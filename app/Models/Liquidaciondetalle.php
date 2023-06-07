<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidaciondetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'liquidacione_id',
        'servicio_id',
        'frente',
        'ficha',
        'plus_doble_serv',
        'plus_triple_serv'
    ];
}
