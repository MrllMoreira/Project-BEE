<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $modal = false;
    public $user = [
        'id' => '',
        'nome' => '',
    ];
    #[On('dispatchOpenModalDeleteUser')]
    public function OpenModal($id){
        $this->user = User::findOrFail($id);
        $this->modal = true;
        
    }
    
    public function closeModal(){
        $this->modal = false;   
    }

    public function delete(){
        User::findOrFail($this->user['id'])->delete();
        $this->modal = false;  
        $this->reset(); 
        $this->dispatch('dispatchDeletedUser');
    }

    public function render()
    {
        return view('livewire.usuario.delete');
    }
}
