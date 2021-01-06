@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}
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
        </style>

              <style>

     .radio-toolbar7 {
     margin: 10px;
     }

     .radio-toolbar7 input[type="radio"] {
         display:none;
     }

     .radio-toolbar7 label {
        display:inline-block;
                background-color:#ddd;
                width: 100%;
                height: 30%;
                padding: 8%;
                font-size:14px;
                border-radius: 4px;
     }


            .radio-toolbar7 label:hover {
                color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
            }

            .radio-toolbar7 input[type="radio"]:checked + label {
                background-color: #19d895;
                border-color: #19d895;
            }
 </style>
@stop

@section('content')
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
    {{ Form::open(['method' => 'post' , 'url' => '/screen5/add']) }}
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
                    <li>CONTOUR AND OCCLUSION DESIGN</li>
                    <li>SHADE</li>
                    <li class="yellow">OCCLUSAL STAINING</li>
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
                                                <li class="breadcrumb-item active" aria-current="page">OCCLUSAL STAINING</li>
                                        </ol>
                                    </nav>
                                <div class="accordion basic-accordion" role="tablist">
                                   <div class="card">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        OCCLUSAL STAINING
                                        </a>
                                    </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                    <!-- {{ Form::open(['method' => 'get' , 'url' => '/asset']) }} -->
                                        <div class="card-body text-center">

                                            <div class="radio-toolbar7">

                                                   <div class="row">
                                                        <div class="col col-sm">

                                                            <input type="radio" id="radioMEDIUM" name="occlusal_staining" value="MEDIUM" checked>
                                                            <label for="radioMEDIUM">MEDIUM</label>

                                                            <input type="radio" id="radioNONE" name="occlusal_staining" value="NONE">
                                                            <label for="radioNONE">&nbspNONE &nbsp&nbsp&nbsp </label>
                                                        </div>

                                                        <div class="col col-sm-6" >

                                                            <input type="radio" id="radioLIGHT" name="occlusal_staining" value="LIGHT">
                                                            <label for="radioLIGHT">LIGHT</label>

                                                            <input type="radio" id="radioDARK" name="occlusal_staining" value="DARK">
                                                            <label for="radioDARK">DARK</label>
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
                        <a href="{{ url('screen4') }}">
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
@stop
