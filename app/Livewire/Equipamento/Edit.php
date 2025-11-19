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
        
        $this->equipamento = Equipamento::query()
                ->join('inventario', 'inventario.id', '=', 'inventario_id')
                ->join('categoria_equipamentos', 'categoria_id', '=', 'categoria_equipamentos.id')
                ->join('marcas_equipamentos', 'marca_id', '=', 'marcas_equipamentos.id')
                ->join('equipamentos_status', 'status_id', '=', 'equipamentos_status.id')
                
                ->where('equipamentos.id', '=', $id)
                
                ->select('inventario_id', 'equipamentos.descricao', 'codigo_patrimonio', 'marcas_equipamentos.nome as marca', 'equipamentos_status.nome as status', 'categoria_equipamentos.nome as categoria' )->first()->toArray();

        
        
        $this->modal = true;
    }
 
    public function mount() {
        $this->inventarios = Inventario::select('nome as label', 'id as value')
            ->where('unidade_id', '=', request()->route('idUnidade'))
            ->get()->toArray();
        return $this->inventarios;
        
    }
    public function editEquipamento() {
        dump($this->equipamento);
    }
    public function render()
    {
        return view('livewire.equipamento.edit');
    }
}
