@extends('layouts.template')
@section('title', 'สร้างงาน')
@section('stylesheet')
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
        height: 15%;
        padding: 15px;
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
</style>



@stop
@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                {{ Form::open(['method' => 'post' , 'url' => '/order2/addPatient']) }}
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-11 p-0 text-left">
                            <h4>สร้างรายการใหม่</h4>
                        </div>
                        @include('order.barcode_cancel')
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 m-0 step-timeline">
                            <ul class="m-0 step-list">
                                <li>บันทึกรหัสสั่งผลิต (Barcode)</li>
                                <li class="yellow">ข้อมูลลูกค้า & คนไข้</li>
                                <li class="white">เลือกแลปที่ผลิต</li>
                                {{-- <li class="white">สิ่งที่ส่งมาด้วย</li> --}}
                                <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                            </ul>
                        </div>
                        <div class="col-md-9 step-content">
                            @if($errors->all())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                            @endif
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                    @foreach($data_customer as $out_data_customer)
                                    <li class="breadcrumb-item"><a href="#">{{ $out_data_customer->customer_type }}</a></li>
                                    <li class="breadcrumb-item"><a href="#">{{ $out_data_customer->customer }}</a></li>
                                    <li class="breadcrumb-item"><a href="#">{{ $out_data_customer->doctor }}</a></li>
                                    @endforeach
                                    <li class="breadcrumb-item active" aria-current="page">ข้อมูลคนไข้</li>
                                </ol>
                            </nav>

                            <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                คนไข้
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                        <div class="card-body text-left">
                                            <form class="forms-sample">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-2" for="patient_name">ชื่อ - นามสกุล</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            {{ Form::text('PatientName',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล','maxlength'=>'60']) }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-2" for="patient_hn">HN</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            {{ Form::text('PatientHN',null, ['class' => 'form-control','placeholder' => 'HN','maxlength'=>'20']) }}
                                                        </div>
                                                    </div>

                                                    <label class="col-form-label col-sm-1" for="patient_age">อายุ</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            {{ Form::number('PatientAge',null, ['class' => 'form-control','placeholder' => 'อายุ','min'=>"1",'max'=>"99" ,'onKeyPress'=>'if(this.value.length==2) return false;' ]) }}
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-2" for="patient_sex">เพศ</label>
                                                    <div class="col-sm-9 text-left">

                                                        <div class="radio-toolbar">

                                                            <input type="radio" id="radioNON_1" name="radio" value="1">
                                                            <label for="radioNON_1" style="cursor:pointer;"><center>ชาย</center></label>&nbsp;&nbsp;&nbsp;

                                                            <input type="radio" id="radioNON_2" name="radio" value="2">
                                                            <label for="radioNON_2" style="cursor:pointer;"><center>หญิง</center></label>&nbsp;&nbsp;&nbsp;

                                                            <input type="radio" id="radioNON_3" name="radio" value="3" checked>
                                                            <label for="radioNON_3" style="cursor:pointer;"><center>ไม่ระบุ</center></label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12 text-right">
                            <a href="javascript:history.go(-1)">
                                <button type="button" class="btn btn-lg btn-success">
                                    <i class="mdi mdi-arrow-left-bold"></i>
                                    ย้อนกลับ
                                </button>
                            </a>
                            <button type="submit" class="btn btn-lg btn-success">
                                ต่อไป
                                <i class="mdi mdi-arrow-right-bold"></i>
                            </button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@stop
