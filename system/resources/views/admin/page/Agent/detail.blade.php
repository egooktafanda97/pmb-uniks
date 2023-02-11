@extends('admin.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .n-tab.active {
            color: orange;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card border-primary border-bottom border-3 border-0" id="form-referal">
                <div class="card-body">
                    <div>
                        <div style="display: flex;justify-content: space-between;align-items: center;margin-bottom: 10px">
                            <strong>
                                DATA AGENT
                            </strong>
                        </div>
                        <hr>
                        <div>
                            <div class="d-flex align-items-center">
                                <img alt="agen" class="rounded-circle p-1 border" height="90"
                                    src="{{ asset('assets/imags/users/default.png') }}" width="90">
                                <div class="flex-grow-1 ms-3">
                                    <label class="mt-0"
                                        style="font-size: 1.1em; font-weight: bold;">{{ $queryes->nama_lengkap }}</label>
                                    <p class="mb-0">
                                        <strong class="text-primary">{{ $queryes->referal }}
                                            <a class="ms-3 bt-icon text-secondary copy-text"
                                                data-token="{{ $queryes->referal }}" title="print">
                                                <i class="fa fa-copy"></i>
                                            </a>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-primary border-bottom border-3 border-0 mb-3">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">Nik</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $queryes->nik ?? '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">jenis Kelamin</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $queryes->jenis_kelamin ?? '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">No Rekening</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $queryes->no_rekening ?? '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">Nama Bank</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $queryes->nama_bank ?? '' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <strong class="mb-0" style="font-size: .8em">Status Area</strong>
                            <span class="text-secondary" style="font-size: .8em">{{ $queryes->status_area ?? '' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-primary border-top border-3 border-0 mb-3">
                <div class="card-body">
                    <form action="">
                        <div style="display: flex;justify-content: space-between; align-items: center">
                            <select aria-label="program studi" class="form-select single-select" id="inputGroupSelect03"
                                name="informasi_pendaftaran" style="width: 90%">
                                @foreach ($info_pendaftaran_all as $item)
                                    <option {{ $item->id == $info_pendaftaran_id ? 'selected' : '' }}
                                        value="{{ $item->id }}">
                                        {{ $item->pendaftaran }}</option>
                                @endforeach
                            </select>
                            <div class="d-flex order-actions">
                                <button class="bt-icon text-light bg-primary"
                                    style="border: none; height: 35px; width: 35px;" title="search" type="submit"><i
                                        class="fadeIn animated bx bx-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (!empty($queryes->pendaftaran))
                @include('admin.page.Agent.incam')
            @endif

        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>

    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });



        function copyToClipboard(text) {
            if (window.clipboardData && window.clipboardData.setData) {
                // IE specific code path to prevent textarea being shown while dialog is visible.
                return clipboardData.setData("Text", text);

            } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                var textarea = document.createElement("textarea");
                textarea.textContent = text;
                textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    return document.execCommand("copy"); // Security exception may be thrown by some browsers.
                } catch (ex) {
                    console.warn("Copy to clipboard failed.", ex);
                    return false;
                } finally {
                    document.body.removeChild(textarea);
                }
            }
        }

        $('.decimal').keyup(function() {
            var val = $(this).val();
            if (isNaN(val)) {
                val = val.replace(/[^0-9\.]/g, '');
                if (val.split('.').length > 2)
                    val = val.replace(/\.+$/, "");
            }
            $(this).val(val);
        });
        $(document).on("click", '.copy-text', function() {
            copyToClipboard($(this).data('token'));

            $.toast({
                title: 'Coppy',
                subtitle: ``,
                content: $(this).data('token'),
                type: 'success',
                delay: 3000,
            })
        })

        /* Tanpa Rupiah */
        /* Tanpa Rupiah */
        var tanpa_rupiah = document.getElementById('tanpa-rupiah');
        tanpa_rupiah.addEventListener('keyup', function(e) {
            tanpa_rupiah.value = formatRupiah(this.value);
        });
        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        async function pencairan() {
            const jml = $(".inp-pencairan-dana").val()?.replace(/[^0-9]+/g, "") ?? 0;
            const push = await axios.post(`{{ url('api/agent/pencairan') }}`, {
                agent_id: `{{ Request::segment(4) }}`,
                info_pendaftaran_id: `{{ $info_pendaftaran_id ?? null }}`,
                jumlah: jml
            }, {
                headers: {
                    "Authorization": `Bearer {{ \Session::get('token')['access_token'] }}`,
                }
            }).catch(() => {
                swal({
                    title: "Oops!",
                    text: "Proses Gagal!",
                    icon: "error",
                    button: "Oke!",
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.reload();
                    }
                });
            });
            if (push) {
                swal({
                    title: "Selesai!",
                    text: "pencairan berhasil!",
                    icon: "success",
                    button: "Oke!",
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.reload();
                    }
                });
            }
        }
        $(".inp-pencairan-dana").keyup(function() {
            const jml = $(this).val().replace(/[^0-9]+/g, "");
            if (__empty(jml) || jml > parseInt(`{{ $queryes->income ?? 0 }}`)) {
                $(this).addClass("is-invalid");
                $(this).removeClass("is-valid");
                $("#btn-cair").prop("disabled", "disabled")
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
                $("#btn-cair").removeAttr("disabled")
            }

        })
        $("#btn-cair").click(function() {
            const jml = $(".inp-pencairan-dana").val();
            if (jml == null || jml == '' || jml == undefined || jml > `{{ $queryes->income ?? 0 }}`) {
                $.toast({
                    title: 'Opps!',
                    subtitle: ``,
                    content: `pastikan saldo cukup`,
                    type: 'error',
                    delay: 3000,
                })
            }
            swal({
                title: "Yakin?",
                text: "",
                icon: "warning",
                button: "Oke!",
            }).then((willDelete) => {
                if (willDelete) {
                    pencairan();
                }
            });
        })
    </script>
@endsection
