<?php

namespace App\Livewire\Inventario;

use App\Models\Equipamento;
use App\Models\Inventario;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $modal = false;
    public $nome;
    public $temEquipamentos = false;
    #[On('dispatchOpenModalDeleteInventario')]
    public function OpenModal($id){
        $this->nome = Inventario::findOrFail($id)['nome'];
        $this->temEquipamentos = Equipamento::where('inventario_id', $id)->exists();
        $this->modal = true;
        
    }
    public function closeModal(){
        $this->modal = false;
    }
    public function render()
    {
        return view('livewire.inventario.delete');
    }
}
