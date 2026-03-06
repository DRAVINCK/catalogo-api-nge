<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; background-color: white; color: #333; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #444; margin-bottom: 20px; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2; text-align: left; padding: 10px; border: 1px solid #ddd; }
        td { padding: 10px; border: 1px solid #ddd; font-size: 14px; }
        .badge {
            background-color: #0d6efd;
            color: white;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
        }
        .text-center { text-align: center; }
    </style>
</head>
<body>

<div class="header">
    <h1>Relatório de Locações</h1>
    <p>Livros Mais Locados - Gerado em {{ date('d/m/Y H:i') }}</p>
</div>

<table>
    <thead>
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th class="text-center">Categoria</th>
        <th class="text-center">Total Locações</th>
        <th class="text-center">Ultima Locação</th>
    </tr>
    </thead>
    <tbody>
    @foreach($maislocados as $livro)
        <tr>
            <td>{{ $livro->titulo }}</td>
            <td>{{ $livro->autor }}</td>
            <td class="text-center">{{ $livro->categoria }}</td>
            <td class="text-center">{{ $livro->total_locacoes }}</td>
            <td class="text-center">
                @if($livro->ultimaLocacao)
                    {{ $livro->ultimaLocacao->data_emissao->format('d/m/Y') }}
                @else
                    -
                @endif
            </td>

        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
