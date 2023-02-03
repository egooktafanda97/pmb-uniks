<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            {{--  NAV TABS PROGRAM STUDI  --}}
            <li class="nav-item" role="presentation">
                <a aria-selected="true" class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="fadeIn animated bx bx-file font-18 me-1"></i>
                        </div>
                        <div class="tab-title">PRODI</div>
                    </div>
                </a>
            </li>
            {{--  NAV TABS PROFILE  --}}
            <li class="nav-item" role="presentation">
                <a aria-selected="false" class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                    tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="fadeIn animated bx bx-file font-18 me-1"></i>
                        </div>
                        <div class="tab-title">PROFILE</div>
                    </div>
                </a>
            </li>
            {{--  NAV TABS LAMPIRAN  --}}
            <li class="nav-item" role="presentation">
                <a aria-selected="false" class="nav-link" data-bs-toggle="tab" href="#lampiran" role="tab"
                    tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="fadeIn animated bx bx-file font-18 me-1"></i>
                        </div>
                        <div class="tab-title">LAMPIRAN</div>
                    </div>
                </a>
            </li>
            {{--  NAV TABS BUKTI PEMBAYARAN  --}}
            <li class="nav-item" role="presentation">
                <a aria-selected="false" class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                    tabindex="-1">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><i class="fadeIn animated bx bx-file font-18 me-1"></i>
                        </div>
                        <div class="tab-title">BUKTI PEMBAYARAN</div>
                    </div>
                </a>
            </li>
        </ul>
        {{--  DATA TABS PROGRAM STUDI  --}}
        <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                <div class="mb-3 mt-3">
                    <strong style="color: #9c9c9c"><i class="fa fa-home"></i> NAMA PROGRAM STUDI YANG DIPILIH</strong>
                </div>
                <div class="space-between">

                    <h6 class="text-primary" style="margin: 0">{{ $pendaftaran->prodi->nama_prodi ?? '' }}</h6>
                    <a class="text-primary" style="font-size: 1rem" type="button"><i
                            class="fadeIn animated bx bx-navigation"></i>
                    </a>
                </div>
            </div>
            {{--  TABS CALON MAHASISWA --}}
            <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                <div class="mb-3">
                    <strong style="color: #9c9c9c"><i class="fa fa-user"></i> CALON MAHASISWA</strong>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($informasi_pendaftaran['c_mhs'] as $k => $v)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
                        </li>
                    @endforeach
                </ul>
                <br>
                <hr>
                <br>
                <div class="mb-3">
                    <strong style="color: #9c9c9c"><i class="fa fa-user"></i> AYAH</strong>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($informasi_pendaftaran['ayah'] as $k => $v)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
                        </li>
                    @endforeach
                </ul>
                <br>
                <hr>
                <br>
                <div class="mb-3">
                    <strong style="color: #9c9c9c"><i class="fa fa-user"></i> IBU</strong>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($informasi_pendaftaran['ibu'] as $k => $v)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{--  TABS LAMPIRAN  --}}
            <div class="tab-pane fade" id="lampiran" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a aria-selected="false" class="nav-link active" data-bs-toggle="pill"
                                    href="#primary-pills-home" role="tab" tabindex="-1">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">FOTO FORMAL</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a aria-selected="false" class="nav-link" data-bs-toggle="pill"
                                    href="#primary-pills-profile" role="tab" tabindex="-1">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">SC KTP</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a aria-selected="true" class="nav-link " data-bs-toggle="pill"
                                    href="#primary-pills-contact" role="tab">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">SC KK</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a aria-selected="true" class="nav-link" data-bs-toggle="pill" href="#ijasa"
                                    role="tab">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">SC IJASA/SKL</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a aria-selected="true" class="nav-link" data-bs-toggle="pill" href="#kip"
                                    role="tab">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Sc KIP</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade active show" id="primary-pills-home" role="tabpanel">
                                @if ($pendaftaran->lampiran_pendaftaran->foto_formal ?? false)
                                    <img alt=""
                                        src="{{ asset('assets/' . $pendaftaran->lampiran_pendaftaran->foto_formal) }}"
                                        width="100%">
                                @endif
                            </div>
                            <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                                @if ($pendaftaran->lampiran_pendaftaran->sc_ktp ?? false)
                                    @php
                                        $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_ktp);
                                        $extensinon = \File::extension($urls);
                                    @endphp
                                    @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                        <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                            id="the-canvas-ktp"></canvas>
                                    @else
                                        <img alt="" src="{{ $urls }}" width="100%">
                                    @endif
                                @else
                                    <div
                                        class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-warning">Warning</h6>
                                                <div>Tidak ada file yang diupload</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade " id="primary-pills-contact" role="tabpanel">
                                @if ($pendaftaran->lampiran_pendaftaran->sc_kk ?? false)
                                    @php
                                        $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_kk);
                                        $extensinon = \File::extension($urls);
                                    @endphp
                                    @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                        <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                            id="the-canvas-kk"></canvas>
                                    @else
                                        <img alt="" src="{{ $urls }}" width="100%">
                                    @endif
                                @else
                                    <div
                                        class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-warning">Warning</h6>
                                                <div>Tidak ada file yang diupload</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="ijasa" role="tabpanel">
                                @if ($pendaftaran->lampiran_pendaftaran->sc_ijasa_skl ?? false)
                                    @php
                                        $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_ijasa_skl);
                                        $extensinon = \File::extension($urls);
                                    @endphp
                                    @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                        <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                            id="the-canvas-ijasa"></canvas>
                                    @else
                                        <img alt="" src="{{ $urls }}" width="100%">
                                    @endif
                                @else
                                    <div
                                        class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-warning">Warning</h6>
                                                <div>Tidak ada file yang diupload</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="kip" role="tabpanel">
                                @if ($pendaftaran->lampiran_pendaftaran->sc_kip_kks_pkh ?? false)
                                    @php
                                        $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_kip_kks_pkh);
                                        $extensinon = \File::extension($urls);
                                    @endphp
                                    @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                        <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                            id="the-canvas-kip"></canvas>
                                    @else
                                        <img alt="" src="{{ $urls }}" width="100%">
                                    @endif
                                @else
                                    <div
                                        class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-warning">Warning</h6>
                                                <div>Tidak ada file yang diupload</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||| --}}
                {{-- <div class="card mb-3 mt-3">
                    <div class="card-header bg-primary">
                        <div class="space-between text-light">
                            <strong>Data Lainnya</strong>
                            <button class="btn btn-sm btn-info">Download</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="the-canvas-ktp"></canvas>
                    </div>
                </div> --}}
            </div>
            {{-- TABS BUKTI PEMBAYARAN  --}}
            <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        @if ($pendaftaran->bukti_pembayaran->bukti_pembayaran ?? false)
                            <img alt=""
                                src="{{ asset('assets/' . $pendaftaran->bukti_pembayaran->bukti_pembayaran) }}"
                                width="100%">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0" style="font-size: .8em">Nama Bank / Provider</strong>
                                <span class="text-secondary"
                                    style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->nama_bank ?? '-' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0" style="font-size: .8em">Atas Nama</strong>
                                <span class="text-secondary"
                                    style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->atas_nama ?? '-' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0" style="font-size: .8em">Waktu Bayar</strong>
                                @if ($pendaftaran->bukti_pembayaran->waktu_bayar ?? false)
                                    <span class="text-secondary"
                                        style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->waktu_bayar ? date('Y-m-d h:i:s', strtotime($pendaftaran->bukti_pembayaran->waktu_bayar ?? '-')) : '-' }}</span>
                                @endif
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0" style="font-size: .8em">Jumlah Trasfer</strong>
                                <span class="text-secondary"
                                    style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->jumlah_tf ?? '-' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <strong class="mb-0" style="font-size: .8em">Keterangan</strong>
                                <span class="text-secondary"
                                    style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->keterangan ?? '-' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
