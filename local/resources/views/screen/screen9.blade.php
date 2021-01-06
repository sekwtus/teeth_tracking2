@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}
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
                 width: 40%;
                 height: 15%;
                 padding: 15px;
                 font-size:14px;
                 cursor: pointer;
                 /* border: 2px solid #444; */
                 /* border-radius: 4px;     */
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
    </style>
@stop

@section('content')
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            {{ Form::open(['method' => 'post' , 'url' => '/screen8/add']) }}
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
                                <li>OCCLUSAL STAINING</li>
                                <li>PONTIC DESIGN</li>
                                <li>MARGIN AND MENTAL DESIGN</li>
                                <li>คำสั่งพิเศษ (Special Requirement)</li>
                                <li class="yellow">ตรวจสอบข้อมูล & บันทึก</li>
                            </ul>
                        </div>
                        <div class="col-md-8 step-content">

                        </div>
                    </div>
                    <div class="col-sm-12 text-right">
                            <a href="{{ url('screen8') }}">
                                <button type="button" class="btn btn-lg btn-success">
                                   <i class="mdi mdi-arrow-left-bold"></i>
                                   ย้อนกลับ
                                </button>
                            </a>
                            <a href="{{ url('mainscreen') }}">
                                <button type="button" class="btn btn-lg btn-success">
                                    จบงาน
                                </button>
                            </a>
                        </div>

        {{-- <div class="row mt-2">
            <div class="col-sm-12 text-right">
                <a href="{{ url('screen7') }}">
                    <button type="submit" class="btn btn-lg btn-success">
                        Back Step

                    </button>
                </a>
                <button type="submit" class="btn btn-lg btn-success">
                    Finish

                </button>
            </div>
        </div> --}}
        </div>
    </div>
    {{ Form::close() }}
    </div>
    </div>
    </div>
@stop
