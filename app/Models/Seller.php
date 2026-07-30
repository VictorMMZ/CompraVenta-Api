<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Model
{
    use HasFactory;

    function sale()
    {
        return $this->hasMany(Sale::class);
    }

    protected $fillable = [
        'name',
        'document_id',
        'phone',
        'notes',
    ];

}
