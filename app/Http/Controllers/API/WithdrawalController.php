<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WithdrawalController extends Controller
{
    /**
     * Get user withdrawals.
     */
    public function index(Request $request)
    {
        $withdrawals = Withdrawal::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Withdrawals retrieved successfully.',
            'data' => ['withdrawals' => $withdrawals]
        ]);
    }

    /**
     * Request a new withdrawal.
     */
    public function store(Request $request, WalletService $walletService)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:5.00', // Minimum withdrawal threshold
            'method' => 'required|in:paypal,crypto,bank',
            'account_details' => 'required|array',
        ]);

        $user = $request->user();

        try {
            DB::transaction(function () use ($user, $validated, $walletService, &$withdrawal) {
                // Debit the wallet first (it locks user and throws if insufficient)
                $transaction = $walletService->debit(
                    $user,
                    $validated['amount'],
                    'withdrawal',
                    null, // No ref yet
                    Str::uuid()->toString()
                );

                // Create the withdrawal record
                $withdrawal = Withdrawal::create([
                    'user_id' => $user->id,
                    'amount' => $validated['amount'],
                    'method' => $validated['method'],
                    'account_details' => $validated['account_details'],
                    'status' => 'pending',
                ]);

                // Link the transaction to the new withdrawal reference
                $transaction->update([
                    'reference_type' => Withdrawal::class,
                    'reference_id' => $withdrawal->id,
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'WITHDRAWAL_FAILED',
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Withdrawal requested successfully.',
            'data' => ['withdrawal' => $withdrawal]
        ], 201);
    }
}
