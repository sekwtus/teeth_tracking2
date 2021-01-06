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
        border: solid black;
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

        .checkbox-toolbar {
            margin: 10px;
        }

        .checkbox-toolbar input[type="checkbox"] {
            display:none;
        }

        .checkbox-toolbar label {
                display:inline-block;
                background-color:#ddd;
                width: 100%;
                height: 15%;
                padding: 20px;
                font-size:14px;
                cursor: pointer;
                border: solid white;
                /* border: 2px solid #444; */
                /* border-radius: 4px;     */
            }
        .checkbox-toolbar label:hover {
            color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
        }

        .checkbox-toolbar input[type="checkbox"]:checked + label {
            color: #fff;
                background-color: #19d895;
                border-color: #19d895;
        }
    </style>
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row">
        {{-- <div class="col-2">
            <ul class="m-0 step-list">
                <li class="yellow">ปูน</li>
                <li class="white">WAX</li>
                <li class="white">แต่งลง</li>
                {{-- <li class="white">เลือกซี่ฟัน & ชนิดงาน & ชนิดสินค้า</li>
                <li class="white">จัดกลุ่มซี่ฟัน</li> --}}
                {{-- <li class="white">โอเปค</li>
                <li class="white">พอสเลน</li>
                <li class="white">ขัด</li>
                <li class="white">FQC</li>
              </ul>
        </div> --}}
        <div class="col-12">
            <div class="row" id="stepApp" style="height: auto%;">
                <div class="col-12 grid-margin">
                    <div class="card" style="height : 99%; width:99%;  overflow-x: auto;">
                        <div class="card-body">
                            <div class="row border-bottom">
                                <div class="col-12 p-0 text-left">
                                    <h4>&nbsp;&nbsp;&nbsp;รายการงานทั้งหมด&nbsp;&nbsp;</h4><br>
                                </div>
                            </div>
                            <div class="row text-center border-bottom">
                                <div class="col-2">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#defaultModal">รับงาน</button>
                                </div>
                                {{-- <div class="col-2">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalregister">ลงทะเบียนช่าง</button>
                                </div> --}}
                            </div>
                            @if($errors->all())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                            @endif
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        {{-- <th>Order ID</th> --}}
                                        <th>Order Screen ID</th>
                                        <th>สาขา</th>
                                        <th>ขั้นตอน</th>
                                        {{-- <th>เวลาผลิต</th>
                                        <th>เวลางานเสร็จ</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count =1;
                                    @endphp
                                        @foreach ($data_job as $out_data_job) 
                                        {{ Form::open(['method' => 'get' , 'url' => '/qc/'.$out_data_job->ID]) }}
                                        <tr>
                                            {{-- <td>{{$count}}</td> --}}
                                            <td>{{$out_data_job->ID}}</td>
                                            <td>{{$out_data_job->ID_order_screen}}</td>
                                            <td>{{$out_data_job->BranchID}}</td>
                                            <td>{{$out_data_job->job_current_department}}</td>
                                            {{-- <td>{{$out_data_job->date_time_start}}</td>
                                            <td>{{$out_data_job->date_time_finish}}</td> --}}
                                            <td>      
                                                <a href="{{ url('/qc').'/'.$out_data_job->ID }}">                                
                                                    <button type="submit" class="btn btn-success" style="padding:10px;">รายละเอียด</button>
                                                </a>
                                            </td>
                                        </tr>
                                            @php 
                                                $count = $count+1;
                                            @endphp
                                        {{Form::close()}}
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="stepApp">
                <div class="col-12 grid-margin">
                <div class="card" style="height : 99%; auto; overflow-y: auto;  overflow-x: auto;">
                    <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                        <h4>&nbsp;&nbsp;&nbsp;รายละเอียดงาน&nbsp;&nbsp;
                            </h4><br>
                        </div>
                    </div>
                    @if($errors->all())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif
                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Product ID</th>
                                {{-- <th>แผนก</th> --}}
                                <th>สถานะงาน</th>
                                <th>ฟัน</th>
                                <th>ผุู้รับผิดชอบ</th>
                                {{-- <th>เวลาทำงาน</th> --}}
                                {{-- <th>Wait time</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_detailjob as $out_data_detailjob)
                                <tr>
                                    {{-- <td>{{$out_data_detailjob->ID}}</td> --}}
                                    <td>{{$out_data_detailjob->productName}}</td>
                                    {{-- <td>{{$out_data_detailjob->DepartmentID}}</td> --}}
                                    <td>{{$out_data_detailjob->status_job_detail}}</td>
                                    <td>{{$out_data_detailjob->Teeth_ID}}</td>
                                    @if($out_data_detailjob->EmployeeID)
                                        <td>{{$out_data_detailjob->EmployeeID}}</td>
                                    @else
                                        <td>ว่าง</td>
                                    @endif
                                    {{-- <td>{{$out_data_detailjob->time_process}}</td> --}}
                                    {{-- <td>{{$out_data_detailjob->time_waiting}}</td> --}}
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#ScanAction{{$out_data_detailjob->ID}}" style="padding:10px;">รับงาน</button>
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-success" data-target="#ScanAction2{{$out_data_detailjob->ID}}" data-toggle="modal" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">ส่งงาน</button>
                                            </div>
                                            {{-- <div style="margin:5px;"> 
                                                <ul class="navbar-nav">
                                                    <li class="nav-item d-none d-lg-block color-setting">
                                                        <button class="btn btn-success" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">QC</button>
                                                    </li>
                                                </ul>
                                            </div>--}}
                                            <div class="col-4">
                                                <button class="btn btn-success" data-toggle="modal" data-target="#ModalQC" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">QC</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>                          
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- partial -->
{{-- <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
        <div id="theme-settings" class="settings-panel"  style="overflow:auto;">
            <div class="card">
                <i class="settings-close mdi mdi-close"></i>
                <div class="d-flex align-items-center justify-content-between border-bottom">
                    <p class="settings-heading font-weight-bold border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">QC</p>
                </div>
                <div class="row" style="margin-bottom:30px;">
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST1" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST1" style="cursor:pointer;">2.1-โมเดลสมบูรณ์ (เต็ม, ไม่มีบับเบิ้ล, ไม่พรุน)</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST2" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST2" style="cursor:pointer;">2.2-ปาดเหงือกถูกต้อง</label>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST3" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST3" style="cursor:pointer;">2.3-ตัดไม่โดนอบัตเมนต์</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST4" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST4" style="cursor:pointer;">2.4-ขอบดายไม่บล็อคซีเมนต์</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST5" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST5" style="cursor:pointer;">2.5-แต่งดายถูกต้อง</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST6" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST6" style="cursor:pointer;">2.6-ดาย 2 สเต็ปส่งโทรก่อน</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST7" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST7" style="cursor:pointer;">2.7-จับสบถูกต้องใช้ไบ้ท์ประกอบ</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST8" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST8" style="cursor:pointer;">2.8-เข้าตรงมิดไลน์ เพลนไม่เอียง</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST9" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST9" style="cursor:pointer;">2.9-สบฟันไม่เคลื่อน</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="checkbox-toolbar text-center">
                            <input type="checkbox" id="checkboxMESIAL_REST10" name="MESIAL_REST" value="MESIAL_REST">
                            <label for="checkboxMESIAL_REST10" style="cursor:pointer;">2.10-สบฟันถูกต้อง ก้านไม่หลุด</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <button class="btn-block btn-danger">ตีกลับ</button>
                    </div>
                    <div class="col-6">
                        <button class="btn-block btn-success">ผ่าน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card-header align-items-center">
                <label class="font-weight-bold">
                    รับงาน
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ Form::open(['method' => 'post' , 'url' => '/qc/scan']) }}
            <div class="card-body">
                <div class="col-12 text-left">
                    <div class="row">
                        <div class="col-6">
                            <h6>
                                สแกนบาร์โค้ดงานเพื่อรับงาน   
                            </h6>
                        </div>
                        <div class="col-6">
                        <input type="text" id="scanbarcode_pd" name="scanbarcode_pd" style="widht:10px;">
                                <button class="btn btn-icons btn-rounded btn-primary" type="submit"><i class="mdi mdi-crop-free"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close()}}
        </div>
    </div>
</div>

<div class="modal fade" id="ActionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:1000px;">
        <div class="modal-content">
            <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        Action
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="card-body">
                <div class="col-12 text-left">
                    <div class="row">
                        <table id="example3" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Job ID</th>
                                    <th>รายละเอียดการทำงาน</th>
                                    <th>ผุู้รับผิดชอบ</th>
                                    <th>เวลาทำงาน</th>
                                    <th>Wait time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_detailjob as $out_data_detailjob)
                                    <tr>
                                        <td>{{$out_data_detailjob->JobID}}</td>
                                        <td>{{$out_data_detailjob->action_detail}}</td>
                                        <td>{{$out_data_detailjob->EmployeeID}}</td>
                                        <td>{{$out_data_detailjob->time_process}}</td>
                                        <td>{{$out_data_detailjob->time_waiting}}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <button class="btn btn-success" data-toggle="modal" data-target="#ScanAction" style="padding:10px;margin:10px;">เปิดงาน</button>
                                                </div>
                                                <div class="col-8">
                                                    <button class="btn btn-success" data-target="#ScanAction2" data-toggle="modal" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;margin:10px;">ปิดงาน</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>                          
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($data_detailjob as $out_data_detailjob)
    <div class="modal fade" id="ScanAction{{$out_data_detailjob->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:980px;">
            <div class="modal-content">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        เปิดงาน
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'post' , 'url' => '/qc/scanOpen/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID]) }}
                <div class="card-body">
                    <div class="col-12 text-left">
                        <div class="row">
                            <div class="col-6">
                                <h6>
                                    สแกนบาร์โค้ดงานเพื่อปิดงาน
                                </h6>
                            </div>
                            <div class="col-6">
                            <input type="text" id="scanbarcode_pd" name="scanbarcode_pd" style="widht:10px;">
                                <button class="btn btn-icons btn-rounded btn-primary" type="submit"><i class="mdi mdi-crop-free"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close()}}
            </div>
        </div>
    </div> 
