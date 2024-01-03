<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        {{ __('lang.settings') }}
                        <i class="fas fa-angle-double-right"></i>
                        {{ __('lang.roles') }}
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('lang.roles') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!--customers -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                        <a wire:click="create" class="btn btn-primary" href="javascript:void(0)"><i
                                                class="fa fa-plus-circle"></i> {{ __('lang.add') }}</a>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                </div>
                                <div class="col-md-4">
                                    <input wire:model.live="search" type="text" class="form-control"
                                        placeholder="{{ __('lang.search') }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-1">
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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th>{{ __('lang.no') }}</th>
                                            <th>{{ __('lang.name') }}</th>
                                            <th>{{ __('lang.des') }}</th>
                                            <th>{{ __('lang.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 1;
                                        @endphp
                                        @foreach ($data as $item)
                                            <tr style="text-align: center">
                                                <td>
                                                    @if ($this->page_number == 'all')
                                                        {{ $stt++ }}
                                                    @else
                                                        {{ ($data->currentPage() - 1) * $this->page_number + $stt++ }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                <td>
                                                    {{ $item->des }}
                                                </td>
                                                <td>
                                                    @if ($item->id != 1)
                                                        <button wire:click="edit({{ $item->id }})" type="button"
                                                            class="btn btn-warning"><i class="fas fa-pen"></i></button>
                                                        <button wire:click="showDestroy({{ $item->id }})"
                                                            type="button" class="btn btn-danger"> <i
                                                                class="fa fa-trash"></i></button>
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">
                        @if ($this->hiddenId)
                            {{ __('lang.edit') }}
                        @else
                            {{ __('lang.add') }}
                        @endif
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" wire:model="hiddenId">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('lang.name') }}</label>
                                <input type="text" class="form-control" wire:model="name"
                                    placeholder="{{ __('lang.name') }}">
                            </div>
                            @error('name')
                                <span style="color: red" class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">{{ __('lang.des') }}</label>
                                <input type="text" class="form-control" wire:model="des"
                                    placeholder="{{ __('lang.des') }}">
                            </div>
                            @error('des')
                                <span style="color: red" class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="table-responsive">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($functions as $item)
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>
                                            <h5><b>
                                                    <input type="checkbox" value="{{ $item->id }}"
                                                        style="width:20px;height:20px ; accent-color: #194bff;"
                                                        wire:model="selected"
                                                        wire:click="delete_parent({{ $item->id }})">
                                                    @if (Config::get('app.locale') == 'lo')
                                                        {{ $item->des_la }}
                                                    @elseif(Config::get('app.locale') == 'en')
                                                        {{ $item->des_en }}
                                                    @else
                                                        {{ $item->des_cn }}
                                                    @endif
                                                </b></h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->selected as $get_item)
                                        @if (intval($get_item) == $item->id)
                                            @php
                                                $child_fucntion = Illuminate\Support\Facades\DB::table('function_models')
                                                    ->where('parent_id', $get_item)
                                                    ->get();

                                            @endphp
                                            @foreach ($child_fucntion as $item_child)
                                                <tr>

                                                    <td>
                                                        <input type="checkbox" value="{{ $item_child->id }}"
                                                            style="width:20px;height:20px ;margin-left:10%; accent-color: #194bff;"
                                                            wire:model="selected"
                                                            wire:click="delete_child({{ $item_child->id }})"
                                                            style="margin-left:10%;">
                                                        @if (Config::get('app.locale') == 'lo')
                                                            {{ $item_child->des_la }}
                                                        @elseif(Config::get('app.locale') == 'en')
                                                            {{ $item_child->des_en }}
                                                        @else
                                                            {{ $item_child->des_cn }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    @foreach ($this->selected as $get_item_child)
                                                        @if (intval($get_item_child) == $item_child->id)
                                                            @php
                                                                $child_fucntion_child = Illuminate\Support\Facades\DB::table('function_models')
                                                                    ->where('parent_id', $item_child->id)
                                                                    ->get();
                                                            @endphp
                                                            @if ($child_fucntion_child->count() > 0)
                                                                @foreach ($child_fucntion_child as $item_child_two)
                                                                    <td><input type="checkbox"
                                                                            value="{{ $item_child_two->id }}"
                                                                            wire:model="selected"
                                                                            style="width:20px;height:20px ;margin-left:30%; accent-color: #194bff;"
                                                                            style="margin-left:20%;">
                                                                        @if (Config::get('app.locale') == 'lo')
                                                                            {{ $item_child_two->des_la }}
                                                                        @elseif(Config::get('app.locale') == 'en')
                                                                            {{ $item_child_two->des_en }}
                                                                        @else
                                                                            {{ $item_child_two->des_cn }}
                                                                        @endif
                                                                    </td>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <hr />
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('lang.cancel') }}</button>
                    @if (!$this->hiddenId)
                        <button wire:click="Store" type="button"
                            class="btn btn-primary">{{ __('lang.save') }}</button>
                    @else
                        <button wire:click="update" type="button"
                            class="btn btn-primary">{{ __('lang.edit') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-delete-->
    <div class="modal fade" id="modal-delete">
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
                    <button wire:click="destroy({{ $hiddenId }})" type="button"
                        class="btn btn-success">{{ __('lang.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
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
    </script>
@endpush
