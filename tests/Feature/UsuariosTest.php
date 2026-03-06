<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuariosTest extends TestCase
{
    use refreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_acessa_rota_usuarios(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_cria_usuario_e_retorna_na_index(): void
    {
        $usuario = Usuario::create([
            'nome' => 'Usuario de Teste',
            'email' => 'test@test.com.br',
            'telefone' => '41999999999',
        ]);

        $response = $this->get('/usuarios');

        $response->assertStatus(200);

        $usuario->refresh();

        $response->assertViewHas('usuarios', function ($usuarios) use ($usuario) {
            return $usuarios->contains($usuario);
        });
    }

    public function test_update_usuario(): void
    {
        $nomeOriginal = 'Usuario de Teste';
        $nomeAtualizado = 'Usuario de teste Atualizado';

        $usuario = Usuario::create([
            'nome' => $nomeOriginal,
            'email' => 'test@test.com.br',
            'telefone' => '4199999999',
        ]);

        $usuario->update([
            'nome' => $nomeAtualizado,
        ]);

        $usuario->refresh();

        $response = $this->get('/usuarios/' . $usuario->id);

        $response->assertStatus(200);

        $response->
        assertViewHas('usuario', function ($viewUsuario) use ($usuario, $nomeAtualizado)
        {
            return $viewUsuario->id === $usuario->id &&
                $viewUsuario->nome === $nomeAtualizado;
        });

    }

    public function test_delete_usuario(): void
    {
        $usuario = Usuario::create([
            'nome' => 'Usuario de Teste',
            'email' => 'test@test.com.br',
            'telefone' => '4199999999',
        ]);

        $usuario->refresh();

        $response = $this->delete('/usuarios/' . $usuario->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('usuarios', [
            'id' => $usuario->id,
        ]);

        $this->assertCount(0, Usuario::all());
    }
}
