@extends('layouts.template')

@section('title', 'ผลิต')

@section('stylesheet')
<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css" />

<style>
@media print{
    .no-print{ display:none; }
}
</style>
<style>
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
          background-color:grey ;
          border-radius: 210px;
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
        /* .dataTables_wrapper {
        position: relative;
        clear: both;
        width: auto;
        min-height : 150 px;
        margin-left: 0px;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        background-color: #9D9C9D;
        zoom: 1;
        } */

        table{
            font-size: 13px;
        }
</style>
@stop

@section('content')
@if (Session::has('message'))
<div class="modal" id="ModalMassage" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <hr> --}}
                <div class="modal-body">
                    <p>{{ Session::get('message') }}</p>
                </div>
                {{-- <hr> --}}
            </div>
        </div>
    </div>
   {{-- <div class="alert alert-danger">{{ Session::get('message') }}</div> --}}
@endif

<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row no-print">
                        <div class="col-12  text-center">
                            <h3>
                                <b>แผนก
                                    {{ $data_department->Name }}
                                </b>
                            </h3>
                        </div>
                        <br>
                    </div>

                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="ourgoal2" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row text-left">
                                <div class="col-2 text-left">
                                    <button type="button" style="margin-bottom: 10px;" class="btn btn-success" data-toggle="modal" data-target="#subDeprt">รับงาน</button>
                                </div>
                            </div>

                            <table id="example3" class=" table-striped table-bordered display compact nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>BarCode</th>
                                        <th>ขั้นตอน</th>
                                        <th>เวลาผลิต</th>
                                        {{-- <th>เวลางานเสร็จ</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count =1;
                                    @endphp
                                    @foreach ($select_data_job as $out_data_job)
                                        <tr>
                                            {{-- <td>{{ $count }}</td> --}}
                                            <td>{{$out_data_job->ID}}</td>
                                            <td>{{$out_data_job->Barcode}}</td>
                                            <td>{{$out_data_job->job_current_department}}</td>
                                            <td>{{$out_data_job->date_time_start}}</td>
                                            {{-- <td>{{$out_data_job->date_time_finish}}</td> --}}
                                            <td>
                                                {{ Form::open(['method' => 'post' , 'url' => '/FQC/'.$id.'/send_to_doctor/'.$out_data_job->ID.'/'.$out_data_job->ID_order_screen]) }}
                                                    <button class="btn btn-success" type="submit" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;" formaction={{url('/FQC/'.$id.'/fqc_complete/'.$out_data_job->ID)}}>QC ผ่าน</button>
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#ModalQCUNCom{{$out_data_job->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">QC ไม่ผ่าน</button>
                                                    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#note{{$out_data_job->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">ส่งให้หมอ</button>
                                                    <button class="btn btn-info" type="button" data-toggle="modal" data-target="#ModalService{{$out_data_job->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">ส่งให้บริการ</button>
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#Modalnote{{$out_data_job->ID}}" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">โทรหาหมอ</button>
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

{{-- รับงานเข้าแผนก --}}
    {{ Form::open(['method' => 'post' , 'url' => 'job/scan/add_FQC/'.$data_department->ID]) }}
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width:420px;">
                <div class="modal-content">
                    <div class="card-header align-items-center text-center">
                        <label class="font-weight-bold ">
                            รับงาน
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                        <div class="control-group">
                            <div class="inc2">
                                <label class="col-form-label col-sm-12"  for="Barcode">
                                        <p class="card-description" style="font-size:15px;"> สแกนบาร์โค๊ดงาน รับเข้าแผนก : </p>
                                </label>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <input type="hidden" id="append2" name="append2" >
                                        <input class='form-control' name='job[]' style="height: 32px; padding-bottom: 5px;padding-top: 5px;" type="text" id="firstButton" onkeydown="if (event.keyCode == 13) {
                                            return false;
                                        }" autofocus />
                                    </div>
                                    <button type="submit" class="btn btn-outline-success" style="padding-right: 10px;padding-left: 10px;">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close()}}

        {{-- subDeprt --}}
        <div class="modal fade" id="subDeprt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width:420px;">
                <div class="modal-content">
                    <div class="card-header align-items-center text-center">
                        <label class="font-weight-bold ">
                            รับงาน
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{ Form::open(['method' => 'post' , 'url' => '/FQC/add_FQC/'.$data_department->ID ,"style"=>"padding-bottom: 10px;"]) }}
                    <div class="col-sm-12" style="padding-bottom: 10px;padding-top: 10px;">
                        @if (!empty($user_subDepartment) )
                            @if (sizeof($user_subDepartment) == 1)
                                @foreach ($user_subDepartment as $subDepartment)
                                    <label class="container"> {{ $subDepartment->Name }}
                                        <input name="sub_depart"  type="radio" id="1subDepartment" checked> <br>
                                        <span class="checkmark"></span>
                                    </label>
                                    <input name="sub_depart" type="hidden" id="1subDepartment" value="{{ $subDepartment->Sub_DepartmentID }}">
                                @endforeach
                            @elseif( sizeof($user_subDepartment) > 1)
                                @foreach ($user_subDepartment as $subDepartment)
                                    <label class="container"> {{ $subDepartment->Name }}
                                        <input name="sub_depart"  type="radio" id="1subDepartment" value="{{ $subDepartment->Sub_DepartmentID }}"> <br>
                                        <span class="checkmark"></span>
                                    </label>
                                @endforeach
                            @endif
                        @endif
                    </div>

                    @if(!empty($usercode))
                        <input type="hidden" id="EmployeeID" name="EmployeeID" value="{{ $usercode }}">
                    @endif

                    <div class="col-sm-12">
                        <div class="control-group">
                            <div class="inc">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <input type="hidden" id="append" name="append" >
                                        <input class='form-control' name="job[]" style="height: 32px; padding-bottom: 5px;padding-top: 5px;" type="text" id="secondaryButton1" onkeydown="if (event.keyCode == 13) {
                                            return false;
                                        }" autofocus />
                                    </div>
                                    <button class="btn btn-outline-success" style="padding-right: 10px;padding-left: 10px;">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

