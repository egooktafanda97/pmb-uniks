@extends('admin.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}"
          rel="stylesheet"
          type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-light">
                    <strong>POSTER</strong>
                </div>
                <div class="card-body">
                    @php
                        $url = !empty($queryes->poster) ? $queryes->poster : false;
                    @endphp
                    @if ($url)
                        <img alt=""
                             src="{{ asset('assets/' . $queryes->poster) }}"
                             width="100%">
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    Info
                </div>
                <div class="card-body">
                    <h5>{{ $queryes->hal }}</h5>
                    <hr>
                    {!! $queryes->keterangan !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
            src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
@endsection
