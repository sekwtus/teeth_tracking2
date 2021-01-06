@extends('layouts.template')

@section('stylesheet')

<link rel="stylesheet" href="./css/shared/style.css">
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
            <!--vertical wizard-->
            <div class="row">
                    <div class="col-12 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          {{-- <form id="example-vertical-wizard" action="#"> --}}
                            {{ Form::open(['method' => 'post' , 'url' => '/employee/add' ,'id'=>'example-vertical-wizard', 'files' => true]) }}
                            <div>
                              <h3>บัญชีผู้ใช้</h3>
                              <section style="height : 100%; width:100%; auto; overflow-y: auto; ">

                                <div class="form-group row">
                                      <div class="col-md-5" align="center">
                                         <br>
                                             <img class="img" src="{{ url('/local/public/file/user1__2018-12-09_KsURh8W2.png') }}" class="img-responsive" style="width:150px;height:150px;">
                                         {{-- @if($out_data_users->picture_user == null)
                                             <img class="img" src="{{ url('/local/public/file/user1__2018-12-09_RNVwN8y7.png') }}" class="img-responsive" style="width:200px;height:80;">
                                         @endif --}}
                                         <br><br>
                                         {{ Form::file('image') }}<br><br>
                                     </div>
                                     <div class="col-md-7" align="center">
                                       <div class="row">
                                          <label class="col-form-label col-sm-4" for="Name">ชื่อ - นามสกุล</label>
                                          <div class="col-sm-8">
                                          {{ Form::text('Name',null, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน']) }}
                                          </div>
                                       </div>
                                       <br>

                                       <div class="row">
                                          <label class="col-form-label col-sm-4" for="username">Username (Barcode)</label>
                                          <div class="col-sm-8">
                                          {{ Form::text('username',null, ['class' => 'form-control','placeholder' => 'Username (Barcode)']) }}
                                          </div>
                                       </div>
                                       <br>

                                       <div class="row">
                                          <label class="col-form-label col-sm-4" for="Nick_name">รหัสผ่าน</label>
                                          <div class="col-sm-8">
                                              <input id="password" placeholder="รหัสผ่าน" type="password" class="form-control" name="password" required>
                                          </div>
                                       </div>
                                       <br>

                                       <div class="row">
                                          <label class="col-form-label col-sm-4" for="gender">ยืนยันรหัสผ่าน</label>
                                          <div class="col-sm-8">
                                              <input id="password_confirmation" placeholder="ยืนยันรหัสผ่าน" type="password" class="form-control" name="password_confirmation" required>
                                          </div>
                                      </div>

                                      </div>



                                 </div>
                                          @if($errors->all())
                                              <div class="alert alert-danger">
                                                  {{ $errors->first() }}
                                              </div>
                                          @endif

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Nick_name">ชื่อเล่น</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Nick_name',null, ['class' => 'form-control','placeholder' => 'ชื่อเล่น']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="gender">เพศ</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('gender',null, ['class' => 'form-control','placeholder' => 'เพศ']) }}
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
                                            <select class="form-control" id="ID_type_users" name="ID_type_users" >
                                                    <option value="0">เลือกประเภทผู้ใช้</option>
                                            @foreach($data_type_users as $out_data_type_users)
                                                <option value="{{  $out_data_type_users->ID }}">{{  $out_data_type_users->Name }}</option>
                                            @endforeach
                                            </select>
                                            </div>

                                            <label class="col-form-label col-sm-2" for="department">แผนกย่อย</label>
                                            <div class="col-sm-4">
                                            @php $chk = 'chk'; @endphp
                                            <select class="form-control" id="sub_department" name="sub_department" required>
                                                    <option value="">เลือกแผนกย่อย</option>
                                            @foreach($data_sub_department as $sub_depart)

                                                @if ($sub_depart->dep_name != $chk)
                                                    <optgroup label="{{ $sub_depart->dep_name }}">
                                                    @php $chk = $sub_depart->dep_name; @endphp
                                                @endif
                                                <option value="{{  $sub_depart->ID }}">{{  $sub_depart->Name }}</option>

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
                                                <option value="{{  $area->ID }}">{{  $area->Name }}</option>
                                            @endforeach
                                            </select>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2" for="Phone_Number">เบอร์โทรศัพท์</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Phone_Number',null, ['class' => 'form-control','placeholder' => 'เบอร์โทรศัพท์']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="Line_ID">Line ID</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('Line_ID',null, ['class' => 'form-control','placeholder' => 'Line ID']) }}
                                            </div>
                                        </div>

                                        <div class="form-group row">

                                            <label class="col-form-label col-sm-2" for="department">E-mail</label>
                                            <div class="col-sm-4">
                                            {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'อีเมล์']) }}
                                            </div>

                                            <label class="col-form-label col-sm-2" for="Branch">สาขา</label>
                                            <div class="col-sm-4">
                                            <select class="form-control" id="ID_type_Branch" name="Branch">
                                                    {{-- <option value="{{  $out_data_Employee->ID_type_Branch }}">{{  $out_data_Employee->type_Branch  }}</option> --}}
                                                @foreach($data_type_Branch as $out_data_type_Branch)
                                                    <option value="{{  $out_data_type_Branch->ID }}"> {{  $out_data_type_Branch->name_company }} - {{  $out_data_type_Branch->Name }} </option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                              </section>

                            </div>
                            {{ Form::close() }}
                          {{-- </form> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

@stop
@section('scripts')
{{-- <script src=".vendor/js/vendor.bundle.base.js"></script> --}}
{{-- <script src=".vendor/js/vendor.bundle.addons.js"></script> --}}
<script>
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




