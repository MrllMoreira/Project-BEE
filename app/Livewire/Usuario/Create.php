<?php

namespace App\Livewire\Usuario;

use App\Models\Role;
use App\Models\Unidade;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $unidades;
    public $newUser = [
        'cpf' => '',
        'matricula' => '',
        'role_id' => '',
        'nome' => '',
        'unidade_id' => '',
        'email' => '',
        'password'=> '',
        'confirmPassword' => ''

    ];
    public $roles = [
        ['label' => '', 'value'=> '']
    ];
    #[On('dispatchOpenModalCreateUser')]
    public function OpenModal(){
        $this->resetValidation();
        $this->modal = true;
      
    }
    public function createUser() {

        $data = $this->validate([
            'newUser.cpf' => 'required|digits:11',
            'newUser.matricula' => 'required|string',
            'newUser.role_id' => 'required|exists:roles,id',
            'newUser.nome' => 'required|string|min:3',
            'newUser.unidade_id' => 'nullable',
            'newUser.email' => 'required|email|unique:users,email',
            'newUser.password'  => 'required|min:8',
            'newUser.confirmPassword' => 'required|same:newUser.password',
        ]);

        unset($data['newUser']['confirmPassword']);
        User::create([
            ...$data['newUser'],                   
        ]);
        $this->modal = false;
        $this->reset('newUser');
        $this->dispatch('dispatchCreateUser');
    }
    public function mount(){
        $this->unidades = Unidade::select('nome as label', 'id as value')->get()->toArray();
        $this->roles = Role::select('nome as label', 'id as value')->get()->toArray();
        
        return $this->unidades;
    }
    public function render()
    {
        
        return view('livewire.usuario.create');
    }
}
