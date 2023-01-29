@extends('admin/index')
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">UPDATE PLAN</h3>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('update_plan', $plans->id) }}" method="post">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">MRP</label>
                        <input type="text" class="form-control" name='mrp' placeholder="Enter MRP"
                            value="<?php echo $plans->mrp; ?>">
                        @error('mrp')
                            <span class="text-danger">{{ $message }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">VALIDITY</label>
                            <input type="text" class="form-control" name='validity' placeholder=" Enter Validity"
                                value="<?php echo $plans->validity; ?>">
                            @if ($errors->has('validity'))
                                <span class="text-danger">{{ $errors->first('validity') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">TOTAL DATA</label>
                            <input type="text" class="form-control" name='total_data' placeholder="Enter Total data"
                                value="<?php echo $plans->total_data; ?>">
                            @if ($errors->has('total_data'))
                                <span class="text-danger">{{ $errors->first('total_data') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">SPEED</label>
                            <input type="text" class="form-control" name='speed' placeholder="Enter Speed"
                                value="<?php echo $plans->speed; ?>">
                            @if ($errors->has('speed'))
                                <span class="text-danger">{{ $errors->first('speed') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">VOICE</label>
                            <input type="text" class="form-control" name='voice' placeholder="Enter Voice"
                                value="<?php echo $plans->voice; ?>">
                            @if ($errors->has('voice'))
                                <span class="text-danger">{{ $errors->first('voice') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">SMS</label>
                            <input type="text" class="form-control" name='sms' placeholder="Enter Sms"
                                value="<?php echo $plans->sms; ?>">
                            @if ($errors->has('sms'))
                                <span class="text-danger">{{ $errors->first('sms') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">OTHER ADDON</label>
                            <input type="text" class="form-control" name='other_addon' placeholder="Enter Other addon"
                                value="<?php echo $plans->other_addon; ?>">
                            @if ($errors->has('other_addon'))
                                <span class="text-danger">{{ $errors->first('other_addon') }}</span>
                            @endif
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
    
