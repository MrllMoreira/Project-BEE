<?php

namespace App\Livewire\Usuario;

use App\Models\Unidade;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $unidades;
    #[On('dispatchOpenModalCreateUser')]
    public function OpenModal(){
        $this->modal = true;
    }
    public function mount(){
        $this->unidades = Unidade::select('nome as label', 'id as value')->get();
        return $this->unidades;
    }
    public function render()
    {
        return view('livewire.usuario.create');
    }
}
