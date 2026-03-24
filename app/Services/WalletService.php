<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class WalletService
{
    /**
     * Credit the user's wallet.
     *
     * @param User $user
     * @param float $amount
     * @param string $source
     * @param mixed|null $ref
     * @param string|null $idempotencyKey
     * @return Transaction
     * @throws Exception
     */
    public function credit(User $user, float $amount, string $source, $ref = null, ?string $idempotencyKey = null): Transaction
    {
        if ($amount <= 0) {
            throw new Exception("Credit amount must be greater than zero.");
        }

        return DB::transaction(function () use ($user, $amount, $source, $ref, $idempotencyKey) {
            $key = $idempotencyKey ?? Str::uuid()->toString();

            // Check idempotency key to prevent double crediting
            $existingTransaction = Transaction::where('idempotency_key', $key)->first();
            if ($existingTransaction) {
                return $existingTransaction;
            }

            return Transaction::create([
                'user_id' => $user->id,
                'type' => 'credit',
                'amount' => $amount,
                'source' => $source,
                'reference_type' => $ref ? get_class($ref) : null,
                'reference_id' => $ref ? $ref->id : null,
                'status' => 'completed',
                'idempotency_key' => $key,
            ]);
        });
    }

    /**
     * Debit the user's wallet.
     *
     * @param User $user
     * @param float $amount
     * @param string $source
     * @param mixed|null $ref
     * @param string|null $idempotencyKey
     * @return Transaction
     * @throws Exception
     */
    public function debit(User $user, float $amount, string $source, $ref = null, ?string $idempotencyKey = null): Transaction
    {
        if ($amount <= 0) {
            throw new Exception("Debit amount must be greater than zero.");
        }

        return DB::transaction(function () use ($user, $amount, $source, $ref, $idempotencyKey) {
            // Lock the user row to prevent concurrent debits from overdrawing
            User::where('id', $user->id)->lockForUpdate()->first();

            $key = $idempotencyKey ?? Str::uuid()->toString();

            $existingTransaction = Transaction::where('idempotency_key', $key)->first();
            if ($existingTransaction) {
                return $existingTransaction;
            }

            // Check if user has sufficient balance
            $balance = $this->getBalance($user);
            if ($balance < $amount) {
                throw new Exception("Insufficient balance.");
            }

            return Transaction::create([
                'user_id' => $user->id,
                'type' => 'debit',
                'amount' => $amount,
                'source' => $source,
                'reference_type' => $ref ? get_class($ref) : null,
                'reference_id' => $ref ? $ref->id : null,
                'status' => 'completed',
                'idempotency_key' => $key,
            ]);
        });
    }

    /**
     * Get the user's current balance based on ledger.
     *
     * @param User $user
     * @return float
     */
    public function getBalance(User $user): float
    {
        $result = Transaction::where('user_id', $user->id)
            ->where('status', 'completed')
            ->selectRaw("SUM(CASE WHEN type='credit' THEN amount ELSE -amount END) as balance")
            ->value('balance');

        return (float) ($result ?? 0);
    }
}
