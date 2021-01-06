@extends('layouts.template')
@section('title', 'สรุปข้อมูล')

@section('stylesheet')
<style media="screen">
        /* ตารางหลัก */
        .tbl td{
          padding: 5px;
          font-size: 12px;
        }
        .hidden{
          display: none;
        }
        .bg-success, .bg-secondary, .bg-success{
          /* color: #fff; */
          font-weight: bold;
        }

        /*รูปฟัน MARGIN AND METAL DESIGN & PONTIC DESIGN*/
        input[type="checkbox"]:checked+label>img {
            border: 4px solid #fff;
            box-shadow: 0 0 5px 5px #090;
            border-radius: 4px;
        }
        .pontic {
          border: 0px dashed #444;
          width: 30px;
          height: 30px;
          transition: 500ms all;
        }

        /* pointer (checkbox,radio) */
        .custom-control input+label, .pointer{
          cursor: pointer;
        }

        /* เลือกฟัน */
        #tooth-check {
          display: none;
        }

        .tooth-chart {
          width: 80%;
          margin: auto;
        }

        #tooth-lbl>text {
          font-family: 'Avenir-Heavy';
        }

        polygon, path {
          -webkit-transition: fill .25s;
          transition: fill .25s;
        }

        polygon:hover, polygon:active,
        #tooth-polygon>path:hover,
        #tooth-polygon>path:active {
          fill: red !important;
          cursor: pointer;
        }

        /*End Tooth*/

        input[type=checkbox] {
            display: none;
        }

        input[type=number] {
            -moz-appearance:textfield; /* Firefox */
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        .lbl {
          border: 1px solid;
          border-radius: 50%;
          cursor: pointer;
          width: 25px;
          height: 25px;
        }
        .lbl:hover {
          opacity: 0.5;
        }
        .check {
          color: blue;
          background: blue;
        }
        .img-tooth {
          width: 25px;
          height: 25px;
          margin-bottom: 15px;
          margin-right: 15px;
        }
        .tbl-tooth {
          margin: auto;
        }
        .tbl-tooth td {
          border:none; !important;
        }
        /* */

        /* The container */

        .select {
            color: #FFE000;
            background: #FFE000;
        }

        .selected {
            color: #00D413;
            background: #00D413;
        }

        .input-hidden {
            display: none;
        }
        th{
          font-size: 14px;
        }

</style>

<script>
    function OnLoad(n){
            //$('.lbl_green_'+n).addClass('check');
            //document.getElementById('lbl_green_'+n).classList.toggle("check");
        // alert($('#lbl_green_'+n).length);
        setTimeout(function() {
            if($('#lbl_green_'+n).length){
                $(".img-tooth-"+n).addClass('img-tooth');
                $('#lbl_green_'+n).addClass('lbl_green_'+n);
                $('#lbl_green_'+n).addClass('select');
            }else{
                OnLoad(n);
            }
        }, 10);
    }
    function select(n){
        //$('.lbl_green_'+n).addClass('check');
        //document.getElementById('lbl_green_'+n).classList.toggle("check");
        setTimeout(function() {
            if( $('#lbl_green_'+n).length){
                $('#lbl_green_'+n).addClass('selected');
            }else{
                select(n);
            }
        }, 10);
    }
</script>
@stop

@section('content')
<div class="container-fluid" id="content"> {{--content-wrapper --}}
  <div class="row">
    <div class="col-12 px-0">
      <table id="tbl-1" class="tbl" width="100%" border="1">
            @foreach($order as $out_order)
          <tr class="bg-secondary text-center">
            <th width="52%">ข้อมูลทั่วไป</th>
            <th width="24%">ข้อมูลวันเวลาผลิต</th>
            <th width="24%">ข้อมูลรหัสงาน</th>
          </tr>

          <tr>
            <td id="td-detail" valign="top">
              <div class="row py-1">
                <div class="col-md-6 col-lg-5 pr-lg-0">
                  <b>แลปที่ผลิต : </b>{{ $out_order->company_name }}
                </div>
                <div class="col-md-6 col-lg-4 pr-lg-0">
                  <b>สาขา : </b>{{ $out_order->branch_name }}
                </div>
              </div>

              <div class="row py-1">
                <div class="col-md-6 col-lg-4 pr-lg-0">
                  <b>ทพ./ทญ. : </b>{{ $out_order->doctor }}
                </div>
                <div class="col-md-6 col-lg-3 pr-lg-0">
                  <b>เบอร์โทร : </b>{{ $out_order->phone_doctor }}
                </div>
                <div class="col-md-6 col-lg-4 pr-lg-0">
                  <b>LINE : </b>{{ $out_order->line_doctor }}
                </div>
              </div>

              <div class="row py-1">
                <div class="col-md-6 col-lg-4 pr-lg-0">
                  <b>รพ./คลีนิค : </b>{{ $out_order->customer }}
                </div>
                <div class="col-md-6 col-lg-3 pr-lg-0">
                  <b>รหัสลูกค้า : </b>{{ $out_order->CustomerCode }}
                </div>
                <div class="col-md-6 col-lg-3 pr-lg-0">
                  <b>เบอร์โทร : </b>{{ $out_order->phone_customer }}
                </div>
                <div class="col-md-6 col-lg-2 pr-lg-0">
                  <b>ช่างประจำ : </b>{{ $out_order->technician_recommend }}
                </div>
              </div>

              <div class="row py-1">
                <div class="col-md-6 col-lg-4 pr-lg-0">
                  <b>ชื่อคนไข้ : </b>{{ $out_order->PatientName }}
                </div>
                <div class="col-md-6 col-lg-3 pr-lg-0">
                  <b>HN : </b>{{ $out_order->PatientHN }}
                </div>
                <div class="col-md-6 col-lg-2 pr-lg-0">
                  <b>อายุ : </b>{{ $out_order->PatientAge }}
                </div>
                <div class="col-md-6 col-lg-3 pr-lg-0">
                    @if ($out_order->PatientSex == '1')
                      <b>เพศ : </b>ชาย
                    @elseif($out_order->PatientSex == '2')
                      <b>เพศ : </b>หญิง
                    @else
                      <b>เพศ : </b>ไม่ระบุ
                    @endif

                </div>
              </div>

              <div class="row py-1">
                <div class="col-md-6 col-lg-6">
                  <b>ชื่อ SALE : </b>{{ $out_order->employee_name }}
                </div>
                <div class="col-md-6 col-lg-6">
                  <b>เขต : </b>{{ $out_order->area }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-md-12 col-lg-12 pr-lg-0">
                  <b>หมายเหตุ : </b>{{ $out_order->note }}
                </div>
              </div>
            </td>

            <td id="td-datetime" valign="top">
              <div class="row py-1">
                <div class="col-12">
                  <b>วันรับงาน : </b>{{ $out_order->StartDate }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-md-7 pr-lg-0">
                  <b>วันส่งงาน : </b>{{ $out_order->DeliverDate }}
                </div>
                <div class="col-md-5 pr-lg-0">
                  <b>เวลา : </b>{{ $out_order->ReceptionTime }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-12 pr-lg-0">
                  <b>รอบงาน : </b>{{ $out_order->production_cycle }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-md-7 pr-lg-0">
                  <b>วันนัดจริง : </b>{{ $out_order->Datefinal }}
                </div>
                <div class="col-md-5 pr-lg-0">
                  <b>เวลา : </b>{{ $out_order->FinalTime }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-md-12 pr-lg-0">
                  <b>หมายเหตุการเลื่อนนัด : </b>{{ $out_order->DeliverDate_comment }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-md-12 pr-lg-0">
                  <b>คนรับเรื่องการเลื่อนนัด : </b>{{ $out_order->Employee_DeliverDate_comment }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-md-12 pr-lg-0">
                  <b>ลักษณะงานที่เลื่อน : </b><b>{{ $out_order->name_type_1 }}</b> {{ $out_order->detail_type_1 }} {{ $out_order->comment_WorkLate }} {{ $out_order->comment_WorkLate_before }}
                </div>
              </div>
            </td>

            <td id="td-workid" valign="top">
              <div class="row">
                  @if($out_order->RefBarcode != null)
                      <div class="col-12 py-1">
                          <b>งาน : </b>แก้ไข
                      </div>
                      <div class="col-12 py-1">
                        <b>BARCODE : </b>{{ $out_order->Barcode }}
                      </div>
                      <div class="col-12 py-1">
                        <b>REF.CODE : </b>{{ $out_order->RefBarcode }}
                      </div>

                      <hr/>

                      <?php
                        $Barcode = $out_order->Barcode;
                        $count = 1;
                        $data[] = $out_order->Barcode;
                      ?>

                      @if($Barcode != NULL && $Barcode != '')
                        @foreach($data_ref as $out_data_ref)
                            @if($out_data_ref->Barcode == $Barcode)
                                <?php $Barcode = $out_data_ref->RefBarcode;
                                $data[] = $out_data_ref->RefBarcode;
                                ?>
                            @endif
                        @endforeach
                      @endif

                      <?php
                      $reversed_data = array_filter(array_reverse($data));
                      ?>
                      @foreach($reversed_data as $reversed_data)
                        @foreach($data_ref as $out_data_ref)
                            @if($reversed_data == $out_data_ref->Barcode && $out_data_ref->RefBarcode != NULL)
                                <div class="col-12 py-1">
                                    <b>แก้ครั้งที่ {{ $count }}. Barcode: </b>{{ $out_data_ref->Barcode }}
                                </div>
                                <div class="col-12 py-1">
                                    <b>ประเภทงานแก้ : </b>{{ $out_data_ref->name_type_2 }} {{ $out_data_ref->detail_type_2 }}

                                    @if($out_data_ref->ddlTypeEdit == 38)
                                        <br>  [ {{ $out_data_ref->comment_Workdefect1 }} ]
                                    @elseif($out_data_ref->ddlTypeEdit == 39)
                                        <br>  [ {{ $out_data_ref->comment_Workdefect2 }} ]
                                    @endif
                                    
                                </div>
                                <hr/>
                                <?php
                                    $count = $count + 1;
                                ?>
                            @endif
                        @endforeach
                      @endforeach

                      <div class="col-12 py-1">
                        <b>ประเภทงาน : </b>{{ $out_order->DeliverType }}
                      </div>

                  @elseif($out_order->ContiBarcode != null)
                      <div class="col-12 py-1">
                          <b>งาน : </b>ต่อเนื่อง
                      </div>
                      <div class="col-12 py-1">
                        <b>BARCODE : </b>{{ $out_order->Barcode }}
                      </div>
                      <div class="col-12 py-1">
                        <b>REF.CODE : </b>{{ $out_order->ContiBarcode }}
                      </div>
                      <div class="col-12 py-1">
                        <b>ประเภทงานต่อเนื่อง : </b>{{ $out_order->type_of_con_name }}
                      </div>
                      <div class="col-12 py-1">
                        <b>ประเภทงาน : </b>{{ $out_order->DeliverType }}
                      </div>
                  @else
                      <div class="col-12 py-1">
                          <b>งาน : </b>ใหม่
                      </div>
                      <div class="col-12 py-1">
                        <b>BARCODE : </b>{{ $out_order->Barcode }}
                      </div>
                      <div class="col-12 py-1">
                        <b>REF.CODE : </b> -
                      </div>
                      <div class="col-12 py-1">
                        <b>ประเภทงาน : </b>{{ $out_order->DeliverType }}
                      </div>
                  @endif
                  <div class="col-12 py-1">
                      {{ $out_order->OralScan }}
                  </div>
                  <div class="col-12 py-1">
                      {{ $out_order->Model }}
                  </div>

              </div>
              {{-- //////////////ภาพที่แนบ --}}
              <div class="col-12 py-1" >
                    <div>{{-- screen --}}
                    <b>ภาพแนบscreen  </b>
                    @foreach ($file as $i=>$f)
                      @if ($f->type == 1)
                        <p class="mt-1" style="font-size: 12px;">
                            <a href="{{url('local/public/file').'/'.$f->name_file}}" target="_blank" class="btn btn-inverse-success btn-rounded btn-block" style="padding: 1px 1px 1px 1px;"  title="ตรวจสอบ">
                              {{-- <i class="fa fa-file-pdf"></i> <span>{{$i+1}}</span>.ภาพแนบ {{$f->created_at}} --}}
                              <i ></i> <span>{{$i+1}}</span>. {{$f->name_file}}
                            </a>
                        </p>
                      @endif
                    @endforeach
                  </div>
                  <div>{{-- screen --}}
                      <b>ภาพแนบแพ็ค  </b>
                      @foreach ($file as $i=>$f)
                      @if ($f->type == 2)
                          <p class="mt-1" style="font-size: 12px;">
                              <a href="{{url('local/public/file').'/'.$f->name_file}}" target="_blank" class="btn btn-inverse-success btn-rounded btn-block" style="padding: 1px 1px 1px 1px;"  title="ตรวจสอบ">

                                <i ></i> <span>{{$i+1}}</span>. {{$f->name_file}}
                              </a>
                          </p>
                      @endif
                      @endforeach
                    </div>
                </div>
                {{-- /////////// --}}
            </td>
          </tr>
          @endforeach
              <tr class="bg-secondary text-center">
                <th width="30%">คำสั่งพิเศษ</th>
                <th width="30%">สิ่งที่ส่งมาด้วย</th>
                <th width="30%">อุปกรณ์ IMPLANT</th>
              </tr>

              <tr >
                <td id="td-special-command" valign="top">
                  @foreach ($select_extra as $extra)
                    <div class="row">
                      <label class="col-lg-7">
                        <i class="fa fa-check text-primary"></i>
                        {{ $extra->topic }}
                        @if (!empty($extra->note))
                          ({{ $extra->note }})
                        @endif
                      </label>
                      @if(!empty($extra->detail))
                        <label class="col-lg-5 pl-sm-4 pl-lg-0">
                          (<i class="fa fa-circle text-primary"></i> {{ $extra->detail }})
                        </label>
                      @endif
                    </div>
                  @endforeach

                </td>

                <td id="td-attachment" valign="top">
                  <div class="row">
                      @foreach ($select_Attachment as $attachment)
                          <label class="col-md-6">
                            <i class="fa fa-check text-primary"></i>
                            {{-- {{ $attachment->topic }} --}}
                            @if (!empty($attachment->number))
                            {{ $attachment->topic }} ( {{ $attachment->number }} )
                            @else
                                {{ $attachment->topic }}
                            @endif
                          </label>
                      @endforeach
                  </div>
                </td>

                <td id="td-attachment-implant" valign="top">
                  <div class="row">
                      @foreach ($select_IMPLANT_Attachment as $implant)
                        <label class="col-md-12">
                          <i class="fa fa-check text-primary"></i>
                          @if (!empty($implant->number))
                            {{ $implant->topic }} ( {{ $implant->number }} )
                          @else
                            {{ $implant->topic }}
                          @endif
                        </label>
                      @endforeach
                  </div>
                </td>
              </tr>
              <tr class="bg-secondary text-center">
                <th width="43%" bgcolor="#FF0000" style="color: white">คำสั่งเพิ่มเติม</th>
                <th width="29%">สิ่งที่ส่งมาด้วยเพิ่มเติม</th>
                <th width="28%">อุปกรณ์ IMPLANT เพิ่มเติม</th>
              </tr>
              <tr>
                <td valign="top">
                  <div class="row mb-3">
                    <div class="col-md-12">
                      @foreach ($select_extra_additional as $additional)
                          <label style="color: #FF0000">{{ $additional->detail }}</label>
                      @endforeach
                    </div>
                  </div>
                </td>

                <td valign="top">
                    <div class="row mb-3">
                      <div class="col-md-12">
                          @foreach ($data_select_attachment_additional as $attachment_additional)
                              {{ $attachment_additional->detail }}
                          @endforeach
                      </div>
                    </div>
                </td>
                <td valign="top">
                  <div class="row mb-3">
                    <div class="col-md-12">
                          @foreach ($data_select_IMPLANT_Attachment_additional as $IMPLANT_Attachment_additional)
                              {{ $IMPLANT_Attachment_additional->detail }}
                          @endforeach
                    </div>
                  </div>
                </td>
              </tr>

              {{-- interlock --}}
              <tr class="bg-secondary text-center">
                <th colspan="3">INTERLOCK</th>
              </tr>
              <tr>
                <td valign="top" colspan="3">
                  <div id="div-system" class="mb-3">
                    <div class="row">

                    @if (!empty($Female_Mesial) || !empty($Female_Distal))
                      <div class="col-1">
                        <label class="col-form-label">Female (ตัวเมีย) </label>
                      </div>
                      <div class="col-1">
                        <label class="col-form-label">Mesial :  {{ $Female_Mesial }}</label>
                      </div>
                      <div class="col-4">
                        <label class="col-form-label">Distal : {{ $Female_Distal }}</label>
                      </div>
                    @endif

                    @if (!empty($Male_Mesial) || !empty($Male_Distal))
                      <div class="col-1">
                        <label class="col-form-label">Male (ตัวผู้)</label>
                      </div>
                      <div class="col-1">
                        <label class="col-form-label">Distal : {{ $Male_Mesial }}</label>
                      </div>
                      <div class="col-4">
                        <label class="col-form-label">Distal : {{ $Male_Distal }}</label>
                      </div>
                    @endif

                    </div>
                  </div>
                </td>
              </tr>


      </table>
      <div class="container-fluid" id="content">
        <div class="row">
          <div class="col-12 px-0">
            <table id="tbl-4" class="tbl" width="100%" border="1">
              <tr class="bg-secondary text-center">
                <th colspan="8">สรุปข้อมูล Screen</th>
              </tr>
                @php $count = 0; @endphp
              @foreach ($detail_screen_group as $screen_group)
                @php $count++; @endphp
              <!-- loop แถว 1 -->
              <tr class="bg-success text-center">
                <th>กลุ่ม {{ $count }}</th>
                <th colspan="5">การออกแบบ</th>
                {{-- <th>แก้ไข</th> --}}
              </tr>

              <tr>
                <td id="td-tooth" width="25%" valign="top" rowspan="2">
                  <table class="tbl" width="100%" border="1">
                    <thead class="bg-secondary text-center">
                      <th>ซี่ฟัน</th>
                      <th>สินค้า</th>
                      <th>ชนิดงาน</th>
                      <th>ชนิดกลุ่มงาน</th>
                    </thead>
                    <tbody>
                      @foreach ($teeth_group as $teeth_g)
                        <?php
                          $group = $teeth_g->screen_group;
                        ?>
                        @if ($teeth_g->screen_group == $screen_group->screen_group )
                          <tr>
                            <th>#{{ $teeth_g->TeethID }}</th>
                            {{-- <td>{{ $teeth_g->product_name }}</td>
                            <td>{{ $teeth_g->work_name }}</td> --}}
                            @foreach ($teeth2 as $out_teeth)
                                @if ($out_teeth->teeth == $teeth_g->TeethID )
                                    <td>{{ $out_teeth->work_type }}</td>
                                    <td>{{ $out_teeth->work_name }}</td>
                                    <td>{{ $out_teeth->name_group }}</td>
                                @endif
                            @endforeach
                          </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                </td>

                <th class="bg-secondary text-center" width="20%">SHADE</th>
                <th class="bg-secondary text-center" width="15%">STUMP</th>
                <th class="bg-secondary text-center" width="15%">MARGIN,METAL</th>
                <th class="bg-secondary text-center" width="10%">PONTIC</th>
                <th class="bg-secondary text-center" width="15%">ALLOYS</th>

                {{-- <td rowspan="4">
                  @if(!empty($flow))
                  <a href="{{ url('/mainscreen/edit_conclusion/').'/'.$id.'/'.$screen_group->screen_group }}" class="btn btn-icons btn-outline-warning" title="แก้ไข" >
                    <i class="fa fa-edit"></i>
                  </a>
                  @endif
                </td> --}}
              </tr>

        <tr>
            <td id="td-shade" valign="top">
                <div id="div-shade">
                @if($screen_group->one_color=='สีเดียว' || $screen_group->one_color=='หลายสี')
                    <div class="bg-warning text-center">{{$screen_group->one_color}}</div>
                    <div class="row my-1">
                    <div class="col-12">
                        @if($screen_group->one_color=='สีเดียว')
                        <table class="tbl" width="100%" border="1">
                            <tr class="bg-secondary text-center">
                            <th>ยี่ห้อ</th>
                            <th>สี</th>
                            </tr>
                            <tr>
                            <td>{{ $screen_group->one_color_branch_name }}</td>
                            <td>{{ $screen_group->one_color_name }}</td>
                            </tr>
                        </table>
                        @endif

                        {{-- shade มีกรณีหลายสี เหมือน ใน ui เช่น คอฟัน->ยี่ห้อ->สี --}}
                        @if($screen_group->one_color=='หลายสี')
                        <table class="tbl" width="100%" border="1">
                            <tr class="bg-secondary text-center">
                            <th>ฟัน</th>
                            <th>ยี่ห้อ</th>
                            <th>สี</th>
                            </tr>
                            <tr>
                            <td>คอฟัน</td>
                            <td>{{ $screen_group->one_color_branch_name_2 }}</td>
                            <td>{{ $screen_group->one_color_name_2 }}</td>
                            </tr>
                            <tr>
                            <td>กลางฟัน</td>
                            <td>{{ $screen_group->one_color_branch_name_3 }}</td>
                            <td>{{ $screen_group->one_color_name_3 }}</td>
                            </tr>
                            <tr>
                            <td>ปลายฟัน</td>
                            <td>{{ $screen_group->one_color_branch_name_4 }}</td>
                            <td>{{ $screen_group->one_color_name_4 }}</td>
                            </tr>
                        </table>
                        @endif
                    </div>
                    </div>
                    <div class="bg-warning text-center">{{$screen_group->one_color_extra1}}</div>
                    {{-- <div class=" text-center">{{$screen_group->txtCommentAlloys}}<br>{{$screen_group->comment_Metal_type}}</div> --}}
                @elseif($screen_group->one_color=='')
                    <div class="row">
                    <div class="col-12 text-center">-</div>
                    </div>
                @else
                    <div class="row">
                    <div class="col-12 text-center">
                        {{$screen_group->one_color}}
                    </div>
                    </div>
                @endif
                </div>

                <br>
                <div class="row">
                    <div class="col-12 text-center">
                    {{$screen_group->txtCommentShade}}
                </div>
                </div>
            </td>

            <td id="td-stump" valign="top">
                @if($screen_group->stump=='สีเดียว')
                <div class="bg-warning text-center">สีเดียว</div>
                <div class="row mt-1">
                    <div class="col-12">
                    <table class="tbl" width="100%" border="1">
                        <tr class="bg-secondary text-center">
                        <th>ยี่ห้อ</th>
                        <th>สี</th>
                        </tr>
                        <tr>
                        <td>{{ $screen_group->one_color_branch_name_5 }}</td>
                        <td>{{ $screen_group->one_color_name_5 }}</td>
                        </tr>
                    </table>
                    </div>
                </div>
                @elseif($screen_group->stump=='')
                <div class="row">
                    <div class="col-12 text-center">-</div>
                </div>
                @else
                <div class="row">
                    <div class="col-12 text-center">
                    {{$screen_group->stump}}
                    </div>
                </div>
                @endif

                <br>
                <div class="row">
                    <div class="col-12 text-center">
                    {{$screen_group->txtCommentStump}}
                </div>
                </div>
            </td>

            <td id="td-margin" valign="top">
                <div class="row text-center">
                @if (!empty($screen_group->MARGIN1))
                    @if($screen_group->MARGIN_Buccal != "" || $screen_group->MARGIN_Lingual != "")
                    <label class="col-4 mt-1">
                    <img class="pontic" src="{{ asset('images/mental-design/'.$screen_group->MARGIN1) }}" >
                    </label>
                    @else
                    <label class="col-12 mt-1">
                    <img class="pontic" src="{{ asset('images/mental-design/'.$screen_group->MARGIN1) }}" >
                    </label>
                    @endif
                @endif

                <div class="col-4 mt-1">
                    {{ $screen_group->MARGIN_Buccal=='' ?'' :$screen_group->MARGIN_Buccal }}
                </div>

                <div class="col-4 mt-1">
                    {{ $screen_group->MARGIN_Lingual=='' ?'' :$screen_group->MARGIN_Lingual }}
                </div>

                @if (!empty($screen_group->MARGIN2))
                    <label class="col-12 mt-1">
                    <img class="pontic" src="{{ asset('images/mental-design/'.$screen_group->MARGIN2) }}">
                    </label>
                @endif

                @if (!empty($screen_group->MARGIN3))
                    <label class="col-12 mt-1">
                    <img class="pontic" src="{{ asset('images/mental-design/'.$screen_group->MARGIN3) }}">
                    </label>
                @endif
                </div>
            </td>

            <td id="td-pontic" valign="top">
                <div class="row text-center">
                @if (!empty($screen_group->PONTIC_DESIGN))
                    <label class="col-12 mt-1">
                    <img class="pontic" src="{{ asset('images/pontic-design/'.$screen_group->PONTIC_DESIGN) }}">
                    </label>
                @endif
                </div>
            </td>

            <td id="td-alloys" class="text-center" valign="top">
                <div class="text-center bg-warning">{{ $screen_group->Metal_type=='' ?'' : $screen_group->Metal_type}}</div>
                <div class="text-center bg-warning">{{ $screen_group->Metal_type2=='' ?'' :$screen_group->Metal_type2 }}</div>
                <div class="text-center bg-warning">{{ $screen_group->Metal_type3=='' ?'' :$screen_group->Metal_type3 }}</div>
                <div class="text-center bg-warning">{{ $screen_group->Metal_type4=='' ?'' :$screen_group->Metal_type4 }}</div>
                <div class="text-center bg-warning">{{ $screen_group->Metal_type5=='' ?'' :$screen_group->Metal_type5 }}</div>
                <div class="text-center bg-warning">{{ $screen_group->Metal_type6=='' ?'' :$screen_group->Metal_type6 }}</div>
                <hr>
                <div class="text-center">{{ $screen_group->comment_Metal_type=='' ?'' :$screen_group->comment_Metal_type }}</div>

                <div class="row">
                    <div class="col-12 text-center">
                    {{$screen_group->txtCommentAlloys}}
                </div>
                </div>
            </td>
        </tr>

              <tr class="bg-secondary text-center">
                <th>PINTOOTH</th>
                <th>IMPLANT</th>
                <th>CONTOUR,OCCLUSION</th>
                <th>รับตะขอ</th>
                <th>OCCLUSAL STAINING</th>
                <th>MODEL</th>
              </tr>

             <tr>
                    <td id="td-implant" class="text-center" valign="top">
                        <div id="div-system">
                        <div class="bg-warning">{{ $screen_group->Pintooth }}</div>
                        </div>

                        <div id="div-retained">
                        <div class="bg-warning">PINTOOTH รับตะขอ ({{ $screen_group->PintoothHook }})</div>
                        <div class="row mb-1">
                            <div class="col-12">
                            {{ $screen_group->PintoothHookRest == '' ?'-' : $screen_group->PintoothHookRest }}
                            </div>
                        </div>
                        </div>

                        <div id="div-retained">
                        <div class="bg-warning">PINTOOTH วัสดุ</div>
                        <div class="row mb-1">
                            <div class="col-12">
                            {{ $screen_group->PintoothAlloys =='' ?'-' :$screen_group->PintoothAlloys }}
                            </div>
                            <div class="col-12"> หมายเหตุ
                            {{ $screen_group->PintoothAlloysNote =='' ?'-' :$screen_group->PintoothAlloysNote }}
                            </div>
                            <div class="col-12">
                            {{ $screen_group->PintoothAlloysComment =='' ?'-' :$screen_group->PintoothAlloysComment }}
                            </div>
                        </div>
                        </div>

                    </td>


                   <td id="td-implant" class="text-center" valign="top">
                    <div id="div-system">
                      <div class="bg-warning">ระบบ</div>
                      <div class="row mb-1">
                        <div class="col-12">
                          {{ $screen_group->implant_ceramage=='' ?'-' :$screen_group->implant_ceramage }}
                        </div>
                      </div>
                    </div>

                    <div id="div-retained">
                      <div class="bg-warning">การยึด</div>
                      <div class="row mb-1">
                        <div class="col-12">
                          {{ $screen_group->implant=='' ?'-' :$screen_group->implant }}
                        </div>
                      </div>
                    </div>

                    <div id="div-imp-brand">
                      <div class="bg-warning">ยี่ห้อ</div>
                      <div class="row mb-1">
                        <div class="col-12">
                          {{ $screen_group->implant_brand=='' ?'-' :$screen_group->implant_brand }}
                        </div>
                      </div>
                    </div>

                    <div id="div-imp-fix">
                      <div class="bg-warning text-center">Fix Cement</div>
                      <div class="row mb-1">
                        <div class="col-12">
                          {{ $screen_group->FixCement=='' ?'-' :$screen_group->FixCement }}
                        </div>
                      </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-12 text-center">
                        {{ $screen_group->txtCommentFixCement }}
                      </div>
                    </div>
                  </td>

                  <td id="td-contour" class="text-center" valign="top">
                    <div class="bg-warning">GINGIVAL EMBRASURES</div>
                    <div class="row mb-1">
                      <div class="col-12">
                        {{ $screen_group->GINGIVAL_EMBRASURES=='' ?'-' :$screen_group->GINGIVAL_EMBRASURES }}
                      </div>
                    </div>

                    <div class="bg-warning">OCCLUSION</div>
                    <div class="row mb-1">
                      <div class="col-12">
                        {{ $screen_group->OCCLUSION=='' ?'-' :$screen_group->OCCLUSION }}
                      </div>

                      {{-- OCCLUSION ถ้าเป็น UNDER จะมีขนาด mm. ด้วย --}}
                      {{-- @if (!empty($screen_group->OCCLUSION)) --}}
                      @if ($screen_group->OCCLUSION=='UNDER')
                        <div class="col-12">
                          <i class="fa fa-arrow-down"></i>
                        </div>
                        <div class="col-12">{{ $screen_group->unit_CONTOUR }} mm.</div>
                      @endif

                    </div>

                    <div class="bg-warning">CONTACT</div>
                    <div class="row mb-1">
                      <div class="col-12">
                        {{ $screen_group->CONTACT=='' ?'-' :$screen_group->CONTACT }}
                      </div>
                    </div>
                  </td>

                  <td id="td-rest" valign="top">
                    @if ($screen_group->Hook == 'มี Rest')
                      <div id="div-rest">
                        <div class="bg-warning text-center">Rest</div>
                        <div class="row mb-1">
                          @if ($screen_group->MESIAL_REST != null )
                            <div class="col-12">- {{ $screen_group->MESIAL_REST }}</div>
                          @endif
                          @if( $screen_group->DISTAL_REST != null )
                            <div class="col-12">- {{ $screen_group->DISTAL_REST }}</div>
                          @endif
                          @if( $screen_group->CINGULUM_REST != null )
                            <div class="col-12">- {{ $screen_group->CINGULUM_REST }}</div>
                          @endif
                          @if( $screen_group->LINGUAL_LEDGE != null )
                            <div class="col-12">- {{ $screen_group->LINGUAL_LEDGE }}</div>
                          @endif
                          @if( $screen_group->EMBRESSURE_REST != null )
                            <div class="col-12">- {{ $screen_group->EMBRESSURE_REST }}</div>
                          @endif
                          {{-- @if( $screen_group->other_hook != null )
                            <div class="col-12">- {{ $screen_group->other_hook }} </div>
                          @endif --}}
                        </div>
                      </div>

                      <div id="div-undercut" class="text-center">
                        <div class="bg-warning">UNDERCUT</div>
                        <div class="row">
                          <div class="col-12">
                            {{ $screen_group->other_hook=='มี UNDERCUT' ? $screen_group->undercut_hook.' mm.' : 'ไม่มี'}}
                          </div>
                        </div>
                      </div>

                    @else
                      <div class="row text-center">
                        <div class="col-12">ไม่มี Rest</div>
                      </div>
                    @endif
                  </td>

                  <td id="td-occlusal" class="text-center" valign="top">
                    {{ $screen_group->OCCLUSAL_STAINING=='' ?'-' :$screen_group->OCCLUSAL_STAINING }}
                  </td>

                  <td id="td-model" valign="top">
                    <div id="div-model" class="row text-center">
                      <div class="col-12">{{ $screen_group->model=='' ?'-' :$screen_group->model }}</div>

                      {{-- ถ้า MODEL เป็น MODEL RESIN (PRINT MODEL) จะมีตำแหน่งด้วย --}}
                      @if ($screen_group->model == 'MODEL RESIN (PRINT MODEL)')
                        <div class="col-12">
                          <i class="fa fa-arrow-down"></i>
                        </div>
                        <div class="col-12">{{ $screen_group->model_resin }}</div>
                      @endif

                    </div>

                    <br>
                    <div class="row">
                        <div class="col-12 text-center">
                        {{ $screen_group->txtCommentModel }}
                      </div>
                    </div>


                  </td>
            </tr>


              @endforeach
            </table>
          </div>
        </div>
      </div>
        <table id="tbl-3" class="tbl" width="100%" border="1">
          <tr class="bg-secondary text-center">
            <th width="100%">สรุปการไหลของงาน</th>
          </tr>
          <tr>
            {{-- <th>
              <label class="badge badge-outline-success badge-pill">
                ขาย
              </label>
              @if (!empty($screen))
                  <i class="fa fa-arrow-right"></i><label class="badge badge-outline-success badge-pill">screen</label>
              @else
                  <i class="fa fa-arrow-right"></i><label class="badge badge-outline-secondary badge-pill">screen</label>
              @endif
              @if (!empty($screen))
                @if(count($job_flow) < count($production_process)-2)
                  @for ($i=2; $i<count($production_process); $i++)
                    @if(count($job_flow) > $i-2)
                      @if($production_process[$i]->department_id == $job_flow[$i-2]->DepartmentID)
                        <i class="fa fa-arrow-right"></i>
                        <label class="badge badge-outline-success badge-pill">
                          {{$production_process[$i]->department}}
                        </label>
                      @else
                        <i class="fa fa-arrow-right"></i>
                        <label class="badge badge-outline-danger badge-pill">
                          {{$production_process[$i]->department}}
                        </label>
                      @endif
                    @else
                      <i class="fa fa-arrow-right"></i>
                      <label class="badge badge-outline-dark badge-pill">
                        {{$production_process[$i]->department}}
                      </label>
                    @endif
                  @endfor
                @else
                  @for ($i=0; $i<count($job_flow); $i++)
                    @if(count($job_flow) > $i)
                      @if($production_process[$i+2]->department_id == $job_flow[$i]->DepartmentID)
                        <i class="fa fa-arrow-right"></i>
                        <label class="badge badge-outline-success badge-pill">
                          {{$production_process[$i+2]->department}}
                        </label>
                      @else
                        <i class="fa fa-arrow-right"></i>
                        <label class="badge badge-outline-danger badge-pill">
                          {{$production_process[$i+2]->department}}
                        </label>
                      @endif
                    @else
                      <i class="fa fa-arrow-right"></i>
                      <label class="badge badge-outline-dark badge-pill">
                        {{$production_process[$i+2]->department}}
                      </label>
                    @endif
                  @endfor
                @endif
              @endif
            </th> --}}
            <th>
              <label class="badge badge-outline-success badge-pill">
                ขาย
              </label>
              @if (!empty($screen))
                  <i class="fa fa-arrow-right"></i><label class="badge badge-outline-success badge-pill">screen</label>
              @else
                  <i class="fa fa-arrow-right"></i><label class="badge badge-outline-secondary badge-pill">screen</label>
              @endif
              @if (!empty($screen))
                {{-- @if(count($job_flow) < count($production_process)-2) --}}
                  @for ($i=2; $i<count($production_process); $i++)
                    @php $Check = 0; @endphp
                    @for ($j=0; $j<count($job_flow); $j++)
                      @if($production_process[$i]->department_id == $job_flow[$j]->DepartmentID)
                        @php $Check = 1; @endphp
                      @endif
                    @endfor
                    @if($Check == 1)
                      <i class="fa fa-arrow-right"></i>
                      <label class="badge badge-outline-success badge-pill">
                        {{$production_process[$i]->department}}
                      </label>
                    @else
                      <i class="fa fa-arrow-right"></i>
                      <label class="badge badge-outline-dark badge-pill">
                        {{$production_process[$i]->department}}
                      </label>
                    @endif
                  @endfor
                {{-- @else
                  @for ($j=0; $j<count($job_flow); $j++)
                    @php $Check; @endphp
                    @for ($i=2; $i<count($production_process); $i++)
                      @if($production_process[$i]->department_id == $job_flow[$j]->DepartmentID)
                        @php $Check = 1; @endphp
                      @else
                        @if($Check != 1)
                          @php $Check = 0; @endphp
                        @endif
                      @endif
                    @endfor
                    @if($j < count($job_flow))
                      {{$Check}}
                    @endif
                  @endfor
                @endif --}}
              @endif
            </th>
          </tr>

          <tr>
              <?php $count = 1;?>
              <td id="td-conclusion-tooth" valign="top">
                  {{ Form::open(['method' => 'POST']) }}
                    <table class="table-striped table-bordered display compact nowrap" width="100%" border="1">
                        <thead class="text-center">
                            <th width="3%">ลำดับที่</th>
                            <th width="8%">แผนก</th>
                            <th width="8%">แผนกย่อย</th>
                            <th width="8%">ชื่อ</th>
                            <th width="4%">ชื่อเล่น</th>
                            <th width="4%">สาขา</th>
                            <th width="4%">บริษัท</th>
                            <th width="8%">วัน-เวลา (บันทึก)</th>
                            <th width="4%">ผล QC</th>
                            <th width="21%">CPP (จุดควบคุม)</th>
                            <th width="13%">เรื่องที่ติดต่อหมอ</th>
                            <th width="18%">ผลการติดต่อหมอ</th>
                            {{-- <th width="13%">บันทึกการส่งกลับหมอ</th> --}}
                        </thead>
                        <tbody>
                            @foreach ($order as $out_order)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $out_order->department_name }}</td>
                                    <td>{{ $out_order->sub_department_name }}
                                        @if($out_order->area != NULL)
                                        ( เขต : {{ $out_order->area }} )
                                        @endif
                                    </td>
                                    <td>{{ $out_order->employee_name }}</td>
                                    <td>{{ $out_order->Employee }}</td>
                                    <td>{{ $out_order->branch_name }}</td>
                                    <td>{{ $out_order->company_name }}</td>
                                    <?php $order_created_at = \Carbon\Carbon::parse($out_order->created_at)->format('d/m/Y - H:i'); ?>
                                    <td>{{ $order_created_at }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    {{-- <td>-</td> --}}
                                </tr>
                            @endforeach

                            @foreach ($screen as $out_screen)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>ธุรการ</td>
                                    <td>Screen</td>
                                    <td>{{ $out_screen->Employee_Name }}</td>
                                    <td>{{ $out_screen->Nick_name }}</td>
                                    <td>{{ $out_screen->Branch_name }}</td>
                                    <td>{{ $out_screen->company_name }}</td>
                                    <?php $out_screen_created_at = \Carbon\Carbon::parse($out_screen->created_at)->format('d/m/Y - H:i'); ?>
                                    <td>{{ $out_screen_created_at }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    {{-- <td>-</td> --}}
                                </tr>
                            @endforeach

                            @foreach ($job as $out_job)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    @if($out_job->DepartmentID == '1000')
                                        <td>ธุรการ</td>
                                        <td>Screen </td>
                                    @else
                                        <td>{{ $out_job->department_name }}</td>
                                        <td>
                                            @if(!empty($out_job->sub_department_name))
                                            {{ $out_job->sub_department_name }}
                                            @else
                                            รับเข้าแผนกหลัก
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ $out_job->Employee_Name }}</td>
                                    <td>{{ $out_job->Nick_name }}</td>
                                    <td>{{ $out_job->Branch_name }}</td>
                                    <td>{{ $out_job->company_name }}</td>
                                    <?php $data_created_at = \Carbon\Carbon::parse($out_job->created_at)->format('d/m/Y - H:i'); ?>
                                    <td>{{ $data_created_at }}</td>
                                    <?php
                                        $status = '';
                                        if($out_job->status_job_detail == "1"){
                                            $status = '-';
                                        }
                                        if($out_job->status_job_detail == "2"){
                                            $status = '-';
                                        }
                                        if($out_job->status_job_detail == "3"){
                                          {
                                              $status = 'ผ่าน';
                                          }
                                        }
                                        if($out_job->status_job_detail == "4"){
                                          if($out_job->department_name == 'FQC'){
                                            foreach ($Job_QC as $out_Job_QC) {
                                              if ($out_job->ID == $out_Job_QC->Job_detail_ID) {
                                                foreach ($qcchecklist as $out_qcchecklist) {
                                                    if ($out_qcchecklist->ID == $out_Job_QC->QC_ID) {
                                                       $status = 'FQC ตีกลับ'.'/'. $out_qcchecklist->departmentName.'/'.$out_qcchecklist->sub_departmentName;
                                                    }
                                                }
                                              }
                                            }
                                          } elseif($out_job->qc_backward_dep_name == null || $out_job->qc_backward_dep_name == ''){
                                            $status = 'ไม่ผ่าน' ;
                                          }
                                          else{
                                            $status = 'ตีกลับ ' . ( empty($out_job->qc_backward_dep_name) ? '' : $out_job->qc_backward_dep_name) ;
                                          }
                                        }
                                        if($out_job->status_job_detail == "5"){
                                            $status = 'ส่งต่อให้หมอ';
                                        }
                                        if($out_job->status_job_detail == "6"){
                                            $status = 'ส่งให้บริการ - รอติดต่อหมอ';
                                        }
                                        if($out_job->status_job_detail == "7"){
                                            $status = 'บริการ - ติดต่อหมอแล้ว';
                                        }
                                        if($out_job->status_job_detail == "8"){
                                            $status = 'แก้ไขซี่ฟันใหม่';
                                        }
                                    ?>
                                    <td>{{ $status }}</td>
                                    <td>
                                        @if($out_job->status_job_detail == "4")
                                            {{-- @foreach ($qcchecklist as $out_qcchecklist)
                                                @if($out_job->ID_Sub_Depart == $out_qcchecklist->sub_department)
                                                    {{ $out_qcchecklist->ccp }} ,
                                                @endif
                                            @endforeach
                                        --}}
                                            @foreach ($Job_QC as $out_Job_QC)
                                                @if($out_Job_QC->Job_detail_ID == $out_job->ID )
                                                     {{ $out_Job_QC->detail_ccp }}
                                                @endif
                                                {{-- @if ($out_Job_QC->Job_ID == $out_job->JobID)
                                                    1 {{ $out_Job_QC->Job_detail_ID }},{{ $out_job->ID}} 1 {{ $out_Job_QC->detail_ccp }},
                                                @endif --}}
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $out_job->Note_QC }}</td>
                                    <td>{{ $out_job->Note_Service }}</td>
                                    {{-- <td></td> --}}
                                    {{-- @if(Auth::user()->ID_type_users == 1)
                                      <td><button class="btn btn-danger btn-sm" onclick="if(confirm('ต้องการลบลำดับที่ : '+{{ $count++ }}+' ?')){return true;}else{return false;}" formaction="{{ url('/summary_report/Del_Transection') }}/{{ $out_job->ID }}/{{$id}}" ><i class="fa fa-trash"></i></button></td>
                                    @endif --}}
                                </tr>
                            @endforeach

                             @if(Auth::user()->ID_type_users == 1 && empty($job_sale) && !empty($out_job->ID))
                                <td><button class="btn btn-danger btn-sm"onclick="if(confirm('ต้องการลบลำดับที่ : '+{{ $count-1 }}+' ?')){return true;}else{return false;}"
                                    formaction="{{ url('/summary_report/Del_Transection') }}/{{ $out_job->ID }}/{{ $id }}" ><i class="fa fa-trash"></i></button></td>
                             @endif

                            @foreach ($job_sale as $out_job_sale)
                            @foreach ($order as $out_order)
                                <tr style="background-color: #15db15;color: white;">
                                    <td>{{ $count }}</td>
                                    <td>{{ $out_order->department_name }}</td>
                                    <td>{{ $out_order->sub_department_name }}
                                        @if($out_order->area != NULL)
                                        ( เขต : {{ $out_order->area }} )
                                        @endif
                                    </td>
                                    <td>
                                        {{ $out_order->employee_name }}
                                        @if($out_order->SaleID_Close != NULL)
                                        / {{ $out_order->employee_name_2 }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $out_order->Employee }}
                                        @if($out_order->SaleID_Close != NULL)
                                        / {{ $out_order->Employee_2 }}
                                        @endif
                                    </td>
                                    <td>{{ $out_order->branch_name }}</td>
                                    <td>{{ $out_order->company_name }}</td>
                                    <?php $order_updated_at = \Carbon\Carbon::parse($out_job_sale->updated_at)->format('d/m/Y - H:i'); ?>
                                    <td>{{ $order_updated_at }}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td></td>
                                    <td></td>
                                    {{-- <td></td> --}}
                                    {{-- @if(Auth::user()->ID_type_users == 1)
                                      <td><button class="btn btn-danger btn-sm" type="submit" formaction="javascript:confirm('ต้องการลบลำดับที่ : '+Count+' ?')?{{ url('/summary_report/Del_Transection') }}'+'/'+ID;: return false;"><i class="fa fa-trash"></i></button></td>
                                    @endif --}}
                                </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    {{ Form::close() }}
              </td>
          </tr>
        </table>
    </div>
  </div>
</div>
 {{--  <div class="col-12 py-2 px-0">
    <center>
      <button type="button" onclick="PrintPreview('content')" class="btn btn-outline-dark btn-block">
        <i class="fa fa-print"></i>Print Preview
      </button>
    </center>
  </div>  --}}

<script type="text/javascript">
function PrintPreview(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();

    document.body.innerHTML = originalContents;
}

</script>
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript">
  function check(n){
    if(document.getElementById("lbl_green_"+n).classList.contains("lbl_green_"+n) == true){
        if(document.getElementById("chkTooth_"+n).checked == true)
            document.getElementById("chkTooth_"+n).checked = false;
        else
            document.getElementById("chkTooth_"+n).checked = true;
        $('.lbl_green_'+n).toggleClass('check');
        $('.lbl_green_'+n).toggleClass('select');
    }
  }
</script>

@stop
