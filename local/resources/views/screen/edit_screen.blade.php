@extends('layouts.template')
@section('title', 'Screen')
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

    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */

    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the indicator (dot/circle) when checked */

    .container input:checked~.checkmark:after {
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
        display: none;
    }

    input[type=radio]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }

    .radio-toolbar label {
        display: inline-block;
        background-color: #ddd;
        width: 45%;
        height: auto;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;
    }

    .radio-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbar input[type="radio"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Radio */

    /* Radio SHADE */

    .radio-toolbarSHADE {
        margin: 0px;
    }

    .radio-toolbarSHADE input[type=radio] {
        display: none;
    }

    input[type=radio]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }

    .radio-toolbarSHADE label {
        display: inline-block;
        background-color: #ddd;
        width: 55px;
        height: 25px;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;
    }

    .radio-toolbarSHADE label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbarSHADE input[type="radio"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Radio SHADE */

    /* Check Box */

    .checkbox-toolbar {
        margin: 10px;
    }

    .checkbox-toolbar input[type="checkbox"] {
        display: none;
    }

    input[type="checkbox"]:checked+label>img {
        border: 4px solid #fff;
        box-shadow: 0 0 5px 5px #090;
        border-radius: 4px;
    }

    .checkbox-toolbar label {
        display: inline-block;
        background-color: #ddd;
        width: 23%;
        height: auto;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;
    }

    .checkbox-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar input[type="checkbox"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    .checkbox-toolbar2 label {
        display: inline-block;
        background-color: #ddd;
        width: 102%;
        height: 8%;
        padding: 10px;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;

    }

    .checkbox-toolbar2 label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar2 input[type="checkbox"]:checked+label {
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Check Box */

    /*Tooth*/

    #tooth-check {
        display: none;
    }

    .tooth-chart {
        width: 80%;
        margin: auto;
    }

    #tooth-lbl>text {
        font-family: 'Avenir-Heavy';
    }

    polygon,
    path {
        -webkit-transition: fill .25s;
        transition: fill .25s;
    }

    polygon:hover,
    polygon:active,
    #tooth-polygon>path:hover,
    #tooth-polygon>path:active {
        fill: red !important;
        cursor: pointer;
    }

    /*End Tooth*/

    input[type=checkbox] {
        display: none;
    }

    .lbl {
        border: 1px solid;
        border-radius: 50%;
        cursor: pointer;
        width: 25px;
        height: 25px;
    }

    .lbl:hover {
        opacity: 0.5;
    }

    .check {
        color: blue;
        background: blue;
    }

    .img-tooth {
        width: 25px;
        height: 25px;
        margin-bottom: 15px;
        margin-right: 15px;
    }

    .tbl-tooth {
        margin: auto;
    }

    .tbl-tooth td {
        /*border:1px solid black;*/
    }

    /* The container */

    .select {
        color: #FFE000;
        background: #FFE000;
    }

    .selected {
        color: #00D413;
        background: #00D413;
    }

    .input-hidden {
        display: none;
    }

    .pontic {
        border: 0px dashed #444;
        width: 50px;
        height: 50px;
        transition: 500ms all;
    }

    .margin {
        border: 0px dashed #444;
        width: 50px;
        height: 50px;
        margin: 1px;
        transition: 500ms all;
    }

    /* Check Box */

    .checkbox-toolbar1 {
        margin: 5px;
    }

    .checkbox-toolbar1 input[type="checkbox"] {
        display: none;
    }

    .checkbox-toolbar1 label {
        display: inline-block;
        background-color: #ddd;
        width: 47%;
        height: auto;
        padding: 1%;
        font-size: 14px;
        border-radius: 4px;
        margin: 1%;

    }

    .checkbox-toolbar1 label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .checkbox-toolbar1 input[type="checkbox"]:checked+label {
        color: #fff;
        background-color: #19d895;
        border-color: #19d895;
    }

    /* End Check Box */
</style>
<script>
    function OnLoad(n){
            //$('.lbl_green_'+n).addClass('check');
            //document.getElementById('lbl_green_'+n).classList.toggle("check");
        // alert($('#lbl_green_'+n).length);
        setTimeout(function() {
            if($('#lbl_green_'+n).length){
                $(".img-tooth-"+n).addClass('img-tooth');
                $('#lbl_green_'+n).addClass('lbl_green_'+n);
                $('#lbl_green_'+n).addClass('select');
            }else{
                OnLoad(n);
            }
        }, 10);
    }
    function select(n){
        //$('.lbl_green_'+n).addClass('check');
        //document.getElementById('lbl_green_'+n).classList.toggle("check");
        setTimeout(function() {
            if( $('#lbl_green_'+n).length){
                $('#lbl_green_'+n).addClass('selected');
            }else{
                select(n);
            }
        }, 10);
    }

</script>

