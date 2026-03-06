<?php

namespace Tests\Feature;

use App\Models\Livro;
use App\Models\Locacao;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocacoesTest extends TestCase
{
    use RefreshDatabase;

    public function test_acessa_rota_relatorio(): void
    {
        $response = $this->get('/locacoes');

        $response->assertStatus(200);
    }

    public function test_cria_e_retorna_na_index(): void
    {
        $livro = Livro::create([
            'ISBN' => 1234567890,
            'titulo' => 'Livro de Teste',
            'autor' => 'Autor de Teste',
            'ano_publicacao' => 2024,
            'categoria' => 'Ficção',
            'qtd_estoque' => 10,
            'url_image' => 'livro-teste.jpg',
        ]);

        $usuario = Usuario::create([
            'nome' => 'Usuario de Teste',
            'email' => 'test@test.com.br',
            'telefone' => '41999999999',
        ]);

        $locacao = Locacao::create([
            'livro_id' => $livro->id,
            'usuario_id' => $usuario->id,
            'data_emissao' => now(),
            'data_vencimento' => now()->addDays(7),
        ]);

        $livro->refresh();

        $response = $this->get('/locacoes');

        $this->assertEquals(9, $livro->qtd_estoque);
        $this->assertEquals(1, $livro->total_locacoes);

        $response->assertStatus(200);

        $response->assertViewHas('locacoes', function ($locacoes) use ($locacao) {
            return $locacoes->contains($locacao);
        });
    }

    public function test_update_locacao(): void
    {
        $livro = Livro::create([
            'ISBN' => 1234567890,
            'titulo' => 'Livro de Teste',
            'autor' => 'Autor de Teste',
            'ano_publicacao' => 2024,
            'categoria' => 'Ficção',
            'qtd_estoque' => 10,
            'url_image' => 'livro-teste.jpg',
        ]);

        $usuario = Usuario::create([
            'nome' => 'Usuario de Teste',
            'email' => 'test@test.com.br',
            'telefone' => '41999999999',
        ]);

        $dataVencimentoOriginal = now()->addDays(7);
        $dataVencimentoNova = now()->addDays(14);

        $locacao = Locacao::create([
            'livro_id' => $livro->id,
            'usuario_id' => $usuario->id,
            'data_emissao' => now(),
            'data_vencimento' => $dataVencimentoOriginal,
        ]);

        $locacao->update([
            'data_vencimento' => $dataVencimentoNova,
        ]);

        $locacao->refresh();

        $response = $this->get('/locacoes/' . $locacao->id);

        $response->assertStatus(200);

        $response->assertViewHas('locacao', function ($viewLocacao) use ($dataVencimentoNova, $locacao)
        {
            return $viewLocacao->id === $locacao->id &&
                $viewLocacao->data_vencimento->toDateString() === $dataVencimentoNova->toDateString();
        });

    }

    public function test_delete_locacao(): void
    {
        $livro = Livro::create([
            'ISBN' => 1234567890,
            'titulo' => 'Livro de Teste',
            'autor' => 'Autor de Teste',
            'ano_publicacao' => 2024,
            'categoria' => 'Ficção',
            'qtd_estoque' => 10,
            'url_image' => 'livro-teste.jpg',
        ]);

        $usuario = Usuario::create([
            'nome' => 'Usuario de Teste',
            'email' => 'test@test.com.br',
            'telefone' => '41999999999',
        ]);

        $locacao = Locacao::create([
            'livro_id' => $livro->id,
            'usuario_id' => $usuario->id,
            'data_emissao' => now(),
            'data_vencimento' => now()->addDays(7),
        ]);

        $response = $this->delete('/locacoes/' . $locacao->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('locacaos', [
            'id' => $locacao->id,
        ]);

        $this->assertCount(0, Locacao::all());
    }


}
