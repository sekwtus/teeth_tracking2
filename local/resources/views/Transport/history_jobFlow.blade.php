@extends('layouts.template')

@section('stylesheet')
    <style>
    </style>
<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css" />
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card" >
            @foreach ($data_order_screen as $data_order_screen)
                <div class="card-body" style="height : 99%; width:99%; auto; overflow-y: auto; overflow-x: auto;">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                                <h5>รายละเอียดลำดับงาน <span class="bg-info text-white" id="clipboardExample4">&nbsp;Barcode : {{ $data_order_screen->Barcode }} &nbsp;</span></h5>
                        </div>
                    </div>
                    <br>

                    <div class="tab-pane fade show active" id="containComplete" role="tabpanel" aria-labelledby="home-tab">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>เซล</th>
                                    <th>แผนก</th>
                                    <th>ช่างผู้รับงาน</th>
                                    <th>รูปภาพช่าง</th>
                                    <th>เวลารับงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                 @foreach ($data_job_flow as $job_flow)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $data_order_screen->Name }}</td>
                                        <td>{{ $job_flow->nameDepartment }}</td>
                                        <td>{{ $job_flow->Name }}</td>
                                        <td>
                                                @if($job_flow->picture_user != null)
                                                    <img class="img" src="{{ url('/local/public/file/').'/'.$job_flow->picture_user }}" class="img-responsive" style="width:80px;height:80px;">
                                                @endif

                                                @if($job_flow->picture_user == null)
                                                    <img class="img" src="{{ url('/local/public/file/user1__2018-12-09_KsURh8W2.png') }}" class="img-responsive" style="width:80px;height:80px;">
                                                @endif
                                        </td>
                                        <td>{{ $job_flow->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                @endforeach
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
        $(document).ready(function() {
            $('#example').DataTable({
                "aaSorting": []
            });
        } );
        });
    </script>



@stop
