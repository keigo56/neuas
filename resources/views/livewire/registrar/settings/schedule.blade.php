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
                <h1 class="font-semibold">Day and Time availability</h1>
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
               <div class="w-52 min-w-fit border-r">
                  <div class="p-5">
                      <h1 class="font-semibold text-md mb-4">Day Availability</h1>

                      @foreach($week_schedules as $index => $week_schedule)
                          <div class="flex items-center justify-between py-1.5 px-3 @if($week_schedule['id'] === $selectedWeekSchedule) bg-brand-semi-light rounded @endif">
                              <div class="mr-16">
                                  <h1 class="text-sm font-semibold">{{ str($week_schedule['day'])->title() }}</h1>
                                  @if($week_schedule['available'])
                                      <p class="text-xs text-emerald-700 font-semibold">Available</p>
                                  @else
                                      <p class="text-xs text-rose-700 font-semibold">Unavailable</p>
                                  @endif
                              </div>
                              <div>
                                  <button wire:click="selectWeekSchedule({{ $week_schedule['id'] }})" class="text-xs font-semibold hover:underline text-brand">Manage Time Schedule</button>
                              </div>
                          </div>
                      @endforeach

                  </div>
               </div>

               <div class="border-r">
                   <div class="p-5">

                       <div class="flex justify-between">
                           <h1 class="font-semibold text-md mb-4 mr-20">Time Schedule ({{ str($this->getWeekSchedule()['day'])->title() }})</h1>
                           <div>
                               <x-forms.checkbox wire:model="week_schedules.{{ $selectedWeekSchedule }}.available" id="week-{{ $selectedWeekSchedule }}" class="mr-2"/>
                               <x-forms.label for="week-{{ $selectedWeekSchedule }}" class="inline-block text-sm font-medium text-gray-700">Available</x-forms.label>
                           </div>
                       </div>

                       @if($this->getWeekSchedule()['available'])
                           <div class="flex space-x-6">
                               <div class="bg-blue-50 p-5">
                                   <div class="flex flex-col">
                                       <h1 class="text-center font-semibold mb-2">AM</h1>
                                       @foreach($time_schedules_am as $time_schedule_am)
                                           <div class="flex justify-between mb-2">
                                               <div class="mr-10" wire:key="{{ $this->selectedWeekSchedule }}-{{ $time_schedule_am['id'] }}-am">
                                                   <x-forms.checkbox wire:model="time_schedules.{{ $time_schedule_am->id }}.available" id="time-{{ $time_schedule_am->id }}" class="mr-2"/>
                                                   <x-forms.label for="time-{{ $time_schedule_am->id }}" class="inline-block text-sm font-medium text-gray-700">{{ $time_schedule_am->time_from }} - {{ $time_schedule_am->time_to }}</x-forms.label>
                                               </div>
{{--                                               <div>--}}
{{--                                                   <x-forms.input wire:model.lazy="time_schedules.{{ $time_schedule_am->id }}.slots" :disabled="$this->time_schedules[$time_schedule_am->id]['available'] === 0 || $this->time_schedules[$time_schedule_am->id]['available'] === false" type="number" name="schedule" class="w-20 px-1 py-1 text-left" value="10"/>--}}
{{--                                               </div>--}}
                                           </div>
                                       @endforeach
                                   </div>
                               </div>
                               <div class="bg-blue-50 p-5">
                                   <h1 class="text-center font-semibold mb-2">PM</h1>
                                   @foreach($time_schedules_pm as $time_schedule_pm)
                                       <div class="flex justify-between mb-2">
                                           <div class="mr-4" wire:key="{{ $this->selectedWeekSchedule }}-{{ $time_schedule_pm->id }}-pm">
                                               <x-forms.checkbox wire:model="time_schedules.{{ $time_schedule_pm->id }}.available" id="time-{{ $time_schedule_pm->id }}" class="mr-2" />
                                               <x-forms.label for="time-{{ $time_schedule_pm->id }}" class="inline-block text-sm font-medium text-gray-700">{{ $time_schedule_pm->time_from }} - {{ $time_schedule_pm->time_to }}</x-forms.label>
                                           </div>
{{--                                           <div>--}}
{{--                                               <x-forms.input wire:model.lazy="time_schedules.{{ $time_schedule_pm->id }}.slots" :disabled="$this->time_schedules[$time_schedule_pm->id]['available'] === 0 || $this->time_schedules[$time_schedule_pm->id]['available'] === false" type="number" name="schedule" class="w-20 px-1 py-1 text-left" value="10"/>--}}
{{--                                           </div>--}}
                                       </div>
                                   @endforeach
                               </div>
                           </div>
                       @else
                           <div class="px- py-10 bg-gray-50 border rounded">
                               <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-700 h-8 w-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                               </svg>
                               <p class="text-center text-sm">Schedule is unavailable</p>
                           </div>
                       @endif

                   </div>
               </div>

{{--                <div class="w-72">--}}
{{--                    <div class="p-5">--}}
{{--                        <h1 class="font-semibold text-md mb-4">Custom Dates</h1>--}}
{{--                        <div class="mb-5">--}}
{{--                            <p class="text-sm font-semibold">Nov 1, 2022</p>--}}
{{--                            <p class="text-xs ">All Saints Day</p>--}}
{{--                        </div>--}}

{{--                        <div class="mb-5">--}}
{{--                            <p class="text-sm font-semibold">Nov 12, 2022 - Nov 13, 2022</p>--}}
{{--                            <p class="text-xs ">Semester Break</p>--}}
{{--                        </div>--}}

{{--                        <div class="mb-5">--}}
{{--                            <p class="text-sm font-semibold">Dec 12, 2022 - Jan 05, 2023</p>--}}
{{--                            <p class="text-xs ">Holiday Season</p>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </x-elements.card>

{{--    <x-elements.card>--}}
{{--        <div class="p-5 bg-slate-50 border-b">--}}
{{--            <h1 class="font-semibold">Time Schedule</h1>--}}
{{--        </div>--}}
{{--        <div class="p-5">--}}

{{--        </div>--}}
{{--    </x-elements.card>--}}
</div>
