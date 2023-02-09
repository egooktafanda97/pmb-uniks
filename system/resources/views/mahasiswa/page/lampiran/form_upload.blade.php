@if (!empty(request()->get('edit')))
    <div class="col-md-12 mb-3">
        <div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-info"><i class="bx bx-info-square"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-info">Info</h6>
                    <div>
                        upload file yang akan di edit saja & kosongkan jika file yang di upload sudah benar.
                    </div>
                </div>
            </div>
            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
        </div>
    </div>
@endif
<div class="col-md-6 mb-3">
    <label class="form-label">
        <strong>
            <i class="lni lni-paperclip"></i>
            PAS FOTO FORMAL (JPG)<span class="in-require">*</span>
        </strong>
    </label>

    <input {{ request()->get('edit') ? '' : 'required' }} class="form-control form-control-sm" name="foto_formal"
        type="file">
</div>
<div class="col-md-6 mb-3">
    <label class="form-label">
        <strong>
            <i class="lni lni-paperclip"></i>
            SCAN KTP (JPG / PDF) <span class="in-require">*</span>
        </strong>
    </label>

    <input {{ request()->get('edit') ? '' : 'required' }} class="form-control form-control-sm" name="sc_ktp"
        type="file">
</div>
<div class="col-md-6 mb-3">
    <label class="form-label">
        <strong>
            <i class="lni lni-paperclip"></i>
            SCAN KARTU KELUARGA (JPG / PDF) <span class="in-require">*</span>
        </strong>
    </label>
    <input {{ request()->get('edit') ? '' : 'required' }} class="form-control form-control-sm" name="sc_kk"
        type="file">
</div>
<div class="col-md-6 mb-3">
    <label class="form-label">
        <strong>
            <i class="lni lni-paperclip"></i>
            SCAN IJAZAH / SKL (JPG / PDF) <span class="in-require">*</span></strong>
    </label>
    <input {{ request()->get('edit') ? '' : 'required' }} class="form-control form-control-sm" name="sc_ijasa_skl"
        type="file">
</div>
@if ($pendaftaran->calon_mahasiswa->jalur_pendaftaran == 'kip-k')
    <div class="col-md-6 mb-3">
        <label class="form-label">
            <strong>
                <i class="lni lni-paperclip"></i>
                SCAN KIP/KKS/PKH <span class="in-require">*</span>
            </strong>
        </label>
        <input {{ request()->get('edit') ? '' : 'required' }} class="form-control form-control-sm" name="sc_kip"
            type="file">
    </div>
@endif

@if ($pendaftaran->calon_mahasiswa->jalur_pendaftaran == 'alih_jenjang')
    <div class="col-md-6 mb-3">
        <label class="form-label">
            <strong>
                <i class="lni lni-paperclip"></i>
                SURAT PINDAH <span class="in-require">*</span>
            </strong>
        </label>
        <input {{ request()->get('edit') ? '' : 'required' }} class="form-control form-control-sm" name="surat_pindah"
            type="file">
    </div>
@endif

{{-- <div class="col-md-6 mb-5">
    <label class="form-label">
        <strong>
            <i class="lni lni-paperclip"></i>
            LAIN LAIN (OPSIONAL) ZIP
        </strong>
    </label>
    <input class="form-control form-control-sm" name="lain_lain" type="file">
</div> --}}
