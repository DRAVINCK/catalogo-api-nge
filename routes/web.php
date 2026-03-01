<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return view('teste');
});

Route::get('locacoes/relatorio', [LocacaoController::class, 'relatorio'])->name('locacoes.relatorio');

Route::get('locacoes/generate', [LocacaoController::class, 'generatePdf'])-> name('locacoes.generatePdf');

Route::resource('usuarios', UsuarioController::class);

Route::resource('livros', LivroController::class);

Route::resource('locacoes', LocacaoController::class);

