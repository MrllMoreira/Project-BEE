<?php

namespace App\Livewire\Equipamentos;

use App\Models\Equipamento;
use App\Models\Inventario;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EquipamentosIndex extends Component
{
    use WithPagination;
    public $quantity = 10; 
    public $search = null; 
    public $statusFilter = null;

    public $id;
    public $idUnidade;

    public function mount($idUnidade,$id)
    {
        $this->id = $id;
        $this->idUnidade = $idUnidade;
    }
    
    public function voltarInventarios() {
        redirect()->route('inventario', $this->idUnidade);
    }
     public function dispatchOpenShowInfos($id){
        $this->dispatch('dispatchOpenModalShowEquipamentos', $id);
    }
 
    public function with(): array
   {
    
        return [
            'headers' => [
                ['index' => 'id', 'label' => 'Id'],
                ['index' => 'codigo_patrimonio', 'label' => 'Codigo'],
                ['index' => 'categoria', 'label' => 'Categoria'],
                ['index' => 'marca', 'label' => 'marca', 'responsive' => true],
                ['index' => 'status', 'label' => 'Status'],
                ['index' => 'atualizadoEm', 'label' => 'Atualizado em', 'responsive' => true],
                ['index' => 'actions', 'label' => 'Ações'],
            ],
            'rows' => Equipamento::query()
                ->join('inventario', 'inventario.id', '=', 'inventario_id')
                ->join('categoria_equipamentos', 'categoria_id', '=', 'categoria_equipamentos.id')
                ->join('marcas_equipamentos', 'marca_id', '=', 'marcas_equipamentos.id')
                ->join('equipamentos_status', 'status_id', '=', 'equipamentos_status.id')
                
                ->where('inventario_id', '=', $this->id)
                ->when(Auth::user()->role != 1, function ($q) {
                    $q->where('inventario.unidade_id', Auth::user()->unidade_id);
                })
                ->when($this->search, function (Builder $query) {
                    $search = "%{$this->search}%";

                    return $query->where(function ($q) use ($search) {
                        $q->where('equipamentos.codigo_patrimonio', 'like', $search)
                        ->orWhere('categoria_equipamentos.nome', 'like', $search)
                        ->orWhere('equipamentos_status.nome', 'like', $search);
                    });
                })
                ->orderBy('equipamentos.id', 'asc')
                ->select('codigo_patrimonio', 'equipamentos.id', 'marcas_equipamentos.nome as marca', 'equipamentos_status.nome as status', 'categoria_equipamentos.nome as categoria', 'equipamentos.updated_at as atualizadoEm' )
                ->paginate($this->quantity)
                ->withQueryString(),
        ];
    }
    public function render()
    {
        return view('livewire.equipamentos.equipamentos-index', $this->with());
    }
}
