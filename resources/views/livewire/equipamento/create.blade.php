<x-ts-modal title="Cadastrar Equipamento" center wire >

    <div >

        <div class="mt-4 flex flex-row gap-5">
            <div class="mt-4 w-1/2">
                <x-ts-input 
                label="Nome *"
                class="block mt-1 w-full"
                wire:model.defer='equipamento.nome'

            />
            </div>
        <div class="mt-4 w-1/2">
                <x-ts-input 
                    label="Código Patrimonial *"
                    class="block mt-1 w-full"
                    wire:model.defer="equipamento.codigo_patrimonio"
                    placeholder="Digite o código patrimonial ou nome"
                    required
                />
        </div>
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
                        ['label' => 'Ativo', 'value' => 'Ativo'],
                        ['label' => 'Inativo', 'value' => 'Inativo'],
                        ['label' => 'Em Manutenção', 'value' => 'Manutenção'],
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
                placeholder="Alguma observação e/ou descrição sobre o equipamento"
            />
        </div>

   
        
        <div class="flex justify-end mt-6">
            <x-button wire:click="createEquipamento">
                Salvar
            </x-button>
        </div>

    </div>

</x-ts-modal>
