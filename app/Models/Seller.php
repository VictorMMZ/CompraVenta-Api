<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
