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
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/simplebar/css/simplebar.css"
        rel="stylesheet" />
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css"
        rel="stylesheet" />
    <link href="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/metismenu/css/metisMenu.min.css"
        rel="stylesheet" />
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
                                        <p>Apakah Sudah Punya Akun? <a href="authentication-signin.html">Login
                                                Sekarang!</a>
                                        </p>
                                    </div>
                                    <div class="d-grid">
                                        <a class="btn my-4 shadow-sm btn-white" href="{{ url('/auth/redirect') }}">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <img alt="Image Description" class="me-2"
                                                    src="{{ asset(config('app.adm-assets')) }}/assets/images/icons/search.svg"
                                                    width="16">
                                                <span>Daftar Melalui Google</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                                        <hr />
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" id="formRegSub">
                                            <div class="col-sm-6">
                                                <label class="form-label" for="inputFirstName">Nik</label>
                                                <input class="form-control"
                                                    id="inputFirstName"onKeyPress="if(this.value.length==16) return false;"
                                                    name="nik" placeholder="16 digit nik" required type="number">
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="form-label" for="inputFirstName">Nama Lengkap</label>
                                                <input class="form-control" name="nama" placeholder="Nama lengkap"
                                                    required type="text">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="inputEmailAddress">Email</label>
                                                <input class="form-control" id="inputEmailAddress" name="email"
                                                    placeholder="example@user.com" required type="email">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="inputChoosePassword">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input class="form-control border-end-0" id="inputChoosePassword"
                                                        name="password" placeholder="Enter Password" type="password"
                                                        value="12345678">
                                                    <a class="input-group-text bg-transparent" href="javascript:;"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" id="flexSwitchCheckChecked"
                                                        type="checkbox">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">
                                                        Saya menyetujui Syarat & Ketentuan sistem ini.</label>
                                                </div>
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class='bx bx-user'></i>Daftar</button>
                                                </div>
                                            </div>
                                        </form>
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
        <!-- Bootstrap JS -->
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js">
        </script>
        <script type="text/javascript" src="{{ asset('public/node_modules/toastr/build/toastr.min.js') }}"></script>
        <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
        <script src="{{ asset('public/js/main.js') }}"></script>
        <script src="{{ asset('public/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('public/js/site.js') }}"></script>
        <!--Password show & hide js -->
        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("bx-hide");
                        $('#show_hide_password i').removeClass("bx-show");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("bx-hide");
                        $('#show_hide_password i').addClass("bx-show");
                    }
                });
            });
            // ||||||||||||||||||||||||||||
            $("#formRegSub").submit(function(e) {
                e.preventDefault();

                const form_data = new FormData(e.target);
                __upSave(form_data);

                function __upSave(data) {
                    $(".btn-loader").addClass("btn-loader--loading")

                    const http_configure = {
                        data: data,
                        url: `{{ url('api/register') }}`,
                        errors: (error) => {
                            $(".btn-loader").removeClass("btn-loader--loading")
                            const {
                                response
                            } = error;
                            const {
                                request,
                                ...errorObject
                            } = response;
                            if (errorObject?.status != 200 && errorObject?.status < 500) {
                                const err = errorObject?.data?.error ?? {};
                                if (Object.keys(err).length > 0) {
                                    for (const key in err) {
                                        if (err.hasOwnProperty(key)) {
                                            $(`[name='${key}']`).addClass("is-invalid")
                                            toastr.error(`${err[key][0]}`);
                                        }
                                    }
                                }
                            } else {
                                swal({
                                    title: "Ooops fatal error!",
                                    text: "pastikan proses dilakukan dengan benar.",
                                    icon: "error",
                                    button: "Oke!",
                                });
                            }
                        },
                        response: (res) => {
                            if (res?.data?.result) {
                                window.location.href = `{{ url('auth/verify?s=') }}${res?.data?.result}`
                            }
                        }
                    }

                    save_inheader(http_configure);
                }
            });
        </script>
        @if ($errors->any() && $errors->first('status') == 501)
            <script>
                toastr.error(`{{ $errors->first() }}`);
            </script>
        @endif
        <!--app JS-->
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/js/app.js"></script>
</body>

</html>
