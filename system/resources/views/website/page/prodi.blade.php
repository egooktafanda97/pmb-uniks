@extends('website.index.index')
@section('style')
    <link href="{{ asset('public/node_modules/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
        @import url('https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css');

        #tsum-tabs h1 {
            padding: 50px 0;
            font-weight: 400;
            text-align: center;
        }

        #tsum-tabs p {
            margin: 0 0 20px;
            line-height: 1.5;
        }

        #tsum-tabs main {
            min-width: 320px;
            padding: 50px;
            margin: 0 auto;
            background: #fff;
        }

        #tsum-tabs section {
            display: none;
            padding: 20px 0 0;
            border-top: 1px solid #ddd;
        }

        #tsum-tabs input {
            display: none;
        }

        #tsum-tabs label {
            display: inline-block;
            margin: 0 0 -1px;
            padding: 15px 25px;
            font-weight: 600;
            text-align: center;
            color: #bbb;
            border: 1px solid transparent;
        }

        #tsum-tabs label:before {
            font-family: fontawesome;
            font-weight: normal;
            margin-right: 10px;
        }

        #tsum-tabs label[for*='1']:before {
            content: '\f1cb';
        }

        #tsum-tabs label[for*='2']:before {
            content: '\f17d';
        }

        #tsum-tabs label[for*='3']:before {
            content: '\f16b';
        }

        #tsum-tabs label[for*='4']:before {
            content: '\f1a9';
        }

        #tsum-tabs label:hover {
            color: #888;
            cursor: pointer;
        }

        #tsum-tabs input:checked+label {
            color: #555;
            border: 1px solid #ddd;
            border-top: 2px solid orange;
            border-bottom: 1px solid #fff;
        }

        #tsum-tabs #tab1:checked~#content1,
        #tsum-tabs #tab2:checked~#content2,
        #tsum-tabs #tab3:checked~#content3,
        #tsum-tabs #tab4:checked~#content4 {
            display: block;
        }

        @media screen and (max-width: 650px) {
            #tsum-tabs label {
                font-size: 0;
            }

            #tsum-tabs label:before {
                margin: 0;
                font-size: 18px;
            }
        }

        @media screen and (max-width: 400px) {
            #tsum-tabs label {
                padding: 15px;
            }
        }
    </style>
@endsection
@section('content')
    <!-- PAGE -->
    <section class="page-section jumbotron-section jb1 with-overlay"
        style="background-image: url('{{ asset('assets/prodi/thumbnail/' . $prodi->gambar) }}')">
        <div class="container">
            <div class="div-table">
                <div class="div-cell">
                    <div class="jumbotron text-center">
                        <h5 class="jumbotron-title-sub" data-animation-delay="700" data-animation="fadeIn">
                            PROGRAM STUDI
                        </h5>
                        <h1 class="jumbotron-title" data-animation-delay="500" data-animation="fadeIn">
                            {{ $prodi->nama_prodi }}
                            <br>
                            {{ $prodi->gelar }}
                        </h1>
                        {{-- <h4 class="jumbotron-title-sub"
                            data-animation-delay="700"
                            data-animation="fadeIn">
                            <span class="text-color">
                                <strong>FAKULTAS {{ $prodi->fakultas()->nama_fakultas ?? '-' }}</strong>
                            </span>
                        </h4> --}}
                        <h4 class="jumbotron-title-sub" data-animation-delay="700" data-animation="fadeIn">
                            <span class="text-color">
                                <strong>UNIVERSITAS ISLAM KUANTAN SINGINGI</strong>
                            </span>
                        </h4>
                        {{-- <h4 class="jumbotron-title-sub" data-animation-delay="700" data-animation="fadeIn">
                            <span class="text-color">
                                <strong>BIAYA / SMESTER : 3000000</strong>
                            </span>
                        </h4> --}}

                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /PAGE -->

    <!-- /BREADCRUMBS -->
    {{-- <div id="tsum-tabs" style="display: flex;justify-content: center;align-items: center; width: 100%;">
        <main style="width: 100% ;"">
            <input checked id="tab1" name="tabs" type="radio">
            <label for="tab1">Gallery</label>

            <input id="tab2" name="tabs" type="radio">
            <label for="tab2">Tentang</label>

            <input checked id="tab3" name="tabs" type="radio">
            <label for="tab3">Biaya Kuliah</label>

            <input id="tab4" name="tabs" type="radio">
            <label for="tab4">Drupal</label>

            <section class="content" id="content1">
                <p>
                    CONTENT FIR TAB 1
                </p>
            </section>

            <section class="content" id="content2">
                <p>
                    CONTENT FIR TAB 2
                </p>
            </section>

            <section class="content" id="content3">
                <br>
                <br>
                <h4 class="card">
                    Biaya / Smester: 300000
                </h4>
            </section>

            <section class="content" id="content4">
                <p>
                    CONTENT FIR TAB 4
                </p>
            </section>

        </main>
    </div> --}}
    <!-- PAGE GALERY -->
    {{-- <section class="page-section">
        <div class="container">

            <div class="row thumbnails portfolio">
                @foreach ($prodi->gallery_prodi as $item)
                    <div class="col-md-4 col-sm-6" data-animation-delay="200" data-animation="fadeInUp">
                        <div class="thumbnail no-border no-padding">
                            <div class="media">
                                <img alt="" src="assets/img/preview/portfolio/portfolio-x1.jpg">
                                <div class="caption hovered">
                                    <div class="caption-border"></div>
                                    <div class="caption-wrapper div-table">
                                        <div class="caption-inner div-cell">
                                            <p class="caption-buttons">
                                                <a class="btn caption-zoom" data-gal="prettyPhoto"
                                                    href="{{ asset('asset/' . $item->gambar) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="caption">
                                <h3 class="caption-title"><a href="#">Project Title</a></h3>
                                <p class="caption-text">Personal Portfolio Template</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="loading">
                <div class="loading__circle"></div>
                <div class="loading__text">Load More</div>
            </div>

        </div>
    </section> --}}
    <!-- /PAGE -->



    <!-- /PAGE -->
    <!-- PAGE -->
    {{-- <section class="page-section lg-padding-top xl-padding-bottom">
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
    </section> --}}
    <!-- /PAGE -->
@endsection

@section('script')
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
            toastr.error(`{{ $errors->first() }}`)
        </script>
    @endif
@endsection
