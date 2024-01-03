<div>
    {{-- ======================================== name page ====================================================== --}}
    <div class="right_col" role="main">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h6> {{ __('lang.settings') }} <i
                                class="fa fa-angle-double-right"></i>
                            {{ __('lang.module_website') }}
                            <i class="fa fa-angle-double-right"></i>
                            {{ __('lang.slide') }}
                        </h6>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('backend.dashboard') }}">{{ __('lang.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('lang.slide') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- ======================================== show and seach data ====================================================== --}}
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="row">
                                    <div class="col-md-8">

                                    </div>
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
                                                <th>{{ __('lang.image') }}</th>
                                                <th>{{ __('lang.name') }}</th>
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
                                                        @if (!empty($item->image))
                                                            <a href="{{ asset($item->image) }}">
                                                                <img class="rounded" src="{{ asset($item->image) }}"
                                                                    width="60px;" height="60px;">
                                                            </a>
                                                        @else
                                                            <img src="{{ asset('logo/noimage.png') }}" width="60px;"
                                                                height="60px;">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{!! $item->description !!}</td>
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
                    <div class="col-md-5">
                        <div class="card card-default">
                            <div class="card-header bg-light">
                                <label>{{ __('lang.add_edit') }}</label>
                            </div>
                            <form>
                                <div class="card-body">
                                    <input type="hidden" wire:model="ID" value="{{ $ID }}">
                                    <div class="row">
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
                                                <label>{{ __('lang.image') }}</label>
                                                <input wire:model="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    placeholder="{{ __('lang.input') }}">
                                                @error('image')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">{{ __('lang.description') }}</label>
                                                    <div wire:ignore>
                                                        <textarea class="form-control" id="description" wire:model="description">{{$description}}</textarea>
                                                    </div>
                                                    @error('description')
                                                    <span style="color: red" class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
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
            <script type="text/javascript">
            $(function() {
                const FMButton = function(context) {
                    const ui = $.summernote.ui;
                    const button = ui.button({
                        contents: '<i class="note-icon-picture"></i> ',
                        tooltip: 'File Manager',
                        click: function() {
                            window.open('/file-manager/summernote', 'fm', 'width=1024,height=800');
                        }
                    });
                    return button.render();
                };
                $('#description').summernote({
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert', ['link', 'picture', 'video']],
                        ['fm-button', ['fm']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    buttons: {
                        fm: FMButton
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('description', contents);
                        },
                    }
                });
            });
        </script>
@endpush
