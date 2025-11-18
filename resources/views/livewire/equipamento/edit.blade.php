<x-ts-modal 
title="Editar equipamento - {{ $equipamento['codigo_patrimonio'] }}" center wire>
    
    
    <div class="mt-4">
            <x-ts-input 
                label="Código Patrimonial"
                class="block mt-1 w-full"
                value="{{ $equipamento['codigo_patrimonio'] }}"

            />
    </div>
    <div class="flex flex-row gap-5">
        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Marca"
                class="block mt-1 w-full"
                value="{{ $equipamento['marca'] }}"

            />
        </div>

        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Categoria"
                class="block mt-1 w-full"
                value="{{ $equipamento['categoria'] }}"

            />
        </div>

        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Status"
                class="block mt-1 w-full"
                value="{{ $equipamento['status'] }}"

            />
        </div>
    </div>

    <div class="mt-4">
        <x-ts-checkbox  wire:model.live='transferirEquipamento' label="Transferir equipamento"></x-ts-checkbox>
    </div>

    @if ($transferirEquipamento)
        <div class="flex flex-row gap-5 mt-4">
         <div class=" w-1/2">
            <x-ts-select.styled class="block mt-1 w-full" label="Unidade" id="unidade_id" :options="$unidades" searchable wire:model.live='unidade_id'
            required/>
        </div>
        <div class=" w-1/2">
            
            <x-ts-select.styled class="block mt-1 w-full" label="Inventario" id="inventario_id" :options="$inventarios" searchable wire:model.live='inventario_id'
            required/>
        </div>
    </div>
    @endif
    <div class="flex items-center justify-end">
        <x-button class="mt-4" type="submit">Salvar alterações</x-button>
    </div>
</x-ts-modal>
