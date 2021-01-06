@extends('layouts.template')

@section('title', 'ผลิต')

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/dataTables/bootstrap.min.css') }}" type="text/css" />

<style>
    @media print{
        .no-print{ display:none; }
    },
    th{
        text-align:center;
    }
</style>
<style>
        table{
            font-size: 13px;
        }
        /* The container */
        .container {
          display: block;
          position: relative;
          padding-left: 35px;
          margin-bottom: 12px;
          cursor: pointer;
          font-size: 15px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
          position: absolute;
          opacity: 0;
          cursor: pointer;
          height: 0;
          width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
          position: absolute;
          top: 0;
          left: 0;
          height: 25px;
          width: 25px;
          background-color:grey ;
          border-radius: 210px;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
          background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
          background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
          content: "";
          position: absolute;
          display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
          display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
          left: 9px;
          top: 5px;
          width: 5px;
          height: 10px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
        }

        table{
            font-size: 13px;
        }
</style>
<style>
    .hide{
        display: none;
    }
</style>
@stop

@section('content')
<input type="hidden" id="massage" value="{{ Session::get('message') }}">
{{-- @if (Session::has('message'))
    <div class="modal" id="ModalMassage" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color:red">แจ้งเตือน !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ Session::get('message') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif --}}

{{-- @if (session('message'))
    <br/>
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif --}}


<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row no-print">
                        <div class="col-12  text-center">
                            <h3>
                                <b>จ่ายงานแผนก
                                    {{ $name_department->Name }}
                                </b>
                            </h3>
                        </div>
                        <br>
                    </div>

                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="ourgoal" role="tabpanel" aria-labelledby="profile-tab">
                        {{-- {{ Form::open(['method' => 'post' , 'url' => '/job/'.$id_job.'/sub_depart']) }} --}}
                            <div class="row">
                                <label class="col-form-label col-sm-3" for="Barcode"><p class="card-description" style="font-size:18px;">สแกนบาร์โค้ด <span style="color:red;">บัตรพนักงาน</span> </p></label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="mdi mdi-barcode-scan"></i></span>
                                        </div>
                                        {{ Form::text('usercode',null, ['class' => 'form-control','placeholder' => 'บัตรพนักงาน','id' => 'scanbarcode_pd','autofocus'])}}
                                            <button class="btn btn-outline-success" style="margin-right: 20px;" id="req_employee_dept" data-toggle="modal" data-target="#subDeprt">ยืนยัน</button>
                                            
                                            <button class="btn btn-outline-warning" style="padding-right: 10px;padding-left: 10px;"
                                                id="req_employee_dept_2" data-toggle="modal" data-target="#subDeprt2">มีงานมากกว่า 1 ชนิด</button>
                                    </div>
                                </div>
                            </div>
                        {{-- {{ Form::close()}} --}}

                        @foreach( $count as $out_count)
                            <input type="hidden" value="{{ $out_count->count }}" id="count">
                        @endforeach
                        <table id="example2" class="table-striped table-bordered display compact nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ชื่อพนักงาน</th>
                                    <th>บาร์โค้ด บัตรพนักงาน</th>
                                    <th>บริษัท</th>
                                    <th>สาขา</th>
                                    {{-- <th>จำนวนงานที่ทำ (วันนี้)</th> --}}
                                    {{-- <th>รายละเอียดงานที่ทำ (วันนี้)</th> --}}
                                </tr>
                            </thead>
                             <tbody>
                                 @php $countNo = 1; @endphp
                                @foreach ($all_subDepartment as $all_subD)
                                <tr>
                                    <td>{{ $countNo++ }}</td>
                                    <td>{{ $all_subD->Nick_name }}</td>
                                    <td>{{ $all_subD->username }}</td>
                                    <td>{{ $all_subD->company }}</td>
                                    <td>{{ $all_subD->Branch }}</td>
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
</div>

{{-- รับงานเข้าแผนก --}}
        {{-- <div class="modal fade show" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg" role="document" style="width:420px;">
                <div class="modal-content">
                    <div class="card-header align-items-center text-center">
                        <label class="font-weight-bold ">
                            รับงาน
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    {{ Form::open(['method' => 'post' , 'url' => '/job/scan/'.$id_job]) }}
                    <div class="col-sm-12" style="padding-bottom: 10px;">
                            <div class="control-group">
                                <div class="inc2">
                                    <label class="col-form-label col-sm-12"  for="Barcode">
                                            <p class="card-description" style="font-size:15px;"> สแกนบาร์โค๊ดงาน รับเข้าแผนก : </p>
                                    </label>
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <input type="hidden" id="append2" name="append2" >
                                            <input class='form-control' name='Barcode[]' style="height: 32px; padding-bottom: 5px;padding-top: 5px;" type="text" id="firstButton" onkeydown="if (event.keyCode == 13) {
                                                return false;
                                            }" autofocus />
                                        </div>
                                        <button class="btn btn-outline-success" style="padding-right: 10px;padding-left: 10px;">ยืนยัน</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{ Form::close()}}
                </div>
            </div>
        </div> --}}

        {{-- subDeprt --}}
        <div class="modal fade" id="subDeprt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width:60%;">
                <div class="modal-content">
                    <div class="card-header align-items-center text-center">
                        <label class="font-weight-bold ">
                            รับงานแผนกย่อย
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        {{ Form::open(['method' => 'post' , 'url' => '/job/scan/sub_depart/'.$id_job ,"style"=>"padding-bottom: 10px;", 'files'=>true])}}
                        {!! csrf_field() !!}
                        
                    <div class="col-sm-12" style="padding-bottom: 10px;padding-top: 10px;" id="dept_data">
                    </div>
                    {{-- ////////แนบภาพ --}}
                    <div class="col-sm-12" style="padding-bottom: 10px;padding-top: 10px;">
                           <div class="col-sm-3">
                                            <b>แนบภาพตรวจอุปกรณ์</b>
                                     </div>
                            <div class="col-6">
                            <div class="form-group mt-1">
                            <input type="file" name="txtFile" class="file-upload-default txtFile">
                            <div class="input-group col-xs-12">
                                <input type="text" value="{{--$file->tc_file--}}" class="form-control file-upload-info file-name txtFileName" placeholder="ชื่อไฟล์" style="padding: 1px 1px 1px 1px;" disabled>
                                <span class="input-group-append">
                                <button type="button" class="file-upload-browse btn btn-outline-success" title="แนบไฟล์">
                                    <i class="fa fa-paperclip"></i>
                                </button>
                                
                                {{-- <button type="button" onclick="saveFile()" class="btn btn-success"  title="บันทึก">
                                    {{-- upload --}}
                                    {{-- <span class="fa fa-camera"></span> 
                                </button> --}}
                            </div>
                            </div>
                            </div>         
                    </div>

                    <div class="col-sm-12">
                        <div class="control-group">
                            <div class="inc">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <b>สแกนบาร์โค๊ดงาน</b>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="hidden" id="append" name="append" >
                                        <input class='form-control' name='job[]' style="height: 32px; padding-bottom: 5px;padding-top: 5px;" type="text" id="secondaryButton1" onkeydown="if (event.keyCode == 13) {
                                            return false;
                                        }" autofocus />
                                    </div>
                                    <button class="btn btn-outline-success"   style="padding-right: 10px;padding-left: 10px;">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        {{-- รับงานมากกว่า2ชนิด --}}
        <div class="modal fade" id="subDeprt2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width:60%;">
                <div class="modal-content">
                    <div class="card-header align-items-center text-center">
                        <label class="font-weight-bold ">
                            รับงานแผนกย่อย
                        </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        {{ Form::open(['method' => 'post' , 'url' => '/job/scan/sub_depart2/'.$id_job ,"style"=>"padding-bottom: 10px;"]) }}
                    
                    <div class="col-sm-12" style="padding-bottom: 10px;padding-top: 10px;" id="dept_data2">
                    </div>

                    <div class="col-sm-12">
                        <div class="control-group">
                            <div class="inc">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <b>สแกนบาร์โค๊ดงาน</b>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="hidden" id="append" name="append" >
                                        <input class='form-control' name='job2[]' style="height: 32px; padding-bottom: 5px;padding-top: 5px;" type="text" id="secondaryButton1_2" onkeydown="if (event.keyCode == 13) { return false;}" autofocus />
                                    </div>
                                    <input type="button" class="btn btn-outline-success" value="ยืนยัน" onclick="select_typeProduct($('#secondaryButton1_2').val())" style="border:solid 1px;" />
                                    <br>
                                    <div class="col-sm-12" style="padding-bottom: 10px;padding-top: 10px;"  id="show_typeProduct">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
@stop
@section('scripts')

<script src="{{ asset('./js/shared/alerts.js') }}"></script>
<script src="{{ asset('./js/shared/avgrund.js') }}"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#ModalMassage').modal('show');
    });
</script>
<script>
    $(document).ready(function(){
    // if($('#count').val() == 1){
    //     $(window).on('load',function(){  
    //         $('#subDeprt1').modal('show');
    //     });
    // }
        if($('#count').val() > 0){
            $(window).on('load',function(){
                $('#whoweare').removeClass('active show');
                $('#home-tab').removeClass('active');
                $('#QC').removeClass('active');
                $('#ourgoal2').removeClass('show');

                $('#subDeprt').modal('show');
                $('#ModalMassage').modal('show');
                $('#profile-tab').addClass('active');
                $('#ourgoal').addClass('show');
            });
        }
    });
</script>
<script>
    function CheckQC($idjob,$idQC){
        // alert(1);
        document.getElementById('note'+$idjob+' '+$idQC).value;
        if(document.getElementById('checkboxcom'+$idjob+' '+$idQC).checked == true){
            document.getElementById('note'+$idjob+' '+$idQC).disabled = false;
        }else{
            document.getElementById('note'+$idjob+' '+$idQC).disabled = true;
        }
    }
</script>
<script>
    jQuery(document).ready( function () {
            n = 2;
            $("#secondaryButton1").keydown( function() {
                if(event.keyCode == 13){
                    $( "#append" ).click();
                    return false;
                }
            });
            $("#append").click( function(e) {
                e.preventDefault();
                $(".inc").append("<div>\<div class='row'>\
                    <div class='col-sm-10'>\
                    <div class='input-group'>\
                    <input name='job[]' type='text' class='form-control' id='secondaryButton"+n+"' onkeydown='if (event.keyCode == 13) { \
                    return false;\
                    }' autofocus style='height: 32px; padding-bottom: 5px;padding-top: 5px;' /></div>\
                    </div>\
                <div class='col-sm-1'>\
                    <a href='#' class='remove_this btn btn-danger'style='padding-right: 10px;padding-left: 10px;'>X</a>\
                </div>\
                </div>\
                </div>\
                ");
                $("#secondaryButton"+n).val($("#secondaryButton1").val());
                $("#secondaryButton1").val('');
                n = n+1;
            });
        jQuery(document).on('click', '.remove_this', function() {
            jQuery(this).parent().parent().parent().remove();
            $("#secondaryButton1").focus();
            return false;
            });
        var massage =  $("#massage").val();
        if(massage != ""){
            alert(massage);
        }
    });
</script>
<script>
    jQuery(document).ready( function () {
            n = 2;
            $("#secondaryButtonQC1").keydown( function() {
                if(event.keyCode == 13){
                    $( "#appendQC" ).click();
                    return false;
                }
            });
            $("#appendQC").click( function(e) {
                e.preventDefault();
                $(".incQC").append("<div>\<div class='row'>\
                    <div class='col-sm-10'>\
                    <div class='input-group'>\
                    <input name='job[]' type='text' class='form-control' id='secondaryButtonQC"+n+"' onkeydown='if (event.keyCode == 13) { \
                    return false;\
                    }' autofocus style='height: 32px; padding-bottom: 5px;padding-top: 5px;' /></div>\
                    </div>\
                <div class='col-sm-1'>\
                    <a href='#' class='remove_this btn btn-danger'style='padding-right: 10px;padding-left: 10px;'>X</a>\
                </div>\
                </div>\
                </div>\
                ");
                $("#secondaryButtonQC"+n).val($("#secondaryButtonQC1").val());
                $("#secondaryButtonQC1").val('');
                n = n+1;
            });
        jQuery(document).on('click', '.remove_this', function() {
            jQuery(this).parent().parent().parent().remove();
            $("#secondaryButtonQC1").focus();
            return false;
            });
    });
</script>

<script>
    jQuery(document).ready( function () {
            n = 3;
            $("#firstButton").keydown( function() {
                if(event.keyCode == 13){
                    $( "#append2" ).click();
                    return false;
                }
            });
            $("#append2").click( function(e) {
                e.preventDefault();
                $(".inc2").append("<div>\<div class='row'>\
                    <div class='col-sm-10'>\
                    <div class='input-group'>\
                    <input name='Barcode[]' type='text' class='form-control' id='firstButton2["+n+"]' onkeydown='if (event.keyCode == 13) { \
                    return false;\
                    }' autofocus style='height: 32px; padding-bottom: 5px;padding-top: 5px;' /></div>\
                    </div>\
                <div class='col-sm-1'>\
                    <a href='#' class='remove_this btn btn-danger' style='padding-right: 10px;padding-left: 10px;'>X</a>\
                </div>\
                </div>\
                </div>\
                ");
                $("#firstButton2\\["+n+"\\]").val($("#firstButton").val());
                $("#firstButton").val('');
                n = n+1;
            });
        jQuery(document).on('click', '.remove_this', function() {
            jQuery(this).parent().parent().parent().remove();
            $("#firstButton").focus();
            return false;
            });
    });

    function onclick1($id,$id2){
        if(document.getElementById('radiocom'+$id+' '+$id2).checked == false && document.getElementById('radiouncom'+$id+' '+$id2).checked == true){
            document.getElementById('count').value;
            a = parseInt(document.getElementById('count').value);
            b = a-1;
            c = parseInt(document.getElementById('lenght').value);
            document.getElementById('count').value = b;
            if(b!=c){
                document.getElementById("QC_submit"+$id).disabled = true;
                document.getElementById("QC_nonsubmit"+$id).disabled = false;
            }
            else if(b==c){
                document.getElementById("QC_submit"+$id).disabled = false;
                document.getElementById("QC_nonsubmit"+$id).disabled = true;

            }else{
                document.getElementById("QC_submit"+$id).disabled = true;
                document.getElementById("QC_nonsubmit"+$id).disabled = true;
            }
        }
        else if(document.getElementById('radiouncom'+$id+' '+$id2).checked == false && document.getElementById('radiocom'+$id+' '+$id2).checked == true){
            document.getElementById('count').value;
            a =parseInt(document.getElementById('count').value);
            b = a+1;
            c = parseInt(document.getElementById('lenght').value);
            document.getElementById('count').value = b;
            if(b!=c){
                document.getElementById("QC_submit"+$id).disabled = true;
                document.getElementById("QC_nonsubmit"+$id).disabled = false;
            }
            else if(b==c){
                document.getElementById("QC_submit"+$id).disabled = false;
                document.getElementById("QC_nonsubmit"+$id).disabled = true;

            }else{
                document.getElementById("QC_submit"+$id).disabled = true;
                document.getElementById("QC_nonsubmit"+$id).disabled = true;
            }
        }
    }
    function onclick2($id,$id2){
        if(document.getElementById('fqc'+$id+' '+$id2).checked == false){
            document.getElementById('count2'+$id).value;
            a = parseInt(document.getElementById('count2'+$id).value);
            b = a+1;
            document.getElementById('count2'+$id).value = b;
            if(b==0){
                document.getElementById("FQC_submit"+$id).disabled = false;
                document.getElementById("FQC_nonsubmit"+$id).disabled = true;
            }
            else{
                document.getElementById("FQC_submit"+$id).disabled = true;
                document.getElementById("FQC_nonsubmit"+$id).disabled = false;
            }
        }
        else{
            document.getElementById('count2'+$id).value;
            a =parseInt(document.getElementById('count2'+$id).value);
            b = a-1;
            document.getElementById('count2'+$id).value = b;
            if(b==0){
            document.getElementById("FQC_submit"+$id).disabled = false;
            document.getElementById("FQC_nonsubmit"+$id).disabled = true;
            }
            else{
            document.getElementById("FQC_submit"+$id).disabled = true;
            document.getElementById("FQC_nonsubmit"+$id).disabled = false;
            }
        }
    }
</script>
<script>
    function checkOnlyOne(name,id){
        $('input[name="'+name+'"]').not('#'+id).prop('checked', false);
    }
</script>
<script>

    $('#example1').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    $('#example2').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );
    $('#example3').DataTable(
    {
        //"scrollX": true,
        "aaSorting": [],
        "paging": true
    }
    );


    $(document).ready(function() {
        $('#defaultModal').on('shown.bs.modal', function() {
          $('#firstButton').trigger('focus');
        });
      });

      $(document).ready(function() {
        $('#subDeprt').on('shown.bs.modal', function() {
          $('#secondaryButton1').trigger('focus');
        });
      });

      $('#ourgoal-tab').hasClass('show',function() {
            $('#scanbarcode_pd').trigger('focus');
      });

