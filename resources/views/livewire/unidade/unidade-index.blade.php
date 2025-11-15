

<div class="h-[780px] px-5 sm:max-w-[750px] lg:max-w-full">
    <h1 class="p-6 mb-8 text-3xl font-bold">Unidades</h1>
    <div class="flex flex-col gap-4 p-2">
    <div class="flex flex-row gap-4 items-end">
        <div class="flex flex-row gap-3 items-end">
            <x-ts-select.styled :options="[
                ['label' => 'Todas', 'value' => null],
                ['label' => 'Fundamental I', 'value' => 1],
                ['label' => 'Fundamental II', 'value' => 2],
                ['label' => 'Fundamental I e II', 'value' => 3],]" 
        label="Ensino" wire:model.live="ensinoFilter"/>
        </div>
        @if (Auth::user()->roles_id == 1)
        <button class="flex items-center justify-center bg-slate-400 h-[34px] w-[34px] rounded-lg mb-[1px]" wire:click="dispatchOpenCreateModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" 
            stroke="white" stroke-width="2" stroke-linecap="round" 
            stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14"/><path d="M12 5v14"/>
            </svg>
        </button>         
        @endif
    </div>
     <x-table
    :headers="$headers" 
    :rows="$rows"
    :search="$search" 
    :quantity="$quantity"
    link="unidade.show"
 />
    <livewire:unidade.create/>
    <livewire:unidade.show/>
</div>

