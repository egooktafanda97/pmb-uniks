<style>
    .form_alih_jenjang {
        display: none;
    }

    .form_kip {
        display: none;
    }
</style>
<div class="row id-hide" id="card-prodi">
    <div class="col col-lg-9 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                FORM PENDAFATRAN <span class="in-require">*</span>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <div style="display: flex;justify-content: space-between">
                        <label for="">JALUR PENDAFATARAN</label>
                        <span data-bs-target="#exampleModal" data-bs-toggle="modal">
                            <i class="fa fa-question-circle"></i>
                        </span>
                    </div>
                    <select aria-label="" class="form-select jalur-select" id="jalur_pendaftaran"
                        name="jalur_pendaftaran">
                        <option selected value="">Pilih Jalur Pendafataran</option>
                        <option value="regular">Regular</option>
                        <option value="alih_jenjang">Alih Jenjang</option>
                        <option value="transfer">Transfer</option>
                        <option value="kipk">KIPK</option>
                    </select>
                </div>
                <div class="form_kip">
                    <div class="mb-2">
                        <label for="">KARTU YANG DIMILIKI (opsional)</label>
                        <select aria-label="" class="form-select jalur-select" id="memiliki_kartu"
                            name="memiliki_kartu">
                            <option selected value="">Pilih Kartu</option>
                            <option value="kipk">KIPK</option>
                            <option value="pkh">PKH</option>
                            <option value="kks">KKS</option>
                            <option value="kis">KIS</option>
                        </select>
                    </div>
                </div>
                <div class="form_alih_jenjang">
                    <div class="mb-2">
                        <label class="form-label" for="inputFirstName">NAMA PERGURUSN TINGGI</label>
                        <input class="form-control" name="pt_sebelumnya" placeholder="nama perguruan tinggi sebelumnya"
                            type="text" value="">
                    </div>
                    <div class="mb-2">
                        <label for="">KATEGORI PERGURUAN TINGGI</label>
                        <select aria-label="" class="form-select jalur-select" id="kategori_pt" name="kategori_pt">
                            <option selected value="">Pilih PTN / PTS</option>
                            <option value="ptn">PTN</option>
                            <option value="pts">PTS</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="inputFirstName">JENIS IJAZAH DIPEROLEH</label>
                        <select aria-label="" class="form-select jalur-select" id="ijazah_diperolah"
                            name="ijazah_diperolah">
                            <option selected value="">Pilih Jenis Ijazah</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                            <option value="Diploma">Diploma</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="inputFirstName">JUMLAH SKS</label>
                        <input class="form-control" name="jml_sks" placeholder="100" type="number" value="">
                    </div>
                </div>
                <hr>
                @php
                    $p1 = '';
                    $p2 = '';
                    if (!empty($pendaftaran->prodi)) {
                        foreach ($pendaftaran->pilihan_prodi as $plp) {
                            if ($plp->no_pilihan == '1') {
                                $p1 = $plp->prodi_id;
                            }
                            if ($plp->no_pilihan == '2') {
                                $p2 = $plp->prodi_id;
                            }
                        }
                    }
                @endphp
                <div class="mb-2">
                    <label for="">PILIHAN 1</label>
                    <select aria-label="program studi" class="form-select p1-select" id="p1">
                        <option {{ $p2 == '' ? 'selected' : '' }} value="">Pilih Program Studi </option>
                        @foreach ($prodi as $p)
                            <option {{ $p1 == $p->id ? 'selected' : '' }} value="{{ $p->id }}">
                                {{ $p->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="">PILIHAN 2</label>
                    <select aria-label="program studi" class="form-select p2-select" id="p2">
                        <option {{ $p2 == '' ? 'selected' : '' }} value="">Pilih Program Studi </option>
                        @foreach ($prodi as $p)
                            <option {{ $p2 == $p->id ? 'selected' : '' }} value="{{ $p->id }}">
                                {{ $p->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4 id-hide d-none" id="info-prodi">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                PROGRAM STUDI {{ strtoupper($pendaftaran->prodi->nama_prodi ?? '') }}
                            </strong>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-primary" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="true" class="nav-link active" data-bs-toggle="tab"
                                        href="#primaryhome" role="tab">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">SYARAT</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="false" class="nav-link" data-bs-toggle="tab"
                                        href="#primaryprofile" role="tab" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">BIAYA</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a aria-selected="false" class="nav-link" data-bs-toggle="tab"
                                        href="#primarycontact" role="tab" tabindex="-1">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-title">TENTANG</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-3 ">
                                <div class="tab-pane fade active show syarat-card" id="primaryhome" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <br>
                                                <span style="color: #9c9c9c;font-size: .8em">
                                                    PERSYARATAN KHUSUS PROGRAM STUDI
                                                    {{ strtoupper($pendaftaran->prodi->nama_prodi ?? '') }}</span>
                                            </div>
                                            <hr>
                                            <div id="card-info-syarat">
                                                @if (!empty($pendaftaran->prodi) && count($pendaftaran->prodi->persyaratan_prodi) > 0)
                                                    <div class="x">
                                                        <ul class="list-group list-group-flush">
                                                            @foreach ($pendaftaran->prodi->persyaratan_prodi as $item)
                                                                <li
                                                                    class="list-group-item bg-transparent text-dark w-100 d-flex">
                                                                    <div
                                                                        style="width: 3%; display: flex;justify-content: center;align-content: center">
                                                                        <strong>{{ $loop->iteration }}</strong>
                                                                    </div>
                                                                    <div>
                                                                        <strong>
                                                                            {{ $item->persyaratan }}
                                                                        </strong>
                                                                        <br>
                                                                        <small>{{ $item->keterangan }}</small>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div
                                                        class="alert bg-white border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="font-35 text-info"><i
                                                                    class="bx bx-info-circle"></i>
                                                            </div>
                                                            <div class="ms-3">
                                                                <h6 class="mb-0 text-info">Info!</h6>
                                                                Tidak ada persyaratan khusus pada prodi
                                                                {{ $pendaftaran->prodi->nama_prodi ?? '' }}
                                                            </div>
                                                        </div>
                                                        <button aria-label="Close" class="btn-close"
                                                            data-bs-dismiss="alert" type="button"></button>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <br>
                                                <span style="color: #9c9c9c;font-size: .8em">
                                                    BIAYA PER SMESTER PADA PROGRAM STUDI
                                                    {{ strtoupper($pendaftaran->prodi->nama_prodi ?? '') }}</span>
                                            </div>
                                            <hr>
                                            <div id="card-info-biaya">
                                                <div id="card">
                                                    @if (!empty($pendaftaran->prodi) && count($pendaftaran->prodi->biaya_kuliah) > 0)
                                                        <div class="">
                                                            <ul class="list-group list-group-flush">
                                                                @foreach ($pendaftaran->prodi->biaya_kuliah as $item)
                                                                    <li
                                                                        class="list-group-item bg-transparent text-dark w-100 d-flex">
                                                                        <div
                                                                            style="width: 3%; display: flex;justify-content: center;align-content: center">
                                                                            <strong>{{ $loop->iteration }}</strong>
                                                                        </div>
                                                                        <div>
                                                                            <strong>
                                                                                {{ $item->keterangan }}
                                                                            </strong>
                                                                            <br>
                                                                            <strong>
                                                                                {{ $item->jumlah }}
                                                                            </strong>
                                                                            <br>
                                                                            <small>{{ $item->deskripsi }}</small>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @else
                                                        <div
                                                            class="alert bg-white border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="font-35 text-info"><i
                                                                        class="bx bx-info-circle"></i>
                                                                </div>
                                                                <div class="ms-3">
                                                                    <h6 class="mb-0 text-info">Info!</h6>
                                                                    Tidak ada persyaratan khusus pada prodi
                                                                    {{ $pendaftaran->prodi->nama_prodi ?? '' }}
                                                                </div>
                                                            </div>
                                                            <button aria-label="Close" class="btn-close"
                                                                data-bs-dismiss="alert" type="button"></button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis fugit eos
                                    ipsa, dignissimos vel odio voluptatem aliquam distinctio impedit? Molestiae,
                                    exercitationem enim? Sit, tempora cupiditate consequuntur quam repellat dolore
                                    sequi?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 l-right">
                    <button class="btn btn-primary px-5 rounded-0 btn-sm" data-card-id="card-prodi"
                        data-next-id="card-mhs" id="card-program-studi" type="button">
                        Next <i class="fa fa-long-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal"
    style="display: none;" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bantuan</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <div class="modal-body">
                <p>Keteranagan jalur pendafataran:</p>

                <ol>
                    <li>Regular&nbsp;<br />
                        yaitu jalur pendafataran seperti pada umum nya dan tidak ada penambahan syarat.</li>
                    <li>Alih jenjang&nbsp;<br />
                        yaitu bagi mahasiswa yang akan alih jenjang dari D1,D2,D3,D4 ke S1 dengan syarat ijazah
                        sesebelum nya &amp; traskip nilai&nbsp;yang di upload pada lampiran.</li>
                    <li>Trasfer<br />
                        yaitu bagi calon mahasiswa pindahan dengan syarat tambahan surat keterangan pindah &amp; traskip
                        nilai pada universitas sebelum nya&nbsp;yang di upload pada lampiran.</li>
                    <li>KIP-K (Kartu Indonesia Pintar - Kuliah)<br />
                        bagi calon mahasiswa dengan jalur KIP-K wajib menyertakan bukti KIP-K yang di upload pada
                        lampiran.<br />
                        &nbsp;</li>
                </ol>

            </div>
        </div>
    </div>
</div>
