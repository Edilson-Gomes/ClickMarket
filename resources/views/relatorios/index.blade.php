@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">📊 Relatórios Gerais</h1>

    <section class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-xl font-semibold mb-4 text-green-700">💰 Movimento de Caixa</h2>
        <ul class="list-disc pl-5 text-gray-700 space-y-1">
            <li><strong>Caixa (estoque com valor de 70%):</strong> R$ {{ number_format($valorInicialCaixa, 2, ',', '.') }}</li>
            <li><strong>Entrada (vendido):</strong> R$ {{ number_format($valorFinalCaixa, 2, ',', '.') }}</li>
        </ul>
    </section>

    {{-- 📦 Controle de Estoque --}}
    <section class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-xl font-semibold text-blue-700 mb-4">📦 Controle de Estoque</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Produto</th>
                        <th class="px-4 py-2 text-center">Estoque Inicial</th>
                        <th class="px-4 py-2 text-center">Estoque Final</th>
                        <th class="px-4 py-2 text-center">Total Vendido</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($relatorioEstoque as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item['nome'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $item['estoque_inicial'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $item['estoque_final'] }}</td>
                            <td class="px-4 py-2 text-center">{{ $item['vendido'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-200 text-gray-700 font-bold">
                    <tr>
                        <td class="px-4 py-2">Total</td>
                        <td class="px-4 py-2 text-center">{{ $totalEstoqueInicial }}</td>
                        <td class="px-4 py-2 text-center">{{ $totalEstoqueFinal }}</td>
                        <td class="px-4 py-2 text-center">{{ $totalEstoqueVendido }}</td>
                    </tr>
                </tfoot>
            </table>

        </div>

        <div class="mt-4 text-sm text-gray-700">
            <p><strong>Produto mais vendido:</strong> {{ $maisVendido['nome'] }} ({{ $maisVendido['vendido'] }})</p>
            <p><strong>Produto menos vendido:</strong> {{ $menosVendido['nome'] }} ({{ $menosVendido['vendido'] }})</p>
        </div>
    </section>

    {{-- 🧍‍♂️ Comportamento dos Clientes --}}
    <section class="bg-white p-6 rounded shadow">
        <div class="max-w-5xl mx-auto py-8 px-4">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">🧍‍♂️ Comportamento dos Clientes</h1>

            @foreach ($clientes as $nome => $registros)
                @php
                    $diaMes = $registros->first()->dia_mes;
                    $diaSemana = ucfirst($registros->first()->dia_semana);
                    $maisComprado = $registros->sortByDesc('total')->first();
                @endphp

                <div class="bg-white p-4 rounded shadow mb-6">
                    <h2 class="text-lg font-semibold text-gray-700">{{ $nome }}</h2>
                    <ul class="text-sm text-gray-600 mt-2 space-y-1">
                        <li><strong>Dia do mês que mais compra:</strong> {{ $diaMes ?? 'Não informado' }}</li>
                        <li><strong>Dia da semana preferido:</strong> {{ $diaSemana ?? 'Não informado' }}</li>
                        <li><strong>Produto mais comprado:</strong> {{ $maisComprado->produto }} ({{ $maisComprado->total }} unidades)</li>
                        @php
                            $pagamentos = $formasPagamentoPorCliente[$nome] ?? collect();
                            $preferencia = $pagamentos->sortByDesc('total')->first();
                        @endphp

                        <li><strong>Forma de pagamento preferida:</strong>
                            {{ $preferencia?->tipo ? ucfirst($preferencia->tipo) . " ({$preferencia->total}x)" : 'Não identificado' }}
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection