<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'date_i',
        'date_f',
        'amount',
        'bonus',
        'slug',
        'state',
    ];
}
