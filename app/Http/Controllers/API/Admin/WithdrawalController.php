<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WithdrawalController extends Controller
{
    /**
     * List all withdrawals.
     */
    public function index(Request $request)
    {
        $withdrawals = Withdrawal::with('user')->orderByDesc('created_at')->get();

        return response()->json([
            'success' => true,
            'message' => 'Withdrawals retrieved.',
            'data' => ['withdrawals' => $withdrawals]
        ]);
    }

    /**
     * Process (approve/reject/paid) withdrawal.
     */
    public function process(Request $request, $id, WalletService $walletService)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,paid',
        ]);

        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status === 'paid' || $withdrawal->status === 'rejected') {
            return response()->json(['success' => false, 'message' => 'Withdrawal is already finalized.'], 400);
        }

        try {
            DB::transaction(function () use ($withdrawal, $validated, $request, $walletService) {
                $withdrawal->update([
                    'status' => $validated['status'],
                    'processed_by' => $request->user()->id,
                ]);

                // Refund the user if the withdrawal is rejected
                if ($validated['status'] === 'rejected') {
                    $walletService->credit(
                        $withdrawal->user,
                        $withdrawal->amount,
                        'adjustment',
                        $withdrawal,
                        "withdrawal_{$withdrawal->id}_refund"
                    );
                }

                // E.g., if 'approved', dispatch job to process payment
                // if ($validated['status'] === 'approved') {
                //     ProcessWithdrawalJob::dispatch($withdrawal);
                // }
            });
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to process withdrawal.', 'error' => $e->getMessage()], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Withdrawal processed.',
            'data' => ['withdrawal' => $withdrawal]
        ]);
    }
}
