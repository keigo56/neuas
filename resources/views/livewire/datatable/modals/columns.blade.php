<x-datatable.overlays.modal modal-id="columns-modal">
    <x-slot name="title">
        Manage Columns
    </x-slot>
    <x-slot name="body">
        <div class="grid grid-flow-row grid-cols-1 gap-4 md:grid-cols-2">
            @foreach($columns as $index => $column)
                <div  style="min-width: 18rem;">
                    <label class="flex justify-start items-center text-sm">
                        <input
                            wire:model.defer="temporaryColumns"
                            type="checkbox"
                            class="input__checkbox input__checkbox__primary mr-2"
                            value="{{ $index }}"
                        >
                        {{ $column->getDisplayName() }}
                    </label>
                </div>
            @endforeach
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="border-t pt-5 flex justify-between">
            <div>
                <label class="flex justify-start items-center text-sm">
                    <input
                        wire:model="selectAllColumns"
                        type="checkbox"
                        class="input__checkbox input__checkbox__primary mr-2"
                    >
                    Select All
                </label>
            </div>
            <div>
                <button wire:click="resetColumns"
                        x-on:close-modal.window="$dispatch('toggle-columns-modal')"
                        type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Reset
                </button>
                <button wire:click="applyColumn"
                        type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-gray-600 text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:ml-1 sm:w-auto sm:text-sm">
                    Apply
                </button>
            </div>
        </div>
    </x-slot>
</x-datatable.overlays.modal>
