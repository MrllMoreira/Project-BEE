<div class="w-full px-4 py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <div class="overflow-hidden shadow-sm rounded-xl theme-card">

        <div class="flex flex-col items-start justify-between gap-4 p-6 theme-card-header sm:flex-row sm:items-center">

            <div>
                <h1 class="text-2xl font-bold theme-title">{{$nome}} - Inventários</h1>
                <p class="mt-1 text-sm theme-subtitle">Gerencie os itens e equipamentos do inventário</p>
            </div>

            <div class="flex flex-row items-end w-full gap-3 sm:w-auto">

                <div class="w-full sm:min-w-[200px]">
                    <x-ts-select.styled
                        :options="[
                            ['label' => 'Todas', 'value' => null],
                            ['label' => 'Ativo', 'value' => 'Ativo'],
                            ['label' => 'Inativo', 'value' => 'Inativo'],
                            ['label' => 'Manutenção', 'value' => 'Manutenção'],
                        ]"
                        label="Status"
                        wire:model.live="statusFilter"
                        searchable
                        placeholder="Filtre por status"
                    />
                </div>

                @if (Auth::user()->unidade_id == $idUnidade)
                <button
                    class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white
                    h-[42px] w-[42px] rounded-lg transition-colors shadow-sm
                    focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mb-[1px]"
                    wire:click="dispatchOpenCreateModal"
                    title="Adicionar Novo Item"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 12h14" /><path d="M12 5v14" />
                    </svg>
                </button>
                @endif
            </div>
        </div>

        <div class="p-6 theme-body">
            <x-table
                :headers="$headers"
                :rows="$rows"
                :search="$search"
                :quantity="$quantity"
                link="equipamentos"
            />
        </div>
    </div>

    <livewire:inventario.create/>
    <livewire:inventario.edit/>
    <livewire:inventario.delete/>

</div>
