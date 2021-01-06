@extends('layouts.template')

@section('title', 'ผลิต')

@section('stylesheet')

<style>
    table {
        font-size: 13px;
    }
</style>

<style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>
<style>
    /* The container */
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 15px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: grey;
        border-radius: 210px;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    /* .dataTables_wrapper {
        position: relative;
        clear: both;
        width: auto;
        min-height : 150 px;
        margin-left: 0px;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        background-color: #9D9C9D;
        zoom: 1;
        } */
</style>
@stop

@section('content')

<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                        <div class="tab-content tab-content-basic">
                                {{-- <div class="row">
                                    <div class="col-lg-2"><h6>ค้นหาลูกค้า : </h6></div>
                                    <div class="col-lg-2"><h6>ค้นหาทันตแพทย์ : </h6></div>
                                    <div class="col-lg-2"><h6>ค้นหาพื้นที่ : </h6></div>
                                    <div class="col-lg-2"><h6>ค้นหาเขต : </h6></div>
                                    <div class="col-lg-2"><h6>ค้นหาประเภทงาน(สินค้า) : </h6></div>
                                    <div class="col-lg-2"><h6>ค้นหาสถานะงาน : </h6></div>

                                </div> --}}

                                <form action="" id='frmMain' method="get">
                                    {{-- {{ csrf_field() }} --}}
                                    <div class="row">
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <h6 for="bracode">ค้นหาบาร์โค๊ด : </h6>
                                                <input type="text" class="form-control" name="bracode" id="bracode"style="padding: 0px; height: 30px;" value='{{ (($_GET["bracode"])) ? ($_GET["bracode"]) : ('')}}' />
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <h6 for="dentist">ค้นหาทันตแพทย์ : </h6>
                                                    <input type="text" class="form-control" name="dentist" id="dentist"style="padding: 0px; height: 30px;" value='{{ (($_GET["dentist"])) ? ($_GET["dentist"]) : ('')}}' />
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                
                                                <div class="form-group">
                                                    <h6 for="search_zone">ค้นหาพื้นที่ : </h6>
                                                    <input type="text" class="form-control" name="search_zone" id="search_zone"style="padding: 0px; height: 30px;" value='{{ (($_GET["search_zone"])) ? ($_GET["search_zone"]) : ('')}}' />
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <h6 for="search_PatientName">ค้นหาคนไข้ : </h6>
                                                    <input type="text" class="form-control" name="search_PatientName" id="search_PatientName"style="padding: 0px; height: 30px;" value='{{ (($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('')}}'/>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group">
                                                    <h6 for="search_area">ค้นหาเขต : </h6>
                                                    <input type="text" class="form-control" name="search_area" id="search_area"style="padding: 0px; height: 30px;" value='{{ (($_GET["search_area"])) ? ($_GET["search_area"]) : ('')}}'/>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-2"> 
                                                <div class="form-group">
                                                    <h6 for="search_work_type">ค้นหาประเภทงาน(สินค้า) : </h6>
                                                    <input type="text" class="form-control" name="search_work_type" id="search_work_type"style="padding: 0px; height: 30px;" value='{{ (($_GET["search_work_type"])) ? ($_GET["search_work_type"]) : ('')}}' />
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-lg-2">
                                                <div class="form-group">
                                                    <h6 for="search_depart">ค้นหาสถานะงาน : </h6>
                                                    <input type="text" class="form-control" name="search_depart" id="search_depart"style="padding: 0px; height: 30px;" value='{{ (($_GET["search_depart"])) ? ($_GET["search_depart"]) : ('')}}' />
                                                </div>
                                            </div> --}}
                                        </div>
                                <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-2"><button type="text" id="btnFiterSubmitSearch" style="float: right; width: 100px" right="50px">ค้นหา</button></div>
                                </div>
                                 </form>
                                <br>


                    <table id="table_packed" class=" table-striped table-bordered display compact nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>No.</th> --}}
                                <th>บาร์โค้ด</th>
                                <th>ทันตแพทย์</th>
                                <th>คนไข้</th>
                                <th>เขต</th>
                                <th>พื้นที่</th>
                                <th>วันที่จัดส่ง</th>
                                <th>เวลาที่จัดส่ง</th>
                                <th>สถานะ</th>
                                <th>สาขาที่ผลิต</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


@stop
@section('scripts')

<script src="{{ asset('./js/shared/alerts.js') }}"></script>
<script src="{{ asset('./js/shared/avgrund.js') }}"></script>

<script>
    $(document).ready(function(){
        $('#search_customer').focus();
    });
</script>

<script>
    $(function() {
          $('#table_packed').DataTable({
          processing: true,
        //   serverSide: true,
          paging: true,
        //   ajax: '{{ url('/table/order_packed_90day') }}',
        ajax: {
                    url : "{{ url('/table/order_packed_90day') }}",
                    // type : 'GET',
                    data : function (d) {
                            d.bracode = $('#bracode').val();
                            d.search_zone = $('#search_zone').val();
                            d.search_area = $('#search_area').val();
                            // d.search_work_type = $('#search_work_type').val();
                            d.dentist = $('#dentist').val();
                            d.search_PatientName = $('#search_PatientName').val();
                        }
           },
          columns: [
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'doctor_name', name: 'doctor_name' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'Area', name: 'Area' },
                   { data: 'zone', name: 'zone' },
                   { data: 'updated_at', name: 'updated_at' },
                   { data: 'updated_at', name: 'updated_at' },
                   { data: 'job_current_department', name: 'job_current_department' },
                   { data: 'branch', name: 'branch' },
                //    { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        "targets": 0,
                        render: function(data, type, row) {
                        return '<a href="../summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                         }
                    },
                    {
                        "targets": 1,
                    },
                    {
                        "targets": 2,
                    },
                    {
                        "targets": 3,
                    },
                    {
                        "targets": 4,
                    },
                    {
                    "targets": 5, render(data,type,row){
                        // 2019-09-11 10:50:12
                        var data = data.substring(8,10) +'/'+ data.substring(5,7) +'/'+ data.substring(0,4);
                        return data;
                    },
                    "className": "text-center",
                    },
                    {
                        "targets": 6, render(data,type,row){
                            // 2019-09-11 10:50:12
                            var data = data.substring(11,16);
                            return data + ' น.';
                        },
                        "className": "text-center",
                    },
                    {
                        "targets": 7, render(data,type,row){
                                return '<label class="badge badge-outline-primary badge-pill">จัดส่งเรียบร้อย</label>';
                        },
                        "className": "text-center"
                    },
                    {
                        "targets": 8,
                    },
                ],
                "order": []
       });
    });

</script>


@stop
