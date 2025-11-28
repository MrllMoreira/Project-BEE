<x-ts-modal title="Informações - {{$unidade['nome']}}" center wire >
    <div class="flex flex-row gap-5">
        <div class="mt-4 w-2/3">
            <x-ts-input 
                label="Nome" 
                class="block mt-1 w-full"
                wire:model.defer="unidade.nome"

            />
        </div>

        <div class="mt-4 w-1/3">
           <x-ts-select.styled :options="[
                        ['label' => 'Todas', 'value' => null],
                        ['label' => 'Fundamental I', 'value' => 'Fundamental I'],
                        ['label' => 'Fundamental II', 'value' => 'Fundamental II'],
                        ['label' => 'Fundamental I e II', 'value' => 'Fundamental I e II'],
                        ['label' => 'Secretaria', 'value' => 'Secretaria']]"
            label="Ensino *" class="block mt-1 w-full" required wire:model.defer="unidade.ensino_tipo"/>
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Código da unidade" 
                class="block mt-1 w-full"
                wire:model.defer="unidade.codigo_unidade"

            />
        </div>

        <div class="mt-4 w-2/3">
            <x-ts-select.styled :options="$responsaveis"
            label="Responsável " class="block mt-1 w-full" wire:model.defer="unidade.responsavel"/>
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <div class="mt-4 w-1/2">
            <x-ts-input 
                label="Telefone" 
                class="block mt-1 w-full"
                wire:model.defer="unidade.telefone"

            />
        </div>

        <div class="mt-4 w-1/2">
            <x-ts-input 
                label="Celular" 
                class="block mt-1 w-full"
                wire:model.defer="unidade.celular"

            />
        </div>
    </div>

    <div class="mt-4">
        <x-ts-input 
            label="Email" 
            class="block mt-1 w-full"
            wire:model.defer="unidade.email"
        />
    </div>

    <div class="flex flex-row gap-5">
                    <div class="mt-4 w-1/5">
                        <x-ts-input id="cep" class="block mt-1 w-full" label="CEP *" required placeholder="_____-___" wire:model.live="unidade.endereco.cep" maxlength="9" />
                    </div>
                    <div class="mt-4 w-3/5">
                        <x-ts-input id="cidade" class="block mt-1 w-full" label="Cidade *" required wire:model.defer="unidade.endereco.cidade"/>
                    </div>
                 
                    <div class="mt-4 w-1/5">
                        
                        <x-ts-select.styled class="block mt-1 w-full" :options="$ufs"
                        label="UF *" required wire:model.defer="unidade.endereco.uf"/>
                    </div>
                 
                </div>
               
                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-3/5">
                        <x-ts-input id="rua" class="block mt-1 w-full" label="Rua *" required wire:model.defer="unidade.endereco.rua"/>
                    </div>
                    <div class="mt-4 w-1/5">
                        <x-ts-input id="numero" class="block mt-1 w-full" label="Número *" 
                        wire:model.defer="unidade.endereco.numero" required />
                    </div>
                    <div class="mt-4 ">
                        <x-ts-input id="bairro" class="block mt-1 w-full" label="Bairro *" required wire:model.defer="unidade.endereco.bairro"/>
                    </div>
                </div>
    <div class="flex items-center justify-end">
        <x-button class="mt-4" wire:click='editUnidade'>Salvar Alterações</x-button>
    </div> 
    
</x-ts-modal>