<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailseller extends Model
{
    protected $fillable = [
        'id_sellers',
        'id_routes',
        'date_i',
        'date_f',
        'slug',
        'state',
    ];
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
