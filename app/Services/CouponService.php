<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    /**
     * Create a new coupon.
     *
     * @param array $data
     * @return Coupon
     */
    public function createCoupon(array $data): Coupon
    {
        $data['step_id'] = (int) $data['step_id'];
        $data['user_id'] = (int) $data['user_id'];
        $data['amount'] = (float) $data['amount'];
        $data['odds'] = (float) $data['odds'];
        $data['events_count'] = (int) $data['events_count'];
        $data['won_events_count'] = (int) $data['won_events_count'];
        $data['lost_events_count'] = (int) $data['lost_events_count'];

        if ($data['result'] === 'win') {
            $data['win_amount'] = floor((($data['amount'] - ($data['amount'] * 0.12)) * $data['odds']) * 100) / 100;
            $data['loss_amount'] = 0;
        } elseif ($data['result'] === 'lose') {
            $data['loss_amount'] = $data['amount'];
            $data['win_amount'] = 0;
        }

        return Coupon::create($data);
    }


    /**
     * Retrieve coupons, grouping them by steps, along with a summary.
     *
     * @return array
     */
    public function getCouponsGroupedByStep(): array
    {
        return Coupon::with('step')
            ->get()
            ->groupBy('step.step_number')
            ->map(function ($group) {
                $summary = [
                    'total_amount' => 0,
                    'total_win' => 0,
                    'total_loss' => 0,
                    'total_balance' => 0,
                ];

                $group = $group->map(function ($coupon) use (&$summary) {
                    $balance = $coupon->result === 'win'
                        ? $coupon->win_amount - $coupon->amount
                        : 0 - $coupon->amount;

                    $summary['total_amount'] += $coupon->amount;
                    $summary['total_win'] += $coupon->win_amount ?? 0;
                    $summary['total_loss'] += $coupon->loss_amount ?? 0;
                    $summary['total_balance'] += $balance;

                    $isFinished = ($coupon->won_events_count + $coupon->lost_events_count === $coupon->events_count);
                    $status = $isFinished ? 'inactive' : 'active';

                    return [
                        'id' => $coupon->id,
                        'type' => $coupon->type === 'standard'
                            ? 'Kupon'
                            : 'Extra',
                        'amount' => $coupon->amount,
                        'odds' => $coupon->odds,
                        'result' => $coupon->result,
                        'win_amount' => $coupon->win_amount,
                        'loss_amount' => $coupon->loss_amount,
                        'balance' => $balance,
                        'events_count' => $coupon->events_count,
                        'won_events_count' => $coupon->won_events_count,
                        'lost_events_count' => $coupon->lost_events_count,
                        'status' => $status,
                    ];
                });

                return [
                    'coupons' => $group,
                    'summary' => $summary,
                ];
            })
            ->toArray();
    }
}
