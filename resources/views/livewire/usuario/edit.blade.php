<x-ts-modal title="Editar  - {{$user['nome']}}" center wire>
<div>
            <div class="mt-4">
            <x-ts-input label="Nome *" class="block mt-1 w-full" wire:model.defer="user.nome"  autofocus/>
            </div>
            <div class="mt-4">
                <x-ts-input class="block mt-1 w-full" label="CPF *" wire:model.defer="user.cpf"  />                            
            </div>
             <div class="mt-4">
                <x-ts-input class="block mt-1 w-full" label="Matrícula *" wire:model.defer="user.matricula"  />
            </div>
            
            <div class="mt-4">
                <x-ts-input class="block mt-1 w-full"  label="Email *" wire:model.defer="user.email"  />
            </div>
            
            <div class="mt-4">
                <x-ts-select.styled class="block mt-1 w-full"  :options="[
                    ['label' => 'Funcionário', 'value' => 2],
                    ['label' => 'Diretor', 'value' => 4],
                    ['label' => 'Secretaria', 'value' => 3],
                    ['label' => 'Admin', 'value' => 1],]" 
                label="Função *" wire:model.defer="user.role_id"  />    
            </div>
            <div class="mt-4">
                <x-ts-select.styled class="block mt-1 w-full"  :options="$unidades" searchable
                label="Unidade *" wire:model.defer="user.unidade_id" /> 
            </div>
                
                
            <div class="flex items-center justify-end">
                <x-button class="mt-4" wire:click='editUsuario'>Salvar alterações</x-button>
            </div>
        </div>   
          
</x-ts-modal>
