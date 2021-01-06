@extends('layouts.template')

@section('title', 'Order')

@section('stylesheet')
    {{-- <style>
        body {margin:2em;}
        tfoot tr, thead tr {
            background: lightblue;
        }
        tfoot td {
            font-weight:bold;
        }
    </style> --}}
@stop

@section('content')

<div class="content-wrapper">
  <div class="row grid-margin">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-header header-sm">
          <div class="row">
            <div class="col-10">
              <ul class="nav nav-tabs tab-basic" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#product" role="tab" aria-controls="whoweare" aria-selected="true"><h6>รายการที่สั่งผลิต</h6></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#complete" role="tab" aria-controls="ourgoal" aria-selected="false"><h6>รายการผลิตที่เสร็จแล้ว</h6></a>
                </li>
              </ul>
            </div>
            <div class="col-2">
              <!--<a class="btn btn-warning btn-fw" href="{{ url('order') }}">
              <i class="mdi mdi-plus"></i>
              Editing Order
              </a>-->
              <a align="right" class="btn btn-primary btn-fw" href="{{ url('order') }}">
                  <i class="mdi mdi-plus"></i>
                  สร้างงานใหม่
              </a>
            </div>
          </div>
        </div>
            <!--data table-->
        <div class="card-body">
          {{-- <table id="order-listing" class="table" style="width:100%"> --}}
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="home-tab">
              <table  id="example0" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>เขต</th>
                        <th>บาร์โค้ด</th>
                        <th>วันที่สั่งผลิต</th>
                        <th>วันที่นัดจริง</th>
                        <th>คลินิก</th>
                        <th>ทันตแพทย์</th>
                        <th>คนไข้</th>
                        <th>สถานะงาน</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $count = 0; ?>
                  @foreach ($order_sale as $out_order_sale)
                  {{-- {{ Form::open(['method' => 'get' , 'url' => '/order_detail/'.$out_order_sale->ID]) }} --}}
                    <tr>
                        <td>เขต {{ Auth::user()->ID_area}}</td>
                        <td>{{$out_order_sale->Barcode}}</td>
                        <td>{{ $out_order_sale->StartDate }}</td>
                        <td>{{$out_order_sale->DeliverDate}}</td>
                        <td>{{$out_order_sale->customer}}</td>
                        <td>{{$out_order_sale->doctor}}</td>
                        <td>{{$out_order_sale->PatientName}}</td>
                        <td>
                            @if($out_order_sale->department == NULL)
                                รอ screen
                            @else
                                {{ $out_order_sale->department }}
                            @endif
                        </td>
                        <td>
                          <button  class="btn btn-success" style="padding:10px;" data-toggle="modal" data-target="#Modal{{ $out_order_sale->ID }}">
                              รายละเอียด
                          </button>
                        </td>
                    </tr>
                {{-- {{ Form::close() }} --}}
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade active" id="complete" role="tabpanel" aria-labelledby="home-tab">
              <table  id="example1" class="table table-striped table-bordered" width="100%">
                <thead>
                  <tr>
                      <th>เขต</th>
                      <th>บาร์โค้ด</th>
                      <th>วันที่สั่งผลิต</th>
                      <th>วันที่นัดจริง</th>
                      <th>คลินิก</th>
                      <th>ทันตแพทย์</th>
                      <th>คนไข้</th>
                      <th>สถานะงาน</th>
                      <th>รายละเอียด</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $count2 = 0; ?>
                  @foreach ($order_sale_complete as $out_order_sale_complete)
                     <tr>
                      <td>เขต {{ Auth::user()->ID_area}}</td>
                      <td>{{$out_order_sale_complete->Barcode}}</td>
                      <td>{{$out_order_sale_complete->StartDate }}</td>
                      <td>{{$out_order_sale_complete->DeliverDate}}</td>
                      <td>{{$out_order_sale_complete->customer}}</td>
                      <td>{{$out_order_sale_complete->doctor}}</td>
                      <td>{{$out_order_sale_complete->PatientName}}</td>
                      <td>
                          @if($out_order_sale_complete->department == NULL)
                              รอ screen
                          @else
                              {{$out_order_sale_complete->department }}
                          @endif
                      </td>
                      <td>
                        <button  class="btn btn-success" style="padding:10px;" data-toggle="modal" data-target="#Modal2{{ $out_order_sale_complete->ID }}">
                            รายละเอียด
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @foreach($order_sale as $out_order_sale)
        <div class="modal fade" id="Modal{{ $out_order_sale->ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog modal-lg" role="document" style="width:60%">
            <div class="modal-content">
              <div class="card">
                <div class="card-header header-sm">
                    <label>รายละเอียดรายการที่สั่งผลิต</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                  <div class="card">
                    <div class="accordion basic-accordion" role="tablist">
                      <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapseOne{{ $out_order_sale->ID }}" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>1.ข้อมูลทั่วไป Order
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne{{ $out_order_sale->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                          <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="Barcode">Barcode</label>
                                <div class="col-sm-4">
                                    {{ Form::text('Barcode',$out_order_sale->Barcode, ['class' => 'form-control','placeholder' => 'Barcode','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="RefBarcode">Barcode อ้างอิง</label>
                                <div class="col-sm-4">
                                    {{ Form::text('RefBarcode',$out_order_sale->RefBarcode, ['class' => 'form-control','placeholder' => 'RefBarcode','readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="StartDate">วันรับงาน</label>
                                <div class="col-sm-4">
                                    {{ Form::text('StartDate',$out_order_sale->StartDate, ['class' => 'form-control','placeholder' => 'วันรับงาน','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="type_doctor">วันส่งงาน</label>
                                <div class="col-sm-4">
                                    {{ Form::text('DeliverDate',$out_order_sale->DeliverDate, ['class' => 'form-control','placeholder' => 'วันส่งงาน','readonly']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="type_doctor">เวลาส่งงาน</label>
                                <div class="col-sm-4">
                                    {{ Form::text('ReceptionTime',$out_order_sale->ReceptionTime, ['class' => 'form-control','placeholder' => 'เวลารับงาน','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="DeliverType">ประเภท Order</label>
                                <div class="col-sm-4">
                                    {{ Form::text('DeliverType',$out_order_sale->DeliverType, ['class' => 'form-control','placeholder' => 'ประเภท Order','readonly']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="customer_type">ประเภทลูกค้า</label>
                                <div class="col-sm-4">
                                   {{ Form::text('customer_type',$out_order_sale->customer_type, ['class' => 'form-control','placeholder' => 'ประเภทลูกค้า','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="customer">ลูกค้า</label>
                                <div class="col-sm-4">
                                    {{ Form::text('customer',$out_order_sale->customer, ['class' => 'form-control','placeholder' => 'ลูกค้า','readonly']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="doctor">แพทย์</label>
                                <div class="col-sm-4">
                                   {{ Form::text('doctor',$out_order_sale->doctor, ['class' => 'form-control','placeholder' => 'แพทย์','readonly']) }}
                                </div>

                                {{-- <label class="col-form-label col-sm-2" for="factory">โรงงานผลิต</label>
                                <div class="col-sm-4">
                                    {{ Form::text('factory',$out_order_sale->factory, ['class' => 'form-control','placeholder' => 'โรงงานผลิต','readonly']) }}
                                </div> --}}

                                <label class="col-form-label col-sm-2" for="PatientName">Patient Name</label>
                                <div class="col-sm-4">
                                    {{ Form::text('PatientName',$out_order_sale->PatientName, ['class' => 'form-control','placeholder' => 'Patient Name','readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="PatientHN">Patient HN</label>
                                <div class="col-sm-4">
                                    {{ Form::text('PatientHN',$out_order_sale->PatientHN, ['class' => 'form-control','placeholder' => 'Patient HN','readonly']) }}
                                </div>

                                {{-- <label class="col-form-label col-sm-2" for="PatientHN">Patient HN</label>
                                <div class="col-sm-4">
                                    {{ Form::text('PatientHN',$out_order_sale->PatientHN, ['class' => 'form-control','placeholder' => 'Patient HN','readonly']) }}
                                </div> --}}

                                <label class="col-form-label col-sm-2" for="PatientAge">Patient Age</label>
                                <div class="col-sm-4">
                                    {{ Form::text('PatientAge',$out_order_sale->PatientAge, ['class' => 'form-control','placeholder' => 'Patient Age','readonly']) }}
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="type_doctor">Patient Sex</label>
                                <div class="col-sm-4">
                                    @if($out_order_sale->PatientSex == 1)
                                        {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                    @elseif($out_order_sale->PatientSex == 2)
                                        {{ Form::text('PatientSex','หญิง', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                    @elseif($out_order_sale->PatientSex == 3)
                                        {{ Form::text('PatientSex','ไม่ระบุเพศ', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                                      <label class="col-form-label col-sm-2" for="type_doctor">Patient Sex</label>
                                                      <div class="col-sm-4">
                                                          @if($out_order_sale->PatientSex == 1)
                                                              {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                          @else
                                                              {{ Form::text('PatientSex','หญิง', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                          @endif
                                                      </div>
                            </div> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                              {{-- <div class="card">
                                              <div class="accordion basic-accordion" role="tablist">
                                                  <div class="card">
                                                      <div class="card-header" role="tab" id="orderRequestTypeID2">
                                                          <h6 class="mb-0">
                                                              <a data-toggle="collapse" href="#collapseTwo{{ $out_order_sale->ID }}" aria-expanded="true" aria-controls="collapseTwo">
                                                                  <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>2.ข้อมลการสั่งงาน
                                                              </a>
                                                          </h6>
                                                      </div>
                                                      <div id="collapseTwo{{ $out_order_sale->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID2">
                                                          <div class="card-body">
                                                                  <div class="col-md-12">
                                                                          <div class="form-group row">
                                                                              <label class="col-form-label col-sm-1"></label>
                                                                              <div class="col-sm-12">
                                                                                      <table  class="table table-striped table-bordered">
                                                                                              <thead>
                                                                                                  <tr>
                                                                                                      <th>Tooth Number</th>
                                                                                                      <th>Type of Work</th>
                                                                                                      <th>Type of Product</th>
                                                                                                      <th>Type of Group</th>
                                                                                                  </tr>
                                                                                              </thead>
                                                                                              @foreach($teeth as $out_teeth)

                                                                                              <tbody>
                                                                                                  @if($out_teeth->OrderID == $out_order_sale->ID)
                                                                                                  <tr>
                                                                                                      <td>#{{ $out_teeth->TeethID }}</td>
                                                                                                      <td>{{ $out_teeth->NameWork }}</td>
                                                                                                      <td>{{ $out_teeth->NameProduct }}</td>
                                                                                                      <td>{{ $out_teeth->NameGroup }}</td>
                                                                                                  </tr>
                                                                                                  @endif
                                                                                              </tbody>

                                                                                              @endforeach
                                                                                          </table>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                              </div> --}}

                  <div class="card">
                    <div class="accordion basic-accordion" role="tablist">
                      <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID3">
                          <h6 class="mb-0">
                              <a data-toggle="collapse" href="#collapsethree{{ $out_order_sale->ID }}" aria-expanded="true" aria-controls="collapsethree">
                                  <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>2.รายการสิ่งที่ส่งมาด้วย
                              </a>
                          </h6>
                        </div>
                        <div id="collapsethree{{ $out_order_sale->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID3">
                          <div class="accordion basic-accordion" role="tablist" >
                            <div class="card">
                              <div class="card-body" >
                                <div class="card-body">
                                  <div class="col-md-12">
                                    <?php $count = 1; ?>
                                      @foreach($data_order_attachment as $out_order_attachment)
                                          @if($out_order_attachment->ScreenID == $out_order_sale->ID)
                                              <p>{{ $count++ }}. &nbsp; {{ $out_order_attachment->Name }}</p>
                                          @endif
                                      @endforeach

                                          @if($out_order_sale->comment != NULL)
                                              อื่นๆ : {{  $out_order_sale->comment }}
                                          @endif
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
            </div>
          </div>
        </div>
      @endforeach

      @foreach($order_sale_complete as $out_order_sale_complete)
        <div class="modal fade" id="Modal2{{ $out_order_sale_complete->ID }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
          <div class="modal-dialog modal-lg" role="document" style="width:60%">
            <div class="modal-content">
              <div class="card">
                <div class="card-header header-sm">
                    <label>รายละเอียดรายการที่สั่งผลิต</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                  <div class="card">
                    <div class="accordion basic-accordion" role="tablist">
                      <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse2{{ $out_order_sale_complete->ID }}" aria-expanded="true" aria-controls="collapse2">
                                    <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>1.ข้อมูลทั่วไป Order
                                </a>
                            </h6>
                        </div>
                        <div id="collapse2{{ $out_order_sale_complete->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                          <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="Barcode">Barcode</label>
                                <div class="col-sm-4">
                                    {{ Form::text('Barcode',$out_order_sale_complete->Barcode, ['class' => 'form-control','placeholder' => 'Barcode','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="RefBarcode">Barcode อ้างอิง</label>
                                <div class="col-sm-4">
                                    {{ Form::text('RefBarcode',$out_order_sale_complete->RefBarcode, ['class' => 'form-control','placeholder' => 'RefBarcode','readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="StartDate">วันรับงาน</label>
                                <div class="col-sm-4">
                                    {{ Form::text('StartDate',$out_order_sale_complete->StartDate, ['class' => 'form-control','placeholder' => 'วันรับงาน','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="type_doctor">วันส่งงาน</label>
                                <div class="col-sm-4">
                                    {{ Form::text('DeliverDate',$out_order_sale_complete->DeliverDate, ['class' => 'form-control','placeholder' => 'วันส่งงาน','readonly']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="type_doctor">เวลาส่งงาน</label>
                                <div class="col-sm-4">
                                    {{ Form::text('ReceptionTime',$out_order_sale_complete->ReceptionTime, ['class' => 'form-control','placeholder' => 'เวลารับงาน','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="DeliverType">ประเภท Order</label>
                                <div class="col-sm-4">
                                    {{ Form::text('DeliverType',$out_order_sale_complete->DeliverType, ['class' => 'form-control','placeholder' => 'ประเภท Order','readonly']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="customer_type">ประเภทลูกค้า</label>
                                <div class="col-sm-4">
                                   {{ Form::text('customer_type',$out_order_sale_complete->customer_type, ['class' => 'form-control','placeholder' => 'ประเภทลูกค้า','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="customer">ลูกค้า</label>
                                <div class="col-sm-4">
                                    {{ Form::text('customer',$out_order_sale_complete->customer, ['class' => 'form-control','placeholder' => 'ลูกค้า','readonly']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="doctor">แพทย์</label>
                                <div class="col-sm-4">
                                   {{ Form::text('doctor',$out_order_sale_complete->doctor, ['class' => 'form-control','placeholder' => 'แพทย์','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="PatientName">Patient Name</label>
                                <div class="col-sm-4">
                                    {{ Form::text('PatientName',$out_order_sale_complete->PatientName, ['class' => 'form-control','placeholder' => 'Patient Name','readonly']) }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="PatientHN">Patient HN</label>
                                <div class="col-sm-4">
                                    {{ Form::text('PatientHN',$out_order_sale_complete->PatientHN, ['class' => 'form-control','placeholder' => 'Patient HN','readonly']) }}
                                </div>

                                <label class="col-form-label col-sm-2" for="PatientAge">Patient Age</label>
                                <div class="col-sm-4">
                                    {{ Form::text('PatientAge',$out_order_sale_complete->PatientAge, ['class' => 'form-control','placeholder' => 'Patient Age','readonly']) }}
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-sm-2" for="type_doctor">Patient Sex</label>
                                <div class="col-sm-4">
                                    @if($out_order_sale_complete->PatientSex == 1)
                                        {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                    @elseif($out_order_sale_complete->PatientSex == 2)
                                        {{ Form::text('PatientSex','หญิง', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                    @elseif($out_order_sale_complete->PatientSex == 3)
                                        {{ Form::text('PatientSex','ไม่ระบุเพศ', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                    @endif
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="accordion basic-accordion" role="tablist">
                      <div class="card">
                        <div class="card-header" role="tab" id="orderRequestTypeID3">
                          <h6 class="mb-0">
                              <a data-toggle="collapse" href="#collapsethree{{ $out_order_sale_complete->ID }}" aria-expanded="true" aria-controls="collapsethree">
                                  <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>2.รายการสิ่งที่ส่งมาด้วย
                              </a>
                          </h6>
                        </div>
                        <div id="collapsethree{{ $out_order_sale_complete->ID }}" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID3">
                          <div class="accordion basic-accordion" role="tablist" >
                            <div class="card">
                              <div class="card-body" >
                                <div class="card-body">
                                  <div class="col-md-12">
                                    <?php $count = 1; ?>
                                      @foreach($data_order_attachment as $out_order_attachment)
                                          @if($out_order_attachment->ScreenID == $out_order_sale_complete->ID)
                                              <p>{{ $count++ }}. &nbsp; {{ $out_order_attachment->Name }}</p>
                                          @endif
                                      @endforeach

                                        @if($out_order_sale->comment != NULL)
                                              อื่นๆ : {{  $out_order_sale->comment }}
                                          @endif
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
            </div>
          </div>
        </div>
      @endforeach


          <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
               <div class="modal-body pt-0">
                <div class="card-body p-0">
                  <div class="mt-5">
                    <div class="vertical-timeline">
                      <div class="timeline-wrapper timeline-wrapper-warning">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title font-weight-bold">Create Order</h6>
                          </div>
                          <div class="timeline-body">
                            <p>By Sale A</p>
                            <p><span class="ml-auto">19/10/2018 (10:30)</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title font-weight-bold">Screen Update</h6>
                          </div>
                          <div class="timeline-body">
                            <p>By Screen A</p>
                            <p><span class="ml-auto">19/10/2018 (11:30)</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="timeline-wrapper timeline-wrapper-success">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title font-weight-bold">ปูน</h6>
                          </div>
                          <div class="timeline-body">
                            <div class="timeline-body">
                              <p>By ปูน A</p>
                              <p><span class="ml-auto">19/10/2018 (12:30)</span></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title font-weight-bold">Wax</h6>
                          </div>
                          <div class="timeline-body">
                            <p>By ปูน A</p>
                            <p><span class="ml-auto">19/10/2018 (13:30)</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="timeline-wrapper timeline-wrapper-primary">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title font-weight-bold">QC</h6>
                          </div>
                          <div class="timeline-body">
                            <p>By QC A</p>
                            <p><span class="ml-auto">19/10/2018 (14:30)</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title font-weight-bold">Packing</h6>
                          </div>
                          <div class="timeline-body">
                            <p>By Packing A</p>
                            <p><span class="ml-auto">19/10/2018 (15:30)</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="timeline-wrapper timeline-wrapper-success">
                        <div class="timeline-badge"></div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h6 class="timeline-title font-weight-bold">Delivery</h6>
                          </div>
                          <div class="timeline-body">
                            <p>By Delivery A</p>
                            <p><span class="ml-auto">19/10/2018 (16:30)</span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>     <!--end data table-->
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')

{{-- <script>
$(document).ready(function() {
	// DataTable initialisation
	$('#example').DataTable(
		{
			"paging": false,
			"autoWidth": true,
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols = api.columns().nodes().length;
				var j = 3;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal);
					j++;
				}
			}
		}
	);
});
</script> --}}

<script>
        $(document).ready(function() {
            $('#example0').DataTable({"scrollX": true});
            // $('div.dataTables_filter input').focus()
        } );
        $(document).ready(function() {
            $('#example1').DataTable({"scrollX": true});
        } );
    </script>

@stop
