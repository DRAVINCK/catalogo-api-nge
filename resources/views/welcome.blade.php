<x-layout titulo="Inicio">
    <div class="container text-center mt-5">
        <h1 class="display-4">Biblioteca</h1>
        <div class="d-flex flex-column align-items-center gap-3">
            <a href="{{ route('livros.index') }}" class="btn btn-primary btn-lg mt-3">Ver Livros</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary btn-lg mt-3">Ver usuarios</a>
            <a href="{{ route('locacoes.index') }}" class="btn btn-primary btn-lg mt-3">Ver locaçoes</a>
        </div>

    </div>
</x-layout>
