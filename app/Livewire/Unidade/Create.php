<?php

namespace App\Livewire\Unidade;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Create extends Component
{
    public $modal = false;
    public $ufs;
    public $cep;
    public $endereco = [
        'cep' => '',
        'localidade' => '',
        'logradouro' => '',
        'bairro' => '',
        'uf' => '',
    ];
    #[On('dispatchOpenModalCreateUnidade')]
    public function OpenModal(){
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

    public function mount()
    {
        $this->endereco = [
        'cep' => '',
        'localidade' => '',
        'logradouro' => '',
        'bairro' => '',
        'uf' => '',
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

    public function render()
    {
        return view('livewire.unidade.create');
    }
}
