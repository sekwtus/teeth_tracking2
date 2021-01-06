@extends('layouts.template')
@section('title', 'Report')
@section('stylesheet')>
{{-- <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css') }}"> --}}
@stop

@section('content')
<div class="row">
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
</div>

<div class="row">
    <div class="col-md-1">
    <select class="form-control form-control-sm"  name="monthYears1" id="monthYears1">
        @foreach ($monthYears as $month)
            <option value="{{ $month->monthYears }}">{{ $month->monthYears }}</option>
        @endforeach
    </select></div>

    <div class="col-md-1">
    <select class="form-control form-control-sm"  name="monthYears2" id="monthYears2">
        @foreach ($monthYears as $month)
            <option value="{{ $month->monthYears }}">{{ $month->monthYears }}</option>
        @endforeach
    </select></div>

    <div class="col-md-1">
    <select class="form-control form-control-sm"  name="monthYears3" id="monthYears3">
        @foreach ($monthYears as $month)
            <option value="{{ $month->monthYears }}">{{ $month->monthYears }}</option>
        @endforeach
    </select></div>

    <div class="col-md-3">
    <input class="btn btn-sm btn-success" type="button" id="getMonth" value="Get Chart"/></div>
</div><br>

<table id="table"  class=" table-striped table-bordered display compact nowrap " width="100%">
    <thead>
        <tr>
            <th style="padding: 5px;">เดือน</th>
        @foreach ($index_work_defect as $index)
            <th style="padding: 5px;">{{ $index->detail_type }}</th>
        @endforeach
            <th style="padding: 5px;">รวม</th>
        </tr>
    </thead>
</table>


@stop

@section('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
{{-- <script src="js/shared/google-charts.js"></script> --}}

<script>
        $(function() {
            var count = 1;
              var t = $('#table').DataTable({
              lengthMenu: [[20, 50, 100, -1], [20, 50, 100, "All"]],
              processing: true,
              serverSide: true,
              sortable: true,
              searchable: true,
              ajax: '{{ url('table/report/work_edit/PFM') }}',
              columns: [
                       { data: 'monthYears', name: 'monthYears' },
                       { data: 'id8', name: 'id8' },
                       { data: 'id9', name: 'id9' },
                       { data: 'id10', name: 'id10' },
                       { data: 'id11', name: 'id11' },
                       { data: 'id12', name: 'id12' },
                       { data: 'id13', name: 'id13' },
                       { data: 'id14', name: 'id14' },
                       { data: 'id15', name: 'id15' },
                       { data: 'id16', name: 'id16' },
                       { data: 'id17', name: 'id17' },
                       { data: 'id18', name: 'id18' },
                       { data: 'id19', name: 'id19' },
                       { data: 'id20', name: 'id20' },
                       { data: 'id21', name: 'id21' },
                       { data: 'id22', name: 'id22' },
                       { data: 'id23', name: 'id23' },
                       { data: 'total', name: 'total' },
                    ],
                    columnDefs: [
                    {
                        "targets": 0,
                        "className": "text-center",
                    },
                    {
                        "targets": 1,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                    {
                        "targets": 3,
                        "className": "text-center",
                    },
                    {
                        "targets": 4,
                        "className": "text-center",
                    },
                    {
                        "targets": 5,
                        "className": "text-center",
                    },
                    {
                        "targets": 6,
                        "className": "text-center",
                    },
                    {
                        "targets": 7,
                        "className": "text-center",
                    },
                    {
                        "targets": 8,
                        "className": "text-center",
                    },
                    {
                        "targets": 9,
                        "className": "text-center",
                    },
                    {
                        "targets": 10,
                        "className": "text-center",
                    },
                    {
                        "targets": 11,
                        "className": "text-center",
                    },
                    {
                        "targets": 12,
                        "className": "text-center",
                    },
                    {
                        "targets": 13,
                        "className": "text-center",
                    },
                    {
                        "targets": 14,
                        "className": "text-center",
                    },
                    {
                        "targets": 15,
                        "className": "text-center",
                    },
                    {
                        "targets": 16,
                        "className": "text-center",
                    },
                    {
                        "targets": 17,
                        "className": "text-center",
                    },
                    ],
                    "order": [],
           });

        });

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

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

{{-- <script>
$(document).ready(function(){
    alert('load');
    $.ajex({
         url:'table/report/work_edit/PFM',
         success: function(result){
             $("#id").html(result);
         }
        });
});
</script> --}}

@stop

