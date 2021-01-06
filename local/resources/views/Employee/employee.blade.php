@extends('layouts.template')

@section('title', 'Employee')

@section('stylesheet')

@stop

@section('content')
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h4>&nbsp;&nbsp;&nbsp;Employee&nbsp;&nbsp;
                                <a href="{{ url('employee/create') }}">
                                    <button type="button" class="btn btn-icons btn-rounded btn-success"title="Add Employee"><i class="mdi mdi-plus"></i></button>
                                </a>
                            </h4>
                            <br>
                        </div>
                    </div>

                    <table id="table" class=" table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>User Name</th>
                                <th>ชื่อพนักงาน</th>
                                <th>ชื่อเล่น</th>
                                <th>ฝ่าย</th>
                                <th>สาขา</th>
                                <th>บริษัท</th>
                                <th>status</th>
                                <th>ดำเนินการ</th>
                            </tr>
                        </thead>
                    </table>

                    @foreach($data_Employee as $out_data_Employee)
                    {{ Form::open(['method' => 'post' , 'url' => '/employee/delete/'.$out_data_Employee->ID.'/'.$out_data_Employee->ID_user]) }}
                    <div class="modal fade" id="DELETE{{ $out_data_Employee->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Delete Employee</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <h5>confirm Delete : {{ $out_data_Employee->Name }}</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" id="delete" name="delete" value="delete">Delete</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    {{ Form::close() }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(function() {
         var table = $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('/table/employee') }}',
          columns: [
                   { data: 'ID', name: 'ID' },
                   { data: 'username', name: 'username' },
                   { data: 'Name', name: 'Name' },
                   { data: 'Nick_name', name: 'Nick_name' },
                   { data: 'cotton', name: 'cotton' },
                   { data: 'type_Branch', name: 'type_Branch' },
                   { data: 'company', name: 'company' },
                   { data: 'status', name: 'status' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
          columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center"
                },
                {
                    "targets": 1
                },
                {
                    "targets": 2
                },
                {
                    "targets": 3
                },
                {
                    "targets": 4
                },
                {
                    "targets": 5
                },
                {
                    "targets": 6
                },
                {
                    "targets": 7,
                    render: function(data, type, row) {
                        if (data == 1) {
                            return '<div class="badge badge-success">Active</div>'
                        }
                        else{
                            return '<div class="badge badge-danger">Inactive</div>'
                        }
                    }

                },
                {
                    "targets": 8,
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<a href="{{ url("employee/edit/")."/" }}'+row["ID_user"]+'"><button class="btn btn-warning" style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button></a>\
                        @if(Auth::user()->ID_type_users == 1)<button class="btn btn-danger" data-toggle="modal" data-target="#DELETE'+data+'" style="padding:5px;">Delete</button>@endif\
                        <a href="{{ url("employee/update_status/")."/" }}'+data+'">\
                        <button class="btn btn-success" data-toggle="modal" style="padding-bottom: 2px;">change<br>status</button></a>'
                        }
                }],
                "order": []
         
       });
    });
</script>
@stop
