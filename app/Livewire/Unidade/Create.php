<?php

namespace App\Livewire\Unidade;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $ufs;
    public $endereco;
    public $unidade = [
    'id' => null,
    'nome' => '',
    'responsavel' => '',
    'telefone' => '',
    'email' => '',
    'celular' => '',
    'codigo_unidade' => '',
    'unidade_tipo_id' => null,
    'endereco' => [
        'uf' => '',
        'cidade' => '',
        'bairro' => '',
        'rua' => '',
        'numero' => '',
        'cep' => '',
    ],
];
    public $step;
    #[On('dispatchOpenModalCreateUnidade')]
    public function OpenModal(){
        $this->step=1;
        $this->modal = true;
    }

    public function updatedUnidadeEnderecoCep($value)
    {
        
        $cepValue = preg_replace('/[^0-9]/', '', $value);
        
        if (strlen($cepValue) === 8) {
            
            $data= Http::get("https://viacep.com.br/ws/{$cepValue}/json/")->json();
            $this->unidade['endereco'] = [
                    'uf' => $data['uf'] ?? '',
                    'bairro' => $data['bairro'] ?? '',
                    'cidade' => $data['localidade'] ?? '',
                    'rua' => $data['logradouro'] ?? '',
                    'numero' => $this->unidade['endereco']['numero'] ?? '',
                    'cep' => $data['cep'] ?? '',
                ];
        }
    }

    public function mount()
    {
        $this->ufs = [
            ['name' => 'AC'], ['name' => 'AL'], ['name' => 'AP'], ['name' => 'AM'],
            ['name' => 'BA'], ['name' => 'CE'], ['name' => 'DF'], ['name' => 'ES'],
            ['name' => 'GO'], ['name' => 'MA'], ['name' => 'MT'], ['name' => 'MS'],
            ['name' => 'MG'], ['name' => 'PA'], ['name' => 'PB'], ['name' => 'PR'],
            ['name' => 'PE'], ['name' => 'PI'], ['name' => 'RJ'], ['name' => 'RN'],
            ['name' => 'RS'], ['name' => 'RO'], ['name' => 'RR'], ['name' => 'SC'],
            ['name' => 'SP'], ['name' => 'SE'], ['name' => 'TO'],
        ];
        return $this->ufs;
    }

    public function createUnidade(){
        dump($this->unidade);
    
    }

    public function render()
    {
        return view('livewire.unidade.create');
    }
}
