<div class="h-[780px] px-5 sm:max-w-[750px] lg:max-w-full">
    <h1 class="p-6 mb-8 text-3xl font-bold">Usuários</h1>
    <div class="flex flex-col gap-4 p-2">
    <div class="flex flex-row gap-4 items-end">
        <div class="flex flex-row gap-3 items-end">
            <x-ts-select.styled :options="array_merge([['label' => 'Todas', 'value' => 0]], $escolas)" searchable
        label="Escola" wire:model.live="escolaFilter"/>
        </div>
        <button class="flex items-center justify-center bg-slate-400 h-[34px] w-[34px] rounded-lg mb-[1px]"
         wire:click="dispatchOpenCreateModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
            stroke="white" stroke-width="2" stroke-linecap="round" 
            stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14"/><path d="M12 5v14"/>
            </svg>
        </button>
    </div>
     <x-table
    :headers="$headers" 
    :rows="$rows"
    :search="$search" 
    :quantity="$quantity"
    link="usuario.show"/>
    <livewire:usuario.create/>
