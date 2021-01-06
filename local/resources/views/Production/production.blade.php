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
                        <h4>Production &nbsp</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class= "col-sm-4">
                    <i>เลือกดูรายการตามมาตรฐานการผลิต</i>
                    </div>
                    <div class= "col-sm-2">
                            <select class="form-control" id="year" name="year">
                                <option value="เลือกทั้งหมด">เลือกทั้งหมด</option>
                                <option value="ปูน">ปูน</option>
                                <option value="WAX">WAX</option>
                                <option value="CAD">CAD</option>
                                <option value="เเต่งโลหะ">เเต่งโลหะ</option>
                                <option value="เเต่งลง Zarconia">เเต่งลง Zarconia</option>
                                <option value="เเต่งลงเซรามิค">เเต่งลงเซรามิค</option>
                                <option value="โอเค">โอเปค</option>
                                <option value="พอสเลน">พอสเลน</option>
                                <option value="ขัด">ขัด</option>
                            </select> 
                    </div>
                    <div class= "col-sm-2">
                        <button type="submit" class="btn btn-sm btn-success">&nbsp;&nbsp;ค้นหา</button>
                    </div>
                </div>
                <br>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>รหัสการผลิต</th>
                            <th>ขั้นตอนการผลิต ปัจจุบัน</th>
                            <th>เวลางานทั้งหมด</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>OR0001</td>
                            <td>WAX</td>
                            <td>2018/11/20 - 2018/11/26</td>
                            <td>
                                <button class="btn btn-outline-warning btn-rounded btn-fw" data-toggle="modal" data-target="#EDIT">
                                    ดูรายละเอียดเพิ่มเติม
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>OR0002</td>
                            <td>เเต่ละโล</td>
                            <td>2018/11/21 - 2018/11/25</td>
                            <td>
                                <button class="btn btn-outline-warning btn-rounded btn-fw" data-toggle="modal" data-target="#EDIT">
                                    ดูรายละเอียดเพิ่มเติม
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>OR0003</td>
                            <td>โอเปค</td>
                            <td>2018/11/25 - 2018/11/28</td>
                            <td>
                                <button class="btn btn-outline-warning btn-rounded btn-fw" data-toggle="modal" data-target="#EDIT">
                                    ดูรายละเอียดเพิ่มเติม
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>OR0004</td>
                            <td>ขัด</td>
                            <td>2018/11/25 - 2018/11/28</td>
                            <td>
                                <button class="btn btn-outline-warning btn-rounded btn-fw" data-toggle="modal" data-target="#EDIT">
                                    ดูรายละเอียดเพิ่มเติม
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

          
               <div class="modal fade" id="EDIT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            Production Detail
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                <div class="content-center">                                    
                                </div>
                                <div class="form-sample" >
                                   <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <label class="col-form-label font-weight-bold">Order Number:</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <label class="col-form-label ">OR001</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <label class="col-form-label font-weight-bold">Customer:</label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <label class="col-form-label">Alphabet puzzle</label>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                  
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#defaultModal">
                                        Process Logs
                                        <i class="mdi mdi-play-circle ml-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="card-body p-0">
                        <div class="mt-5">
                            <div class="vertical-timeline">

                                <div class="timeline-wrapper timeline-wrapper-warning">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                             <h6 class="timeline-title font-weight-bold">Create Order</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By Sale A</p>
                                            <p><span class="ml-auto">19/10/2018 (10:30)</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h6 class="timeline-title font-weight-bold">Screen Update</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By Screen A</p>
                                            <p><span class="ml-auto">19/10/2018 (11:30)</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-wrapper-primary">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                           <h6 class="timeline-title font-weight-bold">ปูน</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <div class="timeline-body">
                                                <p>By ปูน </p>
                                                <p><span class="ml-auto">19/10/2018 (12:30)</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                             <h6 class="timeline-title font-weight-bold">Wax</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By ปูน A</p>
                                            <p><span class="ml-auto">19/10/2018 (13:30)</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-wrapper timeline-wrapper-primary">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h6 class="timeline-title font-weight-bold">CAD</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By Weerawat kongle</p>
                                            <p><span class="ml-auto">19/10/2018 (14:30)</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h6 class="timeline-title font-weight-bold">เเต่งโลหะ</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By วรัชญ์ ชุมอินทร์</p>
                                            <p><span class="ml-auto">19/10/2018 (15:30)</span></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="timeline-wrapper timeline-wrapper-primary">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h6 class="timeline-title font-weight-bold">เเต่งลง Zarconia</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By Weerawat kongle</p>
                                            <p><span class="ml-auto">19/10/2018 (14:30)</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h6 class="timeline-title font-weight-bold">เเต่งลงเซรามิค</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By วรัชญ์ ชุมอินทร์</p>
                                            <p><span class="ml-auto">19/10/2018 (15:30)</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-wrapper-primary">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h6 class="timeline-title font-weight-bold">โอเปค</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By Weerawat kongle</p>
                                            <p><span class="ml-auto">19/10/2018 (14:30)</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h6 class="timeline-title font-weight-bold">พอสเลน</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By วรัชญ์ ชุมอินทร์</p>
                                            <p><span class="ml-auto">19/10/2018 (15:30)</span></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-wrapper timeline-wrapper-success">
                                    <div class="timeline-badge"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                             <h6 class="timeline-title font-weight-bold">ขัด</h6>
                                        </div>
                                        <div class="timeline-body">
                                            <p>By Weerawat kongle</p>
                                            <p><span class="ml-auto">19/10/2018 (16:30)</span></p>
                                        </div>
                                    </div>
                                </div>
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
