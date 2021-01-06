@extends('layouts.template')

@section('stylesheet')

@stop

@section('content')
<!--enter your code here!!-->
<div class="content-wrapper">
    <div class="row" >
        
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right"></p>
                      <div class="fluid-container">
                      <a  href="{{ url('/product_master1') }}">
                        <h3 class="font-weight-medium text-right mb-0">Product Master</h3>
                      </a>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Product Master
                  </p>
                </div>
              </div>
            </div>
        
        
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right"></p>
                      <div class="fluid-container">
                        <a  href="{{ url('/masterCompany') }}">
                            <h3 class="font-weight-medium text-right mb-0">Company Master</h3>
                        </a>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i>Company Master
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right"></p>
                      <div class="fluid-container">
                        <a  href="#">
                           <h3 class="font-weight-medium text-right mb-0">Employees Master</h3>
                        </a>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Employees Master
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi  mdi-google-maps  icon-lg" style="color:F0E68C"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right"></p>
                      <div class="fluid-container">
                      <a  href="{{ url('/zone_master') }}">
                        <h3 class="font-weight-medium text-right mb-0">Zone Master</h3>
                      </a>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Zone Master
                  </p>
                </div>
              </div>
            </div>
         

    </div>
</div>
@stop

@section('scripts')

@stop
