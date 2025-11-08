<x-ts-modal title="Criar unidade" center wire>
        <form method="POST" ">
            @csrf
            <div>
                <x-label for="nome" value="Nome" />
                <x-input id="nome" class="block mt-1 w-full" type="text" name="nome"  required autofocus/>
            </div>
            
            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/3">
                    <x-label for="codigo" value="Codigo da unidade" />
                    <x-input id="codigo" class="block mt-1 w-full" type="text" name="codigo" required />
                </div>
                
                <div class="mt-4 w-2/3">
                    <x-label for="responsavel" value="Responsavel" />
                    <x-input id="responsavel" class="block mt-1 w-full" type="text" name="responsavel" required />
                </div>
            </div>
            
            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/3">
                    <x-label for="telefone" value="Telefone" />
                    <x-input id="telefone" class="block mt-1 w-full" type="tel" name="telefone" required />
                </div>

                <div class="mt-4 w-1/3">
                    <x-label for="celular" value="Celular" />
                    <x-input id="celular" class="block mt-1 w-full" type="tel" name="celular" required />
                </div>

                <div class="mt-4 w-1/3">
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                </div>
            </div>
            
            <div class="flex flex-row gap-5">
                <div class="mt-4 w-1/2">
                    <x-label for="endereco" value="Endereco" />
                    <x-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" required />
                </div>

                <div class="mt-4 w-1/2">
                    <x-label for="ensino" value="Ensino" />
                    <x-input id="ensino" class="block mt-1 w-full" type="text" name="ensino" required />
                </div>

            </div>

               
            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4" type="submit">
                    Criar
                </x-button>
            </div>
        </form>
    </x-ts-modal>