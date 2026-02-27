<x-layout titulo="Pagina principal Livros">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-primary" href="{{route('livros.create')}}">Cadastrar</a>
    </div>
    <div class="container">
        <h1>listar Livros</h1>
        <ul>
            @foreach($livros as $livro)
                <li class="border p-2 rounded m-1">
                    Titulo: {{$livro->titulo}} | Categoria: {{$livro->categoria}} | Quantidade: {{$livro->qtd_estoque}}
                </li>
            @endforeach
        </ul>
    </div>
</x-layout>
