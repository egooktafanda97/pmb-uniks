@extends('mahasiswa.index.index')
@section('style')
    <link href="{{ asset('public/node_modules/croppie/croppie.css') }}"
          rel="stylesheet" />
    <style>
        #img-profile:hover {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card border-primary border-bottom border-3 border-0">
                <input class="id-hide"
                       id="img-update-profile"
                       type="file">
                <img alt=""
                     class="card-img-top"
                     id="img-profile"
                     src="{{ asset('assets/logo/logo.png') }}"
                     style="max-height: 300px; cursor:pointer" />
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $pendaftaran->calon_mahasiswa->nama_lengkap ?? '-' }}</h5>
                    <strong>KODE PENDAFTARAN: <span class="text-danger">{{ $pendaftaran->no_resister }}</span></strong>
                    <p class="card-text">
                    <div
                         class="alert bg-warning text-light border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div>
                                <div> <i class="bx bx-info-circle"></i> Menunggu validasi admin</div>
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-primary border-bottom border-3 border-0 mb-3">
                <div class="card-header text-light bg-primary">
                    <div class="space-between">
                        <strong>PROGRAM STUDI PILIHAN</strong>
                        <a class="text-light fadeIn animated bx bx-message-square-edit"
                           href="">Edit</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="space-between">
                        <h6 class="text-primary"
                            style="margin: 0">{{ $pendaftaran->prodi->nama_prodi ?? '' }}</h6>
                        <a class="text-primary"
                           style="font-size: 1rem"
                           type="button"><i class="fadeIn animated bx bx-navigation"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card border-primary border-bottom border-3 border-0 mb-3">
                <div class="card-header text-light bg-primary">
                    <div class="space-between">
                        <strong>DATA PENDAFTARAN</strong>
                        <a class=" text-light fadeIn animated bx bx-message-square-edit"
                           href="">Edit</a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($informasi_pendaftaran['c_mhs'] as $k => $v)
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0"
                                        style="font-size: .8em">{{ $k }}</strong>
                                <span class="text-secondary"
                                      style="font-size: .8em">{{ $v }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card border-primary border-bottom border-3 border-0 mb-3">
                <div class="card-header text-light bg-primary">
                    <div class="space-between">
                        <strong>DATA ORANGTUA</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong style="color: #9c9c9c"><i class="fa fa-user"></i> AYAH</strong>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach ($informasi_pendaftaran['ayah'] as $k => $v)
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0"
                                        style="font-size: .8em">{{ $k }}</strong>
                                <span class="text-secondary"
                                      style="font-size: .8em">{{ $v }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <br>
                    <hr>
                    <br>
                    <div class="mb-3">
                        <strong style="color: #9c9c9c"><i class="fa fa-user"></i> IBU</strong>
                    </div>

                    <ul class="list-group list-group-flush">
                        @foreach ($informasi_pendaftaran['ibu'] as $k => $v)
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0"
                                        style="font-size: .8em">{{ $k }}</strong>
                                <span class="text-secondary"
                                      style="font-size: .8em">{{ $v }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/node_modules/croppie/croppie.min.js') }}"></script>
    <script>
        $("#img-profile").click(function() {
            $("#img-update-profile").click();
        });
        $("#img-update-profile").change(function() {

        });
    </script>
@endsection
