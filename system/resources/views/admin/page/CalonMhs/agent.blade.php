<div class="">
    {{-- <div class="d-lg-flex align-items-center space-between mb-4 gap-3">
        <div style="display: flex; justify-content: center; align-content: center; align-items: center">
            <div class="position-relative">
                <input class="form-control form-control-sm" id="search" name="search" placeholder="cari nama / nik"
                    type="text" value="{{ request()->get('search') ?? '' }}">
            </div>
        </div>
        <div class="d-flex order-actions">
            <a class="ms-3 bt-icon text-secondary" data-bs-target="#print_filter" data-bs-toggle="modal"
                title="print"><i class="fadeIn animated bx bx-printer"></i></a>
            <a class="ms-3 bt-icon text-success" href="#" id="exp" title="export excel">
                <i class="fa fa-file-excel"></i>
            </a>
        </div>
    </div> --}}
    <div class="viwers">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Agent</th>
                        <th>Referal</th>
                        <th>Pendaftar</th>
                        <th>Validasi</th>
                        <th>Daftar Ulang</th>
                        <th>Total Income</th>
                        <th>Saldo</th>
                        <th>Ditarik</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agent as $items)
                        <tr style="padding: 10px">
                            <td class="">
                                <div class="d-flex align-items-center">
                                    <div class="ms-2">
                                        <h6 class="mb-0 font-14">
                                            {{ $loop->iteration }}
                                        </h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $items->nama_lengkap ?? '' }}</td>
                            <td>{{ $items->referal ?? '' }}</td>
                            <td>
                                <span class="badge badge-blue badge-round"
                                    title="status pending artinya data belum di verifikasi">
                                    {{ count($items->claster) ?? '0' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-yellow badge-round"
                                    title="status pending artinya data belum di verifikasi">
                                    {{ $items->count_cmhs['adminitrasi'] ?? '0' }}
                                </span>

                            </td>
                            <td>
                                <span
                                    class="badge {{ $items->count_cmhs['daftar_ulang'] ?? 0 > 0 ? 'badge-primary' : 'badge-red' }} badge-round"
                                    title="status pending artinya data belum di verifikasi">
                                    {{ $items->count_cmhs['daftar_ulang'] ?? '0' }}
                                </span>
                            </td>
                            <td>{{ convert_to_rupiah($items->total_income) ?? '0' }}</td>
                            <td>{{ convert_to_rupiah($items->income) ?? '0' }}</td>
                            <td><strong
                                    class="{{ $items->penarikan == $items->total_income ? 'text-success' : 'text-danger' }}">{{ convert_to_rupiah($items->penarikan) ?? '0' }}</strong>
                            </td>
                            <td>
                                <a href="{{ url('admin/agent/show/' . $items->id) }}" type="button">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="paging">
            {{-- {!! $agent->appends(request()->query())->links('pagination::bootstrap-4') !!} --}}
        </div>
    </div>
</div>
