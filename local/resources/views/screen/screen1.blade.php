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

<!-- 1 -->
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
<!-- 1 -->

<!-- 2 -->

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
    padding:7%;
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
       padding: 7%;
       font-size:11px;
       border-radius: 4px;
   }

   .radio-toolbar label:hover {
       color: #212529;
       background-color: #cddde5;
       border-color: #c4d7e1;s
   }

   .radio-toolbar input[type="radio"]:checked + label {
       background-color: #19d895;
       border-color: #19d895;
   }
</style>
<!-- 2 -->

<!-- 3 -->
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
        font-size:11px;
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
        height: 7%;
        padding: 10%;
        font-size:11px;
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
<!-- 3 -->

<!-- 4 -->
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
                padding:7%;
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
        height: 7%;
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
<!-- 4 -->

<!-- 5 -->
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
           height: 7%;
           padding: 8%;
           font-size:11px;
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
<!-- 5 -->

<!-- 6 -->
<style>
  .input-hidden1 {
    position: absolute;
    left: -9999px;
  }

  input[type=radio]:checked + label>img {
    border: 4px solid #fff;
    box-shadow: 0 0 5px 5px #090;
    border-radius: 4px;
  }

  input[type=radio] + label>img {
    border: 0px dashed #444;
    width: 60px;
    height: 60px;
    transition: 500ms all;
  }
</style>
<!-- 6 -->

<!-- 7 -->
<style>
  .input-hidden2 {
    position: absolute;
    left: -9999px;
  }

  input[type=radio]:checked + label>img {
    border: 4px solid #fff;
    box-shadow: 0 0 5px 5px #090;
    border-radius: 4px;
  }

  input[type=radio] + label>img {
    border: 0px dashed #444;
    width: 60px;
    height: 60px;
    transition: 500ms all;
  }
</style>
<!-- 7 -->

<!-- 8 -->
<style>
     .checkbox-toolbar8 {
        margin: 10px;
        }

        .checkbox-toolbar8 input[type="checkbox"] {
            display:none;
        }

        .checkbox-toolbar8 label {
            display:inline-block;
    background-color:#ddd;
    width: 100%;
    height: 13%;
    padding:8%;
    font-size:11px;
    border-radius: 4px;
                 /* display:inline-block;
                 background-color:#ddd;
                 width: 40%;
                 height: 15%;
                 padding: 15px;
                 font-size:11px; */
                 /* cursor: pointer; */
                 /* border: 2px solid #444; */
                 /* border-radius: 4px;     */
             }
        .checkbox-toolbar8 label:hover {
            color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
        }

        .checkbox-toolbar8 input[type="checkbox"]:checked + label {
            color: #fff;
                background-color: #19d895;
                border-color: #19d895;
        }
    </style>
<!-- 8 -->
@stop

