<div>
    <x-ts-modal title="Criar usuário" center wire>
        <div>
            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/3">
                    <x-ts-input 
                        class="block mt-1 w-full" 
                        type="text" 
                        label="CPF *" 
                        wire:model.defer='newUser.cpf' 
                        autofocus
                    />                            
                </div>
                <div class="mt-4 w-1/3">
                    <x-ts-input 
                        class="block mt-1 w-full" 
                        type="text" 
                        label="Matrícula *"  
                        wire:model.defer='newUser.matricula'
                    />
                </div>
                <div class="mt-4 w-1/3">
                    <x-ts-select.styled 
                        class="block mt-1 w-full"  
                        :options="[
                            ['label' => 'Funcionário', 'value' => 1],
                            ['label' => 'Diretor', 'value' => 2],
                            ['label' => 'Secretaria', 'value' => 3],
                            ['label' => 'Admin', 'value' => 4]
                        ]" 
                        label="Função *" 
                        wire:model.defer='newUser.role_id'
                    />
                </div>
            </div>

            <div class="mt-4">
                <x-ts-input 
                    label="Nome *"  
                    class="block mt-1 w-full" 
                    type="text" 
                    wire:model.defer='newUser.nome' 
                />
            </div>

            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/2">
                    <x-ts-select.styled 
                        class="block mt-1 w-full" 
                        :options="$unidades" 
                        searchable
                        label="Unidade *"  
                        wire:model.defer='newUser.unidade_id'
                    />   
                </div>
                <div class="mt-4 w-1/2">
                    <x-ts-input  
                        class="block mt-1 w-full" 
                        type="email" 
                        label="Email *" 
                        wire:model.defer='newUser.email' 
                    />
                </div>
            </div>

            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/2">
                    <x-ts-input  
                        class="block mt-1 w-full" 
                        type="password" 
                        label="Senha Temporária *" 
                        wire:model.defer='newUser.password' 
                    />
                </div>
                <div class="mt-4 w-1/2">
                    <x-ts-input 
                        class="block mt-1 w-full" 
                        type="password" 
                        label="Confirmar senha *" 
                        wire:model.defer='newUser.confirmPassword' 
                    />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button wire:click='createUser'>
                    Criar
                </x-button>
            </div>
        </div>    
    </x-ts-modal>
</div>
