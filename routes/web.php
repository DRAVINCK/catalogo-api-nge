<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
});


Route::get('/teste-s3', function () {
    try {
        Storage::disk('s3')->put('teste.txt', 'ok teste');
        return 'Upload OK';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Route::get('/debug-s3', function () {
    return config('filesystems.disks.s3');
});

Route::get('locacoes/relatorio', [LocacaoController::class, 'relatorio'])->name('locacoes.relatorio');

Route::get('locacoes/generate', [LocacaoController::class, 'generatePdf'])-> name('locacoes.generatePdf');

Route::resource('usuarios', UsuarioController::class);

Route::resource('livros', LivroController::class);

Route::resource('locacoes', LocacaoController::class);

