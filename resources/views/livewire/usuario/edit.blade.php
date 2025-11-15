<x-ts-modal title="Editar" center wire>
        <form method="POST" ">
            @csrf
         <div>
            <div class="mt-4">
                <x-ts-input label="Nome *"  id="nome" class="block mt-1 w-full" type="text" value="{{$user['nome']}}" required autofocus/>
            </div>
            <div class="mt-4">
                <x-ts-input id="cpf" class="block mt-1 w-full" type="text" label="CPF *"  value="{{$user['cpf']}}" required />                            
            </div>
             <div class="mt-4">
                <x-ts-input id="matricula" class="block mt-1 w-full" type="text" label="Matrícula *" value="{{$user['matricula']}}" required />
            </div>
            
            <div class="mt-4">
                <x-ts-input id="email" class="block mt-1 w-full" type="email" label="Email *" value="{{$user['email']}}" required />
            </div>
            <div class="mt-4">
              <div class="mt-4">
                    <x-ts-select.styled class="block mt-1 w-full" id="role" :options="[
                        ['label' => 'Funcionário', 'value' => 1],
                        ['label' => 'Diretor', 'value' => 2],
                        ['label' => 'Secretaria', 'value' => 3],
                        ['label' => 'Admin', 'value' => 4],]" 
                    label="Função *" wire:model="roles_id"  required/>    
            </div>
            <div class="mt-4">
                <x-ts-select.styled class="block mt-1 w-full" id="unidade" :options="$unidades" searchable
                label="Unidade *" wire:model="unidades_id" required/> 
                </div>
            </div>
            <div class="flex items-center justify-end">
                <x-button class="mt-4" type="submit">Salvar alterações</x-button>
            </div>
        </div>    
    </form>
</x-ts-modal>