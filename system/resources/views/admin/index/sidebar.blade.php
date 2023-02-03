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
            <a href="{{ url('admin') }}">
                <div class="parent-icon">
                    <i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li class="menu-label">Pendaftaran Online</li>
        <li>
            <a href="{{ url('admin/info-pendaftaran') }}">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">PMB</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/mhs') }}">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">Calon Mahasiswa</div>
            </a>
        </li>
        {{-- <li>
            <a href="javascript:;">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">Export</div>
            </a>
        </li> --}}
        <li class="menu-label">Studi</li>
        <li>
            <a href="{{ url('admin/fakultas') }}">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">Fakultas</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/prodi') }}">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">PROGRAM STUDI</div>
            </a>
        </li>
        <li class="menu-label">Setup</li>
        <li>
            <a href="{{ url('admin/pengumuman') }}">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">Pengumuman</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin/agent') }}">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">Agen</div>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <div class="parent-icon">
                    <i class='bx bx-circle'></i>
                </div>
                <div class="menu-title">Management Akun</div>
            </a>
        </li>
    </ul>
</div>
<!--end sidebar -->
