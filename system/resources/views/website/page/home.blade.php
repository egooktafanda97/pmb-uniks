@extends('website.index.index')
@section('style')
    <link href="{{ asset('public/node_modules/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css">
    <style>
        .jumbotron-section.jb1 {
            /* margin-top: -110px; */
        }

        .sticky-wrapper {
            height: 50px;
            position: absolute;
            width: 100%;
            top: 50px
        }

        .header .top-bg {
            background: transparent !important;
        }

        .loader-page {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 99999999999999999999;
            display: none;
            justify-content: center;
            align-items: center;
        }

        .loader-page-loader {
            position: relative;
            width: 400px;
            height: 10px;
            background: #333;
            border-radius: 50px;
        }

        .loader-page-loader::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: #fff;
            border-radius: 100px;
            transform-origin: left;
            box-shadow: 0 0 30px 4px #7371fc;
            animation: animate-loader-page 8s linear infinite;
        }

        @keyframes animate-loader-page {

            0%,
            20% {
                transform: scaleX(0);
            }

            40% {
                transform: scaleX(1);
                transform-origin: left;
            }

            40.00001%,
            60% {
                transform: scaleX(1);
                transform-origin: right;
            }

            70%,
            100% {
                transform: scaleX(0);
                transform-origin: left;
            }
        }
    </style>
