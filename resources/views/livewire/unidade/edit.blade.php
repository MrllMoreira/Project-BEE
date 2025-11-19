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
                ['label' => 'Fundamental I', 'value' => 1],
                ['label' => 'Fundamental II', 'value' => 2],
                ['label' => 'Fundamental I e II', 'value' => 3],]" 
            label="Ensino *" class="block mt-1 w-full" required wire:model.defer="unidade.unidade_tipo_id"/>
           

        
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
            <x-ts-input 
                label="Responsável" 
                class="block mt-1 w-full"
                wire:model.defer="unidade.responsavel"

            />
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
                        <x-ts-input id="cep" class="block mt-1 w-full" type="text" label="CEP *" required placeholder="_____-___" wire:model.live.debounce.500ms="unidade.enderecos.cep" maxlength="9" />
                    </div>
                    <div class="mt-4 w-3/5">
                        <x-ts-input id="cidade" class="block mt-1 w-full" type="text" label="Cidade *" required wire:model.defer="unidade.enderecos.cidade"/>
                    </div>
                 
                    <div class="mt-4 w-1/5">
                        
                        <x-ts-select.styled class="block mt-1 w-full" id="uf" :options="$ufs"
                       
                        label="UF *" required wire:model.defer="unidade.enderecos.uf"/>
                    </div>
                 
                </div>
        
                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-3/5">
                        <x-ts-input id="rua" class="block mt-1 w-full" type="text" label="Rua *" required wire:model.defer="unidade.enderecos.rua"/>
                    </div>
                    <div class="mt-4 w-1/5">
                        <x-ts-input id="numero" class="block mt-1 w-full" type="text" label="Número *" 
                        wire:model.defer="unidade.enderecos.numero" required />
                    </div>
                    <div class="mt-4 ">
                        <x-ts-input id="bairro" class="block mt-1 w-full" type="text" label="Bairro *" required wire:model.defer="unidade.enderecos.bairro"/>
                    </div>
                </div>
    <div class="flex items-center justify-end">
        <x-button class="mt-4" type="submit">Salvar Alterações</x-button>
    </div> 
    
</x-ts-modal>