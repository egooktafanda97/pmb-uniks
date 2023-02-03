@extends('admin.index.index')
@section('style')
    <style>
        .tb-title {
            width: 85%;
        }

        .tb-acton {
            width: 15%;
        }

        .div-action-container {
            display: flex;
            justify-content: center;
            align-content: center;
        }
    </style>
@endsection
@section('content')
    <!--start page wrapper -->
    <div class="row">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">{{ $title ?? '' }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                        </li>
                        <li aria-current="page" class="breadcrumb-item active">{{ $sub_title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="ms-auto">
                <a class="btn btn-inverse-primary"
                   href="{{ url($uri['store']['prefix'] . $uri['store']['router']) }}"><i class="fa fa-plus"></i> Tambah
                    Data</a>
            </div> --}}
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-body">
                    <strong class="card-title text-primary">CALON MAHASISWA</strong>
                    <hr>
                    <div class="card-body">
                        <div class="d-lg-flex align-items-center space-between mb-4 gap-3">
                            <div style="display: flex; justify-content: center; align-content: center; align-items: center">
                                <div class="position-relative">

                                </div>
                            </div>
                            <div class="d-flex order-actions">
                                <a class="ms-3 bt-icon text-primary" href="javascript:;"><i
                                        class="fadeIn animated bx bx-line-chart-down"></i></a>
                                <a class="ms-3 bt-icon text-primary" data-bs-target="#filter" data-bs-toggle="modal"><i
                                        class="fadeIn animated bx bx-filter"></i></a>

                                <a class="ms-3 bt-icon text-secondary" href="javascript:;"><i
                                        class="fadeIn animated bx bx-printer"></i></a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
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
                                                        <input aria-label="..." class="form-check-input me-3"
                                                            type="checkbox" value="">
                                                    </div>
                                                    <div class="ms-2">
                                                        <h6 class="mb-0 font-14">
                                                            {{ ($mhs->currentPage() - 1) * $mhs->perPage() + $loop->iteration }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="">
                                                <h6 class="mb-0 font-14">
                                                    {{ $items->pendaftaran->informasi_pendaftaran->pendaftaran ?? '-' }}
                                                </h6>
                                            </td>
                                            <td class="">
                                                <h6 class="mb-0 font-14">
                                                    {{ $items->pendaftaran->informasi_pendaftaran->tahun_ajaran ?? '-' }}
                                                </h6>
                                            </td>
                                            <td class="">
                                                <h6 class="mb-0 font-14">{{ $items->pendaftaran->prodi->nama_prodi ?? '-' }}
                                                </h6>
                                            </td>
                                            <td class="">{{ $items->nik }}</td>
                                            <td class="tb-title">{{ $items->nama_lengkap }}</td>
                                            <td class="tb-acton">
                                                @php
                                                    $bg = $items->pendaftaran->status == 'pending' ? 'badge-yellow' : ($items->pendaftaran->status == 'invalid' ? 'badge-red' : 'badge-primary');
                                                    $msg = $items->pendaftaran->status == 'pending' ? 'Pending' : ($items->pendaftaran->status == 'invalid' ? 'invalid' : 'valid');
                                                @endphp
                                                <span class="badge {{ $bg }} badge-round"
                                                    title="status pending artinya data belum di verifikasi">
                                                    {{ $msg }}
                                                </span>
                                            </td>
                                            <td class="tb-acton">
                                                <a class="btn btn-primary btn-sm radius-30 px-4"
                                                    href="{{ url('admin/mhs/getById/' . $items->pendaftaran->id) }}"
                                                    type="button">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="paging">
                        {!! $mhs->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.page.CalonMhs.model')
    <!--end page wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
                paging: false,
                info: false
            });
        });
    </script>
@endsection
