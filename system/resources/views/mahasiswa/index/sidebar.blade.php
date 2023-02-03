@php
    $pmb = \Modules\V1\Entities\Pendaftaran::whereUserId(Auth::user()->id)
        ->with(['users', 'prodi', 'informasi_pendaftaran', 'calon_mahasiswa'])
        ->first();
@endphp
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img alt="logo icon" class="logo-icon" src="{{ asset('assets/logo/logo.png') }}" />
        </div>
        <div>
            <h4 class="logo-text" style="color: orange">UNIKS</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('mahasiswa/form') }}">
                <div class="parent-icon">
                    <i class='fadeIn animated bx bx-notepad'></i>
                </div>
                <div class="menu-title">FORM PENDAFTARAN</div>
            </a>
        </li>
        @if ($pmb->calon_mahasiswa)
            <li>
                <a href="{{ url('mahasiswa/profile') }}">
                    <div class="parent-icon">
                        <i class='fadeIn animated bx bx-user'></i>
                    </div>
                    <div class="menu-title">PROFILE</div>
                </a>
            </li>
        @endif
        <li>
            <a href="{{ url('mahasiswa/info_khusus') }}">
                <div class="parent-icon">
                    <i class='fadeIn animated bx bx-message-dots'></i>
                </div>
                <div class="menu-title">INFO KHUSUS</div>
            </a>
        </li>

        <li>
            <a href="{{ url('mahasiswa/info') }}">
                <div class="parent-icon">
                    <i class='fadeIn animated bx bx-info-circle'></i>
                </div>
                <div class="menu-title">INFO PENDAFTARAN</div>
            </a>
        </li>
        {{-- <li>
            <a href="{{ url('admin') }}">
                <div class="parent-icon">
                    <i class='fadeIn animated bx bx-home-smile'></i>
                </div>
                <div class="menu-title">PROGRAM STUDI</div>
            </a>
        </li> --}}
        <li>
            <a href="{{ url('mahasiswa/faq') }}">
                <div class="parent-icon">
                    <i class='fadeIn animated bx bx-info-circle'></i>
                </div>
                <div class="menu-title text-warning">CARA DAFTAR</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin') }}">
                <div class="parent-icon" style="display: flex;justify-content: center;align-items: center">
                    <img alt="" src="{{ asset('assets/logo/logo.png') }}" style="width: 20px">
                </div>
                <div class="menu-title">UNIKS</div>
            </a>
        </li>
    </ul>
</div>
<!--end sidebar -->
