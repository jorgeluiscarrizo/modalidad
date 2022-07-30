<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_products',
        'name',
        'price',
        'stock',
        'slug',
        'state'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
