<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $livros = Cache::remember('livros', 120, function () {
                return Livro::all();
            });

            $searchCondicao = $request->input('search');
            $filtro = $request->input('filtro');


            if ($searchCondicao) {
                $livros = $livros->filter(function ($livro) use ($filtro, $searchCondicao) {
                    return str_contains(strtolower($livro->{$filtro}), strtolower($searchCondicao));
                });

            }
            return view('livro.index', compact('livros'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao exibir livros: ' . $e->getMessage()]);
        }
    }

    public function create()
    {
        return view('livro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $request->validate([
                'image'          => [
                    'required',
                    'file',
                    'mimes:jpg,jpeg,png,pdf',
                    'max:2048'
                ]
            ]);

            $path = Storage::disk('s3')->putFile($request->file('image'));

            if (!$path) {
                return response()->json(['error' => 'Falha ao salvar no S3']);

            }

            $url = Storage::disk('s3')->url($path);

            $dados = $request->except('_token') + ['url_image' => $url];

            Livro::create($dados);

            return redirect()->route("livros.index")->with('sucesso', 'Livro cadastrado!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao criar Livro: ' . $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {
            $livro = Cache::remember("livro_{$id}", 60, function () use ($id) {
                return Livro::findOrFail($id);
            });

            return view('livro.show', compact('livro'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => "Falha ao exibir o livro {$id}: " . $e->getMessage()]);
        }

    }

    public function edit(string $id)
    {
        try {
            $livro = Livro::find($id);
            return view('livro.edit' , compact('livro'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha no processo de edição: ' . $e->getMessage()]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $livro = Livro::findOrFail($id);
            $storage = Storage::disk('s3');

            $dados = $request->except(['_token', 'image']);

            if ($request->hasFile('image')) {
                if ($livro->url_image) {
                    $pathAntigo = str_replace($storage->url(''), '', $livro->url_image);
                    $storage->delete($pathAntigo);
                }

                $pathNovo = $storage->putFile($request->file('image'));
                $dados['url_image'] = $storage->url($pathNovo);
            }

            $livro->update($dados);

            return to_route('livros.index');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao salvar edicao: ' . $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $storage = Storage::disk('s3');

            $imgDelete = Livro::find($id)->url_image;
            $storage->delete(str_replace($storage->url(''), '', $imgDelete));

            Livro::destroy($id);
            return to_route('livros.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao deletar livro: ' . $e->getMessage()]);
        }
    }
}
