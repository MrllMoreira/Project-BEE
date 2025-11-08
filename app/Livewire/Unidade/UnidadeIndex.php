<?php

namespace App\Livewire\Unidade;

use Livewire\Component;
use App\Models\Unidade;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class UnidadeIndex extends Component
{
    use WithPagination;
    public int $quantity = 5; 
 
    public ?string $search = null; 
    public $ensinoFilter = null;
    public function with(): array
   {
    
    
        return [
            'headers' => [
                ['index' => 'codigo_unidade', 'label' => 'Codigo'],
                ['index' => 'nome', 'label' => 'Nome'],
                ['index' => 'responsavel', 'label' => 'Responsavel'],
                ['index' => 'telefone', 'label' => 'telefone'],
            ],
            'rows' => Unidade::query()
                ->join('unidades_tipo', 'unidades.unidade_tipo_id', '=', 'unidades_tipo.id')
                ->select('unidades.*', 'unidades_tipo.nome as tipo_nome')
                ->when($this->search, function (Builder $query) {
                    return $query->where('unidades.nome', 'like', "%{$this->search}%");
                })
                ->orderBy('unidades.nome', 'asc')
                ->when($this->ensinoFilter, function (Builder $query) {
                    return $query->where('unidades_tipo.id', $this->ensinoFilter);
                })
                ->paginate($this->quantity)
                ->withQueryString(),
        ];
    }
    
    public function render()
    {
        return view('livewire.unidade.unidade-index', $this->with());
    }
}
