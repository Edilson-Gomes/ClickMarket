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

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function itemPedidos(){
        return $this->belongsTo(ItemPedido::class);
    }
}
