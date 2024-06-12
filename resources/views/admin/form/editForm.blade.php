@include('admin.layouts.header')
@include('admin.layouts.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">CUSTOM FORM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Form</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="alert alert-success" id="productSuccess" style="display: none">
                        <strong>Success!</strong> Product Added Successfully.
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Edit CUSTOM FORM</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form class="pt-3" id="userForm" method="POST" action="{{ route('admin.form.update', $forms->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Form Name</label>
                                            <input type="text" class="form-control" name="form_name"
                                                   value="{{ $forms->form_name }}" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6"></div>
                                    <!-- /.col -->
                                </div>
                                @php
                                    $optionCount = 0;
                                @endphp
                                @foreach($form_fields as $key => $each)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Field Name</label>
                                                <input type="text" class="form-control" name="field_name[]" required
                                                       value="{{ $each->field_name }}">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Field Type</label>
                                                <select class="form-control select2" style="width: 100%;" data-id="{{$each->id}}" name="field_type[]" required>
                                                    <option value="">Select</option>
                                                    @foreach($fields as $field)
                                                        <option value="{{ $field->slug }}" {{ $each->field_type == $field->slug ? 'selected' : '' }}>{{ $field->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.form-group -->

                                        </div>
                                        @if($key == 0)
                                            <div class="col-md-1">
                                                <button type="button" name="add" id="add" class="btn btn-primary"
                                                        style="margin-left: -7px;margin-top: 33px;">+
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-md-1">
                                                <button type="button" name="remove" class="btn btn-danger btn_remove"
                                                        style="margin-left: -7px; margin-top: 33px;">X
                                                </button>
                                            </div>
                                        @endif
                                        <div class="col-md-1">
                                            @if ($each->field_type == 'select' || $each->field_type == 'radio' || $each->field_type == 'check_box')
                                                <button type="button" name="add_option" id="optionBtn{{$each->id}}" data-id="{{$each->id}}" class="optionBtn btn btn-primary" style="margin-top: 33px;">options</button>
                                            @else
                                                <button type="button" name="add_option" id="optionBtn{{$each->id}}" data-id="{{$each->id}}" class="optionBtn btn btn-primary" style="margin-top: 33px; display:none;">options</button>
                                            @endif
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    @foreach($each->options as $key1 => $option)
                                        <div class="row" id="row_op_{{$option->id}}">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="field_option[{{$key}}][]"
                                                           required value="{{ $option->options }}">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" name="remove" data-id="{{$option->id}}" class="btn btn-danger btn_remove2" style="margin-left: -6px;">X</button>
                                            </div>
                                        </div>
                                        @php
                                            $optionCount++;
                                        @endphp
                                    @endforeach
                                    <div class="add_option_{{$each->id}}"></div>

                                @endforeach

                                <input type="hidden" name="optionCount" value="{{$optionCount}}">

                                <div class="addCustomField"></div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <div class="add_modal"></div>
                            </form>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @include('admin.layouts.footer')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <script>


        $(document).ready(function () {

            var i = {{ count($form_fields)}};

            $("#add").click(function () {
                i++;
                let field = `<div class="row" id="new_row_${i}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Field Type</label>
                                <input type="text" class="form-control" name="field_name[${i}]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Field Type</label>
                                <select class="form-control select2" data-id="${i}" style="width: 100%;" name="field_type[${i}]" required>
                                    <option>Select</option>@foreach($fields as $field)<option value="{{ $field->slug }}">{{ $field->name }}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" name="remove" data-id="new_row_${i}" class="btn btn-danger btn_remove" style="margin-left: -6px; margin-top: 33px">X</button>
                        </div>
                        <div class="col-md-1">
                            <button type="button" name="add_option" id="optionBtn${i}" data-id="${i}" class="optionBtn btn btn-primary" style="margin-top: 33px; display:none;">options</button>
                        </div>
                    </div>
                    <div class="add_option_${i}"></div>`;
                $('.addCustomField').append(field);
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).data("id");
                $(`#${button_id}`).remove();
            });

            $(document).on('click', '.optionBtn', function () {
                let id = $(this).data('id');
                let field = `<div class="row" id="row_op_${id}">
                    <div class="col-md-4"></div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="field_option[${id}][]"required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" name="remove" data-id="${id}" class="btn btn-danger btn_remove2" style="margin-left: -6px;">X</button>
                        </div>
                    </div>`;
                $(`.add_option_${id}`).append(field);
            });

            $(document).on('click', '.btn_remove2', function () {
                let button_id = $(this).data("id");
                $(`#row_op_${button_id}`).remove();
            });

            $(document).on('change', '.select2', function () {
                let selectId = $(this).data("id");
                let option = $(this).val();
                if(option == 'select' || option == 'radio' || option == 'check_box'){
                    $(`#optionBtn${selectId}`).show();
                }
                else{
                    $(`#optionBtn${selectId}`).hide();
                }
            });
        });
    </script>
