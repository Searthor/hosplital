<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">
                    <h1 class="m-0">Dashboard
                    </h1>
                </div>
                <div class="col-md-7"></div>
                
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info" >
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">{{count($all_user)}}  ຄົນ</h3>
                            <p>{{__("lang.all_user")}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('backend.user')}}" class="small-box-footer"> {{__("lang.detail")}} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success" >
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">{{count($all_patient)}} ຄົນ</h3>
                            <p>{{__("lang.all_patients")}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer"> {{__("lang.detail")}} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">10 ຄົນ</h3>
                            <p>{{__("lang.all_appointment")}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"> {{__("lang.detail")}} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">{{count($all_treatment)}} ລາຍການ</h3>
                            <p>{{__("lang.list_of_history")}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer"> {{__("lang.detail")}} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>

        <div class="position-relative my-4 p-4 " >
            <canvas  id="visitors-chart" height="300" ></canvas>
        </div>


    </div>
</div>

@push('scripts')
<script>
    var count = <?php echo json_encode($count); ?>;
    var date = <?php echo json_encode($date); ?>;
    // Initialize the chart with initial data
    var $visitorsChart = $('#visitors-chart');
    var visitorsChart = new Chart($visitorsChart, {
        data: {
            labels: date,
            datasets: [{
                type: 'line',
                data: count,
                backgroundColor: 'transparent',
                borderColor: '#13B7D2',
                pointBorderColor: '#13B7D2',
                pointBackgroundColor: '#13B7D2',
                fill: false
            }]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: true
            },
            hover: {
                mode: 'index',
                intersect: true
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        maxRotation: 45, // Rotate the labels by 90 degrees
                        minRotation: 45  // Rotate the labels by 90 degrees
                    }
                }]
            }
        }
    });
</script>



@endpush