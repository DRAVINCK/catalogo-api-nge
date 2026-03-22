<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone'
    ];

    public function locacao(){
        return $this->hasMany('App\Models\Locacao');
    }

}
