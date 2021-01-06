@extends('layouts.template')

@section('stylesheet')
<style>
        .button1 {
                 display:inline-block;
                 background-color:#ddd;
                 width: 100%;
                 height: 12%;
                 padding: 5px;
                 font-size:14px;
                 cursor: pointer;
                 border-radius: 4px;    
                 margin: 3px;
             }
       
        .radio-toolbar1 {
        margin: 10px;
        }

        .radio-toolbar1 input[type="radio"] {
            display:none;
        }

        .radio-toolbar1 label {
                 display:inline-block;
                 background-color:#ddd;
                 width:20%;
                 height: 15%;
                 padding: 15px;
                 font-size:14px;
                 cursor: pointer;
                 /* border: 2px solid #444; */
                 /* border-radius: 4px;     */
             }
        .radio-toolbar1 label:hover {
            color: #212529;
                background-color: #cddde5;
                border-color: #c4d7e1;
        }

        .radio-toolbar1 input[type="radio"]:checked + label {
            color: #fff;
                background-color: #19d895;
                border-color: #19d895;
        }

        .radio-toolbar {
           margin: 5px;
        }
        .radio-toolbar input[type="radio"] {
           display:none;
        }
        .radio-toolbar label {
            display:inline-block;
            background-color:#ddd;
            width: 100%;
            height: auto;
            padding: 10px;
            font-size:12px;

            /* border: 2px solid #444; */
            /* border-radius: 4px;     */
        }
        .radio-toolbar label:hover {
            background-color: #898989;
        }

        .radio-toolbar input[type="radio"]:checked + label {
            color: #fff;
            background-color: #19d895;
            border-color: #19d895;
        }
         
 
    .button{
            width: 70px;
            height: 35px;
            padding: 8px;
            font-size:12px;
    }
    .webkit-scrollbar-thumb {
            background: #888; 
        }
    </style>

