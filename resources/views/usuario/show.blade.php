<x-layout titulo="exibir Usuario">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('usuarios.index')}}">Sair</a>
    </div>
    <div class="d-flex flex-column border rounded m-3 w-50 p-3">
        <b>Nome: </b>
        <p>{{ $usuario->nome }}</p>
        <b>Email:</b>
        <p>{{ $usuario->email }}</p>
        <b>Telefone:</b>
        <p>{{ $usuario->telefone }}</p>
    </div>
</x-layout>

