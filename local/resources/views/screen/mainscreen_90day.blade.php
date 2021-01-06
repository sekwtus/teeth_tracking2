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

    table{
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
                    <div class="row border-bottom">
                            <div class="col-12  text-center">
                                    <h3>
                                        <b>งานที่สกรีนแล้วไม่เกิน90วัน</b>
                                    </h3>
                            </div>
                    </div>
                    <div class="tab-content tab-content-basic">
                            {{-- <div class="row">
                                <div class="col-lg-2"><h6>ค้นหาบาร์โค้ด : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาลูกค้า : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาทันตแพทย์ : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาเขต : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาประเภทงาน(สินค้า) : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาสถานะงาน : </h6></div>

                            </div> --}}

                            <form action="" id='frmMain' method="get">
                                {{-- {{ csrf_field() }} --}}
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <h6 for="bracode">ค้นหาบาร์โค้ด :</h6>
                                            <input type="text" class="form-control" name="bracode" id="bracode"style="padding: 0px; height: 30px;" value='{{ (($_GET["bracode"])) ? ($_GET["bracode"]) : ('')}}'  />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <h6 for="search_customer">ค้นหาลูกค้า : </h6>
                                            <input type="text" class="form-control" name="search_customer" id="search_customer"style="padding: 0px; height: 30px; " value='{{ (($_GET["search_customer"])) ? ($_GET["search_customer"]) : ('')}}' />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">  
                                            <h6 for="dentist">ค้นหาทันตแพทย์ : </h6> 
                                            <input type="text" class="form-control" name="dentist" id="dentist"style="padding: 0px; height: 30px;" value='{{ (($_GET["dentist"])) ? ($_GET["dentist"]) : ('')}}'  />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">  
                                            <h6 for="search_area">ค้นหาเขต : </h6>
                                            <input type="text" class="form-control" name="search_area" id="search_area"style="padding: 0px; height: 30px;" value='{{ (($_GET["search_area"])) ? ($_GET["search_area"]) : ('')}}'  />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">  
                                            <h6 for="search_PatientName">ค้นหาคนไข้ : </h6>
                                            <input type="text" class="form-control" name="search_PatientName" id="search_PatientName"style="padding: 0px; height: 30px;" value='{{ (($_GET["search_PatientName"])) ? ($_GET["search_PatientName"]) : ('')}}'  />
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
                    </div>
                    <div class="tab-content tab-content-basic">

                    <table id="example2" class="table-striped table-bordered display compact nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th width="15%">บาร์โค้ด</th>
                                <th width="10%">เขต</th>
                                <th width="10%">ชื่อ Sale</th>
                                <th>วันที่สั่งผลิต</th>
                                <th>วันที่ส่งกลับ</th>
                                <th>วันที่นัดจริง</th>
                                <th width="20%">รพ./คลีนิค</th>
                                <th>ทันตแพทย์</th>
                                <th>เบอร์หมอ</th>
                                <th>ไลน์หมอ</th>
                                <th>คนไข้</th>
                                <th width="5%">ดำเนินการ</th>
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
        var table = $('#example2').DataTable({
            lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
          processing: true,
        //   serverSide: true,
        //   ajax: '{{ url('/table/screen_complete') }}',
        ajax: {
                    url : "{{ url('/table/screen_teeth_90day')  }}",
                    // type : 'GET',
                    data : function (d) {
                            d.search_customer = $('#search_customer').val();
                            d.search_area = $('#search_area').val();
                            d.dentist = $('#dentist').val();
                            d.bracode = $('#bracode').val();
                            d.search_PatientName = $('#search_PatientName').val();
                        }
           },
          columns: [
                   { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                   { data: 'Barcode', name: 'Barcode' },
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
                    render: function(data, type, row) {
                        return '<a href="./summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                    }
                },
                {
                    "targets": 2,
                    render: function(data, type, row) {
                            return row["AreaID"]
                    }
                },
                {
                    "targets": 3
                },
                {
                    "targets": 4,
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
                        return '<a href="{{ url("mainscreen/detail/teeth/")."/" }}'+data+'"><button class="btn btn-primary btn-fw" style="padding: 10px 24px;">รายละเอียด</button></a>'
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
    ////////////////////////
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
