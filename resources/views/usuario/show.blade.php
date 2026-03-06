<x-layout titulo="exibir Usuario">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('usuarios.index')}}">Sair</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container flex-control w-50">
        <h1>Exibir Usuário</h1>
        <div class="bg-white border p-4 roundedr">
            <b>Nome: </b>
            <p>{{ $usuario->nome }}</p>
            <b>Email:</b>
            <p>{{ $usuario->email }}</p>
            <b>Telefone:</b>
            <p>{{ $usuario->telefone }}</p>
        </div>
    </div>
</x-layout>

