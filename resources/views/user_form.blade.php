<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Forms</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->

                        @foreach ($forms as $row)
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $row->form_name }}</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">


                                    <form class="pt-3" id="userForm{{$row->id}}" method="POST" action="{{ route('forms.save', $row->id) }}">
                                        @csrf
                                        <div class="row">
                                            @foreach ($row->FormField as $row1)
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ $row1->field_name }}</label>
                                                        @if ($row1->field_type == 'text')
                                                            <input type="text" class="form-control" name="field_name[{{$row1->field_name}}]" required>
                                                        @elseif ($row1->field_type == 'text_area')
                                                            <textarea class="form-control" name="field_name[{{$row1->field_name}}]" rows="2" required></textarea>
                                                        @elseif ($row1->field_type == 'select')
                                                            <select class="form-control select2" style="width: 100%;" name="field_name[{{$row1->field_name}}]" required>
                                                                <option value="">Select</option>
                                                                @foreach($row1->options as $option)
                                                                    <option value="{{ $option->options }}">{{ $option->options }}</option>
                                                                @endforeach
                                                            </select>
                                                        @elseif ($row1->field_type == 'radio')
                                                            <div class="row">
                                                                @foreach($row1->options as $key => $option)
                                                                    <div class="form-group {{ $key != 0 ? 'ml-2' : ''}}">
                                                                        <input type="radio" name="field_name[{{$row1->field_name}}]" value="{{ $option->options }}">
                                                                        <label>{{ $option->options }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @elseif ($row1->field_type == 'check_box')
                                                            <div class="row">
                                                                @foreach($row1->options as $key => $option)
                                                                    <div class="form-group {{ $key != 0 ? 'ml-2' : '' }}">
                                                                        <input type="checkbox" name="field_name[{{$row1->field_name}}]" value="{{ $option->options }}">
                                                                        <label>{{ $option->options }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        @endforeach
                        <!-- /.row -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->
@include('admin.layouts.footer')
