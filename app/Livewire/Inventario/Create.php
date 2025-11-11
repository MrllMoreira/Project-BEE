<?php

namespace App\Livewire\Inventario;

use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    #[On('dispatchOpenModalCreateInventario')]
    public function OpenModal(){
        $this->modal = true;
    }
    public function render()
    {
        return view('livewire.inventario.create');
    }
}
