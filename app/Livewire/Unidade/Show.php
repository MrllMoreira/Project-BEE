<?php

namespace App\Livewire\Unidade;

use App\Models\Endereco;
use App\Models\Unidade;
use App\Models\UnidadeTipo;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $modal = false;
    public $unidade = [
    'id' => null,
    'nome' => '',
    'responsavel' => '',
    'telefone' => '',
    'email' => '',
    'celular' => '',
    'codigo_unidade' => '',
    'unidade_tipo_id' => null,
    'endereco_id' => null,
    'endereco' => null,
    'ensino' => null
];
    public $id;
    public function irParaInventario(){
        return redirect()->route('inventario', $this->unidade['id']);
        
    }
    #[On('dispatchOpenModalShowUnidade')]
    public function OpenModal($id){
        $this->unidade = Unidade::select(
            'id','nome', 'responsavel', 
            'telefone', 'email', 'celular', 
            'codigo_unidade', 'unidade_tipo_id', 'endereco_id'
            )
        ->where('id', $id)
        ->first()
        ->toArray();
        $e = Endereco::where('id', '=', $this->unidade['endereco_id'])
            ->first()->toArray();
        $this->unidade['endereco'] = sprintf(
                    '%s, %s - %s, %s/%s, CEP %s',
                    $e['rua'], $e['numero'], $e['bairro'], $e['cidade'], $e['uf'], $e['cep'],);
    
        $this->unidade['ensino'] = UnidadeTipo::select('nome')
            ->where('id', '=', $this->unidade['unidade_tipo_id'])
            ->first()['nome'];

        $this->modal = true;
    }
    public function render()
    {
        return view('livewire.unidade.show');
    }
}
