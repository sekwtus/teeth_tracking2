{{-- @extends('layouts.template')

@section('title', 'Packing')

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
                            <h4>การบรรจุ &nbsp</h4>
                        </div>
                    </div>
                    <br> {{ Form::open(['method' => 'post' , 'url' => '/packing/scan']) }}
                    <div class="form-group row">
                        <label class="col-form-label col-sm-4" for="Barcode"><p class="card-description" style="font-size:18px;"> สแกนบาร์โค๊ดชิ้นงานที่จะทำการบรรจุ </p></label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                </div>
                                {{ Form::text('Barcode',null, ['class' => 'form-control','placeholder' => 'Barcode','id' => 'scanbarcode_pd','name' => 'scanbarcode_pd'])}} &nbsp;
                                <button class="btn btn-outline-success">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close()}}

                    <ul class="nav nav-tabs tab-basic" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#whoweare" role="tab" aria-controls="whoweare" aria-selected="true">
                                <h6>รอบรรจุ</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ourgoal" role="tab" aria-controls="ourgoal" aria-selected="false">
                                <h6>บรรจุเสร็จ</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="whoweare" role="tabpanel" aria-labelledby="home-tab">
                            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>บาร์ค้ด</th>
                                        <th>ลูกค้า</th>
                                        <th>ชื่อคนไข้</th>
                                        <th>วันที่ผลิต</th>
                                        <th>วันที่ผลิตเสร็จ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="ourgoal" role="tabpanel" aria-labelledby="profile-tab">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>บาร์โค้ด</th>
                                        <th>ลูกค้า</th>
                                        <th>ชื่อคนไข้</th>
                                        <th>วันที่ผลิต</th>
                                        <th>วันที่ผลิตเสร็จ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
@section('scripts')

<script>
    $(document).ready(function() {
      @if(\Session::has('massage'))
        alert('{{ \Session::get('massage') }}');
      @endif
      $('#example2').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('/table/packing') }}',
          columns: [
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'Name', name: 'Name' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'ID_JOB', name: 'ID_JOB' ,orderable: false, searchable: false}
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
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<a href="{{ url("packing_finish/")."/" }}'+data+'"><button class="btn btn-outline-success btn-rounded btn-fw" >บรรจุเสร็จ</button></a>'
                        }
                }],
                "aaSorting": []
       });


      $('#example').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('/table/packing_complete') }}',
          columns: [
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'Name', name: 'Name' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                {
                    "targets": 0,
                    "className": "text-center"
                },
                {
                    "targets": 1,
                    render: function(data, type, row) {
                        if(data == null , data == '') {
                            return 'เขต '+row["AreaID"]+''
                        }
                        else {
                            return 'เขต '+data+''
                        }

                    }
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
                    "className": "text-center",
                    render: function(data, type, row) {
                        return '<a href="{{ url("detail_packing/")."/" }}'+data+'"><button class="btn btn-outline-warning btn-rounded btn-fw" >รายละเอียดเพิ่มเติม</button></a>'
                        }
                }],
                "aaSorting": []
       });
    } );

</script>
<script src="./js/shared/alerts.js"></script>
<script src="./js/shared/avgrund.js"></script>


@stop --}}
