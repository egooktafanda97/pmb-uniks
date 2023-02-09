<!-- Modal -->
<div aria-hidden="true" class="modal fade" id="filter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" method="get" style="width: 100%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">FILTER</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">Pendaftaran</label>
                        <select aria-label="Default select example" class="form-select" name="informasi_pendaftaran">
                            <option {{ !request()->informasi_pendaftaran ? 'selected' : '' }} value="">Seluruh
                                Data</option>
                            @foreach ($info_pendaftaran as $item)
                                @if ($item->status == 'active')
                                    <option {{ request()->informasi_pendaftaran == $item->id ? 'selected' : '' }}
                                        style="color: green" value="{{ $item->id }}">{{ $item->pendaftaran }}
                                        {{ $item->tahun }}</option>
                                @else
                                    <option {{ request()->informasi_pendaftaran == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}">{{ $item->pendaftaran }}
                                        {{ $item->tahun }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Status</label>
                        <select aria-label="Default select example" class="form-select" name="status">
                            <option {{ !request()->status ? 'selected' : '' }} value="">Seluruh Data</option>
                            <option {{ request()->status == 'pending' ? 'selected' : '' }} class="text-warning"
                                value="pending">Pending</option>
                            <option {{ request()->status == 'valid' ? 'selected' : '' }} class="text-success"
                                value="valid">Valid</option>
                            <option {{ request()->status == 'invalid' ? 'selected' : '' }} class="text-danger"
                                value="invalid">Invalid</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Tahun Ajaran</label>
                        <select aria-label="Default select example" class="form-select" name="tahun_ajaran">

                            <option {{ !request()->tahun_ajaran ? 'selected' : '' }} value="">Seluruh Data
                            </option>
                            @foreach ($tahun_ajaran as $item)
                                <option {{ request()->tahun_ajaran == $item ? 'selected' : '' }}
                                    value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group mb-3">
                        <label for="">Jalur Pendafataran</label>
                        <select aria-label="Default select example" class="form-select" name="tahun_ajaran">
                            <option {{ !request()->tahun_ajaran ? 'selected' : '' }} value="">Seluruh Data
                            </option>
                            @foreach ($tahun_ajaran as $item)
                                <option {{ request()->tahun_ajaran == $item ? 'selected' : '' }}
                                    value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="form-group mb-3">
                        <label for="">Program Studi</label>
                        <select aria-label="Default select example" class="form-select" name="prodi">
                            <option {{ !request()->prodi ? 'selected' : '' }} value="">Seluruh Data</option>
                            @foreach ($prodi as $item)
                                <option {{ request()->prodi == $item->id ? 'selected' : '' }}
                                    value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                    <button class="btn btn-primary" type="submit">Terapkan</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- print --}}
<!-- Modal -->
<div aria-hidden="true" class="modal fade" id="print_filter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form action="" id="form_print_filter" method="POST" style="width: 100%" target="_blank">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">FILTER LAPORAN</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="">PENGELOMPOKAN</label>
                        <select aria-label="Default select example" class="form-select" name="cluster">
                            <option value="1">PRODI PILIHAN 1</option>
                            <option value="2">PRODI PILIHAN 2</option>
                            {{-- <option value="prodi">PRODI LULUS</option> --}}
                        </select>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <strong for="">STATUS</strong>
                        <br>
                        <div class="d-flex space-between" style="margin-top: 5px; margin-bottom: 5px">
                            <label for="">Semua Status</label>
                            <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input checked-status" name="all" type="checkbox">
                            </div>
                        </div>
                        <div class="d-flex space-between" style="margin-top: 5px; margin-bottom: 5px">
                            <label for="">Data Valid</label>
                            <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input checked-status" name="valid" type="checkbox">
                            </div>
                        </div>
                        <div class="d-flex space-between" style="margin-top: 5px; margin-bottom: 5px">
                            <label for="">Data Tidak Valid</label>
                            <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input checked-status" name="invalid" type="checkbox">
                            </div>
                        </div>
                        <div class="d-flex space-between" style="margin-top: 5px; margin-bottom: 5px">
                            <label for="">Lulus</label>
                            <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input checked-status" name="lulus" type="checkbox">
                            </div>
                        </div>
                        <div class="d-flex space-between" style="margin-top: 5px; margin-bottom: 5px">
                            <label for="">Tidak Lulus</label>
                            <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input checked-status" name="tidak_lulus" type="checkbox">
                            </div>
                        </div>
                        <div class="d-flex space-between" style="margin-top: 5px; margin-bottom: 5px">
                            <label for="">Daftar Ulang</label>
                            <div class="form-check-danger form-check form-switch">
                                <input class="form-check-input checked-status" name="daftar_ulang" type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                    <button class="btn btn-primary" id="btn_print_filter" type="button"><i class="fa fa-print"></i>
                        Print</button>
                    <input id="form_submit" style="display: none" type="submit">
                </div>
            </div>
        </form>
    </div>
</div>
