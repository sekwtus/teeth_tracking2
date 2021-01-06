@extends('layouts.template')
@section('title', 'Screen')
@section('stylesheet')
<style media="screen">
    /* ตารางหลัก */
    .tbl td{
      padding: 5px;
      font-size: 12px;
    }
    .hidden{
      display: none;
    }
    .bg-success, .bg-secondary, .bg-success{
      /* color: #fff; */
      font-weight: bold;
    }

    /*รูปฟัน MARGIN AND METAL DESIGN & PONTIC DESIGN*/
    input[type="checkbox"]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }
    .pontic {
      border: 0px dashed #444;
      width: 30px;
      height: 30px;
      transition: 500ms all;
    }

    /* pointer (checkbox,radio) */
    .custom-control input+label, .pointer{
      cursor: pointer;
    }

    /* เลือกฟัน */
    #tooth-check {
      display: none;
    }

    .tooth-chart {
      width: 80%;
      margin: auto;
    }

    #tooth-lbl>text {
      font-family: 'Avenir-Heavy';
    }

    polygon, path {
      -webkit-transition: fill .25s;
      transition: fill .25s;
    }

    polygon:hover, polygon:active,
    #tooth-polygon>path:hover,
    #tooth-polygon>path:active {
      fill: red !important;
      cursor: pointer;
    }

    /*End Tooth*/

    input[type=checkbox] {
        display: none;
    }

    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

    .lbl {
      border: 1px solid;
      border-radius: 50%;
      cursor: pointer;
      width: 25px;
      height: 25px;
    }
    .lbl:hover {
      opacity: 0.5;
    }
    .check {
      color: blue;
      background: blue;
    }
    .img-tooth {
      width: 25px;
      height: 25px;
      margin-bottom: 15px;
      margin-right: 15px;
    }
    .tbl-tooth {
      margin: auto;
    }
    .tbl-tooth td {
      border:none; !important;
    }
    /* */

    /* The container */

    .select {
        color: #FFE000;
        background: #FFE000;
    }

    .selected {
        color: #00D413;
        background: #00D413;
    }

    .input-hidden {
        display: none;
    }

</style>

<script>
    function OnLoad(n){
           // $('.lbl_green_'+n).addClass('check');
           // document.getElementById('lbl_green_'+n).classList.toggle("check");
        // alert($('#lbl_green_'+n).length);
        setTimeout(function() {
            if($('#lbl_green_'+n).length){
                $(".img-tooth-"+n).addClass('img-tooth');
                $('#lbl_green_'+n).addClass('lbl_green_'+n);
                $('#lbl_green_'+n).addClass('select');
            }else{
                OnLoad(n);
            }
        }, 1000);
    }
    function select(n){
        //$('.lbl_green_'+n).addClass('check');
        //document.getElementById('lbl_green_'+n).classList.toggle("check");
        setTimeout(function() {
            if( $('#lbl_green_'+n).length){
                $('#lbl_green_'+n).addClass('selected');
            }else{
                select(n);
            }
        }, 10);
    }

</script>
@stop

