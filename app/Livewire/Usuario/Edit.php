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
        'role_id' => null,
        'profile_photo_url' => '',
    ];
    public $unidades = [
        ['label' => ' ',  'value' => ' ']
    ];
    
    #[On('dispatchOpenModalEditUser')]
    public function OpenModal($id){
        
        $this->user = User::select('id', 'nome', 'email', 'cpf', 'matricula', 'unidade_id', 'role_id')
        ->findOrFail($id)
        ->toArray();
        $this->modal = true;   
    }
    public function mount() {
        $this->unidades = Unidade::select('nome as label', 'id as value')->get()->toArray();
        return $this->unidades;
    }

    public function editUsuario() {
        dump($this->user);
    }
   
    public function render()
    {
        return view('livewire.usuario.edit');
    }
}
