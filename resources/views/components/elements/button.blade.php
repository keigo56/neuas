
<button {{ $attributes->merge(['class' => 'bg-brand text-white px-3 py-2 rounded-md text-sm font-medium border-b-2 border-b-gray-700 active:border-b-0']) }}>
    {{ $slot }}
</button>
