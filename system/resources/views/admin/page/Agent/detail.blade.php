@extends('admin.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <strong class="mb-0" style="font-size: .8em">Nik</strong>
                        <span class="text-secondary" style="font-size: .8em">{{ $queryes->nik ?? '' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <strong class="mb-0" style="font-size: .8em">Nama Lengkap</strong>
                        <span class="text-secondary" style="font-size: .8em">{{ $queryes->nama_lengkap ?? '' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <strong class="mb-0" style="font-size: .8em">jenis Kelamin</strong>
                        <span class="text-secondary" style="font-size: .8em">{{ $queryes->jenis_kelamin ?? '' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <strong class="mb-0" style="font-size: .8em">No Rekening</strong>
                        <span class="text-secondary" style="font-size: .8em">{{ $queryes->no_rekening ?? '' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <strong class="mb-0" style="font-size: .8em">Nama Bank</strong>
                        <span class="text-secondary" style="font-size: .8em">{{ $queryes->nama_bank ?? '' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <strong class="mb-0" style="font-size: .8em">Status Area</strong>
                        <span class="text-secondary" style="font-size: .8em">{{ $queryes->status_area ?? '' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <strong class="mb-0" style="font-size: .8em">Kode Referal</strong>
                        <span class="text-secondary"
                            style="font-size: .8em;color:#000;"><strong>{{ $queryes->referal ?? '' }}</strong></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    PENDAFTAR
                </div>
                <div class="card-body">
                    <select aria-label="program studi" class="form-select single-select" id="inputGroupSelect03">
                        <option value="">Pilih Program Studi </option>

                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endsection
