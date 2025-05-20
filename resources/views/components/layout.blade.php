<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <title>{{ $title ?? '' }} | To Do App</title>
        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>

    <body class="h-dvh bg-slate-900 text-gray-100 antialiased">
        <div class="m-auto grid h-dvh w-full max-w-[1298px] grid-cols-1 grid-rows-[auto_1fr_auto]">
            <x-header></x-header>
            <div class="mt-5">
                {{ $slot }}
            </div>
            <x-footer></x-footer>
        </div>
    </body>

</html>
