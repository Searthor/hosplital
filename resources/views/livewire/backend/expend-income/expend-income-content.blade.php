<div>
    {{-- ======================================== name page ====================================================== --}}
    <div class="right_col" role="main">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h6>
                            {{ __('lang.income_expend') }}</h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('backend.dashboard') }}">{{ __('lang.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('lang.income_expend') }}</li>
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
                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select wire:model="select_branch" id="select_branch"
                                                    class="form-control">
                                                    <option value="">
                                                        {{ __('lang.select') }}{{ __('lang.branch') }}
                                                    </option>
                                                    @foreach ($get_all_branches as $item)
                                                        <option value="{{ $item->id }}">
                                                            @if (Config::get('app.locale') == 'lo')
                                                                {{ $item->name_la }}
                                                            @elseif(Config::get('app.locale') == 'en')
                                                                {{ $item->name_en }}
                                                            @else
                                                                {{ $item->name_cn }}
                                                            @endif

                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <input wire:model.live="search" type="text" class="form-control"
                                            placeholder="ຄົ້ນຫາ...">
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th>{{ __('lang.no') }}</th>
                                                <th>{{ __('lang.branch') }}</th>
                                                <th>{{ __('lang.service_unit') }}</th>
                                                <th>{{ __('lang.type') }}</th>
                                                <th>{{ __('lang.name') }}</th>
                                                <th>{{ __('lang.total_price') }}</th>
                                                <th>{{ __('lang.description') }}</th>
                                                {{-- @foreach ($rolepermissions as $items)
                                                @if ($items->permissionname->name == 'action_sectors') --}}
                                                <th>{{ __('lang.action') }}</th>
                                                {{-- @endif
                                            @endforeach --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $num = 1;
                                            @endphp
                                            @foreach ($data as $item)
                                                <tr class="text-center">
                                                    <td>{{ $num++ }}</td>
                                                    <td>
                                                        @if (!empty($item->branches))
                                                            {{ $item->branches->name_la }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($item->service_unit))
                                                            {{ $item->service_unit->name_la }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->type == 1)
                                                            <span class="text-success">{{ __('lang.income') }}</span>
                                                        @elseif($item->type == 2)
                                                            <span class="text-danger">{{ __('lang.expend') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ number_format($item->total_price) }}</td>
                                                    <td>{{ $item->note }}</td>
                                                    {{-- @foreach ($rolepermissions as $items)
                                                @if ($items->permissionname->name == 'action_sectors') --}}
                                                    <td>
                                                        <div class="btn-group">
                                                            <button wire:click="edit({{ $item->id }})"
                                                                type="button" class="btn btn-warning btn-sm"><i
                                                                    class="fa fa-pencil"></i></button>
                                                            <button wire:click="showDestroy({{ $item->id }})"
                                                                type="button" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </div>
                                                        {{-- @endif
                                                        @endforeach --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="float-right">
                                        {{ $data->links('livewire.backend.pagination.pagination-component') }}
                                    </div>
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
                                    <input type="hidden" wire:model="ID" value="{{ $ID }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                                <div class="form-group">
                                                    <label>{{ __('lang.branch') }}</label>
                                                    <select wire:model.live="branch_id" id="branch_id"
                                                        class="form-control @error('branch_id') is-invalid @enderror">
                                                        <option value="">
                                                            {{ __('lang.select') }}{{ __('lang.branch') }}
                                                        </option>
                                                        @foreach ($branches as $item)
                                                            <option value="{{ $item->id }}">
                                                                @if (Config::get('app.locale') == 'lo')
                                                                    {{ $item->name_la }}
                                                                @elseif(Config::get('app.locale') == 'en')
                                                                    {{ $item->name_en }}
                                                                @else
                                                                    {{ $item->name_cn }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('branch_id')
                                                        <span style="color: red" class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                        @if ($this->branch_id)
                                            <div class="col-md-12">
                                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                                    <div wire:ignore.self class="form-group">
                                                        <label>{{ __('lang.service_unit') }}</label>
                                                        <select wire:model.live="service_units_id" id="service_units_id"
                                                            class="form-control @error('service_units_id') is-invalid @enderror">
                                                            <option value="">
                                                                {{ __('lang.select') }}{{ __('lang.branch') }}
                                                            </option>
                                                            @foreach ($this->service_unit as $item)
                                                                <option value="{{ $item->id }}">
                                                                    @if (Config::get('app.locale') == 'lo')
                                                                        {{ $item->name_la }}
                                                                    @elseif(Config::get('app.locale') == 'en')
                                                                        {{ $item->name_en }}
                                                                    @else
                                                                        {{ $item->name_cn }}
                                                                    @endif
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('service_units_id')
                                                            <span style="color: red"
                                                                class="error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('lang.type') }}</label>
                                                <select wire:model="type" id="type_"
                                                    class="form-control @error('type') is-invalid @enderror">
                                                    <option value="">
                                                        {{ __('lang.select') }}
                                                    </option>
                                                    <option value="1">
                                                        {{ __('lang.income') }}
                                                    </option>
                                                    <option value="2">
                                                        {{ __('lang.expend') }}
                                                    </option>
                                                </select>
                                                @error('type')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('lang.name') }}</label>
                                                <input wire:model="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="{{ __('lang.input') }}">
                                                @error('name')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('lang.total_price') }}
                                                    @if ($this->total_price)
                                                        {{ number_format($this->total_price) }}
                                                    @endif
                                                </label>
                                                <input wire:model="total_price" type="number"
                                                    class="form-control @error('total_price') is-invalid @enderror"
                                                    placeholder="{{ __('lang.input') }}">
                                                @error('total_price')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{ __('lang.description') }}</label>
                                                <input wire:model="note" type="text"
                                                    class="form-control @error('note') is-invalid @enderror"
                                                    placeholder="{{ __('lang.input') }}">
                                                @error('note')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between md-2">
                                        {{-- @foreach ($rolepermissions as $items)
                            @if ($items->permissionname->name == 'action_product_type') --}}
                                        <button type="button" wire:click="resetform"
                                            class="btn btn-warning">{{ __('lang.reset') }}</button>
                                        <button type="button" wire:click="store"
                                            class="btn btn-success">{{ __('lang.save') }}</button>
                                        {{-- @endif
                              @endforeach --}}
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
                        <h4 class="text-center">{{ __('lang.do_you_want_to_delete') }} <b>({{ $name }})</b> ?
                        </h4>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{ __('lang.cancle') }}</button>
                        <button wire:click="destroy({{ $ID }})" type="button"
                            class="btn btn-success">{{ __('lang.save') }}</button>
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
