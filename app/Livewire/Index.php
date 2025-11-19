<?php

namespace App\Livewire;

use App\Models\Unidade;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $nome;
    public function mount() {
        $this->nome = Unidade::findOrfail(Auth::user()->unidade_id)['nome'];
        
    }
    public function render()
    {
        return view('livewire.index');
    }
}
