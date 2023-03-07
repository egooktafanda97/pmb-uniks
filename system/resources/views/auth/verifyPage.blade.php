<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!--favicon-->
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/images/favicon-32x32.png" rel="icon"
        type="image/png" />
    <!--plugins-->

    <!-- loader-->
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('public/admin/rocker/vertical') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/css/icons.css" rel="stylesheet">
    <link href="{{ asset('public/node_modules/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/site.css') }}" rel="stylesheet" />
    <title>Daftar</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <a href="{{ url('/') }}">
                                <img alt="" src="{{ asset('assets/logo/logo.png') }}" width="80" />
                                <h5 style="color: #e3c300">UNIKS</h5>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <span>Verifikasi <span class="text-color">Email</span></span>
                                        <small>Cek email anda dan masukkan kode verifikasi dibawah ini</small>
                                        <small>Tidak mendapatkan email,
                                            @if ($email)
                                                <button class="btn btn-sm btn-secondary" id="kirim-ulang">kirim
                                                    ulang</button>
                                            @endif
                                        </small>
                                        <br>
                                        <br>
                                        <button class="btn btn-success btn-sm" data-bs-target="#exampleModal"
                                            data-bs-toggle="modal"><i class="lni lni-whatsapp"></i> kirim ke
                                            whatsapp</button>
                                    </div>

                                    <div class="login-separater text-center mb-4"> <span>OTP</span>
                                        <hr />
                                    </div>

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12" style="margin-bottom: 15px">
                                                <label
                                                    style="padding: 5px; border-left:2px solid orange; margin-top:5px;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px; background: #f5f5f5;">jika
                                                    tidak menerima email,
                                                    coba
                                                    cek <strong class="text-danger">spam.</strong></label>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label class="form-label" for="inputFirstName">Kode Verifikasi</label>
                                                <input class="form-control" id="verifikasi" name="kode"
                                                    onKeyPress="if(this.value.length==4) return false;"
                                                    placeholder="4 digit angka" required type="number">
                                                <div class="loader" style="display: none">
                                                    <small class="font_loads">LOADING <span
                                                            class="bullets">.</span></small>
                                                </div>
                                                <small id="err-msg" style="color: red; display: none">kode verifikasi
                                                    anda salah.</small>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-loader text-center" disabled
                                                        id="sub-verifikasi"
                                                        style="height: 40px;display: flex;align-items: center;justify-content: center"
                                                        type="submit">
                                                        Verfikasi
                                                        <span>
                                                            <b></b>
                                                            <b></b>
                                                            <b></b>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end wrapper-->

        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal"
            style="display: none;" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kirim Kode OTP</h5>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Email yang didaftarkan:</label>
                            <input class="form-control" id="oldEmails" type="text" type="email"
                                value="{{ !empty($email) ? decrypt($email) : '' }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="">No Telepon</label>
                            <input class="form-control" id="noWa" placeholder="62822" type="text"
                                type="email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                        <button class="btn btn-primary" id="sendWa" type="button">Kirim</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script type="text/javascript" src="{{ asset('public/node_modules/toastr/build/toastr.min.js') }}"></script>
        <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
        <script src="{{ asset('public/js/main.js') }}"></script>
        <script src="{{ asset('public/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('public/js/site.js') }}"></script>
        <!--Password show & hide js -->
        <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $("#verifikasi").keydown(function() {
                var d = $("#verifikasi").val();
                var code = event.keyCode ? event.keyCode : event.which;
                if (d.length == 4) {
                    $("#sub-verifikasi").removeAttr("disabled")
                }
            });
            $("#verifikasi").change(function() {
                var d = $("#verifikasi").val();
                if (d.length == 4) {
                    $("#sub-verifikasi").removeAttr("disabled")
                }
            });
            $("#verifikasi").keypress(function() {
                var d = $("#verifikasi").val();
                var code = event.keyCode ? event.keyCode : event.which;
                if (d.length > 3) {
                    $("#sub-verifikasi").removeAttr("disabled")
                }
                if (code == 13) {
                    $(".btn-loader").addClass("btn-loader--loading")
                    ver(d);
                }
            });
            $("#sub-verifikasi").click(function() {
                $(".btn-loader").addClass("btn-loader--loading");
                const d = $("#verifikasi").val();
                ver(d);
            })

            function ver(kode) {
                $(".loader").show();
                const Y = async () => {
                    const x = await axios.post(`{{ url('api/otp_check') }}`, {
                        "otp": kode
                    }).catch((err) => {
                        $(".loader").hide();
                        $("#err-msg").show();
                        $(".inp-verify").css("border-color", "red");
                        $(".btn-loader").removeClass("btn-loader--loading")
                    });
                    if (x.status == 200) {
                        $(".loader").hide();
                        $("#err-msg").hide();
                        $(".inp-verify").css("border-color", "green");
                        $(".btn-loader").removeClass("btn-loader--loading")
                        if (x?.data != undefined) {
                            window.location.href = `{{ url('auth/verify') }}/${x?.data}`
                        } else {
                            $(".loader").hide();
                            $("#err-msg").show();
                            $(".inp-verify").css("border-color", "red");
                            $(".btn-loader").removeClass("btn-loader--loading")
                        }
                    }
                }
                Y();
            }

            function sendEmail() {
                Swal.fire({
                    title: 'Kirim ulang kode verifikasi?',
                    html: `periksa email anda !`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oke',
                    input: 'text',
                    inputValue: `{{ !empty(request()->get('s')) ? decrypt(request()->get('s')) : '' }}`,
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    preConfirm: (xdata) => {
                        $(".loader-div").css("display", "flex");
                        const Y = async () => {
                            const x = await axios.post(`{{ url('auth/resending_email') }}`, {
                                "email": xdata,
                                "oldEmail": `{{ !empty(request()->get('s')) ? decrypt(request()->get('s')) : '' }}`
                            }).catch((err) => {
                                const {
                                    response
                                } = error;
                                const {
                                    request,
                                    ...errorObject
                                } = response;
                                if (errorObject?.status != 200) {
                                    const err = errorObject?.data?.error ?? {};
                                    $(".loader-div").css("display", "none");
                                }
                            });
                            if (x.status == 200) {
                                $(".loader-div").css("display", "none");
                            }
                        }
                        Y();
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {})
            }


            $("#sendWa").click(function() {
                sendWa();
            })

            function sendWa() {
                const Z = async () => {
                    const x = await axios.post(`{{ url('auth/resending_wa') }}`, {
                        "email": $("#oldEmails").val(),
                    }).catch((err) => {});
                    if (x) {
                        const Sender = async () => {
                            const wa = await axios.post(`http://wa.kaptencode.com/api/sendtext`, {
                                "sessions": "session_1",
                                "target": $("#noWa").val(),
                                "message": x?.kode
                            }).catch((err) => {
                                console.log(err.response);
                            });
                            if (wa) {
                                console.log(wa);
                            }
                        }
                        Sender();
                    }

                }
                Z();

            }
            $("#kirim-ulang").click(function() {
                sendEmail();
            })
        </script>
        <!--app JS-->
</body>

</html>
