<div>
    {{-- ======================================== name page ====================================================== --}}
    <div class="right_col" role="main">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h6><i class="fa fa-database"></i> {{ __('lang.settings') }} <i class="fa fa-angle-double-right"></i>
                            {{ __('lang.province') }}</h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('lang.province') }}</li>
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
                                    <div class="col-md-2">
                                        <select name="" id="" wire:model.live="page_number"
                                            class="form-control">
                                            <option value="10">10</option>
                                            <option value="30">30</option>
                                            <option value="100">100</option>
                                            <option value="1000">1,000</option>
                                            <option value="all">{{ __('lang.all') }}</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-8">
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th>{{ __('lang.no') }}</th>
                                                <th>{{ __('lang.name_la') }}</th>
                                                <th>{{ __('lang.name_en') }}</th>
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
                                                    <td>{{ $item->name_la }}</td>
                                                    <td>{{ $item->name_en }}</td>
                                                   
                                                   
                                                    <td>
                                                        <div class="btn-group">
                                                            <button wire:click="edit({{ $item->id }})"
                                                                type="button" class="btn btn-warning btn-sm"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <button wire:click="showDestroy({{ $item->id }})"
                                                                type="button" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                             
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
                                                <label>{{__('lang.province')}} ( ຊື່ພາສາລາວ)</label>
                                                <input wire:model="name_la" type="text"
                                                    class="form-control @error('name_la') is-invalid @enderror"
                                                    placeholder="{{ __('lang.name_la') }}">
                                                @error('name_la')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{__('lang.province')}} ( ຊື່ພາສາອັງກິດ)</label>
                                                <input wire:model="name_en" type="text"
                                                    class="form-control @error('name_en') is-invalid @enderror"
                                                    placeholder="{{ __('lang.name_en') }}">
                                                @error('name_en')
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
                                        <button type="button" wire:click="store"
                                            class="btn btn-success">{{ __('lang.save') }}</button>
                            
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
                        <h4 class="text-center">ທ່ານຕອງການລົບແຂວງ<b>({{ $name_la }})</b>ບໍ ?</h4>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('lang.cancle') }}</button>
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
