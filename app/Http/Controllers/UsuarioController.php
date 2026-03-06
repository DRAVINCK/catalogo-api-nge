<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuarios = Cache::remember('usuarios', 60, function () {
                return Usuario::all();
            });
            return view('usuario.index', compact('usuarios'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao exibir index: ' . $e->getMessage()]);
        }

    }

    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            Usuario::create($request->except('_token'));

            return to_route('usuarios.index');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao criar o usuario: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {

            $usuario = Cache::remember("usuario_{$id}" . $id, 60, function () use ($id) {
                return Usuario::FindOrFail($id);
            });

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => "Falha ao exibir o {$id} : " . $e->getMessage()]);
        }


        return view('usuario.show' , compact('usuario'));
    }

    public function edit(string $id)
    {
        try {

            $usuario = Usuario::find($id);

            return view('usuario.edit' , compact('usuario'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao exibir editar: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            Usuario::find($id)->update($request->except('_token'));

            return to_route('usuarios.index');

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

            Usuario::destroy($id);

            return to_route('usuarios.index');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Falha ao deletar: ' . $e->getMessage()]);
        }

    }
}
