<?php

namespace App\Livewire\Unidade;

use App\Models\Equipamento;
use App\Models\Inventario;
use App\Models\Unidade;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $modal = false;
    public $unidade = [
        'id' => '',
        'nome' => '',
    ];
    public $temEquipamentos = false;
    #[On('dispatchOpenModalDeleteUnidade')]
    public function OpenModal($id){
        $this->unidade = Unidade::findOrFail($id);
        $inventarios = Inventario::where('unidade_id', $id)->pluck('id');
        if(!empty($inventarios)){
            $this->temEquipamentos = Equipamento::whereIn('inventario_id', $inventarios)->exists();
        }
        $this->modal = true;
    }
    public function closeModal(){
        $this->modal = false;
    }

    public function delete(){
        Unidade::findOrFail($this->unidade['id'])->delete();
        $this->modal = false;  
        $this->reset(); 
        $this->dispatch('dispatchDeletedUnidade');
    }

    public function render()
    {
        return view('livewire.unidade.delete');
    }
}
