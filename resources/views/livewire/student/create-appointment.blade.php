<div>

    @if(!$done)
        <x-elements.card class="max-w-4xl mx-auto border relative -my-36 flex flex-col md:flex-row font-inter">
            <div class="h-full py-8 pl-8 pr-20 border-b md:border-none">
                <div class="flex items-end h-8 mb-10">
                    <h1 class=" text-gray-900 font-semibold text-2xl">New Appointment</h1>
                </div>
                {{--     STEPPER    --}}
                <div class="flex flex-col">
                    @foreach($steps as $index => $step)
                        <div class="flex">
                            <div class="flex items-center flex-col mr-4">
                                <a
                                   wire:click="setCurrentPage({{ $index }})"
                                   href="#"
                                   class="w-12 h-12 rounded-full @if($step['done'] && $current_step !== $index) bg-brand text-white @elseif($step['done'] && $current_step === $index) bg-white border-2 border-brand text-brand @elseif(!$step['done'] && $current_step === $index) bg-white border-2 border-brand text-brand @else bg-white border-2 border-gray-400 text-gray-400 @endif  font-semibold">

                                    <span class="w-full h-full grid place-items-center">

                                        @if($step['done'] && $current_step !== $index)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @elseif($step['done'] && $current_step === $index)
                                            {{ $index }}
                                        @else
                                            {{ $index }}
                                        @endif
                                    </span>
                                </a>

                                @if($loop->index !== count($steps) - 1)
                                    <div class="w-0.5 @if($step['done'] && $current_step !== $index) bg-brand @elseif(!$step['done'] && $current_step !== $index) bg-gray-400 @elseif(!$step['done'] && $current_step === $index) bg-gray-400 @else bg-brand @endif h-12"></div>
                                @endif

                            </div>
                            <div>
                                <p class="font-semibold text-md uppercase @if($step['done']) text-brand @elseif($current_step === $index) text-brand @else text-gray-400 @endif">Step {{ $index }}</p>
                                <p class="text-sm -mt-1 font-semibold @if($step['done']) text-gray-700 @elseif($current_step === $index) text-gray-700 @else text-gray-400 @endif">{{ $step['title'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="h-full border-l p-8 flex-1 min-h-[36rem]">

                @if($current_step === 1)
                    <div wire:key="step_1">
                        <div class="flex items-end h-8 mb-10">
                            <h1 class="text-gray-900 font-semibold text-xl ">Application Form</h1>
                        </div>

                        @error('student_document')
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="flex flex-col space-y-8">
                            <div>
                                <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <x-forms.input wire:model="student_name" name="student_name" type="text" id="student_name" placeholder="John Doe"/>
                            </div>

                            <div>
                                <label  for="student_department" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                <x-forms.select-menu wire:model="student_department" id="student_department">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->display_name }}</option>
                                    @endforeach
                                </x-forms.select-menu>
                            </div>

                            <div>
                                <label for="document" class="block text-sm font-medium text-gray-700 mb-2">Document</label>
                                @foreach($documents as $document)
                                    <div>
                                        <label class="text-sm">
                                            <x-forms.checkbox wire:model="student_document" value="{{ $document->id }}" class="mr-2"></x-forms.checkbox>
                                            <span>{{ $document->name }}</span>
                                        </label>
                                    </div>

                                @endforeach
                            </div>
                            <div>
                                <label for="other_documents" class="block text-sm font-medium text-gray-700 mb-2">Additional Documents (optional)</label>
                                <textarea class="block w-full shadow-sm sm:text-sm rounded-md focus:ring-brand focus:border-brand border-gray-300" wire:model.lazy="student_other_documents" name="other_documents" type="text" id="other_documents"></textarea>
                            </div>
                        </div>
                    </div>

                @elseif($current_step === 2)
                    <div wire:key="step_2">
                        <div class="flex items-end h-8 mb-10">
                            <h1 class="text-gray-900 font-semibold text-xl ">Date and Time</h1>
                        </div>
                        <div class="flex flex-col space-y-8">

                            <div>
                                <label for="appointment_date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <x-forms.input wire:model="appointment_date" name="appointment_date" type="date" id="appointment_date" min="{{ now()->addDay()->format('Y-m-d') }}" />
                            </div>

                            <div>
                                <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Time</label>

                                <x-forms.select-menu-custom name="appointment_time_id" wire:model="appointment_time_id" wire:key="time_schedule">
                                    <x-slot name="options">
                                        @forelse($time_schedules as $time_schedule)
                                            @if($loop->index === 0)
                                                <option value="no_sched" disabled @if($time_schedule['id'] === 'no_sched') selected @endif>Please select a schedule...</option>
                                            @endif
                                            <option value="{{ $time_schedule['id'] }}"  @if($time_schedule['remaining_slots'] <= 0) disabled @endif  @if($time_schedule['id'] === $this->appointment_time_id) selected @endif>{{ $time_schedule['time_range'] }}</option>
                                        @empty
                                            <option value="no_sched" disabled>No available Schedule</option>
                                        @endforelse
                                    </x-slot>
                                    <x-slot name="customhtml">
                                        @forelse($time_schedules as $time_schedule)
                                            @if($loop->index === 0)
                                                <div value="no_sched">
                                                    <div class="flex items-center justify-between pr-4">
                                                        <p class="mr-2 font-semibold">Please select a schedule</p>
                                                    </div>
                                                </div>
                                            @endif
                                            <div value="{{ $time_schedule['id'] }}">
                                                <div class="flex items-center justify-between pr-4">
                                                    <p class="mr-2">{{ $time_schedule['time_range'] }}</p>

                                                    @if($time_schedule['remaining_slots'] <= 0)
                                                        <p class="text-xs text-rose-600 font-semibold ">No slot available</p>
                                                    @else
                                                        <p class="text-xs text-emerald-600 font-semibold ">{{ $time_schedule['remaining_slots'] }} {{ $time_schedule['remaining_slots'] > 1 ? 'slots' : 'slot' }} available</p>
                                                    @endif

                                                </div>
                                            </div>
                                        @empty
                                            <div value="no_sched">
                                                <div class="flex items-center justify-between pr-4">
                                                    <p class="text-rose-600 font-semibold ">No available Schedule</p>
                                                </div>
                                            </div>
                                        @endforelse
                                    </x-slot>
                                </x-forms.select-menu-custom>
                            </div>
                        </div>
                    </div>
                @elseif($current_step === 3)
                    <div wire:key="step_3">
                        <div class="flex items-end h-8 mb-10">
                            <h1 class="text-gray-900 font-semibold text-xl ">Appointment Confirmation</h1>
                        </div>
                        <dl>
                            <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $student_name }}</dd>
                            </div>
                            <div class="bg-white px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Department</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ 'High School' }}</dd>
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
                            <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Time</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $this->appointment_time_display }}</dd>
                            </div>
                        </dl>
                    </div>
                @endif

                    <div class="mt-8 flex justify-between">

                        @if($current_step > 1)
                            <a wire:click="previous" href="#" class="px-3 py-2 rounded-md text-sm font-medium inline-block bg-white border hover:bg-gray-100 hover:text-brand focus:outline-none focus:ring-4 focus:ring-gray-200">
                                <div class="flex items-center px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                    Prev
                                </div>
                            </a>
                        @else
                            <div></div>
                        @endif


                        @if($current_step === count($steps) )
                            <x-elements.a @click="$dispatch('toggle-confirm-appointment-modal')" href="#" class="inline-block">
                                <div class="flex items-center px-2">
                                    Submit
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </div>
                            </x-elements.a>
                        @else
                            <x-elements.a wire:click="next" href="#" class="inline-block">
                                <div class="flex items-center px-2">
                                    Next
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </div>
                            </x-elements.a>
                        @endif

                    </div>
            </div>
        </x-elements.card>
    @else
        <x-elements.card class="max-w-3xl mx-auto border relative -my-36 flex font-inter">
            <div class="px-10 pt-10 pb-5 w-full">
                <h1 class="font-semibold text-4xl text-gray-700 mb-8">Thank you</h1>
                <p class="text-sm text-gray-700 ml-2">Your appointment has been set. Please expect an email confirmation after this. Thank you.</p>
                <div class="flex justify-center items-center mt-10">
                    <x-elements.a href="{{ route('student.appointment-lists') }}" class="mx-auto">
                        <div class="flex items-center px-2">
                            Home
                        </div>
                    </x-elements.a>
                </div>

                <p class="text-xs text-center text-zinc-400 mt-12">2022 NEU, All rights Reserved</p>
            </div>
        </x-elements.card>
    @endif

    <x-overlays.modal modalId="confirm-appointment-modal" class="w-full max-w-xl">
        <x-slot name="title">
            Confirm Appointment
        </x-slot>
        <x-slot name="body">
            <p class="text-sm text-gray-500">
                Are you sure you want to submit appointment?
            </p>
        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end flex-col-reverse md:flex-row ">
                <x-datatable.elements.button
                    @click="$dispatch('close-confirm-appointment-modal')"
                    type="button"
                    class="mr-2 mt-2 md:mt-0 px-3 py-2 bg-white hover:bg-gray-100 text-gray-700 hover:text-brand focus:ring-gray-200">
                    Cancel
                </x-datatable.elements.button>
                <x-datatable.elements.button
                    wire:click="submit"
                    class="mt-2 md:mt-0 px-3 py-2 bg-brand hover:bg-brand-dark text-white focus:ring-brand-light">
                    Submit Appointment
                </x-datatable.elements.button>
            </div>
        </x-slot>
    </x-overlays.modal>
</div>
