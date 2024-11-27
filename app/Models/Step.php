<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_number',
        'budget',
    ];

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
