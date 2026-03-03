<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchCondicao = $request->input('search');
        $filtro = $request->input('filtro');

        $query = Livro::query();

        if ($searchCondicao) {
            $query->where($filtro, 'like', "%{$searchCondicao}%");

        }

        $livros = $query->get();

        return view('livro.index', compact('livros'));
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
            $message = $e->getMessage();
            return response()->json([
                'error'   => 'Erro ao cadastrar livro',
                'details' => $message,
                'type'    => get_class($e)
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $livro = Livro::find($id);
        return view('livro.show', compact('livro'));
    }

    public function edit(string $id)
    {
        $livro = Livro::find($id);
        return view('livro.edit' , compact('livro'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $storage = Storage::disk('s3');

            if ($request->hasFile('image')) {

                $imgAntiga = Livro::find($id)->url_image;

                $storage->delete(str_replace($storage->url(''), '', $imgAntiga));

                $path = Storage::disk('s3')->putFile($request->file('image'));

                $dados['url_image'] = Storage::disk('s3')->url($path);;

            }

            Livro::findOrFail($id)->update($dados);

            return to_route('livros.index');

        } catch (\Exception $e) {
            $message = $e->getMessage();
            return response()->json([
                'error'   => 'Erro ao atualizar livro',
                'details' => $message,
                'type'    => get_class($e)
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imgDelete = Livro::find($id)->url_image;
        $imgDelete = str_replace('/storage/', '', $imgDelete);
        Storage::disk('public')->delete($imgDelete);
        Livro::destroy($id);
        return to_route('livros.index');
    }
}
