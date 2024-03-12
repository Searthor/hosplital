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
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">{{count($all_user)}}  ຄົນ</h3>
                            <p>ຜູ້ໃຊ້ລະບົບທັງໜົດ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('backend.user')}}" class="small-box-footer">ລາຍລະອຽດ<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">{{count($all_patient)}} ຄົນ</h3>
                            <p>ຄົນໄຂທັງໝົດ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer"> ລາຍລະອຽດ <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">10 ຄົນ</h3>
                            <p>ຄົນໄຂທີ່ໜັດໜາມມື້ນີ້</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"> ລາຍລະອຽດ <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box " style="background: rgb(255, 154, 154)">
                        <div class="inner">
                            <h3 style="font-size:2.5vw;">{{count($all_treatment)}} ລາຍການ</h3>
                            <p>ລາຍການປະຫວັດ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer"> ລາຍລະອຽດ <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>

    </div>
</div>