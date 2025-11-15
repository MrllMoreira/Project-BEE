<div class="flex flex-col gap-5 p-2 overflow-y-auto ">
  <div class="flex flex-row justify-between items-end">
    <x-ts-select.styled id="status" :options="[5,10,20,50,100]" 
            label="Quantidade" wire:model.live="quantity" required>
    </x-ts-select.styled>
    <div class="relative rounded-md shadow-sm">
      <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none z-10">
          <svg class="h-5 w-5 text-gray-500 dark:text-dark-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
          </svg>
      </div>

      <div class="flex rounded-md ring-1 ring-gray-300 bg-white dark:bg-dark-800 dark:ring-dark-600">
          <x-ts-input
              class="w-full rounded-md border-0 bg-transparent py-1.5 pl-8 text-gray-600 placeholder:text-gray-400
                    focus:outline-none focus:ring-transparent sm:text-sm sm:leading-6"
                wire:model.live.debounce.500ms="search"
                placeholder="Procure por algo"
          />
      </div>
    </div>

  </div>

  <div class="overflow-hidden dark:ring-dark-600 rounded-lg shadow ring-1 ring-gray-300">
    <div class="relative soft-scrollbar overflow-auto">
        <svg
            class="text-amber-500 dark:text-dark-300 absolute bottom-0 left-0 right-0 top-0 m-auto grid h-10 w-10 animate-spin place-items-center"
            wire:loading="quantity,search"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                stroke-width="4"
            ></circle>
            <path
                class="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
            ></path>
        </svg>

        <table
            class="dark:divide-dark-500/50 min-w-full divide-y divide-gray-200"
            wire:loading.class="cursor-not-allowed select-none opacity-25"
        >
            <thead class="uppercase bg-gray-50 dark:bg-dark-600">
                <tr>
                    @foreach ($headers as $header)
                      <th scope="col"
                        class="dark:text-dark-200 px-3 py-3.5 text-left text-sm font-semibold text-gray-700 {{ $header['responsive'] ?? false ? 'hidden lg:table-cell' : '' }}">
                        {{$header['label']}}
                      </th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="dark:bg-dark-700 dark:divide-dark-500/20 divide-y divide-gray-200 bg-white">
              @foreach ($rows as $row )
                <tr>
                  @foreach ($headers as $header)
                    <td wire:click='dispatchOpenShowModal({{$row->id}})'
                        class="dark:text-dark-300 whitespace-nowrap px-3 py-4 text-sm text-gray-500 cursor-pointer {{ $header['responsive'] ?? false ? 'hidden lg:table-cell' : '' }}">
                        {{ data_get($row, $header['index']) }}
                        @if($header['index'] == 'actions')
                           
                            <div class="flex gap-2">
                                <x-ts-button icon="pencil" color="gray" outline sm />
                                <x-ts-button icon="trash" color="red" sm/>
                            </div>
                            
                        @endif
                    </td>
                  @endforeach
               
                </tr>
              @endforeach
            </tbody>
        </table>
        </div>
    </div>
{{-- Paginação --}}
    <div class="hidden sm:flex sm:items-center sm:justify-between">
    <div class="mr-4">
        <p class="text-sm leading-5 text-gray-700 dark:text-dark-300">
            Exibindo
            <span class="font-medium">{{ $rows->firstItem() }}</span>
            até
            <span class="font-medium">{{ $rows->lastItem() }}</span>
            de
            <span class="font-medium">{{ $rows->total() }}</span>
            resultados
        </p>
    </div>

    
    <div>
        <span class="relative z-0 inline-flex rounded-md shadow-sm">

            <!-- Anterior -->
            <button
                wire:click="previousPage('page')"
                @disabled($rows->onFirstPage())
                class="relative inline-flex items-center px-2 py-2 text-sm font-medium leading-5 
                       border rounded-l-md 
                       {{ $rows->onFirstPage() 
                            ? 'text-gray-300 bg-gray-100 cursor-default'
                            : 'cursor-pointer text-gray-600 bg-white hover:bg-gray-50' }}"
            >
                <svg class="w-5 h-5" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" />
                </svg>
            </button>

            <!-- Pages -->
            @foreach ($rows->getUrlRange(1, $rows->lastPage()) as $page => $url)
                @if ($page == $rows->currentPage())
                    <span
                        class="relative z-10 inline-flex items-center px-4 py-2 -ml-px 
                               text-sm font-bold 
                               bg-amber-100 dark:bg-dark-700 
                               text-amber-700 dark:text-dark-300 
                               border border-amber-300 dark:border-transparent">
                        {{ $page }}
                    </span>
                @else
                    <button
                        wire:click="gotoPage({{ $page }}, 'page')"
                        class="relative inline-flex items-center px-4 py-2 -ml-px 
                               text-sm font-medium text-gray-600 bg-white 
                               border border-gray-300 dark:bg-dark-600 dark:text-dark-400 
                               cursor-pointer hover:bg-gray-50">
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            <!-- Próximo -->
            <button
                wire:click="nextPage('page')"
                @disabled(! $rows->hasMorePages())
                class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium leading-5 
                       border rounded-r-md
                       {{ $rows->hasMorePages() 
                            ? 'cursor-pointer text-gray-500 bg-white hover:bg-gray-50' 
                            : 'cursor-default text-gray-300 bg-gray-100' }}"
            >
                <svg class="w-5 h-5" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" />
                </svg>
            </button>

        </span>
    </div>
</div>
</div>