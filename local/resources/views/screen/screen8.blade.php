@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}
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
                 width: 40%;
                 height: 15%;
                 padding: 15px;
                 font-size:14px;
                 cursor: pointer;
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
                                <li class="yellow">คำสั่งพิเศษ (Special Requirement)</li>
                                <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                            </ul>
                        </div>
                        <div class="col-md-8 step-content">
                                <div class="form-group row">
                                        <div class="col-lg-12">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                            <li class="breadcrumb-item active" aria-current="page">Select Special Requirement Type</li>
                                                    </ol>
                                                </nav>
                                            <div class="accordion basic-accordion" role="tablist">
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                                        <h6 class="mb-0">
                                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                            Special Requirement Type
                                                            </a>
                                                        </h6>
                                                    </div>
                                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                        <div class="card-body text-center">

                                                        <div class="checkbox-toolbar8">
                                                                    <div class="row">
                                                                            <div class="col col-sm">
                                                                                @foreach($data_Requirement as $row)

                                                                                <input type="checkbox" id="{{ $row->ID }}" name="{{ $row->Name }}" value="{{ $row->ID }}">
                                                                                <label for="{{ $row->ID }}"><center>{{ $row->Name }}</center></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                @endforeach
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
                    <a href="{{ url('screen7') }}">
                            <button type="button" class="btn btn-lg btn-success">
                               <i class="mdi mdi-arrow-left-bold"></i>
                               ย้อนกลับ
                            </button>
                        </a>
                <button type="submit" class="btn btn-lg btn-success">
                    @foreach($id_screen as $out_id_screen)
                        <input type="hidden" name="id_screen" value="{{ $out_id_screen->ID }}">
                    @endforeach
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
