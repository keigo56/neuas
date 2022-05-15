<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">
    @livewireStyles
    <title>{{ $title }}</title>
</head>
<body class="box-border antialiased font-inter overflow-x-hidden">
    {{ $slot }}

@livewireScripts
<script defer src="https://unpkg.com/alpinejs@3.10.1/dist/cdn.min.js"></script>
@stack('datatable-scripts')
</body>
</html>
