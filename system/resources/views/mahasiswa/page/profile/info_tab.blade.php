<ul class="nav nav-pills mb-3 border-primary  border-bottom border-3 border-0 mb-3" role="tablist"
    style="display: flex;justify-content: space-evenly; background: #fff; padding-bottom: 10px;padding-top: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
    <li class="nav-item" role="presentation">
        <a aria-selected="true" class="n-tab active" data-bs-toggle="pill" href="#primary-pills-home" role="tab">
            <div class="d-flex align-items-center">
                <div class="tab-title">PROFILE</div>
            </div>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a aria-selected="false" class="n-tab" data-bs-toggle="pill" href="#primary-pills-profile" role="tab"
            tabindex="-1">
            <div class="d-flex align-items-center">
                <div class="tab-title">LAMPIRAN</div>
            </div>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a aria-selected="false" class="n-tab" data-bs-toggle="pill" href="#primary-pills-contact" role="tab"
            tabindex="-1">
            <div class="d-flex align-items-center">
                <div class="tab-title">BUKTI BAYAR</div>
            </div>
        </a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade active show" id="primary-pills-home" role="tabpanel">
        <div class="card border-primary border-bottom border-3 border-0 mb-3">
            <div class="card-header text-light bg-primary">
                <div class="space-between">
                    <strong>DATA PENDAFTARAN</strong>
                    @if ($pendaftaran->status == 'pending' || $pendaftaran->status == 'invalid')
                        <a class="text-light fadeIn animated bx bx-message-square-edit"
                            href="{{ url('mahasiswa/form?edit=mhs') }}">Edit</a>
                    @endif

                </div>
            </div>
            <div class="card-body">
                <div class="card border-primary border-bottom border-3 border-0 mb-3">
                    <div class="card-body">
                        <strong>PROGRAM STUDI</strong>
                        <hr>
                        @if ($pendaftaran->pilihan_prodi)
                            @foreach ($pendaftaran->pilihan_prodi as $plp)
                                <div class="space-between" style="margin-bottom: 5px">
                                    <strong class="text-primary" style="margin: 0;    font-size: .8em;">
                                        {{ $plp->no_pilihan }}. {{ $plp->prodi->nama_prodi }}
                                    </strong>

                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="card border-primary border-bottom border-3 border-0 mb-3">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($informasi_pendaftaran['jalur'] as $k => $v)
                                @if ($v)
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                                        <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($informasi_pendaftaran['c_mhs'] as $k => $v)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">{{ $k }}</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $v }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card border-primary border-bottom border-3 border-0 mb-3">
            <div class="card-header text-light bg-primary">
                <div class="space-between">
                    <strong>DATA ORANGTUA</strong>
                </div>
            </div>
            <div class="card-body">
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
        </div>
    </div>
    <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
        <div class="card border-primary border-bottom border-3 border-0 mb-3">
            <div class="card-header text-light bg-primary">
                <div class="space-between">
                    <strong>LAMPIRAN</strong>
                    @if ($pendaftaran->status == 'pending' || $pendaftaran->status == 'invalid')
                        <a class="text-light fadeIn animated bx bx-message-square-edit"
                            href="{{ url('mahasiswa/form?edit=lampiran') }}">Edit</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills mb-3 border-primary border-top border-3 border-0" role="tablist"
                    style="display: flex;justify-content: space-evenly; background: #fff; padding-bottom: 10px;padding-top: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                    <li class="nav-item" role="presentation">
                        <a aria-selected="false" class="n-tab active" data-bs-toggle="pill"
                            href="#primary-pills-foto" role="tab" tabindex="-1">
                            <div class="d-flex align-items-center">
                                <div class="tab-title">FOTO</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a aria-selected="false" class="n-tab" data-bs-toggle="pill" href="#primary-pills-ktp"
                            role="tab" tabindex="-1">
                            <div class="d-flex align-items-center">
                                <div class="tab-title">KTP</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a aria-selected="true" class="n-tab " data-bs-toggle="pill" href="#primary-pills-kk"
                            role="tab">
                            <div class="d-flex align-items-center">
                                <div class="tab-title">KK</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a aria-selected="true" class="n-tab" data-bs-toggle="pill" href="#ijasa" role="tab">
                            <div class="d-flex align-items-center">
                                <div class="tab-title">IJASA/SKL</div>
                            </div>
                        </a>
                    </li>
                    @if ($pendaftaran->calon_mahasiswa->jalur_pendaftaran == 'kip-k')
                        <li class="nav-item" role="presentation">
                            <a aria-selected="true" class="n-tab" data-bs-toggle="pill" href="#kip"
                                role="tab">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">KIP</div>
                                </div>
                            </a>
                        </li>
                    @endif
                    @if ($pendaftaran->calon_mahasiswa->jalur_pendaftaran == 'transfer')
                        <li class="nav-item" role="presentation">
                            <a aria-selected="true" class="n-tab" data-bs-toggle="pill" href="#surat_pindah"
                                role="tab">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">SURAT PINDAH</div>
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="primary-pills-foto" role="tabpanel">
                        <img alt=""
                            src="{{ asset('assets/' . $pendaftaran->lampiran_pendaftaran->foto_formal) }}"
                            width="100%">
                    </div>
                    <div class="tab-pane fade" id="primary-pills-ktp" role="tabpanel">
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
                    <div class="tab-pane fade " id="primary-pills-kk" role="tabpanel">
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
                        @if ($pendaftaran->lampiran_pendaftaran->sc_kip ?? false)
                            @php
                                $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->sc_kip);
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

                    <div class="tab-pane fade" id="surat_pindah" role="tabpanel">
                        @if ($pendaftaran->lampiran_pendaftaran->surat_pindah ?? false)
                            @php
                                $urls = asset('assets/' . $pendaftaran->lampiran_pendaftaran->surat_pindah);
                                $extensinon = \File::extension($urls);
                            @endphp
                            @if ($extensinon == 'pdf' || $extensinon == 'PDF')
                                <canvas class="canvas-pdf" data-url="{{ $urls }}"
                                    id="the-canvas-surat"></canvas>
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
    </div>
    <div class="tab-pane fade" id="primary-pills-contact" role="tabpanel">
        <div class="card border-primary border-bottom border-3 border-0 mb-3">
            <div class="card-header text-light bg-primary">
                <div class="space-between">
                    <strong>BUKTI PEMBAYARAN</strong>
                    @if ($pendaftaran->status == 'pending' || $pendaftaran->status == 'invalid')
                        <a class="text-light fadeIn animated bx bx-message-square-edit"
                            href="{{ url('mahasiswa/form?edit=biaya') }}">Edit</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img alt=""
                            src="{{ asset('assets/' . $pendaftaran->bukti_pembayaran->bukti_pembayaran) }}"
                            width="100%">
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
                                <span class="text-secondary"
                                    style="font-size: .8em">{{ $pendaftaran->bukti_pembayaran->waktu_bayar ? date('Y-m-d h:i:s', strtotime($pendaftaran->bukti_pembayaran->waktu_bayar ?? '-')) : '-' }}</span>
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
