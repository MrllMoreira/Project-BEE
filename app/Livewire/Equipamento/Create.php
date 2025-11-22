<?php

namespace App\Livewire\Equipamento;

use App\Models\Equipamento;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $idInventario;
    public $equipamento = [
        'codigo_patrimonio' => '',
        'marca' => '',
        'categoria' => '',
        'status' => '',
        'descricao' => '',
        'nome' => '',
        ];

    #[On('dispatchOpenModalCreateEquipamento')]
    public function OpenModal(){
        $this->resetValidation();
        $this->modal = true;
    }

    public function mount(){
        $this->idInventario = request()->route('idInventario');
    }
    public function createEquipamento(){
        
        $data = $this->validate([
            'equipamento.codigo_patrimonio' => 'nullable|string|unique:equipamentos,codigo_patrimonio',
            'equipamento.nome' => 'required|string|min:2',
            'equipamento.marca' => 'required|string|min:2',
            'equipamento.categoria' => 'required|string|min:2',
            'equipamento.status' => 'required|string|min:2',
            'equipamento.descricao' => 'nullable|string',
        ]);

        Equipamento::create([
            ...$data['equipamento'],
            'inventario_id' => $this->idInventario
        ]);


        $this->modal = false;
        $this->reset('equipamento');
        $this->dispatch('dispatchCreatedEquipamento');
    }
    public function render()
    {
        return view('livewire.equipamento.create');
    }
}
