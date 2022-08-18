<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
    'client_id',
    'seller_id',
    'total',
    'slug',
    'state'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
