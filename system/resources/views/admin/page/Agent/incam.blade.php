<div class="card border-primary border-top border-3 border-0 mb-3">
    <div class="card-body">
        <strong>SALDO</strong>
        <hr>
        <div style="display: flex; justify-content: space-between">
            <h3 class="text-danger">
                <strong>{{ convert_to_rupiah($queryes->income ?? 0) }}</strong>
            </h3>
            <button {{ $queryes->income == 0 ? 'disabled' : '' }} class="btn btn-primary btn-sm" data-bs-target="#pencairan"
                data-bs-toggle="modal" title="pencairan">Cairkan
                Dana</button>
        </div>
        <hr>
        <small class="text-secondary">
            * calon mahasiswa diantar sampai adminitrasi {{ convert_to_rupiah(50000) }}
            <br>
            ** calon mahasiswa diantar sampai daftar ulang {{ convert_to_rupiah(100000) }}
        </small>
    </div>
</div>
<div class="card card border-primary border-bottom border-3 border-0 mb-3">
    <ul class="nav nav-pills mb-3 border-primary border-top border-3 border-0" role="tablist"
        style="display: flex;justify-content: space-evenly; background: #fff; padding-bottom: 10px;padding-top: 10px; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        <li class="nav-item" role="presentation">
            <a aria-selected="false" class="n-tab active" data-bs-toggle="pill" href="#x2" role="tab"
                tabindex="-1">
                <div class="d-flex align-items-center">
                    <div class="tab-title">CALON MAHASISWA</div>
                </div>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a aria-selected="true" class="n-tab " data-bs-toggle="pill" href="#x3" role="tab">
                <div class="d-flex align-items-center">
                    <div class="tab-title">RIWAYAT PENARIKAN</div>
                </div>
            </a>
        </li>
    </ul>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="x2" role="tabpanel">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr style="font-size: .8em">
                                <th>NO</th>
                                <th>PENDAFATARAN</th>
                                <th>JALUR</th>
                                <th>NAMA</th>
                                <th>STATUS</th>
                                <th>INCAM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = [];
                            @endphp
                            @foreach ($queryes->pendaftaran as $items)
                                <tr style="padding: 10px">
                                    <td class="">
                                        <h6 class="mb-0 font-14">
                                            {{ $loop->iteration }}
                                        </h6>
                                    </td>
                                    <td class="">
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 p-0 font-14" style="margin: 0">
                                                {{ $items->informasi_pendaftaran->pendaftaran ?? '-' }} /
                                                {{ $items->informasi_pendaftaran->tahun_ajaran ?? '-' }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="">
                                        <h6 class="mb-0 font-14">
                                            {{ strtoupper($items->calon_mahasiswa->jalur_pendaftaran ?? '-') }}
                                        </h6>
                                    </td>
                                    <td class="tb-title">{{ $items->calon_mahasiswa->nama_lengkap }}</td>
                                    <td class="tb-acton">
                                        @if (!empty($items))
                                            @php
                                                $bg = $items->status == 'pending' ? 'badge-yellow' : ($items->status == 'invalid' ? 'badge-red' : 'badge-primary');
                                                $msg = $items->status == 'pending' ? 'Pending' : ($items->status == 'invalid' ? 'invalid' : 'valid');
                                            @endphp
                                            <span class="badge {{ $bg }} badge-round"
                                                title="status pending artinya data belum di verifikasi">
                                                {{ $msg }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="tb-title">
                                        @php
                                            $inc = $items->status != 'pending' && $items->status != 'daftar_ulang' ? 50000 : ($items->status == 'daftar_ulang' ? 100000 : 0);
                                            array_push($total, $inc);
                                        @endphp
                                        {{ $items->status != 'pending' && $items->status != 'daftar_ulang' ? convert_to_rupiah($inc) : ($items->status == 'daftar_ulang' ? convert_to_rupiah($inc) : convert_to_rupiah($inc)) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5">Totoal</th>
                                <th>{{ convert_to_rupiah(array_sum($total)) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="x3" role="tabpanel">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr style="font-size: .8em">
                                <th>NO</th>
                                <th>TANGGAL</th>
                                <th>JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = [];
                            @endphp
                            @foreach ($queryes->riwayat_pencairan_agent as $items)
                                <tr style="padding: 10px">
                                    <td class="">
                                        <h6 class="mb-0 font-14">
                                            {{ $loop->iteration }}
                                        </h6>
                                    </td>
                                    <td class="">
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 p-0 font-14" style="margin: 0">
                                                {{ $items->created_at->format('d M Y - H:i:s') }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 p-0 font-14" style="margin: 0">
                                                @php
                                                    array_push($total, $items->jml_pencairan);
                                                @endphp
                                                {{ convert_to_rupiah($items->jml_pencairan ?? 0) }}
                                            </h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Totoal</th>
                                <th>{{ convert_to_rupiah(array_sum($total)) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<div aria-hidden="true" class="modal fade" id="pencairan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">FORM PENCAIRAN SALDO</h5>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">JUMLAH PENCAIRAN</label>
                    <input class="form-control form-control-sm decimal inp-pencairan-dana" id="tanpa-rupiah"
                        name="" placeholder="jumlah yang akan dicairkan" type="text" value="0">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                <button class="btn btn-primary" disabled id="btn-cair" type="button">
                    Oke
                </button>
            </div>
        </div>
    </div>
</div>
