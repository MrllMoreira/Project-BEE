<?php

namespace App\Livewire\Inventario;

use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $inventario = [
        'nome' => '',
        'status' =>'',
        'descricao' =>'',
    ];
    #[On('dispatchOpenModalCreateInventario')]
    public function OpenModal(){
        $this->modal = true;
    }

     public function createInventario() {
        dump($this->inventario);
    }

    public function render()
    {
        return view('livewire.inventario.create');
    }
}
