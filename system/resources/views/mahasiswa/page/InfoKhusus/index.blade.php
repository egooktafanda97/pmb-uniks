@extends('mahasiswa.index.index')
@section('content')
    <div class="card">
        @for ($i = 0; $i < 10; $i++)
            <div class="p-4 rounded"
                 style="font-family: 'Sofia Sans', sans-serif;">
                <div class="p-2"
                     style="display: flex;align-items: center;">
                    <img alt=""
                         src="{{ asset('assets/logo/logo.png') }}"
                         width="40px">
                    <div style="margin-left: 10px">
                        <strong>Admisi</strong>
                        <div>
                            <small>20-10-2023 00:00</small>
                        </div>
                    </div>
                </div>
                <div class="card"
                     style="background: #d8ebff">
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae quos nulla unde nisi pariatur
                        sapiente numquam. Nobis quos obcaecati dolorum consequuntur rerum distinctio quaerat. Error
                        provident
                        impedit voluptatum eius blanditiis!
                    </div>
                </div>
            </div>
            <hr>
        @endfor
    </div>
@endsection
