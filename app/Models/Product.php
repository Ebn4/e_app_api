<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cartProducts()
    {
        return $this->hasMany(Cart_Product::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(Order_Product::class);
    }
}
