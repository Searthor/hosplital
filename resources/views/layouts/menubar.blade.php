<nav class="main-header navbar navbar-expand-md navbar-light navbar-white" @if (request()->is('check-bill-restaurant')) style="position: sticky;top:0;" @endif>
    <div class="container-fluid">
        <a href="{{ route('backend.dashboard') }}" class="navbar-brand">
            <img src="{{ asset('fontend/img/logo1.png')}}" width="35" height="35" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">
                {{ !empty(auth()->user()->firstname) ? auth()->user()->firstname : '' }}
            </span>
        </a>
        <!-- Left navbar links -->
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">

            <ul class="navbar-nav">
                @if (
                $function_controller->check_permission('access_setting') == true ||
                auth()->user()->role_id == 1 )
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ __('lang.settings') }}</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        @if (auth()->user()->role_id == 1)
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">
                                <i class="fa fa-angle-double-right main-web-color"></i>
                                {{ __('lang.module_website') }}</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-1" href="{{ route('backend.slide') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                                        {{ __('lang.slide') }}</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{ route('backend.blog_type') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                                        {{ __('lang.blog_type') }}</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{ route('backend.blog') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                                        {{ __('lang.blog') }}</a>
                                </li>
                                <li>
                                    <a tabindex="-1" href="{{ route('backend.about') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                                        {{ __('lang.about') }}</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                       
                        @if (
                        $function_controller->check_permission('access_role') == true ||
                        auth()->user()->role_id == 1 )
                        <li><a href="{{ route('backend.role') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                                {{ __('lang.roles') }}</a>
                        </li>
                        @endif
                        @if (
                        $function_controller->check_permission('access_user') == true ||
                        auth()->user()->role_id == 1)
                        <li><a href="{{ route('backend.user') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                                {{ __('lang.users') }}</a>
                        </li>
                        @endif
                        @if (
                        $function_controller->check_permission('access_user') == true ||
                        auth()->user()->role_id == 1)
                        <li><a href="{{ route('backend.province') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ແຂວງ</a>
                        </li>
                        @endif
                        @if (
                        $function_controller->check_permission('access_user') == true ||
                        auth()->user()->role_id == 1)
                        <li><a href="{{ route('backend.district') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ເມືອງ</a>
                        </li>
                        @endif
                        @if (
                        $function_controller->check_permission('access_user') == true ||
                        auth()->user()->role_id == 1)
                        <li><a href="{{ route('backend.village') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ບ້ານ</a>
                        </li>
                        @endif
                     
                       
                 
                        
                      
                       
                    </ul>
                </li>
                @endif
   
                @if (
                $function_controller->check_permission('customer') == true ||
                auth()->user()->role_id == 1 )
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{__('lang.customer')}}</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="{{ route('backend.customers') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            {{__('lang.customer')}}</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (
                $function_controller->check_permission('customer') == true ||
                auth()->user()->role_id == 1 )
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">ປະຫັວດການປິ່ນປົວ</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ປະຫັວດການປິ່ນປົວ</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (
                $function_controller->check_permission('customer') == true ||
                auth()->user()->role_id == 1 )
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">ການໝາຍຂອງຄົນໄຂ</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                            ການໝາຍຂອງຄົນໄຂ</a>
                        </li>
                    </ul>
                </li>
                @endif
        

            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ __('lang.report') }}</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="{{ route('backend.report_all_customer') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                        ລູກຄ້າ ຫຼື ຄົນໄຂທັງໝົດ</a>
                    </li>
                    <li><a href="{{ route('backend.report_customer_arrear') }}" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                        ລາຍງານການໜັດໝາຍ</a>
                    </li>
                    <li><a href="" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                        ລາຍງານການຜິດໜັດໝາຍ</a>
                    </li>
                    <li><a href="" class="dropdown-item"><i class="fa fa-angle-double-right main-web-color"></i>
                        ລາຍການຜູ້ລະບົບ</a>
                    </li>
                    <li class="dropdown-divider"></li>
            </li>
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
                    <img src="{{ asset('fontend/img/logo1.png')}}" style="width: 30px; height: 30px" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light text-md"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0">
                    <a class="nav-link" data-toggle="nav-item" href="{{ route('backend.profile') }}">
                        <i class="fas fa-user-tie"></i> {{ __('lang.profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a data-toggle="modal" data-target="#modal-default" class="nav-link" data-controlsidebar-slide="true" role="button">
                        <i class="fas fa-sign-out-alt main-web-color"></i> {{ __('lang.logout') }}
                    </a>
                </div>
            </li>
            <li class="user-footer">

            </li>
        </ul>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
                <a type="button" href="{{ route('backend.logout') }}" class="btn btn-primary">{{ __('lang.ok') }}</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>