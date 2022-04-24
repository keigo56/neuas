@props([
    'title' => 'Modal Title',
    'body' => '',
    'footer' => '',
    'modalId' => 'modal-id'
])

<div
    x-data="{ open: false, toggle() { this.open = !this.open} }"
    @keydown.esc.window="open = false"
>
    <div class="fixed z-10 inset-0 overflow-y-auto"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         x-on:toggle-{{ $modalId }}.window="toggle()"
         x-on:close-{{ $modalId }}.window="open = false"
         x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
    >
        <div class="flex items-center justify-center w-full min-h-screen pt-4 px-4 pb-20 overflow-hidden">

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 aria-hidden="true">
            </div>

            <div {{ $attributes->merge(['class' => 'rounded-lg bg-white text-left shadow-xl transform transition-all sm:my-8']) }}
                 x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
                <div class="rounded-lg bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-3 sm:mt-0 ">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 border-b pb-3">
                            {{ $title }}
                        </h3>
                        <div class="mt-3">
                            {{ $body }}
                        </div>
                    </div>
                </div>
                <div class="rounded-b bg-gray-50 px-6 py-3">
                    {{ $footer }}
                </div>
            </div>
        </div>
    </div>
</div>
