<x-datatable.overlays.modal modalId="delete-modal">
    <x-slot name="title">
        Delete {{ $title }}
    </x-slot>
    <x-slot name="body">
        <p class="text-sm text-gray-500">
            Are you sure you want to delete these {{ strtolower($title) }}? This action cannot be undone.
        </p>
    </x-slot>
    <x-slot name="footer">
        <div class="sm:flex sm:flex-row-reverse">
            <button wire:click="deleteSelected"
                    type="button"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                Delete
            </button>
            <button @click="$dispatch('toggle-delete-modal')"
                    type="button"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
    </x-slot>
</x-datatable.overlays.modal>
