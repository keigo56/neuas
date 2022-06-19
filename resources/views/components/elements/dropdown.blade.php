<div {{ $attributes->merge(['class' => 'ml-3 relative']) }} x-data="{ open : false }">
    <div>
        {{ $button }}
    </div>
    <div
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"

        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"

        x-show="open"
        @click.away="open = false"

        class="origin-top-right absolute right-0 mt-2 rounded-md shadow-lg py-1 z-10 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
        {{ $dropdown }}
    </div>
</div>
