<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Blank title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-body-tertiary">
    <header>
        @include('layouts.site.partials.header')
    </header>

    <main class="min-vh-100">
        @yield('content')
    </main>

    <footer>
        @include('layouts.site.partials.footer')
    </footer>
    @livewireScripts
</body>
</html>
