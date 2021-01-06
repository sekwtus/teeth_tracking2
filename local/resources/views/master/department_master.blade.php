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
                            <h4 class="">Master Product</h4>
                        </div>
                    </div>
                    <div class="row border" style="overflow-x:auto; max-width: 100%;">
                    <div class="col-12 p-0 text-center">
                        <h4>แผนกปูน</h4>
                    </div>
                    </div>
                    <div class="row border" style="overflow-x:auto; max-width: 100%;">
                        <div class="col-4 text-center border">
                            <button class="btn">รับงาน</button>
                        </div>
                        <div class="col-4 text-center border">
                            <button class="btn">แจกงาน</button>
                        </div>
                        <div class="col-4 text-center border">
                            <button class="btn">QC</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 border">
                            <div class="row" style="margin:10px;">
                                <div  class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Product</th>
                                                <th>Sale</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="margin:10px;">
                                <div  class="table-responsive">
                                    <table class="table table-striped" id="example">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Product</th>
                                                <th>Sale</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card" style="height:auto;">
                                <div class="card-body">
                                    <h4 class="card-title">QC-Checklist</h4>
                                    <div class="template-demo">
                                        <form id="editable-form" class="editable-form">
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.1-โมเดลสมบูรณ์ (เต็ม, ไม่มีบับเบิ้ล, ไม่พรุน)</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.2-ปาดเหงือกถูกต้อง</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.3-ตัดไม่โดนอบัตเมนต์</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.4-ขอบดายไม่บล็อคซีเมนต์</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.5-แต่งดายถูกต้อง</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.6-ดาย 2 สเต็ปส่งโทรก่อน</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.7-จับสบถูกต้องใช้ไบ้ท์ประกอบ</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.8-เข้าตรงมิดไลน์ เพลนไม่เอียง</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.8-เข้าตรงมิดไลน์ เพลนไม่เอียง</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.9-สบฟันไม่เคลื่อน</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.10-สบฟันถูกต้อง ก้านไม่หลุด</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-12 col-form-label">2.11-ทำถูกต้องต้องใบสั่งงาน</label>
                                            </div>
                                        </form>
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
@stop

@section('scripts')
<script>
$(document).ready(function() {
	// DataTable initialisation
    $('#example').DataTable();
});
</script>
@stop