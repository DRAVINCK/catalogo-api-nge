<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class locacao extends Model
{
    protected $fillable = [
        '_token',
        'Usuario_id',
        'livro_id',
        'data_emissao',
        'data_vencimento',
    ];

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario');
    }

    public function livro(){
        return $this->belongsTo('App\Models\Livro');
    }
}
