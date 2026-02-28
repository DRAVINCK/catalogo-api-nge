<x-layout titulo="exibir livro">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('livros.index')}}">Sair</a>
    </div>
    <div class="d-flex flex-column border rounded m-3 w-50 p-3">
        <b>Titulo: </b>
        <p>{{ $livro->titulo }}</p>
        <b>Autor: </b>
        <p>{{ $livro->autor }}</p>
        <b>Categoria:</b>
        <p>{{ $livro->categoria}}</p>
        <b>Ano publicado</b>
        <p>{{ $livro->ano_publicacao }}</p>
        <b>Quantidade estoque</b>
        <p>{{ $livro->qtd_estoque }}</p>
        <b>ISBN</b>
        <p>{{ $livro->ISBN }}</p>
    </div>
</x-layout>

