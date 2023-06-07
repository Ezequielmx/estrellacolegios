<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pluse extends Model
{
    use HasFactory;

    protected $fillable = [
        'plustipo_id',
        'user_id',
        'fecha',
        'descripcion',
        'monto',
    ];

    public function tipo()
    {
        return $this->belongsTo(Plustipo::class, 'plustipo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
