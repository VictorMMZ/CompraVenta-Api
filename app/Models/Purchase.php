<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  

class Purchase extends Model
{
    use HasFactory;

    
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

    protected $fillable = [
        'user_id',
        'seller_id',
        'total',
        'payment_method',
        'notes',
    ];
}
