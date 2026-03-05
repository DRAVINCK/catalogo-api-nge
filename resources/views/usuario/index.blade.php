<x-layout titulo="Pagina lista de Usuarios">
    <div class="d-flex justify-content-end m-2">
        <a class="btn btn-sm btn-warning m-1" href="/home">Home</a>
        <a class="btn btn-sm btn-primary m-1" href="{{route('livros.create')}}">Cadastrar</a>
    </div>

    <div class="container">
        <h1 class="mb-4">Lista de Usuários</h1>

        <ul class="bg-white list-unstyled rounded p-2">
            @foreach($usuarios as $usuario)
                <div class="border p-2 m-1 row align-items-center">
                    <div class="col">
                        <strong>Nome:</strong> {{$usuario->nome}} |
                        <strong>Email:</strong> {{$usuario->email}} |
                        <strong>Telefone:</strong> {{$usuario->telefone}}
                    </div>

                    <div class="col-auto">
                        <a class="btn btn-sm btn-primary" href="{{route('usuarios.show', $usuario->id ) }}">Ver</a>
                        <a class="btn btn-sm btn-warning" href="{{route('usuarios.edit', $usuario->id ) }}">Editar</a>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
</x-layout>s

