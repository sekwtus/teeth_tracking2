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

                            @foreach ($employee_department as $data)
                                @if(Auth::user()->id == $data->ID_user)
                                    @if ($data->department == '23')

                                    @if($id_job == '9')
                                        <li class="yellow"><a href="{{ url('product/9') }}">ปูน</a></li>
                                    @else
                                        <li class="white"><a href="{{ url('product/9') }}">ปูน</a></li>
                                    @endif
                                    @if($id_job == '15')
                                        <li class="yellow"><a href="{{ url('product/15') }}">WAX</a></li>
                                    @else
                                        <li class="white"><a href="{{ url('product/15') }}">WAX</a></li>
                                    @endif

                                    @if($id_job == '13')
                                        <li class="yellow"><a href="{{ url('product/13') }}">แต่งลง</a></li>
                                    @else
                                        <li class="white"><a href="{{ url('product/13') }}">แต่งลง</a></li>
                                    @endif

                                    @if($id_job == '12')
                                        <li class="yellow"><a href="{{ url('product/12') }}">โอเปค</a></li>
                                    @else
                                        <li class="white"><a href="{{ url('product/12') }}">โอเปค</a></li>
                                    @endif

                                    @if($id_job == '8')
                                        <li class="yellow"><a href="{{ url('product/8') }}">พอสเลน</a></li>
                                    @else
                                        <li class="white"><a href="{{ url('product/8') }}">พอสเลน</a></li>
                                    @endif

                                    @if($id_job == '10')
                                        <li class="yellow"><a href="{{ url('product/10') }}">ขัด</a></li>
                                    @else
                                        <li class="white"><a href="{{ url('product/10') }}">ขัด</a></li>
                                    @endif

                                    @if($id_job == '6')
                                        <li class="yellow"><a href="{{ url('product/6') }}">FQC</a></li>
                                    @else
                                        <li class="white"><a href="{{ url('product/6') }}">FQC</a></li>
                                    @endif

                                    @else
                                    @if($id_job == '9')
                                    <li class="yellow">ปูน</li>
                                    @else
                                        <li class="white">ปูน</li>
                                    @endif

                                    @if($id_job == '15')
                                        <li class="yellow">WAX</li>
                                    @else
                                        <li class="white">WAX</li>
                                    @endif

                                    @if($id_job == '13')
                                        <li class="yellow">แต่งลง</li>
                                    @else
                                        <li class="white">แต่งลง</li>
                                    @endif

                                    @if($id_job == '12')
                                        <li class="yellow">โอเปค</li>
                                    @else
                                        <li class="white">โอเปค</li>
                                    @endif

                                    @if($id_job == '8')
                                        <li class="yellow">พอสเลน</li>
                                    @else
                                        <li class="white">พอสเลน</li>
                                    @endif

                                    @if($id_job == '10')
                                        <li class="yellow">ขัด</li>
                                    @else
                                        <li class="white">ขัด</li>
                                    @endif

                                    @if($id_job == '6')
                                        <li class="yellow">FQC</li>
                                    @else
                                        <li class="white">FQC</li>
                                    @endif
                                    @endif
                                @endif
                            @endforeach --}}

