@extends('layouts.template')

@section('stylesheet')
<style>
.checkbox-toolbar {
    margin: 10px;
    }

    .checkbox-toolbar input[type="checkbox"] {
        display:none;
    }

    .checkbox-toolbar label {
             display:inline-block;
             background-color:#ddd;
             width: 100%;
             height: 15%;
             padding: 20px;
             font-size:14px;
             cursor: pointer;
             /* border: 2px solid #444; */
             /* border-radius: 4px;     */
         }
    .checkbox-toolbar label:hover {
        color: #212529;
            background-color: #cddde5;
            border-color: #c4d7e1;
    }

    .checkbox-toolbar input[type="checkbox"]:checked + label {
        color: #fff;
            background-color: #19d895;
            border-color: #19d895;
    }
</style>
@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp" style="height: 100%;">
        <div class="col-12 grid-margin">
        <div class="card" style="height : 99%; width:99%; auto; overflow-y: auto; overflow-x: auto;">
            <div class="card-body">
            <div class="row border-bottom">
                <div class="col-12 p-0 text-left">
                   <h4>&nbsp;&nbsp;&nbsp;รายการงานทั้งหมด&nbsp;&nbsp;
                    </h4><br>
                </div>
            </div>
            @if($errors->all())
        			<div class="alert alert-danger">
        				{{ $errors->first() }}
        			</div>
        	@endif
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order ID</th>
                            <th>Factory Name</th>
                            <th>Customer Name</th>
                            <th>Doctor Name</th>
                            <th>Sale Name</th>
                            <th>Deliver Type</th>
                            <th>Start Date</th>
                            <th>Deliver Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count =1;
                        @endphp
                         <a href="#">
                        @foreach ($data_order as $out_data_order) 
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$out_data_order->ID}}</td>
                            <td>{{$out_data_order->FactoryName}}</td>
                            <td>{{$out_data_order->CustomerName}}</td>
                            <td>{{$out_data_order->DoctorName}}</td>
                            <td>{{$out_data_order->SaleName}}</td>
                            <td>{{$out_data_order->DeliverType}}</td>
                            <td>{{$out_data_order->StartDate}}</td>
                            <td>{{$out_data_order->DeliverDate}}</td>
                            <td>
                                <button class="btn btn-success"style="padding:10px;">
                                        &nbsp;&nbsp;&nbsp;Select&nbsp;&nbsp;&nbsp;
                                </button>
                            </td>
                        </tr>
                        @php 
                            $count = $count+1;
                        @endphp
                        @endforeach
                        </a>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
        <div class="card" style="height : 99%; auto; overflow-y: auto;  overflow-x: auto;">
            <div class="card-body">
            <div class="row border-bottom">
                <div class="col-12 p-0 text-left">
                   <h4>&nbsp;&nbsp;&nbsp;QC&nbsp;&nbsp;
                    </h4><br>
                </div>
            </div>
            @if($errors->all())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
            <table id="example2" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>แผนก</th>
                            <th>ผุู้รับผิดชอบ</th>
                            <th>สถานะ</th>
                            <th>Wait time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td>ปูน</td>
                            <td>นายวีรวัฒน์ คงเหล่</td>
                            <td>กำลังทำ</td>
                            <td>1 ชั่วโมง</td>
                            <td>
                            <div class="navbar-menu-wrapper d-flex align-items-center">
                                <ul class="navbar-nav navbar-nav-right">
                                    <li class="nav-item d-none d-lg-block color-setting">
                                        <a class="nav-link" href="#">
                                            <button class="btn btn-success" data-toggle="modal" data-target="#EDIT" style="padding:10px;">
                                                    &nbsp;&nbsp;&nbsp;Select&nbsp;&nbsp;&nbsp;
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@stop

@section('scripts')
   <script>
           $(document).ready(function() {
               $('#example2').DataTable();
           } );
    </script>


@stop
