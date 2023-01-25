@extends('admin.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}"
          rel="stylesheet"
          type="text/css">
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
                    <h5 class="card-title text-primary">PENDAFTARAN MAHASISWA BARU</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered"
                               id="example"
                               style="width:100%">
                            <thead>
                                <tr>
                                    <th>PENDAFTARAN</th>
                                    <th>TAHUN AJARAN</th>
                                    <th>STATUS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $item)
                                    <tr style="padding: 10px">
                                        <td>{{ $item->pendaftaran }}</td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                        <td style="width: 10%">
                                            <div class="form-check-danger form-check form-switch">
                                                <input {{ $item->status == 'active' ? 'checked' : '' }}
                                                       class="form-check-input checked-status"
                                                       data-id="{{ $item->id }}"
                                                       name="status"
                                                       type="checkbox">
                                            </div>
                                        </td>
                                        <td class="tb-acton">
                                            <div class="div-action-container">
                                                <div aria-label="Basic example"
                                                     class="btn-group btn-sm"
                                                     role="group">
                                                    <a class="btn btn-sm btn-outline-primary"
                                                       href="{{ url('admin/info-pendaftaran/show/' . $item->id) }}"
                                                       type="button">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-success"
                                                       type="button">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
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
                        {!! $data->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
@endsection

@section('script')
    <script type="text/javascript"
            src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
                paging: false,
                info: false
            });
        });

        function http_update_status_pendaftaran(status, id) {
            const option_http = {
                url: `{{ url('api/v1/informasi_pendaftaran/up-status') }}/${id}?status=${status}`,
                header: {
                    headers: {
                        "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                    }
                },
                errors: (error) => {
                    const {
                        response
                    } = error;
                    const {
                        request,
                        ...errorObject
                    } = response;
                    if (errorObject?.status != 200) {
                        const err = errorObject?.data?.error ?? {};
                        if (Object.keys(err).length > 0) {
                            for (const key in err) {
                                if (err.hasOwnProperty(key)) {
                                    $(`[name='${key}']`).addClass("is-invalid")
                                    $.toast({
                                        title: 'Opps!',
                                        subtitle: ``,
                                        content: `${err[key][0]}`,
                                        type: 'error',
                                        delay: 3000,
                                    })
                                }
                            }
                        }

                    }
                },
                response: (res) => {
                    $.toast({
                        title: 'Berhasil!',
                        subtitle: ``,
                        content: `Status ${status}`,
                        type: 'success',
                        delay: 3000,
                    })
                }
            }

            http_get_header(option_http);
        }
        $(document).on('change', "[name='status']", ':checkbox', function() {
            if ($(this).is(':checked')) {
                // on
                http_update_status_pendaftaran('active', $(this).data("id"));
                $("[name='status']").prop('checked', false);
                $(this).prop('checked', true);
            } else {
                // off
                http_update_status_pendaftaran('in_active', $(this).data("id"));
            }
        });
    </script>
@endsection
