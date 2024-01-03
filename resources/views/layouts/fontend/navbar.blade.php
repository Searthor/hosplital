
      <!-- Topbar Start -->
      <div class="container-fluid bg-with py-2 d-none d-md-flex">
        <div class="container">
            <div class="d-flex justify-content-between topbar">
                <div class="top-info">
                    <small class="me-3 text-dark-50"><a href="#"><i class="fas fa-map-marker-alt me-2 text-dark"
                                style="font-size: 1rem;"></i></a>{{__('lang.vang_vieng_village')}}, {{__('lang.vang_vieng_district')}},{{__('lang.vientiane_province')}}</small>
                    <small class="me-3 text-dark-50"><a href="#"><i class="fas fa-envelope me-2 text-dark"
                                style="font-size: 1rem;"></i></a>info@vandala.la</small>
                </div>
                <div id="note" class="text-dark d-none d-xl-flex"><small>
                        ຫມາຍ​ເຫດ : ພວກເຮົາສາມາດຊ່ວຍເຈົ້າໃນການຂະຫຍາຍທຸລະກິດຂອງທ່ານ</small></div>
                <div class="top-link">
                    <a href="https://www.facebook.com/profile.php?id=100063573279633" target="_back" class="bg-dark nav-fill btn btn-sm-square rounded-circle"><i
                            class="fab fa-facebook-f maincolor"></i></a>
                    <a href="" class="bg-dark nav-fill btn btn-sm-square rounded-circle"><i
                            class="fab fa-twitter maincolor"></i></a>
                    <a href="" class="bg-dark nav-fill btn btn-sm-square rounded-circle"><i
                            class="fab fa-instagram maincolor"></i></a>
                    <a href="" class="bg-dark nav-fill btn btn-sm-square rounded-circle me-0"><i
                            class="fab fa-linkedin-in maincolor"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid Header">
        <div class="container">
            <nav class="navbar navbar-dark navbar-expand-lg py-2">
                <div class="logo">
                    <img src="{{asset('fontend/img/logo.png')}}" style="width: 50px;height: 50px;" alt="">
                    <a href="index.html">VANDALA</a>
                </div>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse bg-transparent" id="navbarCollapse">
                    <div class="navbar-nav ms-auto mx-xl-auto p-0">
                        <a href="{{Route('/')}}" class="nav-item nav-link @if (request()->is('/')) active  @endif  ">{{__('lang.home')}}</a>
                        <a href="{{Route('fontend.about')}}" class="nav-item nav-link @if (request()->is('about')) active  @endif">{{__('lang.about')}}</a>
                        <a href="{{Route('fontend.services')}}" class="nav-item nav-link @if (request()->is('services') || request()->is('services/service_detail/*')) active  @endif">{{__('lang.service')}}</a>
                        <a href="{{Route('fontend.news')}}" class="nav-item nav-link @if (request()->is('news') || request()->is('news/news_detail/*')) active  @endif">{{__('lang.news')}}</a>
                        <a href="{{Route('fontend.contact')}}" class="nav-item nav-link @if (request()->is('contact')) active  @endif">{{__('lang.contact')}}</a>
                    </div>
                    <div class="nav-item  language">
                        <a href="{{ url('localization/lo') }}" class=" @if (Config::get('app.locale') == 'lo') active @endif">LA</a> 
                        <a href="{{ url('localization/en')}}" class="@if (Config::get('app.locale') == 'en') active @endif">EN</a> 
                        <a href="{{ url('localization/cn') }} " class="@if (Config::get('app.locale') == 'cn') active @endif">CN</a>
                    </div>


                    <div class="login">
                        <a href="{{Route('backend.login')}}" target="_blank"><i class="fa-solid fa-right-to-bracket"></i> {{__('lang.login')}}</a>
                    </div>
                </div>

            </nav>
        </div>
    </div>
    <!-- Navbar End -->
