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
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card border-primary border-bottom border-3 border-0">
                <input class="id-hide" id="img-update-profile" type="file">
                <img alt="" class="card-img-top" id="img-profile"
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
        </div>
        <div class="col-md-8">
            @include('admin.page.CalonMhs.tabs')
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/node_modules/croppie/croppie.min.js') }}"></script>
    <!--notification js -->
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script script src='https://www.jsdelivr.com/package/npm/pdfjs-dist'></script>
    <script script src='https://cdnjs.com/libraries/pdf.js'></script>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
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
        });

        //  =====
        $(".verifications").click(function() {
            const clases = $(this);
            const status = $(this).data('status');
            let pesan = ``;
            if (status == 'valid') {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-success">valid?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
            } else {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-danger">tidak valid?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
            }
            Swal.fire({
                title: 'Yakin?',
                html: `${pesan}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                preConfirm: (xdata) => {
                    clases.toggleClass("button--loading");
                    const option = {
                        url: `{{ url('api/mhs/verifikasi_pendaftaran/' . $pendaftaran->id) }}`,
                        data: {
                            "status": status,
                            "message": xdata,
                        },
                        header: {
                            headers: {
                                "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                            }
                        },
                        errors: (err) => {
                            $(".button--loader").removeClass("button--loading")
                            swal({
                                title: "Opps!",
                                text: "Proses verifikasi gagal, silahkan ulangi dan periksa email pengguna!",
                                icon: "success",
                                button: "Oke!",
                            }).then((willDelete) => {
                                if (willDelete) {
                                    window.location.href = `{{ url()->previous() }}`
                                }
                            });
                        },
                        response: (res) => {
                            $(".button--loader").removeClass("button--loading")
                            Swal.fire(
                                'Selesai!',
                                '',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {

                                    window.location.href = `{{ url()->previous() }}`

                                }
                            })
                        }
                    }
                    request_post(option)
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {})
        });
        $(".seleksi").click(function() {
            $status = $(this).data('status');
            swal({
                    title: "Yakin?",
                    text: `Calon mahasiswa ${$status} ini seleksi`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(this).toggleClass("button--loading");
                        const option = {
                            url: `{{ url('api/mhs/status_seleksi/' . $pendaftaran->id) }}`,
                            data: {
                                "status_seleksi": $status,
                            },
                            header: {
                                headers: {
                                    "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                                }
                            },
                            errors: (err) => {
                                $(".button--loader").removeClass("button--loading")
                                swal({
                                    title: "Opps!",
                                    text: "Proses gagal, silahkan ulangi dan periksa email pengguna!",
                                    icon: "success",
                                    button: "Oke!",
                                }).then((willDelete) => {
                                    if (willDelete) {
                                        window.location.href = `{{ url()->previous() }}`
                                    }
                                });
                            },
                            response: (res) => {
                                $(".button--loader").removeClass("button--loading")
                                swal({
                                    title: "Selesai!",
                                    text: "",
                                    icon: "success",
                                    button: "Oke!",
                                }).then((willDelete) => {
                                    if (willDelete) {
                                        window.location.href = `{{ url()->previous() }}`
                                    }
                                });
                            }
                        }
                        request_post(option)
                    }
                });
        });
    </script>

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
