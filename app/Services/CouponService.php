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
}
