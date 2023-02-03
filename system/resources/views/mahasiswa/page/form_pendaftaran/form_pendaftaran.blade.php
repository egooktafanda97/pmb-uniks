@extends('mahasiswa.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    @include('mahasiswa.page.form_pendaftaran.info')
    @include('mahasiswa.page.form_pendaftaran.program_studi')
    @include('mahasiswa.page.form_pendaftaran.form_mhs')
    @include('mahasiswa.page.form_pendaftaran.form_alamat')
    @include('mahasiswa.page.form_pendaftaran.form_ortu')
@endsection
@section('script')
    <!--notification js -->
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    @if (!empty($pendaftaran->prodi))
        <script>
            $("#info-prodi").addClass("id-show").removeClass("id-hide");
        </script>
    @endif
    <script>
        /*|*/
        //    ==========================
        /*
        | AJAX 
        |
        */
        function ajax_prov(result = null) {
            const optProv = {
                url: "{{ url('api/wilayah') }}",
                response: (res) => {
                    // if (res?.data.lnght)
                    if (res?.data?.length > 0) {
                        const prov = res?.data?.map((x) =>
                            `<option value="${x?.id}">${x?.nama}</option>`)
                        $("#provinsi").append(`<option value="">PILIH PROVINSI</option>`);
                        $("#provinsi").append(prov);
                        if (result != null) {
                            result(res?.data);
                        }
                    }
                },
                errors: (err) => {

                }
            }
            http_get(optProv);
        }

        function ajax_kab(prov_id, elemet, result = null) {
            const optKab = {
                url: `{{ url('api/wilayah') }}?provinsi_id=${prov_id}`,
                response: (res) => {

                    // if (res?.data.lnght)
                    if (res?.data?.length > 0) {
                        elemet.html(``);
                        const kab = res?.data?.map((x) =>
                            `<option value="${x?.id}">${x?.nama}</option>`)
                        elemet.append(`<option value="">PILIH KABUPATEN</option>`);
                        elemet.append(kab);
                        if (result != null)
                            result();
                    }
                },
                errors: (err) => {

                }
            }
            http_get(optKab);
        }

        function ajax_kec(kab_id, elemet, result = null) {
            const optKab = {
                url: `{{ url('api/wilayah') }}?kabupaten_id=${kab_id}`,
                response: (res) => {

                    // if (res?.data.lnght)
                    if (res?.data?.length > 0) {
                        elemet.html(``);
                        const kab = res?.data?.map((x) =>
                            `<option value="${x?.id}">${x?.nama}</option>`)
                        elemet.append(`<option value="">PILIH KECAMATAN</option>`);
                        elemet.append(kab);
                        if (result != null)
                            result();
                    }
                },
                errors: (err) => {

                }
            }
            http_get(optKab);
        }

        function ajax_kel(kec_id, elemet, result = null) {
            const optKab = {
                url: `{{ url('api/wilayah') }}?kecamatan_id=${kec_id}`,
                response: (res) => {

                    // if (res?.data.lnght)
                    if (res?.data?.length > 0) {
                        elemet.html(``);
                        const kab = res?.data?.map((x) =>
                            `<option value="${x?.id}">${x?.nama}</option>`)
                        elemet.append(`<option value="">PILIH KELURAHAN</option>`);
                        elemet.append(kab);
                        if (result != null)
                            result();
                    }
                },
                errors: (err) => {

                }
            }
            http_get(optKab);
        }

        function ajax_getProdi(id, result) {
            const optProv = {
                url: `{{ url('api/mahasiswa/get-prodi-id') }}/${id}`,
                header: {
                    headers: {
                        "Authorization": `Bearer {{ \Session::get('token')['access_token'] ?? '' }}`,
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
                                }
                            }
                        }
                        $.toast({
                            title: 'Opps!',
                            subtitle: '',
                            content: 'Progrm studi gagal di ubah!',
                            type: 'error',
                            delay: 2000,
                        })

                    }
                },
                response: (res) => {
                    result(res);
                }
            }
            http_get_header(optProv);
        }
        /*
        | 
        | END 
        */
        //    **************************************************************************************
        /*
        | SELECT PICKER
        |
        */
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        /*
        | 
        | END SELECT PICKER
        */
        //    **************************************************************************************
        /*
        | FUNCTION SELECTED ALAMAT
        |
        */
        ajax_prov();
        $("#provinsi").change(function() {
            ajax_kab($(this).val(), $("#kabupaten"));
        })
        $("#kabupaten").change(function() {
            ajax_kec($(this).val(), $("#kecamatan"));
        })
        $("#kecamatan").change(function() {
            ajax_kel($(this).val(), $("#kelurahan"));
        })
        /*
        | 
        | END FUNCTION SELECTED ALAMAT
        */
        //    **************************************************************************************
        /*
        | TAB CARD ENTRY
        |
        */
        if (sessionStorage.getItem("card-active") != undefined) {
            $(`#${sessionStorage.getItem("card-active")}`).addClass("id-show").removeClass("id-hide");
        } else {
            $("#card-prodi").addClass("id-show").removeClass("id-hide");
        }
        $(".next-card").click(function() {
            $(this).addClass('btn-loader--loading')
            const next = $(this).data("next-id");
            const this_card = $(this).data("card-id");
            $("#" + this_card).addClass("id-hide").removeClass("id-show");
            $(`#${next}`).addClass("id-show").removeClass("id-hide");
            sessionStorage.setItem("card-active", next);
            $(this).removeClass('btn-loader--loading')
        });
        /*
        | 
        | END TAB CARD ENTRY
        */
        //    **************************************************************************************
        /*
        | TAB SORAGE ENTRY HNDEL
        |
        */
        function _init_alamat_ready() {
            ajax_prov(function() {
                const data_ready = JSON.parse(localStorage.getItem("entry"));
                $("#provinsi").val(data_ready?.provinsi);
                ajax_kab(data_ready?.provinsi, $("#kabupaten"), function() {
                    $("#kabupaten").val(data_ready?.kabupaten);
                    console.log(data_ready?.kecamatan);
                    ajax_kec(data_ready?.kabupaten, $("#kecamatan"), function(res) {
                        $("#kecamatan").val(data_ready?.kecamatan);
                        ajax_kel(data_ready?.kecamatan, $("#kelurahan"), function() {
                            $("#kelurahan").val(data_ready?.kelurahan);
                        });
                    });
                });
            });
        }

        async function _readedCmhs() {
            const main = await axios.get(`{{ url('api/mahasiswa/read') }}`, {
                headers: {
                    "Authorization": `Bearer {{ \Session::get('token')['access_token'] ?? '' }}`,
                }
            });
            if (main) {
                if (!__empty(main?.data)) {
                    const cmhs = main.data?.calon_mahasiswa;
                    const ortu = main.data?.calon_mahasiswa?.orangtua;
                    delete cmhs.orangtua;
                    const data_ready = {
                        ...cmhs,
                        ...ortu
                    };
                    $('input, select, textarea').each(
                        function(index) {
                            $(this).val(data_ready[$(this).attr("name")]);
                            localStorage.setItem("entry", JSON.stringify(data_ready));
                        }
                    );
                    _init_alamat_ready();
                } else {
                    const _ls = localStorage.getItem("entry");
                    if (!localStorage.hasOwnProperty("entry") || __empty(_ls)) {
                        $('input, select, textarea').each(
                            function(index) {
                                const data_ready = main.data?.calon_mahasiswa ?? {};
                                data_ready[$(this).attr("name")] = $(this).val();
                                localStorage.setItem("entry", JSON.stringify(data_ready));
                            }
                        );
                    }
                    _init_alamat_ready();
                }

            }
        }
        _readedCmhs();

        // const _ls = localStorage.getItem("entry");
        // if (!localStorage.hasOwnProperty("entry") || __empty(_ls)) {
        //     $('input, select, textarea').each(
        //         function(index) {
        //             const data_ready = JSON.parse(localStorage.getItem("entry")) ?? {};
        //             data_ready[$(this).attr("name")] = $(this).val();
        //             localStorage.setItem("entry", JSON.stringify(data_ready));
        //         }
        //     );
        // } else {
        //     $('input, select, textarea').each(
        //         function(index) {
        //             const data_ready = JSON.parse(localStorage.getItem("entry"));
        //             if ($(this).attr("name") != "nik")
        //                 $(this).val(data_ready[$(this).attr("name")]);
        //         }
        //     );
        //     _init_alamat_ready();
        // }
        $("input,select,textarea").change(function() {
            const data_ready = JSON.parse(localStorage.getItem("entry"));
            data_ready[$(this).attr("name")] = $(this).val();
            localStorage.setItem("entry", JSON.stringify(data_ready));
        })

        /*
        | 
        | END TAB SORAGE ENTRY HNDEL
        */
        //    ************************************************************
        /*
        | SIMPAN PEMBAHARUAN PRODI
        |
        */
        $("#card-program-studi").click(function() {
            const _prod = $(".single-select").val();
            const form_data = new FormData();
            form_data.append("prodi_id", _prod);
            const http_configure = {
                data: form_data,
                url: `{{ url('api/mahasiswa/register-prodi-update') }}`,
                header: {
                    headers: {
                        "Authorization": `Bearer {{ \Session::get('token')['access_token'] ?? '' }}`,
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
                                }
                            }
                        }
                        $.toast({
                            title: 'Opps!',
                            subtitle: '',
                            content: 'Progrm studi gagal di ubah!',
                            type: 'error',
                            delay: 2000,
                        })

                    }
                },
                response: (res) => {
                    $.toast({
                        title: 'Berhasil!',
                        subtitle: '',
                        content: 'Progrm studi berhasil di ubah!',
                        type: 'success',
                        delay: 2000,
                    })
                }
            }
            save(http_configure);
            if ($(".single-select") == '')
                $("#info-prodi").hide();
            else
                $("#info-prodi").show();
        });
        /*
        | 
        | END SIMPAN PEMBAHARUAN PRODI 
        */
        //    ************************************************************
        /*
        | SELECT PRODI
        |
        */
        $(".single-select").change(function() {
            if ($(this).val() == '')
                $("#info-prodi").addClass("id-hide").removeClass("id-show");
            else
                $("#info-prodi").addClass("id-show").removeClass("id-hide");
            $("#card-info-syarat").html("");
            ajax_getProdi($(this).val(), (res) => {
                const data = res?.data;
                const loops = data?.persyaratan_prodi;
                const biaya = data?.biaya_kuliah;
                component_prodi_syarat(loops, data);
                component_prodi_biaya_kuliah(biaya, data);
            });
        });
        /*
        | 
        | END SIMPAN PEMBAHARUAN PRODI 
        */
        //    ************************************************************
        /*
        | COMPONENT SYARAT PRODI
        |
        */
        function component_prodi_syarat(loops, data) {
            let __loop_html = ``;
            let __html = ``;
            if (loops.length > 0) {
                loops?.map((x, io) => {
                    __loop_html += `<li class="list-group-item bg-transparent text-dark w-100 d-flex">
                                        <div
                                             style="width: 3%; display: flex;justify-content: center;align-content: center">
                                            <strong>${io + 1}</strong>
                                        </div>
                                        <div>
                                            <strong>
                                                ${x?.persyaratan}
                                            </strong>
                                            <br>
                                            <small> ${x?.keterangan}</small>
                                        </div>
                                    </li>`;
                });
                __html = `
                                <div class="">
                                    <ul class="list-group list-group-flush">
                                       ${__loop_html}    
                                    </ul>
                                </div>
                                `;
            } else {
                __html = `<div class="alert bg-white border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-info"><i
                                                   class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-info">Info!</h6>
                                                Tidak ada persyaratan khusus pada prodi
                                                ${data?.nama_prodi}
                                            </div>
                                        </div>
                                        <button aria-label="Close"
                                                class="btn-close"
                                                data-bs-dismiss="alert"
                                                type="button"></button>
                                    </div>`;
            }
            $("#card-info-syarat").html(__html);
        }
        /*
        | 
        | END COMPONENT SYARAT PRODI 
        */
        //    ************************************************************
        /*
        | COMPONENT SYARAT PRODI
        |
        */
        function component_prodi_biaya_kuliah(loops) {
            let __loop_html = ``;
            let __html = ``;
            if (loops.length > 0) {
                loops?.map((x, io) => {
                    __loop_html += ` <li
                                        class="list-group-item bg-transparent text-dark w-100 d-flex">
                                            <div
                                                style="width: 3%; display: flex;justify-content: center;align-content: center">
                                                <strong>${io + 1}</strong>
                                            </div>
                                            <div>
                                                <strong>
                                                    ${x?.keterangan}
                                                </strong>
                                                <br>
                                                <strong>
                                                    ${x?.jumlah}
                                                </strong>
                                                <br>
                                                <small>${x?.deskripsi}</small>
                                            </div>
                                        </li>`;
                });
                __html = ` <div class="">
                                <ul class="list-group list-group-flush">
                                   ${__loop_html}    
                                </ul>
                            </div>`;
            } else {
                __html = `<div class="alert bg-white border-0 border-start border-5 border-info alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-info"><i
                                                   class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-info">Info!</h6>
                                                Tidak ada persyaratan khusus pada prodi
                                                ${data?.nama_prodi}
                                            </div>
                                        </div>
                                        <button aria-label="Close"
                                                class="btn-close"
                                                data-bs-dismiss="alert"
                                                type="button"></button>
                                    </div>`;
            }
            $("#card-info-biaya").html(__html);
        }
        /*
        | 
        | END COMPONENT SYARAT PRODI 
        */
        //    ************************************************************
        /*
        | STORE ENTRY DATA
        |
        */
        $("#form-done").click(function() {
            const Btn = $(this);
            Btn.addClass("btn-loader--loading");
            store(Btn, (r) => {

            });

        })

        function store(load, response) {
            const data = JSON.parse(localStorage.getItem("entry"));
            data['pendaftaran_id'] = `{{ $pendaftaran->id ?? '' }}`;
            const http_configure = {
                data: data,
                url: `{{ url('api/mahasiswa/register') }}`,
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
                            load.removeClass("btn-loader--loading");
                        }
                    } else {
                        swal({
                            title: "Ooops fatal error!",
                            text: "pastikan proses dilakukan dengan benar.",
                            icon: "error",
                            button: "Oke!",
                        });
                        load.removeClass("btn-loader--loading");
                    }
                },
                response: (res) => {
                    let msg = "";
                    if (res?.status == 200) {
                        msg = "Data anda berhasil di simpan, next step!";
                    } else if (res?.status == 201) {
                        msg = "data berhasil di update!";
                    }
                    load.removeClass("btn-loader--loading");
                    swal({
                        title: "Selesai!",
                        text: msg,
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
        /*
        | 
        | END STORE ENTRY DATA
        */
    </script>
@endsection
