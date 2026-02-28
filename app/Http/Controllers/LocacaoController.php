<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\locacao;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $livro = Livro::find($request->input('livro_id'));
        if ($livro->qtd_estoque <= 0) {
            return redirect()->back()
                ->with(['error', 'Livro indisponível para locação.'])
                ->withInput();

        }

        locacao::create($request->except('_token'));
        $livro->qtd_estoque -= 1;
        $livro->total_locacoes += 1;
        $livro->save();

        return to_route("locacoes.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $locacao = locacao::find($id);
        return view('locacao.show', compact('locacao'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locacao = locacao::findOrFail($id);
        $usuarios = Usuario::all();
        $livros = Livro::all();
        return view('locacao.edit', compact('locacao', 'usuarios', 'livros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        locacao::find($id)->update($request->except('_token'));
        return to_route('locacoes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $locacao = locacao::find($id);
        $livro = Livro::find($locacao->livro_id);
        $livro->qtd_estoque += 1;
        $livro->save();
        locacao::destroy($id);
        return to_route('locacoes.index');
    }

    public function relatorio(){
        $livros = Livro::all();
        $maislocados = Livro::orderBy('total_locacoes', 'desc')->take(5)->get();
        return view('locacao.relatorio', compact('maislocados', 'livros'));
    }
}
