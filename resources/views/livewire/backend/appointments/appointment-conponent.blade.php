<div wire:poll>
    <style>
        .appointment_time {
            display: flex;
            justify-content: flex-start;
            align-items: flex-end;
            height: 50px;
            margin-top: 2rem
        }

        .appointment_time p {
            padding: .4rem 1rem;

            border-radius: 5px;
            margin-left: 1rem;
            cursor: pointer;
            border: 1px solid rgba(80, 79, 79, 0.564)
        }

        .appointment_time p:hover,
        .appointment_time p.active {
            background: rgb(7, 165, 13);
            color: #fff;
            border-color: rgb(7, 165, 13);
        }

        .appointment_time p.no_active {
            background: rgb(255, 0, 0);
            color: #fff;
            border-color: rgb(255, 255, 255);
            cursor: no-drop;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fa fa-calendar-check text-primary"></i>
                        ການນັດໝາຍ

                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        /ການນັດໝາຍ
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="row">
                                        @if ($function_controller->check_permission('access_add_appointments') == true || auth()->user()->role_id == 1)
                                            <button class="btn btn-primary" wire:click="create">
                                                ເພີ່ມໃໝ່
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-7">

                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{ __('lang.search') }}"
                                            wire:model="search">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <select name="" id="" wire:model.live="page_number"
                                        class="form-control">
                                        <option value="10">10</option>
                                        <option value="30">30</option>
                                        <option value="100">100</option>
                                        <option value="1000">1,000</option>
                                        <option value="all">{{ __('lang.all') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive mt-2" wire:poll>
                                <table class="table table-bordered" id="table-excel">
                                    <thead>
                                        <tr>
                                            <td class="text-center">No.</td>
                                            <td>{{ __('lang.fullname') }}</td>
                                            <td>ທ່ານໜໍນັດ</td>
                                            <td class="text-center">{{ __('lang.date') }}</td>
                                            <td class="text-center">ເວລາ</td>
                                            <td class="text-center">{{ __('lang.creator') }}</td>
                                            <td class="text-center">{{ __('lang.action') }}</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($appointments as $item)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td>
                                                    <p class="bg-info mr-3"
                                                        style= "border-radius: 50%;width:40px;height:40px;line-height:40px;text-align:center; display:inline-block">
                                                        {{ substr($item->get_patient->f_name, 0, 1) }}{{ substr($item->get_patient->l_name, 0, 1) }}
                                                    </p>
                                                    {{ $item->get_patient->f_name }} {{ $item->get_patient->l_name }}
                                                </td>

                                                <td>
                                                    {{ $item->get_doctor->f_name }} {{ $item->get_doctor->l_name }}
                                                </td>
                                                <td class="text-center">

                                                    {{ date('d/m/Y', strtotime($item->date)) }}
                                                </td>
                                                <td class="text-center">

                                                    <p style="padding: .3rem 1rem;width:100px;margin:0 auto;border-radius:5px"
                                                        class="bg-info">{{ $item->time }}:00</p>
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->get_creator->f_name }}
                                                    {{ !empty($item->get_creator->l_name) ? $item->get_creator->l_name : '' }}
                                                </td>
                                                <td class="text-center">
                                                    {{-- <a wire:click="showdetail({{ $item->id }})"
                                                    type="button" class="btn btn-info btn-sm">
                                                    <i  class="fa fa-eye"></i>
                                                </a> --}}
                                                    @if ($function_controller->check_permission('access_update_appointments') == true || auth()->user()->role_id == 1)
                                                        <a wire:click="showUpdate({{ $item->id }})" type="button"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-pencil"></i>

                                                        </a>
                                                    @endif
                                                    @if ($function_controller->check_permission('access_delete_appointments') == true || auth()->user()->role_id == 1)
                                                        <a wire:click="showDestroy({{ $item->id }})" type="button"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach




                                    </tbody>

                                </table>
                                {{-- @if ($this->page_number != 'all')
                                    <div class="float-right">
                                        {{ $data->links('livewire.backend.pagination.pagination-component') }}
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.modal-add -->

    <!-- /.modal-delete-->
    <div class="modal fade" id="modal-delete" wire:ignore.self>
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
                    <button wire:click="Destroy()" type="button"
                        class="btn btn-success">{{ __('lang.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.modal-add -->
    <div wire:ignore.self class="modal fade" id="modal-add">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    @if ($hiddenId)
                        <h4 class="modal-title second-web-color"> {{ __('lang.edit') }}</h4>
                    @else
                        <h4 class="modal-title second-web-color"> {{ __('lang.add') }}</h4>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"wire:ignore>
                                        <label for="">ຄົນໄຂ້ <span class="text-danger">*</span></label>
                                        <select wire:model.live='patient_id' id="select-person" class="form-control">
                                            <option value="">--ກະລຸນາເລືອກຄົນໄຂ້--</option>
                                            @foreach ($patient as $item)
                                                <option value="{{ $item->id }}">({{ $item->code }})
                                                    {{ $item->f_name }}
                                                    {{ $item->l_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('patient_id')
                                        <span style="color: red;" class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" wire:ignore>
                                        <label>ທ່ານໝໍ<span class="text-danger">*</span></label>
                                        <select name="" wire:model='doctor_id' id="select-doctor"
                                            class="form-control">
                                            <option value="">ເລືອກທ່ານໝໍ</option>
                                            @foreach ($doctor as $item)
                                                <option value="{{ $item->id }}">({{ $item->code }})
                                                    {{ $item->f_name }}
                                                    {{ $item->l_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    @error('doctor_id')
                                        <span style="color: red" class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{ __('lang.date') }}<span
                                                class="text-danger">*</span></label>
                                        <input type="date" wire:model='appointment_date' class="form-control"
                                            @if ($this->doctor_id == null) disabled @endif
                                            min="{{ date('Y-m-d') }}">
                                        @error('appointment_date')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                @if ($appointment_date)
                                    <div class="col-md-12">
                                        <div class="appointment_time">
                                            @foreach ($time_list as $item)
                                                @if ($item['status'] == 'No' && $old_time != $item['time'])
                                                    <p class=" @if ($appointment_time != $item['time']) no_active @endif ">
                                                        {{ $item['time'] }}:00
                                                    </p>
                                                @else
                                                    <p wire:click='setappointment_time({{ $item['time'] }})'
                                                        class="@if ($appointment_time == $item['time']) active @endif">
                                                        {{ $item['time'] }}:00
                                                    </p>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="appointment_detail">{{ __('lang.details') }}</label>
                                        <textarea type="text" class="form-control" wire:model="appointment_detail" placeholder="ປ້ອມຂໍ້ມູນ"> </textarea>
                                        @error('appointment_detail')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('lang.cancel') }}</button>
                    @if ($hiddenId)
                        <button wire:click="Update({{ $hiddenId }})" type="button"
                            class="btn btn-warning">{{ __('lang.edit') }}</button>
                    @else
                        <button wire:click="Store" type="button"
                            class="btn btn-primary">{{ __('lang.save') }}</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('show-modal-add', (event) => {
                $('#modal-add').modal('show');
            });
        });
        document.addEventListener('livewire:initialized', () => {
            @this.on('hide-modal-add', (event) => {
                $('#modal-add').modal('hide');
            });
        });
        //Delete
        window.addEventListener('show-modal-delete', event => {
            $('#modal-delete').modal('show');
        })
        window.addEventListener('hide-modal-delete', event => {
            $('#modal-delete').modal('hide');
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#select-person').select2();
            $('#select-person').on('change', function(e) {
                var data = $('#select-person').select2("val");
                @this.set('patient_id', data);
            });
        });
        $(document).ready(function() {
            $('#select-doctor').select2();
            $('#select-doctor').on('change', function(e) {
                var data = $('#select-doctor').select2("val");
                @this.set('doctor_id', data);
            });
        });
    </script>
@endpush
