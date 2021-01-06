@extends('layouts.template')

@section('title', 'สร้างงาน')

@section('stylesheet')
<style>
 table{
     font-size: 13px;
 }
</style>
@stop

@section('content')
<div class="content-wrapper">
    <div class="row grid-margin">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header header-sm">
                    <div class="row">
                        <div class="col-10">
                            <ul class="nav nav-tabs tab-basic" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#product" role="tab" aria-controls="whoweare" aria-selected="true">
                                        <h6>รายการที่สั่งผลิต</h6>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="loop" data-toggle="tab" href="#return" role="tab" aria-controls="whoweare" aria-selected="false">
                                        <h6>งานต่อเนื่อง</h6>
                                    </a>
                                </li> --}}
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#complete" role="tab" aria-controls="ourgoal" aria-selected="false">
                                        <h6>รายการผลิตที่เสร็จแล้ว</h6>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="col-2">
                            <!-- <a align="right" class="btn btn-primary btn-fw" href="{{ url('order') }}">
                                <i class="mdi mdi-plus"></i>
                                สร้างงานใหม่
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane active in" id="product" role="tabpanel" aria-labelledby="home-tab">
                            <table id="example0" class=" table-striped table-bordered display compact nowrap" with ="100%">
                                    {{-- cellspacing="0" --}}
                                <thead>
                                    <tr>
                                        <th>บาร์โค้ด</th>
                                        <th>เขต</th>
                                        <th>ชื่อ Sale</th>
                                        <th>วันที่สั่งผลิต</th>
                                        <th>วันที่ส่งกลับ</th>
                                        <th>วันที่นัดจริง</th>
                                        <th>คลินิก</th>
                                        <th>ทันตแพทย์</th>
                                        <th>คนไข้</th>
                                        <th>สถานะงาน</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="tab-pane fade " id="return" role="tabpanel" aria-labelledby="loop">
                            <table id="example2" class=" table-striped table-bordered display compact nowrap" width="100%">
                                    {{-- cellspacing="0" --}}
                                <thead>
                                    <tr>
                                        <th> บาร์โค้ด</th>
                                        <th>เขต</th>
                                        <th>ชื่อ Sale</th>
                                        <th>วันที่สั่งผลิต</th>
                                        <th>วันที่ส่งกลับ</th>
                                        <th>วันที่นัดจริง</th>
                                        <th>คลินิก</th>
                                        <th>ทันตแพทย์</th>
                                        <th>คนไข้</th>
                                        <th>สถานะงาน</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="tab-pane " id="complete" role="tabpanel" aria-labelledby="profile-tab">
                            <table id="example1" class="table-striped table-bordered display compact nowrap" cellspacing="0">
                                {{-- <thead class="thead-light"> --}}
                                <thead>
                                    <tr>
                                        <th>บาร์โค้ด</th>
                                        <th>เขต</th>
                                        <th>ชื่อ Sale</th>
                                        <th>วันที่สั่งผลิต</th>
                                        <th>วันที่ส่งกลับ</th>
                                        <th>วันที่นัดจริง</th>
                                        <th>คลินิก</th>
                                        <th>ทันตแพทย์</th>
                                        <th>คนไข้</th>
                                        <th>สถานะงาน</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                @foreach($order_sale as $out_order_sale)
                <div class="modal fade" id="Modal{{ $out_order_sale->ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document" style="width:60%">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label>รายละเอียดรายการที่สั่งผลิต</label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="false">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="accordion basic-accordion" role="tablist">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapseOne{{ $out_order_sale->ID }}" aria-expanded="true" aria-controls="collapseOne">
                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>ข้อมูลทั่วไป Order
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseOne{{ $out_order_sale->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="Barcode">Barcode</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('Barcode',$out_order_sale->Barcode, ['class' => 'form-control','placeholder' => 'Barcode','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="RefBarcode">Barcode อ้างอิง</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('RefBarcode',$out_order_sale->RefBarcode, ['class' => 'form-control','placeholder' => 'RefBarcode','readonly'])}}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="StartDate">วันรับงาน</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('StartDate',$out_order_sale->StartDate, ['class' => 'form-control','placeholder' => 'วันรับงาน','readonly'])}}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="type_doctor">วันส่งงาน</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('DeliverDate',$out_order_sale->DeliverDate, ['class' => 'form-control','placeholder' => 'วันส่งงาน','readonly'])}}
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="type_doctor">เวลาส่งงาน</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('ReceptionTime',$out_order_sale->ReceptionTime, ['class' => 'form-control','placeholder' => 'เวลารับงาน','readonly'])}}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="DeliverType">ประเภท Order</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('DeliverType',$out_order_sale->DeliverType, ['class' => 'form-control','placeholder' => 'ประเภท Order','readonly'])}}
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="customer_type">ประเภทลูกค้า</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('customer_type',$out_order_sale->customer_type, ['class' => 'form-control','placeholder' => 'ประเภทลูกค้า','readonly'])}}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="customer">ลูกค้า</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('customer',$out_order_sale->customer, ['class' => 'form-control','placeholder' => 'ลูกค้า','readonly']) }}
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="doctor">แพทย์</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('doctor',$out_order_sale->doctor, ['class' => 'form-control','placeholder' => 'แพทย์','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="PatientName">Patient Name</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('PatientName',$out_order_sale->PatientName, ['class' => 'form-control','placeholder' => 'Patient Name','readonly'])}}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="PatientHN">Patient HN</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('PatientHN',$out_order_sale->PatientHN, ['class' => 'form-control','placeholder' => 'Patient HN','readonly'])}}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="PatientAge">Patient Age</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('PatientAge',$out_order_sale->PatientAge, ['class' => 'form-control','placeholder' => 'Patient Age','readonly'])}}
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="type_doctor">Patient Sex</label>
                                                            <div class="col-sm-4">
                                                                @if($out_order_sale->PatientSex == 1)
                                                                    {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                @elseif($out_order_sale->PatientSex == 2)
                                                                    {{ Form::text('PatientSex','หญิง',['class' => 'form-control','placeholder' => 'Patient Sex','readonly'])}}
                                                                @elseif($out_order_sale->PatientSex == 3)
                                                                    {{ Form::text('PatientSex','ไม่ระบุเพศ',['class' => 'form-control','placeholder' => 'Patient Sex','readonly'])}}
                                                                @endif
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
                @endforeach

                {{-- งานต่อเนื่อง --}}

                @foreach($order_sale as $out_order_sale)
                    {{ Form::open(['method' => 'post' , 'url' => '/order/continuouswork/'.$out_order_sale->ID.'']) }}
                        <div class="modal fade" id="Modal3{{ $out_order_sale->ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document" style="width:60%">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-header header-sm">
                                            <label>รายละเอียดงานต่อเนื่อง</label>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="false">&times;</span>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="accordion basic-accordion" role="tablist">
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="orderRequestTypeID">
                                                            <h6 class="mb-0">
                                                                <a data-toggle="collapse" href="#collapseOne{{ $out_order_sale->ID }}" aria-expanded="true" aria-controls="collapseOne">
                                                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>ข้อมูลทั่วไป Order
                                                                </a>
                                                            </h6>
                                                        </div>
                                                        <div id="collapseOne{{ $out_order_sale->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                            <div class="card-body">
                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-sm-2" for="Barcode">Barcode</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('Barcode',$out_order_sale->Barcode, ['class' => 'form-control','placeholder' => 'Barcode','readonly']) }}
                                                                    </div>

                                                                    <label class="col-form-label col-sm-2" for="RefBarcode">Barcode อ้างอิง</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('RefBarcode',$out_order_sale->RefBarcode, ['class' => 'form-control','placeholder' => 'RefBarcode','readonly'])}}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-sm-2" for="StartDate">วันรับงาน</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('StartDate',$out_order_sale->StartDate, ['ID'=>'StartDate','data-date-format' => 'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันรับงาน'])}}
                                                                    </div>

                                                                    <label class="col-form-label col-sm-2" for="type_doctor">วันส่งงาน</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('DeliverDate',$out_order_sale->DeliverDate, ['ID'=>'DeliverDate','data-date-format' => 'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันส่งงาน'])}}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-sm-2" for="type_doctor">เวลาส่งงาน</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('ReceptionTime',$out_order_sale->ReceptionTime, ['class' => 'form-control','placeholder' => 'เวลารับงาน','readonly'])}}
                                                                    </div>

                                                                    <label class="col-form-label col-sm-2" for="DeliverType">ประเภท Order</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('DeliverType',$out_order_sale->DeliverType, ['class' => 'form-control','placeholder' => 'ประเภท Order','readonly'])}}
                                                                    </div>

                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-sm-2" for="customer_type">ประเภทลูกค้า</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('customer_type',$out_order_sale->customer_type, ['class' => 'form-control','placeholder' => 'ประเภทลูกค้า','readonly'])}}
                                                                    </div>

                                                                    <label class="col-form-label col-sm-2" for="customer">ลูกค้า</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('customer',$out_order_sale->customer, ['class' => 'form-control','placeholder' => 'ลูกค้า','readonly']) }}
                                                                    </div>

                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-sm-2" for="doctor">แพทย์</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('doctor',$out_order_sale->doctor, ['class' => 'form-control','placeholder' => 'แพทย์','readonly']) }}
                                                                    </div>

                                                                    <label class="col-form-label col-sm-2" for="PatientName">Patient Name</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('PatientName',$out_order_sale->PatientName, ['class' => 'form-control','placeholder' => 'Patient Name','readonly'])}}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-sm-2" for="PatientHN">Patient HN</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('PatientHN',$out_order_sale->PatientHN, ['class' => 'form-control','placeholder' => 'Patient HN','readonly'])}}
                                                                    </div>

                                                                    <label class="col-form-label col-sm-2" for="PatientAge">Patient Age</label>
                                                                    <div class="col-sm-4">
                                                                        {{ Form::text('PatientAge',$out_order_sale->PatientAge, ['class' => 'form-control','placeholder' => 'Patient Age','readonly'])}}
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-sm-2" for="type_doctor">Patient Sex</label>
                                                                    <div class="col-sm-4">
                                                                        @if($out_order_sale->PatientSex == 1)
                                                                            {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                        @elseif($out_order_sale->PatientSex == 2)
                                                                            {{ Form::text('PatientSex','หญิง',['class' => 'form-control','placeholder' => 'Patient Sex','readonly'])}}
                                                                        @elseif($out_order_sale->PatientSex == 3)
                                                                            {{ Form::text('PatientSex','ไม่ระบุเพศ',['class' => 'form-control','placeholder' => 'Patient Sex','readonly'])}}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-9"></div>
                                                            <div class="col-sm-3">
                                                                <button class="btn btn-success" type="submit"  data-toggle="modal" data-target="#Modal3'+data+'">บันทึกข้อมูล</button>
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
                    {{ Form::close() }}
                @endforeach

                @foreach($order_sale_complete as $out_order_sale_complete)
                <div class="modal fade" id="Modal2{{ $out_order_sale_complete->ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document" style="width:60%">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label>รายละเอียดรายการที่สั่งผลิต</label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="false">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="accordion basic-accordion" role="tablist">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapse2{{ $out_order_sale_complete->ID }}" aria-expanded="true" aria-controls="collapse2">
                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>ข้อมูลทั่วไป Order
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapse2{{ $out_order_sale_complete->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="Barcode">Barcode</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('Barcode',$out_order_sale_complete->Barcode, ['class' => 'form-control','placeholder' => 'Barcode','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="RefBarcode">Barcode อ้างอิง</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('RefBarcode',$out_order_sale_complete->RefBarcode, ['class' => 'form-control','placeholder' => 'RefBarcode','readonly']) }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="StartDate">วันรับงาน</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('StartDate',$out_order_sale_complete->StartDate, ['class' => 'form-control','placeholder' => 'วันรับงาน','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="type_doctor">วันส่งงาน</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('DeliverDate',$out_order_sale_complete->DeliverDate, ['class' => 'form-control','placeholder' => 'วันส่งงาน','readonly']) }}
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="type_doctor">เวลาส่งงาน</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('ReceptionTime',$out_order_sale_complete->ReceptionTime, ['class' => 'form-control','placeholder' => 'เวลารับงาน','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="DeliverType">ประเภท Order</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('DeliverType',$out_order_sale_complete->DeliverType, ['class' => 'form-control','placeholder' => 'ประเภท Order','readonly']) }}
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="customer_type">ประเภทลูกค้า</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('customer_type',$out_order_sale_complete->customer_type, ['class' => 'form-control','placeholder' => 'ประเภทลูกค้า','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="customer">ลูกค้า</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('customer',$out_order_sale_complete->customer, ['class' => 'form-control','placeholder' => 'ลูกค้า','readonly']) }}
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="doctor">แพทย์</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('doctor',$out_order_sale_complete->doctor, ['class' => 'form-control','placeholder' => 'แพทย์','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="PatientName">Patient Name</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('PatientName',$out_order_sale_complete->PatientName, ['class' => 'form-control','placeholder' => 'Patient Name','readonly']) }}
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="PatientHN">Patient HN</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('PatientHN',$out_order_sale_complete->PatientHN, ['class' => 'form-control','placeholder' => 'Patient HN','readonly']) }}
                                                            </div>

                                                            <label class="col-form-label col-sm-2" for="PatientAge">Patient Age</label>
                                                            <div class="col-sm-4">
                                                                {{ Form::text('PatientAge',$out_order_sale_complete->PatientAge, ['class' => 'form-control','placeholder' => 'Patient Age','readonly']) }}
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="type_doctor">Patient Sex</label>
                                                            <div class="col-sm-4">
                                                                @if($out_order_sale_complete->PatientSex == 1)
                                                                    {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                @elseif($out_order_sale_complete->PatientSex == 2)
                                                                    {{ Form::text('PatientSex','หญิง', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                @elseif($out_order_sale_complete->PatientSex == 3)
                                                                    {{ Form::text('PatientSex','ไม่ระบุเพศ', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                @endif
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
                @endforeach


                <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body pt-0">
                                <div class="card-body p-0">
                                    <div class="mt-5">
                                        <div class="vertical-timeline">
                                            <div class="timeline-wrapper timeline-wrapper-warning">
                                                <div class="timeline-badge"></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title font-weight-bold">Create Order</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>By Sale A</p>
                                                        <p><span class="ml-auto">19/10/2018 (10:30)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">
                                                <div class="timeline-badge"></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title font-weight-bold">Screen Update</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>By Screen A</p>
                                                        <p><span class="ml-auto">19/10/2018 (11:30)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-wrapper timeline-wrapper-success">
                                                <div class="timeline-badge"></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title font-weight-bold">ปูน</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <div class="timeline-body">
                                                            <p>By ปูน A</p>
                                                            <p><span class="ml-auto">19/10/2018 (12:30)</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                                                <div class="timeline-badge"></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title font-weight-bold">Wax</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>By ปูน A</p>
                                                        <p><span class="ml-auto">19/10/2018 (13:30)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-wrapper timeline-wrapper-primary">
                                                <div class="timeline-badge"></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title font-weight-bold">QC</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>By QC A</p>
                                                        <p><span class="ml-auto">19/10/2018 (14:30)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                                                <div class="timeline-badge"></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title font-weight-bold">Packing</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>By Packing A</p>
                                                        <p><span class="ml-auto">19/10/2018 (15:30)</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="timeline-wrapper timeline-wrapper-success">
                                                <div class="timeline-badge"></div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h6 class="timeline-title font-weight-bold">Delivery</h6>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>By Delivery A</p>
                                                        <p><span class="ml-auto">19/10/2018 (16:30)</span></p>
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
    </div>
</div>

@stop
@section('scripts')
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
<script>
$(function() {
          $('#example0').DataTable({
          processing: true,
         serverSide: true,
          ajax: '{{ url('/table/order') }}',
          columns: [
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'ID_area', name: 'ID_area' },
                   { data: 'Employee', name: 'Employee' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'DeliverDate', name: 'Datefinal' },
                   { data: 'customer', name: 'customer' },
                   { data: 'doctor', name: 'doctor' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'department', name: 'department' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center"
                },
                {
                    "targets": 1,
                    render: function(data, type, row) {
                            return row["AreaID"];
                    }
                },
                {
                    "targets": 2
                },
                {
                    "targets": 3
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5
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
                        if(data == null || data == '') {
                            return '<label class="badge badge-outline-danger badge-pill">รอ screen</label>'
                        }
                        else if(data == 'กำลังรอรับงาน') {
                            return '<label class="badge badge-outline-warning badge-pill">กำลังรอรับงาน</label>'
                        }
                        else {
                            return '<label class="badge badge-outline-primary badge-pill">'+data+'</label>'
                        }
                    }
                },
                {
                    "targets": 10,
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<button class="btn btn-success" style="padding:10px;" data-toggle="modal" data-target="#Modal'+data+'">รายละเอียด</button>'
                        }
                }],
                "aaSorting": [],
                //"scrollX": true
       });
       $('div.dataTables_filter input').focus()
    });


    $(function() {
          $('#example1').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('/table/order_complete') }}',
          columns: [
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'ID_area', name: 'ID_area' },
                   { data: 'Employee', name: 'Employee' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'DeliverDate', name: 'Datefinal' },
                   { data: 'customer', name: 'customer' },
                   { data: 'doctor', name: 'doctor' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'department', name: 'department' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                   "className": "text-center"
                },
                {
                    "targets": 1,
                    render: function(data, type, row) {
                            return row["AreaID"]
                    }
                },
                {
                    "targets": 2
                },
                {
                    "targets": 3
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5
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
                        if(data == null || data == '') {
                            return '<label class="badge badge-outline-danger badge-pill">รอ screen</label>'
                        }
                        else if(data == 'กำลังรอรับงาน') {
                            return '<label class="badge badge-outline-warning badge-pill">กำลังรอรับงาน</label>'
                        }
                        else {
                            return '<label class="badge badge-outline-primary badge-pill">'+data+'</label>'
                        }
                    }
                },
                {
                    "targets": 10,
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<button class="btn btn-success" style="padding:10px;" data-toggle="modal" data-target="#Modal'+data+'">รายละเอียด</button>'
                        }
                }],
                "aaSorting": [],
                //"scrollX": true,
                //"paging": true,
       });
       $('div.dataTables_filter input').focus()

    });

    $(function() {
          $('#example2').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('/table/order_doctor') }}',
          columns: [
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'ID_area', name: 'ID_area' },
                   { data: 'Employee', name: 'Employee' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'DeliverDate', name: 'Datefinal' },
                   { data: 'customer', name: 'customer' },
                   { data: 'doctor', name: 'doctor' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'department', name: 'department' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center"
                },
                {
                    "targets": 1,
                    render: function(data, type, row) {
                        if(data == null || data == '') {
                            return 'เขต '+row["AreaID"]+''
                        }
                        else {
                            return 'เขต '+data+''
                        }

                    }
                },
                {
                    "targets": 2
                },
                {
                    "targets": 3
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5
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
                            return '<label class="badge badge-outline-success badge-pill">ส่งต่อให้แพทย์</label>'
                    }
                },
                {
                    "targets": 10,
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<button class="btn btn-success" style="padding:10px;" data-toggle="modal" data-target="#Modal3'+data+'">รายละเอียด</button>'
                        }
                }],
                "aaSorting": [],
               // "scrollX": true
       });
       $('div.dataTables_filter input').focus()
    });
</script>

@stop
