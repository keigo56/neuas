<x-layouts.registrar>
    <x-slot name="activeurl">{{ route('registrar.users') }}</x-slot>
    <x-slot name="title">Users</x-slot>
    <div class="p-8">
        <livewire:users-datatable/>
    </div>
    <livewire:registrar.user.create/>
</x-layouts.registrar>
