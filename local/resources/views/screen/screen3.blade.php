@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}
 <style>

    .radio-toolbar4 {
    margin: 10px;
    }

    .radio-toolbar4 input[type="radio"] {
        display:none;
    }

    .radio-toolbar4 label {
        display:inline-block;
        background-color:#ddd;
        width: 100%;
        height: 7%;
        padding: 5%;
        font-size:14px;
        border-radius: 4px;
    }


            .radio-toolbar4 label:hover {
                color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
            }

            .radio-toolbar4 input[type="radio"]:checked + label {
                background-color: #19d895;
                border-color: #19d895;
            }
</style>
<style>
    .radio-toolbar3 {
        margin: 12px;
    }

    .radio-toolbar3 input[type="radio"] {
        display:none;
    }

    .radio-toolbar3 label {
        display:inline-block;
        background-color:#ddd;
        width: 60%;
        height: 22%;
        padding: 10%;
        font-size:12px;
        border-radius: 4px;
    }

    .radio-toolbar3 label:hover {
    color: #212529;
    background-color: #cddde5;
    border-color: #c4d7e1;
    }

    .radio-toolbar3 input[type="radio"]:checked + label {
    background-color: #19d895;
    border-color: #19d895;
    }
</style>

@stop

@section('content')
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
    {{ Form::open(['method' => 'post' , 'url' => '/screen3/add']) }}
      <div class="card">
        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
              <h4>New Order</h4>
            </div>
          </div>
          <div class="row mt-4">
                <div class="col-md-4 m-0 step-timeline">
                    <ul class="m-0 step-list">
                        <li>โลหะ</li>
                        <li>รับตะขอ</li>
                        <li class="yellow">CONTOUR AND OCCLUSION DESIGN</li>
                        <li class="white">SHADE</li>
                        <li class="white">OCCLUSAL STAINING</li>
                        <li class="white">PONTIC DESIGN</li>
                        <li class="white">MARGIN AND MENTAL DESIGN</li>
                        <li class="white">คำสั่งพิเศษ (Special Requirement)</li>
                        <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                    </ul>
                </div>

                <div class="col-md-8 step-content">
                    <div class="form-group row">
                            <div class="col-lg-12">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                <li class="breadcrumb-item active" aria-current="page">CONTOUR AND OCCLUSION DESIGN</li>
                                        </ol>
                                    </nav>
                                <div class="accordion basic-accordion" role="tablist">
                                    <div class="card">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        CONTOUR AND OCCLUSION DESIGN
                                        </a>
                                    </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                    <!-- {{ Form::open(['method' => 'get' , 'url' => '/asset']) }} -->
                                        <div class="card-body text-center">
                                            <div class="radio-toolbar4">

                                                <div class="row">
                                                    <div class="col col-sm-12" >
                                                        <input type="radio" id="radioNON_PRECIOUS" name="contour_type" value="GINGIVAL EMBRASURES"  onclick="myFunction1()">
                                                        <label for="radioNON_PRECIOUS">GINGIVAL EMBRASURES</label>
                                                            <div class="radio-toolbar3" id="text1" style="display: none">
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col col-sm" >
                                                                            <input type="radio" id="radioOpen " name="contour_non_precious" value="Open " >
                                                                            <label for="radioOpen ">Open </label>
                                                                        </div>

                                                                        <div class="col col-sm-6" >
                                                                            <input type="radio" id="radioClose" name="contour_non_precious" value="Close">
                                                                            <label for="radioClose">Close</label>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                            </div>

                                                        <input type="radio" name="contour_type" value="OCCLUSION" id="radioOCCLUSION"  onclick="myFunction1()" >
                                                        <label for="radioOCCLUSION">OCCLUSION</label>
                                                            <div class="radio-toolbar3" id="text2"  style="display: none">
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col col-sm" >
                                                                        <input type="radio" id="radio1สบสนิท" name="contour_non_precious" value="สบสนิท"  onclick="myFunction2()">
                                                                        <label for="radio1สบสนิท">สบสนิท</label>
                                                                    </div>
                                                                    <div class="col col-sm-6" >
                                                                        <input type="radio" id="radioUNDER" name="contour_non_precious" value="UNDER" onclick="myFunction2()">
                                                                        <label for="radioUNDER">UNDER </label>

                                                                        <div  id="text3" style="display: none" >
                                                                            <div class="col col-sm-3">

                                                                            </div>
                                                                            <div class="col col-sm-12">
                                                                                <select class="form-control" name="undercut_contour">
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
                                                                <hr>
                                                            </div>


                                                        <input type="radio" id="radioCONTACT" name="contour_type" value="CONTACT"  onclick="myFunction1()" >
                                                        <label for="radioCONTACT">CONTACT</label>
                                                            <div class="radio-toolbar3" id="text4" style="display: none">
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col col-sm" >
                                                                            <input type="radio" id="radioAREA" name="contour_non_precious" value="AREA" onclick="myFunction1()" >
                                                                            <label for="radioAREA">AREA </label>
                                                                        </div>

                                                                        <div class="col col-sm-6" >
                                                                            <input type="radio" id="radioPOINT" name="contour_non_precious" value="POINT" onclick="myFunction1()" >
                                                                            <label for="radioPOINT">POINT </label>
                                                                        </div>

                                                                    </div>
                                                                    <hr>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <!-- {{ Form::close() }} -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>

        <div class="row mt-2">
                <div class="col-sm-12 text-right">
                        <a href="{{ url('screen2') }}">
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
    </div>
    {{ Form::close() }}
    </div>
    </div>
    </div>

<script>

    function myFunction1() {
        var radioNON_PRECIOUS = document.getElementById("radioNON_PRECIOUS");
        var text1 = document.getElementById("text1");
        var radioOCCLUSION = document.getElementById("radioOCCLUSION");
        var text2 = document.getElementById("text2");
        var radioUNDER = document.getElementById("radioUNDER");
        var text3 = document.getElementById("text3");
        var radioCONTACT = document.getElementById("radioCONTACT");
        var text4 = document.getElementById("text4");
        var radioAREA = document.getElementById("radioAREA");
        var radioPOINT = document.getElementById("radioPOINT");

        if (radioNON_PRECIOUS.checked == true){
            text1.style.display = "block";
            text2.style.display = "none";
            text4.style.display = "none";
        }
        else if (radioOCCLUSION.checked == true){
            text2.style.display = "block";
            text1.style.display = "none";
            
            text4.style.display = "none";
        }
        else if (radioCONTACT.checked == true){
            text4.style.display = "block";
            text1.style.display = "none";
            text2.style.display = "none";
            
        }
        else if (radioAREA.checked == true){
            text4.style.display = "block";
            text1.style.display = "none";
            text2.style.display = "none";
            text3.style.display = "none";
        }
        else if (radioPOINT .checked == true){
            text4.style.display = "block";
            text1.style.display = "none";
            text2.style.display = "none";
            text3.style.display = "none";
        }
        else {
            text1.style.display = "none";
            text2.style.display = "none";
            text3.style.display = "none";
            text4.style.display = "none";
        }
    }

        function myFunction2() {

        var radioUNDER = document.getElementById("radioUNDER");
        var radio1สบสนิท = document.getElementById("radio1สบสนิท");
        var text3 = document.getElementById("text3");



      if (radioUNDER.checked == true){
            text3.style.display = "block";

        }
      else if (radio1สบสนิท.checked == true){
            text3.style.display = "none";

       }
       else{

       }

    }


</script>

@stop
