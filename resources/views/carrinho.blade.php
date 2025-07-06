@extends('layouts.app')

@section('content')

  <!-- Conteúdo -->
  <main class="p-6 max-w-4xl mx-auto bg-white rounded shadow mt-6">
    <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">🛒 Seu Carrinho</h2>

    @if(session('carrinho') && count(session('carrinho')) > 0)
        <table class="w-full text-left">
            <thead class="border-b font-semibold text-gray-700">
                <tr>
                    <th>Produto</th>
                    <th class="text-center">Qtd</th>
                    <th class="text-right">Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('carrinho') as $id => $item)
                    @php $subtotal = $item['quantidade'] * $item['preco']; $total += $subtotal; @endphp
                    <tr class="border-b py-2">
                        <td class="py-2 flex items-center gap-4">
                            <img src="{{ asset('/img/produtos/' . $item['imagem']) }}" class="w-16 h-16 object-cover rounded" alt="img">
                            <span>{{ $item['nome'] }}</span>
                        </td>
                        <td class="text-center">{{ $item['quantidade'] }}</td>
                        <td class="text-right">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td class="text-right">
                            <form method="POST" action="{{ route('carrinho.remover', $id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline text-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-4">
            <p class="text-xl font-bold">Total: R$ {{ number_format($total, 2, ',', '.') }}</p>
            <a href="{{ route('checkout.index') }}"
                class="inline-block mt-3 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Finalizar Compra
            </a>
        </div>
    @else
        <p class="text-gray-600">O carrinho está vazio.</p>
    @endif
</div>

  </main>

@endsection