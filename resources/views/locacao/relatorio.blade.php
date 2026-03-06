<x-layout titulo="Relatorio de locacoes">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-warning" href="{{route('locacoes.index')}}">voltar</a>
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
    <div class="container">
        <div class="flex-row">
            <h1>Relatorio de locações
                <a class="btn btn-sm btn-danger" href="{{route('locacoes.generatePdf')}}">PDF</a></h1>
        </div>
        <table>
            <ul class="list-group">
                @foreach($maislocados as $livro)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $livro->titulo }}
                        <span class="badge bg-primary rounded"> Quantidade locado: {{ $livro->total_locacoes }} </span>
                    </li>
                @endforeach
            </ul>
        </table>
    </div>

</x-layout>
