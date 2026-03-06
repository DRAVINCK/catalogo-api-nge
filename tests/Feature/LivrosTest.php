<?php

namespace Tests\Feature;

use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LivrosTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_acessa_rota_livros(): void
    {
        $response = $this->get('/livros');

        $response->assertStatus(200);
        $response->assertViewIs('livro.index');
    }

    public function test_livro_cria_e_retorna_na_index(): void
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

        $response = $this->get('/livros');

        $response->assertStatus(200);

        $response->assertViewHas('livros', function ($viewlivros) use ($livro) {//$viewlivro ou outro nome usa para quem eu quero validar, laravel faz solo
            return $viewlivros->contains($livro);
        });

    }

    public function test_update_livro(): void
    {
        $tituloOriginal = 'Livro de Teste';
        $tituloAtualizado = 'Livro de Teste atualizado';
        $livro = Livro::create([
            'ISBN' => '1234567890',
            'titulo' => $tituloOriginal,
            'autor' => 'Autor de Teste',
            'ano_publicacao' => 2024,
            'categoria' => 'Ficção',
            'qtd_estoque' => 10,
            'url_image' => 'livro-teste.jpg',
        ]);

        $livro->update([
            'titulo' => $tituloAtualizado,
        ]);

        $livro->refresh();

        $response = $this->get('/livros/'. $livro->id);
        $response->assertStatus(200);

        $response->assertViewHas('livro', function ($viewLivro) use ($livro, $tituloAtualizado) {
            return $viewLivro-> id === $livro->id &&
                $viewLivro->titulo === $tituloAtualizado;
         });
    }

    public function test_delete_livro(): void
    {
        $livro = Livro::create([
            'ISBN' => '1234567890',
            'titulo' => 'Livro de Teste',
            'autor' => 'Autor de Teste',
            'ano_publicacao' => 2024,
            'categoria' => 'Ficção',
            'qtd_estoque' => 10,
            'url_image' => 'livro-teste.jpg',
        ]);

        $livro->refresh();

        $response = $this->delete('/livros/' . $livro->id);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('livros', [
            'id' => $livro->id
        ]);

        $this->assertCount(0, Livro::all());

    }
}
