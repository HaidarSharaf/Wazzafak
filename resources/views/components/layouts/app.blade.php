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
<body
    class="bg-gray-200 bg-gradient-to-br from-blue-600 to-indigo-300 min-h-screen text-white flex p-6 lg:p-8 items-center lg:justify-start flex-col"
    x-data
>
    <div class="w-full lg:max-w-6xl md:max-w-4xl sm:max-w-2xl max-w-[450px]">

        <header class="w-full lg:max-w-6xl md:max-w-4xl sm:max-w-2xl max-w-[450px] top-0 z-50 text-sm mb-2 not-has-[nav]:hidden">
            <livewire:navbar />
        </header>

        <div
            class="flex items-start justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0 my-10"
        >
            <main
                class="flex w-full flex-col-reverse justify-center lg:max-w-6xl md:max-w-4xl sm:max-w-2xl max-w-[450px] lg:flex-row"
            >
                {{ $slot }}

            </main>
        </div>

        <livewire:footer />
    </div>

</body>
</html>
