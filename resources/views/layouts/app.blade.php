<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>


    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="scroll-smooth relative m-0 min-h-screen pb-[256px]">
    @include('layouts.navigation')

    <main class="px-4 lg:px-12 pt-24 lg:pt-32 pb-20 mx-auto grid gap-4 border">
        {{ $slot }}
    </main>

    @include('layouts.footer')
</body>
</html>