<nav class="main-header navbar navbar-expand-md navbar-light navbar-white"
    @if (request()->is('check-bill-restaurant')) style="position: sticky;top:0;" @endif>
    <div class="container-fluid">
        <a href="{{ route('backend.dashboard') }}" class="navbar-brand">
            @if (auth()->user()->image)
                <img src="{{ asset(auth()->user()->image) }}" width="35" height="35" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
            @else
                <img src="{{ asset('fontend/img/logo1.png') }}" width="35" height="35" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
            @endif


            <span class="brand-text font-weight-light">
                {{ !empty(auth()->user()->firstname) ? auth()->user()->firstname : '' }}
            </span>
        </a>
        <!-- Left navbar links -->
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                @if ($function_controller->check_permission('access_setting') == true || auth()->user()->role_id == 1)
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="nav-link dropdown-toggle"> <i class="fa fa-gear text-primary"></i> ຈັດການຂໍ້ມູນ</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            @if ($function_controller->check_permission('access_role') == true || auth()->user()->role_id == 1)
                                <li><a href="{{ route('backend.role') }}" class="dropdown-item"><i
                                            class="fa fa-angle-double-right main-web-color"></i>
                                        {{ __('lang.roles') }}</a>
                                </li>
                            @endif
                            @if ($function_controller->check_permission('access_user') == true || auth()->user()->role_id == 1)
                                <li><a href="{{ route('backend.user') }}" class="dropdown-item"><i
                                            class="fa fa-angle-double-right main-web-color"></i>
                                        {{ __('lang.users') }}</a>
                                </li>
                            @endif
                            @if ($function_controller->check_permission('access_departments') == true || auth()->user()->role_id == 1)
                                <li><a href="{{ route('backend.departments') }}" class="dropdown-item"><i
                                            class="fa fa-angle-double-right main-web-color"></i>
                                        ພະແນກ</a>
                                </li>
                            @endif
                            @if ($function_controller->check_permission('access_medicine') == true || auth()->user()->role_id == 1)
                                <li><a href="{{ route('backend.medicine') }}" class="dropdown-item"><i
                                            class="fa fa-angle-double-right main-web-color"></i>
                                        ຢາ</a>
                                </li>
                            @endif
                            @if ($function_controller->check_permission('access_medicine_type') == true || auth()->user()->role_id == 1)
                                <li><a href="{{ route('backend.medicine_types') }}" class="dropdown-item"><i
                                            class="fa fa-angle-double-right main-web-color"></i>
                                        ປະເພດຢາ</a>
                                </li>
                            @endif
                            {{-- @if ($function_controller->check_permission('access_user') == true || auth()->user()->role_id == 1)
                        <li><a href="{{ route('backend.province') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ແຂວງ</a>
                        </li>
                        @endif --}}
                            {{-- @if ($function_controller->check_permission('access_user') == true || auth()->user()->role_id == 1)
                        <li><a href="{{ route('backend.district') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ເມືອງ</a>
                        </li>
                        @endif --}}
                            {{-- @if ($function_controller->check_permission('access_user') == true || auth()->user()->role_id == 1)
                        <li><a href="{{ route('backend.village') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ບ້ານ</a>
                        </li>
                        @endif --}}






                        </ul>
                    </li>
                @endif

                @if ($function_controller->check_permission('access_patient') == true || auth()->user()->role_id == 1)
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-user text-primary"></i> ຄົນໄຂ້</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="{{ route('backend.patients') }}" class="dropdown-item"><i
                                        class="fa fa-angle-double-right main-web-color"></i>
                                    ຄົນໄຂ້</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($function_controller->check_permission('access_treatment') == true || auth()->user()->role_id == 1)
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-history text-primary"></i>ປະຫັວດການປິ່ນປົວ</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="{{ route('create_treatment') }}" class="dropdown-item"><i
                                        class="fa fa-angle-double-right main-web-color"></i>
                                    ເພີ່ມອາການເບື້ອງຕົ້ນ</a>
                            </li>
                            <li><a href="{{ route('backend.treatment') }}" class="dropdown-item"><i
                                        class="fa fa-angle-double-right main-web-color"></i>
                                    ລາຍການຄົນໄຂ້</a>
                            </li>
                        </ul>

                    </li>
                @endif
                @if ($function_controller->check_permission('access_appointments') == true || auth()->user()->role_id == 1)
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-calendar-check text-primary"></i> ການນັດໝາຍ</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="{{ route('backend.appointment') }}" class="dropdown-item"><i
                                        class="fa fa-angle-double-right main-web-color"></i>
                                    ການນັດໝາຍ</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($function_controller->check_permission('access_report') == true || auth()->user()->role_id == 1)
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link dropdown-toggle"><i
                        class="fas fa-chart-line text-primary"></i> {{ __('lang.report') }}</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ route('backend.report_pateint') }}" class="dropdown-item"><i
                                    class="fa fa-angle-double-right main-web-color"></i>
                                ຄົນໄຂທັງໝົດ</a>
                        </li>
                        <li><a href="{{ route('backend.report_appointments') }}" class="dropdown-item"><i
                                    class="fa fa-angle-double-right main-web-color"></i>
                                ລາຍງານການໜັດໝາຍ</a>
                        </li>
                        <li><a href="" class="dropdown-item"><i
                                    class="fa fa-angle-double-right main-web-color"></i>
                                ລາຍງານການຜິດໜັດໝາຍ</a>
                        </li>
                        <li><a href="" class="dropdown-item"><i
                                    class="fa fa-angle-double-right main-web-color"></i>
                                ລາຍການຜູ້ລະບົບ</a>
                        </li>
                        <li class="dropdown-divider"></li>
                </li>
                @endif
            </ul>

        </div>
        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="">
                    <i class="fas fa-language"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    <a class="nav-link" data-toggle="nav-item" href="{{ url('localization/lo') }}">
                        <i class="flag-icon flag-icon-la"></i> {{ __('lang.lao') }}
                    </a>
                    <a class="nav-link" data-toggle="nav-item" href="{{ url('localization/en') }}">
                        <i class="flag-icon flag-icon-us"></i> {{ __('lang.english') }}
                    </a>

                </div>
            </li>
            <li class="nav-item dropdown">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    @if (auth()->user()->image)
                        <img src="{{ asset(auth()->user()->image) }}" width="35" height="35"
                            alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    @else
                        <img src="{{ asset('fontend/img/logo1.png') }}" width="35" height="35"
                            alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    @endif
                    <span class="brand-text font-weight-light text-md"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    <a class="nav-link" data-toggle="nav-item" href="{{ route('backend.profile') }}">
                        <i class="fas fa-user-tie"></i> {{ __('lang.profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a data-toggle="modal" data-target="#modal-default" class="nav-link"
                        data-controlsidebar-slide="true" role="button">
                        <i class="fas fa-sign-out-alt main-web-color"></i> {{ __('lang.logout') }}
                    </a>
                </div>
            </li>
            <li class="user-footer">

            </li>
        </ul>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
{{-- =========================== modal logout ============================ --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header main-web-background second-web-color">
                <p class="modal-title"> <i class="fas fa-sign-out-alt"></i>{{ __('lang.logout') }}</p>
                <button type="button" class="close second-web-color" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">{{ __('lang.do_you_want_to_logout') }}?</h5>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('lang.cancel') }}</button>
                <a type="button" href="{{ route('backend.logout') }}"
                    class="btn btn-primary">{{ __('lang.ok') }}</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
