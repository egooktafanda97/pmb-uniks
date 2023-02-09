@extends('mahasiswa.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.date.css" rel="stylesheet">
    <link href="{{ asset('public/css/form_mhs.css') }}" rel="stylesheet">
@endsection
@section('content')
    @include('mahasiswa.page.form_pendaftaran.info')
    @include('mahasiswa.page.form_pendaftaran.step_one')
    @include('mahasiswa.page.form_pendaftaran.form_mhs')
    @include('mahasiswa.page.form_pendaftaran.form_alamat')
    @include('mahasiswa.page.form_pendaftaran.form_ortu')
@endsection
@section('script')
    <!--notification js -->
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.date.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.1/vanilla-masker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="{{ asset('public/js/date_pickadate.js') }}"></script>
    @if (!empty($pendaftaran->prodi))
        <script>
            $("#info-prodi").addClass("id-show").removeClass("id-hide");
        </script>
    @endif
    <script>
        window.api_wilayah = "{{ url('api/wilayah') }}";
        window.uri = "{{ url('api') }}";
        window.base_url = "{{ url('') }}";
        const token = `Bearer {{ \Session::get('token')['access_token'] ?? '' }}`;
        const pendaftaran_id = `{{ $pendaftaran->id ?? '' }}`;
    </script>
    <script src="{{ asset('public/js/form_page/__func.js') }}"></script>
    <script src="{{ asset('public/js/form_page/alamat.js') }}"></script>
    <script src="{{ asset('public/js/form_page/selectpicker.js') }}"></script>
    <script src="{{ asset('public/js/form_page/entry_storage.js') }}"></script>
    <script src="{{ asset('public/js/form_page/prodi.js') }}"></script>
    <script src="{{ asset('public/js/form_page/step1.js') }}"></script>
    <script src="{{ asset('public/js/form_page/person_tab.js') }}"></script>
    <script src="{{ asset('public/js/form_page/run.js') }}"></script>
    <script src="{{ asset('public/js/form_page/store.js') }}"></script>
    {{-- <script>
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
        $('.p1-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.p2-select').select2({
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
                if (!__empty(main?.data?.calon_mahasiswa)) {
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
                                if ($(this).val() != undefined) {
                                    const data_ready = main.data?.calon_mahasiswa ?? {};
                                    data_ready[$(this).attr("name")] = $(this).val();
                                    localStorage.setItem("entry", JSON.stringify(data_ready));
                                }
                            }
                        );
                    }
                }
                if (!__empty(main?.data?.pilihan_prodi)) {
                    main?.data?.pilihan_prodi?.map((easy) => {
                        if (easy?.no_pilihan == '1')
                            $('#p1').val(easy?.prodi_id).select2();
                        if (easy?.no_pilihan == '2')
                            $('#p2').val(easy?.prodi_id).select2();
                    })

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
        $(".person_data_next").click(function() {
            if (__empty($("#provinsi").val())) {
                ajax_prov();
            }
        })
        $("input,select,textarea").change(function() {
            const data_ready = JSON.parse(localStorage.getItem("entry"));
            if (!__empty($(this).val()) && !__empty(data_ready)) {
                data_ready[$(this).attr("name")] = $(this).val();
                localStorage.setItem("entry", JSON.stringify(data_ready));
            }

        })

        // ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
        function alr(el, msg) {
            if (el) {
                $.toast({
                    title: 'Opps!',
                    subtitle: ``,
                    content: `${msg}`,
                    type: 'error',
                    delay: 3000,
                })
                return true;
            } else {
                return false;
            }
        }
        /*
        | 
        | END TAB SORAGE ENTRY HNDEL
        */
        //    ************************************************************
        /*
        | HNDEL ALIH JENJANG
        |
        */
        $("#jalur_pendaftaran").change(function() {
            console.log($(this).val() == "alih_jenjang");
            if ($(this).val() == "alih_jenjang") {
                $(".form_alih_jenjang").show();
            } else if ($(this).val() == "kipk") {
                $(".form_kip").show();
            } else {
                $(".form_alih_jenjang").hide();
                $(".form_kip").hide();
            }
        })
        /*
         | 
         | END HNDEL ALIH JENJANG
         */
        //    ************************************************************
        /*
        | SIMPAN PEMBAHARUAN PRODI
        |
        */
        $("#card-program-studi").click(function() {
            $(this).addClass('btn-loader--loading')
            const _prod = $("#p1").val();
            const form_data = new FormData();
            if (__empty($("#jalur_pendaftaran").val())) {
                $.toast({
                    title: 'Opps!',
                    subtitle: '',
                    content: 'Pilih jalur pendafataran!',
                    type: 'error',
                    delay: 2000,
                })
                return;
            }
            if (__empty(_prod)) {
                $.toast({
                    title: 'Opps!',
                    subtitle: '',
                    content: 'Paling tidak pilih 1 program studi!',
                    type: 'error',
                    delay: 2000,
                })
                return;
            }

            if (!__empty($("#p1").val()))
                form_data.append("prodi_1", $("#p1").val());
            if (!__empty($("#p2").val()))
                form_data.append("prodi_2", $("#p2").val());
            // ||||||||||||||||||||||||||||||||||||
            if ($("#jalur_pendaftaran").val() == "alih_jenjang") {
                if (alr(__empty($("[name='pt_sebelumnya']").val()), "nama perguruan tinggi tidak boleh kosong")) {
                    $("[name='pt_sebelumnya']").focus();
                    return;
                }
                if (alr(__empty($("[name='kategori_pt']").val()), "kategori perguruan tinggi tidak boleh kosong")) {
                    $("[name='kategori_pt']").focus();
                    return;
                }
                if (alr(__empty($("[name='jml_sks']").val()), "jumlah sks tidak boleh kosong")) {
                    $("[name='jml_sks']").focus();
                    return;
                }
            }

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
                            content: 'Proses gagal !',
                            type: 'error',
                            delay: 2000,
                        })

                    }
                },
                response: (res) => {
                    const next = $(this).data("next-id");
                    const this_card = $(this).data("card-id");
                    $("#" + this_card).addClass("id-hide").removeClass("id-show");
                    $(`#${next}`).addClass("id-show").removeClass("id-hide");
                    sessionStorage.setItem("card-active", next);
                    $(this).removeClass('btn-loader--loading')
                    $.toast({
                        title: 'Berhasil!',
                        subtitle: '',
                        content: 'Progrm studi berhasil di ubah!',
                        type: 'success',
                        delay: 2000,
                    })
                }
            }
            return;
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
        | DATA PERSONAL
        |
        */
        $("#jenis_slta").change(function() {
            if ($(this).val() == "lainnya") {
                $("#lainya_jenis_slta").show();
                $("#lainya_jenis_slta").prop("name", 'jenis_slta');
                $("#lainya_jenis_slta").prop('required', true);
                $(this).removeAttr("required");
                $(this).removeAttr("name");
            } else {
                $("#lainya_jenis_slta").hide();
                $("#lainya_jenis_slta").removeAttr("name", 'jenis_slta');
                $("#lainya_jenis_slta").removeAttr("required");
                $(this).prop('required', true);
                $(this).prop("name", 'jenis_slta');
            }
        })
        $("#data-personal").click(function() {
            if (!moment($("#from-date").val(), 'DD/MM/YYYY', true).isValid()) {
                $.toast({
                    title: 'Opps!',
                    subtitle: ``,
                    content: `format tanggal salah, tanggal/bulan/tahun`,
                    type: 'error',
                    delay: 3000,
                })
                $("#from-date").focus();
                return;
            }

            if (alr($("[name='nik']").val().length != 16, "nik harus 16 digit")) {
                $("[name='nik']").focus();
                return;
            }
            const next = $(this).data("next-id");
            const this_card = $(this).data("card-id");
            $("#" + this_card).addClass("id-hide").removeClass("id-show");
            $(`#${next}`).addClass("id-show").removeClass("id-hide");
            sessionStorage.setItem("card-active", next);
            $(this).removeClass('btn-loader--loading')
        })
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
        $("#data-address").click(function() {
            if (alr(__empty($("[name='provinsi']").val()), "provinsi harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='kabupaten']").val()), "kabupaten harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='kecamatan']").val()), "kecamatan harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='kelurahan']").val()), "kelurahan harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='alamat_lengkap']").val()), "alamat lengkap harus di isi")) {
                return;
            }

            const next = $(this).data("next-id");
            const this_card = $(this).data("card-id");
            $("#" + this_card).addClass("id-hide").removeClass("id-show");
            $(`#${next}`).addClass("id-show").removeClass("id-hide");
            sessionStorage.setItem("card-active", next);
            $(this).removeClass('btn-loader--loading')
        })
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
            if (alr(__empty($("[name='nama_ayah']").val()), "nama ayah harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='tempat_lahir_ayah']").val()), "tempat lahir ayah harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='tanggal_lahir_ayah']").val()), "tanggal lahir ayah harus di isi")) {
                return;
            }

            if (alr(__empty($("[name='nama_ibu']").val()), "nama ibu harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='tempat_lahir_ibu']").val()), "tempat lahir ibu harus di isi")) {
                return;
            }
            if (alr(__empty($("[name='tanggal_lahir_ibu']").val()), "tanggal lahir ibu harus di isi")) {
                return;
            }

            const Btn = $(this);
            Btn.addClass("btn-loader--loading");
            store(Btn, (r) => {
                localStorage.removeItem('entry');
            });

        })

        function store(load, callback) {
            const data = JSON.parse(localStorage.getItem("entry"));
            data['pendaftaran_id'] = `{{ $pendaftaran->id ?? '' }}`;
            data['nik'] = $("[name='nik']").val() ?? "";
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
                    callback(res);
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
    </script> --}}
@endsection
