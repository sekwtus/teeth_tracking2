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
        background-color: black;
        border-color: #19d895;
    }
    /* End Check Box */
    /*Tooth*/
    #tooth-check{
        display: none;
    }
    .tooth-chart{
        width:80%;
        margin: auto;
    }
    #tooth-lbl > text{
        font-family: 'Avenir-Heavy';
    }
    polygon, path{
        -webkit-transition:fill .25s;
        transition:fill .25s;
    }
    polygon:hover, polygon:active, #tooth-polygon>path:hover, #tooth-polygon>path:active{
        fill:red !important;
        cursor: pointer;
    }
    /*End Tooth*/

    input[type=checkbox]{
        display: none;
    }
    .lbl{
        border:1px solid;
        border-radius: 50%;
        cursor: pointer;
        width: 25px;
        height: 25px;
    }
    .lbl:hover{
        opacity: 0.5;
    }
    .check {
        color: blue;
        background: blue;
    }
    .img-tooth{
        width: 25px;
        height: 25px;
        margin-bottom: 15px;
        margin-right: 15px;
    }
    .tbl-tooth {
        margin: auto;
    }
    /* The container */
    .select{
        color: #FFE000;
        background: #FFE000;
    }
    .selected{
        color: #00D413;
        background: #00D413;
    }
    .input-hidden {
        display: none;
    }
    .pontic{
        border: 0px dashed #444;
        width: 75px;
        height: 75px;
        transition: 500ms all;
    }
    .margin{
        border: 0px dashed #444;
        width: 50px;
        height: 50px;
        margin: 5px;
        transition: 500ms all;
    }
/*    --------------------------------------------------
:: General
-------------------------------------------------- */
body {
	font-family: 'Open Sans', sans-serif;
	color: #353535;
}
.content h1 {
	text-align: center;
}
.content .content-footer p {
	color: #6d6d6d;
    font-size: 12px;
    text-align: center;
}
.content .content-footer p a {
	color: inherit;
	font-weight: bold;
}

/*	--------------------------------------------------
	:: Table Filter
	-------------------------------------------------- */
.panel {
	border: 1px solid #ddd;
	background-color: #fcfcfc;
}
.panel .btn-group {
	margin: 15px 0 30px;
}
.panel .btn-group .btn {
	transition: background-color .3s ease;
}
.table-filter {
	background-color:white;
	border-bottom: 1px solid #eee;
}
.table-filter tbody tr:hover {
	cursor: pointer;
	background-color:#ccc;
}
.table-filter tbody tr td {
	padding: 10px;
	vertical-align: middle;
	border-top-color: #eee;
}
.table-filter tbody tr.selected td {
	background-color:#4CDE90;
}
.table-filter tr td:first-child {
	width: 38px;
}
.table-filter tr td:nth-child(2) {
	width: 35px;
}
.table-filter .media-photo {
	width: 35px;
}
.table-filter .media-body {
    display: block;
    /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
}
.table-filter .media-meta {
	font-size: 11px;
	color: #999;
}
.table-filter .media .title {
	color: #2BBCDE;
	font-size: 14px;
	font-weight: bold;
	line-height: normal;
	margin: 0;
}
</style>
<script>
    function OnLoad(n){
        setTimeout(function() {
            $(".img-tooth-"+n).addClass('img-tooth');
            $('#lbl_green_'+n).addClass('lbl_green_'+n);
            $('#lbl_green_'+n).addClass('select');
        }, 10);
    }
    function select(n){
        setTimeout(function() {
            $('#lbl_green_'+n).addClass('selected');
        }, 10);
    }
