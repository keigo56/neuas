<x-layouts.registrar :department="$department">
    <x-slot name="activeurl">{{ route('registrar.appointments', $department) }}</x-slot>
    <x-slot name="title">Appointments</x-slot>
</x-layouts.registrar>
