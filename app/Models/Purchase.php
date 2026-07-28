<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_details', 'purchase_id', 'product_id')
            ->withPivot(['quantity', 'unit_price', 'subtotal'])
            ->withTimestamps();
    }
}
