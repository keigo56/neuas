<x-layouts.app>
    <x-slot name="title">NEU Appointment System | {{ $department->display_name }} Registrar</x-slot>
    <div class="flex w-full overflow-x-hidden bg-gray-100">
        <x-registars.sidebar active="{{ $activeurl }}" :department="$department"/>
        <div class="w-[calc(100%-18rem)]">
            <nav class="bg-white shadow" x-data="{ open : false }">
                <div class="mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        <div>
                            <h1 class="text-xl font-semibold">{{ $title }}</h1>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="button" class="p-1 rounded-full text-brand hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-brand focus:ring-white">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
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

                                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">My Profile</a>
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
            </nav>
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>
