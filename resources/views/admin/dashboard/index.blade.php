@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="fas fa-chart-pie"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.Profit Today') }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="fas fa-chart-line"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.Profit Week') }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger"><i class="fas fa-chart-bar"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.Profit Month') }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info"><i class="fas fa-chart-area"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.All Profits') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="fas fa-chart-pie"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.Cases Today') }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="fas fa-chart-line"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.Cases Week') }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger"><i class="fas fa-chart-bar"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.Cases Month') }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-info">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info"><i class="fas fa-chart-area"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.All Cases') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-lg-6 mb-4">
            <div class="card card-border-shadow-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="fas fa-user-injured"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.Reservations Today') }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6 mb-4">
            <div class="card card-border-shadow-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="fas fa-user-nurse"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">0</h4>
                    </div>
                    <p class="mb-1">{{ trans('admin.All Reservations') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-line"></i> {{ trans('admin.Cases Report') }} - ({{ date('Y') }})</h5>
                </div>
                <div class="card-body">
                    <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                </div>
            </div>
        </div>

        @push('script')
            <script src="{{ asset('dashboard') }}/assets/vendor/libs/chartjs/chartjs.js"></script>
            <script src="{{ asset('dashboard') }}/assets/js/charts-chartjs.js"></script>
            <script>
                // Color Variables
                const purpleColor = '#836AF9',
                    yellowColor = '#ffe800',
                    cyanColor = '#28dac6',
                    orangeColor = '#FF8132',
                    orangeLightColor = '#FDAC34',
                    oceanBlueColor = '#299AFF',
                    greyColor = '#4F5D70',
                    greyLightColor = '#EDF1F4',
                    blueColor = '#2B9AFF',
                    blueLightColor = '#84D0FF';

                let cardColor, headingColor, labelColor, borderColor, legendColor;

                if (isDarkStyle) {
                    cardColor = config.colors_dark.cardColor;
                    headingColor = config.colors_dark.headingColor;
                    labelColor = config.colors_dark.textMuted;
                    legendColor = config.colors_dark.bodyColor;
                    borderColor = config.colors_dark.borderColor;
                } else {
                    cardColor = config.colors.cardColor;
                    headingColor = config.colors.headingColor;
                    labelColor = config.colors.textMuted;
                    legendColor = config.colors.bodyColor;
                    borderColor = config.colors.borderColor;
                }

                // Bar Chart
                // --------------------------------------------------------------------
                const barChart = document.getElementById('barChart');
                if (barChart) {
                    var ordermcount = {!! json_encode($ordermcount) !!};
                    var orderArr = {!! json_encode($orderArr) !!};
                    const barChartVar = new Chart(barChart, {
                        type: 'bar',
                        data: {
                            labels: [
                                "{{ trans('admin.January') }}",
                                "{{ trans('admin.February') }}",
                                "{{ trans('admin.March') }}",
                                "{{ trans('admin.April') }}",
                                "{{ trans('admin.May') }}",
                                "{{ trans('admin.June') }}",
                                "{{ trans('admin.July') }}",
                                "{{ trans('admin.August') }}",
                                "{{ trans('admin.September') }}",
                                "{{ trans('admin.October') }}",
                                "{{ trans('admin.November') }}",
                                "{{ trans('admin.December') }}",
                            ],
                            datasets: [{
                                    label: "{{ trans('admin.Count') }}",
                                    data: [
                                        orderArr[1],
                                        orderArr[2],
                                        orderArr[3],
                                        orderArr[4],
                                        orderArr[5],
                                        orderArr[6],
                                        orderArr[7],
                                        orderArr[8],
                                        orderArr[9],
                                        orderArr[10],
                                        orderArr[11],
                                        orderArr[12],
                                    ],
                                    borderColor: '#b28105',
                                    backgroundColor: '#d64dcf',
                                    hoverborderColor: '#1e9960',
                                    hoverBackgroundColor: '#070e1b',
                                    maxBarThickness: 50,
                                    borderRadius: {
                                        topRight: 15,
                                        topLeft: 15
                                    }
                                },
                                {
                                    label: "{{ trans('admin.Total') }}",
                                    data: [
                                        orderArr[1],
                                        orderArr[2],
                                        orderArr[3],
                                        orderArr[4],
                                        orderArr[5],
                                        orderArr[6],
                                        orderArr[7],
                                        orderArr[8],
                                        orderArr[9],
                                        orderArr[10],
                                        orderArr[11],
                                        orderArr[12],
                                    ],

                                    borderColor: '#b28105',
                                    backgroundColor: '#28dac6',
                                    hoverborderColor: '#1e9960',
                                    hoverBackgroundColor: '#070e1b',
                                    maxBarThickness: 50,
                                    borderRadius: {
                                        topRight: 15,
                                        topLeft: 15
                                    }
                                },
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            animation: {
                                duration: 500
                            },
                            plugins: {
                                tooltip: {
                                    rtl: isRtl,
                                    backgroundColor: cardColor,
                                    titleColor: headingColor,
                                    bodyColor: legendColor,
                                    borderWidth: 1,
                                    borderColor: borderColor
                                },
                                legend: {
                                    display: false
                                }
                            },

                        }
                    });
                }
            </script>
        @endpush
    @endsection
