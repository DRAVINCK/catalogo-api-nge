<x-layout titulo="Pagina principal Locacoes">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-primary" href="{{route('locacoes.create')}}">Locar</a>
    </div>
    <div class="container">
        <h1>listar Locacoes</h1>
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>livro</th>
                <th>data_emprestimo</th>
                <th>data_devolucao</th>
            </tr>
            </thead>
            @foreach($locacoes as $locacao)
                <tr>
                    <td>{{$locacao->id}}</td>
                    <td>{{$locacao->usuario->nome}}</td>
                    <td>{{$locacao->livro->titulo}}</td>
                    <td>{{$locacao->data_emissao}}</td>
                    <td>{{$locacao->data_vencimento}}</td>
                <tr>
            @endforeach
        </table>
    </div>
</x-layout>
