<x-ts-modal center wire>
   
        <div class="flex flex-col justify-center items-center gap-3">
            <h2 class="font-bold">Tem certeza que deseja deletar o equipamento {{$nome}}?</h2>
            <p class="text-sm px-10">
                Todos dados do equipamento serão deletados permanentemente.
            </p>
            
            <div class="flex flex-row justify-center w-1/2 gap-10">
                <x-ts-button color='black' outline sm wire:click="closeModal" >Não</x-ts-button>
                <x-ts-button color='red' outline sm>Sim</x-ts-button>
            </div>
        </div>
</x-ts-modal>