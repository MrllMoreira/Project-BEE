<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $modal = false;
    public $nome;
    #[On('dispatchOpenModalDeleteUser')]
    public function OpenModal($id){
        $this->nome = User::findOrFail($id)['nome'];
        $this->modal = true;
        
    }
    
    public function closeModal(){
        
        $this->modal = false;
        
    }

    public function render()
    {
        return view('livewire.usuario.delete');
    }
}
