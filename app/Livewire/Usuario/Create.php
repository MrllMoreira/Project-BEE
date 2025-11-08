<?php

namespace App\Livewire\Usuario;

use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    #[On('dispatchOpenModalCreateUser')]
    public function OpenModal(){
        $this->modal = true;
    }
    public function render()
    {
        return view('livewire.usuario.create');
    }
}
