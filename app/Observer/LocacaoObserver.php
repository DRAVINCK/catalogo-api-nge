<?php

namespace  App\Observer;

use App\Models\Livro;
use App\Models\Locacao;
use App\Models\Usuario;
use Illuminate\Support\Facades\Cache;

class LocacaoObserver{
    private function clearCache(){
        Cache::forget('locacoes');
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
