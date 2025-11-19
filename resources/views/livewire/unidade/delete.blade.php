<x-ts-modal center wire>
   
        <div class="flex flex-col justify-center items-center gap-3">
            <h2 class="font-bold">Tem certeza que deseja deletar a unidade {{$nome}}?</h2>
            @if ($temEquipamentos)
                <p class="text-sm px-10">
                    Existe equipamentos cadastrados nessa unidade, todos os seus dados serão deletados permanentemente.
                </p>
            @else
                <p class="text-sm px-10">
                Todos os dados da unidade serão deletados permanentemente.
                </p>
            @endif
            <div class="flex flex-row justify-center w-1/2 gap-10">
                <x-ts-button color='black' outline sm wire:click="closeModal" >Não</x-ts-button>
                <x-ts-button color='red' outline sm>Sim</x-ts-button>
            </div>
        </div>
</x-ts-modal>