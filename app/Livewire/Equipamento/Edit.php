<?php

namespace App\Livewire\Equipamento;

use App\Models\Equipamento;
use App\Models\Inventario;
use App\Models\Role;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal = false;
    public $transferirEquipamento = false;
    public $equipamento = [
        'nome'=> '',
        "codigo_patrimonio" => '',
        'descricao' => '',
        "marca" => '',
        "status" => '',
        "categoria" => '',
        'inventario_id' => '',
    ];
    public $inventarios = [
        ['label' => '', 'value' => '']
    ];

    public $unidade_id;

    #[On('dispatchOpenModalEditEquipamento')]
    public function OpenModal($id){
        $this->resetValidation();
        $this->equipamento = Equipamento::query()
                ->where('id', $id)
                ->select('inventario_id', 'equipamentos.id','equipamentos.descricao', 'codigo_patrimonio', 'marca', 'equipamentos.status as status', 'equipamentos.nome as nome', 'categoria')->first()->toArray();
        $this->modal = true;
    }
 
    public function mount() {
        $this->inventarios = Inventario::select('nome as label', 'id as value')
            ->where('unidade_id', '=', request()->route('idUnidade'))
            ->get()->toArray();
        return $this->inventarios;
        
    }
    public function editEquipamento() {
        
        $data = $this->validate([
            'equipamento.codigo_patrimonio' => 'nullable|string|unique:equipamentos,codigo_patrimonio'. $this->equipamento['id'],
            'equipamento.nome' => 'required|string|min:2',
            'equipamento.marca' => 'required|string|min:2',
            'equipamento.categoria' => 'required|string|min:2',
            'equipamento.status' => 'required|string|min:2',
            'equipamento.descricao' => 'nullable|string',
        ]);

        Equipamento::find($this->equipamento['id'])->update([
            ...$data['equipamento'],
        ]);

        $this->modal = false;
        $this->reset('equipamento');
        $this->dispatch('dispatchEditEquipamento');
    }
    public function render()
    {
        return view('livewire.equipamento.edit');
    }
}
