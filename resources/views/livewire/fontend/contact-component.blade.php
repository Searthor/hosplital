<div>
    <div class="location">
        <p><a href="{{route('/')}}">{{__('lang.home')}}</a> / {{__('lang.contact')}}</p>
    </div>
    <!-- Contact Start -->
    <div class="container-fluid py-2 mt-2">
        <div class="container py-5">
            <div class="title" data-wow-delay=".3s">
                <h4 class="text-black">{{__('lang.contact_up')}}</h4>
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
                                target="_blank">{{__('lang.vang_vieng_village')}}, {{__('lang.vang_vieng_district')}},{{__('lang.vientiane_province')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 wow fadeIn" data-wow-delay=".5s">
                        <div class="d-flex bg-light p-3 rounded">
                            <div class="flex-shrink-0 btn-square bg-dark rounded-circle"
                                style="width: 50px; height: 50px;">
                                <i class="fa fa-phone  maincolor"></i>
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
                                <input type="text" class="form-control border-0 py-3" placeholder="{{__('lang.name')}}..">
                            </div>
                            <div class="mb-4">
                                <input type="phone" class="form-control border-0 py-3" placeholder="{{__('lang.phone')}}..">
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control border-0 py-3" placeholder="{{__('lang.email')}}..">
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control border-0 py-3" placeholder="{{__('lang.title_story')}}..">
                            </div>
                            <div class="mb-4">
                                <textarea class="w-100 form-control border-0 py-3" rows="6" cols="10" placeholder="{{__('lang.content')}}.........."></textarea>
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

    {{-- service unit --}}
    <div class="container-fluid py-2 mt-2">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeIn" data-wow-delay=".3s" style="max-width: 600px;">
                <h2 class="text-black">{{__('lang.service_unit')}}</h2>
            </div>
            <div class="box-branch-service">
                @foreach ($service_unit as $item)
                    <div class="box">
                        <img src="{{asset('fontend/img/serviceunit.png')}}"
                            alt="">
                        <div class="content">
                            <h5>{{__('lang.service_units')}}: 
                                @if(Config::get('app.locale') =='lo')
                                {{$item->name_la}}
                                @elseif(Config::get('app.locale') =='en')
                                {{$item->name_en}}
                                @else
                                {{$item->name_cn}}
                                @endif
                            </h5>
                            <p>{{__('lang.village')}}:
                                @if(Config::get('app.locale') =='lo')
                                {{$item->village->name_la}}
                                @elseif(Config::get('app.locale') =='en')
                                {{$item->village->name_en}}
                                @else
                                {{$item->village->mane_cn}}
                                @endif
                                
                            </p>
                            <p>{{__('lang.district')}}:
                                @if(Config::get('app.locale') =='lo')
                                {{$item->district->name_la}}
                                @elseif(Config::get('app.locale') =='en')
                                {{$item->district->name_en}}
                                @else
                                {{$item->district->name_cn}}
                                @endif
                               
                            </p>
                            <p>{{__('lang.province')}}:
                                @if(Config::get('app.locale') =='lo')
                                {{$item->province->name_la}}
                                @elseif(Config::get('app.locale') =='en')
                                {{$item->province->name_en}}
                                @else
                                {{$item->province->name_cn}}
                                @endif
                                
                            </p>
                            <p>{{__('lang.phone')}}:{{$item->phone}}</p>
                            <a href="https://www.google.com/maps?q={{$item->latitude}},{{$item->longitude}}" target="_blank"
                                class="button">{{__('lang.open_map')}}</a>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="float-left pagination">
                {{$service_unit->links('livewire.backend.pagination.pagination-component')}}
            </div>
        </div>
       
    </div>
 

 
</div>
