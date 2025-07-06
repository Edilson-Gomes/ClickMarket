<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'idade',
        'estado_civil',
        'quantidade_filhos',
        'dia_mes',
        'dia_semana',
        'horario',
    ];

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
