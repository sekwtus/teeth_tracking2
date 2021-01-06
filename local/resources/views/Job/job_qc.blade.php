@extends('layouts.template')

@section('title', 'ผลิต')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/dataTables/bootstrap.min.css') }}" type="text/css" />

<style>
    @media print {
        .no-print {
            display: none;
        }
    }

    ,
    th {
        text-align: center;
    }
</style>
<style>
    table {
        font-size: 13px;
    

    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 15px;
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
        background-color: grey;
        border-radius: 210px;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
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

    table {
        font-size: 13px;
    }
</style>
<style>
    .hide {
        display: none;
    }
</style>
@stop

@section('content')
<input type="hidden" id="massage" value="{{ Session::get('message') }}">

{{-- @if (session('message'))
    <br/>
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif --}}

<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row no-print">
                        <div class="col-12  text-center">
                            <h3>
                                <b>QC แผนก
                                    {{ $name_department->Name }}
                                </b>
                            </h3>
                        </div>
                        <br>
                    </div>

                    <div class="tab-content tab-content-basic">
                        @if (Gate::allows('IsQC') || Gate::allows('IsFQC') || Gate::allows('IsAdmin'))
                        <div class="tab-pane fade show active" id="ourgoal2" role="tabpanel"
                            aria-labelledby="profile-tab">
                            @else
                            <div class="tab-pane fade" id="ourgoal2" role="tabpanel" aria-labelledby="profile-tab">
                                @endif

                                <div class="row text-left">
                                    <div class="col-2 text-left">
                                        <button type="button" style="margin-bottom: 10px;" class="btn btn-success"
                                            data-toggle="modal" data-target="#acceptQC">
                                            <font color="black">รับงาน
                                        </button>
                                    </div>
                                </div>

                                <table id="example3" class="table-striped table-bordered display compact nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>BarCode</th>
                                            <th>ขั้นตอน</th>
                                            <th>เวลาผลิต</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($select_data_job1 as $out_data_job)
                                        @php
                                        $count =1;
                                        @endphp
                                        <tr>
                                            <td>{{$out_data_job->ID}}</td>
                                            <td>{{$out_data_job->Barcode}}</td>
                                            <td>{{$out_data_job->job_current_department}}</td>
                                            <td>{{$out_data_job->date_time_start}}</td>
                                            <td>
                                                {{ Form::open(['method' => 'post' , 'url' => '/job/'.$id.'/send_to_doctor/'.$out_data_job->ID]) }}
                                                <button class="btn btn-success" type="submit"
                                                    style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;"
                                                    formaction={{url('/job/'.$id.'/QC_Compelte/'.$out_data_job->ID)}}>
                                                    <font color="black">QC ผ่าน
                                                </button>
                                                <button class="btn btn-danger" type="button" data-toggle="modal"
                                                    data-target="#ModalQCUNCom{{$out_data_job->ID}}"
                                                    style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">
                                                    <font color="black">QC ไม่ผ่าน
                                                </button>
                                                <button class="btn btn-danger" type="button" data-toggle="modal"
                                                    data-target="#ModalQCUNComBackward{{$out_data_job->ID}}"
                                                    style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">
                                                    <font color="black">ตีกลับแผนกก่อนหน้า
                                                </button>
                                                <button class="btn btn-warning" type="button" data-toggle="modal"
                                                    data-target="#note{{$out_data_job->ID}}" onclick="NoteModal({{$out_data_job->ID}})"
                                                    style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">
                                                    <font color="black">ส่งให้หมอ
                                                </button>
                                                <button class="btn btn-info" type="button" data-toggle="modal"
                                                    data-target="#ModalService{{$out_data_job->ID}}"
                                                    style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">
                                                    <font color="black">ส่งให้บริการ
                                                </button>
                                                <button class="btn btn-primary" type="button" data-toggle="modal"
                                                    data-target="#Modalnote{{$out_data_job->ID}}" id="Modalnote"
                                                    style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">
                                                    <font color="black">โทรหาหมอ
                                                </button>
                                                {{ Form::close() }}
                                            </td>
                                        </tr>
                                        @php
                                        $count = $count+1;
                                        @endphp
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

    <div class="modal fade" id="acceptQC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:60%;">
            <div class="modal-content">
                <div class="card-header align-items-center text-center">
                    <label class="font-weight-bold ">
                        รับงานเข้า QC
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{ Form::open(['method' => 'post' , 'url' => '/job/scan/add_QC/'.$id_job ,"style"=>"padding-bottom: 10px;"]) }}

                <div class="col-sm-12" style="padding-bottom: 10px;padding-top: 10px;">
                </div>

                @if(!empty($usercode))
                <input type="hidden" id="EmployeeID" name="EmployeeID" value="{{ $usercode }}">
                @endif

                <div class="col-sm-12">
                    <div class="control-group">
                        <div class="incQC">
                            <div class="row">
                                <div class="col-sm-3">
                                    <b>สแกนบาร์โค๊ดงาน</b>
                                </div>
                                <div class="col-sm-7">
                                    <input type="hidden" id="appendQC" name="appendQC">
                                    <input class='form-control' name='job[]'
                                        style="height: 32px; padding-bottom: 5px;padding-top: 5px;" type="text"
                                        id="secondaryButtonQC1" onkeydown="if (event.keyCode == 13) {
                                                    return false;}" autofocus />
                                </div>
                                <button class="btn btn-outline-success"
                                    style="padding-right: 10px;padding-left: 10px;">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    @foreach ($select_data_job1 as $out_select_data_job)
        {{-- @foreach ($note as $out_note) --}}
            {{-- @if($out_select_data_job->Barcode == $out_note->Barcode) --}}
            <div class="modal fade" id="note{{$out_select_data_job->ID}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="width:800px;">
                    <div class="modal-content">
                        <div class="card">
                            <div class="card-header align-items-center">
                                <label class="font-weight-bold">
                                    Note
                                </label>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="DivNote{{$out_select_data_job->ID}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @endif --}}
        {{-- @endforeach --}}


