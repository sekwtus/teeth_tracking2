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

    th{
      font-size: 14px;
    }
    .form-control,.form-control-sm{
        color: black;
        font-style: normal;
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

/////////////////////save file
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
              s = "'";
              row = '';
              row = row+ '<div class="row mt-1 file_'+res.file_name+'" id="'+res.id_file+'">\
                            <div class="col-10">'
                              +res.download+
                            '</div>\
                              <button type="button" class="btn btn-danger" style="padding:10px;" onclick="deleteFile('+s+res.file_name+s+','+s+barcode+s+','+s+res.file_name+s+','+s+res.id_file+s+')">ลบ</button>\
                          </div>';
              alert(res.msg+res.file_name);
              $('.downloaded').append(row);
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

@section('content')
<div class="container-fluid">
  {{ Form::open(['method'=>'post' , 'url'=>'/mainscreen/new_screen/save' , 'id'=>'orderform']) }}
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
                {{-- <div class="col-sm-6 col-md-8 pr-md-0">แลปที่ผลิต
                  {{ Form::text('company_name',$out_order->company_name, ['class'=>'form-control form-control-sm','readonly']) }}
                </div> --}}


                <div class="col-sm-6 col-md-8 pr-md-0">แลปที่ผลิต
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
                {{-- <div class="col-sm-6 col-md-4">สาขา
                <select class="form-control form-control-sm" id="BranchID" name="BranchID">
                    <option value="{{$out_order->BranchID}}" selected hidden>{{$out_order->branch_name}}</option>
                    @foreach ($type_Branch as $out_type_Branch)
                        <option value="{{$out_type_Branch->ID}}">{{$out_type_Branch->Name}}</option>
                    @endforeach
                </select>
                </div> --}}


              </div>
              <div class="row py-1">
                <div class="col-sm-4 col-md-4 pr-md-0" style="padding-right: 5px;">ทพ./ทญ.
                <select class="form-control form-control-sm js-example-basic-single" id="doctor" name="doctor">
                        <option value="{{$out_order->doctorID}}" selected hidden>{{$out_order->doctor}}</option>
                    @foreach ($list_doctor as $out_list_doctor)
                        <option value="{{$out_list_doctor->Name_doctor}}">{{$out_list_doctor->Name}}</option>
                    @endforeach
                </select>
                  {{-- {{ Form::text('doctor',$out_order->doctor, ['class'=>'form-control form-control-sm','placeholder'=>'ชื่อ - นามสกุล','readonly']) }} --}}
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
                  {{ Form::text('Datefinal',$out_order->Datefinal, ['ID'=>'Datefinal','data-date-format'=>'dd/mm/yyyy','class'=>'form-control form-control-sm','placeholder'=>'วันส่งจริง','readonly']) }}
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
                <div class="col-12">หมายเหตุการเลื่อนนัด
                  {{ Form::text('DeliverDate_comment',$out_order->DeliverDate_comment, ['class'=>'form-control form-control-sm','placeholder'=>'หมายเหตุการเลื่อนนัด']) }}
                </div>
              </div>

              <div class="row py-1">
                <div class="col-12">คนรับเรื่องการเลื่อนนัด
                  {{ Form::text('Employee_DeliverDate_comment',$out_order->Employee_DeliverDate_comment, ['class'=>'form-control form-control-sm','placeholder'=>'คนรับเรื่องการเลื่อนนัด']) }}
                </div>
              </div>

              <div class="row py-1">
                <div class="col-12">ลักษณะงานที่เลื่อน
                  <select name="ddlWorkLate" class="form-control form-control-sm" onchange="eventWorkLate(this.value)">

                    @if($out_order->ddlWorkLate != '' && $out_order->ddlWorkLate != NULL)
                        <option value="{{ $out_order->ddlWorkLate }}" hidden>{{ $out_order->detail_type_1 }}</option>
                    @else
                        <option value="">เลือกลักษณะงานที่เลื่อน</option>
                    @endif

                    <optgroup label="ก่อนผลิต">
                      @foreach ($work_defect3 as $out_defect)
                        <option value="{{ $out_defect->id }}">{{$out_defect->detail_type}}</option>
                      @endforeach
                    </optgroup>
                    <optgroup label="ระหว่างผลิต">
                      @foreach ($work_defect4 as $out_defect)
                        <option value="{{ $out_defect->id }}">{{$out_defect->detail_type}}</option>
                      @endforeach
                    </optgroup>
                  </select>
                </div>
              </div>

              @if($out_order->ddlWorkLate == 36)
                <div class="row py-1" id="comment_WorkLate">
                  <div class="col-12">
                    {{ Form::text('comment_WorkLate',$out_order->comment_WorkLate, ['id'=>'comment_WorkLate_input','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                  </div>
                </div>
              @else
                <div class="row py-1 hidden" id="comment_WorkLate">
                  <div class="col-12">
                    {{ Form::text('comment_WorkLate',$out_order->comment_WorkLate, ['id'=>'comment_WorkLate_input','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                  </div>
                </div>
              @endif

              @if($out_order->ddlWorkLate == 26)
                <div class="row py-1" id="comment_WorkLate_before">
                  <div class="col-12">
                    {{ Form::text('comment_WorkLate_before',$out_order->comment_WorkLate_before, ['id'=>'comment_WorkLate_before_input','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                  </div>
                </div>
              @else
                <div class="row py-1 hidden" id="comment_WorkLate_before">
                  <div class="col-12">
                    {{ Form::text('comment_WorkLate_before',$out_order->comment_WorkLate_before, ['id'=>'comment_WorkLate_before_input','class'=>'form-control form-control-sm','placeholder'=>'อื่นๆ ระบุ']) }}
                  </div>
                </div>
              @endif
            </td>

            <td id="td-workid" valign="top">
              <div class="row py-1">
                <div class="col-12">
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
                        {{-- {{ Form::text('RefBarcode','', ['required','disabled','class'=>'form-control form-control-sm','placeholder'=>'RefBarcode','id'=>'RefBarcode']) }} --}}

                    @if($out_order->ContiBarcode != null)
                        {{ Form::text('RefBarcode',$out_order->ContiBarcode, ['required','class'=>'form-control form-control-sm','placeholder'=>'RefBarcode','id'=>'RefBarcode']) }}
                    @elseif($out_order->RefBarcode != null)
                        {{ Form::text('RefBarcode',$out_order->RefBarcode, ['required','class'=>'form-control form-control-sm','placeholder'=>'RefBarcode','id'=>'RefBarcode']) }}
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

              <div class="row py-1 div-type-edit" style="display:none;">
                <div class="col-12">ประเภทงานแก้

                  <select name="ddlTypeEdit" id="ddlTypeEdit" class="form-control form-control-sm" onchange="eventWorkdefect(this.value)">

                    @if($out_order->ddlTypeEdit != '' && $out_order->ddlTypeEdit != NULL)
                        <option value="{{ $out_order->ddlTypeEdit }}">{{ $out_order->detail_type_2 }}</option>
                    @else
                        <option value="" >เลือกลักษณะงานแก้</option>
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
                <div class="col-12">ประเภทงาน
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
                      <button type="button" onclick="saveFile({{$out_order->Barcode}},{{$id}})" class="btn btn-success"  title="บันทึก">
                        {{-- upload --}}
                        <span class="fa fa-camera"></span>
                      </button>
                    </span>
                  </div>
                </div>
                <div class="downloaded">
                    @foreach ($file as $i=>$f)
                      <div class="row mt-1 file_{{$i+1}}" id="file_{{$i+1}}">
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
                {{-- <div class="downloaded">
                  @foreach ($file as $i=>$f)

                      <p class="mt-1" style="font-size: 12px;">
                        <a href="{{url('local/public/file').'/'.$f->name_file}}" target="_blank" class="btn btn-inverse-success btn-rounded btn-block" style="padding: 1px 1px 1px 1px;"  title="ตรวจสอบ">
                          
                          <i ></i> <span>{{$i+1}}</span>. {{$f->name_file}}
                        </a>
                      </p>

                  @endforeach
                </div> --}}
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

      <table id="tbl-3" class="tbl" width="100%" border="1">
        <tr class="bg-secondary text-center">
          <td width="50%">เลือกซี่ฟัน</td>
          <td width="50%">ตารางสรุปซี่ฟัน</td>
        </tr>

        <tr>
          <td id="td-tooth" valign="top" rowspan="5">
            <table class="tbl-tooth" height="5">
              <tr>
                  <td class="text-center">
                      <h5>UR (1)</h5>
                  </td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_12" style="margin-top:30px;margin-right:2px;">
                          <img src="{{ asset('images/tooth3color/12.png') }}" class="img-tooth img-tooth-12" id="img-tooth-12" onclick="check(12)" >
                      </label>
                  </td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_11" style="margin-right:2px;">
                          <img src="{{ asset('images/tooth3color/11.png') }}" class="img-tooth img-tooth-11" id="img-tooth-11" onclick="check(11)">
                      </label>
                  </td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_21" style="margin-left:2px;">
                          <img  src="{{ asset('images/tooth3color/21.png') }}" class="img-tooth img-tooth-21" id="img-tooth-21" onclick="check(21)">
                      </label>
                  </td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_22" style="margin-top:30px;margin-left:2px;">
                          <img src="{{ asset('images/tooth3color/22.png') }}" class="img-tooth img-tooth-22" id="img-tooth-22" onclick="check(22)">
                      </label>
                  </td>
                  <td></td>
                  <td class="text-center">
                      <h5>UL (2)</h5>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_13" style="margin-left:55px;margin-top:-50px;">
                          <img src="{{ asset('images/tooth3color/13.png') }}" class="img-tooth img-tooth img-tooth-13" id="img-tooth-13" onclick="check(13)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_23" style="margin-right:55px;margin-top:-15px;">
                          <img src="{{ asset('images/tooth3color/23.png') }}" class="img-tooth img-tooth-23" id="img-tooth-23" onclick="check(23)">
                      </label>
                  </td>
                  <td></td>
              </tr>
              <tr>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_14" style="margin-right:-10px; margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/14.png') }}" class="img-tooth img-tooth-14" id="img-tooth-14" onclick="check(14)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_24" style="margin-left:-10px; margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/24.png') }}" class="img-tooth img-tooth-24" id="img-tooth-24" onclick="check(24)">
                      </label>
                  </td>
                  <td></td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_15" style="margin-right:-110px;margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/15.png') }}" class="img-tooth img-tooth-15" id="img-tooth-15" onclick="check(15)" >
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_25" style="margin-left:-110px;margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/25.png') }}" class="img-tooth img-tooth-25" id="img-tooth-25" onclick="check(25)" >
                      </label>
                  </td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_16" style="margin-right:-90px;margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/16.png') }}" class="img-tooth img-tooth-16" id="img-tooth-16" onclick="check(16)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_26" style="margin-left:-90px;margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/26.png') }}" class="img-tooth img-tooth-26" id="img-tooth-26" onclick="check(26)">
                      </label>
                  </td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_17" style="margin-right:-80px;margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/17.png') }}" class="img-tooth img-tooth-17" id="img-tooth-17" onclick="check(17)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_27" style="margin-left:-80px;margin-top:-5px;">
                          <img src="{{ asset('images/tooth3color/27.png') }}" class="img-tooth img-tooth-27" id="img-tooth-27" onclick="check(27)">
                      </label>
                  </td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_18" style="margin-right:-70px;margin-top:-10px;">
                          <img src="{{ asset('images/tooth3color/18.png') }}" class="img-tooth img-tooth-18" id="img-tooth-18" onclick="check(18)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_28" style="margin-left:-70px;margin-top:-10px;">
                          <img src="{{ asset('images/tooth3color/28.png') }}" class="img-tooth img-tooth-28" id="img-tooth-28" onclick="check(28)">
                      </label>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td align="left">R</td>
                  <td colspan="4"></td>
                  <td align="right">L</td>
                  <td></td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_48" style="margin-right:-70px;margin-bottom:0px;">
                          <img src="{{ asset('images/tooth3color/48.png') }}" class="img-tooth img-tooth-48" id="img-tooth-48" onclick="check(48)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_38" style="margin-left:-70px;margin-bottom:0px;">
                          <img src="{{ asset('images/tooth3color/38.png') }}" class="img-tooth img-tooth-38" id="img-tooth-38" onclick="check(38)">
                      </label>
                  </td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_47" style="margin-right:-80px;margin-bottom:0px;">
                          <img src="{{ asset('images/tooth3color/47.png') }}" class="img-tooth img-tooth-47" id="img-tooth-47" onclick="check(47)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_37" style="margin-left:-80px;margin-bottom:0px;">
                          <img src="{{ asset('images/tooth3color/37.png') }}" class="img-tooth img-tooth-37" id="img-tooth-37" onclick="check(37)">
                      </label>
                  </td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_46" style="margin-right:-90px;margin-bottom:0px;">
                          <img src="{{ asset('images/tooth3color/46.png') }}" class="img-tooth img-tooth-46" id="img-tooth-46" onclick="check(46)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_36" style="margin-left:-90px;margin-bottom:0px;">
                          <img src="{{ asset('images/tooth3color/36.png') }}" class="img-tooth img-tooth-36" id="img-tooth-36" onclick="check(36)">
                      </label>
                  </td>
              </tr>
              <tr>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_45" style="margin-right:-110px;margin-bottom:-0px;">
                          <img src="{{ asset('images/tooth3color/45.png') }}" class="img-tooth img-tooth-45" id="img-tooth-45" onclick="check(45)">
                      </label>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                      <label class="lbl" id="lbl_green_35" style="margin-left:-110px;margin-bottom:-0px;">
                          <img src="{{ asset('images/tooth3color/35.png') }}" class="img-tooth img-tooth-35" id="img-tooth-35" onclick="check(35)">
                      </label>
                  </td>
              </tr>
              <tr>
                <td class="text-center">
                  <label class="lbl" id="lbl_green_44" style="margin-right:-140px;margin-bottom:-0px;">
                    <img src="{{ asset('images/tooth3color/44.png') }}" class="img-tooth img-tooth-44" id="img-tooth-44" onclick="check(44)">
                  </label>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center">
                  <label class="lbl" id="lbl_green_34" style="margin-left:-140px;margin-bottom:-0px;">
                    <img src="{{ asset('images/tooth3color/34.png') }}" class="img-tooth img-tooth-34" id="img-tooth-34" onclick="check(34)">
                  </label>
                </td>
              </tr>
              <tr>
                <td></td>
                <td class="text-center">
                  <label class="lbl" id="lbl_green_43" style="margin-left:55px;margin-bottom:-0px;">
                    <img src="{{ asset('images/tooth3color/43.png') }}" class="img-tooth img-tooth-43" id="img-tooth-43" onclick="check(43)">
                  </label>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center">
                  <label class="lbl" id="lbl_green_33" style="margin-right:55px;margin-bottom:-0px;">
                    <img src="{{ asset('images/tooth3color/33.png') }}" class="img-tooth img-tooth-33" id="img-tooth-33" onclick="check(33)">
                  </label>
                </td>
                <td></td>
              </tr>
              <tr>
                <td class="text-center">
                    <h5>LR (4)</h5>
                </td>
                <td></td>
                <td class="text-center">
                    <label class="lbl" id="lbl_green_42" style="margin-bottom:50px;margin-right:2px;">
                        <img src="{{ asset('images/tooth3color/42.png') }}" class="img-tooth img-tooth-42" id="img-tooth-42" onclick="check(42)">
                    </label>
                </td>
                <td class="text-center">
                    <label class="lbl" id="lbl_green_41" style="margin-right:2px;">
                        <img src="{{ asset('images/tooth3color/41.png') }}" class="img-tooth img-tooth-41" id="img-tooth-41" onclick="check(41)">
                    </label>
                </td>
                <td>
                    <label class="lbl" id="lbl_green_31" style="margin-left:2px;">
                        <img src="{{ asset('images/tooth3color/31.png') }}" class="img-tooth img-tooth-31" id="img-tooth-31" onclick="check(31)">
                    </label>
                </td>
                <td>
                    <label class="lbl" id="lbl_green_32" style="margin-bottom:50px;margin-left:2px;">
                        <img src="{{ asset('images/tooth3color/32.png') }}" class="img-tooth img-tooth-32" id="img-tooth-32" onclick="check(32)">
                    </label>
                </td>
                <td></td>
                <td class="text-center">
                    <h5>LL (3)</h5>
                </td>
              </tr>
            </table>
            @php
              $x = '';
              $y = '';
            @endphp

            @for($i = 1; $i <= 4; $i++)
              @for($j = 1; $j <= 8; $j++)
                @php
                    $k = $i*10;
                    $k = $k+$j;
                @endphp
                    <input type="checkbox" id="chkTooth_{{$k}}" name="chkTooth_{{$k}}" value= {{$k}} >
                @foreach($teeth as $out_teeth)
                    @if($out_teeth->TeethID == $k && $out_teeth->status == '1')
                        @php $x=$k; @endphp
                        <img class="img" src="{{ asset('./images/test.gif') }}" width="0" height="0" onload="select({{$k}})">
                    @endif

                    @if($out_teeth->TeethID == $k )
                        @php
                        $y=$k;
                        @endphp
                        <img class="img" src="{{ asset('./images/test.gif') }}" width="0" height="0" onload="OnLoad({{$k}})">

                    @endif
                {{-- <input type="hidden" name="ID_order_screen" value="{{ $out_teeth->ScreenID }}"> --}}
                @endforeach
              @endfor
            @endfor
          </td>
          <td id="td-conclusion-tooth" valign="top" rowspan="5">
            <table class="" width="100%" border="1">
              <thead class="text-center">
                <th>ซี่ฟัน</th>
                <th>สินค้า</th>
                <th>กลุ่มฟัน</th>
                <th>ชนิดงาน</th>
                <th>สถานะ</th>
              </thead>
              <tbody>
                <tr>
                  @foreach ($order_teeth_screen as $teeth_screen)
                      @if($teeth_screen->status == '1')
                          <tr style="background-color: #4CAF50;color: white;">
                              <td>{{ $teeth_screen->teeth_name }}</td>
                              <td>{{ $teeth_screen->work_type }}</td>
                              <td>{{ $teeth_screen->name_group }}</td>
                              <td>{{ $teeth_screen->work_name }}</td>
                              <td>Screen แล้ว</td>
                          </tr>
                      @else
                          <tr>
                              <td>{{ $teeth_screen->teeth_name }}</td>
                              <td>{{ $teeth_screen->work_type }}</td>
                              <td>{{ $teeth_screen->name_group }}</td>
                              <td>{{ $teeth_screen->work_name }}</td>
                              <td>รอ Screen</td>
                          </tr>
                      @endif
                  @endforeach
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </table>

      <table id="tbl-4" class="tbl" width="100%" border="1">
        <tr class="bg-secondary text-center">
          <td width="22%">ALLOYS (โลหะ)</td>
          <td width="25%">SHADE</td>
          <td width="30%">MARGIN AND METAL DESIGN</td>
          <td width="23%">CONTOUR AND OCCLUSAL DESIGN</td>
        </tr>

        <tr>
          <td id="td-alloys" valign="top">
            <div id="div-alloys" class="row mb-3"  style="display:;">
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="NON_PRECIOUS" class="custom-control-input" id="rdoAlloys1" name="rdoAlloys1" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoAlloys1">NON PRECIOUS</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="PALLADIUM" class="custom-control-input" id="rdoAlloys2" name="rdoAlloys2" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoAlloys2">PALLADIUM</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="SEMI PRECIOUS" class="custom-control-input" id="rdoAlloys3" name="rdoAlloys3" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoAlloys3">SEMI PRECIOUS</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="HIGH PRECIOUS" class="custom-control-input" id="rdoAlloys4" name="rdoAlloys4" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoAlloys4">HIGH PRECIOUS</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="แจ้งค่าโลหะก่อนเหวี่ยง" class="custom-control-input" id="rdoAlloys5" name="rdoAlloys5" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoAlloys5">แจ้งค่าโลหะก่อนเหวี่ยง</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="มีโลหะมาเคลม" class="custom-control-input" id="rdoAlloys6" name="rdoAlloys6" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoAlloys6">มีโลหะมาเคลม</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoAlloys7" name="rdoAlloys7" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoAlloys7">รอถามแพทย์</label>
                </div>
                {{ Form::textarea('txtDoctorAlloys',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
              </div>
              <div class="col-12">
                {{ Form::textarea('txtCommentAlloys',null, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
              </div>
            </div>
          </td>

          <td id="td-shade" valign="top" rowspan="3">
            <div id="div-shade" class="mb-3">
              <div class="bg-success text-center">SHADE</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoShadeOneColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoShadeOneColor">สีเดียว</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="หลายสี" class="custom-control-input" id="rdoShadeMultiColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)"  onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoShadeMultiColor">หลายสี</label>
                  </div>
                </div>
              </div>

              <div class="row mt-1">
                <div class="col-md-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoShadeLine" name="rdoGroupShade2"  onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoShadeLine">แพทย์ส่งสีฟันมาทาง Line</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoShadeCompare" name="rdoGroupShade2" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoShadeCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoShadeDoctor" name="rdoGroupShade2" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoShadeDoctor">รอถามแพทย์</label>
                  </div>
                  {{ Form::textarea('txtDoctorShade',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                </div>
                <div class="col-12">
                    {{ Form::textarea('txtCommentShade',null, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
                </div>
              </div>

              <div id="div-Shade-one" class="mt-3" style="display:none;">
                <div class="bg-warning text-center mb-2">เลือกสีเดียว</div>
                <div class="row">
                  <div class="col-md-8 mb-1">
                    <select class="form-control form-control-sm" id="Shade-one-brand" name="ddlShadeBrand" onchange="SelectColor(this.value,'ddlShadeColor',this.id)">
                      <option value="0">ยี่ห้อ</option>
                      @foreach ( $screen_SHADE_Brand as $out_screen_SHADE_Brand)
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                      @endforeach
                          <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select class="form-control form-control-sm" id="Shade-one-color" name="ddlShadeColor">
                      <option value="0">สี</option>
                    </select>
                  </div>
                </div>
                <div class="row" id='div-ddlShadeColor-One-Color' style="display:none;">
                    <div class="col-md-8 mb-1">
                      {{ Form::text('txtShadeOne',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                    <div class="col-md-4 pl-md-0">
                        {{ Form::text('txtColorOne',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                </div>
              </div>
              <div id="div-Shade-multi" class="mt-3" style="display:none;">
                <div class="bg-warning text-center mb-2">หลายสี</div>

                <div class="row">
                  <label class="col-md-3 col-form-label pr-0">คอฟัน</label>
                  <div class="col-md-5 pl-md-0 mb-1">
                    <select name="ddlShadeBrandMulti1" id="Shade-multi-brand1" class="form-control form-control-sm" onchange="SelectColor(this.value,'ddlShadeColordMulti1',this.id)">
                      <option value="0">ยี่ห้อ</option>
                      @foreach ( $screen_SHADE_Brand as $out_screen_SHADE_Brand)
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                      @endforeach
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select name="ddlShadeColordMulti1" id="Shade-multi-color1" class="form-control form-control-sm">
                      <option value="0">สี</option>
                    </select>
                  </div>
                </div>
                <div class="row" id='div-ddlShadeColordMulti1-One-Color' style="display:none;">
                    <div class="col-md-3 col-form-label pr-0">
                    </div>
                    <div class="col-md-5 mb-1">
                      {{ Form::text('txtShadeBrandMulti1',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                    <div class="col-md-4 pl-md-0">
                        {{ Form::text('txtShadeColorMulti1',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                </div>

                <div class="row">
                  <label class="col-md-3 col-form-label pr-0">กลางฟัน</label>
                  <div class="col-md-5 pl-md-0 mb-1">
                    <select name="ddlShadeBrandMulti2" id="Shade-multi-brand2" class="form-control form-control-sm" onchange="SelectColor(this.value,'ddlShadeColordMulti2',this.id)">
                      <option value="0">ยี่ห้อ</option>
                      @foreach ( $screen_SHADE_Brand as $out_screen_SHADE_Brand)
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                      @endforeach
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select name="ddlShadeColordMulti2" id="Shade-multi-color2" class="form-control form-control-sm">
                      <option value="0">สี</option>
                    </select>
                  </div>
                </div>
                <div class="row" id='div-ddlShadeColordMulti2-One-Color' style="display:none;">
                    <div class="col-md-3 col-form-label pr-0">
                    </div>
                    <div class="col-md-5 mb-1">
                      {{ Form::text('txtShadeBrandMulti2',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                    <div class="col-md-4 pl-md-0">
                        {{ Form::text('txtShadeColorMulti2',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                </div>

                <div class="row">
                  <label class="col-md-3 col-form-label pr-0">ปลายฟัน</label>
                  <div class="col-md-5 pl-md-0 mb-1">
                    <select name="ddlShadeBrandMulti3" id="Shade-multi-brand3" class="form-control form-control-sm" onchange="SelectColor(this.value,'ddlShadeColordMulti3',this.id)">
                      <option value="0">ยี่ห้อ</option>
                      @foreach ( $screen_SHADE_Brand as $out_screen_SHADE_Brand)
                        <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                      @endforeach
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select name="ddlShadeColordMulti3" id="Shade-multi-color3" class="form-control form-control-sm">
                      <option value="0">สี</option>
                    </select>
                  </div>
                </div>
                <div class="row" id='div-ddlShadeColordMulti3-One-Color' style="display:none;">
                    <div class="col-md-3 col-form-label pr-0">
                    </div>
                    <div class="col-md-5 mb-0">
                      {{ Form::text('txtShadeBrandMulti3',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                    <div class="col-md-4 pl-md-0">
                        {{ Form::text('txtShadeColorMulti3',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                </div>
              </div>
            </div>

            <div id="div-stump" class="mb-3">
              <div class="bg-success text-center">STUMP</div>
              <div class="row">
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoStumpOneColor" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStumpOneColor">สีเดียว</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoStumpLine" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStumpLine">แพทย์ส่งสีฟันมาทาง Line</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoStumpCompare" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStumpCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoStumpDoctor" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStumpDoctor">รอถามแพทย์</label>
                  </div>
                  {{ Form::textarea('txtDoctorStump',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                </div>
                <div class="col-12">
                    {{ Form::textarea('txtCommentStump',null, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
                </div>
              </div>

              <div id="div-Stump-one" class="mt-3" style="display:none;">
                <div class="bg-warning text-center mb-2">สีเดียว</div>
                <div class="row">
                  <div class="col-md-8 mb-1">
                    <select class="form-control form-control-sm" id="Stump-one-brand" name="ddlStumpBrand" onchange="SelectColor(this.value,'ddlStumpColor',this.id)">
                      <option value="0">ยี่ห้อ</option>
                      @foreach ( $screen_SHADE_Brand as $out_screen_SHADE_Brand)
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                      @endforeach
                        <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select class="form-control form-control-sm" id="Stump-one-color" name="ddlStumpColor">
                      <option value="0">สี</option>
                    </select>
                  </div>
                </div>
                <div class="row" id='div-ddlStumpColor-One-Color' style="display:none;">
                    <div class="col-md-8 mb-1">
                      {{ Form::text('txtStumpBrand',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                    <div class="col-md-4 pl-md-0">
                        {{ Form::text('txtStumpColor',null, ['class'=>'form-control','placeholder'=>'ระบุ']) }}
                    </div>
                </div>
              </div>
            </div>

            <div id="div-occlusal" class="mb-3">
              <div class="bg-success text-center">OCCLUSAL STAINING</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="NONE" class="custom-control-input" id="rdoStaining1" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStaining1">NONE</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="LIGHT" class="custom-control-input" id="rdoStaining2" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStaining2">LIGHT</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="MEDIUM" class="custom-control-input" id="rdoStaining3" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStaining3">MEDIUM</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="DARK" class="custom-control-input" id="rdoStaining4" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStaining4">DARK</label>
                  </div>
                </div>
              </div>
            </div>
          </td>

          <td id="td-design" valign="top">
            <div id="div-mgmt-design">
              <div class="bg-success text-center">MARGIN AND METAL DESIGN</div>
              <div class="row mt-3">
                <div class="col-md-6 pr-md-1 text-center">
                  <input type="checkbox" name="MARGIN1" id="MARGIN1" class="hidden" value="11.png" onchange="checkOnlyOne(this.id,this.name)">
                  <label for="MARGIN1" class="pointer text-center">
                    <img class="pontic" data-toggle="tooltip"src="{{ asset('images/mental-design/11.png') }}" title data-original-title="Porcelain Margin" >
                    {{-- <div style="font-size:5px;">Porcelain</div>
                    <div style="font-size:5px;">Margin</div> --}}
                  </label>

                  <input type="checkbox" name="MARGIN1" id="MARGIN2" class="hidden" value="12.png" onchange="checkOnlyOne(this.id,this.name)">
                  <label for="MARGIN2" class="pointer text-center">
                    <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/12.png') }}" title data-original-title="Extended โดยรอบ">
                    {{-- <div style="font-size:5px;">Extended</div>
                    <div style="font-size:5px;">โดยรอบ</div> --}}
                  </label>

                  <input type="checkbox" name="MARGIN1" id="MARGIN3" class="hidden" value="13.png" onchange="checkOnlyOne(this.id,this.name)">
                  <label for="MARGIN3" class="pointer text-center">
                     <img class="pontic" data-toggle="tooltip"src="{{ asset('images/mental-design/13.png') }}" title data-original-title="Extended Margin">
                     {{-- <div style="font-size:5px;">Extended</div>
                     <div style="font-size:5px;">Margin</div> --}}
                  </label>

                  <input type="checkbox" name="MARGIN1" id="MARGIN4" class="hidden" value="14.png" onchange="checkOnlyOne(this.id,this.name)">
                  <label for="MARGIN4"  class="pointer text-center">
                    <img class="pontic"  data-toggle="tooltip" src="{{ asset('images/mental-design/14.png') }}" title data-original-title="Matal Margin">
                    {{-- <div style="font-size:5px;">Matal</div>
                    <div style="font-size:5px;">Margin</div> --}}
                  </label>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="row">
                    <div class="col-md-6 py-1 pr-md-1">
                      <input type="text" class="form-control form-control-sm" placeholder="Buccal mm." name="MARGIN_Buccal">
                    </div>
                    <div class="col-md-6 py-1 pl-md-1">
                      <input type="text" class="form-control form-control-sm" placeholder="Lingual mm." name="MARGIN_Lingual">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12 text-center">
                   <input type="checkbox" name="MARGIN2" id="sad4" class="hidden" value="21.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad4" class="pointer m-1">
                      <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/21.png') }}" title data-original-title="Porcelain Total Baking">
                      {{-- <div style="font-size:5px;">Porcelain</div>
                      <div style="font-size:5px;">Total Baking</div> --}}
                   </label>
                   <input type="checkbox" name="MARGIN2" id="sad5" class="hidden" value="22.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad5" class="pointer m-1">
                      <img class="pontic"data-toggle="tooltip"  src="{{ asset('images/mental-design/22.png') }}" title data-original-title="Porcelain Extended Margin">
                      {{-- <div style="font-size:5px;">Porcelain</div>
                      <div style="font-size:5px;">Extended Margin</div> --}}
                   </label>
                   <input type="checkbox" name="MARGIN2" id="sad6" class="hidden" value="23.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad6" class="pointer m-1">
                      <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/23.png') }}" title data-original-title="Metal Margin">
                      {{-- <div style="font-size:5px;">Metal</div>
                      <div style="font-size:5px;">Margin</div> --}}
                   </label>
                    <input type="checkbox" name="MARGIN2" id="sad7" class="hidden" value="24.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="sad7" class="pointer m-1">
                      <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/24.png') }}" title data-original-title="3/4 Occlusal Metal">
                      {{-- <div style="font-size:5px;">3/4 Occlusal</div>
                      <div style="font-size:5px;">Metal</div> --}}
                    </label>
                    <input type="checkbox" name="MARGIN2" id="sad8" class="hidden" value="25.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="sad8" class="pointer m-1">
                      <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/25.png') }}" title data-original-title="Occlusal Metal">
                      {{-- <div style="font-size:5px;">Occlusal</div>
                      <div style="font-size:5px;">Metal</div> --}}
                    </label>
                    <input type="checkbox" name="MARGIN2" id="sad9" class="hidden" value="26.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="sad9" class="pointer m-1">
                      <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/26.png') }}" title data-original-title="3/4 Metal เฉพาะด้านกัด">
                      {{-- <div style="font-size:5px;">3/4 Metal</div>
                      <div style="font-size:5px;">เฉพาะด้านกัด</div> --}}
                    </label>
                    <input type="checkbox" name="MARGIN2" id="sad10" class="hidden" value="27.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="sad10" class="pointer m-1">
                        <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/27.png') }}" title data-original-title="OCC. Metal เฉพาะด้านกัด">
                        {{-- <div style="font-size:5px;">OCC. Metal</div>
                        <div style="font-size:5px;">เฉพาะด้านกัด</div> --}}
                    </label>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12 text-center">
                   <input type="checkbox" name="MARGIN3" id="sad11" class="hidden" value="31.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad11" class="pointer m-1">
                      <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/31.png') }}" title data-original-title="หมอออกแบบเอง">
                      {{-- <div style="font-size:5px;">หมอออก</div>
                      <div style="font-size:5px;">แบบเอง</div> --}}
                   </label>
                   <input type="checkbox" name="MARGIN3" id="sad12" class="hidden" value="32.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad12" class="pointer m-1">
                       <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/32.png') }}" title data-original-title="Lingual Metal Margin">
                       {{-- <div style="font-size:5px;">Lingual</div>
                        <div style="font-size:5px;">Metal Margin</div> --}}
                   </label>
                   <input type="checkbox" name="MARGIN3" id="sad13" class="hidden" value="33.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad13" class="pointer m-1">
                        <img class="pontic"data-toggle="tooltip" src="{{ asset('images/mental-design/33.png') }}" title data-original-title="1/3 Lingual Metal Margin">
                        {{-- <div style="font-size:5px;">1/3 Lingual</div>
                        <div style="font-size:5px;">Metal Margin</div> --}}
                   </label>
                   <input type="checkbox" name="MARGIN3" id="sad14" class="hidden" value="34.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad14" class="pointer m-1">
                        <img class="pontic" data-toggle="tooltip" src="{{ asset('images/mental-design/34.png') }}" title data-original-title="3/4 Lingual Metal Margin">
                        {{-- <div style="font-size:5px;">3/4 Lingual</div>
                        <div style="font-size:5px;">Metal Margin</div> --}}
                   </label>
                   <input type="checkbox" name="MARGIN3" id="sad15" class="hidden" value="35.png" onchange="checkOnlyOne(this.id,this.name)">
                   <label for="sad15" class="pointer m-1">
                      <img class="pontic"data-toggle="tooltip" src="{{ asset('images/mental-design/35.png') }}" title data-original-title="Lingual Metal">
                      {{-- <div style="font-size:5px;">Lingual</div>
                      <div style="font-size:5px;">Metal</div> --}}
                   </label>
                </div>
              </div>
            </div>

            <div id="div-pontic-design" class="mt-3">
              <div class="bg-success text-center">PONTIC DESIGN</div>
              <div class="row mb-3">
                <div class="col-12 text-center">
                    <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC1" value="1.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="PONTIC1" class="pointer m-2">
                      <img class="pontic" src="{{ asset('images/pontic-design/1.png') }}" title data-original-title="Bullet Type Pontic">
                      {{-- <div style="font-size:5px;">Bullet</div>
                      <div style="font-size:5px;">Type Pontic</div> --}}
                    </label>

                    <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC2" value="2.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="PONTIC2" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/2.png') }}" title data-original-title="Hygienic Pontic/Conical Pontic">
                        {{-- <div style="font-size:5px;">Hygienic Pontic</div>
                        <div style="font-size:5px;">/Conical Pontic</div> --}}
                    </label>

                    <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC4" value="3.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="PONTIC4" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/3.png') }}" title data-original-title="Modified Ridge Lab Pontic">
                        {{-- <div style="font-size:5px;">Modified Ridge</div>
                        <div style="font-size:5px;">Lab Pontic</div> --}}
                    </label>

                    <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC5" value="4.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="PONTIC5" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/4.png') }}" title="Ridge Lab Pontic" >
                        {{-- <div style="font-size:5px;">Ridge</div>
                        <div style="font-size:5px;">Lab Pontic</div> --}}
                    </label>
                    <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC6" value="5.png" onchange="checkOnlyOne(this.id,this.name)">
                    <label for="PONTIC6" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/5.png') }}" title data-original-title="Oval Pontic">
                        {{-- <div style="font-size:5px;">Oval</div>
                        <div style="font-size:5px;">Pontic</div> --}}
                    </label>
                </div>
              </div>
            </div>
          </td>

          <td id="td-contour" valign="top" >
            <div id="div-gingival" class="mb-3">
              <div class="bg-success text-center">GINGIVAL EMBRASURES</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="เปิด" class="custom-control-input" id="chkOpenGingival" name="chkGingival" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkOpenGingival">เปิด</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="ปิด" class="custom-control-input" id="chkCloseGingival" name="chkGingival" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkCloseGingival">ปิด</label>
                  </div>
                </div>
              </div>
            </div>

            <div id="div-occlusion" class="mb-3">
              <div class="bg-success text-center">OCCLUSION</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="สบสนิท" class="custom-control-input" id="chkOcclusion1" name="chkOcclusion" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkOcclusion1">สบสนิท</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="UNDER" class="custom-control-input" id="chkOcclusion2" name="chkOcclusion" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkOcclusion2">UNDER</label>
                  </div>
                </div>
              </div>

              <div id="div-under" class="mt-2" style="display:none;">
                <div class="bg-warning text-center">UNDER (mm.)</div>
                <div class="row">
                  <div class="col-6 col-md-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="0.3" class="custom-control-input" id="rdoUnder1" name="rdoUnder" checked>
                      <label class="custom-control-label" for="rdoUnder1">0.3</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="0.5" class="custom-control-input" id="rdoUnder2" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder2">0.5</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="1" class="custom-control-input" id="rdoUnder3" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder3">1</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="2" class="custom-control-input" id="rdoUnder4" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder4">2</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="3" class="custom-control-input" id="rdoUnder5" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder5">3</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="div-contact" class="mb-3">
              <div class="bg-success text-center">CONTACT</div>
              <div class="row">
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="AREA" class="custom-control-input" id="chkContact1" name="chkContact" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkContact1">AREA</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="POINT" class="custom-control-input" id="chkContact2" name="chkContact" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkContact2">POINT</label>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>

        <tr class="bg-secondary text-center">
          <td>รับตะขอ</td>
          <td>MODEL</td>
          <td>IMPLANT</td>
        </tr>
        <tr>
          <td id="td-rest" valign="top">
            <div class="row">
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="มี Rest" class="custom-control-input" id="rdoHaveRest" name="rdoRest" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoHaveRest">มี Rest</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="ไม่มี Rest" class="custom-control-input" id="rdoNoRest" name="rdoRest" onchange="checkOnlyOne(this.id,this.name)" checked>
                  <label class="custom-control-label" for="rdoNoRest">ไม่มี Rest</label>
                </div>
              </div>
            </div>

            <div id="div-haverest" class="mt-3" style="display:none;">
              <div class="bg-success text-center">มี Rest</div>
              <div class="row">
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="MESIAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest1" id="chkHaveRest1">
                    <label class="custom-control-label" for="chkHaveRest1">MESIAL REST</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="DISTAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest2" id="chkHaveRest2">
                    <label class="custom-control-label" for="chkHaveRest2">DISTAL REST</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="CINGULUM REST" class="custom-control-input chkHaveRest" name="chkHaveRest3" id="chkHaveRest3">
                    <label class="custom-control-label" for="chkHaveRest3">CINGULUM REST</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="LINGUAL LEDGE" class="custom-control-input chkHaveRest" name="chkHaveRest4" id="chkHaveRest4">
                    <label class="custom-control-label" for="chkHaveRest4">LINGUAL LEDGE</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="EMBRESSURE REST" class="custom-control-input chkHaveRest" name="chkHaveRest5" id="chkHaveRest5">
                    <label class="custom-control-label" for="chkHaveRest5">EMBRESSURE REST</label>
                  </div>
                </div>
              </div>

              <div id="div-undercut" class="mt-3">
                <div class="bg-success text-center">UNDERCUT</div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="มี UNDERCUT" class="custom-control-input" id="rdoHaveUndercut" name="rdoUndercut" checked>
                      <label class="custom-control-label" for="rdoHaveUndercut">มี</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="ไม่มี UNDERCUT" class="custom-control-input" id="rdoNoUndercut" name="rdoUndercut">
                      <label class="custom-control-label" for="rdoNoUndercut">ไม่มี</label>
                    </div>
                  </div>
                </div>

                <div id="div-haveundercut" class="mt-2">
                  <div class="bg-warning text-center">UNDERCUT (mm.)</div>
                  <div class="row">
                    <div class="col-md-4 col-lg-4">
                      <div class="custom-control custom-radio">
                        <input type="radio" value="UNDERCUT 0.01" class="custom-control-input" id="rdoHaveUndercut1" name="rdoGroupHaveUndercut" checked>
                        <label class="custom-control-label" for="rdoHaveUndercut1">0.01</label>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="custom-control custom-radio">
                        <input type="radio" value="UNDERCUT 0.02" class="custom-control-input" id="rdoHaveUndercut2" name="rdoGroupHaveUndercut">
                        <label class="custom-control-label" for="rdoHaveUndercut2">0.02</label>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                      <div class="custom-control custom-radio">
                        <input type="radio" value="UNDERCUT 0.03" class="custom-control-input" id="rdoHaveUndercut3" name="rdoGroupHaveUndercut">
                        <label class="custom-control-label" for="rdoHaveUndercut3">0.03</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </td>

          <td id="td-model" valign="top">
            <div class="row mb-2">
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="SURGICAL GUIDE" class="custom-control-input" id="rdoModelSupergical" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoModelSupergical">SURGICAL GUIDE</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="MODEL RESIN (PRINT MODEL)" class="custom-control-input" id="rdoModelResin" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoModelResin">MODEL RESIN (PRINT MODEL)</label>
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoModelDoctor" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdoModelDoctor">รอถามแพทย์</label>
                </div>
                <textarea name="txtDoctorModel" class="form-control hidden" rows="2" cols="66" placeholder="ระบุ"></textarea>
              </div>
              <div class="col-12">
                {{ Form::textarea('txtCommentModel',null, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
              </div>
            </div>

            <div id="div-model-resin" class="mt-3" style="display:none;">
              <div class="bg-success text-center">เลือก MODEL RESIN (PRINT MODEL)</div>
              <div class="row">
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="บน" class="custom-control-input" id="rdoModelResin1" name="rdoModelResin" checked>
                      <label class="custom-control-label" for="rdoModelResin1">บน</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="ล่าง" class="custom-control-input" id="rdoModelResin2" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin2">ล่าง</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="บนและล่าง" class="custom-control-input" id="rdoModelResin3" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin3">บนและล่าง</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="เต็มปาก" class="custom-control-input" id="rdoModelResin4" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin4">เต็มปาก</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="ครึ่งปาก" class="custom-control-input" id="rdoModelResin5" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin5">ครึ่งปาก</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="1/4" class="custom-control-input" id="rdoModelResin6" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin6">1/4</label>
                    </div>
                  </div>
              </div>
            </div>
          </td>

          <td id="td-implant" valign="top" rowspan="3">
            <div id="div-system" class="mb-3">
              <div class="bg-success text-center">ระบบ IMPLANT</div>
              <div class="row">
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="ระบบ TI-BASE" class="custom-control-input" id="rdoTbase" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoTbase">ระบบ TI-BASE</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="ระบบ TITANIUM CUSTOMED" class="custom-control-input" id="rdoTitanium" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoTitanium">ระบบ TITANIUM CUSTOMED</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="ระบบ STANDARD" class="custom-control-input" id="rdoStandard" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStandard">ระบบ STANDARD</label>
                  </div>
                </div>
              </div>
            </div>
            <div id="div-retained" class="mb-3">
              <div class="bg-success text-center">การยึด</div>
              <div class="row">
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="Cement-retained" class="custom-control-input" id="rdoCement" name="rdoGroupRetained" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoCement">Cement-retained</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="Screw-retained" class="custom-control-input" id="rdoScrew" name="rdoGroupRetained" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoScrew">Screw-retained</label>
                  </div>
                </div>
              </div>
            </div>
            <div id="div-brand" class="mb-3">
              <div class="bg-success text-center">ยึ่ห้อ IMPLANT</div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="STRAUMANN" class="custom-control-input" id="rdoBrand1" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoBrand1">STRAUMANN</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="ASTRA" class="custom-control-input" id="rdoBrand2" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoBrand2">ASTRA</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="OSSTEM" class="custom-control-input" id="rdoBrand3" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoBrand3">OSSTEM</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="อื่นๆ" class="custom-control-input" id="rdoBrand4" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoBrand4">อื่นๆ</label>
                  </div>
                  <input type="text" name="txtImpBrandOther" class="form-control form-control-sm hidden" placeholder="ระบุ">
                </div>
              </div>
            </div>
            <div id="div-cement" class="mb-3">
              <div class="bg-success text-center">Fix Cement</div>
              <div class="row">
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="ให้แลป Fix Cement ด้วย" class="custom-control-input" id="rdoFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoFix">ให้แลป Fix Cement ด้วย</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="แลปไม่ต้อง Fix Cement" class="custom-control-input" id="rdoNotFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoNotFix">แลปไม่ต้อง Fix Cement</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoDoctorFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoDoctorFix">รอถามแพทย์</label>
                  </div>
                  {{-- <textarea class="form-control hidden" placeholder="ระบุ" cols="66" rows="2" name="txtDoctorFix"></textarea> --}}
                  <textarea name="txtDoctorFix" class="form-control hidden" rows="2" cols="66" placeholder="ระบุ"></textarea>
                </div>
                <div class="col-12">
                    {{ Form::textarea('txtCommentFixCement',null, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
                </div>
              </div>
            </div>
          </td>
        </tr>

        <tr class="bg-secondary text-center">
          <th>PINTOOTH</th>
          <th>PINTOOTH รับตะขอ</th>
          <th>PINTOOTH วัสดุ</th>
        </tr>
        <tr>
          <td valign="top">
            <div class="row">
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="PINTOOTH" class="custom-control-input" id="rdopintooth" name="rdopintooth" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdopintooth">PINTOOTH</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="COOPING" class="custom-control-input" id="rdocooping" name="rdopintooth" onchange="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="rdocooping">COOPING</label>
                </div>
              </div>
            </div>
          </td>
          <td valign="top">
            <div class="row">
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="มี Rest" class="custom-control-input" id="rdopintoothhookHaveRest" name="rdopintoothhook" onclick="checkOnlyOne(this.id,this.name)" >
                  <label class="custom-control-label" for="rdopintoothhookHaveRest">มี Rest</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="ไม่มี Rest" class="custom-control-input" id="rdopintoothhookNoRest" name="rdopintoothhook" onclick="checkOnlyOne(this.id,this.name)" checked>
                  <label class="custom-control-label" for="rdopintoothhookNoRest">ไม่มี Rest</label>
                </div>
              </div>
            </div>

            <div id="div-pintoothhaverest" class="mt-3 hidden">
              <div class="bg-success text-center">มี Rest</div>
              <div class="row">
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="MESIAL REST" class="custom-control-input" name="chkHaveRestpintooth" id="chkHaveRestpintooth1" onclick="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkHaveRestpintooth1">MESIAL REST</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="DISTAL REST" class="custom-control-input" name="chkHaveRestpintooth" id="chkHaveRestpintooth2" onclick="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkHaveRestpintooth2">DISTAL REST</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="MESIAL/DISTAL REST" class="custom-control-input" name="chkHaveRestpintooth" id="chkHaveRestpintooth3" onclick="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="chkHaveRestpintooth3">MESIAL/DISTAL REST</label>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td valign="top">
            <div class="row">
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="NON PRECIOUS" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys1" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys1">NON PRECIOUS</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="PALLADIUM" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys2" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys2">PALLADIUM</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="SEMI PRECIOUS" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys3" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys3">SEMI PRECIOUS</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="HIGH PRECIOUS" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys4" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys4">HIGH PRECIOUS</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="ZIRCONIA" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys5" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys5">ZIRCONIA</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="CERAMAGE" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys6" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys6">CERAMAGE</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="COMPOSITE" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys7" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys7">COMPOSITE</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys8" onclick="checkOnlyOne(this.id,this.name)">
                  <label class="custom-control-label" for="chkpintoothalloys8">รอถามแพทย์</label>
                </div>
              </div>
              <div class="col-12" id="Notepintoothalloys">
                <textarea name="Notepintoothalloys" class="form-control" rows="2" cols="66" placeholder="หมายเหตุ"></textarea>
              </div>
              <div class="col-12 hidden" id="Commentpintoothalloys">
                <textarea name="Commentpintoothalloys" class="form-control" rows="2" cols="66" placeholder="ระบุ"></textarea>
              </div>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <div class="col-12 px-0 mt-2 text-right">
      <input type="button" class="btn btn-lg btn-info" onclick="checking_screen()" data-toggle="modal" data-target="#checking_screen" value="ตรวจสอบการ screen ซี่ฟัน"/>
      @if( $count != 0)
        <input type="hidden" name="checkjob" value="0">
        <button type="submit" class="btn btn-lg btn-success">
            บันทึก
        </button>
      @endif
      @if( $count == 0)
        <input type="hidden" name="checkjob" value="1">
        <a href="{{ url('mainscreen')}}">
          <button type="submit" class="btn btn-lg btn-success">
            จบการ screen
          </button>
        </a>
      @endif
    </div>
  </div>
  {{ Form::close() }}
</div>


  {{-- ตรวจสอบการ screen --}}
  <div class="modal fade show" id="checking_screen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg" role="document" style="width:100%;">
        <div class="modal-content">
            <div class="card-header align-items-center text-center">
                <label class="font-weight-bold ">
                    ตรวจสอบการ screen ซี่ฟัน
                </label>

                <div id="teeth_group">

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
    }else if(id=='rdoAlloys7'){
      $('textarea[name="txtDoctorAlloys"]').show().focus();
      $('textarea[name="txtDoctorAlloys"]').prop('disabled',false);
    //   $('textarea[name="txtCommentAlloys"]').hide();
    }else{
      $('textarea[name="txtDoctorAlloys"]').hide();
      $('textarea[name="txtCommentAlloys"]').show();
      $('textarea[name="txtCommentAlloys"]').prop('disabled',false);
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
  function Color(val,name,Check_id){
    if($('#'+Check_id).is(':checked')){
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
        $('textarea[name="txtCommentShade"]').show();
        $('textarea[name="txtCommentShade"]').prop('disabled',false);
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
        $('textarea[name="txtCommentShade"]').show();
        $('textarea[name="txtCommentShade"]').prop('disabled',false);
      }else if(Check_id=='rdoShadeLine'){
        $('textarea[name="txtCommentShade"]').show();
        $('textarea[name="txtCommentShade"]').prop('disabled',false);
        $('textarea[name="txtDoctorShade"]').hide();
      }else if(Check_id=='rdoShadeCompare'){
        $('textarea[name="txtCommentShade"]').show();
        $('textarea[name="txtCommentShade"]').prop('disabled',false);
        $('textarea[name="txtDoctorShade"]').hide();
      }else if(Check_id=='rdoStumpLine'){
        $('#div-'+name+'-multi').hide();
        $('#div-'+name+'-one').hide();
        $('textarea[name="txtCommentStump"]').show();
        $('textarea[name="txtCommentStump"]').prop('disabled',false);
        $('textarea[name="txtDoctorStump"]').hide();
      }else if(Check_id=='rdoStumpCompare'){
        $('#div-'+name+'-multi').hide();
        $('#div-'+name+'-one').hide();
        $('textarea[name="txtCommentStump"]').show();
        $('textarea[name="txtCommentStump"]').prop('disabled',false);
        $('textarea[name="txtDoctorStump"]').hide();
      }else if(Check_id=='rdoStumpDoctor'){
        $('#div-'+name+'-multi').hide();
        $('#div-'+name+'-one').hide();
        $('textarea[name="txtDoctorStump"]').show();
        $('textarea[name="txtDoctorStump"]').prop('disabled',false);
        $('textarea[name="txtCommentStump"]').hide();
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
        $('textarea[name="txtCommentShade"]').hide();
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
  function SelectColor(id,name,select_id) {
    $.ajax({
      type: 'GET',
      url: '{{url('color-by-brand')}}',
      data: {brand_id: id},
      success: function(data) {
        console.log(name+' : '+data);
        $('select[name="'+name+'"]').empty().html(data);
      }
    });

    var selectBox = document.getElementById(select_id);
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    if(selectedValue == 'อื่นๆ'){
      document.getElementById('div-'+name+'-One-Color').style.display = 'flex';
    }
    else{
      document.getElementById('div-'+name+'-One-Color').style.display = 'none';
    }
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
      $('textarea[name="txtCommentModel"]').show();
      $('textarea[name="txtCommentModel"]').prop('disabled',false);
      $('textarea[name="txtDoctorModel"]').prop('disabled',true);

      if($('#rdoModelResin').prop('checked')==false){
        $('#div-model-resin').hide();
      }
    }else if(id=='rdoModelDoctor'){
      $('textarea[name="txtCommentModel"]').hide();
      $('textarea[name="txtDoctorModel"]').show();
      $('textarea[name="txtDoctorModel"]').prop('disabled',false);
    //   $('textarea[name="txtDoctorModel"]').prop('disabled',true);
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
      $('textarea[name="txtCommentModel"]').show();
      $('textarea[name="txtCommentModel"]').prop('disabled',false);
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
    if($('input[name="rdoRest"]').is(':checked')){
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
    }else{
      $('#div-haverest').hide();
      $('.chkHaveRest').each(function(i) {
        $('.chkHaveRest').eq(i).prop('checked', false);
      });
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
      $('textarea[name="txtDoctorFix"]').show();
      $('textarea[name="txtDoctorFix"]').prop('disabled',false);
      $('textarea[name="txtCommentFixCement"]').hide();
    }else{
      $('textarea[name="txtDoctorFix"]').hide();
      $('textarea[name="txtDoctorFix"]').prop('disabled',true);
      $('textarea[name="txtCommentFixCement"]').show();
      $('textarea[name="txtCommentFixCement"]').prop('disabled',false);
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
  //     $('.ddlEdit').hide();
  // }
  // function edit_Barcode(){
  //     document.getElementById("RefBarcode").disabled = false;
  //     document.getElementById("RefBarcode2").disabled = true;
  //     $('.ddlEdit').show();
  // }

  $('input[name="rdopintoothhook"]').change(function(){
    if($("#rdopintoothhookHaveRest").prop('checked')==true){
      $("#div-pintoothhaverest").show();
    }else{
      $("#div-pintoothhaverest").hide();
      $("#chkHaveRestpintooth1").prop('checked',false);
      $("#chkHaveRestpintooth2").prop('checked',false);
      $("#chkHaveRestpintooth3").prop('checked',false);
    }
  });

  $('input[name="chkpintoothalloys"]').change(function(){
    if($("#chkpintoothalloys8").prop('checked')==true){
      $("#Notepintoothalloys").hide();
      $("#Commentpintoothalloys").show();
      $('textarea[name="Notepintoothalloys"]').val(null);
    }else{
      $("#Notepintoothalloys").show();
      $("#Commentpintoothalloys").hide();
      $('textarea[name="Commentpintoothalloys"]').val(null);
    }
  });

  $(document).ready(function(){
      if ($('#rdoWorkEdit').is(':checked')) {
        $('.div-type-edit').show();
      }
  })

  $(document).ready(function(){
      if ($('#rdoWorkContinue').is(':checked')) {
        $('#type_of_con').show();
      }
  })

  function BarcodeWork(type){
    if(type=='new'){
      $('#RefBarcode').attr('disabled',true);
      $('.div-type-edit').hide();
      $("#ddlTypeEdit").prop('required',false);
      $('#type_of_con').hide();
      $('#select_type_of_con').attr('disabled',false);
      $("#select_type_of_con").prop('required',false);
    }else if(type=='edit'){
      $('#RefBarcode').attr('disabled',false);
      $('.div-type-edit').show();
      $("#ddlTypeEdit").prop('required',true);
      $('#type_of_con').hide();
      $('#select_type_of_con').attr('disabled',true);
      $("#select_type_of_con").prop('required',false);
    }else{
      $('#RefBarcode').attr('disabled',false);
      $('.div-type-edit').hide();
      $("#ddlTypeEdit").prop('required',false);
      $('#type_of_con').show();
      $('#select_type_of_con').attr('disabled',false);
      $("#select_type_of_con").prop('required',true);
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

  ////////tooltitel
  (function($) {
  'use strict';

  $(function() {
    /* Code for attribute data-custom-class for adding custom class to tooltip */
    if (typeof $.fn.tooltip.Constructor === 'undefined') {
      throw new Error('Bootstrap Tooltip must be included first!');
    }

    var Tooltip = $.fn.tooltip.Constructor;

    // add customClass option to Bootstrap Tooltip
    $.extend(Tooltip.Default, {
      customClass: ''
    });

    var _show = Tooltip.prototype.show;

    Tooltip.prototype.show = function() {

      // invoke parent method
      _show.apply(this, Array.prototype.slice.apply(arguments));

      if (this.config.customClass) {
        var tip = this.getTipElement();
        $(tip).addClass(this.config.customClass);
      }

    };

  });
  })(jQuery);


</script>

<script>
  function checking_screen(){
    var id_order_screen = '{{ $id }}';
    $.ajax({
        type: 'GET',
        url: '{{ url('checking_screen') }}',
        data: {id_order_screen:id_order_screen},
        success: function (data) {
          var str = '';
          var detail_screen_group0 = 0;
          var teeth_group1 = 1;
          var teeth2 = 2;
          var count_group = 1;

          data[detail_screen_group0].forEach(detail_screen_group => {

            str = str + '<div class="container-fluid" id="content"> \
                          <div class="row">\
                              <div class="col-12 px-0">\
                                <table id="tbl-4" class="tbl" width="100%" border="1">\
                                  <tr class="bg-success text-center">\
                                    <th>กลุ่ม'+(count_group++)+'</th>\
                                    <th colspan="4">การออกแบบ</th>\
                                        <th colspan="1">\
                                            @if(!empty($endflow))\
                                              @if($count_job == 0)\
                                              <a href="{{ url('/mainscreen/edit_on_screening/').'/'.$id.'/'}}'+detail_screen_group.screen_group+' " class="btn btn-icons btn-warning" title="แก้ไข" >\
                                                  <i class="fa fa-edit"></i>\
                                              </a>\
                                              @else\
                                              <button class="btn btn-icons btn-danger" title="แก้ไข" onclick="complete()">\
                                                  <i class="fa fa-edit"></i>\
                                              </button>\
                                              @endif\
                                          @else\
                                                  @if($count_job == 0)\
                                                  <button class="btn btn-icons btn-danger" title="แก้ไข" onclick="complete_2()">\
                                                      <i class="fa fa-edit"></i>\
                                                  </button>\
                                                  @else\
                                                  <button class="btn btn-icons btn-outline-danger" title="แก้ไข" onclick="complete()">\
                                                      <i class="fa fa-edit"></i>\
                                                  </button>\
                                                  @endif\
                                          @endif\
                                        </th>\
                                  </tr>\
                                  <tr>\
                                    <td id="td-tooth" width="25%" valign="top" rowspan="2">\
                                      <table class="tbl" width="100%" border="1">\
                                        <thead class="bg-secondary text-center">\
                                          <th>ซี่ฟัน</th>\
                                          <th>สินค้า</th>\
                                          <th>ชนิดงาน</th>\
                                          <th>ชนิดกลุ่มงาน</th>\
                                        </thead>\
                                        <tbody>';

                      data[teeth_group1].forEach(teeth_group => {

                          if (detail_screen_group.screen_group == teeth_group.screen_group) {
                              str = str + '<tr>\
                                <th>#'+teeth_group.TeethID+'</th>';

                                data[teeth2].forEach(teeth => {
                                      if (teeth_group.TeethID == teeth.teeth){
                                          str = str + '<td>'+teeth.work_type+'</td>\
                                                      <td>'+teeth.work_name+'</td>\
                                                      <td>'+teeth.name_group+'</td>';
                                      }
                                });
                          }
                      });
                      str = str +'</tbody>\
                                    </table>\
                                  </td>\
                                  <th class="bg-secondary text-center" width="20%">SHADE</th>\
                                  <th class="bg-secondary text-center" width="15%">STUMP</th>\
                                  <th class="bg-secondary text-center" width="15%">MARGIN,METAL</th>\
                                  <th class="bg-secondary text-center" width="10%">PONTIC</th>\
                                  <th class="bg-secondary text-center" width="15%">ALLOYS</th>\
                                </tr>\
                                \
                                <tr>\
                                  <td id="td-shade" valign="top">\
                                    <div id="div-shade">';
                      if (detail_screen_group.one_color=='สีเดียว' || detail_screen_group.one_color=='หลายสี') {
                        str = str +'<div class="bg-warning text-center">'+detail_screen_group.one_color+'</div>\
                                        <div class="row my-1">\
                                          <div class="col-12">';
                              if (detail_screen_group.one_color=='สีเดียว') {
                                  str = str +' <table class="tbl" width="100%" border="1">\
                                                <tr class="bg-secondary text-center">\
                                                  <th>ยี่ห้อ</th>\
                                                  <th>สี</th>\
                                                </tr>\
                                                <tr>\
                                                  <td>'+detail_screen_group.one_color_branch_name+'</td>\
                                                  <td>'+detail_screen_group.one_color_name+'</td>\
                                                </tr>\
                                              </table>';
                              }
                              if (detail_screen_group.one_color=='หลายสี') {
                                str = str +'<table class="tbl" width="100%" border="1">\
                                                <tr class="bg-secondary text-center">\
                                                  <th>ฟัน</th>\
                                                  <th>ยี่ห้อ</th>\
                                                  <th>สี</th>\
                                                </tr>\
                                                <tr>\
                                                  <td>คอฟัน</td>\
                                                  <td>'+detail_screen_group.one_color_branch_name_2+'</td>\
                                                  <td>'+detail_screen_group.one_color_name_2+'</td>\
                                                </tr>\
                                                <tr>\
                                                  <td>กลางฟัน</td>\
                                                  <td>'+detail_screen_group.one_color_branch_name_3+'</td>\
                                                  <td>'+detail_screen_group.one_color_name_3+'</td>\
                                                </tr>\
                                                <tr>\
                                                  <td>ปลายฟัน</td>\
                                                  <td>'+detail_screen_group.one_color_branch_name_4+'</td>\
                                                  <td>'+detail_screen_group.one_color_name_4+'</td>\
                                                </tr>\
                                              </table>';
                              }

                                str = str +'</div>\
                                        </div>\
                                        <div class="bg-warning text-center">'+((detail_screen_group.one_color_extra1 == '' || detail_screen_group.one_color_extra1 == null) ? '':detail_screen_group.one_color_extra1)+'</div>\
                                        <div class=" text-center">'+((detail_screen_group.txtCommentAlloys == ''|| detail_screen_group.txtCommentAlloys == null)? '':detail_screen_group.txtCommentAlloys)+'<br>\
                                        '+((detail_screen_group.comment_Metal_type == ''|| detail_screen_group.comment_Metal_type == null) ? '':detail_screen_group.comment_Metal_type)+'</div>';

                      }else if(detail_screen_group.one_color==''){
                            str = str +'<div class="row">\
                                          <div class="col-12 text-center">-</div>\
                                        </div>';
                      }else{
                            str = str +'<div class="row">\
                                          <div class="col-12 text-center">\
                                            '+detail_screen_group.one_color+'\
                                          </div>\
                                        </div>';
                      }
                      str = str +'</div>\
                                    <br>\
                                    <div class="row">\
                                        <div class="col-12 text-center">\
                                          '+((detail_screen_group.txtCommentShade == '' || detail_screen_group.txtCommentShade == null) ? '':detail_screen_group.txtCommentShade)+'\
                                      </div>\
                                    </div>\
                                  </td>\
                                  <td id="td-stump" valign="top">';

                      if (detail_screen_group.stump=='สีเดียว') {
                        str = str +'<div class="bg-warning text-center">สีเดียว</div>\
                                      <div class="row mt-1">\
                                        <div class="col-12">\
                                          <table class="tbl" width="100%" border="1">\
                                            <tr class="bg-secondary text-center">\
                                              <th>ยี่ห้อ</th>\
                                              <th>สี</th>\
                                            </tr>\
                                            <tr>\
                                              <td>'+detail_screen_group.one_color_branch_name_5+'</td>\
                                              <td>'+detail_screen_group.one_color_name_5+'</td>\
                                            </tr>\
                                          </table>\
                                        </div>\
                                      </div>';
                      }else if(detail_screen_group.stump==''){
                        str = str +'<div class="row">\
                                        <div class="col-12 text-center">-</div>\
                                      </div>';
                      }else{
                        str = str +'<div class="row">\
                                        <div class="col-12 text-center">\
                                          '+((detail_screen_group.stump == '' || detail_screen_group.stump == null) ? '':detail_screen_group.stump)+'\
                                        </div>\
                                      </div>';
                      }
                        str = str +'<br>\
                                    <div class="row">\
                                        <div class="col-12 text-center">\
                                          '+((detail_screen_group.txtCommentStump == '' || detail_screen_group.txtCommentStump == null) ? '':detail_screen_group.txtCommentStump)+'\
                                      </div>\
                                    </div>\
                                  </td>\
                                  <td id="td-margin" valign="top">\
                                    <div class="row text-center">';
                        if (detail_screen_group.MARGIN1 != '' && detail_screen_group.MARGIN1 != null) {
                              if (detail_screen_group.MARGIN_Buccal != '' && detail_screen_group.MARGIN_Lingual != '') {
                                  str = str +'<label class="col-4 mt-1">\
                                            <img class="pontic" src="../../images/mental-design/'+detail_screen_group.MARGIN1+'" >\
                                            </label>';
                              }else{
                                  str = str +'<label class="col-12 mt-1">\
                                            <img class="pontic" src="../../images/mental-design/'+detail_screen_group.MARGIN1+'" >\
                                            </label>';
                              }
                        }
                          var MARGIN_Buccal = (detail_screen_group.MARGIN_Buccal == '' || detail_screen_group.MARGIN_Buccal == null) ? '':detail_screen_group.MARGIN_Buccal;
                          var MARGIN_Lingual = (detail_screen_group.MARGIN_Lingual == '' || detail_screen_group.MARGIN_Lingual == null) ? '':detail_screen_group.MARGIN_Lingual;
                          str = str +'<div class="col-4 mt-1">\
                                        '+MARGIN_Buccal+'\
                                      </div>\
                                      <div class="col-4 mt-1">\
                                        '+MARGIN_Lingual+'\
                                      </div>';

                        if (detail_screen_group.MARGIN2 != '' && detail_screen_group.MARGIN2 != null) {
                            str = str +'<label class="col-4 mt-1">\
                                      <img class="pontic" src="../../images/mental-design/'+detail_screen_group.MARGIN2+'" >\
                                      </label>';
                        }
                        if (detail_screen_group.MARGIN3 != '' && detail_screen_group.MARGIN3 != null) {
                            url = "{{ asset('images/pontic-design/"+detail_screen_group.MARGIN3+"') }}";
                            str = str +'<label class="col-4 mt-1">\
                                      <img class="pontic" src="../../images/mental-design/'+detail_screen_group.MARGIN3+'" >\
                                      </label>';
                        }
                          str = str +'</div>\
                                  </td>\
                                  <td id="td-pontic" valign="top">\
                                    <div class="row text-center">';

                        if (detail_screen_group.PONTIC_DESIGN != '' && detail_screen_group.PONTIC_DESIGN != null) {
                          str = str +'<label class="col-12 mt-1">\
                                      <img class="pontic"src="../../images/pontic-design/'+detail_screen_group.PONTIC_DESIGN+'" >\
                                      </label>';
                        }
                          var Metal_type  = (detail_screen_group.Metal_type == '' || detail_screen_group.Metal_type == null) ? '':detail_screen_group.Metal_type;
                          var Metal_type2 = (detail_screen_group.Metal_type2 == '' || detail_screen_group.Metal_type2 == null) ? '':detail_screen_group.Metal_type2;
                          var Metal_type3 = (detail_screen_group.Metal_type3 == '' || detail_screen_group.Metal_type3 == null) ? '':detail_screen_group.Metal_type3;
                          var Metal_type4 = (detail_screen_group.Metal_type4 == '' || detail_screen_group.Metal_type4 == null) ? '':detail_screen_group.Metal_type4;
                          var Metal_type5 = (detail_screen_group.Metal_type5 == '' || detail_screen_group.Metal_type5 == null) ? '':detail_screen_group.Metal_type5;
                          var Metal_type6 = (detail_screen_group.Metal_type6 == '' || detail_screen_group.Metal_type6 == null) ? '':detail_screen_group.Metal_type6;
                          var comment_Metal_type = (detail_screen_group.comment_Metal_type == '' || detail_screen_group.comment_Metal_type == null) ? '':detail_screen_group.comment_Metal_type;

                          str = str +'</div>\
                                  </td>\
                                  <td id="td-alloys" class="text-center" valign="top">\
                                    <div class="text-center bg-warning">'+Metal_type+'</div>\
                                    <div class="text-center bg-warning">'+Metal_type2+'</div>\
                                    <div class="text-center bg-warning">'+Metal_type3+'</div>\
                                    <div class="text-center bg-warning">'+Metal_type4+'</div>\
                                    <div class="text-center bg-warning">'+Metal_type5+'</div>\
                                    <div class="text-center bg-warning">'+Metal_type6+'</div>\
                                    <hr>\
                                    <div class="text-center">'+comment_Metal_type+'</div>\
                                    <div class="row">\
                                        <div class="col-12 text-center">\
                                        '+detail_screen_group.txtCommentAlloys+'\
                                      </div>\
                                    </div>\
                                  </td>\
                                </tr>\
                                <tr class="bg-secondary text-center">\
                                    <th>PINTOOTH</th>\
                                    <th>IMPLANT</th>\
                                    <th>CONTOUR,OCCLUSION</th>\
                                    <th>รับตะขอ</th>\
                                    <th>OCCLUSAL STAINING</th>\
                                    <th>MODEL</th>\
                                </tr>\
                                <tr class="bg-secondary text-center">\
                                  <td id="td-implant" class="text-center" valign="top">\
                                    <div id="div-system">\
                                    <div class="bg-warning">'+ detail_screen_group.Pintooth +'</div>\
                                    </div>\
                                    <div id="div-retained">\
                                    <div class="bg-warning">PINTOOTH รับตะขอ('+detail_screen_group.PintoothHook+')</div>\
                                    <div class="row mb-1">\
                                        <div class="col-12">\
                                        '+((detail_screen_group.PintoothHookRest == '' || detail_screen_group.PintoothHookRest == null) ? '-':detail_screen_group.PintoothHookRest)+'\
                                        </div>\
                                    </div>\
                                    </div>\
                                    <div id="div-retained">\
                                    <div class="bg-warning">PINTOOTH วัสดุ</div>\
                                    <div class="row mb-1">\
                                        <div class="col-12">\
                                        '+((detail_screen_group.PintoothAlloys == '' || detail_screen_group.PintoothAlloys == null) ? '-':detail_screen_group.PintoothAlloys)+'\
                                        </div>\
                                        <div class="col-12"> หมายเหตุ\
                                        '+((detail_screen_group.PintoothAlloysNote == '' || detail_screen_group.PintoothAlloysNote == null) ? '-':detail_screen_group.PintoothAlloysNote)+'\
                                        </div>\
                                        <div class="col-12">\
                                        '+((detail_screen_group.PintoothAlloysComment == '' || detail_screen_group.PintoothAlloysComment == null) ? '-':detail_screen_group.PintoothAlloysComment)+'\
                                        </div>\
                                    </div>\
                                    </div>\
                                  </td>\
                                <td id="td-implant" class="text-center" valign="top">\
                                <div id="div-system">\
                                  <div class="bg-warning">ระบบ</div>\
                                  <div class="row mb-1">\
                                    <div class="col-12">\
                                      '+((detail_screen_group.implant_ceramage == '' || detail_screen_group.implant_ceramage == null) ? '-':detail_screen_group.implant_ceramage)+'\
                                    </div>\
                                  </div>\
                                </div>\
                                <div id="div-retained">\
                                  <div class="bg-warning">การยึด</div>\
                                  <div class="row mb-1">\
                                    <div class="col-12">\
                                      '+((detail_screen_group.implant == '' || detail_screen_group.implant == null) ? '-':detail_screen_group.implant)+'\
                                    </div>\
                                  </div>\
                                </div>\
                                <div id="div-imp-brand">\
                                  <div class="bg-warning">ยี่ห้อ</div>\
                                  <div class="row mb-1">\
                                    <div class="col-12">\
                                      '+((detail_screen_group.implant_brand == '' || detail_screen_group.implant_brand == null) ? '-':detail_screen_group.implant_brand)+'\
                                    </div>\
                                  </div>\
                                </div>\
                                <div id="div-imp-fix">\
                                  <div class="bg-warning text-center">Fix Cement</div>\
                                  <div class="row mb-1">\
                                    <div class="col-12">\
                                      '+((detail_screen_group.FixCement == '' || detail_screen_group.FixCement == null) ? '-':detail_screen_group.FixCement)+'\
                                    </div>\
                                  </div>\
                                </div>\
                                <br>\
                                <div class="row">\
                                    <div class="col-12 text-center">\
                                      '+((detail_screen_group.txtCommentFixCement == '' || detail_screen_group.txtCommentFixCement == null) ? '':detail_screen_group.txtCommentFixCement)+'\
                                  </div>\
                                </div>\
                              </td>\
                              <td id="td-contour" class="text-center" valign="top">\
                                <div class="bg-warning">GINGIVAL EMBRASURES</div>\
                                <div class="row mb-1">\
                                  <div class="col-12">\
                                    '+((detail_screen_group.GINGIVAL_EMBRASURES == '' || detail_screen_group.GINGIVAL_EMBRASURES == null) ? "-":detail_screen_group.GINGIVAL_EMBRASURES )+'\
                                  </div>\
                                </div>\
                                <div class="bg-warning">OCCLUSION</div>\
                                <div class="row mb-1">\
                                  <div class="col-12">\
                                    '+((detail_screen_group.OCCLUSION == '' || detail_screen_group.OCCLUSION == null) ? '-':detail_screen_group.OCCLUSION)+'\
                                  </div>';

                                  if (detail_screen_group.OCCLUSION =='UNDER' ) {
                                    str = str + '<div class="col-12">\
                                              <i class="fa fa-arrow-down"></i>\
                                              </div>\
                                              <div class="col-12">'+detail_screen_group.unit_CONTOUR +'mm.</div>';
                                  }

                                  str = str + '</div>\
                                  <div class="bg-warning">CONTACT</div>\
                                    <div class="row mb-1">\
                                      <div class="col-12">\
                                        '+((detail_screen_group.CONTACT == '' || detail_screen_group.CONTACT == null) ? '-':detail_screen_group.CONTACT)+'\
                                      </div>\
                                    </div>\
                                    </td>\
                                  <td id="td-rest" valign="top">';

                                  if (detail_screen_group.Hook == 'มี Rest' ) {
                                  str = str + ' <div id="div-rest">\
                                  <div class="bg-warning text-center">Rest</div>\
                                  <div class="row mb-1">';

                                    if (detail_screen_group.MESIAL_REST != null ) {
                                      str = str + ' <div class="col-12">- '+detail_screen_group.MESIAL_REST+'</div>';
                                    }
                                    if (detail_screen_group.DISTAL_REST != null ) {
                                      str = str + ' <div class="col-12">- '+detail_screen_group.DISTAL_REST+'</div>';
                                    }
                                    if (detail_screen_group.CINGULUM_REST != null ) {
                                      str = str + ' <div class="col-12">- '+detail_screen_group.CINGULUM_REST+'</div>';
                                    }
                                    if (detail_screen_group.LINGUAL_LEDGE != null ) {
                                      str = str + ' <div class="col-12">- '+detail_screen_group.LINGUAL_LEDGE+'</div>';
                                    }
                                    if (detail_screen_group.EMBRESSURE_REST != null ) {
                                      str = str + ' <div class="col-12">- '+detail_screen_group.EMBRESSURE_REST+'</div>';
                                    }

                                  str = str + ' </div>\
                                  </div>\
                                  <div id="div-undercut" class="text-center">\
                                    <div class="bg-warning">UNDERCUT</div>\
                                    <div class="row">\
                                      <div class="col-12">\
                                        '+(detail_screen_group.other_hook=='มี UNDERCUT') ? detail_screen_group.undercut_hook+' mm.' :'ไม่มี'+'\
                                      </div>\
                                    </div>\
                                  </div>';
                                }

                                  else{
                                    str = str + '<div class="row text-center">\
                                                  <div class="col-12">ไม่มี Rest</div>\
                                                </div>';
                                  }


                                  str = str + '</td>\
                                    <td id="td-occlusal" class="text-center" valign="top">\
                                      '+((detail_screen_group.OCCLUSAL_STAINING == ''|| detail_screen_group.OCCLUSAL_STAINING == null) ? '-' :detail_screen_group.OCCLUSAL_STAINING)+'\
                                    </td>\
                                    <td id="td-model" valign="top">\
                                      <div id="div-model" class="row text-center">\
                                        <div class="col-12">\
                                      '+((detail_screen_group.model == '' || detail_screen_group.model == null) ? '-' :detail_screen_group.model)+'\
                                      </div>';

                                if (detail_screen_group.model == 'MODEL RESIN (PRINT MODEL)' ) {
                                  str = str + '<div class="col-12">\
                                        <i class="fa fa-arrow-down"></i>\
                                        </div>\
                                        <div class="col-12">'+detail_screen_group.model_resin+'</div>';
                                }

                                str = str + '</div>\
                                      <br>\
                                      <div class="row">\
                                          <div class="col-12 text-center">\
                                          '+detail_screen_group.txtCommentModel+'\
                                        </div>\
                                      </div>\
                                    </td>\
                                  </tr>\
                                </table>\
                                </div>\
                              </div>\
                            </div>';


                          });


          $('#teeth_group').html(str);





        }

    });
  }
</script>

<script>
    $('#orderform').submit(function() {
    if($('#enddate').val() == ''){
        alert('วันส่งงานต้องไม่ว่าง');
        return false;
    }
    });
</script>
<script>
  function deleteFile(file_name,barcode,id,id_file){
    //  alert(id);
    if(confirm("ต้องการลบไฟล์นี้หรือไม่ !")){
      var form_data = new FormData();
        form_data.append('_token', '{{csrf_token()}}');
        form_data.append('file_name', file_name);
        form_data.append('id', id);
        form_data.append('barcode', barcode);
        // console.log(file_name);
      $.ajax({
          url: '{{url('edit_conclusion_general/deletefile')}}',
          type: 'POST', // data: new FormData($('#upload_form')),
          data: form_data,
          dataType:'JSON',
          contentType: false,
          processData: false,
          success: function (res) {  
            console.log(res);
//file_261631_155332.jpg
//file_261631_155332.jpg
            if(res.msg=='ลบสำเร็จ'){
              alert(res.msg); //ลบสำเร็จ
              // alert(res.id);
              // row = "";
              // s = "'";
              // row = row+'#file_'+file_name;
              // alert(res.id); //.file_1
              $(res.id).remove();
              $('#'+id_file).remove(); 
               
              // $("#file_"+file_name).remove();
              // $( row ).remove(); 
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


<script>
  function complete() {
    alert("ไม่สามารถแก้ไขได้เนื่องจากงานจัดส่งแล้ว");
  }
  
  function complete_2() {
    alert("ไม่สามารถแก้ไขได้เนื่องจากงานอยู่ในแผนก");
  }
  </script>



@stop
