<div wire:poll>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        ຄົນໄຂ
                        <i class="fas fa-angle-double-right"></i>
                        ລາຍການຄົນໄຂ
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        /ລາຍການຄົນໄຂ
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
                                        @if ($function_controller->check_permission('customer_add') == true || auth()->user()->role_id == 1)
                                            <div class="col-md-4">
                                                <a href="{{ route('create_treatment') }}" class="btn btn-info"
                                                    style="padding: .5rem 2rem">{{ __('lang.add') }}</a>
                                            </div>
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
                                            <td class="text-center">{{ __('lang.code') }}</td>
                                            <td>{{ __('lang.fullname') }}</td>
                                            <td>ທ່ານໜໍທີ່ດຸແລ</td>
                                            <td class="text-center">{{ __('lang.date') }}</td>
                                            <td class="text-center">{{ __('lang.creator') }}</td>
                                            <td class="text-center">{{ __('lang.action') }}</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $i = 1;
                                            $name = 'searthor';

                                        @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                @if ($function_controller->check_permission('access_detail_treatment') == true || auth()->user()->role_id == 1)
                                                    <td class="text-center"><a
                                                            href="{{ route('treatment_detail', ['id' => $item->id]) }}"
                                                            style="background: rgba(194, 255, 247, 0.338);padding:0rem 1rem;border-radius: 5px;">{{ $item->code }}</a>
                                                    </td>
                                                @else
                                                    <td class="text-center"><a href="#"
                                                            style="background: rgba(194, 255, 247, 0.338);padding:0rem 1rem;border-radius: 5px;">{{ $item->code }}</a>
                                                    </td>
                                                @endif
                                                <td>
                                                    <p class="bg-info mr-3"
                                                        style= "border-radius: 50%;width:40px;height:40px;line-height:40px;text-align:center; display:inline-block">
                                                        {{ substr($item->get_patient->f_name, 0, 1) }}{{ substr($item->get_patient->l_name, 0, 1) }}
                                                    </p>
                                                    {{ $item->get_patient->f_name }} {{ $item->get_patient->l_name }}
                                                </td>

                                                <td>
                                                    {{ $item->get_creator->f_name }} {{ $item->get_creator->l_name }}
                                                </td>
                                                <td class="text-center">

                                                    {{ date('d/m/Y', strtotime($item->date)) }}
                                                </td>
                                                <td class="text-center">

                                                    Admin
                                                </td>
                                                <td class="text-center">

                                                    {{-- <<button wire:click="showDestroy({{ $item->id }})"
                                                    type="button" class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash"></i></button> --}}
                                                    @if ($function_controller->check_permission('access_detail_treatment') == true || auth()->user()->role_id == 1)
                                                        <a  type="button" href="{{ route('treatment_detail', ['id' => $item->id]) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    <a wire:click="showDestroy({{ $item->id }})" type="button"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach



                                        {{-- <tr>
                                        <td class="text-center">02</td>
                                        <td class="text-center"><a href="" style="background: rgba(194, 255, 247, 0.338);padding:0rem 1rem;border-radius: 5px;">TM-04234</a></td>
                                        <td>
                                            <span class="bg-info mr-3" style="padding: .5rem .8rem;border-radius: 50%;">ST</span>
                                            SearThor
                                        </td>
                                        <td class="text-center">25/2/2024</td>
                                        <td class="text-center">
                                            <span class="text-danger" style="background: rgba(255, 198, 194, 0.338);padding:0rem 1rem;border-radius: 5px;">ຍັງບໍຊໍາລະ</span>
                                        </td>
                                        <td class="text-center">
                                            
                                            Admin
                                        </td>
                                        <td class="text-center">
                                            <a href="" class="text-danger text-lg">
                                                <i  class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                       </tr> --}}
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
                    <button wire:click="Destroy({{ $hiddenId }})" type="button"
                        class="btn btn-success">{{ __('lang.delete') }}</button>
                </div>
            </div>
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
