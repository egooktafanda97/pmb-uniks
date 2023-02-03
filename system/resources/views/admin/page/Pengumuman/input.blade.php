@extends('admin.index.index')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css"
          rel="stylesheet">
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
                        <li aria-current="page"
                            class="breadcrumb-item active">{{ $title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <form enctype="multipart/form-data"
                      id="form-save">
                    <input id="id"
                           name="id"
                           type="hidden"
                           value="{{ $Quri->id ?? '' }}">
                    <div class="card-body">
                        <div class="space-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="mr-2"
                                   href="{{ url()->previous() }}"> <i class="fa fa-long-arrow-left"></i></a>
                                <h5 class="card-title text-primary m-0"> INPUT PENGUMUMAN BARU</h5>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-outline-primary px-5"
                                        type="submit">
                                    <i class="fa fa-save"></i>Simpan</button>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label>HAL <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03"
                                           id="hal"
                                           name="hal"
                                           placeholder="judul pengumuman"
                                           required=""
                                           type="text"
                                           value="{{ $Quri->hal ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="">POSTER <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm"
                                           id="poster"
                                           name="poster"
                                           type="file">
                                </div>
                            </div>
                            {{-- ============= --}}
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        BUAT INFO
                                    </div>
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <strong style="color: #9c9c9c"><i
                                                       class="fadeIn animated bx bx-info-circle"></i> deskripsi
                                                    pengumuman</strong>
                                            </div>
                                            <textarea class="keterangan"
                                                      id="keterangan"
                                                      name="keterangan">{{ $Quri->keterangan ?? '' }}</textarea>
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
                `{{ url('api/v1/pengumuman/update') }}/${$("#id").val()}` :
                `{{ url('api/v1/pengumuman/store') }}`;
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
                                    $(`[name='${key}']`).addClass("is-invalid")
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
