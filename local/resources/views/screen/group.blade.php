@extends('layouts.template')

@section('stylesheet')
<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css" />

<style>
    .tab-pane{
        display:none;
        }
    .active{
        display:block;
    }
</style>


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
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#menu1"> <button type="button" onclick="active('menu1')" class="btn btn-inverse-primary btn-fw">รอ Screen</button></a></li>
                      <li><a data-toggle="tab" href="#menu2"><button type="button"  onclick="active('menu2')"  class="btn btn-inverse-success btn-fw">Screen แล้ว</button></a></li>
                    </ul>
                    <br>

                    {{-- body tab --}}
                    <div class="tab-content">
                      <div id="menu1" class="tab-pane active" >
                            <table  id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Screen #</th>
                                            <th>Date</th>
                                            <th>Order ID</th>
                                            <th>Customer name</th>
                                            <th>Saler name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2016/01/15</td>
                                            <td>od01</td>
                                            <td>Alphabet puzzle</td>
                                            <td>Alphabet puzzle</td>
                                            <td class="center">
                                            <div class="modal-footer">
                                               <a class="btn btn-primary btn-fw" href="#" style="padding: 10px 24px;" data-toggle="modal" data-target="#SALEINFO">
                                                   จัดการข้อมูล Screen
                                               </a>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2016/01/15</td>
                                            <td>od02</td>
                                            <td>Alphabet puzzle</td>
                                            <td>Alphabet puzzle</td>
                                            <td class="center">
                                            <div class="modal-footer">
                                               <a class="btn btn-primary btn-fw" href="{{ url('screen1') }}" style="padding: 10px 24px;" data-toggle="modal" data-target="#SALEINFO">
                                                   จัดการข้อมูล Screen
                                               </a>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2016/01/15</td>
                                            <td>od03</td>
                                            <td>Alphabet puzzle</td>
                                            <td>Alphabet puzzle</td>
                                            <td class="center">
                                            <div class="modal-footer">
                                               <a class="btn btn-primary btn-fw" href="{{ url('screen1') }}" style="padding: 10px 24px;" data-toggle="modal" data-target="#SALEINFO">
                                                   จัดการข้อมูล Screen
                                               </a>
                                            </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                      </div>

                      <div id="menu2" class="tab-pane fade">
                            <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Screen #</th>
                                            <th>Date</th>
                                            <th>Order ID</th>
                                            <th>Customer name</th>
                                            <th>Saler name</th>
                                            <th>Type of Group</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2015/05/22</td>
                                            <td>od055</td>
                                            <td>watunyou sl.</td>
                                            <td>Waruch Chu-min</td>
                                            <td>type#5</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2015/05/22</td>
                                            <td>od055</td>
                                            <td>watunyou sl.</td>
                                            <td>Waruch Chu-min</td>
                                            <td>type#6</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2015/05/22</td>
                                            <td>od055</td>
                                            <td>tester sl.</td>
                                            <td>Waruch Chu-min</td>
                                            <td>type#7</td>
                                        </tr>
                                    </tbody>
                                </table>
                      </div>
                    </div>
                    {{-- end body tab --}}
                </div>




                    <div class="modal fade" id="SALEINFO" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">

                                        <h4 class="modal-title" id="myModalLabel">Order: #12345</h4>
                                        <button type="button" class="btn btn-icons btn-rounded btn-closed" title="close" data-dismiss="modal"><i class="mdi mdi-close"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Saler ID : S-011</label><br>
                                        <label>Saler Name : Waruch Chu-min</label><br>
                                        <label>E-mial : chumin@mail.com</label>

                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-primary btn-fw" href="{{ url('screen1') }}" style="padding: 10px 24px;" >
                                                NEXT
                                        </a>
                                    </div>
                                </div>
                                 <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
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
        $(document).ready(function() {
            $('#example2').DataTable();
        } );
    </script>

    {{-- <script src="./js/tab-bootstrap/ajex-tab.min.js"></script> --}}
    <script src="./js/tab-bootstrap/bootstrap-tab.min.js"></script>
    <script src="/js/tab-bootstrap/bootstrap-tap.min.js"></script>

    <script>
        function active(id){
            if(id == 'menu1')
        {
            $('#'+id).toggleClass('active');
            $('#menu2').toggleClass('active');
        }
        else if(id == 'menu2')
        {
            $('#'+id).toggleClass('active');
            $('#menu1').toggleClass('active');
        }
        }

    </script>

@stop
