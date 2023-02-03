<!-- HEADER -->
<header class="header fixed">
    <div class="header-wrapper top-bg">
        <div class="container">

            <!-- Logo -->
            <div class="logo">
                <a href="index.html">
                    <img alt="uniks" id="logo-header" src="{{ asset('assets/logo/logo-header.png') }}" />
                </a>
            </div>
            <!-- /Logo -->

            <!-- Mobile menu toggle button -->
            <a class="menu-toggle btn btn-theme-transparent" href="#"><i class="fa fa-bars"></i></a>
            <!-- /Mobile menu toggle button -->

            <!-- Navigation -->
            <nav class="navigation closed clearfix">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <!-- navigation menu -->
                        <a class="menu-toggle-close btn" href="#"><i class="fa fa-times"></i></a>
                        <ul class="nav sf-menu">
                            <li><a href="about.html">HOME</a></li>
                            <li><a href="about.html">PRODI</a></li>
                            <li><a href="about.html">TENTANG</a></li>
                            <li><a href="about.html">BIAYA KULIAH</a></li>
                            <li><a href="about.html">GALLERY</a></li>
                            <li>
                                <span class="sign-in-button">
                                    <a class="btn btn-theme btn-theme-sm btn-rounded" href="{{ url('login') }}">SIGN
                                        IN</a>
                                </span>
                            </li>
                        </ul>
                        <!-- /navigation menu -->
                    </div>
                </div>
                <!-- Add Scroll Bar -->
                <div class="swiper-scrollbar"></div>
            </nav>
            <!-- /Navigation -->

        </div>
    </div>

</header>
<!-- /HEADER -->
