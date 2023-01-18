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
                        <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <form id="form-save" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="space-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ url()->previous() }}" class="mr-2"> <i class="fa fa-long-arrow-left"></i></a>
                                <h5 class="card-title text-primary m-0"> INPUT PENDAFTARAN BARU</h5>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <button type="submit" class="btn btn-outline-primary px-5">
                                    <i class="fa fa-save"></i>Simpan</button>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>NAMA PENDAFTARAN <span class="in-require">*</span></label>
                                    <input type="text" name="pendaftaran"
                                        class="form-control form-control-sm validationTooltip03" placeholder="GELOMBANG I"
                                        required="">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">BROSUR</label>
                                    <input type="file" name="brosur" id="brosur"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>TAHUN AJARAN <span class="in-require">*</span></label>
                                    <input type="text" name="tahun_ajaran"
                                        class="form-control form-control-sm validationTooltip03"
                                        placeholder="{{ date('Y') . '/' . (date('Y') + 1) }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>KUOTA</label>
                                    <input type="text" name="kuota"
                                        class="form-control form-control-sm validationTooltip03" placeholder="0"
                                        value="0">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        INFORMASI UMUM
                                    </div>
                                    <div class=" mt-3">
                                        <div class="card-body">
                                            <textarea class="informasi_umum" id="informasi_umum" name="informasi_umum">
                                                </textarea>
                                        </div>
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
        /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        | DATA TABLE CONFIGURATION
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        */
        $(document).ready(function() {
            $('.informasi_umum').summernote({
                height: 300,
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
            const http_configure = {
                data: form_data,
                url: `{{ url('api/v1/informasi_pendaftaran/store') }}`,
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
                                    $(`[name='${key}']`).addClass("is-invalid")
                                }
                            }
                        }

                    }
                },
                response: (res) => {
                    swal({
                        title: "Selesai!",
                        text: "data fakultas berhasil di entry!",
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
