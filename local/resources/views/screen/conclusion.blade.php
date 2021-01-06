@extends('layouts.template')
@section('title', 'สรุปข้อมูล Screen')

@section('stylesheet')

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="5OkiOqxQFTKikiQDesqvvWfpxmazrKRon4lxDoVu">

  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="print.css" />

  <link rel="stylesheet" type="text/css" href="Style.css" />
  <style media="screen">
    /* ตารางหลัก */
    .tbl td, .tbl th{
      padding: 5px;
      font-size: 12px;
    }
    .hidden{
      display: none;
    }

    /* pointer (checkbox,radio) */
    .custom-control label, .pointer{
      cursor: pointer;
    }

    /* รูปฟัน */
    .pontic {
      border: 0px dashed #444;
      width: 30px;
      height: 30px;
      transition: 500ms all;
    }

    .bg-warning{
      font-weight: bold;
    }
  </style>
  <style type="text/css" media="print">
    @page { size: landscape; }
  </style>


@stop

@section('content')
<div class="container-fluid" id="content"> {{--content-wrapper --}}
  <div class="row">
    <div class="col-12 px-0">
      @foreach($order as $out_order)
        <table id="tbl-1" class="tbl" width="100%" border="1">
          <tr class="bg-secondary text-center">
            <th width="51%">ข้อมูลทั่วไป</th>
            <th width="22%">ข้อมูลวันเวลาผลิต</th>
            <th width="22%">ข้อมูลรหัสงาน</th>
            <th width="5%">แก้ไข</th>
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
                <div class="col-md-6 col-lg-6 pr-lg-0">
                  <b>ชื่อ SALE : </b>{{ $out_order->employee_name }}
                </div>
                <div class="col-md-6 col-lg-6 pr-lg-0">
                  <b>เขต : </b>{{ $out_order->ID_area }}
                </div>
              </div>
              <div class="row py-1">
                <div class="col-md-12 col-lg-12">
                    <b>หมายเหตุ : </b>{{ $out_order->note }}
                </div>
              </div>

              {{-- <center class="py-1">
                <div class="col-3 px-0">
                  <a href="{{ url('/mainscreen/edit_conclusion_general').'/'.$out_order->ID }}" title="แก้ไข"  class="btn btn-outline-warning btn-block">
                    <i class="fa fa-edit"></i>แก้ไข
                  </a>
                </div>
              </center> --}}
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
                      {{-- <div class="col-12 py-1">
                        <b>ประเภทงานแก้ : </b><b>{{ $out_order->name_type_2 }}</b> {{ $out_order->detail_type_2 }}
                      </div> --}}


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
                                  @if ($out_data_ref->detail_type_2 == 'อื่นๆ (ระบุ)')
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
            </td>
            <td rowspan="7">
                @if(!empty($endflow))
                    @if($count_job == 0)
                    <center class="py-1">
                        <a href="{{ url('/mainscreen/edit_conclusion_general').'/'.$out_order->ID }}" class="btn btn-icons btn-outline-warning" title="แก้ไข"  class="btn btn-outline-warning btn-block">
                            <i class="fa fa-edit"></i>
                        </a>
                    </center>
                    @else
                    <button class="btn btn-icons btn-outline-danger" title="แก้ไข" onclick="complete()">
                        <i class="fa fa-edit"></i>
                    </button>
                    @endif
                @else
                    @if($count_job == 0)
                    <button class="btn btn-icons btn-outline-danger" title="แก้ไข" onclick="complete_2()">
                        <i class="fa fa-edit"></i>
                    </button>
                    @else
                    <button class="btn btn-icons btn-outline-danger" title="แก้ไข" onclick="complete()">
                        <i class="fa fa-edit"></i>
                    </button>
                    @endif
                @endif
            </td>
          </tr>
        {{-- </table> --}}
      @endforeach

      {{-- <table id="tbl-2" class="tbl" width="100%" border="1"> --}}
              <tr class="bg-secondary text-center">
                <th width="30%">คำสั่งพิเศษ</th>
                <th width="30%">สิ่งที่ส่งมาด้วย</th>
                <th width="30%">อุปกรณ์ IMPLANT</th>
              </tr>

              <tr>
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
      {{-- </table> --}}

      {{-- <table id="tbl-3" class="tbl" width="100%" border="1"> --}}
              <tr class="bg-secondary text-center">
                <td width="43%" bgcolor="#FF0000" style="color: white">คำสั่งเพิ่มเติม</td>
                <td width="29%">สิ่งที่ส่งมาด้วยเพิ่มเติม</td>
                <td width="28%">อุปกรณ์ IMPLANT เพิ่มเติม</td>
              </tr>
              <tr>
                <td valign="top">
                  <div class="row mb-3">
                    <div class="col-md-12">
                      @foreach ($select_extra_additional as $additional)
                        <label style="color:#FF0000">{{ $additional->detail }}</label>
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
    </div>
    {{-- <div class="col-1 px-0">
      <table class="tbl" width="100%" height="100%" border="0">
        <tr class="bg-secondary text-center">
          <th width="20%">แก้ไข</th>
        </tr>
        <tr height="100%">
          <td>
            <center class="py-1">
              <a href="{{ url('/mainscreen/edit_conclusion_general').'/'.$out_order->ID }}" class="btn btn-icons btn-outline-warning" title="แก้ไข"  class="btn btn-outline-warning btn-block">
                <i class="fa fa-edit"></i>
              </a>
            </center>
          </td>
        </tr>
      </table>
    </div> --}}
  </div>
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
          <th>แก้ไข</th>
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
                      @foreach ($teeth as $out_teeth)
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

          <td rowspan="4">
            @if(!empty($endflow))
                @if($count_job == 0)
                <a href="{{ url('/mainscreen/edit_conclusion/').'/'.$id.'/'.$screen_group->screen_group }}" class="btn btn-icons btn-outline-warning" title="แก้ไข" >
                    <i class="fa fa-edit"></i>
                </a>
                @else
                <button class="btn btn-icons btn-outline-danger" title="แก้ไข" onclick="complete()">
                    <i class="fa fa-edit"></i>
                </button>
                @endif
            @else
                    @if($count_job == 0)
                    <button class="btn btn-icons btn-outline-danger" title="แก้ไข" onclick="complete_2()">
                        <i class="fa fa-edit"></i>
                    </button>
                    @else
                    <button class="btn btn-icons btn-outline-danger" title="แก้ไข" onclick="complete()">
                        <i class="fa fa-edit"></i>
                    </button>
                    @endif
            @endif
          </td>
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
                <div class=" text-center">{{$screen_group->txtCommentAlloys}}<br>{{$screen_group->comment_Metal_type}}</div>
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
                <div class="col-12">
                  {{ $screen_group->implant_brand_comment=='' ?'' :$screen_group->implant_brand_comment }}
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

        <tr>
          <th class="bg-secondary text-center">ขั้นตอนรอถามแพทย์</th>
          <td valign="top" colspan="6">
            @if($screen_group->comment_Metal_type != NULL)
                <div class="badge badge-outline-primary">ALLOYS</div>
            @endif
            @if($screen_group->comment_model != NULL)
                <div class="badge badge-outline-primary">MODEL</div>
            @endif
            @if($screen_group->comment_shade != NULL)
                <div class="badge badge-outline-primary">SHADE</div>
            @endif
            @if($screen_group->comment_stump != NULL)
                <div class="badge badge-outline-primary">STUMP</div>
            @endif
            @if($screen_group->comment_fix_cement != NULL)
                <div class="badge badge-outline-primary">FIX CEMENT</div>
            @endif
          </td>
        </tr>
        <tr>
          <th class="bg-secondary text-center">ขั้นตอนการทำงาน(แผนก)</th>
          <td valign="top" colspan="6">
            @foreach ($flow as $out_flow)
                {{$out_flow->flow}}
            @endforeach
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
<div class="col-12 py-2 px-0">
    @if(!empty($endflow))
   <center>
     <a  href="{{ url('/mainscreen/edit_teeth/'.$id) }}">
     <button type="button" class="btn btn-outline-warning btn-block">
       <i class="fa fa-edit"></i>แก้ไขเลือกซี่ฟัน
     </button>
   </center>
   @endif
</div>
<div class="col-12 py-2 px-0">
   <center>
     <button type="button" onclick="PrintPreview('content')" class="btn btn-outline-dark btn-block">
       <i class="fa fa-print"></i>Print Preview
     </button>
   </center>
</div>

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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}

<script>
function complete() {
  alert("ไม่สามารถแก้ไขได้เนื่องจากงานจัดส่งแล้ว");
}

function complete_2() {
  alert("ไม่สามารถแก้ไขได้เนื่องจากงานอยู่ในแผนก");
}
</script>

@stop
