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

<style>
    .radio-toolbar {
    margin: 10px;
    }

    .radio-toolbar input[type="radio"] {
        display:none;
    }

    .radio-toolbar label {
             display:inline-block;
             background-color:#ddd;
             width: 20%;
             height: 20%;
             padding: 20px;
             font-size:14px;
             /* border: 2px solid #444; */
             /* border-radius: 4px;     */
         }
    .radio-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbar input[type="radio"]:checked + label {
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
        display: none;}

///////////////////////////////////////////////////////////
    /* Radio */
    .radio-toolbar1 {
        margin: 10px;
    }
    .radio-toolbar1 input[type=radio] {
        display:none;
    }
    input[type=radio]:checked + label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }
    .radio-toolbar1 label {
        display:inline-block;
        background-color:#ddd;
        width: 45%;
        height: auto;
        padding: 1%;
        font-size:14px;
        border-radius: 4px;
        margin: 1%;
    }
    .radio-toolbar1 label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }
    .radio-toolbar1 input[type="radio"]:checked + label {
        background-color: #19d895;
        border-color: #19d895;
    }
    /* End Radio */

        
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
                                <li class="white">เลือกโรงงานผลิต</li>
                                <li class="white">สิ่งที่ส่งมาด้วย</li>
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
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                    <div class="card-body text-center">

                                                        <div class="row">
                                                            <div class="col-8"></div>
                                                            <div class="col-4">
                                                                <div class="row radio-toolbar1 text-center">
                                                                    <input type="radio" name="Barcode"  id="WorkNew1" value="have" onclick="BarcodeFunction()" >
                                                                    <label for="WorkNew1"  style="cursor:pointer;">งานใหม่</label>

                                                                    <input type="radio" name="Barcode" id="WorkModify1" value="don't have" onclick="BarcodeFunction()" >
                                                                    <label for="WorkModify1"  style="cursor:pointer;">งานเเก้ </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="row">
                                                            <div  class="col-6">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="Barcode">รหัสสั่งผลิต</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                                                            </div>
                                                                            {{ Form::text('Barcode',null, ['class' => 'form-control','placeholder' => 'Barcode']) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- style="display:none;" -->
                                                            <div class="col-6" id="RefBarcode1"style="display:none;" >
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="barcode">รหัสอ้างอิง</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-barcode"></i></span>
                                                                            </div>
                                                                            {{ Form::text('RefBarcode',null, ['ID'=>'RefBarcode','class' => 'form-control','placeholder' => 'Barcode อ้างอิง']) }}
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
                                                                        <label class="col-form-label " for="pickup">วันรับงาน*</label>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="mdi mdi-table-edit"></i></span>
                                                                            </div>
                                                                            <input class="form-control" type="text" placehoder="Start Date"data-date-format="dd/mm/yyyy"  placeholder = "{{date("d/m/Y", strtotime('+7 hours'))}}" name="StartDate" id="startdate"/>
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
                                                                                <input class="form-control" type="text" placehoder="End Date" data-date-format="dd/mm/yyyy" name="Enddate" id="enddate"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    
                                                            <div class="col-6">
                                                                <div class="row">
                                                                    <br>
                                                                    <div class="col-4">
                                                                        <label class="col-form-label " for="pickup">เวลาส่งงาน*</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                                                                            <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                                                                <div class="input-group-addon input-group-append">
                                                                                <i class="mdi mdi-clock input-group-text"></i>
                                                                                </div>
                                                                                <input type="text" id="time1" name="ReceptionTime" class="form-control floating-label" placeholder="Time">
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
                                    </div>
                                </div>

                                <br>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="accordion basic-accordion" role="tablist">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                        ประเภทของงาน
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                    <div class="card-body text-center">

                                                        <div class="radio-toolbar">

                                                        @foreach($type_Deliver as $out_type_Deliver)
                                                            @if ($loop->first)
                                                                <input type="radio" id="{{ $out_type_Deliver->ID }}" name="radio" value="{{ $out_type_Deliver->ID }}" checked>
                                                                <label for="{{ $out_type_Deliver->ID }}" style="cursor:pointer;">{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                                            @else
                                                                <input type="radio" id="{{ $out_type_Deliver->ID }}" name="radio" value="{{ $out_type_Deliver->ID }}">
                                                                <label for="{{ $out_type_Deliver->ID }}" style="cursor:pointer;">{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                                            @endif
                                                        @endforeach
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
    {{ Form::close() }}
    </div>
  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script> 
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" >
             $(document).ready(function(){
    
                $("#startdate").datepicker({
                    todayBtn:  1,
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('#enddate').datepicker('setStartDate', minDate);
                });
                
                $("#enddate").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
            });

            });

        function BarcodeFunction() {
                var New = document.getElementById("WorkNew1");
                var Modify = document.getElementById("WorkModify1");

                var Barcode = document.getElementById("Barcode");
                var RefBarcode = document.getElementById("RefBarcode1");
            
                if(New.checked == true){
                    RefBarcode.style.display = "none";
                }
                if(Modify.checked == true) {
                    RefBarcode.style.display = "block";
                }
            
            }
            $(document).ready(function()
            {
                $('#time1').bootstrapMaterialDatePicker
                ({
                    date: false,
                    shortTime: false,
                    format: 'HH:mm'
                });
            });

    </script> 
       <script>
        $('#WorkNew1').click(function() {
                $('#RefBarcode').val('');
        });
    </script>
@stop
