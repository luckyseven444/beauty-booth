<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    /**
     * Get the phone associated with the user.
     */
    public function orderDetail(): HasOne
    {
        return $this->hasOne(OrderDetail::class);
    }

}
