<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Locacao;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $locacoes = Cache::remember('locacoes', 60, function () {
                return Locacao::all();
            });
            $livros = Cache::remember('livros', 60, function () {
                return Livro::all();
            });
            $usuarios = Cache::remember('usuarios', 60, function () {
                return Usuario::all();
            });

            return view('locacao.index', compact('locacoes', 'livros', 'usuarios'));

        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $usuarios = Usuario::all();
            $livros = Livro::all();
            return view('locacao.create', compact('usuarios', 'livros'));

        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $livro = Livro::find($request->input('livro_id'));
            if ($livro->qtd_estoque <= 0) {
                return redirect()->back()
                    ->with(['error', 'Livro indisponível para locação.'])
                    ->withInput();

            }

            Locacao::create($request->except('_token'));
            $livro->qtd_estoque -= 1;
            $livro->total_locacoes += 1;
            $livro->save();

            return to_route("locacoes.index");

        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $locacao = Cache::remember("locacao_{$id}", 60, function () use ($id) {
                return Locacao::findOrFail($id);
            });

            return view('locacao.show', compact('locacao'));
        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {

            $locacao = Locacao::findOrFail($id);
            $usuarios = Usuario::all();
            $livros = Livro::all();
            return view('locacao.edit', compact('locacao', 'usuarios', 'livros'));
        }
        catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            Locacao::find($id)->update($request->except('_token'));
            return to_route('locacoes.index');

        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $locacao = Locacao::find($id);
            $livro = Livro::find($locacao->livro_id);
            $livro->qtd_estoque += 1;
            $livro->save();
            Locacao::destroy($id);
            return to_route('locacoes.index');

        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }
    }

    public function relatorio()
    {
        try {


            $livros = Cache::remember('livros', 60, function () {
                return Livro::all();
            });
            $maislocados = Cache::remember('total_locacoes', 60, function (){
                return Livro::orderBy('total_locacoes', 'desc')->take(10)->get();
            });

            return view('locacao.relatorio', compact('maislocados', 'livros'));
        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }
    }

    public function generatePdf()
    {
        try {
            $maislocados = Livro::orderBy('total_locacoes', 'desc')->take(10)->get();
            $pdf = PDF::loadView('locacao.relatorio-pdf', compact('maislocados'));
            return $pdf->stream('relatorio_locacoes.pdf');

        }catch (\Exception $e){
            $mensagem = $e->getMessage();
            Log::error($mensagem);
            response()->json([ 'mensagem' => $mensagem]);
        }
    }
}
