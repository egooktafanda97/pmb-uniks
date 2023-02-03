<div class="row id-hide" id="card-alamat">
    <div class="col-xl-9 mx-auto">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-map me-1 font-22 text-primary"></i>
                    </div>
                    <h5 class="mb-0 text-primary">DATA ALAMAT CALON MAHASISWA</h5>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label" for="inputFirstName">ALAMAT LENGKAP <span
                                class="in-require">*</span></label>
                        <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" placeholder="Alamat lengkap" rows="3"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">PROVINSI <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="provinsi" name="provinsi" required>
                        </select>
                    </div>
                    <div class="col-md-6" id="kab">
                        <label class="form-label" for="inputFirstName">KABUPATEN <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="kabupaten" name="kabupaten" required>
                            <option value="">PILIH KABUPATEN</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="kab">
                        <label class="form-label" for="inputFirstName">KECAMATAN <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="kecamatan" name="kecamatan" required>
                            <option value="">PILIH KECAMATAN</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="kab">
                        <label class="form-label" for="inputFirstName">KELURAHAN <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="kelurahan" name="kelurahan" required>
                            <option value="">PILIH KELURAHAN</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">KODE POS</label>
                        <input class="form-control" name="kode_pos" placeholder="55555" type="text">
                    </div>
                    <hr>
                    <div class="mt-3 space-between">
                        <button class="btn btn-primary px-5 rounded-0 btn-sm next-card" data-card-id="card-alamat"
                            data-next-id="card-mhs" type="button"> <i class="fa fa-long-arrow-left"></i>
                            Kembali</button>
                        <button class="btn btn-primary px-5 rounded-0 btn-sm next-card" data-card-id="card-alamat"
                            data-next-id="card-orangtua" type="button">
                            Next <i class="fa fa-long-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
