<div>
    <x-ts-modal title="Criar unidade" center wire class="p-0">

    {{-- BARRA DE PROGRESSO --}}
    <div class="w-full flex justify-between mt-4 select-none relative">

        @php
            $stepsLabels = [
                1 => 'Identificação',
                2 => 'Contato',
                3 => 'Endereço',
            ];
        @endphp

        <div class="flex w-full items-center justify-between">
            @foreach ($stepsLabels as $num => $label)
                <div class="relative flex items-center justify-center flex-1">

                    {{-- LINHA ESQUERDA --}}
                    @if($num !== 1)
                        <div class="absolute left-0 top-1/2 w-1/2 h-[2px] @if($step >= $num) bg-amber-500 @else bg-gray-300 @endif"></div>
                    @endif

                    {{-- LINHA DIREITA --}}
                    @if($num !== count($stepsLabels))
                        <div class="absolute right-0 top-1/2 w-1/2 h-[2px] @if($step > $num) bg-amber-500 @else bg-gray-300 @endif"></div>
                    @endif

                    {{-- BOLINHA --}}
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold z-10
                        @if($step >= $num) bg-amber-500 @else bg-gray-300 @endif">
                        {{ $num }}
                    </div>

                    {{-- TÍTULO CENTRALIZADO NA BOLINHA --}}
                    <span class="absolute top-12 left-1/2 -translate-x-1/2 text-sm font-medium whitespace-nowrap
                        @if($step >= $num) text-amber-600 @else text-gray-500 @endif">
                        {{ $label }}
                    </span>

                </div>
            @endforeach
        </div>

    </div>

    {{-- CONTEUDO --}}
    <div class="mt-10 px-4 pb-2">

        {{-- IDENTIFICAÇÃO --}}
        @if($step === 1)
            <div>

                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-1/2">
                        <x-ts-input wire:model.defer="unidade.codigo_unidade" class="block mt-1 w-full"
                         label="Codigo da unidade *" />
                    </div>

                    <div class="mt-4 w-1/2">
                        <x-ts-select.styled
                            :options="[
                                ['label' => 'Fundamental I', 'value' => 'Fundamental I'],
                                ['label' => 'Fundamental II', 'value' => 'Fundamental II'],
                                ['label' => 'Fundamental I e II', 'value' => 'Fundamental I e II']
                            ]"
                            label="Ensino *"
                            class="block mt-1 w-full"
                        
                            wire:model.defer='unidade.ensino_tipo'
                        />
                    </div>
                </div>

                <div class="mt-4">
                    <x-ts-input label="Nome *" wire:model.defer="unidade.nome"
                        class="block mt-1 w-full" autofocus/>
                </div>

                <div class="mt-4">
                    <x-ts-select.styled
                            :options="$responsaveis"
                            label="Responsavel *"
                            class="block mt-1 w-full"
                        
                            wire:model.defer="unidade.responsavel"
                        />
                </div>

                <div class="flex justify-end mt-4">
                    <x-ts-button wire:click="$set('step', 2)" outline color='black' >Próximo</x-ts-button>
                </div>

            </div>
        @endif

        {{-- CONTATO --}}
        @if($step === 2)
            <div>

                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-1/2">
                        <x-ts-input wire:model.defer="unidade.telefone"
                            class="block mt-1 w-full"  label="Telefone *" />
                    </div>

                    <div class="mt-4 w-1/2">
                        <x-ts-input wire:model.defer="unidade.celular"
                            class="block mt-1 w-full"  label="Celular" />
                    </div>
                </div>

                <div class="mt-4">
                    <x-ts-input wire:model.defer="unidade.email"
                        class="block mt-1 w-full" label="Email *" />
                </div>

                <div class="flex justify-between mt-4">
                    <x-ts-button wire:click="$set('step', 1)" outline color='black'>Voltar</x-ts-button>
                    <x-ts-button wire:click="$set('step', 3)" outline color='black'>Próximo</x-ts-button>
                </div>

            </div>
        @endif

        {{-- ENDEREÇO --}}
        @if($step === 3)
            <div class="relative">

                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-2/5">
                        <x-ts-input wire:model.live="unidade.endereco.cep"
                            class="block mt-1 w-full"
                            label="CEP *" placeholder="_____-___" maxlength="9" />
                    </div>

                    <div class="mt-4 w-2/5">
                        <x-ts-input wire:model.defer="cidade"
                            class="block mt-1 w-full"
                            label="Cidade *" wire:model.defer="unidade.endereco.cidade"/>
                    </div>

                    <div class="mt-4 w-1/5">
                        <x-ts-select.styled class="block mt-1 w-full"
                            wire:model.defer="uf" :options="$ufs"
                            
                            label="UF *" wire:model.defer="unidade.endereco.uf"/>
                    </div>
                </div>

                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-3/5">
                        <x-ts-input class="block mt-1 w-full"
                            label="Rua *" wire:model.defer="unidade.endereco.rua"/>
                    </div>

                    <div class="mt-4">
                        <x-ts-input class="block mt-1 w-full"
                            label="Bairro *" wire:model.defer="unidade.endereco.bairro"/>
                    </div>

                    <div class="mt-4 w-1/5">
                        <x-ts-input class="block mt-1 w-full"
                            label="Número *" wire:model.defer="unidade.endereco.numero"/>
                    </div>

                    
                </div>

                <div class="flex justify-between mt-4">
                    <x-ts-button wire:click="$set('step', 2)" outline color='black'>Voltar</x-ts-button>

                    <x-button wire:click='createUnidade'>
                        Criar
                    </x-button>
                </div>

            </div>
        @endif

    </div>

</x-ts-modal>

</div>