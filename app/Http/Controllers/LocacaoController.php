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

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'falha ao mostrar: ' . $e->getMessage()]);
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

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha na create: ' . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $livro = Livro::findOrFail($request->input('livro_id'));

            if ($livro->qtd_estoque <= 0) {
                return redirect()->back()
                    ->withErrors(['estoque' => 'Livro indisponível para locação'])
                    ->withInput();
            }


            Locacao::create([
                'livro_id' => $request->livro_id,
                'usuario_id' => $request->usuario_id,
                'data_emissao' => $request->data_emissao,
                'data_vencimento' => $request->data_vencimento,
            ]);

            $livro->qtd_estoque -= 1;
            $livro->total_locacoes += 1;
            $livro->save();

            return to_route("locacoes.index");

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao salvar: ' . $e->getMessage()]);
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
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => "Falha ao mostrar detalhes de {$id}: " . $e->getMessage()]);
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
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao exibir edicao: ' . $e->getMessage()]);
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

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao salvar ediçao: ' . $e->getMessage()]);
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
            $livro->qtd_estoque -= 1;
            $livro->save();
            Locacao::destroy($id);
            return to_route('locacoes.index');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao excluir: ' . $e->getMessage()]);
        }
    }

    public function relatorio()
    {
        try {

            $livros = Cache::remember('livros', 60, function () {
                return Livro::all();
            });
            $maislocados = Cache::remember('relatorio:mais_locados', 60, function () {
                return Livro::with('ultimaLocacao.usuario')
                    ->orderBy('total_locacoes', 'desc')
                    ->take(10)
                    ->get();
            });

            return view('locacao.relatorio', compact('maislocados', 'livros'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao exibir relatorio: ' . $e->getMessage()]);
        }
    }

    public function generatePdf()
    {
        try {
            $maislocados = Livro::with('ultimaLocacao.usuario')
            ->orderBy('total_locacoes', 'desc')
                ->take(10)
                ->get();

            $pdf = PDF::loadView('locacao.relatorio-pdf', compact('maislocados'));
            return $pdf->stream('relatorio_locacoes.pdf');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha gerar pdf: ' . $e->getMessage()]);
        }
    }
}
