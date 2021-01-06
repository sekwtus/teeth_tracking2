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
                    <li>ชื่อบริษัท</li>
                    <li>สาขา</li>
                    <li>โซน</li>
                    <li class="yellow">ชื่อเขต</li>
                </ul>
            </div>
            <div class="col-md-9 step-content">
                    <div class="form-group row">
                            <div class="col-lg-12">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                         @foreach(array_slice($data_zone, 0, 1)  as $data_zone )
                                                <li class="breadcrumb-item">{{ $data_zone ->Name }}</li>
                                                <li class="breadcrumb-item">{{ $data_zone->NameBranch }}</li>
                                                <li class="breadcrumb-item">{{ $data_zone->NameZone }}</li>
                                         @endforeach    
                                                <li class="breadcrumb-item active" aria-current="page">ชื่อเขต</li>
                                        </ol>
                                    </nav>
                                <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" >
                                    <h6 class="mb-0">
                                        <a data-toggle="collapse"  aria-expanded="true" >
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        ชื่อเขต
                                        </a>
                                    </h6>
                                    </div>
                                    <div  class="collapse show" >
                                       <div class="card-body text-center">
                                            @foreach($data_zone2  as $data_zone2 )
                                                <button name="radio" class="button1" type="submit"  >
                                                {{ $data_zone2 ->NameArea }}
                                                </button>
                                            @endforeach
                                            <br>
                                                <br>
                                                <br>
                                                <div class="col-lg-12 ">
                                                    <button  class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#">
                                                        เพิ่ม
                                                    </button>
                                                        
                                                    <button  class="btn btn-outline-danger" align="right" data-toggle="modal" data-target="#">
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
