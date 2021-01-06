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
    /* Radio */
    .radio-toolbar {
        margin: 10px;
    }
    .radio-toolbar input[type=radio] {
        display:none;
    }
    input[type=radio]:checked + label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }
    .radio-toolbar label {
        display:inline-block;
        background-color:#ddd;
        width: 100%;
        height: auto;
        padding: 8%;
        font-size:14px;
        border-radius: 4px;
    }
    .radio-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }
    .radio-toolbar input[type="radio"]:checked + label {
        background-color: #19d895;
        border-color: #19d895;
    }
    /* End Radio */

    /* Check Box */
    .checkbox-toolbar {
        margin: 10px;
    }
    .checkbox-toolbar input[type="checkbox"] {
        display:none;
    }
    input[type="checkbox"]:checked + label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }
    .checkbox-toolbar label {
        display:inline-block;
        background-color:#ddd;
        width: 100%;
        height: auto;
        padding: 8%;
        font-size:14px;
        border-radius: 4px;
    }
    .checkbox-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar input[type="checkbox"]:checked + label {
        background-color: #19d895;
        border-color: #19d895;
    }
    .hidden{
    display: none;
    }
    img.center {
    display: block;
    margin: 0 auto;
    }
    /* End Check Box */
</style>
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        {{ Form::open(['method' => 'get' , 'url' => '/production/scan_profile']) }}
                                        <div class="card-header header-sm">
                                                <div class="input-group row">
                                                    <div class="col-5">
                                                        <label style="font-size: 14px;">Scan Barcode ตัวเอง </label>
                                                    </div>
                                                    <div class="col-7 text-right">
                                                        <input type="text" id="scanbarcode_pf" name="scanbarcode_pf" style="width:75%;" onkeyup="change1()">
                                                        @if($profile != null)
                                                            @foreach($data_employee as $out_data_employee)
                                                                <input type="hidden" id="scanbarcode2" name="scanbarcode2" style="width:75%;" value="{{$out_data_employee->ID_user}}" placeholder="pf1">
                                                            @endforeach
                                                        @else
                                                            <input type="hidden" id="scanbarcode2" name="scanbarcode2" style="width:75%;" placeholder="pf2">
                                                        @endif
                                                        @if($product != null)
                                                            @foreach($data_product as $out_data_product)
                                                                <input type="hidden" id="scanbarcode1" name="scanbarcode1" style="width:75%;" value="{{$out_data_product->ID_order_screen}}" placeholder="pd">
                                                            @endforeach
                                                        @else
                                                            <input type="hidden" id="scanbarcode1" name="scanbarcode1" style="width:75%;" placeholder="pd">
                                                        @endif
                                                        <button class="btn btn-icons btn-rounded btn-primary" type="submit"><i class="mdi mdi-crop-free"></i></button>
                                                    </div>
                                                </div>
                                        </div>
                                        {{ Form::close() }}
                                        <div class="card-body">
                                            @foreach($data_employee as $out_data_employee)
                                            <div class="row">
                                                <div class="col-md-3  step-content">
                                                    <div class="row d-flex align-items-center justify-content-center">
                                                        <div class="col-md-12 d-flex align-items-center justify-content-center">
                                                            @if($out_data_employee->picture_user != null)
                                                                <img class="img rounded mx-auto d-block" src="{{ url('/local/public/file/').'/'.$out_data_employee->picture_user }}" class="img-responsive" style="width:100%;height:100%;">
                                                            @endif
                                            
                                                            @if($out_data_employee->picture_user == null)
                                                                <img class="img" align="center" src="{{ url('/local/public/file/user1__2018-12-09_KsURh8W2.png') }}" class="img-responsive" style="width:100%;height:100%;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="accordion basic-accordion" role="tablist">
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                <h6 class="mb-0">
                                                                    <a data-toggle="collapse" href="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                        <label style="font-size: 14px;">รายละเอียดพนักงาน</label>
                                                                    </a>
                                                                </h6>
                                                            </div>
                                                            <div id="collapseZero" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                <div class="card-body text-left">
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-4" for="Name" style="font-size: 14px;">ID</label>
                                                                        <div class="col-sm-8">
                                                                        {{ Form::text('id_user',$out_data_employee->ID_user, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-4" for="Name" style="font-size: 14px;">ชื่อ-สกุล</label>
                                                                        <div class="col-sm-8">
                                                                        {{ Form::text('Name',$out_data_employee->Name, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-4" for="Nick_name" style="font-size: 14px;">ชื่อเล่น</label>
                                                                        <div class="col-sm-8">
                                                                        {{ Form::text('Nick_name',$out_data_employee->Nick_name, ['class' => 'form-control','placeholder' => 'ชื่อเล่น','readonly']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-4" for="company" style="font-size: 14px;">บริษัท</label>
                                                                        <div class="col-sm-8">
                                                                        {{ Form::text('company',$out_data_employee->fullname, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-4" for="sub-department" style="font-size: 14px;">แผนกย่อย</label>
                                                                        <div class="col-sm-8">
                                                                        {{ Form::text('sub-department',$out_data_employee->cotton, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                        </div>
                                                                    </div>
                                        
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

                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header header-sm">
                                            {{ Form::open(['method' => 'get' , 'url' => '/production/scan_profile']) }}
                                            <div class="input-group row">
                                                <div class="col-5">
                                                    <label style="font-size: 14px;">Scan Barcode งาน </label>
                                                </div>
                                                <div class="col-7 text-right">
                                                    <input type="text" id="scanbarcode_pd" name="scanbarcode_pd" style="width:75%;" onkeyup="change2()">
                                                    @if($product != null)
                                                        @foreach($data_product as $out_data_product)
                                                            <input type="hidden" id="scanbarcode4" name="scanbarcode4" style="width:75%;" value="{{$out_data_product->ID_order_screen}}" placeholder="pd">
                                                        @endforeach
                                                    @else
                                                        <input type="hidden" id="scanbarcode4" name="scanbarcode4" style="width:75%;" placeholder="pd">
                                                    @endif
                                                    @if($profile != null)
                                                        @foreach($data_employee as $out_data_employee)
                                                            <input type="hidden" id="scanbarcode3" name="scanbarcode3" style="width:75%;" value="{{$out_data_employee->ID_user}}" placeholder="pf">
                                                        @endforeach
                                                    @else
                                                        <input type="hidden" id="scanbarcode3" name="scanbarcode3" style="width:75%;" placeholder="pf">
                                                    @endif
                                                    <button class="btn btn-icons btn-rounded btn-primary" type="submit"><i class="mdi mdi-crop-free"></i></button>
                                                </div>

                                            </div>
                                            {{ Form::close()}}
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                @foreach($data_product as $out_data_product)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="accordion basic-accordion" role="tablist">
                                                            <div class="card">
                                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                                    <h6 class="mb-0">
                                                                        <a data-toggle="collapse" href="#job" aria-expanded="true" aria-controls="collapseZero">
                                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                                            <label style="font-size: 14px;">รายละเอียดงาน</label>
                                                                        </a>
                                                                    </h6>
                                                                </div>
                                                                <div id="job" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                                    <div class="card-body text-left">
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="Name" style="font-size: 14px;">OrderID</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('id_user',$out_data_product->ID_order_screen, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="Name" style="font-size: 14px;">Teeth ID</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('Name',$out_data_product->TeethID, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="Nick_name" style="font-size: 14px;">Metal type</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('Nick_name',$out_data_product->Metal_type, ['class' => 'form-control','placeholder' => 'ชื่อเล่น','readonly']) }}
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="company" style="font-size: 14px;">Hook</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('company',$out_data_product->Hook, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="sub-department" style="font-size: 14px;">MESIAL REST</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('sub-department',$out_data_product->MESIAL_REST, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="sub-department" style="font-size: 14px;">DISTAL REST</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('sub-department',$out_data_product->DISTAL_REST, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="sub-department" style="font-size: 14px;">CINGULUM REST</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('sub-department',$out_data_product->CINGULUM_REST, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-sm-4" for="sub-department" style="font-size: 14px;">EMBRESSURE REST</label>
                                                                            <div class="col-sm-8">
                                                                            {{ Form::text('sub-department',$out_data_product->EMBRESSURE_REST, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                                            </div>
                                                                        </div>
                                            
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
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12 text-right">
                                    <a href="{{ url('/production_product') }}">
                                        <button type="submit" class="btn btn-lg btn-success">
                                            ต่อไป<i class="mdi mdi-arrow-right-bold"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="EDIT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
    <div class="modal-dialog modal-lg" role="document" style="width:500px">
        <div class="modal-content">
            <div class="card">
                <div class="card-header header-sm">
                    <label class="font-weight-bold">
                        Scan Barcode ตัวเอง 
                    </label> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="mdi mdi-crop-free"></i></span>
                        </div>
                        <input type="text" class="" id="scanbarcode">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@stop

@section('scripts')
<script>
    function change1(){
        $('#scanbarcode2').val($('#scanbarcode_pf').val());
        $('#scanbarcode3').val($('#scanbarcode_pf').val());
    }
    function change2(){
        $('#scanbarcode1').val($('#scanbarcode_pd').val());
        $('#scanbarcode4').val($('#scanbarcode_pd').val());
    }
</script>
@stop
