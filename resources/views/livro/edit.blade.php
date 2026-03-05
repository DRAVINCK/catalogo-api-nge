<x-layout titulo="Editar Livro">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('livros.index')}}">Sair</a>
    </div>
    <div class="container flex-control w-50">
        <h1>Editar Livro</h1>
        <div class="border p-4 rounded">
            <form class="form mt-1" action="{{route('livros.update', $livro->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <strong >ISBN:</strong>
                    <input value="{{ $livro->ISBN }}"
                           placeholder="Digite o ISBN"
                           autocomplete="off"
                           type="text"
                           name="ISBN"
                           class="form-control mt-1 mb-2">

                    <strong >Titulo:</strong>
                    <input value="{{ $livro->titulo }}"
                           placeholder="Digite o Titulo"
                           autocomplete="off"
                           type="text"
                           name="titulo"
                           class="form-control mt-1 mb-2">


                    <strong >Autor:</strong>
                    <input value="{{ $livro->autor }}"
                           placeholder="Digite o Autor"
                           autocomplete="off"
                           type="text"
                           name="autor"
                           class="form-control mt-1 mb-2">

                    <strong >Ano de publicação:</strong>
                    <input value="{{ $livro->ano_publicacao }}"
                           placeholder="Digite o Ano de Publicação"
                           autocomplete="off"
                           type="text"
                           name="ano_publicacao"
                           class="form-control mt-1 mb-2">

                    <strong >categoria:</strong>
                    <input value="{{ $livro->categoria }}"
                           placeholder="Digite a Categoria"
                           autocomplete="off"
                           type="text"
                           name="categoria"
                           class="form-control mt-1 mb-2">

                    <strong >Quantidade:</strong>
                    <input value="{{ $livro->qtd_estoque }}"
                           placeholder="Digite a Quantidade"
                           autocomplete="off"
                           type="text"
                           name="qtd_estoque"
                           class="form-control mt-1 mb-2">

                    <strong >Capa:</strong>
                    <input value="{{ $livro->url_image }}"
                           placeholder="Alterar imagem"
                           autocomplete="off"
                           type="file"
                           name="image"
                           class="form-control mt-1 mb-2">
                <input type="submit" class="btn btn-primary mt-1 mb-2" value="Atualizar">

            </form>

            <div class="align-items-center d-flex gap-2">

                <form action="{{route('livros.destroy', $livro->id )}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger mt-1 mb-2" type="submit" >Excluir</button>
                </form>

            </div>
        </div>


    </div>
</x-layout>
