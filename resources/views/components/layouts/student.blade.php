<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">
    <title>NEUAS</title>
</head>
<body class="antialiased">
<div class="flex flex-col items-center justify-center h-screen">
    <h1 class="text-blue-900 text-3xl font-semibold">NEU APPOINTMENT SYSTEM</h1>
    {{ $title }}
</div>
</body>
</html>

