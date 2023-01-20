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
                    <div class="card-body">
                        <div class="space-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="mr-2"
                                   href="{{ url()->previous() }}"> <i class="fa fa-long-arrow-left"></i></a>
                                <h5 class="card-title text-primary m-0"> INPUT FAKULTAS</h5>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-outline-primary px-5"
                                        type="submit">
                                    <i class="fa fa-save"></i>Simpan</button>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>Nama Fakultas <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03"
                                           name="nama_fakultas"
                                           placeholder="nama fakultas"
                                           required=""
                                           type="text">
                                    <div class="invalid-tooltip">Input wajib di isi.</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">Nama Dekan</label>
                                    <input class="form-control form-control-sm"
                                           name="kepala_fakultas"
                                           placeholder="nama fakultas"
                                           type="text">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">Foto Fakultas</label>
                                    <input class="form-control form-control-sm"
                                           id="gambar"
                                           name="gambar"
                                           type="file">
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">Situs Web</label>
                                    <input class="form-control form-control-sm"
                                           id="situs_web"
                                           name="situs_web"
                                           placeholder="https://example.com"
                                           type="text">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        AKUN
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Username</label>
                                                    <input class="form-control form-control-sm"
                                                           id="username"
                                                           name="username"
                                                           type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input class="form-control form-control-sm"
                                                           id="email"
                                                           name="email"
                                                           type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">password</label>
                                                    <input class="form-control form-control-sm"
                                                           id="password"
                                                           name="password"
                                                           type="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        INFO FAKULTAS
                                    </div>
                                    <div class="card-body">
                                        <div class=" mt-3">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-primary"
                                                    role="tablist">
                                                    <li class="nav-item"
                                                        role="presentation">
                                                        <a aria-selected="true"
                                                           class="nav-link active"
                                                           data-bs-toggle="tab"
                                                           href="#primaryhome"
                                                           role="tab">
                                                            <div class="d-flex align-items-center">
                                                                <div class="tab-title">Info Fakultas</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item"
                                                        role="presentation">
                                                        <a aria-selected="false"
                                                           class="nav-link"
                                                           data-bs-toggle="tab"
                                                           href="#primaryprofile"
                                                           role="tab"
                                                           tabindex="-1">
                                                            <div class="d-flex align-items-center">
                                                                <div class="tab-title">Visi Misi</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item"
                                                        role="presentation">
                                                        <a aria-selected="false"
                                                           class="nav-link"
                                                           data-bs-toggle="tab"
                                                           href="#primarycontact"
                                                           role="tab"
                                                           tabindex="-1">
                                                            <div class="d-flex align-items-center">
                                                                <div class="tab-title">Tujuan</div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content py-3">
                                                    <div class="tab-pane fade active show"
                                                         id="primaryhome"
                                                         role="tabpanel">
                                                        <textarea class="info_fakultas"
                                                                  id="info_fakultas"
                                                                  name="info_fakultas">
                                                        </textarea>
                                                    </div>
                                                    <div class="tab-pane fade"
                                                         id="primaryprofile"
                                                         role="tabpanel">
                                                        <textarea class="visi_misi"
                                                                  id="visi_misi"
                                                                  name="visi_misi">
                                                        </textarea>
                                                    </div>
                                                    <div class="tab-pane fade"
                                                         id="primarycontact"
                                                         role="tabpanel">
                                                        <textarea class="tujuan"
                                                                  id="tujuan"
                                                                  name="tujuan">
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-3 w-100 right-comp">

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
            $('.info_fakultas').summernote({
                height: 300,
                tabsize: 2,
                inheritPlaceholder: true,
                placeholder: 'deskripsikan informasi fakultas'
            });
            $('.visi_misi').summernote({
                height: 300,
                tabsize: 2,
                inheritPlaceholder: true,
                placeholder: 'deskripsikan visi misi fakultas'
            });
            $('.tujuan').summernote({
                height: 300,
                tabsize: 2,
                inheritPlaceholder: true,
                placeholder: 'deskripsikan tujuan fakultas'
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
                url: `{{ url('api/v1/fakultas/store') }}`,
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
