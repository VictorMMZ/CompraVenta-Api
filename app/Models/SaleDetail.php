<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
