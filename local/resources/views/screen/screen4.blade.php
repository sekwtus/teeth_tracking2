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

        .radio-toolbar5 {
        margin: 10px;
        }

        .radio-toolbar5 input[type="radio"] {
            display:none;
        }

        .radio-toolbar5 label {
        display:inline-block;
                background-color:#ddd;
                width: 100%;
                height: 30%;
                padding: 8%;
                font-size:14px;
                border-radius: 4px;
        }


       .radio-toolbar5 label:hover {
           color: #212529;
           background-color: #cddde5;
           border-color: #c4d7e1;
       }

       .radio-toolbar5 input[type="radio"]:checked + label {
           background-color: #19d895;
           border-color: #19d895;
       }
</style>
<style>

    .radio-toolbar6 {
        margin: 12px;
    }

    .radio-toolbar6 input[type="radio"] {
        display:none;
    }

    .radio-toolbar6 label {
        display:inline-block;
        background-color:#ddd;
        width: 70%;
        height: 30%;
        padding: 20%;
        font-size:12px;
        border-radius: 4px;
    }

    .radio-toolbar6 label:hover {
    color: #212529;
    background-color: #cddde5;
    border-color: #c4d7e1;
    }

    .radio-toolbar6 input[type="radio"]:checked + label {
    background-color: #19d895;
    border-color: #19d895;
    }
</style>

@stop

@section('content')
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
    {{ Form::open(['method' => 'post' , 'url' => '/screen4/add']) }}
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
                    <li class="yellow">SHADE</li>
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
                                                <li class="breadcrumb-item active" aria-current="page">SHADE</li>
                                        </ol>
                                    </nav>
                                <div class="accordion basic-accordion" role="tablist">
                                     <div class="card">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        SHADE
                                        </a>
                                    </h6>
                                    </div>
                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                    <!-- {{ Form::open(['method' => 'get' , 'url' => '/asset']) }} -->
                                        <div class="card-body text-center">
                                             <div class="radio-toolbar5">
                                                   <div class="row">
                                                        <div class="col col-sm">

                                                            <input type="radio" id="radioOne" name="type" value="One" onclick="myFunction3()">
                                                            <label for="radioOne"> สีเดียว </label>

                                                        </div>
                                                        <div class="col col-sm-6" >

                                                            <input type="radio" id="radioVarious" name="type" value="Various" onclick="myFunction3()">
                                                            <label for="radioVarious"> หลายสี </label>

                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="radio-toolbar5" id="text1" style="display: none">
                                                <hr>
                                                <div class="row">
                                                    <div class="col col-sm" >
                                                        <input type="radio" id="radioVITA_AD" name="shade_one" value="VITA AD" onclick="myFunction4()">
                                                        <label for="radioVITA_AD">VITA AD</label>

                                                        <input type="radio" id="radioVITA_3D" name="shade_one" value="VITA 3D" onclick="myFunction4()">
                                                        <label for="radioVITA_3D">VITA 3D</label>

                                                        <input type="radio" id="radioอื่นๆ" name="shade_one" value="อื่นๆ" onclick="myFunction4()">
                                                        <label for="radioอื่นๆ">อื่นๆ</label>

                                                    </div>

                                                    <div class="col col-sm-6" >
                                                        <input type="radio" id="radioSHOFU" name="shade_one" value="SHOFU" onclick="myFunction4()">
                                                        <label for="radioSHOFU">SHOFU</label>

                                                        <input type="radio" id="radioCHOMASCOP" name="shade_one" value="CHOMASCOP" onclick="myFunction4()">
                                                        <label for="radioCHOMASCOP">CHOMASCOP</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="radio-toolbar6" id="text2" style="display: none">
                                                <hr>
                                                <br>
                                                <div class="row">
                                                    <div class="col col-sm" >

                                                        <input type="radio" id="radio1A1" name="key_shade_one" value="A1">
                                                        <label for="radio1A1">A1</label>
                                                    </div>

                                                    <div class="col col-sm-2">
                                                        <input type="radio" id="radio1A2" name="key_shade_one" value="A2">
                                                        <label for="radio1A2">A2</label>
                                                    </div>

                                                    <div class="col col-sm-2">
                                                        <input type="radio" id="radio1A3" name="key_shade_one" value="A3">
                                                        <label for="radio1A3">A3</label>
                                                    </div>

                                                    <div class="col col-sm-2">
                                                        <input type="radio" id="radio1B1" name="key_shade_one" value="B1">
                                                        <label for="radio1B1">B1</label>
                                                    </div>

                                                    <div class="col col-sm-2">
                                                        <input type="radio" id="radio1B2" name="key_shade_one" value="B2">
                                                        <label for="radio1B2">B2</label>
                                                    </div>

                                                    <div class="col col-sm-2">
                                                        <input type="radio" id="radio1B3" name="key_shade_one" value="B3">
                                                        <label for="radio1B3">B3</label>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="form-group row col-sm-10" id="text3" style="display: none">
                                                 <hr>
                                                 <br>
                                                    &nbsp
                                                        ระบุยี่ห้อ:  <input type="text"  >

                                                    &nbsp
                                                        ระบุสี:  <input type="text">

                                                <hr>
                                            </div>
                                            <div class="form-group row col-sm-12" id="text4" style="display: none">
                                                 <hr>
                                                    <div class="form-group ">
                                                        <div class="row col-sm-6">
                                                            <h6>คอฟัน</h6>
                                                        </div>
                                                        <div class="form-group row col-sm-12">
                                                            &nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp
                                                            <input type="text" name="shade_many1" placeholder="ยี่ห้อ">
                                                            &nbsp&nbsp
                                                            <input type="text" name="color1" placeholder="สี">
                                                        </div>
                                                    </div>

                                                    <div class="form-group ">
                                                        <div class="row col-sm-6">
                                                            <h6>กลางฟัน</h6>
                                                        </div>
                                                        <div class="form-group row col-sm-12">
                                                            &nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp
                                                            <input type="text" name="shade_many2" placeholder="ยี่ห้อ">
                                                            &nbsp&nbsp
                                                            <input type="text" name="color2" placeholder="สี">
                                                        </div>
                                                    </div>

                                                    <div class="form-group ">
                                                        <div class="row col-sm-6">
                                                            <h6>ปลายฟัน</h6>
                                                        </div>
                                                        <div class="form-group row col-sm-12">
                                                            &nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp &nbsp
                                                            <input type="text" name="shade_many3" placeholder="ยี่ห้อ">
                                                            &nbsp&nbsp
                                                            <input type="text" name="color3" placeholder="สี">
                                                        </div>
                                                    </div>
                                                <hr>
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
              <a href="{{ url('screen3') }}">
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

