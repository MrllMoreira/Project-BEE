<x-ts-modal title="Informações - " center wire >
    <div class="mt-4">
            <x-ts-input class="block mt-1 w-full" label="Nome" value="{{ $inventario['nome'] }}" disabled/>                            
    </div>
    <div class="mt-4">
            <x-ts-input class="block mt-1 w-full"  
            label="Status" value="{{ $inventario['status'] }}" disabled/>   
    </div>
</x-ts-modal>