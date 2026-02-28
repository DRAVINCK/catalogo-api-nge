<x-layout Titulo="Realiza locacao">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('locacoes.index')}}">Sair</a>
    </div>
    <div class="d-flex container">
        <form class="form mt-4" action="{{route('locacoes.update', $locacao->id)}}" method="post">
            @csrf
            @method('PUT')
            <h1>Editar locação</h1>

            <label for="usuario">Usuario:</label>
            <select name="Usuario_id" id="usuario" class="form-control mt-1 mb-2">
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}"
                        {{ (old('Usuario_id') ?? $locacao->Usuario_id) == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nome }}
                    </option>
                @endforeach
            </select>

            <label for="livro">Livro:</label>
            <select name="livro_id" id="livro" class="form-control mt-1 mb-2" >
                @foreach($livros as $livro)
                    <option value="{{ $livro->id }}"
                        {{ (old('livro_id') ?? $livro->id) == $usuario->id ? 'selected' : '' }}>
                        {{ $livro->titulo }}
                    </option>
                @endforeach
            </select>



            <label for="categoria">Data de emprestimo:</label>
            <input
                type="date"
                name="data_emissao"
                id="data_emissao"
                class="form-control mt-1 mb-2"
                value="{{ old('data_emissao') ?? ($locacao->data_emissao ? $locacao->data_emissao->format('Y-m-d') : '') }}"
                autocomplete="off">

            <label for="categoria">Data de vencimento:</label>
            <input
                type="date"
                name="data_vencimento"
                id="data_vencimento"
                class="form-control mt-1 mb-2"
                value="{{ old('data_vencimento') ?? ($locacao->data_vencimento ? $locacao->data_vencimento->format('Y-m-d') : '') }}"
                autocomplete="off">

            <input type="submit" class="btn btn-primary mt-1 mb-2" value="Atualizar">
        </form>
    </div>
</x-layout>
