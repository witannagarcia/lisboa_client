<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} | Cocina</title>
    <link rel="stylesheet" href="{{ asset('css/kitchen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
</head>

<body>
    @yield('content')
</body>
@yield('scripts')

</html>
