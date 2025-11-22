<x-ts-modal 
title="Editar equipamento - {{ $equipamento['codigo_patrimonio'] }}" center wire>
    
    
    <div class="mt-4 flex flex-row gap-5">
            <div class="mt-4 w-1/2">
                <x-ts-input 
                label="Nome"
                class="block mt-1 w-full"
                wire:model.defer='equipamento.nome'

            />
            </div>
            <div class="mt-4 w-1/2">
                <x-ts-input 
                label="Código Patrimonial"
                class="block mt-1 w-full"
                wire:model.defer='equipamento.codigo_patrimonio'

            />
            </div>
            
    </div>
    <div class="flex flex-row gap-5">
        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Marca"
                class="block mt-1 w-full"
                wire:model.defer='equipamento.marca'

            />
        </div>

        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Categoria"
                class="block mt-1 w-full"
                wire:model.defer='equipamento.categoria'

            />
        </div>

        <div class="mt-4 w-1/3">
            <x-ts-select.styled :options="[
                            ['label' => 'Ativo', 'value' => 'Ativo'],
                            ['label' => 'Inativo', 'value' => 'Inativo'],
                            ['label' => 'Manutenção', 'value' => 'Manutenção'],]" 
                    label="Status" wire:model.defer='equipamento.status' searchable/>
        </div>
    </div>

    <div class="mt-4">
            <x-ts-input 
                label="Descrição / Observação"
                class="block mt-1 w-full"
                wire:model.defer="equipamento.descricao"
                placeholder="Alguma observação e/ou descrição sobre o equipamento"
            />
        </div>
    <div class=" mt-4">
            <x-ts-select.styled class="block mt-1 w-full" label="Inventario" :options="$inventarios" searchable wire:model='equipamento.inventario_id'
        
            />
         
        </div>
        
    <div class="flex items-center justify-end">
        <x-button class="mt-4" wire:click='editEquipamento'>Salvar alterações</x-button>
    </div>

</x-ts-modal>
