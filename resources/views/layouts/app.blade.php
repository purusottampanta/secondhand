<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @section('stylesheet')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
        <link href="{{ asset('css/mystyle.css') }}?<?php echo time(); ?>" rel="stylesheet">
    @show
</head>
<body>
    <div id="app">
        @include('layouts.topheader')
        
        <div class="container">
            @include('layouts.returnmessage')
        </div>

        @yield('content')

        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    @section('javascript')
        <script src="{{ asset('js/app.js') }}"></script>
    @show
</body>
</html>
