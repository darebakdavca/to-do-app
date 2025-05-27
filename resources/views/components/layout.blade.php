<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="image/x-icon" href="{{ asset('favicon.ico') }}" rel="icon">
        <title>{{ $title ?? '' }} | To Do App</title>
        @vite('resources/css/app.css')
        @vite('resources/js/jquery.js')
        <link type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"
            rel="stylesheet">
    </head>

    <body class="h-dvh bg-slate-900 text-gray-100 antialiased">
        <div class="m-auto grid h-dvh w-full max-w-[1298px] grid-cols-1 grid-rows-[auto_1fr_auto]">
            <x-header></x-header>
            <div class="mt-5">
                {{ $slot }}
            </div>
            <x-footer></x-footer>
        </div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        @vite('resources/js/infoPopUp.js')
    </body>

</html>
