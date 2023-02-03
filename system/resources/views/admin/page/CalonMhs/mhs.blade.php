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
            <div class="breadcrumb-title pe-3">{{ $title ?? '' }}</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                        </li>
                        <li aria-current="page" class="breadcrumb-item active">{{ $sub_title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
            {{-- <div class="ms-auto">
                <a class="btn btn-inverse-primary"
                   href="{{ url($uri['store']['prefix'] . $uri['store']['router']) }}"><i class="fa fa-plus"></i> Tambah
                    Data</a>
            </div> --}}
        </div>
        <div class="col-12">
            <div class="card border-primary border-bottom border-3 border-0">
                <div class="card-body">
                    <strong class="card-title text-primary">CALON MAHASISWA</strong>
                    <hr>
                    <div class="card-body">
                        <div class="d-lg-flex align-items-center space-between mb-4 gap-3">
                            <div style="display: flex; justify-content: center; align-content: center; align-items: center">
                                <div class="position-relative">
                                    <input class="form-control form-control-sm" id="search" name="search"
                                        placeholder="cari nama / nik" type="text"
                                        value="{{ request()->get('search') ?? '' }}">
                                </div>
                            </div>
                            <div class="d-flex order-actions">
                                <a class="ms-3 bt-icon text-primary toggel_view" data-hide="chart" data-show="table"
                                    title="lihat grafik"><i class="fadeIn animated bx bx-line-chart-down"></i></a>

                                <a class="ms-3 bt-icon text-primary" data-bs-target="#filter" data-bs-toggle="modal"
                                    title="filter"><i class="fadeIn animated bx bx-filter"></i></a>

                                <a class="ms-3 bt-icon text-secondary" data-bs-target="#print_filter" data-bs-toggle="modal"
                                    title="cetak kartu"><i class="fa fa-id-card"></i></a>

                                <a class="ms-3 bt-icon text-secondary" data-bs-target="#print_filter" data-bs-toggle="modal"
                                    title="print"><i class="fadeIn animated bx bx-printer"></i></a>

                                <a class="ms-3 bt-icon text-success" href="#" id="exp" title="export excel">
                                    <i class="fa fa-file-excel"></i>
                                </a>
                            </div>
                        </div>

                        <div class="viwers" id="table" style="display: none">
                            @include('admin.page.CalonMhs.table_view')
                        </div>
                        <div class="viwers" id="chart" style="display: none">
                            @include('admin.page.CalonMhs.chart')
                        </div>
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
        |END CONTROLL VIEW
        |
        */
        function CreateChart(data) {
            if (data.length == 0)
                return;
            $("#jmlMhs").html(data?.jumlah_data);

            // ======================================
            const maping_data = data?.maping_data
            // masuk kedalam object maping_data pada result api
            for (var key_data in maping_data) {
                if (maping_data.hasOwnProperty(key_data)) {
                    var ctx = document.getElementById(maping_data[key_data]?.id).getContext('2d');
                    const data_set_obj = maping_data[key_data]?.map_data;
                    var ds_pending = [];
                    var ds_valid = [];
                    var ds_invalid = [];
                    var ds_complit = [];
                    var id_data = 1;
                    data_set_obj?.map((x, inx) => {
                        ds_pending.push(x?.by_status?.pending?.length ?? 0);
                        ds_valid.push(x?.by_status?.valid?.length ?? 0);
                        ds_invalid.push(x?.by_status?.invalid?.length ?? 0);
                        ds_complit.push(x?.data?.length ?? 0)
                        id_data++;
                    })

                    const obj_dataset = [{
                            label: "pending",
                            backgroundColor: '#f5b105',
                            borderWidth: 1,
                            data: ds_pending,
                            xAxisID: "bar-x-axis1",
                            yAxisID: "bar-y-axis1"
                        },
                        {
                            label: "valid",
                            backgroundColor: '#47bf22',
                            borderWidth: 1,
                            data: ds_valid,
                            xAxisID: "bar-x-axis1",
                            yAxisID: "bar-y-axis1"
                        },
                        {
                            label: "invalid",
                            backgroundColor: '#bf2a22',
                            borderWidth: 1,
                            data: ds_invalid,
                            xAxisID: "bar-x-axis1",
                            yAxisID: "bar-y-axis1"
                        },
                        {
                            label: "Seluruh Data",
                            backgroundColor: 'rgba(66, 135, 245, 0.2)',
                            borderWidth: 1,
                            data: ds_complit,
                            xAxisID: "bar-x-axis2",
                            yAxisID: "bar-y-axis2"
                        }
                    ]
                    var options = {
                        scales: {
                            xAxes: [{
                                    stacked: true,
                                    id: "bar-x-axis1",
                                    barThickness: 30,
                                },
                                {
                                    display: false,
                                    stacked: true,
                                    id: "bar-x-axis2",
                                    barThickness: 70,
                                    // these are needed because the bar controller defaults set only the first x axis properties
                                    type: 'category',
                                    categoryPercentage: 0.8,
                                    barPercentage: 0.9,
                                    gridLines: {
                                        offsetGridLines: true
                                    },
                                    offset: true
                                }
                            ],
                            yAxes: [{
                                    id: "bar-y-axis1",
                                    stacked: true,
                                    ticks: {
                                        beginAtZero: true,
                                        min: 0,
                                        autoSkip: false,
                                    }
                                },
                                {
                                    id: "bar-y-axis2",
                                    stacked: false,
                                    ticks: {
                                        beginAtZero: true,
                                        min: 0,
                                        autoSkip: false,
                                        display: false
                                    },
                                    gridLines: {
                                        display: false
                                    }
                                }
                            ]

                        },
                        legend: {
                            display: true,
                            labels: {
                                fontSize: 12,
                                fontColor: '#595d6e',
                            }
                        },
                        plugins: {
                            datalabels: {
                                formatter: (value, ctx) => {
                                    console.log(ctx?.datasetIndex == 3);
                                    if (value != 0 && ctx?.datasetIndex != 3)
                                        return value;
                                    else if (value == 0 || ctx?.datasetIndex == 3)
                                        return "";
                                },
                                color: '#fff',
                            }
                        }
                    };
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: maping_data[key_data]?.label,
                            datasets: obj_dataset
                        },
                        // options: {
                        //     maintainAspectRatio: false,
                        //     legend: {
                        //         position: 'bottom',
                        //         display: false,
                        //         labels: {
                        //             boxWidth: 8
                        //         }
                        //     },
                        //     tooltips: {
                        //         displayColors: false,
                        //     },
                        //     scales: {
                        //         xAxes: [{
                        //             barPercentage: 1
                        //         }],
                        //         yAxes: [{
                        //             ticks: {
                        //                 beginAtZero: true,
                        //                 stepSize: 10
                        //             }
                        //         }]
                        //     }
                        // }
                        options: options
                    });

                }
            }
            // ==============================================


        }

        function CreateChartProdi() {

        }
        /*
        |CONTROLL CHART
        |
        */

        request_get({
            url: `{{ url('api/v1/calon_mahasiswa/chart') }}${window.location.search}`,
            header: headers,
            response: (res) => {
                if (res?.status == 200) {
                    CreateChart(res?.data);
                }
            },
            errors: () => {

            }
        })
        /*
        |END CONTROLL CHART
        |
        */
        $("canvas").css("height", "400px")

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
        $("#search").keypress(function() {
            const d = $(this).val();
            var code = event.keyCode ? event.keyCode : event.which;
            if (code == 13) {
                var _search = ``;

                if (__empty(window.location.search)) {
                    _search = `?search=${d}`;
                } else if (!__empty(window.location.search) && __empty(search?.search)) {
                    _search = removeURLParameter(`${window.location.search}`, "search") + `&search=${d}`
                } else {
                    _search = removeURLParameter(`${window.location.search}`, "search") + `&search=${d}`
                }
                window.location.href = `{{ url('admin/mhs') }}${_search}`;
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
