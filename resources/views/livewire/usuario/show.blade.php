<x-ts-modal title="Dados pessoais" center wire>
    <div class="pb-4">
        <div class="mt-4">
            <x-ts-input label="Nome" class="block mt-1 w-full"  value="{{$user['nome']}}" disabled/>
        </div>
        <div class="mt-4">
            <x-ts-input label="CPF" class="block mt-1 w-full" value="{{$user['cpf']}}" disabled   />                            
        </div>
         <div class="mt-4">
            <x-ts-input label="Matrícula" class="block mt-1 w-full" value="{{$user['matricula']}}" disabled />
        </div>
        
        <div class="mt-4">
            <x-ts-input label="Email" class="block mt-1 w-full" value="{{$user['email']}}" disabled />
        </div>
        <div class="mt-4">
            <x-ts-input label="Função" value="{{ $user['role_nome']  }}" disabled/>
        </div>         
      
        <div class="mt-4">
            <x-ts-input label="Unidade" value="{{ $user['unidade_nome']  }}" disabled/>
        </div>
    </div>    
</x-ts-modal>