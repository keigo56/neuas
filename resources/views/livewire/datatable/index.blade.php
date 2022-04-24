<div class="md:border md:rounded pt-6 pb-4 md:shadow-md min-w-full font-inter bg-white custom-scrollbar"
     x-data="{
       delete_notification_show: false
     }"
     id="{{ \Illuminate\Support\Str::singular($this->title) }}-datatable"
>
    <div class="px-2 md:px-6">
        <div class="flex justify-between pb-4 border-b">
            <h1 class="text-3xl font-semibold text-gray-900">{{ $title }}</h1>
            <div class="flex space-x-1.5">

                @if($this->withImport)
                    <x-datatable.elements.button class="mt-2 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                        <div class="flex justify-between items-center">
                            <x-datatable.icons.import class="h-5 w-5 mr-2"/>
                            <div class="text-xsm">
                                Import {{ $title }}
                            </div>
                        </div>
                    </x-datatable.elements.button>
                @endif

                @if($this->canCreateRecord)
                    <x-datatable.elements.button
                        wire:click="createRecord"
                        class="mr-2 mt-2 px-3 py-2 bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                        <div class="flex justify-between items-center">
                            <x-datatable.icons.plus class="h-5 w-5 mr-2"/>
                            <div class="text-xsm">
                               New {{ Str::singular($title) }}
                            </div>
                        </div>
                    </x-datatable.elements.button>
                @endif
            </div>
        </div>

        @if(!$this->isBaseTable())
            <div class="flex items-center justify-between border-b">
                <div class="py-3 flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-2 justify-center w-full md:w-auto">

                        @if($this->canSearchRows)
                            <label class="relative w-full md:w-auto">
                                <x-datatable.icons.search class="h-4 w-4 absolute top-3 left-3 text-gray-600"/>
                                <x-datatable.forms.input
                                       wire:model.lazy="search"
                                       class="md:w-96 pl-8 pr-2 text-sm"
                                       placeholder="Search {{ $title }}..."
                                />
                            </label>
                        @endif

                        @if($this->withFilters)
                            <x-datatable.elements.button-menu
                                class="px-3 py-1.5 border-gray-300 text-gray-700"
                                @click="$dispatch('toggle-filter-modal')"
                            >
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-xs">Filter</span>
                                    <x-datatable.icons.filter class="ml-2 h-3.5 w-3.5"/>
                                </div>
                            </x-datatable.elements.button-menu>
                        @endif

                        <div class="relative text-left" x-data="{ open: false }">
                            <div>
                                <x-datatable.elements.button-menu
                                        class="px-3 py-1.5 border-gray-300 text-gray-700"
                                        aria-haspopup="true"
                                        x-on:click="open = true"
                                >
                                    <div class="flex justify-between items-center">
                                        <span class="font-semibold text-xs">More Options</span>
                                        <svg class="ml-2 h-3.5 w-3.5"
                                             xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20"
                                             fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </x-datatable.elements.button-menu>
                            </div>

                            <div class="origin-top-left absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                                 role="menu"
                                 aria-orientation="vertical"
                                 aria-labelledby="menu-button"
                                 tabindex="-1"
                                 x-show="open"
                                 x-on:click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                            >
                                <div class="py-1"
                                     role="none">

                                    <div class="px-4 py-2 pb-2 text-xs font-semibold">Manage</div>

                                    @if($this->withColumnVisibility)
                                        <a href="#"
                                           class="text-gray-700 block px-4 py-1.5 text-xs hover:bg-gray-100 flex items-center justify-between"
                                           role="menuitem"
                                           tabindex="-1"
                                           id="menu-item-column-visibility"
                                           @click="$dispatch('toggle-export-modal')"
                                        >
                                            <div>
                                                Columns
                                            </div>
                                            <div>
                                                <x-datatable.icons.columns class="w-4 h-4"/>
                                            </div>
                                        </a>
                                    @endif

                                    @if($this->withImport)
                                        <a href="#"
                                           class="text-gray-700 block px-4 py-1.5 text-xs hover:bg-gray-100 flex items-center justify-between"
                                           role="menuitem"
                                           tabindex="-1"
                                           id="menu-item-column-imports"
                                        >
                                            <div>
                                                Imports
                                            </div>
                                            <div>
                                                <x-datatable.icons.import class="w-4 h-4"/>
                                            </div>
                                        </a>
                                    @endif

                                    <a href="#"
                                       class="text-gray-700 block px-4 py-1.5 text-xs hover:bg-gray-100 flex items-center justify-between"
                                       role="menuitem"
                                       tabindex="-1"
                                       id="menu-item-column-export"
                                    >
                                        <div>
                                            Exports
                                        </div>
                                        <div>
                                            <x-datatable.icons.export class="w-4 h-4"/>
                                        </div>
                                    </a>

                                    <div class="border-b mt-2"></div>
                                    <div class="px-4 py-2 pb-2 text-xs font-semibold">View</div>

                                    <a href="#"
                                       class="text-gray-700 block px-4 py-1.5 text-xs hover:bg-gray-100 flex items-center justify-between"
                                       role="menuitem"
                                       tabindex="-1"
                                       id="menu-item-column-export"
                                    >
                                        <div>
                                            Trash
                                        </div>
                                        <div>
                                            <x-datatable.icons.trash class="w-4 h-4"/>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($this->withBulkActions)
                    <div class="flex justify-end">
                        <div class="flex items-center space-x-2">
                            @if(count($this->selectedIDS) > 0 || $this->selectAll)
                                <x-datatable.elements.button-menu
                                    class="px-3 py-1.5 border-gray-300 text-gray-700"
                                    @click="$dispatch('toggle-export-modal')"
                                >
                                    <div class="flex items-center justify-center">
                                        <span class="font-semibold text-xs">Export</span>
                                        <x-datatable.icons.export class="ml-2 h-3.5 w-3.5"/>
                                    </div>
                                </x-datatable.elements.button-menu>

                                <x-datatable.elements.button-menu
                                    class="px-3 py-1.5 border-red-700 text-red-700"
                                    @click="$dispatch('toggle-delete-modal')"
                                >
                                    <div class="flex items-center justify-center">
                                        <span class="font-semibold text-xs">Delete</span>
                                        <x-datatable.icons.trash class="ml-2 h-3.5 w-3.5"/>
                                    </div>
                                </x-datatable.elements.button-menu>

                                <div class="relative text-left" x-data="{ open: false }">
                                    <div>
                                        <x-datatable.elements.button-menu
                                            class="px-3 py-1.5 border-gray-300 text-gray-700"
                                            x-on:click="open = true"
                                        >
                                            <div class="flex items-center justify-center">
                                                <span class="font-semibold text-xs">More Actions</span>
                                                <svg class="ml-2 h-3.5 w-3.5"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20"
                                                     fill="currentColor"
                                                     aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        </x-datatable.elements.button-menu>
                                    </div>

                                    <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                                         role="menu"
                                         aria-orientation="vertical"
                                         aria-labelledby="menu-button"
                                         tabindex="-1"
                                         x-show="open"
                                         x-on:click.away="open = false"
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"
                                    >
                                        <div class="py-1"
                                             role="none">
                                            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                            <a href="#"
                                               class="text-gray-700 block px-4 py-1.5 text-xs hover:bg-gray-100 flex items-center justify-between"
                                               role="menuitem"
                                               tabindex="-1"
                                               id="menu-item-0"
                                            >
                                                <div>
                                                    Copy to Clipboard
                                                </div>
                                                <div>
                                                    <x-datatable.icons.clipboard class="w-4 h-4"/>
                                                </div>
                                            </a>
                                            <a href="#"
                                               class="text-gray-700 block px-4 py-1.5 text-xs hover:bg-gray-100 flex items-center justify-between"
                                               role="menuitem"
                                               tabindex="-1"
                                               id="menu-item-1"
                                            >
                                                <div>
                                                    Mark as Completed
                                                </div>
                                                <div>
                                                    <x-datatable.icons.check class="w-4 h-4"/>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div></div>
                @endif
            </div>
        @endif

        @if($this->withFilters)
            @if($isFiltered)
                <div class="flex flex-wrap py-2 border-b ">
                    @foreach($filters as $index => $filter)
                        <div class="mb-2 md:mb-0 px-3 py-2 mr-2 border border-brand-semi-light bg-brand-lightest hover:bg-brand-semi-light text-brand text-xs font-semibold rounded-full flex items-center justify-center">
                            <span class="mr-2"> {{ $this->getFilterTranslation($filter, $index) }} </span>
                            <button wire:click="deleteFilter({{ $index }})"
                                    class="bg-brand rounded-full p-0.5">
                                <x-datatable.icons.x class="h-3 w-3 text-white"/>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

        <div>
            @if(count($this->selectedIDS) > 0)
                <div class="mt-2 px-3 py-2 bg-sky-100 rounded-md">
                    @if($selectPage)
                        @if(!$selectAll)
                            <div class="flex justify-center items-center">
                                <div class="flex items-center">
                                    <p class="text-xs font-semibold">All <strong>{{ $rows->count() }}</strong> records on this page are selected.</p>
                                    <a wire:click="$set('selectAll', true)"
                                       role="button"
                                       class="py-1 px-2 rounded hover:bg-sky-50 ml-3 text-xsm font-semibold text-sky-500 ">
                                        Select All {{ number_format($rows->total()) }} records
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center justify-center">
                                <p class="text-sky-900 font-semibold text-xs">
                                    All {{ number_format($rows->total()) }} {{ $rows->total() > 1 ? 'records' : 'record' }} selected
                                </p>
                                <a wire:click="resetSelected"
                                   role="button"
                                   class="py-1 px-2 rounded hover:bg-sky-50 ml-3 text-xsm font-semibold text-sky-500 ">
                                    Clear Selection
                                </a>
                            </div>
                        @endif

                    @else

                        <div class="flex justify-center items-center">
                            <p class="text-sky-900 font-semibold text-xs">
                                {{ count($this->selectedIDS) }} {{ count($this->selectedIDS) > 1 ? 'records' : 'record' }} selected
                            </p>

                            <a wire:click="resetSelected"
                               role="button"
                               class="py-1 px-2 rounded hover:bg-sky-50 ml-3 text-xsm font-semibold text-sky-500 ">
                                Clear Selection
                            </a>
                        </div>

                    @endif
                </div>
            @endif
        </div>

    </div>
    <div wire:loading.delay.longest
         class="slider inline-block -top-3">
        <div class="line"></div>
        <div class="sub-line inc"></div>
        <div class="sub-line dec"></div>
    </div>
    <div class="relative">
        <div wire:loading.delay.longest
             class="absolute w-full h-full bg-gray-50 opacity-30"></div>
        <div class="overflow-x-auto overflow-y-hidden w-full"
             id="{{ Str::slug($title) }}-table-wrapper">
            <table id="{{ Str::slug($title) }}-table"
                   class="table table-sm"
                   datatable="true">
                <thead>
                <tr>

                    @if($this->withBulkActions)
                        <x-datatable.lists.table.th class="w-4">
                            <x-datatable.forms.checkbox
                                wire:model="selectPage"
                            />
                        </x-datatable.lists.table.th>
                    @endif

                    @foreach($columns as $column)
                        @if($column->isVisible())
                            @if($this->canSortColumns)
                                <x-datatable.lists.table.th class="column"
                                            :sortable="$column->isSortable()"
                                            :field="$column->getField()"
                                            :sortField="$sortField"
                                            :sortDirection="$sortDirection"
                                            :textAlign="$column->getTextAlign()">
                                    {{ $column->getDisplayName() }}
                                </x-datatable.lists.table.th>
                            @else
                                <x-datatable.lists.table.th class="column"
                                            :textAlign="$column->getTextAlign()">
                                    {{ $column->getDisplayName() }}
                                </x-datatable.lists.table.th>
                            @endif
                        @endif
                    @endforeach
                    @if($this->withItemActions)
                        <x-datatable.lists.table.th class="w-4 right-0 sticky bg-white"></x-datatable.lists.table.th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $index => $row)
                    <tr wire:key="row-{{ $index }}"
                        class="@if(in_array($this->getRowKey($row), $this->selectedIDS)) bg-blue-50 @endif hover:bg-gray-100">
                        @if($this->withBulkActions)
                            <x-datatable.lists.table.td class="checkbox">
                                <x-datatable.forms.checkbox
                                    wire:model="selectedIDS"
                                    value="{{ $this->getRowKey($row) }}"
                                />
                            </x-datatable.lists.table.td>
                        @endif

                        @foreach($columns as $column)
                            @if($column->isVisible())
                                <x-datatable.lists.table.td
                                    :sortable="$column->isSortable()"
                                    :field="$column->getField()"
                                    :sortField="$sortField"
                                    :sortDirection="$sortDirection"
                                    :textAlign="$column->getTextAlign()"
                                    title="{{ $this->getColumnData($row, $column) }}"
                                >
                                    {!! $this->formatColumnData($this->getColumnData($row, $column), $column) !!}
                                </x-datatable.lists.table.td>
                            @endif
                        @endforeach

                        @if($this->withItemActions)
                            <td class="right-0 absolute bg-white py-0.5"
                                x-data="{ open: false }"
                                x-on:click.away="open = false">
                                <div class="relative w-full bg-white">
                                    <div class="flex items-center justify-center cursor-pointer">
                                        <x-datatable.icons.v-dots class="h-4 w-4"
                                                        x-on:click="open = !open"/>
                                    </div>
                                    <div x-show="open"

                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="transform opacity-0 scale-95"
                                         x-transition:enter-end="transform opacity-100 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="transform opacity-100 scale-100"
                                         x-transition:leave-end="transform opacity-0 scale-95"

                                         class="z-20 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                         role="menu"
                                         aria-orientation="vertical"
                                         aria-labelledby="menu-button"
                                         tabindex="-1">
                                        <div class="py-1 text-xs cursor-pointer"
                                             role="none">
                                            @forelse($this->itemActions() as $index => $item)
                                                @if($this->getItemAction($index)->isAllowed() && $this->allowItemActionIf($this->getItemAction($index), $row ))
                                                    <div wire:key="row-{{ $this->getRowKey($row) }}-item-action-{{ $index }}"
                                                         wire:click="{{ $this->getItemAction($index)->getMethod() }}('{{ $this->getRowKey($row) }}')"
                                                         class="{{ $this->getItemAction($index)->getClass() ?? 'text-gray-700' }} hover:bg-gray-100 flex items-center justify-between px-4 py-2"
                                                         role="menuitem"
                                                         tabindex="-1"
                                                         id="menu-item-0">
                                                        {{ $this->getItemAction($index)->getText() }}
                                                        @if($this->getItemAction($index)->getIcon() !== null)
                                                            {!!  Blade::render('<x-datatable.icons.' . $this->getItemAction($index)->getIcon() . ' class="w-4 h-4" />') !!}
                                                        @endif
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="flex items-center justify-center py-4">
                                                    No Item Actions
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @endif

                    </tr>
                @endforeach

                @if($this->withFooter && $rows->total() > 0)
                    <tr class="bg-gray-100">
                        <x-datatable.lists.table.td/>
                        @foreach($columns as $column)
                            @if($column->isVisible())
                                <x-datatable.lists.table.td
                                    :sortable="$column->isSortable()"
                                    :field="$column->getField()"
                                    :sortField="$sortField"
                                    :sortDirection="$sortDirection"
                                    :textAlign="$column->getTextAlign()"
                                >
                                    {!! $this->formatFooterColumn($this->getFooterData($column), $column) !!}
                                </x-datatable.lists.table.td>
                            @endif
                        @endforeach
                        <x-datatable.lists.table.td/>
                    </tr>
                @endif
                </tbody>
            </table>
            @if($rows->total()  === 0)
                <div class="flex flex-col justify-center items-center py-20">
                    <x-datatable.icons.files class="h-8 w-8 text-gray-700"/>
                    <div class="text-sm text-gray-700 mt-4">No record found</div>
                </div>
            @endif
        </div>
    </div>

    <div class="relative">
        <div wire:loading.delay.longest
             class="absolute top-0 left-0 w-full h-full bg-gray-50 opacity-30 z-10 "></div>
        <div class="px-6 pt-4 d-flex justify-content-between">
            <div>{{ $rows->links('components.datatable.navigation.pagination.tailwind') }}</div>
        </div>
    </div>

    {{--  MODALS  --}}
    @includeWhen($this->withFilters,'livewire.datatable.modals.filter')
    @includeWhen($this->withBulkActions, 'livewire.datatable.modals.delete')
    @includeWhen($this->withColumnVisibility,'livewire.datatable.modals.columns')
    @includeWhen($this->withBulkActions, 'livewire.datatable.modals.export')

    {{--  Notifications  --}}
    <div class="fixed right-5 top-16 px-4 py-4 border bg-white rounded-md shadow-2xl"
         x-transition:enter="transition delay-700 ease-in-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-12 "
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-on:delete-notification.window="delete_notification_show = true"
         x-show="delete_notification_show"
    >
        <div class="flex">
            <div class="mr-4">
                <x-datatable.icons.trash class="h-5 w-5 text-red-400"/>
            </div>
            <div class="flex justify-between w-full">
                <div class="text-left w-full mr-6">
                    <h1 class=" font-semibold text-sm text-gray-700 mb-1">Successfully deleted!</h1>
                    <p class="text-sm text-gray-600">
                        You can restore deleted items in trash.
                    </p>
                </div>
                <div>
                    <button @click="delete_notification_show = false">
                        <x-datatable.icons.x class="h-5 w-5 text-gray-700 cursor-pointer "/>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@if($this->canResizeColumns)
    @push('datatable-scripts')
        <script src="{{ secure_asset('/js/columnResize.js') }}"></script>
    @endpush
@endif
