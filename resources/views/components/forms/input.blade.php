@php

     $class = 'block w-full shadow-sm sm:text-sm rounded-md ';

     if($errors->has($attributes->get('name'))){
         $class .= 'focus:ring-rose-700 focus:border-rose-700 border-rose-700';
     }else{
         $class .= 'focus:ring-brand focus:border-brand border-gray-300';
     }

@endphp

<input
    {{ $attributes->merge(
    [   'class'=> $class,
        'type' => ''
    ])}}
>
@if($errors->has($attributes->get('name')))
    <p class="text-rose-700 text-xs mt-2 ml-2"> @error($attributes->get('name')) {{ $message }} @enderror</p>
@endif
