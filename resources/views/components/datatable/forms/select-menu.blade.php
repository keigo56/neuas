@props([
    'type' => 'single', // single, multiple
    'key' => '',
    'items' => [],
    'width' => 'auto',
    'selectedItem' => '',
    'selectedItems' => [],
    'withSearch' => true,
    'model' => '',
    'livewireComponentId' => ''
])
@php

    $selectedValue = '';

    if($selectedItem !== ''){

        foreach ($items as $item){
            if($item['key'] === $selectedItem) $selectedValue = $item['value'];
        }

        $mappedItems = collect($items)->mapWithKeys(fn($item) => [ $item['key'] => $item ])->toArray();
        $item = $mappedItems[$selectedItem];
    }

@endphp
<div
    wire:key="{{ $key }}"
    id="{{ $key }}"
    x-data="{
              opened : false ,
              items : @js($items),
              search : '',
              selectAll : false,
              @if($type === 'single') selectedItemKey : @entangle($model), @endif
    @if($type === 'multiple') selectedItems : @entangle($model).defer, @endif
    @if($type === 'single') get selectedItem() { return this.items.filter((el) => el.key === this.selectedItemKey)[0] }, @endif
        get filteredItems(){
          let search = this.search
          return this.items.filter(function(el) {
              return el.value.toLowerCase().indexOf(search.toLowerCase()) !== -1
          })
        },
        toggleSelectAll(checked){
          if(checked){
              this.selectedItems = this.filteredItems.map((el) => el.key);
          }else{
              this.selectedItems = [];
          }
        }
}"
    x-init="$watch('selectAll', (value) =>{ toggleSelectAll(value) }); $watch('selectedItems', (value) => { if(filteredItems.map((el) => el.key ).sort().join(',') === value.map(el => el).sort().join(',')) { selectAll = true } else if (value.length === 0) { selectAll = false } } )"
    @keydown.esc.window="opened = false"
    style="width: {{ $width }}"
>
    <div class="relative">
        {{--  DROPDOWN BUTTON  --}}
        <button type="button"
                class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-brand focus:border-brand-dark sm:text-sm"
                @click="opened = !opened"
        >
            {{--  SELECTED ITEM  --}}
            <div class="flex items-center">
                <div class="block truncate">
                    @if($type === 'single')
                        <div x-text="selectedItem?.value"></div>
                    @else
                        <div x-text="selectedItems.length"></div>
                    @endif
                </div>
            </div>

            <div class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20"
                     fill="currentColor"
                     aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </button>

        {{-- DROPDOWN PANEL --}}
        <ul class="absolute z-20 mt-2 w-full bg-white shadow-lg max-h-56 rounded-md py-2 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
            role="listbox"
            tabindex="-1"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
            x-show="opened"
            @click.away="opened = false"
        >
            @if($withSearch)
                <div class="relative px-3 py-2">
                    <x-datatable.icons.search class="h-5 w-3.5 absolute text-gray-500 top-4 left-5"/>
                    <input type="text"
                           class="py-1.5 pl-6 w-full text-sm rounded-md focus:ring-brand focus:border-brand border-gray-300"
                           placeholder="Search..."
                           x-model.lazy="search"
                    >
                </div>
            @endif

            @if($type === 'single')
                <template x-for="item in filteredItems" :key="item.key">
                    <div class="group">
                        <li class="relative text-gray-900 cursor-default select-none relative py-1 pl-3 group-hover:bg-brand group-hover:text-white"
                            role="option"
                            x-on:click="selectedItem = item; selectedItemKey = item.key"
                        >
                            <div class="flex items-center">
                                <label class="flex items-center block truncate py-1 pl-1 w-full">
                                    <div class="block text-sm"
                                         x-bind:class="selectedItem?.key === item.key? 'font-bold' : ''"
                                         x-bind:title="item['value']">

                                        <template x-if="item['value'] === ''">
                                            <div>(Blank)</div>
                                        </template>

                                        <template x-if="item['value'] !== ''">
                                            <div x-text="item['value']"></div>
                                        </template>

                                    </div>
                                </label>
                            </div>

                            <template x-if="selectedItem?.key === item.key">
                                <div class="text-brand group-hover:text-white absolute inset-y-0 right-0 flex items-center pr-4">
                                    <!-- Heroicon name: solid/check -->
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </template>

                        </li>
                    </div>
                </template>
            @else
                <template x-for="item in filteredItems" :key="item.key">
                    <li class="text-gray-900 cursor-default select-none relative pl-2 pr-9 border-l-2 border-l-brand border-opacity-0 hover:border-opacity-100 hover:bg-gray-100 "
                        role="option">
                        <div class="flex items-center">
                            <label class="flex items-center block truncate py-2 pl-1 w-full">
                                <x-datatable.forms.checkbox
                                    class="mr-2"
                                    x-model="selectedItems"
                                    x-bind:value="item.key"
                                    is-checked
                                    x-not-click-away
                                />
                                <div class="block truncate text-xsm"
                                     x-bind:title="item['value']"
                                     x-text="item['value']"
                                >
                                </div>
                            </label>
                        </div>
                    </li>
                </template>
                <li class="px-2 pt-3 pb-2 border-t">
                    <div class="pl-1.5 flex justify-between items-center">
                        <div>
                            <label class="text-xsm text-gray-900 flex justify-center items-center">
                                <x-datatable.forms.checkbox
                                    class="mr-2"
                                    x-model="selectAll"
                                />
                                Select All
                            </label>
                        </div>
                        <div class="flex items-center justify-end">
                            <button
                                class="mr-2 px-3 py-1.5 text-xs rounded-md inline-block bg-white border hover:bg-gray-100 hover:text-brand focus:outline-none focus:ring-2 focus:ring-gray-200">
                                Reset
                            </button>
                            <button
                                class="px-3 py-1.5 text-xs rounded-md font-medium inline-block bg-brand text-white border hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-light">
                                Apply
                            </button>
                        </div>
                    </div>
                </li>
            @endif

            <template x-if="filteredItems.length === 0">
                <li class="relative text-gray-900 cursor-default select-none relative py-1 pl-3 hover:bg-gray-700 hover:text-white"
                    role="option"
                >
                    <div class="flex items-center">
                        <label class="flex items-center block truncate py-2 pl-1 w-full">
                            <div class="block truncate text-xsm">No items.</div>
                        </label>
                    </div>
                </li>
            </template>

        </ul>
    </div>
</div>
