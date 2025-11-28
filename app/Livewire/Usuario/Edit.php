<?php

namespace App\Livewire\Usuario;

use App\Models\Role;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal = false;
    public $user = [
        'id' => '',
        'nome' => '',
        'email' => '',
        'cpf' => '',
        'matricula' => '',
        'unidade_id' => '',
        'role_id' => '',
    ];
    public $unidades = [
        ['label' => ' ',  'value' => ' ']
    ];
    
    #[On('dispatchOpenModalEditUser')]
    public function OpenModal($id){
        $this->resetValidation();
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
        $data = $this->validate([
            'user.cpf' => 'required|digits:11',
            'user.matricula' => 'required|string',
            'user.role_id' => 'required|exists:roles,id',
            'user.nome' => 'required|string|min:3',
            'user.unidade_id' => 'nullable',
            'user.email' => [
                'required','email',
                Rule::unique('users', 'email')->ignore($this->user['id']),
            ],
        ]);

        User::find($this->user['id'])->update([
            ...$data['user'],
        ]);
        
        $this->modal = false;
        $this->reset('user');
        $this->dispatch('dispatchEditUser');
    }
   
    public function render()
    {
        return view('livewire.usuario.edit');
    }
}
