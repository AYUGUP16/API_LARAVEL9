@extends('admin/index')
@section('content')

<div class="container">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">ADD PLANS</h3>
        </div>
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">MRP</label>
                    <input type="text" class="form-control" name='mrp' id="exampleInputEmail1" placeholder="Enter MRP">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">VALIDITY</label>
                    <input type="text" class="form-control" name='validity' id="exampleInputPassword1" placeholder=" Enter Validity">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">TOTAL DATA</label>
                    <input type="text" class="form-control" name='total_data' id="exampleInputPassword1" placeholder="Enter Total data">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">SPEED</label>
                    <input type="text" class="form-control" name='speed' id="exampleInputPassword1" placeholder="Enter Speed">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">VOICE</label>
                    <input type="text" class="form-control" name='voice' id="exampleInputPassword1" placeholder="Enter Voice">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">SMS</label>
                    <input type="text" class="form-control" name='sms' id="exampleInputPassword1" placeholder="Enter Sms">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">OTHER ADDON</label>
                    <input type="text" class="form-control" name='other_addon' id="exampleInputPassword1" placeholder="Enter Other addon">
                </div>

            </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>
@endsection