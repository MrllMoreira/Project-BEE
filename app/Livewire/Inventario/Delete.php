<?php

namespace App\Livewire\Inventario;

use App\Models\Equipamento;
use App\Models\Inventario;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $modal = false;
    public $inventario= [
        'id' => '',
        'nome' => '',
    ];
    public $temEquipamentos = false;
    #[On('dispatchOpenModalDeleteInventario')]
    public function OpenModal($id){
        $this->inventario = Inventario::findOrFail($id);
        $this->temEquipamentos = Equipamento::where('inventario_id', $id)->exists();
        $this->modal = true;
        
    }
    public function closeModal(){
        $this->modal = false;
    }
    public function delete(){
        Inventario::findOrFail($this->inventario['id'])->delete();
        $this->modal = false; 
        $this->reset(); 
        $this->dispatch('dispatchDeletedInventario');
    }
    public function render()
    {
        return view('livewire.inventario.delete');
    }
}
