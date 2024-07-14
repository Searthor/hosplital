<div wire:poll>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h6>
                        {{ __('lang.report') }}
                        <i class="fa fa-angle-double-right"></i>
                        ຄົນໄຂ້
                    </h6>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a></li>
                        <li class="breadcrumb-item active">ຄົນໄຂ້</li>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" wire:model="start_date" class="form-control">
                                    </div>
                                </div><!-- end div-col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" wire:model="end_date" class="form-control">
                                    </div>
                                </div><!-- end div-col -->
                                {{-- @foreach ($rolepermissions as $items)
                                @if ($items->permissionname->name == 'action_report_sale') --}}
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-info" id="print"><i class="fas fa-print"></i>
                                            {{ __('lang.print') }}</button>
                                    </div>
                                </div><!-- end div-col -->
                                {{-- @endif
                                @endforeach --}}
                            </div><!-- end div-row -->
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="right_content">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h6>ສາທາລະນະລັດ ປະຊາທິປະໄຕ ປະຊາຊົນລາວ</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h6>ສັນຕິພາບ ເອກະລາດ ປະຊາທິປະໄຕ ເອກະພາບ ວັດທະນາຖາວອນ</h6>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                @if ($this->start_date && $this->end_date)
                                                <h4>{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</h4>
                                                @else
                                                <h4>ຜູ້ໃຊ້ລະບົດ</h4>
                                                @endif
                                              
                                            </div>
                                        </div>
                           
                                        
        
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr >
                                                            <td class="text-center">ລ/ດ</td>
                                                            {{-- <td>ລະຫັດCode</td> --}}
                                                            <td>ຊື່ ແລະ ນາມສະກຸນ</td>
                                                            <td>ພະແນກ</td>
                                                            <td>{{__('lang.roles')}}</td>
                                                            <td>{{ __('lang.gender') }}</td>
                                                            <td>{{ __('lang.birthday') }}</td>
                                                            <td>{{ __('lang.phone') }}</td>
                                                            <td>ສັນຊາດ</td>
                                                            <td>{{ __('lang.village') }}</td>
                                                            <td>{{ __('lang.district') }}</td>
                                                            <td>{{ __('lang.province') }}</td>
                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1 @endphp
                                                        @foreach ($data as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $no++ }}</td>
                                                            <td>{{ $item->f_name }} {{ $item->l_name }}</td>
                                                            <td>{{ $item->f_name }} </td>
                                                            <td>
                                                                {{ !empty($item->get_role->name) ? $item->get_role->name : '' }}
                                                            </td>
                                                            <td>
                                                                @if ($item->gender == 'male')
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

                                                         
                                      
                                                        </tr>
                                                    @endforeach
                                                   
            
                             
                                                    </tbody>

                                                </table>
                                                <div  class="float-right" style="margin-right: 2rem">
                                                    <p >ວັນທີ່: <b>{{date('d/m/Y')}}</b></p>
                                                    <p>ຜູ້ລາຍງານ: <b>{{auth()->user()->f_name}} {{auth()->user()->l_name}}</b> </p>
                                                    <p>ລາຍຊັນ</p><br>
                                                    <p>.................................</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body-->
                    </div><!-- end card -->
                </div>
            </div>
        </div>
    </section>
    {{-- @include('livewire.backend.report.buy-detail') --}}
</div>
@push('scripts')
    <script>
        window.addEventListener('show-modal-detail', event => {
            $('#modal-detail').modal('show');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#print').click(function() {
                printDiv();

                function printDiv() {
                    var printContents = $(".right_content").html();
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }
                location.reload();
            });
        });
    </script>
@endpush
