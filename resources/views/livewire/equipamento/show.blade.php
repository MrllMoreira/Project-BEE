<x-ts-modal 
title="Informações do Equipamento - {{ $equipamento['codigo_patrimonio'] }}" center wire>
    
    <div class="flex flex-row gap-5">
        <div class=" w-1/3">
            <x-ts-input 
                label="ID"
                class="block mt-1 w-full"
                value="{{ $equipamento['id'] }}"
                disabled
            />
        </div>

        <div class="w-2/3">
            <x-ts-input 
                label="Código Patrimonial"
                class="block mt-1 w-full"
                value="{{ $equipamento['codigo_patrimonio'] }}"
                disabled
            />
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Marca"
                class="block mt-1 w-full"
                value="{{ $equipamento['marca'] }}"
                disabled
            />
        </div>

        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Categoria"
                class="block mt-1 w-full"
                value="{{ $equipamento['categoria'] }}"
                disabled
            />
        </div>

        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Status"
                class="block mt-1 w-full"
                value="{{ $equipamento['status'] }}"
                disabled
            />
        </div>
    </div>

    <div class="mt-4">
        <x-ts-input 
            label="Atualizado em"
            class="block mt-1 w-full"
            value="{{ $equipamento['atualizadoEm'] }}"
            disabled
        />
    </div>
</x-ts-modal>
