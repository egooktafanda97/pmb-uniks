<div class="row id-hide" id="card-prodi">
    <div class="col col-lg-9 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                PILIH PROGRA STUDI <span class="in-require">*</span>
            </div>
            <div class="card-body">
                @php
                    $selected = '';
                    if (!empty($pendaftaran->prodi)) {
                        $selected = $pendaftaran->prodi->id;
                    }
                @endphp
                <div class="mb-2">
                    <label for="">PILIHAN 1</label>
                    <select aria-label="program studi" class="form-select single-select" id="p1">
                        <option {{ $selected == '' ? 'selected' : '' }} value="">Pilih Program Studi </option>
                        @foreach ($prodi as $p)
                            <option {{ $selected == $p->id ? 'selected' : '' }} value="{{ $p->id }}">
                                {{ $p->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="">PILIHAN 2</label>
                    <select aria-label="program studi" class="form-select single-select" id="p2">
                        <option {{ $selected == '' ? 'selected' : '' }} value="">Pilih Program Studi </option>
                        @foreach ($prodi as $p)
                            <option {{ $selected == $p->id ? 'selected' : '' }} value="{{ $p->id }}">
                                {{ $p->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="">PILIHAN 3</label>
                    <select aria-label="program studi" class="form-select single-select" id="p3">
                        <option {{ $selected == '' ? 'selected' : '' }} value="">Pilih Program Studi </option>
                        @foreach ($prodi as $p)
                            <option {{ $selected == $p->id ? 'selected' : '' }} value="{{ $p->id }}">
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
