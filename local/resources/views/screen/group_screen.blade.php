@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}
/////////////////////////////////1
 <style>

    .radio-toolbar2 {
    margin: 10px;
    }

    .radio-toolbar2 input[type="radio"] {
        display:none;
    }

    .radio-toolbar2 label {
        display:inline-block;
        background-color:#ddd;
        width: 100%;
        height: 7%;
        padding: 3%;
        font-size:11px;
        border-radius: 4px;
    }


            .radio-toolbar2 label:hover {
                color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
            }

            .radio-toolbar2 input[type="radio"]:checked + label {
                background-color: #19d895;
                border-color: #19d895;
            }
</style>
///////////////////////////////////////1


///////////////////////////////////2
<style>

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
    font-size:11px;
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
       height: 15%;
       padding: 8%;
       font-size:11px;
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
///////////////////////////////////////////2
///////////////////////////////////////////3

///////////////////////////////////////////3

@stop

@section('content')
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
            <div class="row border-bottom">
                <div class="col-12 p-0 text-left">
                <h4>Screen</h4>
                </div>
            </div>
            <!-- ROW 1 -->
            <div class="row mt-12">
                <div class="col-lg-6">
                    <div class="accordion basic-accordion" role="tablist">
                            <div class="card">
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Metal Type
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                    <div class="card-body text-center">
                                        <div class="radio-toolbar2 text-center justify-content-center">
                                            <div class="row" style="over-flow:auto;">
                                                <input type="radio" id="radioNON_PRECIOUS" name="Metal_type" value="NON_PRECIOUS" >
                                                    <label for="radioNON_PRECIOUS">NON PRECIOUS</label>
                                                        <input type="radio" id="radioPALLADIUM" name="Metal_type" value="PALLADIUM" >
                                                        <label for="radioPALLADIUM">PALLADIUM </label>
                                                        <input type="radio" id="radioSEMI_PRECIOUS" name="Metal_type" value="SEMI_PRECIOUS">
                                                        <label for="radioSEMI_PRECIOUS">SEMI PRECIOUS</label>
                                                        <input type="radio" id="radioHIGH_PRECIOUS" name="Metal_type" value="HIGH_PRECIOUS">
                                                    <label for="radioHIGH_PRECIOUS"> HIGH PRECIOUS </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="orderRequestTypeID1">
                                <h4 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        รับตะขอ
                                    </a>
                                </h4>
                                <div class="radio-toolbar">
                                    <div class="row">
                                        <div class="col-3 col-sm-6">
                                            <input type="radio" name="hook_type"  id="chkPassport" value="have" onclick="myFunction()" >
                                            <label align="center" for="chkPassport">มีตะขอ</label>
                                        </div>
                                        <div class="col-3 col-sm-6">
                                            <input type="radio" name="hook_type" id="nochkPassport" value="don't have" onclick="myFunction()" >
                                            <label align="center" for="nochkPassport">ไม่มีตะขอ </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID1">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            <!-- ROW 1 -->
            <!-- ROW 2 -->
            <div class="row mt-12">
                <div class="col-lg-6">
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
                                    <div class="radio-toolbar">
                                        <div class="row">
                                            <div class="col col-sm-12" >
                                                <input type="radio" id="radioNON_PRECIOUS" name="contour_type1" value="GINGIVAL EMBRASURES"  onclick="myFunction1()">
                                                <label for="radioNON_PRECIOUS">GINGIVAL EMBRASURES</label>

                                                <div class="radio-toolbar1" id="text1" style="display: none">
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

                                                <input type="radio" name="contour_type1" value="OCCLUSION" id="radioOCCLUSION"  onclick="myFunction1()" >
                                                <label for="radioOCCLUSION">OCCLUSION</label>
                                                <div class="radio-toolbar1" id="text2"  style="display: none">
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
                                                                <div class="col col-sm-3"></div>
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

                                                <input type="radio" id="radioCONTACT" name="contour_type1" value="CONTACT"  onclick="myFunction1()" >
                                                <label for="radioCONTACT">CONTACT</label>
                                                <div class="radio-toolbar1" id="text4" style="display: none">
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
                <div class="col-lg-6">
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
                                    <div class="radio-toolbar">
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

                                    <div class="radio-toolbar" id="text1" style="display: none">
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
                                    <div class="radio-toolbar1" id="text2" style="display: none">
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
            <!-- ROW 2 -->

            <!-- ROW 3 -->
           
            <!-- ROW 3 -->

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
