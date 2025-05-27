<!DOCTYPE html>
<html class="h-full" lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>403 | Forbidden</title>
        @vite('resources/css/app.css')
    </head>

    <body class="flex h-full items-center justify-center bg-gray-900">
        <div class="flex flex-col gap-4">
            <div class="text-2xl font-semibold text-red-500">
                403 |
                {{ $exception->getMessage() ?: 'You do not have access to this page.' }}
            </div>
            <div class="flex items-center justify-center gap-2">
                <a class="block text-center text-white underline-offset-4 hover:text-gray-100 hover:underline"
                    href="{{ route('home') }}">
                    Return to homepage
                </a>
                <p class="text-center text-gray-400">or</p>
                <button
                    class="block text-center text-white underline-offset-4 hover:text-gray-100 hover:underline"
                    onclick="window.history.back();">Go back</button>
            </div>
        </div>
    </body>

</html>
