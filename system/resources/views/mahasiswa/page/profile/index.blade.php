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

        .n-tab {
            color: gray;
        }

        .n-tab.active {
            font-weight: bold;
            color: #008cff;
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
                    <strong>No. PENDAFATARAN: <span class="text-danger">{{ $pendaftaran->no_resister }}</span></strong>
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
                    @if ($pendaftaran->status == 'valid')
                        <a class="btn btn-primary btn-sm w-100" href="{{ url('report/id-card') }}" target="_blank">
                            <i class="fa fa-print"></i>
                            CETAK KARTU UJIAN
                        </a>
                        <br>
                    @endif
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
            @else
                <div class="card border-primary border-bottom border-3 border-0" id="form-referal">
                    <div class="card-body">
                        <div>
                            <div
                                style="display: flex;justify-content: space-between;align-items: center;margin-bottom: 10px">
                                <strong>
                                    Agent
                                </strong>
                            </div>
                            <hr>
                            <div>
                                <div class="d-flex align-items-center">
                                    <img alt="agen" class="rounded-circle p-1 border" height="90"
                                        src="{{ asset('assets/imags/users/default.png') }}" width="90">
                                    <div class="flex-grow-1 ms-3">
                                        <label class="mt-0"
                                            style="font-size: 1.1em; font-weight: bold;">{{ $pendaftaran->agent->nama_lengkap }}</label>
                                        <p class="mb-0">
                                            <strong class="text-primary">{{ $pendaftaran->agent->referal }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            @include('mahasiswa.page.profile.info_tab')
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
                $("#form-referal").hide();
                // UpRef({
                //     referal: false
                // }, () => {});
            });
            $("#send_referal_id").click(function() {
                $(this).addClass("btn-loader--loading");
                UpRef({
                    referal: $('#referal').val()
                }, () => {
                    $(this).removeClass("btn-loader--loading");
                    window.location.reload();
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
