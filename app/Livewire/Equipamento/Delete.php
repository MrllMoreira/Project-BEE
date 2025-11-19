<?php

namespace App\Livewire\Equipamento;

use App\Models\Equipamento;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $modal = false;
    public $nome;
    #[On('dispatchOpenModalDeleteEquipamento')]
    public function OpenModal($id){
        $this->nome = Equipamento::findOrFail($id)['nome'];
        $this->modal = true;
        
    }
    public function closeModal(){
        $this->modal = false;
    }
    public function render()
    {
        return view('livewire.equipamento.delete');
    }
}
