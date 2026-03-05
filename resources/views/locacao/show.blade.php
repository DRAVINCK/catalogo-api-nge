<x-layout titulo="exibir livro">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('locacoes.index')}}">Sair</a>
    </div>
    <div class="container flex-control w-50">
        <h1>Exibir Usuário</h1>
        <div class="bg-white border p-4 roundedr">
            <b>Usuario: </b>
            <p>{{ $locacao->Usuario->nome }}</p>
            <b>livro: </b>
            <p>{{ $locacao->livro->titulo }}</p>
            <b>Data_emprestimo:</b>
            <p>{{ $locacao->data_emissao }}</p>
            <b>Data_devolucao</b>
            <p>{{ $locacao->data_vencimento }}</p>
            <div class="d-flex justify-content-end">
                <form action="{{route('locacoes.destroy', $locacao->id )}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-success mt-1" type="submit" >Registrar Devolução</button>
                </form>
                <a class="btn btn-sm btn-warning m-1" href="{{route('locacoes.edit', $locacao->id)}}">editar</a>
            </div>

        </div>
    </div>
</x-layout>

