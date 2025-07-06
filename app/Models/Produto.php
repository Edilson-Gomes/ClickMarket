<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'preco',
        'estoque',
        'descricao',
        'imagem',
    ];

    public function itemPedidos()
    {
        return $this->belongsTo(ItemPedido::class);
    }
}

