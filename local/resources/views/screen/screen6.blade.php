@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}
<!-- <style type="text/css">
    .hidden{
      display:none;
    }
    .img-tooth{
      width:100%;
      height:120px;
    }
</style> -->
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
    width: 100px;
    height: 100px;
    transition: 500ms all;
  }
</style>

@stop

@section('content')
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
    {{ Form::open(['method' => 'post' , 'url' => '/screen6/add']) }}
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
                    <li class="yellow">PONTIC DESIGN</li>
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
                                                    <li class="breadcrumb-item active" aria-current="page">PONTIC DESIGN</li>
                                            </ol>
                                        </nav>
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
                </div>
        </div>


        <div class="row mt-2">
                <div class="col-sm-12 text-right">
                        <a href="{{ url('screen5') }}">
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
