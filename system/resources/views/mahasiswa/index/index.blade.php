<!doctype html>
<html lang="en">

<head>
    @include('mahasiswa.index.head')

    @yield('style')
    <title>Admisi</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        @include('mahasiswa.index.sidebar')
        @include('mahasiswa.index.top_nav')

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
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">kaptenCode.com</p>
        </footer>
    </div>
    @include('mahasiswa.index.footer')
</body>

</html>