function myFunction3() {
    var radioOne = document.getElementById("radioOne");
    var radioVarious = document.getElementById("radioVarious");

    var text1 = document.getElementById("text1");
    var text2 = document.getElementById("text2");
    var text3 = document.getElementById("text3");
    var text4 = document.getElementById("text4");


    if (radioOne.checked == true){
        text1.style.display = "block";
        text4.style.display = "none";
    }
    else if(radioVarious.checked == true){
        text4.style.display = "block";
        text1.style.display = "none";
        text3.style.display = "none";
        text2.style.display = "none";
    }
    else {
    text2.style.display = "none";
    text1.style.display = "none";
    }
}

function myFunction4() {
    var text2 = document.getElementById("text2");
    var text3 = document.getElementById("text3");

    var radioVITA_AD = document.getElementById("radioVITA_AD");
    var radioVITA_3D = document.getElementById("radioVITA_3D");
    var radioSHOFU = document.getElementById("radioSHOFU");
    var radioCHOMASCOP = document.getElementById("radioCHOMASCOP");
    var radioอื่นๆ = document.getElementById("radioอื่นๆ");

    if(radioVITA_3D.checked == true){
        text2.style.display = "block";
        text3.style.display = "none";

    }
    else if(radioVITA_AD .checked == true){
        text2.style.display = "block";
        text3.style.display = "none";
    }
    else if(radioSHOFU.checked == true){
        text2.style.display = "block";
        text3.style.display = "none";
    }
    else if(radioCHOMASCOP.checked == true){
        text2.style.display = "block";
        text3.style.display = "none";
    }
    else if(radioอื่นๆ.checked == true){
        text3.style.display = "block";
        text2.style.display = "none";
    }
    else {
    text.style.display = "none";
    text1.style.display = "none";
    }
}


</script>

@stop
