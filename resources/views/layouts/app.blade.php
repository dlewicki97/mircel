<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Daniel Lewicki">
    <title>{{ $meta_title }}</title>
    <meta name="description" content="{{ $meta_description }}">

    <link rel="icon" href="{{ asset('img/bolt.png') }}" type="image/png">
    <link type="text/css" rel="stylesheet" href="{{ asset('magiczoomplus/magiczoomplus.css') }}" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ asset('js/owlcarousel/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('magiczoomplus/magiczoomplus.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>

    </script>
</body>

</html>
