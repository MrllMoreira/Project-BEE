<?php

namespace App\Livewire\Usuario;

use App\Models\Unidade;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class UsuarioIndex extends Component
{
    use WithPagination;
    public $quantity = 5; 
    public ?string $search = ""; 
    public $escolaFilter = null;
    public $escolas;

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
        $this->escolas  = Unidade::query()
                ->select('unidades.nome as label', 'unidades.id as value')
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
                ->join('unidades', 'users.unidade_id', '=', 'unidades.id')
                ->select('users.*', 'unidades.nome as unidades_nome')
                ->when($this->search, function (Builder $query) {
                     $search = strtolower($this->search);
                    return $query->whereRaw('LOWER(users.nome) LIKE ?', ["%{$search}%"]);
                })
                ->orderBy('users.nome', 'asc')
                ->when($this->escolaFilter, function (Builder $query) {
                    return $query->where('unidades.id', $this->escolaFilter);
                })
                ->paginate($this->quantity)
                ->withQueryString(),
            
        ];
    }
    
    public function render()
    {
        return view('livewire.usuario.usuario-index', $this->with());
    }
}
