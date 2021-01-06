@extends('layouts.template')
@section('title', 'Report')
@section('stylesheet')

@stop

@section('content')
<div class="row">
    <div class="col-12 ">
            <div class="card-body">
                <h2 class=" text-center">รายงาน งานทำใหม่</h2>
                <div class="row">
                        <div class="col-10 "> </div>
                    <div class="col-2" id="selectedMount">
                    </div>
                </div>

                <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                <div id="Bar-chart" class="google-charts"></div>
                </div>
            </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- select mount --}}
                <div class="row">
                    <div class="col-md-1">
                    <select class="form-control form-control-sm" name="monthYears1" id="monthYears1">
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

                    <input type="button" class="btn btn-sm btn-success" id="getMonth" value="Get Chart"/>
                </div>
                <br>

                <table id="table_report"  class=" table-striped table-bordered display compact nowrap " width="100%">
                    <thead>
                        <tr>
                            <th style="padding: 5px;" rowspan="2">เดือน</th>
                        @foreach ($work_defect as $work_def)
                            <th style="padding: 5px;" colspan="5" class="text-center">{{ $work_def->detail_type }}</th>   
                        @endforeach
                            <th style="padding: 5px;" class="text-center" rowspan="2" >รวม</th>
                        </tr>
                        <tr>
                        @foreach ($work_defect as $work_def)
                            <th style="padding: 5px;">W1</th>
                            <th style="padding: 5px;">W2</th>
                            <th style="padding: 5px;">W3</th>
                            <th style="padding: 5px;">W4</th>
                            <th style="padding: 5px;">W5</th>
                        @endforeach
                            
                        </tr>
                    </thead>
                    <tbody>

                            @php
                                $mountCount = ["01","02","03","04","05","06","07","08","09","10","11","12"];
                                $mountName = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
                            @endphp
                            @foreach ($sql as $key => $value)
                                @php
                                $analys[$value->mount][$value->weeks][$value->ddlTypeEdit] = 0;
                                @endphp
                            @endforeach
                            
                            @foreach ($sql as $key => $value)
                                @php
                                $analys[$value->mount][$value->weeks][$value->ddlTypeEdit]++;
                                @endphp
                            @endforeach

                    @for ($i = 0; $i < 12; $i++)
                    @php
                        $countInMount = 0;
                    @endphp
                    <tr>
                            <th>{{ $mountName[$i] }}</th>
                        @foreach ($work_defect as $work_def)
                            @if (empty($analys[$mountCount[$i]][1][$work_def->id]))
                                <td style="padding: 5px;"class="text-center">0</td>
                            @else
                                @php $countInMount = $countInMount + $analys[$mountCount[$i]][1][$work_def->id] @endphp
                                <td style="padding: 5px;"class="text-center">{{ $analys[$mountCount[$i]][1][$work_def->id] }}</td>
                            @endif

                            @if (empty($analys[$mountCount[$i]][2][$work_def->id]))
                                <td style="padding: 5px;"class="text-center">0</td>
                            @else
                                @php $countInMount = $countInMount + $analys[$mountCount[$i]][2][$work_def->id] @endphp
                                <td style="padding: 5px;"class="text-center">{{ $analys[$mountCount[$i]][2][$work_def->id] }}</td>
                            @endif

                            @if (empty($analys[$mountCount[$i]][3][$work_def->id]))
                                <td style="padding: 5px;"class="text-center">0</td>
                            @else
                                @php $countInMount = $countInMount + $analys[$mountCount[$i]][3][$work_def->id] @endphp
                                <td style="padding: 5px;"class="text-center">{{ $analys[$mountCount[$i]][3][$work_def->id] }}</td>
                            @endif

                            @if (empty($analys[$mountCount[$i]][4][$work_def->id]))
                                <td style="padding: 5px;"class="text-center">0</td>
                            @else
                                @php $countInMount = $countInMount + $analys[$mountCount[$i]][4][$work_def->id] @endphp
                                <td style="padding: 5px;"class="text-center">{{ $analys[$mountCount[$i]][4][$work_def->id] }}</td>
                            @endif
 
                            @if (empty($analys[$mountCount[$i]][5][$work_def->id]))
                                <td style="padding: 5px;"class="text-center">0</td>
                            @else
                                @php $countInMount = $countInMount + $analys[$mountCount[$i]][5][$work_def->id] @endphp
                                <td style="padding: 5px;"class="text-center">{{ $analys[$mountCount[$i]][5][$work_def->id] }}</td>
                            @endif
                        @endforeach
                        <td style="padding: 5px;" class="text-center">{{ $countInMount }}</td>                        
                    </tr>
                     @endfor        

                        {{-- @php
                            var_dump($mountCount[4]);
                        @endphp --}}
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>     

