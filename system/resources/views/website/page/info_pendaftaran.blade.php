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
                    <span>INFORMASI <span class="text-color">PENDAFTARAN</span></span>
                    {{-- <small>Check our latest exciting templates</small> --}}
                </h2>
            </div>
        </section>
        <!-- /PAGE -->
        <section class="page-section no-padding-top md-padding-bottom featured-product featured-product-raise-above">
            <div class="container">
                <div class="featured-product-wrapper">
                    {{-- <div class="featured-product-label">Featured</div> --}}
                    <div class="row">
                        <div class="col-md-7">
                            <a class="featured-product-image" href="#">
                                <img alt="" src="{{ asset('assets/' . $pendaftaran->brosur) }}"></a>
                        </div>
                        <div class="col-md-5">
                            <div class="overflowed">
                                <h5 class="caption-title"><a href="#" style="color: #333">PENDAFTARAN
                                    </a>
                                </h5>
                                <span class="caption-category"><a
                                        href="#">{{ $pendaftaran->pendaftaran ?? '-' }}</a></span>
                            </div>
                            <h5 class="caption-title-sub">Tahun Ajaran {{ $pendaftaran->tahun_ajaran ?? '' }}
                            </h5>
                            <br>
                            {!! $pendaftaran->informasi_umum ?? '' !!}
                            <strong>Info Biaya Pendaftaran</strong>
                            {!! $pendaftaran->biaya_pendaftaran ?? '' !!}
                            <br>
                            <strong>JADWAL</strong>
                            <table class="table" style="color: #333; font-size: .8em">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Mulai</th>
                                        <th scope="col">Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendaftaran->jadwal as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->kegiatan }}</td>
                                            <td>{{ tgl_i(Carbon::parse($item->mulai)->format('Y-m-d')) }}</td>
                                            <td>{{ !empty($item->selesai) ? tgl_i(Carbon::parse($item->selesai)->format('Y-m-d')) : '' }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
