<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta content="pendafataran mahasiswa baru uniks "
      name="title">
<meta content="pendafataran mahasiswa baru uniks , universitas islam kuantan singingi"
      name="description">
<meta content="pendafataran mahasiswa baru, uniks ,universitas islam kuantan singingi, pmb,teknik informatika, pertanian, pai,ti"
      name="keywords">
<meta content="index, follow"
      name="robots">
<meta content="text/html; charset=utf-8"
      http-equiv="Content-Type">
<meta content="English"
      name="language">

<head>
    @include('website.layout_prodi.head')
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

        @include('website.layout_prodi.popUpLogin')
        @include('website.layout_prodi.navigasi')
        <!-- CONTENT AREA -->
        <div class="content-area">

            @yield('content')

        </div>
        <!-- /CONTENT AREA -->

        @include('website.layout_prodi.footer')

        <div class="to-top"
             id="to-top"><i class="fa fa-angle-up"></i></div>

    </div>
    <!-- /WRAPPER -->

    @include('website.layout_prodi.script')

    @yield('script')
</body>

</html>
