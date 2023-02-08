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
                    {{-- <div class="col-md-6">
                        <input class="form-control inp-date" name="tanggal_lahir" required type="date" />
                        <input class="datepicker date-input form-control inp-date" id="from-date" name="tanggal_lahir"
                            required type="text" />
                    </div> --}}
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TANGGAL LAHIR
                            <span class="in-require">*</span></label>
                        <div class="input-group mb-3">
                            <input aria-describedby="basic-addon2" class="datepicker date-input form-control inp-date"
                                id="from-date" name="tanggal_lahir" placeholder="30/10/1997" type="text">
                            <span class="input-group-text from-datepicker-btn" id="basic-addon2"
                                style="cursor: pointer;">
                                <span aria-hidden="true" class="fa fa-calendar"></span>
                            </span>
                        </div>
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
                        <label class="form-label" for="inputFirstName">STATUS PERKAWINAN <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="status_perkawinan" name="status_perkawinan"
                            required>
                            <option value="">Pilih Status Perkawinan</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">KEWARGA NEGARAAN<span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="kewarga_negaraan" name="kewarga_negaraan"
                            required>
                            <option value="wni">Warga Negara Indonesia</option>
                            <option value="wna">Warga Negara Asing</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NOMOR HANDPHONE (WA) <span
                                class="in-require">*
                                +62</span></label>
                        <input class="form-control" name="no_telepon" placeholder="tempat lahir sesuai ktp / ijasah"
                            required type="text" value="+62">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">JENIS SLTA <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="jenis_slta" name="jenis_slta" required>
                            <option value="sma">SMA</option>
                            <option value="smk">SMK</option>
                            <option value="ma">MA</option>
                            <option value="lainnya">LAIN NYA</option>
                        </select>
                        <input class="form-control" id="lainya_jenis_slta" placeholder="jenis slta"
                            style="display:none;" type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NAMA ASAL SLTA <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="asal_slta"
                            placeholder="asal sekolah sesuai ijasah terakhir" required type="text">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TAHUN Ijazah <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="tahun_ijazah" name="tahun_ijazah"
                            required>
                            @foreach (array_combine(range(date('Y'), 1900), range(date('Y'), 1900)) as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NO. IJAZAH <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="no_ijazah" placeholder="Nomor Ijazah" required
                            type="number">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">SUMBER BIAYA KULIAH TERBESAR <span
                                class="in-require">*</span></label>
                        <select class="form-select form-select-md mb-3" id="sumber_biaya_kuliah"
                            name="sumber_biaya_kuliah" required>
                            <option value="">Pilih Sumber Biaya Kuliah</option>
                            <option value="Orantua/Wali">Orantua/Wali</option>
                            <option value="Ikatan Dinas">Ikatan Dinas</option>
                            <option value="Biaya Sendiri">Biaya Sendiri</option>
                            <option value="Beasiswa">Beasiswa</option>
                            <option value="Sponsor">Sponsor</option>
                            <option value="Lainnya">Lainnya</option>
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
