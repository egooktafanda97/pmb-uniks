@extends('admin.index.index')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!--start page wrapper -->
    <div class="row">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $prefix ?? 'Table' }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                        </li>
                        <li aria-current="page" class="breadcrumb-item active">{{ $title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <form enctype="multipart/form-data" id="form-save">
                    <input id="id" name="id" type="hidden" value="{{ $Quri->id ?? '' }}">
                    <div class="card-body">
                        <div class="space-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="mr-2" href="{{ url()->previous() }}"> <i class="fa fa-long-arrow-left"></i></a>
                                <h5 class="card-title text-primary m-0"> INPUT AGENT BARU</h5>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-outline-primary px-5" type="submit">
                                    <i class="fa fa-save"></i>Simpan</button>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        AKUN
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">USERNAME</label>
                                                    <input class="form-control form-control-sm" id="username"
                                                        name="username" type="text">
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">EMAIL</label>
                                                    <input class="form-control form-control-sm" id="email"
                                                        name="email" type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">PASSWORD</label>
                                                    <input class="form-control form-control-sm" id="password"
                                                        name="password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="inputFirstName">NIK <span class="in-require">*</span></label>
                                <input class="form-control" maxlength="16" minlength="16" name="nik"
                                    placeholder="nik 16 digit" required type="text" value="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="inputFirstName">NAMA LENGKAP <span
                                        class="in-require">*</span></label>
                                <input class="form-control" name="nama_lengkap" required type="text">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="inputFirstName">JENIS KELAMIN <span
                                        class="in-require">*</span></label>
                                <select class="form-select form-select-md mb-3" id="jenis_kelamin" name="jenis_kelamin"
                                    required>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="inputFirstName">NO REKENING <span
                                        class="in-require">*</span></label>
                                <input class="form-control" name="no_rekening"required type="text">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="inputFirstName">NAMA BANK <span
                                        class="in-require">*</span></label>
                                <select class="form-select form-select-md mb-3" id="nama_bank" name="nama_bank" required>
                                    <option value="bri">BRI</option>
                                    <option value="bni">BNI</option>
                                    <option value="brk">BRK</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="inputFirstName">STATUS AREA <span
                                        class="in-require">*</span></label>
                                <select class="form-select form-select-md mb-3" id="status_area" name="status_area"
                                    required>
                                    <option value="dalam kampus">DALAM KAMPUS</option>
                                    <option value="luar kampus">LUAR KAMPUS</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div>
                                    <label class="form-label" for="inputFirstName">KODE REFERAL <span
                                            class="in-require">*</span></label>
                                    <div style="display: flex">
                                        <input class="form-control" name="referal" required type="text">
                                        <button class="btn btn-primary btn-sm" type="button">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.keterangan').summernote({
                height: 500,
                tabsize: 2,
                inheritPlaceholder: true,
            });
        });
        /*
        |
        | END TABLE CONFIGURATION
        |
        */
        //    =====================================================
        /*
        |
        | REQUEST API ACTION
        |
        */
        $("#form-save").submit(function(e) {
            e.preventDefault();
            const form_data = new FormData(e.target);
            const Urls = !__empty($("#id").val()) ?
                `{{ url('api/v1/agent/update') }}/${$("#id").val()}` :
                `{{ url('api/v1/agent/store') }}`;
            const http_configure = {
                data: form_data,
                url: Urls,
                header: {
                    headers: {
                        "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                    }
                },
                errors: (error) => {
                    const {
                        response
                    } = error;
                    const {
                        request,
                        ...errorObject
                    } = response;
                    if (errorObject?.status != 200) {
                        const err = errorObject?.data?.error ?? {};
                        if (Object.keys(err).length > 0) {
                            for (const key in err) {
                                if (err.hasOwnProperty(key)) {
                                    $(`[name='${key}']`).addClass("is-invalid");
                                }
                            }
                        }

                    }
                },
                response: (res) => {
                    swal({
                        title: "Selesai!",
                        text: "data berhasil di entry!",
                        icon: "success",
                        button: "Oke!",
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.href = `{{ url()->previous() }}`
                        }
                    });
                }
            }
            save(http_configure);
        })
        /*
        |
        | END API ACTION
        |
        */
    </script>
@endsection
