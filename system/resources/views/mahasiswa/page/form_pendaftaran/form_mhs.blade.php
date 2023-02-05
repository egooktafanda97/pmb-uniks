<div class="row id-hide" id="card-mhs">
    <div class="col-xl-9 mx-auto">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                    </div>
                    <h5 class="mb-0 text-primary">DATA CALON MAHASISWA</h5>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NIK <span class="in-require">*</span></label>
                        <input class="form-control" maxlength="16" minlength="16" name="nik"
                            placeholder="nik 16 digit" required type="text" value="{{ $pendaftaran->nik }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NIS </label>
                        <input class="form-control" maxlength="16" name="nis" placeholder="isian opsional jika ada."
                            type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NPWP </label>
                        <input class="form-control" maxlength="16" name="npwp" placeholder="isian opsional jika ada."
                            type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NAMA LENGKAP <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="nama_lengkap" placeholder="nama lengkap sesuai ktp / ijasa"
                            required type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">JENIS KELAMIN <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="jenis_kelamin" name="jenis_kelamin"
                            required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TEMPAT LAHIR <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="tempat_lahir" placeholder="tempat lahir sesuai ktp / ijasah"
                            required type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TANGGAL LAHIR
                            <span class="in-require">*</span></label>
                        <input class="form-control inp-date" name="tanggal_lahir" required type="date" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">AGAMA <span class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="agama" name="agama" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Lain nya">Lain nya</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NOMOR HANDPHONE (WA) <span class="in-require">*
                                +62</span></label>
                        <input class="form-control" name="no_telepon" placeholder="tempat lahir sesuai ktp / ijasah"
                            required type="text" value="+62">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">ASAL SEKOLAH <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="asal_sekolah"
                            placeholder="asal sekolah sesuai ijasah terakhir" required type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TAHUN LULUS <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="tahun_lulus" name="tahun_lulus" required>
                            @foreach (array_combine(range(date('Y'), 1900), range(date('Y'), 1900)) as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="mt-3 space-between">
                        <button class="btn btn-secondary rounded-0 btn-sm next-card" data-card-id="card-mhs"
                            data-next-id="card-prodi"
                            style="height: 30px; width: 100px; display: flex; justify-content: center; align-items: center"
                            type="button"> <i class="fa fa-long-arrow-left"></i>
                        </button>
                        <button class="btn btn-primary  rounded-0 btn-sm btn-loader person_data_next"
                            data-card-id="card-mhs" data-next-id="card-alamat" id="data-personal"
                            style="height: 30px; width: 100px; display: flex; justify-content: center; align-items: center"
                            type="button">
                            <i class="fa fa-long-arrow-right"></i>
                            <span>
                                <b></b>
                                <b></b>
                                <b></b>
                            </span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
