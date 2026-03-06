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
        'qtd_estoque',
        'total_locacoes',
        'url_image'
    ];

    public function locacao(){
        return $this->hasMany(Locacao::class);
    }

    public function ultimaLocacao(){
        return $this->hasOne(Locacao::class)->latestOfMany(); // consulta dps https://laravel.com/docs/12.x/eloquent-relationships#has-one-of-many
    }
}
