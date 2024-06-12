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
                        <li class="breadcrumb-item active">Add Form</li>
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
                            <h3 class="card-title">ADD CUSTOM FORM</h3>

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
                            <form class="pt-3" id="userForm" method="POST" action="{{ route('admin.form.save') }}">
                                @csrf
                                <h6><b>Follow the Steps: for creating a form.</b></h6>
                                <h6>1. Enter  Form Name and Field Name ,it is mandatory.</h6>
                                <h6>2. Select Field Type, it is mandatory.</h6>
                                <h6>3. `+` button for adding new field.</h6>
                                <h6>4. Click `options` button and add a option value, `options` is mandatory for all fields. Otherwise throw error.</h6>
                                <h6>5. `x` button for cancelling the fields.</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Form Name</label>
                                            <input type="text" class="form-control" name="form_name" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6"></div>
                                    <!-- /.col -->
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Field Name</label>
                                            <input type="text" class="form-control" name="field_name[]" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Field Type</label>
                                            <select class="form-control select2" style="width: 100%;"
                                                    name="field_type[]" required>
                                                <option value="">Select</option>
                                                @foreach($fields as $field)
                                                    <option value="{{ $field->slug }}">{{ $field->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" name="add" id="add" class="btn btn-primary"
                                                style="margin-left: -7px;margin-top: 33px;">+
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" name="add_option" id="myBtn" class="btn btn-primary" style="margin-left: -61px;margin-top: 33px;">options</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <div class="add_option_1"></div>

                                <div class="addCustomField"></div>
                                <button type="submit" class="btn btn-primary">Save</button>

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

            var i = 1;

            $("#add").click(function () {
                i++;

                let field = `<div class="row" id="new_row_${i}">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="field_name[${i}]" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control select2" style="width: 100%;" name="field_type[${i}]" required><option>Select</option>@foreach($fields as $field)<option value="{{ $field->slug }}">{{ $field->name }}</option>@endforeach</select>
                        </div>
                    </div>
                    <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove" style="height: 10%;">X</button>
                    <button type="button" name="add" id="new_row_option_${i}" class="btn btn-primary" style="margin-left: 14px;height: 37px;">options</button>
                </div>
                <div class="add_option_${i}"></div>`;

                $('.addCustomField').append(field);

                $(`#new_row_option_${i}`).on('click', function () {
                    let option = `<div class="row" id="row_op_${i}">
                        <div class="col-md-4"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="field_option[${i}][]"required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove2" style="margin-left: -6px;">X</button>
                        </div>
                    </div>
                    <div class="new_row_1"></div>`;
                    $(`.add_option_${i}`).append(option);

                });
            });

            var j = 1;
            $("#myBtn").click(function () {
                j++;

                $('.add_option_1').append('<div class="row" id="row_op_' + i + '"> <div class="col-md-4"></div> <div class="col-md-3"> <div class="form-group"> <input type="text" class="form-control" name="field_option[0][]"required> </div> </div> <div class="col-md-1"> <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove2" style="margin-left: -6px;">X</button></div></div><div class="new_row_1"></div>');
            });


            $("#add_option_field").click(function () {
                i++;

                $('.new_row').append('<div class="row" id="new_row_' + i + '"> <div class="col-md-9"> <div class="form-group"> <input type="text" class="form-control" name="field_option[0][]" required> </div> </div> <button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" style="height: 10%;">X</button>');
            });

            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#new_row_' + button_id + '').remove();
            });

            $(document).on('click', '.btn_remove2', function () {
                var button_id = $(this).attr("id");
                $('#row_op_' + button_id + '').remove();
            });
        });
    </script>
