<x-ts-modal title="Criar usuário" center wire>
    
    <form method="POST" ">
            @csrf
         <div>
            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/3">
                    <x-ts-input id="cpf" class="block mt-1 w-full" type="text" label="CPF *" required />                            
                </div>
                 <div class="mt-4 w-1/3">
                    <x-ts-input id="matricula" class="block mt-1 w-full" type="text" label="Matrícula *" required />
                </div>
                 <div class="mt-4 w-1/3">
                    <x-ts-select.styled class="block mt-1 w-full" id="role" :options="[
                        ['label' => 'Funcionário', 'value' => 1],
                        ['label' => 'Diretor', 'value' => 2],
                        ['label' => 'Secretaria', 'value' => 3],
                        ['label' => 'Admin', 'value' => 4],]" 
                    label="Função *" required/>
                        
                    </div>
            </div>
            <div class="mt-4">
                <x-ts-input label="Nome *"  id="nome" class="block mt-1 w-full" type="text" required autofocus/>
            </div>
            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/2">
                    <x-ts-select.styled class="block mt-1 w-full" id="unidade" :options="$unidades" searchable
                    label="Unidade *"  required/>   
                </div>
            
                <div class="mt-4 w-1/2">
                    <x-ts-input id="email" class="block mt-1 w-full" type="email" label="Email *" required />
                </div>
            </div>
            <div class="flex flex-row gap-5">
                    <div class="mt-4 w-1/2">
                        <x-ts-input id="password" class="block mt-1 w-full" type="password" label="Senha Temporaria *" required />
                    </div>
                    <div class="mt-4 w-1/2">
                        <x-ts-input id="confirmPassword" class="block mt-1 w-full" type="password" label="Confirmar senha *" required />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <x-button class="mt-4" type="submit">Criar</x-button>
            </div>
        </div>    
    </form>
</x-ts-modal>