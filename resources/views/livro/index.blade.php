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
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-4">
            @foreach($livros as $livro)
                <div class="col">
                    <x-card-livro :livro="$livro" />
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
