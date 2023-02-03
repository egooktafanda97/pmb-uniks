<div class="table-responsive">
    <table class="table mb-0">
        <thead class="table-light">
            <tr>
                <th>
                    <div>
                        <input aria-label="..." class="form-check-input me-3" type="checkbox" value="">
                        No
                    </div>
                </th>
                <th>Pendaftaran</th>
                <th>Tahun Ajaran</th>
                <th>Prodi</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mhs as $items)
                <tr style="padding: 10px">
                    <td class="">

                        <div class="d-flex align-items-center">
                            <div>
                                <input aria-label="..." class="form-check-input me-3" type="checkbox" value="">
                            </div>
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
                            {{ $items->pendaftaran->prodi->nama_prodi ?? '-' }}
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
                            href="{{ url('admin/mhs/getById/' . $items?->pendaftaran?->id ?? null) }}" type="button">
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
