<x-layouts.registrar :department="$department">
    <x-slot name="activeurl">{{ route('registrar.settings', $department) }}</x-slot>
    <x-slot name="title">Settings</x-slot>
</x-layouts.registrar>
