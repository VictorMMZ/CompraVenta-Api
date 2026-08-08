<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    
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

    function seller()
    {
        return $this->belongsTo(Seller::class, 'document_id', 'document_id');
    }

    protected $fillable = [
        'user_id',
        'document_id',
        'total',
        'payment_method',
        'notes',
        'purchase_date',
    ];
}
