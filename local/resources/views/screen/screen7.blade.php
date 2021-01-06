@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}
<style type="text/css">
    .hidden{
      display:none;
    }
    .img-tooth{
      width:100%;
      height:120px;
    }
</style>
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
    {{ Form::open(['method' => 'post' , 'url' => '/screen7/add']) }}
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
                    <li class="yellow">MARGIN AND MENTAL DESIGN</li>
                    <li class="white">คำสั่งพิเศษ (Special Requirement)</li>
                    <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                  </ul>
                </div>
                <div class="col-md-8 step-content">
                        <div class="form-group row">
                                <div class="col-lg-12">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                    <li class="breadcrumb-item active" aria-current="page">Select MARGIN AND MENTAL DESIGN Type</li>
                                            </ol>
                                        </nav>
                                    <div class="accordion basic-accordion" role="tablist">
                                       <div class="card">
                                        <div class="card-header" role="tab" id="orderRequestTypeID">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                            MARGIN AND MENTAL DESIGN Type
                                            </a>
                                        </h6>
                                        </div>
                                        <div class="row" align="center">

                                                <div class="form-group col-3">
                                                    <input type="radio" name="mental_design_type_1" id="sad" class="input-hidden2" value="1"/>
                                                    <label for="sad">
                                                      <img src="images/mental-design/11.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                   <input type="radio" name="mental_design_type_1" id="sad1" class="input-hidden2" value="2"/>
                                                    <label for="sad1">
                                                      <img src="images/mental-design/12.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="radio" name="mental_design_type_1" id="sad2" class="input-hidden2" value="3"/>
                                                    <label for="sad2">
                                                      <img src="images/mental-design/13.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="radio" name="mental_design_type_1" id="sad3" class="input-hidden2" value="4"/>
                                                    <label for="sad3">
                                                      <img src="images/mental-design/14.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                              </div>
                                              <hr>
                                              <div class="row" align="center">
                                                <div class="form-group col-3">
                                                    <input type="radio" name="mental_design_type_2" id="sad4" class="input-hidden2" value="1"/>
                                                    <label for="sad4">
                                                      <img src="images/mental-design/21.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                   <input type="radio" name="mental_design_type_2" id="sad5" class="input-hidden2" value="2"/>
                                                    <label for="sad5">
                                                      <img src="images/mental-design/22.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="radio" name="mental_design_type_2" id="sad6" class="input-hidden2" value="3"/>
                                                    <label for="sad6">
                                                      <img src="images/mental-design/23.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                   <input type="radio" name="mental_design_type_2" id="sad7" class="input-hidden2" value="4"/>
                                                    <label for="sad7">
                                                      <img src="images/mental-design/24.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="radio" name="mental_design_type_2" id="sad8" class="input-hidden2" value="5"/>
                                                    <label for="sad8">
                                                      <img src="images/mental-design/25.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                   <input type="radio" name="mental_design_type_2" id="sad9" class="input-hidden2" value="6"/>
                                                    <label for="sad9">
                                                      <img src="images/mental-design/26.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input type="radio" name="mental_design_type_2" id="sad10" class="input-hidden2" value="7"/>
                                                    <label for="sad10">
                                                      <img src="images/mental-design/27.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                              </div>
                                              <hr>

                                              <div class="row"  align="center">
                                                 &nbsp&nbsp&nbsp&nbsp&nbsp
                                                <div class="form-group col-2">
                                                   <input type="radio" name="mental_design_type_3" id="sad11" class="input-hidden2" value="1"/>
                                                    <label for="sad11">
                                                      <img src="images/mental-design/31.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-2">
                                                   <input type="radio" name="mental_design_type_3" id="sad12" class="input-hidden2" value="2"/>
                                                    <label for="sad12">
                                                      <img src="images/mental-design/32.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-2">
                                                   <input type="radio" name="mental_design_type_3" id="sad13" class="input-hidden2" value="3"/>
                                                    <label for="sad13">
                                                      <img src="images/mental-design/33.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-2">
                                                    <input type="radio" name="mental_design_type_3" id="sad14" class="input-hidden2" value="4"/>
                                                    <label for="sad14">
                                                      <img src="images/mental-design/34.png" alt="I'm sad" />
                                                    </label>
                                                </div>
                                                <div class="form-group col-2">
                                                   <input type="radio" name="mental_design_type_3" id="sad15" class="input-hidden2" value="5"/>
                                                    <label for="sad15">
                                                      <img src="images/mental-design/35.png" alt="I'm sad" />
                                                    </label>
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
                        <a href="{{ url('screen6') }}">
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
