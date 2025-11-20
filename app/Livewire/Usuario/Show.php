<?php

namespace App\Livewire\Usuario;

use App\Models\Role;
use App\Models\Unidade;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
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
        'unidade_nome' => '',
        'role_nome' => '',
    ];

    #[On('dispatchOpenModalShowUser')]
    public function OpenModal($id){
        $this->user = User::with(['unidade:id,nome', 'role:id,nome'])
        ->select('id', 'nome', 'email', 'cpf', 'matricula', 'unidade_id', 'role_id')
        ->where('id', $id)
        ->first()
        ->toArray();

        $this->user['unidade_nome'] = $this->user['unidade']['nome'] ?? '-';
        $this->user['role_nome'] = strtoupper($this->user['role']['nome'] ?? '-');
        $this->modal = true;
   
    }
    public function render()
    {
        return view('livewire.usuario.show');
    }
}
