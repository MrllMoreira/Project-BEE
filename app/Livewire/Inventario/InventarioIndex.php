<?php

namespace App\Livewire\Inventario;

use App\Models\Inventario;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InventarioIndex extends Component
{
    use WithPagination;
    public $quantity = 10; 
    public $search = null; 
    public $statusFilter = null;
    public $idUnidade;

    public function dispatchOpenCreateModal(){
        $this->dispatch('dispatchOpenModalCreateInventario');
    }
     public function dispatchOpenShowInfos($id){
        redirect()->route('equipamento', ['idUnidade' =>$this->idUnidade, 'id'=> $id]);
    }
    public function dispatchOpenEditModal($id){
        $this->dispatch('dispatchOpenModalEditInventario', $id);
    }
    
    public function mount($id)
    {
        if (Auth::user()->roles_id != 1 && $id != Auth::user()->unidade_id) {
            abort(403, 'Não autorizado.');
        }
        $this->idUnidade = $id;
    }
    public function with(): array
   {
    
        return [
            'headers' => [
                ['index' => 'nome', 'label' => 'Nome'],
                ['index' => 'status', 'label' => 'Status', 'responsive' => true],
                ['index' => 'actions', 'label' => 'Ações'],
            ],
            'rows' => Inventario::query()
                ->join('inventario_status', 'inventario.status', '=', 'inventario_status.id')
                ->select('inventario.nome', 'inventario_status.nome as status', 'inventario.id')
                ->where('inventario.unidade_id', '=', $this->idUnidade)
                ->when($this->search, function (Builder $query) {
                    return $query->where('inventario.nome', 'like', "%{$this->search}%");
                })
                ->when($this->statusFilter, function (Builder $query) {
                    return $query->where('inventario_status.id', $this->statusFilter);
                })
                ->orderBy('inventario.nome', 'asc')
                ->paginate($this->quantity)
                ->withQueryString(),
        ];
    }
    public function render()
    {        
        return view('livewire.inventario.inventario-index', $this->with());
    }
}
