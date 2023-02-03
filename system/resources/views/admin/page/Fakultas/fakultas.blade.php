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
                        <li aria-current="page"
                            class="breadcrumb-item active">{{ $sub_title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a class="btn btn-inverse-primary"
                   href="{{ url($uri['store']['prefix'] . $uri['store']['router']) }}"><i class="fa fa-plus"></i> Tambah
                    Data</a>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-body">
                    <h5 class="card-title text-primary">FAKULTAS</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered"
                               id="example"
                               style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Fakultas</th>
                                    <th>Actios</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($fakultas as $item)
                                    <tr style="padding: 10px">
                                        <td class="tb-title">{{ $item->nama_fakultas }}</td>
                                        <td class="tb-acton">
                                            <div class="div-action-container">
                                                <div aria-label="Basic example"
                                                     class="btn-group btn-sm"
                                                     role="group">
                                                    <button class="btn btn-sm btn-outline-primary"
                                                            type="button">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-success"
                                                            type="button">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                            type="button">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Fakultas</th>
                                    <th>Actios</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="horizontal-line"></div>
                    <div class="paging">
                        {!! $fakultas->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
                paging: false,
                info: false,
                ordering: false
            });
        });
    </script>
@endsection
