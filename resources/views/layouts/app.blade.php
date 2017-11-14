<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title"              content="When Great Minds Don’t Think Alike" />
    <meta property="og:description"        content="How much does culture influence creative thinking?" />
    <meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    @section('stylesheet')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/temp-style.css') }}?<?php echo time(); ?>">
        <link href="{{ asset('css/mystyle.css') }}?<?php echo time(); ?>" rel="stylesheet">
    @show
</head>
<body style="background-color: white">
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
        <script src="{{ asset('js/temp-main.js') }}"></script>


    @show
</body>
</html>
