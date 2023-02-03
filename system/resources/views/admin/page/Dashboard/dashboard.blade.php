@extends('admin.index.index')
@section('content')
    <div class="page-content">
        <div class="mb-3">
            <span class="border px-1 rounded cursor-pointer"
                  style="background: #fff"><i class="bx bxs-circle me-1"
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
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Pendaftar Valid</p>
                                <h4 class="my-1 text-success">{{ $pendaftaran['pendaftar'] ?? 0 }}</h4>
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
            <div class="col-12 col-lg-8">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Chart / Prodi</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret"
                                   data-bs-toggle="dropdown"
                                   href="#"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                           href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="javascript:;">Something else here</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                   style="color: #14abef"></i>Data Valid</span>
                            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1"
                                   style="color: #ffc107"></i>Data Invalid</span>
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
            <div class="col-12 col-lg-4">
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
            </div>
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
                const prodi_name = _daftar?.group_prodi?.prodi;
                const result_data_valid = _daftar?.group_prodi?.data_valid;
                const result_data_invalid = _daftar?.group_prodi?.data_invalid;
                const result_data_pending = _daftar?.group_prodi?.data_pending;


                var ctx = document.getElementById("chart1").getContext('2d');

                var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke1.addColorStop(0, '#6078ea');
                gradientStroke1.addColorStop(1, '#17c5ea');

                var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke2.addColorStop(0, '#ff8359');
                gradientStroke2.addColorStop(1, '#ffdf40');

                var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke3.addColorStop(0, '#eb0505');
                gradientStroke3.addColorStop(1, '#eb09a0');

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: prodi_name,
                        datasets: [{
                                label: 'data valid',
                                data: result_data_valid,
                                borderColor: gradientStroke1,
                                backgroundColor: gradientStroke1,
                                hoverBackgroundColor: gradientStroke1,
                                pointRadius: 0,
                                fill: false,
                                borderWidth: 0
                            },
                            {
                                label: 'data tidak valid',
                                data: result_data_invalid,
                                borderColor: gradientStroke2,
                                backgroundColor: gradientStroke2,
                                hoverBackgroundColor: gradientStroke2,
                                pointRadius: 0,
                                fill: false,
                                borderWidth: 0
                            },
                            {
                                label: 'data belum diproses',
                                data: result_data_pending,
                                borderColor: gradientStroke3,
                                backgroundColor: gradientStroke3,
                                hoverBackgroundColor: gradientStroke3,
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

                var ctx = document.getElementById("chart2").getContext('2d');

                var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke1.addColorStop(0, '#fc4a1a');
                gradientStroke1.addColorStop(1, '#f7b733');

                var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke2.addColorStop(0, '#4776e6');
                gradientStroke2.addColorStop(1, '#8e54e9');


                var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke3.addColorStop(0, '#ee0979');
                gradientStroke3.addColorStop(1, '#ff6a00');

                var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
                gradientStroke4.addColorStop(0, '#42e695');
                gradientStroke4.addColorStop(1, '#3bb2b8');

                var myChart = new Chart(ctx, {

                        type: 'doughnut',
                        data: {

                            labels: prodi_name,
                            datasets: [{
                                    backgroundColor: [gradientStroke1,
                                        gradientStroke2,
                                        gradientStroke3,
                                        gradientStroke4
                                    ],
                                    hoverBackgroundColor: [gradientStroke1,
                                        gradientStroke2,
                                        gradientStroke3,
                                        gradientStroke4
                                    ],
                                    data: result_data_valid,
                                    borderWidth: [1, 1, 1, 1]
                                }

                            ]
                        }

                        ,
                        options: {

                            maintainAspectRatio: false,
                            cutoutPercentage: 75,
                            legend: {

                                position: 'bottom',
                                display: false,
                                labels: {
                                    boxWidth: 8
                                }
                            }

                            ,
                            tooltips: {
                                displayColors: false,
                            }
                        }
                    }

                );

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
