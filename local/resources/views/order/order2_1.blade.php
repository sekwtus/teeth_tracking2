@extends('layouts.template')
@section('title', 'สร้างงาน')
@section('stylesheet')
<style>
    .button1 {
        display: inline-block;
        background-color: #ddd;
        width: 30%;
        height: 15%;
        padding: 20px;
        font-size: 12px;
        cursor: pointer;
        border: none;
        margin: 3px;
    }

    .button1:hover {
        background-color: #19d895;
        color: white;
    }

    /* #myInput {
                        background-image: url('/css/searchicon.png');
                        background-position: 10px 12px;
                        background-repeat: no-repeat;
                        width: 50%;

                        font-size: 14px;
                        padding: 12px 20px 12px 40px;
                        border: 1px solid #ddd;
                        margin-bottom: 10px;
                        } */
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
                        <div class="col-11 p-0 text-left">
                            <h4>สร้างรายการใหม่</h4>
                        </div>
                        @include('order.barcode_cancel')
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 m-0 step-timeline">
                            <ul class="m-0 step-list">
                                <li>บันทึกรหัสสั่งผลิต (Barcode)</li>
                                <li class="yellow">ข้อมูลลูกค้า & คนไข้</li>
                                <li class="white">เลือกแลปที่ผลิต</li>
                                {{-- <li class="white">สิ่งที่ส่งมาด้วย</li> --}}
                                <li class="white">ตรวจสอบข้อมูล & บันทึก</li>
                            </ul>
                        </div>
                        <div class="col-md-9 step-content">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                            <li class="breadcrumb-item active" aria-current="page">เลือกประเภทลูกค้า</li>
                                        </ol>
                                    </nav>
                                    <div class="accordion basic-accordion" role="tablist">
                                        <div class="card">
                                            <div class="card-header" role="tab" id="orderRequestTypeID">
                                                <h6 class="mb-0">
                                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>
                                                        ประเภทลูกค้า
                                                    </a>
                                                </h6>
                                            </div>



                                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                                <div class="card-body">

                                                    <div id="myUL" class="checkbox-toolbar">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            </div>
                                                            <div class="col-sm-3">
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                                                        </div>
                                                                        <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาประเภทลูกค้า" title="Type in a name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        @foreach($customer_type_all as $out_customer_type_all)
                                                        <a href="{{ url('order2/').'/'.$out_customer_type_all->id }}">
                                                            <button type="button" class="button1">
                                                                {{ $out_customer_type_all->name }}
                                                            </button>
                                                        </a>
                                                        @endforeach
                                                    </div>
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
                            <a href="javascript:history.go(-1)">
                    <button type="button" class="btn btn-lg btn-success">
                        <i class="mdi mdi-arrow-left-bold"></i>
                        ย้อนกลับ
                    </button>
                </a>
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
            $('#example').DataTable();
        } );
</script>

<script>
    function myFunction() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                li = ul.getElementsByTagName("a");
                for (i = 0; i < li.length; i++) {
                    a = li[i].getElementsByTagName("button")[0];
                    txtValue = a.textContent || a.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        li[i].style.display = "";
                    } else {
                        li[i].style.display = "none";
                    }
                }
            }
</script>


@stop
