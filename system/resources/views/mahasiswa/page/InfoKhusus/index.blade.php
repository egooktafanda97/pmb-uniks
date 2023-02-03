@extends('mahasiswa.index.index')
@section('content')
    <div class="">
        @foreach ($info as $item)
            <div class="p-4 rounded" style="font-family: 'Sofia Sans', sans-serif;">
                <div class="p-2" style="display: flex;align-items: center;">
                    <img alt="" src="{{ asset('assets/logo/logo.png') }}" width="40px">
                    <div style="margin-left: 10px">
                        <strong>Admisi</strong>
                        <div>
                            <small>{{ $item->created_at }}</small>
                        </div>
                    </div>

                </div>

                <div class="card" style="background: #fff">
                    <div class="card-body">
                        <div style="margin-bottom: 5px">
                            <strong>{{ $item->subject }}</strong>
                        </div>
                        {!! $item->message !!}
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
