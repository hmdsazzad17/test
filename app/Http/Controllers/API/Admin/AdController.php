<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * List all ads.
     */
    public function index(Request $request)
    {
        $ads = Ad::with('advertiser')->orderByDesc('created_at')->get();

        return response()->json([
            'success' => true,
            'message' => 'Ads retrieved.',
            'data' => ['ads' => $ads]
        ]);
    }

    /**
     * Update ad status (e.g., active, rejected).
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,rejected',
        ]);

        $ad = Ad::findOrFail($id);

        if ($ad->status === 'completed') {
            return response()->json(['success' => false, 'message' => 'Cannot update completed ad.'], 400);
        }

        $ad->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Ad status updated.',
            'data' => ['ad' => $ad]
        ]);
    }
}
