<?php

namespace App\Livewire\Unidade;

use Illuminate\Support\Facades\Http;
use App\Models\Unidade;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public $modal= false;
    public $endereco = [
        'cep' => '',
        'localidade' => '',
        'logradouro' => '',
        'bairro' => '',
        'uf' => '',
    ];
    public $cep;
    public $ufs = [
            ['name' => 'AC'], ['name' => 'AL'], ['name' => 'AP'], ['name' => 'AM'],
            ['name' => 'BA'], ['name' => 'CE'], ['name' => 'DF'], ['name' => 'ES'],
            ['name' => 'GO'], ['name' => 'MA'], ['name' => 'MT'], ['name' => 'MS'],
            ['name' => 'MG'], ['name' => 'PA'], ['name' => 'PB'], ['name' => 'PR'],
            ['name' => 'PE'], ['name' => 'PI'], ['name' => 'RJ'], ['name' => 'RN'],
            ['name' => 'RS'], ['name' => 'RO'], ['name' => 'RR'], ['name' => 'SC'],
            ['name' => 'SP'], ['name' => 'SE'], ['name' => 'TO'],
        ];
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
    #[On('dispatchOpenModalEditUnidade')]
    public function openModal($id) {
       
        $this->unidade = Unidade::join('enderecos', 'enderecos.id', '=', 'endereco_id')
        ->where('unidades.id', '=', $id)->first();
  
        $this->endereco = [
                    'localidade' => $this->unidade['localidade'] ?? '',
                    'logradouro' => $this->unidade['rua'] ?? '',
                    'bairro' => $this->unidade['bairro'] ?? '',
                    'cidade' => $this->unidade['cidade'] ?? '',
                    'uf' => $this->unidade['uf'] ?? '',
                    'numero' => $this->unidade['numero'] ?? '',
                ];
        $this->modal = true;
       
        
    }

    public function updatedCep($value)
    {
        $cepValue = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cepValue) === 8) {
            $data= Http::get("https://viacep.com.br/ws/{$cepValue}/json/")->json();
            $this->endereco = [
                    'localidade' => $data['localidade'] ?? '',
                    'logradouro' => $data['logradouro'] ?? '',
                    'bairro' => $data['bairro'] ?? '',
                    'cidade' => $data['localidade'] ?? '',
                    'uf' => $data['uf'] ?? '',
                ];
        }
    }
    
    public function render()
    {
        return view('livewire.unidade.edit');
    }
}
