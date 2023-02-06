@extends('mahasiswa.index.index')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-light">
                    <strong>Brosur</strong>
                </div>
                <div class="card-body">
                    @php
                        $url = !empty($queryes->brosur) ? $queryes->brosur : false;
                    @endphp
                    @if ($url)
                        <a href="{{ asset('assets/' . $queryes->brosur) }}">
                            <img alt="" src="{{ asset('assets/' . $queryes->brosur) }}" width="100%">
                        </a>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item " role="presentation">
                            <a aria-selected="false" class="nav-link active" data-bs-toggle="pill"
                                href="#primary-pills-home" role="tab" tabindex="-1">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Pendaftaran</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a aria-selected="false" class="nav-link" data-bs-toggle="pill" href="#primary-pills-profile"
                                role="tab" tabindex="-1">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Informasi Umum</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a aria-selected="true" class="nav-link" data-bs-toggle="pill" href="#primary-pills-contact"
                                role="tab">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Biaya Pendafataran</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="primary-pills-home" role="tabpanel">
                            <div style="margin-top: 2rem"></div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <strong class="mb-0" style="font-size: .8em">PENDAFATARAN</strong>
                                    <span class="text-secondary" style="font-size: .8em">{{ $queryes->pendaftaran }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <strong class="mb-0" style="font-size: .8em">TAHUN</strong>
                                    <span class="text-secondary" style="font-size: .8em">{{ $queryes->tahun }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <strong class="mb-0" style="font-size: .8em">TAHUN AJARAN</strong>
                                    <span class="text-secondary" style="font-size: .8em">{{ $queryes->tahun_ajaran }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <strong class="mb-0" style="font-size: .8em">DIBUKA TANGGAL</strong>
                                    <span class="text-secondary" style="font-size: .8em">{{ $queryes->buka }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <strong class="mb-0" style="font-size: .8em">DITUTUP TANGGAL</strong>
                                    <span class="text-secondary" style="font-size: .8em">{{ $queryes->tutup }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <strong class="mb-0" style="font-size: .8em">KUOTA</strong>
                                    <span class="text-secondary" style="font-size: .8em">{{ $queryes->kuota }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                            {!! $queryes->informasi_umum !!}
                        </div>
                        <div class="tab-pane fade" id="primary-pills-contact" role="tabpanel">
                            {!! $queryes->biaya_pendaftaran !!}
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header text-light bg-primary">
                    <div class="space-between">
                        <strong>Informasi Jadwal</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($queryes->jadwal as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->kegiatan }}</td>
                                        <td>{{ tgl_i(Carbon::parse($item->mulai)->format('Y-m-d')) }}</td>
                                        <td>{{ !empty($item->selesai) ? tgl_i(Carbon::parse($item->selesai)->format('Y-m-d')) : '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
