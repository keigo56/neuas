@props([
    'selected' => ''
])

@php
    $routes = [

        'appointment_lists' => [
            'name' => 'Appointment Lists',
            'path' => '/student/appointment-lists',
        ],
        'my_account' => [
            'name' => 'My Account',
            'path' => '/student/my-account',
        ]

    ];

    if($selected === '') $selected = 'appointment_lists';

    $routes = [];

@endphp
<x-navigation.navbar :routes="$routes" :selected="$selected"/>
