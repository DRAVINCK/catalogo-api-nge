<?php

namespace  App\Observer;

use App\Models\Livro;
use App\Models\Usuario;
use Illuminate\Support\Facades\Cache;

class UsuarioObserver{
    private function clearCache(){
        Cache::forget('usuarios');
    }

    public function created(Usuario $usuario){
        $this->clearCache();
    }

    public function updated(Usuario $usuario){
        $this->clearCache();
    }

    public function deleted(Usuario $usuario){
        $this->clearCache();
    }

}
