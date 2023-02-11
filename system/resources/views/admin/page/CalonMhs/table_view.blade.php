<div class="">
    <div class="d-lg-flex align-items-center space-between mb-4 gap-3">
        <div style="display: flex; justify-content: center; align-content: center; align-items: center">
            <div class="position-relative">
                <input class="form-control form-control-sm" id="search" name="search" placeholder="cari nama / nik"
                    type="text" value="{{ request()->get('search') ?? '' }}">
            </div>
        </div>
        <div class="d-flex order-actions">
            {{-- <a class="ms-3 bt-icon text-primary toggel_view" data-hide="chart" data-show="table"
                title="lihat grafik"><i class="fadeIn animated bx bx-line-chart-down"></i></a> --}}



            {{-- <a class="ms-3 bt-icon text-secondary" data-bs-target="#print_filter" data-bs-toggle="modal"
                title="cetak kartu"><i class="fa fa-id-card"></i></a> --}}

            <a class="ms-3 bt-icon text-secondary" data-bs-target="#print_filter" data-bs-toggle="modal"
                title="print"><i class="fadeIn animated bx bx-printer"></i></a>

            <a class="ms-3 bt-icon text-success" href="#" id="exp" title="export excel">
                <i class="fa fa-file-excel"></i>
            </a>
        </div>
    </div>
    <div class="viwers">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>
                            <div>
                                {{-- <input aria-label="..." class="form-check-input me-3" type="checkbox" value=""> --}}
                                No
                            </div>
                        </th>
                        <th>PENDAFATARAN</th>
                        <th>TAHUN AJARAN</th>
                        <th>JALUR PENDAFATARAN</th>
                        <th>NIK</th>
                        <th>NAMA LENGKAP</th>
                        <th>STATUS</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mhs as $items)
                        <tr style="padding: 10px">
                            <td class="">

                                <div class="d-flex align-items-center">
                                    {{-- <div>
                                        <input aria-label="..." class="form-check-input me-3" type="checkbox" value="">
                                    </div> --}}
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-14">
                                            {{ ($mhs->currentPage() - 1) * $mhs->perPage() + $loop->iteration }}
                                        </h6>
                                    </div>
                                </div>
                            </td>
                            <td class="">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 p-0 font-14" style="margin: 0">
                                        {{ $items->pendaftaran->informasi_pendaftaran->pendaftaran ?? '-' }}
                                    </h6>
                                </div>
                            </td>
                            <td class="">
                                <h6 class="mb-0 font-14">
                                    {{ $items->pendaftaran->informasi_pendaftaran->tahun_ajaran ?? '-' }}
                                </h6>
                            </td>
                            <td class="">
                                <h6 class="mb-0 font-14">
                                    {{ strtoupper($items->jalur_pendaftaran ?? '-') }}
                                </h6>
                            </td>
                            <td class="">{{ $items->nik }}</td>
                            <td class="tb-title">{{ $items->nama_lengkap }}</td>
                            <td class="tb-acton">
                                @if (!empty($items->pendaftaran))
                                    @php
                                        $bg = $items->pendaftaran->status == 'pending' ? 'badge-yellow' : ($items->pendaftaran->status == 'invalid' ? 'badge-red' : 'badge-primary');
                                        $msg = $items->pendaftaran->status == 'pending' ? 'Pending' : ($items->pendaftaran->status == 'invalid' ? 'invalid' : 'valid');
                                    @endphp
                                    <span class="badge {{ $bg }} badge-round"
                                        title="status pending artinya data belum di verifikasi">
                                        {{ $msg }}
                                    </span>
                                @endif
                            </td>
                            <td class="tb-acton">
                                <a class="btn btn-primary btn-sm radius-30 px-4"
                                    href="{{ url('admin/mhs/getById/' . \App\Helpers\Crypto::encrypt($items->pendaftaran->id) ?? null) }}"
                                    type="button">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="paging">
            {!! $mhs->appends(request()->query())->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>
