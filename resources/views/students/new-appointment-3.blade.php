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
                        <a href="{{ route('student.new-appointment-2') }}" class="w-12 h-12 rounded-full bg-brand border-2 border-brand text-gray-400 font-semibold">
                            <span class="w-full h-full grid place-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        </a>
                        <div class="w-0.5 bg-brand h-12"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-md uppercase text-brand">Step 2</p>
                        <p class="text-sm -mt-1 font-semibold">Date and Time</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex items-center flex-col mr-4">
                        <a href="{{ route('student.new-appointment-3') }}" class="w-12 h-12 rounded-full bg-white border-2 border-brand text-brand font-semibold">
                            <span class="w-full h-full grid place-items-center">
                                3
                            </span>
                        </a>
                    </div>
                    <div>
                        <p class="font-semibold text-md uppercase text-brand">Step 3</p>
                        <p class="text-sm -mt-1 font-semibold">Confirmation</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="h-full border-l p-8 flex-1 min-h-[36rem]">
            <div class="flex items-end h-8 mb-10">
                <h1 class="text-gray-900 font-semibold text-xl ">Appointment Confirmation</h1>
            </div>

                <dl>
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Rovin Cruz</dd>
                    </div>
                    <div class="bg-white px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Department</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">College</dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Document</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Form 137</dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Date</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">04-22-2022 <span class="text-gray-400 text-xs">(Friday)</span></dd>
                    </div>
                    <div class="bg-gray-50 px-2 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-medium text-gray-500">Time</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">10:00 AM - 11:00 PM</dd>
                    </div>
                </dl>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('student.new-appointment-2') }}" class="px-3 py-2 rounded-md text-sm font-medium inline-block bg-white border hover:bg-gray-100 hover:text-brand focus:outline-none focus:ring-4 focus:ring-gray-200">
                        <div class="flex items-center px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Prev
                        </div>
                    </a>
                    <x-elements.a href="{{ route('student.appointment-lists') }}" class="inline-block">
                        <div class="flex items-center px-2">
                            Submit
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </x-elements.a>
                </div>
        </div>
    </x-elements.card>
</x-layouts.student>


