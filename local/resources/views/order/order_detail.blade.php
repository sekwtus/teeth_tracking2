@extends('layouts.template')

@section('stylesheet')

@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
               <div role="tab" id="orderRequestTypeID">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page"><h4> 1.ข้อมูลทั่วไป Order</h4></li>
                        </ol>
                     </nav>
                 </div>
                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="accordion basic-accordion" role="tablist" >
                                <div class="card">
                                        @foreach($data_all as $out_data_all)
                                            <div class="card-body">
                                                <div class="col-md-15">

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="barcode">Barcode*</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                {{ Form::text('Barcode',$out_data_all->Barcode, ['class' => 'form-control','placeholder' => 'Barcode','readonly']) }}
                                                            </div>
                                                        </div>
                                                        <label class="col-form-label col-sm-2" for="barcode">Barcode อ้างอิง</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                {{ Form::text('RefBarcode',$out_data_all->RefBarcode, ['class' => 'form-control','placeholder' => 'Barcode อ้างอิง','readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="pickup">วันรับงาน*</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                        {{ Form::date('StartDate',$out_data_all->StartDate, ['class' => 'form-control','placeholder' => 'วันรับงาน','readonly']) }}
                                                                </div>
                                                            </div>
                                                            <label class="col-form-label col-sm-2" for="pickup">วันส่งงาน*</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                        {{ Form::date('DeliverDate',$out_data_all->DeliverDate, ['class' => 'form-control','placeholder' => 'วันส่งงาน','readonly']) }}
                                                                </div>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="pickup">Order Type</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                        {{ Form::text('DeliverType',$out_data_all->DeliverType, ['class' => 'form-control','placeholder' => 'ประเภทของงาน','readonly']) }}
                                                                </div>
                                                            </div>
                                                            <label class="col-form-label col-sm-2" for="pickup">Customer Type</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                        {{ Form::text('DeliverType',$out_data_all->customer_type, ['class' => 'form-control','placeholder' => 'ประเภทของงาน','readonly']) }}
                                                                </div>
                                                            </div>
                                                    </div>


                                                    <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="pickup">Customers</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                        {{ Form::text('CustomerID',$out_data_all->customer, ['class' => 'form-control','placeholder' => 'Customers','readonly']) }}
                                                              </div>
                                                            </div>
                                                            <label class="col-form-label col-sm-2" for="pickup">Doctor</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                   {{ Form::text('CustomerID',$out_data_all->doctor, ['class' => 'form-control','placeholder' => 'Customers','readonly']) }}
                                                                </div>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="pickup">Factory</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                     {{ Form::text('FactoryID',$out_data_all->factory, ['class' => 'form-control','placeholder' => 'Factory','readonly']) }}
                                                                </div>
                                                            </div>
                                                            <label class="col-form-label col-sm-2" for="pickup">Patient Name</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    {{ Form::text('PatientName',$out_data_all->PatientName, ['class' => 'form-control','placeholder' => 'PatientName','readonly']) }}
                                                                </div>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row">
                                                            <label class="col-form-label col-sm-2" for="pickup">Patient HN</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    {{ Form::text('PatientHN',$out_data_all->PatientHN, ['class' => 'form-control','placeholder' => 'Patient HN','readonly']) }}
                                                                </div>
                                                            </div>
                                                            <label class="col-form-label col-sm-2" for="pickup">Patient Age</label>
                                                            <div class="col-sm-4">
                                                                <div class="input-group">
                                                                    {{ Form::text('PatientAge',$out_data_all->PatientAge, ['class' => 'form-control','placeholder' => 'Patient Age','readonly']) }}
                                                                </div>
                                                            </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label col-sm-2" for="pickup">Patient Sex</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group">
                                                                @if ($out_data_all->PatientSex == '1')
                                                                    {{ Form::text('PatientSex','ชาย', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                @endif
                                                                @if ($out_data_all->PatientSex == '2')
                                                                    {{ Form::text('PatientSex','หญิง', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                @endif
                                                                @if ($out_data_all->PatientSex == '3')
                                                                    {{ Form::text('PatientSex','ไม่ระบุเพศ', ['class' => 'form-control','placeholder' => 'Patient Sex','readonly']) }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                    </div>
                                    @endforeach
                                    </div>

                        </div>
                        </div>
                        {{-- 1 --}}
                        {{-- 2 --}}
                        <div role="tab" id="orderRequestTypeID">
                            <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-inverse-primary">
                                        <li class="breadcrumb-item active" aria-current="page"><h4> 2. ข้อมูลการสั่งงาน</h4></li>
                                    </ol>
                            </nav>
                            </div>
                            <div id="collapseOne2" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    <div class="card-body" >
                                         <div class="col-sm-12">
                                             <table  class="table table-striped table-bordered">
                                                 <thead>
                                                     <tr>
                                                         <th>No.</th>
                                                         <th>Tooth Number</th>
                                                         <th>Type of Work</th>
                                                         <th>Type of Product</th>
                                                         <th>Type of Group</th>
                                                     </tr>
                                                 </thead><?php $counts = 1; ?>
                                                 @foreach($teeth as $out_teeth)
                                                 <tbody>
                                                     <tr>
                                                         <td>{{  $counts++ }}</td>
                                                         <td>{{ $out_teeth->TeethID }}</td>
                                                         <td>{{ $out_teeth->NameWork }}</td>
                                                         <td>{{ $out_teeth->NameProduct }}</td>
                                                         <td>{{ $out_teeth->NameGroup }}</td>
                                                     </tr>
                                                 </tbody>
                                                 @endforeach
                                             </table>
                                         </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- 2 --}}

                        {{-- 3 --}}
                        <div role="tab" id="orderRequestTypeID">
                                <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb bg-inverse-primary">
                                            <li class="breadcrumb-item active" aria-current="page"><h4>  3. รายการสิ่งที่ส่งมาด้วย</h4></li>
                                        </ol>
                                </nav>
                            </div>
                            <div id="collapseOne3" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="accordion basic-accordion" role="tablist" >
                                <div class="card">
                                    <div class="card-body" >
                                        <div class="card-body">
                                            <div class="col-md-12">

                                                    <?php $count = 1; ?>
                                                    @foreach($data_order_attachment as $out_order_attachment)
                                                    <p>{{ $count++ }}. &nbsp; {{ $out_order_attachment->Name }}</p>
                                                    @endforeach


                                            </div>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- 3 --}}





                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@stop
