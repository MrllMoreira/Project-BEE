<?php

namespace App\Livewire\Unidade;

use Livewire\Component;
use App\Models\Unidade;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class UnidadeIndex extends Component
{
    use WithPagination;
    public $quantity = 5; 
    public $search = null; 
    public $ensinoFilter = null;

    public function dispatchOpenCreateModal(){
        $this->dispatch('dispatchOpenModalCreateUnidade');
    }
    public function dispatchOpenShowInfos($id){
        $this->dispatch('dispatchOpenModalShowUnidade', $id);
    }

    public function dispatchOpenEditModal($id){
        $this->dispatch('dispatchOpenModalEditUnidade', $id);
    }

    public function dispatchOpenDeleteModal($id){
        $this->dispatch('dispatchOpenModalDeleteUnidade', $id);
    }

    

    public function with()
   {
        return [
            'headers' => [
                ['index' => 'codigo_unidade', 'label' => 'Codigo'],
                ['index' => 'nome', 'label' => 'Nome'],
                ['index' => 'responsavel', 'label' => 'Responsavel', 'responsive' => true],
                ['index' => 'telefone', 'label' => 'telefone', 'responsive' => true],
                ['index' => 'actions', 'label' => 'Ações'],
            ],
            'rows' => Unidade::query()
                ->when($this->search, function (Builder $query) {
                    $search = strtolower($this->search);
                    return $query->where(function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(nome) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(codigo_unidade) LIKE ?', ["%{$search}%"]);
                    });
                })
                ->when($this->ensinoFilter, function (Builder $query) {
                    return $query->where('ensino_tipo', $this->ensinoFilter);
                })
                ->orderBy('nome', 'asc') 
                ->paginate($this->quantity)
                ->withQueryString(),
        ];
    }
    
    public function render()
    {
        return view('livewire.unidade.unidade-index', $this->with());
    }

    public function updatedSearch(){$this->resetPage();}

    public function updatedEnsinoFilter(){$this->resetPage();}

    public function updatedQuantity(){$this->resetPage();}
}
