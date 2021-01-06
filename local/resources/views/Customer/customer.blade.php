@extends('layouts.template')

@section('title', 'Customer')

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
                            <h4>&nbsp;&nbsp;&nbsp;Customer&nbsp;&nbsp;
                            <button type="button" class="btn btn-icons btn-rounded btn-success" title="Add Customer" data-toggle="modal" data-target="#ADD"><i class="mdi mdi-plus"></i></a></button>
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
                                <th>ชื่อลูกค้า</th>
                                <th>ประเภทลูกค้า</th>
                                <th>เขตพื้นที่</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>


                    {{ Form::open(['method' => 'POST' , 'url' => 'customer']) }}
                    @csrf
                    <div class="modal fade" id="ADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Add Customer</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    <div class="col-6 ">
                                    <label>ชื่อลูกค้า :</label>
                                    {{ Form::text('Name',null, ['class' => 'form-control','placeholder' => 'ชื่อลูกค้า']) }}
                                    </div>
                                    <div class="col-6 ">
                                    <label>ชื่อเซลล์เรียก:</label>
                                    {{ Form::text('short_Name',null, ['class' => 'form-control','placeholder' => 'ชื่อเซลล์เรียก']) }}
                                    {{-- short_Name บันทึกลง Name --}}
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-6 ">
                                    <label>รหัสลูกค้า PC :</label>
                                    {{ Form::text('CustomerCode',null, ['class' => 'form-control','placeholder' => 'รหัสลูกค้า PC']) }}
                                    </div>
                                    <div class="col-6 ">
                                    <label>รหัสลูกค้า DT :</label>
                                    {{ Form::text('CustomerCode2',null, ['class' => 'form-control','placeholder' => 'รหัสลูกค้า DT']) }}
                                    </div>
                                    </div>
                                    <label>ที่อยู่ส่งของ:</label>
                                    {{ Form::text('send_object',null, ['class' => 'form-control','placeholder' => 'ที่อยู่ในการส่งของ']) }}
                                    <label>ที่อยู่ออกบิล:</label>
                                    {{ Form::text('send_bill',null, ['class' => 'form-control','placeholder' => 'ที่อยู่ในการออกบิล']) }}
                                    <label>เบอร์โทร:</label>
                                    {{ Form::text('Tel',null, ['class' => 'form-control','placeholder' => 'เบอร์โทร']) }}
                                    <label>เลขประจำตัวผู้เสียภาษี:</label>
                                    {{ Form::text('TaxID',null, ['class' => 'form-control','placeholder' => 'เลขประจำตัวผู้เสียภาษี']) }}
                                    <div class= "row">
                                    <div class="col-6 ">
                                    <label>ประเภทลูกค้า :</label>
                                    <select class="form-control" id="CustomerTypeID" name="CustomerTypeID">
                                        @foreach($data_type_customer as $out_data_type_customer)
                                            <option value="{{  $out_data_type_customer->id }}">{{  $out_data_type_customer->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="col-6 ">
                                    <label>เขตพื้นที่ :</label>
                                    <select class="form-control" id="AreaID" name="AreaID">
                                        @foreach($data_area as $out_data_area)
                                            <option value="{{  $out_data_area->ID }}">{{  $out_data_area->Name }}</option>
                                         @endforeach
                                    </select>
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

                    <!-- Modal -->
                    {{ Form::open(['method' => 'POST' , 'url' => 'update_customer/save']) }}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h4 class="modal-title" id="myModalLabel">Edit Customer</h4>
                                    <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6 ">
                                            <div id="customername_input"></div>
                                        </div>
                                        <div class="col-6 ">
                                            <div id="short_Name_input"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 ">
                                            <div id="CustomerCode_input"></div>
                                        </div>
                                        <div class="col-6 ">
                                            <div id="CustomerCode2_input"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="send_object_input"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="send_bill_input"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="Tel_input"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="TaxID_input"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>ประเภทลูกค้า :</label>
                                            <select class="form-control" id="CustomerTypeID" name="CustomerTypeID">
                                                <option id="ddlCustomerType"></option>
                                                @foreach($data_type_customer as $out_data_type_customer)
                                                    <option value="{{  $out_data_type_customer->id }}">{{  $out_data_type_customer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>เขตพื้นที่ :</label>
                                            <select class="form-control" id="AreaID" name="AreaID">
                                                <option id="ddlArea"></option>
                                                @foreach($data_area as $out_data_area)
                                                    <option value="{{  $out_data_area->ID }}">{{  $out_data_area->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="btnSave" name="ID_" value="">Save changes</button>
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
          ajax: '{{ url('/table/customer') }}',
          columns: [
                   { data: 'ID', name: 'ID' },
                   { data: 'Name', name: 'Name' },
                   { data: 'CustomerType', name: 'CustomerType' },
                   { data: 'Area', name: 'Area' },
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
                    "targets": 4,
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
                    "targets": 5,
                    "className": "text-center",
                    render: function(data, type, row) {

                        var customername_ = row["Name"];
                        var sign ="'";

                        return '<button class="btn btn-warning" onclick="editCustomer('+row["ID"]+','+sign+customername_+sign+','+sign+row["CustomerType"]+sign+','+sign+row["CustomerTypeID"]+sign+',\
                        '+sign+row["AreaID"]+sign+','+sign+row["Area"]+sign+','+sign+row["CustomerCode"]+sign+','+sign+row["CustomerCode2"]+sign+','+sign+row["short_Name"]+sign+','+sign+row["NameCustomer1"]+sign+',\
                        '+sign+row["NameCustomer2"]+sign+','+sign+row["send_object"]+sign+','+sign+row["send_bill"]+sign+','+sign+row["Tel"]+sign+','+sign+row["TaxID"]+sign+','+sign+row["CustomerName"]+sign+')"\style="padding:5px;">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;</button>\
                        @if (Auth::user()->ID_type_users == 1)<button class="btn btn-danger" style="padding:5px;" onclick="deleteCustomer('+row["ID"]+','+sign+customername_+sign+')">Delete</button>@endif\
                        <a href="{{ url("customer/update_status/")."/" }}'+data+'">\
                        <button class="btn btn-success" data-toggle="modal" style="padding-bottom: 1px;">change<br>status</button></a>'
                        }
                }],
                "order": []
       });
    });
</script>

  <script type="text/javascript">
    function deleteCustomer(ID_,customername_) {
        // alert(Barcode_ID+"--"+text_barcode);
        if(confirm('ต้องการลบลูกค้า : '+customername_+'?')){
            $.ajax({
            type: 'GET',
            url: '{{ url('delete_customer') }}',
            data: {ID_:ID_},
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

    function editCustomer(ID_,customername_,customerType_,customerTypeId_,customerAreaId_,customerArea_,CustomerCode_,CustomerCode2_,
        short_Name_,NameCustomer1_,NameCustomer2_,send_object_,send_bill_,Tel_,TaxID_,CustomerName_)
        {
            var sign ="'";
            if (customername_ == 'null') {
                customername_ = '';
            }
            if (customerType_ == 'null') {
                customerType_ = '';
            }
            if (CustomerCode_ == 'null') {
                CustomerCode_ = '';
            }
            if (CustomerCode2_ == 'null') {
                CustomerCode2_ = '';
            }
            if (send_object_ == 'null') {
                send_object_ = '';
            }
            if (send_bill_ == 'null') {
                send_bill_ = '';
            }
            if (Tel_ == 'null') {
                Tel_ = '';
            }
            if (TaxID_ == 'null') {
                TaxID_ = '';
            }

            $("#exampleModal").modal();
            customername_input = '<label>ชื่อลูกค้า :</label>\
            <input type="text" name="Name" class="form-control" value="'+customername_+'"/>';

            short_Name_input = '<label>ชื่อเซลล์เรียก:</label>\
            <input type="text" name="short_Name" class="form-control" value="'+short_Name_+'"/ placeholder="ชื่อเซลล์เรียก">';

            CustomerCode_input = '<label>รหัสลูกค้า PC :</label>\
            <input type="text" name="CustomerCode" class="form-control" value="'+CustomerCode_+'"/ placeholder="รหัสลูกค้า PC">';

            CustomerCode2_input = '<label>รหัสลูกค้า DT :</label>\
            <input type="text" name="CustomerCode2" class="form-control" value="'+CustomerCode2_+'"/ placeholder="รหัสลูกค้า DT">';

            send_object_input = '<label>ที่อยู่ส่งของ:</label>\
            <input type="text" name="send_object" class="form-control" value="'+send_object_+'"/ placeholder="ที่อยู่ในการส่งของ">';

            send_bill_input = '<label>ที่อยู่ออกบิล:</label>\
            <input type="text" name="send_bill" class="form-control" value="'+send_bill_+'"/ placeholder="ที่อยู่ในการออกบิล">';

            Tel_input = '<label>เบอร์โทร:</label>\
            <input type="text" name="Tel" class="form-control" value="'+Tel_+'"/ placeholder="เบอร์โทร">';

            TaxID_input = '<label>เลขประจำตัวผู้เสียภาษี:</label>\
            <input type="text" name="TaxID" class="form-control" value="'+TaxID_+'"/ placeholder="เลขประจำตัวผู้เสียภาษี">';

            $("#customername_input").html(customername_input);
            $("#short_Name_input").html(short_Name_input);
            $("#CustomerCode_input").html(CustomerCode_input);
            $("#CustomerCode2_input").html(CustomerCode2_input);
            $("#send_object_input").html(send_object_input);
            $("#send_bill_input").html(send_bill_input);
            $("#Tel_input").html(Tel_input);
            $("#TaxID_input").html(TaxID_input);
            

            $("#ddlCustomerType").html(customerType_);
            $("#ddlCustomerType").val(customerTypeId_);
            $("#ddlArea").html(customerArea_);
            $("#ddlArea").val(customerAreaId_);
            $("#btnSave").val(ID_);

    }

 </script>

@stop
