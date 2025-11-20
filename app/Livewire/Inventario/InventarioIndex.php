<?php

namespace App\Livewire\Inventario;

use App\Models\Inventario;
use App\Models\Unidade;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InventarioIndex extends Component
{
    use WithPagination;
    public $quantity = 5; 
    public $search = null; 
    public $statusFilter = null;
    public $idUnidade;
    public $nome;

    public function dispatchOpenCreateModal(){
        $this->dispatch('dispatchOpenModalCreateInventario');
    }
     public function dispatchOpenShowInfos($id){
        redirect()->route('equipamento', ['idUnidade' =>$this->idUnidade, 'idInventario'=> $id]);
    }
    public function dispatchOpenEditModal($id){
        $this->dispatch('dispatchOpenModalEditInventario', $id);
    }
    public function dispatchOpenDeleteModal($id){
        $this->dispatch('dispatchOpenModalDeleteInventario', $id);
    }
    
    

    public function mount($idUnidade)
    {
        
        $this->idUnidade = $idUnidade;
        $this->nome = Unidade::findOrfail($idUnidade)['nome'];
        
    }
    
    public function with(): array
   {
    
        return [
            'headers' => [
                ['index' => 'nome', 'label' => 'Nome'],
                ['index' => 'status', 'label' => 'Status'],
                ['index' => 'descricao', 'label' => 'Descricao', 'responsive' => true],
                ['index' => 'actions', 'label' => 'Ações'],
            ],
            'rows' => Inventario::query()
                ->where('unidade_id', $this->idUnidade)
                ->when($this->search, function (Builder $query) {
                    return $query->whereRaw('LOWER(inventario.nome)', 'like', "%{$this->search}%");
                })
                ->when($this->statusFilter, function (Builder $query) {
                    return $query->where('status', $this->statusFilter);
                })
                ->orderBy('nome')
                ->paginate($this->quantity)
                ->withQueryString(),
        ];
    }
    public function render()
    {        
        return view('livewire.inventario.inventario-index', $this->with());
    }

    public function updatedSearch(){$this->resetPage();}

    public function updatedStatusFilter(){$this->resetPage();}

    public function updatedQuantity(){$this->resetPage();}
}