</script>

<script>
    $("#scanbarcode_qc").keydown( function() {
        $("#Employee").val($("#scanbarcode_qc").val());
    });
</script>

<script>
    $("#req_employee_dept").on('click', function() {
        var scanbarcode_pd = $('#scanbarcode_pd').val();
        var id_department = '{{ $name_department->ID }}';

        $.ajax({
            type: 'GET',
            url: '{{ url('req_employee_dept') }}',
            data: {scanbarcode_pd:scanbarcode_pd,id_department:id_department},
            success: function (data) {
               var str = '';

                if (data == 'บาร์โค้ดไม่ถูกต้อง') {
                    var str =  '<b style="color:red;">'+data+'</b>';
                } else {

                    if (data[0][0].type_dep != 'qc' && data[0][0].Sub_DepartmentID != 7) { // แสดงแผนกหลัก แต่ ไม่แสดง หาก Qc เป็นแผนกหลัก
                        var str = '<label class="container"> '+data[0][0].Name+'\
                                 <input name="sub_depart[]" checked type="checkbox" id="1subDepartment" value="'+data[0][0].Sub_DepartmentID+'"> <br>\
                                 <span class="checkmark"></span>\
                              </label>';
                    }
                    for (let index = 0; index < data[1].length; index++) { // แสดง แผนกที่เหลือ
                    // console.log(data[1][index].Sub_DepartmentID);
                        if (data[1][index].Sub_DepartmentID != 7) { 
                    // console.log(data[1][index].Sub_DepartmentID);
                            
                            str = str + '<label class="container"> '+data[1][index].Name+'\
                                            <input name="sub_depart[]" type="checkbox" id="1subDepartment" value="'+data[1][index].Sub_DepartmentID+'"> <br>\
                                            <span class="checkmark"></span>\
                                        </label>';
                                        /////////////////////แนบภาพ
                            // if(data[1][index].Name == 'ตรวจอุปกรณ์'){
                            // str = str + '\
                            //             <div class="col-6">\
                            //             <div class="form-group mt-1">\
                            //             <input type="file" name="txtFile" class="file-upload-default txtFile">\
                            //             <div class="input-group col-xs-12">\
                            //                 <input type="text" value="{{--$file->tc_file--}}" class="form-control file-upload-info file-name txtFileName" placeholder="ชื่อไฟล์" style="padding: 1px 1px 1px 1px;" disabled>\
                            //                 <span class="input-group-append">\
                            //                 <button type="button" class="file-upload-browse btn btn-outline-success" title="แนบไฟล์">\
                            //                     <i class="fa fa-paperclip"></i>\
                            //                 </button>\
                            //                 <button type="button" onclick="saveFile("124")" class="btn btn-success"  title="บันทึก">\
                            //                     {{-- upload --}}\
                            //                     <span class="fa fa-camera"></span>\
                            //                 </button>\
                            //             </div>\
                            //             </div>\
                            //             </div>\
                            //         </div>\
                            //     ';
                            // }
                            
                        }
                        
                    }

                    if (data[0][0].type_dep != 'qc' && data[0][0].Sub_DepartmentID == 7) { // แสดงแผนกหลัก แต่ ไม่แสดง หาก Qc เป็นแผนกหลัก
                         str = str + '<label class="container"> '+data[0][0].Name+'\
                                 <input name="sub_depart[]" checked type="checkbox" id="1subDepartment" value="'+data[0][0].Sub_DepartmentID+'"> <br>\
                                 <span class="checkmark"></span>\
                              </label>';
                    }
                    for (let index = 0; index < data[1].length; index++) { // แสดง แผนกที่เหลือ
                        if (data[1][index].Sub_DepartmentID == 7) { 
                            str = str + '<label class="container"> '+data[1][index].Name+'\
                                            <input name="sub_depart[]" type="checkbox" id="1subDepartment" value="'+data[1][index].Sub_DepartmentID+'"> <br>\
                                            <span class="checkmark"></span>\
                                        </label>';
                        }
                        
                    }

                    str = str + '<input type="hidden" id="EmployeeID" name="EmployeeID" value="'+data[0][0].user_id+'">';


                }
               
               $('#dept_data').html(str);
               
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });
</script>
<script>
    $("#req_employee_dept_2").on('click', function() {
        console.log('x');
        var scanbarcode_pd = $('#scanbarcode_pd').val();
        var id_department = '{{ $name_department->ID }}';

        $.ajax({
            type: 'GET',
            url: '{{ url('req_employee_dept') }}',
            data: {scanbarcode_pd:scanbarcode_pd,id_department:id_department},
            success: function (data) {
               var str = '';

                if (data == 'บาร์โค้ดไม่ถูกต้อง') {
                    var str =  '<b style="color:red;">'+data+'</b>';
                } else {

                    if (data[0][0].type_dep != 'qc' && data[0][0].Sub_DepartmentID != 7) { // แสดงแผนกหลัก แต่ ไม่แสดง หาก Qc เป็นแผนกหลัก
                        var str = '<label class="container"> '+data[0][0].Name+'\
                                 <input name="sub_depart[]" checked type="checkbox" id="1subDepartment" value="'+data[0][0].Sub_DepartmentID+'"> <br>\
                                 <span class="checkmark"></span>\
                              </label>';
                    }
                    for (let index = 0; index < data[1].length; index++) { // แสดง แผนกที่เหลือ
                    // console.log(data[1][index].Sub_DepartmentID);
                        if (data[1][index].Sub_DepartmentID != 7) { 
                    // console.log(data[1][index].Sub_DepartmentID);
                            
                            str = str + '<label class="container"> '+data[1][index].Name+'\
                                            <input name="sub_depart[]" type="checkbox" id="1subDepartment" value="'+data[1][index].Sub_DepartmentID+'"> <br>\
                                            <span class="checkmark"></span>\
                                        </label>';
                        }
                        
                    }

                    if (data[0][0].type_dep != 'qc' && data[0][0].Sub_DepartmentID == 7) { // แสดงแผนกหลัก แต่ ไม่แสดง หาก Qc เป็นแผนกหลัก
                         str = str + '<label class="container"> '+data[0][0].Name+'\
                                 <input name="sub_depart[]" checked type="checkbox" id="1subDepartment" value="'+data[0][0].Sub_DepartmentID+'"> <br>\
                                 <span class="checkmark"></span>\
                              </label>';
                    }
                    for (let index = 0; index < data[1].length; index++) { // แสดง แผนกที่เหลือ
                        if (data[1][index].Sub_DepartmentID == 7) { 
                            str = str + '<label class="container"> '+data[1][index].Name+'\
                                            <input name="sub_depart[]" type="checkbox" id="1subDepartment" value="'+data[1][index].Sub_DepartmentID+'"> <br>\
                                            <span class="checkmark"></span>\
                                        </label>';
                        }
                        
                    }

                    str = str + '<input type="hidden" id="EmployeeID" name="EmployeeID" value="'+data[0][0].user_id+'">';


                }
               
               $('#dept_data2').html(str);
               
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });
</script>
{{-- datatables --}}
<script>
        var id_job = '{{ $id_job }}'
        var table = $('#department').DataTable({
            "scrollX": false,
            orderCellsTop: true,
            fixedHeader: true,
            ajax: {
                    url: '{{ url('ajax_get_data_job') }}',
                    data: {id_job:id_job},
            },
            columns: [
                { data: 'DeliverDate', name: 'DeliverDate' },
                { data: 'DeliverType', name: 'DeliverType' },
                { data: 'company_name', name: 'company_name' },
                { data: 'Zonename', name: 'Zonename' },
                { data: 'ID_area', name: 'ID_area' },
                { data: 'Barcode', name: 'Barcode' },
                { data: 'doctor', name: 'doctor' },
                { data: 'customer', name: 'customer' },
                { data: 'PatientName', name: 'PatientName' },
                { data: 'StartDate', name: 'StartDate' },
                { data: 'DeliverDate', name: 'DeliverDate' },
                { data: 'production_cycle', name: 'production_cycle' },
                { data: 'type_of_product', name: 'type_of_product' },
                { data: 'RefBarcode', name: 'RefBarcode' },
            ],
            columnDefs: [
                {
                    "targets": 0,   render: function(data, type, row)
                    {
                        if(data == null || data == ''){
                            return 'ไม่ระบุวันส่งงาน';
                        }else{
                            var c = data.split('/');
                            var FormatDay =  new Date(c[2],c[1]-1,c[0]);

                            var days = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
                            var daysWeek = days[ FormatDay.getDay() ];

                            if (daysWeek == 'อาทิตย์') {
                                return "<div style='background-color:#FF0000;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'จันทร์') {
                                return "<div style='background-color:#FFFF00;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'อังคาร') {
                                return "<div style='background-color:#FF0066;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'พุธ') {
                                return "<div style='background-color:#32CD32;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'พฤหัสบดี') {
                                return "<div style='background-color:#FF8C00;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'ศุกร์') {
                                return "<div style='background-color:#1E90FF;padding: 2px;'>"+daysWeek+"</div>" ;
                            }else if(daysWeek == 'เสาร์') {
                                return "<div style='background-color:#990099;padding: 2px;'>"+daysWeek+"</div>" ;
                            }
                        }

                    },
                    orderable: true,
                    "className": "text-center",
                },
                {
                    "targets": 1,  render: function(data, type, row) {
                        if(data == 'ด่วน' || data == 'ด่วนรับปาก'){
                            return '<span style="display:none;">'+row['DeliverDate']+'</span> <div style="background-color:#FF0000;padding: 4px;"><font color="white" >'+data+'</font></div>';
                        }
                        else{
                            return data;
                        }
                    },
                    "className": "text-center",
                    orderable: false,
                },
                {
                    "targets": 2,
                    "className": "text-center",
                },
            {
                "targets": 3
            },
            {
                "targets": 4
            },
            {
                "targets": 5 , render: function(data, type, row) {
                    return '<a href="../summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                },
                "className": "text-center",
            },
            {
                "targets": 6
            },
            {
                "targets": 7
            },
            {
                "targets": 8
            },
            {
                "targets": 9,
                render: function(data, type, row) {
                    if(data!= null && data != ''){
                        var day = data;
                        day = day.split("/");
                        return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                    } else {
                        return null;
                    }
                },
                "className": "text-center",
            },
                {
                    "targets": 10,
                    render: function(data, type, row) {
                        if(data!= null && data != ''){
                            var day = data;
                            day = day.split("/");
                            return "<div class='hide'>"+day[2]+day[1]+day[0]+"</div>"+data
                        } else {
                            return null;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 11,  render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            return data;
                        }
                    },
                    "className": "text-center",
                },
                {
                    "targets": 12,  render: function(data, type, row) {
                        if(data == null || data == ''){
                            return '-';
                        }else{
                            return data;
                        }
                    },
                },
            {
                    "targets": 13, render: function(data,type,row){
                        if(row['RefBarcode']){
                            return '<font color="red">งานแก้</font>';
                        }else if(row['ContiBarcode']){
                            return '<font color="blue">งานต่อเนื่อง</font>';
                        }else{
                            return 'งานใหม่';
                        }
                    }
                },
            ],
            "order": [],
        });
</script>

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script>
    function select_typeProduct(barcode){
        $.ajax({
            type: 'GET',
            url: '{{ url('ajax_get_type_product') }}',
            data: {barcode:barcode},
            success: function (data) {
                console.log(data);
                if(data == 'บาร์โค้ดไม่ถูกต้อง'){
                    $('#show_typeProduct').html('<b style="color:red;">'+data+'</b>');
                }
                else{
                    var str ='<div class="col-sm-12 text-center">\
                                            <b>เลือกชนิดงาน</b>\
                                        </div>';
                    for (let i = 0; i < data.length; i++) {
                        str = str + '<label class="container" > '+data[i].product_name+'\
                                                <input name="typeProduct[]" type="checkbox" id="type_product" value="'+data[i].TypeOfProductID+'">\
                                                <br>\
                                                <span class="checkmark"></span>\
                                            </label>';
                    }
                    str = str + '<div class="col-12 text-center" >\
                    <button class="btn btn-outline-success" name="OrderID" value="'+data[0].OrderID+'" style="padding-right: 10px;padding-left: 10px;">ยืนยัน</button></div>';
                    $('#show_typeProduct').html(str);
                }
            }
            });
    }
</script>

@stop


