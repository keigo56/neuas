<x-layouts.registrar :department="$department">
    <x-slot name="activeurl">{{ route('registrar.appointments', $department) }}</x-slot>
    <x-slot name="title">Appointments</x-slot>
    <div class="p-8">
        <livewire:registrar.appointments.appointments-datatable :department="$department->id"/>
    </div>
    <livewire:registrar.appointments.update-status/>
    <livewire:registrar.appointments.view-appointment/>
</x-layouts.registrar>
