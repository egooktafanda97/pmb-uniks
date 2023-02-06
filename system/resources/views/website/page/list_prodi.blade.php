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
                                        style="height: 200px">
                                    <div class="caption hovered">
                                        <div class="caption-border"></div>
                                        <div class="caption-wrapper div-table">
                                            <div class="caption-inner div-cell">
                                                <p class="caption-buttons">
                                                    <a class="btn caption-link"
                                                        href="{{ url('detail_prodi/' . $item->id) }}">
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
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
