<x-layout Titulo="Realiza locacao">
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
        <div class="bg-white border p-4 rounded">
            <h1>Realizar locação</h1>
            <form class="form mt-4" action="{{route('locacoes.store')}}" method="post">

                @csrf
                <label for="usuario">Usuario:</label>
                <select name="usuario_id" id="usuario" class="form-control mt-1 mb-2" >
                    <option value="">Selecione</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nome }}
                        </option>
                    @endforeach
                </select>

                <label for="livro">Livro:</label>
                <select name="livro_id" id="livro" class="form-control mt-1 mb-2" >
                    <option value="">Selecione</option>
                    @foreach($livros as $livro)
                        <option value="{{ $livro->id }}" {{ old('livro_id') == $livro->id ? 'selected' : '' }}>
                            {{ $livro->titulo }}
                        </option>
                    @endforeach
                </select>



                <label for="categoria">Data de emprestimo:</label>
                <input placeholder="Informe uma data" autocomplete="off" type="date" name="data_emissao" class="form-control mt-1 mb-2">

                <label for="categoria">Data de vencimento:</label>
                <input placeholder="Informe uma data" autocomplete="off" type="date" name="data_vencimento" class="form-control mt-1 mb-2">

                <input type="submit" class="btn btn-success mt-3" value="Cadastrar">
            </form>
        </div>

    </div>
</x-layout>
