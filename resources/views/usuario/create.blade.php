<x-layout Titulo="Criação de Usuário">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('usuarios.index')}}">Sair</a>
    </div>
    <div class="d-flex container">
        <form class="form mt-4" action="{{route('usuarios.store')}}" method="post">
            @csrf
            <h1>Criar Usuario</h1>
            <input placeholder="Informe um Nome" autocomplete="off"  type="text" name="nome" class="form-control mt-3">
            <input placeholder="Informe um Email" autocomplete="off" type="text" name="email" class="form-control mt-3">
            <input placeholder="Informe um Telefone" autocomplete="off" type="text" name="telefone" class="form-control mt-3">
            <input type="submit" class="btn btn-success mt-3" value="Cadastrar">
        </form>
    </div>
</x-layout>
