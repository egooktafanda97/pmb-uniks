@extends('website.index.index')
@section('style')
    <link href="{{ asset('public/node_modules/toastr/build/toastr.css') }}"
          rel="stylesheet"
          type="text/css">
@endsection
@section('content')
    <!-- PAGE -->
    <section class="page-section jumbotron-section jb1 with-overlay"
             style="background-image: url('https://uniks.ac.id/images/slides/KAJARI-KUANSING:-GEDUNG-UNIKS-BISA-DIFUNGSIKAN-ASALKAN-ADA-IZIN-PEMDA.jpg')">
        <div class="container">

            <div class="div-table">
                <div class="div-cell">
                    <div class="jumbotron text-center">
                        <h5 class="jumbotron-title-sub"
                            data-animation-delay="700"
                            data-animation="fadeIn">
                            SISTEM INFORMASI
                        </h5>
                        <h1 class="jumbotron-title"
                            data-animation-delay="500"
                            data-animation="fadeIn">
                            PENERIMAAN MAHASISWA BARU
                            </span>
                        </h1>
                        <h4 class="jumbotron-title-sub"
                            data-animation-delay="700"
                            data-animation="fadeIn">
                            <span class="text-color">
                                <strong>UNIVERSITAS ISLAM KUANTAN SINGINGI</strong>
                            </span>
                        </h4>
                        @if ($pendaftaran != null)
                            <h4 class="jumbotron-title-sub"
                                data-animation-delay="700"
                                data-animation="fadeIn">
                                <span class="text-color">
                                    {{ tgl_i($pendaftaran->buka) ?? '- ' }}
                                </span>- {{ tgl_i($pendaftaran->tutup) ?? ' -' }}
                            </h4>
                            <p class="btn-row">
                                <a class="btn btn-theme btn-rounded btn-theme-lg"
                                   data-animation-delay="400"
                                   data-animation="fadeInLeft"
                                   data-target="#popup-sign-up"
                                   data-toggle="modal"
                                   href="#">
                                    DAFTAR SEKARANG
                                </a>
                            </p>
                        @endif
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
                        <a class="featured-product-image"
                           href="#"><img alt=""
                                 src="assets/img/preview/featured-product-1.jpg"></a>
                    </div>
                    <div class="col-md-5">
                        <div class="overflowed">
                            <h3 class="caption-title"><a href="#">PENGUMUMAN</a></h3>
                            <span class="caption-category"><a href="#">psd</a></span>
                        </div>
                        <h5 class="caption-title-sub">Lorem ipsum dolor sit amet</h5>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Recusandae laudantium aliquam
                            provident nam, sequi cumque accusamus ducimus exercitationem, quia qui quaerat quo fuga debitis
                            vero, a cupiditate minima fugiat expedita!
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit, expedita ullam quas hic,
                            deleniti officia excepturi mollitia corporis recusandae omnis eum fugit aliquam placeat suscipit
                            in nesciunt nihil totam vero!
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

            <h2 class="section-title"
                data-animation-delay="100"
                data-animation="fadeInUp">
                <span>PROGRAM STUDI <span class="text-color">UNIKS</span></span>
                {{-- <small>Check our latest exciting templates</small> --}}
            </h2>

            <div class="row thumbnails portfolio isotope isotope-items">
                @for ($i = 0; $i < 10; $i++)
                    <div class="col-md-4 col-sm-6 isotope-item"
                         data-animation-delay="300"
                         data-animation="fadeInUp">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img alt=""
                                     src="{{ asset(config('app.site-assets')) }}/assets/img/preview/portfolio/portfolio-x6.jpg">
                                <div class="caption hovered">
                                    <div class="caption-border"></div>
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a class="btn caption-link"
                                                   href="themes-single.html">
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
                                    <img alt=""
                                         src="{{ asset('assets/logo/logo.png') }}"
                                         style="width: 100%">
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
                                    <iframe allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen
                                            frameborder="0"
                                            height="315"
                                            src="https://www.youtube.com/embed/TbApNye4YoQ?start=116"
                                            title="YouTube video player"
                                            width="560"></iframe>
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

            <h2 class="section-title"
                data-animation-delay="100"
                data-animation="fadeInUp">
                <span>PIMPINAN <span class="text-color">UNIKS</span></span>
                <small>Rektoret Universitas Islam Kuantan Singingi</small>
            </h2>

            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding"
                         data-animation-delay="200"
                         data-animation="fadeInUp">
                        <div class="media">
                            <a href="#"><img alt=""
                                     src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x1.jpg" /></a>
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
                    <div class="thumbnail thumbnail-team no-border no-padding"
                         data-animation-delay="300"
                         data-animation="fadeInUp">
                        <div class="media">
                            <a href="#"><img alt=""
                                     src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x2.jpg" /></a>
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
                    <div class="thumbnail thumbnail-team no-border no-padding"
                         data-animation-delay="400"
                         data-animation="fadeInUp">
                        <div class="media">
                            <a href="#"><img alt=""
                                     src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x3.jpg" /></a>
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
                    <div class="thumbnail thumbnail-team no-border no-padding"
                         data-animation-delay="500"
                         data-animation="fadeInUp">
                        <div class="media">
                            <a href="#"><img alt=""
                                     src="{{ asset(config('app.site-assets')) }}/assets/img/preview/team/team-270x345x4.jpg" /></a>
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

@section('script')
    <script type="text/javascript"
            src="{{ asset('public/node_modules/toastr/build/toastr.min.js') }}"></script>
    @if ($errors->any() && $errors->first('status') == 201)
        <script>
            const errors = JSON.parse(`{{ $errors->first() }}`.replace(/&quot;/g, '"'));
            if (errors) {
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        toastr.error(`${errors[key][0]}`, key)
                    }
                }
            }
        </script>
    @elseif($errors->any() && $errors->first('status') == 501)
        <script>
            toastr.error(`{{ $errors->first() }}`)
        </script>
    @endif
@endsection
