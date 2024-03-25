<div wire:poll>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        {{ __('lang.settings') }}
                        <i class="fas fa-angle-double-right"></i>
                        {{ __('lang.users') }}
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('lang.users') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!--customers -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                @if ($function_controller->check_permission('access_add_user') == true || auth()->user()->role_id == 1)
                                    <div class="col-md-2">
                                        <a wire:click="create" class="btn btn-primary" href="javascript:void(0)"><i
                                                class="fa fa-plus-circle"></i> {{ __('lang.add') }}</a>
                                    </div>
                                @else
                                    <div class="col-md-2"></div>
                                @endif
                                <div class="col-md-6"></div>
                                <div class="col-md-4">
                                    <input wire:model.live="search" type="text" class="form-control"
                                        onfocus="this.value=''" placeholder="{{ __('lang.search') }}">
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-1">
                                <div class="col-md-1">
                                    <select firstname="" id="" wire:model.live="page_number"
                                        class="form-control">
                                        <option value="10">10</option>
                                        <option value="30">30</option>
                                        <option value="100">100</option>
                                        <option value="1000">1,000</option>
                                        <option value="all">{{ __('lang.all') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>{{ __('lang.no') }}</th>
                                            <th>{{ __('lang.code') }}</th>
                                            <th>{{ __('lang.firstname') }}</th>
                                            <th>{{ __('lang.lastname') }}</th>
                                            <th>{{ __('lang.phone') }}</th>
                                            <th>{{ __('lang.birthday') }}</th>
                                            <th>{{ __('lang.roles') }}</th>
                                            <th>{{ __('lang.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr style="text-align: center">
                                                <td>
                                                    @if ($this->page_number == 'all')
                                                        {{ $stt++ }}
                                                    @else
                                                        {{ ($data->currentPage() - 1) * $this->page_number + $stt++ }}
                                                    @endif
                                                </td>
                                                <td><a href="" style="background: rgba(194, 255, 247, 0.338);padding:0rem 1rem;border-radius: 5px;">{{ $item->code }}</a></td>
                                                <td>
                                                    {{ $item->f_name }}
                                                </td>
                                                <td>
                                                    {{ $item->l_name }}
                                                </td>
                                                <td>
                                                    {{ $item->phone }}
                                                </td>
                                                <td>
                                                    {{ $item->birthday }}
                                                </td>
                                                <td>
                                                    {{ !empty($item->get_role->name) ? $item->get_role->name : '' }}
                                                </td>

                                                <td>
                                                    @if ($function_controller->check_permission('access_edit_user') == true || auth()->user()->role_id == 1)
                                                        <button wire:click="edit({{ $item->id }})" type="button"
                                                            class="btn btn-warning"><i class="fas fa-pen"></i></button>
                                                    @endif

                                                    @if ($function_controller->check_permission('access_delete_user') == true || auth()->user()->role_id == 1)
                                                        <button wire:click="showDestroy({{ $item->id }})"
                                                            type="button" class="btn btn-danger"> <i
                                                                class="fa fa-trash"></i></button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @if ($this->page_number != 'all')
                                    <div class="float-right">
                                        {{ $data->links('livewire.backend.pagination.pagination-component') }}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.modal-add -->
    <div wire:ignore.self class="modal fade" id="modal-add">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">
                        @if ($this->hiddenId)
                            {{ __('lang.edit') }}
                        @else
                            ເພີ່ມໃໝ່
                        @endif
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" wire:model="hiddenId">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{ __('lang.firstname') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="firstname"
                                    placeholder="{{ __('lang.firstname') }}">
                                @error('firstname')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for=""> {{ __('lang.lastname') }}</label>
                                <input type="text" class="form-control" wire:model="lastname"
                                    placeholder="{{ __('lang.lastname') }}">
                                @error('lastname')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('lang.gender') }}<span class="text-danger">*</span></label>
                                <select wire:model='gender' class="form-control">
                                    <option value="">ກະລຸນາເລືອກຂໍ້ມູນ</option>
                                    <option value="male">ຊາຍ</option>
                                    <option value="female">ຍິງ</option>
                                    <option value="ອື່ນໆ">ອື່ນໆ</option>
                                </select>
                                @error('gender')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('lang.birthday') }}<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" wire:model="birthday"
                                    placeholder="{{ __('lang.birthday') }}">
                                @error('birthday')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('lang.status_life') }}</label>
                                <select wire:model='status' class="form-control">
                                    <option value="">{{ __('lang.select') }}</option>
                                    <option value="ໂສດ">ໂສດ</option>
                                    <option value="ແຕ່ງງານແລ້ວ">ແຕ່ງງານແລ້ວ</option>
                                    <option value="ໄໝ້">ໄໝ້</option>
                                    <ອoption value="ອື່ນໆ">ອື່ນໆ</option>
                                </select>
                                @error('status')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('lang.nationality') }}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="nationality"
                                    placeholder="{{ __('lang.nationality') }}"
                                   >
                                @error('nationality')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{__('lang.ethnicity')}}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="ethnicity"
                                    placeholder="{{ __('lang.ethnicity') }}" 
                                  >
                                @error('ethnicity')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>

                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('lang.phone') }}<span class="text-danger">*</span> 
                                </label>
                                <input type="text" class="form-control" wire:model="phone"
                                    placeholder="{{ __('lang.phone') }}">
                                @error('phone')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    {{ __('lang.province') }}</label>
                                <select class="form-control" wire:model.live="pro_id">
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
                                @error('pro_id')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    {{ __('lang.district') }}</label>
                                <select class="form-control" wire:model.live="dis_id">
                                    <option value="">{{ __('lang.district') }}</option>
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($this->dis_id == $item->id) selected @endif>
                                            @if (Config::get('app.locale') == 'lo')
                                                {{ $item->name_la }}
                                            @elseif(Config::get('app.locale') == 'en')
                                                {{ $item->name_en }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('dis_id')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    {{ __('lang.village') }}</label>
                                <input type="text" wire:model='village' class="form-control" placeholder="{{ __('lang.village') }}.....">
                                @error('village')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    {{ __('lang.department') }}<span class="text-danger">*</span></label>
                                <select type="text" class="form-control" wire:model.live="department_id"
                                    id="department_id">
                                    <option value="">{{ __('lang.select') }}</option>
                                    @foreach ($depament as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->dep_name_la }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    {{ __('lang.roles') }}<span class="text-danger">*</span></label>
                                <select type="text" class="form-control" wire:model.live="role_id"
                                    id="role_id">
                                    <option value="">{{ __('lang.select') }}</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    {{ __('lang.password') }}<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" wire:model="password"
                                    placeholder="{{ __('lang.password') }}">
                                @error('password')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">
                                    {{ __('lang.confirm_password') }}<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" wire:model="confirm_password"
                                    placeholder="{{ __('lang.confirm_password') }}">
                                @error('confirm_password')
                                    <span style="color: red"
                                        class="error">{{ __('lang.please_fill_information_first') }}</span>
                                @enderror
                            </div>
                        </div>
                      
                    </div>
                    <div>
                        @if ($this->image)
                            <div class="p-1" style="overflow:hidden; width: 150px;height:150px;">
                                <img src="{{ $image->temporaryUrl() }}" width="100%;"
                                    height="100%;" style="object-fit: cover">
                            </div>
                 
                        @else
                            @if ($this->old_image)
                                <div class="p-2"
                                    style="overflow:hidden; width: 150px;height:150px;">
                                    <img src="{{ asset($this->old_image) }}" width="100%;"
                                        height="100%;" style="object-fit: cover">

                                </div>
                       
                            @endif
                        @endif
                    </div>
                    <div class="row">
                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('lang.image') }}</label>
                                <input type="file" class="form-control" wire:model="image"
                                    placeholder="{{ __('lang.confirm_password') }}">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('lang.cancel') }}</button>
                    <button wire:click="Store" type="button" class="btn btn-primary">{{ __('lang.save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-delete-->
    <div wire:ignore.self class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title"><i class="fa fa-trash"> </i> {{ __('lang.delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h3 class="text-center">{{ __('lang.do_you_want_to_delete') }}</h3>
                </div>
                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-primary"
                        data-dismiss="modal">{{ __('lang.cancel') }}</button>
                    <button wire:click="destroy({{ $hiddenId }})" type="button"
                        class="btn btn-success">{{ __('lang.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#branch_id').select2();
            $('#branch_id').on('change', function(e) {
                var data = $('#branch_id').select2("val");
                @this.set('branch_id', data);
            });
            $('#select_branch_id').select2();
            $('#select_branch_id').on('change', function(e) {
                var data = $('#select_branch_id').select2("val");
                @this.set('select_branch_id', data);
            });
        });
        document.addEventListener('livewire:initialized', function() {
            Livewire.on('role_id', () => {
                initSelectDrop();
            });

            function initSelectDrop() {
                $('#role_id').select2({
                    placeholder: '@lang('lang.select')',
                    allowClear: true
                });
                $('#role_id').on('change', function(e) {
                    var data = $(this).val();
                    @this.set('role_id', data);
                });
            }
            initSelectDrop();
        });
        document.addEventListener('livewire:initialized', () => {
            @this.on('show-modal-add', (event) => {
                $('#modal-add').modal('show');
            });
        });
        document.addEventListener('livewire:initialized', () => {
            @this.on('show-modal-hide', (event) => {
                $('#modal-add').modal('hide');
            });
        });

        function validateNumber(evt) {
            var theEvent = evt || window.event;
            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        //Delete
        window.addEventListener('show-modal-delete', event => {
            $('#modal-delete').modal('show');
        })
        window.addEventListener('hide-modal-delete', event => {
            $('#modal-delete').modal('hide');
        })
    </script>
@endpush
