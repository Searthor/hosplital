<div wire:poll>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h6>
                        {{ __('lang.report') }}
                        <i class="fa fa-angle-double-right"></i>
                        {{ __('lang.all_customer') }}
                    </h6>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('lang.all_customer') }}</li>
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
                                        <input type="date" wire:model="start" class="form-control">
                                    </div>
                                </div><!-- end div-col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="date" wire:model="end" class="form-control">
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
                                                <h6>{{ __('lang.headding1') }}</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h6>{{ __('lang.headding2') }}</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <i class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i><i
                                                    class="fa fa-angle-double-left"></i> <span> <i
                                                        style="font-size: 30px"
                                                        class="fas fa-yin-yang text-info"></i></span> <i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i><i
                                                    class="fa fa-angle-double-right"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 text-center">
                                                <img src="{{ asset('images/logo.png') }}"
                                                    class="brand-image-xl img-circle elevation-2" height="80"
                                                    width="80">
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6 text-right">
                                                {{-- <h6>ເລກທີ: {{ $this->billNumber }}</h6> --}}
                                                <h6>{{ __('lang.date') }}: {{ date('d/m/Y') }}</h6>
                                                <h6>{{ __('lang.time') }}: {{ date('H:i:s') }}</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5 class="text-center">ວັນດາລາ</h5>
                                                <h6 class="text-sm"><i class="fas fa-phone-alt"></i> ຕິດຕໍ່:
                                                    020 
                                                    <h6 class="text-sm"><i class="fas fa-envelope"></i> {{ __('lang.email') }}:
                                                        @gmail.com
                                                        <h6 class="text-sm"><i class="fas fa-hospital"></i> ທີ່ຕັ້ງ:
                                                            ........,.........,...........</h6>
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h4><u><b>{{ __('lang.report') }}{{ __('lang.all_customer') }}</b></u></h4>
                                                <h4><b>ວັນທີ່:
                                                        {{-- @if (!empty($starts))
                                                            {{ date('d-m-Y', strtotime($starts)) }}
                                                        @endif
                                                        ຫາ ວັນທີ່:
                                                        @if (!empty($ends))
                                                            {{ date('d-m-Y', strtotime($ends)) }}
                                                        @endif --}}
                                                    </b></h4>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr class="text-center bg-gradient-light text-bold">
                                                            <th>{{ __('lang.no') }}</th>
                                                            <th>{{ __('lang.name') }} {{ __('lang.lastname') }}</th>
                                                            <th>{{ __('lang.gender') }}</th>
                                                            <th>{{ __('lang.phone') }}</th>
                                                            <th>{{ __('lang.address') }}</th>
                                                            <th>{{ __('lang.nationality') }}</th>
                                                            <th>{{ __('lang.birthday') }}</th>
                                                            <th>{{ __('lang.status') }}</th>
                                                            <th>{{ __('lang.status_life') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1 @endphp
                                                        {{-- @foreach ($buy_lands as $item)
                                                            <tr class="text-center">
                                                                <td>{{ $no++ }}</td>
                                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="javascript:void(0)"
                                                                        wire:click="ShowDetail({{ $item->id }})">{{ $item->code }}</a>
                                                                </td>
                                                                <td class="text-left">
                                                                    @if (!empty($item->supplier))
                                                                        {{ $item->supplier->name }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">
                                                                    @if (!empty($item->employee))
                                                                        {{ $item->employee->name }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-left">
                                                                    {{ number_format($item->cost_price) }} LAK
                                                                </td>
                                                                <td class="text-center">
                                                                    @if ($item->status == 1)
                                                                        <span class="text-warning"><i
                                                                                class="fas fa-hand-holding-usd"></i>
                                                                            ຄ້າງຊໍຳລະ</span>
                                                                    @elseif($item->status == 0)
                                                                        <span class="text-success"><i
                                                                                class="fas fa-check-circle"></i>
                                                                            ສຳເລັດເເລ້ວ</span>
                                                                    @else
                                                                        <span class="text-danger"><i
                                                                                class="fas fa-times-circle"></i>
                                                                            ຍົກເລີກ</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach --}}
                                                        <tr class="text-center">
                                                            <td class="bg-light text-right" colspan="7">
                                                                <i>
                                                                    <h5><b>ລວມທັງໝົດ</b></h5>
                                                                </i>
                                                            </td>
                                                            <td class="text-left bg-light">
                                                                {{-- <h5>{{ number_format($sum_cost_price) }} LAK</h5> --}}
                                                            </td>
                                                            <td class="bg-light"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
