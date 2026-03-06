<?php

namespace  App\Observer;

use App\Models\Livro;
use App\Models\Locacao;
use App\Models\Usuario;
use Illuminate\Support\Facades\Cache;

class LocacaoObserver{
    private function clearCache(){
        Cache::forget('locacoes');

        Cache::forget('livros');
        Cache::forget('total_locacoes');
        Cache::forget('relatorio:mais_locados');
    }

    public function created(Locacao $locacao){
        $this->clearCache();
    }

    public function updated(Locacao $locaocao){
        $this->clearCache();
    }

    public function deleted(Locacao $locaocao){
        $this->clearCache();
    }

}
