@extends('layouts.template')

@section('title', 'เลือกซี่ฟัน')

@section('stylesheet')
    <link rel="stylesheet" href="css/main.css">
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
        width: 20%;
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
</style>
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['method' => 'post' , 'url' => '/mainscreen/teeth/'.$id.'/save']) }}
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h4>เลือกซี่ฟัน</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 m-0 step-timeline">
                            <ul class="m-0 step-list">
                                <li>เลือกซี่ฟัน & ชนิดงาน & ชนิดสินค้า</li>
                                <li>จัดกลุ่มซี่ฟัน</li>
                                <li class="yellow">ตรวจสอบข้อมูล & บันทึก</li>
                            </ul>
                        </div>
                        <div class="col-md-9 step-content">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                            <li class="breadcrumb-item active" aria-current="page">ตรวจสอบข้อมูล & บันทึก</li>
                                        </ol>
                                    </nav>
                                    {{-- 2 --}}
                                    <div class="accordion basic-accordion" role="tablist">
                                        <div class="card">
                                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                                <h6 class="mb-0">
                                                    <a data-toggle="collapse" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                        ข้อมูลการสั่งงาน
                                                    </a>
                                                </h6>
                                            </div>
                                            <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                <div class="card-body">
                                                    {{-- <div class="row text-right">
                                                        <div class="col-12">
                                                            <label class="switch">
                                                                <input type="checkbox" id="toggle0" value="Model" name="Model">
                                                                <span class="slider round" ></span>
                                                            </label>
                                                            <label class="col-form-label " for="toggle0">
                                                                Model
                                                            </label>
                                                        </div>
                                                    </div> --}}
                                                    <div class="card-body">
                                                        @foreach($data_all as $out_data_all)
                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="barcode">Barcode*</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                                                        </div>
                                                                        {{ Form::text('Barcode',$out_data_all->Barcode, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="pickup">วันรับงาน*</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="mdi mdi-table-edit"></i></span>
                                                                        </div>
                                                                        {{ Form::text('StartDate',$out_data_all->StartDate, ['ID'=>'StartDate','data-date-format' => 'dd/mm/yyyy','class' => 'form-control','placeholder' => 'ไม่มี']) }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="pickup">วันส่งงาน*</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="mdi mdi-timetable"></i></span>
                                                                        </div> 
                                                                        {{ Form::text('DeliverDate',$out_data_all->DeliverDate, ['ID'=>'DeliverDate','data-date-format' => 'dd/mm/yyyy','class' => 'form-control','placeholder' => 'ไม่มี']) }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row" >
                                                                    <label class="col-form-label col-sm-3" for="pickup">เหตุผลการเลื่อน</label>
                                                                    <div class="col-sm-9">
                                                                        <div class="input-group">
                                                                            {{ Form::textarea('other',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"9"]) }}
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="pickup">ลูกค้า</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="mdi mdi-hospital-building"></i></span>
                                                                        </div>
                                                                        {{ Form::text('CustomerID',$out_data_all->customer, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="pickup">ทันตแพทย์</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="mdi mdi-stethoscope"></i></span>
                                                                        </div>
                                                                        {{ Form::text('CustomerID',$out_data_all->doctor, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="pickup">ชื่อคนไข้</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                                                                        </div>
                                                                        {{ Form::text('PatientName',$out_data_all->PatientName, ['class' => 'form-control','placeholder' => 'ไม่มี']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="pickup">อายุคนไข้</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-plus-square"></i></span>
                                                                        </div>
                                                                        {{ Form::text('PatientAge',$out_data_all->PatientAge, ['class' => 'form-control','placeholder' => 'ไม่มี','min'=>"1",'max'=>"99",'onKeyPress'=>'if(this.value.length==2) return false;']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-3" for="pickup">รหัสประจำตัวคนไข้</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-wheelchair"></i></span>
                                                                        </div>
                                                                        {{ Form::text('PatientHN',$out_data_all->PatientHN, ['class' => 'form-control','placeholder' => 'ไม่มี','maxlength'=>'20']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach

                                                        <div class="col-md-12">
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-sm-1"></label>
                                                                <div class="col-sm-12">
                                                                    <table class="table table-striped table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tooth Number</th>
                                                                                <th>Type of Work</th>
                                                                                <th>Type of Product</th>
                                                                                <th>Type of Group</th>
                                                                            </tr>
                                                                        </thead>
                                                                        @foreach($teeth as $out_teeth)
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>#{{ $out_teeth->TeethID }}</td>
                                                                                <td>{{ $out_teeth->NameWork }}</td>
                                                                                <td>{{ $out_teeth->NameProduct }}</td>
                                                                                <td>{{ $out_teeth->NameGroup }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <br>  --}}
                                        <!-- <div class="accordion basic-accordion" role="tablist" >
                                            <div class="card">
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                            รายการสิ่งที่ส่งมาด้วย
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseOne3" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                        <div class="card-body" >
                                                            <div class="card-body">
                                                                <div class="col-md-12"> 
                                                                
                                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div> -->
                                </div>
                            </div>

                        </div>
                    </div>
                    {{-- 3 --}}
                    <div class="row mt-2">
                        <div class="col-sm-12 text-right">
                            <a href="javascript:history.go(-1)">
                                <button class="btn btn-lg btn-success">
                                    <i class="mdi mdi-arrow-left-bold"></i>
                                    ย้อนกลับ
                                </button>
                            </a>
                            {{-- <a href="{{ url('mainscreen') }}"> --}}
                                <button type="submit" class="btn btn-lg btn-success">
                                    บันทึกข้อมูล
                                    <i class="mdi mdi-arrow-right-bold"></i>
                                </button>
                            {{-- </a> --}}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="camera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">บันทึกภาพ</h5>
                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" class='center'>
                        <video id="video" width="100%" height="100%" autoplay></video>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="snap" name="pic" value="delete">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@stop

@section('scripts')

<script src="js/photo.js"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

                $("#StartDate").datepicker({
                    todayBtn:  1,
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('#DeliverDate').datepicker('setStartDate', minDate);
                });

                $("#DeliverDate").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                $('#StartDate').datepicker('setEndDate', minDate);
                });

        

            });

            function BarcodeFunction() {
                var Testtoggle123 = document.getElementById("toggle123");
                var ContiBarcode = document.getElementById("ContiBarcode");


                if(Testtoggle123.checked == true){
                    ContiBarcode.style.display = "none";

                }
                else if(Testtoggle123.checked == false){
                    ContiBarcode.style.display = "flex";

                }
                else {
                    dfgdfg;
                }
            }
            function BarcodeFunction2() {

                var toggle = document.getElementById("toggle");
                var RefBarcode = document.getElementById("RefBarcode");

                if(toggle.checked == true) {
                    RefBarcode.style.disabled = "none";

                }
                else if(toggle.checked == false) {
                    RefBarcode.style.disabled = "flex";

                }
                else {
                    dfgdfg;
                }
            }
            $('#toggle123').click(function() {
                $('#RefBarcode').val('');
            });
            $('#toggle').click(function() {
                $('#Test').val('');
            });

        function toggle(){
            if(document.getElementById('toggle').checked == false){
                document.getElementById('DeliverDate').disabled = false;
            }else {
                document.getElementById('DeliverDate').disabled = true;

            }
        }

</script>
@stop