@foreach ($select_data_job as $out_select_data_job)
    @foreach ($note as $out_note)
        @if($out_select_data_job->Barcode == $out_note->Barcode)
            <div class="modal fade" id="note{{$out_select_data_job->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                            {{ Form::open(['method' => 'post' , 'url' => '/FQC/'.$id.'/send_to_doctor/'.$out_select_data_job->ID.'/'.$out_note->ID]) }}
                            <div class="card-body" style="100%">
                                <div class="row" style="overflow-x: auto;">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="note" name="note" placeholder="หมายเหตุ" autofocus >{{$out_note->note}} </textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="margin:5px;">
                                    <div class="col-6">
                                        <button class=" btn btn-block btn-danger" id="QC_nonsubmit_uncom{{$out_select_data_job->ID}}"  data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalQCCom{{$out_select_data_job->ID}}" >ยกเลิก</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" id="QC_submit_uncom{{$out_select_data_job->ID}}" class="btn btn-block btn-success" type="submit">ส่งให้หมอ</button>
                                    </div>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <div class="modal fade" id="ModalQCUNCom{{$out_select_data_job->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    {{ Form::open(['method' => 'post' , 'url' => '/FQC/'.$id.'/fqc_uncomplete/'.$out_select_data_job->ID]) }}
                    <div class="card-body" style="100%">
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
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
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
                                                            <input type="checkbox" class="custom-control-input" name="checkbox[]" id="checkboxcom{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}" value="{{$out_data_qc_checklist->ID}}" onchange="CheckQC({{$out_select_data_job->ID}},{{$out_data_qc_checklist->ID}})">
                                                            <label class="custom-control-label" for="checkboxcom{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}" >{{$out_data_qc_checklist->ccp}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" name="note[]" id="note{{$out_select_data_job->ID}} {{$out_data_qc_checklist->ID}}" placeholder="รายละเอียด" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    <input type="hidden" id="Employee" name="Employee" value="">
                                    <input type="hidden" id="count" name="count" value="0">
                                </div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-6">
                                        <button class=" btn btn-block btn-danger" id="QC_UNComplete_nonsubmit{{$out_select_data_job->ID}}" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalQC{{$out_select_data_job->ID}}">ยกเลิก</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" id="QC_UNComplete_submit{{$out_select_data_job->ID}}" class="btn btn-block btn-success" formaction={{url('/FQC/'.$id.'/fqc_uncomplete/'.$out_select_data_job->ID)}} >ตีกลับให้ช่าง</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalService{{$out_select_data_job->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    {{ Form::open(['method' => 'post' , 'url' => '/FQC/'.$id.'/send_to_service/'.$out_select_data_job->ID]) }}
                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                            <div class="col-sm-12">
                                <textarea class="form-control" id="NoteService" name="NoteService" placeholder="" autofocus ></textarea>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-12">
                                <select class="form-control" name="Service" required>
                                    <option value="" disabled selected hidden>เลือกบริการ</option>
                                    @foreach ($Service as $item)
                                <option value="{{$item->ID}}">{{$item->Nick_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br/>
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger" id="QC_nonsubmit_uncom{{$out_select_data_job->ID}}" data-dismiss="modal" aria-label="Close" >ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="QC_submit_uncom{{$out_select_data_job->ID}}" class="btn btn-block btn-success" type="submit">ส่งให้บริการ</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modalnote{{$out_select_data_job->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                {{ Form::open(['method' => 'post' , 'url' => '/FQC/'.$id.'/call_to_doctor/'.$out_select_data_job->ID]) }}
                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">หมายเหตุ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="note" name="noteQC" placeholder="Note QC" autofocus >{{ $out_select_data_job->Note_QC }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">ผลการติดต่อ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="note" name="noteService" placeholder="Note Service" autofocus >{{ $out_select_data_job->Note_Service }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger" id="QC_nonsubmit_uncom{{$out_select_data_job->ID}}"  data-dismiss="modal" aria-label="Close" data-toggle="modal">ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="QC_submit_uncom{{$out_select_data_job->ID}}" class="btn btn-block btn-success" type="submit">โทรหาหมอแล้ว</button>
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

<script type="text/javascript">
    $(window).on('load',function(){
        $('#ModalMassage').modal('show');
    });
</script>

<script>
    $(document).ready(function(){
        if($('#count').val() > 0){
            $(window).on('load',function(){
                $('#whoweare').removeClass('active show');
                $('#home-tab').removeClass('active');
                $('#QC').removeClass('active');
                $('#ourgoal2').removeClass('show');

                $('#subDeprt').modal('show');

                $('#profile-tab').addClass('active');
                $('#ourgoal').addClass('show');
            });
        }
    });
</script>

<script>
    function CheckQC($idjob,$idQC){
        // alert(1);
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

    $('#example1').DataTable(
    {
        "scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    $('#example2').DataTable(
    {
        "scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    $('#example3').DataTable(
    {
        "scrollX": true,
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

@stop
