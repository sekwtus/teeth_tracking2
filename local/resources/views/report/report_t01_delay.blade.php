@extends('layouts.template')

@section('title', 'Delay')

@section('stylesheet')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"> --}}
@stop

@section('content')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <!-- <h4 class="card-title">งานเลื่อนหลังผลิต</h4> -->
      <div class="row border-bottom">
        <div class="col-12 p-0 text-left">
          <h4>งานเลื่อนหลังผลิต </h4>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-12">
          <table id="tbl-report-delay" class="table-striped table-bordered display compact nowrap" style="width:100%">
            <thead class="text-center">
              <tr>
                <th>ลำดับ</th>
                <th>ปี</th>
                <th>เดือน</th>
                <th>สินค้า</th>
                <th>งานใหม่ (ซี่)</th>
                <th>งานแก้ (ซี่)</th>
                <th>งานต่อเนื่อง (ซี่)</th>
              </tr>
            </thead>

            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')

{{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script> --}}

<script type="">
var arr_month = [
  'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
  'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
];
var datatable_report;

$(document).ready(function() {
  // $('#tbl-report-delay').DataTable( {
  //     dom: 'Bfrtip',
  //     lengthChange: true,
  //     buttons: [
  //         'copy', 'excel', 'print'
  //     ]
  // } );

  datatable_report = $('#tbl-report-delay').DataTable({
    processing: true,
    serverSide: true,
    order:[], 
    
    "aLengthMenu": [
      [10, 20, 30, 50, -1], 
      [10, 20, 30, 50, "ทั้งหมด"]
    ], 
    "language": {
      search: "" 
    },
    "iDisplayLength": 20,
  
    ajax: {
      type: "GET",
      url: "{{url('table/report_work_delay')}}",
      data: function (d) {
        // d.year = $('select[name=ddlYear]').val();
        // d.round = $('select[name=ddlRound]').val();
        // console.log(d);
      },
    },
    columns: [
      { },
      { data: 'year_create', className:'text-center' },
      { data: 'created_at' },
      { data: 'product_name' },
      { data: 'count_new', className:'text-right' },
      { data: 'count_modify', className:'text-right' },
      { data: 'count_conti', className:'text-right' },
    ],
    columnDefs: [
      { 
        targets: 0, "className":"text-center",
        render: function (data, type, row, meta) {
          return (meta.row + meta.settings._iDisplayStart + 1);
        } 
      },
      { 
        targets: 2, "className":"text-center",
        render: function (data, type, row, meta) {
          // console.log(row);
          var created_date = new Date(row.created_at);
          var mm = arr_month[created_date.getMonth()];
          return (mm);
        } 
      },
    ],
  
  });
});
</script>
@stop
