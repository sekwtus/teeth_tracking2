@extends('layouts.template')

@section('title', 'ผลิต')

@section('stylesheet')

<style>
 table{
     font-size: 13px;
 }
</style>

<style>
@media print{
    .no-print{ display:none; }
}
</style>
<style>
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
        /* .dataTables_wrapper {
        position: relative;
        clear: both;
        width: auto;
        min-height : 150 px;
        margin-left: 0px;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        background-color: #9D9C9D;
        zoom: 1;
        } */
</style>
@stop

@section('content')
@if (Session::has('message'))
    <div class="modal" id="ModalMassage" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <hr> --}}
                <div class="modal-body">
                    <p>{{ Session::get('message') }}</p>
                </div>
                {{-- <hr> --}}
            </div>
        </div>
    </div>
   {{-- <div class="alert alert-danger">{{ Session::get('message') }}</div> --}}
@endif

<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                            {{ Form::open(['method' => 'post' , 'url' => '/job/'.$data_department.'/sub_depart']) }}
                                <div class="row">
                                    <div class="col-2 text-left">
                                        <button type="button" style="margin-bottom: 10px;" class="btn btn-success" data-toggle="modal" data-target="#defaultModal">จัดส่ง</button>
                                    </div>
                                </div>
                            {{ Form::close()}}

                            @foreach( $count as $out_count)
                            <input type="hidden" value="{{ $out_count->count }}" id="count">
                        @endforeach
                        <table id="table_packing" class=" table-striped table-bordered display compact nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th>No.</th> --}}
                                    <th>วันที่ส่งงาน</th>
                                    <th>บาร์โค้ด</th>
                                    <th>ทันตแพทย์</th>
                                    <th>คนไข้</th>
                                    <th>เขต</th>
                                    <th>พื้นที่</th>
                                    <th>วันที่แพ็ค</th>
                                    <th>เวลาที่แพ็ค</th>
                                    <th>สถานะ</th>
                                    <th>สาขาที่ผลิต</th>
                                </tr>
                            </thead>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- รับงานเข้าแผนก --}}
 <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document" style="width:420px;">
         <div class="modal-content">
             <div class="card-header align-items-center text-center">
                 <label class="font-weight-bold ">
                     จัดส่ง
                 </label>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             {{ Form::open(['method' => 'post' , 'url' => '/job/export/'.$data_department]) }}
                <div class="col-sm-12" style="padding-bottom: 10px;">
                     <div class="control-group">
                         <div class="inc2">
                             <label class="col-form-label col-sm-12"  for="Barcode">
                                     <p class="card-description" style="font-size:15px;"> สแกนบาร์โค๊ดงาน จัดส่งงาน : </p>
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
            $('#profile-tab').addClass('active');
            $('#ourgoal').addClass('show');

        });
    }
});
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

</script>

<script>
    $("#scanbarcode_qc").keydown( function() {
        $("#Employee").val($("#scanbarcode_qc").val());
    });
</script>

<script>
   $(function() {
          $('#table_packing').DataTable({
          processing: true,
          //serverSide: true,
          paging: true,
          ajax: '{{ url('/table/order_packing') }}',
          columns: [
                    { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'doctor_name', name: 'doctor_name' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'Area', name: 'Area' },
                   { data: 'zone', name: 'zone' },
                   { data: 'created_at', name: 'created_at' },
                   { data: 'created_at', name: 'created_at' },
                   { data: 'job_current_department', name: 'job_current_department' },
                   { data: 'Branch', name: 'Branch' },
                //    { data: 'ID', name: 'ID' ,orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        "targets": 0,//  render(data,type,row){
                        // // 2019-09-11 10:50:12
                        //     var data = data.substring(8,10) +'/'+ data.substring(5,7) +'/'+ data.substring(0,4);
                        //     return data;
                        // },
                        "className": "text-center",
                    },
                    {
                        "targets": 1,
                        render: function(data, type, row) {
                        return '<a href="../summary_report/'+row["ID"]+'" target="_blank">'+row["Barcode"]+'</a>';
                         }
                        //"className": "text-center"
                    },
                    {
                        "targets": 2,
                    },
                    {
                        "targets": 3,
                    },
                    {
                        "targets": 4,
                    },
                    {
                        "targets": 5,
                    },
                    {
                        "targets": 6, render(data,type,row){
                        // 2019-09-11 10:50:12
                            var data = data.substring(8,10) +'/'+ data.substring(5,7) +'/'+ data.substring(0,4);
                            return data;
                        },
                        "className": "text-center",
                    },
                    {
                        "targets": 7, render(data,type,row){
                            // 2019-09-11 10:50:12
                            var data = data.substring(11,16);
                            return data + ' น.';
                        },
                        "className": "text-center",
                    },
                    {
                        "targets": 8, render(data,type,row){
                            if (data == 3) {
                                return '<label class="badge badge-outline-primary badge-pill">แพ็ค</label>';
                            }
                        },
                        "className": "text-center"
                    },
                    {
                        "targets": 9,
                    },
                ],
                "order": []
       });
    });
</script>


@stop
