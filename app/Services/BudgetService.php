<?php

namespace App\Services;

use App\Models\UserTransaction;
use App\Models\Coupon;

class BudgetService
{
    /**
     * Calculate user budget.
     *
     * @param int $userId
     * @return float
     */
    public function calculateBudget(int $userId): float
    {
        $deposits = UserTransaction::where('user_id', $userId)
            ->where('type', 'deposit')
            ->sum('amount');

        $withdrawals = UserTransaction::where('user_id', $userId)
            ->where('type', 'withdrawal')
            ->sum('amount');

        $stakes = Coupon::where('user_id', $userId)
            ->sum('amount');

        $wins = Coupon::where('user_id', $userId)
            ->where('result', 'win')
            ->sum('win_amount');

        return round($deposits - $withdrawals - $stakes + $wins, 2);
    }
}
