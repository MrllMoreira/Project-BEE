<?php

namespace App\Livewire\Unidade;

use App\Models\Endereco;
use App\Models\Unidade;
use App\Models\UnidadeTipo;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $modal = false;
    public $unidade = [
        'nome' => '',
        'responsavel' => '',
        'telefone' => '',
        'email' => '',
        'celular' => '',
        'codigo_unidade' => '',
        'ensino_tipo' => null,
        'endereco' => null,
        'ensino' => null
    ];

    public function irParaInventario(){
        return redirect()->route('inventario', $this->unidade['id']);
        
    }
    #[On('dispatchOpenModalShowUnidade')]
    public function OpenModal($id){
        $this->unidade = Unidade::with(['endereco', 'responsavelUser:id,nome'])
        ->select(
            'id', 'nome', 'responsavel', 
            'telefone', 'email', 'celular', 
            'codigo_unidade', 'ensino_tipo as ensino', 'endereco_id'
        )
        ->where('id', $id)
        ->first()
        ->toArray();

        $this->unidade['endereco'] = sprintf(
            '%s, %s - %s, %s/%s, CEP %s',
            $this->unidade['endereco']['rua'],
            $this->unidade['endereco']['numero'],
            $this->unidade['endereco']['bairro'],
            $this->unidade['endereco']['cidade'],
            $this->unidade['endereco']['uf'],
            $this->unidade['endereco']['cep']
        );

        $this->unidade['responsavel'] = $this->unidade['responsavel_user']['nome'] ?? ' - ';

        $this->modal = true;
    }
    public function render()
    {
        return view('livewire.unidade.show');
    }
}
