<div>
    <x-overlays.modal modal-id="search-student-modal" class="w-full max-w-2xl">
        <x-slot name="title">Search Student</x-slot>
        <x-slot name="body">
            <div class="mb-0">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Student Email</label>
                <x-forms.input wire:model.lazy="student_email" name="student_email" type="email" id="email" placeholder="johndoe@example.com"/>
            </div>

            @if($appointment === null && $this->validationPassed)
                <div class="mt-3 bg-rose-100 p-4 rounded">
                    <div class="text-sm">
                        <div class="text-rose-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <p class="font-semibold">Student has no appointment schedule set for today</p>
                        </div>
                    </div>
                </div>
            @elseif($appointment !== null && $this->validationPassed)
                <div class="mt-3 bg-gray-100 p-4 rounded">
                    <h1 class="font-semibold text-center mb-3 border-b pb-3">Student Appointment Information</h1>
                    <div class="text-sm">
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold">Name</p>
                            <p>{{ $appointment->name }}</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold">Email</p>
                            <p>{{ $appointment->email }}</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold">Appointment Status</p>
                            <div>
                                @if($appointment->status === 'pending')
                                    <span class='ml-1 text-xs text-yellow-600 truncate px-2 py-0.5 rounded-full bg-yellow-200'>{{ $appointment->status }}</span>
                                @elseif($appointment->status === 'cancelled')
                                    <span class='ml-1 text-xs text-rose-600 truncate px-2 py-0.5 rounded-full bg-rose-200'>{{ $appointment->status }}</span>
                                @else
                                    <span class='ml-1 text-xs text-green-600 truncate px-2 py-0.5 rounded-full bg-green-200'>{{ $appointment->status }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold">Department</p>
                            <p>{{ $appointment->department_name }}</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="font-semibold">Appointment Schedule</p>
                            <p> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }} ( {{ $appointment->time_schedule }} )</p>
                        </div>
                    </div>
                </div>
            @endif

        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end flex-col-reverse md:flex-row ">
                <x-datatable.elements.button
                    wire:click="resetSearch"
                    type="button"
                    class="mr-2 mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    Reset
                </x-datatable.elements.button>
                <x-datatable.elements.button
                    wire:click="search"
                    class="mt-2 md:mt-0 px-3 py-2 bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                    Search
                </x-datatable.elements.button>
            </div>
        </x-slot>
    </x-overlays.modal>
</div>
