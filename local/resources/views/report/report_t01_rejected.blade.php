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
          <h4>ตีกลับช่างภายใน</h4>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-12">
          <table id="tbl-report-rejected" class="table-striped table-bordered display compact nowrap">
            <thead>
              <tr>
                <th>ปี/เดือน</th>
                <th>ชื่อเล่นช่าง</th>
                <th>แผนกย่อย</th>
                <th>แผนก</th>
                <th>บริษัท</th>
                <th>สินค้า</th>
                <th>จำนวนซี่</th>
                <th>ถูกตีกลับภายใน</th>
                <th>% การถูกตีกลับภายใน</th>
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
<script type="">
var datatable_report;

$(document).ready(function() {
  datatable_report = $('#tbl-report-rejected').DataTable({
    // processing: true,
    // serverSide: true,
    "aLengthMenu": [
      [5, 10, 20, 50, -1], 
      [5, 10, 20, 50, "ทั้งหมด"]
    ], 
    "language": {
      search: "" 
    },
    "iDisplayLength": 10,
  /*
    ajax: {
      type: "GET",
      url: "{{url('/get-doc-manual')}}",
      data: function (d) {
        // d.year = $('select[name=ddlYear]').val();
        // d.round = $('select[name=ddlRound]').val();
        // console.log(d);
      },
    },
    columns: [
      { data: 'id'},
      { data: 'name_doc' },
      { data: 'name_pdf' },
      { data: 'id' },
    ],
    columnDefs: [
      { 
        targets: 0, "className":"text-center",
        render: function (data, type, row, meta) {
          return (meta.row + meta.settings._iDisplayStart + 1);
        } 
      },

      {
        targets: -1,
        searchable: false,
        className: 'text-center',
        render: function (data, type, row, meta) {
          return '<buttonn class="btn btn-sm btn-warning" onclick="editDocManual('+data+')" data-toggle="modal" data-target="">\
            <i class="fa fa-edit m-0"></i></buttonn>\
            <button class="btn btn-sm btn-danger" onclick="deleteDocManual('+data+')" data-toggle="modal" title="ลบข้อมูล"><i class="fa fa-trash-alt m-0"></i></button>';
        }
      }
    ],
  */
  });
});
</script>
@stop
