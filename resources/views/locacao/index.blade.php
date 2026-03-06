<x-layout titulo="Pagina principal Locacoes">
    <div class="d-flex justify-content-end m-2">
        <a class="btn btn-sm btn-warning m-1" href="/">Home</a>
        <a class="btn btn-sm btn-primary m-1" href="{{route('locacoes.create')}}">Cadastrar</a>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex-row">
            <h1>Lista de Locações
                <a class="btn btn-sm btn-primary" href="{{route('locacoes.relatorio')}}">Relatorio</a></h1>
            </h1>
        </div>
        <div class="bg-white table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-center" >Id</th>
                    <th class="text-center" >Usuario</th>
                    <th class="text-center">livro</th>
                    <th class="text-center">Data Emprestimo</th>
                    <th class="text-center">Data Devolução</th>
                    <th></th>

                </tr>
                </thead>
                @foreach($locacoes as $locacao)
                    <tr>
                        <td class="text-center">{{$locacao->id}}</td>
                        <td class="text-center">{{$locacao->usuario->nome}}</td>
                        <td class="text-center">{{$locacao->livro->titulo}}</td>
                        <td class="text-center">{{$locacao->data_emissao->format('d/m/Y')}}</td>
                        <td class="text-center">{{$locacao->data_vencimento->format('d/m/Y')}}</td>
                        <td>
                            <a href="{{ route('locacoes.show', $locacao->id) }}" >
                                <button class="btn btn-sm btn-outline-primary w-100">Ver</button>
                            </a>
                        </td>

                    <tr>
                @endforeach
            </table>
        </div>
    </div>
</x-layout>
