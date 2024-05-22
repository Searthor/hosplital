<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        ຄົນໄຂ
                        <i class="fas fa-angle-double-right"></i>
                        ຄົນໄຂ
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                       ຄົນໄຂ
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
                                        @if (
                                            $function_controller->check_permission('access_add_patient') == true ||
                                                auth()->user()->role_id == 1
                                               )
                                            <div class="col-md-4">
                                                <button class="btn btn-primary" wire:click="create">
                                                    {{ __('lang.add') }}
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-7">

                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                            placeholder="{{ __('lang.search') }}" wire:model="search">
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
                                        <tr class="text-center">
                                            <td>No.</td>
                                            <td>ລະຫັດCode</td>
                                            <td>ຊື່ ແລະ ນາມສະກຸນ</td>
                                            <td>{{ __('lang.gender') }}</td>
                                            <td>{{ __('lang.birthday') }}</td>
                                            <td>{{ __('lang.phone') }}</td>
                                            <td>{{ __('lang.job') }}</td>
                                            <td>ສັນຊາດ</td>
                                            <td>{{ __('lang.village') }}</td>
                                            <td>{{ __('lang.district') }}</td>
                                            <td>{{ __('lang.province') }}</td>
                                            <td>{{ __('lang.action') }}</td>

                                        </tr>
                                    </thead>

                                    <tbody class="text-center">

                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td><a href="{{route('backend_patient_list',['id'=>$item->id])}}" style="background: rgba(194, 255, 247, 0.338);padding:0rem 1rem;border-radius: 5px;">{{ $item->code }}</a></td>
                                                <td>{{ $item->f_name }} {{ $item->l_name }}</td>
                                                <td>
                                                    @if ($item->gender == 'man')
                                                        {{ __('lang.man') }}
                                                    @endif
                                                    @if ($item->gender == 'women')
                                                        {{ __('lang.women') }}
                                                    @endif
                                                    @if ($item->gender == 'another')
                                                        {{ __('lang.another') }}
                                                    @endif
                                                </td>
                                                <td>{{ date('d/m/Y', strtotime($item->birthday)) }}</td>
                                                
                                                <td>{{ $item->phone }}</td>
                                                <td>{{$item->job}}
                                                </td>
                                                <td>{{$item->nationality}}</td>
                                                <td>
                                                    {{$item->village}}
                                                </td>
                                                <td>
                                                    {{$item->district->name_la}}
                                                </td>
                                                <td>
                                                    {{$item->province->name_la}}
                                                </td>
                                                <td>
                                                    @if (
                                                        $function_controller->check_permission('access_edit_patient') == true ||
                                                            auth()->user()->role_id == 1)
                                                        <button wire:click="edit({{ $item->id }})" type="button"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="fas fa-pencil-alt"></i></button>
                                                    @endif
                                                    @if (
                                                        $function_controller->check_permission('access_delete_patient') == true ||
                                                            auth()->user()->role_id == 1 
                                                            )
                                                        <button wire:click="showDestroy({{ $item->id }})"
                                                            type="button" class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
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
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    @if ($hiddenId)
                        <h4 > {{ __('lang.edit') }}</h4>
                    @else
                        <h4 > {{ __('lang.add') }}</h4>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('lang.name') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='first_name' placeholder="{{__('lang.name')}}">
                                        @error('first_name')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('lang.lastname') }}<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='last_name' placeholder="{{__('lang.lastname')}}">
                                        @error('last_name')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('lang.birthday') }}<span class="text-danger">*</ເspan></label>
                                        <input type="date" class="form-control" wire:model.live='birthday'>
                                        @error('birthday')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('lang.gender') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model.live='gender'>
                                            <option value="">--{{ __('lang.select') }}
                                                {{ __('lang.gender') }}--</option>
                                            <option value="women">{{ __('lang.women') }}</option>
                                            <option value="man">{{ __('lang.man') }}</option>
                                            <option value="another">{{ __('lang.another') }}</option>
                                        </select>
                                        @error('gender')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ສັນຊາດ<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" wire:model.live='nationality' placeholder="ສັນຊາດ">
                                        @error('nationality')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ຊົນເຜົ່າ</label>
                                        <input type="text" class="form-control" wire:model.live='ethnicity' placeholder="ຊົນເຜົ່າ">
                                        @error('ethnicity')
                                        <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ອາຊິບ</label>
                                        <input type="text" class="form-control" wire:model.live='job' placeholder="ສັນຊາດ">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('lang.status_life') }}<span class="text-danger">*</span></label>
                                        <select class="form-control" wire:model.live='status'>
                                            <option value="">--{{ __('lang.select') }}
                                                {{ __('lang.status_life') }}--</option>
                                            <option value="1">{{ __('lang.single') }}</option>
                                            <option value="2">{{ __('lang.married') }}</option>
                                        </select>
                                        @error('status')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{ __('lang.phone') }}<span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" wire:model.live='phone' placeholder="{{__('lang.phone')}}">
                                        @error('phone')
                                            <span style="color: red" class="error">{{ $message }}</span>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('lang.identity_card_census_number')}}</label>
                                        <input type="text" class="form-control"
                                            wire:model.live='number_doc_person' placeholder="{{__('lang.identity_card_census_number')}}">
                                        @error('number_doc_person')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__('lang.name_out')}}</label>
                                        <input type="text" class="form-control"
                                            wire:model.live='doc_person_name' placeholder="{{__('lang.name_out')}}">
                                        @error('out_doc_person_name')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__('lang.date_of_issue')}}</label>
                                        <input type="date" class="form-control" wire:model.live='doc_person_date'>
                                        @error('doc_person_date')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__('lang.province')}}</label>
                                       <select name="" id="" class="form-control">
                                            <option value="">{{__('lang.select')}} {{__('lang.province')}}</option>
                                       </select>
                                        @error('detail')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                
                            </div>
                            <h2>ຂໍ້ມູນຕິດຕໍ່ສໍາຮອງ</h2>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__('lang.fullname')}}</label>
                                        <input type="text" class="form-control"
                                            wire:model.live='contact_name' placeholder="{{__('lang.fullname')}}">
                                        @error('contact_name')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>ສາຍພົວພັນ</label>
                                        <select wire:model.live='contact_relationship' class="form-control">
                                            <option value="">{{__('lang.select')}}</option>
                                            <option value="ພໍ່">ພໍ່</option>
                                            <option value="ແມ່">ແມ່</option>
                                            <option value="ອ້າຍ">ອ້າຍ</option>
                                            <option value="ເອື້ອຍ">ເອື້ອຍ</option>
                                            <option value="ນ້ອງ">ນ້ອງ</option>
                                            <option value="ອື່ນໆ">ອື່ນໆ</option>
                                        </select>
                                        @error('contact_relationship')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                              
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__('lang.phone')}}</label>
                                        <input type="text" class="form-control" wire:model.live='contact_phone'>
                                        @error('contact_phone')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>  
                                @if ($contact_relationship == 'ອື່ນໆ')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('lang.details')}} (ສາຍພົວພັນ)</label>
                                        <input type="text" class="form-control" wire:model.live='detail' placeholder="{{__('lang.details')}}">
                                        @error('detail')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif    
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">
                                            {{ __('lang.province') }}</label>
                                        <select class="form-control" wire:model.live="pro_contact_id">
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
                                        @error('pro_contact_id')
                                            <span style="color: red"
                                                class="error">{{ __('lang.please_fill_information_first') }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">
                                            {{ __('lang.district') }}</label>
                                        <select class="form-control" wire:model.live="dis_contact_id">
                                            <option value="">{{ __('lang.district') }}</option>
                                            @foreach ($districts_contact as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($this->dis_contact_id == $item->id) selected @endif>
                                                    @if (Config::get('app.locale') == 'lo')
                                                        {{ $item->name_la }}
                                                    @elseif(Config::get('app.locale') == 'en')
                                                        {{ $item->name_en }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dis_contact_id')
                                            <span style="color: red"
                                                class="error">{{ __('lang.please_fill_information_first') }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">
                                            {{ __('lang.village') }}</label>
                                        <input type="text" wire:model='village_contact' class="form-control" placeholder="{{ __('lang.village') }}.....">
                                        @error('village_contact')
                                            <span style="color: red"
                                                class="error">{{ __('lang.please_fill_information_first') }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                          
                          
                            



                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__('lang.file_document')}}</label>
                                        <input type="file" class="form-control" wire:model.live='file'>
                                        @error('file')
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
                            class="btn btn-primary">{{ __('lang.edit') }}</button>
                    @else
                        <button wire:click="Store" type="button"
                            class="btn btn-primary">{{ __('lang.save') }}</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
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
                    <button wire:click="Destroy({{ $hiddenId }})" type="button"
                        class="btn btn-success">{{ __('lang.delete') }}</button>
                </div>
            </div>
        </div>
    </div>



    <div class="row d-none">


        <div class="table-responsive mt-2 print-content" wire:poll>
            <div class="col-md-12" style="text-align:center;">
                <b>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ <br>
                    ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ <br>
                </b>
                <br>
            </div>
            <table class="table table-bordered" id="table-excel">
                <thead>
                    <tr class="text-center">
                        <td>No.</td>
                        <td>{{ __('lang.name') }}</td>
                        <td>{{ __('lang.lastname') }}</td>
                        <td>{{ __('lang.birthday') }}</td>
                        <td>{{ __('lang.gender') }}</td>
                        <td>{{ __('lang.phone') }}</td>
                        <td>{{ __('lang.job') }}</td>
                        <td>{{ __('lang.village') }}</td>
                        <td>{{ __('lang.district') }}</td>
                        <td>{{ __('lang.province') }}</td>
                    </tr>
                </thead>

                <tbody class="text-center">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->lastname }}</td>
                            <td>{{ $item->birthday }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->jobs }}</td>
                            {{-- <td>{{ $item->get_village->name_la }}</td>
                            <td>{{ $item->get_district->name_la }}</td>
                            <td>{{ $item->get_province->name_la }}</td> --}}

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
@push('scripts')
    <script>
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
        //Delete
        window.addEventListener('show-modal-delete', event => {
            $('#modal-delete').modal('show');
        })
        window.addEventListener('hide-modal-delete', event => {
            $('#modal-delete').modal('hide');
        })
        window.addEventListener('show-modal-hus-wife', event => {
            $('#modal-add-hus-wife').modal('show');
        })
        window.addEventListener('hide-modal-hus-wife', event => {
            $('#modal-add-hus-wife').modal('hide');
        })
        window.addEventListener('show-modal-job', event => {
            $('#show-modal-job').modal('show');
        })
        window.addEventListener('hide-modal-job', event => {
            $('#show-modal-job').modal('hide');
        })
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