@stop
@section('content')
<div class="content-wrapper">
    @foreach($data_all as $out_data_all)
    {{ Form::open(['method' => 'post' , 'url' => '/mainscreen/detail/teeth/edit/save'.'/'.$out_data_all->ID_order_screen.'/'.$out_data_all->TeethID]) }}

    

    @php
        $count = 0;
    @endphp
    <div class="row" id="stepApp">


           {{-- 5 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp;E.MAX & COLOR</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;E.MAX</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->e_max == 'VEENEER')
                                <input type="radio" id="e_max_VEENEER" name="e_max" value="VEENEER" checked>
                            @else 
                                <input type="radio" id="e_max_VEENEER" name="e_max" value="VEENEER">
                            @endif
                                <label for="e_max_VEENEER" style="cursor:pointer;">VEENEER</label>

                            @if($out_data_all->e_max == 'CROWN')
                                <input type="radio" id="e_max_CROWN" name="e_max" value="CROWN" checked>
                            @else 
                                <input type="radio" id="e_max_CROWN" name="e_max" value="CROWN">
                            @endif
                                <label for="e_max_CROWN" style="cursor:pointer;">CROWN </label>

                            @if($out_data_all->e_max == 'BRIDGE')
                                <input type="radio" id="e_max_BRIDGE" name="e_max" value="BRIDGE" checked>
                            @else
                                <input type="radio" id="e_max_BRIDGE" name="e_max" value="BRIDGE">
                            @endif
                                <label for="e_max_BRIDGE" style="cursor:pointer;">BRIDGE</label>

                            @if($out_data_all->e_max == 'INLAY')
                                <input type="radio" id="e_max_INLAY" name="e_max" value="INLAY" checked>
                            @else
                                <input type="radio" id="e_max_INLAY" name="e_max" value="INLAY">
                            @endif
                                <label for="e_max_INLAY" style="cursor:pointer;"> INLAY </label>

                            @if($out_data_all->e_max == 'ONLAY')
                                <input type="radio" id="e_max_ONLAY" name="e_max" value="ONLAY" checked>
                            @else
                                <input type="radio" id="e_max_ONLAY" name="e_max" value="ONLAY">
                            @endif
                                <label for="e_max_ONLAY" style="cursor:pointer;"> ONLAY </label>
                        </div>
                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;COLOR</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->color == 'STUMP')
                                <input type="radio" id="color_STUMP" name="color" value="STUMP" checked>
                            @else
                                <input type="radio" id="color_STUMP" name="color" value="STUMP">
                            @endif
                                <label for="color_STUMP" style="cursor:pointer;">สี STUMP</label>

                            @if($out_data_all->color == 'INGOT')    
                                <input type="radio" id="color_INGOT" name="color" value="INGOT" checked>
                            @else
                                <input type="radio" id="color_INGOT" name="color" value="INGOT">
                            @endif
                                <label for="color_INGOT" style="cursor:pointer;">สี INGOT </label>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_emax_color">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_emax_color',$out_data_all->comment_emax_color, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
            </div>

            <br>
            {{-- 6 --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;ceramage</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->ceramage == 'CROWN')
                                <input type="radio" id="ceramage_CROWN" name="ceramage" value="CROWN" checked>
                            @else 
                                <input type="radio" id="ceramage_CROWN" name="ceramage" value="CROWN">
                            @endif
                                <label for="ceramage_CROWN" style="cursor:pointer;">CROWN</label>

                            @if($out_data_all->ceramage == 'BRIDGE')
                                <input type="radio" id="ceramage_BRIDGE" name="ceramage" value="BRIDGE" checked>
                            @else
                                <input type="radio" id="ceramage_BRIDGE" name="ceramage" value="BRIDGE">
                            @endif
                                <label for="ceramage_BRIDGE" style="cursor:pointer;">BRIDGE </label>

                            @if($out_data_all->ceramage == 'INLAY')
                                <input type="radio" id="ceramage_INLAY" name="ceramage" value="INLAY" checked>
                            @else
                                <input type="radio" id="ceramage_INLAY" name="ceramage" value="INLAY">
                            @endif    
                                <label for="ceramage_INLAY" style="cursor:pointer;">INLAY</label>

                            @if($out_data_all->ceramage == 'ONLAY')
                                <input type="radio" id="ceramage_ONLAY" name="ceramage" value="ONLAY" checked>
                            @else
                                <input type="radio" id="ceramage_ONLAY" name="ceramage" value="ONLAY">
                            @endif
                                <label for="ceramage_ONLAY" style="cursor:pointer;"> ONLAY </label>

                            @if($out_data_all->ceramage == 'VENEER')
                                <input type="radio" id="ceramage_VENEER" name="ceramage" value="VENEER" checked>
                            @else
                                <input type="radio" id="ceramage_VENEER" name="ceramage" value="VENEER">
                            @endif
                                <label for="ceramage_VENEER" style="cursor:pointer;"> VENEER </label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_ceramage">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_ceramage',$out_data_all->comment_ceramage, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- 7 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;ZIRCONIA</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;COPPING</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->zirconia_copping == 'PC LAVA')
                                <input type="radio" id="zirconia_copping1" name="zirconia_copping" value="PC LAVA" checked>
                            @else
                                <input type="radio" id="zirconia_copping1" name="zirconia_copping" value="PC LAVA">
                            @endif
                                <label for="zirconia_copping1" style="cursor:pointer;">PC LAVA</label>

                            @if($out_data_all->zirconia_copping == 'PC ZIRCONIA (ปิดสีโลหะ)')
                                <input type="radio" id="zirconia_copping2" name="zirconia_copping" value="PC ZIRCONIA (ปิดสีโลหะ)" checked>
                            @else
                                <input type="radio" id="zirconia_copping2" name="zirconia_copping" value="PC ZIRCONIA (ปิดสีโลหะ)">
                            @endif
                                <label for="zirconia_copping2" style="cursor:pointer;">PC ZIRCONIA (ปิดสีโลหะ) </label>

                            @if($out_data_all->zirconia_copping == 'PC ZIRCONIA')    
                                <input type="radio" id="zirconia_copping3" name="zirconia_copping" value="PC ZIRCONIA" checked>
                            @else
                                <input type="radio" id="zirconia_copping3" name="zirconia_copping" value="PC ZIRCONIA">
                            @endif
                                <label for="zirconia_copping3" style="cursor:pointer;">PC ZIRCONIA</label>
                        </div>
                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;ALL ZIRCONIA CROWN (กลึงทั้งซี่ด้วย ZIRCONIA)</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->zirconia_crown == 'PC LAVA') 
                                <input type="radio" id="zirconia_crown1" name="zirconia_crown" value="PC LAVA" checked>
                            @else
                                <input type="radio" id="zirconia_crown1" name="zirconia_crown" value="PC LAVA">
                            @endif
                                <label for="zirconia_crown1" style="cursor:pointer;">PC LAVA</label>

                            @if($out_data_all->zirconia_crown == 'PC ALL ZIRCONIA (แบบใส)')
                                <input type="radio" id="zirconia_crown2" name="zirconia_crown" value="PC ALL ZIRCONIA (แบบใส)" checked>
                            @else
                                <input type="radio" id="zirconia_crown2" name="zirconia_crown" value="PC ALL ZIRCONIA (แบบใส)">
                            @endif
                                <label for="zirconia_crown2" style="cursor:pointer;">PC ALL ZIRCONIA (แบบใส)</label>

                            @if($out_data_all->zirconia_crown == 'PC ALL ZIRCONIA (Multi)')
                                <input type="radio" id="zirconia_crown3" name="zirconia_crown" value="PC ALL ZIRCONIA (Multi)" checked>
                            @else
                                <input type="radio" id="zirconia_crown3" name="zirconia_crown" value="PC ALL ZIRCONIA (Multi)">
                            @endif    
                                <label for="zirconia_crown3" style="cursor:pointer;">PC ALL ZIRCONIA (Multi)</label>
                        </div>
                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;SELECT RESTORATION TYPE (ประเภทงาน)</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->zirconia_restoration == 'Crown')
                                <input type="radio" id="zirconia_restoration1" name="zirconia_restoration" value="Crown" checked>
                            @else
                                <input type="radio" id="zirconia_restoration1" name="zirconia_restoration" value="Crown">
                            @endif
                                <label for="zirconia_restoration1" style="cursor:pointer;">Crown</label>
                            
                            @if($out_data_all->zirconia_restoration == 'Bridge')
                                <input type="radio" id="zirconia_restoration2" name="zirconia_restoration" value="Bridge" checked>
                            @else
                                <input type="radio" id="zirconia_restoration2" name="zirconia_restoration" value="Bridge">
                            @endif
                                <label for="zirconia_restoration2" style="cursor:pointer;">Bridge</label>

                            @if($out_data_all->zirconia_restoration == 'Inlay')
                                <input type="radio" id="zirconia_restoration3" name="zirconia_restoration" value="Inlay" checked>
                            @else
                                <input type="radio" id="zirconia_restoration3" name="zirconia_restoration" value="Inlay">
                            @endif
                                <label for="zirconia_restoration3" style="cursor:pointer;">Inlay</label>
                            
                            @if($out_data_all->zirconia_restoration == 'Onlay')
                                <input type="radio" id="zirconia_restoration4" name="zirconia_restoration" value="Onlay" checked>
                            @else
                                <input type="radio" id="zirconia_restoration4" name="zirconia_restoration" value="Onlay">
                            @endif
                                <label for="zirconia_restoration4" style="cursor:pointer;">Onlay</label>

                            @if($out_data_all->zirconia_restoration == 'Veneer')
                                <input type="radio" id="zirconia_restoration5" name="zirconia_restoration" value="Veneer" checked>
                            @else
                                <input type="radio" id="zirconia_restoration5" name="zirconia_restoration" value="Veneer">
                            @endif
                                <label for="zirconia_restoration5" style="cursor:pointer;">Veneer</label>

                            @if($out_data_all->zirconia_restoration == 'All On 4')
                                <input type="radio" id="zirconia_restoration6" name="zirconia_restoration" value="All On 4" checked>
                            @else
                                <input type="radio" id="zirconia_restoration6" name="zirconia_restoration" value="All On 4">
                            @endif
                                <label for="zirconia_restoration6" style="cursor:pointer;">All On 4</label>

                            @if($out_data_all->zirconia_restoration == 'All On 6')
                                <input type="radio" id="zirconia_restoration7" name="zirconia_restoration" value="All On 6" checked>
                            @else
                                <input type="radio" id="zirconia_restoration7" name="zirconia_restoration" value="All On 6">
                            @endif
                                <label for="zirconia_restoration7" style="cursor:pointer;">All On 6</label>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_zirconia">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_zirconia',$out_data_all->comment_zirconia, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>

        {{-- 6.5 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp;MODEL</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->model == 'SURGICAL GUIDE')
                                <input type="radio" id="MODEL1" name="model" value="SURGICAL GUIDE" onclick="MODELFunctions()" checked>
                            @else
                                <input type="radio" id="MODEL1" name="model" value="SURGICAL GUIDE" onclick="MODELFunctions()">
                            @endif
                                <label for="MODEL1" style="cursor:pointer;">SURGICAL GUIDE</label>

                            @if($out_data_all->model == 'MODEL RESIN')
                                <input type="radio" id="MODEL2" name="model" value="MODEL RESIN" onclick="MODELFunctions()" checked>
                            @else
                                <input type="radio" id="MODEL2" name="model" value="MODEL RESIN" onclick="MODELFunctions()">
                            @endif
                                <label for="MODEL2" style="cursor:pointer;">MODEL RESIN (PRINT MODEL)</label>
                        </div>
                    </div>

                    @if($out_data_all->model == 'MODEL RESIN')
                        <div id="CardRESIN">
                    @else
                        <div id="CardRESIN" style="display:none;">
                    @endif
                        <br>
                        <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือก MODEL RESIN (PRINT MODEL)</li>
                                </ol>
                            </nav>
                        <div>
                            <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    @if($out_data_all->model_resin == 'บน')
                                        <input type="radio" id="model_resin1" name="model_resin" value="บน" checked>
                                    @else
                                        <input type="radio" id="model_resin1" name="model_resin" value="บน">
                                    @endif
                                        <label for="model_resin1" style="cursor:pointer;">บน</label>

                                    @if($out_data_all->model_resin == 'ล่าง')
                                        <input type="radio" id="model_resin2" name="model_resin" value="ล่าง" checked>
                                    @else
                                        <input type="radio" id="model_resin2" name="model_resin" value="ล่าง">
                                    @endif
                                        <label for="model_resin2" style="cursor:pointer;">ล่าง</label>

                                    @if($out_data_all->model_resin == 'บนและล่าง')
                                        <input type="radio" id="model_resin3" name="model_resin" value="บนและล่าง" checked>
                                    @else
                                        <input type="radio" id="model_resin3" name="model_resin" value="บนและล่าง">
                                    @endif
                                        <label for="model_resin3" style="cursor:pointer;">บนและล่าง</label>

                                    @if($out_data_all->model_resin == 'เต็มปาก')
                                        <input type="radio" id="model_resin4" name="model_resin" value="เต็มปาก" checked>
                                    @else
                                        <input type="radio" id="model_resin4" name="model_resin" value="เต็มปาก">
                                    @endif
                                        <label for="model_resin4" style="cursor:pointer;">เต็มปาก</label>

                                    @if($out_data_all->model_resin == 'ครึ่งปาก')
                                        <input type="radio" id="model_resin5" name="model_resin" value="ครึ่งปาก" checked>
                                    @else
                                        <input type="radio" id="model_resin5" name="model_resin" value="ครึ่งปาก">
                                    @endif
                                        <label for="model_resin5" style="cursor:pointer;">ครึ่งปาก</label>

                                    @if($out_data_all->model_resin == '1/4')
                                        <input type="radio" id="model_resin6" name="model_resin" value="1/4" checked>
                                    @else
                                        <input type="radio" id="model_resin6" name="model_resin" value="1/4">
                                    @endif
                                        <label for="model_resin6" style="cursor:pointer;">1/4</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_model">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_model',$out_data_all->comment_model, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- 7 --}}
            <br>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;IMPLANT</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->implant == 'E.MAX')
                                <input type="radio" id="IMPLANT1" name="implant" value="E.MAX" onclick="CERAMAGEFunctions()" checked>
                            @else
                                <input type="radio" id="IMPLANT1" name="implant" value="E.MAX" onclick="CERAMAGEFunctions()">
                            @endif
                                <label for="IMPLANT1" style="cursor:pointer;">E.MAX</label>
                            
                            @if($out_data_all->implant == 'ZIRCONIA')
                                <input type="radio" id="IMPLANT2" name="implant" value="ZIRCONIA" onclick="CERAMAGEFunctions()" checked>
                            @else
                                <input type="radio" id="IMPLANT2" name="implant" value="ZIRCONIA" onclick="CERAMAGEFunctions()">
                            @endif
                                <label for="IMPLANT2" style="cursor:pointer;">ZIRCONIA</label>

                            @if($out_data_all->implant == 'CERAMAGE')
                                <input type="radio" id="IMPLANT3" name="implant" value="CERAMAGE" onclick="CERAMAGEFunctions()" checked>
                            @else
                                <input type="radio" id="IMPLANT3" name="implant" value="CERAMAGE" onclick="CERAMAGEFunctions()">
                            @endif
                                <label for="IMPLANT3" style="cursor:pointer;">CERAMAGE</label>

                            @if($out_data_all->implant == 'Cement-retained')
                                <input type="radio" id="IMPLANT4" name="implant" value="Cement-retained" onclick="CERAMAGEFunctions()" checked>
                            @else
                                <input type="radio" id="IMPLANT4" name="implant" value="Cement-retained" onclick="CERAMAGEFunctions()">
                            @endif
                                <label for="IMPLANT4" style="cursor:pointer;">Cement-retained</label>

                            @if($out_data_all->implant == 'Screw-retained')
                                <input type="radio" id="IMPLANT5" name="implant" value="Screw-retained" onclick="CERAMAGEFunctions()" checked>
                            @else
                                <input type="radio" id="IMPLANT5" name="implant" value="Screw-retained" onclick="CERAMAGEFunctions()">
                            @endif
                                <label for="IMPLANT5" style="cursor:pointer;">Screw-retained</label>

                            @if($out_data_all->implant == 'สกรูที่หมอส่งมา')
                                <input type="radio" id="IMPLANT6" name="implant" value="สกรูที่หมอส่งมา" onclick="CERAMAGEFunctions()" checked>
                            @else
                                <input type="radio" id="IMPLANT6" name="implant" value="สกรูที่หมอส่งมา" onclick="CERAMAGEFunctions()">
                            @endif
                                <label for="IMPLANT6" style="cursor:pointer;">สกรูที่หมอส่งมา</label>

                            @if($out_data_all->implant == 'ให้แลป FIX CEMENT ด้วย')
                                <input type="radio" id="IMPLANT7" name="implant" value="ให้แลป FIX CEMENT ด้วย" onclick="CERAMAGEFunctions()" checked>
                            @else
                                <input type="radio" id="IMPLANT7" name="implant" value="ให้แลป FIX CEMENT ด้วย" onclick="CERAMAGEFunctions()">
                            @endif
                                <label for="IMPLANT7" style="cursor:pointer;">ให้แลป FIX CEMENT ด้วย</label>
                        </div>
                    </div>

                    @if($out_data_all->implant == 'CERAMAGE')
                        <div id="CardCERAMAGE">
                    @else
                        <div id="CardCERAMAGE" style="display:none;">
                    @endif
                        <br>
                        <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือก CERAMAGE</li>
                                </ol>
                            </nav>
                        <div>
                            <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    @if($out_data_all->implant_ceramage == 'ระบบ TI-BASE')
                                        <input type="radio" id="implant_ceramage1" name="implant_ceramage" value="ระบบ TI-BASE" checked>
                                    @else
                                        <input type="radio" id="implant_ceramage1" name="implant_ceramage" value="ระบบ TI-BASE">
                                    @endif
                                        <label for="implant_ceramage1" style="cursor:pointer;">ระบบ TI-BASE</label>

                                    @if($out_data_all->implant_ceramage == 'ระบบ TITANIUM CUSTOMED')
                                        <input type="radio" id="implant_ceramage2" name="implant_ceramage" value="ระบบ TITANIUM CUSTOMED" checked>
                                    @else
                                        <input type="radio" id="implant_ceramage2" name="implant_ceramage" value="ระบบ TITANIUM CUSTOMED">
                                    @endif
                                        <label for="implant_ceramage2" style="cursor:pointer;">ระบบ TITANIUM CUSTOMED</label>

                                    @if($out_data_all->implant_ceramage == 'ระบบ STANDARD')
                                        <input type="radio" id="implant_ceramage3" name="implant_ceramage" value="ระบบ STANDARD" checked>
                                    @else
                                        <input type="radio" id="implant_ceramage3" name="implant_ceramage" value="ระบบ STANDARD">
                                    @endif
                                        <label for="implant_ceramage3" style="cursor:pointer;">ระบบ STANDARD</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($out_data_all->implant == 'Screw-retained')
                        <div id="CardScrew">
                    @else
                        <div id="CardScrew" style="display:none;">
                    @endif
                        <br>
                        <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือก Screw-retained</li>
                                </ol>
                            </nav>
                        <div>
                            <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    @if($out_data_all->implant_screw == 'STRAUMANN')
                                        <input type="radio" id="implant_screw1" name="implant_screw" value="STRAUMANN" checked>
                                    @else
                                        <input type="radio" id="implant_screw1" name="implant_screw" value="STRAUMANN">
                                    @endif
                                        <label for="implant_screw1" style="cursor:pointer;">STRAUMANN</label>

                                    @if($out_data_all->implant_screw == 'ASTRA')
                                        <input type="radio" id="implant_screw2" name="implant_screw" value="ASTRA" checked>
                                    @else
                                        <input type="radio" id="implant_screw2" name="implant_screw" value="ASTRA">
                                    @endif
                                        <label for="implant_screw2" style="cursor:pointer;">ASTRA</label>

                                    @if($out_data_all->implant_screw == 'OSSTEM')
                                        <input type="radio" id="implant_screw3" name="implant_screw" value="OSSTEM" checked>
                                    @else
                                        <input type="radio" id="implant_screw3" name="implant_screw" value="OSSTEM">
                                    @endif
                                        <label for="implant_screw3" style="cursor:pointer;">OSSTEM</label>

                                    @if($out_data_all->implant_screw == 'อื่นๆ')
                                        <input type="radio" id="implant_screw4" name="implant_screw" value="อื่นๆ" checked>
                                    @else
                                        <input type="radio" id="implant_screw4" name="implant_screw" value="อื่นๆ">
                                    @endif
                                        <label for="implant_screw4" style="cursor:pointer;">อื่นๆ</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_implant">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_implant',$out_data_all->comment_implant, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 8 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;6.&nbsp;รับตะขอ</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                        <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    @if($out_data_all->Hook == 'have')
                                        <input type="radio" name="Hook" id="chkPassport" value="have" onclick="HookFunction()" checked>
                                    @else
                                        <input type="radio" name="Hook" id="chkPassport" value="have" onclick="HookFunction()">
                                    @endif
                                        <label for="chkPassport" style="cursor:pointer;">มีตะขอ</label>

                                    @if($out_data_all->Hook == "don't have")
                                        <input type="radio" name="Hook" id="nochkPassport" value="don't have" onclick="HookFunction()" checked>
                                    @else
                                        <input type="radio" name="Hook" id="nochkPassport" value="don't have" onclick="HookFunction()">
                                    @endif
                                        <label for="nochkPassport" style="cursor:pointer;">ไม่มีตะขอ </label>
                                </div>
                            </div>

                            @if($out_data_all->Hook == 'have')
                                <div id="OptionHook">
                            @else
                                <div id="OptionHook" style="display:none;">
                            @endif
                                <br>
                                    <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;HOOK TYPE</li>
                                            </ol>
                                        </nav>
                                            <div class="checkbox-toolbar1 text-center justify-content-center">
                                                <div class="row">
                                                    @if($out_data_all->MESIAL_REST == 'MESIAL_REST')
                                                        <input type="checkbox" id="checkboxMESIAL_REST" name="MESIAL_REST" value="MESIAL_REST" checked>
                                                    @else
                                                        <input type="checkbox" id="checkboxMESIAL_REST" name="MESIAL_REST" value="MESIAL_REST">
                                                    @endif
                                                        <label for="checkboxMESIAL_REST" style="cursor:pointer;">MESIAL REST</label>

                                                    @if($out_data_all->DISTAL_REST == 'DISTAL_REST')
                                                        <input type="checkbox" id="checkboxDISTAL_REST" name="DISTAL_REST" value="DISTAL_REST" checked>
                                                    @else
                                                        <input type="checkbox" id="checkboxDISTAL_REST" name="DISTAL_REST" value="DISTAL_REST">
                                                    @endif
                                                        <label for="checkboxDISTAL_REST" style="cursor:pointer;">DISTAL REST</label>

                                                    @if($out_data_all->CINGULUM_REST == 'CINGULUM_REST')
                                                        <input type="checkbox" id="checkboxCINGULUM_REST" name="CINGULUM_REST" value="CINGULUM_REST" checked>
                                                    @else
                                                        <input type="checkbox" id="checkboxCINGULUM_REST" name="CINGULUM_REST" value="CINGULUM_REST">
                                                    @endif
                                                        <label for="checkboxCINGULUM_REST" style="cursor:pointer;">CINGULUM REST</label>

                                                    @if($out_data_all->LINGUAL_LEDGE == 'LINGUAL_LEDGE')
                                                        <input type="checkbox" id="checkboxLINGUAL_LEDGE" name="LINGUAL_LEDGE" value="LINGUAL_LEDGE" checked>
                                                    @else
                                                        <input type="checkbox" id="checkboxLINGUAL_LEDGE" name="LINGUAL_LEDGE" value="LINGUAL_LEDGE">
                                                    @endif
                                                        <label for="checkboxLINGUAL_LEDGE" style="cursor:pointer;">LINGUAL LEDGE</label>

                                                    @if($out_data_all->EMBRESSURE_REST == 'EMBRESSURE_REST')
                                                        <input type="checkbox" id="checkboxEMBRESSURE_REST" name="EMBRESSURE_REST" value="EMBRESSURE_REST" checked>
                                                    @else
                                                        <input type="checkbox" id="checkboxEMBRESSURE_REST" name="EMBRESSURE_REST" value="EMBRESSURE_REST">
                                                    @endif
                                                        <label for="checkboxEMBRESSURE_REST" style="cursor:pointer;">EMBRESSURE REST</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <h4 class="col-sm-4 col-form-label">อื่นๆ</h4>
                                                <div class="col-sm-8">
                                                    <input type="text" id="another" name="other_hook"  value={{ $out_data_all->other_hook }} class="form-control" placeholder="รายละเอียดอื่นๆ" />
                                                </div>
                                            </div>

                                                    <br>
                                                    <nav aria-label="breadcrumb">
                                                            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                                <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;UNDERCUT</li>
                                                            </ol>
                                                        </nav>
                                                <div class="radio-toolbar">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <select class="form-control" name="undercut_hook" id="undercut_hook">
                                                                @if($out_data_all->undercut_hook == '0.01')
                                                                    <option value="0.01">UNDERCUT 0.01"</option>
                                                                    <option value="0.02">UNDERCUT 0.02"</option>
                                                                    <option value="0.03">UNDERCUT 0.03"</option>
                                                                @elseif($out_data_all->undercut_hook == '0.02')
                                                                    <option value="0.02">UNDERCUT 0.02"</option>
                                                                    <option value="0.01">UNDERCUT 0.01"</option>
                                                                    <option value="0.03">UNDERCUT 0.03"</option>
                                                                @elseif($out_data_all->undercut_hook == '0.03')
                                                                    <option value="0.03">UNDERCUT 0.03"</option>
                                                                    <option value="0.01">UNDERCUT 0.01"</option>
                                                                    <option value="0.02">UNDERCUT 0.02"</option>
                                                                @else
                                                                    <option value="defaultunit">เลือกขนาด</option>
                                                                    <option value="0.01">UNDERCUT 0.01"</option>
                                                                    <option value="0.02">UNDERCUT 0.02"</option>
                                                                    <option value="0.03">UNDERCUT 0.03"</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        &nbsp;
                                                        <div class="col-sm-12">
                                                            <select class="form-control" name="unit_hook" id="unit_hook">
                                                                @if($out_data_all->unit_hook == 'MB')
                                                                    <option value="MB">MB</option>
                                                                    <option value="DB">DB</option>
                                                                    <option value="M">ML</option>
                                                                    <option value="B">B</option>
                                                                    <option value="MBDB">MBDB</option>
                                                                @elseif($out_data_all->unit_hook == 'DB')
                                                                    <option value="DB">DB</option>
                                                                    <option value="MB">MB</option>
                                                                    <option value="M">ML</option>
                                                                    <option value="B">B</option>
                                                                    <option value="MBDB">MBDB</option>
                                                                @elseif($out_data_all->unit_hook == 'M')
                                                                    <option value="M">ML</option>
                                                                    <option value="DB">DB</option>
                                                                    <option value="MB">MB</option>
                                                                    <option value="B">B</option>
                                                                    <option value="MBDB">MBDB</option>
                                                                @elseif($out_data_all->unit_hook == 'B')
                                                                    <option value="B">B</option>
                                                                    <option value="DB">DB</option>
                                                                    <option value="MB">MB</option>
                                                                    <option value="M">ML</option>
                                                                    <option value="MBDB">MBDB</option>
                                                                @elseif($out_data_all->unit_hook == 'MBDB')
                                                                    <option value="MBDB">MBDB</option>
                                                                    <option value="DB">DB</option>
                                                                    <option value="MB">MB</option>
                                                                    <option value="M">ML</option>
                                                                    <option value="B">B</option>
                                                                @else
                                                                    <option value="defaultunit">เลือกหน่วย</option>
                                                                    <option value="MB">MB</option>
                                                                    <option value="DB">DB</option>
                                                                    <option value="M">ML</option>
                                                                    <option value="B">B</option>
                                                                    <option value="MBDB">MBDB</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                            </div>

                    <br>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-3" for="comment_hook">รอถามแพทย์</label>
                        <div class="col-sm-8">
                                {{ Form::textarea('comment_hook',$out_data_all->comment_hook, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                        <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;7.&nbsp;ALLOYS</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <div class="radio-toolbar text-center">
                            <div class="row" style="over-flow:auto;">
                                @if($out_data_all->Metal_type == 'NON_PRECIOUS')
                                    <input type="radio" id="radioNON_PRECIOUS" name="Metal_type" value="NON_PRECIOUS" checked>
                                @else
                                    <input type="radio" id="radioNON_PRECIOUS" name="Metal_type" value="NON_PRECIOUS">
                                @endif
                                    <label for="radioNON_PRECIOUS" style="cursor:pointer;">NON PRECIOUS</label>
    
                                @if($out_data_all->Metal_type == 'PALLADIUM')
                                    <input type="radio" id="radioPALLADIUM" name="Metal_type" value="PALLADIUM" checked>
                                @else
                                    <input type="radio" id="radioPALLADIUM" name="Metal_type" value="PALLADIUM">
                                @endif
                                    <label for="radioPALLADIUM" style="cursor:pointer;">PALLADIUM </label>
    
                                @if($out_data_all->Metal_type == 'SEMI_PRECIOUS')
                                    <input type="radio" id="radioSEMI_PRECIOUS" name="Metal_type" value="SEMI_PRECIOUS" checked>
                                @else
                                    <input type="radio" id="radioSEMI_PRECIOUS" name="Metal_type" value="SEMI_PRECIOUS">
                                @endif
                                    <label for="radioSEMI_PRECIOUS" style="cursor:pointer;">SEMI PRECIOUS</label>
    
                                @if($out_data_all->Metal_type == 'HIGH_PRECIOUS')
                                    <input type="radio" id="radioHIGH_PRECIOUS" name="Metal_type" value="HIGH_PRECIOUS" checked>
                                @else
                                    <input type="radio" id="radioHIGH_PRECIOUS" name="Metal_type" value="HIGH_PRECIOUS">
                                @endif
                                    <label for="radioHIGH_PRECIOUS" style="cursor:pointer;"> HIGH PRECIOUS </label>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3" for="comment_emax_color">รอถามแพทย์</label>
                            <div class="col-sm-8">
                                    {{ Form::textarea('comment_Metal_type',$out_data_all->comment_Metal_type, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        {{-- 9 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;8.&nbsp;CONTOUR AND OCCLUSION DESIGN & PONTIC DESIGE</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;GINGIVAL EMBRASURES</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->CONTOUR == 'OPEN')
                                <input type="radio" id="radioOPEN" name="CONTOUR" value="OPEN" checked>
                            @else
                                <input type="radio" id="radioOPEN" name="CONTOUR" value="OPEN">
                            @endif
                                <label for="radioOPEN" style="cursor:pointer;">OPEN</label>

                            @if($out_data_all->CONTOUR == 'CLOSE')
                                <input type="radio" id="radioCLOSE" name="CONTOUR" value="CLOSE" checked>
                            @else
                                <input type="radio" id="radioCLOSE" name="CONTOUR" value="CLOSE">
                            @endif
                                <label for="radioCLOSE" style="cursor:pointer;">CLOSE </label>
                        </div>
                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;OCCLUSION</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->CONTOUR == 'สบสนิท')
                                <input type="radio" id="radiosomsanit" name="CONTOUR" value="สบสนิท" onclick="ContourFunction()" checked>
                            @else
                                <input type="radio" id="radiosomsanit" name="CONTOUR" value="สบสนิท" onclick="ContourFunction()">
                            @endif
                                <label for="radiosomsanit" style="cursor:pointer;">สบสนิท</label>

                            @if($out_data_all->CONTOUR == 'UNDER')
                                <input type="radio" id="radioUNDER" name="CONTOUR" value="UNDER" onclick="ContourFunction()" checked>
                            @else
                                <input type="radio" id="radioUNDER" name="CONTOUR" value="UNDER" onclick="ContourFunction()">
                            @endif
                                <label for="radioUNDER" style="cursor:pointer;">UNDER </label>
                        </div>
                    </div>

                    @if($out_data_all->CONTOUR == 'UNDER')
                        <div class="row" id="undercut">
                    @else
                        <div class="row" id="undercut" style="display:none;">
                    @endif

                        <div class="col col-sm-11">
                            <div class="radio-toolbar text-center justify-content-center">
                                <select class="form-control" name="unit_CONTOUR" id="unit_CONTOUR">
                                    @if($out_data_all->unit_CONTOUR == '0.3')
                                        <option value="0.3">0.3</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    @elseif($out_data_all->unit_CONTOUR == '0.5')
                                        <option value="0.5">0.5</option>
                                        <option value="0.3">0.3</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    @elseif($out_data_all->unit_CONTOUR == '1')
                                        <option value="1">1</option>
                                        <option value="0.3">0.3</option>
                                        <option value="0.5">0.5</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    @elseif($out_data_all->unit_CONTOUR == '2')
                                        <option value="2">2</option>
                                        <option value="0.3">0.3</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1">1</option>
                                        <option value="3">3</option>
                                    @elseif($out_data_all->unit_CONTOUR == '3')
                                        <option value="3">3</option>
                                        <option value="0.3">0.3</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    @else
                                        <option value="non_unit_CONTOUR">เลือกหน่วย</option>
                                        <option value="0.3">0.3</option>
                                        <option value="0.5">0.5</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;CONTACT</li>
                        </ol>
                    </nav>
                    <div class="radio-toolbar text-center">
                        <div class="row" style="over-flow:auto;">
                            @if($out_data_all->CONTOUR == 'AREA')
                                <input type="radio" id="radioAREA" name="CONTOUR" value="AREA" checked>
                            @else
                                <input type="radio" id="radioAREA" name="CONTOUR" value="AREA">
                            @endif
                                <label for="radioAREA" style="cursor:pointer;">AREA</label>

                            @if($out_data_all->CONTOUR == 'POINT')
                                <input type="radio" id="radioPOINT" name="CONTOUR" value="POINT" checked>
                            @else
                                <input type="radio" id="radioPOINT" name="CONTOUR" value="POINT">
                            @endif
                                <label for="radioPOINT" style="cursor:pointer;">POINT </label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                            <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;PONTIC DESIGE</li>
                        </ol>
                    </nav>
                    <div class="text-center justify-content-center" style="margin:15px;">
                            <div class="row" align="center">
                                <div class="col-2">
                                    @if($out_data_all->PONTIC_DESIGN == '1.png')
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC1" value="1.png" checked/>
                                    @else
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC1" value="1.png" />
                                    @endif
                                        <label for="PONTIC1" style="cursor:pointer;">
                                            <img class="pontic" src="{{ asset('images/pontic-design/1.png') }}" alt="I'm sad"/>
                                        </label>
                                </div>

                                <div class="col-2">
                                    @if($out_data_all->PONTIC_DESIGN == '2.png')
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC2" value="2.png" checked/>
                                    @else
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC2" value="2.png" />
                                    @endif
                                        <label for="PONTIC2" style="cursor:pointer;">
                                            <img class="pontic" src="{{ asset('images/pontic-design/2.png') }}" alt="I'm sad" />
                                        </label>
                                </div>

                                <div class="col-2">
                                    @if($out_data_all->PONTIC_DESIGN == '3.png')
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC4" value="3.png" checked/>
                                    @else
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC4" value="3.png"/>
                                    @endif
                                        <label for="PONTIC4" style="cursor:pointer;">
                                            <img class="pontic" src="{{ asset('images/pontic-design/3.png') }}"  alt="I'm sad" />
                                        </label>
                                </div>
                                <div class="col-2">
                                    @if($out_data_all->PONTIC_DESIGN == '4.png')
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC5" value="4.png" checked/>
                                    @else
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC5" value="4.png" />
                                    @endif
                                        <label for="PONTIC5" style="cursor:pointer;">
                                            <img class="pontic" src="{{ asset('images/pontic-design/4.png') }}"   alt="I'm sad" />
                                        </label>
                                </div>

                                <div class="col-2">
                                    @if($out_data_all->PONTIC_DESIGN == '5.png')
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC6" value="5.png" checked/>
                                    @else
                                        <input class="input-hidden" type="radio" name="PONTIC_DESIGN" id="PONTIC6" value="5.png" />
                                    @endif
                                        <label for="PONTIC6" style="cursor:pointer;">
                                            <img class="pontic" src="{{ asset('images/pontic-design/5.png') }}"   alt="I'm sad" />
                                        </label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3" for="comment_contour">รอถามแพทย์</label>
                            <div class="col-sm-8">
                                    {{ Form::textarea('comment_contour',$out_data_all->comment_contour, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                            </div>
                        </div>
                        <br>
                </div>
            </div>
        </div>

        {{-- 10 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;9.&nbsp;SHADE</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                        <div class="radio-toolbar text-center justify-content-center">
                                <div class="row" style="over-flow:auto;">
                                    @if($out_data_all->one_color != NULL)
                                        <input type="radio" id="radioOne" name="type" value="One" onclick="ShadeFunction()" checked>
                                    @else
                                        <input type="radio" id="radioOne" name="type" value="One" onclick="ShadeFunction()">
                                    @endif
                                        <label for="radioOne" style="cursor:pointer;" checked>สีเดียว</label>

                                    @if($out_data_all->one_color == NULL)
                                        <input type="radio" id="radiomulti" name="type" value="Various" onclick="ShadeFunction()" checked>
                                    @else
                                        <input type="radio" id="radiomulti" name="type" value="Various" onclick="ShadeFunction()">
                                    @endif
                                        <label for="radiomulti" style="cursor:pointer;">หลายสี</label>
                                </div>
                            </div>

                            @if($out_data_all->one_color != NULL)
                                <div class="card" id="CardOneColor">
                            @else
                                <div class="card" id="CardOneColor" style="display:none;">
                            @endif
                                    <br>
                                    <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือกสีเดียว</li>
                                            </ol>
                                        </nav>
                                    <div>
                                        <div class="radio-toolbar text-center justify-content-center">
                                            <div class="row" style="over-flow:auto;">
                                                @if($out_data_all->one_color == 'VITA AD')
                                                    <input type="radio" id="radioVITA_AD" name="one_color" value="VITA AD" onclick="ShadeFunction()" checked>
                                                @else
                                                    <input type="radio" id="radioVITA_AD" name="one_color" value="VITA AD" onclick="ShadeFunction()">
                                                @endif
                                                    <label for="radioVITA_AD" style="cursor:pointer;">VITA AD</label>

                                                @if($out_data_all->one_color == 'VITA 3D')
                                                    <input type="radio" id="radioVITA_3D" name="one_color" value="VITA 3D" onclick="ShadeFunction()" checked>
                                                @else
                                                    <input type="radio" id="radioVITA_3D" name="one_color" value="VITA 3D" onclick="ShadeFunction()">
                                                @endif
                                                    <label for="radioVITA_3D" style="cursor:pointer;">VITA 3D</label>

                                                @if($out_data_all->one_color == 'SHOFU')
                                                    <input type="radio" id="radioSHOFU" name="one_color" value="SHOFU" onclick="ShadeFunction()" checked>
                                                @else
                                                    <input type="radio" id="radioSHOFU" name="one_color" value="SHOFU" onclick="ShadeFunction()">
                                                @endif
                                                    <label for="radioSHOFU" style="cursor:pointer;">SHOFU</label>

                                                @if($out_data_all->one_color == 'CHOMASCOP')
                                                    <input type="radio" id="radioCHOMASCOP" name="one_color" value="CHOMASCOP" onclick="ShadeFunction()" checked>
                                                @else
                                                    <input type="radio" id="radioCHOMASCOP" name="one_color" value="CHOMASCOP" onclick="ShadeFunction()">
                                                @endif
                                                    <label for="radioCHOMASCOP" style="cursor:pointer;">CHOMASCOP</label>

                                                @if($out_data_all->one_color == 'อื่นๆ')
                                                    <input type="radio" id="radioAnother" name="one_color" value="อื่นๆ" onclick="ShadeFunction()" checked>
                                                @else
                                                    <input type="radio" id="radioAnother" name="one_color" value="อื่นๆ" onclick="ShadeFunction()">
                                                @endif
                                                    <label for="radioAnother" style="cursor:pointer;">อื่นๆ</label>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            @if($out_data_all->one_color == 'VITA AD' || $out_data_all->one_color == 'VITA 3D' || $out_data_all->one_color == 'SHOFU' || $out_data_all->one_color == 'CHOMASCOP')
                                <div class="card" id="CardChooseColor">
                            @else
                                <div class="card" id="CardChooseColor" style="display:none;">
                            @endif
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <a>
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>เลือกสี
                                    </a>
                                </div>
                                <div>
                                    <div class="card-body text-center">
                                        <div class="radio-toolbarSHADE text-center justify-content-center">
                                            <div class="row" style="over-flow:auto;">
                                                <div class="col-2">
                                                    @if($out_data_all->one_color_Combobox == 'A1')
                                                        <input type="radio" id="radio1A1" name="one_color_Combobox" value="A1" checked>
                                                    @else
                                                        <input type="radio" id="radio1A1" name="one_color_Combobox" value="A1">
                                                    @endif
                                                        <label for="radio1A1" style="cursor:pointer;">A1</label>
                                                </div>
                                                <div class="col-2">
                                                    @if($out_data_all->one_color_Combobox == 'A2')
                                                        <input type="radio" id="radio1A2" name="one_color_Combobox" value="A2" checked>
                                                    @else
                                                        <input type="radio" id="radio1A2" name="one_color_Combobox" value="A2">
                                                    @endif
                                                        <label for="radio1A2" style="cursor:pointer;">A2</label>
                                                </div>
                                                <div class="col-2">
                                                    @if($out_data_all->one_color_Combobox == 'A3')
                                                        <input type="radio" id="radio1A3" name="one_color_Combobox" value="A3" checked>
                                                    @else
                                                        <input type="radio" id="radio1A3" name="one_color_Combobox" value="A3">
                                                    @endif
                                                        <label for="radio1A3" style="cursor:pointer;">A3</label>
                                                </div>
                                                <div class="col-2">
                                                    @if($out_data_all->one_color_Combobox == 'B1')
                                                        <input type="radio" id="radio1B1" name="one_color_Combobox" value="B1" checked>
                                                    @else
                                                        <input type="radio" id="radio1B1" name="one_color_Combobox" value="B1">
                                                    @endif
                                                        <label for="radio1B1" style="cursor:pointer;">B1</label>
                                                </div>
                                                <div class="col-2">
                                                    @if($out_data_all->one_color_Combobox == 'B2')
                                                        <input type="radio" id="radio1B2" name="one_color_Combobox" value="B2" checked>
                                                    @else
                                                        <input type="radio" id="radio1B2" name="one_color_Combobox" value="B2">
                                                    @endif
                                                        <label for="radio1B2" style="cursor:pointer;">B2</label>
                                                </div>
                                                <div class="col-2">
                                                    @if($out_data_all->one_color_Combobox == 'B3')
                                                        <input type="radio" id="radio1B3" name="one_color_Combobox" value="B3" checked>
                                                    @else
                                                        <input type="radio" id="radio1B3" name="one_color_Combobox" value="B3">
                                                    @endif
                                                        <label for="radio1B3" style="cursor:pointer;">B3</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card" id="CardAnotherColor" style="display:none;">
                                <div class="card-header" role="tab" id="orderRequestTypeID">
                                    <a>
                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>อื่นๆ
                                    </a>
                                </div>
                                <div>
                                    <div class="card-body text-center">
                                        <div class="radio-toolbar text-center justify-content-center">
                                            <div class="row">
                                                <h4 class="col-sm-4 col-form-label">ระบุยี่ห้อ:</h4>
                                                <div class="col-sm-8">
                                                    <input type="text" id="brand" name="one_color_branch" class="form-control" value={{ $out_data_all->one_color_branch }}/>
                                                </div>
                                            </div>
                                            &nbsp;
                                            <div class="row">
                                                <h4 class="col-sm-4 col-form-label">ระบุสี:</h4>
                                                <div class="col-sm-8">
                                                    <input type="text" id="color" name="one_color_branch_color" class="form-control" value={{ $out_data_all->one_color_branch_color }}/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($out_data_all->one_color == NULL)
                                <div class="card" id="CardMultiColor">
                            @else
                                <div class="card" id="CardMultiColor" style="display:none;">
                            @endif
                                <br>
                                    <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;เลือกหลายสี</li>
                                            </ol>
                                        </nav>
                                <div>
                                    <div class="card-body text-center">
                                        <div class="radio-toolbar text-center justify-content-center">
                                            <div class="row">
                                                <h4 class="col-sm-4 col-form-label">คอฟัน:</h4>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text" id="shade_many1" name="many_branch_crowns" value={{ $out_data_all->many_branch_crowns }}  placeholder="ยี่ห้อ">                                                                                    &nbsp;
                                                    <input class="form-control" type="text" id="color1" name="many_color_crowns" value={{ $out_data_all->many_color_crowns }}  placeholder="สี">
                                                </div>
                                            </div>
                                            &nbsp;
                                            <div class="row">
                                                <h4 class="col-sm-4 col-form-label">กลางฟัน:</h4>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text" id="shade_many2" name="many_branch_Middle" value={{ $out_data_all->many_branch_Middle }}  placeholder="ยี่ห้อ">                                                                                    &nbsp;
                                                    <input class="form-control" type="text" id="color2" name="many_color_Middle" value={{ $out_data_all->many_color_Middle }}  placeholder="สี">
                                                </div>
                                            </div>
                                            &nbsp;
                                            <div class="row">
                                                <h4 class="col-sm-4 col-form-label">ปลายฟัน:</h4>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="text" id="shade_many3" name="many_branch_tip" value={{ $out_data_all->many_branch_tip }}  placeholder="ยี่ห้อ">                                                                                    &nbsp;
                                                    <input class="form-control" type="text" id="color3" name="many_color_tip" value={{ $out_data_all->many_color_tip }} placeholder="สี">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3" for="comment_shade">รอถามแพทย์</label>
                                <div class="col-sm-8">
                                        {{ Form::textarea('comment_shade',$out_data_all->comment_shade, ['class' => 'form-control','placeholder' => 'ระบุ' , 'cols'=>"66" , 'rows'=>"6"]) }}
                                </div>
                            </div>
                </div>
            </div>
        </div>


        {{-- 6 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;10.&nbsp;IMPLANT</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="checkbox-toolbar1 text-center">
                        <div class="row" style="over-flow:auto;">
                            @foreach($data_implant as $out_data_implant)
                                @if($out_data_implant->topic == 'IMPRESSION')
                                    <input type="checkbox" id="IMP1" name="IMP1" value="IMPRESSION" checked>
                                @else
                                    <input type="checkbox" id="IMP1" name="IMP1" value="IMPRESSION">
                                @endif
                                    <label for="IMP1" style="cursor:pointer;">IMPRESSION</label>

                                @if($out_data_implant->topic == 'IMPRESSION CAP')
                                    <input type="checkbox" id="IMP2" name="IMP2" value="IMPRESSION CAP" checked>
                                @else
                                    <input type="checkbox" id="IMP2" name="IMP2" value="IMPRESSION CAP">
                                @endif
                                    <label for="IMP2" style="cursor:pointer;">IMPRESSION CAP</label>

                                @if($out_data_implant->topic == 'SCREW')
                                    <input type="checkbox" id="IMP3" name="IMP3" value="SCREW" checked>
                                @else
                                    <input type="checkbox" id="IMP3" name="IMP3" value="SCREW">
                                @endif
                                    <label for="IMP3" style="cursor:pointer;">SCREW</label>

                                @if($out_data_implant->topic == 'ANALOG')
                                    <input type="checkbox" id="IMP4" name="IMP4" value="ANALOG" checked>
                                @else
                                    <input type="checkbox" id="IMP4" name="IMP4" value="ANALOG">
                                @endif
                                    <label for="IMP4" style="cursor:pointer;">ANALOG</label>

                                @if($out_data_implant->topic == 'ABUTMENT')
                                    <input type="checkbox" id="IMP5" name="IMP5" value="ABUTMENT" checked>
                                @else
                                    <input type="checkbox" id="IMP5" name="IMP5" value="ABUTMENT">
                                @endif
                                    <label for="IMP5" style="cursor:pointer;">ABUTMENT</label>

                                @if($out_data_implant->topic == 'SCREW DRIVER')
                                    <input type="checkbox" id="IMP6" name="IMP6" value="SCREW DRIVER" checked>
                                @else
                                    <input type="checkbox" id="IMP6" name="IMP6" value="SCREW DRIVER">
                                @endif
                                    <label for="IMP6" style="cursor:pointer;">SCREW DRIVER</label>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>

        {{-- 10 --}}
        <div class="col-6 grid-margin">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                    <li class="breadcrumb-item active" aria-current="page">&nbsp;&nbsp;&nbsp;&nbsp;11.&nbsp;MARGIN AND MENTAL DESIGN</li>
                </ol>
                <div class="card">
                    <div class="card-body">
                            <div class="text-center">
                                    <div class="row" style="over-flow:auto;">
                                        <div class="row card-body border">
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN1 == '11.png')
                                                    <input type="radio" name="MARGIN1" id="MARGIN1" class="input-hidden" value="11.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN1" id="MARGIN1" class="input-hidden" value="11.png" />
                                                @endif
                                                    <label for="MARGIN1" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/11.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN1 == '12.png')
                                                    <input type="radio" name="MARGIN1" id="MARGIN2" class="input-hidden" value="12.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN1" id="MARGIN2" class="input-hidden" value="12.png" />
                                                @endif
                                                    <label for="MARGIN2" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/12.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN1 == '13.png')
                                                    <input type="radio" name="MARGIN1" id="MARGIN3" class="input-hidden" value="13.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN1" id="MARGIN3" class="input-hidden" value="13.png"/>
                                                @endif
                                                    <label for="MARGIN3" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/13.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN1 == '14.png')
                                                    <input type="radio" name="MARGIN1" id="MARGIN4" class="input-hidden" value="14.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN1" id="MARGIN4" class="input-hidden" value="14.png" />
                                                @endif
                                                    <label for="MARGIN4" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/14.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row card-body border">
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN2 == '21.png')
                                                    <input type="radio" name="MARGIN2" id="sad4" class="input-hidden" value="21.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN2" id="sad4" class="input-hidden" value="21.png" />
                                                @endif
                                                    <label for="sad4" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/21.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN2 == '22.png')
                                                    <input type="radio" name="MARGIN2" id="sad5" class="input-hidden" value="22.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN2" id="sad5" class="input-hidden" value="22.png"/>
                                                @endif
                                                    <label for="sad5" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/22.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN2 == '23.png')
                                                    <input type="radio" name="MARGIN2" id="sad6" class="input-hidden" value="23.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN2" id="sad6" class="input-hidden" value="23.png" />
                                                @endif
                                                    <label for="sad6" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/23.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN2 == '24.png')
                                                    <input type="radio" name="MARGIN2" id="sad7" class="input-hidden" value="24.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN2" id="sad7" class="input-hidden" value="24.png" />
                                                @endif
                                                    <label for="sad7" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/24.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN2 == '25.png')
                                                    <input type="radio" name="MARGIN2" id="sad8" class="input-hidden" value="25.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN2" id="sad8" class="input-hidden" value="25.png" />
                                                @endif
                                                    <label for="sad8" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/25.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN2 == '26.png')
                                                    <input type="radio" name="MARGIN2" id="sad9" class="input-hidden" value="26.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN2" id="sad9" class="input-hidden" value="26.png" />
                                                @endif
                                                    <label for="sad9" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/26.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN2 == '27.png')
                                                    <input type="radio" name="MARGIN2" id="sad10" class="input-hidden" value="27.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN2" id="sad10" class="input-hidden" value="27.png" />
                                                @endif
                                                    <label for="sad10" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/27.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row card-body border ">
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN3 == '31.png')
                                                    <input type="radio" name="MARGIN3" id="sad11" class="input-hidden" value="31.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN3" id="sad11" class="input-hidden" value="31.png" />
                                                @endif
                                                    <label for="sad11" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/31.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN3 == '32.png')
                                                    <input type="radio" name="MARGIN3" id="sad12" class="input-hidden" value="32.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN3" id="sad12" class="input-hidden" value="32.png"/>
                                                @endif
                                                    <label for="sad12" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/32.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN3 == '33.png')
                                                    <input type="radio" name="MARGIN3" id="sad13" class="input-hidden" value="33.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN3" id="sad13" class="input-hidden" value="33.png" />
                                                @endif
                                                    <label for="sad13" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/33.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN3 == '34.png')
                                                    <input type="radio" name="MARGIN3" id="sad14" class="input-hidden" value="34.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN3" id="sad14" class="input-hidden" value="34.png" />
                                                @endif
                                                    <label for="sad14" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/34.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                            <div class="col-2">
                                                @if($out_data_all->MARGIN3 == '35.png')
                                                    <input type="radio" name="MARGIN3" id="sad15" class="input-hidden" value="35.png" checked/>
                                                @else
                                                    <input type="radio" name="MARGIN3" id="sad15" class="input-hidden" value="35.png" />
                                                @endif
                                                    <label for="sad15" style="cursor:pointer;">
                                                        <img class="pontic" src="{{ asset('images/mental-design/35.png') }}" alt="I'm sad" />
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <br>
                    <br>
                </div>
            </nav>
        </div>

        <div class="col-sm-12 text-right">
            @if( $count != 0)
                <input type="hidden" name="checkjob" value="0">
                <button type="submit" class="btn btn-lg btn-success">
                    บันทึก
                </button>
            @endif

            @if( $count == 0)
                <input type="hidden" name="checkjob" value="1">
                <a href="{{ url('mainscreen')}}">
                    <button type="submit" class="btn btn-lg btn-success">
                        จบการ screen
                    </button>
                </a>
            @endif
        </div>

    </div>
    
    {{ Form::close() }}
    @endforeach
