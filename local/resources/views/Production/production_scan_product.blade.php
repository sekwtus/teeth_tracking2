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
                        {{ Form::open(['method' => 'get' , 'url' => '/production/scan']) }}
                        <div class="card-header header-sm">
                            <div class="input-group row">
                                <div class="col-4">
                                    <label class="font-weight-bold">Scan Barcode งาน </label>
                                </div>
                                
                                <div class="col-8 text-right">
                                    <label>Scan Barcode : </label>
                                    <input type="text" id="scanbarcode" name="scanbarcode">
                                    <button type="submit">ค้นหา</button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close()}}
                        <div class="card">
                            @foreach($data_employee as $out_data_employee)
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 step-timeline">
                                        <div class="row d-flex align-items-center justify-content-center">
                                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                                @if($out_data_employee->picture_user != null)
                                                    <img class="img rounded mx-auto d-block" src="{{ url('/local/public/file/').'/'.$out_data_employee->picture_user }}" class="img-responsive" style="width:200px;height:80;">
                                                @endif
                                
                                                @if($out_data_employee->picture_user == null)
                                                    <img class="img" align="center" src="{{ url('/local/public/file/user1__2018-12-09_KsURh8W2.png') }}" class="img-responsive" style="width:200px;height:80;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9 step-content">
                                        <div class="accordion basic-accordion" role="tablist">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                                    <h6 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
                                                            <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                            PC Dental Lab
                                                        </a>
                                                    </h6>
                                                </div>
                                                <div id="collapseZero" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                    <div class="card-body text-left">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3" for="Name">ID</label>
                                                            <div class="col-sm-9">
                                                            {{ Form::text('id_user',$out_data_employee->ID_user, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3" for="Name">ชื่อบริษัท</label>
                                                            <div class="col-sm-9">
                                                            {{ Form::text('Name','บริษัท พี ซี เด็นตัล แลป จำกัด', ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                            </div>
                                                        </div>
                            
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3" for="Name">ชื่อ - นามสกุล</label>
                                                            <div class="col-sm-5">
                                                            {{ Form::text('Name',$out_data_employee->Name, ['class' => 'form-control','placeholder' => 'ชื่อพนักงาน','readonly']) }}
                                                            </div>
                            
                                                            <label class="col-form-label col-sm-2" for="Nick_name">ชื่อเล่น</label>
                                                            <div class="col-sm-2">
                                                            {{ Form::text('Nick_name',$out_data_employee->Nick_name, ['class' => 'form-control','placeholder' => 'ชื่อเล่น','readonly']) }}
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
                                        <a href="{{ url('') }}">
                                            <button type="submit" class="btn btn-lg btn-success">
                                                ต่อไป<i class="mdi mdi-arrow-right-bold"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    function setFocusToTextBox(){
        document.getElementById("mytext").focus();
    }
</script>
@stop
