@extends('admin.index.index')
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
                @php
                    $img = 'assets/logo/logo.png';
                    if ($pendaftaran->lampiran_pendaftaran->foto_formal) {
                        $img = 'assets/' . $pendaftaran->lampiran_pendaftaran->foto_formal;
                    }
                @endphp
                <img alt="" class="card-img-top" id="img-profile" src="{{ asset($img) }}"
                    style="max-height: 300px; cursor:pointer" />
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $pendaftaran->calon_mahasiswa->nama_lengkap ?? '-' }}</h5>
                    <strong style="font-size: .8em">No. PENDAFTARAN ONLINE:
                        <span
                            class="text-danger">{{ $num_padded = sprintf('%03d', $pendaftaran->no_resister) ?? '-' }}</span></strong>
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
            <div class="alert bg-white border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-warning">Info</h6>
                        Setiap perubahan status yang dilakukan admin tidak dapat di ubah kembali <br>
                        karna perubahan status akan langsung dikirim ke akun yang bersangkutan.
                        <br>
                        seblum melakukan action pastikan anda telah melihat dengan benar.
                    </div>
                </div>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
            </div>
            <div class="card ">
                <div class="card-body">
                    <div class="space-between">
                        <div>
                            <strong>Data Lengkap Calon Mahasiswa</strong>
                        </div>
                        @if ($pendaftaran->status == 'pending')
                            <div class="d-flex order-actions">
                                <button class="validasi btn btn-success btn-loader brn-sm ml-2 mr-2" data-bgmsg="green"
                                    data-mail="true" data-msg="Dokumen anda telah di periksa." data-status="valid"
                                    id="valid" style="height: 35px"><i class="fadeIn animated bx bx-check-circle"></i>
                                    Valid <span>
                                        <b></b>
                                        <b></b>
                                        <b></b>
                                    </span></button>
                                <button class="validasi btn btn-warning btn-loader brn-sm ml-2" data-bgmsg="orange"
                                    data-mail="true" data-msg="Dokumen anda telah di periksa." data-status="invalid"
                                    id="invalid" style="height: 35px"><i class="fa fa-times"></i>
                                    Invalid <span> Loading
                                        <b></b>
                                        <b></b>
                                        <b></b>
                                    </span></button>
                            </div>
                        @elseif($pendaftaran->status == 'valid')
                            <div class="d-flex order-actions">
                                {{-- <button class="seleksi btn btn-primary btn-loader brn-sm ml-2 mr-2" data-status="lulus"
                                    id="lulus" style="height: 35px"><i class="fadeIn animated bx bx-check-circle"></i>
                                    Lulus <span>
                                        <b></b>
                                        <b></b>
                                        <b></b>
                                    </span></button>
                                <button class="seleksi btn btn-danger btn-loader brn-sm ml-2" data-status="tidak_lulus"
                                    id="tidak_lulus" style="height: 35px"><i class="fa fa-times"></i>
                                    Tidak Lulus <span> Loading
                                        <b></b>
                                        <b></b>
                                        <b></b>
                                    </span></button> --}}
                                <button class="validasi btn btn-primary btn-loader brn-sm ml-2 mr-2" data-bgmsg="#038cfc"
                                    data-mail="true" data-msg="Hasil ujian anda telah kami periksa. <br> anda di nyatakan."
                                    data-status="lulus" id="lulus" style="height: 35px"><i
                                        class="fadeIn animated bx bx-check-circle"></i>
                                    Lulus <span>
                                        <b></b>
                                        <b></b>
                                        <b></b>
                                    </span></button>
                                <button class="validasi btn btn-danger btn-loader brn-sm ml-2" data-bgmsg="red"
                                    data-mail="true" data-msg="Hasil ujian anda telah kami periksa. <br> anda di nyatakan."
                                    data-status="tidak_lulus" id="tidak_lulus" style="height: 35px"><i
                                        class="fa fa-times"></i>
                                    Tidak Lulus <span> Loading
                                        <b></b>
                                        <b></b>
                                        <b></b>
                                    </span></button>
                            </div>
                        @elseif($pendaftaran->status == 'lulus')
                            <div class="d-flex order-actions">
                                <button class="validasi btn btn-primary btn-loader brn-sm ml-2 mr-2" data-bgmsg="#03a9fc"
                                    data-mail="false" data-msg="" data-status="daftar_ulang" id="daftar_ulang"
                                    style="height: 35px"><i class="fadeIn animated bx bx-check-circle"></i>
                                    Daftar Ulang <span>
                                        <b></b>
                                        <b></b>
                                        <b></b>
                                    </span></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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
        $(".validasi").click(function() {
            $(this).addClass("btn-loader--loading")
            const clases = $(this);
            const status = $(this).data('status');
            const status_mail = $(this).data('mail');
            const mssg = $(this).data('msg');
            const bgMsg = $(this).data("bgmsg") ?? "#orange";
            let pesan = ``;
            if (status == 'valid') {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-success">valid?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
            } else if (status == 'invalid') {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-danger">tidak valid?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
            } else if (status == 'lulus') {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-success">LULUS?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
            } else if (status == 'tidak_lulus') {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-danger">TIDAK LULUS?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
            } else if (status == 'daftar_ulang') {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-info">Melakukan Daftar Ulang?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
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

                    const option = {
                        url: `{{ url('api/mhs/verifikasi_pendaftaran/' . $pendaftaran->id) }}`,
                        data: {
                            "status": status,
                            "message": xdata,
                            "mail": status_mail,
                            "msg": mssg,
                            "bgMsg": bgMsg
                        },
                        header: {
                            headers: {
                                "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                            }
                        },
                        errors: (err) => {
                            $(this).removeClass("btn-loader--loading")
                            // Proses verifikasi gagal, silahkan ulangi dan periksa email pengguna!
                        },
                        response: (res) => {
                            $(this).removeClass("btn-loader--loading")
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
            }).then((result) => {
                // $(this).removeClass("btn-loader--loading")
            })
        })


        $(".seleksi").click(function() {
            $(this).addClass("btn-loader--loading")
            const clases = $(this);
            const status = $(this).data('status');
            let pesan = ``;
            if (status == 'lulus') {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-success">LULUS?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
            } else {
                pesan =
                    `Apakah data ini sudah benar-benar <strong class="text-danger">TIDAK LULUS?</strong><br> <small>Tinggal pesan dibawah ini jika diperlukan</small>`
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
                    const option = {
                        url: `{{ url('api/mhs/status_seleksi/' . $pendaftaran->id) }}`,
                        data: {
                            "status_seleksi": $status,
                            "message": xdata,
                        },
                        header: {
                            headers: {
                                "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                            }
                        },
                        errors: (err) => {
                            $(this).removeClass("btn-loader--loading")
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
                            $(this).removeClass("btn-loader--loading")
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
            }).then((result) => {
                // $(this).removeClass("btn-loader--loading")
            })
        })

        $(".seleksi").click(function() {
            $(this).addClass("btn-loader--loading")
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
                        $(this).removeClass("btn-loader--loading")
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
                                $(this).removeClass("btn-loader--loading")
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
                                $(this).removeClass("btn-loader--loading")
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
