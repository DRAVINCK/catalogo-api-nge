<x-layout titulo="Relatorio de Locacoes">
    <div class="container">
        <div class="flex-row justify-content-between align-items-center">
            <h1>Relatorio de locacoes</h1>
        </div>
        <table>
            <ul class="list-group">
                @foreach($maislocados as $livro)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Titulo: {{ $livro->titulo }} |
                    Autor: {{ $livro->autor }} |
                    Ano: {{ $livro->ano_publicacao }} |
                    <span class="badge bg-primary rounded">{{ $livro->total_locacoes }} locacoes</span>
                </li>
                @endforeach
            </ul>
        </table>
    </div>
</x-layout>
