@extends('website.index.index')
@section('style')
    <link href="{{ asset('public/css/site.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content-area">
        <!-- PAGE PRICE -->
        <section class="page-section" id="price" style="min-height: 500px">
            <div class="container">
                <h2 class="section-title animated fadeInUp visible" data-animation-delay="100" data-animation="fadeInUp">
                    <span>Reset <span class="text-color">Password</span></span>
                    <small></small>
                </h2>

                <div class="row price-tables">
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-6">
                        <form action="{{ url('auth/reset_confirm?token=' . request()->get('token')) }}" id="form-setPass"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input class="form-control inp-verify" id="password" minlength="8" name="password"
                                    placeholder="new password" type="password">
                                <small id="err-msg-pass" style="color: red; display: none">password minimal 8
                                    karakter.</small>
                            </div>
                            <div class="form-group">
                                <label for="">Konfirmasi Password</label>
                                <input class="form-control inp-verify" id="password_confirmation"
                                    placeholder="password confirmation" type="password">
                                <div class="loader" style="display: none">
                                    <small class="font_loads">LOADING <span class="bullets">.</span></small>
                                </div>
                                <small id="err-msg" style="color: red; display: none">password tidak sama.</small>
                            </div>
                            <div class="form-group">
                                <div style="display: flex;justify-content: flex-end">
                                    <button class="btn btn-primary" disabled id="submits" type="submit">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /PAGE PRICE -->
    </div>
    </section>
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#password").change(function() {
            const pass = $(this).val();
            if (pass.length < 8) {
                $("#err-msg-pass").show();
                $(this).css("border-color", "red");
            } else {
                $("#err-msg-pass").hide();
                $(this).css("border-color", "green");
            }
        })
        $("#password_confirmation").keyup(function() {
            const c_pas = $(this).val();
            const pass = $("#password").val();
            if (c_pas != pass) {
                $("#err-msg").show();
                $("#password").css("border-color", "red");
                $(this).css("border-color", "red");
            } else {
                $("#err-msg").hide();
                $("#password").css("border-color", "green");
                $(this).css("border-color", "green");
                $("#submits").attr("disabled", false)
            }
        });
    </script>
@endsection
