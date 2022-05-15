<x-layouts.registrar :department="$department">
    <x-slot name="activeurl">{{ route('registrar.dashboard', $department) }}</x-slot>
    <x-slot name="title">Dashboard</x-slot>

    <div class="pt-12 pb-8 mx-12 mx-auto">
        <livewire:registrar.dashboard.dashboard :department="$department->id"/>
    </div>
</x-layouts.registrar>
