<div class="flex flex-col gap-5 p-2 overflow-y-auto">

    <div class="flex flex-row items-end justify-between">

        <x-ts-select.styled id="status" class="!text-red-500"
            :options="[5,10,20,50,100]"
            label="Quantidade" wire:model.live="quantity" required>
        </x-ts-select.styled>

        <div class="relative rounded-md shadow-sm">

          <div class="absolute inset-y-0 left-0 z-10 flex items-center pl-2 pointer-events-none">
              <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  fill="currentColor">
                  <path fill-rule="evenodd"
                      d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                      clip-rule="evenodd" />
              </svg>
          </div>

          <div class="flex rounded-md ring-1 ring-[var(--border-gray-200)] bg-[var(--white)]">
              <x-ts-input
                  class="w-full rounded-md border-0 bg-transparent py-1.5 pl-8 text-[var(--text)] placeholder:text-gray-400
                      focus:outline-none focus:ring-transparent sm:text-sm sm:leading-6"
                  wire:model.live.debounce.500ms="search"
                  placeholder="Procure por algo"
              />
          </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg shadow ring-1 table-wrapper">

        <div class="relative overflow-auto soft-scrollbar">
            <svg
                class="absolute top-0 bottom-0 left-0 right-0 grid w-10 h-10 m-auto text-amber-500 animate-spin place-items-center"
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
                class="min-w-full divide-y"
                wire:loading.class="opacity-25 cursor-not-allowed select-none"
            >
                <thead class="uppercase">
                    <tr>
                        @foreach ($headers as $header)
                        <th scope="col"
                            class="px-3 py-3.5 text-left text-sm font-semibold {{ $header['responsive'] ?? false ? 'hidden lg:table-cell' : '' }}">
                            {{ $header['label'] }}
                        </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y">
                  @foreach ($rows as $row)
                    <tr>
                      @foreach ($headers as $header)

                        @if($header['index'] == 'actions')
                            <td class="px-3 py-4">
                                <div class="flex gap-2">
                                    <x-ts-button wire:click='dispatchOpenEditModal({{$row->id}})' icon="pencil" color="gray" outline sm />
                                    <x-ts-button wire:click='dispatchOpenDeleteModal({{$row->id}})' icon="trash" color="red" sm/>
                                </div>
                            </td>
                        @else
                            <td wire:click='dispatchOpenShowInfos({{$row->id}})'
                                class="whitespace-nowrap px-3 py-4 text-sm cursor-pointer {{ $header['responsive'] ?? false ? 'hidden lg:table-cell' : '' }}">
                                {{ data_get($row, $header['index']) }}
                            </td>
                        @endif

                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginação --}}
    <div class="hidden mt-3 sm:flex sm:items-center sm:justify-between">

      <div class="mr-4 text-sm text-[var(--text)]">
          Exibindo
          <span class="font-medium">{{ $rows->firstItem() }}</span>
          até
          <span class="font-medium">{{ $rows->lastItem() }}</span>
          de
          <span class="font-medium">{{ $rows->total() }}</span>
          resultados
      </div>

      <div>
          <span class="relative z-0 inline-flex rounded-md shadow-sm">

              <!-- Anterior -->
              <button
                  wire:click="previousPage('page')"
                  @disabled($rows->onFirstPage())
                  class="relative inline-flex items-center px-2 py-2 text-sm font-medium border
                         {{ $rows->onFirstPage()
                              ? 'text-gray-300 bg-[var(--gray-100)] cursor-default'
                              : 'cursor-pointer text-[var(--text)] bg-[var(--white)] hover:bg-[var(--gray-100)]' }}"
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
                          class="relative z-10 inline-flex items-center px-4 py-2 -ml-px text-sm font-bold border bg-amber-100 text-amber-700 border-amber-300">
                          {{ $page }}
                      </span>
                  @else
                      <button
                          wire:click="gotoPage({{ $page }}, 'page')"
                          class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium
                                 cursor-pointer bg-[var(--white)] text-[var(--text)] border border-[var(--border-gray-200)]
                                 hover:bg-[var(--gray-100)]">
                          {{ $page }}
                      </button>
                  @endif
              @endforeach

              <!-- Próximo -->
              <button
                  wire:click="nextPage('page')"
                  @disabled(! $rows->hasMorePages())
                  class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium border
                         {{ $rows->hasMorePages()
                              ? 'cursor-pointer text-[var(--text)] bg-[var(--white)] hover:bg-[var(--gray-100)]'
                              : 'cursor-default text-gray-300 bg-[var(--gray-100)]' }}"
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
