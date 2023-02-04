@extends('mahasiswa.index.index')
@section('style')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2"
                style="background: #fff; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="mb-0 text-success">SELESAI</h6>
                        <hr>
                        <p style="font-size: 2vh">
                            Data anda berhasil di kirim tunggu pemberitahuan <strong>verifikasi</strong> dari admin
                            kampus,<br>
                            anda bertanggung jawab penuh dengan kebenaran data yang anda isi. <br /> <a
                                href="{{ url('mahasiswa/profile') }}">lihat data
                                anda</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
