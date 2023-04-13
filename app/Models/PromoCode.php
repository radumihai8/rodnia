<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* get total uses of promo code */
    public function getTotalUsesAttribute()
    {
        return $this->hasMany(PromoCodeRedeem::class, 'promo_code_id', 'id')->count();
    }
}
