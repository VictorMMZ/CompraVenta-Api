<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'brand',
        'model',
        'serial_number',
        'description',
        'purchase_price',
        'sale_price',
        'price',
        'category_id',
        'stock',
    ];

    // Relaciones...

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
