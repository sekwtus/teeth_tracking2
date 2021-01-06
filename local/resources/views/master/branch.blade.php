@extends('layouts.template')

@section('title', 'สาขา')

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
                            <h4>&nbsp;&nbsp;&nbsp;สาขา&nbsp;&nbsp;
                            <button type="button" class="btn btn-icons btn-rounded btn-success" title="เพิ่มสาขา" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-plus"></i></a></button>
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
                                <th>ชื่อสาขา</th>
                                <th>ชื่อบริษัท</th>
                                <th>แลป</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                    {{ Form::open(['method' => 'POST' , 'url' => 'add_branch']) }}
                    @csrf
                    <div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">เพิ่มสาขา</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <label>ชื่อสาขา :</label> {{ Form::text('branch_name',null, ['class' => 'form-control','placeholder' => 'ชื่อสาขา']) }}
                                    <br>
                                    <label>ชื่อบริษัท :</label>
                                    <select name="ddlcompany" class="form-control ">
                                            <option  value="">เลือกบริษัท</option>
                                        @foreach ($company as $comp)
                                                <option value="{{ $comp->ID }}">{{ $comp->Name }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>ชื่อแลป :</label>
                                    <select name="ddllab" class="form-control ">
                                            <option value="">เลือกแลป</option>
                                        @foreach ($lab_master as $lab)
                                                <option value="{{ $lab->lab_name }}">{{ $lab->lab_name }}</option>
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

                    {{-- edit --}}
                    {{ Form::open(['method' => 'POST' , 'url' => 'update_branch']) }}
                    @csrf
                    <div class="modal fade" id="EDIT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">แก้ไขชื่อสาขา</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body" id="branchInfo">
                                   
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
            lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
          processing: true,
          serverSide: true,
          ajax: '{{ url('table/branch') }}',
          columns: [
                   { data: 'ID', name: 'ID' },
                   { data: 'branch_name', name: 'branch_name' },
                   { data: 'company_name', name: 'company_name' },
                   { data: 'lab', name: 'lab' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
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
                        var s = "'";
                        return '<button class="btn btn-warning" onclick="edit('+row["ID"]+','+s+row["branch_name"]+s+','+s+row["company_name"]+s+','+s+row["lab"]+s+')" style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>\
                        @if(Auth::user()->ID_type_users == 1)<button class="btn btn-danger" onclick="delete_branch('+row["ID"]+','+s+row["branch_name"]+s+')" style="padding:5px;">Delete</button>@endif'
                        }
                }],
                "order": []
       });

       table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
    });
</script>

<script>

function edit(ID,branch_name,company_name,lab_input)
        {

            $.ajax({
            type: 'GET',
            url: '{{ url('getLab_company') }}',
            data: {},
            success: function (data) {
                    var sign ="'";
                    if (ID == 'null') {
                        ID = '';
                    }if (branch_name == 'null') {
                        branch_name = '';
                    }if (company_name == 'null') {
                        company_name = '';
                    }if (lab_input == 'null') {
                        lab_input = '';
                    }
                    
                    input = '';

                    $("#EDIT").modal();

                    input = input +'<label>ชื่อสาขา :</label>\
                    <input type="text" name="branch_name" class="form-control" value="'+branch_name+'" required/>';

                    input = input +'<input type="hidden" name="ID" class="form-control" value="'+ID+'"/ placeholder="ID"><br>';

                    input = input +'<select name="ddlcompany" class="form-control ">\
                            <option value="">เลือกบริษัท</option>';
                            for (let company = 0; company < data[0].length; company++) {
                                if (data[0][company].Name == company_name) {
                                    input = input +'<option selected value="'+data[0][company].ID+'">'+data[0][company].Name+'</option>';
                                } else {
                                    input = input +'<option value="'+data[0][company].ID+'">'+data[0][company].Name+'</option>';
                                }
                            }
                    input = input +'</select><br>';

                    input = input +'<select name="ddllab" class="form-control ">\
                        <option value="">เลือกบริษัท</option>';
                        for (let lab = 0; lab < data[1].length; lab++) {
                            console.log();
                            if (data[1][lab].lab_name == lab_input) {
                                input = input +'<option selected value="'+data[1][lab].lab_name+'">'+data[1][lab].lab_name+'</option>';
                            } else {
                                input = input +'<option value="'+data[1][lab].lab_name+'">'+data[1][lab].lab_name+'</option>';
                            }
                            
                        }
                    input = input +'</select>';
                    
                    $("#branchInfo").html(input);


            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
            });
    }

    function delete_branch(id,branch_name) {

        if(confirm('ต้องการลบสาขา : '+branch_name+'?')){
            $.ajax({
            type: 'GET',
            url: '{{ url('delete_branch') }}',
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
