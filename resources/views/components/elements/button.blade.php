<button {{ $attributes->merge(['class' => 'px-3 py-2 rounded-md text-sm font-medium inline-block bg-brand text-white border hover:bg-brand-dark focus:outline-none focus:ring-4 focus:ring-brand-light']) }}>
    {{ $slot }}
</button>
