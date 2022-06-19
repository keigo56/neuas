<x-layouts.registrar :department="$department">
    <x-slot name="activeurl">{{ route('registrar.users', $department) }}</x-slot>
    <x-slot name="title">Users</x-slot>
    <div class="p-8">
        <livewire:registrar.user.users-datatable :department="$department->id"/>
    </div>
    <livewire:registrar.user.create :department="$department->id"/>
</x-layouts.registrar>
