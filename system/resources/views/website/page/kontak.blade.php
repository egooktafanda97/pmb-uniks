@extends('website.index.index')
@section('style')
    <link href="{{ asset('public/css/site.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content-area">
        <!-- PAGE -->
        <section class="page-section sm-padding-top">
            <div class="container">

                <h2 class="section-title" data-animation-delay="100" data-animation="fadeInUp">
                    <span>KONTAK <span class="text-color">UNIKS</span></span>
                    {{-- <small>Check our latest exciting templates</small> --}}
                </h2>

                <div class="container">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="contact-info">

                                <div class="media-list">
                                    <div class="media">
                                        <i class="pull-left fa fa-phone"></i>
                                        <div class="media-body">
                                            <strong>Telephone</strong><br>
                                            <span style="color: #333; font-size: 1.2em">(0760) 561655</span>
                                            <br>



                                        </div>
                                    </div>
                                    <div class="media">
                                        <i class="pull-left fa fa-whatsapp" style="color: green"></i>
                                        <div class="media-body">
                                            <strong>Whatsapp</strong><br>
                                            <span style="color: #333; font-size: 1.2em">
                                                <a href="https://wa.me/6282286844808" style="color: blue">+6282286844808</a>
                                            </span>
                                            <br>
                                            <span style="color: #333; font-size: 1.2em">
                                                <a href="https://wa.me/6282174697276" style="color: blue">+6282174697276</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <i class="pull-left fa fa-envelope"></i>
                                        <div class="media-body">
                                            <strong>Email</strong><br>
                                            <span style="color: #333; font-size: 1.2em">info@uniks.ac.id,
                                                humas@uniks.ac.id</span>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <i class="pull-left fa fa-map-marker"></i>
                                        <div class="media-body">
                                            <strong>Alamat</strong><br>
                                            <span style="color: #333; font-size: 1.2em"> Jl. Gatot Subroto KM 7, Kebun
                                                Nenas, Teluk Kuantan, Sungai Jering, Kuantan
                                                Singingi, Kabupaten Kuantan Singingi, Riau 29566</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-8 text-left">

                            <!-- Contact form -->
                            <div class="">
                                <!-- |||||||||||||||||||||||||||||||| -->
                                <div>
                                    <div class="mapouter">
                                        <div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0"
                                                marginheight="0" marginwidth="0" scrolling="no"
                                                src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=-0.50737289443463, 101.50597805489492&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a
                                                href="https://embed-googlemap.com">google maps code generator</a></div>
                                        <style>
                                            .mapouter {
                                                position: relative;
                                                text-align: right;
                                                width: 100%;
                                                height: 500px;
                                            }

                                            .gmap_canvas {
                                                overflow: hidden;
                                                background: none !important;
                                                width: 100%;
                                                height: 500px;
                                            }

                                            .gmap_iframe {
                                                width: 100% !important;
                                                height: 500px !important;
                                            }
                                        </style>
                                    </div>
                                </div>
                                <!-- |||||||||||||||||||||||||||||||| -->
                            </div>
                            <!-- /Contact form -->

                        </div>

                    </div>



                </div>
            </div>
        </section>
        <!-- /PAGE -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
