@extends('layouts.template')
@section('title', 'recieve send report')
@section('stylesheet')
<style>
    table{
        font-size: 13px;
    }
    #example1 div.dataTables_scrollHeadInner thead {
        height: 10em;
    line-height: 10em;
    white-space: nowrap;
    }
    #example2 div.dataTables_scrollHeadInner thead {
        height: 10em;
    line-height: 10em;
    white-space: nowrap;
    }
    .dataTables_filter{
        display: none;
    }
    /* tfoot{
        display: none;
    } */
</style>

<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the initial value */
        margin-top: 5mm;
        margin-left: 5mm;
        margin-right: 10mm;

    }
    /* @media{
        tfoot{
            display:block;
        }
    } */

</style>

<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css') }}" type="text/css" />


@stop

@section('content')

<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card" >
                <div class="card-body" style="height : 100%; width:100%;">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h4>บันทึกการรับ - ส่งงาน ย้อนหลัง 7 วัน</h4>
                            {{-- <button class="btn btn-primary btn-search" title="พิมพ์" data-tooltip="tooltip" onclick="pdf()"><i class="mdi mdi-24px mdi-printer"></i></button> --}}
                        </div>
                    </div>
                    <br>

                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="containComplete" role="tabpanel" aria-labelledby="home-tab" width="100%">
                            <div class="row">
                                <div class="col-lg-2"><h6>ค้นหาวันที่สร้างใบงาน: </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาพื้นที่ : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาเขต : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาประเภทงาน(สินค้า) : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาลูกค้า : </h6></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2"><input class="form-control input-daterange-datepicker" id="datepicker" data-date-format="dd/mm/yyyy" style="padding: 0px; height: 30px;"></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_zone" id="search_zone"style="padding: 0px; height: 30px;" /></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_area" id="search_area"style="padding: 0px; height: 30px;"/></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_work_type" id="search_work_type"style="padding: 0px; height: 30px;" /></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_customer" id="search_customer"style="padding: 0px; height: 30px;" /></div>
                            </div><br>
                            <table id="example1"  class=" table-striped table-bordered display compact" width="100%">
                            {{-- <table id="example1" class="table-striped compact nowrap table-responsive "
                                 style="width:100%;"> --}}
                                <thead>
                                    <tr>
                                        <th  style="padding-right: 4px;" class="bg-secondary text-center">No</th>
                                        <th class="bg-secondary text-center">วันที่สร้างใบงาน</th>
                                        <th class="bg-secondary text-center">เวลาที่สร้างใบงาน</th>
                                        <th class="bg-secondary text-center">Barcode</th>
                                        <th class="bg-secondary text-center">พื้นที่</th>
                                        <th class="bg-secondary text-center">เขต </th>
                                        <th class="bg-secondary text-center">สินค้า</th>
                                        <th class="bg-secondary text-center">รพ./คลีนิค</th>
                                        <th class="bg-secondary text-center">ทันตแพทย์</th>
                                        <th class="bg-secondary text-center">ชื่อคนไข้</th>
                                        <th class="bg-secondary text-center">H.N.</th>
                                        <th class="bg-secondary text-center">วันที่ส่งงาน</th>
                                        <th class="bg-secondary text-center">เวลาส่งงาน</th>
                                        <th class="bg-secondary text-center">วันที่ </th>
                                        <th class="bg-secondary text-center">ลงชื่อ</th>
                                    </tr>
                                </thead>

                                {{-- <tfoot ><tr>
                                    <td>
                                            SFM-SA-003
                                    </td>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td >
                                            REV: 02; 01/09/2010
                                    </td>
                                </tr></tfoot> --}}

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

   <script>
 var area = 'ทั้งหมด'
            $('#search_customer').on('keyup change', function () {
                    table.column(7).search($(this).val()).draw();
            });
            $('#search_area').on('keyup change', function () {
                    table.column(5).search($(this).val()).draw();
            });
            $('#search_work_type').on('keyup change', function () {
                    table.column(6).search($(this).val()).draw();
            });
            $('#search_zone').on('keyup change', function () {
                    table.column(4).search($(this).val()).draw();
            });
            // $('.datepicker').on('keyup change', function () {
            //     var date = $(this).val();
            //     var dateMin = date.substring(8,10) +'/'+ date.substring(5,7) +'/'+ date.substring(0,4);
            //     alert(dateMin);
            //         table.column(1).search($(this).val()).draw();
            // });
            $('#datepicker').datepicker();
            $('#datepicker').on('keyup change', function () {
                var date = $(this).val();
                // var dateMin = date.substring(8,10) +'/'+ date.substring(5,7) +'/'+ date.substring(0,4);
                // alert(date);
                    table.column(1).search(date).draw();
            });

var table = $('#example1').DataTable({
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
                dom: 'lBfrtip',
                buttons: [
                    'copy','excel'
                    //  'pdf', 'print'
                ],
                "scrollX": false,
                orderCellsTop: true,
                fixedHeader: true,
                // processing: true,
                // serverSide: true,
                ajax: '{{ url('/table/report/re_send_today/') }}',
                columns: [
                    // {data: 'DT_RowIndex', orderable: false, searchable: false},
                   { data: 'ID', name: 'ID' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'zone_name', name: 'zone_name' },
                   { data: 'area_name', name: 'area_name' },
                   { data: 'product_name', name: 'product_name' },
                //    { data: 'first_product', name: 'first_product' },
                   { data: 'customer_name', name: 'customer_name' },
                   { data: 'doctorname', name: 'doctorname' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'PatientHN', name: 'PatientHN' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'ReceptionTime', name: 'ReceptionTime' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'StartDate', name: 'StartDate' },
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                },
                {
                    "targets": 1 ,
                    render(data,type,row){
                        var date = new Date(row['StartDate']).toJSON().slice(0,10);
                        var dateMin = date.substring(8,10) +'/'+ date.substring(5,7) +'/'+ date.substring(0,4);
                        return dateMin;
                    }
                },
                {
                    "targets": 2,"className": "text-center",render(data,type,row){
                        // var time = new Date(row['StartDate']).toJSON().slice(11,19);
                        // return time;
                        return row['StartDate'].slice(11,19);
                    }
                },
                {
                    "targets": 3 , render: function(data, type, row) {
                        return '<a target="_blank" rel="noopener noreferrer" href="../summary_report/'+row["ID"]+'">'+row["Barcode"]+'</a>';
                    }
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5,
                    // "className": "text-center",
                },
                {
                    "targets": 6
                },
                {
                    "targets": 7,
                },
                {
                    "targets": 8,
                },
                {
                    "targets": 9,
                },
                {
                    "targets": 10
                },
                {
                    "targets": 11
                },
                {
                    "targets": 12
                },
                {
                    "targets": 13,render(data,type,row){
                        return "";
                    }
                },
                {
                    "targets": 14,render(data,type,row){
                        return "";
                    }
                },
                ],
            });

   </script>

@stop
