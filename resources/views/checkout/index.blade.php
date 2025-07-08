@extends('layouts.app')

@section('content')
<section>
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</section>
<div class="max-w-2xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">🧾 Finalizar Pedido</h2>

    <form method="POST" action="{{ route('checkout.processar') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium text-sm text-gray-700">Nome</label>
            <input type="text" name="nome" required class="mt-1 block w-full border px-3 py-2 rounded-md shadow-sm" required/>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Idade</label>
            <input type="number" name="idade" min="0" required class="mt-1 block w-full border px-3 py-2 rounded-md" required/>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Estado Civil</label>
            <select name="estado_civil" required class="mt-1 block w-full border px-3 py-2 rounded-md" required>
                <option value="">Selecione</option>
                <option value="solteira(o)">Solteiro(a)</option>
                <option value="casada(o)">Casado(a)</option>
                <option value="divorciada(o)">Divorciado(a)</option>
                <option value="viuva(o)">Viúvo(a)</option>
            </select>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Quantidade de Filhos</label>
            <input type="number" name="quantidade_filhos" min="0" class="mt-1 block w-full border px-3 py-2 rounded-md" required/>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-sm text-gray-700">Dia do Mês</label>
                <input type="number" name="dia_mes" min="1" max="31" class="mt-1 block w-full border px-3 py-2 rounded-md" required/>
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Dia da Semana</label>
                <select name="dia_semana" class="mt-1 block w-full border px-3 py-2 rounded-md" required>
                    <option value="">Selecione</option>
                    <option value="segunda">Segunda</option>
                    <option value="terça">Terça</option>
                    <option value="quarta">Quarta</option>
                    <option value="quinta">Quinta</option>
                    <option value="sexta">Sexta</option>
                    <option value="sábado">Sábado</option>
                    <option value="domingo">Domingo</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block font-medium text-sm text-gray-700">Horário</label>
            <input type="time" name="horario" class="mt-1 block w-full border px-3 py-2 rounded-md" required/>
        </div>

        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">💳 Forma de pagamento</h2>
            <div>
                <label class="block font-medium text-sm text-gray-700">Tipo de pagamento</label>
                <select name="tipo_pagamento" class="mt-1 block w-full border px-3 py-2 rounded-md" required>
                    <option value="">Selecione</option>
                    <option value="pix">Pix</option>
                    <option value="debito">Débito</option>
                    <option value="credito">Crédito</option>
                </select>
            </div>
            <div>
                <p class="text-end text-xl font-bold">Total: <span class="text-red-700">R$ {{ number_format($total, 2, ',', '.') }}</span></p>
            </div>
        </section>

        <div class="text-right pt-4">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Confirmar Pedido
            </button>
        </div>
    </form>
</div>
@endsection