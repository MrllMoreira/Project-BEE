<?php

namespace App\Livewire\Equipamento;

use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $equipamento = [
        'id' => null,
        'codigo_patrimonio' => '',
        'marca' => '',
        'categoria' => '',
        'status' => '',
        'descricao' => '',
        ];
    #[On('dispatchOpenModalCreateEquipamento')]
    public function OpenModal(){

        $this->modal = true;
    }
    public function createEquipamento(){
        dump($this->equipamento);
        $this->modal = false;
        $this->reset();
    }
    public function render()
    {
        return view('livewire.equipamento.create');
    }
}
