<x-ts-modal title="Editar inventario" center wire>   
    
        <div class="mt-4">
            <x-ts-input class="block mt-1 w-full" label="Nome *"  wire:model.defer='inventario.nome'/>                            
        </div>
        <div class="mt-4">
            <x-ts-select.styled class="block mt-1 w-full"  :options="[
                ['label' => 'Ativo', 'value' => 1],
                ['label' => 'Inativo', 'value' => 2],
                ['label' => 'Manutenção', 'value' => 3],]" 
            label="Status *" wire:model.defer='inventario.status'/>   
        </div>
        
        <div class="flex items-center justify-end">
            <x-button class="mt-4" wire:click='editInventario'>Salvar Alterações</x-button>
        </div>  
   
</x-ts-modal>