

<div class="h-[780px] px-5 sm:max-w-[750px] lg:max-w-full">
    <div class="flex flex-row items-center p-4 gap-5">
      <button wire:click="voltarInventarios">
        <svg class="w-5 h-5" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" />
        </svg>
      </button>
      <h1 class="text-3xl font-bold">Sala 1</h1>
    </div>
    <div class="flex flex-col gap-4 p-2">
    <div class="flex flex-row gap-4 items-end">
        <div class="flex flex-row gap-3 items-end">
            <x-ts-select.styled :options="[
                ['label' => 'Todas', 'value' => null],
                ['label' => 'Ativo', 'value' => 1],
                ['label' => 'Inativo', 'value' => 2],
                ['label' => 'Manutenção', 'value' => 3],]" 
        label="Status" wire:model.live="statusFilter" searchable/>
        </div>
        <button class="flex items-center justify-center bg-slate-400 h-[34px] w-[34px] rounded-lg mb-[1px]" wire:click="dispatchOpenCreateModal">
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
        link="equipamentos.show"
   />
    <livewire:equipamentos.show/>
    
</div>

