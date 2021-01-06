@extends('layouts.template')


@section('title', 'Doctor')

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
                            <h4>&nbsp;&nbsp;&nbsp;Doctor&nbsp;&nbsp;
                                <button type="button" class="btn btn-icons btn-rounded btn-success btn-lg" title="Add Doctor" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-plus"></i></button>
                            </h4>
                            <br>
                        </div>
                    </div>
                    @if($errors->all())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    <table id="table" class="table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>E-mail</th>
                                <th>LINE</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    {{ Form::open(['method' => 'POST' , 'url' => 'doctor']) }}
                    @csrf
                    <div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Add Doctor</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อ-นามสกุล :</label> {{ Form::text('Name',null, ['class' => 'form-control','placeholder' => 'ชื่อ-นามสกุล']) }}
                                    <label>เบอร์โทรศัพท์ :</label> {{ Form::text('Phone',null, ['class' => 'form-control','placeholder' => 'หมายเลขโทรศัพท์']) }}
                                    <label>E-mail :</label> {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'E-mail']) }}
                                    <label>ที่อยู่ :</label> {{ Form::text('Address',null, ['class' => 'form-control','placeholder' => 'ที่อยู่']) }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add" name="add" value="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }} 
                    {{ Form::open(['method' => 'POST' , 'url' => 'doctor/update']) }}
                    @csrf
                    <div class="modal fade" id="EDIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Edit Doctor</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body" id="doctor_info">
                                   
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
          ajax: '{{ url('/table/doctor') }}',
          columns: [
                   { data: 'ID', name: 'ID' },
                   { data: 'Name', name: 'Name' },
                   { data: 'Phone', name: 'Phone' },
                   { data: 'email', name: 'email' },
                   { data: 'Line_doctor', name: 'Line_doctor' },
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
                    "targets": 5,
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
                    "targets": 6,
                    "className": "text-center",
                    render: function(data, type, row) {
                        var s = "'";
                        return '<button class="btn btn-warning" onclick="editDoctor('+row["ID"]+','+s+row["Name"]+s+','+s+row["Phone"]+s+','+s+row["email"]+s+','+s+row["Line_doctor"]+s+');"\
                        style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>\
                        @if (Auth::user()->ID_type_users == 1)<button class="btn btn-danger" onclick="deleteDoctor('+row["ID"]+','+s+row["Name"]+s+')" style="padding:5px;">Delete</button>@endif\
                        <a href="{{ url("doctor/update_status/")."/" }}'+data+'">\
                        <button class="btn btn-success" data-toggle="modal" style="padding-bottom: 2px;">change<br>status</button></a>'
                        }
                }],
                "order": []
       });
    });
</script>

<script>
    function editDoctor(ID,Name,Phone,email,Line_doctor)
        {
            var sign ="'";
            if (Name == 'null') {
                Name = '';
            }
            if (Phone == 'null') {
                Phone = '';
            }
            if (email == 'null') {
                email = '';
            }
            if (Line_doctor == 'null') {
                Line_doctor = '';
            }

            input = '';

            $("#EDIT").modal();

            input = input +'<label>ชื่อ-นามสกุล :</label>\
            <input type="text" name="Name" class="form-control" value="'+Name+'" required/>';

            input = input +'<label>เบอร์โทรศัพท์ :</label>\
            <input type="text" name="Phone" class="form-control" value="'+Phone+'"/ placeholder="เบอร์โทรศัพท์">';

            input = input +'<label>E-mail :</label>\
            <input type="text" name="email" class="form-control" value="'+email+'"/ placeholder="E-mail">';

            input = input +'<label>Line :</label>\
            <input type="text" name="Line_doctor" class="form-control" value="'+Line_doctor+'"/ placeholder="Line">';

            input = input +'<input type="hidden" name="ID" class="form-control" value="'+ID+'"/ placeholder="ID">';

            $("#doctor_info").html(input);
          
           

    }

    function deleteDoctor(ID,Name) {
        
        if(confirm('ต้องการลบหมอ : '+Name+'?')){
            $.ajax({
            type: 'GET',
            url: '{{ url('delete_docter') }}',
            data: {ID:ID},
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
