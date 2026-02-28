<x-layout titulo="Pagina principal Livros">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-primary" href="{{route('livros.create')}}">Cadastrar</a>
    </div>
    <div class="container">
        <h1>listar Livros</h1>
        <form action="{{ route('livros.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Pesquisar..." class="border p-2 rounded">
            <select name="filtro" class="border p-2 rounded">
                <option value="titulo" {{ request('filtro') == 'titulo' ? 'selected' : '' }}>Título</option>
                <option value="autor" {{ request('filtro') == 'autor' ? 'selected' : '' }}>Autor</option>
                <option value="categoria" {{ request('filtro') == 'categoria' ? 'selected' : '' }}>Categoria</option>
            </select>

            <button type="submit" class="btn btn-sm btn-warning px-4 py-2 rounded">
                Buscar
            </button>
        </form>
        <ul>
            @foreach($livros as $livro)
                <li class="border p-2 rounded m-1">
                    Titulo: {{$livro->titulo}} | Categoria: {{$livro->categoria}} | Autor: {{$livro->autor}}
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
