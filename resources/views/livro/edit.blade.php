<x-layout titulo="Editar Livro">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('livros.index')}}">Sair</a>
    </div>
    <div class="d-flex container">
        <form class="form mt-4" action="{{route('livros.update', $livro->id)}}" method="post">
            @csrf
            @method('PUT')
            <h1>Editar Livro</h1>
            <div class="border p-4 rounded">
                <label for="usuario">ISBN:</label>
                <input value="{{ $livro->ISBN }}"
                       placeholder="Digite o ISBN"
                       autocomplete="off"
                       type="text"
                       name="ISBN"
                       class="form-control mt-1 mb-2">

                <label for="usuario">Titulo:</label>
                <input value="{{ $livro->titulo }}"
                       placeholder="Digite o Titulo"
                       autocomplete="off"
                       type="text"
                       name="titulo"
                       class="form-control mt-1 mb-2">


                <label for="usuario">Autor:</label>
                <input value="{{ $livro->autor }}"
                       placeholder="Digite o Autor"
                       autocomplete="off"
                       type="text"
                       name="autor"
                       class="form-control mt-1 mb-2">

                <label for="usuario">Ano de publicação:</label>
                <input value="{{ $livro->ano_publicacao }}"
                       placeholder="Digite o Ano de Publicação"
                       autocomplete="off"
                       type="text"
                       name="ano_publicacao"
                       class="form-control mt-1 mb-2">

                <label for="usuario">categoria:</label>
                <input value="{{ $livro->categoria }}"
                       placeholder="Digite a Categoria"
                       autocomplete="off"
                       type="text"
                       name="categoria"
                       class="form-control mt-1 mb-2">

                <label for="usuario">Quantidade:</label>
                <input value="{{ $livro->qtd_estoque }}"
                       placeholder="Digite a Quantidade"
                       autocomplete="off"
                       type="text"
                       name="qtd_estoque"
                       class="form-control mt-1 mb-2">

                <input type="submit" class="btn btn-primary mt-1 mb-2" value="Atualizar">
                <form action="{{route('livros.destroy', $livro->id )}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger mt-1 mb-2" type="submit" >Excluir</button>
                </form>
            </div>

        </form>
    </div>
</x-layout>
