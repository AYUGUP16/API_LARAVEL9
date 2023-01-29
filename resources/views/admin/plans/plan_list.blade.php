@extends('admin/index')
@section('content')
    <div class="container">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Plans List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">DataTables</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong><h3 class="card-title">HERE OUR ACTIVE PLANS</h3></strong>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>MRP</th>
                                                <th>VALIDITY</th>
                                                <th>TOTAL DATA</th>
                                                <th>SPEED</th>
                                                <th>VOICE</th>
                                                <th>SMS</th>
                                                <th>OTHER ADDONS PLAN</th>
                                                <th>DELETE</th>
                                                <th>EDIT</th>
                                                

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($plans as $key => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->mrp }}</td>
                                                    <td>{{ $item->validity }}</td>
                                                    <td>{{ $item->total_data }}</td>
                                                    <td>{{ $item->speed }}</td>
                                                    <td>{{ $item->voice }}</td>
                                                    <td>{{ $item->sms }}</td>
                                                    <td>{{ $item->other_addon }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/delete-plan') }}/{{$item->id}}" class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('admin/update-plan') }}/{{ $item->id }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </td>

                                                </tr>

                                                </tfoot>
                                            @endforeach
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </section>

        </div>
    </div>
@endsection
