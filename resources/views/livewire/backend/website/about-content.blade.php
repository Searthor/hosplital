<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h6> {{ __('lang.settings') }} <i class="fa fa-angle-double-right"></i>
                        {{ __('lang.module_website') }}
                        <i class="fa fa-angle-double-right"></i>
                        {{ __('lang.about') }}
                    </h6>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('backend.dashboard') }}">{{ __('lang.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('lang.about') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"
                            style="background: linear-gradient(90deg, rgba(26,159,245,1) 20%, rgba(33,8,176,1) 52%, rgba(61,8,176,1) 84%);">
                            <h5 style="color:#fff"><b><i class="fas fa-building"></i> ຂໍ້ມູນກ່ຽວກັບບໍລິສັດ</b></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' wire:model="image" id="imageUpload2"
                                                accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload2"></label>
                                        </div>
                                        @if ($image)
                                            <div class="avatar-preview">
                                                <img id="imagePreview2" src="{{ asset($image->temporaryUrl()) }}"
                                                    alt="" width="120px;">
                                            </div>
                                        @else
                                            @if ($newimage)
                                                <div class="avatar-preview">
                                                    <img id="imagePreview2"
                                                        src="{{ asset('employee') }}/{{ $newimage }}" alt=""
                                                        width="120px;">
                                                </div>
                                            @else
                                                <div class="avatar-preview">
                                                    <div id="imagePreview2"
                                                        style="background-image: url({{ asset('logo/noimage.jpg') }});">
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12" wire:ignore>
                                    <div class="form-group">
                                        <label>{{ __('lang.description') }}</label>
                                        <textarea type="text" wire:model="description" placeholder="{{ __('lang.description') }}"
                                            class="form-control @error('description') is-invalid @enderror" id="description">
                                        </textarea>
                                    </div>
                                    @error('description')
                                        <span style="color: red" class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-12" wire:ignore>
                                        <div id="map-update-s" style="height:250px; width: 100%;" class="my-3"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>ສະເເດງແຜນທີ່</label>
                                            <button type="button" class="btn btn-outline-primary form-control"><a href="#" onclick="getLocations()"><i class="fas fa-map-marker-alt"></i> ສະເເດງແຜນທີ່ <i class="icon-long-arrow-right"></i></a></button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>lat</label>
                                            <input wire:model="lats" placeholder="lat" type="text"
                                                class="form-control @error('lats') is-invalid @enderror" id="lats" readonly>
                                            @error('lats')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>long</label>
                                            <input wire:model="longs" placeholder="long" type="text"
                                                class="form-control @error('longs') is-invalid @enderror" id="longs" readonly>
                                            @error('longs')
                                            <span style="color: red" class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}

                            </div>
                        </div>
                        <div class="card-footer">
                            {{-- @foreach ($rolepermissions as $items)
                                @if ($items->permissionname->name == 'action_about') --}}
                            <button wire:click="update" class="btn btn-success"><i class="fa fa-edit"></i>
                                {{ __('lang.save') }}{{ __('lang.edit') }}</button>
                            <button class="btn btn-warning float-right"><i class="fa fa-trash"></i> ລ້າງຂໍ້ມູນ</button>
                            {{-- @endif
                                @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
    @push('scripts')
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
</div>
{{-- @include('livewire.backend.company.script') --}}
