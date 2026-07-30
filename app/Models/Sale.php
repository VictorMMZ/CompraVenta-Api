<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Sale extends Model
{
    use HasFactory;
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
  protected $fillable =[
    
        'customer_id',
        'user_id',
        'total',
        'payment_method',
        'notes',
        'sale_date',
    ];

}
