<x-layout titulo="Pagina principal Locacoes">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-primary" href="{{route('locacoes.create')}}">Locar</a>
    </div>
    <div class="container">
        <h1>listar Locacoes</h1>
        <a class="btn btn-sm btn-primary" href="{{route('locacoes.relatorio')}}">relatorio</a>
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>livro</th>
                <th>data_emprestimo</th>
                <th>data_devolucao</th>
                <th></th>

            </tr>
            </thead>
            @foreach($locacoes as $locacao)
                <tr>
                    <td>{{$locacao->id}}</td>
                    <td>{{$locacao->usuario->nome}}</td>
                    <td>{{$locacao->livro->titulo}}</td>
                    <td>{{$locacao->data_emissao}}</td>
                    <td>{{$locacao->data_vencimento}}</td>
                    <td>
                        <a href="{{ route('locacoes.show', $locacao->id) }}" >
                            <button class="btn btn-sm btn-outline-primary w-100">Ver</button>
                        </a>
                    </td>

                <tr>
            @endforeach
        </table>
    </div>
</x-layout>
