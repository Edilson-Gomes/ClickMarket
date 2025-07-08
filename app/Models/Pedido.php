<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'total',
        'data',
        'cliente_id',
    ];

    public function cliente(){
        return $this->hasMany(Cliente::class);
    }

    public function itemPedidos(){
        return $this->belongsTo(ItemPedido::class);
    }

    public function movimentoCaixa(){
        return $this->belongsTo(MovimentoCaixa::class);
    }
}
