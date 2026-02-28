<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\locacao;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locacoes = Locacao::all();
        $usuarios = Usuario::all();
        $livros = Livro::all();
        return view('locacao.index', compact('locacoes', 'usuarios', 'livros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = Usuario::all();
        $livros = Livro::all();
        return view('locacao.create', compact('usuarios', 'livros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        locacao::create($request->except('_token'));
        return to_route("locacoes.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
