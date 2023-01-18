@extends('mahasiswa.index.index')
@section('content')
    @include('mahasiswa.page.info')
    @include('mahasiswa.page.program_studi')
    @include('mahasiswa.page.form_mhs')
    @include('mahasiswa.page.form_alamat')
    @include('mahasiswa.page.form_ortu')
@endsection
@section('script')
    <script>
        const optProv = {
            url: "{{ url('api/wilayah') }}",
            response: (res) => {
                // if (res?.data.lnght)
                if (res?.data?.length > 0) {
                    const prov = res?.data?.map((x) =>
                        `<option value="${x?.id_provinsi}">${x?.nama}</option>`)
                    $("#provinsi").append(`<option value="">PILIH PROVINSI</option>`);
                    $("#provinsi").append(prov);
                }
            },
            errors: (err) => {

            }
        }
        http_get(optProv);

        $("#provinsi").change(function() {
            const optKab = {
                url: `{{ url('api/wilayah') }}?provinsi_id=${$(this).val()}`,
                response: (res) => {

                    // if (res?.data.lnght)
                    if (res?.data?.length > 0) {
                        $("#kabupaten").html(``);
                        const kab = res?.data?.map((x) =>
                            `<option value="${x?.id_kabupaten}">${x?.nama}</option>`)
                        $("#kabupaten").append(`<option value="">PILIH KABUPATEN</option>`);
                        $("#kabupaten").append(kab);

                    }
                },
                errors: (err) => {

                }
            }
            http_get(optKab);
        })
        $("#kabupaten").change(function() {
            const optKab = {
                url: `{{ url('api/wilayah') }}?kabupaten_id=${$(this).val()}`,
                response: (res) => {

                    // if (res?.data.lnght)
                    if (res?.data?.length > 0) {
                        $("#kecamatan").html(``);
                        const kab = res?.data?.map((x) =>
                            `<option value="${x?.id_kecamatan}">${x?.nama}</option>`)
                        $("#kecamatan").append(`<option value="">PILIH KECAMATAN</option>`);
                        $("#kecamatan").append(kab);
                    }
                },
                errors: (err) => {

                }
            }
            http_get(optKab);
        })

        $("#kecamatan").change(function() {
            const optKab = {
                url: `{{ url('api/wilayah') }}?kecamatan_id=${$(this).val()}`,
                response: (res) => {

                    // if (res?.data.lnght)
                    if (res?.data?.length > 0) {
                        $("#kelurahan").html(``);
                        const kab = res?.data?.map((x) =>
                            `<option value="${x?.id_kelurahan}">${x?.nama}</option>`)
                        $("#kelurahan").append(`<option value="">PILIH KELURAHAN</option>`);
                        $("#kelurahan").append(kab);
                    }
                },
                errors: (err) => {

                }
            }
            http_get(optKab);
        })
    </script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
    <script>
        const mhs = $("#card-mhs");
        const orangtua = $("#card-orangtua");
        const info = $("#card-start-info");
        const prodi = $("#card-prodi")
        const alamat = $("#card-alamat")

        // $("#card-start-info").addClass("id-show").removeClass("id-hide");
        $("#card-prodi").addClass("id-show").removeClass("id-hide");
        $(".next-card").click(function() {
            const next = $(this).data("nextId");
            const this_card = $(this).data("cardId");
            $(this_card).addClass("id-hide").removeClass("id-show");
        })
    </script>
@endsection
