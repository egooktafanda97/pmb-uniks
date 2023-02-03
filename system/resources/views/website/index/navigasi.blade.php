{{-- <section style="padding-left: 20px; padding-right: 20px; background: #111; ">
    <div style="width:100%; height: 30px; color:#fff; display: flex">
        <span>(0760) 561655</span>
    </div>
</section> --}}
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
                            <li><a href="{{ url('') }}">HOME</a></li>
                            <li><a href="{{ url('programstudi') }}">PRODI</a></li>
                            @if (!empty($pendaftaran))
                                <li><a href="{{ url('info_pendaftaran') }}">INFO PENDAFTARAN</a></li>
                            @endif
                            {{-- <li><a href="about.html">FORM PENDAFTARAN</a></li> --}}
                            {{-- <li><a href="about.html">Sisfo Uniks</a></li> --}}
                            {{-- <li><a href="about.html">FAQ</a></li> --}}
                            <li><a href="{{ url('kontak') }}">KONTAK</a></li>
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
