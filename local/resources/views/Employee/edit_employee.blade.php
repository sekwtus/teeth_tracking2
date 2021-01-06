@extends('layouts.template')

@section('stylesheet')


@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
    @foreach($data_Employee as $out_data_Employee)
    {{ Form::open(['method' => 'post' , 'url' => '/employee/saveedit/'.$out_data_Employee->ID_user, 'files' => true]) }}
      <div class="card">
        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
             <h4> &nbsp;&nbsp;Edit Employee</h4>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-3 m-0 step-timeline">
                <div class="row">
                    <div class="col-md-12" align="center">
                        <br>
                        @foreach($data_users as $out_data_users)

                        @if($out_data_users->picture_user != null)
                            <img class="img" src="{{ url('/local/public/file/').'/'.$out_data_users->picture_user }}" class="img-responsive" style="width:200px;height:80;">
                        @endif

                        @if($out_data_users->picture_user == null)
                            <img class="img" src="{{ url('/local/public/file/user1__2018-12-09_KsURh8W2.png') }}" class="img-responsive" style="width:200px;height:80;">
                        @endif

                        @endforeach
                        <br><br>
                        {{ Form::file('image') }}<br><br>
                    </div>
                </div>
            </div>
            <div class="col-md-9 step-content">
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
                                    เพิ่มข้อมูลผู้ใช้
                                    </a>
                                </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-left">

                                    <form class="forms-sample">

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Name">ชื่อ - นามสกุล</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Name',$out_data_Employee->Name, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="username">Username (Barcode)</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('username',$out_data_Employee->username, ['class' => 'form-control','placeholder' => 'ชื่อเล่น']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="col-form-label col-sm-2" for="Nick_name">ชื่อเล่น</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Nick_name',$out_data_Employee->Nick_name, ['class' => 'form-control','placeholder' => 'ชื่อเล่น']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="gender">เพศ</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('gender',$out_data_Employee->gender, ['class' => 'form-control','placeholder' => 'เพศ']) }}
                                            </div>

                                        </div>

                                        @if (Auth::user()->ID_type_users == 8)
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2" for="position">ประเภทผู้ใช้</label>
                                                <div class="col-sm-4">
                                                <select class="form-control" id="ID_type_users" name="ID_type_users" >
                                                        <option value="2">ขาย</option>
                                                </select>
                                                </div>

                                                <label class="col-form-label col-sm-2" for="department">แผนกย่อย</label>
                                                <div class="col-sm-4">
                                                <select class="form-control" id="sub_department" name="sub_department" required>
                                                        <option value="1">ขาย</option>
                                                </select>
                                                </div>
                                            </div>
                                        @else

                                        <div class="form-group row">
                                                <label class="col-form-label col-sm-2" for="position">ประเภทผู้ใช้</label>
                                                <div class="col-sm-4">
                                                <select class="form-control" id="ID_type_users" name="ID_type_users" required>
                                                    <option disabled value="0">เลือกประเภทผู้ใช้</option>
                                                @foreach($data_type_users as $out_data_type_users)
                                                    @if ($out_data_Employee->ID_type_users ==  $out_data_type_users->ID)
                                                    <option selected value="{{  $out_data_type_users->ID }}">{{  $out_data_type_users->Name }}</option>
                                                    @else
                                                    <option value="{{  $out_data_type_users->ID }}">{{  $out_data_type_users->Name }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                </div>

                                                <label class="col-form-label col-sm-2" for="department">แผนกย่อย</label>
                                                <div class="col-sm-4">

                                                @php $chk = 'chk'; @endphp
                                                    <select class="form-control" id="sub_department" name="sub_department" required >
                                                        <option disabled value="">เลือกแผนกย่อย</option>
                                                        @foreach($data_sub_department as $sub_depart)

                                                            @if ($sub_depart->dep_name != $chk)
                                                                <optgroup label="{{ $sub_depart->dep_name }}">
                                                                @php $chk = $sub_depart->dep_name; @endphp
                                                            @endif
                                                                @if ($out_data_Employee->Sub_DepartmentID ==  $sub_depart->ID)
                                                                <option selected value="{{  $sub_depart->ID }}">{{  $sub_depart->Name }}</option>
                                                                @else
                                                                <option value="{{  $sub_depart->ID }}">{{  $sub_depart->Name }}</option>
                                                                @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                        </div>
                                        @endif

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2" for="area">เขต</label>
                                                <div class="col-sm-4">
                                                @php $chk = 'chk'; @endphp
                                                <select class="form-control" id="area" name="area" required disabled>
                                                        <option value="">เลือกเขต</option>
                                                @foreach($area as $area)
                                                    @if ($out_data_Employee->ID_area ==  $area->ID)
                                                    <option selected value="{{  $area->ID }}">{{  $area->Name }}</option>
                                                    @else
                                                    <option value="{{  $area->ID }}">{{  $area->Name }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                                </div>

                                            </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Phone_Number">เบอร์โทรศัพท์</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Phone_Number',$out_data_Employee->Phone_Number, ['class' => 'form-control','placeholder' => 'เบอร์โทรศัพท์']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="Line_ID">Line ID</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Line_ID',$out_data_Employee->Line_ID, ['class' => 'form-control','placeholder' => 'Line ID']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="col-form-label col-sm-2" for="department">E-mail</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('email',$out_data_Employee->email, ['class' => 'form-control','placeholder' => 'อีเมล์']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="Branch">สาขา</label>
                                            <div class="col-sm-4">
                                            <select class="form-control" id="ID_type_Branch" name="Branch">
                                                    {{-- <option value="{{  $out_data_Employee->ID_type_Branch }}">{{  $out_data_Employee->type_Branch  }}</option> --}}
                                                @foreach($data_type_Branch as $out_data_type_Branch)
                                                    @if ($out_data_Employee->ID_type_Branch ==  $out_data_type_Branch->ID)
                                                    <option selected value="{{  $out_data_type_Branch->ID }}"> {{  $out_data_type_Branch->name_company }} - {{  $out_data_type_Branch->Name }} </option>
                                                    @else
                                                    <option value="{{  $out_data_type_Branch->ID }}"> {{  $out_data_type_Branch->name_company }} - {{  $out_data_type_Branch->Name }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
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
                <a href="{{ url('profile') }}">
                    <button type="submit" class="btn btn-lg btn-success">
                        <i class="mdi mdi-content-save"></i>
                        บันทึกข้อมูล
                    </button>
                </a>
                <a href="{{ url('employee') }}"><button type="button" class="btn btn-lg btn-danger">ยกเลิก
                    </button></a>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    @endforeach
    </div>
    </div>
    </div>
@stop
@section('scripts')
<script>
     $(document).ready(function(){
        if ($("#ID_type_users").val() == '2') {
                    $("#sub_department").val('1');
                    $("#sub_department").attr("style", "pointer-events: none;");
                    $("#area").prop('disabled', false);
            }else{
                $("#sub_department").val('');
                $("#sub_department").attr("style", "pointer-events: true;");
                $("#area").prop('disabled', true);
            }
     });
        $("#ID_type_users").change(function () {
            if ($("#ID_type_users").val() == '2') {
                    $("#sub_department").val('1');
                    $("#sub_department").attr("style", "pointer-events: none;");
                    $("#area").prop('disabled', false);
            }else{
                $("#sub_department").val('');
                $("#sub_department").attr("style", "pointer-events: true;");
                $("#area").prop('disabled', true);
            }
            });
        </script>
@stop
