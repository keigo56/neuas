<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">
    <title>NEU Appointment System</title>
</head>
<body class="antialiased pb-96">
    {{ $slot }}
<script defer
        src="https://unpkg.com/alpinejs@3.10.1/dist/cdn.min.js"></script>
</body>
</html>

