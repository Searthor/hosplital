<div wire:poll>

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 5px;
            bottom: 3.3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(30px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 50px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5><i class="fas fa-layer-group"></i>
                        ຄົນໄຂ
                        <i class="fas fa-angle-double-right"></i>
                        ລາຍລະອຽດ
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">{{ __('lang.home') }}</a>
                        </li>
                        /ລາຍລະອຽດ
                    </ol>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#address').summernote({
                toolbar: [
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
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('address', contents);
                    },
                }
            });






        });
    </script>










    <script>
        $(document).ready(function() {
            $('#select-person').select2();
        });


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

