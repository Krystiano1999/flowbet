<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id',
        'user_id',
        'type',
        'amount',
        'odds',
        'result',
        'win_amount',
        'loss_amount',
        'events_count',
        'won_events_count', 
        'lost_events_count',
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
