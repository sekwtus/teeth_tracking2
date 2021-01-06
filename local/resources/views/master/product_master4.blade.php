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
        padding: 2%;
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
    /* End Check Box */
</style>
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
                            <h4>Department</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 m-0 step-timeline">
                            <ul class="m-0 step-list">
                                <li>Product Type</li>
                                <li>Department</li>
                                <li>Sub-Department</li>
                                <li class="yellow">QC</li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                        <li class="breadcrumb-item"><a href="#">Product Type</a></li>
                                        <li class="breadcrumb-item"><a href="#">Department</a></li>
                                        <li class="breadcrumb-item active"><a href="#">Sub-Department</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">QC</li>
                                </ol>
                            </nav>
                            <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="orderRequestTypeID">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#MetalType" aria-expanded="true" aria-controls="MetalType">
                                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>QC
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="MetalType" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                        <div class="card-body text-center">
                                            <div class="radio-toolbar text-center justify-content-center" style="max-height: 400px;overflow-x:hidden;overflow-y: scroll;">
                                                @php
                                                    $count = 1;
                                                @endphp
                                                @foreach($data_qcchecklist as $out_data_qcchecklist)
                                                <div class="{{$count}}">
                                                    <div class="row Department_{{$out_data_qcchecklist->ccp}}  P{{$count}}" id="P{{$count}}" onclick="test('P{{$count}}')">
                                                        <input type="radio" id="{{$out_data_qcchecklist->ccp}}" name="type_department" value="{{$out_data_qcchecklist->ID}}" >
                                                        <label for="{{$out_data_qcchecklist->ccp}}" style="cursor:pointer;">{{$out_data_qcchecklist->ccp}}</label>
                                                    </div>
                                                </div>
                                                @php
                                                    $count++;
                                                @endphp
                                                @endforeach
                                            </div>
                                            <input type="hidden" id="f" class="pp" value="df">
                                            <footer>
                                                <div class="row">
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-3">
                                                        <button class="btn btn-block btn-success" data-toggle="modal" data-target="#EDIT">
                                                            + เพิ่ม Product
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-block btn-danger">
                                                            - ลบ Product
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn social-btn btn-facebook btn-rounded" onclick="up()">
                                                            <i class="mdi mdi-arrow-up-bold"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button type="button" class="btn social-btn btn-facebook btn-rounded" onclick="down()">
                                                            <i class="mdi mdi-arrow-down-bold"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                </div>                       
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-12 text-right">
                            <a href="{{url('product_master2')}}">
                                <button type="button" class="btn btn-lg btn-success">
                                    ต่อไป
                                    <i class="mdi mdi-arrow-right-bold"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EDIT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
        <div class="modal-dialog modal-lg" role="document" style="width:500px">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header header-sm">
                        <label class="font-weight-bold">
                                Production Detail
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                    <div class="content-center">                                    
                    </div>
                    <div class="form-sample" >
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="col-form-label font-weight-bold">Order Number:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <label class="col-form-label ">OR001</label>
                                    </div>
                                </div>
                            </div>
                        </div>
      
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label class="col-form-label font-weight-bold">Customer:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <label class="col-form-label">Alphabet puzzle</label>
                                    </div>
                               </div>
                            </div>
                        </div>
      
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#defaultModal">
                            Process Logs
                            <i class="mdi mdi-play-circle ml-1"></i>
                            </button>
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
    function up(){
        var a = $('#f').val();
        var n = parseInt(a);
        var x = n-1;
        var element1 = document.getElementsByClassName('.P'+n);
        var element2 = document.getElementsByClassName('.P'+x);          
            $('.P'+x).appendTo("."+n);
            $('.P'+n).appendTo("."+x);
            $('.P'+x).toggleClass('P'+x+' A');
            $('.P'+n).toggleClass('P'+n+' P'+x);
            $('.A').toggleClass('P'+n+' A')
            $('.P'+n).focus();
            $('#f').val(n-1);
    }
    function down(){
        var a = $('#f').val();
        var n = parseInt(a);
        var x = n+1;
            $('.P'+x).appendTo("."+n);
            $('.P'+n).appendTo("."+x);
            $('.P'+x).toggleClass('P'+x+' A');
            $('.P'+n).toggleClass('P'+n+' P'+x);
            $('.A').toggleClass('P'+n+' A')
            $('#f').val(n+1);
        }
    function test(n){  
        var x = document.getElementById(n).parentElement.className;
        $('#f').val(x);
    }

</script>
@stop