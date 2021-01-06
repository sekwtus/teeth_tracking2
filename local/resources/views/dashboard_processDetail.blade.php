@extends('layouts.template')

@section('title', 'Dashboard')

@section('stylesheet')

@stop

@section('content')
        <div class="content-wrapper">
          <div class="row">
            @foreach ($data_department as $department)
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">{{ $department->Name }}</p>
                      <div class="fluid-container">
                          <?php $num = 0; ?>
                            @foreach($data_job as $job)
                            @if ($department->ID == $job->job_current_department)
                                <?php $num = $job->count ?>
                            @endif
                            @endforeach
                        <h3 class="font-weight-medium text-right mb-0">{{ $num  }}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-4 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>
                    <a href="{{ url('/product/'.$department->ID) }}">รายละเอียดอื่นๆ</a></p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <!-- content-wrapper ends -->
@stop

@section('scripts')
    <script src="./js/shared/calendar.js"></script>
@stop
