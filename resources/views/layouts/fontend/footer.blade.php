<div class="container-fluid footer wow fadeIn" data-wow-delay=".3s">
    <div class="container pt-5 pb-4">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <a href="index.html">
                    <img src="{{ asset('fontend/img/logo.png')}}" style="width: 60px; height: 60px;" alt="">
                </a>
                <p class="mt-4 text-light">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta
                    voluptatem sint voluptatum, itaque rem adipisci culpa voluptatibus tempora ipsum libero omnis
                    vel ratione consequuntur nam obcaecati voluptas unde eos. Magnam, saepe totam. Quis facere atque
                    animi a perspiciatis necessitatibus mollitia?</p>
                <div class="d-flex hightech-link">
                    <a href="https://www.facebook.com/profile.php?id=100063573279633" target="_back" class="bmaincolor nav-fill btn btn-square rounded-circle me-2"><i
                            class="fab fa-facebook-f text-light"></i></a>
                    <a href="" class="bmaincolor nav-fill btn btn-square rounded-circle me-2"><i
                            class="fab fa-twitter text-light"></i></a>
                    <a href="" class="bmaincolor nav-fill btn btn-square rounded-circle me-2"><i
                            class="fab fa-instagram text-light"></i></a>
                    <a href="" class="bmaincolor nav-fill btn btn-square rounded-circle me-0"><i
                            class="fab fa-linkedin-in text-light"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <a href="#" class="h3 text-white">Short Link</a>
                <div class="mt-4 d-flex flex-column short-link">
                    <a href="{{route('fontend.about')}}" class="mb-2 text-white"><i
                            class="fas fa-angle-right text-white me-2"></i>{{__('lang.about')}}</a>
                    <a href="{{route('fontend.contact')}}" class="mb-2 text-white"><i
                            class="fas fa-angle-right text-white me-2"></i>{{__('lang.contact')}}</a>
                    <a href="{{route('fontend.services')}}" class="mb-2 text-white"><i
                            class="fas fa-angle-right text-white me-2"></i>{{__('lang.service')}}</a>
                    <a href="{{route('fontend.news')}}" class="mb-2 text-white"><i
                        class="fas fa-angle-right text-white me-2"></i>{{__('lang.news')}}</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <h3 class="text-white">{{__('lang.contact_up')}}</h3>
                <div class="text-white mt-4 d-flex flex-column contact-link">
                    <a href="#" class="pb-3 text-light border-bottom border-warning"><i
                            class="fas fa-map-marker-alt text-white me-2"></i> {{__('lang.vang_vieng_village')}}, {{__('lang.vang_vieng_district')}},{{__('lang.vientiane_province')}}</a>
                    <a href="#" class="py-3 text-light border-bottom border-warning"><i
                            class="fas fa-phone-alt text-white me-2"></i> 02054894444</a>
                    <a href="#" class="py-3 text-light border-bottom border-warning"><i
                            class="fas fa-envelope text-white me-2"></i> info@vandala.la</a>
                </div>
            </div>
        </div>
    </div>
</div>