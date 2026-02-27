<x-layout titulo="Pagina principal">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-primary" href="{{route('usuarios.create')}}">Cadastrar</a>
    </div>
    <div class="container">
        <h1>listar Usuarios</h1>
        <ul>
            @foreach($usuarios as $usuario)
                <li class="border p-2 rounded m-1">
                    Nome: {{$usuario->nome}} | Email: {{$usuario->email}} | Telefone: {{$usuario->telefone}}
                </li>
            @endforeach
        </ul>
    </div>
</x-layout>
