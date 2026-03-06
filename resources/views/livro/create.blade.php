<x-layout Titulo="Criação de Livros">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('livros.index')}}">Sair</a>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class=" container flex-control w-50">
        <div class="bg-white border p-4 rounded">
            <form class="form mt-4" action="{{route('livros.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h1>Criar Livro</h1>
                <input placeholder="Informe um ISBN" autocomplete="off" type="text" name="ISBN" maxlength="13", pattern="\d*" class="form-control mt-3">
                <input placeholder="Informe um Titulo" autocomplete="off"  type="text" name="titulo" maxlength="100" class="form-control mt-3">
                <input placeholder="Informe nome do Autor" autocomplete="off" type="text" name="autor" maxlength="100" class="form-control mt-3">
                <input placeholder="Ano de Publicação" autocomplete="off" type="text" name="ano_publicacao" min="1500" max="{{ date('Y') }}" class="form-control mt-3">
                <input placeholder="Informe a Categoria" autocomplete="off" type="text" name="categoria" maxlength="100" class="form-control mt-3">
                <input placeholder="Informe Quantidade" autocomplete="off" type="text" name="qtd_estoque" min="0" step="1" class="form-control mt-3">
                <input placeholder="carregar imagem" autocomplete="off" type="file" name="image" class="form-control mt-3">
                <input type="submit" class="btn btn-success mt-3" value="Cadastrar">
            </form>

        </div>
    </div>
</x-layout>
