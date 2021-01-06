@extends('layouts.template')

@section('stylesheet')


@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">

      <div class="card">
        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
             <h4> &nbsp;&nbsp;Profile</h4>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-3 m-0 step-timeline">
                <div class="row">
                    <div class="col-md-12" align="center">
                        <br><br>
                            <img src="{{ asset('images/Pc_Dental_Lab.JPG') }}" width="200" height="120"  alt="logo" />
                        <br><br><br><br>
                        @foreach($data_users as $out_data_users)

                        @if($out_data_users->picture_user != null)
                            <img class="img" src="{{ url('/local/public/file/').'/'.$out_data_users->picture_user }}" class="img-responsive" style="width:200px;height:80;">
                        @endif

                        @if($out_data_users->picture_user == null)
                            <img class="img" src="{{ url('/local/public/file/user1__2018-12-09_KsURh8W2.png') }}" class="img-responsive" style="width:200px;height:80;">
                        @endif

                        @endforeach
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="col-md-9 step-content">
                    <div class="accordion basic-accordion" role="tablist">
                            <div class="card">
                            @foreach($data_Employee as $out_data_Employee)
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    PC Dental Lab
                                    </a>
                                </h6>
                                </div>
                            <div id="collapseZero" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Name">ชื่อบริษัท</label>
                                            <div class="col-sm-10">
                                            {{ Form::text('Name','บริษัท พี ซี เด็นตัล แลป จำกัด', ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Name">ชื่อ - นามสกุล</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Name',$out_data_Employee->Name, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="Nick_name">ชื่อเล่น</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Nick_name',$out_data_Employee->Nick_name, ['class' => 'form-control','placeholder' => 'ชื่อเล่น','readonly']) }}
                                            </div>
                                        </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>





                        <div class="accordion basic-accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    รายละเอียดข้อมูลผู้ใช้
                                    </a>
                                </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-left">

                                    <form class="forms-sample">
                                    @foreach($data_Employee as $out_data_Employee)
                                        {{-- <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Name">ชื่อ - นามสกุล</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Name',$out_data_Employee->Name, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="username">username</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('username',$out_data_Employee->username, ['class' => 'form-control','placeholder' => 'ชื่อเล่น','readonly']) }}
                                            </div>
                                        </div> --}}

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="username">username</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('username',$out_data_Employee->username, ['class' => 'form-control','placeholder' => 'ชื่อเล่น','readonly']) }}
                                            </div>
                                            <label class="col-form-label col-sm-2" for="ID_Employee">รหัสพนักงาน</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('ID_Employee',$out_data_Employee->ID_Employee, ['class' => 'form-control','placeholder' => 'รหัสพนักงาน','readonly']) }}
                                            </div>

                                            {{-- <label class="col-form-label col-sm-2" for="Nick_name">ชื่อเล่น</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Nick_name',$out_data_Employee->Nick_name, ['class' => 'form-control','placeholder' => 'ชื่อเล่น','readonly']) }}
                                            </div> --}}
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="position">ตำแหน่ง</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('position',$out_data_Employee->name_position, ['class' => 'form-control','placeholder' => 'ตำแหน่ง','readonly']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="gender">เพศ</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('gender',$out_data_Employee->gender, ['class' => 'form-control','placeholder' => 'เพศ','readonly']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Phone_Number">เบอร์โทรศัพท์</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Phone_Number',$out_data_Employee->Phone_Number, ['class' => 'form-control','placeholder' => 'เบอร์โทรศัพท์','readonly']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="Line_ID">Line ID</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Line_ID',$out_data_Employee->Line_ID, ['class' => 'form-control','placeholder' => 'Line ID','readonly']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="department">E-mail</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('email',$out_data_Employee->email, ['class' => 'form-control','placeholder' => 'อีเมล์','readonly']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="department">แผนก</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('department',$out_data_Employee->department, ['class' => 'form-control','placeholder' => 'แผนก','readonly']) }}
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="cotton">ฝ่าย</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('cotton',$out_data_Employee->cotton, ['class' => 'form-control','placeholder' => 'ฝ่าย','readonly']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="Branch">สาขา</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Branch',$out_data_Employee->type_Branch, ['class' => 'form-control','placeholder' => 'สาขา','readonly']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="col-form-label col-sm-2" for="company">บริษัท</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('company',$out_data_Employee->company, ['class' => 'form-control','placeholder' => 'บริษัท','readonly']) }}
                                            </div>
                                        </div>
                                    @endforeach
                                    </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                <a href="{{ url('changepassword') }}">
                    <button type="submit" class="btn btn-lg btn-danger">
                        <i class="mdi mdi-lock-open"></i>
                        เปลี่ยนรหัสผ่าน
                    </button>
                </a>

                <a href="{{ url('editprofile') }}">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="mdi mdi-account"></i>
                        แก้ไขโปรไฟล์
                    </button>
                </a>
            </div>
        </div>
    </div>

    </div>
    </div>
    </div>
@stop
@section('script')
@stop
