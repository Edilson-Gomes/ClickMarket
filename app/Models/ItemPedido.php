<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    protected $fillable = [
        'quantidade',
        'subtotal',
        'pedido_id',
        'produto_id',
    ];

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}