@endsection
@section('content')
    <div class="loader-page">
        <div class="loader-page-loader"></div>
    </div>
    <!-- PAGE -->
    <section class="page-section jumbotron-section jb1 with-overlay bg-home-page"
        style="background-image: url('{{ asset('assets/images/website/bg.jpg') }}')">
        <div class="container">

            <div class="div-table">
                <div class="div-cell">
                    <div class="jumbotron text-center">
                        <h5 class="jumbotron-title-sub" data-animation-delay="700" data-animation="fadeIn">
                            SISTEM INFORMASI
                        </h5>
                        <h1 class="jumbotron-title" data-animation-delay="500" data-animation="fadeIn">
                            PENERIMAAN MAHASISWA BARU
                            </span>
                        </h1>
                        <h4 class="jumbotron-title-sub" data-animation-delay="700" data-animation="fadeIn">
                            <span class="text-color">
                                <strong>UNIVERSITAS ISLAM KUANTAN SINGINGI</strong>
                            </span>
                        </h4>
                        @if ($pendaftaran != null)
                            <h4 class="jumbotron-title-sub" data-animation-delay="700" data-animation="fadeIn">
                                <span class="text-color">
                                    {{ tgl_i($pendaftaran->buka) ?? '- ' }}
                                </span>- {{ tgl_i($pendaftaran->tutup) ?? ' -' }}
                            </h4>
                            <p class="btn-row">
                                <a class="btn btn-theme btn-rounded btn-theme-lg" data-animation-delay="400"
                                    href="{{ url('register') }}">
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
    @if ($pengumuman)
        <section class="page-section no-padding-top md-padding-bottom featured-product featured-product-raise-above">
            <div class="container">
                <div class="featured-product-wrapper">
                    <div class="featured-product-label">PENGUMUMAN</div>
                    <div class="row">
                        <div class="col-md-7">
                            <a class="featured-product-image" href="#"><img alt=""
                                    src="{{ asset('assets/' . $pengumuman->poster) }}"></a>
                        </div>
                        <div class="col-md-5">
                            <div class="overflowed">
                                <h3 class="caption-title"><a href="#">{{ $pengumuman->hal }}</a></h3>
                                {{-- <span class="caption-category"><a href="#">psd</a></span> --}}
                            </div>
                            <h5 class="caption-title-sub">{{ $pengumuman->created_at }}</h5>
                            <br>
                            <div id="reset-this-root">
                                {!! $pengumuman->keterangan !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- /PAGE -->

    <!-- PAGE -->
    <section class="page-section sm-padding-top">
        <div class="container">

            <h2 class="section-title" data-animation-delay="100" data-animation="fadeInUp">
                <span>PROGRAM STUDI <span class="text-color">UNIKS</span></span>
                {{-- <small>Check our latest exciting templates</small> --}}
            </h2>

            <div class="row thumbnails portfolio isotope isotope-items">
                @foreach ($prodi as $item)
                    <div class="col-md-4 col-sm-6 isotope-item" data-animation-delay="300" data-animation="fadeInUp">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img alt=""
                                    src="{{ asset('assets/prodi/thumbnail/' . ($item->gambar ?? 'default.jpg')) }}"
                                    style="height: 250px">
                                <div class="caption hovered">
                                    <div class="caption-border"></div>
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a class="btn caption-link" href="{{ url('detail_prodi/' . $item->id) }}">
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
                                    <img alt="" src="{{ asset('assets/prodi/logo/' . $item->logo) }}"
                                        style="width: 100%">
                                </p>
                                <h3 class="caption-title"><a href="#">{{ $item->nama_prodi }}</a></h3>
                                <p class="caption-text">Terakreditasi {{ $item->akreditas }}</p>
                            </div>
                            <div class="caption-details">
                                <div class="row">
                                    <div class="col-xs-12 pcd-shop text-left">
                                        <div style="padding-left: 10px">
                                            <i class="fa fa-users"></i>Gelar {{ $item->gelar }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                        class="page-section no-padding-top md-padding-bottom featured-product featured-product-raise-above"
                        style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                        <img alt="" src="{{ asset('assets/imags/banner/1.jpg') }}" width="100%">
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

            <h2 class="section-title" data-animation-delay="100" data-animation="fadeInUp">
                <span>PIMPINAN <span class="text-color">UNIKS</span></span>
                <small>Rektoret Universitas Islam Kuantan Singingi</small>
            </h2>

            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation-delay="200"
                        data-animation="fadeInUp">
                        <div class="media">
                            <a href="#">
                                <img alt="Rektor" src="{{ asset('assets/images/pimpinan/rektor-min.png') }}" />
                            </a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">Dr. H. Nopriadi, S.K.M.,M.Kes</a>
                                <small>REKTOR</small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation-delay="300"
                        data-animation="fadeInUp">
                        <div class="media">
                            <a href="#">
                                <img alt="Rektor" src="{{ asset('assets/images/pimpinan/w1-min.png') }}" />
                            </a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">M. Irwan SE., MM</a>
                                <small>Wakil Rektor I</small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation-delay="400"
                        data-animation="fadeInUp">
                        <div class="media">
                            <a href="#">
                                <img alt="Rektor" src="{{ asset('assets/images/pimpinan/w2-min.png') }}" />
                            </a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">Desriadi, S.Sos., M.Si</a>
                                <small>Wakil Rektor II</small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail thumbnail-team no-border no-padding" data-animation-delay="500"
                        data-animation="fadeInUp">
                        <div class="media">
                            <a href="#">
                                <img alt="Rektor" src="{{ asset('assets/images/pimpinan/w3-min.png') }}" />
                            </a>
                        </div>
                        <div class="caption">
                            <h4 class="caption-title">
                                <a href="#">Afrinald Rizhan, SH., MH
                                </a>
                                <small>Wakil Rektor III</small>
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
    <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="{{ asset('public/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('public/js/site.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/node_modules/toastr/build/toastr.min.js') }}"></script>
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
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif
    <script>
        $("#logo-header").attr("src", `{{ asset('assets/logo/logo-header2.png') }}`)
        $(".nav>li>a").css("color", "#fff")
        $(".sticky-wrapper").css("position", "absolute");
        $(window).on("scroll", function() {
            var scroll = $(window).scrollTop();
            if (scroll > 50) {
                $(".nav>li>a").css("color", "#000")
                $("#logo-header").attr("src", `{{ asset('assets/logo/logo-header.png') }}`)
                $(".header-wrapper").removeClass("top-bg");
                // $(".sticky-wrapper").css("position", "fixed");
            } else {
                $("#logo-header").attr("src", `{{ asset('assets/logo/logo-header2.png') }}`)
                $(".header-wrapper").addClass("top-bg");
                $(".nav>li>a").css("color", "#fff")
                // $(".sticky-wrapper").css("position", "absolute");
            }
        });
        $("#formRegSub").submit(function(e) {
            e.preventDefault();

            const form_data = new FormData(e.target);
            __upSave(form_data);

            function __upSave(data) {
                $(".btn-loader").addClass("btn-loader--loading")

                const http_configure = {
                    data: data,
                    url: `{{ url('api/register') }}`,
                    errors: (error) => {
                        $(".btn-loader").removeClass("btn-loader--loading")
                        const {
                            response
                        } = error;
                        const {
                            request,
                            ...errorObject
                        } = response;
                        if (errorObject?.status != 200 && errorObject?.status < 500) {
                            const err = errorObject?.data?.error ?? {};
                            if (Object.keys(err).length > 0) {
                                for (const key in err) {
                                    if (err.hasOwnProperty(key)) {
                                        $(`[name='${key}']`).addClass("is-invalid")
                                        toastr.error(`${err[key][0]}`);
                                    }
                                }
                            }
                        } else {
                            swal({
                                title: "Ooops fatal error!",
                                text: "pastikan proses dilakukan dengan benar.",
                                icon: "error",
                                button: "Oke!",
                            });
                        }
                    },
                    response: (res) => {
                        if (res?.data?.result) {
                            window.location.href = `{{ url('auth/verify?s=') }}${res?.data?.result}`
                        }
                    }
                }

                save_inheader(http_configure);
            }
        });
    </script>
@endsection
