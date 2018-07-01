<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('meta-tag')
        <meta property="og:title" content="Buy Sell used second hand furniture" />
        <meta property="og:description" content="You Sell We Buy You Buy We Sell | secondhand | furniture | office, home furniture | furniture prices| online shopping| home shopping" />
        <meta property="og:image" content="{{ asset('img/sliders/slide1.jpg') }}" />
        <meta name="description" content="furniture stores | furniture price in nepal | secondhand shop, used furniture, office, home, furniture | buy and sell | chair | sofa | bed | bookcase |office desk | online shopping | home shopping | https://www.facebook.com/secondhandshop.ktm">
        <meta name="keywords" content="furniture stores, furniture price, used furniture, office, home, furniture, buy and sell, chair, sofa, bed, bookcase, office desk, online shopping, home shopping">
    @show
    <title>
        @section('title')
            Buy Sell used second hand furniture | furniture store | furniture price | online shopping | home shopping
        @show
    </title>
    
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

         <script>
             $(document).ready(function(){
                setTimeout(function() {
                  $('#success-return, #error-return').fadeOut('slow');
                }, 3000); // <-- time in milliseconds
            });
          </script>

    @show
</body>
</html>
