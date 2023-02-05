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
    <title>Login</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <a href="{{ url('/') }}">
                                <img alt="" src="{{ asset('assets/logo/logo.png') }}" width="80" />
                                <h5 style="color: #e3c300">UNIKS</h5>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign in</h3>
                                        <div class="d-grid">
                                            <a class="btn my-4 shadow-sm btn-white" href="{{ url('/auth/redirect') }}">
                                                <span class="d-flex justify-content-center align-items-center">
                                                    <img alt="Image Description" class="me-2"
                                                        src="{{ asset(config('app.adm-assets')) }}/assets/images/icons/search.svg"
                                                        width="16">
                                                    <span>Login Dengan Google</span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="login-separater text-center mb-4">
                                            <span>
                                                OR SIGN IN WITH EMAIL
                                            </span>
                                            <hr />
                                        </div>

                                        <div class="form-body">
                                            <form action="{{ url('auth/login') }}" class="row g-3" method="POST">
                                                @csrf
                                                <div class="col-12">
                                                    <label class="form-label" for="inputEmailAddress">
                                                        Email
                                                    </label>
                                                    <input class="form-control" id="email" name="email"
                                                        placeholder="email" type="email">

                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label" for="inputChoosePassword">
                                                        Enter Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input class="form-control border-end-0"
                                                            id="inputChoosePassword" name="password"
                                                            placeholder="Enter Password" type="password">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <a class="input-group-text bg-transparent" href="javascript:;">
                                                            <i class='bx bx-hide'></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                </div>
                                                <div class="col-md-6 text-end"> <a
                                                        href="{{ url('auth/reset_password') }}">Forgot Password ?</a>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="bx bxs-lock-open"></i>Sign
                                                            in</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    Belum punya akun? <a href="{{ url('/') }}"
                                                        style="color: blue;">Daftar</a>
                                                </div>
                                            </form>

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
        <!-- Bootstrap JS -->
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="{{ asset('public/admin/rocker/vertical') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js">
        </script>
        <script type="text/javascript" src="{{ asset('public/node_modules/toastr/build/toastr.min.js') }}"></script>
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
