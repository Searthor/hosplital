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
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
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
                                        <button class="btn btn-info" id="print"><i class="fas fa-print"></i>
                                            {{ __('lang.print') }}
                                        </button>
                                    </div>
                                </div><!-- end div-col -->
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

                                                <h4>ລາຍງານຢາ</h4>


                                            </div>
                                        </div>



                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center">No.</td>
                                                            <td>ປະເພດຢາ</td>
                                                            <td>ຊື່ຢາ</td>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $no = 1 @endphp
                                                        @foreach ($data as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $no++ }}</td>
                                                                <td>{{ $item->med_name }}</td>
                                                                <td>{{ $item->get_type_name->type_name }}</td>




                                                            </tr>
                                                        @endforeach



                                                    </tbody>

                                                </table>
                                                <div class="float-right" style="margin-right: 2rem">
                                                    <p>ວັນທີ່: <b>{{ date('d/m/Y') }}</b></p>
                                                    <p>ຜູ້ລາຍງານ: <b>{{ auth()->user()->f_name }}
                                                            {{ auth()->user()->l_name }}</b> </p>
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
