<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class SaleDetail extends Model
{
    use HasFactory;
    function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];
}
