@extends('layouts.template')

@section('title', 'lab')

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
                            <h4>&nbsp;&nbsp;&nbsp;แลป&nbsp;&nbsp;
                            <button type="button" class="btn btn-icons btn-rounded btn-success" title="เพิ่มแลป" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-plus"></i></a></button>
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
                                <th>ชื่อแลป</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    {{ Form::open(['method' => 'POST' , 'url' => 'add_lab']) }}
                    @csrf
                    <div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">เพิ่มแลป</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อแลป :</label> {{ Form::text('lab_name',null, ['class' => 'form-control','placeholder' => 'ชื่อแลป']) }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add" name="add" value="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}

                    {{-- edit --}}
                    {{ Form::open(['method' => 'POST' , 'url' => 'update_lab']) }}
                    @csrf
                    <div class="modal fade" id="EDIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">แก้ไขชื่อแลป</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body" id="labinfo">
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add" name="add" value="save">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }} 


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
          ajax: '{{ url('table/lab') }}',
          columns: [
                   { data: 'id', name: 'id' },
                   { data: 'lab_name', name: 'lab_name' },
                   { data: 'id', name: 'id' ,orderable: false, searchable: false}
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
                    "targets": 2,
                    "className": "text-center",
                    render: function(data, type, row) {
                        var s = "'";
                        return '<button class="btn btn-warning" onclick="edit('+row["id"]+','+s+row["lab_name"]+s+')" style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>\
                        @if(Auth::user()->ID_type_users == 1)<button class="btn btn-danger" onclick="delete_lab('+row["id"]+','+s+row["lab_name"]+s+')" style="padding:5px;">Delete</button>@endif'
                        }
                }],
                "order": []
       });
    });
</script>

<script>

function edit(id,lab_name)
        {
            var sign ="'";
            if (id == 'null') {
                id = '';
            }
            if (lab_name == 'null') {
                lab_name = '';
            }

            input = '';

            $("#EDIT").modal();

            input = input +'<label>ชื่อแลป :</label>\
            <input type="text" name="lab_name" class="form-control" value="'+lab_name+'" required/>';

            input = input +'<input type="hidden" name="id" class="form-control" value="'+id+'"/ placeholder="ID">';

            $("#labinfo").html(input);
    }

    function delete_lab(id,lab_name) {
        
        if(confirm('ต้องการลบแลป : '+lab_name+'?')){
            $.ajax({
            type: 'GET',
            url: '{{ url('delete_lab') }}',
            data: {id:id},
            success: function (msg) {
                alert(msg);
                location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
            });
        }
    }
</script>
@stop
