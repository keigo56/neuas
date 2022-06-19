<x-layouts.student xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-students.navigation.navbar selected="appointment_lists"/>

    <div class="bg-brand h-72 rounded-b"></div>
    <x-elements.card class="max-w-4xl mx-auto border relative -my-36 flex font-inter">
        <div class="h-full py-8 pl-8 pr-20">
            <div class="flex items-end h-8 mb-10">
                <h1 class=" text-gray-900 font-semibold text-2xl">New Appointment</h1>
            </div>
            {{--     STEPPER    --}}
            <div class="flex flex-col">
                <div class="flex">
                    <div class="flex items-center flex-col mr-4">
                        <a href="{{ route('student.new-appointment') }}" class="w-12 h-12 rounded-full bg-brand border-2 border-brand text-gray-400 font-semibold">
                            <span class="w-full h-full grid place-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        </a>
                        <div class="w-0.5 bg-brand h-12"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-md uppercase text-brand">Step 1</p>
                        <p class="text-sm -mt-1 font-semibold">Application Form</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex items-center flex-col mr-4">
                        <a href="{{ route('student.new-appointment-2') }}" class="w-12 h-12 rounded-full bg-white border-2 border-brand text-brand font-semibold">
                            <span class="w-full h-full grid place-items-center">
                                2
                            </span>
                        </a>
                        <div class="w-0.5 bg-gray-400 h-12"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-md uppercase text-brand">Step 2</p>
                        <p class="text-sm -mt-1 font-semibold">Date and Time</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex items-center flex-col mr-4">
                        <a href="{{ route('student.new-appointment-3') }}" class="w-12 h-12 rounded-full bg-white border-2 border-gray-400 text-gray-400 font-semibold">
                            <span class="w-full h-full grid place-items-center">
                                3
                            </span>
                        </a>
                    </div>
                    <div>
                        <p class="font-semibold text-md uppercase text-gray-400">Step 3</p>
                        <p class="text-sm -mt-1 font-semibold text-gray-400">Confirmation</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="h-full border-l p-8 flex-1 min-h-[36rem]">
            <div class="flex items-end h-8 mb-10">
                <h1 class="text-gray-900 font-semibold text-xl ">Date and Time</h1>
            </div>
                <div class="flex flex-col space-y-8">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <x-forms.input name="date" type="date" id="name" min="2022-04-22" value="{{ now()->toDateString() }}"/>
                    </div>

                    <div>
                        <label  for="department" class="block text-sm font-medium text-gray-700 mb-2">Time</label>
                        <x-forms.select-menu-custom name="time">
                           <x-slot name="options">
                               <option value="9AM10AM">9:00 AM - 10:00 AM</option>
                               <option value="10AM10PM" disabled>10:00 AM - 11:00 AM</option>
                               <option value="11AM12PM" disabled>11:00 AM - 12:00 PM</option>
                               <option value="12PM01PM">12:00 PM - 01:00 PM</option>
                           </x-slot>
                            <x-slot name="customhtml">
                                <div value="9AM10AM">
                                    <div class="flex items-center justify-between pr-4">
                                        <p class="mr-2">9:00 AM - 10:00 AM</p>
                                        <p class="text-xs text-emerald-600 font-semibold ">9 slots available</p>
                                    </div>
                                </div>
                                <div value="10AM10AM">
                                    <div class="flex items-center justify-between pr-4">
                                        <p class="mr-2">10:00 AM - 11:00 AM</p>
                                        <p class="text-xs text-rose-700 font-semibold">No slot available</p>
                                    </div>
                                </div>
                                <div value="11AM12PM">
                                    <div class="flex items-center justify-between pr-4">
                                        <p class="mr-2">11:00 AM - 12:00 PM</p>
                                        <p class="text-xs text-rose-700 font-semibold">No slot available</p>
                                    </div>
                                </div>
                                <div value="12PM01PM">
                                    <div class="flex items-center justify-between pr-4">
                                        <p class="mr-2">12:00 PM - 01:00 PM</p>
                                        <p class="text-xs text-green-600 font-semibold">2 slots available</p>
                                    </div>
                                </div>
                            </x-slot>
                        </x-forms.select-menu-custom>
                    </div>

                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('student.new-appointment') }}" class="px-3 py-2 rounded-md text-sm font-medium inline-block bg-white border hover:bg-gray-100 hover:text-brand focus:outline-none focus:ring-4 focus:ring-gray-200">
                        <div class="flex items-center px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Prev
                        </div>
                    </a>
                    <x-elements.a href="{{ route('student.new-appointment-3') }}" class="inline-block">
                        <div class="flex items-center px-2">
                            Next
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </x-elements.a>
                </div>
        </div>
    </x-elements.card>
</x-layouts.student>


