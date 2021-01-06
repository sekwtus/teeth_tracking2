@extends('layouts.template')

@section('title', 'สร้างงาน')

@section('stylesheet')
    <link rel="stylesheet" href="css/main.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; background:#FFF; }
    </style>
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
      <div class="card">
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
                <li>ข้อมูลลูกค้า & คนไข้</li>
                <li>เลือกแลปที่ผลิต</li>
                {{-- <li>เลือกซี่ฟัน & ชนิดงาน & ชนิดสินค้า</li>
                <li>จัดกลุ่มซี่ฟัน</li> --}}
                {{-- <li>สิ่งที่ส่งมาด้วย</li> --}}
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
                            {{-- 1 --}}
                                    {{-- <div class="accordion basic-accordion" role="tablist">
                                      <div role="tab" id="orderRequestTypeID">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                            1.ข้อมูลทั่วไป Order
                                            </a>
                                        </h6>
                                      </div>
                                    </div> --}}
                        <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        1.ข้อมูลทั่วไป Order
                                        </a>
                                    </h6>
                                    </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                    {{-- style="height : 30%; auto; overflow-y: auto;" --}}
                                    <div class="card-body" >

                                        @foreach($data_all as $out_data_all)
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="barcode">Barcode*</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                                                </div>
                                                                {{ Form::text('Barcode',$out_data_all->Barcode, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>

                                                        <label class="col-form-label col-sm-2" for="barcode">Barcode อ้างอิง</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-barcode"></i></span>
                                                                </div>
                                                                {{ Form::text('RefBarcode',$out_data_all->RefBarcode, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-group row">
                                                        <label class="col-form-label col-sm-3" for="barcode">Barcode อ้างอิง</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-barcode"></i></span>
                                                                </div>
                                                                {{ Form::text('RefBarcode',$out_data_all->RefBarcode, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="pickup">วันรับงาน*</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-table-edit"></i></span>
                                                                </div>
                                                            {{ Form::text('StartDate',$out_data_all->StartDate, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>

                                                        <label class="col-form-label col-sm-2" for="pickup">วันส่งงาน*</label>
                                                        <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="mdi mdi-timetable"></i></span>
                                                                    </div>
                                                                    {{ Form::text('DeliverDate',$out_data_all->DeliverDate, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-group row">
                                                        <label class="col-form-label col-sm-3" for="pickup">วันส่งงาน*</label>
                                                        <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="mdi mdi-timetable"></i></span>
                                                                    </div>
                                                                    {{ Form::text('DeliverDate',$out_data_all->DeliverDate, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                </div>
                                                        </div>
                                                    </div> --}}

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="pickup">ประเภทของงาน</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-tooltip-edit"></i></span>
                                                                </div>
                                                                {{ Form::text('DeliverType',$out_data_all->DeliverType, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>

                                                        <label class="col-form-label col-sm-2" for="pickup">ประเภทลูกค้า</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-hospital"></i></span>
                                                                </div>
                                                                {{ Form::text('DeliverType',$out_data_all->customer_type, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                </div>
                                                            </div>
                                                    </div>

                                                    {{-- <div class="form-group row">
                                                        <label class="col-form-label col-sm-3" for="pickup">ประเภทลูกค้า</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-hospital"></i></span>
                                                                </div>
                                                                {{ Form::text('DeliverType',$out_data_all->customer_type, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="pickup">ลูกค้า</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-hospital-building"></i></span>
                                                                </div>
                                                                {{ Form::text('CustomerID',$out_data_all->customer, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>

                                                        <label class="col-form-label col-sm-2" for="pickup">ทันตแพทย์</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-stethoscope"></i></span>
                                                                </div>
                                                                {{ Form::text('CustomerID',$out_data_all->doctor, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-group row">
                                                        <label class="col-form-label col-sm-3" for="pickup">ทันตแพทย์</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-stethoscope"></i></span>
                                                                </div>
                                                                {{ Form::text('CustomerID',$out_data_all->doctor, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                    {{-- <div class="form-group row">
                                                        <label class="col-form-label col-sm-3" for="pickup">Factory</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-factory"></i></span>
                                                                </div>
                                                                {{ Form::text('FactoryID',$out_data_all->factory, ['class' => 'form-control','placeholder' => 'Factory','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="pickup">ชื่อคนไข้</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                                                                </div>
                                                                {{ Form::text('PatientName',$out_data_all->PatientName, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>

                                                        <label class="col-form-label col-sm-2" for="pickup">HN คนไข้</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-account-key"></i></span>
                                                                </div>
                                                                {{ Form::text('PatientHN',$out_data_all->PatientHN, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="form-group row">
                                                        <label class="col-form-label col-sm-3" for="pickup">HN คนไข้</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-account-key"></i></span>
                                                                </div>
                                                                {{ Form::text('PatientHN',$out_data_all->PatientHN, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="pickup">อายุคนไข้</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-timer-sand"></i></span>
                                                                </div>
                                                                {{ Form::text('PatientAge',$out_data_all->PatientAge, ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                            </div>
                                                        </div>
                                                        <label class="col-form-label col-sm-2" for="pickup">เพศคนไข้</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-gender-male-female"></i></span>
                                                                </div>
                                                                @if ($out_data_all->PatientSex == '1')
                                                                    {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                @endif
                                                                @if ($out_data_all->PatientSex == '2')
                                                                    {{ Form::text('PatientSex','หญิง', ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                @endif
                                                                @if ($out_data_all->PatientSex == '3')
                                                                    {{ Form::text('PatientSex','ไม่ระบุเพศ', ['class' => 'form-control','placeholder' => 'ไม่มี','readonly']) }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    @endforeach
                                    </div>
                        </div>
                    </div>
                </div>
                {{-- 1 --}}
                        <br>
                        {{-- 2 --}}
                    {{-- <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        2.ข้อมลการสั่งงาน
                                    </a>
                                </h6>
                            </div>
                            <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">

                                    <div class="card-body" >
                                        <div class="card-body">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-1"></label>
                                                        <div class="col-sm-12">
                                                                <table  class="table table-striped table-bordered">
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
                                                                                <td>{{ $out_teeth->TeethID }}</td>
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

                        <br> --}}
                        {{-- 2 --}}

                        {{-- 3 --}}

<!--
                        <br>
                        <div class="accordion basic-accordion" role="tablist" >
                            <div class="card">
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                            3.ข้อมูลอื่นๆ
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOne4" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                        <div class="card-body" >
                                            <div class="card-body">
                                                    <div class="form-group row">
                                                            <label class="col-form-label col-sm-3" for="patient_name">ความต้องการพิเศษ</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    {{ Form::textarea('PatientName',null, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล','maxlength'=>'60']) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="results" align="right"></div>
                                                <div class="col-md-12 text-right">
                                                    <button class="btn btn-danger" data-toggle="modal" data-target="#camera" style="padding:10px;">
                                                        บันทึกภาพ
                                                   </button>
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
        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                <a href="javascript:history.go(-1)">
                    <button class="btn btn-lg btn-success">
                        <i class="mdi mdi-arrow-left-bold"></i>
                        ย้อนกลับ
                    </button>
                </a>

                <a href="{{ url('order7/save') }}">
                    <button class="btn btn-lg btn-success">
                        บันทึกข้อมูล
                        <i class="mdi mdi-arrow-right-bold"></i>
                    </button>
                </a>
            </div>
          </div>
                        {{-- 3 --}}
                    </div>
                </div>
            </div>
        </div>

<!--
        <div class="modal fade" id="camera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">บันทึกภาพ</h5>
                            <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12" align="center">
                            {{-- <video id="video" width="100%" height="100%" autoplay></video> --}}
                            <div id="my_camera"></div>
                            {{-- <br/> --}}
                            {{-- <input type=button value="Take Snapshot" onClick="take_snapshot()"> --}}
                            <input type="hidden" name="image" class="image-tag">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger"  value="Take Snapshot" onClick="take_snapshot()">Save</button>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
@stop

@section('scripts')
        {{-- <script src="js/photo.js"></script> --}}

        <script language="JavaScript">
            Webcam.set({
                width: 490,
                height: 390,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach( '#my_camera' );

            function take_snapshot() {
                Webcam.snap( function(data_uri) {
                    $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                } );
            }
        </script>
@stop
