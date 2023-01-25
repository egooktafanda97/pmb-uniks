@extends('mahasiswa.index.index')
@section('style')
    <link href="{{ asset('public/node_modules/croppie/croppie.css') }}"
          rel="stylesheet" />
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}"
          rel="stylesheet"
          type="text/css">
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
                     src="{{ !empty(auth()->user()->foto) ? asset('assets/' . auth()->user()->foto) : asset('assets/logo/logo.png') }}"
                     style="max-height: 300px; cursor:pointer" />
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $pendaftaran->calon_mahasiswa->nama_lengkap ?? '-' }}</h5>
                    <strong>KODE PENDAFTARAN: <span class="text-danger">{{ $pendaftaran->no_resister }}</span></strong>
                    <p class="card-text">
                        @php
                            $bg = $pendaftaran->status == 'pending' ? 'bg-warning' : ($pendaftaran->status == 'invalid' ? 'bg-danger' : 'bg-success');
                            $msg = $pendaftaran->status == 'pending' ? 'Menunggu validasi admin' : ($pendaftaran->status == 'invalid' ? 'data  invalid' : 'valid');
                        @endphp
                    <div
                         class="alert {{ $bg }} text-light border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div>
                                <div>
                                    <i class="bx bx-info-circle"></i> {{ $msg }}
                                </div>
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
            @if (!$pendaftaran->agent_id)
                <div class="card border-primary border-bottom border-3 border-0"
                     id="form-referal">
                    <div class="bg-info card-header">
                        <div class="w-100 text-white l-right">
                            <strong id="card-ref-close"><i class="fa fa-times"></i></strong>
                        </div>
                    </div>

                    <div class="card-body">
                        <label class="form-label"
                               for="inputFirstName">Kode Referal </label>
                        <div class="input-group mb-3">
                            <input aria-describedby="button-addon2"
                                   aria-label="kode referal"
                                   class="form-control"
                                   id="referal"
                                   placeholder="kode referal"
                                   type="text">
                            <button class="btn btn-outline-primary disabled"
                                    id="send_referal_id"
                                    type="button">Kirim</button>
                        </div>
                        <small class="text-success">masukkan kode referal agent anda jika ada.</small>
                    </div>

                </div>
            @endif
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
                        <a class="text-light fadeIn animated bx bx-message-square-edit"
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
    <!--notification js -->
    <script type="text/javascript"
            src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script>
        $("#img-profile").click(function() {
            $("#img-update-profile").click();
        });
        $("#img-update-profile").change(function() {

        });
        $("#referal").on("keyup change", function(e) {
            getById({
                url: `{{ url('api/mahasiswa/getAgent') }}`,
                id: `?referal=${$(this).val()}`,
                header: {
                    headers: {
                        "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                    }
                },
                errors: (error) => {
                    $("#send_referal_id").addClass("disabled")
                    $(this).removeClass("is_valid");
                    $(this).addClass("is-invalid");
                },
                response: (res) => {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                    $("#send_referal_id").removeClass("disabled")
                }
            })
        });
        const UpRef = (_data) => {
            save({
                data: _data,
                url: `{{ url('api/mahasiswa/addReferal') }}`,
                header: {
                    headers: {
                        "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                    }
                },
                errors: (error) => {
                    $.toast({
                        title: 'Opps!',
                        subtitle: ``,
                        content: `gagal menyimpan referal, silahkan ulangi`,
                        type: 'error',
                        delay: 3000,
                    })
                },
                response: (res) => {
                    $.toast({
                        title: 'Referal!',
                        subtitle: ``,
                        content: `berhasil menyimpan referal anda`,
                        type: 'success',
                        delay: 3000,
                    })
                    $("#form-referal").hide();
                }
            });
        }
        $("#card-ref-close").click(function() {
            UpRef({
                referal: false
            });
        });
        $("#send_referal_id").click(function() {
            UpRef({
                referal: $('#referal').val()
            });
        })
    </script>
@endsection
