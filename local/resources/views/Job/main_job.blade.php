@extends('layouts.template')

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
        display:none;
    }
    input[type=radio]:checked + label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }
    .radio-toolbar label {
        display:inline-block;
        background-color:#ddd;
        width: 100%;
        height: auto;
        padding: 8%;
        font-size:14px;
        border-radius: 4px;
    }
    .radio-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }
    .radio-toolbar input[type="radio"]:checked + label {
        background-color: #19d895;
        border-color: #19d895;
    }
    /* End Radio */

    /* Check Box */
    .checkbox-toolbar {
        margin: 10px;
    }
    .checkbox-toolbar input[type="checkbox"] {
        display:none;
    }
    input[type="checkbox"]:checked + label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }
    .checkbox-toolbar label {
        display:inline-block;
        background-color:#ddd;
        width: 100%;
        height: auto;
        padding: 8%;
        font-size:14px;
        border-radius: 4px;
    }
    .checkbox-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar input[type="checkbox"]:checked + label {
        background-color: #19d895;
        border-color: #19d895;
    }
    /* End Check Box */
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
    /* The container */
    .select{
        color: #FFE000;
        background: #FFE000;
    }
    .selected{
        color: #00D413;
        background: #00D413;
    }
    .input-hidden {
        display: none;
    }
    .pontic{
        border: 0px dashed #444;
        width: 75px;
        height: 75px;
        transition: 500ms all;
    }
    .margin{
        border: 0px dashed #444;
        width: 50px;
        height: 50px;
        margin: 5px;
        transition: 500ms all;
    }
</style>
<script>
    function OnLoad(n){
        setTimeout(function() {
            $(".img-tooth-"+n).addClass('img-tooth');
            $('#lbl_green_'+n).addClass('lbl_green_'+n);
            $('#lbl_green_'+n).addClass('select');
        }, 10);
    }
    function select(n){
        setTimeout(function() {
            $('#lbl_green_'+n).addClass('selected');
        }, 10);
    }
