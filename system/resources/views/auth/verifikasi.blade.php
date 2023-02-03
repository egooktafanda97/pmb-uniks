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
                    <span>Verifikasi <span class="text-color">Email</span></span>
                    <small>Cek email anda dan masukkan kode verifikasi dibawah ini</small>
                    <small>Tidak mendapatkan email, <button class="btn btn-sm btn-info" id="kirim-ulang">kirim
                            ulang</button></small>
                </h2>

                <div class="row price-tables">
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input class="form-control inp-verify" id="verifikasi" maxlength="4" placeholder="0000"
                                type="text">
                            <div class="loader" style="display: none">
                                <small class="font_loads">LOADING <span class="bullets">.</span></small>
                            </div>
                            <small id="err-msg" style="color: red; display: none">kode verifikasi anda salah.</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /PAGE PRICE -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('public/node_modules/axios/dist/axios.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#verifikasi").keypress(function() {
            const d = $(this).val();
            var code = event.keyCode ? event.keyCode : event.which;
            if (code == 13) {
                $(".loader").show();
                const Y = async () => {
                    const x = await axios.post(`{{ url('api/otp_check') }}`, {
                        "otp": d
                    }).catch((err) => {
                        $(".loader").hide();
                        $("#err-msg").show();
                        $(".inp-verify").css("border-color", "red");
                    });
                    if (x.status == 200) {
                        $(".loader").hide();
                        $("#err-msg").hide();
                        $(".inp-verify").css("border-color", "green");
                        window.location.href = `{{ url('auth/verify') }}/${d}`
                    }
                }
                Y();
            }
        });


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
                inputValue: `{{ decrypt(request()->get('s')) }}`,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                preConfirm: (xdata) => {
                    $(".loader-div").css("display", "flex");
                    const Y = async () => {
                        const x = await axios.post(`{{ url('auth/resending_email') }}`, {
                            "email": xdata,
                            "oldEmail": `{{ decrypt(request()->get('s')) }}`
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
        $("#kirim-ulang").click(function() {
            sendEmail();
        })
    </script>
@endsection
