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
                                    <strong>
                                        <h3 class="card-title">HERE OUR ACTIVE PLANS</h3>
                                    </strong>
                                </div>
                                <button class="btn btn-primary btn-sm" id="show_data" class="show">show data</button>
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
                                                {{-- <th>STATUS</th> --}}
                                                {{-- <th>DELETE</th>
                                                <th>EDIT</th> --}}


                                            </tr>
                                        </thead>
                                        <tbody id="bodyData">

                                        </tbody>
                                            {{-- @foreach ($plans as $key => $item)
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
                                                        @if ($item->status == 1)
                                                            <div class="text-danger mySelect" data-id={{ $item->id }}
                                                                name='0'>Active</div>
                                                        @else
                                                            <div class="text-danger mySelect" data-id={{ $item->id }}
                                                                name='1'>Inactive</div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ url('admin/delete-plan') }}/{{ $item->id }}"
                                                            class="btn btn-danger btn-sm">Delete</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('admin/update-plan') }}/{{ $item->id }}"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </td>

                                                </tr>

                                                </tfoot>
                                            @endforeach --}}

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.mySelect').on('click', function() {
            var status = $(this).attr('name');
            var id = $(this).attr('data-id');
            $.ajax({
                type: 'get',
                url: '{{ route('update_status') }}',
                data: {
                    status,
                    id
                },
                success: function(data) {
                    if (data == '0') {
                        $('.mySelect[data-id=' + id + ']').html('Inactive');
                    } else {
                        $('.mySelect[data-id=' + id + ']').html('Active');
                    }

                }
            });

        });

    });
</script>
<script>
   $(document).ready(function() {
        $.ajax({
            url: "{{ url('admin/list-plan') }}",
            type: "GET",
            data:{
                _token:'{{ csrf_token() }}'
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
            }











        });
