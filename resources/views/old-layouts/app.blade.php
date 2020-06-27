<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('meta-tag')
        <meta property="og:title" content="SECOND HAND SHOP" />
        <meta property="og:description" content="Buy Sell Used Furniture" />
        <meta property="og:image" content="{{ asset('img/sliders/slide1.jpg') }}" />

        <meta name="description" content="Buy-sell used home and office furniture in Kathmandu. Find sofa set, dinning table, bed, daraz, office table, chair, file rack, reception table and more">
        <meta name="keywords" content="buy, sell, used furniture, home furniture, office furniture, sofa set, tea table, tv cabinet, palang, box palang, bed, lowbed, daraz, wardrobe, cupboard, carpets, curtains, chair, office table, ofice revolving chair, reception table, cash counter, file rack, ofice sofa, visitor's sofa, refrigerator, fridge, washing machine, music system, woofer, speaker">
    @show
    <title>
        @section('title')
            SECOND HAND SHOP - Buy Sell Used Furniture
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
