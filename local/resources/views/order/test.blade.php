@extends('layouts.template')

@section('title', 'สร้างงาน')

@section('stylesheet')

 <link rel="stylesheet" href="{{ asset('css/datepicker/bootstrap-datepicker.css') }}">
@stop

@section('content')
<div class="content">

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label class="control-label">Start</label>
            <input class="form-control" type="text" placehoder="Start Date" data-date-format="dd/mm/yyyy" id="startdate"/>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <label class="control-label">End</label>
            <input class="form-control" type="text" placehoder="End Date" data-date-format="dd/mm/yyyy" id="enddate"/>
        </div>
    </div>
</div>
</div>

@stop

@section('scripts')
    <script src="{{ asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
    
        $("#startdate").datepicker({
            todayBtn:  1,
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#enddate').datepicker('setStartDate', minDate);
        });
        
        $("#enddate").datepicker()
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', minDate);
            });

      });
    </script>

@stop
