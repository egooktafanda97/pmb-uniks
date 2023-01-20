<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('website.index.head')
    @yield('style')
</head>

<body class="wide"
      id="home">
    <!-- PRELOADER -->
    <div id="preloader">
        <div id="preloader-status">
            <div class="spinner">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
            <div id="preloader-title">Loading</div>
        </div>
    </div>
    <!-- /PRELOADER -->

    <!-- WRAPPER -->
    <div class="wrapper">

        @include('website.index.popUpLogin')
        @include('website.index.navigasi')
        <!-- CONTENT AREA -->
        <div class="content-area">

            @yield('content')

        </div>
        <!-- /CONTENT AREA -->

        @include('website.index.footer')

        <div class="to-top"
             id="to-top"><i class="fa fa-angle-up"></i></div>

    </div>
    <!-- /WRAPPER -->
    @include('website.index.script')
    @yield('script')
</body>

</html>