</script>
@stop

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header header-sm">
                        <div class="align-items-center">
                            <div class="media-info">
                                <label class="card-title font-weight-bold">รายการงานทั้งหมด</label>
                            </div>
                        </div>
                    </div>
                <!--data table-->
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รหัส</th>
                                    <th>ชื่อแลป</th>
                                    <th>ประเภท</th>
                                    <th>ชื่อคลินิก/รพ.</th>
                                    <th>ชื่อแพทย์</th>
                                    <th>ชื่อคนไข้</th>
                                    {{-- <th>วันเวลารับ</th> 
                                    <th>วันเวลาสั่ง</th>
                                    <th>สถานะ</th>--}}
                                    <th>รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>QA1234</td>
                                    <td>PCDental Lab</td>
                                    <td>คลินิก</td>
                                    <td>คลินิกทันตกรรม วีแรนด้า</td>
                                    <td>ทญ.นพรัตน์ เบิกฟ้า </td>
                                    <td>นายทดสอบ ระบบ</td>
                                    {{-- <td>17/12/2018</td>
                                    <td>12/02/2019</td>
                                    <td>กำลังทำ</td>--}}
                                    <td>
                                        <button class="btn btn-warning" style="padding:10px;" data-toggle="modal" data-target="#Modal">
                                            แก้ไขข้อมูล
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--end data table-->
                </div>
            </div>
        </div>

        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg" role="document" style="width:50%">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-2">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-container">
                                        <table class="table table-filter">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <button>เลือก</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="title">
                                                                    Lorem Impsum
                                                                </h4>
                                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <button>เลือก</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="title">
                                                                    Lorem Impsum
                                                                </h4>
                                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-radio form-radio-flat">
                                                                <button>เลือก</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="title">
                                                                    Lorem Impsum
                                                                </h4>
                                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <button>เลือก</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="title">
                                                                    Lorem Impsum
                                                                </h4>
                                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <button>เลือก</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <a href="#" class="pull-left">
                                                                <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                                            </a>
                                                            <div class="media-body">
                                                                <h4 class="title">
                                                                    Lorem Impsum
                                                                </h4>
                                                                <p class="summary">Ut enim ad minim veniam, quis nostrud exercitation...</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
        $(document).ready(function() {
            $('#example').DataTable({
                "columnDefs": [
                { "width": "9%", "targets": 0 },
                { "width": "9%", "targets": 1 },
                { "width": "9%", "targets": 2 },
                { "width": "9%", "targets": 3 },
                { "width": "9%", "targets": 4 },
                { "width": "9%", "targets": 5 },
                { "width": "9%", "targets": 6 },
                { "width": "9%", "targets": 7 }
  ]});
        } );

    function check(n){
        if(document.getElementById("lbl_green_"+n).classList.contains("lbl_green_"+n) == true){
            if(document.getElementById("chkTooth_"+n).checked == true)
                document.getElementById("chkTooth_"+n).checked = false;
            else
                document.getElementById("chkTooth_"+n).checked = true;
            $('.lbl_green_'+n).toggleClass('check');
            $('.lbl_green_'+n).toggleClass('select');
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
        var radioNONPRECIOUS = document.getElementById("radioNONPRECIOUS");
        var gingival = document.getElementById("gingival");
        var radioOCCLUSION = document.getElementById("radioOCCLUSION");
        var occlusion = document.getElementById("occlusion");
        var radioUNDER = document.getElementById("radioUNDER");
        var radiosomsanit = document.getElementById("radiosomsanit");
        var undercut = document.getElementById("undercut");
        var radioCONTACT = document.getElementById("radioCONTACT");
        var contact = document.getElementById("contact");

        if(radioNONPRECIOUS.checked == true){
            gingival.style.display = "flex";
            occlusion.style.display = "none";
            contact.style.display = "none";
        }
        if(radioOCCLUSION.checked == true){
            occlusion.style.display = "flex";
            gingival.style.display = "none";
            contact.style.display = "none";
            if(radioUNDER.checked == true){
                undercut.style.display = "flex";
            }
            if(radiosomsanit.checked == true){
                undercut.style.display = "none";
            }
        }
        if(radioCONTACT.checked == true){
            contact.style.display = "flex";
            occlusion.style.display = "none";
            gingival.style.display = "none";
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
    $(document).ready(function () {
            $('.star').on('click', function () {
            $(this).toggleClass('star-checked');
            });

            $('.form-group label').on('click', function () {
            $(this).parents('tr').toggleClass('selected');
            });

            $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
            });
    });
    </script>
@stop
