<ul class="list-group">
    @foreach($livrosMaislocados as $livro)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $livro->titulo }}
            <span class="badge bg-primary rounded-pill">{{ $livro->total_locacoes }} locacoes</span>
        </li>
    @endforeach
</ul>
