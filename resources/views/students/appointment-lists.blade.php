<x-layouts.student xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-students.navigation.navbar selected="appointment_lists"/>
    <div class="bg-brand h-0 md:h-72 rounded-b"></div>
    <div class="max-w-7xl mx-auto relative -my-0 md:-my-36  flex font-inter">
        <livewire:student.student-appointments-datatable/>
        <livewire:registrar.appointments.view-appointment/>
        <livewire:student.update-proof-of-payment/>
    </div>
</x-layouts.student>
