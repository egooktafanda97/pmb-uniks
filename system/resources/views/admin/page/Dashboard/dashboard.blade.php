@extends('admin.index.index')
@section('content')
    <div class="page-content">
        <div class="mb-3">
            <span class="border px-1 rounded cursor-pointer" style="background: #fff"><i class="bx bxs-circle me-1"
                    style="color: #15ca20"></i>{{ $pendaftaran['info_pendaftaran']->pendaftaran ?? 'Pendaftaran Belum dibuka' }}</span>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Jumlah Fakultas</p>
                                <h4 class="my-1 text-info">{{ $fakultas->count() ?? 0 }}</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <i class='fa fa-home'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Jumlah Prodi</p>
                                <h4 class="my-1 text-info">{{ $prodi->count() ?? 0 }}</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                <i class='fa fa-home'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <strong>
                                    <p class="mb-0 text-secondary">Pendaftar</p>
                                </strong>
                                <h4 class="my-1 text-warning">{{ $pendaftaran['pendaftar'] ?? 0 }}</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <strong>
                                    <p class="mb-0 text-secondary">Calon Mahasiswa</p>
                                </strong>
                                <h4 class="my-1 text-success">{{ $pendaftaran['c_pendaftar'] ?? 0 }}</h4>
                                <p class="mb-0 font-13"></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Chart / Prodi</h6>
                            </div>
                            {{-- <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"
                                    href="#"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #14abef"></i>PILIHAN 2</span>
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                    style="color: #ffc107"></i>PILIHAN 1</span>
                        </div>
                        <div class="chart-container-1">
                            <canvas id="chart1"></canvas>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $pendaftaran['pendaftar_pending'] ?? 0 }}</h5>
                                <small class="mb-0">Belum Diproses <span></small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $pendaftaran['pendaftar_valid'] ?? 0 }}</h5>
                                <small class="mb-0">Valid <span> </small>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3">
                                <h5 class="mb-0">{{ $pendaftaran['pendaftar_invalid'] ?? 0 }}</h5>
                                <small class="mb-0">Invalid <span> </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12 col-lg-4">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Data Valid</h6>
                            </div>
                        </div>
                        <div class="chart-container-2 mt-4">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if (!empty($pendaftaran['group_prodi']['prodi']))
                            @php
                                $index = 0;
                            @endphp
                            @foreach ($pendaftaran['group_prodi']['prodi'] as $item)
                                <li
                                    class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                    {{ $item }} <span
                                        class="badge bg-success rounded-pill">{{ $pendaftaran['group_prodi']['data_valid'][$index] ?? 0 }}</span>
                                </li>
                                @php
                                    $index++;
                                @endphp
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div> --}}
        </div>
        <!--end row-->
    </div>
