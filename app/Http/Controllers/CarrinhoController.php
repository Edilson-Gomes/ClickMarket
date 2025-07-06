<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index(){

        return view('carrinho');
    }
    public function adicionar(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $quantidade = $request->input('quantidade', 1);

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade'] += $quantidade;
        } else {
            $carrinho[$id] = [
                'nome' => $produto->nome,
                'quantidade' => $quantidade,
                'preco' => $produto->preco,
                'imagem' => $produto->imagem,
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()->back()->with('sucesso', 'Produto adicionado ao carrinho!');
    }
    public function remover($id)
{
    $carrinho = session()->get('carrinho', []);

    if (isset($carrinho[$id])) {
        unset($carrinho[$id]);
        session()->put('carrinho', $carrinho);
    }

    return redirect()->back()->with('sucesso', 'Produto removido do carrinho.');
}
}
