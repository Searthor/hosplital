<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        ຄົນໄຂ
                        <i class="fas fa-angle-double-right"></i>
                        ປະຫວັດລາຍການປິ່ນປົວ
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        ປະຫວັດລາຍການປິ່ນປົວ
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
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="{{ __('lang.search') }}"
                                            wire:model="search">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control" wire:model="start_date">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control" wire:model="end_date">
                                    </div>
                                </div>

                            </div>
                            <div class="table-responsive mt-2" wire:poll>
                                <table class="table table-bordered" id="table-excel">
                                    <p>ທັງໝົດ <b>{{count($data)}}</b> ລາຍການ</p>
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
                                                    <td><a href="{{route('backend_patient_detail',['id'=>$item->id])}}" style="background: rgba(194, 255, 247, 0.338);padding:0rem 1rem;border-radius: 5px;">{{ $item->code }}</a></td>
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
                                                        {{ $item->get_creator->firstname }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>




                                </table>
                                @if (count($data)<=0)
                                `   <p class="text-center">ຍັງບໍມີຂໍ້ມູນ</p>
                                @endif
                                

                                <a href="{{ route('backend.patients') }}"
                                    class="btn btn-warning">{{ __('lang.back') }}</a>

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
