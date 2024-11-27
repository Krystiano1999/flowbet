<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_id',
        'type',
        'amount',
        'odds',
        'result',
        'win_amount',
        'loss_amount',
    ];

    public function step()
    {
        return $this->belongsTo(Step::class);
    }
}
