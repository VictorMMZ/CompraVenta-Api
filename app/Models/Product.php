<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'purchase_details', 'product_id', 'purchase_id')
            ->withPivot(['quantity', 'unit_price', 'subtotal'])
            ->withTimestamps();
    }

    function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_details', 'product_id', 'sale_id')
            ->withPivot(['quantity', 'unit_price', 'subtotal'])
            ->withTimestamps();
    }
}
