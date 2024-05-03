<div wire:poll>
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
                        ລາຍລະອຽດ
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-md-12"
                    style="border-radius: 5px;background:#fff;padding:2rem;box-shadow: 0px 3px 10px rgb(183, 183, 183)">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h1 class="text-primary">{{ $patient->f_name }} {{ $patient->l_name }}</h1>
                            <h5>Tel: {{ $patient->phone }}</h5>
                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-3 text-center"
                            style="border:1px solid rgb(123, 123, 123); padding:1.5rem;border-radius: 5px;">
                            ລວມກວດທັງໜົດ : <b>{{ count($data) }}</b> ຄັ້ງ
                        </div>
                        <div class="col-md-3 ml-2 text-center"
                            style="border:1px solid rgb(129, 129, 129); padding:1.5rem;border-radius: 5px;">
                            ລວມນັດໜາຍທັງໜົດ : <b>{{count($Appointments)}}</b> ຄັ້ງ
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pl-5">
                <p wire:click='set_step(1)'
                    style="padding-bottom: 1rem; 
                    @if ($this->step == 1) border-bottom:1px solid rgb(0, 85, 255); color:rgb(0, 85, 255); @endif
                    cursor:pointer">
                    ລວມກວດທັງໜົດ</p>
                <p wire:click='set_step(2)'
                    style="padding-bottom: 1rem;margin-left:1rem;
                 @if ($this->step == 2) border-bottom:1px solid rgb(0, 85, 255); color:rgb(0, 85, 255); @endif
                cursor:pointer">
                    ລວມນັດໜາຍທັງໜົດ
                </p>
                <p wire:click='set_step(3)'
                    style="padding-bottom: 1rem;margin-left:1rem;
                 @if ($this->step == 3) border-bottom:1px solid rgb(0, 85, 255); color:rgb(0, 85, 255); @endif
                cursor:pointer">
                    ຂໍ້ມູນຄົນໄຂ້</p>


            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($this->step == 1)
                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered" id="table-excel">
                                        <p>ທັງໝົດ <b>{{ count($data) }}</b> ລາຍການ</p>
                                        <thead>
                                            <tr class="text-center">
                                                <td>No.</td>
                                                <td>ລະຫັດCode</td>
                                                <td>ຊື່ ແລະ ນາມສະກຸນ</td>
                                                <td>{{ __('lang.date') }}</td>
                                                <td>{{ __('lang.creator') }}</td>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">

                                            @php
                                                $i = 1;
                                            @endphp
                                            @if (count($data) > 0)

                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td><a href="{{ route('backend_patient_detail', ['id' => $item->id]) }}"
                                                                style="background: rgba(194, 255, 247, 0.338);padding:0rem 1rem;border-radius: 5px;">{{ $item->code }}</a>
                                                        </td>
                                                        <td>
                                                            <span class="bg-info mr-3"
                                                                style="padding: .5rem .8rem;border-radius: 50%;">
                                                                {{ substr($item->get_patient->f_name, 0, 1) }}{{ substr($item->get_patient->l_name, 0, 1) }}
                                                            </span>
                                                            {{ $item->get_patient->f_name }}
                                                            {{ $item->get_patient->l_name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->date }}
                                                        </td>
                                                        <td>
                                                            {{ $item->get_creator->f_name }}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>




                                    </table>
                                    @if (count($data) <= 0)
                                        <p class="text-center">ຍັງບໍມີຂໍ້ມູນ</p>
                                    @endif


                                </div>
                            @elseif ($this->step == 2)
                                <div class="table-responsive mt-2">
                                    <table class="table table-bordered" id="table-excel">
                                        <p>ທັງໝົດ <b>{{ count($Appointments) }}</b> ລາຍການ</p>
                                        <thead>
                                            <td class="text-center">No.</td>
                                            <td class="text-center">{{ __('lang.fullname') }}</td>
                                            <td class="text-center">ທ່ານໜໍທີ່ນັດ</td>
                                            <td class="text-center">{{ __('lang.date') }}ນັດໝາຍ</td>
                                            <td class="text-center">ເວລາ</td>
                                            <td class="text-center">{{ __('lang.creator') }}</td>

                                        </thead>

                                        <tbody class="text-center">

                                            @php
                                                $i = 1;
                                            @endphp
                                            @if (count($Appointments) > 0)

                                                @foreach ($Appointments as $item)
                                                <tr>
                                                    <td class="text-center">{{$i++}}</td>
                                                    <td>
                                                        <p class="bg-info mr-3" style= "border-radius: 50%;width:40px;height:40px;line-height:40px;text-align:center; display:inline-block">
                                                            {{ substr($item->get_patient->f_name,0,1) }}{{ substr($item->get_patient->l_name,0,1) }}
                                                        </p>
                                                        {{ $item->get_patient->f_name }} {{ $item->get_patient->l_name }}
                                                    </td>
        
                                                    <td>
                                                        {{$item->get_doctor->f_name}} {{$item->get_doctor->l_name}}
                                                    </td>
                                                    <td class="text-center">
                                                        
                                                        {{ date('d/m/Y', strtotime($item->date)) }}
                                                    </td>
                                                    <td class="text-center">
                                                       
                                                       <p style="padding: .3rem 1rem;width:100px;margin:0 auto;border-radius:5px" class="bg-info">{{$item->time}}:00</p> 
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->get_creator->f_name}} {{!empty($item->get_creator->l_name) ? $item->get_creator->l_name : ''}}
                                                    </td>
                                                 
                                                   </tr>
                                                @endforeach
                                            @endif
                                        </tbody>




                                    </table>
                                    @if (count($data) <= 0)
                                        <p class="text-center">ຍັງບໍມີຂໍ້ມູນ</p>
                                    @endif


                                </div>
                            @elseif($this->step == 3)
                                <div class="text-start" style="margin-left: 20rem">
                                    <h5>ຊື່ ແລະ ນາມສະກຸນ: <b> {{ $patient->f_name }} {{ $patient->l_name }}</b>
                                        ອາຍຸ: <b>23</b> ປີ ,ສັນຊາດ: <b>{{ $patient->nationality }}</b> ,ຊົນເຜົ່າ:
                                        <b>{{ $patient->ethnicity }}</b> ອາຊິບ: <b>{{ $patient->job }}</b> <br><br>
                                        ສະຖານະ:{{ $patient->status }} ,ປັດຈຸບັນຢູ່ບ້ານ: <b>{{ $patient->village }}</b>
                                        ,ເມືອງ: <b>{{ $patient->district->name_la }}</b> ,ແຂວງ:
                                        <b>{{ $patient->province->name_la }}</b>,ຫ່ວຍ: <b>{{ $patient->unit }}</b>,
                                        @if ($patient->house_number)
                                            ເຮືອນເລກທີ່: <b>{{ $patient->house_number }}</b>
                                        @endif <br><br>
                                        @if ($patient->number_doc_person)
                                            ເອສານ(ສໍາມະໂນຄົວ ຫຼື ບັດປະຈໍາຕົວ)ເລກທີ່:
                                            <b>{{ $patient->number_doc_person }}</b>, ອອກຊື່: <b>
                                                {{ $patient->doc_person_name }}</b>, ອອກວັນທີ່:
                                            <b>{{ $patient->doc_person_date }}</b>
                                            <br>
                                            <br>
                                        @endif

                                        ເບີຕິດຕໍ່: <b>{{ $patient->phone }}</b>
                                    </h5>
                                    <hr>
                                    <h2>ຂໍ້ມູນຕິດຕໍ່ສໍາຮອງ</h2>
                                    @if ($patient->contact_name)
                                        <h5>ຊື່ ແລະ ນາມສະກຸນ: <b> {{ $patient->contact_name }} </b>
                                            ສາຍສໍາພັນ: <b>{{ $patient->contact_relationship }}</b>
                                            ເບີຕິດຕໍ່: <b>{{ $patient->contact_phone }}</b>
                                        </h5>
                                    @else
                                        <p>ບໍມີຂໍ້ມູນ</p>
                                    @endif

                                </div>



                            @endif
                        </div>
                        <div class="cart-footer p-4">
                            <a href="{{ route('backend.patients') }}"
                                class="btn btn-warning">{{ __('lang.back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
