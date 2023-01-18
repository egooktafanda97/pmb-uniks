<!--sidebar wrapper -->
<div class="sidebar-wrapper"
     data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img alt="logo icon"
                 class="logo-icon"
                 src="{{ asset('assets/logo/logo.png') }}" />
        </div>
        <div>
            <h4 class="logo-text"
                style="color: orange">UNIKS</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu"
        id="menu">
        <li>
            <a href="{{ url('admin') }}">
                <div class="parent-icon">
                    <i class='fa fa-file'></i>
                </div>
                <div class="menu-title">Form Pendaftaran</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin') }}">
                <div class="parent-icon">
                    {{-- <i class='fa fa-file'></i> --}}
                </div>
                <div class="menu-title">Info Pendaftaran</div>
            </a>
        </li>
        <li>
            <a href="{{ url('admin') }}">
                <div class="parent-icon">
                    {{-- <i class='fa fa-circle'></i> --}}
                </div>
                <div class="menu-title">Program Studi</div>
            </a>
        </li>
    </ul>
</div>
<!--end sidebar -->
