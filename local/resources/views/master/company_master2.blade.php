@extends('layouts.template')

@section('stylesheet')
<style>
        .button1 {
                 display:inline-block;
                 background-color:#ddd;
                 width: 30%;
                 height: 15%;
                 padding: 20px;
                 font-size:12px;
                 cursor: pointer;
                 border: none;
                 margin: 3px;
             }
        .button1:hover
            {
                background-color: #19d895;
                color: white;
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
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
              <h4>Company Master</h4>
            </div>
          </div>
        <div class="row mt-3">
            <div class="col-md-3 m-0 step-timeline">
              <ul class="m-0 step-list">
                <li>ชื่อบริษัท</li>
                <li class="yellow">สาขาย่อย</li>
                <li class="white">ฝ่าย</li>
                <li class="white">เเผนก</li>
                <li class="white">เเผนกย่อย</li>
              </ul>
            </div>
            <div class="col-md-9 step-content">
                    <div class="form-group row">
                            <div class="col-lg-12">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-custom bg-inverse-primary">
                                                <li class="breadcrumb-item active" aria-current="page">เลือกสาขาย่อย</li>
                                        </ol>
                                    </nav>
                                <div class="accordion basic-accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" >
                                    <h6 class="mb-0">
                                        <a  aria-expanded="true" >
                                        <i class="card-icon mdi fa-university"></i>
                                          สาขาย่อย
                                        </a>
                                    </h6>
                                    </div>
                                    <div class="collapse show" >
                                        <div class="card-body text-center">
                                           <div class="checkbox-toolbar">
                                                @foreach($data_branch as $out_data_branch)
                                                    <a href = "{{ url('company_master2/').'/'.$out_data_branch->ID }}" >
                                                        <button type="button" class="button1">
                                                           {{ $out_data_branch->Name}}
                                                        </button>
                                                    </a>
                                                @endforeach
                                                <br>
                                                <br>
                                                <br>
                                                <div class="col-lg-12 ">
                                                    <button class="btn btn-outline-success" align="left" data-toggle="modal" data-target="#">
                                                        เพิ่ม
                                                    </button>

                                                    <button  class="btn btn-outline-danger" align="right" data-toggle="modal" data-target="#">
                                                        เเก้ใข
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
        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                <a href="javascript:history.go(-1)">
                    <button type="button" class="btn btn-lg btn-success">
                        <i class="mdi mdi-arrow-left-bold"></i>
                        ย้อนกลับ
                    </button>
                </a>
                {{-- <a href="{{ url('order3') }}">
                    <button class="btn btn-lg btn-success">
                        Next Step
                        <i class="mdi mdi-arrow-right-bold"></i>
                    </button>
                </a> --}}
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
