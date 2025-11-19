<div>
    @php
        $isActiveDashboard = request()->routeIs('dashboard');
        $isActiveDocumentos = request()->routeIs('documentos');
        $isActiveInventario = request()->routeIs('inventario')
            && request()->route('id') == Auth::user()->unidade_id;
        $isActiveUnidade = request()->routeIs('unidade');
        $isActiveUsuario = request()->routeIs('usuario');

        $aClass = "flex items-center gap-3 px-4 py-2 text-sm font-semibold rounded-xl
                   transition-all duration-300 cursor-pointer";
        $activeClass = "bg-[#273333] text-[#FDC029]";
        $hoverClass = "hover:bg-[#273333] hover:text-[#FDC029]";
    @endphp


    <nav class="w-[200px] bg-white border-r border-gray-200  shadow-sm">

        <div class="h-screen bg-[#F9F9F9] p-6 ">

            <!-- LOGO -->
            <div class="flex justify-center mb-10">
                <img class="rounded-full w-[66px] h-[66px]" src="{{ asset('storage/img logo.png') }}">
            </div>

            <!-- SEARCH -->
            <x-ts-input
                class="text-sm border-gray-300 rounded-lg shadow-sm h-9 focus:ring-gray-300"
                placeholder="Pesquisar..."
            ></x-ts-input>

            <!-- MENU TITLE -->
            <h4 class="mt-10 mb-3 text-xs font-semibold tracking-wide text-gray-500 uppercase">
                Menu
            </h4>

            <!-- NAV LINKS -->
            <div class="flex flex-col gap-3 text-sm">

                <a href="{{ route('dashboard') }}"
                   class="{{ $aClass }} {{ $hoverClass }}
                          {{ $isActiveDashboard ? $activeClass : 'text-gray-700' }}">
                    <x-ts-icon class="w-5 h-5" icon="chart-pie" outline/>
                    Dashboard
                </a>

                <a href="{{ route('documentos') }}"
                   class="{{ $aClass }} {{ $hoverClass }}
                          {{ $isActiveDocumentos ? $activeClass : 'text-gray-700' }}">
                    <x-ts-icon class="w-5 h-5" icon="document" outline/>
                    Documentos
                </a>

                <a href="{{ route('inventario', Auth::user()->unidade_id) }}"
                   class="{{ $aClass }} {{ $hoverClass }}
                          {{ $isActiveInventario ? $activeClass : 'text-gray-700' }}">
                    <x-ts-icon class="w-5 h-5" icon="inbox-arrow-down" outline/>
                    Inventário
                </a>

                @if (Auth::user()->roles_id == 3 || Auth::user()->roles_id == 1)
                    <a href="{{ route('unidade') }}"
                       class="{{ $aClass }} {{ $hoverClass }}
                              {{ $isActiveUnidade ? $activeClass : 'text-gray-700' }}">
                        <x-ts-icon class="w-5 h-5" icon="user" outline/>
                        Unidades
                    </a>
                @endif

                @if (Auth::user()->roles_id == 1)
                    <a href="{{ route('usuario') }}"
                       class="{{ $aClass }} {{ $hoverClass }}
                              {{ $isActiveUsuario ? $activeClass : 'text-gray-700' }}">
                        <x-ts-icon class="w-5 h-5" icon="user" outline/>
                        Usuários
                    </a>
                @endif

            </div>
        </div>

    </nav>
</div>
