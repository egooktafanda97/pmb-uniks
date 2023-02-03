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
                    <small>Masukkan alamat email anda</small>
                </h2>

                <div class="row price-tables">
                    <div class="col-lg-3">

                    </div>
                    @if (empty(request()->get('token')))
                        <div class="col-lg-6" id="form-email">
                            <div class="form-group">
                                <input class="form-control inp-verify" id="email" placeholder="ex@" type="text">
                                <div class="loader" style="display: none">
                                    <small class="font_loads">LOADING <span class="bullets">.</span></small>
                                </div>
                                <small id="err-msg" style="color: red; display: none">alamat email tidak
                                    ditemukan.</small>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6">
                            <div class="card" style="border-left: 3px solid #2596be; padding-left: 10px">
                                <div class="card-body">
                                    <h4 style="color: #333">
                                        Cek email anda untuk mendapatkan akses ubah password.
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endif
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
        $("#email").keypress(function() {
            const d = $(this).val();
            var code = event.keyCode ? event.keyCode : event.which;
            if (code == 13) {
                $(".loader").show();
                const Y = async () => {
                    const x = await axios.post(`{{ url('auth/email_check') }}`, {
                        "email": d
                    }).catch((err) => {
                        $(".loader").hide();
                        $("#err-msg").show();
                        $(".inp-verify").css("border-color", "red");
                    });
                    if (x.status == 200) {
                        $(".loader").hide();
                        $("#err-msg").hide();
                        $(".inp-verify").css("border-color", "green");
                        window.location.href = `?token=${x?.data?.token}`
                    }
                }
                Y();
            }
        });
    </script>
@endsection
