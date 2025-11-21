<div class="flex lg:flex-row flex-col gap-4 p-2">
    @php
        $labelClass = "absolute inset-0 cursor-pointer flex items-center pl-2";
        $liClass = "min-h-[30px] h-[30px] max-h-[30px] rounded-xl pl-2 h-7 relative";
        $divClass = "overflow-y-scroll py-2 max-h-56";
        $ulClass ="flex flex-col justify-center gap-2";
    @endphp
    <x-ts-tab  wire:model.live="tab"  x-on:selected-change="$wire.set('selectedDocument', '')">
        <x-ts-tab.items tab="Assinar" >
            <div class="{{ $divClass }}">
                <ul class="{{ $ulClass }}">
                @foreach ($documentos as $doc)
                    @if ($doc['status'] == "assinar")
                        <li class="{{ $liClass }} {{$doc['id'] == $selectedDocument ? 'bg-slate-300' : 'hover:bg-slate-100'}}">
                            <input type="radio" name="documento" id="{{$doc['id']}}" wire:model.live="selectedDocument" value="{{$doc['id']}}" class="hidden" >
                            <label class="absolute inset-0 cursor-pointer flex items-center pl-2" for="{{$doc['id']}}">{{$doc['nome']}}</label>
                        </li>
                    @endif
                @endforeach
            </ul>
            </div>
            @if ($selectedDocument != "")
                <div class="flex justify-end items-center mt-3">
                    <x-button >Assinar</x-button>  
                </div>
            @endif
        </x-ts-tab.items>
        <x-ts-tab.items tab="Em espera">
            <div class="{{ $divClass }}">
                <ul class="{{ $ulClass }}">
                @foreach ($documentos as $doc)
                    @if ($doc['status'] == "em espera")
                        <li class="{{ $liClass }} {{$doc['id'] == $selectedDocument ? 'bg-slate-300' : 'hover:bg-slate-100'}}">
                            <input type="radio" name="documento" id="{{$doc['id']}}" wire:model.live="selectedDocument" value="{{$doc['id']}}" class="hidden" >
                            <label class="absolute inset-0 cursor-pointer flex items-center pl-2" for="{{$doc['id']}}">{{$doc['nome']}}</label>
                        </li>
                    @endif
                @endforeach
            </ul>
            </div>
            
        </x-ts-tab.items>
        <x-ts-tab.items tab="Assinados">
            <div class="{{ $divClass }}">
                <ul class="{{ $ulClass }}">
                    @foreach ($documentos as $doc)
                        @if ($doc['status'] == "assinado")
                            <li class= "{{ $liClass }}  {{$doc['id'] == $selectedDocument ? 'bg-slate-300' : 'hover:bg-slate-100'}}">
                                <input type="radio" name="documento" id="{{$doc['id']}}" wire:model.live="selectedDocument" value="{{$doc['id']}}" class="hidden" >
                                <label class="absolute inset-0 cursor-pointer flex items-center pl-2" for="{{$doc['id']}}">{{$doc['nome']}}</label>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            
        </x-ts-tab.items>

    </x-ts-tab>
    @if($path)
        @php
            $filename = basename($path); 
        @endphp
        <iframe src="{{ route('documento.view', $filename) }}" width="100%" height="800px"></iframe>
        
    @endif
    
</div>
