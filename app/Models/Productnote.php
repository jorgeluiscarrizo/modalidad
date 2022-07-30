<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productnote extends Model
{
    protected $fillable = [
     'id_batches',
     'id_notes',
     'amount',
     'price',
     'subtotal',
     'slug',
     'state'
        ];
        public function note()
        {
            return $this->belongsTo(Note::class);
        }
        public function batch()
        {
            return $this->belongsTo(Batch::class);
        }
}
