<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidacione extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'desde',
        'hasta',
        'subtotal',
        'vales',
        'neto'
    ];
}
