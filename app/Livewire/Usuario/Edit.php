<?php

namespace App\Livewire\Usuario;

use App\Models\Role;
use App\Models\Unidade;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal = false;
    public $user;
    public $unidades;
    public $roles_id;
    public $unidades_id;
    #[On('dispatchOpenModalEditUser')]
    public function OpenModal($id){
        
        $this->modal = true;
    }

    public function mount(){
        $this->user = User::find(5)->toArray();
        $this->unidades = Unidade::select('nome as label', 'id as value')->get();
        $role_name = Role::select('nome')
            ->where('id', '=', $this->user['roles_id'])->first()['nome']; 
        $label = $this->unidades->firstWhere('value', $this->user['unidade_id'])->label;
        $this->user['unidade_nome'] = $label;
        $this->roles_id = $this->user['roles_id'];
        $this->unidades_id = $this->user['unidade_id'];
        $this->user['role_nome'] = strtoupper($role_name);
    }
    public function render()
    {
        return view('livewire.usuario.edit');
    }
}
