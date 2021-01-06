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

    .hide{
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
                        <h4>งานที่อยู่ในแลป </h4>
                    </div>
                </div>
                <br>
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <h6 for="search_customer">ค้นหาลูกค้า : </h6>
                                        <input type="text" class="form-control" name="search_customer" id="search_customer"style="padding: 0px; height: 30px;" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <h6 for="search_zone">ค้นหาพื้นที่ : </h6>
                                        <input type="text" class="form-control" name="search_zone" id="search_zone"style="padding: 0px; height: 30px;" />
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
                                        <input type="text" class="form-control" name="search_work_type" id="search_work_type"style="padding: 0px; height: 30px;" />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <h6 for="search_depart">ค้นหาสถานะงาน : </h6>
                                        <input type="text" class="form-control" name="search_depart" id="search_depart"style="padding: 0px; height: 30px;" />
                                    </div>
                                </div>
                            </div>
                            <br>

                            <table id="table"  class="table-hover table-striped table-bordered display compact " width="100%">
                                <thead>
                                    <tr>
                                        {{-- <th style="padding:0%;">ลำดับ</th> --}}
                                        <th style="padding:5px;" >ลำดับ</th>
                                        <th style="padding:10px;" >วันส่งงาน</th>
                                        <th style="padding:5px;">งาน</th>
                                        <th style="padding:5px;">แลป</th>
                                        <th style="padding:5px;">พื้นที่</th>
                                        <th style="padding:5px;">เขต</th>
                                        <th style="padding:5px;">บาร์โค้ด</th>
                                        <th style="padding:15px;">ทันตแพทย์</th>
                                        <th style="padding:15px;">รพ./คลีนิค</th>
                                        <th style="padding:25px;">คนไข้</th>
                                        <th style="padding:5px;">H.N.</th>
                                        <th style="padding:5px;">วันที่รับงาน</th>
                                        <th style="padding:5px;">วันที่ส่งงาน</th>
                                        <th style="padding:5px;">เวลาส่งงาน</th>
                                        <th style="padding:5px;">รอบการผลิต</th>
                                        <th style="padding:5px;">สินค้า</th>
                                        <th style="padding:5px;">ลักษณะงาน</th>
                                        <th style="padding:5px;">งานแก้</th>
                                        <th style="padding:5px;">งานเลื่อน</th>
                                        <th style="padding:5px;">ประเภทงาน</th>
                                        <th style="padding:5px;">สถานะงาน</th>
                                        <th style="padding:5px;">สาขาที่ผลิต</th>
                                        @if(Auth::user()->ID_type_users == 1)
                                            <th id="Bdelete" >action</th>
                                        @else
                                            <th style="padding: 0px;"></th>
                                        @endif
                                    </tr>
                                </thead>

                                        {{-- <td>@php
                                                $date = str_replace('/', '-', $data->DeliverDate );
                                                $newDate = date("Y-m-d", strtotime($date));
                                                $date = str_replace('-', '', $newDate );
                                            @endphp
                                            <span style="display:none;">{{$date}}</span>
                                            {{ $data->DeliverDate }}
                                        </td> --}}

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
        $('#search_customer').focus();
    });
