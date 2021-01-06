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
                {{-- head tab --}}
                <div class="container">

                    {{-- body tab --}}
                            <table  id="example" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ซี่ฟัน</th>
                                            <th>ดำเนินการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count=1 ?>
                                        @foreach($teeth as $out_teeth)
                                        <tr>
                                            <td>{{  $count  }}</td>
                                            <td>#{{  $out_teeth->TeethID  }}</td>
                                            <td>
                                                <a href="{{ url('mainscreen/detail/teeth').'/'.$out_teeth->ScreenID.'/'.$out_teeth->TeethID }}">
                                                        <button class="btn btn-primary btn-fw" style="padding: 10px 24px;">
                                                            รายละเอียดการ Screen
                                                        </button>
                                                </a>
                                            </td>
                                            <?php $count=$count+1 ?>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
            $('#example').DataTable({"scrollX": true});
            $('div.dataTables_filter input').focus()
        } );
    </script>
@stop
