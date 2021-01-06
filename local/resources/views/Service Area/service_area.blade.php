@extends('layouts.template')

@section('stylesheet')

@section('title', 'Service Area')

@stop

@section('content')
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h4>&nbsp;&nbsp;&nbsp;Service Area&nbsp;&nbsp;
                                <button type="button" class="btn btn-icons btn-rounded btn-success" title="Add Service Area" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-plus"></i></a></button>
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
                                <th>ขื่อเขตพื้นที่</th>
                                <th>Zone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    {{ Form::open(['method' => 'POST' , 'url' => 'service_area']) }}
                    @csrf
                    <div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Add Service Area</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อพื้นที่ให้บริการ :</label> {{ Form::text('Name',null, ['class' => 'form-control','placeholder' => 'ชื่อพื้นที่ให้บริการ']) }}
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
                    @foreach($data_area as $out_data_area)
                    {{ Form::open(['method' => 'PATCH' , 'action' => ['area_controller@update',$out_data_area->ID]]) }}
                    <div class="modal fade" id="EDIT{{  $out_data_area->ID  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Edit Service Area</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อพื้นที่ให้บริการ :</label> {{ Form::text('Name',$out_data_area->Name, ['class' => 'form-control','placeholder' => 'ชื่อพื้นที่ให้บริการ']) }}
                                    <label>Zone :</label>
                                    <select class="form-control" id="ZoneID" name="ZoneID">
                                            <option value="{{  $out_data_area->ZoneID }}">{{  $out_data_area->Area  }}</option>
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

                    @foreach($data_area as $out_data_area)
                    {{ Form::open(['method' => 'DELETE' , 'action' => ['area_controller@destroy',$out_data_area->ID]]) }}
                    <div class="modal fade" id="DELETE{{  $out_data_area->ID  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Delete Service Area</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <h5>confirm Delete : {{ $out_data_area->Name }}</h5>
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
          ajax: '{{ url('/table/service_area') }}',
          columns: [
                   { data: 'ID', name: 'ID' },
                   { data: 'Name', name: 'Name' },
                   { data: 'Area', name: 'Area' },
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
                    "targets": 3,
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<button class="btn btn-warning" data-toggle="modal" data-target="#EDIT'+data+'" style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>\
                        @if(Auth::user()->ID_type_users == 1)  <button class="btn btn-danger" data-toggle="modal" data-target="#DELETE'+data+'" style="padding:5px;">Delete</button>@endif'
                        }
                }],
                "order": []
       });
    });
</script>
@stop
