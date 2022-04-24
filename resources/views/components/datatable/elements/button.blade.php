<button
    {{ $attributes->merge(['class' => 'text-sm justify-center rounded-md font-medium inline-block border focus:outline-none focus:ring-2']) }}
>
    {{ $slot }}
</button>
