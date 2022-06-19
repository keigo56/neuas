<div>
    <x-overlays.modal modal-id="user-add-modal" class="w-full max-w-2xl">
        <x-slot name="title">Add New User</x-slot>
        <x-slot name="body">
            <div class="mb-5">
                <x-forms.label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</x-forms.label>
                <x-forms.input name="name" type="email" id="name" placeholder="John Doe" wire:model.lazy="name"/>
            </div>
            <div>
                <x-forms.label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</x-forms.label>
                <x-forms.input name="email" type="email" id="email" placeholder="johndoe@example.com" wire:model.lazy="email"/>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end flex-col-reverse md:flex-row ">
                <x-datatable.elements.button
                    @click="$dispatch('close-user-add-modal')"
                    type="button"
                    class="mr-2 mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    Cancel
                </x-datatable.elements.button>
                <x-datatable.elements.button
                    wire:click="addNewUser"
                    class="mt-2 md:mt-0 px-3 py-2 bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                    Add New User
                </x-datatable.elements.button>
            </div>
        </x-slot>
    </x-overlays.modal>
</div>
