<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentoCaixa extends Model
{
    protected $fillable = [
        'valor',
        'tipo',
        'data',
        'pedido_id',
    ];
}
