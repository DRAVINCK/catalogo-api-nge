<x-layout Titulo="Editar locacao">
    <div class="d-flex justify-content-end m-3 ">
        <a class="btn btn-sm btn-danger" href="{{route('locacoes.index')}}">Sair</a>
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
    <div class="container flex-control w-50">
        <h1>Editar locação</h1>
        <div class="bg-white border p-4 rounded">
            <form class="form mt-1" action="{{route('locacoes.update', $locacao->id)}}" method="post">
                @csrf
                @method('PUT')
                <strong>Usuario:</strong>
                <select name="Usuario_id" id="usuario" class="form-control mt-1 mb-2">
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}"
                            {{ (old('Usuario_id') ?? $locacao->Usuario_id) == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nome }}
                        </option>
                    @endforeach
                </select>

                <strong>Livro:</strong>
                <select name="livro_id" id="livro" class="form-control mt-1 mb-2" >
                    @foreach($livros as $livro)
                        <option value="{{ $livro->id }}"
                            {{ (old('livro_id') ?? $livro->id) == $usuario->id ? 'selected' : '' }}>
                            {{ $livro->titulo }}
                        </option>
                    @endforeach
                </select>



                <strong>Data de emprestimo:</strong>
                <input
                    type="date"
                    name="data_emissao"
                    id="data_emissao"
                    class="form-control mt-1 mb-2"
                    value="{{ old('data_emissao') ?? ($locacao->data_emissao ? $locacao->data_emissao->format('Y-m-d') : '') }}"
                    autocomplete="off">

                <strong>Data de vencimento:</strong>
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
    </div>
</x-layout>
