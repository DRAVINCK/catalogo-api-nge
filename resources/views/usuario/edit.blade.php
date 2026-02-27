<x-layout titulo="Editar de cadastro">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('usuarios.index')}}">Sair</a>
    </div>
    <div class="d-flex container">
        <form class="form mt-4" action="{{route('usuarios.update', $usuario->id)}}" method="post">
            @csrf
            @method('PUT')
            <input value="{{ $usuario->name }}"
                   placeholder="Digite o Nome"
                   autocomplete="off"
                   type="text"
                   name="nome"
                   class="form-control mt-3">

            <input value="{{ $usuario->email }}"
                   placeholder="Digite o Email"
                   autocomplete="off"
                   type="text"
                   name="email"
                   class="form-control mt-3">

            <input value="{{ $usuario->telefone }}"
                   placeholder="Digite o Telefone"
                   autocomplete="off"
                   type="text"
                   name="telefone"
                   class="form-control mt-3">

            <input type="submit" class="btn btn-primary mt-3" value="Atualizar">
        </form>
    </div>
</x-layout>