</script>
@stop

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header header-sm">
                        <div class="align-items-center">
                            <div class="media-info">
                                <label class="card-title font-weight-bold">รายการงานทั้งหมด</label>
                            </div>
                        </div>
                    </div>
                <!--data table-->
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รหัส</th>
                                    <th>ชื่อแลป</th>
                                    <th>ประเภท</th>
                                    <th>ชื่อคลินิก/รพ.</th>
                                    <th>ชื่อแพทย์</th>
                                    <th>ชื่อคนไข้</th>
                                    {{-- <th>วันเวลารับ</th> 
                                    <th>วันเวลาสั่ง</th>
                                    <th>สถานะ</th>--}}
                                    <th>รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>QA1234</td>
                                    <td>PCDental Lab</td>
                                    <td>คลินิก</td>
                                    <td>คลินิกทันตกรรม วีแรนด้า</td>
                                    <td>ทญ.นพรัตน์ เบิกฟ้า </td>
                                    <td>นายทดสอบ ระบบ</td>
                                    {{-- <td>17/12/2018</td>
                                    <td>12/02/2019</td>
                                    <td>กำลังทำ</td>--}}
                                    <td>
                                        <button class="btn btn-warning" style="padding:10px;" data-toggle="modal" data-target="#Modal">
                                            แก้ไขข้อมูล
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--end data table-->
                </div>
            </div>
        </div>

        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
            <div class="modal-dialog modal-lg" role="document" style="width:80%">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-header header-sm">
                            <label>แก้ไขข้อมูลงาน</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="accordion basic-accordion" role="tablist">
                                    <div class="card">
                                        <div class="card-header" role="tab" id="orderRequestTypeID">
                                            <h6 class="mb-0">
                                                <a data-toggle="collapse" href="#Doctor" aria-expanded="true" aria-controls="Doctor">
                                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>แก้ไขข้อมูลแพทย์
                                                </a>
                                            </h6>
                                        </div>
                                        <div id="Doctor" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-1" for="type_doctor">ประเภท</label>
                                                    <div class="col-sm-11">
                                                        <select class="form-control" id="type_doctor" name="type_doctor">
                                                            <option value="" disabled selected hidden>ประเภทแพทย์</option>
                                                            <option value="1">ปกติ</option>
                                                            <option value="2">VIP</option>
                                                        </select>
                                                        {{-- {{ Form::select('type_doctor',array(null => 'ประเภท', '1' => 'ปกติ', '2' => 'VIP'), ['class' => 'form-control','placeholder' => 'ประเภท']) }} --}}
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">  
                                                    <label class="col-form-label col-sm-1" for="name_doctor">ทพ./ทญ.</label>
                                                    <div class="col-sm-5">
                                                        {{ Form::text('name_doctor','นพรัตน์', ['class' => 'form-control','placeholder' => 'ชื่อแพทย์']) }}
                                                    </div>    
                
                                                    <label class="col-form-label col-sm-1" for="surname_doctor">นามสกุลแพทย์</label>
                                                    <div class="col-sm-5">
                                                        {{ Form::text('surname_doctor','เบิกฟ้า', ['class' => 'form-control','placeholder' => 'นามสกุลแพทย์']) }}
                                                    </div>
                                                </div>
                
                                                <div class="form-group row"> 
                                                    <label class="col-form-label col-sm-1" for="custommer_doctor">รพ./คลินิก</label>
                                                    <div class="col-sm-11">
                                                        <select class="form-control" id="custommer_doctor" name="custommer_doctor">
                                                            <option value="" disabled selected hidden>โรงพยาบาล/คลินิก</option>
                                                            <option value="1">โรงพยาบาลปิยะเวท</option>
                                                            <option value="2">โรงพยาบาลรามาธิบดี</option>
                                                        </select>
                                                        {{-- {{ Form::select('custommer_doctor',array('1' => 'โรงพยาบาลปิยะเวท', '2' => 'โรงพยาบาลรามาธิบดี'), ['class' => 'form-control','placeholder' => 'โรงพยาบาล/คลินิก']) }} --}}
                                                    </div>
                                                </div>
                
                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-1" for="address_doctor">Address</label>
                                                    <div class="col-sm-11">
                                                        {{ Form::textarea('address_doctor','ว่าง', ['class' => 'form-control','placeholder' => 'ที่อยู่แพทย์']) }}
                                                    </div>
                                                </div>
                                    
                                                <div class="form-group row">
                                                    <label class="col-form-label col-sm-1" for="email_doctor">E-mail</label>
                                                    <div class="col-sm-5">
                                                        {{ Form::text('email_doctor','ว่าง', ['class' => 'form-control','placeholder' => 'อีเมล์แพทย์']) }}
                                                    </div>
                                    
                                                    <label class="col-form-label col-sm-1" for="line_id_doctor">Line ID</label>
                                                    <div class="col-sm-5">
                                                        {{ Form::text('line_id_doctor','ว่าง', ['class' => 'form-control','placeholder' => 'Line ID แพทย์']) }}
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="accordion basic-accordion" role="tablist">
                                    <div class="card">
                                        <div class="card-header" role="tab" id="orderRequestTypeID">
                                            <h6 class="mb-0">
                                                <a data-toggle="collapse" href="#Patient" aria-expanded="true" aria-controls="Patient">
                                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>แก้ไขข้อมูลคนไข้
                                                </a>
                                            </h6>
                                        </div>
                                        <div id="Patient" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                            <div class="card-body">
                                                 <div class="form-group row">
                                                     <label class="col-form-label col-sm-1" for="name_patient">ชื่อ</label>
                                                     <div class="col-sm-5">
                                                         {{ Form::text('name_patient','นายทดสอบ' , ['class' => 'form-control','placeholder' => 'ชื่อคนไข้']) }}
                                                     </div>
                
                                                     <label class="col-form-label col-sm-1" for="surname_patient">นามสกุล</label>
                                                     <div class="col-sm-5">
                                                         {{ Form::text('surname_patient','ระบบ', ['class' => 'form-control','placeholder' => 'นามสกุลคนไข้']) }}
                                                     </div>
                                                 </div>
                
                                                 <div class="form-group row">
                                                     <label class="col-form-label col-sm-1" for="email_patient">อายุ</label>
                                                     <div class="col-sm-2">
                                                         {{ Form::number('email_patient','23', ['class' => 'form-control','placeholder' => 'อายุคนไข้']) }}
                                                     </div>
                                                     <div class="col-sm-3">
                                                     </div>
                
                                                     <label class="col-form-label col-sm-1" for="surname_patient">เพศคนไข้</label>
                                                     <div class="col-sm-5">
                                                         <select class="form-control" id="custommer_doctor" name="custommer_doctor">
                                                             <option value="" disabled selected hidden>เลือกเพศ</option>
                                                             <option value="1">ชาย</option>
                                                             <option value="2">หญิง</option>
                                                             <option value="3">อื่นๆ</option>
                                                         </select>
                                                     </div>
                                                 </div>                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#Screen" aria-expanded="true" aria-controls="Screen">
                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>แก้ไขข้อมูล Screen
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="Screen" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                        {{-- Start Table --}}
                                                        <table class="tbl-tooth" height="10">
                                                            <tr>
                                                                <td class="text-center"><h5>UR (1)</h5></td>
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
                                                                <td class="text-center"><h5>UL (2)</h5></td>
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
                                                                <td class="text-center"><h5>LR (3)</h5></td>
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
                                                                <td class="text-center"><h5>LL (4)</h5></td>
                                                            </tr>
                                                        </table>
                                                </div>
                                                {{-- End Table --}}
                
                                                {{-- @php
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
                                                                @php $y=$k; @endphp
                                                                <img class="img" src="{{ asset('./images/test.gif') }}" width="0" height="0" onload="OnLoad({{$k}})">
                                                            @endif
                
                                                            <input type="hidden" name="ID_order_sale" value="{{ $out_teeth->OrderID }}">
                                                        @endforeach
                                                    @endfor
                                                @endfor --}} 
                                                <div class="col-lg-6">
                                                    <div class="col-lg-12">
                                                        <div class="accordion basic-accordion" role="tablist">
                                                            <div class="card">
                                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                    <h6 class="mb-0">
                                                                        <a data-toggle="collapse" href="#MetalType" aria-expanded="false" aria-controls="MetalType">
                                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Metal Type
                                                                        </a>
                                                                    </h6>
                                                                </div>
                                                                <div id="MetalType" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                    <div class="card-body text-center">
                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                            <div class="row" style="over-flow:auto;">
                                                                                <input type="radio" id="radioNON_PRECIOUS" name="Metal_type" value="NON_PRECIOUS" >
                                                                                <label for="radioNON_PRECIOUS" style="cursor:pointer;">NON PRECIOUS</label>
                                                                                <input type="radio" id="radioPALLADIUM" name="Metal_type" value="PALLADIUM" >
                                                                                <label for="radioPALLADIUM" style="cursor:pointer;">PALLADIUM </label>
                
                                                                                <input type="radio" id="radioSEMI_PRECIOUS" name="Metal_type" value="SEMI_PRECIOUS">
                                                                                <label for="radioSEMI_PRECIOUS" style="cursor:pointer;">SEMI PRECIOUS</label>
                                                                                <input type="radio" id="radioHIGH_PRECIOUS" name="Metal_type" value="HIGH_PRECIOUS">
                                                                                <label for="radioHIGH_PRECIOUS" style="cursor:pointer;"> HIGH PRECIOUS </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                            <div class="accordion basic-accordion" role="tablist">
                                                                <div class="card">
                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                        <h4 class="mb-0">
                                                                            <a data-toggle="collapse" href="#hook" aria-expanded="false" aria-controls="collapseOne">
                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>รับตะขอ
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="hook" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                        <div class="card-body text-center">
                                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                                <div class="row" style="over-flow:auto;">
                                                                                    <input type="radio" name="Hook"  id="chkPassport" value="have" onclick="HookFunction()" >
                                                                                    <label for="chkPassport"  style="cursor:pointer;">มีตะขอ</label>
                
                                                                                    <input type="radio" name="Hook" id="nochkPassport" value="don't have" onclick="HookFunction()" >
                                                                                    <label for="nochkPassport"  style="cursor:pointer;">ไม่มีตะขอ </label>
                                                                                </div>
                                                                            </div>
                                                                            <div id="OptionHook" style="display:none;">
                                                                                <div class="card">
                                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                                        <h4 class="mb-0">
                                                                                            <a data-toggle="collapse" href="#TypeHook" aria-expanded="false" aria-controls="collapseOne">
                                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Hook Type
                                                                                            </a>
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div id="TypeHook" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                                        <div class="card-body">
                                                                                            <div class="checkbox-toolbar text-center justify-content-center">
                                                                                                <div class="row" style="over-flow:auto;">
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
                                                                                            <div class="form-group row">
                                                                                                <h4 class="col-sm-4 col-form-label">อื่นๆ</h4>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" id="another" name="other_hook" class="form-control" placeholder="รายละเอียดอื่นๆ"/>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                
                                                                                <div class="card">
                                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                                        <h4 class="mb-0">
                                                                                            <a data-toggle="collapse" href="#UNDERCUT" aria-expanded="false" aria-controls="collapseOne">
                                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>UNDERCUT
                                                                                            </a>
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div class="row" style="over-flow:auto;">
                                                                                        <div id="UNDERCUT" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                                            <div class="card-body">
                                                                                                <div class="radio-toolbar">
                                                                                                    <div class="row" >
                                                                                                        <div class="col-lg-12">
                                                                                                            <select class="form-control" name="undercut_hook">
                                                                                                                <option value="defaultsize">เลือกขนาด</option>
                                                                                                                <option value="0.01">UNDERCUT 0.01"</option>
                                                                                                                <option value="0.02">UNDERCUT 0.02"</option>
                                                                                                                <option value="0.03">UNDERCUT 0.03"</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        &nbsp;
                                                                                                        <div class="col-sm-12">
                                                                                                            <select class="form-control" name="unit_hook">
                                                                                                                <option value="defaultunit">เลือกหน่วย</option>
                                                                                                                <option value="MB">MB</option>
                                                                                                                <option value="DB">DB</option>
                                                                                                                <option value="M">ML</option>
                                                                                                                <option value="MB">MB</option>
                                                                                                                <option value="B">B</option>
                                                                                                                <option value="MBDB">MBDB</option>
                                                                                                            </select>
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
                
                                                    <div class="col-lg-12">
                                                            <div class="accordion basic-accordion" role="tablist">
                                                                <div class="card">
                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                        <h6 class="mb-0">
                                                                            <a data-toggle="collapse" href="#CONTOUR" aria-expanded="false" aria-controls="CONTOUR">
                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>CONTOUR AND OCCLUSION DESIGN
                                                                            </a>
                                                                        </h6>
                                                                    </div>
                                                                    <div id="CONTOUR" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                        <div class="card-body text-center">
                                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                                <input type="radio" id="radioNONPRECIOUS" name="UNDERCUT" value="GINGIVAL EMBRASURES" onclick="ContourFunction()">
                                                                                <label for="radioNONPRECIOUS" style="cursor:pointer;">GINGIVAL EMBRASURES</label>
                                                                                <div class="row" id="gingival" style="display:none;">
                                                                                    <div class="col col-sm-6">
                                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                                            <input type="radio" id="radioOpen " name="CONTOUR" value="Open" >
                                                                                            <label for="radioOpen " style="cursor:pointer;">Open </label>
                                                                                        </div>
                                                                                    </div>
                
                                                                                    <div class="col col-sm-6" >
                                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                                            <input type="radio" id="radioClose" name="CONTOUR" value="Close">
                                                                                            <label for="radioClose"  style="cursor:pointer;">Close</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                
                                                                                <input type="radio" id="radioOCCLUSION" name="UNDERCUT" value="OCCLUSION" onclick="ContourFunction()">
                                                                                <label for="radioOCCLUSION" style="cursor:pointer;">OCCLUSION</label>
                                                                                <div>
                                                                                    <div class="row" id="occlusion" style="display:none;">
                                                                                        <div class="col col-sm-6">
                                                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                                                <input type="radio" id="radiosomsanit" name="CONTOUR" value="สบสนิท"  onclick="ContourFunction()">
                                                                                                <label for="radiosomsanit" style="cursor:pointer;">สบสนิท</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col col-sm-6" >
                                                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                                                <input type="radio" id="radioUNDER" name="CONTOUR" value="UNDER" onclick="ContourFunction()">
                                                                                                <label for="radioUNDER" style="cursor:pointer;">UNDER </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row" id="undercut" style="display:none;">
                                                                                        <div class="col col-sm-12" >
                                                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                                                <select class="form-control" name="unit_CONTOUR">
                                                                                                    <option value="defaultunit">เลือกหน่วย</option>
                                                                                                    <option value="0.3">0.3</option>
                                                                                                    <option value="0.5">0.5</option>
                                                                                                    <option value="1">1</option>
                                                                                                    <option value="2">2</option>
                                                                                                    <option value="3">3</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                
                                                                                <input type="radio" id="radioCONTACT" name="UNDERCUT" value="CONTACT" onclick="ContourFunction()">
                                                                                <label for="radioCONTACT">CONTACT</label>
                                                                                <div class="row" id="contact" style="display:none;">
                                                                                    <div class="col col-sm-6" >
                                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                                            <input type="radio" id="radioAREA" name="CONTOUR" value="AREA">
                                                                                            <label for="radioAREA" style="cursor:pointer;">AREA </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col col-sm-6" >
                                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                                            <input type="radio" id="radioPOINT" name="CONTOUR" value="POINT">
                                                                                            <label for="radioPOINT" style="cursor:pointer;">POINT </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                
                
                                                    <div class="col-lg-12">
                                                            <div class="accordion basic-accordion" role="tablist">
                                                                <div class="card">
                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                        <a data-toggle="collapse" href="#SHADE" aria-expanded="false" aria-controls="collapseOne">
                                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>SHADE
                                                                        </a>
                                                                    </div>
                                                                    <div id="SHADE" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                        <div class="card-body text-center">
                                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                                <div class="row" style="over-flow:auto;">
                
                                                                                    <input type="radio" id="radioOne" name="type" value="One" onclick="ShadeFunction()">
                                                                                    <label for="radioOne" style="cursor:pointer;">สีเดียว</label>
                
                                                                                    <input type="radio" id="radiomulti" name="type" value="Various" onclick="ShadeFunction()">
                                                                                    <label for="radiomulti" style="cursor:pointer;">หลายสี</label>
                                                                                </div>
                                                                            </div>
                
                                                                            <div class="card" id="CardOneColor" style="display:none;">
                                                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                                    <a data-toggle="collapse" href="#OneColor" aria-expanded="false" aria-controls="collapseOne">
                                                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>เลือกสีเดียว
                                                                                    </a>
                                                                                </div>
                                                                                <div id="OneColor" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                                    <div class="card-body text-center">
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
                                                                            </div>
                
                                                                            <div class="card" id="CardChooseColor" style="display:none;">
                                                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                                    <a data-toggle="collapse" href="#ChooseColor" aria-expanded="false" aria-controls="collapseOne">
                                                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>เลือกสี
                                                                                    </a>
                                                                                </div>
                                                                                <div id="ChooseColor" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                                    <div class="card-body text-center">
                                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                                            <div class="row" style="over-flow:auto;">
                                                                                                <input type="radio" id="radio1A1" name="one_color_Combobox" value="A1">
                                                                                                <label for="radio1A1" style="cursor:pointer;">A1</label>
                
                                                                                                <input type="radio" id="radio1A2" name="one_color_Combobox" value="A2">
                                                                                                <label for="radio1A2" style="cursor:pointer;">A2</label>
                
                                                                                                <input type="radio" id="radio1A3" name="one_color_Combobox" value="A3">
                                                                                                <label for="radio1A3" style="cursor:pointer;">A3</label>
                
                                                                                                <input type="radio" id="radio1B1" name="one_color_Combobox" value="B1">
                                                                                                <label for="radio1B1" style="cursor:pointer;">B1</label>
                
                                                                                                <input type="radio" id="radio1B2" name="one_color_Combobox" value="B2">
                                                                                                <label for="radio1B2" style="cursor:pointer;">B2</label>
                
                                                                                                <input type="radio" id="radio1B3" name="one_color_Combobox" value="B3">
                                                                                                <label for="radio1B3" style="cursor:pointer;">B3</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                
                                                                            <div class="card" id="CardAnotherColor" style="display:none;">
                                                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                                    <a data-toggle="collapse" href="#AnotherColor" aria-expanded="false" aria-controls="collapseOne">
                                                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>อื่นๆ
                                                                                    </a>
                                                                                </div>
                                                                                <div id="AnotherColor" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                                    <div class="card-body text-center">
                                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                                            <div class="row" style="over-flow:auto;">
                                                                                                    <h4 class="col-sm-4 col-form-label">ระบุยี่ห้อ:</h4>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input type="text" id="brand" name="one_color_branch" class="form-control"/>
                                                                                                    </div>
                                                                                            </div>
                                                                                            &nbsp;
                                                                                            <div class="row" style="over-flow:auto;">
                                                                                                <h4 class="col-sm-4 col-form-label">ระบุสี:</h4>
                                                                                                <div class="col-sm-8">
                                                                                                    <input type="text" id="color" name="one_color_branch_color" class="form-control"/>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                
                                                                            <div class="card" id="CardMultiColor" style="display:none;">
                                                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                                    <a data-toggle="collapse" href="#MultiColor" aria-expanded="false" aria-controls="collapseOne">
                                                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>เลือกหลายสี
                                                                                    </a>
                                                                                </div>
                                                                                <div id="MultiColor" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                                    <div class="card-body text-center">
                                                                                        <div class="radio-toolbar text-center justify-content-center">
                                                                                            <div class="row">
                                                                                                <h4 class="col-sm-4 col-form-label">คอฟัน:</h4>
                                                                                                <div class="col-sm-8">
                                                                                                    <input class="form-control" type="text" id="shade_many1" name="many_branch_crowns" placeholder="ยี่ห้อ">
                                                                                                    &nbsp;
                                                                                                    <input class="form-control" type="text" id="color1" name="many_color_crowns" placeholder="สี">
                                                                                                </div>
                                                                                            </div>
                                                                                            &nbsp;
                                                                                            <div class="row">
                                                                                                <h4 class="col-sm-4 col-form-label">กลางฟัน:</h4>
                                                                                                <div class="col-sm-8">
                                                                                                    <input class="form-control" type="text" id="shade_many2" name="many_branch_Middle" placeholder="ยี่ห้อ">
                                                                                                    &nbsp;
                                                                                                    <input class="form-control" type="text" id="color2" name="many_color_Middle" placeholder="สี">
                                                                                                </div>
                                                                                            </div>
                                                                                            &nbsp;
                                                                                            <div class="row">
                                                                                                    <h4 class="col-sm-4 col-form-label">ปลายฟัน:</h4>
                                                                                                    <div class="col-sm-8">
                                                                                                        <input class="form-control" type="text" id="shade_many3" name="many_branch_tip" placeholder="ยี่ห้อ">
                                                                                                        &nbsp;
                                                                                                        <input class="form-control" type="text" id="color3" name="many_color_tip" placeholder="สี">
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
                
                                                    <div class="col-lg-12">
                                                            <div class="accordion basic-accordion" role="tablist">
                                                                <div class="card">
                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                        <h6 class="mb-0">
                                                                            <a data-toggle="collapse" href="#OCCLUSAL" aria-expanded="false" aria-controls="collapseOne">
                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>OCCLUSAL STAINING
                                                                            </a>
                                                                        </h6>
                                                                    </div>
                                                                    <div id="OCCLUSAL" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                        <div class="card-body text-center">
                                                                            <div class="radio-toolbar text-center justify-content-center">
                                                                                <div class="row" style="over-flow:auto;">
                                                                                        <input type="radio" id="radioMEDIUM" name="OCCLUSAL_STAINING" value="MEDIUM">
                                                                                        <label for="radioMEDIUM" style="cursor:pointer;">MEDIUM</label>
                
                                                                                        <input type="radio" id="radioNONE" name="OCCLUSAL_STAINING" value="NONE">
                                                                                        <label for="radioNONE" style="cursor:pointer;">&nbspNONE &nbsp&nbsp&nbsp </label>
                
                                                                                        <input type="radio" id="radioLIGHT" name="OCCLUSAL_STAINING" value="LIGHT">
                                                                                        <label for="radioLIGHT" style="cursor:pointer;">LIGHT</label>
                
                                                                                        <input type="radio" id="radioDARK" name="OCCLUSAL_STAINING" value="DARK">
                                                                                        <label for="radioDARK" style="cursor:pointer;">DARK</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                            <div class="accordion basic-accordion" role="tablist">
                                                                <div class="card">
                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                        <h6 class="mb-0">
                                                                            <a data-toggle="collapse" href="#PONTIC" aria-expanded="false" aria-controls="collapseOne">
                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>PONTIC DESIGN
                                                                            </a>
                                                                        </h6>
                                                                    </div>
                                                                    <div id="PONTIC" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                        <div class="card-body text-center">
                                                                            <div class="text-center justify-content-center" style="margin:15px;">
                                                                                <div class="row" style="over-flow:auto;">
                                                                                    <div class="row">
                                                                                        <div class="col-4">
                                                                                            <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC1" value="1"/>
                                                                                            <label for="PONTIC1" style="cursor:pointer;">
                                                                                                <img class="pontic" src="{{ asset('images/pontic-design/1.png') }}" alt="I'm sad"/>
                                                                                            </label>
                                                                                        </div>
                
                                                                                        <div class="col-4">
                                                                                            <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC2" value="2"/>
                                                                                            <label for="PONTIC2" style="cursor:pointer;">
                                                                                                <img class="pontic" src="{{ asset('images/pontic-design/2.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                
                                                                                        <div class="col-4">
                                                                                            <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC3" value="3"/>
                                                                                            <label for="PONTIC3" style="cursor:pointer;">
                                                                                                <img class="pontic" src="{{ asset('images/pontic-design/2.png') }}"   alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                
                                                                                    <div class="row">
                                                                                        <div class="col-4">
                                                                                            <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC4" value="4"/>
                                                                                            <label for="PONTIC4" style="cursor:pointer;">
                                                                                                <img class="pontic" src="{{ asset('images/pontic-design/3.png') }}"  alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC5" value="5"/>
                                                                                            <label for="PONTIC5" style="cursor:pointer;">
                                                                                                <img class="pontic" src="{{ asset('images/pontic-design/4.png') }}"   alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                
                                                                                        <div class="col-4" style="cursor:pointer;">
                                                                                            <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC6" value="6"/>
                                                                                            <label for="PONTIC6" style="cursor:pointer;">
                                                                                                <img class="pontic" src="{{ asset('images/pontic-design/5.png') }}"   alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                            <div class="accordion basic-accordion" role="tablist">
                                                                <div class="card">
                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                        <h6 class="mb-0">
                                                                            <a data-toggle="collapse" href="#MARGIN_AND_MENTAL_DESIGN_Type" aria-expanded="false" aria-controls="collapseOne">
                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>MARGIN AND MENTAL DESIGN Type
                                                                            </a>
                                                                        </h6>
                                                                    </div>
                                                                    <div id="MARGIN_AND_MENTAL_DESIGN_Type" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                        <div class="card-body text-center">
                                                                            <div class="text-center">
                                                                                <div class="row" style="over-flow:auto;">
                                                                                    <div class="row card-body border" >
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN1" id="MARGIN1" class="input-hidden" value="1"/>
                                                                                            <label for="MARGIN1" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/11.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN1" id="MARGIN2" class="input-hidden" value="2"/>
                                                                                            <label for="MARGIN2" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/12.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN1" id="MARGIN3" class="input-hidden" value="3"/>
                                                                                            <label for="MARGIN3" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/13.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN1" id="MARGIN4" class="input-hidden" value="4"/>
                                                                                            <label for="MARGIN4" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/14.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                
                                                                                    <div class="row card-body border">
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN2" id="sad4" class="input-hidden" value="1"/>
                                                                                            <label for="sad4" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/21.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN2" id="sad5" class="input-hidden" value="2"/>
                                                                                            <label for="sad5" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/22.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN2" id="sad6" class="input-hidden" value="3"/>
                                                                                            <label for="sad6" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/23.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN2" id="sad7" class="input-hidden" value="4"/>
                                                                                            <label for="sad7" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/24.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN2" id="sad8" class="input-hidden" value="5"/>
                                                                                            <label for="sad8" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/25.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN2" id="sad9" class="input-hidden" value="6"/>
                                                                                            <label for="sad9" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/26.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-3">
                                                                                            <input type="radio" name="MARGIN2" id="sad10" class="input-hidden" value="7"/>
                                                                                            <label for="sad10" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/27.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                
                                                                                    <div class="row card-body border">
                                                                                        <div class="col-4">
                                                                                            <input type="radio" name="MARGIN3" id="sad11" class="input-hidden" value="1"/>
                                                                                            <label for="sad11" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/31.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <input type="radio" name="MARGIN3" id="sad12" class="input-hidden" value="2"/>
                                                                                            <label for="sad12" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/32.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <input type="radio" name="MARGIN3" id="sad13" class="input-hidden" value="3"/>
                                                                                            <label for="sad13" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/33.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <input type="radio" name="MARGIN3" id="sad14" class="input-hidden" value="4"/>
                                                                                            <label for="sad14" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/34.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="col-4">
                                                                                            <input type="radio" name="MARGIN3" id="sad15" class="input-hidden" value="5"/>
                                                                                            <label for="sad15" style="cursor:pointer;">
                                                                                                <img class="margin" src="{{ asset('images/mental-design/35.png') }}" alt="I'm sad" />
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                            <div class="accordion basic-accordion" role="tablist">
                                                                <div class="card">
                                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                        <h6 class="mb-0">
                                                                            <a data-toggle="collapse" href="#Requirement" aria-expanded="false" aria-controls="collapseOne">
                                                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Special Requirement Type
                                                                            </a>
                                                                        </h6>
                                                                    </div>
                                                                    <div id="Requirement" class="collapse" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                        <div class="card-body text-center" style="height:auto; over-flow:auto;">
                                                                            <div class="checkbox-toolbar text-center justify-content-center">
                                                                                <div class="row">
                                                                                        {{-- @foreach($data_Requirement as $row)
                                                                                        <div class="col-6">
                                                                                            <input type="checkbox" id="{{ $row->ID }}" name="{{ $row->Name }}" value="{{ $row->ID }}">
                                                                                            <label for="{{ $row->ID }}"  style="cursor:pointer;">{{ $row->Name }}</label>
                                                                                        </div>
                                                                                        @endforeach --}}
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
                            
                            <div class="row mt-2">
                                <div class="col-sm-12 text-right">
                                    <a href="{{url('history_job')}}">
                                        <button type="button" class="btn btn-lg btn-success">
                                            ดูประวัติ
                                        </button>
                                    </a>
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
<script>
        $(document).ready(function() {
            $('#example').DataTable({
                "columnDefs": [
                { "width": "9%", "targets": 0 },
                { "width": "9%", "targets": 1 },
                { "width": "9%", "targets": 2 },
                { "width": "9%", "targets": 3 },
                { "width": "9%", "targets": 4 },
                { "width": "9%", "targets": 5 },
                { "width": "9%", "targets": 6 },
                { "width": "9%", "targets": 7 }
  ]});
        } );

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
    function ContourFunction(){
        var radioNONPRECIOUS = document.getElementById("radioNONPRECIOUS");
        var gingival = document.getElementById("gingival");
        var radioOCCLUSION = document.getElementById("radioOCCLUSION");
        var occlusion = document.getElementById("occlusion");
        var radioUNDER = document.getElementById("radioUNDER");
        var radiosomsanit = document.getElementById("radiosomsanit");
        var undercut = document.getElementById("undercut");
        var radioCONTACT = document.getElementById("radioCONTACT");
        var contact = document.getElementById("contact");

        if(radioNONPRECIOUS.checked == true){
            gingival.style.display = "flex";
            occlusion.style.display = "none";
            contact.style.display = "none";
        }
        if(radioOCCLUSION.checked == true){
            occlusion.style.display = "flex";
            gingival.style.display = "none";
            contact.style.display = "none";
            if(radioUNDER.checked == true){
                undercut.style.display = "flex";
            }
            if(radiosomsanit.checked == true){
                undercut.style.display = "none";
            }
        }
        if(radioCONTACT.checked == true){
            contact.style.display = "flex";
            occlusion.style.display = "none";
            gingival.style.display = "none";
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
    </script>
@stop
