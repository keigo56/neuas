<x-layouts.registrar :department="$department">
    <x-slot name="activeurl">{{ route('registrar.dashboard', $department) }}</x-slot>
    <x-slot name="title">Dashboard</x-slot>
</x-layouts.registrar>
