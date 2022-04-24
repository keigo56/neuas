@props([
    'sortable' => false,
    'field' => '',
    'sortField' => '',
    'sortDirection' => '',
    'textAlign' => 'start',
])

@php
    if($textAlign === 'left') $textAlign = 'start';
    if($textAlign === 'right') $textAlign = 'end';

    $class = " relative max-w-max whitespace-nowrap ";

    if($sortField === $field && $sortField !== "") $class .= "bg-blue-100 ";
    if($sortable) $class .= " hover:bg-blue-100 ";

@endphp

<th {{ $attributes->merge(['class'=> $class]) }} data-key="{{ $field }}">
    @if($sortable)
        <div wire:click="sortBy('{{ $field }}')" class="mt-0.5 px-2 flex justify-{{ $textAlign }} items-center cursor-pointer min-w-0">
            <div class="flex flex-row @if($textAlign === 'end') flex-row-reverse @endif">
                <div>
                    {{ $slot }}
                </div>
                @if($sortField === $field)
                    @if($sortDirection === 'asc')
                        <div>
                            <x-datatable.icons.arrow-up/>
                        </div>
                    @else
                        <div>
                            <x-datatable.icons.arrow-down/>
                        </div>
                    @endif
                @else
                    <div class="opacity-0">
                        <x-datatable.icons.arrow-up/>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="flex px-2 py-2">
            <div class="mt-0.5">
                {{ $slot }}
            </div>
        </div>
    @endif
</th>
