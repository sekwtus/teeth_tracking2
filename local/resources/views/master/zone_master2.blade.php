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
        </style>
        <style>
        .button1 {
                 display:inline-block;
                 background-color:#ddd;
                 width: 30%;
                 height: 15%;
                 padding: 20px;
                 font-size:12px;
                 cursor: pointer;
                 border-radius: 4px;
                 border: none;
                 margin: 3px;
             }
        .button1:hover
            {
                background-color: #19d895;
                color: white;
            }
    </style>

<style>
            #myInput {
                        background-image: url('/css/searchicon.png'); /* Add a search icon to input */
                        background-position: 10px 12px; /* Position the search icon */
                        background-repeat: no-repeat; /* Do not repeat the icon image */
                        width: 75%;
                        font-size: 14px; /* Increase font-size */
                        padding: 12px 20px 12px 40px; /* Add some padding */
                        border: 1px solid #ddd; /* Add a grey border */
                        margin-bottom: 10px; /* Add some space below the input */
                        }
    </style>
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
              <h4>Zone Master</h4>
            </div>
          </div>
        <div class="row mt-3">
            <div class="col-md-3 m-0 step-timeline">
                <ul class="m-0 step-list">
                   <li>โซน</li>
                   <li class="yellow">เขต</li>
                </ul>
            </div>
            <div class="col-md-9 step-content">
                    <div class="form-group row">
                            <div class="col-lg-12">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                            @foreach($data_company as $data_company)
                                                <input type="hidden" id="custId" name="custId" value="{{$data_company->ID}}">
                                                <li class="breadcrumb-item">{{ $data_company->Name }}</li>
                                            @endforeach
                                                <li class="breadcrumb-item active" aria-current="page">เลือกเขต</li>
                                        </ol>
                                    </nav>
                                <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" >
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse"  aria-expanded="true" >
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                            เขต
                                        </a>
                                    </h6>
                                    </div>
                                    <div  class="collapse show" >
                                       <div id="myUL" class="card-body text-center">
                                            <div  class="row">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-5" align="center">
                                                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาเขต" title="Type in a name">
                                                </div>
                                            </div>
                                            @foreach($data_area as $out_data_area)
                                            <a href="#">
                                                <button name="radio"  class="button1" name="radio" value="{{ $out_data_area->ID }}">
                                                    {{ $out_data_area->Name }}
                                                </button>
                                            </a>
                                            @endforeach
                                            <br>
                                                <br>
                                                <br>
                                                <div class="col-lg-12 ">
                                                    <button  class="btn btn-outline-success" align="left" >
                                                        เพิ่ม
                                                    </button>
                                                        
                                                    <button  class="btn btn-outline-danger" align="right" >
                                                        เเก้ใข
                                                    </button>
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
                <a href="javascript:history.go(-1)">
                    <button type="button" class="btn btn-lg btn-success">
                        <i class="mdi mdi-arrow-left-bold"></i>
                        ย้อนกลับ
                    </button>
                </a>
                {{-- <button type="submit" class="btn btn-lg btn-success">
                    Next Step
                    <i class="mdi mdi-arrow-right-bold"></i>
                </button> --}}
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
            function myFunction() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("a");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("button")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
    </script>

@stop
