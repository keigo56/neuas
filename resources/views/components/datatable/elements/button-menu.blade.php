<button
    {{ $attributes->merge(['class' => 'bg-white border border-b-2 active:border-b rounded shadow-sm text-sm font-medium ']) }}
>
   {{ $slot }}
</button>
