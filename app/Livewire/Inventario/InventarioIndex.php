<?php

namespace App\Livewire\Inventario;

use App\Models\Inventario;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class InventarioIndex extends Component
{
    use WithPagination;
    public int $quantity = 10; 
 
    public ?string $search = null; 
    public $statusFilter = null;
 
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
