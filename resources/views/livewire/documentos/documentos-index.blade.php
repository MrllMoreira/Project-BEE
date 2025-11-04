<div class="flex lg:flex-row flex-col gap-4 p-2">
    <x-ts-tab  wire:model.live="tab"  x-on:selected-change="$wire.set('selectedDocument', '')">
        <x-ts-tab.items tab="Assinar" >
            <ul class="flex flex-col justify-center gap-2  border-am">
                @foreach ($documentos as $doc)
                    @if ($doc['status'] == "assinar")
                        <li class="{{$doc['id'] == $selectedDocument ? 'bg-slate-300' : 'hover:bg-slate-100'}}  rounded-xl pl-2 h-7 relative">
                            <input type="radio" name="documento" id="{{$doc['id']}}" wire:model.live="selectedDocument" value="{{$doc['id']}}" class="hidden">
                            <label class="absolute inset-0 cursor-pointer flex items-center pl-2" for="{{$doc['id']}}">{{$doc['nome']}}</label>
                        </li>
                    @endif
                @endforeach
            </ul>
            @if ($selectedDocument != "")
                <div class="flex justify-end items-center mt-3">
                    <x-button >Assinar</x-button>  
                </div>
            @endif
        </x-ts-tab.items>
        <x-ts-tab.items tab="Em espera">
            <ul class="flex flex-col justify-center gap-2 ">
                @foreach ($documentos as $doc)
                    @if ($doc['status'] == "em espera")
                        <li class="{{$doc['id'] == $selectedDocument ? 'bg-slate-300' : 'hover:bg-slate-100'}}  rounded-xl pl-2 h-7 relative">
                            <input type="radio" name="documento" id="{{$doc['id']}}" wire:model.live="selectedDocument" value="{{$doc['id']}}" class="hidden">
                            <label class="absolute inset-0 cursor-pointer flex items-center pl-2" for="{{$doc['id']}}">{{$doc['nome']}}</label
                        </li>
                    @endif
                @endforeach
            </ul>
        </x-ts-tab.items>
        <x-ts-tab.items tab="Assinados">
            <ul class="flex flex-col justify-center gap-2 ">
                @foreach ($documentos as $doc)
                    @if ($doc['status'] == "assinado")
                        <li class="{{$doc['id'] == $selectedDocument ? 'bg-slate-300' : 'hover:bg-slate-100'}}  rounded-xl pl-2 h-7 relative">
                            <input type="radio" name="documento" id="{{$doc['id']}}" wire:model.live="selectedDocument" value="{{$doc['id']}}" class="hidden">
                            <label class="absolute inset-0 cursor-pointer flex items-center pl-2" for="{{$doc['id']}}">{{$doc['nome']}}</label
                        </li>
                    @endif
                @endforeach
            </ul>
        </x-ts-tab.items>

    </x-ts-tab>
    <iframe src="..." width="100%" height="800px"></iframe>

</div>
