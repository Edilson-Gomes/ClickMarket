<?php

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Route;

Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::get('/', [ProdutoController::class, 'index'])->name('produtos');
Route::post('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::delete('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'processar'])->name('checkout.processar');
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');