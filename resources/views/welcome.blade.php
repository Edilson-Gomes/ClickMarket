@extends('layouts.app')

@section('content')
  <!-- Produtos -->
  <main class="p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
      <!-- Card de Produto -->
      @foreach ( $produtos as $prod )
      <div class="bg-white rounded-lg shadow-md p-4 text-center">
        <img src="{{ url('/img/produtos/'.$prod->imagem) }}" alt="{{ $prod->nome }}" class="w-40 h-40 object-cover mx-auto mb-4">
        <h2 class="text-xl font-semibold">{{ $prod->descricao }}</h2>
        <p class="text-green-600 font-bold mt-1">R$ {{ $prod->preco }}</p>
        <form class="mt-4" action="{{ route('carrinho.adicionar', $prod->id) }}" method="POST">
            @csrf
          <input type="number" name="quantidade" value="1" min="1" max="{{ $prod->estoque }}" class="border border-gray-300 rounded px-2 py-1 w-20 text-center" />
          <button type="submit" class="ml-2 px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Carrinho</button>
        </form>
      </div>
      @endforeach

    </div>
  </main>

@endsection