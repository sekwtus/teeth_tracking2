@extends('layouts.template')

@section('stylesheet')
@stop

@section('content')
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header header-sm">
                        <div class="align-items-center">
                            <div class="media-info">
                                <label class="card-title font-weight-bold">รายการงานทั้งหมด</label>
                            </div>
                        </div>
                    </div>
                <!--data table-->
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ขั้นตอน</th>
                                    <th>สถานะ</th>
                                    <th>พนักงานรับผิดชอบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>หล่อรูปฟัน</td>
                                    <td>กำลังทำ</td>
                                    <td>นาย.ทรงวุฒิ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 text-right">
                        <a href="{{url('main_job')}}">
                            <button type="buuton" class="btn btn-lg btn-success">
                                ย้อนกลับ
                            </button>
                        </a>
                    </div>
                    <br>
                    <!--end data table-->
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
