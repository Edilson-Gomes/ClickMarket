<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MovimentoCaixa;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Cliente;

class RelatorioController extends Controller
{
    public function index()
    {
        // 📦 Controle de Estoque
        $produtos = Produto::with('itensPedidos')->get();

        $relatorioEstoque = $produtos->map(function ($produto) {
            $vendido = $produto->itensPedidos->sum('quantidade');
            $estoqueFinal = $produto->estoque;
            $estoqueInicial = $estoqueFinal + $vendido;

            return [
                'nome' => $produto->nome,
                'estoque_inicial' => $estoqueInicial,
                'estoque_final' => $estoqueFinal,
                'vendido' => $vendido,
            ];
        });
        $totalEstoqueInicial = $relatorioEstoque->sum('estoque_inicial');
        $totalEstoqueFinal = $relatorioEstoque->sum('estoque_final');
        $totalEstoqueVendido = $relatorioEstoque->sum('vendido');

        $maisVendido = $relatorioEstoque->sortByDesc('vendido')->first();
        $menosVendido = $relatorioEstoque->sortBy('vendido')->first();

        // 💰 Movimento de Caixa
        $valorInicialCaixa = $produtos->reduce(function ($total, $produto) {
            $vendido = $produto->itensPedidos->sum('quantidade');
            $estoqueFinal = $produto->estoque;
            $estoqueInicial = $estoqueFinal + $vendido;

            return $total + ($estoqueInicial * $produto->preco * 0.7); // 70% de cada produto
        }, 0);

        $valorFinalCaixa = MovimentoCaixa::sum('valor');        
        $totalRecebido = MovimentoCaixa::sum('valor');

        // 🧍‍♂️ Comportamento do Cliente
        $clientes = Cliente::select('clientes.nome')
        ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
        ->join('item_pedidos', 'pedidos.id', '=', 'item_pedidos.pedido_id')
        ->join('produtos', 'item_pedidos.produto_id', '=', 'produtos.id')
        ->selectRaw('clientes.nome, clientes.dia_mes, clientes.dia_semana, produtos.nome as produto, SUM(item_pedidos.quantidade) as total')
        ->groupBy('clientes.nome', 'clientes.dia_mes', 'clientes.dia_semana', 'produtos.nome')
        ->orderBy('clientes.nome')
        ->get()
        ->groupBy('nome');

        $formasPagamentoPorCliente = DB::table('clientes')
        ->join('pedidos', 'clientes.id', '=', 'pedidos.cliente_id')
        ->join('movimento_caixas', 'pedidos.id', '=', 'movimento_caixas.pedido_id')
        ->select('clientes.nome', 'movimento_caixas.tipo', DB::raw('COUNT(*) as total'))
        ->groupBy('clientes.nome', 'movimento_caixas.tipo')
        ->orderBy('clientes.nome')
        ->get()
        ->groupBy('nome');
        // $produtoMaisComprado = Produto::select('nome', DB::raw('SUM(item_pedidos.quantidade) as total'))
        //     ->join('item_pedidos', 'produtos.id', '=', 'item_pedidos.produto_id')
        //     ->groupBy('nome')
        //     ->orderByDesc('total')
        //     ->first();

        // $comprasPorDiaMes = Pedido::select(DB::raw('strftime("%d", created_at) as dia'), DB::raw('COUNT(*) as total'))
        //     ->groupBy('dia')
        //     ->orderByDesc('total')
        //     ->get();

        $formasPagamento = MovimentoCaixa::select('tipo', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo')
            ->orderByDesc('total')
            ->get();

        return view('relatorios.index', compact(
            'valorInicialCaixa',
            'valorFinalCaixa',
            'relatorioEstoque',
            'maisVendido',
            'menosVendido',
            'clientes',
            'formasPagamento',
            'totalEstoqueInicial',
            'totalEstoqueFinal',
            'totalEstoqueVendido',
            'formasPagamentoPorCliente'
        ));
    }
}