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
        "id" => 0,
        "marca" => '',
        "status" => '',
        "categoria" => '',
        'inventario_id' => '',
    ];
    public $inventario_id;
    public $unidade_id;


    #[On('dispatchOpenModalEditEquipamento')]
    public function OpenModal($id){
        $this->unidade_id = request()->route('idUnidade');
        $this->inventario_id = request()->route('id');
        $this->equipamento = Equipamento::query()
                ->join('inventario', 'inventario.id', '=', 'inventario_id')
                ->join('categoria_equipamentos', 'categoria_id', '=', 'categoria_equipamentos.id')
                ->join('marcas_equipamentos', 'marca_id', '=', 'marcas_equipamentos.id')
                ->join('equipamentos_status', 'status_id', '=', 'equipamentos_status.id')
                
                ->where('equipamentos.id', '=', $id)
                
                ->select('inventario_id', 'codigo_patrimonio', 'equipamentos.id', 'marcas_equipamentos.nome as marca', 'equipamentos_status.nome as status', 'categoria_equipamentos.nome as categoria', 'equipamentos.updated_at as atualizadoEm' )->first();

        

        $this->modal = true;
    }
 
    public function with() {        
        

        return [
            'unidades' => Unidade::select('nome as label', 'id as value')
            ->get(),
            'inventarios' => Inventario::select('nome as label', 'id as value')
            ->where('id', '=', $this->unidade_id)
            ->get()
        ];
    }
    public function render()
    {
        return view('livewire.equipamento.edit', $this->with());
    }
}
