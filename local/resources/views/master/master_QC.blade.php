@extends('layouts.template') 
@section('stylesheet')

<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css"
/> 
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
                            <h4>Master QC CheckList</h4>
                        </div>
                    </div>
                    <br> 
                    {{ Form::open(['method' => 'get' , 'url' => 'master_QC/search']) }}
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label class="col-form-label" for="Barcode"><p class="card-description" style="font-size:18px;">เลือกเพื่อค้นหา</p></label>
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select class="form-control form-control-lm" id="Product" name="Product">
                                            <option disabled selected hidden>Product</option>
                                            @foreach ($Product as $out_Product)
                                                <option value="{{$out_Product->ID}}">{{$out_Product->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control form-control-lm" id="Department" name="Department">
                                            <option disabled selected hidden>Department</option>
                                            @foreach ($Department as $out_Department)
                                                <option value="{{$out_Department->ID}}">{{$out_Department->Name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button class="btn btn-outline-success">ยืนยัน</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}

                    {{-- <ul class="nav nav-tabs tab-basic" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#whoweare" role="tab" aria-controls="whoweare" aria-selected="true">
                                <h6>รอบรรจุ</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ourgoal" role="tab" aria-controls="ourgoal" aria-selected="false">
                                <h6>บรรจุเสร็จ</h6>
                            </a>
                        </li>
                    </ul> --}}
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="whoweare" role="tabpanel" aria-labelledby="home-tab">
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>Product</th>
                                        <th>แผนก</th>
                                        <th>QC Checklist</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @if($QC_Checklist != null) 
                                        @foreach ($QC_Checklist as $out_QC_Checklist)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $out_QC_Checklist->product }}</td>
                                                <td>{{ $out_QC_Checklist->department }}</td>
                                                <td>{{ $out_QC_Checklist->ccp }}</td>
                                                <td>
                                                    <button class="btn btn-warning mr-2" style="padding:10px;" data-toggle="modal" data-target="#Modal{{$out_QC_Checklist->ID}}">
                                                        แก้ไขข้อมูล
                                                    </button>
                                                    <a href="{{ url('/master_QC/Delete/'.$out_QC_Checklist->ID) }}">
                                                        <button class="btn btn-danger mr-2" style="padding:10px;">ลบ</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($QC_Checklist != null) 
                        @foreach ($QC_Checklist as $out_QC_Checklist)
                            {{ Form::open(['method' => 'get' , 'url' => 'master_QC/Edit/'.$out_QC_Checklist->ID]) }}
                                <div class="modal fade" id="Modal{{$out_QC_Checklist->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                                    <div class="modal-dialog modal-lg" role="document" style="width:60%">
                                        <div class="modal-content">
                                            <div class="card">
                                                <div class="card-header header-sm">
                                                    <label>แก้ไข Qc Checklist</label>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="ProductEdit">Product</label>
                                                        <select class="form-control form-control-lm" id="ProductEdit" name="ProductEdit">
                                                            <option selected hidden value="{{$out_QC_Checklist->product_ID}}">{{$out_QC_Checklist->product}}</option>
                                                            @foreach ($Product as $out_Product)
                                                                <option value="{{$out_Product->ID}}">{{$out_Product->Name}}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input type="text" class="form-control" id="ProductEdit" name="ProductEdit" value="{{$out_QC_Checklist->product}}" placeholder="Product"> --}}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="DepartmentEdit">แผนก</label>
                                                        <select class="form-control form-control-lm" id="DepartmentEdit" name="DepartmentEdit">
                                                            <option selected hidden value="{{$out_QC_Checklist->department_ID}}">{{$out_QC_Checklist->department}}</option>
                                                            @foreach ($Department as $out_Department)
                                                                <option value="{{$out_Department->ID}}">{{$out_Department->Name}}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input type="text" class="form-control" id="DepartmentEdit" name="DepartmentEdit" value="{{$out_QC_Checklist->department}}" placeholder="แผนก"> --}}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="QCEdit">QC Checklist</label>
                                                        <input type="text" class="form-control" id="QCEdit" name="QCEdit" value="{{$out_QC_Checklist->ccp}}" placeholder="QC Checklist">
                                                    </div>

                                                    <button type="submit" class="btn btn-success" style="float:right;">ยืนยัน</button>
                                                </div>                         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@stop 
@section('scripts')
<script>
    $(document).ready(function() {
      @if(\Session::has('massage'))
        alert('{{ \Session::get('massage') }}');
      @endif
      $('#example').DataTable();
      $('#example2').DataTable();
    } );
</script>
<script src="./js/shared/alerts.js"></script>
<script src="./js/shared/avgrund.js"></script>

@stop