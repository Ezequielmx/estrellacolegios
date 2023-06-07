<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vale extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'fecha',
        'descripcion',
        'monto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
