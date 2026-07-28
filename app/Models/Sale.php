<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    function saleDetail()
    {
        return $this->hasMany(SaleDetail::class);
    }

    function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    function products()
    {
        return $this->belongsToMany(Product::class, 'sale_details', 'sale_id', 'product_id')
            ->withPivot(['quantity', 'unit_price', 'subtotal'])
            ->withTimestamps();
    }
}
