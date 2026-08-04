<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Model
{
    use HasFactory;

    function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    protected $fillable = [
        'name',
        'document_id',
        'phone',
        'notes',
    ];

}
