@extends('layouts.template')

@section('title', 'Factory')

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
                            <h4>&nbsp;&nbsp;&nbsp;Branch&nbsp;&nbsp;
                            <button type="button" class="btn btn-icons btn-rounded btn-success" title="Add Factory" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-plus"></i></a></button>
                            </h4>
                            <br>
                        </div>
                    </div>
                    @if($errors->all())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    <table id="table" class=" table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อโรงงาน</th>
                                <th>บริษัท</th>
                                <th>Zone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    {{ Form::open(['method' => 'POST' , 'url' => 'factory']) }}
                    @csrf
                    <div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Add Branch</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อโรงงาน :</label> {{ Form::text('Name',null, ['class' => 'form-control','placeholder' => 'ชื่อโรงงาน']) }}
                                    <label>บริษัท :</label>
                                    <select class="form-control" id="CompanyID" name="CompanyID">
                                        @foreach($data_company as $out_data_company)
                                            <option value="{{  $out_data_company->ID }}">{{  $out_data_company->Name }}</option>
                                        @endforeach
                                    </select>
                                    <label>Zone :</label>
                                    <select class="form-control" id="ZoneID" name="ZoneID">
                                        @foreach($data_zone as $out_data_zone)
                                            <option value="{{  $out_data_zone->ID }}">{{  $out_data_zone->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add" name="add" value="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}

                    @foreach($data_factory as $out_data_factory)
                    {{ Form::open(['method' => 'PATCH' , 'action' => ['factory_controller@update',$out_data_factory->ID]]) }}
                    <div class="modal fade" id="EDIT{{ $out_data_factory->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Edit Branch</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อโรงงาน :</label> {{ Form::text('Name',$out_data_factory->Name, ['class' => 'form-control','placeholder' => 'ชื่อโรงงาน']) }}
                                    <label>บริษัท :</label>
                                    <select class="form-control" id="CompanyID" name="CompanyID">
                                            <option value="{{  $out_data_factory->CompanyID }}">{{  $out_data_factory->company  }}</option>
                                        @foreach($data_company as $out_data_company)
                                            <option value="{{  $out_data_company->ID }}">{{  $out_data_company->Name }}</option>
                                        @endforeach
                                    </select>
                                    <label>Zone :</label>
                                    <select class="form-control" id="ZoneID" name="ZoneID">
                                            <option value="{{  $out_data_factory->ZoneID }}">{{  $out_data_factory->zone  }}</option>
                                        @foreach($data_zone as $out_data_zone)
                                            <option value="{{  $out_data_zone->ID }}">{{  $out_data_zone->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add" name="add" value="save">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                    @endforeach

                    @foreach($data_factory as $out_data_factory)
                    {{ Form::open(['method' => 'DELETE' , 'action' => ['factory_controller@destroy',$out_data_factory->ID]]) }}
                    <div class="modal fade" id="DELETE{{ $out_data_factory->ID }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Delete Branch</h5>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>confirm Delete : {{ $out_data_factory->Name }}</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" id="delete" name="delete" value="delete">Delete</button>
                                </div>
                            </div>
                        </div>
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
          $('#table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('/table/factory') }}',
          columns: [
                   { data: 'ID', name: 'ID' },
                   { data: 'Name', name: 'Name' },
                   { data: 'company', name: 'company' },
                   { data: 'zone', name: 'zone' },
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
                    "targets": 4,
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<button class="btn btn-warning" data-toggle="modal" data-target="#EDIT'+data+'" style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>\
                        @if(Auth::user()->ID_type_users == 1)<button class="btn btn-danger" data-toggle="modal" data-target="#DELETE'+data+'" style="padding:5px;">Delete</button>@endif'
                        }
                }],
                "order": []
       });
    });
</script>
@stop
