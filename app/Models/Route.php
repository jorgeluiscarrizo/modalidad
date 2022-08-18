<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'citi_id',
        'goal_id',
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
