@extends('layouts.template')


@section('title', 'ติดตามงาน')

@section('stylesheet')
<style>
    table{
        font-size: 13px;
    },
    th{
        text-align:center;

    }
    .hide {
        display: none;
    }
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@stop

@section('content')
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                <div class="row border-bottom">
                    <div class="col-12 p-0 text-left">
                        <h4>งานที่จัดส่งแล้วไม่เกิน 30 วัน</h4>
                    </div>
                </div>
                    <div class="tab-content tab-content-basic">
                        {{-- <div class="row">
                            <div class="col-lg-2"><h6>ค้นหาบาร์โค้ด : </h6></div>
                            <div class="col-lg-2"><h6>ค้นหาลูกค้า : </h6></div>
                            <div class="col-lg-2"><h6>ค้นหาทันตแพทย์ : </h6></div>
                            <div class="col-lg-2"><h6>ค้นหาพื้นที่ : </h6></div>
                            <div class="col-lg-2"><h6>ค้นหาเขต : </h6></div>
                            <div class="col-lg-2"><h6>ค้นหาประเภทงาน(สินค้า) : </h6></div>
                        </div> --}}

                        <form action="work_follower_30day_before" id='frmMain' method="get">
                            {{-- {{ csrf_field() }} --}}
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="bracode">ค้นหาบาร์โค้ด : </h6>
                                    <input type="text" class="form-control" name="bracode" id="bracode"style="padding: 0px; height: 30px;"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="search_customer">ค้นหาลูกค้า : </h6>
                                    <input type="text" class="form-control" name="search_customer" id="search_customer"style="padding: 0px; height: 30px;" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="dentist">ค้นหาทันตแพทย์ : </h6>
                                    <input type="text" class="form-control" name="dentist" id="dentist"style="padding: 0px; height: 30px;" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="search_zone">ค้นหาพื้นที่ : </h6>
                                    <input type="text" class="form-control" name="search_zone" id="search_zone"style="padding: 0px; height: 30px;"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="search_area">ค้นหาเขต : </h6>
                                    <input type="text" class="form-control" name="search_area" id="search_area"style="padding: 0px; height: 30px;"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="search_work_type">ค้นหาประเภทงาน(สินค้า) : </h6>
                                    <input type="text" class="form-control" name="search_work_type" id="search_work_type"style="padding: 0px; height: 30px;"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="search_PatientName">ค้นหาค้นไข้ : </h6>
                                    <input type="text" class="form-control" name="search_PatientName" id="search_PatientName"style="padding: 0px; height: 30px;"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <h6 for="search_depart">ค้นหาสถานะงาน : </h6>
                                    <input type="text" class="form-control" name="search_depart" id="search_depart"style="padding: 0px; height: 30px;"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                {{-- <div class="col-lg-2"><input type="text" class="form-control" name="search_depart" id="search_depart"style="padding: 0px; height: 30px;" /></div> --}}
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-2"><button type="text" id="btnFiterSubmitSearch" style="float: right; width: 100px" right="50px">ค้นหา</button></div>
                        </div>
                         </form>
                        <br>

                        <table id="table2"  class="table-hover table-striped table-bordered display compact " width="100%">
                            <thead>
                                <tr>
                                    {{-- <th style="padding:0%;">ลำดับ</th> --}}
                                    <th style="padding:5px;">No.</th>
                                    <th style="padding:5px;">วันส่ง<br>งาน</th>
                                    <th style="padding:5px;">งาน</th>
                                    <th style="padding:5px;">แลป</th>
                                    <th style="padding:5px;">พื้นที่</th>
                                    <th style="padding:5px;">เขต</th>
                                    <th style="padding:5px;">บาร์โค้ด</th>
                                    <th style="padding:5px;">ทันตแพทย์

                                    </th>
                                    <th style="padding:5px;">รพ./คลีนิค</th>
                                    <th style="padding:5px;">คนไข้</th>
                                    <th style="padding:5px;">H.N.</th>
                                    <th style="padding:5px;">วันที่รับงาน</th>
                                    <th style="padding:5px;">วันที่ส่งงาน</th>
                                    <th style="padding:5px;">เวลาส่งงาน</th>
                                    <th style="padding:5px;">รอบการผลิต</th>
                                    <th>สินค้า</th>
                                    <th style="padding:5px;">ลักษณะงาน</th>
                                    <th style="padding:5px;">งานแก้</th>
                                    <th style="padding:5px;">งานเลื่อน</th>
                                    <th style="padding:5px;">ประเภทงาน</th>
                                    <th>สถานะงาน</th>
                                    <th>สาขาที่ผลิต</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')

