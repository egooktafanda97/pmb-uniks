<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta content="pendafataran mahasiswa baru uniks " name="title">
<meta content="pendafataran mahasiswa baru uniks , universitas islam kuantan singingi" name="description">
<meta
    content="pendafataran mahasiswa baru, uniks ,universitas islam kuantan singingi, pmb,teknik informatika, pertanian, pai,ti"
    name="keywords">
<meta content="index, follow" name="robots">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="English" name="language">

<head>
    @include('website.index.head')
    @yield('style')
    <style>
        /* .bg-trasparant {
            background: transparent;
        }

        .bg-home-page {
            margin-top: -100px;
        } */


        .loader-div {
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(51, 51, 51, .5);
            height: 100%;
            width: 100%;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999999999999;
        }

        .page-loader {
            position: relative;
            width: 10vw;
            height: 5vw;
            padding: 1.5vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-loader span {
            position: absolute;
            height: 0.8vw;
            width: 0.8vw;
            border-radius: 50%;
            background-color: #ff0;
        }

        .page-loader span:nth-child(1) {
            animation: loading-dotsA 0.5s infinite linear;
        }

        .page-loader span:nth-child(2) {
            animation: loading-dotsB 0.5s infinite linear;
        }

        @keyframes loading-dotsA {
            0% {
                transform: none;
            }

            25% {
                transform: translateX(2vw);
            }

            50% {
                transform: none;
            }

            75% {
                transform: translateY(2vw);
            }

            100% {
                transform: none;
            }
        }

        @keyframes loading-dotsB {
            0% {
                transform: none;
            }

            25% {
                transform: translateX(-2vw);
            }

            50% {
                transform: none;
            }

            75% {
                transform: translateY(-2vw);
            }

            100% {
                transform: none;
            }
        }
    </style>
</head>

<body class="wide" id="home">
    <div class="loader-div">
        <span class="page-loader">
            <span></span>
            <span></span>
        </span>
    </div>
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

        <div class="to-top" id="to-top"><i class="fa fa-angle-up"></i></div>

    </div>
    <!-- /WRAPPER -->

    @include('website.index.script')

    @yield('script')
</body>

</html>
