@extends('layouts.template')

@section('title', 'Modify')

@section('stylesheet')

@stop

@section('content')
<div class="content-wrapper">
  <div class="card">
    <div class="card-body">
      <div class="row border-bottom">
        <div class="col-12 p-0 text-left">
          <h4>งานแก้ภายนอก by สินค้า</h4>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-12">
            <table id="tbl-report-modify" class="table-striped table-bordered display compact nowrap" style="width:100%">
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
            
            {{-- @foreach ($data_monify as $data)
              <tr>
                <td>{{ $data->YY }} </td>
                <td>{{ $data->MM }}</td>
                <td>{{ $data->NN }}</td>
                  <td>{{ $data->count_TT - ( $data->count_ref + $data->count_con ) }}</td>
                <td>{{ $data->count_con }}</td>
                <td>{{ $data->count_ref }}</td>
                <td>
                    {{    number_format($data->count_ref /$data->count_TT,2)}}%
                </td>
              </tr>
             @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="">
var arr_month = [
  'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
  'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
];
var datatable_report;

  // var today = new Date('2020-04-30'); // Or Date.today()
  // var tomorrow = today.add(1).day();
$(document).ready(function() {
  datatable_report = $('#tbl-report-modify').DataTable({
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
      url: "{{url('table/report_work_modify')}}",
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
      // { data: 'Barcode' },
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
          // var dd = created_date.getDate();
          var mm = arr_month[created_date.getMonth()];
          // var yyyy = new String(thaiDate.getFullYear()+543).substr(2,4);
          return (mm);
        } 
      },

      // {
      //   targets: -1,
      //   searchable: false,
      //   className: 'text-center',
      //   render: function (data, type, row, meta) {
      //     return '<buttonn class="btn btn-sm btn-warning" onclick="editDocManual('+data+')" data-toggle="modal" data-target="">\
      //       <i class="fa fa-edit m-0"></i></buttonn>\
      //       <button class="btn btn-sm btn-danger" onclick="deleteDocManual('+data+')" data-toggle="modal" title="ลบข้อมูล"><i class="fa fa-trash-alt m-0"></i></button>';
      //   }
      // }
    ],
  
  });
});
</script>
@stop
