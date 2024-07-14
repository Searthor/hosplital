<div>
    {{-- ======================================== name page ====================================================== --}}
    <div class="right_col" role="main">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h6><i class="fa fa-database"></i> {{ __('lang.settings') }} <i
                                class="fa fa-angle-double-right"></i>
                            ປະເພດຢາ</h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('backend.dashboard') }}">{{ __('lang.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">ປະເພດຢາ</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- ======================================== show and seach data ====================================================== --}}
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="row">

                                    <div class="col-md-4">
                                        <input wire:model.live="search" type="text" class="form-control"
                                            placeholder="ຄົ້ນຫາ...">
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th>{{ __('lang.no') }}</th>
                                                <th>ຊື່ປະເພດຢາ</th>
                                                <th>ລາຍລະອຽດ</th>
                                                <th>{{ __('lang.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $num = 1;
                                            @endphp
                                            @foreach ($data as $item)
                                                <tr class="text-center">
                                                    <td>{{ $num++ }}</td>
                                                    <td>{{ $item->type_name }}</td>
                                                    <td>{{ $item->des }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            @if ($function_controller->check_permission('access_edit_medicine_type') == true || auth()->user()->role_id == 1)
                                                                <button wire:click="edit({{ $item->id }})"
                                                                    type="button" class="btn btn-warning btn-sm"><i
                                                                        class="fa fa-pencil"></i></button>
                                                            @endif

                                                            @if ($function_controller->check_permission('access_delete_medicine_type') == true || auth()->user()->role_id == 1)
                                                                <button wire:click="showDestroy({{ $item->id }})"
                                                                    type="button" class="btn btn-danger btn-sm"><i
                                                                        class="fa fa-trash"></i></button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- <div class="float-right">
                                        {{ $data->links() }}
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- ============================== form add-edit ==================================== --}}
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header bg-light">
                                <label>{{ __('lang.add_edit') }}</label>
                            </div>
                            <form>
                                <div class="card-body">
                                    {{-- <input type="hidden" wire:model="ID" value="{{ $ID }}"> --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>ຊື່ປະເພດ <span class="text-danger">*</span> </label>
                                                <input wire:model.live="type_name" type="text"
                                                    class="form-control
                                                    @if ($type_name == null) @error('type_name') is-invalid @enderror @endif"
                                                    placeholder="{{ __('lang.name') }}">
                                                @if ($type_name == null)
                                                    @error('type_name')
                                                        <span style="color: red" class="error">{{ $message }}</span>
                                                    @enderror
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('lang.details') }}</label>
                                                <textarea wire:model='detail' class="form-control"></textarea>
                                                @error('des')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between md-2">

                                        <button type="button" wire:click="resetform"
                                            class="btn btn-warning">{{ __('lang.reset') }}</button>
                                        @if ($ID)
                                            @if ($function_controller->check_permission('access_edit_medicine_type') == true || auth()->user()->role_id == 1)
                                                <button type="button" wire:click="store"
                                                    class="btn btn-warning">{{ __('lang.edit') }}</button>
                                            @endif
                                        @else
                                            @if ($function_controller->check_permission('access_add_medicine_type') == true || auth()->user()->role_id == 1)
                                                <button type="button" wire:click="store"
                                                    class="btn btn-success">{{ __('lang.save') }}</button>
                                            @endif
                                        @endif


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- ======================================== modal-delete ====================================================== --}}
        <div class="modal fade" id="modal-delete">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title"><i class="fa fa-trash text-white"></i></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <input type="hidden" wire:model="ID">
                        <h4 class="text-center">ທ່ານຕອງການລົບບໍ ?</h4>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('lang.cancle') }}</button>
                        <button wire:click="destroy({{ $ID }})" type="button"
                            class="btn btn-success">ລົບ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('show-modal-delete', event => {
            $('#modal-delete').modal('show');
        })
        window.addEventListener('hide-modal-delete', event => {
            $('#modal-delete').modal('hide');
        })
    </script>
@endpush
