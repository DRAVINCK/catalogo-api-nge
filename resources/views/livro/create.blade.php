<x-layout Titulo="Criação de Livros">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('livros.index')}}">Sair</a>
    </div>
    <div class="d-flex container">
        <form class="form mt-4" action="{{route('livros.store')}}" method="post">
            @csrf
            <h1>Criar Livro</h1>
            <input placeholder="Informe um ISBN" autocomplete="off" type="text" name="ISBN" class="form-control mt-3">
            <input placeholder="Informe um Titulo" autocomplete="off"  type="text" name="titulo" class="form-control mt-3">
            <input placeholder="Informe nome do Autor" autocomplete="off" type="text" name="autor" class="form-control mt-3">
            <input placeholder="Ano de Publicação" autocomplete="off" type="text" name="ano_publicacao" class="form-control mt-3">
            <input placeholder="Informe a Categoria" autocomplete="off" type="text" name="categoria" class="form-control mt-3">
            <input placeholder="Informe Quantidade" autocomplete="off" type="text" name="qtd_estoque" class="form-control mt-3">
            <input type="submit" class="btn btn-success mt-3" value="Cadastrar">
        </form>
    </div>
</x-layout>