{{--
                        @if($id_job == '9')
                            <li class="yellow">ปูน</li>
                        @else
                            <li class="white">ปูน</li>
                        @endif

                        @if($id_job == '15')
                            <li class="yellow">WAX</li>
                        @else
                            <li class="white">WAX</li>
                        @endif

                        @if($id_job == '13')
                            <li class="yellow">แต่งลง</li>
                        @else
                            <li class="white">แต่งลง</li>
                        @endif

                        @if($id_job == '12')
                            <li class="yellow">โอเปค</li>
                        @else
                            <li class="white">โอเปค</li>
                        @endif

                        @if($id_job == '8')
                            <li class="yellow">พอสเลน</li>
                        @else
                            <li class="white">พอสเลน</li>
                        @endif

                        @if($id_job == '10')
                            <li class="yellow">ขัด</li>
                        @else
                            <li class="white">ขัด</li>
                        @endif

                        @if($id_job == '6')
                            <li class="yellow">FQC</li>
                        @else
                            <li class="white">FQC</li>
                        @endif --}}

                        {{-- @if($id_job == '9')
                            <li class="yellow"><a href="{{ url('product/9') }}">ปูน</a></li>
                        @else
                            <li class="white"><a href="{{ url('product/9') }}">ปูน</a></li>
                        @endif

                        @if($id_job == '15')
                            <li class="yellow"><a href="{{ url('product/15') }}">WAX</a></li>
                        @else
                            <li class="white"><a href="{{ url('product/15') }}">WAX</a></li>
                        @endif

                        @if($id_job == '13')
                            <li class="yellow"><a href="{{ url('product/13') }}">แต่งลง</a></li>
                        @else
                            <li class="white"><a href="{{ url('product/13') }}">แต่งลง</a></li>
                        @endif

                        @if($id_job == '12')
                            <li class="yellow"><a href="{{ url('product/12') }}">โอเปค</a></li>
                        @else
                            <li class="white"><a href="{{ url('product/12') }}">โอเปค</a></li>
                        @endif

                        @if($id_job == '8')
                            <li class="yellow"><a href="{{ url('product/8') }}">พอสเลน</a></li>
                        @else
                            <li class="white"><a href="{{ url('product/8') }}">พอสเลน</a></li>
                        @endif

                        @if($id_job == '10')
                            <li class="yellow"><a href="{{ url('product/10') }}">ขัด</a></li>
                        @else
                            <li class="white"><a href="{{ url('product/10') }}">ขัด</a></li>
                        @endif

                        @if($id_job == '6')
                            <li class="yellow"><a href="{{ url('product/6') }}">FQC</a></li>
                        @else
                            <li class="white"><a href="{{ url('product/6') }}">FQC</a></li>
                        @endif --}}


                        {{-- <li class="white"><a href="{{ url('product/15') }}">WAX</a></li>
                        <li class="white"><a href="{{ url('product/13') }}">แต่งลง</a></li>
                        <li class="white"><a href="{{ url('product/12') }}">โอเปค</a></li>
                        <li class="white"><a href="{{ url('product/8') }}">พอสเลน</a></li>
                        <li class="white"><a href="{{ url('product/10') }}">ขัด</a></li>
                        <li class="white"><a href="{{ url('product/6') }}">FQC</a></li> --}}
                    {{-- </ul>
        </div> --}}


        <div class="col-12">
            <div class="row" id="stepApp" style="height: auto%;">
                <div class="col-12 grid-margin">
                    <div class="card" style="height : 99%; width:99%;  overflow-x: auto;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12  text-center" style="background-color:#666666;color:white;">
                                    <h3>
                                        <b>แผนก
                                            @foreach($data_department as $department)
                                                {{ $department->name }}
                                            @endforeach
                                        </b>
                                    </h3>
                                </div>
                                <br>
                            </div>
                            <br>
                            <div class="row text-left">
                                <div class="col-2">
                                    <label>รายการงานทั้งหมด</label>
                                 </div>
                                @if (!Gate::allows('IsQC'))
                                    <div class="col-2 text-left">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#defaultModal">รับงาน</button>
                                    </div>
                                @endif
                                {{-- <div class="col-2">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalregister">ลงทะเบียนช่าง</button>
                                </div> --}}
                            </div>
                            <br>
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
                                        <th>BarCode</th>
                                        <th>สาขา</th>
                                        <th>ขั้นตอน</th>
                                        <th>เวลาผลิต</th>
                                        <th>เวลางานเสร็จ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count =1;
                                    @endphp
                                        @foreach ($data_job as $out_data_job)
                                            @if($out_data_job->ID == $id)
                                                <tr style="background-color: #4CAF50;color: white;">
                                                    {{-- <td>{{$count}}</td> --}}
                                                    <td>{{$out_data_job->ID}}</td>
                                                    <td>{{$out_data_job->Barcode}}</td>
                                                    <td>{{$out_data_job->BranchID}}</td>
                                                    <td>{{$out_data_job->job_current_department}}</td>
                                                    <td>{{$out_data_job->date_time_start}}</td>
                                                    <td>{{$out_data_job->date_time_finish}}</td>
                                                    <td>
                                                        <a href="{{ url('/product').'/'.$id_job.'/'.$out_data_job->ID }}">
                                                            <button type="submit" class="btn btn-success" style="padding:10px;">รายละเอียด</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                    @php
                                                        $count = $count+1;
                                                    @endphp
                                            @else
                                                <tr>
                                                    {{-- <td>{{$count}}</td> --}}
                                                    <td>{{$out_data_job->ID}}</td>
                                                    <td>{{$out_data_job->Barcode}}</td>
                                                    <td>{{$out_data_job->BranchID}}</td>
                                                    <td>{{$out_data_job->job_current_department}}</td>
                                                    <td>{{$out_data_job->date_time_start}}</td>
                                                    <td>{{$out_data_job->date_time_finish}}</td>
                                                    <td>
                                                        <a href="{{ url('/product').'/'.$id_job.'/'.$out_data_job->ID }}">
                                                            <button type="submit" class="btn btn-success" style="padding:10px;">รายละเอียด</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                    @php
                                                        $count = $count+1;
                                                    @endphp
                                            @endif
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
                            <div class="row">
                                <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดงาน&nbsp;&nbsp;&nbsp;</h4>
                                @foreach ($data_detailjob as $detailjob)
                                <h4 class="text-primary">   #Barcode : {{ $detailjob->Barcode }} &nbsp;&nbsp;&nbsp;</h4>
                                    @foreach ($data_sale as $detailsale)
                                        <h4 class="text-info">  #เซล : {{ $detailsale->NameSale }} ({{ $detailsale->NickNameSale }})</h4>
                                    @endforeach
                                @endforeach
                            </div>
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
                                <th>ประเภทสินค้า</th>
                                <th>แผนก</th>
                                <th>สถานะงาน</th>
                                <th>ฟัน</th>
                                <th>ผู้รับผิดชอบ</th>
                                <th>เวลารับงาน</th>
                                <th>เวลาส่งงาน</th>
                                {{-- <th>เวลาทำงาน</th> --}}
                                {{-- <th>Wait time</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($employee_department as $data)
                                @if(Auth::user()->id == $data->ID_user)
                                    @if (Gate::allows('IsFQC'))
                                        {{-- @foreach ($data_job as $out_data_job) --}}
                                            <button class="btn btn-success" data-target="#ModalFQC{{ $id }}" data-toggle="modal" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">FQC</button>
                                        {{-- @endforeach --}}
                                    @endif
                                @endif
                            @endforeach

                            @foreach ($data_detailjob as $out_data_detailjob)
                                <tr>
                                    {{-- <td>{{$out_data_detailjob->ID}}</td> --}}
                                    <td>{{$out_data_detailjob->productName}}</td>
                                    <td>{{$out_data_detailjob->DepartmentID}}</td>
                                    @if($out_data_detailjob->status_job_detail ==0)
                                        <td>
                                          <label class="badge badge-outline-warning badge-pill">ว่าง</label>
                                        </td>
                                    @elseif($out_data_detailjob->status_job_detail ==1)
                                        <td>
                                          <label class="badge badge-outline-danger badge-pill">ไม่ผ่าน</label>
                                        </td>
                                    @elseif($out_data_detailjob->status_job_detail ==2)
                                        <td>
                                          <label class="badge badge-outline-success badge-pill">ส่งงาน</label>
                                        </td>
                                    @elseif($out_data_detailjob->status_job_detail ==3)
                                        <td>
                                          <label class="badge badge-outline-primary badge-pill">กำลังทำ</label>
                                        </td>
                                    @endif
                                    <td>{{$out_data_detailjob->Teeth_ID}}</td>
                                    @if($out_data_detailjob->EmployeeID)
                                         <td>{{$out_data_detailjob->EmployeeID}}</td>
                                    @else
                                        <td>ไม่มี</td>
                                    @endif
                                    {{-- <td>{{$out_data_detailjob->time_process}}</td> --}}
                                    {{-- <td>{{$out_data_detailjob->time_waiting}}</td> --}}
                                    <td>{{$out_data_detailjob->created_at}}</td>
                                    <td>{{$out_data_detailjob->updated_at}}</td>
                                    <td>
                                        <div class="row">
                                                @foreach ($employee_department as $data)
                                                    @if(Auth::user()->id == $data->ID_user)
                                                        @if(Gate::allows('IsTechnician'))
                                                            <div class="col-12" style="margin:5px">
                                                                <button id="ScanAction" class="btn btn-info" data-toggle="modal" data-target="#ScanAction{{$out_data_detailjob->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">รับงาน</button>
                                                            </div>

                                                            {{-- <div class="col-12" style="margin:5px">
                                                                <button class="btn btn-success" data-target="#ScanAction2{{$out_data_detailjob->ID}}" data-toggle="modal" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">ส่งงาน</button>
                                                            </div> --}}
                                                        @endif
                                                    @endif
                                                @endforeach


                                            {{-- <div style="margin:5px;">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item d-none d-lg-block color-setting">
                                                        <button class="btn btn-success" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">QC</button>
                                                    </li>
                                                </ul>
                                            </div>--}}
                                            <div class="col-4">
                                                @foreach ($employee_department as $data)
                                                    @if(Auth::user()->id == $data->ID_user)
                                                        @if(Gate::allows('IsQC'))
                                                            {{-- @if($out_data_detailjob->status_job_detail ==2)
                                                                <button class="btn btn-success" data-toggle="modal" data-target="#ModalQC{{$out_data_detailjob->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">QC</button>
                                                            @else
                                                            <button class="btn btn-success" data-toggle="modal" data-target="#ModalQC{{$out_data_detailjob->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;" disabled>รอช่างทำงานเสร็จ</button>
                                                            @endif --}}
                                                            <button class="btn btn-success" data-toggle="modal" data-target="#ModalQC{{$out_data_detailjob->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">QC</button>
                                                        @endif
                                                    @endif
                                                @endforeach
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
            {{-- {{ url('/product').'/'.$id_job.'/'.$out_data_job->ID }} --}}
            {{ Form::open(['method' => 'post' , 'url' => '/product'.'/'.$id_job.'/scan']) }}
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
                                                    {{-- <div class="col-8">
                                                        <button class="btn btn-success" data-target="#ScanAction2" data-toggle="modal" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;margin:10px;">ปิดงาน</button>
                                                    </div> --}}
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
                {{ Form::open(['method' => 'post' , 'url' => '/product'.'/'.$id_job.'/scanOpen'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID]) }}
                <div class="card-body">
                    <div class="col-12 text-left">
                        <div class="row">
                            <div class="col-6">
                                <h6>
                                    สแกนบัตรพนักงาน
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
                {{ Form::open(['method' => 'post' , 'url' => '/product'.'/'.$id_job.'/scanClose'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID]) }}
                    <div class="card-body">
                        <div class="col-12 text-left">
                            <div class="row">
                                <div class="col-6">
                                    <h6>
                                        สแกนบัตรพนักงาน
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


{{---------------------------------------------------Modal QC --------------------------------------------------------}}
@foreach ($data_detailjob as $out_data_detailjob)
    <div class="modal fade" id="ScanQC{{$out_data_detailjob->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:980px;">
            <div class="modal-content">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        QC
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="card-body">
                        <div class="col-12 text-left">
                            <div class="row">
                                <div class="col-6">
                                    <h6>
                                        สแกนบัตรพนักงาน
                                    </h6>
                                </div>
                                <div class="col-6">
                                <input type="text" id="scanbarcode_pd" name="scanbarcode_pd" style="widht:10px;">
                                <button class="btn btn-icons btn-rounded btn-primary" type="button"><i class="mdi mdi-crop-free"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($data_detailjob as $out_data_detailjob)
    <div class="modal fade" id="ModalQC{{$out_data_detailjob->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header align-items-center">
                        <label class="font-weight-bold">
                            QC
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        {{-- <input type="text" id="scanbarcode_pd" name="scanbarcode_pd" placeholder="รหัสพนักงาน QC"> --}}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ Form::open(['method' => 'post' , 'url' => '/product'.'/'.$id_job.'/qcchecklist'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID]) }}
                    <div class="card-body">
                            <div class="row col-12" style="margin:10px;">
                                <div class="col-2">
                                    สแกนบัตรพนักงาน
                                </div>
                                <div class="col-10">
                                   <input type="text" class="form-control" id="scanbarcode_qc" name="scanbarcode_qc" placeholder="รหัสพนักงาน QC" required autofocus/>
                                </div>
                            </div>
                            <br>
                        <div style="height:300px;overflow-x: auto;">
                            @php
                                $lenght = 0;
                            @endphp
                            @foreach ($data_qc_checklist as $out_data_qc_checklist)
                                @php
                                    $lenght++;
                                @endphp
                                <div class="row col-12" style="margin:10px;">
                                    <div class="col-4">
                                        <div>
                                            <input type="hidden" id="{{$out_data_detailjob->ID}} {{$out_data_qc_checklist->ID}}" name="{{$out_data_qc_checklist->ID}}" value="{{$out_data_qc_checklist->ID}}">
                                            <label for="{{$out_data_detailjob->ID}} {{$out_data_qc_checklist->ID}}" >{{$out_data_qc_checklist->ccp}}</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-radio form-radio-flat">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="radio{{$out_data_qc_checklist->ID}}" id="radiocom{{$out_data_detailjob->ID}} {{$out_data_qc_checklist->ID}}" value="com" onchange="onclick1({{$out_data_detailjob->ID}},{{$out_data_qc_checklist->ID}})"> ผ่าน
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-radio form-radio-flat">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="radio{{$out_data_qc_checklist->ID}}" id="radiouncom{{$out_data_detailjob->ID}} {{$out_data_qc_checklist->ID}}" value="uncom" onchange="onclick1({{$out_data_detailjob->ID}},{{$out_data_qc_checklist->ID}})" checked> ไม่ผ่าน
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" class="form-control" name="note[]" id="note{{$out_data_detailjob->ID}} {{$out_data_qc_checklist->ID}}" placeholder="รายละเอียด" />
                                    </div>
                                </div>

                            @endforeach
                            <input type="hidden" id="lenght" name="lenght" value="{{$lenght}}">
                            <input type="hidden" id="count" name="count" value="0">
                            {{-- <div class="form-group col-12">
                                <label for="exampleTextarea1">เพิ่มเติม</label>
                                <textarea class="form-control" id="note" name="note" rows="3" style="width:80% text-align: center;"></textarea>
                            </div> --}}
                        </div>
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger"  id="QC_nonsubmit{{$out_data_detailjob->ID}}" type="submit" formaction="{{url('/product'.'/'.$id_job.'/qcchecklist'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID.'/2')}}" >ตีกลับ</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="QC_submit{{$out_data_detailjob->ID}}" class="btn btn-block btn-success" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalQCCom{{$out_data_detailjob->ID}}" disabled>ผ่าน</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalQCCom{{$out_data_detailjob->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:800px;">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header align-items-center">
                        <label class="font-weight-bold">
                            Complete QC
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ Form::open(['method' => 'post' , 'url' => '/product'.'/'.$id_job.'/qcchecklist'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID]) }}
                    <div class="card-body" style="100%">
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger" id="QC_nonsubmit{{$out_data_detailjob->ID}}"  type="submit" formaction={{url('/product'.'/'.$id_job.'/qcchecklist'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID.'/sendtodoctor')}}>ส่งต่อให่แพทย์</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="QC_Complete_submit{{$out_data_detailjob->ID}}" class="btn btn-block btn-success" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalQCDepartment{{$out_data_detailjob->ID}}">ไปแผนกอื่น</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalQCDepartment{{$out_data_detailjob->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:800px;">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header align-items-center">
                        <label class="font-weight-bold">
                            Select Department
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ Form::open(['method' => 'post' , 'url' => '/product'.'/'.$id_job.'/qcchecklist'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID]) }}
                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                            {{-- @foreach ($data_qc_checklist as $out_data_qc_checklist) --}}
                                <div class="col-sm-12">
                                    <select name="department" class="form-control">
                                        @foreach ($data_department_all as $out_data_department_all)
                                            <option value="{{$out_data_department_all->ID}}">{{$out_data_department_all->Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            {{-- @endforeach --}}
                        </div>
                        <br>
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger" id="QC_nonsubmit{{$out_data_detailjob->ID}}"  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalQCCom{{$out_data_detailjob->ID}}" >ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="QC_select_department_submit{{$out_data_detailjob->ID}}" class="btn btn-block btn-success" type="submit">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endforeach

{{---------------------------------------------------------- END Modal QC -------------------------------------------------------------}}

@foreach ($data_job as $out_data_job)
    @foreach ($data_detailjob as $out_data_detailjob)
        <div class="modal fade" id="ModalFQC{{$out_data_job->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width:800px;">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header align-items-center">
                            <label class="font-weight-bold">
                                FQC
                            </label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{ Form::open(['method' => 'post' , 'url' => '/product'.'/'.$id_job.'/qcchecklist'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID.'/fqc_com']) }}
                        <div class="card-body">
                            <div class="row" style="height:300px;overflow-x: auto;">
                                @foreach ($data_fqc_checklist as $out_data_fqc_checklist)
                                    <div class="col-12">
                                        <div class="checkbox-toolbar text-center">
                                            <input type="checkbox" id="fqc{{$out_data_job->ID}} {{$out_data_fqc_checklist->ID}}" name="{{$out_data_fqc_checklist->ID}}" value="{{$out_data_fqc_checklist->ID}}">
                                            <label for="fqc{{$out_data_job->ID}} {{$out_data_fqc_checklist->ID}}" style="cursor:pointer;" onclick="onclick2({{$out_data_job->ID}},{{$out_data_fqc_checklist->ID}})">{{$out_data_fqc_checklist->ccp}}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" id="count2{{$out_data_job->ID}}" name="count2{{$out_data_job->ID}}" value="0">
                            <div class="row" style="margin:5px;">
                                <div class="col-6">
                                    <button class=" btn btn-block btn-danger" id="FQC_nonsubmit{{$out_data_job->ID}}" type="submit" formaction="{{ url('/product'.'/'.$id_job.'/qcchecklist'.'/'.$out_data_detailjob->productID.'/'.$out_data_detailjob->JobID.'/'.$out_data_detailjob->ID.'/fqc_uncom')}}"  disabled>ตีกลับ</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" id="FQC_submit{{$out_data_job->ID}}" class="btn btn-block btn-success">ผ่าน</button>
                                </div>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

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
            $('#example').DataTable().DataTable({"scrollX": true,"aaSorting": []});;
        } );
        $(document).ready(function() {
            $('#example2').DataTable().DataTable({"scrollX": true,"aaSorting": []});;
        } );
        $(document).ready(function() {
            $('#example3').DataTable().DataTable({"scrollX": true,"aaSorting": []});;
        } );
        $(window).on('load',function(){
            $('#defaultModal').modal('show');
        });
        



        function onclick1($id,$id2){
            if(document.getElementById('radiocom'+$id+' '+$id2).checked == false && document.getElementById('radiouncom'+$id+' '+$id2).checked == true){
                document.getElementById('count').value;
                a = parseInt(document.getElementById('count').value);
                b = a-1;
                c = parseInt(document.getElementById('lenght').value);
                document.getElementById('count').value = b;
                if(b!=c){
                    document.getElementById("QC_submit"+$id).disabled = true;
                    document.getElementById("QC_nonsubmit"+$id).disabled = false;
                }
                else if(b==c){
                    document.getElementById("QC_submit"+$id).disabled = false;
                    document.getElementById("QC_nonsubmit"+$id).disabled = true;

                }else{
                    document.getElementById("QC_submit"+$id).disabled = true;
                    document.getElementById("QC_nonsubmit"+$id).disabled = true;
                }
            }
            else if(document.getElementById('radiouncom'+$id+' '+$id2).checked == false && document.getElementById('radiocom'+$id+' '+$id2).checked == true){
                document.getElementById('count').value;
                a =parseInt(document.getElementById('count').value);
                b = a+1;
                c = parseInt(document.getElementById('lenght').value);
                document.getElementById('count').value = b;
                if(b!=c){
                    document.getElementById("QC_submit"+$id).disabled = true;
                    document.getElementById("QC_nonsubmit"+$id).disabled = false;
                }
                else if(b==c){
                    document.getElementById("QC_submit"+$id).disabled = false;
                    document.getElementById("QC_nonsubmit"+$id).disabled = true;

                }else{
                    document.getElementById("QC_submit"+$id).disabled = true;
                    document.getElementById("QC_nonsubmit"+$id).disabled = true;
                }
            }
        }
        function onclick2($id,$id2){
            if(document.getElementById('fqc'+$id+' '+$id2).checked == false){
                document.getElementById('count2'+$id).value;
                a = parseInt(document.getElementById('count2'+$id).value);
                b = a+1;
                document.getElementById('count2'+$id).value = b;
                if(b==0){
                    document.getElementById("FQC_submit"+$id).disabled = false;
                    document.getElementById("FQC_nonsubmit"+$id).disabled = true;
                }
                else{
                    document.getElementById("FQC_submit"+$id).disabled = true;
                    document.getElementById("FQC_nonsubmit"+$id).disabled = false;
                }
            }
            else{
                document.getElementById('count2'+$id).value;
                a =parseInt(document.getElementById('count2'+$id).value);
                b = a-1;
                document.getElementById('count2'+$id).value = b;
                if(b==0){
                document.getElementById("FQC_submit"+$id).disabled = false;
                document.getElementById("FQC_nonsubmit"+$id).disabled = true;
                }
                else{
                document.getElementById("FQC_submit"+$id).disabled = true;
                document.getElementById("FQC_nonsubmit"+$id).disabled = false;
                }
            }
        }

        $(document).ready(function() {
        @if(\Session::has('massage'))
            alert('{{ \Session::get('massage') }}');
        @endif
        } );
</script>
<script src="./js/shared/alerts.js"></script>
@stop
