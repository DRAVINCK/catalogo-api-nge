<?php

namespace  App\Observer;

use App\Models\Livro;
use Illuminate\Support\Facades\Cache;

class LivroObserver{

    private function clearCache(){
        Cache::forget('livros');
    }

    public function created(Livro $livro){
        $this->clearCache();
    }

    public function updated(Livro $livro){
        $this->clearCache();
    }

    public function deleted(Livro $livro){
        $this->clearCache();
    }

}
