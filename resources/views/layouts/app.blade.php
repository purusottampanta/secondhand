<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.ico">

    <!-- Styles -->
    @section('stylesheet')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/new-theme-style.min.css') }}?<?php echo time(); ?>">
        <link href="{{ asset('css/mystyle.css') }}?<?php echo time(); ?>" rel="stylesheet">
    @show

    <!-- Main CSS File -->
</head>
<body>
    <div class="page-wrapper">
        @include('layouts.header')
        <div class="container">
            @include('layouts.returnmessage')
        </div>
        <main class="main">
            @yield('content')
        </main><!-- End .main -->

        <footer class="footer">
            @include('layouts.footer')
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->

    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        @include('layouts.mobile-menu')
    </div><!-- End .mobile-menu-container -->

    <div class="newsletter-popup mfp-hide" id="newsletter-popup-form" style="background-image: url(assets/images/newsletter_popup_bg.jpg)">
        @include('layouts.news-letter-popup')
    </div><!-- End .newsletter-popup -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    <!-- Plugins JS File -->
    {{-- <script src="assets/js/jquery.min.js"></script> --}}
    {{-- <script src="assets/js/bootstrap.bundle.min.js"></script> --}}
   {{--  <script src="assets/js/plugins.min.js"></script>

    <script src="assets/js/main.min.js"></script> --}}
    @section('javascript')
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/new-theme/plugins.min.js') }}"></script>
        <script src="{{ asset('js/new-theme/main.min.js') }}"></script>

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