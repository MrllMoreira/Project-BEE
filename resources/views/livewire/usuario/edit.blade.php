<x-ts-modal title="Editar" center wire>
<div>
            <div class="mt-4">
            <x-ts-input label="Nome *" class="block mt-1 w-full" type="text" wire:model.defer="user.nome" required autofocus/>
            </div>
            <div class="mt-4">
                <x-ts-input class="block mt-1 w-full" type="text" label="CPF *" wire:model.defer="user.cpf" required />                            
            </div>
             <div class="mt-4">
                <x-ts-input class="block mt-1 w-full" type="text" label="Matrícula *" wire:model.defer="user.matricula" required />
            </div>
            
            <div class="mt-4">
                <x-ts-input class="block mt-1 w-full" type="email" label="Email *" wire:model.defer="user.email" required />
            </div>
            
            <div class="mt-4">
                <x-ts-select.styled class="block mt-1 w-full" id="role" :options="[
                    ['label' => 'Funcionário', 'value' => 1],
                    ['label' => 'Diretor', 'value' => 2],
                    ['label' => 'Secretaria', 'value' => 3],
                    ['label' => 'Admin', 'value' => 4],]" 
                label="Função *" wire:model.defer="user.roles_id"  required/>    
            </div>
            <div class="mt-4">
                <x-ts-select.styled class="block mt-1 w-full" id="unidade" :options="$unidades" searchable
                label="Unidade *" wire:model.defer="user.unidade_id" required/> 
            </div>
                
                
            <div class="flex items-center justify-end">
                <x-button class="mt-4">Salvar alterações</x-button>
            </div>
        </div>   
          
</x-ts-modal>
