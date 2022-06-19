<x-datatable.overlays.modal modalId="export-modal"
         class="w-full max-w-3xl">
    <x-slot name="title">
        Export Options
    </x-slot>
    <x-slot name="body">
        <div x-data="{ selected: 'csv' }" class="mb-5">
            <h1 class="text-md font-semibold text-gray-800 mb-3">Format</h1>
            <div class="flex flex-col w-full text-sm overflow-hidden rounded border">
                <label
                    @click="selected = 'csv'"
                    class="w-full items-center flex px-4 py-2 border-2 border-gray-500 border-opacity-0  border-box"
                    :class="selected === 'csv' ? 'bg-gray-100 rounded border-opacity-100 ' : 'bg-white'"
                >
                    <input
                        wire:model="fileType"
                        type="radio"
                        name="format"
                        class="h-5 w-5 border-gray-300 focus:ring-gray-500 text-gray-600 mr-4"
                        value="csv"
                        checked
                    >
                    <div>
                        <p class="text-sm font-semibold mb-1">CSV <span class="font-normal text-xsm">(Comma Separated Values)</span>
                        </p>
                        <p class="text-xsm">
                            This is a .csv file that can be imported into other programs. Each value in the
                            response is separated by a comma and each response is separated by a newline
                            character.
                        </p>
                    </div>
                    <div>
                        <x-datatable.icons.csv class="h-20 w-20 text-gray-700"/>
                    </div>
                </label>

                <label
                    @click="selected = 'xlsx'"
                    class="w-full items-center flex px-4 py-2 border-2 border-gray-500 border-opacity-0  border-box"
                    :class="selected === 'xlsx' ? 'bg-gray-100 rounded border-opacity-100 ' : 'bg-white'"
                >
                    <input
                        wire:model="fileType"
                        type="radio"
                        name="format"
                        class="h-5 w-5 border-gray-300 focus:ring-gray-500 text-gray-600 mr-4"
                        value="xlsx"
                    >
                    <div>
                        <p class="text-sm font-semibold mb-1">Excel</p>
                        <p class="text-xsm">
                            Export the data to an XLSX format, which can be opened in Excel. This file format
                            cannot be used for import.
                        </p>
                    </div>
                    <div>
                        <x-datatable.icons.xlsx class="h-20 w-20 text-gray-700"/>
                    </div>
                </label>
            </div>
        </div>

        <div>
            <h1 class="text-md font-semibold text-gray-800 mb-3">
                File Name
                <span class="font-normal text-xs text-gray-400">(Optional)</span>
            </h1>

            <div class="relative">
                <x-datatable.forms.input
                       type="text"
                       class="pr-12"
                       placeholder="products-2021-12-19"/>
                <div class="absolute right-0 top-0 text-gray-500 text-sm h-full flex items-center pr-2">.{{ $fileType }}</div>
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <div class="border-t pt-4 flex justify-between items-center w-full">
            <div>
                <x-datatable.elements.button
                    class="mr-2 px-3 py-2 text-xs bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    <div class="flex items-center justify-center">
                        More Options
                    </div>
                </x-datatable.elements.button>
            </div>
            <div class="flex items-center justify-end">
                <x-datatable.elements.button
                    @click="$dispatch('toggle-export-modal')"
                    class="mr-2 px-3 py-2 text-xs bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    <div class="flex items-center justify-center">
                        Close
                    </div>
                </x-datatable.elements.button>

                <x-datatable.elements.button
                    wire:click="exportSelected"
                    class="px-3 py-2 text-xs bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                    <div class="flex items-center justify-center">
                        <x-datatable.icons.import class="w-4 h-4 mr-2"/>
                        Export
                    </div>
                </x-datatable.elements.button>
            </div>
        </div>
    </x-slot>
</x-datatable.overlays.modal>
