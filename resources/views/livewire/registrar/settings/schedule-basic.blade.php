<div>
    <div class="mb-10">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="font-semibold text-2xl">
                    Schedule
                </h1>
                <p class="text-gray-500">Update schedule date and time availability</p>
            </div>


        </div>
    </div>

    <x-elements.card class="mb-10">
        <div class="p-5 bg-slate-50 border-b">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold">Availability</h1>
                <div>
                    @if($isChanged)
                        <button wire:click="cancel" class="px-3 py-1.5 rounded-md text-sm font-medium inline-block bg-white text-gray-700 border hover:bg-gray-100 hover:text-brand focus:outline-none focus:ring-2 focus:ring-gray-200">Cancel</button>
                        <x-elements.button wire:click="save" class="py-1.5 focus:ring-2">Save Changes</x-elements.button>
                    @endif
                </div>
            </div>
        </div>
        <div>
            <div class="flex">
                <div class="w-52 min-w-fit">
                    <div class="p-5">
                        <h1 class="font-semibold text-md mb-4">Week</h1>

                        @foreach($week_schedules as $index => $week_schedule)
                            <div class="flex items-center justify-between py-1.5">
                                <div class="mr-16">
                                    <div class="flex items-center justify-center">
                                        <x-forms.checkbox wire:model="week_schedules.{{ $index }}.available" id="week-{{ $index }}" class="mr-2"/>
                                        <x-forms.label for="week-{{ $index }}" class="text-sm mb-0 font-semibold">{{ str($week_schedule['day'])->title() }}</x-forms.label>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </x-elements.card>
</div>
