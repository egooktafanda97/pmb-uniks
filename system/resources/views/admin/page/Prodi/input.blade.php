@extends('admin.index.index') @section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet" />
    @endsection @section('content')
    <!--start page wrapper -->
    <div class="row">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $prefix ?? 'Table' }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"></li>
                        <li aria-current="page" class="breadcrumb-item active">
                            {{ $title ?? '' }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <input id="prodi_id" name="prodi_id" type="hidden" value="{{ $prodi->id ?? '' }}">
                <form enctype="multipart/form-data" id="form-save">
                    <div class="card-body">
                        <div class="space-between">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="mr-2" href="{{ url()->previous() }}">
                                    <i class="fa fa-long-arrow-left"></i></a>
                                <h5 class="card-title text-primary m-0">
                                    INPUT PROGRAM STUDI
                                </h5>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-outline-primary px-5" type="submit">
                                    <i class="fa fa-save"></i>Simpan
                                </button>
                            </div>
                        </div>
                        <hr />

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>NAMA PRODI
                                        <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03" name="nama_prodi"
                                        placeholder="nama fakultas" required="" type="text"
                                        value="{{ $prodi->nama_prodi ?? '' }}" />
                                    <div class="invalid-tooltip">
                                        Input wajib di isi.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>SINGKATAN
                                        <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03" maxlength="10"
                                        name="nama_alias" placeholder="singkatan prodi" required="" type="text"
                                        value="{{ $prodi->nama_alias ?? '' }}" />
                                    <div class="invalid-tooltip">
                                        Input wajib di isi.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>GELAR
                                        <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03" maxlength="5"
                                        name="gelar" placeholder="gelar yang diperoleh" required="" type="text"
                                        value="{{ $prodi->gelar ?? '' }}" />
                                    <div class="invalid-tooltip">
                                        Input wajib di isi.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label>BIAYA / SMESTER
                                        <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03" id="biaya"
                                        name="biaya" placeholder="biaya kuliah per smester" required type="text"
                                        value="{{ $prodi->biaya ?? '' }}" />
                                    <div class="invalid-tooltip">
                                        Input wajib di isi.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">NAMA FAKULTAS</label>
                                    <select class="form-control form-control-sm" id="fakultas_id" name="fakultas_id">
                                        @foreach ($fakultas as $item)
                                            <option {{ ($prodi->fakultas_id ?? '') == $item->id ? 'selected' : '' }}
                                                value="{{ $item->id }}">
                                                {{ $item->nama_fakultas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">JENJANG</label>
                                    <input class="form-control form-control-sm" id="jenjang" name="jenjang" readonly
                                        type="text" value="{{ $prodi->jenjang ?? 'S-1' }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">AKREDITAS</label>
                                    <select class="form-control form-control-sm" id="akreditas" name="akreditas">
                                        <option {{ ($prodi->akreditas ?? '') == 'A' ? 'selected' : '' }} value="A">A
                                        </option>
                                        <option {{ ($prodi->akreditas ?? '') == 'B' ? 'selected' : '' }} value="B">B
                                        </option>
                                        <option {{ ($prodi->akreditas ?? '') == 'B' ? 'selected' : '' }} value="B">
                                            BAIK
                                        </option>
                                        <option {{ ($prodi->akreditas ?? '') == 'Terkreditasi' ? 'selected' : '' }}
                                            value="Terkreditasi">
                                            Terkreditasi
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">KETUA PRODI</label>
                                    <input class="form-control form-control-sm" name="kepala_prodi"
                                        placeholder="nama fakultas" type="text"
                                        value="{{ $prodi->kepala_prodi ?? 'S-1' }}" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">FOTO PRODI</label>
                                    <input class="form-control form-control-sm" id="gambar" name="gambar"
                                        type="file" />
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="">Situs Web</label>
                                    <input class="form-control form-control-sm" id="situs_web" name="situs_web"
                                        placeholder="https://example.com" type="text"
                                        value="{{ $prodi->situs_web ?? 'S-1' }}" />
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
                                                    <label for="">EMAIL</label>
                                                    <input class="form-control form-control-sm" id="email"
                                                        name="email" type="email"
                                                        value="{{ $prodi->users->email ?? '' }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">PASSWORD</label>
                                                    <input class="form-control form-control-sm" id="password"
                                                        name="password" type="password" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        INFO PROGRAM STUDI
                                    </div>
                                    <div class="card-body">
                                        <div class="mt-3">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-primary" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <a aria-selected="true" class="nav-link active"
                                                            data-bs-toggle="tab" href="#primaryhome" role="tab">
                                                            <div class="d-flex align-items-center">
                                                                <div class="tab-title">
                                                                    INFO FAKULTAS
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a aria-selected="false" class="nav-link" data-bs-toggle="tab"
                                                            href="#primaryprofile" role="tab" tabindex="-1">
                                                            <div class="d-flex align-items-center">
                                                                <div class="tab-title">
                                                                    VISI MISI
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <a aria-selected="false" class="nav-link" data-bs-toggle="tab"
                                                            href="#primarycontact" role="tab" tabindex="-1">
                                                            <div class="d-flex align-items-center">
                                                                <div class="tab-title">
                                                                    TUJUAN
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content py-3">
                                                    <div class="tab-pane fade active show" id="primaryhome"
                                                        role="tabpanel">
                                                        <textarea class="info_fakultas" id="info_fakultas" name="info_fakultas">{{ $prodi->info_fakultas ?? '' }}</textarea>
                                                    </div>
                                                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                                        <textarea class="visi_misi" id="visi_misi" name="visi_misi">{{ $prodi->visi_misi ?? '' }}</textarea>
                                                    </div>
                                                    <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                                        <textarea class="tujuan" id="tujuan" name="tujuan">  {{ $prodi->tabpanel ?? '' }} </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-3 w-100 right-comp"></div>
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
            $(".info_fakultas").summernote({
                height: 300,
                tabsize: 2,
                inheritPlaceholder: true,
                placeholder: "deskripsikan informasi fakultas",
            });

            $(".visi_misi").summernote({
                height: 300,
                tabsize: 2,
                inheritPlaceholder: true,
                placeholder: "deskripsikan visi misi fakultas",
            });
            $(".tujuan").summernote({
                height: 300,
                tabsize: 2,
                inheritPlaceholder: true,
                placeholder: "deskripsikan tujuan fakultas",
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
            let url = `{{ url('api/v1/prodi/store') }}`;
            const form_data = new FormData(e.target);
            form_data.append("biaya", $("[name='biaya']").val().replace(/[^0-9]+/g, ""));
            if (!__empty($("#prodi_id").val())) {
                url = `{{ url('api/v1/prodi/updates') }}/${$("#prodi_id").val()}`;
            }
            const http_configure = {
                data: form_data,
                url: url,
                header: {
                    headers: {
                        Authorization: `Bearer {{ \Session::get('token')['access_token'] }}`,
                    },
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
                        text: "data fakultas berhasil di entry!",
                        icon: "success",
                        button: "Oke!",
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.href = `{{ url()->previous() }}`;
                        }
                    });
                },
            };
            save(http_configure);
        });
        /*
            |
            | END API ACTION
            |
            */

        /* Tanpa Rupiah */
        /* Tanpa Rupiah */
        var tanpa_rupiah = document.getElementById("biaya");
        tanpa_rupiah.addEventListener("keyup", function(e) {
            tanpa_rupiah.value = formatRupiah(this.value);
        });
        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }
    </script>
    @if (!empty($prodi))
        <script>
            $(document).ready(function() {
                $(".info_fakultas").summernote("code", `{{ $prodi->info_fakultas ?? '' }}`);
                $(".visi_misi").summernote("code", `{{ $prodi->visi_misi ?? '' }}`);
                $(".tujuan").summernote("code", `{{ $prodi->tabpanel ?? '' }}`);
            });
        </script>
    @endif
@endsection