<div class="modal fade" id="ModalQCCom{{$out_select_data_job->ID}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                {{ Form::open(['method' => 'post' , 'url' => '/job/'.$id.'/send_to_doctor/'.$out_select_data_job->ID ]) }}
                <div class="card-body" style="100%">
                    <div class="row" style="margin:5px;">
                        <div class="col-6">
                            <button class=" btn btn-block btn-danger" id="QC_nonsubmit{{$out_select_data_job->ID}}"
                                type="submit">ส่งต่อให้หมอ</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" id="QC_Complete_submit{{$out_select_data_job->ID}}"
                                class="btn btn-block btn-success" data-dismiss="modal" aria-label="Close"
                                data-toggle="modal"
                                data-target="#ModalQCDepartment{{$out_select_data_job->ID}}">ไปแผนกอื่น</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalQCUNCom{{$out_select_data_job->ID}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        จุดควบคุมสำคัญ
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'post' , 'url' => '/job/'.$id.'/qcchecklist/'.$out_select_data_job->ID]) }}
                <div class="card-body" style="100%">
                    <div style="height:300px;overflow-x: auto;">
                        <div class="accordion basic-accordion" id="accordionExample">
                            @foreach ($Department_FQC as $out_Department_FQC)
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <a data-toggle="collapse" href="#collapseOne{{$out_Department_FQC->DepartmentID}}"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <label>{{$out_Department_FQC->DepartmentName}}</label>
                                    </a>
                                </div>
                                <div id="collapseOne{{$out_Department_FQC->DepartmentID}}" class="collapse"
                                    aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="accordion basic-accordion" role="tablist">
                                        <div class="card">
                                            @php
                                                $lenght = 0;
                                                $temp1 = 0;
                                            @endphp
                                            @php
                                                foreach ($Sub_department_FQC as $out_Sub_department_FQC) {
                                                    $temp1 = $out_Sub_department_FQC->Name;
                                                }
                                                $temp2 = 0;
                                            @endphp
                                            @foreach ($data_qc_checklist as $out_data_qc_checklist)
                                                @if($out_data_qc_checklist->departmentID == $out_Department_FQC->DepartmentID)
                                                    @php
                                                        $temp2 = $out_data_qc_checklist->sub_department;
                                                    @endphp
                                                    @if($temp2 != $temp1)
                                                        <div class="card-header " id="orderRequestTypeID">
                                                            <a data-toggle="collapse" href="#TypeofWork{{$temp2}}" aria-expanded="false" aria-controls="TypeofWork">
                                                            <label>{{$out_data_qc_checklist->Name}}</label>
                                                            </a>
                                                        </div>
                                                        @php $temp1 = $temp2 @endphp
                                                    @endif
                                                    @php $lenght++; @endphp
                                                    <div id="TypeofWork{{$temp2}}" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID" style="max-height: 380px;overflow-x:hidden;overflow-y: auto;">
                                                        <div class="row col-12" style="margin:10px;">
                                                            <div class="col-8">
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        name="checkbox[]"
                                                                        id="checkboxcom{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}"
                                                                        value="{{$out_data_qc_checklist->ID}}"
                                                                        onchange="CheckQC({{$out_select_data_job->ID}},{{$out_data_qc_checklist->ID}})">
                                                                    <label class="custom-control-label"
                                                                        for="checkboxcom{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}">{{$out_data_qc_checklist->ccp}}</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="text" class="form-control" name="note[]"
                                                                    id="note{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}"
                                                                    placeholder="รายละเอียด" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        <input type="hidden" id="Employee" name="Employee" value="">
                                        <input type="hidden" id="count" name="count" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row" style="margin:5px;">
                    <div class="col-6">
                        <button class=" btn btn-block btn-danger"
                            id="QC_UNComplete_nonsubmit{{$out_select_data_job->ID}}" data-dismiss="modal"
                            aria-label="Close">ยกเลิก</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" id="QC_UNComplete_submit{{$out_select_data_job->ID}}"
                            class="btn btn-block btn-success"
                            formaction={{url('/job/'.$id.'/qcchecklist/'.$out_select_data_job->ID)}}>ตีกลับให้ช่าง</button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="ModalQCUNComBackward{{$out_select_data_job->ID}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header align-items-center" style="background-color: #2196F3;">
                    <label class="font-weight-bold" style="color:white;">
                       แบบฟอร์มสำหรับ QC เพื่อตีกลับแผนก
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                {{ Form::open(['method' => 'post' , 'url' => '#']) }}
                <div class="card-body" style="100%">
                    กรุณาเลือกแผนกที่ต้องการตีกลับ
                    <div style="height:150px;overflow-x: auto;">
                        <div class="row" style="margin:10px;">
                            @foreach ($all_department as $out_all_department)
                            <div class="col-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="checkboxcombackward"
                                        id="checkboxcombackward{{$out_select_data_job->ID}}{{$out_all_department->ID}}"
                                        value="{{$out_all_department->ID}}" onchange="checkOnlyOne(this.name,this.id,this.value)">
                                    <label class="custom-control-label"
                                        for="checkboxcombackward{{$out_select_data_job->ID}}{{$out_all_department->ID}}">{{$out_all_department->Name}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- //////////////////// --}}
                {{-- <div class="card-body" style="100%"> --}}
                    
                    {{-- <div>
                        <input type="text" name="test11" >
                   </div> --}}
                    <label class="font-weight-bold">
                        กรุณาเลือกข้อมูลจาก จุดควบคุมสำคัญ ในแผนกที่ตีกลับ
                    </label>
                        <div style="height:300px;overflow-x: auto;">
                            <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    @php $lenght = 0; @endphp
                                    @php
                                        foreach ($Sub_department_FQC as $out_Sub_department_FQC) {
                                            $temp1 = $out_Sub_department_FQC->Name;
                                        }
                                        $temp2 = 0;
                                   
                                    @endphp
                                        @foreach($data_fqc_checklist as $out_data_qc_checklist)
                                       
                                            @php
                                                $temp2 = $out_data_qc_checklist->sub_department;
                                            @endphp
                                            @if($temp2 != $temp1)
                                               <div class="card-header department departmentID_{{$out_data_qc_checklist->departmentID}}" departmentID="{{$out_data_qc_checklist->departmentID}}" role="tab" id="orderRequestTypeID">
                                                    <a data-toggle="collapse" href="#TypeofWork{{$temp2}}" aria-expanded="false" aria-controls="TypeofWork"  onclick="CheckQC_1({{$out_data_qc_checklist->sub_department}})" >
                                                        <label>{{$out_data_qc_checklist->Name}}</label>
                                                    </a>
                                                </div>
                                                @php $temp1 = $temp2 @endphp
                                            @endif
                                            @php $lenght++;@endphp

                                            {{-- <div class="card-body">  --}}
                                            <div id="TypeofWork{{$temp2}}" class="collapse department departmentID_{{$out_data_qc_checklist->sub_department}}" departmentID="{{$out_data_qc_checklist->sub_department}}" role="tabpanel" aria-labelledby="orderRequestTypeID" style="max-height: 380px;overflow-x:hidden;overflow-y: auto;">
                                                    <div class="row col-12" style="margin:10px;">
                                                        <div class="col-8">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" name="checkbox[]" id="checkboxcom{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}" value="{{$out_data_qc_checklist->ID}}" onchange="CheckQC({{$out_select_data_job->ID}},{{$out_data_qc_checklist->ID}})" >
                                                                <label class="custom-control-label" for="checkboxcom{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}" >{{$out_data_qc_checklist->ccp}}</label>
                                                            </div>
                                                        </div> 
                                                         {{-- <div class="col-4">
                                                            <input type="text" class="form-control" name="note[]" id="note{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}" placeholder="รายละเอียด" disabled/>
                                                        </div>  --}}
                                                   </div>
                                                </div> 
                                            {{-- </div> --}}
                                        
                                         @endforeach
                                    <input type="hidden" id="Employee" name="Employee" value="">
                                    <input type="hidden" id="count" name="count" value="0">
                                </div>
                            </div>
                        </div> 
                {{-- </div> --}}
               <br> 
                    {{-- //////////////// --}}
                    <div class="col-12">
                        <textarea class="form-control" id="notebackward{{$out_select_data_job->ID}}"
                            name="notebackward" placeholder="รายละเอียด"></textarea>
                    </div>
                    <div class="row" style="margin:5px;">
                        <div class="col-6">
                            <button class=" btn btn-block btn-danger"
                                id="QC_UNComplete_nonsubmit{{$out_select_data_job->ID}}" data-dismiss="modal"
                                aria-label="Close">ยกเลิก</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" id="QC_UNComplete_submit{{$out_select_data_job->ID}}"
                                class="btn btn-block btn-success"
                                formaction={{url('/job/'.$id.'/QC_Uncom_backward/'.$out_select_data_job->ID)}}>ตีกลับแผนกอื่น</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalService{{$out_select_data_job->ID}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        ส่งให้บริการ
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(['method' => 'post' , 'url' => '/job/'.$id.'/send_to_service/'.$out_select_data_job->ID]) }}
                <div class="card-body" style="100%">
                    <div class="row" style="overflow-x: auto;">
                        <div class="col-sm-12">
                            <textarea class="form-control" id="NoteService" name="NoteService" placeholder=""
                                autofocus></textarea>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12">
                            <select class="form-control" name="Service" required>
                                <option value="" selected>เลือกบริการ</option>
                                @foreach ($Service as $item)
                                <option value="{{$item->ID}}">{{$item->Nick_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="margin:5px;">
                        <div class="col-6">
                            <button class=" btn btn-block btn-danger"
                                id="QC_nonsubmit_uncom{{$out_select_data_job->ID}}" data-dismiss="modal"
                                aria-label="Close">ยกเลิก</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" id="QC_submit_uncom{{ $out_select_data_job->ID }}" name="Barcode"
                                value="{{ $out_select_data_job->Barcode }}" class="btn btn-block btn-success"
                                type="submit">ส่งให้บริการ</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modalnote{{$out_select_data_job->ID}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card">
                <div class="card-header align-items-center">
                    <label class="font-weight-bold">
                        Note
                    </label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                {{ Form::open(['method' => 'post' , 'url' => '/job/'.$id.'/call_to_doctor/'.$out_select_data_job->ID]) }}
                <div class="card-body" style="100%">
                    <div class="row" style="overflow-x: auto;">
                        <label class="col-form-label col-sm-12" for="Barcode">
                            <p class="card-description" style="font-size:15px;">หมายเหตุ :</span> </p>
                        </label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="note" name="noteQC" placeholder="Note QC"
                                autofocus>{{ $out_select_data_job->Note_QC }}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="overflow-x: auto;">
                        <label class="col-form-label col-sm-12" for="Barcode">
                            <p class="card-description" style="font-size:15px;">ผลการติดต่อ :</span> </p>
                        </label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="note" name="noteService" placeholder="Note Service"
                                autofocus>{{ $out_select_data_job->Note_Service }}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="margin:5px;">
                        <div class="col-6">
                            <button class=" btn btn-block btn-danger"
                                id="QC_nonsubmit_uncom{{$out_select_data_job->ID}}" data-dismiss="modal"
                                aria-label="Close" data-toggle="modal">ยกเลิก</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" id="QC_submit_uncom{{$out_select_data_job->ID}}"
                                class="btn btn-block btn-success" type="submit">โทรหาหมอแล้ว</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@endforeach



@stop
@section('scripts')

<script src="{{ asset('./js/shared/alerts.js') }}"></script>
<script src="{{ asset('./js/shared/avgrund.js') }}"></script>
<script>
    function CheckQC($idjob,$idQC){
        document.getElementById('note'+$idjob+' '+$idQC).value;
        if(document.getElementById('checkboxcom'+$idjob+' '+$idQC).checked == true){
            document.getElementById('note'+$idjob+' '+$idQC).disabled = false;
        }else{
            document.getElementById('note'+$idjob+' '+$idQC).disabled = true;
        }
    }
</script>
<script>
    jQuery(document).ready( function () {
            n = 2;
            $("#secondaryButton1").keydown( function() {
                if(event.keyCode == 13){
                    $( "#append" ).click();
                    return false;
                }
            });
            $("#append").click( function(e) {
                e.preventDefault();
                $(".inc").append("<div>\<div class='row'>\
                    <div class='col-sm-10'>\
                    <div class='input-group'>\
                    <input name='job[]' type='text' class='form-control' id='secondaryButton"+n+"' onkeydown='if (event.keyCode == 13) { \
                    return false;\
                    }' autofocus style='height: 32px; padding-bottom: 5px;padding-top: 5px;' /></div>\
                    </div>\
                <div class='col-sm-1'>\
                    <a href='#' class='remove_this btn btn-danger'style='padding-right: 10px;padding-left: 10px;'>X</a>\
                </div>\
                </div>\
                </div>\
                ");
                $("#secondaryButton"+n).val($("#secondaryButton1").val());
                $("#secondaryButton1").val('');
                n = n+1;
            });
        jQuery(document).on('click', '.remove_this', function() {
            jQuery(this).parent().parent().parent().remove();
            $("#secondaryButton1").focus();
            return false;
            });
        var massage =  $("#massage").val();
        if(massage != ""){
            alert(massage);
        } 
    });
</script>
<script>
    jQuery(document).ready( function () {
            n = 2;
            $("#secondaryButtonQC1").keydown( function() {
                if(event.keyCode == 13){
                    $( "#appendQC" ).click();
                    return false;
                }
            });
            $("#appendQC").click( function(e) {
                e.preventDefault();
                $(".incQC").append("<div>\<div class='row'>\
                    <div class='col-sm-10'>\
                    <div class='input-group'>\
                    <input name='job[]' type='text' class='form-control' id='secondaryButtonQC"+n+"' onkeydown='if (event.keyCode == 13) { \
                    return false;\
                    }' autofocus style='height: 32px; padding-bottom: 5px;padding-top: 5px;' /></div>\
                    </div>\
                <div class='col-sm-1'>\
                    <a href='#' class='remove_this btn btn-danger'style='padding-right: 10px;padding-left: 10px;'>X</a>\
                </div>\
                </div>\
                </div>\
                ");
                $("#secondaryButtonQC"+n).val($("#secondaryButtonQC1").val());
                $("#secondaryButtonQC1").val('');
                n = n+1;
            });
        jQuery(document).on('click', '.remove_this', function() {
            jQuery(this).parent().parent().parent().remove();
            $("#secondaryButtonQC1").focus();
            return false;
            });
    });
</script>

<script>
    jQuery(document).ready( function () {
            n = 3;
            $("#firstButton").keydown( function() {
                if(event.keyCode == 13){
                    $( "#append2" ).click();
                    return false;
                }
            });
            $("#append2").click( function(e) {
                e.preventDefault();
                $(".inc2").append("<div>\<div class='row'>\
                    <div class='col-sm-10'>\
                    <div class='input-group'>\
                    <input name='Barcode[]' type='text' class='form-control' id='firstButton2["+n+"]' onkeydown='if (event.keyCode == 13) { \
                    return false;\
                    }' autofocus style='height: 32px; padding-bottom: 5px;padding-top: 5px;' /></div>\
                    </div>\
                <div class='col-sm-1'>\
                    <a href='#' class='remove_this btn btn-danger' style='padding-right: 10px;padding-left: 10px;'>X</a>\
                </div>\
                </div>\
                </div>\
                ");
                $("#firstButton2\\["+n+"\\]").val($("#firstButton").val());
                $("#firstButton").val('');
                n = n+1;
            });
        jQuery(document).on('click', '.remove_this', function() {
            jQuery(this).parent().parent().parent().remove();
            $("#firstButton").focus();
            return false;
            });
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
</script>
<script>
    function CheckQC_1(value){
        // alert(value);
        console.log( $('.collapse.department').length );
                        $.each( $('.collapse.department') , function(index,element) {
                            if( $(this).attr('departmentID') == value ) { 
                                $(this).show();
                            }else{
                                $(this).hide();
                            }
                        });  
    }
    function checkOnlyOne(name,id,value){
        //  alert(name,id,value);
        $('input[name="test11"]').val(value);
        $('input[name="'+name+'"]').not('#'+id).prop('checked', false);

        // $('.card-header').not('.departmentID_'+value).hide();collapse
        console.log( $('.card-header.department').length );
        
        $.each( $('.card-header.department') , function(index,element) {
            // console.log( index + ": "+ $(this).attr('departmentID') ) ;
            if( $(this).attr('departmentID') == value ) { 
                $(this).show();
                        // console.log( $('.collapse.department').length );
                        // $.each( $('.collapse.department') , function(index,element) {
                        //     if( $(this).attr('departmentID') == value ) { 
                        //         $(this).show();
                        //     }
                        // });
            }else{
                $(this).hide();
                   console.log( $('.collapse.department').length );
                        $.each( $('.collapse.department') , function(index,element) {
                            if( $(this).attr('departmentID') != value ) { 
                                $(this).hide();
                            }else{
                                // $(this).show();
                            }
                        });  
            }
        });


        // console.log( $('.collapse.department').length );
        
        // $.each( $('.collapse.department') , function(index,element) {
        //     // console.log( index + ": "+ $(this).attr('departmentID') ) ;
        //     if( $(this).attr('departmentID') == value ) { 
        //         // $(this).show();
        //     }else{
        //         $(this).hide();
        //     }
        // });

        function CheckQC($idjob,$idQC){
        document.getElementById('note'+$idjob+' '+$idQC).value;
        if(document.getElementById('checkboxcom'+$idjob+' '+$idQC).checked == true){
            document.getElementById('note'+$idjob+' '+$idQC).disabled = false;
        }else{
            document.getElementById('note'+$idjob+' '+$idQC).disabled = true;
        }
    }
    }
</script>
<script>
    $('#example1').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    $('#example2').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    $('#example3').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );


    $(document).ready(function() {
        $('#defaultModal').on('shown.bs.modal', function() {
          $('#firstButton').trigger('focus');
        });
      });

      $(document).ready(function() {
        $('#subDeprt').on('shown.bs.modal', function() {
          $('#secondaryButton1').trigger('focus');
        });
      });

      $('#ourgoal-tab').hasClass('show',function() {
            $('#scanbarcode_pd').trigger('focus');
      });

</script>

<script>
    $("#scanbarcode_qc").keydown( function() {
        $("#Employee").val($("#scanbarcode_qc").val());
    });
</script>
<script>
    $("#req_employee_dept_2").on('click', function() {
        console.log('x');
        var scanbarcode_pd = $('#scanbarcode_pd').val();
        var id_department = '{{ $name_department->ID }}';

        $.ajax({
            type: 'GET',
            url: '{{ url('req_employee_dept') }}',
            data: {scanbarcode_pd:scanbarcode_pd,id_department:id_department},
            success: function (data) {
               var str = '';

                if (data == 'บาร์โค้ดไม่ถูกต้อง') {
                    var str =  '<b style="color:red;">'+data+'</b>';
                } else {

                    if (data[0][0].type_dep != 'qc' && data[0][0].Sub_DepartmentID != 7) { // แสดงแผนกหลัก แต่ ไม่แสดง หาก Qc เป็นแผนกหลัก
                        var str = '<label class="container"> '+data[0][0].Name+'\
                                 <input name="sub_depart[]" checked type="checkbox" id="1subDepartment" value="'+data[0][0].Sub_DepartmentID+'"> <br>\
                                 <span class="checkmark"></span>\
                              </label>';
                    }
                    for (let index = 0; index < data[1].length; index++) { // แสดง แผนกที่เหลือ
                    // console.log(data[1][index].Sub_DepartmentID);
                        if (data[1][index].Sub_DepartmentID != 7) { 
                    // console.log(data[1][index].Sub_DepartmentID);
                            
                            str = str + '<label class="container"> '+data[1][index].Name+'\
                                            <input name="sub_depart[]" type="checkbox" id="1subDepartment" value="'+data[1][index].Sub_DepartmentID+'"> <br>\
                                            <span class="checkmark"></span>\
                                        </label>';
                        }
                        
                    }

                    if (data[0][0].type_dep != 'qc' && data[0][0].Sub_DepartmentID == 7) { // แสดงแผนกหลัก แต่ ไม่แสดง หาก Qc เป็นแผนกหลัก
                         str = str + '<label class="container"> '+data[0][0].Name+'\
                                 <input name="sub_depart[]" checked type="checkbox" id="1subDepartment" value="'+data[0][0].Sub_DepartmentID+'"> <br>\
                                 <span class="checkmark"></span>\
                              </label>';
                    }
                    for (let index = 0; index < data[1].length; index++) { // แสดง แผนกที่เหลือ
                        if (data[1][index].Sub_DepartmentID == 7) { 
                            str = str + '<label class="container"> '+data[1][index].Name+'\
                                            <input name="sub_depart[]" type="checkbox" id="1subDepartment" value="'+data[1][index].Sub_DepartmentID+'"> <br>\
                                            <span class="checkmark"></span>\
                                        </label>';
                        }
                        
                    }

                    str = str + '<input type="hidden" id="EmployeeID" name="EmployeeID" value="'+data[0][0].user_id+'">';


                }
               
               $('#dept_data2').html(str);
               
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });
</script>

<script>
    var id_job = '{{ $id_job }}'
        var table = $('#department').DataTable({
            "scrollX": false,
            orderCellsTop: true,
            fixedHeader: true,
            ajax: {
                    url: '{{ url('ajax_get_data_job') }}',
                    data: {id_job:id_job},
            },
            columns: [
                { data: 'DeliverDate', name: 'DeliverDate' },
                { data: 'DeliverType', name: 'DeliverType' },
                { data: 'company_name', name: 'company_name' },
                { data: 'Zonename', name: 'Zonename' },
                { data: 'ID_area', name: 'ID_area' },
                { data: 'Barcode', name: 'Barcode' },
                { data: 'doctor', name: 'doctor' },
                { data: 'customer', name: 'customer' },
                { data: 'PatientName', name: 'PatientName' },
                { data: 'StartDate', name: 'StartDate' },
                { data: 'DeliverDate', name: 'DeliverDate' },
                { data: 'production_cycle', name: 'production_cycle' },
                { data: 'type_of_product', name: 'type_of_product' },
                { data: 'RefBarcode', name: 'RefBarcode' },
            ],
            columnDefs: [
                {
                    "targets": 0,   render: function(data, type, row)
                    {
                        if(data == null || data == ''){
                            return 'ไม่ระบุวันส่งงาน';
                        }else{
                            var c = data.split('/');
                            var FormatDay =  new Date(c[2],c[1]-1,c[0]);

                            var days = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
                            var daysWeek = days[ FormatDay.getDay() ];

                            if (daysWeek == 'อาทิตย์') {
                                return "<div style='background-color:#FF0000;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'จันทร์') {
                                return "<div style='background-color:#FFFF00;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'อังคาร') {
                                return "<div style='background-color:#FF0066;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'พุธ') {
                                return "<div style='background-color:#32CD32;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'พฤหัสบดี') {
                                return "<div style='background-color:#FF8C00;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'ศุกร์') {
                                return "<div style='background-color:#1E90FF;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'เสาร์') {
                                return "<div style='background-color:#990099;padding: 2px;'>"+daysWeek+"</div>" ;
                            }
                        }

                    },
                    orderable: true,
                    "className": "text-center",
                },
                {
                    "targets": 1,  render: function(data, type, row) {
                        if(data == 'ด่วน' || data == 'ด่วนรับปาก'){
                            return '<span style="display:none;">'+row['DeliverDate']+'</span> <div style="background-color:#FF0000;padding: 4px;"><font color="white" >'+data+'</font></div>';
                        }
                        else{
                            return data;
                        }
                    },
                    "className": "text-center",
                    orderable: false,
                },
                {
                    "targets": 2,
                    "className": "text-center",
                },
            {
                "targets": 3
            },
            {
                "targets": 4
            },
            {
                "targets": 5 , render: function(data, type, row) {
                    return '<a href="../summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                },
                "className": "text-center",
            },
            {
                "targets": 6
            },
            {
                "targets": 7
            },
            {
                "targets": 8
            },
            {
                "targets": 9,
                render: function(data, type, row) {
                    if(data!= null && data != ''){
                        var day = data;
                        day = day.split("/");
                        return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                    } else {
                        return null;
                    }
                },
                "className": "text-center",
            },
                {
                    "targets": 10,
                    render: function(data, type, row) {
                        if(data!= null && data != ''){
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        } else {
                            return null;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 11,  render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            return data;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 12,  render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            return data;
                        }
                    },
                },
            {
                    "targets": 13, render: function(data,type,row){
                        if(row['RefBarcode']){
                            return '<font color="red">งานแก้</font>';
                        }else if(row['ContiBarcode']){
                            return '<font color="blue">งานต่อเนื่อง</font>';
                        }else{
                            return 'งานใหม่';
                        }
                    }
                },
            ],
            "order": [],
        });
</script>

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script>
    function select_typeProduct(barcode){
        $.ajax({
            type: 'GET',
            url: '{{ url('ajax_get_type_product') }}',
            data: {barcode:barcode},
            success: function (data) {
                console.log(data);
                if(data == 'บาร์โค้ดไม่ถูกต้อง'){
                    $('#show_typeProduct').html('<b style="color:red;">'+data+'</b>');
                }
                else{
                    var str ='<div class="col-sm-12 text-center">\
                                            <b>เลือกชนิดงาน</b>\
                                        </div>';
                    for (let i = 0; i < data.length; i++) {
                        str = str + '<label class="container" > '+data[i].product_name+'\
                                                <input name="typeProduct[]" type="checkbox" id="type_product" value="'+data[i].TypeOfProductID+'">\
                                                <br>\
                                                <span class="checkmark"></span>\
                                            </label>';
                    }
                    str = str + '<div class="col-12 text-center" >\
                    <button class="btn btn-outline-success" name="OrderID" value="'+data[0].OrderID+'" style="padding-right: 10px;padding-left: 10px;">ยืนยัน</button></div>';
                    $('#show_typeProduct').html(str);
                }
            }
            });
    }
</script>
<script>
    $( "#acceptQC" ).on('shown.bs.modal', function(){
        $("#secondaryButtonQC1").focus();
    });
</script>
<script>
    function NoteModal(id){
        console.log(1);
        $.ajax({
            type: 'GET',
            url: '{{ url('ajax_get_note') }}',
            data: {id:id},
            success: function (data) {
                console.log(data);
                str =   '{{ Form::open(["method" => "post" , "url" => "/job/".$id."/send_to_doctor/"]) }}\
                            <div class="card-body" style="100%">\
                                <div class="row" style="overflow-x: auto;">\
                                <div class="col-sm-12" >\
                                        @if('+data[0].note+' != "")\
                                        <textarea class="form-control" id="note" name="note" placeholder="หมายเหตุ"\
                                            autofocus>'+data[0].note+'</textarea>\
                                        @else\
                                        <textarea class="form-control" id="note" name="note" placeholder="หมายเหตุ"\
                                            autofocus></textarea>\
                                        @endif\
                                        <input type="hidden" class="form-control" id="JobID" name="JobID" value="'+data[0].JobID+'" />\
                                        <input type="hidden" class="form-control" id="id_order_screen" name="id_order_screen" value="'+data[0].ID_order_screen+'" />\
                                    </div>\
                                </div>\
                                <br>\
                                <div class="row" style="margin:5px;">\
                                    <div class="col-6">\
                                        <button class=" btn btn-block btn-danger"\
                                            id="QC_nonsubmit_uncom'+data[0].JobID+'" data-dismiss="modal"\
                                            aria-label="Close">ยกเลิก</button>\
                                    </div>\
                                    <div class="col-6">\
                                        <button type="submit" id="QC_submit_uncom'+data[0].JobID+'"\
                                            class="btn btn-block btn-success" type="submit">ส่งให้หมอ</button>\
                                    </div>\
                                </div>\
                            </div>\
                        {{Form::close()}}';
                console.log(str);
                $('#DivNote'+id).html(str);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus); console.log("Error: " + errorThrown);
            }
        });
    }
</script>
@stop