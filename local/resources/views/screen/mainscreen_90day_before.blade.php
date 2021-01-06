@extends('layouts.template')

@section('title', 'Screen')

@section('stylesheet')
<style>
    .tab-pane {
        display: none;
    }

    .active {
        display: block;
    }

    table {
        font-size: 13px;
    }

    .hide {
        display: none;
    }
</style>
@stop

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row no-print">
                        <div class="col-12  text-center">
                            <h3>
                                <b>งานที่สกรีนแล้วไม่เกิน90วัน</b>
                            </h3>
                        </div>
                        <br>
                    </div>
                    <div class="tab-content tab-content-basic">
                            <form action="mainscreen_90day_before" id='frmMain' method="get">  
                                {{-- {{ csrf_field() }} --}}
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <h6 for="bracode">ค้นหาบาร์โค้ด :</h6>
                                        <input type="text" class="form-control" name="bracode" id="bracode"style="padding: 0px; height: 30px;"  />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <h6 for="search_customer">ค้นหาลูกค้า : </h6>
                                        <input type="text" class="form-control" name="search_customer" id="search_customer"style="padding: 0px; height: 30px; " />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">  
                                        <h6 for="dentist">ค้นหาทันตแพทย์ : </h6> 
                                        <input type="text" class="form-control" name="dentist" id="dentist"style="padding: 0px; height: 30px;"  />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">  
                                        <h6 for="search_area">ค้นหาเขต : </h6>
                                        <input type="text" class="form-control" name="search_area" id="search_area"style="padding: 0px; height: 30px;"  />
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">  
                                        <h6 for="search_PatientName">ค้นหาคนไข้ : </h6>
                                        <input type="text" class="form-control" name="search_PatientName" id="search_PatientName"style="padding: 0px; height: 30px;"  />
                                    </div>
                                </div>
                                {{-- <div class="col-lg-2">
                                    <div class="form-group">  
                                        <h6 for="search_work_type">ค้นหาประเภทงาน(สินค้า) : </h6>
                                        <input type="text" class="form-control" name="search_work_type" id="search_work_type"style="padding: 0px; height: 30px;" />
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-2">
                                    <div class="form-group">  
                                        <h6 for="search_depart">ค้นหาสถานะงาน : </h6>
                                        <input type="text" class="form-control" name="search_depart" id="search_depart"style="padding: 0px; height: 30px;" />
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-2"><button type="text" id="btnFiterSubmitSearch" style="float: right; width: 100px" right="50px">ค้นหา</button></div> --}}
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
                    <div class=" tab-pane fade show active " id="ourgoal" role="tabpanel" aria-labelledby="profile-tab">
                        <table id="example" class="table-striped table-bordered display compact nowrap" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>บาร์โค้ด</th>
                                    <th>เขต</th>
                                    <th>ชื่อ Sale</th>
                                    <th>วันที่สั่งผลิต</th>
                                    <th>วันที่ส่งกลับ</th>
                                    <th>วันที่นัดจริง</th>
                                    <th>รพ./คลีนิค</th>
                                    <th>ทันตแพทย์</th>
                                    <th>เบอร์หมอ</th>
                                    <th>ไลน์หมอ</th>
                                    <th>คนไข้</th>
                                    <th>ดำเนินการ</th>
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
<script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(document).ready(function(){
        $('#bracode').focus();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){

                $("#StartDate").datepicker({
                    todayBtn:  1,
                    autoclose: true,
                }).on('changeDate', function (selected) {
                    var minDate = new Date(selected.date.valueOf());
                    $('#DeliverDate').datepicker('setStartDate', minDate);
                });

                $("#DeliverDate").datepicker()
                    .on('changeDate', function (selected) {
                        var minDate = new Date(selected.date.valueOf());
                $('#StartDate').datepicker('setEndDate', minDate);
                });
            });
</script>
<script>
    $(function() {
        var table = $('#example0').DataTable({
          lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
          processing: true,
        //   serverSide: true,
        //   ajax: '{{ url('/table/screen_teeth_90day') }}',
          columns: [
                   { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                   { data: 'Barcode',
                    render: function ( data, type, row ) {
                        if(row.Barcode != null && row.Barcode != ''){
                            //return row.Barcode;
                            return '<a href="./summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                        }
                        else if(row.RefBarcode != null && row.RefBarcode != ''){
                            return row.RefBarcode;
                        }
                        else if(row.ContiBarcode != null && row.ContiBarcode != ''){
                            return row.ContiBarcode;
                        }
                    }},
                   { data: 'ID', name: 'ID' },
                   { data: 'ID_area', name: 'ID_area' },
                   { data: 'Employee', name: 'Employee' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'Datefinal', name: 'Datefinal' },
                   { data: 'customer', name: 'customer' },
                   { data: 'doctor', name: 'doctor' },
                   { data: 'phone_doctor', name: 'phone_doctor' },
                   { data: 'line_doctor', name: 'line_doctor' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    "targets": 1,
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    render: function ( data, type, row ) {
                        if(row.RefBarcode != null && row.RefBarcode != ''){
                            return 'งานแก้';
                        }
                        else if(row.ContiBarcode != null && row.ContiBarcode != ''){
                            return 'งานต่อเนื่อง';
                        }
                        else
                        {
                            return 'งานใหม่';
                        }
                    }
                },
                {
                    "targets": 3,
                    render: function(data, type, row) {
                            return row["AreaID"]
                    }
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5,
                    render: function(data, type, row) {
                        if(data!= null && data != ''){
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        } else {
                            return null;
                        }
                    }
                },
                {
                    "targets": 6,
                    render: function(data, type, row) {
                        if(data!= null && data != ''){
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        } else {
                            return null;
                        }
                    }
                },
                {
                    "targets": 7,
                    render: function(data, type, row) {
                        if(data!= null && data != ''){
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        } else {
                            return null;
                        }
                    }
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
                    "targets": 11
                },
                {
                    "targets": 12
                },
                {
                    "targets": 13,
                    "className": "text-center",
                    render: function(data, type, row) {
                            if(row.editable == null){
                                return '<a href="{{ url("mainscreen/teeth/")."/" }}'+data+'"><button class="btn btn-primary btn-fw" style="padding: 10px 24px;">เลือกซี่ฟัน</button></a>'
                            }
                            else if(row.editable == 0){
                                return '<a href="{{ url("mainscreen/edit_teeth/")."/" }}'+data+'"><button class="btn btn-warning btn-fw" style="padding: 10px 24px;">แก้ไขซี่ฟัน</button></a>'
                            }
                        }
                }],
                "aaSorting": [],
                //"scrollX": true
        });
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
                table.cell(cell).invalidate('dom'); 
            } );
        } ).draw();
    //    $('div.dataTables_filter input').focus();
    });


    $(function() {
          var table = $('#example').DataTable({
          lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
          processing: true,
        //   serverSide: true,
        //   ajax: '{{ url('/table/screen') }}',
          columns: [
                   { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'AreaID', name: 'AreaID' },
                   { data: 'Employee', name: 'Employee' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'Datefinal', name: 'Datefinal' },
                   { data: 'customer', name: 'customer' },
                   { data: 'doctor', name: 'doctor' },
                   { data: 'phone_doctor', name: 'phone_doctor' },
                   { data: 'line_doctor', name: 'line_doctor' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                },
                {
                    "targets": 1,
                    //"className": "text-center"
                    render: function(data, type, row) {
                        return '<a href="./summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                    }
                },
                {
                    "targets": 2,
                    render: function(data, type, row) {
                        return row["AreaID"];
                    }
                },
                {
                    "targets": 3
                },
                {
                    "targets": 4,
                    render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        }
                    }
                },
                {
                    "targets": 5,
                    render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        }
                    }
                },
                {
                    "targets": 6,
                    render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        }
                    }
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
                    "targets": 11
                },
                {
                    "targets": 12,
                    "className": "text-center",
                    render: function(data, type, row) {
                        // return '<a href="{{ url("mainscreen/screen/")."/" }}'+data+'"><button class="btn btn-primary btn-fw" style="padding: 10px 24px;">Screen</button></a>'
                        return '<a href="{{ url("mainscreen/new_screen/")."/" }}'+data+'"><button class="btn btn-primary btn-fw" style="padding: 10px 24px;">Screen</button></a>'
                        }
                }],
                "aaSorting": [],
                //"scrollX": true
        });
        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    //    $('div.dataTables_filter input').focus();
    });
</script>

{{-- <script src="./js/tab-bootstrap/bootstrap-tab.min.js"></script> --}}
{{-- <script src="/js/tab-bootstrap/bootstrap-tab.min.js"></script> --}}
<script src="{{ asset('js/tab-bootstrap/bootstrap-tap.min.js') }}"></script>


<script>
    function active(id){
            if(id == 'menu1')
        {
            $('#'+id).toggleClass('active');
            $('#menu2').toggleClass('active');
        }
        else if(id == 'menu2')
        {
            $('#'+id).toggleClass('active');
            $('#menu1').toggleClass('active');
        }
        }

        var panelView = $('.panel-group.responsive').is(':visible');
        $( window ).resize( function () {
    if ( $('.panel-group.responsive').is(':visible') != panelView ) {
        $('.footable').removeClass('footable-loaded').footable();
        panelView = $('.panel-group.responsive').is(':visible');
    }
} );
</script>




@stop