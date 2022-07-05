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
            </nav>
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>
