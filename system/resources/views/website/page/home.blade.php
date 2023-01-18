@extends('website.index.index')
@section('content')
    <!-- PAGE -->
    <section class="page-section jumbotron-section jb1 with-overlay"
        style="background-image: url('https://uniks.ac.id/images/slides/KAJARI-KUANSING:-GEDUNG-UNIKS-BISA-DIFUNGSIKAN-ASALKAN-ADA-IZIN-PEMDA.jpg')">
        <div class="container">

            <div class="div-table">
                <div class="div-cell">

                    <div class="jumbotron text-center">
                        <h5 class="jumbotron-title-sub" data-animation="fadeIn" data-animation-delay="700">
                            PORTAL INFORMASI</h5>
                        <h1 class="jumbotron-title" data-animation="fadeIn" data-animation-delay="500">PENERIMAAN MAHASISWA
                            BARU</span>
                        </h1>
                        <h4 class="jumbotron-title-sub" data-animation="fadeIn" data-animation-delay="700">
                            <span class="text-color"><strong>UNIVERSITAS ISLAM KUANTAN SINGINGI</strong></span>
                        </h4>
                        <h4 class="jumbotron-title-sub" data-animation="fadeIn" data-animation-delay="700">
                            <span class="text-color">19 JANUARI 2023</span> 20 APRIL 2023
                        </h4>
                        <p class="btn-row">
                            <a class="btn btn-theme btn-rounded btn-theme-lg" href="#" data-toggle="modal"
                                data-target="#popup-sign-up" data-animation="fadeInLeft" data-animation-delay="400">
                                DAFTAR SEKARANG
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- /PAGE -->

    <!-- PAGE -->
    <section class="page-section no-padding-top md-padding-bottom featured-product featured-product-raise-above">
        <div class="container">
            <div class="featured-product-wrapper">
                <div class="featured-product-label">Featured</div>
                <div class="row">
                    <div class="col-md-7">
                        <a class="featured-product-image" href="#"><img
                                src="assets/img/preview/featured-product-1.jpg" alt=""></a>
                    </div>
                    <div class="col-md-5">
                        <div class="overflowed">
                            <h3 class="caption-title"><a href="#">Gentle</a></h3>
                            <span class="caption-category"><a href="#">psd</a></span>
                        </div>
                        <h5 class="caption-title-sub">Creative Personal vCard Template</h5>
                        <p class="caption-text">
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit
                            esse molestie consequat, vel illum dolore eu feugiat nulla facilisis...
                        </p>
                        <div class="caption-details">
                            <ul>
                                <li class="fpcd-price">Price: <span class="text-color">$12</span></li>
                                <li class="fpcd-shop"><i class="fa fa-shopping-cart"></i>10 Sold</li>
                                <li class="fpcd-like"><i class="fa fa-heart"></i>163</li>
                            </ul>
                        </div>
                        <p class="caption-buttons">
                            <a class="btn btn-theme btn-theme-green btn-rounded" href="#">Purchase This
                                Template</a><a class="btn btn-theme btn-theme-dark btn-rounded" href="#">Live Demo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /PAGE -->

    <!-- PAGE -->
    <section class="page-section sm-padding-top">
        <div class="container">

            <h2 class="section-title" data-animation="fadeInUp" data-animation-delay="100">
                <span>PROGRAM STUDI <span class="text-color">UNIKS</span></span>
                {{-- <small>Check our latest exciting templates</small> --}}
            </h2>

            <div class="row thumbnails portfolio isotope isotope-items">
                @for ($i = 0; $i < 10; $i++)
                    <div class="col-md-4 col-sm-6 isotope-item" data-animation="fadeInUp" data-animation-delay="300">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img src="{{ asset(config('app.site-assets')) }}/assets/img/preview/portfolio/portfolio-x6.jpg"
                                    alt="">
                                <div class="caption hovered">
                                    <div class="caption-border"></div>
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a href="themes-single.html" class="btn caption-link">
                                                    Lihat Prodi
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <p class="caption-price"
                                    style="background: #fff;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                    <img src="{{ asset('assets/logo/logo.png') }}" style="width: 100%" alt="">
                                </p>
                                <h3 class="caption-title"><a href="#">Project Title</a></h3>
                                <p class="caption-text">Personal Portfolio Template</p>
                            </div>
                            <div class="caption-details">
                                <div class="row">
                                    <div class="col-xs-12 pcd-shop text-left">
                                        <div style="padding-left: 10px">
                                            <i class="fa fa-users"></i>104 Mahasiswa
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- <div class="loading">
                <div class="loading__circle"></div>
                <div class="loading__text">Load More</div>
            </div> --}}

        </div>
    </section>
    <!-- /PAGE -->
    <!-- PAGE -->
    <section class="page-section light lg-padding-top xl-padding-bottom">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <!-- PAGE -->
                    <section
                        class="page-section no-padding-top md-padding-bottom featured-product featured-product-raise-above">
                        <div class="container">
                            <div class="featured-product-wrapper">
                                <div class="featured-product-label">Featured</div>
                                <div class="row">
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/TbApNye4YoQ?start=116"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /PAGE -->
                </div>
            </div>

        </div>
    </section>
    <!-- /PAGE -->
    <!-- PAGE -->
    <section class="page-section lg-padding-top xl-padding-bottom">
        <div class="container">

            <h2 class="section-title" data-animation="fadeInUp" data-animation-delay="100">
                <span>PIMPINAN <span class="text-color">UNIKS</span></span>
                <small>Rektoret Universitas Islam Kuantan Singingi</small>
            </h2>

            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation="fadeInUp"
                        data-animation-delay="200">
                        <div class="media">
                            <a href="#"><img
                                    src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x1.jpg"
                                    alt="" /></a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">David Ramon</a>
                                <small>Design Director</small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation="fadeInUp"
                        data-animation-delay="300">
                        <div class="media">
                            <a href="#"><img
                                    src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x2.jpg"
                                    alt="" /></a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">Mark Jason</a>
                                <small>Coding Guru</small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation="fadeInUp"
                        data-animation-delay="400">
                        <div class="media">
                            <a href="#"><img
                                    src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x3.jpg"
                                    alt="" /></a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">Jasica Arther</a>
                                <small>Product Designer</small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation="fadeInUp"
                        data-animation-delay="500">
                        <div class="media">
                            <a href="#"><img
                                    src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x4.jpg"
                                    alt="" /></a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">John Diggle</a>
                                <small>Wordpress Ninja</small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /PAGE -->



    {{-- 
    <!-- PAGE -->
    <section class="page-section light no-padding subscribe">
        <div class="container">

            <div class="form-subscribe-wrapper">
                <div class="row div-table">
                    <div class="col-sm-6 col-md-5 div-cell" data-animation="fadeInUp" data-animation-delay="200">
                        <h4 class="form-subscribe-title">SUBSCRIBE TO OUR NEWSLETTER</h4>
                        <p class="form-subscribe-text">
                            Subscribe to our newsletter for latest News, Updates,
                            Templates directly in your inbox.
                        </p>
                    </div>
                    <div class="col-sm-6 col-md-7 div-cell" data-animation="fadeInUp" data-animation-delay="400">
                        <!-- Subscribe form -->
                        <form action="#" class="form-subscribe" id="form-subscribe">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="formSubscribeEmail" class="sr-only">Enter your email
                                            address</label>
                                        <input type="email" class="form-control" name="formSubscribeEmail"
                                            id="formSubscribeEmail" placeholder="Enter your email here" required
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <button type="submit"
                                        class="btn btn-block btn-submit btn-theme btn-theme-dark">Subscribe
                                        Today</button>
                                </div>
                            </div>
                        </form>
                        <!-- Subscribe form -->
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /PAGE --> --}}
@endsection
