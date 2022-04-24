@props([
    'sortable' => false,
    'field' => '',
    'sortField' => '',
    'sortDirection' => '',
    'textAlign' => 'text-center',
])

@php
    if($textAlign === 'left') $textAlign = 'text-left';
    if($textAlign === 'right') $textAlign = 'text-right';
    if($textAlign === 'center') $textAlign = 'text-center';

    $class = "{$textAlign} max-w-0 overflow-ellipsis overflow-hidden whitespace-nowrap";

    if($sortField === $field && $sortField !== "") $class .= " bg-blue-50 ";
    if($sortable) $class .= "";

@endphp


<td {{ $attributes->merge(['class'=> $class]) }}>
    {{ $slot }}
</td>