@endforeach

@foreach ($data_detailjob as $out_data_detailjob)
    <div class="modal fade" id="ScanAction2{{$out_data_detailjob->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:980px;">
            <div class="modal-content">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        ปิดงาน
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'post' , 'url' => '/qc/scanClose/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID]) }}
                    <div class="card-body">
                        <div class="col-12 text-left">
                            <div class="row">
                                <div class="col-6">
                                    <h6>
                                        สแกนบาร์โค้ดงานเพื่อปิดงาน
                                    </h6>
                                </div>
                                <div class="col-6">
                                <input type="text" id="scanbarcode_pd" name="scanbarcode_pd" style="widht:10px;">
                                    <button class="btn btn-icons btn-rounded btn-primary" type="submit"><i class="mdi mdi-crop-free"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> 
                {{Form::close()}}
            </div>
        </div>
    </div> 
@endforeach

<div class="modal fade" id="Modalregister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:auto;">
        <div class="modal-content">
            <div class="card-header align-items-center">
                <label class="font-weight-bold">
                    ลงทะเบียนช่าง
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="col-12 text-left">
                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อช่าง</th>
                                <th>แผนก</th>
                                <th>เป้าหมาย</th>
                                <th>เวลาเริ่มงาน</th>
                                <th>เวลาเลิกงาน</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_employee as $out_data_employee)
                                <tr>
                                    <td>{{$out_data_employee->ID}}</td>
                                    <td>{{$out_data_employee->EmployeeName}}</td>
                                    <td>{{$out_data_employee->department}}</td>
                                    <td>{{$out_data_employee->Job_target}}</td>
                                    <td>{{$out_data_employee->start_time_of_work}}</td>
                                    <td>{{$out_data_employee->end_time_of_work}}</td>
                                    <td>
                                        <div class="icheck-square">
                                            <label class="container">
                                                <input type="checkbox" id="status" name="status">
                                                <span class="checkmark"></span>
                                              </div>
                                        
                                    </td>
                                </tr>                          
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalQC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        QC
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row" style="height:300px;overflow-x: auto;">
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST1" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST1" style="cursor:pointer;">2.1-โมเดลสมบูรณ์ (เต็ม, ไม่มีบับเบิ้ล, ไม่พรุน)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST2" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST2" style="cursor:pointer;">2.2-ปาดเหงือกถูกต้อง</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST3" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST3" style="cursor:pointer;">2.3-ตัดไม่โดนอบัตเมนต์</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST4" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST4" style="cursor:pointer;">2.4-ขอบดายไม่บล็อคซีเมนต์</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST5" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST5" style="cursor:pointer;">2.5-แต่งดายถูกต้อง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST6" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST6" style="cursor:pointer;">2.6-ดาย 2 สเต็ปส่งโทรก่อน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST7" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST7" style="cursor:pointer;">2.7-จับสบถูกต้องใช้ไบ้ท์ประกอบ</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST8" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST8" style="cursor:pointer;">2.8-เข้าไม่ตรงมิดไลน์ เพลนไม่เอียง</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST9" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST9" style="cursor:pointer;">2.9-สบฟันไม่เคลื่อน</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="checkbox-toolbar text-center">
                                <input type="checkbox" id="checkboxMESIAL_REST10" name="MESIAL_REST" value="MESIAL_REST">
                                <label for="checkboxMESIAL_REST10" style="cursor:pointer;">2.10-สบฟันถูกต้อง ก้านไม่หลุด</label>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin:5px;">
                        <div class="col-6">
                            <a href="">
                                <button class=" btn btn-block btn-danger">ตีกลับ</button>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="">
                                <button class="btn btn-block btn-success">ผ่าน</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        เลือกช่าง
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อช่าง</th>
                                <th>แผนก</th>
                                <th>เป้าหมาย</th>
                                <th>เวลาเริ่มงาน</th>
                                <th>เวลาเลิกงาน</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_employee as $out_data_employee)
                                <tr>
                                    <td>{{$out_data_employee->ID}}</td>
                                    <td>{{$out_data_employee->EmployeeName}}</td>
                                    <td>{{$out_data_employee->department}}</td>
                                    <td>{{$out_data_employee->Job_target}}</td>
                                    <td>{{$out_data_employee->start_time_of_work}}</td>
                                    <td>{{$out_data_employee->end_time_of_work}}</td>
                                    <td>
                                        <div class="icheck-square">
                                            <label class="container">
                                                <input type="checkbox" id="status" name="status">
                                                <span class="checkmark"></span>
                                              </div>
                                        
                                    </td>
                                </tr>                          
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

        $(document).ready(function() {
            $('#example2').DataTable();
        } );

        $(document).ready(function() {
            $('#example3').DataTable();
        } );
    </script>


@stop