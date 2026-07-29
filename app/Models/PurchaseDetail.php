<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
