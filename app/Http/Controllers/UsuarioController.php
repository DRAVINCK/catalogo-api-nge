<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

        }catch (\Exception $e){
            $message = $e->getMessage();
            response()->json(['error' => $message]);
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

        }catch (\Exception $e){
            $message = $e->getMessage();
            response()->json(['error' => $message]);
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

        }catch (\Exception $e){
            $message = $e->getMessage();
            response()->json(['error' => $message]);
        }


        return view('usuario.show' , compact('usuario'));
    }

    public function edit(string $id)
    {
        try {

            $usuario = Usuario::find($id);

            return view('usuario.edit' , compact('usuario'));

        }catch (\Exception $e){
            $message = $e->getMessage();
            response()->json(['error' => $message]);
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

        }catch (\Exception $e){
            $message = $e->getMessage();
            response()->json(['error' => $message]);
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

        }catch (\Exception $e){
            $message = $e->getMessage();
            response()->json(['error' => $message]);
        }

    }
}
