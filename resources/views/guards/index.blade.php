<x-layouts.guard xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-guards.navigation.navbar selected="appointment_lists"/>

    <div class="bg-brand h-72 rounded-b hidden sm:block"></div>
    <div class="mt-5 flex justify-end">
        <x-elements.button
            x-data="{}"
            @click="$dispatch('toggle-search-student-modal')"
            class="px-4 py-2.5 mr-5 block sm:hidden"
        >
            <div class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Search Student
            </div>
        </x-elements.button>
    </div>
    <div class="max-w-7xl mx-auto relative px-2 lg:px-0 sm:-my-36 flex font-inter">
        <livewire:guard.guard-datatable/>
    </div>
    <livewire:guard.search-student/>
</x-layouts.guard>


