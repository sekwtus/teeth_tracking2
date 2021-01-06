@extends('layouts.template')


@section('title', 'Manual')

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
                            <h4>&nbsp;&nbsp;&nbsp;เอกสาร&nbsp;&nbsp;
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
                                <th>ชื่อเอกสาร</th>
                                <th>ดาวน์โหลด</th>
                                {{-- <th>E-mail</th> --}}
                                <th>หมวด</th>
                                <th>ผู้อัพ</th>
                                <th>วันเวลาที่อัพ</th>
                                {{-- <th>status</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    {{ Form::open(['method' => 'POST' , 'url' => '/manual/add', 'files' => true]) }}
                    @csrf
                    <div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">เพิ่มเอกสาร</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อเอกสาร :</label> {{ Form::text('name_manual',null, ['class' => 'form-control','placeholder' => 'ชื่อเอกสาร']) }}
                                   <br>
                                    {{-- <label>เบอร์โทรศัพท์ :</label> {{ Form::text('Phone',null, ['class' => 'form-control','placeholder' => 'หมายเลขโทรศัพท์']) }}
                                    <label>E-mail :</label> {{ Form::text('email',null, ['class' => 'form-control','placeholder' => 'E-mail']) }}
                                    <label>ที่อยู่ :</label> {{ Form::text('Address',null, ['class' => 'form-control','placeholder' => 'ที่อยู่']) }} --}}
                                    <label>หมวด :</label> 
                                    {{-- {{ Form::select('size', array('L' => 'Large', 'S' => 'Small'), 'S') }} --}}
                                    <select id="cars" name="file_category_id" class="form-control"> 
                                        @foreach ( $file_category as  $file_category)
                                            <option value='{{$file_category->id}}'>{{$file_category->name}}</option>
                                        @endforeach
                                      </select>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="input-file-now">
                                                    อัปโหลดเอกสารคู่มือ
                                                </label>
                                                {{ Form::file('image',['class' => 'dropify','id' => 'input-file-now','required']) }}
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add" name="add" value="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }} 
                    {{ Form::open(['method' => 'POST' , 'url' => 'manual/edit', 'files' => true]) }}
                    @csrf
                    <div class="modal fade" id="EDIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">แก้ไขเอกสาร</h4>
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
          ajax: '{{ url('/table/manual') }}',
          columns: [
                   { data: 'id', name: 'id' },
                   { data: 'name', name: 'name' },
                   { data: 'path_file', name: 'path_file' },
                //    { data: 'email', name: 'email' },
                   { data: 'file_category_name', name: 'file_category_name' },
                   { data: 'Nick_name', name: 'Nick_name' },
                   { data: 'date_up', name: 'date_up' },
                //    { data: 'status', name: 'status' },
                   { data: 'id', name: 'id' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    "targets": 1,
                    "className": "text-left"
                },
                {
                    "targets": 2,
                    render: function(data, type, row) {
                        // return data;
                        return '<a href="{{ url("local/public/file")."/"}}'+data+'" target="_blank">\
                                        <font color="red"><i class="fa fa-file-pdf-o"></i></font> '+data+'\
                                    </a>';
                    }, 
                   "className": "text-left"
                },
                // {
                //     "targets": 3
                // },
                {
                    "targets": 3,"className": "text-center"
                },
                {
                    "targets": 4,"className": "text-center"
                },
                {
                    "targets": 5,"className": "text-left"
                },
                // {
                //     "targets": 6,
                //     render: function(data, type, row) {
                //         if (data == 'active') {
                //             return '<div class="badge badge-success">Active</div>'
                //         }
                //         else{
                //             return '<div class="badge badge-danger">Inactive</div>'
                //         }
                //     },
                //     "className": "text-center"

                // },
                {
                    "targets": 6,
                    "className": "text-center",
                    render: function(data, type, row) {
                        var s = "'";
                        return '<button class="btn btn-warning" onclick="editDoctor('+row["id"]+','+s+row["name"]+s+','+s+row["path_file"]+s+','+s+row["email"]+s+','+s+row["Line_doctor"]+s+','+s+row["file_category_name"]+s+','+s+row["file_category_id"]+s+')"\
                        style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>\
                        @if (Auth::user()->ID_type_users == 1)<button class="btn btn-danger" onclick="deleteDoctor('+row["id"]+','+s+row["name"]+s+','+s+row["path_file"]+s+')" style="padding:5px;">Delete</button>@endif\
                        <a href="{{ url("delete_status")."/" }}'+data+'">\
                        ';
                        },
                    "className": "text-center"
                }],
                "order": []
       });
    });
</script>
<script> 
    function editDoctor(ID,Name,path_file,email,Line_doctor,file_category_name,file_category_id)
        {
            var sign ="'";
            if (Name == 'null') {
                Name = '';
            }
            if (path_file == 'null') {
                path_file = '';
            }
            if (email == 'null') {
                email = '';
            }
            if (Line_doctor == 'null') {
                Line_doctor = '';
            }
            if (Line_doctor == 'null') {
                Line_doctor = '';
            }
            input = '';

            $("#EDIT").modal();

            input = input +'<label>ชื่อเอกสาร :</label>\
            <input type="text" name="Name" class="form-control" value="'+Name+'" required/>';

            input = input + '<label>หมวด :</label>\
            <select id="cars" name="file_category_id" class="form-control"> \
                <option value="'+file_category_id+'">'+file_category_name+'</option>\
                <option value="1">WI</option>\
                    <option value="2">SFM</option>\
                    <option value="3">CAD</option>\
                    <option value="4">CAM</option>\
                    <option value="5">นิทาน</option>\
            </select>';

            input = input +'<label>เอกสาร :</label>\
            <input type="text" name="path_file" class="form-control" value="'+path_file+'"/ placeholder="" readonly>';

            input = input +'<label>อัปโหลดเอกสารใหม่ :</label>\
            <input type="file" name="image" class="dropify" / placeholder=" ">';

            input = input +'<input type="hidden" name="ID" class="form-control" value="'+ID+'"/ placeholder="ID">';

            $("#doctor_info").html(input);

    }

    function deleteDoctor(ID,Name,path_file) {

        if(confirm('ต้องการลบ : '+Name+'?')){
            $.ajax({
            type: 'GET',
            url: '{{ url('delete_manual') }}',
            data: {ID:ID,path_file:path_file},
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