@section('content')
<div class="container-fluid">
    {{ Form::open(['method'=>'post' , 'url'=>'/mainscreen/new_screen_general/save/'.$id]) }}
        @php
            $count = 0;
        @endphp
        <input type="hidden" name="ID_order_screen" value="{{ $id }}">
        @foreach($teeth as $out_teeth)
            @if($out_teeth->status != '1')
                @php
                    $count = $count+1;
                @endphp
            @endif
        @endforeach
    <div class="row">
        <div class="col-12 px-0">
            <table id="tbl-1" class="tbl" width="100%" border="1">
                <tr class="bg-secondary text-center">
                  <td width="55%">ข้อมูลทั่วไป</td>
                  <td width="20%">ข้อมูลวันเวลาผลิต</td>
                  <td width="25%">ข้อมูลรหัสงาน</td>
                </tr>

                @foreach($order as $out_order)
                <tr>
                  <td id="td-detail" valign="top">
                    <div class="row py-1">
                        <div class="col-sm-6 col-md-8 pr-md-0">แลปที่ผลิต
                        {{-- {{ Form::text('company_name',$out_order->company_name, ['class'=>'form-control form-control-sm','readonly']) }} --}}
                        <select class="form-control form-control-sm" id="FactoryID" name="FactoryID">
                            <option value="{{$out_order->FactoryID}}" selected hidden>{{$out_order->company_name}}</option>
                            @foreach ($company as $out_company)
                                <option value="{{$out_company->ID}}">{{$out_company->fullname}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-sm-6 col-md-4">สาขา
                        {{ Form::text('branch_name',$out_order->branch_name, ['class'=>'form-control form-control-sm','readonly']) }}
                        </div>
                    </div>
                    <div class="row py-1">
                      <div class="col-sm-4 col-md-4 pr-md-0" style="padding-right: 5px;">ทพ./ทญ.
                          <select class="form-control form-control-sm js-example-basic-single" id="doctor" name="doctor">
                            <option value="{{$out_order->doctorID}}" selected hidden>{{$out_order->doctor}}</option>
                            @foreach ($list_doctor as $out_list_doctor)
                              <option value="{{$out_list_doctor->Name_doctor}}">{{$out_list_doctor->Name}}</option>
                            @endforeach
                          </select>
                        {{-- {{ Form::select('doctor',$out_order->doctor, ['class'=>'form-control form-control-sm','placeholder'=>'ชื่อ - นามสกุล','readonly']) }} --}}
                      </div>
                      <div class="col-sm-1 col-md-1 pr-md-0">
                      </div>
                      <div class="col-sm-3 col-md-3 pr-md-0">เบอร์โทร
                        {{ Form::number('phone_doctor',$out_order->phone_doctor, ['class'=>'form-control form-control-sm','placeholder'=>'เบอร์โทร']) }}
                      </div>
                      <div class="col-sm-4 col-md-4">LINE
                        {{ Form::text('line_doctor',$out_order->line_doctor, ['class'=>'form-control form-control-sm','placeholder'=>'LINE']) }}
                      </div>
                    </div>
                    <div class="row py-1">
                        <div class="col-md-4 pr-md-0">รพ./คลีนิค
                        {{-- {{ Form::text('customer',$out_order->customer, ['class'=>'form-control form-control-sm','placeholder'=>'ร.พ./คลีนิค','readonly']) }} --}}
                        <select class="form-control form-control-sm js-example-basic-single" id="CustomerID" name="CustomerID">
                            <option value="{{$out_order->CustomerID}}" selected hidden>{{$out_order->customer}}</option>
                            @foreach ($customer as $out_customer)
                                <option value="{{$out_customer->ID}}">{{$out_customer->Name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-sm-1 col-md-1 pr-md-0">
                        </div>

                        <div class="col-md-3 pr-md-0">รหัสลูกค้า
                        {{ Form::text('CustomerCode',$out_order->CustomerCode, ['class'=>'form-control form-control-sm','placeholder'=>'รหัสลูกค้า','readonly']) }}
                        </div>
                        <div class="col-sm-6 col-md-2 pr-md-0">เบอร์โทร
                        {{ Form::number('phone_customer',$out_order->phone_customer, ['class'=>'form-control form-control-sm','placeholder'=>'เบอร์โทร']) }}
                        </div>
                        <div class="col-sm-6 col-md-2">ช่างประจำ
                        {{ Form::text('technician_recommend',$out_order->technician_recommend, ['class'=>'form-control form-control-sm','placeholder'=>'รหัสช่าง']) }}
                        </div>
                    </div>
                    <div class="row py-1">
                        <div class="col-md-5 pr-md-0">ชื่อ-นามสกุลคนไข้
                        {{ Form::text('PatientName',$out_order->PatientName, ['class'=>'form-control form-control-sm','placeholder'=>'คนไข้']) }}
                        </div>
                        <div class="col-sm-4 col-md-3 pr-md-0">HN
                        {{ Form::text('PatientHN',$out_order->PatientHN, ['class'=>'form-control form-control-sm','placeholder'=>'HN']) }}
                        </div>
                        <div class="col-sm-4 col-md-2 pr-md-0">อายุ
                        {{ Form::text('PatientAge',$out_order->PatientAge, ['class'=>'form-control form-control-sm','placeholder'=>'อายุ','min'=>"1",'max'=>"99" ,'onKeyPress'=>'if(this.value.length==2) return false;']) }}
                        </div>

                        <?php
                        $sex = '';
                        if ($out_order->PatientSex == 1) {
                            $sex = 'ชาย';
                        } elseif ($out_order->PatientSex == 2) {
                            $sex = 'หญิง';
                        } else {
                            $sex = 'ไม่ระบุเพศ';
                        }
                        ?>
                        <div class="col-sm-4 col-md-2">เพศ
                        {{ Form::text('sex',$sex, ['class'=>'form-control form-control-sm','placeholder'=>'เพศ','readonly']) }}
                        </div>
                    </div>
                    <div class="row py-1">
                      <div class="col-sm-6 col-md-6 pr-md-0">ชื่อ SALE
                        {{ Form::text('Employee',$out_order->name_Employee, ['class'=>'form-control form-control-sm','placeholder'=>'ชื่อ SALE','readonly']) }}
                      </div>
                      <div class="col-sm-6 col-md-6">เขต
                        {{ Form::text('ID_area',$out_order->ID_area, ['class'=>'form-control form-control-sm','placeholder'=>'เขต','readonly']) }}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6 col-md-12">หมายเหตุ
                        {{ Form::textarea('note',$out_order->note, ['class'=>'form-control form-control-sm','placeholder'=>'หมายเหตุ','rows'=>'4']) }}
                      </div>
                    </div>
                    </td>
                    <td id="td-datetime" valign="top">
                      <div class="row py-1">
                        <div class="col-12">วันรับงาน
                          {{ Form::text('StartDate',$out_order->StartDate, ['ID'=>'startdate','data-date-format'=>'dd/mm/yyyy','class'=>'form-control form-control-sm','placeholder'=>'วันรับงาน','readonly']) }}
                        </div>
                      </div>
                      <div class="row py-1">
                        <div class="col-md-6 pr-lg-0">วันส่งงาน
                          {{ Form::text('DeliverDate',$out_order->DeliverDate, ['ID'=>'enddate','data-date-format'=>'dd/mm/yyyy','class'=>'form-control form-control-sm','placeholder'=>'วันที่ส่ง','readonly']) }}
                        </div>
                        <div class="col-md-6">เวลา
                          {{-- <input type="time" name="" value="" class="form-control form-control-sm"> --}}
                          {{ Form::time('ReceptionTime',$out_order->ReceptionTime, ['class'=>'form-control form-control-sm']) }}
                        </div>
                      </div>
                      <div class="row py-1">
                        <div class="col-12 pr-lg-0">รอบงาน
                          <div class="row">
                            @foreach ( $processround as $out_processround)
                              @if($out_processround->ID == $out_order->processroundID )
                                <div class="col-md-6 col-lg- pr-lg-0">
                                  <div class="custom-control custom-radio">
                                    <input type="radio" value="{{ $out_processround->ID }}" class="custom-control-input" id="processround{{ $out_processround->ID }}" name="processround" checked>
                                    <label class="custom-control-label" for="processround{{ $out_processround->ID }}">{{ $out_processround->production_cycle }}</label>
                                  </div>
                                </div>
                              @else
                                <div class="col-md-6 col-lg- pr-lg-0">
                                  <div class="custom-control custom-radio">
                                    <input type="radio" value="{{ $out_processround->ID }}" class="custom-control-input" id="processround{{ $out_processround->ID }}" name="processround">
                                    <label class="custom-control-label" for="processround{{ $out_processround->ID }}">{{ $out_processround->production_cycle }}</label>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          </div>
                        </div>
                      </div>
                      <div class="row py-1">
                        <div class="col-md-6 pr-lg-0">วันนัดจริง
                          {{ Form::text('Datefinal',$out_order->Datefinal, ['ID'=>'Datefinal','data-date-format'=>'dd/mm/yyyy','class'=>'form-control form-control-sm','placeholder'=>'วันส่งจริง','readonly'=>'readonly']) }}
                        </div>
                        <div class="col-md-6">เวลา
                          {{-- <input type="time" class="form-control form-control-sm"> --}}
                          {{ Form::time('FinalTime',$out_order->FinalTime, ['class'=>'form-control form-control-sm']) }}
                        </div>

                        {{-- <div class="col-md-6 pr-lg-0">วันเลื่อนนัด
                            {{ Form::text('Datefinal',$out_order->Delaydate, ['ID'=>'Delaydate','data-date-format'=>'dd/mm/yyyy','class'=>'form-control form-control-sm','placeholder'=>'วันเลื่อนนัด']) }}
                          </div>
                          <div class="col-md-6">เวลา
                            {{ Form::time('FinalTime',$out_order->Delaytime, ['class'=>'form-control form-control-sm']) }}
                          </div> --}}
                      </div>
                      <div class="row py-1">
                        <div class="col-md-12">หมายเหตุการเลื่อนนัด
                          {{ Form::text('DeliverDate_comment',$out_order->DeliverDate_comment, ['class'=>'form-control form-control-sm','placeholder'=>'หมายเหตุการเลื่อนนัด']) }}
                        </div>
                      </div>

                      <div class="row py-1">
                        <div class="col-12">คนรับเรื่องการเลื่อนนัด
                          {{ Form::text('Employee_DeliverDate_comment',$out_order->Employee_DeliverDate_comment, ['class'=>'form-control form-control-sm','placeholder'=>'คนรับเรื่องการเลื่อนนัด']) }}
                        </div>
                      </div>
                    </div>

                    <div class="row py-1">
                      <div class="col-12">ลักษณะงานที่เลื่อน
                        <select name="ddlWorkLate" id="ddlWorkLate" class="form-control form-control-sm" onchange="eventWorkLate(this.value)">

                            {{-- @if($out_order->ddlWorkLate != '' && $out_order->ddlWorkLate != NULL)
                                <option value="{{ $out_order->ddlWorkLate }}">{{ $out_order->detail_type_1 }}</option>
                            @endif --}}

                            @if($out_order->ddlWorkLate != '' && $out_order->ddlWorkLate != NULL)
                                <option value="{{ $out_order->ddlWorkLate }}" hidden>{{ $out_order->detail_type_1 }}</option>
                            @else
                                <option value="">เลือกลักษณะงานที่เลื่อน</option>
                            @endif

                          <optgroup label="ก่อนผลิต">
                            @foreach ($work_defect3 as $out_defect)
                              <option value="{{$out_defect->id}}">{{$out_defect->detail_type}}</option>
                            @endforeach
                          </optgroup>
                          <optgroup label="ระหว่างผลิต">
                            @foreach ($work_defect4 as $out_defect)
                              <option value="{{$out_defect->id}}">{{$out_defect->detail_type}}</option>
                            @endforeach
                          </optgroup>
                        </select>
                      </div>
                    </div>

                    <div class="row py-1 hidden" id="comment_WorkLate">
                        <div class="col-12">
                          {{ Form::text('comment_WorkLate',$out_order->comment_WorkLate, ['class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                        </div>
                      </div>

                      <div class="row py-1 hidden" id="comment_WorkLate_before">
                        <div class="col-12">
                          {{ Form::text('comment_WorkLate_before',$out_order->comment_WorkLate_before, ['class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                        </div>
                      </div>
                    </td>
                    <td id="td-workid" valign="top">
                      <div class="row">
                        <div class="col-12 py-1">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 pr-lg-0">
                                    <div class="custom-control custom-radio">
                                    @if (empty($out_order->RefBarcode) && empty($out_order->ContiBarcode))
                                        <input type="radio" value="new" onchange="BarcodeWork(this.value)" class="custom-control-input" id="rdoWorkNew" name="rdoWork" checked>
                                    @else
                                        <input type="radio" value="new" onchange="BarcodeWork(this.value)" class="custom-control-input" id="rdoWorkNew" name="rdoWork">
                                    @endif
                                    <label class="custom-control-label" for="rdoWorkNew">ใหม่</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 px-lg-0">
                                    <div class="custom-control custom-radio">
                                    @if (!empty($out_order->RefBarcode))
                                        <input type="radio" value="edit" onchange="BarcodeWork(this.value)" class="custom-control-input" id="rdoWorkEdit" name="rdoWork" checked>
                                    @else
                                        <input type="radio" value="edit" onchange="BarcodeWork(this.value)" class="custom-control-input" id="rdoWorkEdit" name="rdoWork">
                                    @endif
                                    <label class="custom-control-label" for="rdoWorkEdit">แก้ไข</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 pl-lg-0">
                                    <div class="custom-control custom-radio">
                                    @if (!empty($out_order->ContiBarcode))
                                        <input type="radio" value="con" onchange="BarcodeWork(this.value)" class="custom-control-input" id="rdoWorkContinue" name="rdoWork" checked>
                                    @else
                                        <input type="radio" value="con" onchange="BarcodeWork(this.value)" class="custom-control-input" id="rdoWorkContinue" name="rdoWork">
                                    @endif
                                    <label class="custom-control-label" for="rdoWorkContinue">ต่อเนื่อง</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row py-1">
                        <div class="col-md-6 pr-md-1">BARCODE
                          {{ Form::text('Barcode',$out_order->Barcode, ['class'=>'form-control form-control-sm','placeholder'=>'Barcode' ]) }}
                        </div>
                        <div class="col-md-6 pl-md-1">REF.CODE

                          @if($out_order->ContiBarcode != null)
                            {{ Form::text('RefBarcode',$out_order->ContiBarcode, ['required','class'=>'form-control form-control-sm','placeholder'=>'RefBarcode','id'=>'RefBarcode']) }}
                            {{-- <input name="RefBarcode" value="" id="RefBarcode2" type="hidden"/> --}}
                          @elseif($out_order->RefBarcode != null)
                            {{ Form::text('RefBarcode',$out_order->RefBarcode, ['required','class'=>'form-control form-control-sm','placeholder'=>'RefBarcode','id'=>'RefBarcode']) }}
                            {{-- <input name="RefBarcode" value="" id="RefBarcode2" type="hidden"/> --}}
                          @else
                            {{ Form::text('RefBarcode','', ['required','disabled','class'=>'form-control form-control-sm','placeholder'=>'RefBarcode','id'=>'RefBarcode']) }}

                          @endif
                        </div>
                      </div>

                      <div class="row py-1">
                        <div class="col-12 hidden" id="type_of_con">ประเภทงานต่อเนื่อง
                          <select class="form-control form-control-sm" name="type_of_con" id="select_type_of_con">
                            @if($out_order->type_of_con != '' && $out_order->type_of_con != NULL)
                              <option value="{{$out_order->type_of_con}}" >{{$out_order->type_of_con_name}}</option>
                            @else
                              <option value="">เลือกลักษณะงานต่อเนื่อง</option>
                            @endif
                            @foreach ($type_of_con as $item)
                              <option value="{{$item->ID}}" >{{$item->Name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="row py-1 div-type-edit" style="display:{{$out_order->RefBarcode==null?'none' :''}};">
                        <div class="col-12">ประเภทงานแก้
                          <select name="ddlTypeEdit" class="form-control form-control-sm" onchange="eventWorkdefect(this.value)">
                            @if($out_order->ddlTypeEdit != '' && $out_order->ddlTypeEdit != NULL)
                                <option value="{{ $out_order->ddlTypeEdit }}">{{ $out_order->detail_type_2 }}</option>
                            @else
                                <option value="">เลือกลักษณะงานแก้</option>
                            @endif
                            <optgroup label="เล็กน้อย">
                              @foreach ($work_defect1 as $out_defect)
                                <option value="{{$out_defect->id}}">{{$out_defect->detail_type}}</option>
                              @endforeach
                            </optgroup>
                            <optgroup label="ทำใหม่">
                              @foreach ($work_defect2 as $out_defect)
                                <option value="{{$out_defect->id}}">{{$out_defect->detail_type}}</option>
                              @endforeach
                            </optgroup>
                          </select>
                        </div>
                      </div>

                      @if($out_order->ddlTypeEdit == 38)
                      <div class="row py-1" id="comment_Workdefect1">
                        <div class="col-12">
                          {{ Form::text('comment_Workdefect1',$out_order->comment_Workdefect1, ['id'=>'comment_Workdefect1','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                        </div>
                      </div>
                    @else
                      <div class="row py-1 hidden" id="comment_Workdefect1">
                        <div class="col-12">
                          {{ Form::text('comment_Workdefect1',$out_order->comment_Workdefect1, ['id'=>'comment_Workdefect1','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                        </div>
                      </div>
                    @endif

                    @if($out_order->ddlTypeEdit == 39)
                      <div class="row py-1" id="comment_Workdefect2">
                        <div class="col-12">
                          {{ Form::text('comment_Workdefect2',$out_order->comment_Workdefect2, ['id'=>'comment_Workdefect2','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                        </div>
                      </div>
                    @else
                      <div class="row py-1 hidden" id="comment_Workdefect2">
                        <div class="col-12">
                          {{ Form::text('comment_Workdefect2',$out_order->comment_Workdefect2, ['id'=>'comment_Workdefect2','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                        </div>
                      </div>
                    @endif

                      <div class="row py-1">
                        <div class="col-12 py-1">ประเภทงาน
                          <div class="row">
                            @foreach($type_Deliver as $out_type_Deliver)
                              @if ($out_type_Deliver->ID == $out_order->DeliverType)
                                <div class="col-12">
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="type_Deliver{{ $out_type_Deliver->ID }}" name="type_Deliver" value="{{ $out_type_Deliver->ID }}" checked>
                                    <label class="custom-control-label" for="type_Deliver{{ $out_type_Deliver->ID }}">{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                  </div>
                                </div>
                              @else
                                <div class="col-12">
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="type_Deliver{{ $out_type_Deliver->ID }}" name="type_Deliver" value="{{ $out_type_Deliver->ID }}">
                                    <label class="custom-control-label" for="type_Deliver{{ $out_type_Deliver->ID }}" >{{ $out_type_Deliver->Name }}</label>&nbsp;&nbsp;&nbsp;
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          </div>
                        </div>
                      </div>
                       <!-- ///////////camera -->
                              <div class="col-12">
                                <h4 class="text-google font-weight-bold">
                                  <u>แนบภาพ</u>
                                </h4>
                                <div class="form-group mt-1">
                                  <input type="file" name="txtFile" class="file-upload-default txtFile">
                                  <div class="input-group col-xs-12">
                                    <input type="text" value="{{--$file->tc_file--}}" class="form-control file-upload-info file-name txtFileName" placeholder="ชื่อไฟล์" style="padding: 1px 1px 1px 1px;" disabled>
                                    <span class="input-group-append">
                                      <button type="button" class="file-upload-browse btn btn-outline-success" title="แนบไฟล์">
                                        <i class="fa fa-paperclip"></i>
                                      </button>
                                      <button type="button" onclick="saveFile('{{$out_order->Barcode}}',{{$id}})" class="btn btn-success"  title="บันทึก">
                                        {{-- upload --}}
                                        <span class="fa fa-camera"></span>
                                      </button>
                                    </span>
                                  </div>
                                </div>
                                <div class="downloaded">
                                  @foreach ($file as $i=>$f)
                                  <div class="row mt-1 file_{{$i+1}}">
                                    <div class="col-10">
                                      <p class="mt-1" style="font-size: 12px;">
                                        <a href="{{url('local/public/file').'/'.$f->name_file}}" target="_blank" class="btn btn-inverse-success btn-rounded btn-block" style="padding: 1px 1px 1px 1px;"  title="ตรวจสอบ">
                                          {{-- <i class="fa fa-file-pdf"></i> <span>{{$i+1}}</span>.ภาพแนบ {{$f->created_at}} --}}
                                          <i ></i> <span>{{$i+1}}</span>. {{$f->name_file}}
                                        </a>
                                      </p>
                                    </div>
                                      <button  type="button" class="btn btn-danger" style="padding:10px;" onclick="deleteFile('{{$f->name_file}}','{{$out_order->Barcode}}',{{$i+1}})">ลบ</button>
                                  </div>
                                  @endforeach
                                </div>
                              </div>
                      {{-- //////////////////// --}}
                    </td>
                </tr>
                @endforeach
            </table>

            <table id="tbl-2" class="tbl" width="100%" border="1">
              <tr class="bg-secondary text-center">
                <td width="43%">คำสั่งพิเศษ</td>
                <td width="29%">สิ่งที่ส่งมาด้วย</td>
                <td width="28%">อุปกรณ์ IMPLANT</td>
              </tr>

              @php
                $check1 = [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];
                $detail1 = ['','','','','','','','','','','','','','',''];
                $note1 = ['','','','','','','','','','','','','','',''];
                $line1 = ['','','','','','','','','','','','','','',''];
                $return1 = ['','','','','','','','','','','','','','',''];
              @endphp
              @foreach ($data_select_extra as $select_extra)
                @if ($select_extra->topic == "เท MODEL + เท DIE")
                  @php
                        $check1[0]=true;
                        $detail1[0]=$select_extra->detail;
                        $note1[0]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ดู MOUNTING + DIE")
                  @php
                        $check1[1]=true;
                        $note1[1]=$select_extra->note;
                        if($select_extra->detail == "ดูทาง Line")
                            $line1[1]=$select_extra->detail;

                        if($select_extra->detail == "ส่งกลับ")
                            $line1[1]=$select_extra->detail;


                  @endphp
                @elseif($select_extra->topic == "ดูโครง WAX")
                  @php
                        $check1[2]=true;
                        $note1[2]=$select_extra->note;
                        if($select_extra->detail == "ดูทาง Line")
                            $line1[2]=$select_extra->detail;

                        if($select_extra->detail == "ส่งกลับ")
                            $line1[2]=$select_extra->detail;

                  @endphp
                @elseif($select_extra->topic == "ดู WAX FULL CONTOUR")
                  @php
                        $check1[3]=true;
                        if($select_extra->detail == "ดูทาง Line")
                            $line1[3]=$select_extra->detail;

                        if($select_extra->detail == "ส่งกลับ")
                            $line1[3]=$select_extra->detail;
                        $note1[3]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ลองโครงโลหะ")
                  @php
                        $check1[4]=true;
                        if($select_extra->detail == "ดูทาง Line")
                            $line1[4]=$select_extra->detail;

                        if($select_extra->detail == "ส่งกลับ")
                            $line1[4]=$select_extra->detail;
                        $note1[4]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ดู CONTOUR PORCELAIN")
                  @php
                        $check1[5]=true;
                        if($select_extra->detail == "ดูทาง Line")
                            $line1[5]=$select_extra->detail;

                        if($select_extra->detail == "ส่งกลับ")
                            $line1[5]=$select_extra->detail;
                        $note1[5]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ขอ SPUR ด้วย")
                  @php
                        $check1[6]=true;
                        $detail1[6]=$select_extra->detail;
                        $note1[6]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ส่งทำงานถอดได้ต่อ")
                  @php
                        $check1[7]=true;
                        $detail1[7]=$select_extra->detail;
                        $note1[7]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ทำ PINDEX")
                  @php
                        $check1[8]=true;
                        $detail1[8]=$select_extra->detail;
                        $note1[8]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "มีงานแก้ส่งมาทำร่วมด้วย")
                  @php
                        $check1[9]=true;
                        $detail1[9]=$select_extra->detail;
                        $note1[9]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ให้ช่างโทรกลับในขั้นตอน")
                  @php
                        $check1[10]=true;
                        $detail1[10]=$select_extra->detail;
                        $note1[10]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "รายละเอียดเพิ่มเติม")
                  @php
                        $check1[11]=true;
                        $detail1[11]=$select_extra->detail;
                        $note1[11]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "รายละเอียดเพิ่มเติม")
                  @php
                        $check1[11]=true;
                        $detail1[11]=$select_extra->detail;
                        $note1[11]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ดูดีไซน์ทางไลน์")
                  @php
                        $check1[13]=true;
                        $detail1[13]=$select_extra->detail;
                        $note1[13]=$select_extra->note;
                  @endphp
                @elseif($select_extra->topic == "ดูดีไซน์ CADCAM")
                  @php
                        $check1[14]=true;
                        if($select_extra->detail == "ดูทาง Line")
                            $line1[14]=$select_extra->detail;

                        if($select_extra->detail == "ส่งกลับ")
                            $line1[14]=$select_extra->detail;
                        $note1[14]=$select_extra->note;
                  @endphp
                @endif
              @endforeach
              <tr>
                <td id="td-special-command" valign="top">
                  <div class="row mb-1">
                    @if($check1[0])
                      <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="เท MODEL + เท DIE" class="custom-control-input" name="chkCmd1" id="chkCmd1" onclick="ClearRadioCommand(this.id,'rdoGroupCmd1')"checked>
                          <label class="custom-control-label" for="chkCmd1">เท MODEL + เท DIE</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd1" id="rdoBackCmd1"checked>
                          <label class="custom-control-label" for="rdoBackCmd1">ส่งกลับ</label>
                        </div>
                      </div>
                    @else
                      <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="เท MODEL + เท DIE" class="custom-control-input" name="chkCmd1" id="chkCmd1" onclick="ClearRadioCommand(this.id,'rdoGroupCmd1')">
                          <label class="custom-control-label" for="chkCmd1">เท MODEL + เท DIE</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd1" id="rdoBackCmd1"disabled>
                          <label class="custom-control-label" for="rdoBackCmd1">ส่งกลับ</label>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[1])
                      <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดู MOUNTING + DIE" class="custom-control-input" name="chkCmd2" id="chkCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')"checked>
                          <label class="custom-control-label" for="chkCmd2">ดู MOUNTING + DIE</label>
                        </div>
                      </div>
                      @if($line1[1] == "ดูทาง Line")
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd2" id="rdoLineCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')"checked>
                          <label class="custom-control-label" for="rdoLineCmd2">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd2" id="rdoBackCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')">
                          <label class="custom-control-label" for="rdoBackCmd2">ส่งกลับ</label>
                        </div>
                      </div>
                      @else
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd2" id="rdoLineCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')">
                          <label class="custom-control-label" for="rdoLineCmd2">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd2" id="rdoBackCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')"checked>
                          <label class="custom-control-label" for="rdoBackCmd2">ส่งกลับ</label>
                        </div>
                      </div>
                      @endif
                    @else
                    <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดู MOUNTING + DIE" class="custom-control-input" name="chkCmd2" id="chkCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')">
                          <label class="custom-control-label" for="chkCmd2">ดู MOUNTING + DIE</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd2" id="rdoLineCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')"disabled>
                          <label class="custom-control-label" for="rdoLineCmd2">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd2" id="rdoBackCmd2" onclick="ClearRadioCommand(this.id,'rdoGroupCmd2')"disabled>
                          <label class="custom-control-label" for="rdoBackCmd2">ส่งกลับ</label>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[2])
                      <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดูโครง WAX" class="custom-control-input" name="chkCmd3" id="chkCmd3" onclick="ClearRadioCommand(this.id,'rdoGroupCmd3')"checked>
                          <label class="custom-control-label" for="chkCmd3">ดูโครง WAX</label>
                        </div>
                      </div>
                      @if($line1[2] == 'ดูทาง Line')
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd3" id="rdoLineCmd3"checked>
                          <label class="custom-control-label" for="rdoLineCmd3">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd3" id="rdoBackCmd3">
                          <label class="custom-control-label" for="rdoBackCmd3">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @else
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd3" id="rdoLineCmd3">
                          <label class="custom-control-label" for="rdoLineCmd3">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd3" id="rdoBackCmd3"checked>
                          <label class="custom-control-label" for="rdoBackCmd3">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @endif
                    @else
                    <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดูโครง WAX" class="custom-control-input" name="chkCmd3" id="chkCmd3" onclick="ClearRadioCommand(this.id,'rdoGroupCmd3')">
                          <label class="custom-control-label" for="chkCmd3">ดูโครง WAX</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd3" id="rdoLineCmd3"disabled>
                          <label class="custom-control-label" for="rdoLineCmd3">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd3" id="rdoBackCmd3"disabled>
                          <label class="custom-control-label" for="rdoBackCmd3">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[3])
                      <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดู WAX FULL CONTOUR" class="custom-control-input" name="chkCmd4" id="chkCmd4" onclick="ClearRadioCommand(this.id,'rdoGroupCmd4')"checked>
                            <label class="custom-control-label" for="chkCmd4">ดู WAX FULL CONTOUR</label>
                        </div>
                      </div>
                      @if($line1[3] == 'ดูทาง Line')
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd4" id="rdoLineCmd4"checked>
                          <label class="custom-control-label" for="rdoLineCmd4">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd4" id="rdoBackCmd4">
                          <label class="custom-control-label" for="rdoBackCmd4">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @else
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd4" id="rdoLineCmd4">
                          <label class="custom-control-label" for="rdoLineCmd4">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd4" id="rdoBackCmd4"checked>
                          <label class="custom-control-label" for="rdoBackCmd4">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @endif
                    @else
                    <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดู WAX FULL CONTOUR" class="custom-control-input" name="chkCmd4" id="chkCmd4" onclick="ClearRadioCommand(this.id,'rdoGroupCmd4')">
                            <label class="custom-control-label" for="chkCmd4">ดู WAX FULL CONTOUR</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd4" id="rdoLineCmd4"disabled>
                          <label class="custom-control-label" for="rdoLineCmd4">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd4" id="rdoBackCmd4"disabled>
                          <label class="custom-control-label" for="rdoBackCmd4">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[4])
                      <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ลองโครงโลหะ" class="custom-control-input" name="chkCmd5" id="chkCmd5" onclick="ClearRadioCommand(this.id,'rdoGroupCmd5')"checked>
                            <label class="custom-control-label" for="chkCmd5">ลองโครงโลหะ</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd5" id="rdoBackCmd5"checked>
                          <label class="custom-control-label" for="rdoBackCmd5">ส่งกลับ</label>
                        </div>
                      </div>
                    @else
                    <div class="col-lg-6 pr-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ลองโครงโลหะ" class="custom-control-input" name="chkCmd5" id="chkCmd5" onclick="ClearRadioCommand(this.id,'rdoGroupCmd5')">
                            <label class="custom-control-label" for="chkCmd5">ลองโครงโลหะ</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd5" id="rdoBackCmd5"disabled>
                          <label class="custom-control-label" for="rdoBackCmd5">ส่งกลับ</label>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[5])
                      <div class="col-lg-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดู CONTOUR PORCELAIN" class="custom-control-input" name="chkCmd6" id="chkCmd6" onclick="ClearRadioCommand(this.id,'rdoGroupCmd6')"checked>
                          <label class="custom-control-label" for="chkCmd6">ดู CONTOUR PORCELAIN</label>
                        </div>
                      </div>
                      @if($line1[5] == 'ดูทาง Line')
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd6" id="rdoLineCmd6"checked>
                          <label class="custom-control-label" for="rdoLineCmd6">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd6" id="rdoBackCmd6">
                          <label class="custom-control-label" for="rdoBackCmd6">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @else
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd6" id="rdoLineCmd6">
                          <label class="custom-control-label" for="rdoLineCmd6">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd6" id="rdoBackCmd6"checked>
                          <label class="custom-control-label" for="rdoBackCmd6">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @endif
                    @else
                    <div class="col-lg-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดู CONTOUR PORCELAIN" class="custom-control-input" name="chkCmd6" id="chkCmd6" onclick="ClearRadioCommand(this.id,'rdoGroupCmd6')">
                          <label class="custom-control-label" for="chkCmd6">ดู CONTOUR PORCELAIN</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd6" id="rdoLineCmd6"disabled>
                          <label class="custom-control-label" for="rdoLineCmd6">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd6" id="rdoBackCmd6"disabled>
                          <label class="custom-control-label" for="rdoBackCmd6">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[14])
                      <div class="col-lg-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดูดีไซน์ CADCAM" class="custom-control-input" name="chkCmd14" id="chkCmd14" onclick="ClearRadioCommand(this.id,'rdoGroupCmd14')"checked>
                          <label class="custom-control-label" for="chkCmd14">ดูดีไซน์ CADCAM</label>
                        </div>
                      </div>
                      @if($line1[14] == 'ดูทาง Line')
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd14" id="rdoLineCmd14"checked>
                          <label class="custom-control-label" for="rdoLineCmd14">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd14" id="rdoBackCmd14">
                          <label class="custom-control-label" for="rdoBackCmd14">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @else
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd14" id="rdoLineCmd14">
                          <label class="custom-control-label" for="rdoLineCmd14">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd14" id="rdoBackCmd14"checked>
                          <label class="custom-control-label" for="rdoBackCmd14">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                      @endif
                    @else
                    <div class="col-lg-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดูดีไซน์ CADCAM" class="custom-control-input" name="chkCmd14" id="chkCmd14" onclick="ClearRadioCommand(this.id,'rdoGroupCmd14')">
                          <label class="custom-control-label" for="chkCmd14">ดูดีไซน์ CADCAM</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ดูทาง Line" class="custom-control-input" name="rdoGroupCmd14" id="rdoLineCmd14"disabled>
                          <label class="custom-control-label" for="rdoLineCmd14">ดูทาง Line</label>
                        </div>
                      </div>
                      <div class="col-lg-3 px-lg-0">
                        <div class="custom-control custom-radio">
                          <input type="radio" value="ส่งกลับ" class="custom-control-input" name="rdoGroupCmd14" id="rdoBackCmd14"disabled>
                          <label class="custom-control-label" for="rdoBackCmd14">ส่งกลับ</label>
                        </div>
                      </div>
                      <hr class="mt-2 mb-1 border-secondary">
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[6])
                      <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ขอ SPUR ด้วย" class="custom-control-input" name="chkCmd7" id="chkCmd7"checked>
                          <label class="custom-control-label" for="chkCmd7">ขอ SPUR ด้วย</label>
                        </div>
                      </div>
                    @else
                      <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ขอ SPUR ด้วย" class="custom-control-input" name="chkCmd7" id="chkCmd7">
                          <label class="custom-control-label" for="chkCmd7">ขอ SPUR ด้วย</label>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[7])
                      <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ส่งทำงานถอดได้ต่อ" class="custom-control-input" name="chkCmd8" id="chkCmd8"checked>
                          <label class="custom-control-label" for="chkCmd8">ส่งทำงานถอดได้ต่อ</label>
                        </div>
                      </div>
                    @else
                    <div class="col-md-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ส่งทำงานถอดได้ต่อ" class="custom-control-input" name="chkCmd8" id="chkCmd8">
                          <label class="custom-control-label" for="chkCmd8">ส่งทำงานถอดได้ต่อ</label>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[8])
                    <div class="col-12">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="ทำ PINDEX" class="custom-control-input" name="chkCmd9" id="chkCmd9"checked>
                        <label class="custom-control-label" for="chkCmd9">ทำ PINDEX</label>
                      </div>
                    </div>
                    @else
                    <div class="col-12">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="ทำ PINDEX" class="custom-control-input" name="chkCmd9" id="chkCmd9">
                        <label class="custom-control-label" for="chkCmd9">ทำ PINDEX</label>
                      </div>
                    </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check1[9])
                      <div class="col-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="มีงานแก้ส่งมาทำร่วมด้วย" class="custom-control-input" name="chkCmd10" id="chkCmd10"checked>
                          <label class="custom-control-label" for="chkCmd10">มีงานแก้ส่งมาทำร่วมด้วย</label>
                        </div>
                      </div>
                    @else
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="มีงานแก้ส่งมาทำร่วมด้วย" class="custom-control-input" name="chkCmd10" id="chkCmd10">
                          <label class="custom-control-label" for="chkCmd10">มีงานแก้ส่งมาทำร่วมด้วย</label>
                        </div>
                      </div>
                    @endif

                  </div>

                  <div class="row mb-1">
                    @if($check1[10])
                      <div class="col-lg-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ให้ช่างโทรกลับในขั้นตอน" class="custom-control-input" name="chkCmd11" id="chkCmd11" onclick="CommandText(11)"checked>
                          <label class="custom-control-label" for="chkCmd11">ให้ช่างโทรกลับในขั้นตอน</label>
                        </div>
                      </div>
                      <div class="col-lg-6 pl-lg-0">
                        {{ Form::text('txtCmd11',$note1[10], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ให้ช่างโทรกลับในขั้นตอน" class="custom-control-input" name="chkCmd11" id="chkCmd11" onclick="CommandText(11)">
                          <label class="custom-control-label" for="chkCmd11">ให้ช่างโทรกลับในขั้นตอน</label>
                        </div>
                      </div>
                      <div class="col-lg-6 pl-lg-0">
                        {{ Form::text('txtCmd11',NULL, ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-3">
                    @if($check1[13])
                      <div class="col-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดูดีไซน์ทางไลน์" class="custom-control-input" name="chkCmd13" id="chkCmd13"checked>
                          <label class="custom-control-label" for="chkCmd13">ดูดีไซน์ทางไลน์</label>
                        </div>
                      </div>
                    @else
                    <div class="col-12">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ดูดีไซน์ทางไลน์" class="custom-control-input" name="chkCmd13" id="chkCmd13">
                          <label class="custom-control-label" for="chkCmd13">ดูดีไซน์ทางไลน์</label>
                        </div>
                      </div>
                    @endif
                  </div>

                  <div class="row mb-3">
                     @if($check1[11])
                      <div class="col-lg-6">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="รายละเอียดเพิ่มเติม" class="custom-control-input" name="chkCmd12" id="chkCmd12" onclick="CommandText(12)"checked>
                            <label class="custom-control-label" for="chkCmd12">รายละเอียดเพิ่มเติม</label>
                        </div>
                      </div>
                      <div class="col-lg-6 pl-lg-0">
                        {{ Form::textarea('txtCmd12',$note1[11], ['class'=>'form-control','cols'=>'66','rows'=>'2','placeholder'=>'ระบุ']) }}
                      </div>

                    @endif
                      <hr class="mt-2 mb-1 border-secondary">
                  </div>
                </td>
                @php $check2 = [false,false,false,false,false,false,false,false,false,false,false,false];
                     $number2 = ['','','','','','','','','','','',''];
                     $assign2 = ['','','','','','','','','','','',''];
                @endphp
                @foreach ($data_select_attachment as $select_attachment)
                    @if ($select_attachment->topic == "IMPRESSION")
                      @php    $check2[0]=true;
                              $number2[0]=$select_attachment->number;
                              $assign2[0]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "WORKING MODEL")
                      @php    $check2[1]=true;
                              $number2[1]=$select_attachment->number;
                              $assign2[1]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "STUDY MODEL")
                      @php    $check2[2]=true;
                              $number2[2]=$select_attachment->number;
                              $assign2[2]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "BITE")
                      @php    $check2[3]=true;
                              $number2[3]=$select_attachment->number;
                              $assign2[3]=$select_attachment->assign;
                      @endphp
                    @elseif ($select_attachment->topic == "คู่สบ")
                      @php    $check2[4]=true;
                              $number2[4]=$select_attachment->number;
                              $assign2[4]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "ARTICULATOR")
                      @php    $check2[5]=true;
                              $number2[5]=$select_attachment->number;
                              $assign2[5]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "อื่นๆ")
                      @php    $check2[6]=true;
                              $number2[6]=$select_attachment->number;
                              $assign2[6]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "DIE")
                      @php    $check2[7]=true;
                              $number2[7]=$select_attachment->number;
                              $assign2[7]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "IMPRESSION / TRAY")
                      @php    $check2[8]=true;
                              $number2[8]=$select_attachment->number;
                              $assign2[8]=$select_attachment->assign;
                      @endphp
                    @elseif($select_attachment->topic == "ชิ้นงานเก่า")
                    @php    $check2[9]=true;
                            $number2[9]=$select_attachment->number;
                            $assign2[9]=$select_attachment->assign;
                    @endphp
                    @elseif($select_attachment->topic == "เฉดสีฟัน")
                        @php    $check2[10]=true;
                                $number2[10]=$select_attachment->number;
                                $assign2[10]=$select_attachment->assign;
                        @endphp
                    @elseif($select_attachment->topic == "ฟันปลอม")
                        @php    $check2[11]=true;
                                $number2[11]=$select_attachment->number;
                                $assign2[11]=$select_attachment->assign;
                        @endphp
                    @endif
                @endforeach

                <td id="td-attachment" valign="top">
                  <div class="row mb-1">
                    @if($check2[8])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="IMPRESSION / TRAY" name="chkAttachment8" class="custom-control-input" id="chkAttachment8" onclick="Attachment(8)" checked>
                          <label class="custom-control-label" for="chkAttachment8">IMPRESSION / TRAY</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment8',$number2[8], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="IMPRESSION / TRAY" name="chkAttachment8" class="custom-control-input" id="chkAttachment8" onclick="Attachment(8)">
                          <label class="custom-control-label" for="chkAttachment8">IMPRESSION / TRAY</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment8',$number2[8], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check2[1])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="WORKING MODEL" name="chkAttachment1" class="custom-control-input" id="chkAttachment1" onclick="Attachment(1)" checked>
                          <label class="custom-control-label" for="chkAttachment1">WORKING MODEL</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment1',$number2[1], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="WORKING MODEL" name="chkAttachment1" class="custom-control-input" id="chkAttachment1" onclick="Attachment(1)">
                          <label class="custom-control-label" for="chkAttachment1">WORKING MODEL</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment1',$number2[1], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check2[4])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="คู่สบ" name="chkAttachment2" class="custom-control-input" id="chkAttachment2" onclick="Attachment(2)" checked>
                          <label class="custom-control-label" for="chkAttachment2">คู่สบ</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment2',$number2[4], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="คู่สบ" name="chkAttachment2" class="custom-control-input" id="chkAttachment2" onclick="Attachment(2)">
                          <label class="custom-control-label" for="chkAttachment2">คู่สบ</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment2',$number2[4], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check2[3])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="BITE" name="chkAttachment3" class="custom-control-input" id="chkAttachment3" onclick="Attachment(3)" checked>
                          <label class="custom-control-label" for="chkAttachment3">BITE</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment3',$number2[3], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="BITE" name="chkAttachment3" class="custom-control-input" id="chkAttachment3" onclick="Attachment(3)">
                          <label class="custom-control-label" for="chkAttachment3">BITE</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment3',$number2[3], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check2[7])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="DIE" name="chkAttachment4" class="custom-control-input" id="chkAttachment4" onclick="Attachment(4)" checked>
                          <label class="custom-control-label" for="chkAttachment4">DIE</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment4',$number2[7], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="DIE" name="chkAttachment4" class="custom-control-input" id="chkAttachment4" onclick="Attachment(4)">
                          <label class="custom-control-label" for="chkAttachment4">DIE</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment4',$number2[7], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check2[2])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="STUDY MODEL" name="chkAttachment5" class="custom-control-input" id="chkAttachment5" onclick="Attachment(5)" checked>
                            <label class="custom-control-label" for="chkAttachment5">STUDY MODEL</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment5',$number2[2], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="STUDY MODEL" name="chkAttachment5" class="custom-control-input" id="chkAttachment5" onclick="Attachment(5)">
                            <label class="custom-control-label" for="chkAttachment5">STUDY MODEL</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment5',$number2[2], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check2[5])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ARTICULATOR" name="chkAttachment6" class="custom-control-input" id="chkAttachment6" onclick="Attachment(6)" checked>
                          <label class="custom-control-label" for="chkAttachment6">ARTICULATOR</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment6',$number2[5], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ARTICULATOR" name="chkAttachment6" class="custom-control-input" id="chkAttachment6" onclick="Attachment(6)">
                          <label class="custom-control-label" for="chkAttachment6">ARTICULATOR</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment6',$number2[5], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check2[9])
                        <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="ชิ้นงานเก่า" name="chkAttachment9" class="custom-control-input" id="chkAttachment9" onclick="Attachment(9)" checked>
                            <label class="custom-control-label" for="chkAttachment9">ชิ้นงานเก่า</label>
                        </div>
                        </div>
                        <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment9',$number2[9], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                        </div>
                    @else
                        <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="ชิ้นงานเก่า" name="chkAttachment9" class="custom-control-input" id="chkAttachment9" onclick="Attachment(9)">
                            <label class="custom-control-label" for="chkAttachment9">ชิ้นงานเก่า</label>
                        </div>
                        </div>
                        <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment9',$number2[9], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                        </div>
                    @endif
                </div>

                <div class="row mb-1">
                    @if($check2[10])
                        <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="เฉดสีฟัน" name="chkAttachment10" class="custom-control-input" id="chkAttachment10" onclick="Attachment(10)" checked>
                            <label class="custom-control-label" for="chkAttachment10">เฉดสีฟัน</label>
                        </div>
                        </div>
                        <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment10',$number2[10], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                        </div>
                    @else
                        <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="เฉดสีฟัน" name="chkAttachment10" class="custom-control-input" id="chkAttachment10" onclick="Attachment(10)">
                            <label class="custom-control-label" for="chkAttachment10">เฉดสีฟัน</label>
                        </div>
                        </div>
                        <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment10',$number2[10], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                        </div>
                    @endif
                </div>

                <div class="row mb-1">
                    @if($check2[11])
                        <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="ฟันปลอม" name="chkAttachment11" class="custom-control-input" id="chkAttachment11" onclick="Attachment(11)" checked>
                            <label class="custom-control-label" for="chkAttachment11">ฟันปลอม</label>
                        </div>
                        </div>
                        <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment11',$number2[11], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                        </div>
                    @else
                        <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" value="ฟันปลอม" name="chkAttachment11" class="custom-control-input" id="chkAttachment11" onclick="Attachment(11)">
                            <label class="custom-control-label" for="chkAttachment11">ฟันปลอม</label>
                        </div>
                        </div>
                        <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachment11',$number2[11], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                        </div>
                    @endif
                </div>


                </td>

                @php $check3 = [false,false,false,false,false,false,false,false,false,false,false,false];
                      $number3 = ['','','','','','','','','','','',''];
                      $assign3 = ['','','','','','','','','','','',''];
                @endphp
                @foreach ($data_select_IMPLANT_Attachment as $select_IMPLANT_Attachment)
                  @if ($select_IMPLANT_Attachment->topic == "IMPRESSION")
                    @php    $check3[0]=true;
                            $number3[0]=$select_IMPLANT_Attachment->number;
                            $assign3[0]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "IMPRESSION CAP")
                    @php    $check3[1]=true;
                            $number3[1]=$select_IMPLANT_Attachment->number;
                            $assign3[1]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "SCREW TRANSFER")
                    @php    $check3[2]=true;
                            $number3[2]=$select_IMPLANT_Attachment->number;
                            $assign3[2]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "ANALOG")
                    @php    $check3[3]=true;
                            $number3[3]=$select_IMPLANT_Attachment->number;
                            $assign3[3]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif ($select_IMPLANT_Attachment->topic == "ABUTMENT")
                    @php    $check3[4]=true;
                            $number3[4]=$select_IMPLANT_Attachment->number;
                            $assign3[4]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "SCREW DRIVER")
                    @php    $check3[5]=true;
                            $number3[5]=$select_IMPLANT_Attachment->number;
                            $assign3[5]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "อื่นๆ")
                    @php    $check3[6]=true;
                            $number3[6]=$select_IMPLANT_Attachment->number;
                            $assign3[6]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "SCREW ABUTMENT")
                    @php    $check3[7]=true;
                            $number3[7]=$select_IMPLANT_Attachment->number;
                            $assign3[7]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "IMPRESSION COPING")
                    @php    $check3[8]=true;
                            $number3[8]=$select_IMPLANT_Attachment->number;
                            $assign3[8]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "KEY / GIG")
                    @php    $check3[9]=true;
                            $number3[9]=$select_IMPLANT_Attachment->number;
                            $assign3[9]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @elseif($select_IMPLANT_Attachment->topic == "เหงือก")
                    @php    $check3[10]=true;
                            $number3[10]=$select_IMPLANT_Attachment->number;
                            $assign3[10]=$select_IMPLANT_Attachment->assign;
                    @endphp
                    @elseif($select_IMPLANT_Attachment->topic == "healing")
                    @php    $check3[11]=true;
                            $number3[11]=$select_IMPLANT_Attachment->number;
                            $assign3[11]=$select_IMPLANT_Attachment->assign;
                    @endphp
                  @endif
                @endforeach

                <td id="td-attachment-implant" valign="top">
                  <div class="row mb-1">
                    @if($check3[1])
                      <div class="col-lg-7 pr-lg-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="IMPRESSION CAP" name="chkAttachmentImp1" class="custom-control-input" id="chkAttachmentImp1" onclick="AttachmentImp(1)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp1">IMPRESSION CAP</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt1',$number3[1], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7 pr-lg-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="IMPRESSION CAP" name="chkAttachmentImp1" class="custom-control-input" id="chkAttachmentImp1" onclick="AttachmentImp(1)">
                          <label class="custom-control-label" for="chkAttachmentImp1">IMPRESSION CAP</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt1',$number3[1], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[8])
                      <div class="col-lg-7 pr-lg-0">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="IMPRESSION COPING" name="chkAttachmentImp2" class="custom-control-input" id="chkAttachmentImp2" onclick="AttachmentImp(2)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp2">IMPRESSION COPING</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt2',$number3[8], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="IMPRESSION COPING" name="chkAttachmentImp2" class="custom-control-input" id="chkAttachmentImp2" onclick="AttachmentImp(2)">
                          <label class="custom-control-label" for="chkAttachmentImp2">IMPRESSION COPING</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt2',$number3[8], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[2])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="SCREW TRANSFER" name="chkAttachmentImp3" class="custom-control-input" id="chkAttachmentImp3" onclick="AttachmentImp(3)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp3">SCREW TRANSFER</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt3',$number3[2], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="SCREW TRANSFER" name="chkAttachmentImp3" class="custom-control-input" id="chkAttachmentImp3" onclick="AttachmentImp(3)">
                          <label class="custom-control-label" for="chkAttachmentImp3">SCREW TRANSFER</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt3',$number3[2], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[3])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ANALOG" name="chkAttachmentImp4" class="custom-control-input" id="chkAttachmentImp4" onclick="AttachmentImp(4)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp4">ANALOG MODEL</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt4',$number3[3], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ANALOG" name="chkAttachmentImp4" class="custom-control-input" id="chkAttachmentImp4" onclick="AttachmentImp(4)">
                          <label class="custom-control-label" for="chkAttachmentImp4">ANALOG MODEL</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt4',$number3[3], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[7])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="SCREW ABUTMENT" name="chkAttachmentImp5" class="custom-control-input" id="chkAttachmentImp5" onclick="AttachmentImp(5)" checked>
                        <label class="custom-control-label" for="chkAttachmentImp5">SCREW ABUTMENT</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt5',$number3[7], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="SCREW ABUTMENT" name="chkAttachmentImp5" class="custom-control-input" id="chkAttachmentImp5" onclick="AttachmentImp(5)">
                        <label class="custom-control-label" for="chkAttachmentImp5">SCREW ABUTMENT</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt5',$number3[7], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[4])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ABUTMENT" name="chkAttachmentImp6" class="custom-control-input" id="chkAttachmentImp6" onclick="AttachmentImp(6)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp6">ABUTMENT</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt6',$number3[4], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="ABUTMENT" name="chkAttachmentImp6" class="custom-control-input" id="chkAttachmentImp6" onclick="AttachmentImp(6)">
                          <label class="custom-control-label" for="chkAttachmentImp6">ABUTMENT</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt6',$number3[4], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[5])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="SCREW DRIVER" name="chkAttachmentImp7" class="custom-control-input" id="chkAttachmentImp7" onclick="AttachmentImp(7)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp7">SCREW DRIVER</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt7',$number3[5], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="SCREW DRIVER" name="chkAttachmentImp7" class="custom-control-input" id="chkAttachmentImp7" onclick="AttachmentImp(7)">
                          <label class="custom-control-label" for="chkAttachmentImp7">SCREW DRIVER</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt7',$number3[5], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[9])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="KEY / GIG" name="chkAttachmentImp8" class="custom-control-input" id="chkAttachmentImp8" onclick="AttachmentImp(8)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp8">KEY / GIG</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt8',$number3[9], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                    <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="KEY / GIG" name="chkAttachmentImp8" class="custom-control-input" id="chkAttachmentImp8" onclick="AttachmentImp(8)">
                          <label class="custom-control-label" for="chkAttachmentImp8">KEY / GIG</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt8',$number3[9], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                   @if($check3[10])
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="เหงือก" name="chkAttachmentImp9" class="custom-control-input" id="chkAttachmentImp9" onclick="AttachmentImp(9)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp9">เหงือก</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt9',$number3[10], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                      </div>
                    @else
                      <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="เหงือก" name="chkAttachmentImp9" class="custom-control-input" id="chkAttachmentImp9" onclick="AttachmentImp(9)">
                          <label class="custom-control-label" for="chkAttachmentImp9">เหงือก</label>
                        </div>
                      </div>
                      <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt9',$number3[10], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                      </div>
                    @endif
                  </div>

                  <div class="row mb-1">
                    @if($check3[11])
                    <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="healing" name="chkAttachmentImp10" class="custom-control-input" id="chkAttachmentImp10" onclick="AttachmentImp(10)" checked>
                          <label class="custom-control-label" for="chkAttachmentImp10">healing</label>
                        </div>
                    </div>
                    <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt10',$number3[11], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ']) }}
                    </div>
                    @else
                    <div class="col-lg-7">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" value="healing" name="chkAttachmentImp10" class="custom-control-input" id="chkAttachmentImp10" onclick="AttachmentImp(10)" >
                          <label class="custom-control-label" for="chkAttachmentImp10">healing</label>
                        </div>
                    </div>
                    <div class="col-lg-5 pl-lg-0">
                        {{ Form::text('txtAttachmentImpAmt10',$number3[11], ['class'=>'form-control form-control-sm','placeholder'=>'ระบุ','disabled']) }}
                    </div>
                    @endif
                </div>

                </td>
              </tr>

              <tr  class="bg-secondary text-center">
                <td width="43%">คำสั่งเพิ่มเติม</td>
                <td width="29%">สิ่งที่ส่งมาด้วยเพิ่มเติม</td>
                <td width="28%">อุปกรณ์ IMPLANT เพิ่มเติม</td>
              </tr>
              <tr>
                <td valign="top">
                  <div class="row mb-3">
                    <div class="col-md-12">
                          {{ Form::textarea('comment_extra',$extra, ['class'=>'form-control','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                    </div>
                  </div>
                </td>

                <td valign="top">
                    <div class="row mb-3">
                      <div class="col-md-12">
                            {{ Form::textarea('comment_attachment',$extra_attachment, ['class'=>'form-control','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                      </div>
                    </div>
                </td>
                <td valign="top">
                  <div class="row mb-3">
                    <div class="col-md-12">
                          {{ Form::textarea('comment_implant_attachment',$extra_implant_attachment, ['class'=>'form-control','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                    </div>
                  </div>
                </td>
              </tr>

              <tr class="bg-secondary text-center">
                <th colspan="3">INTERLOCK</th>
              </tr>
              <tr>
                <td valign="top" colspan="3">
                  <div id="div-system" class="mb-3">
                    <div class="row">
                      <div class="col-6">
                        <label class="col-form-label">Female (ตัวเมีย) </label>
                      </div>
                      <div class="col-6">
                        <label class="col-form-label">Male (ตัวผู้)</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <label class="col-sm-3 col-form-label">Mesial</label>
                        <div class="col-sm-7">
                          <input type="text" value="{{ $Female_Mesial }}" class="form-control number" id="Female_Mesial" name="Female_Mesial"  placeholder="ซี่ฟัน" >
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="col-sm-3 col-form-label">Mesial</label>
                        <div class="col-sm-7">
                          <input type="text"  value="{{ $Male_Mesial }}" class="form-control number" id="Male_Mesial" name="Male_Mesial" placeholder="ซี่ฟัน">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-6">
                        <label class="col-sm-3 col-form-label">Distal</label>
                        <div class="col-sm-7">
                          <input type="text"  value="{{ $Female_Distal }}" class="form-control number" id="Female_Distal" name="Female_Distal"  placeholder="ซี่ฟัน">
                        </div>
                      </div>
                      <div class="col-6">
                        <label class="col-sm-3 col-form-label">Distal</label>
                        <div class="col-sm-7">
                          <input type="text"  value="{{ $Male_Distal }}" class="form-control number" id="Male_Distal" name="Male_Distal" placeholder="ซี่ฟัน">
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>

            </table>


            <div class="col-12 px-0 mt-2 text-right">
                <input type="hidden" name="checkjob" value="0">
                <button type="submit" class="btn btn-lg btn-success">
                    บันทึก
                </button>
            </div>
        </div>
    </div>
  {{ Form::close() }}
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
  function check(n){
    if(document.getElementById("lbl_green_"+n).classList.contains("lbl_green_"+n) == true){
        if(document.getElementById("chkTooth_"+n).checked == true)
            document.getElementById("chkTooth_"+n).checked = false;
        else
            document.getElementById("chkTooth_"+n).checked = true;
        $('.lbl_green_'+n).toggleClass('check');
        $('.lbl_green_'+n).toggleClass('select');
    }
  }

  //รอถามแพทย์
  function AskDoctor(val,name){
    if(val=='รอถามแพทย์'){
      $('textarea[name="'+name+'"]').show().focus();
      $('textarea[name="'+name+'"]').prop('disabled', false);
    }else{
      $('textarea[name="'+name+'"]').hide();
      $('textarea[name="'+name+'"]').prop('disabled', true);
    }
  }

  //เลือก checkbox ได้แค่ตัวเดียว MARGIN, PONTIC, CONTOUR
  function checkOnlyOne(id,name){ //alert(id+' '+name)
    $('input[name="'+name+'"]').not('#'+id).prop('checked', false);
    if(id=='chkOcclusion2'){
      $('#div-under').show();
      $('#rdoUnder1').prop('disabled', false);
      if($('#chkOcclusion2').prop('checked')==false){
        $('#div-under').hide();
        $('#rdoUnder1').prop('disabled', true);
      }
    }else if(id=='chkOcclusion1'){
      $('#div-under').hide();
      $('#rdoUnder1').prop('disabled', true);
    }
  }

  //สิ่งที่ส่งมาด้วย
  function Attachment(i){
    if(i==7){
      txt = 'textarea';
    }else{
      txt = 'input';
    }
    if($('#chkAttachment'+i).prop('checked')==true){
      $(txt+'[name="txtAttachment'+i+'"]').prop('disabled', false);
    }else{
      $(txt+'[name="txtAttachment'+i+'"]').prop('disabled', true);
    }
  }

  //อุปกรณ์ IMPLANT)
  function AttachmentImp(i){
    if($('#chkAttachmentImp'+i).prop('checked')==true){
      $('input[name="txtAttachmentImpAmt'+i+'"]').prop('disabled', false);
      if(i==10){
        $('input[name="txtAttachmentImpName'+i+'"]').prop('disabled', false);
      }
    }else{
      $('input[name="txtAttachmentImpAmt'+i+'"]').prop('disabled', true);
      if(i==10){
        $('input[name="txtAttachmentImpName'+i+'"]').prop('disabled', true);
      }
    }
  }

  //คำสั่งพิเศษ
  function ClearRadioCommand(id,rdo) {
    if($('#'+id).prop('checked')==false){
      $('input[name="'+rdo+'"]').prop('checked', false);
      $('input[name="'+rdo+'"]').prop('disabled', true);
    }else{
      $('input[name="'+rdo+'"]').eq(0).focus();
      $('input[name="'+rdo+'"]').prop('disabled', false);
    }
  }
  function CommandText(i){
    if(i==12){
      txt = 'textarea';
    }else{
      txt = 'input';
    }
    if($('#chkCmd'+i).prop('checked')==true){
      // $(txt+'[name="txtCmd'+i+'"]').attr('readonly', false).focus();
      $(txt+'[name="txtCmd'+i+'"]').prop('disabled', false);
    }else{
      // $(txt+'[name="txtCmd'+i+'"]').val('').attr('readonly', true);
      $(txt+'[name="txtCmd'+i+'"]').prop('disabled', true);
    }
  }

  // SHADE & STUMP
  function Color(val,name){
    if(val=='สีเดียว'){
      $('#div-'+name+'-one').show();
      $('#div-'+name+'-multi').hide();
      $('textarea[name="txtDoctor'+name+'"]').hide().focus();
      $('textarea[name="txtDoctor'+name+'"]').prop('disabled',true);
      $('#'+name+'-one-brand').prop('disabled',false);
      $('#'+name+'-one-color').prop('disabled',false);
      $('#'+name+'-multi-brand1').prop('disabled',true);
      $('#'+name+'-multi-color1').prop('disabled',true);
      $('#'+name+'-multi-brand2').prop('disabled',true);
      $('#'+name+'-multi-color2').prop('disabled',true);
      $('#'+name+'-multi-brand3').prop('disabled',true);
      $('#'+name+'-multi-color3').prop('disabled',true);
    }else if(val=='หลายสี'){
      $('#div-'+name+'-multi').show();
      $('#div-'+name+'-one').hide();
      $('textarea[name="txtDoctor'+name+'"]').hide().focus();
      $('textarea[name="txtDoctor'+name+'"]').prop('disabled',true);
      $('#'+name+'-one-brand').prop('disabled',true);
      $('#'+name+'-one-color').prop('disabled',true);
      $('#'+name+'-multi-brand1').prop('disabled',false);
      $('#'+name+'-multi-color1').prop('disabled',false);
      $('#'+name+'-multi-brand2').prop('disabled',false);
      $('#'+name+'-multi-color2').prop('disabled',false);
      $('#'+name+'-multi-brand3').prop('disabled',false);
      $('#'+name+'-multi-color3').prop('disabled',false);
    }else if(val=='รอถามแพทย์'){
      $('#div-'+name+'-multi').hide();
      $('#div-'+name+'-one').hide();
      $('textarea[name="txtDoctor'+name+'"]').show().focus();
      $('textarea[name="txtDoctor'+name+'"]').prop('disabled',false);
      $('#'+name+'-one-brand').prop('disabled',true);
      $('#'+name+'-one-color').prop('disabled',true);
      $('#'+name+'-multi-brand1').prop('disabled',true);
      $('#'+name+'-multi-color1').prop('disabled',true);
      $('#'+name+'-multi-brand2').prop('disabled',true);
      $('#'+name+'-multi-color2').prop('disabled',true);
      $('#'+name+'-multi-brand3').prop('disabled',true);
      $('#'+name+'-multi-color3').prop('disabled',true);
    }else{
      $('#div-'+name+'-multi').hide();
      $('#div-'+name+'-one').hide();
      $('textarea[name="txtDoctor'+name+'"]').hide().focus();
      $('textarea[name="txtDoctor'+name+'"]').prop('disabled',true);
      $('#'+name+'-one-brand').prop('disabled',true);
      $('#'+name+'-one-color').prop('disabled',true);
      $('#'+name+'-multi-brand1').prop('disabled',true);
      $('#'+name+'-multi-color1').prop('disabled',true);
      $('#'+name+'-multi-brand2').prop('disabled',true);
      $('#'+name+'-multi-color2').prop('disabled',true);
      $('#'+name+'-multi-brand3').prop('disabled',true);
      $('#'+name+'-multi-color3').prop('disabled',true);
    }
  }
  // SHADE & STUMP เลือกสีแต่ละยี่ห้อ
  function SelectColor(id,name) {
    $.ajax({
      type: 'GET',
      url: '{{url('color-by-brand')}}',
      data: {brand_id: id},
      success: function(data) {
        console.log(name+' : '+data);
        $('select[name="'+name+'"]').empty().html(data);
      }
    });
  }

  // MODEL
  $('input[name="rdoGroupModel"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoModelResin'){
      $('#div-model-resin').show();
      $('textarea[name="txtDoctorModel"]').hide();
      $('#rdoModelResin1').prop('disabled',false);
      $('#rdoModelResin2').prop('disabled',false);
      $('#rdoModelResin3').prop('disabled',false);
      $('#rdoModelResin4').prop('disabled',false);
      $('#rdoModelResin5').prop('disabled',false);
      $('#rdoModelResin6').prop('disabled',false);
      $('textarea[name="txtDoctorModel"]').prop('disabled',true);

      if($('#rdoModelResin').prop('checked')==false){
        $('#div-model-resin').hide();
      }
    }else if(id=='rdoModelSupergical'){
      $('#div-model-resin').hide();
      $('textarea[name="txtDoctorModel"]').hide();
      $('#rdoModelResin1').prop('disabled',true);
      $('#rdoModelResin2').prop('disabled',true);
      $('#rdoModelResin3').prop('disabled',true);
      $('#rdoModelResin4').prop('disabled',true);
      $('#rdoModelResin5').prop('disabled',true);
      $('#rdoModelResin6').prop('disabled',true);
      $('textarea[name="txtDoctorModel"]').prop('disabled',true);
    }else{
      $('#div-model-resin').hide();
      $('#rdoModelResin1').prop('disabled',true);
      $('#rdoModelResin2').prop('disabled',true);
      $('#rdoModelResin3').prop('disabled',true);
      $('#rdoModelResin4').prop('disabled',true);
      $('#rdoModelResin5').prop('disabled',true);
      $('#rdoModelResin6').prop('disabled',true);
      $('textarea[name="txtDoctorModel"]').show().focus();
      $('textarea[name="txtDoctorModel"]').prop('disabled',false);
    }
  });

  // UNDERCUT
  $('input[name="rdoUndercut"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoHaveUndercut'){
      $('#div-haveundercut').show();
    }else{
      $('#div-haveundercut').hide();
    }
  });

  // รับตะขอ
  $('input[name="rdoRest"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoHaveRest'){
      $('#div-haverest').show();
      // $('#div-haveundercut').show();
      // $('#rdoHaveUndercut').prop('checked', true);
      // $('#rdoHaveUndercut1').prop('checked', true);
    }else{
      $('#div-haverest').hide();
      $('.chkHaveRest').each(function(i) {
        $('.chkHaveRest').eq(i).prop('checked', false);
      });
      // $('input[name="rdoUndercut"]').prop('checked', false);
      // $('input[name="rdoGroupHaveUndercut"]').prop('checked', false);
      // $('input[name="rdoHaveUndercut1"]').prop('checked', false);
    }
  });

  //ยี่ห้อ์ IMPLANT อื่นๆ
  $('input[name="rdoGroupImpBrand"]').change(function() {
    if($(this).val()=='อื่นๆ'){
      $('input[name="txtImpBrandOther"]').show().focus();
      $('input[name="txtImpBrandOther"]').prop('disabled',false);
    }else{
      $('input[name="txtImpBrandOther"]').hide();
      $('input[name="txtImpBrandOther"]').prop('disabled',true);
    }
  });

  //Fix Cement
  $('input[name="rdoFixCement"]').change(function() {
    if($(this).val()=='รอถามแพทย์'){
      $('textarea[name="txtDoctorFix"]').show().focus();
      $('textarea[name="txtDoctorFix"]').prop('disabled',false);
    }else{
      $('textarea[name="txtDoctorFix"]').hide();
      $('textarea[name="txtDoctorFix"]').prop('disabled',true);
    }
  });

  //วันรับวันส่งงาน
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
    $("#Datefinal").datepicker()
  });

  // function NewBarcode(){
  //     document.getElementById("RefBarcode").disabled = true;
  //     document.getElementById("RefBarcode2").disabled = false;
  // }
  // function edit_Barcode(){
  //     document.getElementById("RefBarcode").disabled = false;
  //     document.getElementById("RefBarcode2").disabled = true;
  // }
  // function Cont_Barcode(){
  //     document.getElementById("RefBarcode").disabled = false ;
  //     document.getElementById("RefBarcode2").disabled = true;
  // }

  function BarcodeWork(type){
    if(type=='new'){
      $('#RefBarcode').attr('disabled',true);
      $('.div-type-edit').hide();
      $('#type_of_con').hide();
      $('#select_type_of_con').attr('disabled',false);
    }else if(type=='edit'){
      $('#RefBarcode').attr('disabled',false);
      $('.div-type-edit').show();
      $('#type_of_con').hide();
      $('#select_type_of_con').attr('disabled',true);
    }else{
      $('#RefBarcode').attr('disabled',false);
      $('.div-type-edit').hide();
      $('#type_of_con').show();
      $('#select_type_of_con').attr('disabled',false);
    }
  }

  function eventWorkLate(type){
    if(type=='26'){
        $('#comment_WorkLate_before').show();
        $('#comment_WorkLate').hide();
        $('#comment_WorkLate_input').val(null);
    }else if(type=='36'){
        $('#comment_WorkLate_before').hide();
        $('#comment_WorkLate').show();
        $('#comment_WorkLate_before_input').val(null);
    }else{
        $('#comment_WorkLate_before').hide();
        $('#comment_WorkLate').hide();
        $('#comment_WorkLat_inpute').val(null);
        $('#comment_WorkLate_before_input').val(null);
    }
  }

  function eventWorkdefect(type){
    if(type=='38'){
        $('#comment_Workdefect1').show();
        $('#comment_Workdefect2').hide();
    }else if(type=='39'){
        $('#comment_Workdefect1').hide();
        $('#comment_Workdefect2').show();
    }else{
        $('#comment_Workdefect1').hide();
        $('#comment_Workdefect2').hide();
    }
  }

  $(document).ready(function(){
    if($('#ddlWorkLate').val() =='26'){
        $('#comment_WorkLate_before').show();
        $('#comment_WorkLate').hide();
        $('#comment_WorkLate_input').val(null);
    }else if($('#ddlWorkLate').val() == '36'){
        $('#comment_WorkLate_before').hide();
        $('#comment_WorkLate').show();
        $('#comment_WorkLate_before_input').val(null);
    }else{
        $('#comment_WorkLate_before').hide();
        $('#comment_WorkLate').hide();
        $('#comment_WorkLat_inpute').val(null);
        $('#comment_WorkLate_before_input').val(null);
    }
  })


  $(document).ready(function(){
      if ($('#rdoWorkContinue').is(':checked')) {
        $('#type_of_con').show();
      }
  })
</script>
<script>
  function saveFile(barcode,screen_id){
      if($('.txtFile').val()==''){
        alert('กรุณาแนบไฟล์ก่อนทำการบันทึก');

      }else{
        var file = $('.txtFile')[0].files[0];
        var form_data = new FormData();
        form_data.append('_token', '{{csrf_token()}}');
        form_data.append('barcode', barcode);
        form_data.append('screen_id', screen_id);
        form_data.append('txtFile', file);

        $.ajax({
          url: '{{url('screen/savefile')}}',
          type: 'POST', // data: new FormData($('#upload_form')),
          data: form_data,
          dataType:'JSON',
          contentType: false,
          processData: false,
          success: function (res) { // console.log(res);

            if(res.msg=='แนบเอกสารสำเร็จ'){
              // $('.txtFileName').val(res.file_name);
              alert(res.msg+res);
              $('.downloaded').append(res.download);
              // $.each($('.downloaded span'), function(i, ele) { console.log(i)
              //   $('.downloaded span').eq(i).text(i+1)
              // });
            }else{
              // var err = '';
              // var br = '';
              // $.each(res.msg, function(i, ele) {
              //   if(res.msg.length>1 && i>0){
              //     br = '\n';
              //   }
              //   err += (br+(i+1)+'.'+ele);
              // });
              // alert(err);
            }
          },
              error: function (error) {
                  // **alert('error; ' + eval(error));**
                  console.log(error);

              }
        });
      }
  }

  function deleteFile(file_name,barcode,id){
    if(confirm("ต้องการลบไฟล์นี้หรือไม่ !")){
      var form_data = new FormData();
        form_data.append('_token', '{{csrf_token()}}');
        form_data.append('file_name', file_name);
        form_data.append('id', id);
        form_data.append('barcode', barcode);

      $.ajax({
          url: '{{url('edit_conclusion_general/deletefile')}}',
          type: 'POST', // data: new FormData($('#upload_form')),
          data: form_data,
          dataType:'JSON',
          contentType: false,
          processData: false,
          success: function (res) {  console.log(res);

            if(res.msg=='ลบสำเร็จ'){
              alert(res.msg);
              $( res.id ).remove();  
              // $('.txtFileName').val(res.file_name);
              // alert(res.msg+res);
              // $('.downloaded').append(res.download);
              // $.each($('.downloaded span'), function(i, ele) { console.log(i)
              //   $('.downloaded span').eq(i).text(i+1)
              // });
            }else{
              // var err = '';
              // var br = '';
              // $.each(res.msg, function(i, ele) {
              //   if(res.msg.length>1 && i>0){
              //     br = '\n';
              //   }
              //   err += (br+(i+1)+'.'+ele);
              // });
              // alert(err);
            }
          },
              error: function (error) {
                  // **alert('error; ' + eval(error));**
                  console.log(error);

              }
        });
    
    }
   
  }

</script>
@stop