@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <nav aria-label="breadcrumb"> 
        <h3 class="mb-0">
            <ol class="breadcrumb breadcrumb-custom bg-inverse-primary" align="center">
           
                <li class="breadcrumb-item active" aria-current="page">Company Master</li>
  
            </ol>
        </h3>
    </nav>
    <div class="row">
        <div class="col-lg-6">
            <div class="accordion basic-accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="orderRequestTypeID">
                        <h6 class="mb-0">
                            <a data-toggle="collapse" >
                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>ชื่อบริษัท
                            </a>
                        </h6>
                    </div>
                    <div  class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                        <div class="card-body text-center">
                            <div class="radio-toolbar1">
                                @foreach($data_company as $out_data_company)
                                    <input type="radio" id="{{ $out_data_company->Name }}" name="company" value="{{ $out_data_company->ID }}">
                                    <label for="{{ $out_data_company->Name}}" style="cursor:pointer;" >{{ $out_data_company->Name }}</label>
                                @endforeach
                            </div>
                            <br>
                            <br>
                            <br>
              
                            
                        </div>    
                             <br>
                            <br>
                            <br>
                        
                            <div class="col-lg-12 ">
                                <button type="submit" class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#ADDCOMPANY">
                                    เพิ่ม
                                </button>
                                    
                                <button type="submit" class="btn btn-outline-danger" align="right" data-toggle="modal" data-target="#DELETECOMPANY">
                                    ลบ
                                </button>
                            </div>
                    </div>
                </div>
            </div>      
        </div>
        
        <div class="col-lg-6">
            <div class="accordion basic-accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="orderRequestTypeID">
                        <a class="mb-0">
                            <a data-toggle="collapse"  >
                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i> รายละเอียดของบริษัท
                            </a>
                        </h6>
                    </div>
                    <div  class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                        <div class="card-body text-center">
                            <div class="wrapper">
                            
                                14 ซอย ราชวิถี 11 ถนน พญาไท แขวง ถนนพญาไท เขต ราชเทวี กรุงเทพมหานคร 10400
                            
                            </div>
                            <br>
                            <div class="col-lg-12 ">
                                <button type="submit" class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#ADDDETAILCOMPANY">
                                    เพิ่ม
                                </button>
                                    
                                <button type="submit" class="btn btn-outline-danger" align="right" data-toggle="modal" data-target="#DELETEDETAILCOMPANY">
                                    ลบ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="accordion basic-accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="orderRequestTypeID">
                        <h6 class="mb-0">
                            <a data-toggle="collapse"  >
                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>สาขาย่อย
                            </a>
                        </h6>
                    </div>
                        <div  class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="card-body text-center">
                                <div class="radio-toolbar text-center justify-content-center">
                                    @foreach($data_branch as $out_data_branch)
                                    <input type="radio" id="{{ $out_data_branch->ID }}" name="sub-company" value="{{ $out_data_branch->ID }}">
                                    <label for="{{ $out_data_branch->ID}}" style="cursor:pointer;" >{{ $out_data_branch->Name }}</label>
                                    @endforeach
                                </div>
                                <br>
                                <div class="col-lg-12 ">
                                    <button type="submit" class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#ADDSUBCOMPANY">
                                        เพิ่ม
                                    </button>
                                        
                                    <button type="submit" class="btn btn-outline-danger" align="right"  data-toggle="modal" data-target="#DELETESUBCOMPANY">
                                        ลบ
                                    </button>
                               </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="accordion basic-accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="orderRequestTypeID">
                        <h6 class="mb-0">
                            <a data-toggle="collapse"  >
                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i>ฝ่าย
                            </a>
                        </h6>
                    </div>
                        <div  class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                            <div class="card-body text-center">
                                <div class="radio-toolbar text-center justify-content-center" style="max-height: 280px;overflow-x:hidden;overflow-y: scroll;">
                                    @foreach($data_division as $out_data_division)
                                    <input type="radio" id="{{ $out_data_division->ID }}" name="division" value="{{ $out_data_division->ID }}">
                                    <label for="{{ $out_data_division->ID}}" style="cursor:pointer;" >{{ $out_data_division->Name }}</label>
                                    @endforeach
                                </div>
                                <br>
                                <div class="col-lg-12 ">
                                    <button type="submit" class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#ADDDIVISION">
                                        เพิ่ม
                                    </button>
                                        
                                    <button type="submit" class="btn btn-outline-danger" align="right"  data-toggle="modal" data-target="#DELETEDIVISION">
                                        ลบ
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="accordion basic-accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="orderRequestTypeID">
                        <h6 class="mb-0">
                            <a data-toggle="collapse"  >
                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i> เเผนก
                            </a>
                        </h6>
                    </div>
                            <div  class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-center">
                                    <div class="radio-toolbar text-center justify-content-center" style="max-height: 280px;overflow-x:hidden;overflow-y: scroll;">
                                        @foreach($data_department as $out_data_department)
                                        <input type="radio" id="{{ $out_data_department->Name }}" name="department" value="{{ $out_data_department->ID }}">
                                        <label for="{{ $out_data_department->Name}}" style="cursor:pointer;" >{{ $out_data_department->Name }}</label>
                                        @endforeach
                                    </div>
                                    <br>
                                    <div class="col-lg-12 ">
                                        <button type="submit" class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#ADDDEPARTMENT">
                                            เพิ่ม
                                        </button>
                                            
                                        <button type="submit" class="btn btn-outline-danger" align="right"  data-toggle="modal" data-target="#DELETEDEPARTMENT">
                                            ลบ
                                        </button>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="accordion basic-accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="orderRequestTypeID">
                        <h6 class="mb-0">
                            <a data-toggle="collapse"  >
                                <i class="card-icon mdi mdi-checkbox-marked-circle-outline"></i> เเผนกย่อย
                            </a>
                        </h6>
                    </div>
                            <div  class="collapse show" role="tabpanel" aria-labelledby="orderRequestTypeID">
                                <div class="card-body text-center">
                                    <div class="radio-toolbar text-center justify-content-center" style="max-height: 280px;overflow-x:hidden;overflow-y: scroll;">
                                        @foreach($data_sub_department as $data_sub_department)
                                        <input type="radio" id="{{ $data_sub_department->Name }}" name="sub-department" value="{{ $data_sub_department->ID }}">
                                        <label for="{{ $data_sub_department->Name}}" style="cursor:pointer;" >{{ $data_sub_department->Name }}</label>
                                        @endforeach
                                    </div>
                                    <br>
                                    <div class="col-lg-12 ">
                                        <button type="submit" class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#ADDSUBDEPARTMENT">
                                            เพิ่ม
                                        </button>
                                            
                                        <button type="submit" class="btn btn-outline-danger" align="right" data-toggle="modal" data-target="#DELETESUBDEPARTMENT">
                                            ลบ
                                        </button>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
            <!-- pop up company -->
                <div class="modal fade" id="ADDCOMPANY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            บริษัท
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
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" >
                                                    เพิ่มบริษัท
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="modal fade" id="DELETECOMPANY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                        <div class="modal-dialog modal-lg" role="document" style="width:500px">
							<div class="modal-content">
							    <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            ลบบริษัท
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
								</div>
								<div class="modal-body">
									<b>คุณเเน่ใจว่าต้องการลบบริษัท</b>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									<a class="btn btn-danger" href="#"  role="button" type="submit">ลบ</a>
								</div>
							</div>
						</div>
					</div>
                <!-- END pop up company -->

                <!-- pop up detail company -->
                <div class="modal fade" id="ADDDETAILCOMPANY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            รายละเอียดของบริษัท
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
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" >
                                                    เพิ่มรายละเอียดของบริษัท
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="modal fade" id="DELETEDETAILCOMPANY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                        <div class="modal-dialog modal-lg" role="document" style="width:500px">
							<div class="modal-content">
							    <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                             ลบรายละเอียดของบริษัท
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
								</div>
								<div class="modal-body">
									<b>คุณเเน่ใจว่าจะลบรายละเอียดของบริษัท</b>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									<a class="btn btn-danger" href="#"  role="button" type="submit">ลบ</a>
								</div>
							</div>
						</div>
					</div>
                <!-- END pop up company -->

                <!-- pop up sub-company -->
                <div class="modal fade" id="ADDSUBCOMPANY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            สาขาย่อย
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
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" >
                                                    เพิ่มสาขาย่อย
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="modal fade" id="DELETESUBCOMPANY" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                        <div class="modal-dialog modal-lg" role="document" style="width:500px">
							<div class="modal-content">
							    <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                             ลบสาขาย่อย
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
								</div>
								<div class="modal-body">
									<b>คุณเเน่ใจว่าจะลบสาขาย่อย</b>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									<a class="btn btn-danger" href="#"  role="button" type="submit">ลบ</a>
								</div>
							</div>
						</div>
					</div>
                <!-- END pop up sub-company-->

                
                <!-- pop up DIVISION -->
                <div class="modal fade" id="ADDDIVISION" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            ฝ่าย
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
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" >
                                                    เพิ่มฝ่าย
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="modal fade" id="DELETEDIVISION" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                        <div class="modal-dialog modal-lg" role="document" style="width:500px">
							<div class="modal-content">
							    <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                             ลบฝ่าย
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
								</div>
								<div class="modal-body">
									<b>คุณเเน่ใจว่าจะลบฝ่าย</b>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									<a class="btn btn-danger" href="#"  role="button" type="submit">ลบ</a>
								</div>
							</div>
						</div>
					</div>
                <!-- END pop up DIVISION -->

                <!-- pop up DEPARTMENT -->
                <div class="modal fade" id="ADDDEPARTMENT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            เเผนก
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
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" >
                                                    เพิ่มเเผนก
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="modal fade" id="DELETEDEPARTMENT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                        <div class="modal-dialog modal-lg" role="document" style="width:500px">
							<div class="modal-content">
							    <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                             ลบเเผลก
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
								</div>
								<div class="modal-body">
									<b>คุณเเน่ใจว่าจะลบเเผลก</b>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									<a class="btn btn-danger" href="#"  role="button" type="submit">ลบ</a>
								</div>
							</div>
						</div>
					</div>
                <!-- END pop up DEPARTMENT -->

                <!-- pop up SUBDEPARTMENT -->
                <div class="modal fade" id="ADDSUBDEPARTMENT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" >
                    <div class="modal-dialog modal-lg" role="document" style="width:500px">
                        <div class="modal-content">
                            <div class="card">
                                <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                            เเผนกย่อย
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
                                                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-lg btn-block" >
                                                    เพิ่มเเผนกย่อย
                                                </button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="modal fade" id="DELETESUBDEPARTMENT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
                        <div class="modal-dialog modal-lg" role="document" style="width:500px">
							<div class="modal-content">
							    <div class="card-header header-sm">
                                    <label class="font-weight-bold">
                                             ลบเเผลกย่อย
                                    </label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
								</div>
								<div class="modal-body">
									<b>คุณเเน่ใจว่าจะลบเเผลกย่อย</b>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
									<a class="btn btn-danger" href="#"  role="button" type="submit">ลบ</a>
								</div>
							</div>
						</div>
					</div>
                <!-- END pop up SUBDEPARTMENT -->


</div>
@stop

@section('scripts')

@stop
