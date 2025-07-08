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

    public function itensPedidos()
    {
        return $this->hasMany(ItemPedido::class);
    }
}

