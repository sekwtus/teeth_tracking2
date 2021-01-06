@extends('layouts.template')

@section('title', 'สิ่งที่ส่งมาด้วย')

@section('stylesheet')
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
                 width: 30%;
                 height: 15%;
                 padding: 20px;
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
<!--enter your code here!!-->
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
      <div class="card">
        {{ Form::open(['method' => 'post' , 'url' => '/order6/addattachment/'.$id_screen]) }}
        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
              <h4>เลือกซี่ฟัน</h4>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-3 m-0 step-timeline">
                <ul class="m-0 step-list">
                    <li>เลือกซี่ฟัน & ชนิดงาน & ชนิดสินค้า</li>
                    <li>จัดกลุ่มซี่ฟัน</li>
                    <li class="yellow">สิ่งที่ส่งมาด้วย</li>
                    <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                </ul>
            </div>
            <div class="col-md-9 step-content">
                <div class="form-group row">
                        <div class="col-lg-12">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                            <li class="breadcrumb-item active" aria-current="page">เลือกสิ่งที่ส่งมาด้วย</li>
                                    </ol>
                                </nav>

                            <div class="accordion basic-accordion" role="tablist">
                              <div role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    สิ่งที่ส่งมาด้วย
                                    </a>
                                </h6>
                              </div>
                            </div>

                            <div class="accordion basic-accordion" role="tablist" style="height : 80%; auto; overflow-y: auto;">
                            <div class="card-body" >
                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID" >
                                    <div class="checkbox-toolbar">

                                        @foreach($data_attachment as $row)
                                        {{-- <div class="icheck-square">
                                            <label class="container">{{ $row->Name }}
                                                @foreach($data_order_attachment as $out_order_attachment)

                                                    @if($out_order_attachment->AttachmentID == $row->ID)
                                                        <input type="checkbox" name="{{$row->Name}}" value="{{ $row->ID }}" checked>
                                                    @endif
                                                @endforeach
                                                        <input type="checkbox" name="{{$row->Name}}" value="{{ $row->ID }}">


                                                <span class="checkmark"></span>
                                            </label>
                                        </div> --}}


                                        {{-- @foreach($data_order_attachment as $out_order_attachment)
                                            @if($out_order_attachment->AttachmentID == $row->ID)
                                                <input type="checkbox" id="{{ $row->ID }}" name="{{$row->Name}}" value="{{ $row->ID }}" checked>
                                                <label for="{{ $row->ID }}"><center>{{ $row->Name }}</center></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            @endif
                                        @endforeach --}}



                                        <input type="checkbox" id="{{ $row->ID }}" name="{{$row->Name}}" value="{{ $row->ID }}">
                                        <label for="{{ $row->ID }}"><center>{{ $row->Name }}</center></label>&nbsp;&nbsp;&nbsp;&nbsp;


                                    @endforeach
                                </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-1" for="other">อื่นๆ</label>
                                        <div class="col-sm-8">
                                                {{ Form::textarea('other',null, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"9"]) }}
                                        </div>
                                    </div>


                                    {{-- <br>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3" for="barcode">อื่นๆ</label>
                                        <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text"/>
                                        </div>
                                    </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                {{-- <a href="{{ url('order5') }}">
                    <button class="btn btn-lg btn-success" v-on:click="backButton" v-bind:disabled="step_number == 1">
                        <i class="mdi mdi-arrow-left-bold"></i>
                        Back Step
                    </button>
                </a> --}}
                <a href="javascript:history.go(-1)">
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
        {{ Form::close() }}
    </div>
    </div>
    </div>
    </div>
@stop
