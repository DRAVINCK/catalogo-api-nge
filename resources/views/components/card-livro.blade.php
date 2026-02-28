@props(['livro'])

<div class="card h-100 shadow-sm">
    {{-- Imagem do Livro --}}
    <img src="{{ $livro->imagem_url ?? 'https://via.placeholder.com/150x200?text=Sem+Capa' }}"
         class="card-img-top"
         alt="{{ $livro->titulo }}"
         style="height: 250px; object-fit: cover;">

    <div class="card-body border d-flex flex-column">
        <div class="mb-2">
            <span class="badge bg-info text-dark">{{ $livro->categoria }}</span>
            <small class="text-muted d-block mt-1">ISBN: {{ $livro->ISBN }}</small>
        </div>

        <h5 class="card-title text-truncate" title="{{ $livro->titulo }}">
            {{ $livro->titulo }}
        </h5>

        <p class="card-text mb-1"><strong>Autor:</strong> {{ $livro->autor }}</p>
        <p class="card-text"><small class="text-muted">Publicado em: {{ $livro->ano_publicacao }}</small></p>

        <div class="mt-auto d-flex gap-2">
            <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-sm btn-outline-primary w-100">Ver</a>
            <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-sm btn-warning w-100">Editar</a>
        </div>
    </div>
</div>