</script>
<script>


    var area = 'ทั้งหมด'
        $('#search_customer').on('keyup change', function () {
                table.column(8).search($(this).val()).draw();
        });
        $('#search_area').on('keyup change', function () {
                table.column(5).search($(this).val()).draw();
        });
        $('#search_work_type').on('keyup change', function () {
                table.column(15).search($(this).val()).draw();
        });
        $('#search_zone').on('keyup change', function () {
                table.column(4).search($(this).val()).draw();
        });
        $('#search_depart').on('keyup change', function () {
                table.column(20).search($(this).val()).draw();
        });


        
          var table = $('#table').DataTable({
          lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
          processing: true,
        //   serverSide: true,
          sortable: true,
          searchable: true,
          ajax: '{{ url('/table/work_follower/order') }}',
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
                   { data: 'DeliverDate', name: 'DeliverDate' ,orderable: true,},
                   { data: 'ReceptionTime', name: 'ReceptionTime' },
                   { data: 'production_cycle', name: 'production_cycle' },
                   { data: 'type_of_product' , name: 'type_of_product'},
                   { data: 'RefBarcode' , name: 'RefBarcode'},
                   { data: 'work_edit' , name: 'work_edit'},
                   { data: 'work_late' , name: 'work_late'},
                   { data: 'OralScan' , name: 'OralScan'},
                   { data: 'department' , name: 'department'},
                   { data: 'branch_name' , name: 'branch_name'},
                //    { data: 'DeliverDate', name: 'DeliverDate' ,orderable: false, searchable: false,sortable: true,}
                ],
                columnDefs: [
                // {
                //     "targets": 0,
                // },
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                     "targets": 1,   render: function(data, type, row)
                    {
                        if(data == null || data == ''){
                            return 'ไม่ระบุ';
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
                            }
                        }

                    },
                    orderable: true,
                    "className": "text-center",
                },
                {
                    "targets": 2,  render: function(data, type, row) {
                        if(data == 'ด่วน' || data == 'ด่วนรับปาก'){
                            return '<span style="display:none;">'+row['DeliverDate']+'</span> <div style="background-color:#FF0000;padding: 4px;"><font color="white" >'+data+'</font></div>';
                        } else if(data == 'ดูแลพิเศษ') {
                            return "<div style='background-color:#FFDF00;padding: 2px;color:'black';>"+data+"</div>"
                        } else if(data == 'คุณภาพรับปาก') {
                            return "<div class='text-white' style='background-color:#000000;padding: 2px;color:'black';>"+data+"</div>"
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
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5,
                    "className": "text-center",
                },
                {
                    "targets": 6 , render: function(data, type, row) {
                        return '<a href="./summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                    },
                    "className": "text-center",
                },
                {
                    "targets": 7
                },
                {
                    "targets": 8
                },
                {
                    "targets": 9
                },
                {
                    "targets": 10
                },
                {
                    "targets": 11,
                    render: function(data, type, row) {
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
                    "targets": 12,
                    render: function(data, type, row) {
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
                            return '<font color="red">งานแก้</font>';
                        }else if(row['ContiBarcode']){
                            return '<font color="blue">งานต่อเนื่อง</font>';
                        }else{
                            return 'งานใหม่';
                        }
                    }
                },
                {
                    "targets": 17, render: function(data,type,row){return row['work_edit'];}
                },
                {
                    "targets": 18, render: function(data,type,row){return row['work_late'];}
                },
                {
                    "targets": 19, render: function(data,type,row){return row['OralScan'];},
                    "className": "text-center",
                },
                {
                    'max-width': '5px',  "targets": 20 , render: function(data,type,row){

                        if ( ( row['job_current_department'] == null || row['job_current_department'] == '' ) && (row['department_main'] == null || row['department_main'] == '')  ) {
                            return '<label class="badge badge-outline-danger badge-pill">รอ Screen</label>';
                        }else if ( row['job_current_department'] == 1000){
                            return '<label class="badge badge-outline-primary badge-pill">รอ Screen - แก้ไขซี่ฟันใหม่</label>';
                        }else if ( row['job_current_sub_department'] != null && row['job_current_department'] != null ) {
                            return '<label class="badge badge-outline-primary badge-pill">'+row["job_current_department"]+' - '+row["job_current_sub_department"]+'</label>';
                        }else if ( row['job_current_sub_department'] != null && row['department_main'] != null ) {
                            return '<label class="badge badge-outline-primary badge-pill">'+row["department_main"]+' - '+row["job_current_sub_department"]+'</label>';
                        }else if ( row['job_current_department'] != null ) {
                            return '<label class="badge badge-outline-primary badge-pill">'+row['job_current_department']+'</label>';
                        }

                    }
                },
                {
                    "targets": 21, render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            return data;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 22, render: function(data,type, row){
                        var barcode_ = row["Barcode"];
                        var sign ="'";
                        return  '@if(Auth::user()->ID_type_users == 1)<button type="button" style="margin-bottom: 10px;" class="btn btn-danger" onclick="deleteBarcode('+row["ID"]+','+sign+barcode_+sign+')">ลบบาร์โค้ด</button>\
                        @else\
                        @endif';
                    }
                },
                ],
                "order": [],
       });

       table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

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
