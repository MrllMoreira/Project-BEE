<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $modal = false;
    public $user;
    #[On('dispatchOpenModalShowUser')]
    public function OpenModal($id){
        $this->user = User::find($id)->toArray();
        $this->modal = true;
    }
    public function render()
    {
        return view('livewire.usuario.show');
    }
}
