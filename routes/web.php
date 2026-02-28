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

Route::resource('usuarios', UsuarioController::class);

Route::resource('livros', LivroController::class);

Route::resource('locacoes', LocacaoController::class);
