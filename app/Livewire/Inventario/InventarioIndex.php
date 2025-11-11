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

    public function dispatchOpenModal(){
        $this->dispatch('dispatchOpenModalCreateInventario');
    }
 
    public function with(): array
   {
    
        return [
            'headers' => [
                ['index' => 'nome', 'label' => 'Nome'],
                ['index' => 'status', 'label' => 'Status'],
            ],
            'rows' => Inventario::query()
                ->join('inventario_status', 'inventario.status', '=', 'inventario_status.id')
                ->select('inventario.nome', 'inventario_status.nome as status')
                ->when(Auth::user()->unidade_id, function (Builder $query){
                    return $query->where('inventario.unidade_id', '=', Auth::user()->unidade_id);
                })
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
