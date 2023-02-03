@extends('admin.index.index')
@section('style')
    <link href="{{ asset('public/node_modules/croppie/croppie.css') }}"
          rel="stylesheet" />
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}"
          rel="stylesheet"
          type="text/css">
    <style>
        .canvas-pdf {
            direction: ltr;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card border-primary border-bottom border-3 border-0">
                <input class="id-hide"
                       id="img-update-profile"
                       type="file">
                <img alt=""
                     class="card-img-top"
                     id="img-profile"
                     src="{{ !empty(auth()->user()->foto) ? asset('assets/' . auth()->user()->foto) : asset('assets/logo/logo.png') }}"
                     style="max-height: 300px; cursor:pointer" />

                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $prodi->nama_prodi }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @include('admin.page.Prodi.tabs')
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#img-profile").click(function() {
            $("#img-update-profile").click();
        });
    </script>
@endsection
