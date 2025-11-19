<x-ts-modal title="Cadastrar Equipamento" center wire >

    <div class="mt-3 px-1 pb-1">

        <div class="mt-4">
                <x-ts-input 
                    label="Código Patrimonial ou Nome *"
                    class="block mt-1 w-full"
                    wire:model.defer="equipamento.codigo_patrimonio"
                    placeholder="Digite o código patrimonial ou nome"
                    required
                />
        </div>

        <div class="flex flex-row gap-5 mt-4">
            <div class="w-1/3">
                <x-ts-input 
                    label="Marca *"
                    class="block mt-1 w-full"
                    wire:model.defer="equipamento.marca"
                    placeholder="Digite a marca"
                    required
                />
            </div>

            <div class="w-1/3">
                <x-ts-input 
                    label="Categoria *"
                    class="block mt-1 w-full"
                    wire:model.defer="equipamento.categoria"
                    placeholder="Digite a categoria"
                    required
                />
            </div>

            <div class="w-1/3">
                <x-ts-select.styled
                    label="Status *"
                    class="block mt-1 w-full"
                    :options="[
                        ['label' => 'Ativo', 'value' => 'ativo'],
                        ['label' => 'Inativo', 'value' => 'inativo'],
                        ['label' => 'Em Manutenção', 'value' => 'manutencao'],
                    ]"
                    wire:model.defer="equipamento.status"
                    required
                />
            </div>
        </div>
        <div class="mt-4">
            <x-ts-input 
                label="Descrição / Observação"
                class="block mt-1 w-full"
                wire:model.defer="equipamento.descricao"
                placeholder="Alguma observação sobre o equipamento"
            />
        </div>

   
        
        <div class="flex justify-end mt-6">
            <x-button wire:click="createEquipamento">
                Salvar
            </x-button>
        </div>

    </div>

</x-ts-modal>
