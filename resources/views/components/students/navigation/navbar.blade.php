<nav class="bg-white shadow" x-data="{ open : false }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button
                    @click="open = !open"
                    type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>

                    <svg
                        :class="!open ? 'block' : 'hidden'"
                        class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg
                        :class="open ? 'block' : 'hidden'"
                        class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('student.appointment-lists') }}" class="flex items-center">
                        <img class="block h-10 w-auto mr-0 md:mr-4" src="data:image/webp;base64,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" alt="Workflow">
                        <h1 class="hidden lg:block text-brand font-semibold mr-4">NEU Appointment System</h1>
                    </a>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
{{--                        <a href="{{ $route['path'] }}" class="@if($selected === $key) bg-gray-900 text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif px-3 py-2 rounded-md text-sm font-medium" @if($key === $selected) aria-current="page" @endif>{{ $route['name'] }}</a>--}}
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                <x-elements.a
                    href="{{ route('student.new-appointment') }}"
                    class="px-4 py-2.5 mr-5 hidden sm:block"
                >
                    <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Appointment
                    </div>
                </x-elements.a>

                <x-elements.dropdown class="font-inter">
                    <x-slot name="button">
                        <button
                            @click="open = !open"
                            type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-brand focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->getAttribute('avatar') }}" alt="">
                        </button>
                    </x-slot>
                    <x-slot name="dropdown">
                        <div class="min-w-[16rem]">
                            <div class="flex items-center px-4 py-4 border-b">
                                <div class="mr-4">
                                    <img class="h-10 w-10 rounded-md" src="{{ Auth::user()->getAttribute('avatar') }}" alt="">
                                </div>
                                <div class="truncate">
                                    <h1 class="text-md font-semibold truncate">{{ Auth::user()->getAttribute('name') }}</h1>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->getAttribute('email') }}</p>
                                    <span class="text-[0.7rem] text-green-600 truncate px-2 py-0.5 rounded-full bg-green-200 -mt-2">{{ ucwords(Auth::user()->roles->first()->name)  }}</span>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 hover:bg-gray-100 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">
                                    Sign out
                                </a>
                            </form>
                        </div>
                    </x-slot>
                </x-elements.dropdown>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div
        :class="open ? 'block' : 'hidden'"
        class="sm:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 border-b">
            <a href="{{ route('student.appointment-lists') }}"
               class="@if(request()->url() === route('student.appointment-lists')) bg-brand text-white @else text-gray-300 hover:bg-brand hover:text-white @endif block px-3 py-2 rounded-md text-base font-medium">
                Appointments List
            </a>
            <a href="{{ route('student.new-appointment') }}"
               class="@if(request()->url() === route('student.new-appointment')) bg-brand text-white @else text-gray-300 hover:bg-brand hover:text-white @endif block px-3 py-2 rounded-md text-base font-medium">
                Create Appointment
            </a>
        </div>
    </div>
</nav>
