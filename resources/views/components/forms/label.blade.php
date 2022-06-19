@php

    $class = 'block text-sm font-medium mb-2 ';

    if($errors->has($attributes->get('for'))){
        $class .= 'text-rose-700';
    }else{
        $class .= 'text-gray-700';
    }

@endphp

<label {{ $attributes->merge(['class'=> $class ]) }}>{{ $slot }}</label>
