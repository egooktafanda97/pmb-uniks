<div class="row id-hide" id="card-orangtua">
    <div class="col-xl-9 mx-auto">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-map me-1 font-22 text-primary"></i>
                    </div>
                    <h5 class="mb-0 text-primary">DATA ORANGTUA</h5>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">PEKERJAAN ORANTUA</label>
                        @php
                            $pekerjaan = ['Peg. Negeri', 'Peg. BUMN', 'Peg. Swasta', 'Wiraswasta', 'ABRI', 'PETANI', 'PEDAGANG', 'Pensiunan'];
                        @endphp
                        <select class="form-select form-select-md mb-3" name="pekerjaan_orangtua">
                            <option value="">Pekerjaan Orangtua</option>
                            @foreach ($pekerjaan as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">PENGHASILAN ORANGTUA / BULAN</label>
                        <select class="form-select form-select-md mb-3" name="penghasilan_orangtua">
                            <option value="">Tidak Ada Penghasilan</option>
                            <option value="< 3000000">
                                < {{ \App\Helpers\Helpers::convert_to_rupiah(3000000) }}</option>
                            <option value="3000000 - 6000000">
                                {{ \App\Helpers\Helpers::convert_to_rupiah(3000000) }} -
                                {{ \App\Helpers\Helpers::convert_to_rupiah(6000000) }}</option>
                            <option value="> 6000000">
                                > {{ \App\Helpers\Helpers::convert_to_rupiah(6000000) }}</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <br>
                            <strong style="color: #9c9c9c"><i class="fa fa-user"></i> AYAH</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NAMA LENGKAP <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="nama_ayah" placeholder="nama lengkap ayah/bapak/abah" required
                            type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TEMPAT LAHIR <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="tempat_lahir_ayah" placeholder="tempat lahir ayah" required
                            type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TANGGAL LAHIR <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="tanggal_lahir_ayah" required type="date" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NOMOR HANDPHONE (WA)</label>
                        <input class="form-control" maxlength="16" name="no_telepon_ayah" placeholder="" type="text"
                            value="">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="inputFirstName">ALAMAT LENGKAP</label>
                        <textarea class="form-control" id="alamat_lengkap_ayah" name="alamat_lengkap_ayah"
                            placeholder="Alamat lengkap ayah (optional)" rows="3"></textarea>
                    </div>
                </div>
                {{-- **************************************************************************** --}}
                <hr>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <br>
                            <strong style="color: #9c9c9c"><i class="fa fa-user"></i> IBU</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NAMA LENGKAP <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="nama_ibu" placeholder="nama lengkap ibu" required
                            type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TEMPAT LAHIR <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="tempat_lahir_ibu" placeholder="tempat lahir ibu" required
                            type="text">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">TANGGAL LAHIR <span
                                class="in-require">*</span></label>
                        <input class="form-control" name="tanggal_lahir_ibu" required type="date" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="inputFirstName">NOMOR HANDPHONE (WA) </label>
                        <input class="form-control" maxlength="16" name="no_telepon_ibu"
                            placeholder="+628 (jika ada)" type="text" value="">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="inputFirstName">ALAMAT LENGKAP</label>
                        <textarea class="form-control" id="alamat_lengkap_ibu" name="alamat_lengkap_ibu"
                            placeholder="Alamat lengkap ibu (optional)" rows="3"></textarea>
                    </div>
                    <hr>
                    <div class="mt-3 space-between">
                        <button class="btn btn-secondary rounded-0 btn-sm next-card" data-card-id="card-orangtua"
                            data-next-id="card-alamat"
                            style="height: 30px; width: 100px; display: flex; justify-content: center; align-items: center"
                            type="button"> <i class="fa fa-long-arrow-left"></i>
                        </button>
                        <button class="btn btn-primary  rounded-0 btn-sm btn-loader" id="form-done"
                            style="height: 30px; width: 100px; display: flex; justify-content: center; align-items: center"
                            type="button" type="button">
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
