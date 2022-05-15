<div>
    <div class="flex items-center justify-between px-2">
        <h1 class="font-semibold text-2xl text-gray-700">
            General Report
        </h1>
        <div class="flex">
            <div class="mr-5 w-48">
                <x-forms.select-menu wire:model="range" id="student_department">
                    <option value="today">Today</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="last_7_days">Last 7 Days</option>
                    <option value="all_time">All Time</option>
                </x-forms.select-menu>
            </div>
            <x-elements.button wire:click="$refresh" class="py-0.5 focus:ring-2">
                <div class="flex items-center justify-between">
                    <div class="text-white mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    Reload Data
                </div>
            </x-elements.button>
        </div>
    </div>

    <div class="flex items-center flex-wrap mt-8">
        <div class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 py-2 text-blue-500">
            <x-elements.card>
                <div class="p-5 flex justify-between">
                    <div>
                        <h1 class="font-black text-2xl text-sm mb-2">{{ $data['all'] }}</h1>
                        <p class="font-base text-sm text-gray-500">Total appointments</p>
                    </div>
                    <div class="flex justify-between mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </x-elements.card>
        </div>
        <div class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 py-2 text-yellow-500">
            <x-elements.card>
                <div class="p-5 flex justify-between">
                    <div>
                        <h1 class="font-black text-2xl text-sm mb-2">{{ $data['pending'] }}</h1>
                        <p class="font-base text-sm text-gray-500">Total pending appointments</p>
                    </div>
                    <div class="flex justify-between mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </x-elements.card>
        </div>
        <div class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 py-2 text-emerald-500">
            <x-elements.card>
                <div class="p-5 flex justify-between">
                    <div>
                        <h1 class="font-black text-2xl text-sm mb-2">{{ $data['done'] }}</h1>
                        <p class="font-base text-sm text-gray-500">Total done appointments</p>
                    </div>
                    <div class="flex justify-between mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </x-elements.card>
        </div>
        <div class="sm:w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 py-2 text-rose-500">
            <x-elements.card>
                <div class="p-5 flex justify-between">
                    <div>
                        <h1 class="font-black text-2xl text-sm mb-2">{{ $data['cancelled'] }}</h1>
                        <p class="font-base text-sm text-gray-500">Total cancelled appointments</p>
                    </div>
                    <div class="flex justify-between mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </x-elements.card>
        </div>
    </div>

</div>
