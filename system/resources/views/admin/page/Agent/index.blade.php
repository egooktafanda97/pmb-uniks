@extends('admin.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
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
            <div class="ms-auto">
                <a class="btn btn-inverse-primary" href="{{ url($uri['store']['prefix'] . $uri['store']['router']) }}"><i
                        class="fa fa-plus"></i> Tambah
                    Data</a>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-body">
                    <h5 class="card-title text-primary">PENGUMUMAN</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 20px">NO</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>REFERAL</th>
                                    <th>JML PENDAFTAR</th>
                                    <th>SALDO</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agent as $item)
                                    <tr>
                                        <td style="width: 20px">#</td>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->referal }}</td>
                                        <td>{{ $item->saldo }}</td>
                                        <td>{{ $item->saldo }}</td>
                                        <td>
                                            <div class="div-action-container">
                                                <div aria-label="Basic example" class="btn-group btn-sm" role="group">
                                                    <a class="btn btn-sm btn-outline-primary"
                                                        href="{{ url('admin/agent/show/' . $item->id) }}" type="button">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-success"
                                                        href="{{ url('admin/agent/update/' . $item->id) }}" type="button">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-outline-danger delete"
                                                        data-id="{{ $item->id }}" type="button">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="paging">
                        {{-- {!! $data->links('pagination::bootstrap-4') !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
@endsection
