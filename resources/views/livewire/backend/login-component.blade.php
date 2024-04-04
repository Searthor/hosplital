<div class="box-contener">
    <div class="forms">
        <div class="logo" >
            <img src="{{ asset('fontend/img/logo1.png')}}"  alt="">
        </div>
        <div class="box1"></div>
        <h2>{{__('lang.your_welcome')}}</h2>
        <div class="box2"></div>
        <div class="form">
            <input type="text" wire:model="phone" wire:keydown.enter="login" class="form-control @error('phone') is-invalid @enderror" placeholder="{{(__('lang.phone'))}}">
            @error('phone')
            <span style="color: red" class="error">{{ $message }}</span>
            @enderror
            <input type="password" wire:model="password" wire:keydown.enter="login" class="form-control @error('password') is-invalid @enderror" placeholder="{{(__('lang.password'))}}">
            @error('password')
            <span style="color: red" class="error">{{ $message }}</span>
            @enderror
            <div class="row mt-1" >
                <div class="col-8">
                    <div class="remember">
                        <input type="checkbox" style="width:20px;height:20px ; accent-color: #194bff;" id="remember" wire:model="remember">
                        <label for="remember">
                            {{__('lang.remember_me')}}
                        </label>
                    </div>
                </div>
            </div>
            <button class="custom-btn btn-9" wire:click="login"> {{__('lang.login')}} <i class="fa fa-sign-in-alt"></i></button>
        </div>
    </div>

</div>

{{-- <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-yellow">
        <div class="card-header text-center">
            <a href="#" class="h4">{{(__('lang.wel_come'))}}</a>
        </div>
        <div class="card-body">
            <a href="#" class="text-center brand-link">
                <img src="{{ asset('images/logo.png') }}" class="img-circle elevation-2" height="150"> <br>
            </a>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                <input type="text" wire:model="phone" wire:keydown.enter="login" class="form-control @error('phone') is-invalid @enderror" placeholder="{{(__('lang.phone'))}}">

            </div>
            @error('phone')
            <span style="color: red" class="error">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                <input type="password" wire:model="password" wire:keydown.enter="login" class="form-control @error('password') is-invalid @enderror" placeholder="{{(__('lang.password'))}}">
            </div>
            @error('password')
            <span style="color: red" class="error">{{ $message }}</span>
            @enderror
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" wire:model="remember">
                        <label for="remember">
                            {{__('lang.remember_me')}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="social-auth-links text-center mt-2 mb-3">
                <button wire:click="login" class="btn btn-block" style="background:#000; color:gold">
                    <i class="fa fa-sign-in-alt"></i> {{__('lang.login')}}
                </button>
            </div>
            <!-- /.social-auth-links -->

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box --> --}}