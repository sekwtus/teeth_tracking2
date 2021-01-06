@extends('layouts.template')
@section('title', 'Report')
@section('stylesheet')
v
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
    .form-control,.form-control-sm{
        color: black;
        font-style: normal;
    }

</style>
{{-- <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}"> --}}
@stop

@section('content')
{{-- <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">งานแก้ทั้งหมด</h3>
                <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                <div id="Bar-chart" class="google-charts"></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-2">
    <select  class="form-control form-control-sm"  name="department" id="department" onchange="getEmployee()">
            <option value="">เลือกแผนก</option>
        @foreach ($department as $depart)
            <option value="{{ $depart->ID }}">{{ $depart->Name }}</option>
        @endforeach
    </select></div>

            <div class="col-md-2">
            <select class="form-control form-control-sm" name="employee" id="employee">
                    
            </select></div>
            <div class="row" style="padding-left:3%;padding-top:1%;padding-bottom:1%;">
                @foreach ($work_defect_type as $defect_type)
                <div class="col-lg-2 pr-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="{{ $defect_type->id }}" class="custom-control-input" name="chk" id="{{ $defect_type->id }}" >
                        <label class="custom-control-label" for="{{ $defect_type->id }}">{{ $defect_type->detail_type }}</label>
                    </div>
                </div>
                @endforeach
            </div>
            
           
    <div class="col-md-3">
    <input class="btn btn-sm btn-success" type="button" onclick="getTable()" value="Get Chart"/></div>
</div><br>

<div class="row">
    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <table id="myTable" width="200%" class="table table-striped table-responsive table-hover">
            <thead>  
                <tr>
                    <th style="padding: 5px;">2019</th>
                    <th style="padding: 5px;">สูง</th>
                    <th style="padding: 5px;">ไม่สบ</th>
                    <th style="padding: 5px;">แตกร้าว</th>
                    <th style="padding: 5px;">คอนเทค</th>
                    <th style="padding: 5px;">รูปร่าง</th>
                    <th style="padding: 5px;">สี</th>
                    <th style="padding: 5px;">รวม</th>
                </tr>
            </thead>  
            <tbody id="rowData">
                <tr></tr>
            </tbody>
        </table>
    </div>

    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <div class="card">
        <div class="card-body">
            <h2 class="text-center" >งานแก้รวม</h4>
            <div id="curve_chart1" style="width: 100%; height: 500px"></div>
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <div class="card">
        <div class="card-body">
            <h2 class="text-center" >งานแก้...</h4>
            <div id="curve_chart2" style="width: 100%; height: 500px"></div>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <div class="card">
        <div class="card-body">
            <h2 class="text-center" >งานแก้...</h4>
            <div id="curve_chart3" style="width: 100%; height: 500px"></div>
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <div class="card">
        <div class="card-body">
            <h2 class="text-center" >งานแก้...</h4>
            <div id="curve_chart4" style="width: 100%; height: 500px"></div>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <div class="card">
        <div class="card-body">
            <h2 class="text-center" >งานแก้...</h4>
            <div id="curve_chart5" style="width: 100%; height: 500px"></div>
        </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <div class="card">
        <div class="card-body">
            <h2 class="text-center" >งานแก้...</h4>
            <div id="curve_chart6" style="width: 100%; height: 500px"></div>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
        <div class="card">
        <div class="card-body">
            <h2 class="text-center" >งานแก้...</h4>
            <div id="curve_chart7" style="width: 100%; height: 500px"></div>
        </div>
        </div>
    </div>
</div>
        

@stop

@section('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ url('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script>
   
    function getTable(depart){
        var depart = $('#department').val();
        var employee = $('#employee').val();
        var text_1st = $('#monthYears1 option:selected').text();
        var text_2nd = $('#monthYears2 option:selected').text();
        var arrWorkdefect=[];
        $.each($("input[name='chk']:checked"), function(){
            arrWorkdefect.push($(this).val());
        });

        
        $.ajax({
            type: 'GET',
            url: '{{ url('/table/report_employee/unit/getajax_unit_workDefect') }}',
            data: {department:depart,employee:employee,arrWorkdefect:arrWorkdefect},
            success: function (data) {
                    console.log(data[10][1])

                    // $('#myTable').DataTable({});
                    var row ='';
                    for (let i = 0; i < data.length; i++) {
                    row = row + '<tr>\
                                    <td >'+data[i][0]+'</td>\
                                    <td >'+data[i][1]+'</td>\
                                    <td >'+data[i][2]+'</td>\
                                    <td >'+data[i][3]+'</td>\
                                    <td >'+data[i][4]+'</td>\
                                    <td >'+data[i][5]+'</td>\
                                    <td >'+data[i][6]+'</td>\
                                    <td >'+data[i][7]+'</td>\
                                </tr>';
                    }
                    
                    $('#rowData').html(row);

    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart1);

    function drawChart1() {

        
        // 1
        var dataChart = new google.visualization.DataTable();
        dataChart.addColumn('string', 'Day');
        dataChart.addColumn('number', 'ไม่สบ');

        dataChart.addRows([
                        [data[0][0], data[0][7]],
                        [data[1][0], data[1][7]],
                        [data[2][0], data[2][7]],
                        [data[3][0], data[3][7]],
                        [data[4][0], data[4][7]],
                        [data[5][0], data[5][7]],
                        [data[6][0], data[6][7]],
                        [data[7][0], data[7][7]],
                        [data[9][0], data[9][7]],
                        [data[10][0], data[10][7]],
                        [data[11][0], data[11][7]],
                        ]);
        var options = {
            legend: 'none',
            lineWidth:50,
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart1'));
        chart.draw(dataChart, google.charts.Line.convertOptions(options));
        
        // 2
        var dataChart = new google.visualization.DataTable();
        dataChart.addColumn('string', 'Day');
        dataChart.addColumn('number', 'สูง');

        dataChart.addRows([
                        [data[0][0], data[0][1]],
                        [data[1][0], data[1][1]],
                        [data[2][0], data[2][1]],
                        [data[3][0], data[3][1]],
                        [data[4][0], data[4][1]],
                        [data[5][0], data[5][1]],
                        [data[6][0], data[6][1]],
                        [data[7][0], data[7][1]],
                        [data[9][0], data[9][1]],
                        [data[10][0], data[10][1]],
                        [data[11][0], data[11][1]],
                        ]);
        var options = {
            legend: 'none',
            lineWidth:50,
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart2'));
        chart.draw(dataChart, google.charts.Line.convertOptions(options));

        // 3
        var dataChart = new google.visualization.DataTable();
        dataChart.addColumn('string', 'Day');
        dataChart.addColumn('number', 'ไม่สบ');

        dataChart.addRows([
                        [data[0][0], data[0][2]],
                        [data[1][0], data[1][2]],
                        [data[2][0], data[2][2]],
                        [data[3][0], data[3][2]],
                        [data[4][0], data[4][2]],
                        [data[5][0], data[5][2]],
                        [data[6][0], data[6][2]],
                        [data[7][0], data[7][2]],
                        [data[9][0], data[9][2]],
                        [data[10][0], data[10][2]],
                        [data[11][0], data[11][2]],
                        ]);
        var options = {
            legend: 'none',
            lineWidth:50,
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart3'));
        chart.draw(dataChart, google.charts.Line.convertOptions(options));

        // 4
        var dataChart = new google.visualization.DataTable();
        dataChart.addColumn('string', 'Day');
        dataChart.addColumn('number', 'ไม่สบ');

        dataChart.addRows([
                        [data[0][0], data[0][3]],
                        [data[1][0], data[1][3]],
                        [data[2][0], data[2][3]],
                        [data[3][0], data[3][3]],
                        [data[4][0], data[4][3]],
                        [data[5][0], data[5][3]],
                        [data[6][0], data[6][3]],
                        [data[7][0], data[7][3]],
                        [data[9][0], data[9][3]],
                        [data[10][0], data[10][3]],
                        [data[11][0], data[11][3]],
                        ]);
        var options = {
            legend: 'none',
            lineWidth:50,
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart4'));
        chart.draw(dataChart, google.charts.Line.convertOptions(options));

        // 5
        var dataChart = new google.visualization.DataTable();
        dataChart.addColumn('string', 'Day');
        dataChart.addColumn('number', 'ไม่สบ');

        dataChart.addRows([
                        [data[0][0], data[0][4]],
                        [data[1][0], data[1][4]],
                        [data[2][0], data[2][4]],
                        [data[3][0], data[3][4]],
                        [data[4][0], data[4][4]],
                        [data[5][0], data[5][4]],
                        [data[6][0], data[6][4]],
                        [data[7][0], data[7][4]],
                        [data[9][0], data[9][4]],
                        [data[10][0], data[10][4]],
                        [data[11][0], data[11][4]],
                        ]);
        var options = {
            legend: 'none',
            lineWidth:50,
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart5'));
        chart.draw(dataChart, google.charts.Line.convertOptions(options));

        // 6
        var dataChart = new google.visualization.DataTable();
        dataChart.addColumn('string', 'Day');
        dataChart.addColumn('number', 'ไม่สบ');

        dataChart.addRows([
                        [data[0][0], data[0][5]],
                        [data[1][0], data[1][5]],
                        [data[2][0], data[2][5]],
                        [data[3][0], data[3][5]],
                        [data[4][0], data[4][5]],
                        [data[5][0], data[5][5]],
                        [data[6][0], data[6][5]],
                        [data[7][0], data[7][5]],
                        [data[9][0], data[9][5]],
                        [data[10][0], data[10][5]],
                        [data[11][0], data[11][5]],
                        ]);
        var options = {
            legend: 'none',
            lineWidth:50,
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart6'));
        chart.draw(dataChart, google.charts.Line.convertOptions(options));


        // 7
        var dataChart = new google.visualization.DataTable();
        dataChart.addColumn('string', 'Day');
        dataChart.addColumn('number', 'ไม่สบ');

        dataChart.addRows([
                        [data[0][0], data[0][6]],
                        [data[1][0], data[1][6]],
                        [data[2][0], data[2][6]],
                        [data[3][0], data[3][6]],
                        [data[4][0], data[4][6]],
                        [data[5][0], data[5][6]],
                        [data[6][0], data[6][6]],
                        [data[7][0], data[7][6]],
                        [data[9][0], data[9][6]],
                        [data[10][0], data[10][6]],
                        [data[11][0], data[11][6]],
                        ]);
        var options = {
            legend: 'none',
            lineWidth:50,
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart7'));
        chart.draw(dataChart, google.charts.Line.convertOptions(options));


    }

                    
            }
        }); 
    }
</script>

<script>
    $('#getMonth').click(function(){
        var _1st = $('#monthYears1').val();
        var _2nd = $('#monthYears2').val();
        var _3th = $('#monthYears3').val();

        if (_1st == _2nd || _1st == _3th || _2nd == _3th) {
            alert('กรุณาเลือกเดือนที่แตกต่างกัน');
        }

        $.ajax({
        type: 'GET',
        url: '{{ url('get_data_report_work_defect') }}',
        data: {_1st:_1st,_2nd:_2nd,_3th:_3th},
        success: function (datax) {
            drawStuff(datax);
        }
        }); 

    // Bar Charts Starts
        google.charts.load('current', {
        'packages': ['bar']
        });
        // google.charts.setOnLoadCallback(drawStuff(dataAjex));

        function drawStuff(dataAjex) {
            var obj = JSON.parse(dataAjex);
            // console.log(obj);
        var data = new google.visualization.arrayToDataTable(obj);

        var options = {
            title: 'Approximating Normal Distribution',
            legend: {
            position: 'none'
            },
            colors: ['blue','red','green'],

            chartArea: {
            width: 401
            },
            hAxis: {
            ticks: [-1, -0.75, -0.5, -0.25, 0, 0.25, 0.5, 0.75, 1]
            },
            bar: {
            gap: 0
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
    function getEmployee(){
        var department = $('#department').val();
        $.ajax({
        type: 'GET',
        url: '{{ url('getEmployee_report_workDefect') }}',
        data: {department:department},
        success: function (data) {
            var employee = '<option value="">เลือกพนักงาน</option>';
            for (let i = 0; i < data.length; i++) {
                employee =  employee  + '<option value="'+data[i].username+'">'+data[i].username+'  '+data[i].Nick_name+' </option>';
            }
            $('#employee').html(employee);
        }
        }); 

       
    }
</script>

{{-- chart --}}
<script src="{{ asset('js/shared/widgets.js') }}"></script>
<script src="{{ asset('js/shared/todo.js') }}"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
@stop

