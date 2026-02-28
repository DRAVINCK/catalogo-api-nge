<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
        '_token',
        'ISBN',
        'titulo',
        'autor',
        'ano_publicacao',
        'categoria',
        'qtd_estoque'
    ];

    public function locacao(){
        return $this->belongsTo('App\Models\Locacao');
    }
}
