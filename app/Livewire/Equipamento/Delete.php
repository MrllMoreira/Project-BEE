<?php

namespace App\Livewire\Equipamento;

use App\Models\Equipamento;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $modal = false;
    public $equipamento= [
        'id' => '',
        'nome' => '',
    ];
    #[On('dispatchOpenModalDeleteEquipamento')]
    public function OpenModal($id){
        $this->equipamento = Equipamento::findOrFail($id);
        $this->modal = true;
    }
    public function closeModal(){
        $this->modal = false;
    }
     public function delete(){
        Equipamento::findOrFail($this->equipamento['id'])->delete();
        $this->modal = false;  
        $this->reset(); 
        $this->dispatch('dispatchDeletedEquipamento');
    }
    public function render()
    {
        return view('livewire.equipamento.delete');
    }
}
