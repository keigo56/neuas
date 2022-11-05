<div>
    <x-overlays.modal modal-id="appointment-view-modal" class="w-full max-w-2xl">
        <x-slot name="title">View Appointment</x-slot>
        <x-slot name="body">
            <div>
                <div class="flex items-end h-8 mb-5">
                    <h1 class="text-gray-900 font-semibold text-md ">Appointment Details</h1>
                </div>
                <dl>
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $student_name }}</dd>
                    </div>
                    <div class="bg-white px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Department</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $this->student_department }}</dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Documents</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @foreach($this->student_document as $document_id)
                                <div>{{ \App\Models\Document::query()->where('id',$document_id)->first()->name }}</div>
                            @endforeach
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Date</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($this->appointment_date)->format('M d, Y') }} <span class="text-gray-400 text-xs">({{ \Carbon\Carbon::parse($this->appointment_date)->dayName }})</span></dd>
                    </div>
                    @if(in_array(3, $student_document))
                        <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Address Type</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $this->student_address_type }}</dd>
                        </div>
                        <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Address</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $this->student_address }}</dd>
                        </div>
                    @endif

                    @if(count($this->student_proof_of_payments) > 0)
                        <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Proof of payment</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="flex mb-3 space-x-2 flex-wrap" >
                                    @foreach($this->student_proof_of_payments as $image)
                                        <div class="h-24 w-24 overflow-hidden bg-white rounded-md border border-gray-400 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                            <img class="w-full h-full object-cover " src="{{ secure_asset('storage/' . $image['url']) }}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </dd>
                        </div>
                    @endif
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Time</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $this->appointment_time_display }}</dd>
                    </div>
                </dl>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end flex-col-reverse md:flex-row ">
                <x-datatable.elements.button
                    @click="$dispatch('close-appointment-view-modal')"
                    type="button"
                    class="mr-2 mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    Close
                </x-datatable.elements.button>
            </div>
        </x-slot>
    </x-overlays.modal>
</div>
