@extends('mahasiswa.index.index')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2"
                style="background: #fff; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">

                @if (!empty($pendaftaran) && $pendaftaran->status != 'draft')
                    <h6 class="mb-0 text-success">SELESAI</h6>
                    <hr>
                    <p>
                        Data anda berhasil di kirim tunggu pemberitahuan <strong>verifikasi</strong> dari admin
                        kampus, <a href="{{ url('mahasiswa/profile') }}">lihat data
                            anda</a>
                    </p>
                @else
                    <h6 class="mb-0 text-info">Info</h6>
                    <hr>
                    <p style="font-size: 2vh">
                        Sebelum mengirim data pastikan data anda sudah lengkap dan di isi dengan benar. <br> Jika data anda
                        tidak valid admin pmb akan memberikan pesan ke email anda.
                        <a href="{{ url('mahasiswa/profile') }}">lihat data anda</a>
                    </p>
                    <button class="btn btn-primary" id="send" style="width: 100px"><i
                            class="fadeIn animated bx bx-send"></i>
                        Kirim</button>
                @endif

                {{-- <p style="font-size: 2vh">
                    
                    anda bertanggung jawab penuh dengan kebenaran data yang anda isi. <br />
                </p> --}}

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script>
        $("#send").click(function() {
            swal({
                    title: "Yakin akan mengirim ke admisi UNIKS?",
                    text: "pastikan data anda sudah benar dan lengkap!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: false,
                    buttons: "Kirim!",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        async function send() {
                            const push = await axios.get(`{{ url('api/mahasiswa/sending') }}`, {
                                headers: {
                                    Authorization: `Bearer {{ \Session::get('token')['access_token'] ?? '' }}`,
                                },
                            }).catch((err) => {
                                console.log(503);
                            });
                            if (push) {
                                swal({
                                    title: "Selamat.",
                                    text: "Pendafataran anda akan segera di periksa penitia pmb uniks!",
                                    icon: "success",
                                }).then((ok) => {
                                    window.location.href = `{{ url('mahasiswa/profile') }}`;
                                });
                            }

                        }
                        send();
                    }
                });
        });
    </script>
@endsection
