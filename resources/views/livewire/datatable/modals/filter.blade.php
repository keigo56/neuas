<x-datatable.overlays.modal modal-id="filter-modal">
    <x-slot name="title">Filter {{ $title }}</x-slot>
    <x-slot name="body">
        <table class="hidden md:block w-full">
            <thead>
            <tr>
                <th class="p-1 text-sm font-semibold">Column</th>
                <th class="p-1 text-sm font-semibold">Condition</th>
                <th class="p-1 text-sm font-semibold">Value</th>
            </tr>
            </thead>
            <tbody>

            @foreach($tempFilters as $index => $filter)

                @if($index !== 0)
                    <tr>
                        <td colspan="4"
                            class="py-5">
                            <div class="bg-gray-200 h-0.5 w-full flex justify-center items-center">
                                <select wire:model.defer="tempFilters.{{ $index }}.logical_expression"
                                        class="pr-8 py-1 text-sm border-1 border-gray-400 rounded-md focus:outline-none focus:ring-gray-400 focus:border-gray-400">
                                    <option value="and">And</option>
                                    <option value="or">Or</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                @endif

                <tr wire:key="filter-{{ $index }}">
                    <td class="p-1">
                        <x-datatable.forms.select-menu
                            key="filter-{{ $index }}-field-{{ $filter['field'] }}"
                            :items="$this->getColumnsForSelect()"
                            selectedItem="{{ $filter['field'] }}"
                            width="285px"
                            model="tempFilters.{{ $index }}.field"
                        />
                    </td>
                    <td class="p-1">
                        <x-datatable.forms.select-menu
                            livewire-component-id="{{ \Illuminate\Support\Str::singular($this->title) }}-datatable"
                            key="filter-{{ $index }}-condition-{{ $filter['field'] }}-{{ $filter['condition'] }}"
                            :items="$this->getFilters($filter['field'])"
                            selectedItem="{{ $filter['condition'] }}"
                            width="285px"
                            model="tempFilters.{{ $index }}.condition"
                        />
                    </td>
                    <td class="p-1 w-96">
                        @if($this->getDatatype($filter['field']) === 'enum' && ($tempFilters[$index]['condition'] === 'in' || $tempFilters[$index]['condition'] === 'not_in'))

                            <x-datatable.forms.select-menu
                                type="multiple"
                                livewire-component-id="{{ \Illuminate\Support\Str::singular($this->title) }}-datatable"
                                key="filter-{{ $index }}-value-{{ $filter['field'] }}"
                                :items="$this->getEnumItems($filter['field'])"
                                :selectedItems="$filter['items']"
                                width="auto"
                                model="tempFilters.{{ $index }}.items"
                                class="px-3"
                                placeholder="Search value..."
                                required
                            />
                        @else

                            @if($this->getDatatype($filter['field']) === 'date')
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="date"
                                    min="1900-01-01"
                                    max="9999-12-31"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @elseif($this->getDatatype($filter['field']) === 'datetime')
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="datetime-local"
                                    min="1900-01-01T00:00"
                                    max="9999-12-31T23:59"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @elseif($this->getDatatype($filter['field']) === 'numeric')
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="number"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @else
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="text"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @endif

                        @endif
                    </td>
                    <td class="px-2">
                        <a role="button"
                           wire:click="deleteFilter({{ $index }})"
                           class="p-2 text-gray-400 hover:text-gray-700">
                            <x-datatable.icons.trash class="h-5 w-5"/>
                        </a>
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4"
                    class="py-5">
                    <div class="bg-gray-200 h-0.5 w-full flex justify-center items-center">
                        <button wire:click="addFilter"
                                class="px-2 py-2 text-xsm rounded-md font-medium inline-block bg-brand text-white border hover:bg-brand-dark focus:outline-none focus:ring-2 focus:ring-brand-light">
                            Add Filter
                        </button>
                    </div>
                </td>
            </tr>

            </tbody>

        </table>

        <div class="md:hidden">
            @foreach($tempFilters as $index => $filter)
                @if($index !== 0)
                    <div class="bg-gray-200 h-0.5 w-full flex justify-center items-center">
                        <select wire:model.defer="tempFilters.{{ $index }}.logical_expression"
                                class="pr-8 py-1 text-sm border-1 border-gray-400 rounded-md focus:outline-none focus:ring-gray-400 focus:border-gray-400">
                            <option value="and">And</option>
                            <option value="or">Or</option>
                        </select>
                    </div>
                @endif

                <div wire:key="filter-{{ $index }}">
                    <div class="mb-3">
                        <label class="text-sm mb-2">Column</label>
                        <x-datatable.forms.select-menu
                            key="filter-{{ $index }}-field-{{ $filter['field'] }}"
                            :items="$this->getColumnsForSelect()"
                            selectedItem="{{ $filter['field'] }}"
                            width="285px"
                            model="tempFilters.{{ $index }}.field"
                        />
                    </div>
                    <div class="mb-3">
                        <label class="text-sm mb-2">Condition</label>
                        <x-datatable.forms.select-menu
                            livewire-component-id="{{ \Illuminate\Support\Str::singular($this->title) }}-datatable"
                            key="filter-{{ $index }}-condition-{{ $filter['field'] }}-{{ $filter['condition'] }}"
                            :items="$this->getFilters($filter['field'])"
                            selectedItem="{{ $filter['condition'] }}"
                            width="285px"
                            model="tempFilters.{{ $index }}.condition"
                        />
                    </div>
                    <div class="mb-3">
                        <label class="text-sm mb-2">Value</label>
                        @if($this->getDatatype($filter['field']) === 'enum' && ($tempFilters[$index]['condition'] === 'in' || $tempFilters[$index]['condition'] === 'not_in'))

                            <x-datatable.forms.select-menu
                                type="multiple"
                                livewire-component-id="{{ \Illuminate\Support\Str::singular($this->title) }}-datatable"
                                key="filter-{{ $index }}-value-{{ $filter['field'] }}"
                                :items="$this->getEnumItems($filter['field'])"
                                :selectedItems="$filter['items']"
                                width="auto"
                                model="tempFilters.{{ $index }}.items"
                                class="px-3"
                                placeholder="Search value..."
                                required
                            />
                        @else

                            @if($this->getDatatype($filter['field']) === 'date')
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="date"
                                    min="1900-01-01"
                                    max="9999-12-31"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @elseif($this->getDatatype($filter['field']) === 'datetime')
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="datetime-local"
                                    min="1900-01-01T00:00"
                                    max="9999-12-31T23:59"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @elseif($this->getDatatype($filter['field']) === 'numeric')
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="number"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @else
                                <x-datatable.forms.input
                                    wire:key="{{ 'filter-value-' . $index . $filter['field'] }}"
                                    wire:model.defer="tempFilters.{{ $index }}.value"
                                    type="text"
                                    class="px-3"
                                    placeholder="Search value..."
                                    required
                                />
                            @endif

                        @endif
                    </div>
                </div>
            @endforeach
        </div>

    </x-slot>
    <x-slot name="footer">
        <div class="flex flex-col-reverse md:flex-row sm:justify-between">
            <x-datatable.elements.button wire:click="resetFilter"
                    type="button"
                    class="mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                Reset Filters
            </x-datatable.elements.button>
            <div class="flex flex-col-reverse md:flex-row ">
                <x-datatable.elements.button @click="$dispatch('toggle-filter-modal')"
                        type="button"
                        class="mr:0 md:mr-2 mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    Cancel
                </x-datatable.elements.button>
                <x-datatable.elements.button
                        wire:click="applyFilter"
                        class="mt-2 md:mt-0 px-3 py-2 bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                    Apply Filters
                </x-datatable.elements.button>
            </div>
        </div>
    </x-slot>
</x-datatable.overlays.modal>
