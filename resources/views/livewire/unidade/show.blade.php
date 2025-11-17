<x-ts-modal title="Informações - {{ $unidade['nome'] }}" center wire >
    <div class="flex flex-row gap-5">
        <div class="mt-4 w-2/3">
            <x-ts-input 
                label="Nome" 
                class="block mt-1 w-full"
                value="{{ $unidade['nome'] }}"
                disabled
            />
        </div>

        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Ensino" 
                class="block mt-1 w-full"
                value="{{ $unidade['ensino'] }}"
                disabled
            />
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <div class="mt-4 w-1/3">
            <x-ts-input 
                label="Código da unidade" 
                class="block mt-1 w-full"
                value="{{ $unidade['codigo_unidade'] }}"
                disabled
            />
        </div>

        <div class="mt-4 w-2/3">
            <x-ts-input 
                label="Responsável" 
                class="block mt-1 w-full"
                value="{{ $unidade['responsavel'] }}"
                disabled
            />
        </div>
    </div>

    <div class="flex flex-row gap-5">
        <div class="mt-4 w-1/2">
            <x-ts-input 
                label="Telefone" 
                class="block mt-1 w-full"
                value="{{ $unidade['telefone'] }}"
                disabled
            />
        </div>

        <div class="mt-4 w-1/2">
            <x-ts-input 
                label="Celular" 
                class="block mt-1 w-full"
                value="{{ $unidade['celular'] }}"
                disabled
            />
        </div>
    </div>

    <div class="mt-4">
        <x-ts-input 
            label="Email" 
            class="block mt-1 w-full"
            value="{{ $unidade['email'] }}"
            disabled
        />
    </div>

    <div class="mt-4">
        <x-ts-input 
            label="Endereço" 
            class="block mt-1 w-full"
            value="{{ $unidade['endereco'] }}"
            disabled
        />
    </div>
    <div class="flex items-center justify-end my-4">
        <x-button wire:click='irParaInventario'>
            Inventarios
        </x-button>
    </div>
</x-ts-modal>