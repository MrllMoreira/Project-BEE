<x-ts-modal center wire>
   
        <div class="flex flex-col justify-center items-center gap-3">
            <h2 class="font-bold">Tem certeza que deseja deletar {{$user['nome']}}?</h2>
            <p class="text-sm px-10">
                Todos os dados do usuario serão deletados permanentemente.
            </p>
            <div class="flex flex-row justify-center w-1/2 gap-10">
                <x-ts-button color='black' outline sm wire:click="closeModal" >Não</x-ts-button>
                <x-ts-button color='red' outline sm  wire:click="delete">Sim</x-ts-button>
            </div>
        </div>
    </x-ts-modal>