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
    /* End Check Box */
</style>
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

@section('content')
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-lg-6">
                    <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#MetalType" aria-expanded="true" aria-controls="MetalType">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Product Type
                                    </a>
                                </h6>
                            </div>
                            <div id="MetalType" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-center">
                                    <div class="radio-toolbar text-center justify-content-center row" style="max-height: 400px;overflow-x:hidden;overflow-y: scroll;">
                                        @foreach($data_product as $out_data_product)
                                            <div class="col-lg-6 Product_{{$out_data_product->Name}}"> 
                                                <input type="radio" id="{{$out_data_product->Name}}" name="type_product" value="{{$out_data_product->ID}}" onclick="Show_department({{$out_data_product->Name}})">
                                                <label for="{{$out_data_product->Name}}" style="cursor:pointer;" >{{$out_data_product->Name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <footer>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-success">
                                                    บันทึก
                                                </button>
                                            </div>
            
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-success">
                                                    บันทึก
                                                </button>
                                            </div>

                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-success">
                                                    บันทึก
                                                </button>
                                            </div>
                                        </div>                        
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#Metal" aria-expanded="true" aria-controls="MetalType">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Department
                                    </a>
                                </h6>
                            </div>
                            <div id="Metal" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-center">
                                    <div class="radio-toolbar text-center justify-content-center" style="max-height: 400px;overflow-x:hidden;overflow-y: scroll;">
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach($data_department as $out_data_department)
                                        <div class="{{$count}}">
                                            <div class="row Department_{{$out_data_department->Name}} hidden P{{$count}}" id="P{{$count}}" onclick="test('P{{$count}}')">
                                                <input type="radio" id="{{$out_data_department->Name}}" name="type_department" value="{{$out_data_department->ID}}" >
                                                <label for="{{$out_data_department->Name}}" style="cursor:pointer;">{{$out_data_department->Name}}</label>
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
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-success">
                                                    เพิ่ม
                                                </button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-danger">
                                                    ลบ
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn social-btn btn-social-outline-facebook" onclick="up()">
                                                    <i class="mdi mdi-arrow-up-bold"></i>
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn social-btn btn-social-outline-facebook" onclick="down()">
                                                    <i class="mdi mdi-arrow-down-bold"></i>
                                                </button>
                                            </div>
                                        </div>                        
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#Metal" aria-expanded="true" aria-controls="MetalType">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Metal Type
                                    </a>
                                </h6>
                            </div>
                            <div id="Metal" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-center">
                                    
                                    <footer>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-success">
                                                    เพิ่ม
                                                </button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-danger">
                                                    ลบ
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn social-btn btn-social-outline-facebook">
                                                    <i class="mdi mdi-arrow-up-bold"></i>
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn social-btn btn-social-outline-facebook">
                                                    <i class="mdi mdi-arrow-down-bold"></i>
                                                </button>
                                            </div>
                                        </div>                        
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion basic-accordion" role="tablist">
                        <div class="card">
                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                <h6 class="mb-0">
                                    <a data-toggle="collapse" href="#Metal" aria-expanded="true" aria-controls="MetalType">
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>Metal Type
                                    </a>
                                </h6>
                            </div>
                            <div id="Metal" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-center">
                                    
                                    <footer>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-success">
                                                    เพิ่ม
                                                </button>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-lg btn-danger">
                                                    ลบ
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn social-btn btn-social-outline-facebook">
                                                    <i class="mdi mdi-arrow-up-bold"></i>
                                                </button>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn social-btn btn-social-outline-facebook">
                                                    <i class="mdi mdi-arrow-down-bold"></i>
                                                </button>
                                            </div>
                                        </div>                        
                                    </footer>
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

@section('scripts')
<script>
    function Show_department(product){
        if(product.id == 'PFM'){            
           $('.Department_ปูน').removeClass('hidden');
           $('.Department_WAX').removeClass('hidden');
           $('.Department_แต่งลง').removeClass('hidden');
           $('.Department_โอเปค').removeClass('hidden');
           $('.Department_พอสเลน').removeClass('hidden');
           $('.Department_ขัด').removeClass('hidden');
           $('.Department_ขาย').addClass('hidden');
           $('.Department_ทัวร์').addClass('hidden');
           $('.Department_EMS').addClass('hidden');
           $('.Department_บริการลูกค้า').addClass('hidden');
           $('.Department_แพ๊ค').addClass('hidden');
           $('.Department_โอแปค').addClass('hidden');
           $('.Department_เตรียมงาน').addClass('hidden');
           $('.Department_SCAN').addClass('hidden');
           $('.Department_PREP').addClass('hidden');
           $('.Department_CAM').addClass('hidden');
           $('.Department_CAD').addClass('hidden');
           $('.Department_TEMP').addClass('hidden');
        }
        else if(product.id == 'FMC'){   
           $('.Department_ปูน').removeClass('hidden');
           $('.Department_WAX').removeClass('hidden');
           $('.Department_แต่งลง').removeClass('hidden');
           $('.Department_โอเปค').addClass('hidden');
           $('.Department_พอสเลน').addClass('hidden');
           $('.Department_ขัด').removeClass('hidden');
           $('.Department_ขาย').addClass('hidden');
           $('.Department_ทัวร์').addClass('hidden');
           $('.Department_EMS').addClass('hidden');
           $('.Department_บริการลูกค้า').addClass('hidden');
           $('.Department_แพ๊ค').addClass('hidden');
           $('.Department_โอแปค').addClass('hidden');
           $('.Department_เตรียมงาน').addClass('hidden');
           $('.Department_SCAN').addClass('hidden');
           $('.Department_PREP').addClass('hidden');
           $('.Department_CAM').addClass('hidden');
           $('.Department_CAD').addClass('hidden');
           $('.Department_TEMP').addClass('hidden');
        }
        else if(product.id == 'PINTOOTH'){   
           $('.Department_ปูน').removeClass('hidden');
           $('.Department_WAX').removeClass('hidden');
           $('.Department_แต่งลง').removeClass('hidden');
           $('.Department_โอเปค').removeClass('hidden');
           $('.Department_พอสเลน').removeClass('hidden');
           $('.Department_ขัด').removeClass('hidden');
           $('.Department_ขาย').removeClass('hidden');
           $('.Department_ทัวร์').removeClass('hidden');
           $('.Department_EMS').removeClass('hidden');
           $('.Department_บริการลูกค้า').removeClass('hidden');
           $('.Department_แพ๊ค').removeClass('hidden');
           $('.Department_โอแปค').removeClass('hidden');
           $('.Department_เตรียมงาน').removeClass('hidden');
           $('.Department_SCAN').removeClass('hidden');
           $('.Department_PREP').removeClass('hidden');
           $('.Department_CAM').removeClass('hidden');
           $('.Department_CAD').removeClass('hidden');
           $('.Department_TEMP').removeClass('hidden');
        }
    }
</script>
@stop