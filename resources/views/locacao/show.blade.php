<x-layout titulo="exibir livro">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('locacoes.index')}}">Sair</a>
    </div>
    <div class="d-flex flex-column border rounded m-3 w-50 p-3">
        <b>Usuario: </b>
        <p>{{ $locacao->usuario->nome }}</p>
        <b>livro: </b>
        <p>{{ $locacao->livro->titulo }}</p>
        <b>Data_emprestimo:</b>
        <p>{{ $locacao->data_emissao }}</p>
        <b>Data_devolucao</b>
        <p>{{ $locacao->data_vencimento }}</p>
        <a class="btn btn-sm btn-warning m-3" href="{{route('locacoes.edit', $locacao->id)}}">editar</a>
        <a class="btn btn-sm btn-success m-3 mt-0 pt-0" href="{{route('locacoes.destroy', $locacao->id)}}">Registrar devolução</a>

    </div>
</x-layout>

