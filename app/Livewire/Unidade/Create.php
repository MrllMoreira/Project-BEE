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
       'codigo' => '',
       'nome' => '',
       'responsavel' => '',
       'telefone' => '',
       'celular' => '',
       'email' => '',
       'ensino' => '',
    ];
    public $step;
    #[On('tsui:step.changed')]
    public function stepChanged($step)
    {
        $this->step = $step;
    }
    #[On('dispatchOpenModalCreateUnidade')]
    public function OpenModal(){
        $this->step=1;
        $this->modal = true;
    }
    public function updatedModal(){

    }
    public function updatedEnderecoCep($value)
    {
        $cepValue = preg_replace('/[^0-9]/', '', $value);
     
        if (strlen($cepValue) === 8) {
            $data= Http::get("https://viacep.com.br/ws/{$cepValue}/json/")->json();
            $this->endereco = [
                    'cep' => $data['cep'] ?? '',
                    'localidade' => $data['localidade'] ?? '',
                    'logradouro' => $data['logradouro'] ?? '',
                    'bairro' => $data['bairro'] ?? '',
                    'cidade' => $data['localidade'] ?? '',
                    'uf' => $data['uf'] ?? '',
                    'numero' => $this->endereco['numero'] ?? ''
                ];
        }
    }

    public function mount()
    {
        $this->endereco = [
        'cep' => '',
        'localidade' => '',
        'logradouro' => '',
        'bairro' => '',
        'uf' => '',
        'numero' => ''
        ];
        $this->ufs = [
            ['name' => 'AC'], ['name' => 'AL'], ['name' => 'AP'], ['name' => 'AM'],
            ['name' => 'BA'], ['name' => 'CE'], ['name' => 'DF'], ['name' => 'ES'],
            ['name' => 'GO'], ['name' => 'MA'], ['name' => 'MT'], ['name' => 'MS'],
            ['name' => 'MG'], ['name' => 'PA'], ['name' => 'PB'], ['name' => 'PR'],
            ['name' => 'PE'], ['name' => 'PI'], ['name' => 'RJ'], ['name' => 'RN'],
            ['name' => 'RS'], ['name' => 'RO'], ['name' => 'RR'], ['name' => 'SC'],
            ['name' => 'SP'], ['name' => 'SE'], ['name' => 'TO'],
        ];
    }

    public function createUnidade(){
        dump($this->unidade, $this->endereco);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.unidade.create');
    }
}