$('#getMonth').click(function(){
    var _1st = $('#monthYears1').val();
    var _2nd = $('#monthYears2').val();
    
    if (_1st == _2nd) {
        alert('กรุณาเลือกเดือนที่แตกต่างกัน');
    }else{
        $.ajax({
        type: 'GET',
        url: '{{ url('get_data_report_work_defect_week') }}',
        data: {_1st:_1st,_2nd:_2nd},
        success: function (datax) {
            drawStuff(datax);
        }
        });

        switch (_1st) {
            case '01': _1st = 'มกราคม'; break; 
            case '02': _1st = 'กุมภาพันธ์'; break; 
            case '03': _1st = 'มีนาคม'; break;    
            case '04': _1st = 'เมษายน'; break; 
            case '05': _1st = 'พฤษภาคม'; break; 
            case '06': _1st = 'มิถุนายน'; break; 
            case '07': _1st = 'กรกฎาคม'; break; 
            case '08': _1st = 'สิงหาคม'; break; 
            case '09': _1st = 'กันยายน'; break;    
            case '10': _1st = 'ตุลาคม'; break; 
            case '11': _1st = 'พฤศจิกายน'; break; 
            case '12': _1st = 'ธันวาคม'; 
        };
        switch (_2nd) {
            case '01': _2nd = 'มกราคม'; break; 
            case '02': _2nd = 'กุมภาพันธ์'; break; 
            case '03': _2nd = 'มีนาคม'; break;    
            case '04': _2nd = 'เมษายน'; break; 
            case '05': _2nd = 'พฤษภาคม'; break; 
            case '06': _2nd = 'มิถุนายน'; break; 
            case '07': _2nd = 'กรกฎาคม'; break; 
            case '08': _2nd = 'สิงหาคม'; break; 
            case '09': _2nd = 'กันยายน'; break;    
            case '10': _2nd = 'ตุลาคม'; break; 
            case '11': _2nd = 'พฤศจิกายน'; break; 
            case '12': _2nd = 'ธันวาคม';
        };
        $('#selectedMount').html('<div class="badge" style="background-color:#76C1FA;font-size: 20px;" >'+_1st+'</div>\
                                  <div class="badge" style="background-color:#ffa3a3;font-size: 20px;" >'+_2nd+'</div>');
    }

    // Bar Charts Starts
    google.charts.load('current', {
    'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff);

    function drawStuff(dataAjex) {
        var obj = JSON.parse(dataAjex);
        // console.log(obj);
    var data = new google.visualization.arrayToDataTable(obj);

    var options = {
        title: 'Approximating Normal Distribution',
        legend: {
        position: 'none'
        },
        colors: ['#76C1FA','#ffa3a3','#76C1FA','#ffa3a3','#76C1FA','#ffa3a3','#76C1FA','#ffa3a3','#76C1FA','#ffa3a3'],

        chartArea: {
        width: 401
        },
        hAxis: {
        ticks: [-1, -0.75, -0.5, -0.25, 0, 0.25, 0.5, 0.75, 1]
        },
        bar: {
        gap: 0,
        groupWidth: '100%'
        },
        vAxis: {  
            viewWindow: { max: 100 }
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

});
</script>


<script>
$.ajax({
    type: 'GET',
    url: '{{ url('get_data_report_work_defect_week') }}',
    data: {},
    success: function (data) {
        // var obj = JSON.parse(data);
        // console.log(data);
    }
    });
</script>

<script>
    $(document).ready(function() {
        $('#table_report').DataTable({
            lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
            "ordering": false,
        });
    } );
</script>

@stop

