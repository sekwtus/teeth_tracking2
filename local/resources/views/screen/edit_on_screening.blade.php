@extends('layouts.template')
@section('title', 'แก้ไขข้อมูล Screen')
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
<div class="container-fluid">
  {{ Form::open(['method'=>'post' , 'url'=>'/mainscreen/edit_on_screening/'.$id.'/'. $group .'/save']) }}
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
                    {{-- @if($out_teeth->TeethID == $k && $out_teeth->status == '1')
                        @php $x=$k; @endphp
                        <img class="img" src="{{ asset('./images/test.gif') }}" width="0" height="0" onload="select({{$k}})">
                    @endif --}}

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
          {{ Form::open(['method'=>'post' , 'url'=>'/edit_conclusion/edit_teeth/'.$id]) }}
          <td id="td-conclusion-tooth" valign="top" rowspan="5">
            <table class="" width="100%" border="1">
              <thead class="text-center">
                <th>ซี่ฟัน</th>
                <th>สินค้า</th>
                <th>ชนิดงาน</th>
                <th>กลุ่มฟัน</th>
                <th>สถานะ</th>
                {{-- <th>Action</th> --}}
              </thead>
              <tbody>
                  @foreach ($order_teeth_screen as $teeth_screen)
                      @if($teeth_screen->status == '1')
                          <tr style="background-color: #4CAF50;color: white;">
                              <td><input type="hidden" name="current_teeth[]" value="{{ $teeth_screen->teeth_name_ID }}"/>{{-- ฟันปัจจุบัน --}}
                                <select class="form-control" name="new_teeth[]">
                                    <option selected="selected" value="{{ $teeth_screen->teeth_name_ID }}">
                                        {{ $teeth_screen->teeth_name }}
                                    </option>
                                    @foreach($teeth_not_in as $out_teeth_not_in)    {{-- แสดงฟันที่ไม่ได้เลือก --}}
                                        @if ($teeth_screen->ID != $out_teeth_not_in->ID)
                                            <option value="{{ $out_teeth_not_in->ID }}">{{$out_teeth_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                               </td>

                               <td><input type="hidden" name="current_product[]" value="{{ $teeth_screen->work_type_id }}"/>{{-- สินค้าฟันปัจจุบัน --}}
                                <select class="form-control" name="new_product[]">
                                    <option selected="selected" value="{{ $teeth_screen->work_type_id }}">
                                        {{ $teeth_screen->work_type }}
                                    </option>
                                    @foreach($product_not_in as $out_product_not_in)
                                        @if ($teeth_screen->work_type != $out_product_not_in->Name)
                                        <option value="{{$out_product_not_in->ID}}">{{$out_product_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </td>

                               <td><input type="hidden" name="current_type_of_work[]" value="{{ $teeth_screen->work_name_ID }}"/>{{-- ชนิดงานฟันปัจจุบัน --}}
                                <select class="form-control" name="new_type_of_work[]">
                                    <option selected="selected"  value="{{ $teeth_screen->work_name_ID }}">
                                        {{ $teeth_screen->work_name }}
                                    </option>
                                    @foreach($work_not_in as $out_work_not_in)
                                        @if ($teeth_screen->work_name != $out_work_not_in->Name)
                                            <option value="{{$out_work_not_in->ID}}">{{$out_work_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </td>

                              <td><input type="hidden" name="current_group[]" value="{{ $teeth_screen->name_group_ID }}"/>{{-- กลุ่มฟันฟันปัจจุบัน --}}
                                <select class="form-control" name="new_group[]">
                                    <option selected="selected" value="{{ $teeth_screen->name_group_ID }}">
                                            {{ $teeth_screen->name_group }}
                                    </option>
                                    @foreach($group_not_in as $out_group_not_in)
                                        @if ($teeth_screen->name_group != $out_group_not_in->Name)
                                            <option value="{{$out_group_not_in->ID}}">{{$out_group_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </td>
                              <td> screen แล้ว </td>
                              {{-- <td><input type="submit" class="btn btn-danger" formaction="{{ url('/mainscreen/edit_conclusion/'.$teeth_screen->ID.'/'.$group.'/delete')}}" value="ยกเลิก"/></td> --}}
                          </tr>
                      @else
                      <tr style="background-color: #4CAF50;color: white;">
                            <td><input type="hidden" name="current_teeth[]" value="{{ $teeth_screen->teeth_name_ID }}"/>{{-- ฟันปัจจุบัน --}}
                                <select class="form-control" name="new_teeth[]">
                                    <option selected="selected" value="{{ $teeth_screen->teeth_name_ID }}">
                                        {{ $teeth_screen->teeth_name }}
                                    </option>
                                    @foreach($teeth_not_in as $out_teeth_not_in)    {{-- แสดงฟันที่ไม่ได้เลือก --}}
                                        @if ($teeth_screen->ID != $out_teeth_not_in->ID)
                                            <option value="{{ $out_teeth_not_in->ID }}">{{$out_teeth_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                               </td>

                               <td><input type="hidden" name="current_product[]" value="{{ $teeth_screen->work_type_id }}"/>{{-- สินค้าฟันปัจจุบัน --}}
                                <select class="form-control" name="new_product[]">
                                    <option selected="selected" value="{{ $teeth_screen->work_type_id }}">
                                        {{ $teeth_screen->work_type }}
                                    </option>
                                    @foreach($product_not_in as $out_product_not_in)
                                        @if ($teeth_screen->work_type != $out_product_not_in->Name)
                                        <option value="{{$out_product_not_in->ID}}">{{$out_product_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </td>

                               <td><input type="hidden" name="current_type_of_work[]" value="{{ $teeth_screen->work_name_ID }}"/>{{-- ชนิดงานฟันปัจจุบัน --}}
                                <select class="form-control" name="new_type_of_work[]">
                                    <option selected="selected"  value="{{ $teeth_screen->work_name_ID }}">
                                        {{ $teeth_screen->work_name }}
                                    </option>
                                    @foreach($work_not_in as $out_work_not_in)
                                        @if ($teeth_screen->work_name != $out_work_not_in->Name)
                                            <option value="{{$out_work_not_in->ID}}">{{$out_work_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </td>

                              <td><input type="hidden" name="current_group[]" value="{{ $teeth_screen->name_group_ID }}"/>{{-- กลุ่มฟันฟันปัจจุบัน --}}
                                <select class="form-control" name="new_group[]">
                                    <option selected="selected" value="{{ $teeth_screen->name_group_ID }}">
                                            {{ $teeth_screen->name_group }}
                                    </option>
                                    @foreach($group_not_in as $out_group_not_in)
                                        @if ($teeth_screen->name_group != $out_group_not_in->Name)
                                            <option value="{{$out_group_not_in->ID}}">{{$out_group_not_in->Name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                              </td>
                            <td> ยังไม่ screen </td>
                            {{-- <td><input type="submit" class="btn btn-danger" formaction="{{ url('/mainscreen/edit_conclusion/'.$teeth_screen->ID.'/'.$group.'/delete')}}" value="ยกเลิก"/></td> --}}
                        </tr>
                      @endif
                  @endforeach

              </tbody>
            </table>
            <br>
            <div class="text-right">
              <button class="btn btn-success" type="menu" formaction="{{ url('/edit_on_screening/edit_teeth/'.$id) }}">บันทึกการแก้ไข</button>
            </div>
          </td>
          {{ Form::close() }}
        </tr>
      </table>

      @foreach($data_screen as $out_data_screen)
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
                  @if($out_data_screen->Metal_type == 'NON_PRECIOUS')
                    <input type="checkbox" value="NON_PRECIOUS" class="custom-control-input" id="rdoAlloys1" name="rdoAlloys1" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoAlloys1">NON PRECIOUS</label>
                  @else
                    <input type="checkbox" value="NON_PRECIOUS" class="custom-control-input" id="rdoAlloys1" name="rdoAlloys1" onchange="checkOnlyOne(this.id,this.name)" >
                    <label class="custom-control-label" for="rdoAlloys1">NON PRECIOUS</label>
                  @endif
                </div>
              </div>

               <div class="col-12">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->Metal_type2 == 'PALLADIUM')
                    <input type="checkbox" value="PALLADIUM" class="custom-control-input" id="rdoAlloys2" name="rdoAlloys2" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoAlloys2">PALLADIUM</label>
                  @else
                    <input type="checkbox" value="PALLADIUM" class="custom-control-input" id="rdoAlloys2" name="rdoAlloys2" onchange="checkOnlyOne(this.id,this.name)" >
                    <label class="custom-control-label" for="rdoAlloys2">PALLADIUM</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->Metal_type3 == 'SEMI PRECIOUS')
                    <input type="checkbox" value="SEMI PRECIOUS" class="custom-control-input" id="rdoAlloys3" name="rdoAlloys3" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoAlloys3">SEMI PRECIOUS</label>
                  @else
                    <input type="checkbox" value="SEMI PRECIOUS" class="custom-control-input" id="rdoAlloys3" name="rdoAlloys3" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoAlloys3">SEMI PRECIOUS</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->Metal_type4 == 'HIGH PRECIOUS')
                    <input type="checkbox" value="HIGH PRECIOUS" class="custom-control-input" id="rdoAlloys4" name="rdoAlloys4" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoAlloys4">HIGH PRECIOUS</label>
                  @else
                    <input type="checkbox" value="HIGH PRECIOUS" class="custom-control-input" id="rdoAlloys4" name="rdoAlloys4" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoAlloys4">HIGH PRECIOUS</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->Metal_type5 == 'แจ้งค่าโลหะก่อนเหวี่ยง')
                    <input type="checkbox" value="แจ้งค่าโลหะก่อนเหวี่ยง" class="custom-control-input" id="rdoAlloys5" name="rdoAlloys5" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoAlloys5">แจ้งค่าโลหะก่อนเหวี่ยง</label>
                  @else
                    <input type="checkbox" value="แจ้งค่าโลหะก่อนเหวี่ยง" class="custom-control-input" id="rdoAlloys5" name="rdoAlloys5" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoAlloys5">แจ้งค่าโลหะก่อนเหวี่ยง</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->Metal_type6 == 'มีโลหะมาเคลม')
                    <input type="checkbox" value="มีโลหะมาเคลม" class="custom-control-input" id="rdoAlloys6" name="rdoAlloys6" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoAlloys6">มีโลหะมาเคลม</label>
                  @else
                    <input type="checkbox" value="มีโลหะมาเคลม" class="custom-control-input" id="rdoAlloys6" name="rdoAlloys6" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoAlloys6">มีโลหะมาเคลม</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                @if($out_data_screen->Metal_type == 'รอถามแพทย์')
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoAlloys7" name="rdoAlloys7" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoAlloys7">รอถามแพทย์</label>
                  </div>
                  {{ Form::textarea('txtDoctorAlloys',$out_data_screen->comment_Metal_type, ['class'=>'form-control','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                @else
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoAlloys7" name="rdoAlloys7" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoAlloys7">รอถามแพทย์</label>
                  </div>
                  {{ Form::textarea('txtDoctorAlloys',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                @endif
              </div>
              <div class="col-12">
                {{ Form::textarea('txtCommentAlloys',$out_data_screen->txtCommentAlloys, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
              </div>
            </div>
          </td>

          <td id="td-shade" valign="top" rowspan="3">
            <div id="div-shade" class="mb-3">
              <div class="bg-success text-center">SHADE</div>
              <div class="row">
                @if($out_data_screen->one_color =="สีเดียว")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoShadeOneColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoShadeOneColor">สีเดียว</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="หลายสี" class="custom-control-input" id="rdoShadeMultiColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeMultiColor">หลายสี</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoShadeLine" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeLine">แพทย์ส่งสีฟันมาทาง Line</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoShadeCompare" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoShadeDoctor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeDoctor">รอถามแพทย์</label>
                    </div>
                    {{ Form::textarea('txtDoctorShade',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                  </div>
                @elseif($out_data_screen->one_color =="หลายสี")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoShadeOneColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeOneColor">สีเดียว</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="หลายสี" class="custom-control-input" id="rdoShadeMultiColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoShadeMultiColor">หลายสี</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoShadeLine" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeLine">แพทย์ส่งสีฟันมาทาง Line</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoShadeCompare" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoShadeDoctor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeDoctor">รอถามแพทย์</label>
                    </div>
                    {{ Form::textarea('txtDoctorShade',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                  </div>
                @elseif($out_data_screen->one_color =="แพทย์ส่งสีฟันมาทาง Line")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoShadeOneColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeOneColor">สีเดียว</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="หลายสี" class="custom-control-input" id="rdoShadeMultiColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeMultiColor">หลายสี</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoShadeLine" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoShadeLine">แพทย์ส่งสีฟันมาทาง Line</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoShadeCompare" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoShadeDoctor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeDoctor">รอถามแพทย์</label>
                    </div>
                    {{ Form::textarea('txtDoctorShade',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                  </div>
                @elseif($out_data_screen->one_color =="จะส่งคนไข้มาเทียบสีที่ Lab")
                <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoShadeOneColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeOneColor">สีเดียว</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="หลายสี" class="custom-control-input" id="rdoShadeMultiColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeMultiColor">หลายสี</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoShadeLine" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeLine">แพทย์ส่งสีฟันมาทาง Line</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoShadeCompare" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoShadeCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoShadeDoctor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeDoctor">รอถามแพทย์</label>
                    </div>
                    {{ Form::textarea('txtDoctorShade',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                  </div>
                @elseif($out_data_screen->one_color =="รอถามแพทย์")
                <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoShadeOneColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeOneColor">สีเดียว</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="หลายสี" class="custom-control-input" id="rdoShadeMultiColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeMultiColor">หลายสี</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoShadeLine" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeLine">แพทย์ส่งสีฟันมาทาง Line</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoShadeCompare" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoShadeCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoShadeDoctor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoShadeDoctor">รอถามแพทย์</label>
                    </div>
                    {{ Form::textarea('txtDoctorShade',$out_data_screen->comment_shade,['class'=>'form-control','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                  </div>
                @elseif($out_data_screen->one_color =="")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoShadeOneColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeOneColor">สีเดียว</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="หลายสี" class="custom-control-input" id="rdoShadeMultiColor" name="rdoGroupShade" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeMultiColor">หลายสี</label>
                    </div>
                  </div>
                </div>

                <div class="row mt-1">
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoShadeLine" name="rdoGroupShade2" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeLine">แพทย์ส่งสีฟันมาทาง Line</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoShadeCompare" name="rdoGroupShade2" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeCompare">จะส่งคนไข้มาเทียบสีที่ Lab</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoShadeDoctor" name="rdoGroupShade2" onclick="Color(this.value,'Shade',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoShadeDoctor">รอถามแพทย์</label>
                    </div>
                    {{ Form::textarea('txtDoctorShade',null, ['class'=>'form-control hidden','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                  </div>
                @endif
                <div class="col-12">
                    {{ Form::textarea('txtCommentShade',$out_data_screen->txtCommentShade, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
                </div>
              </div>

              @if($out_data_screen->one_color =="สีเดียว")
                <div id="div-Shade-one" class="mt-3" style="display:block;">
              @else
                <div id="div-Shade-one" class="mt-3" style="display:none;">
              @endif
                <div class="bg-warning text-center mb-2">เลือกสีเดียว</div>
                <div class="row">
                  <div class="col-md-8 mb-1">
                    <select class="form-control form-control-sm" id="Shade-one-brand" name="ddlShadeBrand" onchange="SelectColor(this.value,'ddlShadeColor',this.id)">
                      <option value="0" >ยี่ห้อ</option>
                      @foreach ($screen_SHADE_Brand as $out_screen_SHADE_Brand)
                          @if($out_screen_SHADE_Brand->id == $out_data_screen->one_color_branch)
                            <option value="{{ $out_screen_SHADE_Brand->id }}" selected="selected">{{ $out_screen_SHADE_Brand->name }}</option>
                          @else
                            <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                          @endif
                      @endforeach
                      <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select class="form-control form-control-sm" id="Shade-one-color" name="ddlShadeColor">
                      <option value="0">สี</option>
                      @foreach ( $screen_SHADE_Colors as $out_screen_SHADE_Colors)
                        <option value="{{$out_screen_SHADE_Colors->id}}" {{$out_screen_SHADE_Colors->id==$out_data_screen->one_color_branch_color?'selected' :''}}>
                          {{$out_screen_SHADE_Colors->color}}
                        </option>
                      @endforeach
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
              @if($out_data_screen->one_color =="หลายสี")
                <div id="div-Shade-multi" class="mt-3" style="display:block;">
              @else
                <div id="div-Shade-multi" class="mt-3" style="display:none;">
              @endif
                <div class="bg-warning text-center mb-2">หลายสี</div>
                <div class="row">
                  <label class="col-md-3 col-form-label pr-0">คอฟัน</label>
                  <div class="col-md-5 pl-md-0 mb-1">
                    <select name="ddlShadeBrandMulti1" id="Shade-multi-brand1" class="form-control form-control-sm" onchange="SelectColor(this.value,'ddlShadeColordMulti1',this.id)">
                      <option value="0">ยี่ห้อ</option>
                      @foreach ( $screen_SHADE_Brand as $out_screen_SHADE_Brand)
                        @if($out_screen_SHADE_Brand->id == $out_data_screen->many_branch_crowns)
                          <option value="{{ $out_screen_SHADE_Brand->id }}" selected="selected">{{ $out_screen_SHADE_Brand->name }}</option>
                        @else
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                        @endif
                      @endforeach
                      <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select name="ddlShadeColordMulti1" id="Shade-multi-color1" class="form-control form-control-sm">
                        <option value="0" >สี</option>
                        @foreach ( $screen_SHADE_Colors1 as $out_screen_SHADE_Colors1)
                          <option value="{{$out_screen_SHADE_Colors1->id}}" {{$out_screen_SHADE_Colors1->id==$out_data_screen->many_color_crowns?'selected' :''}}>
                            {{$out_screen_SHADE_Colors1->color}}
                          </option>
                        @endforeach
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
                        @if($out_screen_SHADE_Brand->id == $out_data_screen->many_branch_Middle)
                          <option value="{{ $out_screen_SHADE_Brand->id }}" selected="selected">{{ $out_screen_SHADE_Brand->name }}</option>
                        @else
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                        @endif
                      @endforeach
                      <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select name="ddlShadeColordMulti2" id="Shade-multi-color2" class="form-control form-control-sm">
                      <option value="0" >สี</option>
                      @foreach ( $screen_SHADE_Colors2 as $out_screen_SHADE_Colors2)
                        <option value="{{$out_screen_SHADE_Colors2->id}}" {{$out_screen_SHADE_Colors2->id==$out_data_screen->many_color_Middle?'selected' :''}}>
                          {{$out_screen_SHADE_Colors2->color}}
                        </option>
                      @endforeach
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
                        @if($out_screen_SHADE_Brand->id == $out_data_screen->many_branch_tip)
                          <option value="{{ $out_screen_SHADE_Brand->id }}" selected="selected">{{ $out_screen_SHADE_Brand->name }}</option>
                        @else
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                        @endif
                      @endforeach
                      <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select name="ddlShadeColordMulti3" id="Shade-multi-color3" class="form-control form-control-sm">
                      <option value="0" >สี</option>
                      @foreach ( $screen_SHADE_Colors3 as $out_screen_SHADE_Colors3)
                        <option value="{{$out_screen_SHADE_Colors3->id}}" {{$out_screen_SHADE_Colors3->id==$out_data_screen->many_color_tip?'selected' :''}}>
                          {{$out_screen_SHADE_Colors3->color}}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row" id='div-ddlShadeColordMulti3-One-Color' style="display:none;">
                    <div class="col-md-3 col-form-label pr-0">
                    </div>
                    <div class="col-md-5 mb-1">
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
                @if($out_data_screen->stump == "สีเดียว")
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoStumpOneColor" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->stump == "แพทย์ส่งสีฟันมาทาง Line")
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="สีเดียว" class="custom-control-input" id="rdoStumpOneColor" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoStumpOneColor">สีเดียว</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="แพทย์ส่งสีฟันมาทาง Line" class="custom-control-input" id="rdoStumpLine" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->stump == "จะส่งคนไข้มาเทียบสีที่ Lab")
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
                      <input type="checkbox" value="จะส่งคนไข้มาเทียบสีที่ Lab" class="custom-control-input" id="rdoStumpCompare" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->stump == "รอถามแพทย์")
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
                      <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoStumpDoctor" name="rdoGroupStump" onclick="Color(this.value,'Stump',this.id)" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoStumpDoctor">รอถามแพทย์</label>
                    </div>
                    {{ Form::textarea('txtDoctorStump',$out_data_screen->comment_stump, ['class'=>'form-control','placeholder'=>'ระบุ','cols'=>'66' ,'rows'=>'2']) }}
                  </div>
                @elseif($out_data_screen->stump =="")
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
                @endif
                <div class="col-12">
                    {{ Form::textarea('txtCommentStump',$out_data_screen->txtCommentStump, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
                </div>
              </div>

              @if($out_data_screen->stump == "สีเดียว")
                <div id="div-Stump-one" class="mt-3" style="display:block;">
              @else
                <div id="div-Stump-one" class="mt-3" style="display:none;">
              @endif
                <div class="bg-warning text-center mb-2">สีเดียว</div>
                <div class="row">
                  <div class="col-md-8 mb-1">
                    <select class="form-control form-control-sm" id="Stump-one-brand" name="ddlStumpBrand" onchange="SelectColor(this.value,'ddlStumpColor',this.id)">
                      <option value="0">ยี่ห้อ</option>
                      @foreach ( $screen_SHADE_Brand as $out_screen_SHADE_Brand)
                        @if($out_screen_SHADE_Brand->id == $out_data_screen->one_branch_stump)
                          <option value="{{ $out_screen_SHADE_Brand->id }}" selected="selected">{{ $out_screen_SHADE_Brand->name }}</option>
                        @else
                          <option value="{{ $out_screen_SHADE_Brand->id }}">{{ $out_screen_SHADE_Brand->name }}</option>
                        @endif
                      @endforeach
                      <option value="อื่นๆ">อื่นๆ</option>
                    </select>
                  </div>
                  <div class="col-md-4 pl-md-0">
                    <select class="form-control form-control-sm" id="Stump-one-color" name="ddlStumpColor">
                      <option value="0">สี</option>
                      @foreach ( $screen_STUMP_Colors as $out_screen_STUMP_Colors)
                        <option value="{{$out_screen_STUMP_Colors->id}}" {{$out_screen_STUMP_Colors->id==$out_data_screen->one_color_stump?'selected' :''}}>
                          {{$out_screen_STUMP_Colors->color}}
                        </option>
                      @endforeach
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
                @if($out_data_screen->OCCLUSAL_STAINING  =="NONE")
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="NONE" class="custom-control-input" id="rdoStaining1" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->OCCLUSAL_STAINING  =="LIGHT")
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="NONE" class="custom-control-input" id="rdoStaining1" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStaining1">NONE</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="LIGHT" class="custom-control-input" id="rdoStaining2" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->OCCLUSAL_STAINING  =="MEDIUM")
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
                    <input type="checkbox" value="MEDIUM" class="custom-control-input" id="rdoStaining3" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoStaining3">MEDIUM</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="DARK" class="custom-control-input" id="rdoStaining4" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoStaining4">DARK</label>
                  </div>
                </div>
                @elseif($out_data_screen->OCCLUSAL_STAINING  =="DARK")
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
                    <input type="checkbox" value="DARK" class="custom-control-input" id="rdoStaining4" name="rdoStaining" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoStaining4">DARK</label>
                  </div>
                </div>
                @elseif($out_data_screen->OCCLUSAL_STAINING  =="")
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
                @endif
              </div>
            </div>
          </td>

          <td id="td-design" valign="top">
            <div id="div-mgmt-design">
              <div class="bg-success text-center">MARGIN AND METAL DESIGN</div>
              <div class="row mt-3">
                <div class="col-md-6 pr-md-1 text-center">
                  @if($out_data_screen->MARGIN1 == '11.png')
                    <input type="checkbox" name="MARGIN1" id="MARGIN1" class="hidden" value="11.png" onchange="checkOnlyOne(this.id,this.name)">
                  @else
                    <input type="checkbox" name="MARGIN1" id="MARGIN1" class="hidden" value="11.png" onchange="checkOnlyOne(this.id,this.name)">
                  @endif
                    <label for="MARGIN1" class="pointer text-center">
                      <img class="pontic" src="{{ asset('images/mental-design/11.png') }}" data-toggle="tooltip" title="Porcelain Margin" title="Porcelain Margin">
                    </label>

                  @if($out_data_screen->MARGIN1 == '12.png')
                    <input type="checkbox" name="MARGIN1" id="MARGIN2" class="hidden" value="12.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                  @else
                    <input type="checkbox" name="MARGIN1" id="MARGIN2" class="hidden" value="12.png" onchange="checkOnlyOne(this.id,this.name)">
                  @endif
                    <label for="MARGIN2" class="pointer text-center">
                      <img class="pontic" src="{{ asset('images/mental-design/12.png') }}" data-toggle="tooltip" title="Extended โดยรอบ">
                    </label>

                  @if($out_data_screen->MARGIN1 == '13.png')
                    <input type="checkbox" name="MARGIN1" id="MARGIN3" class="hidden" value="13.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                  @else
                    <input type="checkbox" name="MARGIN1" id="MARGIN3" class="hidden" value="13.png" onchange="checkOnlyOne(this.id,this.name)">
                  @endif
                    <label for="MARGIN3" class="pointer text-center">
                      <img class="pontic" src="{{ asset('images/mental-design/13.png') }}" data-toggle="tooltip" title="Extended Margin">
                    </label>

                  @if($out_data_screen->MARGIN1 == '14.png')
                    <input type="checkbox" name="MARGIN1" id="MARGIN4" class="hidden" value="14.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                  @else
                    <input type="checkbox" name="MARGIN1" id="MARGIN4" class="hidden" value="14.png" onchange="checkOnlyOne(this.id,this.name)" >
                  @endif
                    <label for="MARGIN4" class="pointer text-center">
                      <img class="pontic" src="{{ asset('images/mental-design/14.png') }}" data-toggle="tooltip" title="Matal Margin">
                    </label>
                </div>
                <div class="col-md-6 pl-md-1">
                  <div class="row">
                    <div class="col-md-6 py-1 pr-md-1">
                      <input type="text" class="form-control form-control-sm" placeholder="Buccal mm." name="MARGIN_Buccal" value="{{ $out_data_screen->MARGIN_Buccal }}">
                    </div>
                    <div class="col-md-6 py-1 pl-md-1">
                      <input type="text" class="form-control form-control-sm" placeholder="Lingual mm." name="MARGIN_Lingual" value="{{ $out_data_screen->MARGIN_Lingual }}">
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12 text-center">
                    @if($out_data_screen->MARGIN2 == '21.png')
                      <input type="checkbox" name="MARGIN2" id="sad4" class="hidden" value="21.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN2" id="sad4" class="hidden" value="21.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="sad4" class="pointer m-1">
                        <img class="pontic" src="{{ asset('images/mental-design/21.png') }}" data-toggle="tooltip" title="Porcelain Total Baking">
                    </label>
                    @if($out_data_screen->MARGIN2 == '22.png')
                      <input type="checkbox" name="MARGIN2" id="sad5" class="hidden" value="22.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN2" id="sad5" class="hidden" value="22.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                      <label for="sad5" class="pointer m-1">
                      <img class="pontic" src="{{ asset('images/mental-design/22.png') }}" data-toggle="tooltip" title="Porcelain Extended Margin">
                   </label>
                    @if($out_data_screen->MARGIN2 == '23.png')
                      <input type="checkbox" name="MARGIN2" id="sad6" class="hidden" value="23.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN2" id="sad6" class="hidden" value="23.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                   <label for="sad6" class="pointer m-1">
                      <img class="pontic" src="{{ asset('images/mental-design/23.png') }}" data-toggle="tooltip" title="Metal Margin">
                   </label>
                    @if($out_data_screen->MARGIN2 == '24.png')
                      <input type="checkbox" name="MARGIN2" id="sad7" class="hidden" value="24.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN2" id="sad7" class="hidden" value="24.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="sad7" class="pointer m-1">
                      <img class="pontic" src="{{ asset('images/mental-design/24.png') }}" data-toggle="tooltip" title="Occlusal Metal">
                    </label>
                    @if($out_data_screen->MARGIN2 == '25.png')
                      <input type="checkbox" name="MARGIN2" id="sad8" class="hidden" value="25.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN2" id="sad8" class="hidden" value="25.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="sad8" class="pointer m-1">
                      <img class="pontic" src="{{ asset('images/mental-design/25.png') }}" data-toggle="tooltip" title="3/4 Occlusal Metal">
                    </label>
                    @if($out_data_screen->MARGIN2 == '26.png')
                      <input type="checkbox" name="MARGIN2" id="sad9" class="hidden" value="26.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN2" id="sad9" class="hidden" value="26.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="sad9" class="pointer m-1">
                      <img class="pontic" src="{{ asset('images/mental-design/26.png') }}" data-toggle="tooltip" title="3/4 Metal เฉพาะด้านกัด">
                    </label>
                    @if($out_data_screen->MARGIN2 == '27.png')
                      <input type="checkbox" name="MARGIN2" id="sad10" class="hidden" value="27.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN2" id="sad10" class="hidden" value="27.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="sad10" class="pointer m-1">
                        <img class="pontic" src="{{ asset('images/mental-design/27.png') }}" data-toggle="tooltip" title="OCC. Metal เฉพาะด้านกัด">
                    </label>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12 text-center">
                    @if($out_data_screen->MARGIN3 == '31.png')
                      <input type="checkbox" name="MARGIN3" id="sad11" class="hidden" value="31.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN3" id="sad11" class="hidden" value="31.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="sad11" class="pointer m-1">
                      <img class="pontic" src="{{ asset('images/mental-design/31.png') }}" data-toggle="tooltip" title="หมอออกแบบเอง">
                   </label>
                    @if($out_data_screen->MARGIN3 == '32.png')
                      <input type="checkbox" name="MARGIN3" id="sad12" class="hidden" value="32.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN3" id="sad12" class="hidden" value="32.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                   <label for="sad12" class="pointer m-1">
                       <img class="pontic" src="{{ asset('images/mental-design/32.png') }}" data-toggle="tooltip" title="Lingual Metal Margin">
                   </label>
                    @if($out_data_screen->MARGIN3 == '33.png')
                      <input type="checkbox" name="MARGIN3" id="sad13" class="hidden" value="33.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN3" id="sad13" class="hidden" value="33.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                   <label for="sad13" class="pointer m-1">
                       <img class="pontic" src="{{ asset('images/mental-design/33.png') }}" data-toggle="tooltip" title="1/3 Lingual Metal Margin">
                   </label>
                    @if($out_data_screen->MARGIN3 == '34.png')
                      <input type="checkbox" name="MARGIN3" id="sad14" class="hidden" value="34.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN3" id="sad14" class="hidden" value="34.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                   <label for="sad14" class="pointer m-1">
                       <img class="pontic" src="{{ asset('images/mental-design/34.png') }}" data-toggle="tooltip" title="3/4 Lingual Metal Margin">
                   </label>
                    @if($out_data_screen->MARGIN3 == '35.png')
                      <input type="checkbox" name="MARGIN3" id="sad15" class="hidden" value="35.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input type="checkbox" name="MARGIN3" id="sad15" class="hidden" value="35.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                   <label for="sad15" class="pointer m-1">
                      <img class="pontic" src="{{ asset('images/mental-design/35.png') }}" data-toggle="tooltip" title="Lingual Metal">
                   </label>
                </div>
              </div>
            </div>

            <div id="div-pontic-design">
              <div class="bg-success text-center">PONTIC DESIGN</div>
              <div class="row mb-3">
                <div class="col-12 text-center">
                    @if($out_data_screen->PONTIC_DESIGN == '1.png')
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC1" value="1.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC1" value="1.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="PONTIC1" class="pointer m-2">
                      <img class="pontic" src="{{ asset('images/pontic-design/1.png') }}">
                    </label>

                    @if($out_data_screen->PONTIC_DESIGN == '2.png')
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC2" value="2.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC2" value="2.png" onchange="checkOnlyOne(this.id,this.name)" >
                    @endif
                    <label for="PONTIC2" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/2.png') }}">
                    </label>

                    @if($out_data_screen->PONTIC_DESIGN == '3.png')
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC4" value="3.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC4" value="3.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="PONTIC4" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/3.png') }}">
                    </label>

                    @if($out_data_screen->PONTIC_DESIGN == '4.png')
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC5" value="4.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC5" value="4.png" onchange="checkOnlyOne(this.id,this.name)" >
                    @endif
                    <label for="PONTIC5" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/4.png') }}"  >
                    </label>
                    @if($out_data_screen->PONTIC_DESIGN == '5.png')
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC6" value="5.png" onchange="checkOnlyOne(this.id,this.name)" checked>
                    @else
                      <input class="hidden" type="checkbox" name="PONTIC_DESIGN" id="PONTIC6" value="5.png" onchange="checkOnlyOne(this.id,this.name)">
                    @endif
                    <label for="PONTIC6" class="pointer m-2">
                        <img class="pontic" src="{{ asset('images/pontic-design/5.png') }}">
                    </label>
                </div>
              </div>
            </div>
          </td>

          <td id="td-contour" valign="top" >
            <div id="div-gingival" class="mb-3">
              <div class="bg-success text-center">GINGIVAL EMBRASURES</div>
              <div class="row">
                @if($out_data_screen->GINGIVAL_EMBRASURES  =="เปิด")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="เปิด" class="custom-control-input" id="chkOpenGingival" name="chkGingival" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="chkOpenGingival">เปิด</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="ปิด" class="custom-control-input" id="chkCloseGingival" name="chkGingival" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="chkCloseGingival">ปิด</label>
                    </div>
                  </div>
                @elseif($out_data_screen->GINGIVAL_EMBRASURES  =="ปิด")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="เปิด" class="custom-control-input" id="chkOpenGingival" name="chkGingival" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="chkOpenGingival">เปิด</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="ปิด" class="custom-control-input" id="chkCloseGingival" name="chkGingival" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="chkCloseGingival">ปิด</label>
                    </div>
                  </div>
                @elseif($out_data_screen->GINGIVAL_EMBRASURES  =="")
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
                @endif
              </div>
            </div>

            <div id="div-occlusion" class="mb-3">
              <div class="bg-success text-center">OCCLUSION</div>
                @if($out_data_screen->OCCLUSION =="สบสนิท")
                <div class="row">
                    <div class="col-md-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="สบสนิท" class="custom-control-input" id="chkOcclusion1" name="chkOcclusion" onchange="checkOnlyOne(this.id,this.name)" checked >
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
                @elseif($out_data_screen->OCCLUSION =="UNDER")
                  <div class="row">
                    <div class="col-md-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="สบสนิท" class="custom-control-input" id="chkOcclusion1" name="chkOcclusion" onchange="checkOnlyOne(this.id,this.name)" >
                        <label class="custom-control-label" for="chkOcclusion1">สบสนิท</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="UNDER" class="custom-control-input" id="chkOcclusion2" name="chkOcclusion" onchange="checkOnlyOne(this.id,this.name)" checked>
                        <label class="custom-control-label" for="chkOcclusion2">UNDER</label>
                      </div>
                    </div>
                  </div>

                  <div id="div-under" class="mt-2">
                    <div class="bg-warning text-center">UNDER (mm.)</div>
                    <div class="row">
                      @if($out_data_screen->unit_CONTOUR =="0.3")
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
                      @elseif($out_data_screen->unit_CONTOUR =="0.5")
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.3" class="custom-control-input" id="rdoUnder1" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder1">0.3</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.5" class="custom-control-input" id="rdoUnder2" name="rdoUnder" checked>
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
                      @elseif($out_data_screen->unit_CONTOUR =="1")
                      <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.3" class="custom-control-input" id="rdoUnder1" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder1">0.3</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.5" class="custom-control-input" id="rdoUnder2" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder2">0.5</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="1" class="custom-control-input" id="rdoUnder3" name="rdoUnder" checked>
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
                      @elseif($out_data_screen->unit_CONTOUR =="2")
                      <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.3" class="custom-control-input" id="rdoUnder1" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder1">0.3</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.5" class="custom-control-input" id="rdoUnder2" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder2">0.5</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="1" class="custom-control-input" id="rdoUnder3" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder3">1</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="2" class="custom-control-input" id="rdoUnder4" name="rdoUnder" checked>
                              <label class="custom-control-label" for="rdoUnder4">2</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="3" class="custom-control-input" id="rdoUnder5" name="rdoUnder">
                              <label class="custom-control-label" for="rdoUnder5">3</label>
                            </div>
                          </div>
                      @elseif($out_data_screen->unit_CONTOUR =="3")
                      <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.3" class="custom-control-input" id="rdoUnder1" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder1">0.3</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="0.5" class="custom-control-input" id="rdoUnder2" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder2">0.5</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="1" class="custom-control-input" id="rdoUnder3" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder3">1</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="2" class="custom-control-input" id="rdoUnder4" name="rdoUnder" >
                              <label class="custom-control-label" for="rdoUnder4">2</label>
                            </div>
                          </div>
                          <div class="col-6 col-md-4">
                            <div class="custom-control custom-radio">
                              <input type="radio" value="3" class="custom-control-input" id="rdoUnder5" name="rdoUnder" checked>
                              <label class="custom-control-label" for="rdoUnder5">3</label>
                            </div>
                          </div>
                      @elseif($out_data_screen->unit_CONTOUR =="")
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
                      @endif
                    </div>
                  </div>
                @elseif($out_data_screen->OCCLUSION  =="")
                  <div class="row">
                    <div class="col-md-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="สบสนิท" class="custom-control-input" id="chkOcclusion1" name="chkOcclusion" onchange="checkOnlyOne(this.id,this.name)" >
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
              @endif
            </div>

            <div id="div-contact" class="mb-3">
              <div class="bg-success text-center">CONTACT</div>
              <div class="row">
                @if($out_data_screen->CONTACT =="AREA")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="AREA" class="custom-control-input" id="chkContact1" name="chkContact" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="chkContact1">AREA</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="POINT" class="custom-control-input" id="chkContact2" name="chkContact" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="chkContact2">POINT</label>
                    </div>
                  </div>
                @elseif($out_data_screen->CONTACT  =="POINT")
                <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="AREA" class="custom-control-input" id="chkContact1" name="chkContact" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="chkContact1">AREA</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="POINT" class="custom-control-input" id="chkContact2" name="chkContact" onchange="checkOnlyOne(this.id,this.name)"checked>
                      <label class="custom-control-label" for="chkContact2">POINT</label>
                    </div>
                  </div>
                @elseif($out_data_screen->CONTACT  =="")
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="AREA" class="custom-control-input" id="chkContact1" name="chkContact" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="chkContact1">AREA</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="POINT" class="custom-control-input" id="chkContact2" name="chkContact" onchange="checkOnlyOne(this.id,this.name)" >
                      <label class="custom-control-label" for="chkContact2">POINT</label>
                    </div>
                  </div>
                @endif
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
                  @if($out_data_screen->Hook == 'มี Rest')
                    <input type="checkbox" value="มี Rest" class="custom-control-input" id="rdoHaveRest" name="rdoRest" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoHaveRest">มี Rest</label>
                  @else
                    <input type="checkbox" value="มี Rest" class="custom-control-input" id="rdoHaveRest" name="rdoRest" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoHaveRest">มี Rest</label>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->Hook == 'ไม่มี Rest')
                    <input type="checkbox" value="ไม่มี Rest" class="custom-control-input" id="rdoNoRest" name="rdoRest" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoNoRest">ไม่มี Rest</label>
                  @else
                    <input type="checkbox" value="ไม่มี Rest" class="custom-control-input" id="rdoNoRest" name="rdoRest" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoNoRest">ไม่มี Rest</label>
                  @endif
                </div>
              </div>
            </div>

            @if($out_data_screen->Hook == 'มี Rest')
              <div id="div-haverest" class="mt-3" style="display:block;">
            @endif
            @if($out_data_screen->Hook == 'ไม่มี Rest')
              <div id="div-haverest" class="mt-3" style="display:none;">
            @endif
                <div class="bg-success text-center">มี Rest</div>
                <div class="row">
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      @if($out_data_screen->MESIAL_REST == 'MESIAL REST')
                        <input type="checkbox" value="MESIAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest1" id="chkHaveRest1" checked>
                        <label class="custom-control-label" for="chkHaveRest1">MESIAL REST</label>
                      @else
                        <input type="checkbox" value="MESIAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest1" id="chkHaveRest1">
                        <label class="custom-control-label" for="chkHaveRest1">MESIAL REST</label>
                      @endif
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      @if($out_data_screen->DISTAL_REST == 'DISTAL REST')
                        <input type="checkbox" value="DISTAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest2" id="chkHaveRest2" checked>
                        <label class="custom-control-label" for="chkHaveRest2">DISTAL REST</label>
                      @else
                        <input type="checkbox" value="DISTAL REST" class="custom-control-input chkHaveRest" name="chkHaveRest2" id="chkHaveRest2">
                        <label class="custom-control-label" for="chkHaveRest2">DISTAL REST</label>
                      @endif
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      @if($out_data_screen->CINGULUM_REST == 'CINGULUM REST')
                        <input type="checkbox" value="CINGULUM REST" class="custom-control-input chkHaveRest" name="chkHaveRest3" id="chkHaveRest3" checked>
                        <label class="custom-control-label" for="chkHaveRest3">CINGULUM REST</label>
                      @else
                        <input type="checkbox" value="CINGULUM REST" class="custom-control-input chkHaveRest" name="chkHaveRest3" id="chkHaveRest3">
                        <label class="custom-control-label" for="chkHaveRest3">CINGULUM REST</label>
                      @endif
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      @if($out_data_screen->LINGUAL_LEDGE == 'LINGUAL LEDGE')
                        <input type="checkbox" value="LINGUAL LEDGE" class="custom-control-input chkHaveRest" name="chkHaveRest4" id="chkHaveRest4" checked>
                        <label class="custom-control-label" for="chkHaveRest4">LINGUAL LEDGE</label>
                      @else
                        <input type="checkbox" value="LINGUAL LEDGE" class="custom-control-input chkHaveRest" name="chkHaveRest4" id="chkHaveRest4">
                        <label class="custom-control-label" for="chkHaveRest4">LINGUAL LEDGE</label>
                      @endif
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      @if($out_data_screen->EMBRESSURE_REST == 'EMBRESSURE REST')
                        <input type="checkbox" value="EMBRESSURE REST" class="custom-control-input chkHaveRest" name="chkHaveRest5" id="chkHaveRest5" checked>
                        <label class="custom-control-label" for="chkHaveRest5">EMBRESSURE REST</label>
                      @else
                        <input type="checkbox" value="EMBRESSURE REST" class="custom-control-input chkHaveRest" name="chkHaveRest5" id="chkHaveRest5">
                        <label class="custom-control-label" for="chkHaveRest5">EMBRESSURE REST</label>
                      @endif
                    </div>
                  </div>
                </div>

                <div id="div-undercut" class="mt-3">
                  <div class="bg-success text-center">UNDERCUT</div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="custom-control custom-radio">
                        @if($out_data_screen->other_hook == 'มี UNDERCUT')
                          <input type="radio" value="มี UNDERCUT" class="custom-control-input" id="rdoHaveUndercut" name="rdoUndercut" checked>
                          <label class="custom-control-label" for="rdoHaveUndercut">มี</label>
                        @else
                          <input type="radio" value="มี UNDERCUT" class="custom-control-input" id="rdoHaveUndercut" name="rdoUndercut" >
                          <label class="custom-control-label" for="rdoHaveUndercut">มี</label>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="custom-control custom-radio">
                      @if($out_data_screen->other_hook == 'ไม่มี UNDERCUT')
                        <input type="radio" value="ไม่มี UNDERCUT" class="custom-control-input" id="rdoNoUndercut" name="rdoUndercut" checked>
                        <label class="custom-control-label" for="rdoNoUndercut">ไม่มี</label>
                      @else
                        <input type="radio" value="ไม่มี UNDERCUT" class="custom-control-input" id="rdoNoUndercut" name="rdoUndercut">
                        <label class="custom-control-label" for="rdoNoUndercut">ไม่มี</label>
                      @endif
                      </div>
                    </div>
                  </div>

                  <div id="div-haveundercut" class="mt-2" style="display:{{$out_data_screen->other_hook=='มี UNDERCUT' ?'' :'none;'}}">
                    <div class="bg-warning text-center">UNDERCUT (mm.)</div>
                    <div class="row">
                      <div class="col-md-4 col-lg-4">
                        <div class="custom-control custom-radio">
                          @if($out_data_screen->undercut_hook == 'UNDERCUT 0.01')
                            <input type="radio" value="UNDERCUT 0.01" class="custom-control-input" id="rdoHaveUndercut1" name="rdoGroupHaveUndercut" checked>
                            <label class="custom-control-label" for="rdoHaveUndercut1">0.01</label>
                          @else
                            <input type="radio" value="UNDERCUT 0.01" class="custom-control-input" id="rdoHaveUndercut1" name="rdoGroupHaveUndercut" >
                            <label class="custom-control-label" for="rdoHaveUndercut1">0.01</label>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-4">
                        <div class="custom-control custom-radio">
                          @if($out_data_screen->undercut_hook == 'UNDERCUT 0.02')
                            <input type="radio" value="UNDERCUT 0.02" class="custom-control-input" id="rdoHaveUndercut2" name="rdoGroupHaveUndercut" checked>
                            <label class="custom-control-label" for="rdoHaveUndercut2">0.02</label>
                          @else
                            <input type="radio" value="UNDERCUT 0.02" class="custom-control-input" id="rdoHaveUndercut2" name="rdoGroupHaveUndercut">
                            <label class="custom-control-label" for="rdoHaveUndercut2">0.02</label>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4 col-lg-4">
                        <div class="custom-control custom-radio">
                          @if($out_data_screen->undercut_hook == 'UNDERCUT 0.03')
                            <input type="radio" value="UNDERCUT 0.03" class="custom-control-input" id="rdoHaveUndercut3" name="rdoGroupHaveUndercut" checked>
                            <label class="custom-control-label" for="rdoHaveUndercut3">0.03</label>
                          @else
                            <input type="radio" value="UNDERCUT 0.03" class="custom-control-input" id="rdoHaveUndercut3" name="rdoGroupHaveUndercut">
                            <label class="custom-control-label" for="rdoHaveUndercut3">0.03</label>
                          @endif
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
                  @if($out_data_screen->model == 'SURGICAL GUIDE')
                    <input type="checkbox" value="SURGICAL GUIDE" class="custom-control-input" id="rdoModelSupergical" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoModelSupergical">SURGICAL GUIDE</label>
                  @else
                    <input type="checkbox" value="SURGICAL GUIDE" class="custom-control-input" id="rdoModelSupergical" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoModelSupergical">SURGICAL GUIDE</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->model == 'MODEL RESIN (PRINT MODEL)')
                    <input type="checkbox" value="MODEL RESIN (PRINT MODEL)" class="custom-control-input" id="rdoModelResin" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoModelResin">MODEL RESIN (PRINT MODEL)</label>
                  @else
                    <input type="checkbox" value="MODEL RESIN (PRINT MODEL)" class="custom-control-input" id="rdoModelResin" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoModelResin">MODEL RESIN (PRINT MODEL)</label>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <div class="custom-control custom-checkbox">
                  @if($out_data_screen->model == 'รอถามแพทย์')
                    <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoModelDoctor" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)" checked>
                    <label class="custom-control-label" for="rdoModelDoctor">รอถามแพทย์</label>
                  @else
                    <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoModelDoctor" name="rdoGroupModel" onchange="checkOnlyOne(this.id,this.name)">
                    <label class="custom-control-label" for="rdoModelDoctor">รอถามแพทย์</label>
                  @endif
                </div>
                <textarea name="txtDoctorModel" class="form-control hidden" rows="2" cols="66" placeholder="ระบุ"></textarea>
              </div>
              <div class="col-12">
                {{ Form::textarea('txtCommentModel',$out_data_screen->txtCommentModel, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
              </div>
            </div>

            <div id="div-model-resin" class="mt-3" style="display:{{$out_data_screen->model=='MODEL RESIN (PRINT MODEL)' ?'' :'none;'}};">
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
                @if($out_data_screen->implant_ceramage =="ระบบ TI-BASE")
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="ระบบ TI-BASE" class="custom-control-input" id="rdoTbase" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->implant_ceramage =="ระบบ TITANIUM CUSTOMED")
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="ระบบ TI-BASE" class="custom-control-input" id="rdoTbase" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoTbase">ระบบ TI-BASE</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="ระบบ TITANIUM CUSTOMED" class="custom-control-input" id="rdoTitanium" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoTitanium">ระบบ TITANIUM CUSTOMED</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="ระบบ STANDARD" class="custom-control-input" id="rdoStandard" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoStandard">ระบบ STANDARD</label>
                    </div>
                  </div>
                @elseif($out_data_screen->implant_ceramage =="ระบบ STANDARD")
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
                      <input type="checkbox" value="ระบบ STANDARD" class="custom-control-input" id="rdoStandard" name="rdoGroupSystem" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoStandard">ระบบ STANDARD</label>
                    </div>
                  </div>
                @elseif($out_data_screen->implant_ceramage =="")
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
                @endif
              </div>
            </div>
            <div id="div-retained" class="mb-3">
              <div class="bg-success text-center">การยึด</div>
              <div class="row">
              @if($out_data_screen->implant =="Cement-retained")
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Cement-retained" class="custom-control-input" id="rdoCement" name="rdoGroupRetained" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoCement">Cement-retained</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Screw-retained" class="custom-control-input" id="rdoScrew" name="rdoGroupRetained" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoScrew">Screw-retained</label>
                    </div>
                  </div>
              @elseif($out_data_screen->implant =="Screw-retained")
              <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Cement-retained" class="custom-control-input" id="rdoCement" name="rdoGroupRetained" onchange="checkOnlyOne(this.id,this.name)">
                      <label class="custom-control-label" for="rdoCement">Cement-retained</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Screw-retained" class="custom-control-input" id="rdoScrew" name="rdoGroupRetained" onchange="checkOnlyOne(this.id,this.name)" checked>
                      <label class="custom-control-label" for="rdoScrew">Screw-retained</label>
                    </div>
                  </div>
              @elseif($out_data_screen->implant =="")
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
              @endif
              </div>
            </div>
            <div id="div-brand" class="mb-3">
              <div class="bg-success text-center">ยึ่ห้อ IMPLANT</div>
              <div class="row">
                @if($out_data_screen->implant_brand == "STRAUMANN")
                  <div class="col-lg-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="STRAUMANN" class="custom-control-input" id="rdoBrand1" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->implant_brand =="ASTRA")
                    <div class="col-lg-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="STRAUMANN" class="custom-control-input" id="rdoBrand1" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)">
                        <label class="custom-control-label" for="rdoBrand1">STRAUMANN</label>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="ASTRA" class="custom-control-input" id="rdoBrand2" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->implant_brand =="OSSTEM")
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
                        <input type="checkbox" value="OSSTEM" class="custom-control-input" id="rdoBrand3" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                @elseif($out_data_screen->implant_brand =="อื่นๆ")
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
                        <input type="checkbox" value="อื่นๆ" class="custom-control-input" id="rdoBrand4" name="rdoGroupImpBrand" onchange="checkOnlyOne(this.id,this.name)" checked>
                        <label class="custom-control-label" for="rdoBrand4">อื่นๆ</label>
                      </div>
                      <input type="text" name="txtImpBrandOther" class="form-control form-control-sm" placeholder="ระบุ" value="{{ $out_data_screen->implant_brand_comment }}">
                    </div>
                @elseif($out_data_screen->implant_brand =="")
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
                @endif
              </div>
            </div>
            <div id="div-cement" class="mb-3">
              <div class="bg-success text-center">Fix Cement</div>
              <div class="row">
                @if($out_data_screen->FixCement == "ให้แลป Fix Cement ด้วย")
                    <div class="col-12">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="ให้แลป Fix Cement ด้วย" class="custom-control-input" id="rdoFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)" checked>
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
                      <textarea class="form-control hidden" placeholder="ระบุ" cols="66" rows="2" name="txtDoctorFix"></textarea>
                    </div>
                @elseif($out_data_screen->FixCement =="แลปไม่ต้อง Fix Cement")
                    <div class="col-12">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="ให้แลป Fix Cement ด้วย" class="custom-control-input" id="rdoFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)">
                        <label class="custom-control-label" for="rdoFix">ให้แลป Fix Cement ด้วย</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="แลปไม่ต้อง Fix Cement" class="custom-control-input" id="rdoNotFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)" checked>
                        <label class="custom-control-label" for="rdoNotFix">แลปไม่ต้อง Fix Cement</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoDoctorFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)">
                        <label class="custom-control-label" for="rdoDoctorFix">รอถามแพทย์</label>
                      </div>
                      <textarea class="form-control hidden" placeholder="ระบุ" cols="66" rows="2" name="txtDoctorFix"></textarea>
                    </div>
                @elseif($out_data_screen->FixCement =="รอถามแพทย์")
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
                        <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" id="rdoDoctorFix" name="rdoFixCement" onchange="checkOnlyOne(this.id,this.name)" checked>
                        <label class="custom-control-label" for="rdoDoctorFix">รอถามแพทย์</label>
                      </div>
                      <textarea class="form-control " placeholder="ระบุ" cols="66" rows="2" name="txtDoctorFix">{{$out_data_screen->comment_fix_cement}}</textarea>
                    </div>
                @elseif($out_data_screen->FixCement =="")
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
                      <textarea class="form-control hidden" placeholder="ระบุ" cols="66" rows="2" name="txtDoctorFix"></textarea>
                    </div>
                @endif
                <div class="col-12">
                    {{ Form::textarea('txtCommentFixCement',$out_data_screen->txtCommentFixCement, ['class'=>'form-control','placeholder'=>'หมายเหตุ','cols'=>'66' ,'rows'=>'2']) }}
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
                  <input type="checkbox" value="PINTOOTH" class="custom-control-input" id="rdopintooth" name="rdopintooth" onchange="checkOnlyOne(this.id,this.name)" {{$out_data_screen->Pintooth == 'PINTOOTH' ?'checked':null }}>
                  <label class="custom-control-label" for="rdopintooth">PINTOOTH</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="COOPING" class="custom-control-input" id="rdocooping" name="rdopintooth" onchange="checkOnlyOne(this.id,this.name)" {{$out_data_screen->Pintooth == 'COOPING' ?'checked':null }}>
                  <label class="custom-control-label" for="rdocooping">COOPING</label>
                </div>
              </div>
            </div>
          </td>
          <td valign="top">
            <div class="row">
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="มี Rest" class="custom-control-input" id="rdopintoothhookHaveRest" name="rdopintoothhook" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothHook == 'มี Rest' ?'checked':null }}>
                  <label class="custom-control-label" for="rdopintoothhookHaveRest">มี Rest</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="ไม่มี Rest" class="custom-control-input" id="rdopintoothhookNoRest" name="rdopintoothhook" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothHook == 'ไม่มี Rest' ?'checked':null }}>
                  <label class="custom-control-label" for="rdopintoothhookNoRest">ไม่มี Rest</label>
                </div>
              </div>
            </div>

            <div id="div-pintoothhaverest" class="mt-3">
              <div class="bg-success text-center">มี Rest</div>
              <div class="row">
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="MESIAL REST" class="custom-control-input" name="chkHaveRestpintooth" id="chkHaveRestpintooth1" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothHookRest == 'MESIAL REST' ?'checked':null }}>
                    <label class="custom-control-label" for="chkHaveRestpintooth1">MESIAL REST</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="DISTAL REST" class="custom-control-input" name="chkHaveRestpintooth" id="chkHaveRestpintooth2" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothHookRest == 'DISTAL REST' ?'checked':null }}>
                    <label class="custom-control-label" for="chkHaveRestpintooth2">DISTAL REST</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" value="MESIAL/DISTAL REST" class="custom-control-input" name="chkHaveRestpintooth" id="chkHaveRestpintooth3" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothHookRest == 'MESIAL/DISTAL REST' ?'checked':null }}>
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
                  <input type="checkbox" value="NON PRECIOUS" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys1" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'NON PRECIOUS' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys1">NON PRECIOUS</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="PALLADIUM" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys2" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'PALLADIUM' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys2">PALLADIUM</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="SEMI PRECIOUS" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys3" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'SEMI PRECIOUS' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys3">SEMI PRECIOUS</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="HIGH PRECIOUS" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys4" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'HIGH PRECIOUS' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys4">HIGH PRECIOUS</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="ZIRCONIA" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys5" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'ZIRCONIA' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys5">ZIRCONIA</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="CERAMAGE" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys6" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'CERAMAGE' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys6">CERAMAGE</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="COMPOSITE" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys7" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'COMPOSITE' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys7">COMPOSITE</label>
                </div>
              </div>
              <div class="col-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="รอถามแพทย์" class="custom-control-input" name="chkpintoothalloys" id="chkpintoothalloys8" onclick="checkOnlyOne(this.id,this.name)" {{$out_data_screen->PintoothAlloys == 'รอถามแพทย์' ?'checked':null }}>
                  <label class="custom-control-label" for="chkpintoothalloys8">รอถามแพทย์</label>
                </div>
              </div>
              <div class="col-12" id="Notepintoothalloys">
              <textarea name="Notepintoothalloys" class="form-control" rows="2" cols="66" placeholder="หมายเหตุ">{{$out_data_screen->PintoothAlloysNote}}</textarea>
              </div>
              <div class="col-12 hidden" id="Commentpintoothalloys">
                <textarea name="Commentpintoothalloys" class="form-control" rows="2" cols="66" placeholder="ระบุ">{{$out_data_screen->PintoothAlloysComment}}</textarea>
              </div>
            </div>
          </td>
        </tr>
      </table>
      @endforeach
    </div>

    <div class="col-12 px-0 mt-2 text-right">
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

  //pintooth

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
    if($("#rdopintoothhookNoRest").prop('checked')==true){
      $("#div-pintoothhaverest").hide();
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

  function NewBarcode(){
      document.getElementById("RefBarcode").disabled = true;
      document.getElementById("RefBarcode2").disabled = false;
  }
  function edit_Barcode(){
      document.getElementById("RefBarcode").disabled = false;
      document.getElementById("RefBarcode2").disabled = true;
  }
  function Cont_Barcode(){
      document.getElementById("RefBarcode").disabled = false ;
      document.getElementById("RefBarcode2").disabled = true;
  }
</script>

@stop
