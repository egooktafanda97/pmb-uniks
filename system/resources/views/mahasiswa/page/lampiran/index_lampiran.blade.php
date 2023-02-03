@extends('mahasiswa.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-body">
                    <div class="space-between">
                        <strong class="card-title text-primary">Lampiran</strong>
                    </div>
                    <hr>
                    <form id="form-lampiran">
                        <div class="row">
                            @include('mahasiswa.page.lampiran.form_upload')
                            <div class="col-12 mt-3">
                                <div class="mt-3 space-between">
                                    <a class="btn btn-primary px-5 rounded-0 btn-sm next-card"> <i
                                            class="fa fa-long-arrow-left"></i>
                                        Kembali</a>

                                    <button class="btn btn-primary px-5 rounded-0 btn-sm btn-loader" id="submit-lampiran"
                                        type="submit" type="button">
                                        Next <i class="fa fa-long-arrow-right"></i>
                                        <span>
                                            <b></b>
                                            <b></b>
                                            <b></b>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script>
        function __upSave(data) {
            $("#submit-lampiran").addClass("btn-loader--loading")
            const http_configure = {
                data: data,
                url: `{{ url('api/mahasiswa/upload-lampiran') }}`,
                header: {
                    headers: {
                        "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                    }
                },
                errors: (error) => {
                    $("#submit-lampiran").removeClass("btn-loader--loading")
                    const {
                        response
                    } = error;
                    const {
                        request,
                        ...errorObject
                    } = response;
                    if (errorObject?.status != 200 && errorObject?.status < 500) {
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
                    } else {
                        swal({
                            title: "Ooops fatal error!",
                            text: "pastikan proses dilakukan dengan benar.",
                            icon: "error",
                            button: "Oke!",
                        });
                    }
                },
                response: (res) => {
                    $("#submit-lampiran").removeClass("btn-loader--loading")
                    swal({
                        title: "Berhasil!",
                        text: 'lampiran berhasil disimpan',
                        icon: "success",
                        button: "Oke!",
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.href = `{{ url('mahasiswa/form') }}`;
                        }
                    });
                }
            }

            save(http_configure);
        }

        $("#form-lampiran").submit(function(e) {
            e.preventDefault();
            const form_data = new FormData(e.target);
            __upSave(form_data)
        })
    </script>
@endsection
