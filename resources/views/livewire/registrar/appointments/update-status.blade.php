<div>
    <x-overlays.modal modal-id="appointment-update-status-modal" class="w-full max-w-2xl">
        <x-slot name="title">Update Status</x-slot>
        <x-slot name="body">
            <div class="mb-5">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <x-forms.select-menu wire:model="appointment_status" name="status">
                    <option value="active">Active</option>
                    <option value="cancelled">Cancelled</option>
                    <option value="finished">Finished</option>
                </x-forms.select-menu>
            </div>

            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (optional)</label>
                <textarea wire:model.lazy="notes" placeholder="Say something here..." rows="7" name="notes" id="notes" class="shadow-sm focus:ring-brand focus:border-brand mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end flex-col-reverse md:flex-row ">
                <x-datatable.elements.button
                    @click="$dispatch('close-appointment-update-status-modal')"
                    type="button"
                    class="mr-2 mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    Cancel
                </x-datatable.elements.button>
                <x-datatable.elements.button
                    wire:click="updateStatus"
                    class="mt-2 md:mt-0 px-3 py-2 bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                    Update Status
                </x-datatable.elements.button>
            </div>
        </x-slot>
    </x-overlays.modal>
</div>
