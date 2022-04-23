@props([
    'title' => '',
    'description' => ''
])

@php

    $class = '';
    $iconClass = '';

    if($attributes->get('type') === 'success'){
        $class .= ' bg-emerald-50 text-emerald-800 ';
        $iconClass = 'text-emerald-400';
    }else if($attributes->get('type') === 'danger'){
        $class .= ' bg-rose-50 text-rose-800 ';
        $iconClass = 'text-rose-400';
    }

@endphp

<div class="px-4 py-4 rounded md font-inter {{ $class }}">
    <div class="flex">
        <div class="mr-4  {{ $iconClass }}">
            @if($attributes->get('type') === 'success')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            @elseif($attributes->get('type') === 'danger')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            @endif
        </div>
        <div>
            <p class="font-semibold text-sm mb-1">{{ $title }}</p>
            <p class="font-base text-[0.8rem]">{{ $description }}</p>
        </div>
    </div>
</div>
