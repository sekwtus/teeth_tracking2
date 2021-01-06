@extends('layouts.template')

@section('stylesheet')

@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">

             {{-- 1 --}}
             <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-danger">
                        <li class="breadcrumb-item active" aria-current="page">ข้อมูลทั่วไป</li>
                    </ol>
            </nav>
            <div class="card">
                @foreach($order as $out_order)
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-form-label col-sm-1">ท.พ./ท.ญ.</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{ Form::text('doctor',$out_order->doctor, ['class' => 'form-control','placeholder' => 'ชื่อ - นามสกุล','readonly']) }}
                            </div>
                        </div>
                        <label class="col-form-label col-sm-1">เบอร์โทร</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{ Form::text('phone',$out_order->phone, ['class' => 'form-control','placeholder' => 'เบอร์โทร','readonly']) }}
                            </div>
                        </div>
                        <label class="col-form-label col-sm-1">ร.พ./คลีนิค</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{ Form::text('customer',$out_order->customer, ['class' => 'form-control','placeholder' => 'ร.พ./คลีนิค','readonly']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-1">HN</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{ Form::text('PatientHN',$out_order->PatientHN, ['class' => 'form-control','placeholder' => 'HN','readonly']) }}
                            </div>
                        </div>
                        <label class="col-form-label col-sm-2">Address/Email/line</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                {{ Form::text('Address',$out_order->Address, ['class' => 'form-control','placeholder' => 'Address/Email/line','readonly']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-1">คนไข้</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{ Form::text('PatientName',$out_order->PatientName, ['class' => 'form-control','placeholder' => 'คนไข้','readonly']) }}
                            </div>
                        </div>
                        <label class="col-form-label col-sm-1">อายุ</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{ Form::text('PatientAge',$out_order->PatientAge, ['class' => 'form-control','placeholder' => 'อายุ','min'=>"1",'max'=>"99" ,'onKeyPress'=>'if(this.value.length==2) return false;','readonly']) }}
                            </div>
                        </div>
                        <?php
                        $sex = '';
                        if ($out_order->PatientSex == 1) {
                            $sex = 'ชาย';
                        } elseif ($out_order->PatientSex == 2) {
                            $sex = 'หญิง';
                        } else {
                            $sex = 'ไม่ระบุเพศ';
                        }
                        ?>
                        <label class="col-form-label col-sm-1">เพศ</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                {{ Form::text('sex',$sex, ['class' => 'form-control','placeholder' => 'เพศ','readonly']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-1">วันที่รับ</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                {{ Form::text('StartDate',$out_order->StartDate, ['ID'=>'startdate','data-date-format'=>'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันที่รับ' ,'readonly']) }}
                            </div>
                        </div>
                        <label class="col-form-label col-sm-1">เวลา</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                {{ Form::text('time',null, ['class' => 'form-control','placeholder' => 'เวลา','readonly']) }}
                            </div>
                        </div>
                        <label class="col-form-label col-sm-1">วันที่ส่ง</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                {{ Form::text('DeliverDate',$out_order->DeliverDate, ['ID'=>'enddate','data-date-format'=>'dd/mm/yyyy','class' => 'form-control','placeholder' => 'วันที่ส่ง' ,'readonly']) }}
                            </div>
                        </div>
                        <label class="col-form-label col-sm-1">เวลา</label>
                        <div class="col-sm-2">
                            <div class="input-group">
                                {{ Form::time('ReceptionTime',$out_order->ReceptionTime, ['ID'=>'time1','class' => 'form-control','placeholder' => 'เวลา' ,'readonly']) }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <br>

            @foreach($data_all as $out_data_all)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">รายละเอียด Screen [Order : {{ $out_data_all->ID_order_screen }}&nbsp;&nbsp;/&nbsp;&nbsp;Teeth : #{{ $out_data_all->TeethID }}]</li><a href="{{ url('mainscreen/detail/teeth/edit').'/'.$out_data_all->ID_order_screen.'/'.$out_data_all->TeethID }}"><button class="btn btn-lg btn-warning">Edit</button></a>
                    </ol>
                </nav>

                <div class="accordion basic-accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    คำสั่งพิเศษ
                                </a>
                            </h6>
                        </div>

                        <div id="collapse11" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="card-body" >
                                @foreach ($select_extra as $extra)
                                    @if ($extra->TeethID == $out_data_all->TeethID)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" readonly value="{{ $extra->topic }}" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                @if ($extra->detail != null)
                                                <input type="text" class="form-control" readonly value="{{ $extra->detail }}" >
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                             <div class="input-group">
                                                @if ($extra->detail_2 != null)
                                                <input type="text" class="form-control" readonly value="{{ $extra->detail_2 }}" >
                                                @endif
                                             </div>
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion basic-accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse12" aria-expanded="true" aria-controls="collapse12">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    E.MAX & COLOR
                                </a>
                            </h6>
                        </div>

                        <div id="collapse12" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="card-body" >
                                    <div class="row">
                                        <label class="col-form-label col-sm-1">E.MAX</label>
                                        <input type="text" class="form-control col-sm-5" readonly value="{{ $out_data_all->e_max }}" >
                                        <label class="col-form-label col-sm-1">Color</label>
                                        <input type="text" class="form-control col-sm-5" readonly value="{{ $out_data_all->color }}" >
                                    </div>
                                    <br>
                                    <div class="row">
                                            <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                            <textarea class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_emax_color }}" ></textarea>
                                    </div>
                                    <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion basic-accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse13" aria-expanded="true" aria-controls="collapse13">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    Ceramage
                                </a>
                            </h6>
                        </div>

                        <div id="collapse13" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="card-body" >
                                    <div class="row">
                                        <label class="col-form-label col-sm-2"></label>
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->ceramage }}" >
                                    </div>
                                    <br>
                                    <div class="row">
                                            <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                            <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_emax_color }}" ></textarea>
                                    </div>
                                    <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion basic-accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse14" aria-expanded="true" aria-controls="collapse14">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    ZIRCONIA
                                </a>
                            </h6>
                        </div>

                        <div id="collapse14" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="card-body" >
                                    <div class="row">
                                        <label class="col-form-label col-sm-3">COPPING</label>
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->zirconia_copping }}" >
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label class="col-form-label col-sm-3">ALL ZIRCONIA CROWN</label>
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->zirconia_crown }}" >
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label class="col-form-label col-sm-3">SELECT RESTORATION TYPE</label>
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->zirconia_restoration }}" >
                                    </div>
                                    <br>
                                    <div class="row">
                                            <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                            <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_emax_color }}" ></textarea>
                                    </div>
                                    <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion basic-accordion" role="tablist">
                     <div class="card">
                         <div class="card-header" role="tab" id="orderRequestTypeID">
                             <h6 class="mb-0">
                                 <a data-toggle="collapse" href="#collapse15" aria-expanded="true" aria-controls="collapse15">
                                     <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                     MODEL
                                 </a>
                             </h6>
                         </div>

                         <div id="collapse15" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                             <div class="card-body" >
                                 @if ($out_data_all->model_resin == null)
                                    <div class="row">
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->model }}" >
                                    </div>
                                 @else
                                    <div class="row">
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->model }}" >
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->model_resin }}" >
                                     </div>
                                 @endif
                                     <br>
                                     <div class="row">
                                             <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                             <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_emax_color }}" ></textarea>
                                     </div>
                                     <br>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="accordion basic-accordion" role="tablist">
                      <div class="card">
                          <div class="card-header" role="tab" id="orderRequestTypeID">
                              <h6 class="mb-0">
                                  <a data-toggle="collapse" href="#collapse16" aria-expanded="true" aria-controls="collapse16">
                                      <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                      IMPLANT
                                  </a>
                              </h6>
                          </div>

                          <div id="collapse16" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body" >

                                        @if ( $out_data_all->implant_ceramage != null)
                                            <div class="row">
                                                    <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->implant }}" >
                                                    <label class="col-form-label col-sm-1"></label>
                                                    <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->implant_ceramage }}" >
                                            </div><br>
                                        @elseif($out_data_all->implant_screw != null )
                                            <div class="row">
                                                    <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->implant }}" >
                                                    <label class="col-form-label col-sm-1"></label>
                                                    <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->implant_screw }}" >
                                            </div><br>
                                        @else
                                            <div class="row">
                                                <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->implant }}" >
                                            </div>
                                            <br>
                                        @endif
                                        <div class="row">
                                                <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                                <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_emax_color }}" ></textarea>
                                        </div>
                                        <br>
                                </div>
                          </div>
                      </div>
                  </div>

                  <div class="accordion basic-accordion" role="tablist">
                      <div class="card">
                          <div class="card-header" role="tab" id="orderRequestTypeID">
                              <h6 class="mb-0">
                                  <a data-toggle="collapse" href="#collapse17" aria-expanded="true" aria-controls="collapse17">
                                      <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                      รับตะขอ
                                  </a>
                              </h6>
                          </div>

                          <div id="collapse17" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                              <div class="card-body" >
                                      <div class="row">
                                          <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->Hook }}" >
                                      </div>
                                      <br>
                                      @if ($out_data_all->Hook == 'have')
                                        <div class="row">
                                            <label class="col-form-label col-sm-2">HOOK TYPE</label>
                                            @if ($out_data_all->MESIAL_REST != null )
                                              <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->MESIAL_REST }}" >
                                            @elseif( $out_data_all->DISTAL_REST != null )
                                              <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->DISTAL_REST }}" >
                                            @elseif( $out_data_all->CINGULUM_REST != null )
                                              <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->CINGULUM_REST }}" >
                                            @elseif( $out_data_all->LINGUAL_LEDGE != null )
                                              <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->LINGUAL_LEDGE }}" >
                                            @elseif( $out_data_all->EMBRESSURE_REST != null )
                                              <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->EMBRESSURE_REST }}" >
                                            @elseif( $out_data_all->other_hook != null )
                                              <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->other_hook }}" >
                                            @endif
                                        </div>

                                        <div class="row">
                                                <label class="col-form-label col-sm-2">UNDERCUT</label>
                                                <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->undercut_hook }}" >
                                                <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->unit_hook }}" >
                                        </div>
                                      @endif
                                      <br>
                                      <div class="row">
                                              <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                              <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_emax_color }}" ></textarea>
                                      </div>
                                      <br>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="accordion basic-accordion" role="tablist">
                      <div class="card">
                          <div class="card-header" role="tab" id="orderRequestTypeID">
                              <h6 class="mb-0">
                                  <a data-toggle="collapse" href="#collapse18" aria-expanded="true" aria-controls="collapse18">
                                      <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                      CONTOUR AND OCCLUSION DESIGN & PONTIC DESIGE
                                  </a>
                              </h6>
                          </div>

                          <div id="collapse18" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                              <div class="card-body" >
                                  @if ($out_data_all->CONTOUR == 'OPEN' || $out_data_all->CONTOUR == 'CLOSE')
                                    <div class="row">
                                        <label class="col-form-label col-sm-3">GINGIVAL EMBRASURES</label>
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->CONTOUR }}" >
                                    </div>
                                    <br>
                                  @elseif($out_data_all->CONTOUR == 'สบสนิท' || $out_data_all->CONTOUR == 'UNDER')
                                    <div class="row">
                                        <label class="col-form-label col-sm-3">OCCLUSION</label><input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->CONTOUR }}" >

                                    </div>
                                    <br>
                                  @elseif($out_data_all->CONTOUR == 'สบสนิท' || $out_data_all->CONTOUR == 'UNDER')
                                    <div class="row">
                                        <label class="col-form-label col-sm-3">OCCLUSION</label>
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->CONTOUR }}" >
                                        @if ($out_data_all->unit_CONTOUR != null)
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->unit_CONTOUR }}" >
                                        @endif
                                    </div>
                                    <br>
                                  @elseif($out_data_all->CONTOUR == 'AREA' || $out_data_all->CONTOUR == 'POINT')
                                    <div class="row">
                                        <label class="col-form-label col-sm-3">CONTACT</label>
                                        <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->CONTOUR }}" >
                                    </div>
                                    <br>
                                  @endif

                                    <div class="row">
                                        <label class="col-form-label col-sm-2"> PONTIC DESIGE</label>
                                        <img class="pontic" style="width: 5%; height:25%;" src="{{ asset('images/pontic-design/'.$out_data_all->PONTIC_DESIGN) }}" alt="I'm sad"/>
                                    </div>
                                  <div class="row">
                                          <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                          <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_emax_color }}" ></textarea>
                                  </div>
                                  <br>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#collapse19" aria-expanded="true" aria-controls="collapse19">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                        SHADE
                                    </a>
                                </h6>
                            </div>

                            <div id="collapse19" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body" >
                                    @if ($out_data_all->one_color != null && $out_data_all->one_color != 'อื่นๆ')
                                      <div class="row">
                                          <label class="col-form-label col-sm-2">สีเดียว</label>
                                          <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->one_color }}" >
                                          <label class="col-form-label col-sm-1"></label>
                                          <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->one_color_Combobox }}" >
                                      </div>
                                      <br>
                                    @elseif($out_data_all->one_color != null && $out_data_all->one_color == 'อื่นๆ')
                                      <div class="row">
                                          <label class="col-form-label col-sm-2">สีเดียว</label>
                                          <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->one_color }}" >
                                          <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->one_color_branch }}" >
                                          <input type="text" class="form-control col-sm-3" readonly value="{{ $out_data_all->one_color_branch_color }}" >
                                      </div>
                                      <br>

                                  @elseif($out_data_all->one_color == null)
                                      <div class="row">
                                          <label class="col-form-label col-sm-2">หลายสี</label>
                                      </div>
                                      <br>
                                      <div class="row">
                                           <h4 class="col-sm-4 col-form-label">คอฟัน:</h4>
                                           <div class="col-sm-8">
                                               <input class="form-control" type="text" readonly value="{{ $out_data_all->many_branch_crowns }}" >                                                                                    &nbsp;
                                               <input class="form-control" type="text" readonly value="{{ $out_data_all->many_color_crowns }}" >
                                           </div>
                                      </div>
                                      &nbsp;
                                      <div class="row">
                                          <h4 class="col-sm-4 col-form-label">กลางฟัน:</h4>
                                          <div class="col-sm-8">
                                              <input class="form-control" type="text" readonly value="{{ $out_data_all->many_branch_Middle }}" >                                                                                    &nbsp;
                                              <input class="form-control" type="text" readonly value="{{ $out_data_all->many_color_Middle }}" >
                                          </div>
                                      </div>
                                      &nbsp;
                                      <div class="row">
                                          <h4 class="col-sm-4 col-form-label">ปลายฟัน:</h4>
                                          <div class="col-sm-8">
                                              <input class="form-control" type="text" readonly value="{{ $out_data_all->many_branch_tip }}" >                                                                                    &nbsp;
                                              <input class="form-control" type="text" readonly value="{{ $out_data_all->many_color_tip }}" >
                                          </div>
                                      </div>

                                    @endif

                                    <div class="row">
                                            <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                            <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_shade }}" ></textarea>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion basic-accordion" role="tablist">
                          <div class="card">
                              <div class="card-header" role="tab" id="orderRequestTypeID">
                                  <h6 class="mb-0">
                                      <a data-toggle="collapse" href="#collapse20" aria-expanded="true" aria-controls="collapse20">
                                          <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                          ALLOYS
                                      </a>
                                  </h6>
                              </div>

                              <div id="collapse20" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                  <div class="card-body" >
                                          <div class="row">
                                              <label class="col-form-label col-sm-2"></label>
                                              <input type="text" class="form-control col-sm-4" readonly value="{{ $out_data_all->Metal_type }}" >
                                          </div>
                                          <br>
                                          <div class="row">
                                                  <label class="col-form-label col-sm-2">รอถามแพทย์</label>
                                                  <textarea  class="form-control col-sm-4" readonly value="{{ $out_data_all->comment_Metal_type }}" ></textarea>
                                          </div>
                                          <br>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="accordion basic-accordion" role="tablist">
                          <div class="card">
                              <div class="card-header" role="tab" id="orderRequestTypeID">
                                  <h6 class="mb-0">
                                      <a data-toggle="collapse" href="#collapse21" aria-expanded="true" aria-controls="collapse21">
                                          <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                          MARGIN AND MENTAL DESIGN
                                      </a>
                                  </h6>
                              </div>

                              <div id="collapse21" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                  <div class="card-body" >
                                        <div class="row">
                                            <label class="col-form-label col-sm-2"></label>
                                            <img class="pontic" style="width: 5%; height:25%;" src="{{ asset('images/mental-design/'.$out_data_all->MARGIN1) }}" alt="I'm sad"/>
                                            <label class="col-form-label col-sm-2"></label>
                                            <img class="pontic" style="width: 5%; height:25%;" src="{{ asset('images/mental-design/'.$out_data_all->MARGIN2) }}" alt="I'm sad"/>
                                            <label class="col-form-label col-sm-2"></label>
                                            <img class="pontic" style="width: 5%; height:25%;" src="{{ asset('images/mental-design/'.$out_data_all->MARGIN3) }}" alt="I'm sad"/>
                                        </div>
                                        <br>
                                  </div>
                              </div>
                          </div>
                      </div>

                <div class="accordion basic-accordion" role="tablist">
                    <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                    สิ่งที่ส่งมาด้วย & IMPLANT
                                </a>
                            </h6>
                        </div>

                        <div id="collapsetwo" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="card-body" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php $countx = 1; ?>
                                        @foreach($data_Requirement as $row)
                                            @if($row->TeethID == $out_data_all->TeethID)
                                            <p>{{ $countx++ }}. &nbsp; {{ $row->topic }}  จำนวน : {{ $row->count }} รายละเอียด : {{ $row->detail }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                    {{ Form::open(['method' => 'post' ,'url' => 'mainscreen/detail/teeth/'.$out_data_all->ID_order_screen.'/'.$out_data_all->TeethID.'/update']) }}
                                        <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                    <i class="ace-icon glyphicon glyphicon-home"></i>
                                                    </span>
                                                    <textarea class="form-control" name='detail' placeholder="กรอกรายละเอียดเพิ่มเติม" cols='50' rows="2" disabled >{{ $out_data_all->detail }}</textarea>
                                                </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                    <input type="button" class="btn btn-block btn-warning" style="width:20%;" name='edit' value='edit'/>&nbsp;
                                                    <button disabled type="submit" class="btn btn-success waves-effect waves-light m-r-10">Save</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                    </div>
                                </div>

                            <div class="row">
                                <label class="col-form-label col-sm-2">IMPLANT</label>
                                <div class="card-body" >
                                        @foreach ($data_implant as $implant)
                                            @if ($implant->TeethID == $out_data_all->TeethID)
                                                    <input type="text" class="form-control col-sm-4" readonly value="{{ $implant->topic }}" > <br>
                                            @endif
                                        @endforeach
                                      <br>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop

@section('scripts')
    {{-- edit button --}}
    <script>
            $(document).ready(function(){

                $("form input[type=text],from textarea").prop("disabled",true);

                $("input[name=edit]").on("click",function(){

                    $(this).closest("form").find("input[type=text],input[type=number],input[type=tel],input[type=email],select,button[type=submit],textarea").removeAttr("disabled");
                })

            //  $("input[name=save]").on("click",function(){

            //     $(this).closest("form").find("input[type=text],input[type=checkbox],select").prop("disabled",true);
            //  })


            })
    </script>
@stop
