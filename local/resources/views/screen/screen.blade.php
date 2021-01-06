@extends('layouts.template')
@section('title', 'Screen')
@section('stylesheet')
<style>
    /* The container */

    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default radio button */

    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom radio button */

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */

    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */

    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */

    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */

    .container .checkmark:after {
        top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }

    /* Radio */

    .radio-toolbar {
        margin: 10px;
    }

    .radio-toolbar input[type=radio] {
        display: none;
    }

    input[type=radio]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }

    .radio-toolbar label {
        display: inline-block;
        background-color: #ddd;
        width: 45%;
        height: auto;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;
    }

    .radio-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbar input[type="radio"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }


    .radio-toolbar1 input[type=radio] {
        display: none;
    }
    .radio-toolbar1 label {
        /* display: inline-block; */
        background-color: #ddd;
        width: 20%;
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

    /* Radio SHADE */

    .radio-toolbarSHADE {
        margin: 0px;
    }

    .radio-toolbarSHADE input[type=radio] {
        display: none;
    }

    input[type=radio]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }

    .radio-toolbarSHADE label {
        display: inline-block;
        background-color: #ddd;
        width: 55px;
        height: 25px;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;
    }

    .radio-toolbarSHADE label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbarSHADE input[type="radio"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Radio SHADE */

    /* Check Box */

    .checkbox-toolbar {
        margin: 10px;
    }

    .checkbox-toolbar input[type="checkbox"] {
        display: none;
    }

    input[type="checkbox"]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }

    .checkbox-toolbar label {
        display: inline-block;
        background-color: #ddd;
        width: 23%;
        height: auto;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;
    }

    .checkbox-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar input[type="checkbox"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    .checkbox-toolbar2 label {
        display: inline-block;
        background-color: #ddd;
        width: 102%;
        height: 8%;
        padding: 10px;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;

    }

    .checkbox-toolbar2 label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar2 input[type="checkbox"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Check Box */

    /*Tooth*/

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

    polygon,
    path {
        -webkit-transition: fill .25s;
        transition: fill .25s;
    }

    polygon:hover,
    polygon:active,
    #tooth-polygon>path:hover,
    #tooth-polygon>path:active {
        fill: red !important;
        cursor: pointer;
    }

    /*End Tooth*/

    input[type=checkbox] {
        display: none;
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
        /*border:1px solid black;*/
    }

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

    .pontic {
        border: 0px dashed #444;
        width: 50px;
        height: 50px;
        transition: 500ms all;
    }

    .margin {
        border: 0px dashed #444;
        width: 50px;
        height: 50px;
        margin: 1px;
        transition: 500ms all;
    }

    /* Check Box */

    .checkbox-toolbar1 {
        margin: 5px;
    }

    .checkbox-toolbar1 input[type="checkbox"] {
        display: none;
    }

    .checkbox-toolbar1 label {
        display: inline-block;
        background-color: #ddd;
        width: 47%;
        height: auto;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;

    }

    .checkbox-toolbar1 label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar1 input[type="checkbox"]:checked+label {
        color: #fff;
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Check Box */
</style>
<style>
    .shot-padding{
        /* padding-left: 5px;
        padding-right: 5px; */
        padding: 5px;
    }
    .pointer{
      cursor:pointer;
    }
</style>
<script>
    function OnLoad(n){
            //$('.lbl_green_'+n).addClass('check');
            //document.getElementById('lbl_green_'+n).classList.toggle("check");
        // alert($('#lbl_green_'+n).length);
        setTimeout(function() {
            if($('#lbl_green_'+n).length){
                $(".img-tooth-"+n).addClass('img-tooth');
                $('#lbl_green_'+n).addClass('lbl_green_'+n);
                $('#lbl_green_'+n).addClass('select');
            }else{
                OnLoad(n);
            }
        }, 10);
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
<div class="content-wrapper">
  {{ Form::open(['method' => 'post' , 'url' => '/mainscreen/new_screen/save']) }}
    @php
        $count = 0;
    @endphp
    <div class="row" id="stepApp">
      <div class="col-12 grid-margin stretch-card">
        <input type="hidden" name="ID_order_screen" value="{{ $id }}">
        @foreach($teeth as $out_teeth)
            @if($out_teeth->status != '1')
                @php
                    $count = $count+1;
                @endphp
            @endif
        @endforeach
        {{-- 1 --}}
        <div class="card">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                  <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลทั่วไป</li>
              </ol>
          </nav>
          @foreach($order as $out_order)
            <div class="card-body pt-0">
              <div class="form-group row">
                  <label class="col-form-label col-sm-1">ท.พ./ท.ญ.</label>
                  <div class="col-sm-3">
                      <div class="input-group">
                          {{ Form::text('doctor',$out_order->doctor, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล','readonly']) }}
                      </div>
                  </div>
                  <label class="col-form-label col-sm-1">เบอร์โทร</label>
                  <div class="col-sm-2">
                      <div class="input-group">
                          {{ Form::number('phone',$out_order->phone, ['class' => 'form-control','placeholder' => 'เบอร์โทร1']) }}
                      </div>
                  </div>
                  <label class="col-form-label col-sm-2">Address/Email/line</label>
                  <div class="col-sm-3">
                      <div class="input-group">
                          {{ Form::text('Address',$out_order->Address, ['class' => 'form-control','placeholder' => 'Address/Email/line']) }}
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-form-label col-sm-1">ร.พ./คลีนิค</label>
                  <div class="col-sm-3">
                      <div class="input-group">
                          {{ Form::text('customer',$out_order->customer, ['class' => 'form-control','placeholder' => 'ร.พ./คลีนิค','readonly']) }}
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-form-label col-sm-1">คนไข้</label>
                  <div class="col-sm-3">
                      <div class="input-group">
                          {{ Form::text('PatientName',$out_order->PatientName, ['class' => 'form-control','placeholder' => 'คนไข้']) }}
                      </div>
                  </div>
                  <label class="col-form-label col-sm-1">HN</label>
                  <div class="col-sm-2">
                      <div class="input-group">
                          {{ Form::text('PatientHN',$out_order->PatientHN, ['class' => 'form-control','placeholder' => 'HN']) }}
                      </div>
                  </div>
                  <label class="col-form-label col-sm-1">อายุ</label>
                  <div class="col-sm-2">
                      <div class="input-group">
                          {{ Form::text('PatientAge',$out_order->PatientAge, ['class' => 'form-control','placeholder' => 'อายุ','min'=>"1",'max'=>"99" ,'onKeyPress'=>'if(this.value.length==2) return false;']) }}
                      </div>
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
                  <label class="col-form-label col-sm-1">เพศ</label>
                  <div class="col-sm-1">
                      <div class="input-group">
                          {{ Form::text('sex',$sex, ['class' => 'form-control','placeholder' => 'เพศ','readonly']) }}
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-form-label col-sm-1">วันที่รับ</label>
                  <div class="col-sm-2">
                      <div class="input-group">
                          {{ Form::text('StartDate',$out_order->StartDate, ['ID'=>'startdate','data-date-format'=>'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันที่รับ']) }}
                      </div>
                  </div>
                  <label class="col-form-label col-sm-1">เวลา</label>
                  <div class="col-sm-2">
                      <div class="input-group">
                          {{ Form::text('time',null, ['class' => 'form-control','placeholder' => 'เวลา','readonly']) }}
                      </div>
                  </div>
                  <label class="col-form-label col-sm-1">วันนัดจริง</label>
                  <div class="col-sm-2">
                      <div class="input-group">
                          {{ Form::text('Datefinal',$out_order->Datefinal, ['ID'=>'datefinal','data-date-format'=>'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันที่รับ']) }}
                      </div>
                  </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-sm-1">วันที่ส่ง</label>
                <div class="col-sm-2">
                    <div class="input-group">
                        {{ Form::text('DeliverDate',$out_order->DeliverDate, ['ID'=>'enddate','data-date-format'=>'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันที่ส่ง']) }}
                    </div>
                </div>
                <label class="col-form-label col-sm-1">เวลา</label>
                <div class="col-sm-2">
                    <div class="input-group">
                        {{ Form::time('ReceptionTime',$out_order->ReceptionTime, ['ID'=>'time1','class' => 'form-control','placeholder' => 'เวลา']) }}
                    </div>
                </div>
                <label class="col-form-label col-sm-1">รอบผลิต</label>
                <div class="col-sm-5">
                    <div class="">
                      {{-- <select class="form-control" id="processround" name="processround">
                          <option value="{{ $out_order->processroundID }}">{{ $out_order->production_cycle_order }}</option>
                          @foreach ( $processround as $out_processround)
                              @if($out_processround->ID != $out_order->processroundID )
                                  <option value="{{ $out_processround->ID }}">{{ $out_processround->production_cycle }}</option>
                              @endif
                          @endforeach
                      </select> --}}

                      <div class="radio-toolbar1 text-center justify-content-center-">
                        {{-- <div class="row" style="over-flow:auto;"> --}}
                        @foreach ( $processround as $out_processround)
                          @if($out_processround->ID == $out_order->processroundID )
                              <input type="radio" id="{{ $out_processround->ID }}" name="processround" value="{{ $out_processround->ID }}" checked>
                          @else
                              <input type="radio" id="{{ $out_processround->ID }}" name="processround" value="{{ $out_processround->ID }}">
                          @endif

                          <label for="{{ $out_processround->ID }}" style="cursor:pointer;">{{ $out_processround->production_cycle }}</label>
                        @endforeach
                        {{-- </div> --}}
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      @if( $count != 0)
        <div class="col-6 grid-margin stretch-card">
            {{-- 4 --}}
            <div class="card">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                      <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือกซี่ฟัน</li>
                  </ol>
                </nav>
                <div class="card-body pt-0">
                        <table class="tbl-tooth" height="10">
                                <tr>
                                    <td class="text-center">
                                        <h5>UR (1)</h5>
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_12" style="margin-top:30px;margin-right:2px;">
                                            <img src="{{ asset('./images/tooth3color/12.png') }}" class="img-tooth img-tooth-12" id="img-tooth-12" onclick="check(12)" >
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_11" style="margin-right:2px;">
                                            <img src="{{ asset('./images/tooth3color/11.png') }}" class="img-tooth img-tooth-11" id="img-tooth-11" onclick="check(11)">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_21" style="margin-left:2px;">
                                            <img  src="{{ asset('./images/tooth3color/21.png') }}" class="img-tooth img-tooth-21" id="img-tooth-21" onclick="check(21)">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_22" style="margin-top:30px;margin-left:2px;">
                                            <img src="{{ asset('./images/tooth3color/22.png') }}" class="img-tooth img-tooth-22" id="img-tooth-22" onclick="check(22)">
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
                                            <img src="{{ asset('./images/tooth3color/13.png') }}" class="img-tooth img-tooth img-tooth-13" id="img-tooth-13" onclick="check(13)">
                                        </label>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_23" style="margin-right:55px;margin-top:-15px;">
                                            <img src="{{ asset('./images/tooth3color/23.png') }}" class="img-tooth img-tooth-23" id="img-tooth-23" onclick="check(23)">
                                        </label>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_14" style="margin-right:-10px; margin-top:-5px;">
                                            <img src="{{ asset('./images/tooth3color/14.png') }}" class="img-tooth img-tooth-14" id="img-tooth-14" onclick="check(14)">
                                        </label>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_24" style="margin-left:-10px; margin-top:-5px;">
                                            <img src="{{ asset('./images/tooth3color/24.png') }}" class="img-tooth img-tooth-24" id="img-tooth-24" onclick="check(24)">
                                        </label>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_15" style="margin-right:-110px;margin-top:-5px;">
                                            <img src="{{ asset('./images/tooth3color/15.png') }}" class="img-tooth img-tooth-15" id="img-tooth-15" onclick="check(15)" >
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
                                            <img src="{{ asset('./images/tooth3color/25.png') }}" class="img-tooth img-tooth-25" id="img-tooth-25" onclick="check(25)" >
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_16" style="margin-right:-90px;margin-top:-5px;">
                                            <img src="{{ asset('./images/tooth3color/16.png') }}" class="img-tooth img-tooth-16" id="img-tooth-16" onclick="check(16)">
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
                                            <img src="{{ asset('./images/tooth3color/26.png') }}" class="img-tooth img-tooth-26" id="img-tooth-26" onclick="check(26)">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_17" style="margin-right:-80px;margin-top:-5px;">
                                            <img src="{{ asset('./images/tooth3color/17.png') }}" class="img-tooth img-tooth-17" id="img-tooth-17" onclick="check(17)">
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
                                            <img src="{{ asset('./images/tooth3color/27.png') }}" class="img-tooth img-tooth-27" id="img-tooth-27" onclick="check(27)">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_18" style="margin-right:-70px;margin-top:-10px;">
                                            <img src="{{ asset('./images/tooth3color/18.png') }}" class="img-tooth img-tooth-18" id="img-tooth-18" onclick="check(18)">
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
                                            <img src="{{ asset('./images/tooth3color/28.png') }}" class="img-tooth img-tooth-28" id="img-tooth-28" onclick="check(28)">
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
                                            <img src="{{ asset('./images/tooth3color/48.png') }}" class="img-tooth img-tooth-48" id="img-tooth-48" onclick="check(48)">
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
                                            <img src="{{ asset('./images/tooth3color/38.png') }}" class="img-tooth img-tooth-38" id="img-tooth-38" onclick="check(38)">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_47" style="margin-right:-80px;margin-bottom:0px;">
                                            <img src="{{ asset('./images/tooth3color/47.png') }}" class="img-tooth img-tooth-47" id="img-tooth-47" onclick="check(47)">
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
                                            <img src="{{ asset('./images/tooth3color/37.png') }}" class="img-tooth img-tooth-37" id="img-tooth-37" onclick="check(37)">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_46" style="margin-right:-90px;margin-bottom:0px;">
                                            <img src="{{ asset('./images/tooth3color/46.png') }}" class="img-tooth img-tooth-46" id="img-tooth-46" onclick="check(46)">
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
                                            <img src="{{ asset('./images/tooth3color/36.png') }}" class="img-tooth img-tooth-36" id="img-tooth-36" onclick="check(36)">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_45" style="margin-right:-110px;margin-bottom:-0px;">
                                            <img src="{{ asset('./images/tooth3color/45.png') }}" class="img-tooth img-tooth-45" id="img-tooth-45" onclick="check(45)">
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
                                            <img src="{{ asset('./images/tooth3color/35.png') }}" class="img-tooth img-tooth-35" id="img-tooth-35" onclick="check(35)">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_44" style="margin-right:-140px;margin-bottom:-0px;">
                                            <img src="{{ asset('./images/tooth3color/44.png') }}" class="img-tooth img-tooth-44" id="img-tooth-44" onclick="check(44)">
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
                                            <img src="{{ asset('./images/tooth3color/34.png') }}" class="img-tooth img-tooth-34" id="img-tooth-34" onclick="check(34)">
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_43" style="margin-left:55px;margin-bottom:-0px;">
                                            <img src="{{ asset('./images/tooth3color/43.png') }}" class="img-tooth img-tooth-43" id="img-tooth-43" onclick="check(43)">
                                        </label>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_33" style="margin-right:55px;margin-bottom:-0px;">
                                            <img src="{{ asset('./images/tooth3color/33.png') }}" class="img-tooth img-tooth-33" id="img-tooth-33" onclick="check(33)">
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
                                            <img src="{{ asset('./images/tooth3color/42.png') }}" class="img-tooth img-tooth-42" id="img-tooth-42" onclick="check(42)">
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="lbl" id="lbl_green_41" style="margin-right:2px;">
                                            <img src="{{ asset('./images/tooth3color/41.png') }}" class="img-tooth img-tooth-41" id="img-tooth-41" onclick="check(41)">
                                        </label>
                                    </td>
                                    <td>
                                        <label class="lbl" id="lbl_green_31" style="margin-left:2px;">
                                            <img src="{{ asset('./images/tooth3color/31.png') }}" class="img-tooth img-tooth-31" id="img-tooth-31" onclick="check(31)">
                                        </label>
                                    </td>
                                    <td>
                                        <label class="lbl" id="lbl_green_32" style="margin-bottom:50px;margin-left:2px;">
                                            <img src="{{ asset('./images/tooth3color/32.png') }}" class="img-tooth img-tooth-32" id="img-tooth-32" onclick="check(32)">
                                        </label>
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <h5>LL (3)</h5>
                                    </td>
                                </tr>
                            </table>
                </div>
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
            </div>
        </div>

        <div class="col-6 grid-margin stretch-card">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;รายละเอียดซี่ฟัน</li>
                    </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ซี่ฟัน</th>
                                        <th>กลุ่มสินค้า</th>
                                        <th>สินค้า</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_teeth_screen as $teeth_screen)
                                        @if($teeth_screen->status == '1')
                                            <tr style="background-color: #4CAF50;color: white;">
                                                <td>{{ $teeth_screen->teeth_name }}</td>
                                                <td>{{ $teeth_screen->work_group }}</td>
                                                <td>{{ $teeth_screen->work_type }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $teeth_screen->teeth_name }}</td>
                                                <td>{{ $teeth_screen->work_group }}</td>
                                                <td>{{ $teeth_screen->work_type }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>

        {{-- 4 --}}
        <div class="col-4 grid-margin stretch-card shot-padding">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;ALLOYS</li>
                    </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;">
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            <input type="radio" id="radioNON_PRECIOUS" name="Metal_type" value="NON_PRECIOUS" onclick="myFunctions()">
                            <label for="radioNON_PRECIOUS" style="cursor:pointer;">NON PRECIOUS</label>
                            <input type="radio" id="radioPALLADIUM" name="Metal_type" value="PALLADIUM">
                            <label for="radioPALLADIUM" style="cursor:pointer;">PALLADIUM </label>
                            <input type="radio" id="radioSEMI_PRECIOUS" name="Metal_type" value="SEMI_PRECIOUS">
                            <label for="radioSEMI_PRECIOUS" style="cursor:pointer;">SEMI PRECIOUS</label>
                            <input type="radio" id="radioHIGH_PRECIOUS" name="Metal_type" value="HIGH_PRECIOUS">
                            <label for="radioHIGH_PRECIOUS" style="cursor:pointer;"> HIGH PRECIOUS </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_emax_color">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_Metal_type',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>

        {{-- 5 --}}
        <div class="col-4 grid-margin stretch-card shot-padding">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;SHADE</li>
                        </ol>
                    </nav>
                    <div class="card-body pt-0" style="padding: 10px;">
                            <div class="radio-toolbar text-center justify-content-center">
                                    <div class="row" style="over-flow:auto;">
                                        <input type="radio" id="radioOne" name="type" value="One" onclick="ShadeFunction()" checked>
                                        <label for="radioOne" style="cursor:pointer;" checked>สีเดียว</label>

                                        <input type="radio" id="radiomulti" name="type" value="Various" onclick="ShadeFunction()">
                                        <label for="radiomulti" style="cursor:pointer;">หลายสี</label>
                                    </div>
                                </div>

                                <div class="card" id="CardOneColor">
                                        <br>
                                        <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือกสีเดียว</li>
                                                </ol>
                                            </nav>
                                        <div>
                                            <div class="radio-toolbar text-center justify-content-center">
                                                <div class="row" style="over-flow:auto;">
                                                    <input type="radio" id="radioVITA_AD" name="one_color" value="VITA AD" onclick="ShadeFunction()">
                                                    <label for="radioVITA_AD" style="cursor:pointer;">VITA AD</label>

                                                    <input type="radio" id="radioVITA_3D" name="one_color" value="VITA 3D" onclick="ShadeFunction()">
                                                    <label for="radioVITA_3D" style="cursor:pointer;">VITA 3D</label>

                                                    <input type="radio" id="radioSHOFU" name="one_color" value="SHOFU" onclick="ShadeFunction()">
                                                    <label for="radioSHOFU" style="cursor:pointer;">SHOFU</label>

                                                    <input type="radio" id="radioCHOMASCOP" name="one_color" value="CHOMASCOP" onclick="ShadeFunction()">
                                                    <label for="radioCHOMASCOP" style="cursor:pointer;">CHOMASCOP</label>

                                                    <input type="radio" id="radioAnother" name="one_color" value="อื่นๆ" onclick="ShadeFunction()">
                                                    <label for="radioAnother" style="cursor:pointer;">อื่นๆ</label>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="card" id="CardChooseColor" style="display:none;">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                        <a>
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>เลือกสี
                                        </a>
                                    </div>
                                    <div>
                                        <div class="card-body pt-0 text-center">
                                            <div class="radio-toolbarSHADE text-center justify-content-center">
                                                <div class="row" style="over-flow:auto;">
                                                    <div class="col-2">
                                                        <input type="radio" id="radio1A1" name="one_color_Combobox" value="A1">
                                                        <label for="radio1A1" style="cursor:pointer;">A1</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" id="radio1A2" name="one_color_Combobox" value="A2">
                                                        <label for="radio1A2" style="cursor:pointer;">A2</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" id="radio1A3" name="one_color_Combobox" value="A3">
                                                        <label for="radio1A3" style="cursor:pointer;">A3</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" id="radio1B1" name="one_color_Combobox" value="B1">
                                                        <label for="radio1B1" style="cursor:pointer;">B1</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" id="radio1B2" name="one_color_Combobox" value="B2">
                                                        <label for="radio1B2" style="cursor:pointer;">B2</label>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="radio" id="radio1B3" name="one_color_Combobox" value="B3">
                                                        <label for="radio1B3" style="cursor:pointer;">B3</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="CardAnotherColor" style="display:none;">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                        <a>
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>อื่นๆ
                                        </a>
                                    </div>
                                    <div>
                                        <div class="card-body pt-0 text-center">
                                            <div class="radio-toolbar text-center justify-content-center">
                                                <div class="row">
                                                    <h4 class="col-sm-4 col-form-label">ระบุยี่ห้อ:</h4>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="brand" name="one_color_branch" class="form-control" />
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <h4 class="col-sm-4 col-form-label">ระบุสี:</h4>
                                                    <div class="col-sm-8">
                                                        <input type="text" id="color" name="one_color_branch_color" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card" id="CardMultiColor" style="display:none;">
                                    <br>
                                        <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือกหลายสี</li>
                                                </ol>
                                            </nav>
                                    <div>
                                        <div class="card-body pt-0 text-center">
                                            <div class="radio-toolbar text-center justify-content-center">
                                                <div class="row">
                                                    <h4 class="col-sm-4 col-form-label">คอฟัน:</h4>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" type="text" id="shade_many1" name="many_branch_crowns" placeholder="ยี่ห้อ">                                                                                    &nbsp;
                                                        <input class="form-control" type="text" id="color1" name="many_color_crowns" placeholder="สี">
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <h4 class="col-sm-4 col-form-label">กลางฟัน:</h4>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" type="text" id="shade_many2" name="many_branch_Middle" placeholder="ยี่ห้อ">                                                                                    &nbsp;
                                                        <input class="form-control" type="text" id="color2" name="many_color_Middle" placeholder="สี">
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <h4 class="col-sm-4 col-form-label">ปลายฟัน:</h4>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" type="text" id="shade_many3" name="many_branch_tip" placeholder="ยี่ห้อ">                                                                                    &nbsp;
                                                        <input class="form-control" type="text" id="color3" name="many_color_tip" placeholder="สี">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-3" for="comment_shade">รอถามแพทย์</label>
                                    <div class="col-sm-8">
                                            {{ Form::textarea('comment_shade',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                                    </div>
                                </div>
                    </div>
                </div>
            </div>


        <div class="col-4">
          <div class="row stretch-card">
            <div class="col-12 shot-padding">
              <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;OCCLUSAL STAINING</li>
                    </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;">
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            <input type="radio" id="radioNONE" name="OCCLUSAL_STAINING" value="NONE">
                            <label for="radioNONE" style="cursor:pointer;">NONE</label>
                            <input type="radio" id="radioLIGHT" name="OCCLUSAL_STAINING" value="LIGHT">
                            <label for="radioLIGHT" style="cursor:pointer;">LIGHT </label>
                            <input type="radio" id="radioMEDIUM" name="OCCLUSAL_STAINING" value="MEDIUM">
                            <label for="radioMEDIUM" style="cursor:pointer;">MEDIUM</label>
                            <input type="radio" id="radioDARK" name="OCCLUSAL_STAINING" value="DARk">
                            <label for="radioDARK" style="cursor:pointer;"> DARK </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_occlusal_staining">รอถามแพทย์</label>
                            <div class="col-sm-8">
                                {{ Form::textarea('comment_occlusal_staining',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"3"]) }}
                            </div>
                    </div>
                </div>
              </div>
            </div>

            {{-- 6 --}}
            <div class="col-12 shot-padding">
              <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;COLOR</li>
                    </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;" >

                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            <input type="radio" id="color_STUMP" name="color" value="STUMP">
                            <label for="color_STUMP" style="cursor:pointer;">สี STUMP</label>
                            <input type="radio" id="color_INGOT" name="color" value="INGOT">
                            <label for="color_INGOT" style="cursor:pointer;">สี INGOT </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_emax_color">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_emax_color',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"3"]) }}
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>





        <div class="col-6">
          <div class="row stretch-card">
            <div class="col-12 shot-padding">
              <div class="card">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;PONTIC</li>
                  </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;" >
                  <div class="row" style="over-flow:auto;">
                    <div class="col-12">
                          <input class="input-hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC1" value="1.png" />
                          <label for="PONTIC1" class="pointer m-2">
                              <img class="pontic" src="{{ asset('images/pontic-design/1.png') }}" alt="I'm sad"/>
                          </label>

                          <input class="input-hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC2" value="2.png" />
                          <label for="PONTIC2" class="pointer m-2">
                              <img class="pontic" src="{{ asset('images/pontic-design/2.png') }}" alt="I'm sad" />
                          </label>

                          <input class="input-hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC4" value="3.png" checked/>
                          <label for="PONTIC4" class="pointer m-2">
                              <img class="pontic" src="{{ asset('images/pontic-design/3.png') }}"  alt="I'm sad" />
                          </label>

                          <input class="input-hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC5" value="4.png" />
                          <label for="PONTIC5" class="pointer m-2">
                              <img class="pontic" src="{{ asset('images/pontic-design/4.png') }}"   alt="I'm sad" />
                          </label>
                          <input class="input-hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC6" value="5.png" />
                          <label for="PONTIC6" class="pointer m-2">
                              <img class="pontic" src="{{ asset('images/pontic-design/5.png') }}"   alt="I'm sad" />
                          </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 grid-margin stretch-card shot-padding">
              <div class="card">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;MARGIN AND MENTAL DESIGN</li>
                  </ol>
                </nav>
                <div class="card-body pt-0" style="padding:10px;">
                  <div class="row" style="over-flow:auto;">
                    <div class="col-12">
                         <input type="checkbox" name="MARGIN1" id="MARGIN1" class="input-hidden" value="11.png" />
                         <label for="MARGIN1" class="pointer m-2 text-center">
                             <img class="pontic" src="{{ asset('images/mental-design/11.png') }}" alt="I'm sad" />
                             <br>Porcelain
                         </label>
                        <input type="checkbox" name="MARGIN1" id="MARGIN2" class="input-hidden" value="12.png" />
                        <label for="MARGIN2" class="pointer m-2 text-center">
                            <img class="pontic" src="{{ asset('images/mental-design/12.png') }}" alt="I'm sad" />
                            <br>Extended
                        </label>

                         <input type="checkbox" name="MARGIN1" id="MARGIN3" class="input-hidden" value="13.png" checked/>
                         <label for="MARGIN3" class="pointer m-2 text-center">
                             <img class="pontic" src="{{ asset('images/mental-design/13.png') }}" alt="I'm sad" />
                             <br>Extended
                          </label>

                        <input type="checkbox" name="MARGIN1" id="MARGIN4" class="input-hidden" value="14.png" />
                        <label for="MARGIN4" class="pointer m-2 text-center">
                            <img class="pontic" src="{{ asset('images/mental-design/14.png') }}" alt="I'm sad" />
                            <br>Matal
                        </label>

                    </div>

                    <div class="col-12 mt-4">
                             <input type="checkbox" name="MARGIN2" id="sad4" class="input-hidden" value="21.png" />
                             <label for="sad4" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/21.png') }}" alt="I'm sad" />
                             </label>
                             <input type="checkbox" name="MARGIN2" id="sad5" class="input-hidden" value="22.png" checked/>
                             <label for="sad5" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/22.png') }}" alt="I'm sad" />
                             </label>
                             <input type="checkbox" name="MARGIN2" id="sad6" class="input-hidden" value="23.png" />
                             <label for="sad6" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/23.png') }}" alt="I'm sad" />
                             </label>
                              <input type="checkbox" name="MARGIN2" id="sad7" class="input-hidden" value="24.png" />
                              <label for="sad7" class="pointer m-2">
                                  <img class="pontic" src="{{ asset('images/mental-design/24.png') }}" alt="I'm sad" />
                              </label>
                              <input type="checkbox" name="MARGIN2" id="sad8" class="input-hidden" value="25.png" />
                              <label for="sad8" class="pointer m-2">
                                  <img class="pontic" src="{{ asset('images/mental-design/25.png') }}" alt="I'm sad" />
                              </label>
                              <input type="checkbox" name="MARGIN2" id="sad9" class="input-hidden" value="26.png" />
                              <label for="sad9" class="pointer m-2">
                                  <img class="pontic" src="{{ asset('images/mental-design/26.png') }}" alt="I'm sad" />
                              </label>
                              <input type="checkbox" name="MARGIN2" id="sad10" class="input-hidden" value="27.png" />
                              <label for="sad10" class="pointer m-2">
                                  <img class="pontic" src="{{ asset('images/mental-design/27.png') }}" alt="I'm sad" />
                              </label>

                    </div>

                    <div class="col-12 mt-4">
                             <input type="checkbox" name="MARGIN3" id="sad11" class="input-hidden" value="31.png" />
                             <label for="sad11" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/31.png') }}" alt="I'm sad" />
                             </label>
                             <input type="checkbox" name="MARGIN3" id="sad12" class="input-hidden" value="32.png" checked/>
                             <label for="sad12" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/32.png') }}" alt="I'm sad" />
                             </label>
                             <input type="checkbox" name="MARGIN3" id="sad13" class="input-hidden" value="33.png" />
                             <label for="sad13" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/33.png') }}" alt="I'm sad" />
                             </label>
                             <input type="checkbox" name="MARGIN3" id="sad14" class="input-hidden" value="34.png" />
                             <label for="sad14" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/34.png') }}" alt="I'm sad" />
                             </label>
                             <input type="checkbox" name="MARGIN3" id="sad15" class="input-hidden" value="35.png" />
                             <label for="sad15" class="pointer m-2">
                                 <img class="pontic" src="{{ asset('images/mental-design/35.png') }}" alt="I'm sad" />
                             </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-3 grid-margin stretch-card shot-padding">
         <div class="card">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;CONTOUR AND OCCLUSION DESIGN</li>
                </ol>
            </nav>
             <div class="card-body pt-0" style="padding:10px;">
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                         <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;GINGIVAL EMBRASURES</li>
                     </ol>
                 </nav>
                 <div class="radio-toolbar text-center">
                     <div class="row" style="over-flow:auto;">
                         <input type="radio" id="radioOPEN" name="CONTOUR" value="OPEN">
                         <label for="radioOPEN" style="cursor:pointer;">เปิด</label>
                         <input type="radio" id="radioCLOSE" name="CONTOUR" value="CLOSE">
                         <label for="radioCLOSE" style="cursor:pointer;">ปิด </label>
                     </div>
                 </div>

                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                         <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;OCCLUSION</li>
                     </ol>
                 </nav>
                 <div class="radio-toolbar text-center">
                     <div class="row" style="over-flow:auto;">
                         <input type="radio" id="radiosomsanit" name="CONTOUR" value="สบสนิท" onclick="ContourFunction()">
                         <label for="radiosomsanit" style="cursor:pointer;">สบสนิท</label>
                         <input type="radio" id="radioUNDER" name="CONTOUR" value="UNDER" onclick="ContourFunction()">
                         <label for="radioUNDER" style="cursor:pointer;">UNDER </label>
                     </div>
                 </div>

                 {{-- style="display:none;" --}}
                 <div class="row" id="undercut">
                     <div class="col col-sm-11">
                         {{-- <div class="radio-toolbar text-center justify-content-center">
                             <select class="form-control" name="unit_CONTOUR" id="unit_CONTOUR">
                                 <option value="non_unit_CONTOUR">เลือกหน่วย</option>
                                 <option value="0.3">0.3</option>
                                 <option value="0.5">0.5</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                             </select>
                         </div> --}}

                         <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    <input type="radio" id="unit_CONTOUR0.3" name="unit_CONTOUR" value="0.3">
                                    <label for="unit_CONTOUR0.3" style="cursor:pointer;">0.3</label>

                                    <input type="radio" id="unit_CONTOUR0.5" name="unit_CONTOUR" value="0.5">
                                    <label for="unit_CONTOUR0.5" style="cursor:pointer;">0.5</label>

                                    <input type="radio" id="unit_CONTOUR1" name="unit_CONTOUR" value="1">
                                    <label for="unit_CONTOUR1" style="cursor:pointer;">1</label>

                                    <input type="radio" id="unit_CONTOUR2" name="unit_CONTOUR" value="2">
                                    <label for="unit_CONTOUR2" style="cursor:pointer;">2</label>

                                    <input type="radio" id="unit_CONTOUR3" name="unit_CONTOUR" value="3">
                                    <label for="unit_CONTOUR3" style="cursor:pointer;">3</label>
                                </div>
                            </div>
                     </div>
                 </div>

                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                         <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;CONTACT</li>
                     </ol>
                 </nav>
                 <div class="radio-toolbar text-center">
                     <div class="row" style="over-flow:auto;">
                         <input type="radio" id="radioAREA" name="CONTOUR" value="AREA">
                         <label for="radioAREA" style="cursor:pointer;">AREA</label>
                         <input type="radio" id="radioPOINT" name="CONTOUR" value="POINT">
                         <label for="radioPOINT" style="cursor:pointer;">POINT </label>
                     </div>
                 </div>
                 <br>
                 <br>
                     <br>
                     <div class="form-group row">
                         <label class="col-form-label col-sm-3" for="comment_contour">รอถามแพทย์</label>
                         <div class="col-sm-8">
                                 {{ Form::textarea('comment_contour',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                         </div>
                     </div>
                     <br>
             </div>
         </div>
        </div>

        {{-- 9 --}}
        <div class="col-3 grid-margin stretch-card shot-padding">
            <div class="card">
                <nav aria-label="breadcrumb">
                   <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                       <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;รับตะขอ</li>
                   </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;">
                            <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    <input type="radio" name="Hook" id="chkPassport" value="have" onclick="HookFunction()" >
                                    <label for="chkPassport" style="cursor:pointer;" checked>มี Rest</label>

                                    <input type="radio" name="Hook" id="nochkPassport" value="don't have" onclick="HookFunction()"checked>
                                    <label for="nochkPassport" style="cursor:pointer;">ไม่มี Rest </label>
                                </div>
                            </div>

                            <div id="OptionHook"  style="display:none;">
                                <br>
                                    <!-- <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;HOOK TYPE</li>
                                            </ol>
                                        </nav> -->
                                            <div class="checkbox-toolbar1 text-center justify-content-center">
                                                <div class="row">
                                                    <input type="checkbox" id="checkboxMESIAL_REST" name="MESIAL_REST" value="MESIAL_REST">
                                                    <label for="checkboxMESIAL_REST" style="cursor:pointer;">MESIAL REST</label>

                                                    <input type="checkbox" id="checkboxDISTAL_REST" name="DISTAL_REST" value="DISTAL_REST">
                                                    <label for="checkboxDISTAL_REST" style="cursor:pointer;">DISTAL REST</label>

                                                    <input type="checkbox" id="checkboxCINGULUM_REST" name="CINGULUM_REST" value="CINGULUM_REST">
                                                    <label for="checkboxCINGULUM_REST" style="cursor:pointer;">CINGULUM REST</label>

                                                    <input type="checkbox" id="checkboxLINGUAL_LEDGE" name="LINGUAL_LEDGE" value="LINGUAL_LEDGE">
                                                    <label for="checkboxLINGUAL_LEDGE" style="cursor:pointer;">LINGUAL LEDGE</label>

                                                    <input type="checkbox" id="checkboxEMBRESSURE_REST" name="EMBRESSURE_REST" value="EMBRESSURE_REST">
                                                    <label for="checkboxEMBRESSURE_REST" style="cursor:pointer;">EMBRESSURE REST</label>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <h4 class="col-sm-4 col-form-label">อื่นๆ</h4>
                                                <div class="col-sm-8">
                                                    <input type="text" id="another" name="other_hook" class="form-control" placeholder="รายละเอียดอื่นๆ" />
                                                </div>
                                            </div> -->

                                                    <br>
                                                    <nav aria-label="breadcrumb">
                                                            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                                <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;UNDERCUT</li>
                                                            </ol>
                                                    </nav>

                                                    <div class="radio-toolbar text-center justify-content-center">
                                                        <div class="row" style="over-flow:auto;">
                                                            <input type="radio" name="undercut" id="haveundercut" value="have" onclick="UndercutFunction()" >
                                                            <label for="haveundercut" style="cursor:pointer;" checked>มี UNDERCUT</label>

                                                            <input type="radio" name="undercut" id="nohaveundercut" value="don't have" onclick="UndercutFunction()"checked>
                                                            <label for="nohaveundercut" style="cursor:pointer;">ไม่มี UNDERCUT</label>
                                                        </div>
                                                    </div>
                                                    <div id="OptionUnit_hook"  style="display:none;">
                                                        <br>
                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                <div class="row" style="over-flow:auto;">
                                                                    <input type="radio" id="undercut_hook0.01" name="undercut_hook" value="0.01">
                                                                    <label for="undercut_hook0.01" style="cursor:pointer;">UNDERCUT 0.01</label>

                                                                    <input type="radio" id="undercut_hook0.02" name="undercut_hook" value="0.02">
                                                                    <label for="undercut_hook0.02" style="cursor:pointer;">UNDERCUT 0.02</label>

                                                                    <input type="radio" id="undercut_hook0.03" name="undercut_hook" value="0.03">
                                                                    <label for="undercut_hook0.03" style="cursor:pointer;">UNDERCUT 0.03</label>
                                                                </div>
                                                            </div>
                                                        <br>
                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                <div class="row" style="over-flow:auto;">
                                                                    <input type="radio" id="unit_hookMB" name="unit_hook" value="MB">
                                                                    <label for="unit_hookMB" style="cursor:pointer;">MB</label>

                                                                    <input type="radio" id="unit_hookDB" name="unit_hook" value="DB">
                                                                    <label for="unit_hookDB" style="cursor:pointer;">DB</label>

                                                                    <input type="radio" id="unit_hookML" name="unit_hook" value="ML">
                                                                    <label for="unit_hookML" style="cursor:pointer;">ML</label>

                                                                    <input type="radio" id="unit_hookB" name="unit_hook" value="B">
                                                                    <label for="unit_hookB" style="cursor:pointer;">B</label>

                                                                    <input type="radio" id="unit_hookMBDB" name="unit_hook" value="MBDB">
                                                                    <label for="unit_hookMBDB" style="cursor:pointer;">MBDB</label>
                                                                </div>
                                                        </div>
                                                    </div>

                            </div>

                    <br>
                    <!-- <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_hook">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_hook',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        {{-- 10 --}}
        <div class="col-3 grid-margin stretch-card shot-padding">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;IMPLANT</li>
                    </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;">
                    {{-- <div class="checkbox-toolbar1 text-center">
                        <div class="row" style="over-flow:auto;">
                                <input type="checkbox" id="IMP1" name="IMP1" value="IMPRESSION">
                                <label for="IMP1" style="cursor:pointer;">IMPRESSION</label>

                                <input type="checkbox" id="IMP2" name="IMP2" value="IMPRESSION CAP">
                                <label for="IMP2" style="cursor:pointer;">IMPRESSION CAP</label>

                                <input type="checkbox" id="IMP3" name="IMP3" value="SCREW">
                                <label for="IMP3" style="cursor:pointer;">SCREW</label>

                                <input type="checkbox" id="IMP4" name="IMP4" value="ANALOG">
                                <label for="IMP4" style="cursor:pointer;">ANALOG</label>

                                <input type="checkbox" id="IMP5" name="IMP5" value="ABUTMENT">
                                <label for="IMP5" style="cursor:pointer;">ABUTMENT</label>

                                <input type="checkbox" id="IMP6" name="IMP6" value="SCREW DRIVER">
                                <label for="IMP6" style="cursor:pointer;">SCREW DRIVER</label>
                        </div>
                    </div> --}}
                    <div class="radio-toolbar text-center">
                            <div class="row" style="over-flow:auto;">
                                <input type="radio" id="IMPLANT1" name="implant" value="E.MAX" onclick="CERAMAGEFunctions()">
                                <label for="IMPLANT1" style="cursor:pointer;">E.MAX</label>
                                <input type="radio" id="IMPLANT2" name="implant" value="ZIRCONIA" onclick="CERAMAGEFunctions()">
                                <label for="IMPLANT2" style="cursor:pointer;">ZIRCONIA</label>
                                <input type="radio" id="IMPLANT3" name="implant" value="CERAMAGE" onclick="CERAMAGEFunctions()">
                                <label for="IMPLANT3" style="cursor:pointer;">CERAMAGE</label>
                                <input type="radio" id="IMPLANT4" name="implant" value="Cement-retained" onclick="CERAMAGEFunctions()">
                                <label for="IMPLANT4" style="cursor:pointer;">Cement-retained</label>
                                <input type="radio" id="IMPLANT5" name="implant" value="Screw-retained" onclick="CERAMAGEFunctions()">
                                <label for="IMPLANT5" style="cursor:pointer;">Screw-retained</label>
                                <input type="radio" id="IMPLANT6" name="implant" value="สกรูที่หมอส่งมา" onclick="CERAMAGEFunctions()">
                                <label for="IMPLANT6" style="cursor:pointer;">สกรูที่หมอส่งมา</label>
                                <input type="radio" id="IMPLANT7" name="implant" value="ให้แลป FIX CEMENT ด้วย" onclick="CERAMAGEFunctions()">
                                <label for="IMPLANT7" style="cursor:pointer;">ให้แลป FIX CEMENT ด้วย</label>
                            </div>
                        </div>

                        <div id="CardCERAMAGE" style="display:none;">
                            <br>
                            <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือก CERAMAGE</li>
                                    </ol>
                                </nav>
                            <div>
                                <div class="radio-toolbar text-center justify-content-center">
                                    <div class="row" style="over-flow:auto;">
                                        <input type="radio" id="implant_ceramage1" name="implant_ceramage" value="ระบบ TI-BASE">
                                        <label for="implant_ceramage1" style="cursor:pointer;">ระบบ TI-BASE</label>

                                        <input type="radio" id="implant_ceramage2" name="implant_ceramage" value="ระบบ TITANIUM CUSTOMED">
                                        <label for="implant_ceramage2" style="cursor:pointer;">ระบบ TITANIUM CUSTOMED</label>

                                        <input type="radio" id="implant_ceramage3" name="implant_ceramage" value="ระบบ STANDARD">
                                        <label for="implant_ceramage3" style="cursor:pointer;">ระบบ STANDARD</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="CardScrew" style="display:none;">
                            <br>
                            <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือก Screw-retained</li>
                                    </ol>
                                </nav>
                            <div>
                                <div class="radio-toolbar text-center justify-content-center">
                                    <div class="row" style="over-flow:auto;">
                                        <input type="radio" id="implant_screw1" name="implant_screw" value="STRAUMANN">
                                        <label for="implant_screw1" style="cursor:pointer;">STRAUMANN</label>

                                        <input type="radio" id="implant_screw2" name="implant_screw" value="ASTRA">
                                        <label for="implant_screw2" style="cursor:pointer;">ASTRA</label>

                                        <input type="radio" id="implant_screw3" name="implant_screw" value="OSSTEM">
                                        <label for="implant_screw3" style="cursor:pointer;">OSSTEM</label>

                                        <input type="radio" id="implant_screw4" name="implant_screw" value="อื่นๆ">
                                        <label for="implant_screw4" style="cursor:pointer;">อื่นๆ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>

        {{-- 11 --}}
        <div class="col-3 grid-margin stretch-card shot-padding">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;MODEL</li>
                    </ol>
                </nav>
                <div class="card-body pt-0" style="padding: 10px;">
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            <input type="radio" id="MODEL1" name="model" value="SURGICAL GUIDE" onclick="MODELFunctions()">
                            <label for="MODEL1" style="cursor:pointer;">SURGICAL GUIDE</label>

                            <input type="radio" id="MODEL2" name="model" value="MODEL RESIN" onclick="MODELFunctions()">
                            <label for="MODEL2" style="cursor:pointer;">MODEL RESIN (PRINT MODEL)</label>
                        </div>
                    </div>

                    <div id="CardRESIN" style="display:none;">
                        <br>
                        <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือก MODEL RESIN (PRINT MODEL)</li>
                                </ol>
                            </nav>
                        <div>
                            <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    <input type="radio" id="model_resin1" name="model_resin" value="บน">
                                    <label for="model_resin1" style="cursor:pointer;">บน</label>

                                    <input type="radio" id="model_resin2" name="model_resin" value="ล่าง">
                                    <label for="model_resin2" style="cursor:pointer;">ล่าง</label>

                                    <input type="radio" id="model_resin3" name="model_resin" value="บนและล่าง">
                                    <label for="model_resin3" style="cursor:pointer;">บนและล่าง</label>

                                    <input type="radio" id="model_resin4" name="model_resin" value="เต็มปาก">
                                    <label for="model_resin4" style="cursor:pointer;">เต็มปาก</label>

                                    <input type="radio" id="model_resin5" name="model_resin" value="ครึ่งปาก">
                                    <label for="model_resin5" style="cursor:pointer;">ครึ่งปาก</label>

                                    <input type="radio" id="model_resin6" name="model_resin" value="1/4">
                                    <label for="model_resin6" style="cursor:pointer;">1/4</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_model">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_model',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-6 grid-margin">
        </div> --}}
        <div class="col-6 grid-margin stretch-card shot-padding">
            <div class="card">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;คำสั่งเพิ่มเติม</li>
                    </ol>
                </nav>
                <div class="card-body pt-0">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_model">คำสั่งเพิ่มเติม</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_extra',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"10"]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 12 --}}
        <div class="col-6 grid-margin stretch-card shot-padding">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;คำสั่งพิเศษ</li>
                        </ol>
                    </nav>
                    <div class="card-body pt-0" style="padding: 10px;">
                        <div class="checkbox-toolbar">
                            <div class="row" style="over-flow:auto;">
                                <input type="checkbox" id="ex1" name="ex1" value="ดู Wax full contour">
                                <label for="ex1" style="cursor:pointer;">ดู Wax full contour</label>

                                <input type="checkbox" id="ex2" name="ex2" value="ดู Design ทางไลน์">
                                <label for="ex2" style="cursor:pointer;">ดู Design ทางไลน์</label>

                                <input type="checkbox" id="ex3" name="ex3" value="ลอง contour พอสเลนก่อนเกรซ">
                                <label for="ex3" style="cursor:pointer;">ลอง contour พอสเลนก่อนเกรซ</label>

                                <input type="checkbox" id="ex5" name="ex5" value="ส่งกลับให้คุณหมอดู">
                                <label for="ex5" style="cursor:pointer;">ส่งกลับให้คุณหมอดู</label>

                                <input type="checkbox" id="ex6" name="ex6" value="ทำ PINDEX">
                                <label for="ex6" style="cursor:pointer;">ทำ PINDEX</label>

                                <input type="checkbox" id="ex7" name="ex7" value="จะส่งคนไข้มาเทียบสีที่ Lab">
                                <label for="ex7" style="cursor:pointer;">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 ">
                                <div class="checkbox-toolbar2" >
                                    <input type="checkbox" id="ex4" name="ex4" value="ให้ช่างโทรกลับในขั้นตอน" onclick="exFunction123()" >
                                    <label for="ex4" style="cursor:pointer;">ให้ช่างโทรกลับในขั้นตอน</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-4">
                                {{ Form::text('ex4_details',null, ['ID'=>'ex4_details','class' => 'form-control','placeholder' => 'ขั้นตอน','readonly']) }}
                            </div>
                            <div class="col-sm-5"></div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-3 ">
                                <div class="checkbox-toolbar2">
                                    <input type="checkbox" id="ex8" name="ex8" value="โทรกลับแล้ว" onclick="exFunction123()">
                                    <label for="ex8" style="cursor:pointer;">โทรกลับแล้ว</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-4">
                                 {{ Form::tel('ex8_details',null, ['ID'=>'phone','class' => 'form-control','placeholder' => 'โทรโดย','readonly']) }}
                            </div>
                            <div class="col-sm-4" >
                                {{ Form::text('ex8_detail2s',null, ['ID'=>'Ex8_detail2s','class' => 'form-control','data-date-format'=>'dd/mm/yyyy','placeholder' => 'วันที่','disabled']) }}
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-sm-3 ">
                                <div class="checkbox-toolbar2">
                                    <input type="checkbox" id="ex9" name="ex9" value="ทางไลน์" onclick="exFunction123()">
                                    <label for="ex9" style="cursor:pointer;">ทางไลน์</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-4">
                                {{ Form::text('ex9_details',null, ['ID'=>'ex9_details','class' => 'form-control','placeholder' => 'ID LINE','readonly']) }}
                            </div>
                            <div class="col-sm-5">
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-sm-3 ">
                                <div class="checkbox-toolbar2">
                                    <input type="checkbox" id="ex10" name="ex10" value="คุณหมอส่งสีฟันมาทางไลน์" onclick="exFunction123()">
                                    <label for="ex10" style="cursor:pointer;">คุณหมอส่งสีฟันมาทางไลน์</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-4">
                                {{ Form::text('ex10_detail',null, ['ID'=>'ex10_detail','class' => 'form-control','placeholder' => 'ID LINE','readonly']) }}
                            </div>
                            <div class="col-sm-5">
                            </div>
                        </div>

                    </div>
                </div>
        </div>

        {{-- 13--}}
        <div class="col-6 grid-margin stretch-card  shot-padding">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;สิ่งที่ส่งมาด้วย</li>
                        </ol>
                    </nav>
                    <div class="card-body pt-0"  style="padding: 10px;">
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="checkbox-toolbar2" >
                                    <input type="checkbox" id="RQ1" name="RQ1" value="IMPRESSION"  onclick="exFunction3()">
                                    <label for="RQ1" style="cursor:pointer;">IMPRESSION</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::number('RQ1_NUM',null, ['ID'=>'RQ1_NUM','class' => 'form-control','placeholder' => 'จำนวน','min'=>"1",'max'=>"99" ,'readonly']) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::textarea('RQ1_DETAIL',null, ['ID'=>'RQ1_DETAIL','class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"1",'readonly']) }}
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox-toolbar2" >
                                    <input type="checkbox" id="RQ2" name="RQ2" value="WORKING MODEL"  onclick="exFunction3()">
                                    <label for="RQ2" style="cursor:pointer;">WORKING MODEL</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::number('RQ2_NUM',null, ['ID'=>'RQ2_NUM','class' => 'form-control','placeholder' => 'จำนวน','min'=>"1",'max'=>"99" ,'readonly']) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::textarea('RQ2_DETAIL',null, ['ID'=>'RQ2_DETAIL','class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"1",'readonly']) }}
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox-toolbar2" >
                                    <input type="checkbox" id="RQ3" name="RQ3" value="STUDY MODEL" onclick="exFunction3()">
                                    <label for="RQ3" style="cursor:pointer;">STUDY MODEL</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::number('RQ3_NUM',null, ['ID'=>'RQ3_NUM','class' => 'form-control','placeholder' => 'จำนวน','min'=>"1",'max'=>"99" ,'readonly']) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::textarea('RQ3_DETAIL',null, ['ID'=>'RQ3_DETAIL','class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"1",'readonly']) }}
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox-toolbar2" >
                                    <input type="checkbox" id="RQ4" name="RQ4" value="BITE" onclick="exFunction3()">
                                    <label for="RQ4" style="cursor:pointer;">BITE</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::number('RQ4_NUM',null, ['ID'=>'RQ4_NUM','class' => 'form-control','placeholder' => 'จำนวน','min'=>"1",'max'=>"99",'readonly' ]) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::textarea('RQ4_DETAIL',null, ['ID'=>'RQ4_DETAIL','class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"1",'readonly']) }}
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox-toolbar2" >
                                    <input type="checkbox" id="RQ5" name="RQ5" value="คู่สบ" onclick="exFunction3()">
                                    <label for="RQ5" style="cursor:pointer;">คู่สบ</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::number('RQ5_NUM',null, ['ID'=>'RQ5_NUM','class' => 'form-control','placeholder' => 'จำนวน','min'=>"1",'max'=>"99",'readonly' ]) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::textarea('RQ5_DETAIL',null, ['ID'=>'RQ5_DETAIL','class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"1",'readonly']) }}
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="checkbox-toolbar2" >
                                    <input type="checkbox" id="RQ6" name="RQ6" value="ARTICULATOR" onclick="exFunction3()">
                                    <label for="RQ6" style="cursor:pointer;">ARTICULATOR</label>
                                    <!-- onclick="exFunction()" -->
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{ Form::number('RQ6_NUM',null, ['ID'=>'RQ6_NUM','class' => 'form-control','placeholder' => 'จำนวน','min'=>"1",'max'=>"99",'readonly' ]) }}
                            </div>
                            <div class="col-sm-6">
                                {{ Form::textarea('RQ6_DETAIL',null, ['ID'=>'RQ6_DETAIL','class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"1",'readonly']) }}
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
        </div>

      @endif

        <div class="col-sm-12 text-right">
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

{{-- <div class="row">


  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
              <li class="breadcrumb-item active" aria-current="page">test</li>
          </ol>
      </nav>
      <div class="card-body">
        <p class="text-muted mb-0">
          55555555555555555555555555555555555555555555555555555555
          55555555555555555555555555555555555555555555555555555555
        </p>
      </div>
    </div>
  </div>


  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
              <li class="breadcrumb-item active" aria-current="page">test</li>
          </ol>
      </nav>
      <div class="card-body">
        <p class="text-muted mb-0">
          5555555555555555555555555555
        </p>
      </div>
    </div>
  </div>
</div> --}}

</div>

@stop

@section('scripts')
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    //PONTIC เลือก checkbox ได้แค่ตัวเดียว
    $('input[name="PONTIC_DESIGN"]').change(function() {
      $('input[name="PONTIC_DESIGN"]').not(this).prop('checked', false);
    });

    //MARGIN AND MENTAL DESIGN เลือก checkbox ได้แค่ตัวเดียว
    $('input[name="MARGIN1"]').change(function() {
      $('input[name="MARGIN1"]').not(this).prop('checked', false);
    });
    $('input[name="MARGIN2"]').change(function() {
      $('input[name="MARGIN2"]').not(this).prop('checked', false);
    });
    $('input[name="MARGIN3"]').change(function() {
      $('input[name="MARGIN3"]').not(this).prop('checked', false);
    });

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

        function exFunction() {
            var ex4_detail = document.getElementById("ex4_detail");
            var ex8_detail = document.getElementById("ex8_detail");
            var ex9_detail = document.getElementById("ex9_detail");
            var ex10_detail = document.getElementById("ex10_detail");
            var ex4 = document.getElementById("ex4");
            var ex8= document.getElementById("ex8");
            var ex9 = document.getElementById("ex9");
            var ex10 = document.getElementById("ex10");

            if (ex4.checked == true){
                ex4_detail.style.display = "block";
            }

            if (ex4.checked != true){
                ex4_detail.style.display = "none";
            }

            if (ex8.checked == true){
                ex8_detail.style.display = "block";
            }

            if (ex8.checked != true){
                ex8_detail.style.display = "none";
            }

            if (ex9.checked == true){
                ex9_detail.style.display = "block";
            }

            if (ex9.checked != true){
                ex9_detail.style.display = "none";
            }

            if (ex10.checked == true){
                ex10_detail.style.display = "block";
            }

            if (ex10.checked != true){
                ex10_detail.style.display = "none";
            }

        }

        function RQFunction() {
            var RQ1_detail = document.getElementById("RQ1_detail");
            var RQ2_detail = document.getElementById("RQ2_detail");
            var RQ3_detail = document.getElementById("RQ3_detail");
            var RQ4_detail = document.getElementById("RQ4_detail");
            var RQ5_detail = document.getElementById("RQ5_detail");
            var RQ6_detail = document.getElementById("RQ6_detail");
            var RQ1 = document.getElementById("RQ1");
            var RQ2 = document.getElementById("RQ2");
            var RQ3 = document.getElementById("RQ3");
            var RQ4 = document.getElementById("RQ4");
            var RQ5 = document.getElementById("RQ5");
            var RQ6 = document.getElementById("RQ6");

            if (RQ1.checked == true){
                RQ1_detail.style.display = "block";
            }

            if (RQ1.checked != true){
                RQ1_detail.style.display = "none";
            }

            if (RQ2.checked == true){
                RQ2_detail.style.display = "block";
            }

            if (RQ2.checked != true){
                RQ2_detail.style.display = "none";
            }

            if (RQ3.checked == true){
                RQ3_detail.style.display = "block";
            }

            if (RQ3.checked != true){
                RQ3_detail.style.display = "none";
            }

            if (RQ4.checked == true){
                RQ4_detail.style.display = "block";
            }

            if (RQ4.checked != true){
                RQ4_detail.style.display = "none";
            }

            if (RQ5.checked == true){
                RQ5_detail.style.display = "block";
            }

            if (RQ5.checked != true){
                RQ5_detail.style.display = "none";
            }

            if (RQ6.checked == true){
                RQ6_detail.style.display = "block";
            }

            if (RQ6.checked != true){
                RQ6_detail.style.display = "none";
            }
        }

        function CERAMAGEFunctions() {
            var CardCERAMAGE = document.getElementById("CardCERAMAGE");
            var CardScrew = document.getElementById("CardScrew");
            var IMPLANT1 = document.getElementById("IMPLANT1");
            var IMPLANT2 = document.getElementById("IMPLANT2");
            var IMPLANT3 = document.getElementById("IMPLANT3");
            var IMPLANT4 = document.getElementById("IMPLANT4");
            var IMPLANT5 = document.getElementById("IMPLANT5");
            var IMPLANT6 = document.getElementById("IMPLANT6");
            var IMPLANT7 = document.getElementById("IMPLANT7");

            if (IMPLANT1.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT2.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT3.checked == true){
                CardCERAMAGE.style.display = "block";
                CardScrew.style.display = "none";
            }

            if (IMPLANT4.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT5.checked == true){
                CardScrew.style.display = "block";
                CardCERAMAGE.style.display = "none";
            }

            if (IMPLANT6.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT7.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }
        }

        function MODELFunctions() {
            var CardRESIN = document.getElementById("CardRESIN");
            var MODEL1 = document.getElementById("MODEL2");
            var MODEL2 = document.getElementById("MODEL1");
            if (MODEL1.checked == true){
                CardRESIN.style.display = "block";
            }
            else {
                CardRESIN.style.display = "none";
            }
            if(MODEL2.checked == true){
                CardRESIN.style.display = "none";
            }
        }

        function HookFunction() {
            var OptionHook = document.getElementById("OptionHook");
            var checkBox = document.getElementById("chkPassport");
            var nochkPassport = document.getElementById("nochkPassport");
            if (checkBox.checked == true){
                OptionHook.style.display = "block";
            }
            else {
                OptionHook.style.display = "none";
            }
            if(nochkPassport.checked == true){
                OptionHook.style.display = "none";
            }
        }
        function  UndercutFunction(){

            var haveundercut = document.getElementById("haveundercut");
            var nohaveundercut = document.getElementById("nohaveundercut");
            var nochkPassport = document.getElementById("OptionUnit_hook");
            if(haveundercut.checked == true){
                nochkPassport.style.display = "block";
            }
            else{
                nochkPassport.style.display = "none";

            }
        }


        function ContourFunction(){
            var radiosomsanit = document.getElementById("radiosomsanit");
            var undercut = document.getElementById("undercut");

             if(radioUNDER.checked == true){
                undercut.style.display = "flex";
            }
            if(radiosomsanit.checked == true){
                undercut.style.display = "none";
            }
        }

        function ShadeFunction(){
            var radioOne = document.getElementById("radioOne");
            var radiomulti = document.getElementById("radiomulti");
            var CardOneColor = document.getElementById("CardOneColor");
            var CardMultiColor = document.getElementById("CardMultiColor");
            var radioVITA_AD = document.getElementById("radioVITA_AD");
            var radioVITA_3D = document.getElementById("radioVITA_3D");
            var radioSHOFU = document.getElementById("radioSHOFU");
            var radioCHOMASCOP = document.getElementById("radioCHOMASCOP");
            var radioAnother = document.getElementById("radioAnother");
            var CardChooseColor = document.getElementById("CardChooseColor");
            var CardAnotherColor = document.getElementById("CardAnotherColor");
            if(radioOne.checked == true){
                CardOneColor.style.display = "flex";
                CardMultiColor.style.display = "none";
                if(radioVITA_AD.checked == true || radioVITA_3D.checked == true || radioSHOFU.checked == true || radioSHOFU.checked == true || radioCHOMASCOP.checked == true){
                    CardChooseColor.style.display = "flex";
                    CardAnotherColor.style.display = "none";
                }
                else if(radioAnother.checked == true){
                    CardAnotherColor.style.display = "flex";
                    CardChooseColor.style.display = "none";
                }
            }
            if(radiomulti.checked == true){
                CardMultiColor.style.display = "flex";
                CardChooseColor.style.display = "none";
                CardAnotherColor.style.display = "none";
                CardOneColor.style.display = "none";
            }
        }
        function myFunctions() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }

        function exFunction123(){

            var ex4 = document.getElementById("ex4");
            var ex4_details = document.getElementById("ex4_details");

            var ex8  = document.getElementById("ex8");
            var phone = document.getElementById("phone");
            var Ex8_detail2s = document.getElementById("Ex8_detail2s");

            var ex9 = document.getElementById("ex9");
            var ex9_details = document.getElementById("ex9_details");

            var ex10 = document.getElementById("ex10");
            var ex10_detail = document.getElementById("ex10_detail");

            if(document.getElementById("ex4").checked == true)
            {
                ex4_details.readOnly = false;
                //เปิด
            }
            if(document.getElementById("ex4").checked == false)
            {
                ex4_details.readOnly = true;
                $('#ex4_details').val('');
                //ปิด
            }

            if(document.getElementById("ex8").checked == true)
            {
                phone.readOnly = false;
                document.getElementById("Ex8_detail2s").disabled = false;
                //เปิด
            }
            if(document.getElementById("ex8").checked == false)
            {
                phone.readOnly = true;
                document.getElementById("Ex8_detail2s").disabled = true;

                $('#phone').val('');
                //ปิด
            }

            if(document.getElementById("ex9").checked == true)
            {
                ex9_details.readOnly = false;
                //เปิด
            }
            if(document.getElementById("ex9").checked == false)
            {
                ex9_details.readOnly = true;
                $('#ex9_details').val('');
                //ปิด
            }

            if(document.getElementById("ex10").checked == true)
            {
                ex10_detail.readOnly = false;
                //เปิด
            }
            if(document.getElementById("ex10").checked == false)
            {
                ex10_detail.readOnly = true;
                $('#ex10_detail').val('');
                //ปิด
            }

        }

        function exFunction3(){

            var RQ1_NUM = document.getElementById("RQ1_NUM");
            var RQ1_DETAIL = document.getElementById("RQ1_DETAIL");

            var ex8  = document.getElementById("ex8");
            var phone = document.getElementById("phone");
            var Ex8_detail2s = document.getElementById("Ex8_detail2s");

            var ex9 = document.getElementById("ex9");
            var ex9_details = document.getElementById("ex9_details");

            var ex10 = document.getElementById("ex10");
            var ex10_detail = document.getElementById("ex10_detail");


            if(document.getElementById("RQ1").checked == true)
            {
                RQ1_NUM.readOnly = false;
                RQ1_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ1").checked == false)
            {
                RQ1_NUM.readOnly = true;
                RQ1_DETAIL.readOnly = true;

                $('#RQ1_NUM').val('');
                $('#RQ1_DETAIL').val('');
                //ปิด
            }
            if(document.getElementById("RQ2").checked == true)
            {
                RQ2_NUM.readOnly = false;
                RQ2_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ2").checked == false)
            {
                RQ2_NUM.readOnly = true;
                RQ2_DETAIL.readOnly = true;

                $('#RQ2_NUM').val('');
                $('#RQ2_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ3").checked == true)
            {
                RQ3_NUM.readOnly = false;
                RQ3_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ3").checked == false)
            {
                RQ3_NUM.readOnly = true;
                RQ3_DETAIL.readOnly = true;

                $('#RQ3_NUM').val('');
                $('#RQ3_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ4").checked == true)
            {
                RQ4_NUM.readOnly = false;
                RQ4_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ4").checked == false)
            {
                RQ4_NUM.readOnly = true;
                RQ4_DETAIL.readOnly = true;

                $('#RQ4_NUM').val('');
                $('#RQ4_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ5").checked == true)
            {
                RQ5_NUM.readOnly = false;
                RQ5_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ5").checked == false)
            {
                RQ5_NUM.readOnly = true;
                RQ5_DETAIL.readOnly = true;

                $('#RQ5_NUM').val('');
                $('#RQ5_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ6").checked == true)
            {
                RQ6_NUM.readOnly = false;
                RQ6_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ6").checked == false)
            {
                RQ6_NUM.readOnly = true;
                RQ6_DETAIL.readOnly = true;

                $('#RQ6_NUM').val('');
                $('#RQ6_DETAIL').val('');
                //ปิด
            }

        }

        $('#radioOpen').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radioClose').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radiosomsanit').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radioAREA').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radioPOINT').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });

        $('#radiomulti').click(function() {
            $('input[name=one_color]').prop('checked', false);
            $('input[name=one_color_Combobox]').prop('checked', false);
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioVITA_AD').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioVITA_3D').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioSHOFU').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioCHOMASCOP').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioAnother').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });

        $('#nohaveundercut').click(function() {
            $('input[name=undercut_hook]').prop('checked', false);
            $('input[name=unit_hook]').prop('checked', false);
        });
        $('#radiosomsanit').click(function() {
            $('input[name=unit_CONTOUR]').prop('checked', false);
        });

        $('#nochkPassport').click(function() {
            $('input[name=MESIAL_REST]').prop('checked', false);
            $('input[name=DISTAL_REST]').prop('checked', false);
            $('input[name=CINGULUM_REST]').prop('checked', false);
            $('input[name=LINGUAL_LEDGE]').prop('checked', false);
            $('input[name=EMBRESSURE_REST]').prop('checked', false);
            $('input[name=other_hook]').prop('checked', false);
            $('input[name=undercut_hook]').prop('checked', false);
            $('input[name=unit_hook]').prop('checked', false);
            $('#another').val('');
            $('#undercut_hook').val('defaultunit');
            $('#unit_hook').val('defaultunit');
        });

        $(document).ready(function(){
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                Ex8_detail2s
                $("#startdate").datepicker({
                    todayBtn:  1,
                    autoclose: true,

                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('#enddate').datepicker('setStartDate', minDate);
                    $('#datefinal').datepicker('setStartDate', minDate);
                });

                $("#enddate").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
                $('#datefinal').datepicker('setStartDate', minDate);
                });

                $("#datefinal").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
                });

                $("#Ex8_detail2s").datepicker({
                    todayBtn:  1,
                    autoclose: true,

                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                });
                $( '#Ex8_detail2s' ).datepicker( 'setDate',today);
                $( '#startdate,#enddate, #datefinal' ).datepicker( 'setDate' );

            });
        $("#phone").inputmask({"mask": "(999) 999-9999"});
</script>

<script>
        $(document).ready(function() {
            @if(\Session::has('massage'))
                alert('{{ \Session::get('massage') }}');
            @endif
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        $(document).ready(function() {
            $('#example2').DataTable();
        } );
        $(document).ready(function() {
            $('#example3').DataTable();
        } );
        });
    </script>

@stop
