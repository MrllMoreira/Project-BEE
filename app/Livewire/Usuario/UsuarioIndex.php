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
    public int $quantity = 5; 
    public ?string $search = ""; 
    public $escolaFilter = null;

    public function dispatchOpenCreateModal(){
        $this->dispatch('dispatchOpenModalCreateUser');
    }
    public function dispatchOpenShowModal($id){
        $this->dispatch('dispatchOpenModalShowUser', $id);
    }

 
    public function with(): array
    
   {
        $this->resetPage();

        return [
            'escolas' => Unidade::query()
                ->select('unidades.nome as label', 'unidades.id as value')
                ->get()
                ->toArray(),
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
                    return $query->where('users.nome', 'like', "%{$this->search}%");
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