<script>
    $(document).ready(function(){
        $('#bracode').focus();
    });
</script>
<script>

    var area = 'ทั้งหมด'
        // $('#search_customer').on('keyup change', function () {
        //         table.column(8).search($(this).val()).draw();
        // });
        // $('#search_area').on('keyup change', function () {
        //         table.column(5).search($(this).val()).draw();
        // });
        // $('#search_work_type').on('keyup change', function () {
        //         table.column(15).search($(this).val()).draw();
        // });
        // $('#search_zone').on('keyup change', function () {
        //         table.column(4).search($(this).val()).draw();
        // });
        // $('#search_depart').on('keyup change', function () {
        //         table.column(20).search($(this).val()).draw();
        // });


        var table =  $('#table2').DataTable({
            lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
            processing: true,
            // serverSide: true,/////
           ajax: '',

            columns: [
                //    { data: 'ID', name: 'ID' },
                   { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'DeliverType', name: 'DeliverType' },
                   { data: 'company_name', name: 'company_name' },
                   { data: 'Zonename', name: 'Zonename' },
                   { data: 'name_area', name: 'name_area' },
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'doctor', name: 'doctor' },
                   { data: 'customer', name: 'customer' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'PatientHN', name: 'PatientHN' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'ReceptionTime', name: 'ReceptionTime' },
                   { data: 'production_cycle', name: 'production_cycle' },
                   { data: 'type_of_product' , name: 'type_of_product'},
                   { data: 'RefBarcode' , name: 'RefBarcode'},
                   { data: 'department' , name: 'department'},
                   { data: 'type_branch_same_sale' , name: 'type_branch_same_sale'},
                //    { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "width": "1%","targets": 0,
                    "className": "text-center",
                },
                {
                    "width": "1%", "targets": 1, render: function(data, type, row)
                    {
                        if(data == null || data == ''){
                            return 'ไม่ระบุวันส่งงาน';
                        }else{
                        var c = data.split('/');
                        var FormatDay =  new Date(c[2],c[1]-1,c[0]);

                        var days = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
                        var daysWeek = days[ FormatDay.getDay() ];

                        if (daysWeek == 'อาทิตย์') {
                            return "<div style='background-color:#FF0000;padding: 2px;'>อา.</div>" ;
                        }else if(daysWeek == 'จันทร์') {
                            return "<div style='background-color:#FFFF00;padding: 2px;'>จ.</div>" ;
                        }else if(daysWeek == 'อังคาร') {
                            return "<div style='background-color:#FF0066;padding: 2px;'>อ.</div>" ;
                        }else if(daysWeek == 'พุธ') {
                            return "<div style='background-color:#32CD32;padding: 2px;'>พ.</div>" ;
                        }else if(daysWeek == 'พฤหัสบดี') {
                            return "<div style='background-color:#FF8C00;padding: 2px;'>พฤ.</div>" ;
                        }else if(daysWeek == 'ศุกร์') {
                            return "<div style='background-color:#1E90FF;padding: 2px;'>ศ.</div>" ;
                        }else if(daysWeek == 'เสาร์') {
                            return "<div style='background-color:#990099;padding: 2px;'>ส.</div>" ;
                        }}
                    },
                    "className": "text-center",
                },
                {
                    "targets": 2,  render: function(data, type, row) {
                        if(data == 'ด่วน' || data == 'ด่วนรับปาก'){
                            return '<div style="background-color:#FF0000;padding: 4px;"><font color="white" >'+data+'</font></div>';
                        }
                        else{
                            return data;
                        }
                    },
                    "className": "text-center",
                    orderable: false,

                },
                {
                    "targets": 3,
                    "className": "text-center",
                    orderable: true,
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5,
                    "className": "text-center",
                },
                {
                    "width": "1%", "targets": 6 , render: function(data, type, row) {
                        return '<a href="./summary_report/'+row["ID"]+'" target="_blank" >'+row["Barcode"]+'</a>';
                    },
                    "className": "text-center",
                },
                {
                    "width": "10%", "targets": 7
                },
                {
                    "targets": 8,
                },
                {
                    "width": "15%",  "targets": 9
                },

                {
                    "targets": 10
                },
                {
                    "targets": 11,render: function(data, type, row) {
                        if(data!= null && data != ''){
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        } else {
                            return null;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 12,  render: function(data, type, row) {
                        if(data!= null && data != ''){
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        } else {
                            return null;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 13
                },
                {
                    "targets": 14,  render: function(data, type, row) {
                        if(data == null || data == ''){
                            return 'ไม่ระบุ';
                        }else{
                            return data;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 15,  render: function(data, type, row) {
                        if(data == null || data == ''){
                            return 'ไม่ระบุ';
                        }else{
                            return data;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 16, render: function(data,type,row){
                        if(row['RefBarcode']){
                            return 'งานแก้';
                        }else if(row['ContiBarcode']){
                            return 'งานต่อเนื่อง';
                        }else{
                            return 'งานใหม่';
                        }
                    }
                },
                {
                    "targets": 17, render: function(data,type,row){return row['work_edit'];}
                },
                {
                    "width": "13%", "targets": 18, render: function(data,type,row){return row['work_late'];}
                },
                {
                    "targets": 19, render: function(data,type,row){return row['OralScan'];},
                    "className": "text-center",
                },
                {
                    "targets": 20, render: function(data,type,row){
                        return '<label class="badge badge-outline-primary badge-pill">'+row['job_current_department']+'</label>';
                        // if (row['department'] == null || row['department'] == '') {
                        //     return '<label class="badge badge-outline-danger badge-pill">รอ Screen</label>';
                        // }else{
                        //     if(row['job_current_department'] == 1000){
                        //         return '<label class="badge badge-outline-primary badge-pill">รอ Screen  - แก้ไขซี่ฟันใหม่</label>';
                        //     }else{
                        //         if (row['sub_department_name'] && (row['DepartmentID'] == row['job_current_department'])) {
                        //             return '<label class="badge badge-outline-primary badge-pill">'+row["department"]+'</label>';
                        //         } else {
                        //             return '<label class="badge badge-outline-primary badge-pill">'+row['department']+'</label>';
                        //         }
                        //     }
                        // }
                    }
                },{
                    "targets": 21, render: function(data,type,row){
                        if (row['type_branch_same_sale'] == null || row['type_branch_same_sale'] == '') {
                            return row['type_branch_other_sale'];
                        }else{
                            return row['type_branch_same_sale'];
                        }
                    }

                }
            ],
                // "order": []
        }
        );



</script>

 <script type="text/javascript">
    function deleteBarcode(Barcode_ID,text_barcode) {
        // alert(Barcode_ID+"--"+text_barcode);
        if(confirm('ต้องการลบบาร์โค้ด : '+text_barcode+'?')){
            $.ajax({
            type: 'GET',
            url: '{{ url('/work_follower/delete_barcode') }}',
            data: {Barcode_ID:Barcode_ID},
            success: function (msg) {
                alert(msg);
                location.reload();
            }
            });
        }
    }
 </script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
        $('#daterange').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse',
            todayBtn: true,
            language: 'th',
            thaiyear: true,
            locale: {
                format: 'DD/MM/YYYY',
                daysOfWeek : [
                                "อา.",
                                "จ.",
                                "อ.",
                                "พ.",
                                "พฤ.",
                                "ศ.",
                                "ส."
                            ],
                monthNames : [
                                "มกราคม",
                                "กุมภาพันธ์",
                                "มีนาคม",
                                "เมษายน",
                                "พฤษภาคม",
                                "มิถุนายน",
                                "กรกฎาคม",
                                "สิงหาคม",
                                "กันยายน",
                                "ตุลาคม",
                                "พฤศจิกายน",
                                "ธันวาคม"
                            ],
                firstDay : 0
            }
        });


    </script>


@stop
