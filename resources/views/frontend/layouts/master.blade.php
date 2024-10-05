<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <title>Sazao || e-Commerce HTML Template</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css')}}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>

        <!--============================
        HEADER START
    ==============================-->
   @include('frontend.layouts.header')


       <!--============================
        MAIN MENU START
    ==============================-->
  @include('frontend.layouts.menu')


      <!--============================
        BANNER PART 2 START
    ==============================-->
    @include('frontend.home.sections.banner-slider')
    <!--============================
        BANNER PART 2 END
    ==============================-->


    <!--============================
        FLASH SELL START
    ==============================-->
    @include('frontend.home.sections.flash-sale')
    <!--============================
        FLASH SELL END
    ==============================-->


    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
    @include('frontend.home.sections.top-category-product')
    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
    @include('frontend.home.sections.brand-slider')
    <!--============================
        BRAND SLIDER END
    ==============================-->


    <!--============================
        SINGLE BANNER START
    ==============================-->
    @include('frontend.home.sections.single-banner')
    <!--============================
        SINGLE BANNER END
    ==============================-->


    <!--============================
        HOT DEALS START
    ==============================-->
    @include('frontend.home.sections.hot-deals')
    <!--============================
        HOT DEALS END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @include('frontend.home.sections.category-product-slider-one')
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @include('frontend.home.sections.category-product-slider-two')

    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        LARGE BANNER  START
    ==============================-->
    @include('frontend.home.sections.large-banner')

    <!--============================
        LARGE BANNER  END
    ==============================-->


    <!--============================
        WEEKLY BEST ITEM START
    ==============================-->
    @include('frontend.home.sections.weekly-best-item')
    <!--============================
        WEEKLY BEST ITEM END
    ==============================-->


    <!--============================
      HOME SERVICES START
    ==============================-->
    @include('frontend.home.sections.services')
    <!--============================
        HOME SERVICES END
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
    @include('frontend.home.sections.blog')
    <!--============================
        HOME BLOGS END
    ==============================-->


    @yield('content')


  @include('frontend.layouts.footer')

    <!--============================
        SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
        SCROLL BUTTON  END
    ==============================-->


    <!--jquery library js-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/js/Font-Awesome.js')}}"></script>
    <!--select2 js-->
    <script src="{{ asset('frontend/js/select2.min.js')}}"></script>
    <!--slick slider js-->
    <script src="{{ asset('frontend/js/slick.min.js')}}"></script>
    <!--simplyCountdown js-->
    <script src="{{ asset('frontend/js/simplyCountdown.js')}}"></script>
    <!--product zoomer js-->
    <script src="{{ asset('frontend/js/jquery.exzoom.js')}}"></script>
    <!--nice-number js-->
    <script src="{{ asset('frontend/js/jquery.nice-number.min.js')}}"></script>
    <!--counter js-->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js')}}"></script>
    <!--add row js-->
    <script src="{{ asset('frontend/js/add_row_custon.js')}}"></script>
    <!--multiple-image-video js-->
    <script src="{{ asset('frontend/js/multiple-image-video.js')}}"></script>
    <!--sticky sidebar js-->
    <script src="{{ asset('frontend/js/sticky_sidebar.js')}}"></script>
    <!--price ranger js-->
    <script src="{{ asset('frontend/js/ranger_jquery-ui.min.js')}}"></script>
    <script src="{{ asset('frontend/js/ranger_slider.js')}}"></script>
    <!--isotope js-->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js')}}"></script>
    <!--venobox js-->
    <script src="{{ asset('frontend/js/venobox.min.js')}}"></script>
    <!--classycountdown js-->
    <script src="{{ asset('frontend/js/jquery.classycountdown.js')}}"></script>

    <!--main/custom js-->
    <script src="{{ asset('frontend/js/main.js')}}"></script>
</body>

</html>