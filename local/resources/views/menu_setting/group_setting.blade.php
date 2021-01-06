@extends('layouts.template')

@section('stylesheet')

<style>
        /* The container */
        .container {
          display: block;
          position: relative;
          padding-left: 35px;
          margin-bottom: 12px;
          cursor: pointer;
          font-size: 22px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
          position: absolute;
          opacity: 0;
          cursor: pointer;
          height: 0;
          width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
          position: absolute;
          top: 0;
          left: 0;
          height: 25px;
          width: 25px;
          background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
          background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
          background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
          content: "";
          position: absolute;
          display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
          display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
          left: 9px;
          top: 5px;
          width: 5px;
          height: 10px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
        }
          .tab-solid-info .nav-link.active {
          background: #8862e0; }

        </style>

@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
<div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h3>กำหนดสิทธิ์กลุ่มผู้ใช้งาน</h3>
            <div class="row ml-md-0 mr-md-0 vertical-tab tab-minimal">
              <ul class="nav nav-tabs tab-solid tab-solid-info mr-4" style=" margin-right: 0.5rem !important;" role="tablist">

                @foreach ($data_type_name as $type_name)
                    {{-- active first tab --}}
                    @if($type_name->ID == '1')
                    <li class="nav-item">
                        <a class="nav-link active" id="tab{{ $type_name->ID }}" data-toggle="tab" href="#permission{{ $type_name->Name }}" role="tab" aria-controls="dashboard-2-1" aria-selected="true">
                          &nbsp;&nbsp;{{ $type_name->Name }}</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" id="tab{{ $type_name->ID }}" data-toggle="tab" href="#permission{{ $type_name->Name }}" role="tab" aria-controls="dashboard-2-1" aria-selected="true">
                        &nbsp;&nbsp;{{ $type_name->Name }}</a>
                    </li>
                    @endif
                @endforeach

                <li class="nav-item">
                   <a class="nav-link" id="tab-2-4" data-toggle="tab" href="#addType" role="tab" aria-controls="addType" aria-selected="false">
                   &nbsp;&nbsp;เพิ่มกลุ่มผู้ใช้งาน</a>
                </li>
              </ul>

              <div class="tab-content col-md-10">
            @foreach ($data_type_name as $type_name2)
            {{-- active first tab --}}
            @if($type_name2->ID == '1')
                <div class="tab-pane fade show active" id="permission{{ $type_name2->Name }}" role="tabpanel" aria-labelledby="tab{{ $type_name2->ID }}">
                    <div class="row" >
                        {{ Form::open(['method'=>'post' , 'url' =>'/group_setting/permission_group' ,'class'=>'forms-sample' ]) }}
                        <input type="hidden" name="id_type_name" value="{{ $type_name2->ID }}"/>
                        <input type="hidden" name="type_name" value="{{ $type_name2->Name }}"/>
                            <div class="col-md-6">
                                            <table class="table table-hover" style="background:#fff;"  >
                                                    <thead>
                                                      <tr>
                                                        <th >เมนู</th>
                                                        <th >สิทธิ์การใช้งาน</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data_menu as $out_data_menu)
                                                            @if(($out_data_menu->menu_parent / 100) == 0)
                                                        <tr>
                                                            <td>
                                                                <i class="menu-icon mdi mdi-{{ $out_data_menu->menu_icon }}"></i>&nbsp;
                                                                <span class="menu-title">{{ $out_data_menu->menu_name }}</span>
                                                            </td>
                                                            @foreach ($data_permission as $out_data_permission)
                                                                @if ($type_name2->ID == $out_data_permission->group_id && $out_data_menu->menu_name == $out_data_permission->Name && $out_data_permission->permission == '1')
                                                                <td>
                                                                    <label class="container">
                                                                      <input type="checkbox" checked name="name[]" id="{{ $out_data_menu->menu_name }}" value="{{ $out_data_menu->menu_name }}">
                                                                      <span class="checkmark"></span>
                                                                    </label>
                                                                </td>
                                                                @elseif($type_name2->ID == $out_data_permission->group_id && $out_data_menu->menu_name == $out_data_permission->Name && $out_data_permission->permission == '0')
                                                                    <td>
                                                                        <label class="container">
                                                                        <input type="checkbox" name="name[]" id="{{ $out_data_menu->menu_name }}" value="{{ $out_data_menu->menu_name }}">
                                                                        <span class="checkmark"></span>
                                                                        </label>
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                  </table>
                                                  <br>
                                                   {{-- button --}}

                                                   <div class="row">
                                                        {{-- <div class="col-md-8">
                                                            <a class="nav nav-tabs mr-1 " id="tab-2-1-1" data-toggle="tab" href="#adduser-2-1-1" role="tablist" aria-controls="dashboard-2-1" aria-selected="true">
                                                                    <button type="button" class="btn btn-outline-info ">เพิ่มผู้ใช้งาน</button></a>
                                                        </div>ปุ่มเพิ่มผู้ใช้งาน --}}
                                                        
                                                        {{-- <div class="col-md-6">
                                                            <a href="#"><button type="button" class="btn btn-danger">ยกเลิก
                                                                </button></a>
                                                        </div> --}}
                                                        <div class="col-md-6">
                                                            <a href="#">
                                                                <button type="submit" class="btn btn-success">บันทึก
                                                            </button> </a>
                                                        </div>
                                                </div>

                            </div>
                            {{ form::close() }}

                             {{-- add user --}}
                            <div class="col-md-6">
                                <div class="tab-pane fade" id="adduser-2-1-1" role="tabpanel" aria-labelledby="tab-2-1-1">
                                        <table class="table table-hover" style="background:#fff;"  >
                                                <thead>
                                                  <tr>
                                                    <th >ผู้ใช้งาน</th>
                                                    <th >เพิ่มเข้ากลุ่ม</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td> user1 </td>

                                                    <td>
                                                         <label class="container">
                                                           <input type="checkbox" >
                                                           <span class="checkmark"></span>
                                                         </label>
                                                    </td>
                                                  </tr>

                                                  <tr>
                                                    <td> user2 </td>
                                                        <td>
                                                                <label class="container">
                                                                  <input type="checkbox" >
                                                                  <span class="checkmark"></span>
                                                                </label>
                                                           </td>
                                                  </tr>

                                                  <tr>
                                                    <td>user3</td>
                                                        <td>
                                                                <label class="container">
                                                                  <input type="checkbox" >
                                                                  <span class="checkmark"></span>
                                                                </label>
                                                           </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                              <br>
                                              {{-- button --}}

                                              <div class="row">
                                                   <div class="col-md-7">
                                                       <a href="#"><button type="button" class="btn btn-danger">ยกเลิก
                                                           </button></a>
                                                       <a href="#">
                                                           <button type="submit" class="btn btn-success">บันทึก
                                                       </button> </a>
                                                   </div>
                                           </div>
                                </div>
                            </div>
                          </div>
                </div>

            {{-- if not first tap is none active --}}
            @else
                <div class="tab-pane fade show" id="permission{{ $type_name2->Name }}" role="tabpanel" aria-labelledby="tab{{ $type_name2->ID }}">
                    <div class="row" >
                        {{ Form::open(['method'=>'post' , 'url' =>'/group_setting/permission_group' ,'class'=>'forms-sample' ]) }}
                        <input type="hidden" name="id_type_name" value="{{ $type_name2->ID }}"/>
                        <input type="hidden" name="type_name" value="{{ $type_name2->Name }}"/>
                            <div class="col-md-6">
                                            <table class="table table-hover" style="background:#fff;"  >
                                                    <thead>
                                                      <tr>
                                                        <th >เมนู</th>
                                                        <th >สิทธิ์การใช้งาน</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data_menu as $out_data_menu)
                                                            @if(($out_data_menu->menu_parent / 100) == 0)
                                                        <tr>
                                                            <td>
                                                                <i class="menu-icon mdi mdi-{{ $out_data_menu->menu_icon }}"></i>&nbsp;
                                                                <span class="menu-title">{{ $out_data_menu->menu_name }}</span>
                                                            </td>
                                                            @foreach ($data_permission as $out_data_permission)
                                                            @if ($type_name2->ID == $out_data_permission->group_id && $out_data_menu->menu_name == $out_data_permission->Name && $out_data_permission->permission == '1')
                                                            <td>
                                                                <label class="container">
                                                                  <input type="checkbox" checked name="name[]" id="{{ $out_data_menu->menu_name }}" value="{{ $out_data_menu->menu_name }}">
                                                                  <span class="checkmark"></span>
                                                                </label>
                                                            </td>
                                                            @elseif($type_name2->ID == $out_data_permission->group_id && $out_data_menu->menu_name == $out_data_permission->Name && $out_data_permission->permission == '0')
                                                                <td>
                                                                    <label class="container">
                                                                    <input type="checkbox" name="name[]" id="{{ $out_data_menu->menu_name }}" value="{{ $out_data_menu->menu_name }}">
                                                                    <span class="checkmark"></span>
                                                                    </label>
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                        </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                  </table>
                                                  <br>
                                                   {{-- button --}}

                                                   <div class="row">
                                                        {{-- <div class="col-md-8">
                                                            <a class="nav nav-tabs mr-1 " id="tab-2-1-1" data-toggle="tab" href="#adduser-2-1-1" role="tablist" aria-controls="dashboard-2-1" aria-selected="true">
                                                                    <button type="button" class="btn btn-outline-info ">เพิ่มผู้ใช้งาน</button></a>
                                                        </div> --}}{{-- ปุ่มเพิ่มผู้ใช้งาน --}}

                                                        {{-- <div class="col-md-6">
                                                            <a href="#"><button type="button" class="btn btn-danger">ยกเลิก
                                                                </button></a>
                                                        </div> --}}
                                                        <div class="col-md-6">
                                                            <a href="#">
                                                                <button type="submit" class="btn btn-success">บันทึก
                                                            </button> </a>
                                                        </div>
                                                </div>

                            </div>
                            {{ form::close() }}

                             {{-- add user --}}
                            <div class="col-md-6">
                                <div class="tab-pane fade" id="adduser-2-1-1" role="tabpanel" aria-labelledby="tab-2-1-1">
                                        <table class="table table-hover" style="background:#fff;"  >
                                                <thead>
                                                  <tr>
                                                    <th >ผู้ใช้งาน</th>
                                                    <th >เพิ่มเข้ากลุ่ม</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td> user1 </td>

                                                    <td>
                                                         <label class="container">
                                                           <input type="checkbox" >
                                                           <span class="checkmark"></span>
                                                         </label>
                                                    </td>
                                                  </tr>

                                                  <tr>
                                                    <td> user2 </td>
                                                        <td>
                                                                <label class="container">
                                                                  <input type="checkbox" >
                                                                  <span class="checkmark"></span>
                                                                </label>
                                                           </td>
                                                  </tr>

                                                  <tr>
                                                    <td>user3</td>
                                                        <td>
                                                                <label class="container">
                                                                  <input type="checkbox" >
                                                                  <span class="checkmark"></span>
                                                                </label>
                                                           </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                              <br>
                                              {{-- button --}}

                                              <div class="row">
                                                   <div class="col-md-7">
                                                       <a href="#"><button type="button" class="btn btn-danger">ยกเลิก
                                                           </button></a>
                                                       <a href="#">
                                                           <button type="submit" class="btn btn-success">บันทึก
                                                       </button> </a>
                                                   </div>
                                           </div>
                                </div>
                            </div>
                          </div>
                </div>
            @endif
        @endforeach


                <div class="tab-pane fade" id="addType" role="tabpanel" aria-labelledby="tab-2-4">
                        <div class="row">
                          <div class="col-md-6">

                                <div class="card-body text-left">
                                        {{ Form::open(['method'=>'post' , 'url' =>'/group_setting/add_group' ,'class'=>'forms-sample' ]) }}
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-5" for="typeName">ชื่อประเภทผู้ใช้งาน</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group">
                                                        {{ Form::text('typeName',null, ['class' => 'form-control','placeholder' => 'example']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            {{-- button --}}
                                            <div class="col-sm-12 text-right">
                                                    {{-- <a href="#"><button type="button" class="btn btn-danger btn-fw">ยกเลิก
                                                        </button></a> --}}
                                                    <a href="#">
                                                        <button type="submit" class="btn btn-success btn-fw">
                                                            <i class="mdi mdi-content-save"></i>
                                                            บันทึก
                                                    </button> </a>
                                            </div>
                                        {{ Form::close() }}
                                </div>
                          </div>
                        </div>
                      </div>


              </div>
            </div>
          </div>
        </div>
</div>
</div>

@stop

@section('script')

<script src="./js/shared/off-canvas.js"></script>
<script src="./js/shared/hoverable-collapse.js"></script>
<script src="./js/shared/misc.js"></script>
<script src="./js/shared/settings.js"></script>
<script src="./js/shared/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="./js/shared/tabs.js"></script>
@stop
