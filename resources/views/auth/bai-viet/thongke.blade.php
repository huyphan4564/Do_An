@extends('auth.master')
@section('head-link')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

    <link href="{{ asset('dist/css/chart/mdb.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/chart/style.css') }}" rel="stylesheet"/>
{{--    <link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">--}}
    <style>
        /* Giảm chiều cao của lưới grid */
        .md-chart .md-chart-area {
            margin-top: 30px; /* Giảm khoảng cách phía trên */
        }
        .md-chart .md-chart-grid-lines {
            height: calc(100% - 30px); /* Giảm chiều cao tổng thể */
        }
    </style>

@endsection
@section('body')
    {{--Page header--}}
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Quản lý thông tin tin tức
                    </div>
                    <h2 class="page-title">
                        Thống kê tin tức
                    </h2>
                </div>
            </div>
        </div>
    </div>

    {{--Page body--}}
    <div class="page-body">
        <div class="container-xl">
            {{--Title--}}
            <div class="d-flex justify-content-between align-items-center py-3">
                <h1 class="mb-0"><a href="#" class="text-muted"></a></h1>
            </div>
            {{--Main content--}}
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Revenue</div>
                                <div class="ms-auto lh-1">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-secondary" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item active" href="#">Last 7 days</a>
                                            <a class="dropdown-item" href="#">Last 30 days</a>
                                            <a class="dropdown-item" href="#">Last 3 months</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="h1 mb-0 me-2">$4,300</div>
                                <div class="me-auto">
                                    <span class="text-green d-inline-flex align-items-center lh-1">
                                      8% <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 17l6 -6l4 4l8 -8"></path><path d="M14 7l7 0l0 7"></path></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <canvas id="tintucChart"></canvas>
                    </div>
                </div>
            </div>

            <br>


            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body_content">
                                <canvas id="labelChart"></canvas>
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        //line
        var ctxL = document.getElementById("tintucChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["", "", "", "", "", "", ""],
                datasets: [
                    {
                        label: "My First dataset",
                        data: [65, 59, 80, 81, 56, 55, 40],
                        backgroundColor: [
                            'rgba(105, 0, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(200, 99, 132, .7)',
                        ],
                        borderWidth: 2,
                    }
                ]
            },
            options: {
                responsive: true,
                legend: {
                    display: false // Ẩn legend
                }

            }
        });
    </script>
{{--    Bieu do tron--}}
    <script>
        $(document).ready(function () {
            {{--let html = str_2_html(`{{$tt->noi_dung}}`)--}}
            {{--$('.card-body_content').html(html);--}}

            $('.tieuDe').change(function () {
                $('.URL').val(toSlug($(this).val()))
            });
        });
        var ctxP = document.getElementById("labelChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            plugins: [ChartDataLabels],
            type: 'pie',
            data: {
                // labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
                labels: ["Số bài đã đăng", "Số bài chưa đăng"],
                datasets: [{
                    // data: [210, 130, 120, 160, 120],
                    // backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    // hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                    data: [24, 12],
                    backgroundColor: ["#F7464A", "#46BFBD"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1"]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'right',
                    labels: {
                        padding: 20,
                        boxWidth: 10
                    }
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(2) + "%";
                            return percentage;
                        },
                        color: 'white',
                        labels: {
                            title: {
                                font: {
                                    size: '16'
                                }
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        //bar
        var ctxB = document.getElementById("barChart").getContext('2d');
        var myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                // labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                labels: ["Red", "Blue"],
                datasets: [{
                    label: '# of Votes',
                    // data: [12, 19, 3, 5, 2, 3],
                    data: [24, 12],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        // 'rgba(255, 206, 86, 1)',
                        // 'rgba(75, 192, 192, 1)',
                        // 'rgba(153, 102, 255, 1)',
                        // 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
{{--Bieu do duong--}}
    <script>
        //line
        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: [
                        'rgba(105, 0, 132, .2)',
                    ],
                    borderColor: [
                        'rgba(200, 99, 132, .7)',
                    ],
                    borderWidth: 2
                },
                    {
                        label: "My Second dataset",
                        data: [28, 48, 40, 19, 86, 27, 90],
                        backgroundColor: [
                            'rgba(0, 137, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(0, 10, 130, .7)',
                        ],
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endsection
@section('bottom-body')

    <script src="{{asset('dist/js/chart/jquery.min.js') }}"></script>
    <script src="{{asset('dist/js/chart/popper.min.js') }}"></script>
    <script src="{{asset('dist/js/chart/bootstrap.min.js') }}"></script>
    <script src="{{asset('dist/js/chart/mdb.min.js') }}"></script>
@endsection
