<?php

namespace App\Livewire\Inventario;

use App\Models\Inventario;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $idUnidade;
    public $inventario = [
        'nome' => '',
        'status' =>'',
        'descricao' =>'',
    ];
    #[On('dispatchOpenModalCreateInventario')]
    public function OpenModal(){
        $this->resetValidation();
        $this->modal = true;
    }
    public function mount(){
        $this->idUnidade = request()->route('idUnidade');
    }

    public function createInventario() {
        
        $data = $this->validate([
            'inventario.nome' => 'required|string|min:3|unique:inventario,nome',
            'inventario.status' => 'required|string',
            'inventario.descricao' => 'nullable|string|max:200',
        ]);

        Inventario::create([
            ...$data['inventario'],
            'unidade_id' => $this->idUnidade,
        ]);
        $this->modal = false;
        $this->reset('inventario');
        $this->dispatch('dispatchCreatedInventario');
    }

    public function render()
    {
        return view('livewire.inventario.create');
    }
}
