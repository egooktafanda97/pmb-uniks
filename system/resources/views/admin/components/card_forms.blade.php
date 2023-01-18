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
            <div class="card-body">
                <div class="space-between">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ url()->previous() }}" class="mr-2"> <i class="fa fa-long-arrow-left"></i></a>
                        <h5 class="card-title text-primary m-0"> INPUT FAKULTAS</h5>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <button type="submit" class="btn btn-outline-primary px-5">
                            <i class="fa fa-save"></i>Simpan</button>
                    </div>
                </div>
                <hr>
                <form action="">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Nama Fakultas <span class="in-require">*</span></label>
                                <input type="text" name="nama_fakultas"
                                    class="form-control form-control-sm validationTooltip03" placeholder="nama fakultas"
                                    required="">
                                <div class="invalid-tooltip">Input wajib di isi.</div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Nama Dekan</label>
                                <input type="text" name="kepala_fakultas" class="form-control form-control-sm"
                                    placeholder="nama fakultas">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Struktur Management</label>
                                <input type="file" name="kepala_fakultas" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Foto Fakultas</label>
                                <input type="file" name="kepala_fakultas" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="">Situs Web</label>
                                <input type="text" name="kepala_fakultas" class="form-control form-control-sm"
                                    placeholder="https://example.com">
                            </div>
                        </div>

                        <div class="col-md-12 mb-2">
                            <div class=" mt-3">
                                <div class="card-body">
                                    <ul class="nav nav-tabs nav-primary" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome"
                                                role="tab" aria-selected="true">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-title">Info Fakultas</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile"
                                                role="tab" aria-selected="false" tabindex="-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-title">Visi Misi</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#primarycontact"
                                                role="tab" aria-selected="false" tabindex="-1">
                                                <div class="d-flex align-items-center">
                                                    <div class="tab-title">Tujuan</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content py-3">
                                        <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
                                            <textarea class="info_fakultas" id="info_fakultas" name="info_fakultas">
                                            </textarea>
                                        </div>
                                        <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                            <textarea class="visi_misi" id="visi_misi" name="visi_misi">
                                            </textarea>
                                        </div>
                                        <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                            <textarea class="tujuan" id="tujuan" name="tujuan">
                                            </textarea>
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
                </form>
            </div>
        </div>
    </div>
</div>
