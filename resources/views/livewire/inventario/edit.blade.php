<x-ts-modal title="Editar inventario" center wire>   
    <form method="POST" ">
        @csrf
        <div class="mt-4">
            <x-ts-input id="nome" class="block mt-1 w-full" type="text" label="Nome *" required wire:model.live='nome'/>                            
        </div>
        <div class="mt-4">
            <x-ts-select.styled class="block mt-1 w-full" id="status" :options="[
                ['label' => 'Ativo', 'value' => 1],
                ['label' => 'Inativo', 'value' => 2],
                ['label' => 'Manutenção', 'value' => 3],]" 
            label="Status *" required wire:model.live='status'/>   
        </div>
        
        <div class="flex items-center justify-end">
            <x-button class="mt-4" type="submit">Salvar Alterações</x-button>
        </div>  
    </form>
</x-ts-modal>