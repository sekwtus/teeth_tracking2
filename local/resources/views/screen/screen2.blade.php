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

         .checkbox-toolbar {
         margin: 10px;
         }

         .checkbox-toolbar input[type="checkbox"] {
             display:none;
         }

         .checkbox-toolbar label {
             display:inline-block;
             background-color:#ddd;
             width: 100%;
                height: 30%;
                padding: 8%;
             /* font-family:Arial; */
             font-size:14px;
             /* border: 2px solid #444; */
             border-radius: 4px;
         }
          .checkbox-toolbar label:hover {
          color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
        }
        .checkbox-toolbar input[type="checkbox"]:checked + label {
            color: #fff;
                background-color: #19d895;
                border-color: #19d895;
        }


            .radio-toolbar {
            margin: 10px;
            }

            .radio-toolbar input[type="radio"] {
                display:none;
            }

            .radio-toolbar label {
                display:inline-block;
                background-color:#ddd;
                width: 100%;
                height: 30%;
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
    </style>
@stop

@section('content')
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
    {{ Form::open(['method' => 'post' , 'url' => '/screen2/add']) }}
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
                    <li class="yellow">รับตะขอ</li>
                    <li class="white">CONTOUR AND OCCLUSION DESIGN</li>
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
                                                <li class="breadcrumb-item active" aria-current="page">รับตะขอ</li>
                                        </ol>
                                    </nav>
                                <div class="accordion basic-accordion" role="tablist">
                                    <div class="card">

                                        <div class="card-header" role="tab" id="orderRequestTypeID">
                                            <h4 class="mb-0">
                                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                รับตะขอ
                                                </a>
                                            </h4>
                                            <div class="radio-toolbar">
                                                    <div class="row">
                                                        <div class="col-3 col-sm-6">
                                                            <!-- &nbsp &nbsp &nbsp &nbsp &nbsp  -->
                                                            <input type="radio" name="hook_type"  id="chkPassport" value="have" onclick="myFunction()" >
                                                            <label for="chkPassport">มีตะขอ</label>
                                                        </div>
                                                        <div class="col-3 col-sm-6">
                                                            <input type="radio" name="hook_type" id="nochkPassport" value="don't have" onclick="myFunction()" >
                                                            <label for="nochkPassport">ไม่มีตะขอ </label>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                    <!-- {{ Form::open(['method' => 'get' , 'url' => '/asset']) }} -->

                                        <div class="card-body text-center" id="dvPassport" style="display: none" >
                                            <div class="checkbox-toolbar">
                                                   <div class="row">
                                                        <div class="col col-sm-6">

                                                            <input type="checkbox" id="checkboxMESIAL_REST" name="hook_type" value="MESIAL_REST">
                                                            <label for="checkboxMESIAL_REST">MESIAL REST</label>

                                                            <input type="checkbox" id="checkboxDISTAL_REST" name="hook_type" value="DISTAL_REST">
                                                            <label for="checkboxDISTAL_REST">DISTAL REST</label>

                                                            <input type="checkbox" id="checkboxCINGULUM_REST" name="hook_type" value="CINGULUM_REST">
                                                            <label for="checkboxCINGULUM_REST">CINGULUM REST</label>
                                                        </div>

                                                        <div class="col col-sm-6" >

                                                            <input type="checkbox" id="checkboxLINGUAL_LEDGE" name="hook_type" value="LINGUAL_LEDGE">
                                                            <label for="checkboxLINGUAL_LEDGE">LINGUAL LEDGE</label>
                                                            <!-- &nbsp &nbsp &nbsp &nbsp &nbsp -->
                                                            <input type="checkbox" id="checkboxEMBRESSURE_REST" name="hook_type" value="EMBRESSURE_REST">
                                                            <label for="checkboxEMBRESSURE_REST">EMBRESSURE REST</label>
                                                            <div class="row">
                                                                <div class="col col-sm-3" > <h4>อื่นๆ</h4> </div>
                                                                <div class="col col-sm-9 " >
                                                                    <input type="text" class="form-control" placeholder="รายละเอียดอื่นๆ"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                            </div>
                                          {{-- 2.1 --}}
                                          <div align="left" class="card-header" role="tab" id="orderRequestTypeID">
                                                <h4 class="mb-0">
                                                    <a data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                    UNDERCUT
                                                    </a>
                                                </h4>
                                        </div>
                                        <div id="collapse2" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                             <div class="card-body text-center">
                                                <div class="radio-toolbar">
                                                 <div class="row">
                                                      <div class="col col-sm-6">
                                                           <select class="form-control" name="undercut_hook">
                                                                <option value="defaultsize">เลือกขนาด</option>
                                                                <option value="0.01">UNDERCUT 0.01"</option>
                                                                <option value="0.02">UNDERCUT 0.02"</option>
                                                                <option value="0.03">UNDERCUT 0.03"</option>
                                                           </select>
                                                      </div>

                                                      <div class="col col-sm-6">
                                                            <select class="form-control" name="bit_undercut_hook">
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
                                         {{-- end 2.1 --}}

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
                <a href="{{ url('screen1') }}">
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

function myFunction() {
    nochkPassport
    var nochkPassport = document.getElementById("nochkPassport");
    var checkBox = document.getElementById("chkPassport");
    var text = document.getElementById("dvPassport");
    if (checkBox.checked == true){
        text.style.display = "block";
    }
    else if(nochkPassport.checked == true){
        text.style.display = "none";
    }
    else {
       text.style.display = "none";
    }
  }

</script>

@stop
