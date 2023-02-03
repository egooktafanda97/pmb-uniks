@extends('mahasiswa.index.index')
@section('style')
    <link href="{{ asset('public/node_modules/croppie/croppie.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        #img-profile:hover {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .canvas-pdf {
            direction: ltr;
            width: 100%;
        }

        .info-bg-warning {
            background: rgba(227, 139, 7, .4);
            color: #333;
        }

        .info-bg-success {
            background: rgba(42, 204, 2, .4);
            color: #333;
        }

        .info-bg-danger {
            background: rgba(217, 2, 27, .4);
            color: #333;
        }

        .info-bg-primary {
            background: rgba(4, 57, 204, .4);
            color: #333;
        }

        .info-bg-info {
            background: rgba(5, 125, 181, .4);
            color: #333;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card border-primary border-bottom border-3 border-0">
                <input class="id-hide" id="img-update-profile" type="file">
                <img alt="" class="card-img-top" id="img-profile"
                    src="{{ !empty(auth()->user()->foto) ? asset('assets/' . auth()->user()->foto) : asset('assets/logo/logo.png') }}"
                    style="cursor:pointer" />
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $pendaftaran->calon_mahasiswa->nama_lengkap ?? '-' }}</h5>
                    <strong>KODE PENDAFTARAN: <span class="text-danger">{{ $pendaftaran->no_resister }}</span></strong>
                    <p class="card-text">
                        @php
                            if ($pendaftaran->status == 'pending') {
                                $bg = 'info-bg-warning';
                                $msg = 'menunggu validasi admisi!';
                            } elseif ($pendaftaran->status == 'invalid') {
                                $bg = 'info-bg-danger';
                                $msg = 'data anda tidak valid, cek pesan di <a href="' . url('info_khusus') . '">info khusus</a> <br/> hubungi admisi jika diperlukan <a href="' . url('kontak') . '">kontak</a>';
                            } elseif ($pendaftaran->status == 'valid') {
                                $bg = 'info-bg-success';
                                $msg = 'data anda sudah di validasi, cektak kartu ujian. <br/>';
                            } elseif ($pendaftaran->status == 'lulus') {
                                $bg = 'info-bg-info';
                                $msg = 'LULUS';
                            } elseif ($pendaftaran->status == 'tidak_lulus') {
                                $bg = 'info-bg-danger';
                                $msg = 'TIDAK LULUS';
                            } elseif ($pendaftaran->status == 'daftar_ulang') {
                                $bg = 'info-bg-danger';
                                $msg = 'anda sudah melakukan daftar ulang.<br/> selesai.';
                            }
                        @endphp
                    <div
                        class="alert {{ $bg }}  border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div>
                                <div>
                                    <i class="bx bx-info-circle"></i> {!! $msg !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    </p>
                    <a class="btn btn-primary btn-sm w-100"
                        href="{{ url('report/id-card?us=' . \Crypt::encryptString($pendaftaran->id)) }}" target="_blank">
                        <i class="fa fa-print"></i>
                        CETAK KARTU UJIAN
                    </a>
                    <br>
                </div>
            </div>
            @if (!$pendaftaran->agent_id)
                <div class="card border-primary border-bottom border-3 border-0" id="form-referal">
                    <div class="bg-info card-header">
                        <div class="w-100 text-white l-right">
                            <strong id="card-ref-close"><i class="fa fa-times"></i></strong>
                        </div>
                    </div>

                    <div class="card-body">
                        <label class="form-label" for="inputFirstName">Kode Referal </label>
                        <div class="input-group mb-3">
                            <input aria-describedby="button-addon2" aria-label="kode referal" class="form-control"
                                id="referal" placeholder="kode referal" type="text">
                            <button class="btn btn-outline-primary disabled btn-loader" id="send_referal_id"
                                style="height: 40px" type="button">
                                Kirim
                                <span>
                                    <b></b>
                                    <b></b>
                                    <b></b>
                                </span>
                            </button>
                        </div>
                        <small class="text-success">masukkan kode referal agent anda jika ada.</small>
                    </div>

                </div>
            @endif
        </div>
        <div class="col-md-8">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a aria-selected="true" class="nav-link active" data-bs-toggle="pill" href="#primary-pills-home"
                        role="tab">
                        <div class="d-flex align-items-center">
                            <div class="tab-title">PROFILE</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a aria-selected="false" class="nav-link" data-bs-toggle="pill" href="#primary-pills-profile"
                        role="tab" tabindex="-1">
                        <div class="d-flex align-items-center">
                            <div class="tab-title">LAMPIRAN</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a aria-selected="false" class="nav-link" data-bs-toggle="pill" href="#primary-pills-contact"
                        role="tab" tabindex="-1">
                        <div class="d-flex align-items-center">
                            <div class="tab-title">BUKTI BAYAR</div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="primary-pills-home" role="tabpanel">
                    <div class="card border-primary border-bottom border-3 border-0 mb-3">
                        <div class="card-header text-light bg-primary">
                            <div class="space-between">
                                <strong>DATA PENDAFTARAN</strong>
                                <a class="text-light fadeIn animated bx bx-message-square-edit"
                                    href="{{ url('mahasiswa/form?edit=mhs') }}">Edit</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card border-primary border-bottom border-3 border-0 mb-3">
                                <div class="card-body">
                                    <strong>PROGRAM STUDI</strong>
                                    <div class="space-between">
                                        <h6 class="text-primary" style="margin: 0">
                                            {{ $pendaftaran->prodi->nama_prodi ?? '' }}
                                        </h6>
                                        <a class="text-primary" style="font-size: 1rem" type="button"><i
                                                class="fadeIn animated bx bx-navigation"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                @foreach ($informasi_pendaftaran['c_mhs'] as $k => $v)
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                                        <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
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
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                                        <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
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
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                                        <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                    <div class="card border-primary border-bottom border-3 border-0 mb-3">
                        <div class="card-header text-light bg-primary">
                            <div class="space-between">
                                <strong>LAMPIRAN</strong>
                                <a class="text-light fadeIn animated bx bx-message-square-edit"
                                    href="{{ url('mahasiswa/form?edit=lampiran') }}">Edit</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="false" class="nav-link active" data-bs-toggle="pill"
                                        href="#primary-pills-foto" role="tab" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">FOTO FORMAL</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="false" class="nav-link" data-bs-toggle="pill"
                                        href="#primary-pills-ktp" role="tab" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">SC KTP</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="true" class="nav-link " data-bs-toggle="pill"
                                        href="#primary-pills-kk" role="tab">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">SC KK</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="true" class="nav-link" data-bs-toggle="pill" href="#ijasa"
                                        role="tab">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">SC IJASA/SKL</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="true" class="nav-link" data-bs-toggle="pill" href="#kip"
                                        role="tab">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">Sc KIP</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="primary-pills-foto" role="tabpanel">
                                    <img alt=""
                                        src="{{ asset('assets/' . $pendaftaran->lampiran_pendaftaran->foto_formal) }}"
                                        width="100%">
                                </div>
                                <div class="tab-pane fade" id="primary-pills-ktp" role="tabpanel">
                                    @if ($pendaftaran->lampiran_pendaftaran->sc_ktp ?? false)
                                        @php
                                            $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_ktp);
                                            $extensinon = \File::extension($urls);
                                        @endphp
                                        @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                            <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                                id="the-canvas-ktp"></canvas>
                                        @else
                                            <img alt="" src="{{ $urls }}" width="100%">
                                        @endif
                                    @else
                                        <div
                                            class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-warning">Warning</h6>
                                                    <div>Tidak ada file yang diupload</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade " id="primary-pills-kk" role="tabpanel">
                                    @if ($pendaftaran->lampiran_pendaftaran->sc_kk ?? false)
                                        @php
                                            $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_kk);
                                            $extensinon = \File::extension($urls);
                                        @endphp
                                        @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                            <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                                id="the-canvas-kk"></canvas>
                                        @else
                                            <img alt="" src="{{ $urls }}" width="100%">
                                        @endif
                                    @else
                                        <div
                                            class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-warning">Warning</h6>
                                                    <div>Tidak ada file yang diupload</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="ijasa" role="tabpanel">
                                    @if ($pendaftaran->lampiran_pendaftaran->sc_ijasa_skl ?? false)
                                        @php
                                            $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_ijasa_skl);
                                            $extensinon = \File::extension($urls);
                                        @endphp
                                        @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                            <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                                id="the-canvas-ijasa"></canvas>
                                        @else
                                            <img alt="" src="{{ $urls }}" width="100%">
                                        @endif
                                    @else
                                        <div
                                            class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-warning">Warning</h6>
                                                    <div>Tidak ada file yang diupload</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="kip" role="tabpanel">
                                    @if ($pendaftaran->lampiran_pendaftaran->sc_kip_kks_pkh ?? false)
                                        @php
                                            $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_kip_kks_pkh);
                                            $extensinon = \File::extension($urls);
                                        @endphp
                                        @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                            <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                                id="the-canvas-kip"></canvas>
                                        @else
                                            <img alt="" src="{{ $urls }}" width="100%">
                                        @endif
                                    @else
                                        <div
                                            class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                            <div class="d-flex align-items-center">
                                                <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0 text-warning">Warning</h6>
                                                    <div>Tidak ada file yang diupload</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="primary-pills-contact" role="tabpanel">
                    <div class="card border-primary border-bottom border-3 border-0 mb-3">
                        <div class="card-header text-light bg-primary">
                            <div class="space-between">
                                <strong>BUKTI PEMBAYARAN</strong>
                                <a class="text-light fadeIn animated bx bx-message-square-edit"
                                    href="{{ url('mahasiswa/form?edit=biaya') }}">Edit</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img alt=""
                                        src="{{ asset('assets/' . $pendaftaran->bukti_pembayaran->bukti_pembayaran) }}"
                                        width="100%">
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <strong class="mb-0" style="font-size: .8em">Nama Bank / Provider</strong>
                                            <span class="text-secondary"
                                                style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->nama_bank ?? '-' }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <strong class="mb-0" style="font-size: .8em">Atas Nama</strong>
                                            <span class="text-secondary"
                                                style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->atas_nama ?? '-' }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <strong class="mb-0" style="font-size: .8em">Waktu Bayar</strong>
                                            <span class="text-secondary"
                                                style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->waktu_bayar ? date('Y-m-d h:i:s', strtotime($pendaftaran->bukti_pembayaran->waktu_bayar ?? '-')) : '-' }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <strong class="mb-0" style="font-size: .8em">Jumlah Trasfer</strong>
                                            <span class="text-secondary"
                                                style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->jumlah_tf ?? '-' }}</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <strong class="mb-0" style="font-size: .8em">Keterangan</strong>
                                            <span class="text-secondary"
                                                style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->keterangan ?? '-' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
    @section('script')
        <script src="{{ asset('public/node_modules/croppie/croppie.min.js') }}"></script>
        <!--notification js -->
        <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
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
            const UpRef = (_data, response) => {
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
                        response(res)
                    }
                });
            }
            $("#card-ref-close").click(function() {
                UpRef({
                    referal: false
                }, () => {});
            });
            $("#send_referal_id").click(function() {
                $(this).addClass("btn-loader--loading");
                UpRef({
                    referal: $('#referal').val()
                }, () => {
                    $(this).removeClass("btn-loader--loading");
                });
            })
        </script>
        <script script script src='https://www.jsdelivr.com/package/npm/pdfjs-dist'></script>
        <script script src='https://cdnjs.com/libraries/pdf.js'></script>
        <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
        <script>
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

            // Asynchronous download of PDF
            const IdData = ["the-canvas-ktp", "the-canvas-kk", "the-canvas-ijasa", "the-canvas-kip"];
            IdData.forEach(id => {
                const url_data = $("#" + id).data("url");
                if (url_data) {
                    var loadingTask = pdfjsLib.getDocument(url_data);
                    loadingTask.promise.then(function(pdf) {
                        console.log('PDF loaded');

                        // Fetch the first page
                        var pageNumber = 1;
                        pdf.getPage(pageNumber).then(function(page) {
                            console.log('Page loaded');

                            var scale = 1.5;
                            var viewport = page.getViewport({
                                scale: scale
                            });

                            // Prepare canvas using PDF page dimensions
                            var canvas = document.getElementById(id);
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;
                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            var renderTask = page.render(renderContext);
                            renderTask.promise.then(function() {
                                console.log('Page rendered');
                            });
                        });
                    }, function(reason) {
                        console.error(reason);
                    });
                }
            });
        </script>
    @endsection
