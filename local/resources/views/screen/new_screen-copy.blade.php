@extends('layouts.template')
@section('title', 'Screen')
@section('stylesheet')
<style media="screen">
    /* ตารางหลัก */
    .tbl td{
      padding: 5px;
    }
    .hidden{
      display: none;
    }
    .bg-primary, .bg-secondary, .bg-success{
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
</style>
@stop

@section('content')
<div class="content-wrapper"> 
  <div class="card">
    <table id="tbl-1" class="tbl" width="100%" border="1">
      <tr class="bg-secondary text-center">
        <td width="60%">ข้อมูลทั่วไป</td>
        <td width="20%">ข้อมูลวันเวลาผลิต</td>
        <td width="20%">ข้อมูลรหัสงาน</td>
      </tr>

      @foreach($order as $out_order)
        <tr>
          <td id="td-detail" valign="top">
            <div class="row py-1">
              <div class="col-md-5 pr-md-0"> ทพ./ทญ.
                {{ Form::text('doctor',$out_order->doctor, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล','readonly']) }}
              </div>
              <div class="col-sm-6 col-md-3 pr-md-0">เบอร์โทร
                {{ Form::text('phone',$out_order->phone, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
              </div>
              <div class="col-sm-6 col-md-4">ช่างประจำ
                {{ Form::text('tec',NULL, ['class' => 'form-control','placeholder' => 'ช่างประจำ']) }}
              </div>
            </div>
            <div class="row py-1 form-group-">
              <div class="col-md-5 pr-md-0">รพ./คลีนิค
                {{ Form::text('customer',$out_order->customer, ['class' => 'form-control','placeholder' => 'ร.พ./คลีนิค','readonly']) }}
              </div>
              <div class="col-md-3 pr-md-0">ที่อยู่
                {{ Form::text('Address',$out_order->Address, ['class' => 'form-control','placeholder' => 'ที่อยู่']) }}
              </div>
              <div class="col-sm-6 col-md-2 pr-md-0">เบอร์โทร
                {{ Form::text('phone_customer',NULL, ['class' => 'form-control','value' => '888','placeholder' => 'เบอร์โทร']) }}
              </div>
              <div class="col-sm-6 col-md-2">LINE
                {{ Form::text('line',NULL, ['class' => 'form-control','placeholder' => 'Line']) }}
              </div>
            </div>
            <div class="row py-1">
              <div class="col-md-5 pr-md-0">ชื่อ-นามสกุลคนไข้
                {{ Form::text('PatientName',$out_order->PatientName, ['class' => 'form-control','placeholder' => 'คนไข้']) }}
              </div>
              <div class="col-sm-4 col-md-3 pr-md-0">HN
                {{ Form::text('PatientHN',$out_order->PatientHN, ['class' => 'form-control','placeholder' => 'HN']) }}
              </div>
              <div class="col-sm-4 col-md-2 pr-md-0">อายุ
                {{ Form::text('PatientAge',$out_order->PatientAge, ['class' => 'form-control','placeholder' => 'อายุ','min'=>"1",'max'=>"99" ,'onKeyPress'=>'if(this.value.length==2) return false;']) }}
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
                {{ Form::text('sex',$sex, ['class' => 'form-control','placeholder' => 'เพศ','readonly']) }}
              </div>
            </div>

            <div class="row py-1">
              <div class="col-md-5 pr-md-0">ชื่อ SALE
                <input type="text" name="" class="form-control">
              </div>
              <div class="col-sm-6 col-md-3 pr-md-0">เขต
                <input type="text" name="" class="form-control">
              </div>
              <div class="col-sm-6 col-md-4">หมายเหตุ
                <input type="text" name="" class="form-control">
              </div>
            </div>
          </td>
          <td id="td-datetime" valign="top">
            <div class="row py-1">
              <label class="col-lg-4 col-form-label pr-0">วันรับงาน</label>
              <div class="col-lg-8">
                {{ Form::text('StartDate',$out_order->StartDate, ['ID'=>'startdate','data-date-format'=>'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันที่รับ']) }}
              </div>
            </div>
            <div class="row py-1">
              <label class="col-lg-4 col-form-label pr-0">วันส่งงาน</label>
              <div class="col-lg-8">
                {{ Form::text('DeliverDate',$out_order->DeliverDate, ['ID'=>'enddate','data-date-format'=>'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันที่ส่ง']) }}
              </div>
            </div>
            <div class="row py-1">
              <label class="col-lg-4 col-form-label pr-0">วันส่งจริง</label>
              <div class="col-lg-8">
                <input type="text" name="" class="form-control">
              </div>
            </div>
            <div class="row py-1">
              <label class="col-lg-4 col-form-label pr-0">รอบงาน</label>
              <div class="col-lg-8">
                <input type="text" name="" class="form-control">
              </div>
            </div>
          </td>
          <td id="td-workid" valign="top">
            <div class="row py-2">
              <div class="col-md-6 col-lg-4 pr-lg-0">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoWorkNew" name="rdoWork">
                    <label class="custom-control-label" for="rdoWorkNew">ใหม่</label>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 px-lg-0">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoWorkEdit" name="rdoWork">
                    <label class="custom-control-label" for="rdoWorkEdit">แก้ไข</label>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 pl-lg-0">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoWorkContinue" name="rdoWork">
                    <label class="custom-control-label" for="rdoWorkContinue">ต่อเนื่อง</label>
                </div>
              </div>
            </div>
            <div class="row py-1">
              <label class="col-lg-4 col-form-label pr-0">BARCODE</label>
              <div class="col-lg-8">
                {{ Form::text('Barcode',$out_order->Barcode, ['class' => 'form-control','placeholder' => 'Barcode']) }}
              </div>
            </div>
            <div class="row py-1">
              <label class="col-lg-4 col-form-label pr-0">REF.CODE</label>
              <div class="col-lg-8">
                {{ Form::text('RefBarcode',$out_order->RefBarcode, ['class' => 'form-control','placeholder' => 'RefBarcode']) }}
              </div>
            </div>
            <div class="row py-1">
              <label class="col-lg-4 col-form-label pr-0">ประเภทงาน</label>
              <div class="col-lg-8">
                {{ Form::text('DeliverType',$out_order->DeliverType, ['class' => 'form-control','placeholder' => 'DeliverType']) }}
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </table>

    <table id="tbl-2" class="tbl" width="100%" border="1">
      <tr class="bg-secondary text-center">
        <td width="30%">เลือกซี่ฟัน</td>
        <td width="30%">ตารางสรุปซี่ฟัน</td>
        <td width="20%">คำสั่งพิเศษ</td>
        <td width="20%">สิ่งที่ส่งมาด้วย</td>
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
                            <td>{{ $teeth_screen->work_group }}</td>
                            <td>{{ $teeth_screen->work_type }}</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $teeth_screen->teeth_name }}</td>
                            <td>{{ $teeth_screen->work_group }}</td>
                            <td>{{ $teeth_screen->work_type }}</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endif
                @endforeach
              </tr>
            </tbody>
          </table>
        </td>
        <td id="td-special-command" valign="top" rowspan="5">
          <div class="row">
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd1" id="chkCmd1">
                  <label class="custom-control-label" for="chkCmd1">ดู Wax full contour</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd2" id="chkCmd2">
                  <label class="custom-control-label" for="chkCmd2">ดู Design ทางไลน์</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd3" id="chkCmd3">
                  <label class="custom-control-label" for="chkCmd3">ลอง contour พอสเลนก่อนเกรซ</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd4" id="chkCmd4">
                  <label class="custom-control-label" for="chkCmd4">ส่งกลับให้คุณหมอดู</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd5" id="chkCmd5">
                  <label class="custom-control-label" for="chkCmd5">ทำ PINDEX</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd6" id="chkCmd6">
                  <label class="custom-control-label" for="chkCmd6">จะส่งคนไข้มาเทียบสีที่ Lab</label>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd7" id="chkCmd7" onclick="Command(7)">
                  <label class="custom-control-label" for="chkCmd7">ให้ช่างโทรกลับในขั้นตอนะส่งคนไข้มาเทียบสีที่ Lab</label>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="txtCmd7" class="form-control" placeholder="ขั้นตอน" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd8" id="chkCmd8" onclick="Command(8)">
                <label class="custom-control-label" for="chkCmd8">ทางไลน์</label>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="txtCmd8" class="form-control" placeholder="LINE ID" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd9" id="chkCmd9" onclick="Command(9)">
                <label class="custom-control-label" for="chkCmd9">คุณหมอส่งสีฟันมาทางไลน์</label>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="txtCmd9" class="form-control" placeholder="LINE ID" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" class="custom-control-input" name="chkCmd10" id="chkCmd10" onclick="Command(10)">
                <label class="custom-control-label" for="chkCmd10">โทรกลับแล้ว</label>
              </div>
              <div class="row">
                <div class="col-lg-7 mb-1">
                  <input type="text" name="txtCmd10" class="form-control" placeholder="โทรโดย" readonly>
                </div>
                <div class="col-lg-5 pl-lg-0">
                  <input type="text" value="" name="txtDateCmd10" class="form-control" placeholder="วว/ดด/ปปปป" readonly>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td id="td-attachment" valign="top">
          <div class="row">
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment1" class="custom-control-input" id="chkAttachment1" onclick="Attachment(1)">
                <label class="custom-control-label" for="chkAttachment1">IMPRESSION</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentAmt1" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachment1" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment2" class="custom-control-input" id="chkAttachment2" onclick="Attachment(2)">
                <label class="custom-control-label" for="chkAttachment2">WORKING MODEL</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentAmt2" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachment2" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment3" class="custom-control-input" id="chkAttachment3" onclick="Attachment(3)">
                <label class="custom-control-label" for="chkAttachment3">STUDY MODEL</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentAmt3" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachment3" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment4" class="custom-control-input" id="chkAttachment4" onclick="Attachment(4)">
                <label class="custom-control-label" for="chkAttachment4">BITE</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentAmt4" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachment4" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment5" class="custom-control-input" id="chkAttachment5" onclick="Attachment(5)">
                <label class="custom-control-label" for="chkAttachment5">คู่สบ</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentAmt5" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachment5" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment6" class="custom-control-input" id="chkAttachment6" onclick="Attachment(6)">
                <label class="custom-control-label" for="chkAttachment6">ARTICULATOR</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentAmt6" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachment6" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment7" class="custom-control-input" id="chkAttachment7" onclick="Attachment(7)">
               <label class="custom-control-label" for="chkAttachment7">อื่นๆ</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentAmt7" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachment7" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>


      <tr class="bg-secondary text-center">
        <td>IMPLANT ที่ส่งมา</td>
      </tr>
      <tr>
        <td id="td-attachment-implant" valign="top">
          <div class="row">
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachmentImp1" class="custom-control-input" id="chkAttachmentImp1" onclick="AttachmentImp(1)">
               <label class="custom-control-label" for="chkAttachmentImp1">IMPRESSION</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentImpAmt1" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachmentImp1" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachmentImp2" class="custom-control-input" id="chkAttachmentImp2" onclick="AttachmentImp(2)">
               <label class="custom-control-label" for="chkAttachmentImp2">IMPRESSION CAP</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentImpAmt2" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachmentImp2" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachmentImp3" class="custom-control-input" id="chkAttachmentImp3" onclick="AttachmentImp(3)">
                <label class="custom-control-label" for="chkAttachmentImp3">SCREW</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentImpAmt3" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachmentImp3" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachmentImp4" class="custom-control-input" id="chkAttachmentImp4" onclick="AttachmentImp(4)">
               <label class="custom-control-label" for="chkAttachmentImp4">ANALOG</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentImpAmt4" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachmentImp4" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachment5" class="custom-control-input" id="chkAttachmentImp5" onclick="AttachmentImp(5)">
               <label class="custom-control-label" for="chkAttachmentImp5">ABUTMENT</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentImpAmt5" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachmentImp5" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachmentImp6" class="custom-control-input" id="chkAttachmentImp6" onclick="AttachmentImp(6)">
               <label class="custom-control-label" for="chkAttachmentImp6">SCREW DRIVER</label>
              </div>
              <div class="row">
                <div class="col-lg-4 pr-lg-0 mb-1">
                  <input type="number" name="txtAttachmentImpAmt6" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-lg-8">
                  <input type="text" name="txtAttachmentImp6" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
              <hr class="mt-2 mb-1 border-secondary">
            </div>
            <div class="col-md-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" value="" name="chkAttachmentImp7" class="custom-control-input" id="chkAttachmentImp7" onclick="AttachmentImp(7)">
               <label class="custom-control-label" for="chkAttachmentImp7">อื่นๆ</label>
              </div>
              <div class="row">
                <div class="col-md-4 pr-0">
                  <input type="number" name="txtAttachmentImpAmt7" class="form-control" min="0" placeholder="จำนวน" readonly>
                </div>
                <div class="col-md-8">
                  <input type="text" name="txtAttachmentImp7" class="form-control" placeholder="ระบุ" readonly>
                </div>
              </div>
            </div>

          </div>
        </td>
      </tr>
      <tr class="bg-secondary text-center">
        <td bgcolor="#FF0000">คำสั่งเพิ่มเติม</td>
      </tr>
      <tr>
        <td valign="top">
          <div class="row">
            <label class="col-md-4 col-form-label">ระบุ</label>
            <div class="col-md-8 pl-md-0">
              <textarea class="form-control"></textarea>
            </div>
          </div>
        </td>
      </tr>
    </table>

    <table id="tbl-3" class="tbl" width="100%" border="1">
      <tr class="bg-success">
        <td colspan="4" align="center">For design</td>
      </tr>
      <tr class="bg-secondary text-center">
        <td width="25%">ALLOYS</td>
        <td width="25%">SHADE</td>
        <td width="25%">MARGIN AND METAL DESIGN</td>
        <td width="25%">CONTOUR AND OCCLUSAL DESIGN</td>
      </tr>

      <tr>
        <td id="td-alloys" valign="top">
          <div class="row mb-3">
                      <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoAlloys1" name="rdoAlloys" checked>
                    <label class="custom-control-label" for="rdoAlloys1">NON PRECIOUS</label>
                  </div>
                      </div>
                      <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoAlloys2" name="rdoAlloys">
                    <label class="custom-control-label" for="rdoAlloys2">PALLADIUM</label>
                  </div>
                      </div>
                      <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoAlloys3" name="rdoAlloys">
                    <label class="custom-control-label" for="rdoAlloys3">SEMI PRECIOUS</label>
                  </div>
                      </div>
                      <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoAlloys4" name="rdoAlloys">
                    <label class="custom-control-label" for="rdoAlloys4">HIGH PRECIOUS</label>
                  </div>
                      </div>
                </div>

                <div class="row mt-3">
                    <label class="col-md-4">
                        รอถามแพทย์
                    </label>
                    <div class="col-md-8">
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
        </td>
        <td id="td-shade" valign="top" rowspan="3">
          <div class="row">
              <div class="col-md-6 col-lg-4">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoShade" name="rdoShade" checked>
                  <label class="custom-control-label" for="rdoShade">SHADE</label>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoStump" name="rdoShade">
                  <label class="custom-control-label" for="rdoStump">STUMP</label>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoIngot" name="rdoShade">
                  <label class="custom-control-label" for="rdoIngot">INGOT</label>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoMultiColor" name="rdoShade">
                  <label class="custom-control-label" for="rdoMultiColor">หลายสี</label>
                </div>
              </div>
          </div>
          <!-- <div class="row">

          </div> -->

          <div id="div-one-color" class="mt-2 border" style="display:none;">
            <div class="bg-primary text-center mb-2">เลือกสีเดียว</div>
                  <div class="row">
                      <div class="col-md-9 mb-1">
                <select class="form-control" name="">
                  <option value="0">ยี่ห้อ</option>
                </select>
                      </div>
                      <div class="col-md-3 pl-md-0">
                          <select class="form-control" name="">
                              <option value="0">สี</option>
                          </select>
                      </div>
                  </div>
          </div>

          <div id="div-multi-color" class="mt-2 border" style="display:none;">
            <div class="bg-primary text-center mb-2">เลือกหลายสี</div>
                  <div class="row">
                      <label class="col-md-4 col-form-label pr-0">คอฟัน</label>
                      <div class="col-md-5 pl-md-0 mb-1">
                <select class="form-control" name="ddlBrand1">
                  <option value="0">ยี่ห้อ</option>
                </select>
                      </div>
                      <div class="col-md-3 pl-md-0">
                          <select name="ddlColor1" class="form-control">
                              <option value="0">สี</option>
                          </select>
                      </div>
                  </div>
            <div class="row">
                      <label class="col-md-4 col-form-label pr-0">กลางฟัน</label>
                      <div class="col-md-5 pl-md-0 mb-1">
                <select name="ddlBrand2" class="form-control">
                  <option value="0">ยี่ห้อ</option>
                </select>
                      </div>
                      <div class="col-md-3 pl-md-0">
                          <select name="ddlColor2" class="form-control">
                              <option value="0">สี</option>
                          </select>
                      </div>
                  </div>
            <div class="row">
                      <label class="col-md-4 col-form-label pr-0">ปลายฟัน</label>
                      <div class="col-md-5 pl-md-0 mb-1">
                <select name="ddlBrand3" class="form-control">
                  <option value="0">ยี่ห้อ</option>
                </select>
                      </div>
                      <div class="col-md-3 pl-md-0">
                          <select name="ddlColor3" class="form-control">
                              <option value="0">สี</option>
                          </select>
                      </div>
                  </div>
          </div>

                <div class="row mt-3">
                    <label class="col-md-4 col-form-label pr-0">
                        รอถามแพทย์
                    </label>
                    <div class="col-md-8 pl-md-0">
                        <textarea name="" class="form-control"></textarea>
                    </div>
                </div>
        </td>
        <td id="td-mgmt-design" valign="top" rowspan="3">
          <div class="row">
            <div class="col-12 text-center">
              <input type="checkbox" name="MARGIN1" id="MARGIN1" class="hidden" value="11.png" />
              <label for="MARGIN1" class="pointer m-2 text-center">
                <img class="pontic" src="{{ asset('images/mental-design/11.png') }}" title="Porcelain Margin">
                <br>Porcelain
              </label>

              <input type="checkbox" name="MARGIN1" id="MARGIN2" class="hidden" value="12.png" />
              <label for="MARGIN2" class="pointer m-2 text-center">
                <img class="pontic" src="{{ asset('images/mental-design/12.png') }}" title="Extended โดยรอบ">
                <br>Extended
              </label>

              <input type="checkbox" name="MARGIN1" id="MARGIN3" class="hidden" value="13.png" checked/>
              <label for="MARGIN3" class="pointer m-2 text-center">
                 <img class="pontic" src="{{ asset('images/mental-design/13.png') }}" title="Extended Margin">
                 <br>Extended
              </label>

              <input type="checkbox" name="MARGIN1" id="MARGIN4" class="hidden" value="14.png" />
              <label for="MARGIN4" class="pointer m-2 text-center">
                <img class="pontic" src="{{ asset('images/mental-design/14.png') }}" title="Matal Margin">
                <br>Matal
              </label>
            </div>

            <div class="col-12 text-center mt-4">
               <input type="checkbox" name="MARGIN2" id="sad4" class="hidden" value="21.png" />
               <label for="sad4" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/21.png') }}">
               </label>
               <input type="checkbox" name="MARGIN2" id="sad5" class="hidden" value="22.png" checked/>
               <label for="sad5" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/22.png') }}">
               </label>
               <input type="checkbox" name="MARGIN2" id="sad6" class="hidden" value="23.png" />
               <label for="sad6" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/23.png') }}">
               </label>
                <input type="checkbox" name="MARGIN2" id="sad7" class="hidden" value="24.png" />
                <label for="sad7" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/24.png') }}" title="Occlusal Metal">
                </label>
                <input type="checkbox" name="MARGIN2" id="sad8" class="hidden" value="25.png" />
                <label for="sad8" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/25.png') }}" title="3/4 Occlusal Metal">
                </label>
                <input type="checkbox" name="MARGIN2" id="sad9" class="hidden" value="26.png" />
                <label for="sad9" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/26.png') }}" title="">
                </label>
                <input type="checkbox" name="MARGIN2" id="sad10" class="hidden" value="27.png" />
                <label for="sad10" class="pointer m-2">
                    <img class="pontic" src="{{ asset('images/mental-design/27.png') }}" title="">
                </label>
              </div>

            <div class="col-12 text-center mt-4">
               <input type="checkbox" name="MARGIN3" id="sad11" class="hidden" value="31.png">
               <label for="sad11" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/31.png') }}" title="">
               </label>
               <input type="checkbox" name="MARGIN3" id="sad12" class="hidden" value="32.png" checked/>
               <label for="sad12" class="pointer m-2">
                   <img class="pontic" src="{{ asset('images/mental-design/32.png') }}" title="">
               </label>
               <input type="checkbox" name="MARGIN3" id="sad13" class="hidden" value="33.png">
               <label for="sad13" class="pointer m-2">
                   <img class="pontic" src="{{ asset('images/mental-design/33.png') }}" title="">
               </label>
               <input type="checkbox" name="MARGIN3" id="sad14" class="hidden" value="34.png">
               <label for="sad14" class="pointer m-2">
                   <img class="pontic" src="{{ asset('images/mental-design/34.png') }}" title="">
               </label>
               <input type="checkbox" name="MARGIN3" id="sad15" class="hidden" value="35.png">
               <label for="sad15" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/mental-design/35.png') }}" title="Lingual Metal">
               </label>
            </div>
          </div>
        </td>
        <td id="td-contour" valign="top" >
          <div class="bg-primary text-center">GINGIVAL EMBRASURES</div>
          <div class="row mb-4">
                      <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoOpenGingival" name="rdoGingival" checked>
                    <label class="custom-control-label" for="rdoOpenGingival">เปิด</label>
                  </div>
                      </div>
              <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoCloseGingival" name="rdoGingival">
                    <label class="custom-control-label" for="rdoCloseGingival">ปิด</label>
                  </div>
                      </div>
          </div>

          <div class="bg-primary text-center mb-0">OCCLUSION</div>
          <div class="row">
                      <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoOcclusion1" name="rdoOcclusion" checked>
                    <label class="custom-control-label" for="rdoOcclusion1">สบสนิท</label>
                  </div>
                      </div>
              <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoOcclusion2" name="rdoOcclusion">
                    <label class="custom-control-label" for="rdoOcclusion2">UNDER</label>
                  </div>
                      </div>
          </div>

          <div id="div-under" class="mt-2 border" style="display:none;">
            <div class="bg-warning text-center w-75 mx-auto">UNDER</div>
            <div class="row mb-4">
                        <div class="col-6 col-md-3 col-lg-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoUnder1" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder1">0.3</label>
                    </div>
                        </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoUnder2" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder2">0.5</label>
                    </div>
                        </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoUnder3" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder3">1</label>
                    </div>
                        </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoUnder4" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder4">2</label>
                    </div>
                        </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoUnder5" name="rdoUnder">
                      <label class="custom-control-label" for="rdoUnder5">3</label>
                    </div>
                        </div>
            </div>
          </div>

          <div class="bg-primary text-center">CONTACT</div>
          <div class="row">
                    <div class="col-md-6">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoContac1" name="rdoContac">
                  <label class="custom-control-label" for="rdoContac1">AREA</label>
                </div>
                    </div>
            <div class="col-md-6">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoContac2" name="rdoContac">
                  <label class="custom-control-label" for="rdoContac2">POINT</label>
                </div>
                    </div>
          </div>
        </td>
      </tr>

      <tr class="bg-secondary text-center">
        <td>รับตะขอ</td>
        <td>IMPLANT</td>
      </tr>

      <tr>
        <td id="td-rest" valign="top" rowspan="5">
          <div class="row">
                      <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="มี Rest" class="custom-control-input" id="rdoHaveRest" name="rdoRest" checked>
                    <label class="custom-control-label" for="rdoHaveRest">มี Rest</label>
                  </div>
                      </div>
              <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ไม่มี Rest" class="custom-control-input" id="rdoNoRest" name="rdoRest">
                    <label class="custom-control-label" for="rdoNoRest">ไม่มี Rest</label>
                  </div>
                      </div>
          </div>

          <div id="div-haverest" class="mt-2 border">
            <div class="bg-primary text-center">มี Rest</div>
            <div class="row">
                        <div class="col-lg-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="MESIAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest1" id="chkHaveRest1">
                      <label class="custom-control-label" for="chkHaveRest1">MESIAL REST</label>
                    </div>
                        </div>
                <div class="col-lg-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="DISTAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest2" id="chkHaveRest2">
                      <label class="custom-control-label" for="chkHaveRest2">DISTAL REST</label>
                    </div>
                        </div>
                <div class="col-lg-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="CINGULUM REST" class="custom-control-input chkHaveRest" name="chkHaveRest3" id="chkHaveRest3">
                      <label class="custom-control-label" for="chkHaveRest3">CINGULUM REST</label>
                    </div>
                        </div>
                <div class="col-lg-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="LINGUAL LEDGE" class="custom-control-input chkHaveRest" name="chkHaveRest4" id="chkHaveRest4">
                      <label class="custom-control-label" for="chkHaveRest4">LINGUAL LEDGE</label>
                    </div>
                        </div>
                <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="EMBRESSURE REST" class="custom-control-input chkHaveRest" name="chkHaveRest5" id="chkHaveRest5">
                      <label class="custom-control-label" for="chkHaveRest5">EMBRESSURE REST</label>
                    </div>
                        </div>
            </div>

            <div id="div-undercut" class="mt-2 border">
              <div class="bg-primary text-center">UNDERCUT</div>
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="มี UNDERCUT" class="custom-control-input" id="rdoHaveUndercut" name="rdoUndercut" checked>
                    <label class="custom-control-label" for="rdoHaveUndercut">มี UNDERCUT</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ไม่มี UNDERCUT" class="custom-control-input" id="rdoNoUndercut" name="rdoUndercut">
                    <label class="custom-control-label" for="rdoNoUndercut">ไม่มี UNDERCUT</label>
                  </div>
                </div>
              </div>

              <div id="div-haveundercut" class="mt-2 border">
                <div class="bg-warning text-center w-75 mx-auto">มี UNDERCUT</div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="UNDERCUT 0.01" class="custom-control-input" id="rdoHaveUndercut1" name="rdoGroupHaveUndercut" checked>
                      <label class="custom-control-label" for="rdoHaveUndercut1">UNDERCUT 0.01</label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="UNDERCUT 0.02" class="custom-control-input" id="rdoHaveUndercut2" name="rdoGroupHaveUndercut">
                      <label class="custom-control-label" for="rdoHaveUndercut2">UNDERCUT 0.02</label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="UNDERCUT 0.03" class="custom-control-input" id="rdoHaveUndercut3" name="rdoGroupHaveUndercut">
                      <label class="custom-control-label" for="rdoHaveUndercut3">UNDERCUT 0.03</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </td>
        <td id="td-implant" valign="top" rowspan="5">
          <div class="row">
                      <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="E.MAX" class="custom-control-input" id="rdoImplant1" name="rdoGroupImplant" checked>
                    <label class="custom-control-label" for="rdoImplant1">E.MAX</label>
                  </div>
                      </div>
              <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ZIRCONIA" class="custom-control-input" id="rdoImplant2" name="rdoGroupImplant">
                    <label class="custom-control-label" for="rdoImplant2">ZIRCONIA</label>
                  </div>
                      </div>
              <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="CERAMAGE" class="custom-control-input" id="rdoImplant3" name="rdoGroupImplant">
                    <label class="custom-control-label" for="rdoImplant3">CERAMAGE</label>
                  </div>
                      </div>
              <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="Cement-retained" class="custom-control-input" id="rdoImplant4" name="rdoGroupImplant">
                    <label class="custom-control-label" for="rdoImplant4">Cement-retained</label>
                  </div>
                      </div>
              <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="Screw-retained" class="custom-control-input" id="rdoImplant5" name="rdoGroupImplant">
                    <label class="custom-control-label" for="rdoImplant5">Screw-retained</label>
                  </div>
                      </div>
              <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="สกรูที่หมอส่งมา" class="custom-control-input" id="rdoImplant6" name="rdoGroupImplant">
                    <label class="custom-control-label" for="rdoImplant6">สกรูที่หมอส่งมา</label>
                  </div>
                      </div>

              <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ให้แลป FIX CEMENT ด้วย" class="custom-control-input" id="rdoImplant7" name="rdoGroupImplant">
                    <label class="custom-control-label" for="rdoImplant7">ให้แลป FIX CEMENT ด้วย</label>
                  </div>
                      </div>
          </div>

          <div id="div-ceramage" class="mt-2 border" style="display:none;">
            <div class="bg-warning text-center w-75 mx-auto">เลือก CERAMAGE</div>
            <div class="row">
                <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ระบบ TI-BASE" class="custom-control-input" id="rdoCeramage1" name="rdoGroupCeramage">
                    <label class="custom-control-label" for="rdoCeramage1">ระบบ TI-BASE</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ระบบ TITANIUM CUSTOMED" class="custom-control-input" id="rdoCeramage2" name="rdoGroupCeramage">
                    <label class="custom-control-label" for="rdoCeramage2">ระบบ TITANIUM CUSTOMED</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ระบบ STANDARD" class="custom-control-input" id="rdoCeramage3" name="rdoGroupCeramage">
                    <label class="custom-control-label" for="rdoCeramage3">ระบบ STANDARD</label>
                  </div>
                </div>
            </div>
          </div>

          <div id="div-screw" class="mt-2 border" style="display:none;">
            <div class="bg-warning text-center w-75 mx-auto">เลือก Screw-retained</div>
            <div class="row">
                <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="STRAUMANN" class="custom-control-input" id="rdoScrew1" name="rdoGroupScrew">
                    <label class="custom-control-label" for="rdoScrew1">STRAUMANN</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="ASTRA" class="custom-control-input" id="rdoScrew2" name="rdoGroupScrew">
                    <label class="custom-control-label" for="rdoScrew2">ASTRA</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="OSSTEM" class="custom-control-input" id="rdoScrew3" name="rdoGroupScrew">
                    <label class="custom-control-label" for="rdoScrew3">OSSTEM</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="อื่นๆ" class="custom-control-input" id="rdoScrew4" name="rdoGroupScrew">
                    <label class="custom-control-label" for="rdoScrew4">อื่นๆ</label>
                  </div>
                </div>
            </div>
          </div>
        </td>
      </tr>

      <tr class="bg-secondary text-center">
        <td>OCCLUSAL STAINING</td>
        <td>MODEL</td>
      </tr>
      <tr>
        <td id="td-occlusal_staining" valign="top">
          <div class="row">
                      <div class="col-md-6 col-lg-3">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoStaining1" name="rdoStaining" checked>
                    <label class="custom-control-label" for="rdoStaining1">NONE</label>
                  </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoStaining2" name="rdoStaining">
                    <label class="custom-control-label" for="rdoStaining2">LIGHT</label>
                  </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="" class="custom-control-input" id="rdoStaining3" name="rdoStaining">
                    <label class="custom-control-label" for="rdoStaining3">MEDIUM</label>
                  </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                <div class="custom-control custom-radio">
                  <input type="radio" value="" class="custom-control-input" id="rdoStaining4" name="rdoStaining">
                  <label class="custom-control-label" for="rdoStaining4">DARK</label>
                </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <label class="col-md-4">
                        รอถามแพทย์
                    </label>
                    <div class="col-md-8 pl-md-0">
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
        </td>
        <td id="td-model" valign="top" rowspan="3">
          <div class="row mb-2">
                      <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="SURGICAL GUIDE" class="custom-control-input" id="rdoModelSupergical" name="rdoGroupModel" checked>
                    <label class="custom-control-label" for="rdoModelSupergical">SURGICAL GUIDE</label>
                  </div>
                      </div>
              <div class="col-lg-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" value="MODEL RESIN (PRINT MODEL)" class="custom-control-input" id="rdoModelResin" name="rdoGroupModel">
                    <label class="custom-control-label" for="rdoModelResin">MODEL RESIN (PRINT MODEL)</label>
                  </div>
                      </div>
          </div>

          <div id="div-model-resin" class="mt-2 border" style="display:none;">
            <div class="bg-primary text-center">เลือก MODEL RESIN (PRINT MODEL)</div>
            <div class="row">
                        <div class="col-md-6 col-lg-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoModelResin1" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin1">บน</label>
                    </div>
                        </div>
                <div class="col-md-6 col-lg-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoModelResin2" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin2">ล่าง</label>
                    </div>
                        </div>
                <div class="col-md-6 col-lg-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoModelResin3" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin3">บนและล่าง</label>
                    </div>
                        </div>
                <div class="col-md-6 col-lg-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoModelResin4" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin4">เต็มปาก</label>
                    </div>
                        </div>
                <div class="col-md-6 col-lg-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoModelResin5" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin5">ครึ่งปาก</label>
                    </div>
                        </div>
                <div class="col-md-6 col-lg-4">
                    <div class="custom-control custom-radio">
                      <input type="radio" value="" class="custom-control-input" id="rdoModelResin6" name="rdoModelResin">
                      <label class="custom-control-label" for="rdoModelResin6">1/4</label>
                    </div>
                        </div>
            </div>
          </div>

          <div class="row mt-3">
                    <label class="col-md-4 col-form-label pr-0">
                        รอถามแพทย์
                    </label>
                    <div class="col-md-8 pl-0">
                        <textarea name="" class="form-control"></textarea>
                    </div>
                </div>
        </td>
      </tr>

      <tr class="bg-secondary text-center">
        <td>PONTIC DESIGN</td>
      </tr>
      <tr>
        <td id="td-pontic" valign="top">
          <div class="row">
            <div class="col-12 text-center">
                <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC1" value="1.png" />
                <label for="PONTIC1" class="pointer m-2">
                  <img class="pontic" src="{{ asset('images/pontic-design/1.png') }}">
                </label>

                <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC2" value="2.png" />
                <label for="PONTIC2" class="pointer m-2">
                    <img class="pontic" src="{{ asset('images/pontic-design/2.png') }}">
                </label>

                <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC4" value="3.png" checked/>
                <label for="PONTIC4" class="pointer m-2">
                    <img class="pontic" src="{{ asset('images/pontic-design/3.png') }}">
                </label>

                <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC5" value="4.png">
                <label for="PONTIC5" class="pointer m-2">
                    <img class="pontic" src="{{ asset('images/pontic-design/4.png') }}"  >
                </label>
                <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC6" value="5.png">
                <label for="PONTIC6" class="pointer m-2">
                    <img class="pontic" src="i{{ asset('images/pontic-design/5.png') }}">
                </label>
            </div>
          </div>
        </td>
      </tr>
    </table>
  </div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
  //สิ่งที่ส่งมาด้วย
  function Attachment(i){ //alert()
    if($('#chkAttachment'+i).prop('checked')==true){
      $('input[name="txtAttachmentAmt'+i+'"]').attr('readonly', false).focus();
      $('input[name="txtAttachment'+i+'"]').attr('readonly', false);
    }else{
      $('input[name="txtAttachmentAmt'+i+'"]').attr('readonly', true);
      $('input[name="txtAttachment'+i+'"]').attr('readonly', true);
    }
  }

  //สิ่งที่ส่งมาด้วย (IMPLANT)
  function AttachmentImp(i){ //alert()
    if($('#chkAttachmentImp'+i).prop('checked')==true){
      $('input[name="txtAttachmentImpAmt'+i+'"]').attr('readonly', false).focus();
      $('input[name="txtAttachmentImp'+i+'"]').attr('readonly', false);
    }else{
      $('input[name="txtAttachmentImpAmt'+i+'"]').attr('readonly', true);
      $('input[name="txtAttachmentImp'+i+'"]').attr('readonly', true);
    }
  }

  //คำสั่งพิเศษ
  function Command(i){
    if($('#chkCmd'+i).prop('checked')==true){
      $('input[name="txtCmd'+i+'"]').attr('readonly', false).focus();
      if(i==10){
        $('input[name="txtDateCmd'+i+'"]').attr('readonly', false);
      }
    }else{
      $('input[name="txtCmd'+i+'"]').attr('readonly', true);
      if(i==10){
        $('input[name="txtDateCmd'+i+'"]').attr('readonly', true);
      }
    }
  }

  // SHADE
  $('input[name="rdoShade"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoMultiColor'){
      $('#div-multi-color').show();
      $('#div-one-color').hide();
    }else{
      $('#div-multi-color').hide();
      $('#div-one-color').show();
    }
  });

  // รับตะขอ
  $('input[name="rdoRest"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoHaveRest'){
      $('#div-haverest').show();
      $('#div-haveundercut').show();
      $('#rdoHaveUndercut').prop('checked', true);
      $('#rdoHaveUndercut1').prop('checked', true);
    }else{
      $('#div-haverest').hide();
      $('.chkHaveRest').each(function(i) {
        $('.chkHaveRest').eq(i).prop('checked', false);
      });
      $('input[name="rdoUndercut"]').prop('checked', false);
      $('input[name="rdoGroupHaveUndercut"]').prop('checked', false);
      $('input[name="rdoHaveUndercut1"]').prop('checked', false);
    }
  });

  // UNDERCUT
  $('input[name="rdoUndercut"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoHaveUndercut'){
      $('#div-haveundercut').show();
      $('#rdoHaveUndercut1').prop('checked', true);
    }else{
      $('#div-haveundercut').hide();
      $('input[name="rdoGroupHaveUndercut"]').prop('checked', false);
    }
  });

  // IMPLANT
  $('input[name="rdoGroupImplant"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoImplant3'){
      $('#div-ceramage').show();
      $('#div-screw').hide();
      $('#rdoCeramage1').prop('checked', true);
      $('input[name="rdoGroupScrew"]').prop('checked', false);
    }else if(id=='rdoImplant5'){
      $('#div-screw').show();
      $('#div-ceramage').hide();
      $('#rdoScrew1').prop('checked', true);
      $('input[name="rdoGroupCeramage"]').prop('checked', false);
    }else{
      $('#div-ceramage').hide();
      $('#div-screw').hide();
      $('input[name="rdoGroupCeramage"]').prop('checked', false);
      $('input[name="rdoGroupScrew"]').prop('checked', false);
    }
  });

  // MODEL
  $('input[name="rdoGroupModel"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoModelResin'){
      $('#div-model-resin').show();
      $('#rdoModelResin1').prop('checked', true);
    }else{
      $('#div-model-resin').hide();
      $('input[name="rdoModelResin"]').prop('checked', false);
    }
  });

  //CONTOUR AND OCCLUSAL DESIGN => OCCLUSION
  $('input[name="rdoOcclusion"]').change(function() {
    var id = $(this).attr('id');
    if(id=='rdoOcclusion2'){
      $('#div-under').show();
      $('#rdoUnder1').prop('checked', true);
    }else{
      $('#div-under').hide();
      $('input[name="rdoUnder"]').prop('checked', false);
    }
  });
</script>

@stop
