<x-layout titulo="Editar Usuario">
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
        <h1>Editar Usuário</h1>
        <div class="bg-white border p-4 rounded">
            <form class="form mt-1" action="{{route('usuarios.update', $usuario->id)}}" method="post">
                @csrf
                @method('PUT')
                <strong>Nome:</strong>
                <input value="{{ $usuario->nome }}"
                       placeholder="Digite o Nome"
                       autocomplete="off"
                       type="text"
                       name="nome"
                       class="form-control mt-1 mb-3">

                <strong >Email:</strong>
                <input value="{{ $usuario->email }}"
                       placeholder="Digite o Email"
                       autocomplete="off"
                       type="text"
                       name="email"
                       class="form-control mt-1 mb-3">

                <strong>Telefone:</strong>
                <input value="{{ $usuario->telefone }}"
                       placeholder="Digite o Telefone"
                       autocomplete="off"
                       type="text"
                       name="telefone"
                       class="form-control mt-1 mb-3">

                <input type="submit" class="btn btn-primary mt-1 mb-3" value="Atualizar">

            </form>

            <div class="align-items-center d-flex gap-2">

                <form action="{{route('usuarios.destroy', $usuario->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger mt-1 mb-3" value="Deletar">
                </form>
            </div>

    </div>
</x-layout>
