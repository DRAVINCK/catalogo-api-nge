<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\Translation\t;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
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
        Usuario::create($request->except('_token'));
        return to_route('usuarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::find($id);
        return view('usuario.show' , compact('usuario'));
    }

    public function edit(string $id)
    {
        $usuario = Usuario::find($id);
        return view('usuario.edit' , compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Usuario::find($id)->update($request->except('_token'));
        return to_route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Usuario::destroy($id);
        return to_route('usuarios.index');

    }
}
