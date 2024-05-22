<div wire:poll>

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 5px;
            bottom: 3.3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(30px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 50px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

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

        .medicine-box {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            max-width: 100%;
            padding: 1rem .2rem;
            background: rgba(216, 216, 216, 0.317);
            border-radius: 5px;





        }

        .medicine-box p {
            margin-left: .5rem;
            background: rgb(208, 235, 255);
            display: inline-block;
            padding: .2rem .5rem;
            border-radius: 5px;
        }

        .medicine-box p span {
            color: red;
            font-size: 1.2rem;
            cursor: pointer;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        ຄົນໄຂ
                        <i class="fas fa-angle-double-right"></i>
                        ລາຍລະອຽດ
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        /ລາຍລະອຽດ
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
                        <div class="card-body bg-light">
                            <div class="card-body">
                                <form>
                                    <div class="row ">
                                        <div class="col-md-3">
                                            <div class="form-group"wire:ignore>
                                                <label for="">ຄົນໄຂ້ <span class="text-danger">*</span></label>
                                                <select wire:model.live='patient_id' id="select-person"
                                                    class="form-control">
                                                    <option value="">--ກະລຸນາເລືອກຄົນໄຂ້--</option>
                                                    @foreach ($patient as $item)
                                                        <option value="{{ $item->id }}">({{ $item->code }})
                                                            {{ $item->f_name }}
                                                            {{ $item->l_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ລວງສູງ(cm)<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" wire:model='height'>
                                                @error('height')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ນໍ້າໜັກ(kg)<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" wire:model='weight'>
                                                @error('weight')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ຄວາມດັນເລືອດ<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" wire:model.live='pressure'>
                                                @if ($pressure == null)
                                                    @error('pressure')
                                                        <span style="color: red" class="error">{{ $message }}</span>
                                                    @enderror
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ກໍາມະຈອນ<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" wire:model='heartbeat'>
                                                @error('heartbeat')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ວັກແສງ</label>
                                                <input type="text" class="form-control" wire:model='vak­_saeng'>
                                                @error('vak­_saeng')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ວັນທີ່ກວດ<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" wire:model='date'>
                                                @error('date')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ທ່ານໜໍ<span class="text-danger">*</span></label>
                                                <select wire:model='doctor_id' class="form-control">
                                                    <option value="">{{ __('lang.select') }}</option>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->f_name }}
                                                            {{ $item->l_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('doctor_id')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" wire:ignore>
                                                <label for="symptom">ອາການ ຫຼື ສາເຫດທີ່ມາໂຮງໜໍ</label>
                                                <textarea type="text" class="form-control" id="symptom" wire:model="symptom" placeholder="ປ້ອມຂໍ້ມູນ"> </textarea>
                                                @error('symptom')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" wire:ignore>
                                                <label for="bongmati">ບົ່ງມະຕິ</label>
                                                <textarea type="text" class="form-control" id="bongmati" wire:model="bongmati" placeholder="ປ້ອມຂໍ້ມູນ"> </textarea>
                                                @error('bongmati')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" wire:ignore>
                                                <label>ຢາທີ່ແນະນໍາ</label>
                                                <select class="form-control " wire:change='addmedicine'
                                                    id="select-medicine">
                                                    <option value="">{{ __('lang.select') }}</option>
                                                    @foreach ($medicine as $item)
                                                        <option value="{{ $item->id }}">{{ $item->med_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class=" medicine-box">
                                                @foreach ($medicine_to_user as $item)
                                                    <p>{{ $item->med_name }} <span
                                                            wire:click='removemedicine({{ $item->id }})'>&times;</span>
                                                    </p>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>ນອນໂຮງໜໍບໍ?</label>
                                            <div class="form-group clearfix">
                                                <div class="icheck-success d-inline">
                                                    <input type="radio" id="radioPrimary3" value="no"
                                                        wire:model="check_admit">
                                                    <label for="radioPrimary3">ບໍນອນ
                                                    </label>
                                                </div>
                                                <div class="icheck-success d-inline">
                                                    <input type="radio" id="radioPrimary4" value="yes"
                                                        wire:model="check_admit">
                                                    <label for="radioPrimary4">ນອນ
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="radioPrimary5" value="1"
                                                        wire:model="appointments" checked>
                                                    <label for="radioPrimary5">ມີນັດຄັ້ງຕໍໄປບໍ
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($this->appointments)
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">ທ່ານໜໍ<span
                                                            class="text-danger">*</span></label>
                                                    <select wire:model='doctor_appointment_id' class="form-control">
                                                        <option value="">{{ __('lang.select') }}</option>
                                                        @foreach ($doctor as $item)
                                                            <option value="{{ $item->id }}">{{ $item->f_name }}
                                                                {{ $item->l_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('doctor_appointment_id')
                                                        <span style="color: red"
                                                            class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">{{ __('lang.date') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" wire:model='appointment_date'
                                                        class="form-control"
                                                        @if ($this->doctor_appointment_id == null) disabled @endif
                                                        min="{{ date('Y-m-d') }}">
                                                    @error('appointment_date')
                                                        <span style="color: red"
                                                            class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if ($appointment_date)
                                                <div class="col-md-6">
                                                    <div class="appointment_time">
                                                        @foreach ($time_list as $item)
                                                            @if ($item['status'] == 'No' && $old_time != $item['time'])
                                                                <p
                                                                    class=" @if ($appointment_time != $item['time']) no_active @endif ">
                                                                    {{ $item['time'] }}:00
                                                                </p>
                                                            @else
                                                                <p wire:click='setappointment_time({{ $item['time'] }})'
                                                                    class="@if ($appointment_time == $item['time']) active @endif">
                                                                    {{ $item['time'] }}:00
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                        {{-- <p href="" wire:click='setappointment_time(10)'
                                                            class="@if ($appointment_time == '10') active @endif">
                                                            10:00</p>
                                                        <p href="" wire:click='setappointment_time(11)'
                                                            class="@if ($appointment_time == '11') active @endif">
                                                            11:00</p>
                                                        <p href="" wire:click='setappointment_time(12)'
                                                            class="@if ($appointment_time == '12') active @endif">
                                                            12:00</p>
                                                        <p href="" wire:click='setappointment_time(13)'
                                                            class="@if ($appointment_time == '13') active @endif">
                                                            13:00</p>
                                                        <p href="" wire:click='setappointment_time(14)'
                                                            class="@if ($appointment_time == '14') active @endif">
                                                            14:00</p>
                                                        <p href="" wire:click='setappointment_time(15)'
                                                            class="@if ($appointment_time == '15') active @endif">
                                                            15:00</p>
                                                        <p href="" wire:click='setappointment_time(16)'
                                                            class="@if ($appointment_time == '16') active @endif">
                                                            16:00</p> --}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="appointment_detail">{{ __('lang.details') }}</label>
                                                    <textarea type="text" class="form-control" wire:model="appointment_detail" placeholder="ປ້ອມຂໍ້ມູນ"> </textarea>
                                                    @error('appointment_detail')
                                                        <span style="color: red"
                                                            class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                    @endif



                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('backend.treatment') }}"
                                    class="btn btn-warning">ກັບຄືນໜ້າລາຍການ</a>
                                <button wire:click="updateTreatment({{ $ID }})" type="button"
                                    style="float: right" class="btn btn-success ">ແກ້ໄຂ
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>


@push('scripts')
    <script>
        function disablePastDates(event) {
            var today = new Date().toISOString().split('T')[0];
            var inputDate = event.target.value;
            var inputField = document.getElementById("appointmentDate");

            if (inputDate < today) {
                inputField.style.cursor = "no-drop";
                inputField.setAttribute("title", "You cannot select a date that has already passed.");
            } else {
                inputField.style.cursor = "auto";
                inputField.removeAttribute("title");
            }
        }
    </script>


    <script type="text/javascript">
        $(function() {
            $('#address').summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['fm-button', ['fm']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('address', contents);
                    },
                }
            });






        });
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
            $('#select-medicine').select2();
            $('#select-medicine').on('change', function(e) {
                var data = $('#select-medicine').select2("val");
                @this.set('med_id', data);
            });
        });
    </script>
    <script>
        function ExportExcel(type, fn, dl) {
            var elt = document.getElementById('table-excel');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "Sheet JS"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('customer.' + (type || 'xlsx')));
        }
    </script>
@endpush
