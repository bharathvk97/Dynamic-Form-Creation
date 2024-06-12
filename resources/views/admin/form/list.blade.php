@include('admin.layouts.header')
@include('admin.layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="col-md-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">Sl No</th>
                        <th>Form Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forms as $each)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $each->form_name }}</td>
                            <td><a href="{{ route('admin.form.edit') }}/{{ $each->id }}" style="color: black;"><i class="fas fa-edit fa-fw"></i> </a>
                                <a href="{{ route('admin.form.delete') }}/{{ $each->id }}" style="color: black;"><i class="fas fa-trash fa-fw"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>

</div>
<!-- /.content-wrapper -->
@include('admin.layouts.footer')

<script>
    $(document).ready(function () {
        //loadUsers();

        {{--$('.searchUser').click(function () {--}}
        {{--    loadUsers();--}}
        {{--});--}}

        {{--function loadUsers()--}}
        {{--{--}}
        {{--    $.post('{{ route('user.search') }}', $('.filterForm').serialize(), function (response) {--}}
        {{--        $('.reportContainer').html(response);--}}
        {{--    }).fail(function (response) {--}}
        {{--        window.location.reload();--}}
        {{--    });--}}
        {{--}--}}
    });
</script>

