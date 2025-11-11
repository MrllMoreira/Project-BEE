<x-ts-modal title="Criar unidade" center wire >
    
    <form method="POST" ">
            @csrf
            <x-ts-step helpers navigate-previous selected="1">

            <x-ts-step.items step="1" title="Identificação">
                <div>
                    <div class="flex flex-row gap-5">
                        <div class="mt-4 w-2/3">
                            <x-ts-input label="Nome *"  id="nome" class="block mt-1 w-full" type="text" required autofocus/>
                        </div>
                        
                        <div class="mt-4 w-1/3">
                            <x-ts-select.styled :options="[
                                ['label' => 'Fundamental I', 'value' => 1],
                                ['label' => 'Fundamental II', 'value' => 2],
                                ['label' => 'Fundamental I e II', 'value' => 3],]" 
                        label="Ensino *" class="block mt-1 w-full" required/>
                        </div>
                </div>
                    <div class="flex flex-row gap-5">
                        <div class="mt-4 w-1/3">
                            <x-ts-input id="codigo" class="block mt-1 w-full" type="text" label="Codigo da unidade *" required />
                        </div>
                        
                        <div class="mt-4 w-2/3">
                            <x-ts-input id="responsavel" class="block mt-1 w-full" type="text" label="Responsavel *" required />
                        </div>
                    </div>
                </div>
            </x-ts-step.items>

            <x-ts-step.items step="2" title="Contato">
                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-1/2">
                        <x-ts-input id="telefone" class="block mt-1 w-full" type="tel" label="Telefone *" required />
                    </div>

                    <div class="mt-4 w-1/2">
                        <x-ts-input id="celular" class="block mt-1 w-full" type="tel" label="Celular" required />
                    </div>
                </div>
                <div class="mt-4">
                    <x-ts-input id="email" class="block mt-1 w-full" type="email" label="Email *" required />
                </div>
            
            </x-ts-step.items>

            <x-ts-step.items step="3" title="Endereço" class="relative">
                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-1/5">
                        <x-ts-input id="cep" class="block mt-1 w-full" type="text" label="CEP *" required placeholder="_____-___" wire:model="cep" maxlength="9" />
                    </div>
                    <div class="mt-4 w-3/5">
                        <x-ts-input id="cidade" class="block mt-1 w-full" type="text" label="Cidade *" required wire:model="endereco.localidade"/>
                    </div>
                    <div class="mt-4 w-1/5">
                        <x-ts-select.styled class="block mt-1 w-full" id="uf" :options="$ufs"
                        select="label:name|value:name"
                        label="UF *" required wire:model.live="endereco.uf"/>
                    </div>
                </div>
            
                <div class="flex flex-row gap-5">
                    <div class="mt-4 w-3/5">
                        <x-ts-input id="rua" class="block mt-1 w-full" type="text" label="Rua *" required wire:model="endereco.logradouro"/>
                    </div>
                    <div class="mt-4 w-1/5">
                        <x-ts-input id="numero" class="block mt-1 w-full" type="text" label="Número *" required />
                    </div>
                    <div class="mt-4 ">
                        <x-ts-input id="bairro" class="block mt-1 w-full" type="text" label="Bairro *" required wire:model="endereco.bairro"/>
                    </div>
                </div>
            

               
                <div class="flex items-center justify-end absolute right-7 bottom-8">
                    <x-button  type="submit">
                        Criar
                    </x-button>
                </div>
            </x-ts-step.items>
        </x-ts-step>
                    
        </form>
</x-ts-modal>