<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
  

    protected $fillable = [
        'type_id',
        'name',
        'num_cell',
        'slug',
        'state',
    ];
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
