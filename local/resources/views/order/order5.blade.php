@extends('layouts.template')

@section('stylesheet')
<!-- plugin css for this page -->

<style type="text/css">
    /*.card-body .col-md-4{ border-right: 1px solid; }*/
    /*Timeline*/
    .timeline{
        position: relative;
    }
    /*line*/
    .tl>li::before{
        content:'';
        position: absolute;
        width: 1px;
        background-color: black;
        top: 0;
        bottom: 0;
        left:-19px;
    }
    /*circle*/
    .tl>li::after{
        text-align: center;
        padding-top:10px;
        z-index: 10;
        content:counter(item);
        position: absolute;
        width: 50px;
        height: 50px;
        border:1px solid black;
        background-color: #19d895;
        border-radius: 50%;
        top:0;
        left:-43px;
    }
    .tl>li.yellow::after{
        background-color: #ffaf00;
    }
    .tl>li.white::after{
        background-color: white;
    }
    /*content*/
    .tl>li{
        counter-increment: item;
        padding: 10px 10px;
        margin-left: 0px;
        min-height:70px;
        position: relative;
        list-style: none;
    }
    .tl>li:nth-last-child(1)::before{
        width: 0px;
    }
    /*End Timeline*/

    /*Tooth*/
    #tooth-check{
        display: none;
    }
    .tooth-chart{
        width:80%;
        margin: auto;
    }
    #tooth-lbl > text{
        font-family: 'Avenir-Heavy';
    }
    polygon, path{
        -webkit-transition:fill .25s;
        transition:fill .25s;
    }
    polygon:hover, polygon:active, #tooth-polygon>path:hover, #tooth-polygon>path:active{
        fill:red !important;
        cursor: pointer;
    }
    /*End Tooth*/

    input[type=checkbox]{
        display: none;
    }
    .lbl{
        border:1px solid;
        border-radius: 50%;
        cursor: pointer;
        width: 25px;
        height: 25px;
    }
    .lbl:hover{
        opacity: 0.5;
    }
    .check {
        color: blue;
        background: blue;
    }
    .img-tooth{
        width: 25px;
        height: 25px;
        margin-bottom: 15px;
        margin-right: 15px;
    }
    .tbl-tooth {
        margin: auto;
    }
    .tbl-tooth td{
        /*border:1px solid black;*/
    }

    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 17.5px;
        margin-bottom: 6px;
        cursor: pointer;
        font-size: 12px;
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
        height: 12.5px;
        width: 12.5px;
        background-color: #eee;
        border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after {
        top: 4.5px;
        left: 4.5px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: white;
    }
    .radio-toolbar {
        margin: 5px;
    }
    .radio-toolbar input[type="radio"] {
        display:none;
    }

    .radio-toolbar label {
        display:inline-block;
        background-color:#ddd;
        width: 100%;
        height: auto;
        padding: 10px;
        font-size:12px;

        /* border: 2px solid #444; */
        /* border-radius: 4px;     */
    }
    .radio-toolbar label:hover {
    background-color: #898989;
    }

    .radio-toolbar input[type="radio"]:checked + label {
        color: #fff;
        background-color: #19d895;
        border-color: #19d895;
    }
    .select{
        color: #FFE000;
        background: #FFE000;
    }
    .selected{
        color: #00D413;
        background: #00D413;
    }
    </style>
    <script>
        function OnLoad(n){
                //$('.lbl_green_'+n).addClass('check');
                //document.getElementById('lbl_green_'+n).classList.toggle("check");
            setTimeout(function() {
                $(".img-tooth-"+n).addClass('img-tooth');
                $('#lbl_green_'+n).addClass('lbl_green_'+n);
                $('#lbl_green_'+n).addClass('select');
            }, 10);
        }
        function select(n){
                //$('.lbl_green_'+n).addClass('check');
                //document.getElementById('lbl_green_'+n).classList.toggle("check");
            setTimeout(function() {
                $('#lbl_green_'+n).addClass('selected');
            }, 10);
        }
    </script>
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css" />
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
                     {{ Form::open(['method' => 'post' , 'url' => '/order5/addgroupteeth']) }}
                    <div class="row mt-3">
                        <div class="col-md-3 m-0 step-timeline">
                            <ul class="m-0 step-list">
                                <li>บันทึกรหัสสั่งผลิต (Barcode)</li>
                                <li>ข้อมูลลูกค้า & คนไข้</li>
                                <li>เลือกแลปที่ผลิต</li>
                                <li>เลือกซี่ฟัน & ชนิดงาน & ชนิดสินค้า</li>
                                <li class="yellow">จัดกลุ่มซี่ฟัน</li>
                                <li class="white">สิ่งที่ส่งมาด้วย</li>
                                <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                            </ul>
                        </div>
                        <div class="col-md-9 step-content">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                    <li class="breadcrumb-item active" aria-current="page">จัดกลุ่มซี่ฟัน</li>
                                </ol>
                            </nav>
                            <div class="card">
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>โรงงานผลิต
                                        </a>
                                    </h6>
                                </div>
                                <div class="card-body justify-content-center align-items-center">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <table class="tbl-tooth" height="10">
                                                <tr>
                                                    <td class="text-center"><h5>UR (1)</h5></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_12" style="margin-top:30px;margin-right:2px;" >
                                                            <img src="./images/tooth3color/12.png" class="img-tooth img-tooth-12" id="img-tooth-12" onclick="check(12)" >
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_11" style="margin-right:2px;">
                                                            <img src="./images/tooth3color/11.png" class="img-tooth img-tooth-11" id="img-tooth-11" onclick="check(11)">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_21" style="margin-left:2px;">
                                                            <img  src="./images/tooth3color/21.png" class="img-tooth img-tooth-21" id="img-tooth-21" onclick="check(21)">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_22" style="margin-top:30px;margin-left:2px;">
                                                            <img src="./images/tooth3color/22.png" class="img-tooth img-tooth-22" id="img-tooth-22" onclick="check(22)">
                                                        </label>

                                                    </td>
                                                    <td></td>
                                                    <td class="text-center"><h5>UL (2)</h5></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_13" style="margin-left:55px;margin-top:-50px;">
                                                            <img src="./images/tooth3color/13.png" class="img-tooth img-tooth img-tooth-13" id="img-tooth-13" onclick="check(13)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_23" style="margin-right:55px;margin-top:-15px;">
                                                            <img src="./images/tooth3color/23.png" class="img-tooth img-tooth-23" id="img-tooth-23" onclick="check(23)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_14" style="margin-right:-10px; margin-top:-5px;">
                                                            <img src="./images/tooth3color/14.png" class="img-tooth img-tooth-14" id="img-tooth-14" onclick="check(14)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_24" style="margin-left:-10px; margin-top:-5px;">
                                                            <img src="./images/tooth3color/24.png" class="img-tooth img-tooth-24" id="img-tooth-24" onclick="check(24)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_15" style="margin-right:-110px;margin-top:-5px;">
                                                            <img src="./images/tooth3color/15.png" class="img-tooth img-tooth-15" id="img-tooth-15" onclick="check(15)" >
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
                                                            <img src="./images/tooth3color/25.png" class="img-tooth img-tooth-25" id="img-tooth-25" onclick="check(25)" >
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_16" style="margin-right:-90px;margin-top:-5px;">
                                                            <img src="./images/tooth3color/16.png" class="img-tooth img-tooth-16" id="img-tooth-16" onclick="check(16)">
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
                                                            <img src="./images/tooth3color/26.png" class="img-tooth img-tooth-26" id="img-tooth-26" onclick="check(26)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_17" style="margin-right:-80px;margin-top:-5px;">
                                                            <img src="./images/tooth3color/17.png" class="img-tooth img-tooth-17" id="img-tooth-17" onclick="check(17)">
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
                                                            <img src="./images/tooth3color/27.png" class="img-tooth img-tooth-27" id="img-tooth-27" onclick="check(27)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_18" style="margin-right:-70px;margin-top:-10px;">
                                                            <img src="./images/tooth3color/18.png" class="img-tooth img-tooth-18" id="img-tooth-18" onclick="check(18)">
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
                                                            <img src="./images/tooth3color/28.png" class="img-tooth img-tooth-28" id="img-tooth-28" onclick="check(28)">
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
                                                            <img src="./images/tooth3color/48.png" class="img-tooth img-tooth-48" id="img-tooth-48" onclick="check(48)">
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
                                                            <img src="./images/tooth3color/38.png" class="img-tooth img-tooth-38" id="img-tooth-38" onclick="check(38)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_47" style="margin-right:-80px;margin-bottom:0px;">
                                                            <img src="./images/tooth3color/47.png" class="img-tooth img-tooth-47" id="img-tooth-47" onclick="check(47)">
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
                                                            <img src="./images/tooth3color/37.png" class="img-tooth img-tooth-37" id="img-tooth-37" onclick="check(37)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_46" style="margin-right:-90px;margin-bottom:0px;">
                                                            <img src="./images/tooth3color/46.png" class="img-tooth img-tooth-46" id="img-tooth-46" onclick="check(46)">
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
                                                            <img src="./images/tooth3color/36.png" class="img-tooth img-tooth-36" id="img-tooth-36" onclick="check(36)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_45" style="margin-right:-110px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/45.png" class="img-tooth img-tooth-45" id="img-tooth-45" onclick="check(45)">
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
                                                            <img src="./images/tooth3color/35.png" class="img-tooth img-tooth-35" id="img-tooth-35" onclick="check(35)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_44" style="margin-right:-140px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/44.png" class="img-tooth img-tooth-44" id="img-tooth-44" onclick="check(44)">
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
                                                            <img src="./images/tooth3color/34.png" class="img-tooth img-tooth-34" id="img-tooth-34" onclick="check(34)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_43" style="margin-left:55px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/43.png" class="img-tooth img-tooth-43" id="img-tooth-43" onclick="check(43)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_33" style="margin-right:55px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/33.png" class="img-tooth img-tooth-33" id="img-tooth-33" onclick="check(33)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><h5>LR (3)</h5></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_42" style="margin-bottom:50px;margin-right:2px;">
                                                            <img src="./images/tooth3color/42.png" class="img-tooth img-tooth-42" id="img-tooth-42" onclick="check(42)">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl" id="lbl_green_41" style="margin-right:2px;">
                                                            <img src="./images/tooth3color/41.png" class="img-tooth img-tooth-41" id="img-tooth-41" onclick="check(41)">
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="lbl" id="lbl_green_31" style="margin-left:2px;">
                                                            <img src="./images/tooth3color/31.png" class="img-tooth img-tooth-31" id="img-tooth-31" onclick="check(31)">
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="lbl" id="lbl_green_32" style="margin-bottom:50px;margin-left:2px;">
                                                            <img src="./images/tooth3color/32.png" class="img-tooth img-tooth-32" id="img-tooth-32" onclick="check(32)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td class="text-center"><h5>LL (4)</h5></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="row grid-margin">
                                                <div class="card-header" role="tab" id="headingThree" >
                                                    <h6 class="mb-1">
                                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                                                            <label style=" font-size:18px;"><i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Type of Group</label>
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div class="col-15 grid-margin stretch-card">
                                                    <div class="card mt-12" style="height : 100%; auto; overflow-y: auto;">
                                                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion" >
                                                            <div class="card-body">
                                                                <div class="radio-toolbar text-center justify-content-center">
                                                                    @foreach($type_of_group as $out_type_of_group)
                                                                        @if ($loop->first)
                                                                            <input type="radio" id="{{ $out_type_of_group->Name }}" name="TypeOfGroupID" value="{{ $out_type_of_group->ID }}" checked>
                                                                            <label for="{{ $out_type_of_group->Name}}">{{ $out_type_of_group->Name }}</label>
                                                                        @else
                                                                            <input type="radio" id="{{ $out_type_of_group->Name }}" name="TypeOfGroupID" value="{{ $out_type_of_group->ID }}">
                                                                            <label for="{{ $out_type_of_group->Name}}">{{ $out_type_of_group->Name }}</label>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                @foreach($id_sale as $out_id_sale)
                                                    <input type="hidden" name="id_sale" value="{{ $out_id_sale->ID }}">
                                                @endforeach
                                                @foreach($group_no as $out_group_no)
                                                    <input type="hidden" name="group_no" value="{{ $out_group_no->max_group+1 }}">
                                                @endforeach
                                                @foreach($id_screen as $out_id_screen)
                                                    <input type="hidden" name="id_screen" value="{{ $out_id_screen->ID }}">
                                                @endforeach

                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" id="submit" class="btn btn-primary btn-fw p-3" >บันทึกกลุ่มฟัน</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        @if($out_teeth->TeethID == $k && $out_teeth->TypeOfGroupID == null && $out_teeth->GroupNo == null)
                                            @php $x=$k; @endphp
                                            <img class="img" src="./images/test.gif" width="0" height="0" onload="OnLoad({{$k}})">
                                        @elseif($out_teeth->TeethID == $k )
                                            @php $y=$k; @endphp
                                            <img class="img" src="./images/test.gif" width="0" height="0" onload="select({{$k}})">
                                        @endif
                                    @endforeach
                                @endfor
                            @endfor
                        </div>
                        {{ Form::close() }}
                        <div class="card-body">
                            <table  class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tooth Number</th>
                                        <th>Type of Work</th>
                                        <th>Type of Product</th>
                                        <th>Type of Group</th>
                                        {{-- <th>กลุ่มงานที่</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach($teeth as $out_teeth)
                                    {{ Form::open(['method' => 'post' , 'url' => '/order5/'.$out_teeth->ID.'/delete']) }}
                                        <tbody>
                                            <tr>
                                                <td>{{ $out_teeth->TeethID }}</td>
                                                <td>{{ $out_teeth->NameWork }}</td>
                                                <td>{{ $out_teeth->NameProduct }}</td>
                                                @if($out_teeth->TypeOfGroupID != null)
                                                <td>{{ $out_teeth->NameGroup }}</td>
                                                @else
                                                <td>-</td>
                                                @endif
                                                {{-- @if($out_teeth->GroupNo != null)
                                                <td>{{ $out_teeth->GroupNo }}</td>
                                                @else
                                                <td>-</td>
                                                @endif --}}
                                                <td>
                                                    <button type="submit" id="submit" class="btn btn-danger">
                                                        ยกเลิกกลุ่ม
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    {{ Form::close() }}
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12 text-right">
                            <a href="{{ url('order4') }}">
                                <button type="button" class="btn btn-lg btn-success">
                                    <i class="mdi mdi-arrow-left-bold"></i>ย้อนกลับ
                                </button>
                            </a>
                            {{-- @if($x == '' && $y != '') --}}
                                <a href="{{ url('order7') }}">
                                    <button class="btn btn-lg btn-success">
                                        ต่อไป
                                        <i class="mdi mdi-arrow-right-bold"></i>
                                    </button>
                                </a>
                            {{-- @elseif($x != '' && $y != '')
                                <a onclick="alert('กรุณาจัดกลุ่มซี่ฟันให้ครบ')">
                                    <button class="btn btn-lg btn-success">
                                        ต่อไป<i class="mdi mdi-arrow-right-bold"></i>
                                    </button>
                                </a>
                            @endif--}}
                        </div>
                    </div>
        {{-- STEP 5 --}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script type="text/javascript">
        function chkTooth(id){ //console.log(id)
          var color = $('#'+id).attr('fill');
          if(color=='#00dc28'){
            $('#'+id).attr('fill','red');
            $('.chk'+id).attr('checked',true);
          }else{
            $('#'+id).attr('fill','#00dc28');
            $('.chk'+id).attr('checked',false);
          }
        }

        $(document).ready(function() {
                $('#example').dataTable();
            }
        )

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
    </script>
@stop

