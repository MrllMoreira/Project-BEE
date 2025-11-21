<?php

namespace App\Livewire\Usuario;

use App\Models\Unidade;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;

class UsuarioIndex extends Component
{
    use WithPagination;
    public $quantity = 5; 
    public $search = ""; 
    public $escolaFilter;
    public $escolas = [
        ['label' => '', 'value' => '']
    ];

    #[On('dispatchDeletedUser')]
    public function resetTable(){
        $this->reset();
        $this->resetPage();
    }

    public function dispatchOpenCreateModal(){
        $this->dispatch('dispatchOpenModalCreateUser');
    }
    public function dispatchOpenShowInfos($id){
        $this->dispatch('dispatchOpenModalShowUser', $id);
    }
    public function dispatchOpenEditModal($id){
        $this->dispatch('dispatchOpenModalEditUser', $id);
    }
    public function dispatchOpenDeleteModal($id){
        $this->dispatch('dispatchOpenModalDeleteUser', $id);
    }

    public function mount(){
        $this->escolas  = Unidade::select('unidades.nome as label', 'unidades.id as value')
                ->get()
                ->toArray();
    }
    public function with(): array
    
   {
        return [
            'headers' => [
                ['index' => 'matricula', 'label' => 'Matricula'],
                ['index' => 'nome', 'label' => 'Nome'],
                ['index' => 'unidades_nome', 'label' => 'Unidade', 'responsive' => true],
                ['index' => 'email', 'label' => 'Email', 'responsive' => true],
                ['index' => 'actions', 'label' => 'Ações']
            ],
            'rows' => User::query()
                ->with(['unidade:id,nome']) 
                ->when($this->search, function (Builder $query) {
                    $search = strtolower($this->search);
                    return $query->where(function (Builder $query) use ($search) {
                        $query->whereRaw('LOWER(users.nome) LIKE ?', ["%{$search}%"])
                              ->orWhereRaw('LOWER(users.matricula) LIKE ?', ["%{$search}%"]);
                    });
                })
                ->when($this->escolaFilter, function (Builder $query) {
                    return $query->where('users.unidade_id', $this->escolaFilter);
                })
                ->orderBy('users.nome')
                ->paginate($this->quantity)
                ->withQueryString(),
            
        ];
    }
    
    
    public function render()
    {
        return view('livewire.usuario.usuario-index', $this->with());
    }

    public function updatedSearch(){ $this->resetPage();}

    public function updatedEscolaFilter(){ $this->resetPage();}

    public function updatedQuantity(){ $this->resetPage();}
}
