<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SuperMercado Digital</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navbar -->
  <header class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-bold">🛒 ClickMarket</h1>
    <nav class="space-x-4">
      <div class="flex">
        <div>
          <a href="{{ route('produtos') }}" class="hover:underline p-3">Início</a>
        </div>
        <div>
          <a href="{{ route('carrinho.index') }}" class="relative flex items-center text-white hover:underline">
            Carrinho
            @if($quantidadeTotal > 0)
              <span class="absolute -top-2 left-1/2 transform -translate-x-1/2 bg-red-600 text-white text-xs font-bold rounded-full px-2 py-0.5">
                {{ $quantidadeTotal }}
              </span>
            @endif
          </a>
        </div>
      </div>
    </nav>
  </header>
  <section class="text-center">
    @if (session('sucesso'))
        <p class="text-green-600 font-semibold">{{ session('sucesso') }}</p>
      @endif
  </section>
  <!-- Produtos -->
  @yield('content')

</body>
</html>