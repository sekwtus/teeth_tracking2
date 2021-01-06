@extends('layouts.template')

@section('stylesheet')


@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
    {{ Form::open(['method' => 'post' , 'url' => '/changepassword/edit']) }}
      <div class="card">
        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
             <h4> &nbsp;&nbsp;Profile</h4>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12 step-content">
                    @if($errors->all())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif
                        <div class="accordion basic-accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    เปลี่ยนรหัสผ่าน
                                    </a>
                                </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-left">

                                    <form class="forms-sample">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Name">รหัสผ่านเก่า</label>
                                            <div class="col-sm-10">
                                            {{-- {{ Form::password('old_password',null, ['class' => 'form-control','placeholder' => 'รหัสผ่านเก่า']) }} --}}
                                                <input id="old_password" placeholder="รหัสผ่านเก่า" type="password" class="form-control" name="old_password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Name">รหัสผ่านใหม่</label>
                                            <div class="col-sm-10">
                                            {{-- {{ Form::text('password',null, ['class' => 'form-control','placeholder' => 'รหัสผ่านใหม่']) }} --}}
                                                <input id="password" placeholder="รหัสผ่านใหม่" type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Name">ยืนยันรหัสผ่านใหม่</label>
                                            <div class="col-sm-10">
                                            {{-- {{ Form::text('password_confirmation',null, ['class' => 'form-control','placeholder' => 'ยืนยันรหัสผ่านใหม่']) }} --}}
                                                <input id="password_confirmation" placeholder="ยืนยันรหัสผ่านใหม่" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>

                                    </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                    <button type="submit" class="btn btn-lg btn-success">
                        <i class="mdi mdi-content-save"></i>
                        บันทึกรหัสผ่าน
                    </button>

                    <a href="{{ url('profile') }}"><button type="button" class="btn btn-lg btn-danger">ยกเลิก
                    </button></a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    </div>
    </div>
    </div>
@stop
@section('script')
@stop
