<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){
        $produtos = Produto::all();
        $carrinho = session('carrinho', []);
        $quantidadeTotal = collect($carrinho)->sum('quantidade');

        return view('welcome', compact('produtos', 'quantidadeTotal'));
    }
}
