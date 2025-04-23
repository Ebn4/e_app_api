<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(Order_Product::class);
    }
    public function payment()
    {
        return $this->hasOne(Payement::class);
    }
}
