<?php

namespace App\Services;

use App\Models\UserTransaction;

class TransactionService
{
    /**
     * Retrieve user transactions.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserTransactions(int $userId)
    {
        return UserTransaction::where('user_id', $userId)->get();
    }

    /**
     * Create new transaction.
     *
     * @param int $userId
     * @param array $data
     * @return UserTransaction
     */
    public function createTransaction(int $userId, array $data): UserTransaction
    {
        return UserTransaction::create([
            'user_id' => $userId,
            'type' => $data['type'],
            'amount' => $data['amount'],
        ]);
    }
}
