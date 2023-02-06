@extends('mahasiswa.index.index')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-top border-0 border-4 border-primary">
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
                                    <th scope="col">FAKULTAS</th>
                                    <th scope="col">PROGRAM STUDI</th>
                                    <th scope="col">AKREDITAS</th>
                                    <th scope="col">GELAR</th>
                                    <th scope="col">BIAYA KULIAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prod as $item)
                                    <tr>
                                        <td scope="col">{{ $loop->iteration }}</td>
                                        <td scope="col">{{ $item->fakultas->nama_fakultas ?? '' }}</td>
                                        <td scope="col">{{ $item->nama_prodi ?? '' }}</td>
                                        <td scope="col">{{ $item->akreditas ?? '' }}</td>
                                        <td scope="col">{{ $item->gelar ?? '' }}</td>
                                        <td scope="col">{{ \App\Helpers\Helpers::convert_to_rupiah($item->biaya ?? 0) }}
                                            /
                                            Smester</td>
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
