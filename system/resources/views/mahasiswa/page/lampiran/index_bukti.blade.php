@extends('mahasiswa.index.index')
@section('style')
    <link href="{{ asset('public/plugis/Toast-master/dist/toast.min.css') }}"
          rel="stylesheet"
          type="text/css">

    <style>
        @import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");

        /* ------------------------------
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Upload button styling
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ------------------------------ */
        .upload {
            --color-black-softest: #485461;
            /* softer black */
            --color-black-soft: #363f48;
            /* softer black */
            --color-black-hard: #2d353c;
            /* harder black */
            --color-black-hardest: #21282e;
            /* hardest black */
            --color-green-light: #65cca9;
            /* light green */
            --color-green: #29b586;
            /* medium green */
            --ease-in-out-quartic: cubic-bezier(0.645, 0.045, 0.355, 1);
            /* position: relative; */
            /* display: inline-flex; */
            background: #485461;
            border-radius: 10px;
            box-shadow: 0 1.7px 1.4px rgba(0, 0, 0, 0.02), 0 4px 3.3px rgba(0, 0, 0, 0.028), 0 7.5px 6.3px rgba(0, 0, 0, 0.035), 0 13.4px 11.2px rgba(0, 0, 0, 0.042), 0 25.1px 20.9px rgba(0, 0, 0, 0.05), 0 60px 50px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            transform: rotate(0);
        }

        .upload-info {
            display: flex;
            align-items: center;
            padding: 16px;
            margin-right: 40px;
            fill: #fff;
            color: #fff;
        }

        .upload-filename {
            padding-left: 8px;
            transition: opacity 300ms ease;
        }

        .upload-filename.inactive {
            opacity: 0.6;
        }

        .upload-button {
            position: relative;
            margin: 0;
            font-size: 100%;
            padding: 0 8px;
            font-family: inherit;
            background: none;
            border: none;
            border-radius: inherit;
            outline: none;
        }

        .upload-button-text {
            padding: 8px 16px;
            color: white;
            background-color: var(--color-green);
            border-radius: inherit;
            outline: none;
            cursor: pointer;
            transition: background-color 200ms ease, box-shadow 300ms ease;
        }

        .upload-button-text:hover,
        .upload-button-text:focus {
            background-color: var(--color-green-light);
        }

        .upload-button-text.inactive {
            background-color: rgba(255, 255, 255, 0.38);
            cursor: not-allowed;
        }

        .upload-hint {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            color: white;
            transform: translateY(100%);
        }

        .upload-progress {
            position: absolute;
            top: 90%;
            left: -100%;
            width: 100%;
            height: 100%;
            color: white;
            background: linear-gradient(270deg, #87e0c2 0%, #65cca9 50%, #26b082 100%);
            transform-origin: left;
        }

        .upload.uploading .upload-button-text {
            animation: fade-up-out 0.4s 0.4s forwards, button-pulse 500ms forwards;
        }

        .upload.uploading .upload-info>* {
            animation: fade-up-out 0.4s 0.4s forwards;
        }

        .upload.uploading .upload-hint {
            animation: fade-up-in 0.4s 0.8s forwards;
        }

        .upload.uploading .upload-progress {
            animation: load-right 2s 1s var(--ease-in-out-quartic) forwards;
            animation-iteration-count: infinite;
        }

        @keyframes button-pulse {
            from {
                box-shadow: 0 0 0 0 var(--color-green-light);
            }

            to {
                box-shadow: 0 0 0 8px rgba(255, 255, 255, 0);
            }
        }

        @keyframes fade-up-out {
            to {
                opacity: 0;
                transform: translateY(-40%);
            }
        }

        @keyframes fade-up-in {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes load-right {
            0% {
                left: -100%;
            }

            50% {
                left: 0;
            }

            100% {
                left: 100%;
            }
        }

        [type=file] {
            height: 0;
            overflow: hidden;
            width: 0;
            cursor: pointer;
        }

        .drop-area {
            border: 1px solid var(--color-black-softest);
        }

        .drop-area.droppable {
            border: 1px dashed rgba(255, 255, 255, 0.6);
        }

        .drop-area.highlight {
            border: 1px dashed var(--color-green);
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-body">
                    <div class="space-between">
                        <strong class="card-title text-primary">UPLOAD BUKTI BIAYA PENDAFTARAN</strong>
                        <button class="btn btn-dark px-5"
                                id="btn_uploads"
                                type="button">
                            <i class="bx bx-cloud-upload mr-1"></i>
                            UPLOAD
                        </button>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            @include('mahasiswa.page.pembayaran.form_upload')
                        </div>
                        <div class="col-md-7">
                            {{-- img-show-upload id-hide --}}
                            <div class="card ">
                                <div class="card-header bg-primary text-white">
                                    KETERANGAN BUKTI PEMBAYARAN
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label"
                                                   for="inputFirstName">NAMA BANK / PROVIDER <span
                                                      class="in-require">*</span></label>
                                            <select aria-label="nama bank"
                                                    class="form-select nama_bank"
                                                    id="nama_bank">
                                                <option value="">Pilih Program Studi </option>
                                                <option value="BRI">BRI</option>
                                                <option value="BNI">BNI</option>
                                                <option value="BNI">BANK RIAU</option>
                                                <option value="BNI">E-WALLET DANA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label"
                                                   for="inputFirstName">ATAS NAMA <span class="in-require">*</span></label>
                                            <input class="form-control"
                                                   name="atas_nama"
                                                   placeholder="atas nama"
                                                   required
                                                   type="text">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label"
                                                   for="inputFirstName">JUMLAH BAYAR <span
                                                      class="in-require">*</span></label>
                                            <input class="form-control"
                                                   name="jumlah_tf"
                                                   placeholder="nama lengkap sesuai ktp / ijasa"
                                                   required
                                                   type="text">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label"
                                                   for="inputFirstName">WAKTU BAYAR <span
                                                      class="in-require">*</span></label>
                                            <input class="form-control"
                                                   name="waktu_bayar"
                                                   placeholder="nama lengkap sesuai ktp / ijasa"
                                                   required
                                                   type="datetime-local">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label"
                                                   for="inputFirstName">KETERANGAN </label>
                                            <textarea class="form-control"
                                                      id="keterangan"
                                                      name="keterangan"
                                                      placeholder="Alamat lengkap"
                                                      rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    INFO BIAYA PENDAFTARAN
                                </div>
                                <div class="card-body">
                                    @if (!empty($pendaftaran->informasi_pendaftaran))
                                        {!! $pendaftaran->informasi_pendaftaran->biaya_pendaftaran !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript"
            src="{{ asset('public/plugis/Toast-master/dist/toast.min.js') }}"></script>
    <script>
        function __upSave(data) {
            const http_configure = {
                data: data,
                url: `{{ url('api/mahasiswa/upload-bukti-biaya-pendaftaran') }}`,
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

                }
            }

            save(http_configure);
        }

        $('.nama_bank').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        // ************************************************************************
        /*
        | HENDEL ACTIONS
        |
        */
        const body = document.querySelector('body')
        const upload = document.querySelector('.upload')
        const uploadButtonText = document.querySelector('.upload-button-text')
        const uploadFilename = document.querySelector('.upload-filename')
        const fileInput = document.getElementById('file')

        $("#btn_uploads").click(function() {
            const form_data = new FormData();
            form_data.append("bukti_pembayaran", fileInput.files[0]);
            form_data.append("nama_bank", $(".nama_bank").val());
            form_data.append("atas_nama", $("[name='atas_nama']").val());
            form_data.append("jumlah_tf", $("[name='jumlah_tf']").val());
            form_data.append("waktu_bayar", $("[name='waktu_bayar']").val());
            form_data.append("keterangan", $("[name='keterangan']").val());
            __upSave(form_data)
        })

        fileInput.onchange = () => uploadFile(fileInput.files[0])


        function uploadFile(file) {
            if (file) {
                // Add the file name to the input and change the button to an upload button
                uploadFilename.classList.remove('inactive')

                uploadFilename.innerText = file.name
                uploadButtonText.innerText = 'Upload'

                fileInput.remove()

                uploadButtonText.addEventListener("click", async () => {
                    upload.classList.add("uploading")

                    // Here you can upload the file to a database, server, or wherever you need it.
                    // You can access the uploaded file by the `file` parameter.

                    // Reset the input after a delay. For actual use, only remove the uploading class when the file is done uploading!
                    setTimeout(() => {
                        upload.classList.remove("uploading")
                    }, 5000)
                })
            }
        }



        // Drop stuff
        const dropArea = document.querySelector('.drop-area')

        // Remove unnecessary bubbling for drag events
        ;
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false)
        })

        function preventDefaults(e) {
            e.preventDefault()
            e.stopPropagation()
        }


        // Add dropArea bordering when dragging a file over the body
        ;
        ['dragenter', 'dragover'].forEach(eventName => {
            body.addEventListener(eventName, displayDropArea, false)
        })

        ;
        ['dragleave', 'drop'].forEach(eventName => {
            body.addEventListener(eventName, hideDropArea, false)
        })


        // Add dropArea highlighting when dragging a file over the dropArea itself
        ;
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false)
        })

        ;
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false)
        })


        function highlight(e) {
            if (!dropArea.classList.contains('highlight')) dropArea.classList.add('highlight')
        }

        function unhighlight(e) {
            dropArea.classList.remove('highlight')
        }

        function displayDropArea() {
            if (!dropArea.classList.contains('highlight')) dropArea.classList.add('droppable')
        }

        function hideDropArea() {
            dropArea.classList.remove('droppable')
        }

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false)

        function handleDrop(e) {
            let dt = e.dataTransfer
            let files = dt.files
            let file = files[0]

            uploadFile(file)
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                $(".img-show-upload").removeClass("id-hide").addClass("id-show");
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewHolder').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                alert('select a file to see preview');
                $('#previewHolder').attr('src', '');
            }
        }

        $("#file").change(function() {
            readURL(this);
        });
    </script>
@endsection
