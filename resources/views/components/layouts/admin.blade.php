<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen" x-data>

<div
    class="relative flex w-full flex-col md:flex-row"
>
    <livewire:admin.admin-sidebar/>

    <div id="main-content" class="h-svh w-full overflow-y-auto bg-gradient-to-br from-blue-500 to-indigo-300 pt-20">
        {{ $slot }}

        <livewire:footer />
    </div>
</div>


</body>
</html>
