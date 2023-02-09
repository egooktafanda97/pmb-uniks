<!doctype html>
<html lang="en">

<head>
    @include('admin.index.head')
    <link href="{{ asset('public/css/site.css') }}" rel="stylesheet" />
    @yield('style')
    <title>Admisi</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        @include('admin.index.sidebar')
        @include('admin.index.top_nav')

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a class="back-to-top" href="javaScript:;"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0"><a href="https://www.uniks.ac.id/">@uniks {{ date('Y') }}</a></p>
        </footer>
    </div>
    @include('admin.index.footer')
</body>

</html>