@endsection
@section('script')
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js">
    </script>
    {{-- ||||||||||||| chart ||||||||||| --}}
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{ asset(config('app.adm-assets')) }}/assets/plugins/chartjs/js/Chart.extension.js"></script>
    {{-- |||||||||||||||||||||||||||| --}}
    {{-- <script src="{{ asset(config('app.adm-assets')) }}/assets/js/index.js"></script> --}}
    <script>
        function __chartFunc(data) {
            const _daftar = data?.pendaftaran ?? [];
            if (_daftar) {
                console.log(_daftar);
                const prodi_name = _daftar?.group_prodi?.prodi;
                // pilihan pertama
                const result_data_p1 = _daftar?.group_prodi?.pilihan_1;
                // pilihan kedua
                const result_data_p2 = _daftar?.group_prodi?.pilihan_2;


                var ctx = document.getElementById("chart1").getContext('2d');

                var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke1.addColorStop(0, '#6078ea');
                gradientStroke1.addColorStop(1, '#17c5ea');

                var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke2.addColorStop(0, '#ff8359');
                gradientStroke2.addColorStop(1, '#ffdf40');

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: prodi_name,
                        datasets: [{
                                label: 'Pilihan 1',
                                data: result_data_p1,
                                borderColor: gradientStroke1,
                                backgroundColor: gradientStroke1,
                                hoverBackgroundColor: gradientStroke1,
                                pointRadius: 0,
                                fill: false,
                                borderWidth: 0
                            },
                            {
                                label: 'Pilihan 2',
                                data: result_data_p2,
                                borderColor: gradientStroke2,
                                backgroundColor: gradientStroke2,
                                hoverBackgroundColor: gradientStroke2,
                                pointRadius: 0,
                                fill: false,
                                borderWidth: 0
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                            display: false,
                            labels: {
                                boxWidth: 8
                            }
                        },
                        tooltips: {
                            displayColors: false,
                        },
                        scales: {
                            xAxes: [{
                                barPercentage: .5
                            }]
                        }
                    }
                });

                // ===***********************************************

                // var ctx = document.getElementById("chart2").getContext('2d');

                // var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
                // gradientStroke1.addColorStop(0, '#fc4a1a');
                // gradientStroke1.addColorStop(1, '#f7b733');

                // var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
                // gradientStroke2.addColorStop(0, '#4776e6');
                // gradientStroke2.addColorStop(1, '#8e54e9');


                // var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
                // gradientStroke3.addColorStop(0, '#ee0979');
                // gradientStroke3.addColorStop(1, '#ff6a00');

                // var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
                // gradientStroke4.addColorStop(0, '#42e695');
                // gradientStroke4.addColorStop(1, '#3bb2b8');

                // var myChart = new Chart(ctx, {

                //         type: 'doughnut',
                //         data: {

                //             labels: prodi_name,
                //             datasets: [{
                //                     backgroundColor: [gradientStroke1,
                //                         gradientStroke2,
                //                         gradientStroke3,
                //                         gradientStroke4
                //                     ],
                //                     hoverBackgroundColor: [gradientStroke1,
                //                         gradientStroke2,
                //                         gradientStroke3,
                //                         gradientStroke4
                //                     ],
                //                     data: result_data_valid,
                //                     borderWidth: [1, 1, 1, 1]
                //                 }

                //             ]
                //         }

                //         ,
                //         options: {

                //             maintainAspectRatio: false,
                //             cutoutPercentage: 75,
                //             legend: {

                //                 position: 'bottom',
                //                 display: false,
                //                 labels: {
                //                     boxWidth: 8
                //                 }
                //             }

                //             ,
                //             tooltips: {
                //                 displayColors: false,
                //             }
                //         }
                //     }

                // );

                // ************************************
                // -----------------------------------
                jQuery('#geographic-map-2').vectorMap({

                        map: 'world_mill_en',
                        backgroundColor: 'transparent',
                        borderColor: '#818181',
                        borderOpacity: 0.25,
                        borderWidth: 1,
                        zoomOnScroll: false,
                        color: '#009efb',
                        regionStyle: {
                            initial: {
                                fill: '#008cff'
                            }
                        }

                        ,
                        markerStyle: {
                            initial: {
                                r: 9,
                                'fill': '#fff',
                                'fill-opacity': 1,
                                'stroke': '#000',
                                'stroke-width': 5,
                                'stroke-opacity': 0.4
                            }

                            ,
                        }

                        ,
                        enableZoom: true,
                        hoverColor: '#009efb',
                        markers: [{
                                latLng: [21.00, 78.00],
                                name: 'Lorem Ipsum Dollar'

                            }

                        ],
                        hoverOpacity: null,
                        normalizeFunction: 'linear',
                        scaleColors: ['#b6d6ff', '#005ace'],
                        selectedColor: '#c9dfaf',
                        selectedRegions: [],
                        showTooltip: true,
                    }

                );

            }
        }
        // chart 1
        request_get({
            url: `{{ url('api/result_main_data') }}`,
            header: headers,
            response: (res) => {
                if (res?.status == 200) {
                    __chartFunc(res?.data)
                }
            },
            errors: () => {

            }
        })
    </script>
@endsection

{{-- <script>
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

</script> --}}
