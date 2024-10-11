<!DOCTYPE html>
<html lang="{{ config('app.locale', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div id="root"></div>
    @viteReactRefresh
    @vite(['resources/js/App.tsx'])
    <script>
        var APP_LOCALE = {{ Illuminate\Support\Js::from(config('app.locale', 'en')) }};
        var APP_URL = {{ Illuminate\Support\Js::from(config('app.url')) }};
        var APP_NAME = {{ Illuminate\Support\Js::from(config('app.name')) }};
        var COMPANY_NAME = "Docplanner Tech";
    </script>
</body>
</html>