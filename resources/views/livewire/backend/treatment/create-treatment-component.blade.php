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
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        ຄົນໄຂ
                        <i class="fas fa-angle-double-right"></i>
                        ອາການເບື້ອງຕົ້ນ
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        /ອາການເບື້ອງຕົ້ນ
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
                                                    @foreach ($data as $item)
                                                        <option value="{{ $item->id }}">({{$item->code}}) {{ $item->f_name }}
                                                            {{ $item->l_name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            {{-- @error('patient_id')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                            @enderror --}}

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
                                                <label for="">ນໍ້າໜັກ(kg)<span class="text-danger">*</span></label>
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
                                                <input type="number" class="form-control" wire:model.live='pressure'>
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
                                                <input type="text" class="form-control" wire:model='hearbeat'>
                                                @error('hearbeat')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">ວັກແສງ<span class="text-danger">*</span></label>
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
                                                <label for="">ທ່ານໜໍ<span
                                                        class="text-danger">*</span></label>
                                                <select wire:model='doctor_id' class="form-control">
                                                    <option value="">{{__('lang.select')}}</option>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{$item->id}}">{{$item->f_name}} {{$item->l_name}}</option>
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
                                    <div class="row">
                                        <div class="col-md-2" style="display: flex;gap:1rem">

                                            <label class="switch">
                                                <input type="checkbox" wire:model='old_new'>
                                                <span class="slider round"></span>

                                            </label>
                                            <h4>ຄົນໄຂ້ເກົ່າ</h4>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('backend.treatment') }}" class="btn btn-warning">ກັບຄືນໜ້າລາຍການ</a>
                                <button wire:click="storeStore" type="button" style="float: right"
                                    class="btn btn-success ">{{ __('lang.save') }}
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


        $('#print').click(function() {
            printDiv();

            function printDiv() {
                var printContents = $(".print-content").html();
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
            location.reload();
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
