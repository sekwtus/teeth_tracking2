@extends('layouts.template')
@section('title', 'today')
@section('stylesheet')
<style>
    table{
        font-size: 13px;
    }
    #example1 div.dataTables_scrollHeadInner thead {
        height: 10em;
    line-height: 10em;
    white-space: nowrap;
    }
    #example2 div.dataTables_scrollHeadInner thead {
        height: 10em;
    line-height: 10em;
    white-space: nowrap;
    }
    /* .dataTables_filter{
        display: block;
    } */
    /* tfoot{
        display: none;
    } */
</style>

<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the initial value */
        margin-top: 5mm;
        margin-left: 5mm;
        margin-right: 25mm;

    }
    /* @media{
        tfoot{
            display:block;
        }
    } */

</style>

<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css') }}" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ url('https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css') }}" type="text/css" />


@stop

@section('content')

<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" id="stepApp">
        <div class="col-12 grid-margin">
            <div class="card" >
                <div class="card-body" style="height : 100%; width:100%;">
                    <div class="row border-bottom">
                        <div class="col-12 p-0 text-left">
                            <h4>งานที่ไม่ได้จัดส่ง</h4>
                            {{-- <button class="btn btn-primary btn-search" title="พิมพ์" data-tooltip="tooltip" onclick="pdf()"><i class="mdi mdi-24px mdi-printer"></i></button> --}}
                        </div>
                    </div>
                    <br>

                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="containComplete" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-2"><h6>ค้นหาช่วงวันที่ผลิตเสร็จ : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาลูกค้า : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาพื้นที่ : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาเขต : </h6></div>
                                <div class="col-lg-2"><h6>ค้นหาประเภทงาน : </h6></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2"><input class="form-control input-daterange-datepicker" type="text" id="daterange" name="daterange" style="padding: 0px; height: 30px;"/></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_customer" id="search_customer"style="padding: 0px; height: 30px;" /></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_zone" id="search_zone"style="padding: 0px; height: 30px;" /></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_area" id="search_area"style="padding: 0px; height: 30px;"/></div>
                                <div class="col-lg-2"><input type="text" class="form-control" name="search_work_type" id="search_work_type"style="padding: 0px; height: 30px;" /></div>
                                {{--  <div class="col-lg-1"><button id="searchToday">ค้นหา</button></div>  --}}
                            </div><br>

                            <table id="example1" class="table-striped compact nowrap table-responsive "
                                 style="width:100% ;">
                                <thead>
                                    <tr>
                                        <th class="bg-secondary text-center">วันที่รับงาน</th>
                                        <th style="padding-right: 4px;" class="bg-secondary text-center">งาน</th>
                                        <th style="padding-right: 4px;" class="bg-secondary text-center">แลป</th>
                                        <th style="padding-right: 4px;" class="bg-secondary text-center">พื้นที่</th>
                                        <th style="padding-right: 4px;" class="bg-secondary text-center">เขต</th>
                                        <th class="bg-secondary text-center">สินค้า</th>
                                        <th style="padding-right: 4px;" class="bg-secondary text-center">ลักษณะงาน</th>
                                        <th class="bg-secondary text-center">บาร์โค้ด</th>
                                        <th class="bg-secondary text-center">ทันตแพทย์</th>
                                        <th class="bg-secondary text-center">ชื่อคนไข้</th>
                                        <th class="bg-secondary text-center">H.N.</th>
                                        <th class="bg-secondary text-center">รพ./คลีนิค</th>
                                        <th class="bg-secondary text-center">วันส่งงาน</th>
                                        <th class="bg-secondary text-center">เวลาส่งงาน</th>
                                        <th class="bg-secondary text-center">วันที่นัดจริง</th>
                                        <th class="bg-secondary text-center">รอบงาน</th>
                                        <th class="bg-secondary text-center">สถานะงาน</th>
                                    </tr>
                                </thead>

                                <tfoot ><tr>
                                    <td>
                                            SFM-SA-003
                                    </td>
                                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                                    <td >
                                            REV: 02; 01/09/2010
                                    </td>
                                </tr></tfoot>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('scripts')

    {{-- <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script> --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('js/buttons.print.min.js') }}"></script> --}}

    <script>
        (function(c) {
            "function" === typeof define && define.amd ? define(["jquery", "datatables.net", "datatables.net-buttons"], function(e) {
                return c(e, window, document)
            }) : "object" === typeof exports ? module.exports = function(e, a) {
                e || (e = window);
                a && a.fn.dataTable || (a = require("datatables.net")(e, a).$);
                a.fn.dataTable.Buttons || require("datatables.net-buttons")(e, a);
                return c(a, e, e.document)
            } : c(jQuery, window, document)
        })(function(c, e, a, q) {
            var k = c.fn.dataTable,
                d = a.createElement("a"),
                p = function(b) {
                    d.href = b;
                    b = d.host; - 1 === b.indexOf("/") &&
                        0 !== d.pathname.indexOf("/") && (b += "/");
                    return d.protocol + "//" + b + d.pathname + d.search
                };
            k.ext.buttons.print = {
                className: "buttons-print",
                text: function(b) {
                    return b.i18n("buttons.print", "Print")
                },
                action: function(b, a, d, g) {
                    b = a.buttons.exportData(c.extend({
                        decodeEntities: !1
                    }, g.exportOptions));
                    d = a.buttons.exportInfo(g);
                    var k = a.columns(g.exportOptions.columns).flatten().map(function(b) {
                            return a.settings()[0].aoColumns[a.column(b).index()].sClass
                        }).toArray(),
                        m = function(b, a) {
                            for (var d = "<tr>", c = 0, e = b.length; c < e; c++){
                                if (c == 4) {
                                    d += "<" + a + " " + (k[c] ? 'class="' + k[c] + '"' : "") + "style='padding: 2px;width:45px;'>" + (null === b[c] || b[c] === q ? "" : b[c]) + "</" + a + ">";
                                }
                                else if(c == 7){
                                    d += "<" + a + " " + (k[c] ? 'class="' + k[c] + '"' : "") + "style='padding: 2px;width:90px;'>" + (null === b[c] || b[c] === q ? "" : b[c]) + "</" + a + ">";
                                }
                                else if(c == 8){
                                    d += "<" + a + " " + (k[c] ? 'class="' + k[c] + '"' : "") + "style='padding: 2px;width:80px;'>" + (null === b[c] || b[c] === q ? "" : b[c]) + "</" + a + ">";
                                }
                                else if(c == 9){
                                    d += "<" + a + " " + (k[c] ? 'class="' + k[c] + '"' : "") + "style='padding: 2px;width:80px;'>" + (null === b[c] || b[c] === q ? "" : b[c]) + "</" + a + ">";
                                }
                                else{
                                    d += "<" + a + " " + (k[c] ? 'class="' + k[c] + '"' : "") + "style='padding: 2px;width: 0px;'>" + (null === b[c] || b[c] === q ? "" : b[c]) + "</" + a + ">";
                                }
                            }
                            return d + "</tr>"
                        },
                        h = '<table id="removeNowrap" class="' + a.table().node().className + '">';
                    g.header && (h += "<thead>" + m(b.header, "th") + "</thead>");
                    h += "<tbody>";
                    for (var n = 0, r = b.body.length; n < r; n++) h += m(b.body[n], "td");
                    h += "</tbody>";
                    g.footer && b.footer && (h += "<tfoot>" + m(b.footer, "th") + "</tfoot>");
                    h += "</table>";
                    var f = e.open("", "");
                    f.document.close();
                    var l = "<title>" + d.title + "</title>";
                    c("style, link").each(function() {
                        var b = l,
                            a = c(this).clone()[0];
                        "link" === a.nodeName.toLowerCase() && (a.href = p(a.href));
                        l = b + a.outerHTML
                    });
                    try {
                        f.document.head.innerHTML = l
                    } catch (t) {
                        c(f.document.head).html(l)
                    }
                    f.document.body.innerHTML = "<div>" + (d.messageTop || "") + "</div>" + h + "<div>" + (d.messageBottom || "") + "</div>" + "<script> $('table').removeClass('nowrap');";
                    c(f.document.body).addClass("dt-print-view");
                    c("img", f.document.body).each(function(b, a) {
                        a.setAttribute("src", p(a.getAttribute("src")))
                    });
                    g.customize && g.customize(f, g, a);
                    b = function() {
                        g.autoPrint && (f.print(), f.close())
                    };
                    navigator.userAgent.match(/Trident\/\d.\d/) ?
                        b() : f.setTimeout(b, 1E3)
                },

                title: "",
                messageTop: "*",
                messageBottom: "*",
                exportOptions: {},
                header: !0,
                footer: !1,
                autoPrint: !0,
                customize: null,
            };
            return k.Buttons
        });
    </script>


    <script>

            var area = 'ทั้งหมด'
            $('#search_customer').on('keyup change', function () {
                    table.column(11).search($(this).val()).draw();
            });
            $('#search_area').on('keyup change', function () {
                    table.column(4).search($(this).val()).draw();
            });
            $('#search_work_type').on('keyup change', function () {
                    table.column(5).search($(this).val()).draw();
            });
            $('#search_zone').on('keyup change', function () {
                    table.column(3).search($(this).val()).draw();
            });

            // $("#search_area").keyup(function(){
            //     $(".search_work_type").val($(".search_area").val());
            // });

            var table = $('#example1').DataTable({
                lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
                "scrollX": false,
                orderCellsTop: true,
                fixedHeader: true,
                // processing: true,
                // serverSide: true,
                ajax: '{{ url('/table/today/waitExport') }}',
                columns: [
                   { data: 'StartDate', name: 'StartDate' },
                   { data: 'deliver_type', name: 'deliver_type' },
                   { data: 'company_name', name: 'company_name' },
                   { data: 'zone_name', name: 'zone_name' },
                   { data: 'name_area', name: 'name_area' },
                   { data: 'product_name', name: 'product_name' },
                   { data: 'Barcode', name: 'Barcode' },
                   { data: 'ID', name: 'ID' },
                   { data: 'doctorname', name: 'doctorname' },
                   { data: 'PatientName', name: 'PatientName' },
                   { data: 'PatientHN', name: 'PatientHN' },
                   { data: 'Name', name: 'Name' },
                   { data: 'DeliverDate', name: 'DeliverDate' },
                   { data: 'ReceptionTime', name: 'ReceptionTime' },
                   { data: 'Datefinal' , name: 'Datefinal'},
                   { data: 'production_cycle' , name: 'production_cycle'},
                   { data: 'department' , name: 'department'},
                ],
                columnDefs: [
                {
                    "targets": 0
                },
                {
                    "targets": 1
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
                    "targets": 5,
                },
                {
                    "targets": 6, render: function(data,type,row){
                        if(row['RefBarcode']){
                            return '<font color="red">งานแก้</font>';
                        }else if(row['ContiBarcode']){
                            return '<font color="blue">งานต่อเนื่อง</font>';
                        }else{
                            return 'งานใหม่';
                        }
                    },
                },
                {
                    "targets": 7, render: function(data,type,row){
                        var sign = "'";
                        var url = '{{ url('/summary_report/row["ID"]') }}';
                        return '<a  target="_blank" rel="noopener noreferrer" href="../summary_report/'+row["ID"]+'">'+row["Barcode"]+'</a>\
                                <input type="hidden" id="id" value="'+row["ID"]+'">';
                    }

                },
                {
                    "targets": 8
                },
                {
                    "targets": 9
                },
                {
                    "targets": 10,
                },
                {
                    "targets": 11,
                },
                {
                    "targets": 12,
                },
                {
                    "targets": 13,
                },
                {
                    "targets": 14,
                },
                {
                    "targets": 15,
                },
                {
                    "targets": 16, render: function(data,type,row){
                        if (data == null || data == '') {
                            return '<label class="badge badge-outline-danger badge-pill">รอ Screen</label>';
                        }else{
                            if(row['job_current_department'] == 1000){
                                return '<label class="badge badge-outline-primary badge-pill">รอ Screen  - แก้ไขซี่ฟันใหม่</label>';
                            }else{
                                if (row['sub_department_name'] && row['job_current_department']) {
                                // if (row['sub_department_name'] && (row['DepartmentID'] == row['job_current_department'])) {
                                    return '<label class="badge badge-outline-primary badge-pill">'+row["department"]+'  - '+row["sub_department_name"]+'</label>';
                                } else {
                                    return '<label class="badge badge-outline-primary badge-pill">'+row['department']+'</label>';
                                }
                            }
                        }
                    }
                },
                ],
                "order": [],
                dom: 'lBfrtip',
                // Roboto:{normal:"/fonts/Roboto/THSarabun.ttf",
                //         bold:"/fonts/Roboto/THSarabun.ttf",
                //         italics:"/fonts/Roboto/THSarabun.ttf",
                //         bolditalics:"/fonts/Roboto/THSarabun.ttf" },
                buttons: [
                    "copy","excel",
                    {
                        extend: "print",
                        footer: true,
                        autoPrint: true,
                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                        customize: function(win)
                        {

                            var area = $("#search_area").val();
                            if (area == null || area == '') {
                                var area = 'ทั้งหมด';
                            }

                            var customer = $("#search_customer").val();
                            if (customer == null || customer == '') {
                                var customer = 'ทั้งหมด';
                            }

                            var work_type = $("#search_work_type").val();
                            if (work_type == null || work_type == '') {
                                var work_type = 'ทั้งหมด';
                            }

                            var zone = $("#search_area").val();
                            if (zone == null || zone == '') {
                                var zone = 'ทั้งหมด';
                            }

                            var daterange = $("#daterange").val();

                            var fullDate = new Date()
                            console.log(fullDate);
                            //Thu Otc 15 2014 17:25:38 GMT+1000 {}

                            //convert month to 2 digits
                            var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) :(fullDate.getMonth()+1);

                            var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
                            console.log(currentDate);

                            var now = new Date(Date.now());
                            var formatted = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

                            var last = null;
                            var current = null;
                            var bod = [];

                            var css = '@page { size: landscape; }',
                                head = win.document.head || win.document.getElementsByTagName('head')[0],
                                style = win.document.createElement('style');

                            $(win.document.body)
                            .prepend(
                                $('<div />').addClass('row').html('<div class="col-12 text-center" style="height: 0px;"><h5><b>รายการงานที่ต้องส่ง Today<b></h5></div>'),
                                $('<div />').addClass('row').html('<div class="col-4" style="font-size: 10pt;">&nbsp;&nbsp;&nbsp;เขต  :  '+ area +' &nbsp;&nbsp; พื้นที่  :  '+zone+'</div>'+
                                    '<div class="col-8 text-right" style="font-size: 10pt;">วันที่พิมพ์ :  '+currentDate+' </div> '),
                                $('<div />').addClass('row').html('<div class="col-4" style="font-size: 10pt;">&nbsp;&nbsp;&nbsp;สินค้า  :  '+work_type+' </div>'+
                                    '<div class="col-8 text-right" style="font-size: 10pt;">เวลาที่พิมพ์ :  '+formatted+' </div>'),
                                $('<div />').addClass('row').html('<div class="col-4" style="font-size: 10pt;">&nbsp;&nbsp;&nbsp;ลูกค้า  :  '+customer+' </div>'),
                                $('<div />').addClass('row').html('<div class="col-4" style="font-size: 10pt;">&nbsp;&nbsp;&nbsp;วันที่  :  '+daterange+'</div>'),

                                // $( '<img />' )
                                // .attr('src','{{ asset("images/PCdental.png") }}')
                                // .attr('style','width:auto;height:55px;')
                                // .addClass('asset-print-img')
                            );

                            $(win.document.body).find( 'table' )
                            .removeClass('table-responsive')
                            .removeClass('nowrap')
                            .addClass( 'compact' )
                            .addClass( 'display' )
                            .attr('border','1')
                            .css( 'font-size', '7.5pt')
                            .css( 'padding', '0px')
                            .css( 'width', '100%')
                            .css({
                                margin: '0px',
                                padding:'0px',
                                border:'1px solid', })

                            // $(win.document.body).find('#footer')
                            //     .prepend(
                            //         $('<div />').addClass('row').html('<div class="col-12 text-center" style="height: 0px;"><h1>1234</h1></div>'), );

                            // $('#footer').html('sss');

                            // .prepend($('<th >')).attr('style','padding: 0px;');

                            style.type = 'text/css';
                            style.media = 'print';

                            if (style.styleSheet)
                            {
                            style.styleSheet.cssText = css;
                            }
                            else
                            {
                            style.appendChild(win.document.createTextNode(css));
                            }

                            head.appendChild(style);
                        }
                    },
                ],

            // "buttons": [
            //             'copy', 'excel',
            //             { // กำหนดพิเศษเฉพาะปุ่ม pdf
            //                 "orientation": 'landscape',
            //                 "extend": 'pdf', // ปุ่มสร้าง pdf ไฟล์
            //                 "text": 'PDF', // ข้อความที่แสดง
            //                 "pageSize": 'A4',   // ขนาดหน้ากระดาษเป็น A4
            //                 "customize":function(doc){ // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
            //                     // กำหนด style หลัก
            //                     doc.defaultStyle = {
            //                         font:'Roboto',
            //                         fontSize:16
            //                     };
            //                     // // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
            //                     doc.content[1].table.widths = [ 50, 'auto', '*', '*' ];
            //                     doc.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
            //                     var rowCount = doc.content[1].table.body.length; // หาจำนวนแถวทั้งหมดในตาราง
            //                     // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
            //                     for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
            //                         doc.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
            //                         doc.content[1].table.body[i][1].alignment = 'center';
            //                         doc.content[1].table.body[i][2].alignment = 'left';
            //                         doc.content[1].table.body[i][3].alignment = 'right';
            //                     };
            //                     console.log(doc); // เอาไว้ debug ดู doc object proptery เพื่ออ้างอิงเพิ่มเติม
            //                 }
            //             }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
            //             // 'print' , 'pageLength',
            //             {
            //                     extend: "print",
            //                     orientation: 'landscape',
            //                     customize: function(win)
            //                     {

            //                         var last = null;
            //                         var current = null;
            //                         var bod = [];

            //                         var css = '@page { size: landscape; }',
            //                             head = win.document.head || win.document.getElementsByTagName('head')[0],
            //                             style = win.document.createElement('style');

            //                         style.type = 'text/css';
            //                         style.media = 'print';

            //                         if (style.styleSheet)
            //                         {
            //                         style.styleSheet.cssText = css;
            //                         }
            //                         else
            //                         {
            //                         style.appendChild(win.document.createTextNode(css));
            //                         }

            //                         head.appendChild(style);
            //                 }
            //             },
            // ]

            });

            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var iStartDateCol = 12;

                    var daterange = $('#daterange').val();
                    var dateMin=daterange.substring(6,10) + daterange.substring(3,5)+ daterange.substring(0,2);
                    var dateMax=daterange.substring(19,23) + daterange.substring(16,18)+ daterange.substring(13,15);
                    var colDate=data[iStartDateCol].substring(6,10) + data[iStartDateCol].substring(3,5)+ data[iStartDateCol].substring(0,2);

                    var areaSale=parseInt($('#areaSale').val());

                    var min = parseInt( dateMin );
                    var max = parseInt( dateMax );
                    var Date_data = parseFloat( colDate ) || 0;

                    if ( ( isNaN( min ) && isNaN( max ) ) ||
                        ( isNaN( min ) && Date_data <= max ) ||
                        ( min <= Date_data   && isNaN( max ) ) ||
                        ( min <= Date_data   && Date_data <= max )
                        )
                    {
                        return true;
                    }
                    return false;
                }
            );

            $(document).ready(function() {
                $('#daterange').change( function() {
                    table.draw();
                } );
            } );
        </script>

            <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/filtering/row-based/range_dates.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script>
            $('#daterange').daterangepicker({
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse',
                todayBtn: true,
                language: 'th',
                thaiyear: true,
                locale: {
                    format: 'DD/MM/YYYY',
                    daysOfWeek : [
                                    "อา.",
                                    "จ.",
                                    "อ.",
                                    "พ.",
                                    "พฤ.",
                                    "ศ.",
                                    "ส."
                                ],
                    monthNames : [
                                    "มกราคม",
                                    "กุมภาพันธ์",
                                    "มีนาคม",
                                    "เมษายน",
                                    "พฤษภาคม",
                                    "มิถุนายน",
                                    "กรกฎาคม",
                                    "สิงหาคม",
                                    "กันยายน",
                                    "ตุลาคม",
                                    "พฤศจิกายน",
                                    "ธันวาคม"
                                ],
                    firstDay : 0
                }
            });


        </script>
        {{-- <script>
          function pdf(){
                swal({
                title: 'ต้องการพิมพ์รายงานหรือไม่ ?',
                type: 'question',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                })
                .then((result) => {
                if (true){
                    // alert('s');
                    window.open("{{ url('pdf/rpt-1') }}","_blank");
                }
                })
            }
        </script> --}}
@stop
