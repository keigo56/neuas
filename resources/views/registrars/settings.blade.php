<x-layouts.registrar :department="$department">
    <x-slot name="activeurl">{{ route('registrar.settings', $department) }}</x-slot>
    <x-slot name="title">Settings</x-slot>

    <div class="pt-12 pb-8 max-w-7xl mx-auto">
        <livewire:registrar.settings.schedule-basic/>
    </div>
</x-layouts.registrar>
