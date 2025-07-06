<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Produto;
use App\Models\MovimentoCaixa;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function index()
    {
        $carrinho = session('carrinho', []);
        $total = collect($carrinho)->sum(function($item) {
            return $item['quantidade'] * $item['preco'];
        });
        if (empty($carrinho)) {
            return redirect()->route('/')->with('sucesso', 'Seu carrinho está vazio.');
        }

        return view('checkout.index', compact('carrinho', 'total'));
    }

    public function processar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'idade' => 'required|integer|min:0',
            'estado_civil' => 'required|string',
            'quantidade_filhos' => 'nullable|integer|min:0',
            'dia_mes' => 'nullable|integer|min:1|max:31',
            'dia_semana' => 'nullable|string',
            'horario' => 'nullable|string',
        ]);

        $carrinho = session('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->route('produtos')->with('sucesso', 'Carrinho vazio.');
        }

        DB::beginTransaction();

        try {
            // 1. Salvar cliente
            $cliente = Cliente::create($request->only([
                'nome', 'idade', 'estado_civil', 'quantidade_filhos', 'dia_mes', 'dia_semana', 'horario'
            ]));

            // 2. Criar pedido
            $pedido = Pedido::create([
                'cliente_id' => $cliente->id,
                'total' => 0,
            ]);

            $total = 0;

            // 3. Criar itens do pedido e atualizar estoque
            foreach ($carrinho as $id => $item) {
                $produto = Produto::find($id);

                if (!$produto || $produto->estoque < $item['quantidade']) {
                    DB::rollBack();
                    return redirect()->route('carrinho.index')->with('erro', "Estoque insuficiente para {$item['nome']}.");
                }

                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'subtotal' => $item['quantidade'] * $produto->preco,
                ]);

                $produto->estoque -= $item['quantidade'];
                $produto->save();

                $total += $item['quantidade'] * $produto->preco;
            }

            // 4. Atualiza o total do pedido
            $pedido->total = $total;
            $pedido->save();

            // 5. Registra no movimento de caixa
            MovimentoCaixa::create([
                'valor' => $total,
                'tipo' => $request->input('tipo_pagamento'),
                'data' => now(),
            ]);

            // 6. Limpa carrinho
            session()->forget('carrinho');

            DB::commit();

            return redirect()->route('produtos')->with('sucesso', 'Pedido finalizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkout.index')->with('erro', 'Erro ao processar o pedido.'. $e->getMessage());
        }
    }

}