@section('content')
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
        {{ Form::open(['method' => 'post' , 'url' => '/screen/add']) }}
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h4>New Screen</h4>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                    <li class="breadcrumb-item active" aria-current="page">เลือกโลหะ</li>
                                </ol>
                            </nav>
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div>
                                            <table class="tbl-tooth" height="10">
                                                <tr>
                                                    <td class="text-center"><h5>UR (1)</h5></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                            <label class="lbl lbl_green_12" id="lbl_green_12" style="margin-top:30px;margin-right:2px;" >
                                                                <img src="./images/tooth3color/12.png" class="img-tooth img-tooth-12" id="img-tooth-12" onclick="check(12)" >
                                                            </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_11" id="lbl_green_11" style="margin-right:2px;">
                                                            <img src="./images/tooth3color/11.png" class="img-tooth img-tooth-11" id="img-tooth-11" onclick="check(11)">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_21" id="lbl_green_21" style="margin-left:2px;">
                                                            <img  src="./images/tooth3color/21.png" class="img-tooth img-tooth-21" id="img-tooth-21" onclick="check(21)">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_22" id="lbl_green_22" style="margin-top:30px;margin-left:2px;">
                                                            <img src="./images/tooth3color/22.png" class="img-tooth img-tooth-22" id="img-tooth-22" onclick="check(22)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td class="text-center"><h5>UL (2)</h5></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_13" id="lbl_green_13" style="margin-left:55px;margin-top:-50px;">
                                                            <img src="./images/tooth3color/13.png" class="img-tooth img-tooth img-tooth-13" id="img-tooth-13" onclick="check(13)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_23" id="lbl_green_23" style="margin-right:55px;margin-top:-15px;">
                                                            <img src="./images/tooth3color/23.png" class="img-tooth img-tooth-23" id="img-tooth-23" onclick="check(23)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_14" id="lbl_green_14" style="margin-right:-10px; margin-top:-5px;">
                                                            <img src="./images/tooth3color/14.png" class="img-tooth img-tooth-14" id="img-tooth-14" onclick="check(14)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_24" id="lbl_green_24" style="margin-left:-10px; margin-top:-5px;">
                                                            <img src="./images/tooth3color/24.png" class="img-tooth img-tooth-24" id="img-tooth-24" onclick="check(24)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_15" id="lbl_green_15" style="margin-right:-110px;margin-top:-5px;">
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
                                                        <label class="lbl lbl_green_25" id="lbl_green_25" style="margin-left:-110px;margin-top:-5px;">
                                                            <img src="./images/tooth3color/25.png" class="img-tooth img-tooth-25" id="img-tooth-25" onclick="check(25)" >
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_16" id="lbl_green_16" style="margin-right:-90px;margin-top:-5px;">
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
                                                        <label class="lbl lbl_green_26" id="lbl_green_26" style="margin-left:-90px;margin-top:-5px;">
                                                            <img src="./images/tooth3color/26.png" class="img-tooth img-tooth-26" id="img-tooth-26" onclick="check(26)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_17" id="lbl_green_17" style="margin-right:-80px;margin-top:-5px;">
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
                                                        <label class="lbl lbl_green_27" id="lbl_green_27" style="margin-left:-80px;margin-top:-5px;">
                                                            <img src="./images/tooth3color/27.png" class="img-tooth img-tooth-27" id="img-tooth-27" onclick="check(27)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_18" id="lbl_green_18" style="margin-right:-70px;margin-top:-10px;">
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
                                                        <label class="lbl lbl_green_28" id="lbl_green_28" style="margin-left:-70px;margin-top:-10px;">
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
                                                        <label class="lbl lbl_green_48" id="lbl_green_48" style="margin-right:-70px;margin-bottom:0px;">
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
                                                        <label class="lbl lbl_green_38" id="lbl_green_38" style="margin-left:-70px;margin-bottom:0px;">
                                                            <img src="./images/tooth3color/38.png" class="img-tooth img-tooth-38" id="img-tooth-38" onclick="check(38)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_47" id="lbl_green_47" style="margin-right:-80px;margin-bottom:0px;">
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
                                                        <label class="lbl lbl_green_37" id="lbl_green_37" style="margin-left:-80px;margin-bottom:0px;">
                                                            <img src="./images/tooth3color/37.png" class="img-tooth img-tooth-37" id="img-tooth-37" onclick="check(37)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_46" id="lbl_green_46" style="margin-right:-90px;margin-bottom:0px;">
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
                                                        <label class="lbl lbl_green_36" id="lbl_green_36" style="margin-left:-90px;margin-bottom:0px;">
                                                            <img src="./images/tooth3color/36.png" class="img-tooth img-tooth-36" id="img-tooth-36" onclick="check(36)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_45" id="lbl_green_45" style="margin-right:-110px;margin-bottom:-0px;">
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
                                                        <label class="lbl lbl_green_35" id="lbl_green_35" style="margin-left:-110px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/35.png" class="img-tooth img-tooth-35" id="img-tooth-35" onclick="check(35)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_44" id="lbl_green_44" style="margin-right:-140px;margin-bottom:-0px;">
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
                                                        <label class="lbl lbl_green_34" id="lbl_green_34" style="margin-left:-140px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/34.png" class="img-tooth img-tooth-34" id="img-tooth-34" onclick="check(34)">
                                                        </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_43" id="lbl_green_43" style="margin-left:55px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/43.png" class="img-tooth img-tooth-43" id="img-tooth-43" onclick="check(43)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_33" id="lbl_green_33" style="margin-right:55px;margin-bottom:-0px;">
                                                            <img src="./images/tooth3color/33.png" class="img-tooth img-tooth-33" id="img-tooth-33" onclick="check(33)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><h5>LR (3)</h5></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_42" id="lbl_green_42" style="margin-bottom:50px;margin-right:2px;">
                                                            <img src="./images/tooth3color/42.png" class="img-tooth img-tooth-42" id="img-tooth-42" onclick="check(42)">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <label class="lbl lbl_green_41" id="lbl_green_41" style="margin-right:2px;">
                                                            <img src="./images/tooth3color/41.png" class="img-tooth img-tooth-41" id="img-tooth-41" onclick="check(41)">
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="lbl lbl_green_31" id="lbl_green_31" style="margin-left:2px;">
                                                            <img src="./images/tooth3color/31.png" class="img-tooth img-tooth-31" id="img-tooth-31" onclick="check(31)">
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <label class="lbl lbl_green_32" id="lbl_green_32" style="margin-bottom:50px;margin-left:2px;">
                                                            <img src="./images/tooth3color/32.png" class="img-tooth img-tooth-32" id="img-tooth-32" onclick="check(32)">
                                                        </label>
                                                    </td>
                                                    <td></td>
                                                    <td class="text-center"><h5>LL (4)</h5></td>
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
                                                {{-- @foreach($teeth as $out_teeth) 
                                                    @if($out_teeth->TeethID == $k && $out_teeth->TypeOfGroupID == null && $out_teeth->GroupNo == null)
                                                        @php $x=$k; @endphp
                                                        <img class="img" src="./images/test.gif" width="0" height="0" onload="OnLoad({{$k}})">
                                                    @elseif($out_teeth->TeethID == $k )
                                                        @php $y=$k; @endphp
                                                        <img class="img" src="./images/test.gif" width="0" height="0" onload="select({{$k}})">
                                                    @endif
                                                @endforeach--}}
                                            @endfor
                                        @endfor
                                        <!-- ROW -->
                                        <div>
                                            <!-- ROW 1 -->
                                            <div class="row mt-12">
                                                <div class="col-lg-6">
                                                    <div class="accordion basic-accordion" role="tablist">
                                                            <div class="card">
                                                                <div class="card-header" role="tab" id="orderRequestTypeID1">
                                                                    <h6 class="mb-0">
                                                                        <a data-toggle="collapse" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Metal Type
                                                                        </a>
                                                                    </h6>
                                                                </div>
                                                                <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID1">
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
                                                            <div class="card-header" role="tab" id="orderRequestTypeID2">
                                                                <h4 class="mb-0">
                                                                    <a data-toggle="collapse" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne2">
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
                                                            <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID2">
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
                                                                                    <div class="col col-sm-3" > <h7>อื่นๆ</h7> </div>
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
                                                            <div class="card-header" role="tab" id="orderRequestTypeID3">
                                                                <h6 class="mb-0">
                                                                    <a data-toggle="collapse" href="#collapseOne3" aria-expanded="true" aria-controls="collapseOne3">
                                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                        CONTOUR AND OCCLUSION DESIGN
                                                                    </a>
                                                                    </h6>
                                                            </div>
                                                            <div id="collapseOne3" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID3">
                                                                <!-- {{ Form::open(['method' => 'get' , 'url' => '/asset']) }} -->
                                                                <div class="card-body text-center">
                                                                    <div class="radio-toolbar4">
                                                                        <div class="row">
                                                                            <div class="col col-sm-12" >
                                                                                <input type="radio" id="radioNON_PRECIOUS" name="contour_type1" value="GINGIVAL_EMBRASURES"  onclick="myFunction1()">
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

                                                                                <input type="radio" name="contour_type1" value="OCCLUSION" id="radioOCCLUSION"  onclick="myFunction1()" >
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
                                                <div class="col-lg-6">
                                                    <div class="accordion basic-accordion" role="tablist">
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="orderRequestTypeID4">
                                                                <h6 class="mb-0">
                                                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                   <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                    SHADE
                                                                </a>
                                                                </h6>
                                                            </div>
                                                            <div id="collapseOne4" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID4">
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
                                                            </div>
                                                             <!-- {{ Form::close() }} -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ROW 2 -->

                                            <!-- ROW 3 -->
                                            <div class="row mt-12">
                                                <div class="col-lg-6">
                                                    <div class="accordion basic-accordion" role="tablist">
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="orderRequestTypeID5">
                                                                <h6 class="mb-0">
                                                                <a data-toggle="collapse" href="#collapseOne5" aria-expanded="true" aria-controls="collapseOne">
                                                                   <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                   OCCLUSAL STAINING
                                                                </a>
                                                                </h6>
                                                            </div>
                                                            <div id="collapseOne5" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID5">
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

                                                <div class="col-lg-6">
                                                    <div class="accordion basic-accordion" role="tablist">
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="orderRequestTypeID6">
                                                                <h6 class="mb-0">
                                                                    <a data-toggle="collapse" href="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                        PONTIC DESIGN
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                            <div id="collapseOne6" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID6">
                                                                <!-- {{ Form::open(['method' => 'get' , 'url' => '/asset']) }} -->
                                                                <div class="row" align="center">
                                                                    <div class="col-4">
                                                                        <input type="radio" name="pontic_design" id="sad" class="input-hidden1" value="1"/>
                                                                        <label for="sad">
                                                                        <img src="images/pontic-design/1.png" alt="I'm sad" />
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="radio" name="pontic_design" id="sad2" class="input-hidden1" value="2"/>
                                                                        <label for="sad2">
                                                                        <img src="images/pontic-design/2.png" alt="I'm sad" />
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="radio" name="pontic_design" id="sad3" class="input-hidden1" value="3"/>
                                                                        <label for="sad3">
                                                                        <img src="images/pontic-design/2.png"   alt="I'm sad" />
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="radio" name="pontic_design" id="sad4" class="input-hidden1" value="4"/>
                                                                        <label for="sad4">
                                                                        <img src="images/pontic-design/3.png"  alt="I'm sad" />
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="radio" name="pontic_design" id="sad5" class="input-hidden1" value="5"/>
                                                                        <label for="sad5">
                                                                        <img src="images/pontic-design/4.png"   alt="I'm sad" />
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <input type="radio" name="pontic_design" id="sad6" class="input-hidden1" value="6"/>
                                                                        <label for="sad6">
                                                                        <img src="images/pontic-design/5.png"   alt="I'm sad" />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- {{ Form::close() }} -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ROW 3 -->
                                            
                                            <!-- ROW 4 -->
                                            <div class="row mt-12">
                                                <div class="col-lg-6">
                                                    <div class="accordion basic-accordion" role="tablist">
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="orderRequestTypeID7">
                                                                <h6 class="mb-0">
                                                                <a data-toggle="collapse" href="#collapseOne7" aria-expanded="true" aria-controls="collapseOne7">
                                                                   <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                    MARGIN AND MENTAL DESIGN Type
                                                                </a>
                                                                </h6>
                                                            </div>
                                                            <div id="collapseOne7" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID7">
                                                                    <div class="row" align="center">
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_1" id="sad11" class="input-hidden2" value="1"/>
                                                                            <label for="sad11">
                                                                                <img src="images/mental-design/11.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_1" id="sad12" class="input-hidden2" value="2"/>
                                                                            <label for="sad12">
                                                                                <img src="images/mental-design/12.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_1" id="sad13" class="input-hidden2" value="3"/>
                                                                            <label for="sad13">
                                                                                <img src="images/mental-design/13.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_1" id="sad14" class="input-hidden2" value="4"/>
                                                                            <label for="sad14">
                                                                                <img src="images/mental-design/14.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row" align="center">
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_2" id="sad15" class="input-hidden2" value="1"/>
                                                                            <label for="sad15">
                                                                                <img src="images/mental-design/21.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_2" id="sad16" class="input-hidden2" value="2"/>
                                                                            <label for="sad16">
                                                                                <img src="images/mental-design/22.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_2" id="sad17" class="input-hidden2" value="3"/>
                                                                            <label for="sad17">
                                                                                <img src="images/mental-design/23.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_2" id="sad18" class="input-hidden2" value="4"/>
                                                                            <label for="sad18">
                                                                                <img src="images/mental-design/24.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_2" id="sad19" class="input-hidden2" value="5"/>
                                                                            <label for="sad19">
                                                                                <img src="images/mental-design/25.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_2" id="sad20" class="input-hidden2" value="6"/>
                                                                            <label for="sad20">
                                                                                <img src="images/mental-design/26.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-3">
                                                                            <input type="radio" name="mental_design_type_2" id="sad21" class="input-hidden2" value="7"/>
                                                                            <label for="sad21">
                                                                                <img src="images/mental-design/27.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row"  align="center">
                                                                        &nbsp&nbsp&nbsp&nbsp&nbsp
                                                                        <div class="form-group col-2">
                                                                            <input type="radio" name="mental_design_type_3" id="sad22" class="input-hidden2" value="1"/>
                                                                            <label for="sad22">
                                                                                <img src="images/mental-design/31.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-2">
                                                                            <input type="radio" name="mental_design_type_3" id="sad23" class="input-hidden2" value="2"/>
                                                                            <label for="sad23">
                                                                                <img src="images/mental-design/32.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-2">
                                                                            <input type="radio" name="mental_design_type_3" id="sad24" class="input-hidden2" value="3"/>
                                                                            <label for="sad24">
                                                                                <img src="images/mental-design/33.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-2">
                                                                            <input type="radio" name="mental_design_type_3" id="sad25" class="input-hidden2" value="4"/>
                                                                            <label for="sad25">
                                                                                <img src="images/mental-design/34.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group col-2">
                                                                            <input type="radio" name="mental_design_type_3" id="sad26" class="input-hidden2" value="5"/>
                                                                            <label for="sad26">
                                                                                <img src="images/mental-design/35.png" alt="I'm sad" />
                                                                            </label>
                                                                        </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-lg-6">
                                                    <div class="accordion basic-accordion" role="tablist">
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="orderRequestTypeID8">
                                                               <h6 class="mb-0">
                                                               <a data-toggle="collapse" href="#collapseOne8" aria-expanded="true" aria-controls="collapseOne8">
                                                               <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                Special Requirement Type
                                                            </a>
                                                        </h6>
                                                    </div>
                                                    <div id="collapseOne8" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID8">
                                                        <div class="card-body text-center">
                                                            <div class="checkbox-toolbar8">
                                                                    <div class="row">
                                                                        <div class="col col-sm">

                                                                            <input type="checkbox" id="checkboxWaxfullcontour" name="select_special_requirement_type" value="ดู Wax full contour" >
                                                                            <label for="checkboxWaxfullcontour">ดู Wax full contour</label>

                                                                            <input type="checkbox" id="checkboxContour_porcelain" name="select_special_requirement_type" value="Contour_porcelain">
                                                                            <label for="checkboxContour_porcelain">ดู Contour porcelain</label>

                                                                            <input type="checkbox" id="checkboxDesign" name="select_special_requirement_type" value="ดู Design ทางไลน์" >
                                                                            <label for="checkboxDesign">ดู Design ทางไลน์</label>

                                                                            <input type="checkbox" id="checkboxลองโครงก่อน" name="select_special_requirement_type" value="ลองโครงก่อน">
                                                                            <label for="checkboxลองโครงก่อน">ลองโครงก่อน</label>

                                                                            <input type="checkbox" id="checkboxลอง_contour_พอสเลนก่อนเกรซ" name="select_special_requirement_type" value="ลอง contour พอสเลนก่อนเกรซ" >
                                                                            <label for="checkboxลอง_contour_พอสเลนก่อนเกรซ">ลอง contour พอสเลนก่อนเกรซ</label>

                                                                            <input type="checkbox" id="checkboxขอ_SPURE_ด้วย" name="select_special_requirement_type" value="ขอ SPURE ด้วย">
                                                                            <label for="checkboxขอ_SPURE_ด้วย">ขอ SPURE ด้วย</label>
                                                                        </div>

                                                                        <div class="col col-sm-6" >
                                                                            <input type="checkbox" id="checkboxทำ_PINDEX" name="select_special_requirement_type" value="ทำ PINDEX" >
                                                                            <label for="checkboxทำ_PINDEX">ทำ PINDEX</label>

                                                                            <input type="checkbox" id="checkboxจะส่งคนไข้มาเทียบสีที่_Lab" name="select_special_requirement_type" value="จะส่งคนไข้มาเทียบสีที่ Lab">
                                                                            <label for="checkboxจะส่งคนไข้มาเทียบสีที่_Lab">จะส่งคนไข้มาเทียบสีที่ Lab</label>

                                                                            <input type="checkbox" id="checkboxหมอส่งสีฟันมาทางไลน์" name="select_special_requirement_type" value="หมอส่งสีฟันมาทางไลน์" >
                                                                            <label for="checkboxหมอส่งสีฟันมาทางไลน์">หมอส่งสีฟันมาทางไลน์</label>

                                                                            <input type="checkbox" id="checkboxทางไลน์" name="select_special_requirement_type" value="ทางไลน์">
                                                                            <label for="checkboxทางไลน์">ทางไลน์</label>

                                                                            <input type="checkbox" id="checkboxส่งกลับ" name="select_special_requirement_type" value="ส่งกลับ" >
                                                                            <label for="checkboxส่งกลับ">ส่งกลับ</label>

                                                                            <input type="checkbox" id="checkboxให้ช่างโทรกลับในขั้นตอน" name="select_special_requirement_type" value="ให้ช่างโทรกลับในขั้นตอน">
                                                                            <label for="checkboxให้ช่างโทรกลับในขั้นตอน">ให้ช่างโทรกลับในขั้นตอน__</label>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                                </div>

                                            </div>
                                             <!-- ROW 4 -->
                                        
                                        </div>
                                       <!-- ROW -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12 text-right">
                            <button type="submit" class="btn btn-lg btn-success">
                                ต่อไป<i class="mdi mdi-arrow-right-bold"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
     </div>
</div>
@stop

@section('scripts')
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

    </script>
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
    //    text.style.display = "none";
    }
  }
  </script>
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
        // text2.style.display = "none";
        // text4.style.display = "none";
    }
    else if (radioOCCLUSION.checked == true){
        text2.style.display = "block";
        // text1.style.display = "none";
        
        text4.style.display = "none";
    }
    else if (radioCONTACT.checked == true){
        text4.style.display = "block";
        // text1.style.display = "none";
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
