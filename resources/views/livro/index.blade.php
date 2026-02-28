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
                    <a class="btn btn-sm btn-primary" href="{{route('livros.show', $livro->id ) }}">Ver</a>
                    <a class="btn btn-sm btn-warning" href="{{route('livros.edit', $livro->id ) }}">Editar</a>
                    <form action="{{route('livros.destroy', $livro->id )}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-layout>
