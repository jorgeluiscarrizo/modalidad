<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'id_cities',
        'id_goals',
        'neighborhood',
        'slug',
        'state',
    ];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
