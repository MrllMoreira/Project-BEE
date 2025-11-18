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
    public $user = [
        'id' => null,
        'nome' => '',
        'email' => '',
        'cpf' => '',
        'matricula' => '',
        'unidade_id' => null,
        'roles_id' => null,
        'profile_photo_url' => '',
        'unidade_nome' => '',
        'role_nome' => '',
    ];
    public $unidades = [
        ['label' => ' ',  'value' => ' ']
    ];
    public $roles_id;
    public $id;
    public $unidades_id;
    #[On('dispatchOpenModalEditUser')]
    public function OpenModal($id){
        $this->unidades = Unidade::select('nome as label', 'id as value')->get()->toArray();
     
        
        $this->user = User::select(
        'id','nome','email','cpf','matricula','unidade_id','roles_id')
        ->where('id', $id)
        ->first()
        ->toArray();

        $this->user['unidade_nome'] =  Unidade::select('nome as label', 'id as value')
            ->where('id', '=', $this->user['unidade_id'])
            ->first()['label'];
        $this->user['role_nome'] = strtoupper(Role::select('nome')
            ->where('id', '=', $this->user['roles_id'])->first()['nome']);
        $this->unidades_id = $this->user['unidade_id'];
        $this->roles_id = $this->user['roles_id'];
        
        $this->modal = true;
        
    }

   
    public function render()
    {
        return view('livewire.usuario.edit');
    }
}
