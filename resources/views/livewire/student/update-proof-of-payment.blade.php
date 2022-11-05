<div>
    <x-overlays.modal modal-id="appointment-update-proof-of-payment-modal" class="w-full max-w-2xl">
        <x-slot name="title">Update Proof of Payment</x-slot>
        <x-slot name="body">
            <div>
                <label for="pof" class="block text-sm font-medium text-gray-700 mb-2">Proof of Payment</label>
                <div class="flex mb-3 space-x-2 flex-wrap" >

                    @if(count($this->student_proof_of_payments) > 0 && count($this->new_student_proof_of_payments) === 0)
                        @foreach($this->student_proof_of_payments as $image)
                            <div class="h-24 w-24 overflow-hidden bg-white rounded-md border border-gray-400 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <img class="w-full h-full object-cover " src="{{ secure_asset('storage/' . $image['url']) }}" alt="">
                            </div>
                        @endforeach
                    @else
                        @foreach($this->new_student_proof_of_payments as $image)
                            <div class="h-24 w-24 overflow-hidden bg-white rounded-md border border-gray-400 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <img class="w-full h-full object-cover " src="{{ $image->temporaryUrl() }}" alt="">
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="flex justify-center items-center w-full">
                    <label for="pof" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="pof" wire:model="new_student_proof_of_payments" type="file" class="hidden" accept="image/png, image/gif, image/jpeg" multiple>
                    </label>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end flex-col-reverse md:flex-row ">
                <x-datatable.elements.button
                    wire:click="cancelUpdate"
                    type="button"
                    class="mr-2 mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    Close
                </x-datatable.elements.button>
                <x-datatable.elements.button
                    wire:click="update_proof_of_payment_action"
                    class="mt-2 md:mt-0 px-3 py-2 bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                    Update
                </x-datatable.elements.button>
            </div>
        </x-slot>
    </x-overlays.modal>
</div>
