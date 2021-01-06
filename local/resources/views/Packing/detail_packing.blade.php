@extends('layouts.template')

@section('stylesheet')

<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css" />
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h3>Detail Packing &nbsp</h3>
                        </div>
                    </div>
                    <br>
                    @foreach ($data_order_screen as $data)
                    <table class="table table-striped table-bordered" style="width:100%" align="center">
                            <tr>
                                <th style="width:25%">รหัสสั่งผลิต</th>
                                <td style="width:25%">{{ $data->ID }}</td>
                            </tr>
                            <tr>
                                <th>วันที่สั่งผลิต</th>
                                <td>{{ $data->StartDate }}</td>

                                <th>วันที่ต้องการรับสินค้า</th>
                                <td>{{ $data->DeliverDate }}</td>
                            </tr>
                            <tr>
                                <th>ชื่อผู้สั่ง(Saler)</th>
                                <td>{{ $data->Name }}</td>

                                <th>พื้นที่บริการ</th>
                                <td>-</td>
                            </tr>
                            <tr>
                                <th >ชื่อหมอ</th>
                                <td>{{ $data->doctorname }}</td>

                                <th>ชื่อคนไข้</th>
                                <td>{{ $data->PatientName }}</td>
                            </tr>
                            <tr>
                                <th>ซี่ฟัน</th>
                                <td>-</td>

                                <th >สิ่งที่ส่งมาด้วย</th>
                                <td>-</td>
                            </tr>
                    </table>
                    @endforeach

                    <div class="row mt-2">
                        <div class="col-sm-12 text-right">
                            {{-- <a  href="{{ url('/packing') }}"> --}}
                                <button type="button" class="btn btn-lg btn-success" onclick="history.go(-1)">
                                    <i class="mdi mdi-arrow-left-bold"></i>
                                    ย้อนกลับ
                                </button>
                            {{-- </a> --}}
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
            $('#example').DataTable();
        } );
    </script>


@stop
