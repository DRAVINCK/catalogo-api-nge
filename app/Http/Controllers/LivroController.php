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
        $request->validate([
            'image'          => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048'
            ]
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('livros', 'public');

            $url = Storage::url($path);

        }

        $dados = $request->except('_token') + ['url_image' => $url];

        Livro::create($dados);

        return redirect()->route("livros.index")->with('sucesso', 'Livro cadastrado!');


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

        if ($request->hasFile('image')) {

            $imgAntiga = Livro::find($id)->url_image;
            $imgAntiga = str_replace('/storage/', '', $imgAntiga);
            Storage::disk('public')->delete($imgAntiga);

            $path = $request->file('image')->store('livros', 'public');

            $dados['url_image'] = Storage::url($path);;

        }

        Livro::findOrFail($id)->update($dados);

        return to_route('livros.index');
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
