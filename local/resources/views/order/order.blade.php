@extends('layouts.template')
@section('title', 'สร้างงาน')
@section('stylesheet')

<link rel="stylesheet" href="{{ asset('css/datepicker/bootstrap-datepicker.css') }}">
<link rel="stylesheet" href="./css/bootstrap-material-datetimepicker.css">
<script>
    (function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function() {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
	ga('create', 'UA-60343429-1', 'auto');
	ga('send', 'pageview');

</script>
{{--    --}}
<style>
        table tr:not(:first-child){
            cursor: pointer;transition: all .25s ease-in-out;
        }
        table tr:not(:first-child):hover{background-color: #ddd;}
    </style>

<style>

    .radio-toolbar {
        margin: 10px;
    }

    .radio-toolbar input[type="radio"] {
        display: none;
    }

    .radio-toolbar label {
        display: inline-block;
        background-color: #ddd;
        width: 30%;
        height: 20%;
        padding: 20px;
        font-size: 14px;
        /* border: 2px solid #444; */
        /* border-radius: 4px;     */
    }

    .radio-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbar input[type="radio"]:checked+label {
        color: #fff;
        background-color: #19d895;
        border-color: #19d895;
    }

    ::-webkit-datetime-edit-year-field:not([aria-valuenow]),
    ::-webkit-datetime-edit-month-field:not([aria-valuenow]),
    ::-webkit-datetime-edit-day-field:not([aria-valuenow]) {
        color: transparent;
    }

    input[type=date]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        display: none;
    }

    ///////////////////////////////////////////////////////////
    /* Radio */

    .radio-toolbar1 {
        margin: 10px;
    }

    .radio-toolbar1 input[type=radio] {
        display: none;
    }

    input[type=radio]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }

    .radio-toolbar1 label {
        display: inline-block;
        background-color: #ddd;
        width: 45%;
        height: auto;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;
    }

    .radio-toolbar1 label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbar1 input[type="radio"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Radio */

    /* The switch - the box around the slider */

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .time1 {
        margin: .4rem 0;
    }


</style>

@stop
@section('content')
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            {{ Form::open(['method' => 'post' , 'url' => '/order/add']) }}
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h4>สร้างรายการใหม่</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 m-0 step-timeline">
                            <ul class="m-0 step-list">
                                <li class="yellow">บันทึกรหัสสั่งผลิต (Barcode)</li>
                                <li class="white">ข้อมูลลูกค้า & คนไข้</li>
                                <li class="white">เลือกแลปที่ผลิต</li>
                                {{-- <li class="white">สิ่งที่ส่งมาด้วย</li> --}}
                                <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                            </ul>
                        </div>
                        <div class="col-md-9 step-content">
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="accordion basic-accordion" role="tablist">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                        สร้าง Order
                                                        @if($errors->all())
                                                            <font color="red">&nbsp;{{ $errors->first() }}</font>
                                                        @endif
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                    <div class="card-body text-center">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="switch">
                                                                    <input type="checkbox" id="toggle0" name="toggleOral">
                                                                    <span class="slider round" ></span>
                                                                </label>
                                                                <label class="col-form-label " for="toggle123">
                                                                    Oral scan/ออรัล สแกน
                                                                </label>
                                                            </div>

                                                            <div class="col-3">
                                                                <label class="switch">
                                                                    <input type="radio" id="toggle1" name="toggle123" onclick="BarcodeFunction()" checked>
                                                                    <span class="slider round" ></span>
                                                                </label>
                                                                <label class="col-form-label " for="toggle123">
                                                                    งานใหม่
                                                                </label>
                                                            </div>

                                                            <div class="col-3">
                                                                <label class="switch">
                                                                    <input type="radio" id="toggle2" name="toggle123" onclick="BarcodeFunction()">
                                                                    <span class="slider round"></span>
                                                                    <!-- onclick="BarcodeFunction() -->
                                                                </label>
                                                                <label class="col-form-label " for="toggle123">
                                                                    งานต่อเนื่อง
                                                                </label>
                                                            </div>

                                                            <div class="col-3">
                                                                <label class="switch">
                                                                    <input type="radio" id="toggle3" name="toggle123" onclick="BarcodeFunction()">
                                                                    <span class="slider round"  ></span>
                                                                    <!-- onclick="BarcodeFunction2()" -->
                                                                </label>
                                                                <label class="col-form-label " for="toggle">
                                                                    งานแก้
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <br>

                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="row" id="Barcode" >
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="Barcode">รหัสสั่งผลิต</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                                                            </div>
                                                                            {{-- <!-- {{ Form::text('Barcode',null,['ID'=>'Barcode1','class' => 'form-control','placeholder' => 'Barcode' ,'autocomplete'=>'off']) }} --> --}}
                                                                            <input class="form-control" name="Barcode" id="Barcode1" autocomplete="off" placeholder = "Barcode"  autocomplete ="off" required=""
                                                                            oninvalid="this.setCustomValidity('โปรดระบุ รหัสสั่งผลิต')" oninput="setCustomValidity('')" autofocus onKeyUp="if(this.value*1!=this.value) this.value='' ;" onkeydown="if (event.keyCode == 13) return false;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
{{--  First Name:<input type="text" name="fname" id="fname"><br><br>


<div class="col-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#defaultModal">รับงาน</button>
</div>  --}}


                                                            <!-- style="display:none;" -->
                                                            {{-- <div class="col-6">
                                                                <div class="row" id="RefBarcode"  style="display:none;">
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="barcode">รหัสอ้างอิง</label><br><br>
                                                                        <button style="width:125%;text-align:left;padding-left: 10px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#defaultModal2">บาร์โค้ดอ้างอิง</button>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-barcode"></i></span>
                                                                            </div>
                                                                            {{ Form::text('RefBarcode',null, ['id'=>'Barcode2','class' => 'form-control','placeholder' => 'Barcode อ้างอิง']) }}
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <br>


                                                        <div class="row" id="RefBarcode"  style="display:none;">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <label class="col-form-label " for="Barcode">รหัสงานต่อเนื่อง</label>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                                                            </div>
                                                                              {{ Form::text('RefBarcode',null, ['id'=>'Barcode2','class' => 'form-control','placeholder' => 'Barcode อ้างอิง']) }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#defaultModal2">บาร์โค้ดอ้างอิง</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" id="ContiBarcode"  style="display:none;">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <label class="col-form-label " for="Barcode">รหัสงานต่อเนื่อง</label>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                                                            </div>
                                                                                {{ Form::text('ContiBarcode',null, ['id'=>'Barcode3', 'class' => 'form-control','placeholder' => 'Barcode งานต่อเนื่อง']) }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#defaultModal">บาร์โค้ดงานต่อเนื่อง</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="pickup">วันรับงาน*</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-table-edit"></i></span>
                                                                            </div>
                                                                            <!-- value="{{date(" d/m/Y ", strtotime('+7 hours'))}}" -->
                                                                            <input class="form-control" type="text" placehoder="Start Date" data-date-format="dd/mm/yyyy" name="StartDate" id="startdate" autocomplete="off" readonly/>
                                                                            <!-- <input id="inputdatepicker" class="datepicker" data-date-format="mm/dd/yyyy"> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <br>
                                                                    <div class="col-4">
                                                                        <label class="col-form-label" for="pickup">วันส่งงาน*</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-timetable"></i></span>
                                                                            </div>
                                                                            <input class="form-control" type="text" placehoder="End Date" data-date-format="dd/mm/yyyy" name="Enddate" id="enddate" oninvalid="this.setCustomValidity('Please Enter valid email')" autocomplete="off" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <br>
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="pickup">เวลาส่งงาน</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                                                                             <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                                                                <div class="input-group-addon input-group-append">
                                                                                    <i class="mdi mdi-clock input-group-text"></i>
                                                                                </div>
                                                                                <!-- <input class="form-control" type="text" placeholder="Time" data-date-format="dd/mm/yyyy" id="time1" name="ReceptionTime" /> -->
                                                                                 <!-- <input type="text" id="time1" name="ReceptionTime" class="form-control floating-label" placeholder="Time"> -->

                                                                                 <!-- <input type="time" id="time1"class="form-control floating-label" name="ReceptionTime" min="9:00" max="18:00" value='now' required> -->

                                                                                 <input type='time' id="time1"class="form-control floating-label" name="ReceptionTime" value=''/>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="pickup">วันนัดจริง*</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fa fa-caret-square-o-up"></i></span>
                                                                            </div>
                                                                            <input class="form-control" type="text" placehoder="Start Date" data-date-format="dd/mm/yyyy" name="Datefinal" id="datefinal"autocomplete="off" readonly/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-3" style="padding-right: 5%;">
                                                                    <label class="col-form-label " for="pickup"><br>ประเภทของงาน</label></div>

                                                                    <div class="col-12">
                                                                    <div class="row">
                                                                        <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                            <div class="card-body text-center">
                                                                                <div class="radio-toolbar">
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            @foreach($type_Deliver as $out_type_Deliver) @if ($loop->first)
                                                                                            <input type="radio" id="{{ $out_type_Deliver->ID }}" name="radio" value="{{ $out_type_Deliver->ID }}" checked>
                                                                                            <label  style="cursor:pointer;width: 100px;padding-top: 10px;padding-bottom: 20px;height: 45px;margin-bottom: 0px;"
                                                                                            for="{{ $out_type_Deliver->ID }}" style="cursor:pointer;">{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                                                                            @else
                                                                                            <input type="radio" id="{{ $out_type_Deliver->ID }}" name="radio" value="{{ $out_type_Deliver->ID }}">
                                                                                            <label style="cursor:pointer;width:100px; padding-top: 10px;padding-bottom: 20px;height: 45px;margin-bottom: 0px;"
                                                                                            for="{{ $out_type_Deliver->ID }}" style="cursor:pointer;">{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                                                                            @endif @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                    <br/>
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <input class="form-control" type="text" name="DesRadio6" style="display:none;">
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

                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="accordion basic-accordion" role="tablist">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                        ประเภทของงาน
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                    <div class="card-body text-center">
                                                        <div class="radio-toolbar">
                                                            @foreach($type_Deliver as $out_type_Deliver) @if ($loop->first)
                                                            <input type="radio" id="{{ $out_type_Deliver->ID }}" name="radio" value="{{ $out_type_Deliver->ID }}" checked>
                                                            <label for="{{ $out_type_Deliver->ID }}" style="cursor:pointer;">{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                                            @else
                                                            <input type="radio" id="{{ $out_type_Deliver->ID }}" name="radio" value="{{ $out_type_Deliver->ID }}">
                                                            <label for="{{ $out_type_Deliver->ID }}" style="cursor:pointer;">{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                                            @endif @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  --}}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-lg btn-success">
                                ต่อไป
                                <i class="mdi mdi-arrow-right-bold"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card-header align-items-center">
                <label class="font-weight-bold">
                    เลือกรหัสงานต่อเนื่อง
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="col-12 text-left">
                    <div class="row">
                            <table class="table table-striped table-bordered" id="table" >
                                    <tr>
                                        <th>Barcode</th>
                                        <th>ชื่อแพทย์</th>
                                        <th>สถานะงาน</th>
                                    </tr>
                                @foreach ($job_continue as $job)
                                    <tr>
                                        <td>{{ $job->Barcode }}</td>
                                        <td>{{ $job->Name }}</td>
                                        <td>{{ $job->current_status }}</td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                    </div>
                    <div class="col-3">
                        <br>
                        <button class="btn btn-primary"  type="button" data-dismiss="modal" >ยืนยันการเลือก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width:800px;">
        <div class="modal-content">
            <div class="card-header align-items-center">
                <label class="font-weight-bold">
                    เลือกรหัสงานต่อเนื่อง
                </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="col-12 text-left">
                    <div class="row">
                            <table id="table2" class="table table-striped table-bordered">
                                <tr>
                                    <th>Barcode</th>
                                    <th>ชื่อแพทย์</th>
                                    <th>สถานะงาน</th>
                                </tr>
                                @foreach ($job_sendBack as $job)
                                    <tr>
                                        <td>{{ $job->Barcode }}</td>
                                        <td>{{ $job->Name }}</td>
                                        <td>{{ $job->current_status }}</td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9">
                    </div>
                    <div class="col-3">
                            <br>
                         <button class="btn btn-primary"  type="button" data-dismiss="modal" >ยืนยันการเลือก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
@section('scripts')

<script>

        var table = document.getElementById('table');

        for(var i = 1; i < table.rows.length; i++)
        {
            table.rows[i].onclick = function()
            {
                 //rIndex = this.rowIndex;
                 document.getElementById("Barcode3").value = this.cells[0].innerHTML;
            };
        }

 </script>

<script>

        var table = document.getElementById('table2');

        for(var i = 1; i < table.rows.length; i++)
        {
            table.rows[i].onclick = function()
            {
                 //rIndex = this.rowIndex;
                 document.getElementById("Barcode2").value = this.cells[0].innerHTML;
            };
        }

 </script>


<!-- <script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>- -->
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- <script src="{{ asset('js/bootstrap-datepicker.th.js') }}"></script> -->
<!-- <script src="{{ asset('js/bootstrap-datepicker-custom.js') }}"></script> -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
    $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
    });
    $(function(){
        var d = new Date(),
            h = d.getHours(),
            m = d.getMinutes();
        if(h < 10) h = '0' + h;
        if(m < 10) m = '0' + m;
        $('input[type="time"][value="now"]').each(function(){
            $(this).attr({'value': h + ':' + m});
        });
    });
    $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    });
    $(document).ready(function(){
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

                // $("#startdate").datepicker({
                //     todayBtn:  1,
                //     autoclose: true,

                // }).on('changeDate', function (selected) {
                //     var minDate = new Date(selected.date.valueOf());
                //     $('#enddate').datepicker('setStartDate', minDate);
                //     $('#datefinal').datepicker('setStartDate', minDate);
                // });

                $("#enddate").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                // $('#startdate').datepicker('setEndDate', minDate);
                $('#datefinal').datepicker('setStartDate', minDate);
                });

                $("#datefinal").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                // $('#startdate').datepicker('setEndDate', minDate);
                });
                // $( '#enddate, #datefinal' ).datepicker('setDate', today);
                $('#enddate').datepicker('setStartDate', date);


                if ((today.getMonth() + 1) < 10) {
                    var formatMonth = '0' + (today.getMonth() + 1);
                }else{
                    var formatMonth = (today.getMonth() + 1);
                }
                let formatted_date =  today.getDate() +  "/" + formatMonth +"/" + today.getFullYear()
                $( '#startdate').val(formatted_date);




            });

            function BarcodeFunction() {
                var Testtoggle1 = document.getElementById("toggle1");
                var Testtoggle2 = document.getElementById("toggle2");
                var Testtoggle3 = document.getElementById("toggle3");

                var Bracode = document.getElementById("Bracode");
                var RefBarcode = document.getElementById("RefBarcode");
                var ContiBarcode = document.getElementById("ContiBarcode");



                if(Testtoggle1.checked == true){
                    RefBarcode.style.display = "none";
                    ContiBarcode.style.display = "none";
                }
                if(Testtoggle2.checked == true){
                    RefBarcode.style.display = "none";
                    ContiBarcode.style.display = "flex";
                }
                if(Testtoggle3.checked == true){
                    ContiBarcode.style.display = "none";
                    RefBarcode.style.display = "flex";
                }
            }
            $('#toggle1').click(function() {
                $('#Barcode3').val('');
                $('#Barcode2').val('');
            });
            $('#toggle2').click(function() {
                $('#Barcode3').val('');
            });
            $('#toggle3').click(function() {
                $('#Barcode2').val('');
            });
            $(document).ready(function()
            {
                $('#time1').bootstrapMaterialDatePicker
                ({
                    date: false,
                    shortTime: false,
                    format: 'HH:mm'
                });
            });
            // $(function() {
            //     $("#time1").datetimepicker('show');
            // });

</script>
<script>
    $('#WorkNew1').click(function() {
                $('#RefBarcode').val(null);
        });
</script>
<script>
    $('input[name ="radio"]').change(function() {
        if(this.value == 6){
            $('input[name ="DesRadio6"]').show();
        }else{
            $('input[name ="DesRadio6"]').hide();
        }
    });
</script>

@stop
