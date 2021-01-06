@extends('layouts.template')
@section('title', 'Report')
@section('stylesheet')
<style>
    .ajax-loader {
    visibility: hidden;
    background-color: rgba(255,255,255,0.7);
    position: absolute;
    z-index: +100 !important;
    width: 100%;
    height:100%;
    }

    .ajax-loader img {
    position: relative;
    top:50%;
    left:40%;
    }
</style>

<style>
        div.scrollmenu {
          /* background-color: #333; */
          overflow: auto;
          white-space: nowrap;
        }
        
        div.scrollmenu a {
          display: inline-block;
          color: white;
          text-align: center;
          padding: 14px;
          text-decoration: none;
        }
        
        div.scrollmenu a:hover {
          background-color: #777;
        }
</style>

{{-- <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}"> --}}
@stop

@section('content')
<h2 class=" text-center">ยูนิตงานแก้ของพนักงาน</h2>
<div class="ajax-loader">
    <img src="../../images/ajax-loader.gif" alt=""  class="img-responsive" />
</div>

<div class="row" style="padding-top: 20px;">
    <div class="col-md-2">
    <select  class="form-control form-control-sm"  name="department" id="department">
            <option value="">เลือกแผนก</option>
        @foreach ($department as $depart)
            <option value="{{ $depart->ID }}">{{ $depart->Name }}</option>
        @endforeach
    </select></div>

            <div class="col-md-1">
            <select class="form-control form-control-sm" name="monthYears1" id="monthYears1">
                    <option value="">เลือกเดือน</option>
                    <option value="01">มกราคม </option>
                    <option value="02">กุมภาพันธ์ </option>
                    <option value="03">มีนาคม </option>
                    <option value="04">เมษายน </option>
                    <option value="05">พฤษภาคม </option>
                    <option value="06">มิถุนายน </option>
                    <option value="07">กรกฎาคม </option>
                    <option value="08">สิงหาคม </option>
                    <option value="09">กันยายน </option>
                    <option value="10">ตุลาคม </option>
                    <option value="11">พฤศจิกายน </option>
                    <option value="12">ธันวาคม </option>
            </select></div>
        
            <div class="col-md-1">
            <select class="form-control form-control-sm" name="monthYears2" id="monthYears2">
                    <option value="">เลือกเดือน</option>
                    <option value="01">มกราคม </option>
                    <option value="02">กุมภาพันธ์ </option>
                    <option value="03">มีนาคม </option>
                    <option value="04">เมษายน </option>
                    <option value="05">พฤษภาคม </option>
                    <option value="06">มิถุนายน </option>
                    <option value="07">กรกฎาคม </option>
                    <option value="08">สิงหาคม </option>
                    <option value="09">กันยายน </option>
                    <option value="10">ตุลาคม </option>
                    <option value="11">พฤศจิกายน </option>
                    <option value="12">ธันวาคม </option>
            </select></div>

    <div class="col-md-3">
    <input class="btn btn-sm btn-success" type="button" onclick="getTable()" value="Get Chart"/></div>
</div><br>

<div class="row">
    <div class="col-4 ">
        <table id="myTable" width="100%" class="table table-striped table-responsive table-hover">
            <thead>  
                <tr>
                    <th style="padding: 5px;">รหัส</th>
                    <th style="padding: 5px;">ชื่อเล่น</th>
                    <th style="padding: 5px;">ยูนิตเบค</th>
                    <th style="padding: 5px;">ยูนิตแก้</th>
                    <th style="padding: 5px;" id="text_1st">งานแก้เดือน..</th>
                    <th style="padding: 5px;" id="text_2nd">งานแก้เดือน..</th>
                </tr>
            </thead>  
            <tbody id="rowData"></tbody>
        </table>
    </div>

    <div class="col-8" >
        <div class="card scrollmenu">
            <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                <div id="Bar-chart" class="google-charts"></div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('js/shared/widgets.js') }}"></script>
<script src="{{ asset('js/shared/todo.js') }}"></script>
{{-- <script src="{{ url('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script> --}}
<script>
    // Bar Charts Starts

    function getTable(depart){
        var depart = $('#department').val();
        var _1st = $('#monthYears1').val();
        var _2nd = $('#monthYears2').val();
        var text_1st = $('#monthYears1 option:selected').text();
        var text_2nd = $('#monthYears2 option:selected').text();
        $.ajax({
            type: 'GET',
            beforeSend: function(){
                $('.ajax-loader').css("visibility", "visible");
            },
            url: '{{ url('/table/report_employee/unit/getajax_unit') }}',
            data: {department:depart,_1st:_1st,_2nd:_2nd},
        
            success: function (data) {
                    console.log(data)
                    var row ='';
                    for (let i = 0; i < data[0].length; i++) {
                    row = row + '<tr>\
                                    <td style="padding: 5px;">'+data[0][i][0]+'</td>\
                                    <td style="padding: 5px;">'+data[0][i][1]+'</td>\
                                    <td style="padding: 5px;">'+data[0][i][2]+'</td>\
                                    <td style="padding: 5px;">'+data[0][i][3]+'</td>\
                                    <td style="padding: 5px;">'+data[0][i][4]+'</td>\
                                    <td style="padding: 5px;">'+data[0][i][5]+'</td>\
                                </tr>';
                    }
                    
                    $('#rowData').html(row);
                    $('#text_1st').html('งานแก้เดือน'+text_1st);
                    $('#text_2nd').html('งานแก้เดือน'+text_2nd);
                    drawStuff(data[1]);
            },
            complete: function(){
                $('.ajax-loader').css("visibility", "hidden");
            }
        }); 
    }
    
            // Bar Charts Starts
            google.charts.load('current', {
            'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawStuff);

            function drawStuff(dataAjex) {
                
                // console.log(obj);
            var data = new google.visualization.arrayToDataTable(dataAjex);

            var options = {
                title: 'Approximating Normal Distribution',
                legend: {
                position: 'none'
                },
                colors: ['#76C1FA','#ffa3a3','#76C1FA','#ffa3a3','#76C1FA','#ffa3a3','#76C1FA','#ffa3a3','#76C1FA','#ffa3a3'],

                chartArea: {
                width: 1000
                },
                hAxis: {
                ticks: [-1, -0.75, -0.5, -0.25, 0, 0.25, 0.5, 0.75, 1]
                },
                bar: {
                gap: 0,
                groupWidth: '200%'
                },
                vAxis: {  
                    viewWindow: { max: 200 }
                },
                hAxis: {  
                    viewWindow: { max: 200 }
                },

                histogram: {
                bucketSize: 0.02,
                maxNumBuckets: 200,
                minValue: -1,
                maxValue: 1
                }
            };

            var chart = new google.charts.Bar(document.getElementById('Bar-chart'));
            chart.draw(data, options);
            };
            // Bar Charts Ends
</script>


@stop

