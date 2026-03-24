<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepositController extends Controller
{
    /**
     * Get user deposits.
     */
    public function index(Request $request)
    {
        $deposits = Deposit::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Deposits retrieved successfully.',
            'data' => ['deposits' => $deposits]
        ]);
    }

    /**
     * Create a deposit intent.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1.00',
            'gateway' => 'required|string',
        ]);

        $deposit = Deposit::create([
            'user_id' => $request->user()->id,
            'amount' => $validated['amount'],
            'gateway' => $validated['gateway'],
            'status' => 'pending',
            'external_ref' => Str::uuid()->toString(), // Usually from the gateway
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Deposit intent created. Proceed to gateway.',
            'data' => ['deposit' => $deposit]
        ], 201);
    }

    /**
     * Mock webhook to confirm a deposit.
     */
    public function webhook(Request $request, WalletService $walletService)
    {
        $validated = $request->validate([
            'external_ref' => 'required|string|exists:deposits,external_ref',
            'status' => 'required|in:completed,failed',
        ]);

        $deposit = Deposit::where('external_ref', $validated['external_ref'])->firstOrFail();

        if ($deposit->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Deposit already processed.'], 400);
        }

        try {
            DB::transaction(function () use ($deposit, $validated, $walletService) {
                $deposit->update(['status' => $validated['status']]);

                if ($validated['status'] === 'completed') {
                    $walletService->credit(
                        $deposit->user,
                        $deposit->amount,
                        'deposit',
                        $deposit,
                        "deposit_{$deposit->id}_credit"
                    );
                }
            });
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to process webhook.', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'Webhook processed successfully.']);
    }
}
