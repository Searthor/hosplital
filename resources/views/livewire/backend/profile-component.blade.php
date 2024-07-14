<div wire:poll>
    {{-- ======================================== header page ====================================================== --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4><i class="fas fa-user-tie"></i> {{ __('lang.profile') }} </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('lang.profile') }} </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-md-8">
                    <!-- Profile Image -->
                    <div class="card card-dark card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('images/logo.png') }}"
                                    alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ auth()->user()->fullname }}</h3>

                            <p class="text-muted text-center">{{ auth()->user()->username }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ __('lang.roles') }} : </b> <a class="float-center">
                                        @if (!empty(auth()->user()->role_id))
                                            {{ auth()->user()->get_role->name }}
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('lang.address') }} : </b> <a class="float-center">
                                        @if (!empty(auth()->user()->village))
                                            {{ auth()->user()->village->name_la }},
                                        @endif
                                        @if (!empty(auth()->user()->district))
                                            {{ auth()->user()->district->name_la }},
                                        @endif
                                        @if (!empty(auth()->user()->province))
                                            {{ auth()->user()->province->name_la }},
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('lang.phone') }} : </b> <a class="float-center">
                                        {{ auth()->user()->phone }}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('lang.branch') }} : </b> <a class="float-center">
                                        @if (Config::get('app.locale') == 'lo')
                                            @if (!empty(auth()->user()->branch))
                                                {{ auth()->user()->branch->name_la }}
                                            @endif
                                        @elseif(Config::get('app.locale') == 'en')
                                            @if (!empty(auth()->user()->branch))
                                                {{ auth()->user()->branch->name_en }}
                                            @endif
                                        @else
                                            @if (!empty(auth()->user()->branch))
                                                {{ auth()->user()->branch->name_cn }}
                                            @endif
                                        @endif
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ __('lang.service_units') }} : </b> <a class="float-center">
                                        @if (Config::get('app.locale') == 'lo')
                                            @if (!empty(auth()->user()->service_unit))
                                                {{ auth()->user()->service_unit->name_la }}
                                            @endif
                                        @elseif(Config::get('app.locale') == 'en')
                                            @if (!empty(auth()->user()->service_unit))
                                                {{ auth()->user()->service_unit->name_en }}
                                            @endif
                                        @else
                                            @if (!empty(auth()->user()->service_unit))
                                                {{ auth()->user()->service_unit->name_cn }}
                                            @endif
                                        @endif
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div> --}}
                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body  p-4">
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName"
                                            class="col-sm-4 col-form-label">{{ __('lang.firstname') }} </label>
                                        <input type="text" wire:model="firstname" class="form-control" id="inputName"
                                            placeholder="{{ __('lang.firstname') }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-4 col-form-label">{{ __('lang.lastname') }}
                                        </label>
                                        <input type="text" wire:model="lastname" class="form-control" id="inputName"
                                            placeholder="{{ __('lang.lastname') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-4 col-form-label">{{ __('lang.email') }}
                                        </label>
                                        <input type="email" wire:model="email" class="form-control" id="inputName"
                                            placeholder="{{ __('lang.email') }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-4 col-form-label">{{ __('lang.phone') }}
                                        </label>
                                        <input type="number" wire:model="phone" class="form-control"
                                            placeholder="{{ __('lang.phone') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">ວັນເດືອນປີເກິດ </label>
                                        <input type="date" wire:model='birthday' class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">ເພດ </label>
                                        <input type="text" wire:model='gender' class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">ສະຖານະ </label>
                                        <input type="text" wire:model='status' class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">{{ __('lang.province') }} </label>
                                        <select class="form-control" wire:model.live="pro_id" id="inputName2">
                                            <option value="">{{ __('lang.province') }}</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{ $item->id }}">
                                                    @if (Config::get('app.locale') == 'lo')
                                                        {{ $item->name_la }}
                                                    @elseif(Config::get('app.locale') == 'en')
                                                        {{ $item->name_en }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">{{ __('lang.district') }} </label>
                                        <select class="form-control" wire:model.live="dis_id" id="inputName2">
                                            <option value="">{{ __('lang.district') }}</option>
                                            @foreach ($districts as $item)
                                                <option value="{{ $item->id }}">
                                                    @if (Config::get('app.locale') == 'lo')
                                                        {{ $item->name_la }}
                                                    @elseif(Config::get('app.locale') == 'en')
                                                        {{ $item->name_en }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">{{ __('lang.village') }} </label>
                                        <input type="text" wire:model='village' class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">{{ __('lang.password') }}ເກົ່າ </label>

                                        <input type="password" wire:model="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror" 
                                            placeholder="ປ້ອນຂໍ້ມູນ">
                                        @error('old_password')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-4 col-form-label">{{ __('lang.password') }} ໃໝ່</label>

                                        <input type="password" wire:model="password"
                                            class="form-control @error('password') is-invalid @enderror" id="inputName2"
                                            placeholder="ປ້ອນຂໍ້ມູນ">
                                        @error('password')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputName2"
                                            class="col-sm-12 col-form-label">{{ __('lang.confirm_password') }}ໃໝ່
                                        </label>
                                        <input type="password" wire:model="confirmpassword"
                                            class="form-control @error('confirmpassword') is-invalid @enderror"
                                            id="inputName2" placeholder="ປ້ອນຂໍ້ມູນ">
                                        @error('confirmpassword')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-info">
                            <button type="button" wire:click="updateProfile" class="btn btn-success"><i
                                    class="fas fa-edit"></i>
                                {{ __('lang.profile') }} </button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
