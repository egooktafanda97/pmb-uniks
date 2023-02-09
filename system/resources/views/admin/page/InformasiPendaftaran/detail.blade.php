@extends('admin.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
@endsection
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
                        <img alt="" src="{{ asset('assets/' . $queryes->brosur) }}" width="100%">
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
            <div class="alert bg-white border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-warning"><i class="bx bx-info-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-warning">Info</h6>
                        <div>
                            Buat jadwal pada pendaftaran ini, data jadwal akan terlihat pada sisfo dan
                            portal pendaftaran
                        </div>
                    </div>
                </div>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
            </div>
            <div class="card">
                <div class="card-header text-light bg-primary">
                    <div class="space-between">
                        <strong>Informasi Jadwal</strong>
                        <button class="btn btn-primary btn-sm" data-bs-target="#input-jadwal" data-bs-toggle="modal"><i
                                class="fa fa-plus"></i> Tambah</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queryes->jadwal as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->mulai }}</td>
                                    <td>{{ $item->selesai }}</td>
                                    <td>
                                        <div class="d-flex order-actions">
                                            <a class="edit" data-bs-target="#input-jadwal" data-bs-toggle="modal"
                                                data-id="{{ $item->id }}" data-kegiatan="{{ $item->kegiatan }}"
                                                data-keterangan="{{ $item->keterangan }}"
                                                data-mulai="{{ $item->mulai }}" data-selesai="{{ $item->selesai }}"
                                                href="javascript:;"><i class="bx bxs-edit"></i></a>
                                            <a class="ms-3 delete" data-id="{{ $item->id }}" href="javascript:;"><i
                                                    class="bx bxs-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="input-jadwal"
                style="display: none;" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <strong>Scheduler</strong>
                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"
                                type="button"></button>
                        </div>
                        <form id="addJawal">
                            <input name="id" type="hidden">
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label>Kegiatan <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03" name="kegiatan"
                                        placeholder="nama fakultas" required="" type="text">
                                    <div class="invalid-tooltip">Input wajib di isi.</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Mulai <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03" name="mulai"
                                        placeholder="nama fakultas" required="" type="datetime-local">
                                    <div class="invalid-tooltip">Input wajib di isi.</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Selesai <span class="in-require">*</span></label>
                                    <input class="form-control form-control-sm validationTooltip03" name="selesai"
                                        placeholder="nama fakultas" required="" type="datetime-local">
                                    <div class="invalid-tooltip">Input wajib di isi.</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="inputFirstName">Keterangan</label>
                                    <textarea class="form-control" id="alamat_lengkap" name="keterangan" placeholder="Alamat lengkap" rows="3"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                                    type="button">Batal</button>
                                <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script>
        $("#addJawal").submit(function(e) {
            e.preventDefault();
            const form_data = new FormData(e.target);
            form_data.append("informasi_pendaftaran_id", `{{ Request::segment(4) }}`);
            const uri = $("[name='id']").val() == '' ? `{{ url('api/v1/jadwal/store') }}` :
                `{{ url('api/v1/jadwal/update') }}/` + $("[name='id']").val();
            const http_configure = {
                data: form_data,
                url: uri,
                header: headers,
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
                                }
                            }
                        }

                    }
                },
                response: (res) => {
                    if (res?.status == 200) {
                        swal({
                            title: "Selesai!",
                            text: "jadwal berhasil di simpan",
                            icon: "success",
                            button: "Oke!",
                        }).then((willDelete) => {
                            if (willDelete) {
                                window.location.reload();
                            }
                        });
                    }
                }
            }
            save(http_configure);
        });
        $(".edit").click(function() {
            const data = $(this).data();
            $($('#addJawal').prop('elements')).each(function() {
                $(this).val(data[$(this).attr('name')]);
            });
        });
        $(".delete").click(function() {
            const Id = $(this).data('id')
            deleted({
                url: `{{ url('api/v1/jadwal/delete') }}/${Id}`,
                header: headers,
                msg: null,
                errors: (res) => {
                    console.log(res);
                    $.toast({
                        title: 'Opps!',
                        subtitle: '',
                        content: 'gagal menghapus!',
                        type: 'error',
                        delay: 2000,
                    })
                },
                result: (response) => {
                    swal({
                        title: "Berhasil!",
                        text: "Jadwal berhasil dihapus",
                        icon: "success",
                        button: "Oke!",
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.reload();
                        }
                    });
                }
            })
        })
    </script>
@endsection