</div>

@stop

@section('scripts')
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">


        function exFunction() {
            var ex4_detail = document.getElementById("ex4_detail");
            var ex8_detail = document.getElementById("ex8_detail");
            var ex9_detail = document.getElementById("ex9_detail");
            var ex10_detail = document.getElementById("ex10_detail");
            var ex4 = document.getElementById("ex4");
            var ex8= document.getElementById("ex8");
            var ex9 = document.getElementById("ex9");
            var ex10 = document.getElementById("ex10");

            if (ex4.checked == true){
                ex4_detail.style.display = "block";
            }

            if (ex4.checked != true){
                ex4_detail.style.display = "none";
            }

            if (ex8.checked == true){
                ex8_detail.style.display = "block";
            }

            if (ex8.checked != true){
                ex8_detail.style.display = "none";
            }

            if (ex9.checked == true){
                ex9_detail.style.display = "block";
            }

            if (ex9.checked != true){
                ex9_detail.style.display = "none";
            }

            if (ex10.checked == true){
                ex10_detail.style.display = "block";
            }

            if (ex10.checked != true){
                ex10_detail.style.display = "none";
            }

        }

        function RQFunction() {
            var RQ1_detail = document.getElementById("RQ1_detail");
            var RQ2_detail = document.getElementById("RQ2_detail");
            var RQ3_detail = document.getElementById("RQ3_detail");
            var RQ4_detail = document.getElementById("RQ4_detail");
            var RQ5_detail = document.getElementById("RQ5_detail");
            var RQ6_detail = document.getElementById("RQ6_detail");
            var RQ1 = document.getElementById("RQ1");
            var RQ2 = document.getElementById("RQ2");
            var RQ3 = document.getElementById("RQ3");
            var RQ4 = document.getElementById("RQ4");
            var RQ5 = document.getElementById("RQ5");
            var RQ6 = document.getElementById("RQ6");

            if (RQ1.checked == true){
                RQ1_detail.style.display = "block";
            }

            if (RQ1.checked != true){
                RQ1_detail.style.display = "none";
            }

            if (RQ2.checked == true){
                RQ2_detail.style.display = "block";
            }

            if (RQ2.checked != true){
                RQ2_detail.style.display = "none";
            }

            if (RQ3.checked == true){
                RQ3_detail.style.display = "block";
            }

            if (RQ3.checked != true){
                RQ3_detail.style.display = "none";
            }

            if (RQ4.checked == true){
                RQ4_detail.style.display = "block";
            }

            if (RQ4.checked != true){
                RQ4_detail.style.display = "none";
            }

            if (RQ5.checked == true){
                RQ5_detail.style.display = "block";
            }

            if (RQ5.checked != true){
                RQ5_detail.style.display = "none";
            }

            if (RQ6.checked == true){
                RQ6_detail.style.display = "block";
            }

            if (RQ6.checked != true){
                RQ6_detail.style.display = "none";
            }
        }

        function CERAMAGEFunctions() {
            var CardCERAMAGE = document.getElementById("CardCERAMAGE");
            var CardScrew = document.getElementById("CardScrew");
            var IMPLANT1 = document.getElementById("IMPLANT1");
            var IMPLANT2 = document.getElementById("IMPLANT2");
            var IMPLANT3 = document.getElementById("IMPLANT3");
            var IMPLANT4 = document.getElementById("IMPLANT4");
            var IMPLANT5 = document.getElementById("IMPLANT5");
            var IMPLANT6 = document.getElementById("IMPLANT6");
            var IMPLANT7 = document.getElementById("IMPLANT7");

            if (IMPLANT1.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT2.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT3.checked == true){
                CardCERAMAGE.style.display = "block";
                CardScrew.style.display = "none";
            }

            if (IMPLANT4.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT5.checked == true){
                CardScrew.style.display = "block";
                CardCERAMAGE.style.display = "none";
            }

            if (IMPLANT6.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }

            if (IMPLANT7.checked == true){
                CardCERAMAGE.style.display = "none";
                CardScrew.style.display = "none";
            }
        }

        function MODELFunctions() {
            var CardRESIN = document.getElementById("CardRESIN");
            var MODEL1 = document.getElementById("MODEL2");
            var MODEL2 = document.getElementById("MODEL1");
            if (MODEL1.checked == true){
                CardRESIN.style.display = "block";
            }
            else {
                CardRESIN.style.display = "none";
            }
            if(MODEL2.checked == true){
                CardRESIN.style.display = "none";
            }
        }

        function HookFunction() {
            var OptionHook = document.getElementById("OptionHook");
            var checkBox = document.getElementById("chkPassport");
            var nochkPassport = document.getElementById("nochkPassport");
            if (checkBox.checked == true){
                OptionHook.style.display = "block";
            }
            else {
                OptionHook.style.display = "none";
            }
            if(nochkPassport.checked == true){
                OptionHook.style.display = "none";
            }
        }
        function ContourFunction(){
            var radiosomsanit = document.getElementById("radiosomsanit");
            var undercut = document.getElementById("undercut");

             if(radioUNDER.checked == true){
                undercut.style.display = "flex";
            }
            if(radiosomsanit.checked == true){
                undercut.style.display = "none";
            }
        }

        function ShadeFunction(){
            var radioOne = document.getElementById("radioOne");
            var radiomulti = document.getElementById("radiomulti");
            var CardOneColor = document.getElementById("CardOneColor");
            var CardMultiColor = document.getElementById("CardMultiColor");
            var radioVITA_AD = document.getElementById("radioVITA_AD");
            var radioVITA_3D = document.getElementById("radioVITA_3D");
            var radioSHOFU = document.getElementById("radioSHOFU");
            var radioCHOMASCOP = document.getElementById("radioCHOMASCOP");
            var radioAnother = document.getElementById("radioAnother");
            var CardChooseColor = document.getElementById("CardChooseColor");
            var CardAnotherColor = document.getElementById("CardAnotherColor");
            if(radioOne.checked == true){
                CardOneColor.style.display = "flex";
                CardMultiColor.style.display = "none";
                if(radioVITA_AD.checked == true || radioVITA_3D.checked == true || radioSHOFU.checked == true || radioSHOFU.checked == true || radioCHOMASCOP.checked == true){
                    CardChooseColor.style.display = "flex";
                    CardAnotherColor.style.display = "none";
                }
                else if(radioAnother.checked == true){
                    CardAnotherColor.style.display = "flex";
                    CardChooseColor.style.display = "none";
                }
            }
            if(radiomulti.checked == true){
                CardMultiColor.style.display = "flex";
                CardChooseColor.style.display = "none";
                CardAnotherColor.style.display = "none";
                CardOneColor.style.display = "none";
            }
        }
        function myFunctions() {
          var x = document.getElementById("myDIV");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
        }

        function exFunction123(){

            var ex4 = document.getElementById("ex4");
            var ex4_details = document.getElementById("ex4_details");

            var ex8  = document.getElementById("ex8");
            var phone = document.getElementById("phone");
            var Ex8_detail2s = document.getElementById("Ex8_detail2s");

            var ex9 = document.getElementById("ex9");
            var ex9_details = document.getElementById("ex9_details");

            var ex10 = document.getElementById("ex10");
            var ex10_detail = document.getElementById("ex10_detail");

            if(document.getElementById("ex4").checked == true)
            {
                ex4_details.readOnly = false;
                //เปิด
            }
            if(document.getElementById("ex4").checked == false)
            {
                ex4_details.readOnly = true;
                $('#ex4_details').val('');
                //ปิด
            }

            if(document.getElementById("ex8").checked == true)
            {
                phone.readOnly = false;
                document.getElementById("Ex8_detail2s").disabled = false;
                //เปิด
            }
            if(document.getElementById("ex8").checked == false)
            {
                phone.readOnly = true;
                document.getElementById("Ex8_detail2s").disabled = true;

                $('#phone').val('');
                //ปิด
            }

            if(document.getElementById("ex9").checked == true)
            {
                ex9_details.readOnly = false;
                //เปิด
            }
            if(document.getElementById("ex9").checked == false)
            {
                ex9_details.readOnly = true;
                $('#ex9_details').val('');
                //ปิด
            }

            if(document.getElementById("ex10").checked == true)
            {
                ex10_detail.readOnly = false;
                //เปิด
            }
            if(document.getElementById("ex10").checked == false)
            {
                ex10_detail.readOnly = true;
                $('#ex10_detail').val('');
                //ปิด
            }

        }

        function exFunction3(){

            var RQ1_NUM = document.getElementById("RQ1_NUM");
            var RQ1_DETAIL = document.getElementById("RQ1_DETAIL");

            var ex8  = document.getElementById("ex8");
            var phone = document.getElementById("phone");
            var Ex8_detail2s = document.getElementById("Ex8_detail2s");

            var ex9 = document.getElementById("ex9");
            var ex9_details = document.getElementById("ex9_details");

            var ex10 = document.getElementById("ex10");
            var ex10_detail = document.getElementById("ex10_detail");


            if(document.getElementById("RQ1").checked == true)
            {
                RQ1_NUM.readOnly = false;
                RQ1_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ1").checked == false)
            {
                RQ1_NUM.readOnly = true;
                RQ1_DETAIL.readOnly = true;

                $('#RQ1_NUM').val('');
                $('#RQ1_DETAIL').val('');
                //ปิด
            }
            if(document.getElementById("RQ2").checked == true)
            {
                RQ2_NUM.readOnly = false;
                RQ2_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ2").checked == false)
            {
                RQ2_NUM.readOnly = true;
                RQ2_DETAIL.readOnly = true;

                $('#RQ2_NUM').val('');
                $('#RQ2_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ3").checked == true)
            {
                RQ3_NUM.readOnly = false;
                RQ3_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ3").checked == false)
            {
                RQ3_NUM.readOnly = true;
                RQ3_DETAIL.readOnly = true;

                $('#RQ3_NUM').val('');
                $('#RQ3_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ4").checked == true)
            {
                RQ4_NUM.readOnly = false;
                RQ4_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ4").checked == false)
            {
                RQ4_NUM.readOnly = true;
                RQ4_DETAIL.readOnly = true;

                $('#RQ4_NUM').val('');
                $('#RQ4_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ5").checked == true)
            {
                RQ5_NUM.readOnly = false;
                RQ5_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ5").checked == false)
            {
                RQ5_NUM.readOnly = true;
                RQ5_DETAIL.readOnly = true;

                $('#RQ5_NUM').val('');
                $('#RQ5_DETAIL').val('');
                //ปิด
            }

            if(document.getElementById("RQ6").checked == true)
            {
                RQ6_NUM.readOnly = false;
                RQ6_DETAIL.readOnly = false;
                //เปิด
            }
            if(document.getElementById("RQ6").checked == false)
            {
                RQ6_NUM.readOnly = true;
                RQ6_DETAIL.readOnly = true;

                $('#RQ6_NUM').val('');
                $('#RQ6_DETAIL').val('');
                //ปิด
            }

        }

        $('#radioOpen').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radioClose').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radiosomsanit').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radioAREA').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });
        $('#radioPOINT').click(function() {
            $('#unit_CONTOUR').val('non_unit_CONTOUR');
        });

        $('#radiomulti').click(function() {
            $('input[name=one_color]').prop('checked', false);
            $('input[name=one_color_Combobox]').prop('checked', false);
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioVITA_AD').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioVITA_3D').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioSHOFU').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioCHOMASCOP').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });
        $('#radioAnother').click(function() {
            $('#brand').val('');
            $('#color').val('');
        });


        $('#nochkPassport').click(function() {
            $('input[name=MESIAL_REST]').prop('checked', false);
            $('input[name=DISTAL_REST]').prop('checked', false);
            $('input[name=CINGULUM_REST]').prop('checked', false);
            $('input[name=LINGUAL_LEDGE]').prop('checked', false);
            $('input[name=EMBRESSURE_REST]').prop('checked', false);
            $('input[name=other_hook]').prop('checked', false);
            $('#another').val('');
            $('#undercut_hook').val('defaultunit');
            $('#unit_hook').val('defaultunit');
        });

        $(document).ready(function(){
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                Ex8_detail2s
                $("#startdate").datepicker({
                    todayBtn:  1,
                    autoclose: true,

                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('#enddate').datepicker('setStartDate', minDate);
                    $('#datefinal').datepicker('setStartDate', minDate);
                });

                $("#enddate").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
                $('#datefinal').datepicker('setStartDate', minDate);
                });

                $("#datefinal").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
                });

                $("#Ex8_detail2s").datepicker({
                    todayBtn:  1,
                    autoclose: true,

                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                });
                $( '#Ex8_detail2s' ).datepicker( 'setDate',today);
                $( '#startdate,#enddate, #datefinal' ).datepicker( 'setDate' );

            });
        $("#phone").inputmask({"mask": "(999) 999-9999"});
</script>



@stop
