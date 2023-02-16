@extends('admin.index.index')
@section('style')
    <style>
        .tb-title {
            width: 85%;
        }

        .tb-acton {
            width: 15%;
        }

        .div-action-container {
            display: flex;
            justify-content: center;
            align-content: center;
        }
    </style>
@endsection
@section('content')
    <!--start page wrapper -->
    <div class="row">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            {{-- <div class="breadcrumb-title pe-3">{{ $title ?? '' }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                        </li>
                        <li aria-current="page" class="breadcrumb-item active">{{ $sub_title ?? '' }}</li>
                    </ol>
                </nav>
            </div> --}}
            {{-- <div class="ms-auto">
                <a class="btn btn-inverse-primary"
                   href="{{ url($uri['store']['prefix'] . $uri['store']['router']) }}"><i class="fa fa-plus"></i> Tambah
                    Data</a>
            </div> --}}
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between">
                        <strong class="card-title text-primary">CALON MAHASISWA</strong>
                        <div class="d-flex order-actions">
                            <a class="ms-3 bt-icon text-primary" data-bs-target="#filter" data-bs-toggle="modal"
                                title="filter"><i class="fadeIn animated bx bx-filter"></i></a>
                        </div>
                    </div>
                    <hr>
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a aria-selected="true" class="nav-link active tabs-cards" data-bs-toggle="tab"
                                data-idactive="tab-mhs" href="#tab-mhs" role="tab">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Calon Mahasiswa</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a aria-selected="false" class="nav-link tabs-cards" data-bs-toggle="tab"
                                data-idactive="tab-agent" href="#tab-agent" role="tab" tabindex="-1">
                                <div class="d-flex align-items-center">
                                    <div class="tab-title">Agent</div>
                                </div>
                            </a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <a aria-selected="false" class="nav-link" data-bs-toggle="tab" href="#primarycontact"
                                role="tab" tabindex="-1">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class="bx bx-microphone font-18 me-1"></i>
                                    </div>
                                    <div class="tab-title">Contact</div>
                                </div>
                            </a>
                        </li> --}}
                    </ul>
                    <div class="tab-content py-3">
                        <div class="tab-pane fade tab-views-cmhs active show" id="tab-mhs" role="tabpanel">
                            <br>
                            @include('admin.page.CalonMhs.table_view')
                        </div>
                        <div class="tab-pane fade tab-views-cmhs" id="tab-agent" role="tabpanel">
                            @include('admin.page.CalonMhs.agent')
                        </div>
                        {{-- <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                          
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.page.CalonMhs.modal')
    <!--end page wrapper -->
@endsection

@section('script')
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js">
    </script>
    {{-- ||||||||||||| chart ||||||||||| --}}
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="{{ asset('public/js/chart_plugin.js') }}"></script>
    {{-- |||||||||||||||||||||||||||| --}}
    <script>
        const id = sessionStorage.getItem("tabs-cards");
        if (!__empty(id)) {
            $(".tab-views-cmhs").removeClass("active show");
            $(".tabs-cards").removeClass("active")
            $(`[data-idactive=${id}]`).addClass("active")
            $(`#${id}`).addClass("active show");
            $(".tabs-cards").click(function() {
                sessionStorage.setItem("tabs-cards", $(this).data("idactive"));
            })
        }

        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
                paging: false,
                info: false,
                ordering: false
            });
        });
        /*
        |CONTROLL VIEW
        |
        */

        if (__empty(sessionStorage.getItem("view-show"))) {
            const hide = $(".toggel_view").data("hide");
            const show = $(".toggel_view").data("show");
            $(`#${hide}`).hide();
            $(`#${show}`).show();
            sessionStorage.setItem("view-hide", show)
            sessionStorage.setItem("view-show", hide)
        } else {
            const hide = sessionStorage.getItem("view-hide");
            const show = sessionStorage.getItem("view-show");
            $(`#${hide}`).hide();
            $(`#${show}`).show();
        }
        $(".toggel_view").click(function() {
            const hide = $(".toggel_view").data("hide");
            const show = $(".toggel_view").data("show");
            $(`#${$(".toggel_view").data("hide")}`).show();
            $(`#${$(".toggel_view").data("show")}`).hide();
            $(this).data("hide", show);
            $(this).data("show", hide);
            sessionStorage.setItem("view-hide", show)
            sessionStorage.setItem("view-show", hide)
        });

        /*
        |CONTROLL SEARCH
        |
        */
        function removeURLParameter(url, parameter) {
            //prefer to use l.search if you have a location/link object
            var urlparts = url.split('?');
            if (urlparts.length >= 2) {

                var prefix = encodeURIComponent(parameter) + '=';
                var pars = urlparts[1].split(/[&;]/g);

                //reverse iteration as may be destructive
                for (var i = pars.length; i-- > 0;) {
                    //idiom for string.startsWith
                    if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                        pars.splice(i, 1);
                    }
                }

                return urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
            }
            return url;
        }

        function replaceQueryParam(param, newval, search) {
            var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
            var query = search.replace(regex, "$1").replace(/&$/, '');

            return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
        }
        $("#search").keypress(function() {
            const d = $(this).val();
            var code = event.keyCode ? event.keyCode : event.which;
            if (code == 13) {
                window.location =
                    `{{ url('admin/mhs') }}${replaceQueryParam('search', d, window.location.search)}`;
            }
        })
        /*
        |END  SEARCH
        |
        */
        // |||||||||||||||||||||||||||||||||||||||||||||||||||||||
        /*
        |CONTROLL PRINT
        |
        */
        $("#btn_print_filter").click(function(e) {
            $("#form_print_filter").attr("action", `{{ url('report/report_cmhs') }}${window.location.search}`)
            $("#form_submit").click();
        })
        /*
        |END  PRINT
        |
        */
        $("#exp").click(function() {
            const Uri = `{{ url('report/report_excel') }}${window.location.search}`;
            $(this).attr("href", Uri);
        })
    </script>
@endsection
