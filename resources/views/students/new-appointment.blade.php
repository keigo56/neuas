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
                        <a href="{{ route('student.new-appointment') }}" class="w-12 h-12 rounded-full bg-white border-2 border-brand text-brand font-semibold">
                            <span class="w-full h-full grid place-items-center">
                                1
                            </span>
                        </a>
                        <div class="w-0.5 bg-gray-400 h-12"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-md uppercase text-brand">Step 1</p>
                        <p class="text-sm -mt-1 font-semibold">Application Form</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex items-center flex-col mr-4">
                        <a href="{{ route('student.new-appointment-2') }}" class="w-12 h-12 rounded-full bg-white border-2 border-gray-400 text-gray-400 font-semibold">
                            <span class="w-full h-full grid place-items-center">
                                2
                            </span>
                        </a>
                        <div class="w-0.5 bg-gray-400 h-12"></div>
                    </div>
                    <div>
                        <p class="font-semibold text-md uppercase text-gray-400">Step 2</p>
                        <p class="text-sm -mt-1 font-semibold text-gray-400">Date and Time</p>
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
                <h1 class="text-gray-900 font-semibold text-xl ">Application Form</h1>
            </div>

{{--            <form action="{{ route('student.submit-appointment') }}" method="post">--}}
{{--                @csrf--}}
                <div class="flex flex-col space-y-8">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <x-forms.input name="full_name" type="text" id="name" placeholder="John Doe"/>
                    </div>

                    <div>
                        <label  for="department" class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                        <x-forms.select-menu name="department">
                            <option value="college">College</option>
                            <option value="high_school">High School</option>
                        </x-forms.select-menu>
                    </div>

                    <div>
                        <label for="document" class="block text-sm font-medium text-gray-700 mb-2">Document</label>
                        <x-forms.select-menu name="document">
                            <option value="form_137">Form 137</option>
                            <option value="form_138">Form 138</option>
                            <option value="tor">Transcript of Records</option>
                        </x-forms.select-menu>
                    </div>
                </div>

            <div class="mt-8 flex justify-end">
                <x-elements.a href="{{ route('student.new-appointment-2') }}" class="inline-block">
                    <div class="flex items-center px-2">
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </div>
                </x-elements.a>
            </div>
{{--            </form>--}}


        </div>
    </x-elements.card>
</x-layouts.student>


