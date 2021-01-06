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
                                <b>แผนกบริการเทคนิค</b>
                            </h3>
                        </div>
                        <br>
                    </div>
                    <ul class="nav nav-tabs tab-basic no-print" role="tablist" style="margin-bottom: 3px;">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#whoweare" role="tab" aria-controls="whoweare" aria-selected="true">
                                <h6>รอติดต่อหมอ</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#whoweare2" role="tab" aria-controls="whoweare2" aria-selected="true">
                                <h6>ติดต่อหมอแล้ว</h6>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="whoweare" role="tabpanel" aria-labelledby="profile-tab">
                            {{-- <div class="row text-left">
                                <div class="col-2 text-left">
                                    <button type="button" style="margin-bottom: 10px;" class="btn btn-success" data-toggle="modal" data-target="#subDeprt">รับงาน</button>
                                </div>
                            </div> --}}

                            <table id="example1" class="table-striped table-bordered display compact nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>BarCode</th>
                                        <th>ชื่อพนักงานที่รับ</th>
                                        <th>ชื่อหมอ</th>
                                        <th>เบอร์โทรหมอ</th>
                                        <th>ไลน์หมอ</th>
                                        <th>ขั้นตอน</th>
                                        <th>วันรับงาน</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Auth::user()->ID_type_users == 1)
                                        @php
                                        $count =1;
                                        @endphp
                                        @foreach ($select_data_job_admin as $out_data_job)
                                                <tr>
                                                    <td>{{$count++ }}</td>
                                                    {{-- <td>{{$out_data_job->ID}}</td> --}}
                                                    <td><a href="../summary_report/{{$out_data_job->ID_order_screen}}" target="_blank" >{{$out_data_job->Barcode}}</a></td>
                                                    <td>{{ $out_data_job->Name_Service }}</td>
                                                    <td>{{ $out_data_job->name_doctor }}</td>
                                                    <td>{{ $out_data_job->phone_doctor }}</td>
                                                    <td>{{ $out_data_job->line_doctor }}</td>
                                                    <td><label class="badge badge-outline-primary badge-pill">{{ $out_data_job->job_current_department }}  -  รอติดต่อหมอ</td>
                                                    <td>{{$out_data_job->date_time_start}}</td>
                                                    <td><button class="btn waves-effect waves-light btn-success" type="button" data-toggle="modal" data-target="#note{{$out_data_job->ID}}"
                                                        style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">บันทึกการติดต่อหมอ</button>

                                                        <button class="btn waves-effect waves-light btn-primary" type="button" data-toggle="modal" data-target="#teeth{{$out_data_job->ID}}"
                                                            style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">แก้ไขซี่ฟัน</button>

                                                        <button class="btn waves-effect waves-light btn-warning" type="button" data-toggle="modal" data-target="#doctor{{$out_data_job->doctor_ID}}"
                                                            style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">แก้ไข้ข้อมูลหมอ</button>
                                                    </td>
                                                </tr>
                                            @php
                                                $count = $count+1;
                                            @endphp
                                        @endforeach
                                    @else
                                        @php
                                        $count =1;
                                        @endphp
                                        @foreach ($select_data_job as $out_data_job)
                                                <tr>
                                                    <td>{{$count++ }}</td>
                                                    {{-- <td>{{$out_data_job->ID}}</td> --}}
                                                    <td><a href="../summary_report/{{$out_data_job->ID_order_screen}}" target="_blank" >{{$out_data_job->Barcode}}</a></td>
                                                    <td>{{ $out_data_job->Name_Service }}</td>
                                                    <td>{{ $out_data_job->name_doctor }}</td>
                                                    <td>{{ $out_data_job->phone_doctor }}</td>
                                                    <td>{{ $out_data_job->line_doctor }}</td>
                                                    <td><label class="badge badge-outline-primary badge-pill">{{ $out_data_job->job_current_department }}  -  รอติดต่อหมอ</td>
                                                    <td>{{$out_data_job->date_time_start}}</td>
                                                    <td><button class="btn waves-effect waves-light btn-success" type="button" data-toggle="modal" data-target="#note{{$out_data_job->ID}}"
                                                        style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">บันทึกการติดต่อหมอ</button>

                                                        <button class="btn waves-effect waves-light btn-primary" type="button" data-toggle="modal" data-target="#teeth{{$out_data_job->ID}}"
                                                            style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">แก้ไขซี่ฟัน</button>
                                                        
                                                        <button class="btn waves-effect waves-light btn-warning" type="button" data-toggle="modal" data-target="#doctor{{$out_data_job->doctor_ID}}"
                                                            style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">แก้ไข้ข้อมูลหมอ</button>
                                                    </td>
                                                    </td>
                                                </tr>
                                            @php
                                                $count = $count+1;
                                            @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade active" id="whoweare2" role="tabpanel" aria-labelledby="profile-tab">
                            <table id="example3" class="table-striped table-bordered display compact nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>BarCode</th>
                                        <th>ชื่อหมอ</th>
                                        <th>เบอร์โทรหมอ</th>
                                        <th>ไลน์หมอ</th>
                                        <th>ขั้นตอน</th>
                                        <th>วันรับงาน</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(Auth::user()->ID_type_users == 1)
                                    @php
                                    $count =1;
                                    @endphp
                                    @foreach ($select_data_job_contacted_admin as $out_data_job)
                                        <tr>
                                            <td>{{$out_data_job->ID}}</td>
                                            <td><a href="../summary_report/{{$out_data_job->ID_order_screen}}" target="_blank" >{{$out_data_job->Barcode}}</a></td>
                                            <td>{{ $out_data_job->name_doctor }}</td>
                                            <td>{{ $out_data_job->phone_doctor }}</td>
                                            <td>{{ $out_data_job->line_doctor }}</td>
                                            <td><label class="badge badge-outline-primary badge-pill">{{ $out_data_job->job_current_department }}  -  ติดต่อหมอแล้ว</label></td>
                                            <td>{{$out_data_job->date_time_start}}</td>
                                            <td><button class="btn waves-effect waves-light btn-success" type="button" data-toggle="modal" data-target="#note2{{$out_data_job->ID}}"
                                                style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">รายการ การติดต่อหมอ</button>
                                            </td>
                                        </tr>
                                        @php
                                            $count = $count+1;
                                        @endphp
                                    @endforeach
                                @else
                                    @php
                                        $count =1;
                                    @endphp
                                    @foreach ($select_data_job_contacted as $out_data_job)
                                        <tr>
                                            <td>{{$out_data_job->ID}}</td>
                                            <td><a href="../summary_report/{{$out_data_job->ID_order_screen}}" target="_blank" >{{$out_data_job->Barcode}}</a></td>
                                            <td>{{ $out_data_job->name_doctor }}</td>
                                            <td>{{ $out_data_job->phone_doctor }}</td>
                                            <td>{{ $out_data_job->line_doctor }}</td>
                                            <td><label class="badge badge-outline-primary badge-pill">{{ $out_data_job->job_current_department }}  -  ติดต่อหมอแล้ว</td>
                                            <td>{{$out_data_job->date_time_start}}</td>
                                            <td><button class="btn waves-effect waves-light btn-success" type="button" data-toggle="modal" data-target="#note2{{$out_data_job->ID}}"
                                                style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:20px;">รายการ การติดต่อหมอ</button>
                                            </td>
                                        </tr>
                                        @php
                                            $count = $count+1;
                                        @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($select_data_job as $out_data_job)
{{ Form::open(['method' => 'post' , 'url' => '/service/'.$id.'/send_to_service_teeth/'.$out_data_job->ID]) }}
    <div class="modal fade" id="teeth{{$out_data_job->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">หมายเหตุ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="Noteteeth" name="Noteteeth" placeholder="หมายเหตุแก้ไขซี่ฟัน" autofocus ></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger" data-dismiss="modal" aria-label="Close" data-toggle="modal">ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-block btn-success" type="submit">แก้ไขซี่ฟัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endforeach



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
            {{ Form::open(['method' => 'post' , 'url' => '/service/add_service/'.$id ,"style"=>"padding-bottom: 10px;"]) }}
            <div class="col-sm-12">
                <div class="control-group">
                    <div class="inc">
                        <div class="row">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">กรุณาสแกนบาร์โค้ด <span style="color:red;">เพื่อรับงาน :</span> </p></label>
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

