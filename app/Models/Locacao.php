<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Locacao extends Model
{
    protected $fillable = [
        'usuario_id',
        'livro_id',
        'data_emissao',
        'data_vencimento',
    ];

    protected $casts = [
        'data_emissao' => 'date',
        'data_vencimento' => 'date',
    ];

    public function usuario(){
        return $this->BelongsTo(Usuario::class);
    }

    public function livro(){
        return $this->BelongsTo(Livro::class);
    }
}
