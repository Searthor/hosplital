<div>
    <!-- Carousel Start -->
    <div class="container-fluid px-0">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <!-- <ol class="carousel-indicators">
                    <li data-bs-target="#carouselId"  data-bs-slide-to="0" class="active"  aria-current="true" aria-label="First slide"></li>
                    <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                </ol> -->
            <div class="carousel-inner" role="listbox">
                {{-- @if (count($slides) > 0)
                    @foreach ($slides as $item)
                        <div class="carousel-item @if ($item->id == 1) active @endif ">
                            <a href="">
                                <img src="{{ $item->image }}" class="img-fluid" alt="First slide">
                                <div class="carousel-caption">
                            <div class="container carousel-content">
                                <h4 class="maincolor mb-4  animated fadeInUp">VANDALA</h4>
                                <h4 class="animated fadeInRight">ໃຫ້ບໍລິການເງິນກູ້ໄລຍະສັ້ນ ເພື່ອສະໜັບສະໜູນເງິນທຶນ
                                    ໃຫ້ແກ່ຜູ້ທີ່ດຳເນີນທຸລະກິດ ກ່ຽວກັບພາກສ່ວນຂະແໜງການ</h4>
                            </div>
                        </div>
                            </a>
                        </div>
                    @endforeach
                @else --}}
                    <div class="carousel-item active">
                        <a href="">
                            <img src="{{ asset('fontend/img/VANDALA.png') }}" class="img-fluid" alt="First slide">
                            {{-- <div class="carousel-caption">
                        <div class="container carousel-content">
                            <h4 class="maincolor mb-4  animated fadeInUp">VANDALA</h4>
                            <h4 class="animated fadeInRight">ໃຫ້ບໍລິການເງິນກູ້ໄລຍະສັ້ນ ເພື່ອສະໜັບສະໜູນເງິນທຶນ
                                ໃຫ້ແກ່ຜູ້ທີ່ດຳເນີນທຸລະກິດ ກ່ຽວກັບພາກສ່ວນຂະແໜງການ</h4>
                        </div>
                    </div> --}}
                        </a>
                    </div>

                {{-- @endif --}}



            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Fact Start -->
    <div class="container-fluid Fact ">
        <div class="container ">
            <div class="row">
                <div class="downloadApp">
                    <div class="wow fadeIn" data-wow-delay=".1s">
                        <div class="d-flex counter">
                            <a href=""><img src="{{ asset('fontend/img/appgle-app-store.png') }}" width="200"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="wow fadeIn" data-wow-delay=".1s">
                        <div class="d-flex counter">
                            <a href=""><img src="{{ asset('fontend/img/google-play-store.png') }}" width="200"
                                    alt=""></a>
                        </div>
                    </div>
                    <div class="wow fadeIn" data-wow-delay=".1s">
                        <div class="d-flex counter">
                            <a href=""> <img src="{{ asset('fontend/img/huawei-app-gallery.png') }}"
                                    width="200" alt=""></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Fact End -->

    <!-- Services Start -->
    <div class="container-fluid blog py-2 my-2">
        <div class="container  py-5">
            <div class="title" data-wow-delay=".3s" >
                <h4>{{ __('lang.our_service') }}</h4>
            </div>
            <div class="box-server">

                <div>
                    <img src="https://images.unsplash.com/photo-1701542183610-60708f7db8f7?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                    <div class="content">
                        <h6>ບໍລິການປ່ວຍເງິນກູ</h6>
                        <a href="{{ route('fontend.service_detail', 1) }}"><button>{{ __('lang.details') }}</button></a>
                    </div>
                </div>
                <div>
                    <img src="https://plus.unsplash.com/premium_photo-1701207574422-9fa92231075c?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="">
                    <div class="content">
                        <h6>ບໍລິການປ່ວຍເງິນກູ</h6>
                        <a href="{{ route('fontend.service_detail', 1) }}"><button>{{ __('lang.details') }}</button></a>
                    </div>
                </div>
            </div>
            <div class="text-center mx-auto pb-2 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <a href="{{ route('fontend.services') }}" class="text-center "><button class="btn_readmore"
                        style="margin-top: 2rem;">{{ __('lang.show_more') }}</button></a>
            </div>

        </div>
    </div>
    <!-- news -->

    <div class="container-fluid blog py-2 my-2">
        <div class="container  py-5">
            <div class="title" data-wow-delay=".3s" >
                <h4>{{ __('lang.news') }}</h4>
            </div>
            <div class="box-news">
                {{-- @if (count($news) > 0)
                    @foreach ($news as $item)
                        <div class="box">
                            <a href="{{ route('fontend.news_detail', ['id' => $item->id]) }}">
                                @if (!empty($item->image))
                                    <img src="{{ $item->image }}" alt="">
                                @else
                                    <img src="{{ asset('fontend/img/news.png') }}" alt="">
                                @endif

                                <div class="content">
                                    {!! $item->description !!}
                                    

                                </div>
                                <p class="data">{{ optional($item->created_at)->format('Y-m-d') }}</p>
                            </a>
                        </div>
                    @endforeach
                @else --}}
                <div class="box">
                    <a href="">
                        <img src="{{ asset('fontend/img/news.png') }}" alt="">

                        <div class="content">
                            <h6>ຍັງບໍມີຂໍ້ມູນ</h6>
                            <p class="data">ຍັງບໍມີຂໍ້ມູນ</p>
                        </div>
                    </a>
                </div>
                <div class="box">
                    <a href="">
                        <img src="{{ asset('fontend/img/news.png') }}" alt="">

                        <div class="content">
                            <h6>ຍັງບໍມີຂໍ້ມູນ</h6>
                            <p class="data">ຍັງບໍມີຂໍ້ມູນ</p>
                        </div>
                    </a>
                </div>
                <div class="box">
                    <a href="">
                        <img src="{{ asset('fontend/img/news.png') }}" alt="">

                        <div class="content">
                            <h6>ຍັງບໍມີຂໍ້ມູນ</h6>
                            <p class="data">ຍັງບໍມີຂໍ້ມູນ</p>
                        </div>
                    </a>
                </div>
{{-- 
                @endif --}}
            </div>
            <div class="text-center mx-auto pb-2 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <a href="{{ route('fontend.news') }}" class="text-center "><button class="btn_readmore"
                        style="margin-top: 2rem;">{{ __('lang.show_more') }}</button></a>
            </div>

        </div>
    </div>
    <!-- Services End -->
    <!-- Contact Start -->
    <div class="container-fluid py-2 mt-2">
        <div class="container py-5">
            <div class="title" data-wow-delay=".3s">
                <h4 class="text-black">{{ __('lang.contact_up') }}</h4>
            </div>
            <div class="contact-detail position-relative ">
                <div class="row g-5 mb-5 justify-content-center">
                    <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".3s">
                        <div class="d-flex bg-light p-3 rounded">
                            <div class="flex-shrink-0 btn-square rounded-circle bg-dark"
                                style="width:50px; height: 50px;">
                                <i class="fas fa-map-marker-alt maincolor"></i>
                            </div>
                            <div class="d-flex align-items-center ">
                                <a href="" style="margin-left: 1rem;" class="textblod"
                                    target="_blank">{{ __('lang.vang_vieng_village') }},
                                    {{ __('lang.vang_vieng_district') }},{{ __('lang.vientiane_province') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                        <div class="d-flex bg-light p-3 rounded">
                            <div class="flex-shrink-0 btn-square bg-dark rounded-circle"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-phone maincolor"></i>
                            </div>
                            <div class="d-flex align-items-center">
                                <a class="h5 " style="margin-left: 1rem;" href="tel:02058189995"
                                    target="_blank">02058189995</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".7s">
                        <div class="d-flex bg-light p-3 rounded">
                            <div class="flex-shrink-0 btn-square bg-dark rounded-circle"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-envelope maincolor"></i>
                            </div>
                            <div class="d-flex align-items-center">

                                <a class="h5" href="mailto:info@citgroup.la" style="margin-left: 1rem;"
                                    target="_blank">info@citgroup.la</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".3s">
                        <div class="p-2 h-100 rounded contact-map">

                            <iframe class="rounded w-100 h-100"
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d18149.55387190925!2d102.45804563541515!3d18.923352630244395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sth!2sla!4v1701856347101!5m2!1sth!2sla"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                        <div class="p-2 rounded contact-form">
                            <div class="mb-4">
                                <input type="text" class="form-control border-0 py-3"
                                    placeholder="{{ __('lang.name') }}..">
                            </div>
                            <div class="mb-4">
                                <input type="phone" class="form-control border-0 py-3"
                                    placeholder="{{ __('lang.phone') }}..">
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control border-0 py-3"
                                    placeholder="{{ __('lang.email') }}..">
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control border-0 py-3"
                                    placeholder="{{ __('lang.title_story') }}..">
                            </div>
                            <div class="mb-4">
                                <textarea class="w-100 form-control border-0 py-3" rows="6" cols="10"
                                    placeholder="{{ __('lang.content') }}.........."></textarea>
                            </div>
                            <div class="text-start">
                                <button class="btn bg-dark maincolor py-3" type="button">{{__('lang.sent_message')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
</div>
