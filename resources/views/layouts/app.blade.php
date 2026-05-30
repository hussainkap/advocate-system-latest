<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Advocate System'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen lg:flex">
        @include('partials.sidebar')

        <div class="flex-1">
            @include('partials.header')
            @include('partials.mobile-nav')

            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
