<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdView;
use App\Models\Referral;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdController extends Controller
{
    /**
     * Get a list of active ads for earners, or all ads for an advertiser.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user && $user->role === 'advertiser') {
            $ads = Ad::where('advertiser_id', $user->id)->get();
            return response()->json([
                'success' => true,
                'message' => 'Ads retrieved.',
                'data' => ['ads' => $ads]
            ]);
        }

        // For earners or guests (if allowed), show active ads with remaining clicks
        $ads = Ad::where('status', 'active')
            ->where('remaining_clicks', '>', 0)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Active ads retrieved.',
            'data' => ['ads' => $ads]
        ]);
    }

    /**
     * Create a new ad (Advertisers only).
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'advertiser' && $user->role !== 'admin') {
            return response()->json(['success' => false, 'error' => 'UNAUTHORIZED', 'message' => 'Only advertisers can create ads.'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'reward_amount' => 'required|numeric|min:0.0001',
            'duration_seconds' => 'required|integer|min:5',
            'total_clicks' => 'required|integer|min:1',
            'country_targets' => 'nullable|array',
            'device_targets' => 'nullable|array',
        ]);

        $validated['advertiser_id'] = $user->id;
        $validated['remaining_clicks'] = $validated['total_clicks'];
        $validated['status'] = 'pending'; // Requires admin approval later

        $ad = Ad::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ad created successfully.',
            'data' => ['ad' => $ad]
        ], 201);
    }

    /**
     * Update an ad.
     */
    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);
        $user = $request->user();

        if ($user->role !== 'admin' && $ad->advertiser_id !== $user->id) {
            return response()->json(['success' => false, 'error' => 'UNAUTHORIZED', 'message' => 'Unauthorized.'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'url' => 'sometimes|url',
            // Typically shouldn't allow changing reward_amount or duration once started,
            // but we'll allow it for simplicity here unless specified otherwise.
        ]);

        $ad->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Ad updated successfully.',
            'data' => ['ad' => $ad]
        ]);
    }

    /**
     * Pause an ad.
     */
    public function pause(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);
        $user = $request->user();

        if ($user->role !== 'admin' && $ad->advertiser_id !== $user->id) {
            return response()->json(['success' => false, 'error' => 'UNAUTHORIZED', 'message' => 'Unauthorized.'], 403);
        }

        if ($ad->status !== 'active' && $ad->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Ad cannot be paused from current state.'], 400);
        }

        $ad->update(['status' => 'paused']);

        return response()->json([
            'success' => true,
            'message' => 'Ad paused successfully.',
            'data' => ['ad' => $ad]
        ]);
    }

    /**
     * Start an ad view session.
     */
    public function start(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);
        $user = $request->user();

        // Validate eligibility
        if ($ad->status !== 'active' || $ad->remaining_clicks <= 0) {
            return response()->json(['success' => false, 'message' => 'Ad is not available.'], 400);
        }

        $alreadyViewed = AdView::where('user_id', $user->id)
            ->where('ad_id', $ad->id)
            ->where('status', 'completed')
            ->exists();

        if ($alreadyViewed) {
            return response()->json(['success' => false, 'message' => 'You have already completed this ad.'], 400);
        }

        // Check for an existing in_progress session, maybe fail or restart it. We'll fail to avoid duplicates.
        $inProgress = AdView::where('user_id', $user->id)
            ->where('ad_id', $ad->id)
            ->where('status', 'in_progress')
            ->first();

        if ($inProgress) {
            // Can choose to return the existing one
            return response()->json([
                'success' => true,
                'message' => 'Ad session already in progress.',
                'data' => [
                    'session_id' => $inProgress->id, // Simple token representation
                    'duration' => $ad->duration_seconds,
                    'started_at' => $inProgress->started_at
                ]
            ]);
        }

        $adView = AdView::create([
            'user_id' => $user->id,
            'ad_id' => $ad->id,
            'started_at' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'in_progress'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ad session started.',
            'data' => [
                'session_id' => $adView->id,
                'duration' => $ad->duration_seconds,
            ]
        ]);
    }

    /**
     * Complete an ad view session.
     */
    public function complete(Request $request, $id, WalletService $walletService)
    {
        $request->validate([
            'session_id' => 'required|integer',
            'visibility_violations' => 'integer|min:0',
            // 'captcha_passed' => 'boolean' (if implemented)
        ]);

        $ad = Ad::findOrFail($id);
        $user = $request->user();
        $adView = AdView::where('id', $request->session_id)
            ->where('user_id', $user->id)
            ->where('ad_id', $ad->id)
            ->where('status', 'in_progress')
            ->first();

        if (!$adView) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired session.'], 400);
        }

        // Server validation
        $elapsed = Carbon::now()->diffInSeconds($adView->started_at);
        if ($elapsed < $ad->duration_seconds) {
            return response()->json(['success' => false, 'message' => 'Ad duration not met.'], 400);
        }

        // Check if ad still has clicks (to avoid race conditions)
        if ($ad->remaining_clicks <= 0) {
            $adView->update(['status' => 'failed']);
            return response()->json(['success' => false, 'message' => 'Ad has no remaining clicks.'], 400);
        }

        try {
            DB::transaction(function () use ($adView, $ad, $user, $request, $walletService) {
                // Update AdView
                $adView->update([
                    'status' => 'completed',
                    'completed_at' => now(),
                    'visibility_violations' => $request->input('visibility_violations', 0),
                    'reward_given' => true,
                ]);

                // Decrement clicks
                $updated = DB::table('ads')
                    ->where('id', $ad->id)
                    ->where('remaining_clicks', '>', 0)
                    ->decrement('remaining_clicks');

                if (!$updated) {
                    throw new \Exception('Failed to decrement ad clicks due to concurrent updates.');
                }

                // If remaining_clicks becomes 0, status could be set to 'completed'
                $ad->refresh();
                if ($ad->remaining_clicks == 0) {
                    $ad->update(['status' => 'completed']);
                }

                // Insert User Credit Transaction
                $walletService->credit(
                    $user,
                    $ad->reward_amount,
                    'ad_view',
                    $adView,
                    "adview_{$adView->id}_reward" // Deterministic key based on session
                );

                // Referral commission logic
                $referral = Referral::where('referred_user_id', $user->id)->first();
                if ($referral) {
                    $commissionAmount = $ad->reward_amount * $referral->commission_rate;
                    if ($commissionAmount > 0) {
                        $walletService->credit(
                            $referral->referrer, // $referral->referrer automatically resolves to User due to belongsTo
                            $commissionAmount,
                            'referral',
                            $adView,
                            "adview_{$adView->id}_referral_commission"
                        );
                    }
                }
            });
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to complete ad.', 'error' => $e->getMessage()], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ad completed successfully.',
            'data' => [
                'reward' => $ad->reward_amount,
            ]
        ]);
    }
}