@foreach ($select_data_job as $out_data_job)
    <div class="modal fade" id="note{{$out_data_job->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    {{ Form::open(['method' => 'post' , 'url' => '/service/'.$id.'/send_to_service_/'.$out_data_job->ID]) }}
                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">หมายเหตุ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="note" name="noteQC" placeholder="Note QC" autofocus >{{ $out_data_job->Note_QC }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">ผลการติดต่อ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="note" name="noteService" placeholder="Note Service" autofocus >{{ $out_data_job->Note_Service }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger" id="QC_nonsubmit_uncom{{$out_data_job->ID}}"  data-dismiss="modal" aria-label="Close" data-toggle="modal">ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="QC_submit_uncom{{$out_data_job->ID}}" class="btn btn-block btn-success" type="submit">โทรหาหมอแล้ว</button>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($select_data_job_contacted as $out_data_job2)
    <div class="modal fade" id="note2{{$out_data_job2->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">หมายเหตุ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea readonly class="form-control" id="note" name="noteQC" placeholder="Note QC" autofocus >{{ $out_data_job2->Note_QC }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">ผลการติดต่อ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea readonly class="form-control" id="note" name="noteService" placeholder="Note Service" autofocus >{{ $out_data_job2->Note_Service }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@foreach ($select_data_job_contacted as $out_data_job2)
    <div class="modal fade" id="docter{{$out_data_job2->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">หมายเหตุ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea readonly class="form-control" id="note" name="noteQC" placeholder="Note QC" autofocus >{{ $out_data_job2->Note_QC }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">ผลการติดต่อ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea readonly class="form-control" id="note" name="noteService" placeholder="Note Service" autofocus >{{ $out_data_job2->Note_Service }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($select_data_job as $out_data_job_doc)
    <div class="modal fade" id="doctor{{$out_data_job_doc->doctor_ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:800px;">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header align-items-center">
                        <label class="font-weight-bold">
                            หมอ
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    {{-- {{ Form::open(['method' => 'post' , 'url' => '/service/'.$id.'/send_to_service_/'.$out_data_job_doc->ID]) }} --}}
                    {{ Form::open(['method' => 'post' , 'url' => '/service/edit/'.$id.'/'.$out_data_job_doc->doctor_ID]) }}
                    <div class="card-body" style="100%">
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">ชื่อ-นาลสกุล :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="name" name="name" placeholder="ชื่อ-นาลสกุล" autofocus >{{ $out_data_job_doc->name_doctor }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="overflow-x: auto;">
                                <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">เบอร์โทรหมอ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="phone_doctor" name="phone_doctor" placeholder="เบอร์โทรหมอ" autofocus >{{ $out_data_job_doc->phone_doctor }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="overflow-x: auto;">
                            <label class="col-form-label col-sm-12" for="Barcode"><p class="card-description" style="font-size:15px;">ไลน์ :</span> </p></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="line_doctor" name="line_doctor" placeholder="ไลน์" autofocus >{{ $out_data_job_doc->line_doctor }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="margin:5px;">
                            <div class="col-6">
                                <button class=" btn btn-block btn-danger" id="QC_nonsubmit_uncom{{$out_data_job->ID}}"  data-dismiss="modal" aria-label="Close" data-toggle="modal">ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="submit"  class="btn btn-block btn-success" type="submit">บันทึก</button>
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

    var table1 = $('#example1').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    table1.on( 'order.dt search.dt', function () {
        table1.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table1.cell(cell).invalidate('dom');
        } );
    } ).draw();
    var table2 = $('#example2').DataTable(
    {
       // "scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    table2.on( 'order.dt search.dt', function () {
        table2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table2.cell(cell).invalidate('dom');
        } );
    } ).draw();
    var table3 = $('#example3').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    table3.on( 'order.dt search.dt', function () {
        table3.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table3.cell(cell).invalidate('dom');
        } );
    } ).draw();

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
