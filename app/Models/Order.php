<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'referral_id',
        'order_number',
        'amount',
        'status',
    ];

    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }
}
