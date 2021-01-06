@extends('layouts.template')

@section('title', 'Dashboard')

@section('stylesheet')

@stop

@section('content')
        <div class="content-wrapper">
         
          <div class="row">

            {{-- งานที่ออกวันนี้ --}}
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-3 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-center">
                      <h3 class="mb-0 text-center"><b>งานที่ออกวันนี้ (กล่อง)</b></h3>
                    </div>
                    <br>
                  </div>
                  <div class="overFlow" id="tableWorkToday">
                      
                  </div>

                </div>
              </div>
            </div>

            {{-- งานที่ค้างอยู่ในแผนกเกิน 1 วัน --}}
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-3 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body">
                    <div class="clearfix">
                      <div class="float-center">
                        <h3 class="mb-0 text-center"><b>งานที่ค้างอยู่ในแผนกเกิน 1 วัน (กล่อง)</b></h3>
                      </div>
                      <br>
                    </div>

                    <div class="overFlow" id="tableWorkYesterday">
                      
                    </div>

                  </div>
                </div>
              </div>
          </div>

          <div class="row">
            
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-3 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                        {{-- key-in --}}
                          <h3 class="mb-0 text-center"><b>งานเซลรับเข้าแยกตามสาขา (กล่อง)</b></h3>  
                          <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                          <div id="Bar-chart" class="google-charts"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <br>

              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-3 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h3 class="mb-0 text-center"><b>งาน screen รับเข้าแยกตามแลปผลิต (กล่อง)</b></h3>
                          <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                            <div id="Bar-chart5" class="google-charts"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <br>

              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-3 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h3 class="mb-0 text-center"><b>งานในระบบ(กทม.) (ซี่)</b></h3>
                          <div class="row">
                                  <div class="col-10 "> </div>
                              <div class="col-2" id="selectedMount">
                              </div>
                          </div>
          
                          <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                          <div id="Bar-chart2" class="google-charts"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-3 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h3 class="mb-0 text-center"><b>งานในระบบ(พัทยา) (ซี่)</b></h3>
                          <div class="row">
                                  <div class="col-10 "> </div>
                              <div class="col-2" id="selectedMount">
                              </div>
                          </div>
          
                          <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                          <div id="Bar-chart3" class="google-charts"></div>
                          </div>
                      </div>
                  </div>
              </div>
              <br>
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-3 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h3 class="mb-0 text-center"><b>งานในระบบ(หาดใหญ่) (ซี่)</b></h3>
                          <div class="row">
                                  <div class="col-10 "> </div>
                              <div class="col-2" id="selectedMount">
                              </div>
                          </div>
          
                          <div class="google-chart-container d-flex align-items-center justify-content-center h-100">
                          <div id="Bar-chart4" class="google-charts" style="width: 90%; height: 20%;"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <br>
          <div class="row">
              <div class="col-12">
                <div class="card" >
                  <div class="card-body">
                      <h3 class="text-center"><b>กทม. (กล่อง)</b></h3>
                      <div class="row">

                      <div class="col-4">
                          <h4 class=" text-center"><b>งานเลื่อนระหว่างผลิต</b></h4>
                          <canvas id="pieChart2"></canvas>
                      </div>

                      <div class="col-4">
                          <h4 class=" text-center"><b>งานรอติดต่อหมอ</b></h4>
                          <canvas id="pieChart3"></canvas>
                      </div>

                      <div class="col-4">
                          <h4 class=" text-center"><b>ประเภทงาน</b></h4>
                          <canvas id="pieChart4"></canvas>
                      </div>

                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 col-lg-12 grid-margin stretch-card top-selling-card">
                  <div class="card">
                    <div class="card-body">
                      <h3 class="text-center" ><b>งานแก้ตามประเภทสินค้า กทม. (30วันย้อนหลัง)(ซี่)</b></h3>
                        <div id="curve_chart1" style="width: 100%; height: 500px"></div>
                    </div>
                  </div>
                </div>
                
            </div>
            <br>

            <div class="row">
              <div class="col-12">
                <div class="card" >
                  <div class="card-body">
                      <h3 class="text-center"><b>พัทยา (กล่อง)</b></h3>
                      <div class="row">
                 

                      <div class="col-4">
                          <h4 class=" text-center"><b>งานเลื่อนระหว่างผลิต</b></h4>
                          <canvas id="pieChart32"></canvas>
                      </div>

                      <div class="col-4">
                          <h4 class=" text-center"><b>งานรอติดต่อหมอ</b></h4>
                          <canvas id="pieChart33"></canvas>
                      </div>

                      <div class="col-4">
                          <h4 class=" text-center"><b>ประเภทงาน</b></h4>
                          <canvas id="pieChart34"></canvas>
                      </div>

                      </div>
                    </div>
                  </div>
              </div>

              <div class="col-md-12 col-lg-12 grid-margin stretch-card top-selling-card">
                <div class="card">
                  <div class="card-body">
                    <h3 class="text-center" ><b>งานแก้ตามประเภทสินค้า พัทยา (30วันย้อนหลัง)(ซี่)</b></h3>
                      <div id="curve_chart2" style="width: 100%; height: 500px"></div>                   
                  </div>
                </div>
              </div>

            </div>
            <br>

            <div class="row">
              <div class="col-12">
                <div class="card" >
                  <div class="card-body">
                      <h3 class="text-center"><b>หาดใหญ่ (กล่อง)</b></h3>
                      <div class="row">
                        
                      <div class="col-4">
                          <h4 class=" text-center"><b>งานเลื่อนระหว่างผลิต</b></h4>
                          <canvas id="pieChart22"></canvas>
                      </div>

                      <div class="col-4">
                          <h4 class=" text-center"><b>งานรอติดต่อหมอ</b></h4>
                          <canvas id="pieChart23"></canvas>
                      </div>

                      <div class="col-4">
                          <h4 class=" text-center"><b>ประเภทงาน</b></h4>
                          <canvas id="pieChart24"></canvas>
                      </div>

                      </div>
                    </div>
                  </div>
              </div>
              
              <div class="col-md-12 col-lg-12 grid-margin stretch-card top-selling-card">
                <div class="card">
                  <div class="card-body">
                    <h3 class="text-center" ><b>งานแก้ตามประเภทสินค้า หาดใหญ่ (30วันย้อนหลัง)(ซี่)</b></h3>
                      <div id="curve_chart3" style="width: 100%; height: 500px"></div>                    
                  </div>
                </div>
              </div>

            </div>
            <br>

            

            <div class="row">
              

                <div class="col-md-6 col-lg-6 grid-margin stretch-card top-selling-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 ><b>รายงานจำนวน KEY-IN ของแลปที่ผลิตแยกตามสาขา (วันนี้) (กล่อง)</b></h4>
                      <div class="table-responsive item-wrapper">
                        <table class="table table-striped">
                          <thead>
                            <tr id="data_branch">
                            </tr>
                          </thead>
                          <tbody id="data_lab">
                        
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                  <div class="col-sm-6 col-md-6 col-lg-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <h4 ><b>งานระหว่างผลิต (ซี่)</b></h4>
                              <table class="table table-striped table-responsive">
                                <thead>
                                  <tr>
                                    <th style="padding: 5px;">แลป/งาน</th>
                                    <th style="padding: 5px;">PFM</th>
                                    <th style="padding: 5px;">FMC</th>
                                    <th style="padding: 5px;">PINTOOTH</th>
                                    <th style="padding: 5px;">ZIRCONIA</th>
                                    <th style="padding: 5px;">E.MAX</th>
                                    <th style="padding: 5px;">CERAMAGE</th>
                                    <th style="padding: 5px;">TEMP</th>
                                    <th style="padding: 5px;">IMP</th>
                                    <th style="padding: 5px;">Other</th>
                                  </tr>
                                </thead>
                                <tbody >
                                  <tr id="in_processing1"></tr>
                                  <tr id="in_processing2"></tr>
                                  <tr id="in_processing3"></tr>
                                </tbody>
                              </table>
                          </div>
                          {{-- <div class="col-md-5 d-flex align-items-end mt-4 mt-md-0">
                            <canvas id="conversionBarChart" height="150"></canvas>
                          </div> --}}
                        </div>
                      </div>
                    </div>
                  </div>

            </div>
      

        </div>
        <!-- content-wrapper ends -->
@stop

@section('scripts')
<script src="{{ asset('js/shared/widgets.js') }}"></script>
<script src="{{ asset('js/shared/todo.js') }}"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="./js/shared/calendar.js"></script>


{{-- pie --}}
<script>
  ////chart circle 

  // pie งานเลื่อน กทม.  2
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/pie_work_late') }}',
    data: {lab:'กทม.'},
    success: function (dataAjex) {
        var ctxP = document.getElementById("pieChart2").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataAjex[0],
              datasets: [{
                data: dataAjex[1],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  }); 

  // pie งานเลื่อน พัทยา  32
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/pie_work_late') }}',
    data: {lab:'พัทยา'},
    success: function (dataAjex) {
        var ctxP = document.getElementById("pieChart32").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataAjex[0],
              datasets: [{
                data: dataAjex[1],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  });

  // pie งานเลื่อน หาดใหญ่  22
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/pie_work_late') }}',
    data: {lab:'หาดใหญ่'},
    success: function (dataAjex) {
      // console.log(dataAjex);
        var ctxP = document.getElementById("pieChart22").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataAjex[0],
              datasets: [{
                data: dataAjex[1],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  });

  //บริการ กทม.  3
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/pie_call_doctor') }}',
    data: {lab:'กทม.'},
    success: function (dataDoctor) {
        var ctxP = document.getElementById("pieChart3").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataDoctor[0],
              datasets: [{
                data: dataDoctor[1],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  });

  //บริการ พัทยา 33
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/pie_call_doctor') }}',
    data: {lab:'พัทยา'},
    success: function (dataDoctor) {
        var ctxP = document.getElementById("pieChart33").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataDoctor[0],
              datasets: [{
                data: dataDoctor[1],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  });

  //บริการ หาดใหญ่  23
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/pie_call_doctor') }}',
    data: {lab:'หาดใหญ่'},
    success: function (dataDoctor) {
        var ctxP = document.getElementById("pieChart23").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataDoctor[0],
              datasets: [{
                data: dataDoctor[1],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  });

  //ประเภทงาน(ปกติ ด่วน) กทม. 4
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/type_of_work') }}',
    data: {lab:'กทม.'},
    success: function (dataDoctor) {
        var ctxP = document.getElementById("pieChart4").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataDoctor[0],
              datasets: [{
                data: dataDoctor[1],
                backgroundColor: ["#73b579", "#F7464A", "#FDB45C"],
                hoverBackgroundColor: ["#3bd949", "#FF5A5E", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  });

  //ประเภทงาน(ปกติ ด่วน) พัทยา 34
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/type_of_work') }}',
    data: {lab:'พัทยา'},
    success: function (dataDoctor) {
        var ctxP = document.getElementById("pieChart34").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataDoctor[0],
              datasets: [{
                data: dataDoctor[1],
                backgroundColor: ["#73b579", "#F7464A", "#FDB45C"],
                hoverBackgroundColor: ["#3bd949", "#FF5A5E", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  }); 

  //ประเภทงาน(ปกติ ด่วน) หาดใหญ่ 24
  $.ajax({
    type: 'GET',
    url: '{{ url('dashboard/type_of_work') }}',
    data: {lab:'หาดใหญ่'},
    success: function (dataDoctor) {
        var ctxP = document.getElementById("pieChart24").getContext('2d');
          var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
              labels: dataDoctor[0],
              datasets: [{
                data: dataDoctor[1],
                backgroundColor: ["#73b579", "#F7464A", "#FDB45C"],
                hoverBackgroundColor: ["#3bd949", "#FF5A5E", "#FFC870"]
              }]
            },
            options: {
              responsive: true
            }
        });

    },
  }); 
</script>
  
{{-- งานที่ออกวันนี้ --}}
<script>
    $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ url('/dashboard/work_transportDay_today') }}',
                success: function (data) {

                  var th_row = '';
                  jQuery.each(data.department, function(key, obj) {
                    th_row = th_row +  '<th style="padding: 5px;">'+obj+'</th>';
                  });
                  console.log(th_row);

                  <th class="text-center">จำนวนทั้งหมด</th>\
                            <th class="text-center">screen</th>\
                            <th class="text-center">ปูน</th>\
                            <th class="text-center">DESIGN</th>\
                            <th class="text-center">แต่งลง</th>\
                            <th class="text-center">CAM</th>\
                            <th class="text-center">โอเปค</th>\
                            <th class="text-center">พอสเลน</th>\
                            <th class="text-center">ขัด</th>\
                            <th class="text-center">TEMP</th>\
                            <th class="text-center">FQC</th>\
                            <th class="text-center">พิมพ์บิล/แพ๊ค</th>\
                            <th class="text-center">บริการ</th>\
                            <th class="text-center">ผลิตพัทยา</th>\
                            <th class="text-center">ผลิตหาดใหญ่</th>\

                  var record = {};
                  var branch = {};
                  
                  $.each(data.type_Branch, function (indexInArray, value) { 
                    record['record' + indexInArray] = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                    branch[value.lab] = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                  });

                  $(data.count_job).each(function (index, value_job) {
                    // element == this
                    $(data.type_Branch).each(function (index, value_branch) {
                      if (value_job.lab == value_branch.lab) {
                        // branch[value_job.lab]
                      }
                    });
                  });


                  console.log(record,branch); 

                  var record1 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                  var record2 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                  var record3 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                  
                    for (let index = 0; index < data.length; index++) {
                      if (data[index].lab == 'กทม.') {

                          if (data[index].job_current_department == 0) {
                              record1[1] = record1[1] + data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 13) {
                              record1[2] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 7) {
                              record1[3] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 10) {
                              record1[4] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 6) {
                              record1[5] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 11) {
                              record1[6] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 14) {
                              record1[7] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 12) {
                              record1[8] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 9) {
                              record1[9] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 8) {
                              record1[10] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 3) {
                              record1[11] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 4) {
                              record1[12] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 15) {
                              record1[13] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 16) {
                              record1[14] = data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                          else {
                              record1[1] = record1[1] + data[index].count_order;
                              record1[0] = record1[0] + data[index].count_order;
                          }
                      }

                      if (data[index].lab == 'พัทยา') {

                        if (data[index].job_current_department == 0) {
                              record2[1] = record2[1] + data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 13) {
                              record2[2] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 7) {
                              record2[3] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 10) {
                              record2[4] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 6) {
                              record2[5] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 11) {
                              record2[6] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 14) {
                              record2[7] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 12) {
                              record2[8] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 9) {
                              record2[9] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 8) {
                              record2[10] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 3) {
                              record2[11] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 4) {
                              record2[12] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 15) {
                              record2[13] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 16) {
                              record2[14] = data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                          else {
                              record2[1] = record2[1] + data[index].count_order;
                              record2[0] = record2[0] + data[index].count_order;
                          }
                      }

                      if (data[index].lab == 'หาดใหญ่') {

                          if (data[index].job_current_department == 0) {
                              record3[1] = record3[1] + data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 13) {
                              record3[2] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 7) {
                              record3[3] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 10) {
                              record3[4] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 6) {
                              record3[5] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 11) {
                              record3[6] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 14) {
                              record3[7] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 12) {
                              record3[8] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 9) {
                              record3[9] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 8) {
                              record3[10] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 3) {
                              record3[11] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 4) {
                              record3[12] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 15) {
                              record3[13] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else if (data[index].job_current_department == 16) {
                              record3[14] = data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                          else {
                              record3[1] = record3[1] + data[index].count_order;
                              record3[0] = record3[0] + data[index].count_order;
                          }
                      }
                    }
                    var row1 ="";
                    var row2 ="";
                    var row3 ="";

                    record1.forEach(element => {
                        row1 = row1 + '<td class="text-center">'+element+'</td>';
                    });
                    record2.forEach(element => {
                        row2 = row2 + '<td class="text-center">'+element+'</td>';
                    });
                    record3.forEach(element => {
                        row3 = row3 + '<td class="text-center">'+element+'</td>';
                    });
               
                      $('#tableWorkToday').html('\
                      <table class="table table-striped table-hover table-bordered" style="width: 100%;">\
                        <thead>\
                          <tr class="bg-light rounded">\
                            <th >แลป</th>\
                            
                          </tr>\
                        </thead>\
                        <tbody>\
                          <tr>\
                            <th>กทม.</th>'+row1+'\
                          </tr>\
                          <tr>\
                            <th>พัทยา</th>'+row2+'\
                          </tr>\
                          <tr>\
                            <th>หาดใหญ่</th>'+row3+'\
                          </tr>\
                        </tbody>\
                      </table>');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            });
    });
</script>

{{-- งานที่ค้างอยู่ในแผนกเกิน 1 วัน --}}
<script>
    $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: '{{ url('/dashboard/work_transportDay_yesterday') }}',
                success: function (data) {
                  var record1 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                  var record2 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
                  var record3 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

                  for (let index = 0; index < data[1].length; index++) {
                      if (data[1][index].lab == 'กทม.') {
                        if (data[1][index].job_current_department == null){
                              record1[1] = data[1][index].count_order;
                              record1[0] = record1[0] + data[1][index].count_order;
                          }
                      }
                      if (data[1][index].lab == 'พัทยา') {
                        if (data[1][index].job_current_department == null){
                              record2[1] = data[1][index].count_order;
                              record2[0] = record2[0] + data[1][index].count_order;
                          }
                      }
                      if (data[1][index].lab == 'หาดใหญ่') {
                        if (data[1][index].job_current_department == null){
                              record3[1] = data[1][index].count_order;
                              record3[0] = record3[0] + data[1][index].count_order;
                          }
                      }
                  }
                  
                  
                    for (let index = 0; index < data[0].length; index++) {
                      if (data[0][index].lab == 'กทม.') {

                          if (data[0][index].job_current_department == 0) {
                              record1[1] = record1[1] + data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 13) {
                              record1[2] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 7) {
                              record1[3] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 10) {
                              record1[4] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 6) {
                              record1[5] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 11) {
                              record1[6] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 14) {
                              record1[7] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 12) {
                              record1[8] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 9) {
                              record1[9] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 8) {
                              record1[10] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 3) {
                              record1[11] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 4){
                              record1[12] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 15) {
                              record1[13] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 16) {
                              record1[14] = data[0][index].count_order;
                              record1[0] = record1[0] + data[0][index].count_order;
                          }
                          else {
                              // record1[1] = data[0][index].count_order;
                              // record1[0] = record1[0] + data[0][index].count_order;
                          }
                      }

                      if (data[0][index].lab == 'พัทยา') {
                          if (data[0][index].job_current_department == 0) {
                              record2[1] = record2[1] + data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 13) {
                              record2[2] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 7) {
                              record2[3] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 10) {
                              record2[4] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 6) {
                              record2[5] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 11) {
                              record2[6] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 14) {
                              record2[7] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 12) {
                              record2[8] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 9) {
                              record2[9] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 8) {
                              record2[10] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 3) {
                              record2[11] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 4){
                              record2[12] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 15) {
                              record2[13] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 16) {
                              record2[14] = data[0][index].count_order;
                              record2[0] = record2[0] + data[0][index].count_order;
                          }
                          else {
                              // record2[1] = data[0][index].count_order;
                              // record2[0] = record2[0] + data[0][index].count_order;
                          }
                      }

                      if (data[0][index].lab == 'หาดใหญ่') {
                        if (data[0][index].job_current_department == 0) {
                              record3[1] = record3[1] + data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 13) {
                              record3[2] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 7) {
                              record3[3] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 10) {
                              record3[4] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 6) {
                              record3[5] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 11) {
                              record3[6] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 14) {
                              record3[7] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 12) {
                              record3[8] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 9) {
                              record3[9] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 8) {
                              record3[10] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 3) {
                              record3[11] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 4){
                              record3[12] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 15) {
                              record3[13] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else if (data[0][index].job_current_department == 16) {
                              record3[14] = data[0][index].count_order;
                              record3[0] = record3[0] + data[0][index].count_order;
                          }
                          else {
                              // record3[1] = data[0][index].count_order;
                              // record3[0] = record3[0] + data[0][index].count_order;
                          }
                      }
                    }
                    var row1 ="";
                    var row2 ="";
                    var row3 ="";

                    record1.forEach(element => {
                        row1 = row1 + '<td class="text-center">'+element+'</td>';
                    });
                    record2.forEach(element => {
                        row2 = row2 + '<td class="text-center">'+element+'</td>';
                    });
                    record3.forEach(element => {
                        row3 = row3 + '<td class="text-center">'+element+'</td>';
                    });
                    
                      $('#tableWorkYesterday').html('\
                      <table class="table table-striped table-hover table-bordered" style="width: 100%;">\
                        <thead>\
                          <tr class="bg-light rounded">\
                            <th>แลป</th>\
                            <th class="text-center">จำนวนทั้งหมด</th>\
                            <th class="text-center">screen</th>\
                            <th class="text-center">ปูน</th>\
                            <th class="text-center">DESIGN</th>\
                            <th class="text-center">แต่งลง</th>\
                            <th class="text-center">CAM</th>\
                            <th class="text-center">โอเปค</th>\
                            <th class="text-center">พอสเลน</th>\
                            <th class="text-center">ขัด</th>\
                            <th class="text-center">TEMP</th>\
                            <th class="text-center">FQC</th>\
                            <th class="text-center">พิมพ์บิล/แพ๊ค</th>\
                            <th class="text-center">บริการ</th>\
                            <th class="text-center">ผลิตพัทยา</th>\
                            <th class="text-center">ผลิตหาดใหญ่</th>\
                          </tr>\
                        </thead>\
                        <tbody>\
                          <tr>\
                            <th>กทม.</th>'+row1+'\
                          </tr>\
                          <tr>\
                            <th>พัทยา</th>'+row2+'\
                          </tr>\
                          <tr>\
                            <th>หาดใหญ่</th>'+row3+'\
                          </tr>\
                        </tbody>\
                      </table>');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
                }
            });
    });
</script>

{{-- งานรับเข้า KEY-IN (เช้า-บ่าย) สาขา --}}
<script>

  function drawStuff1(){
    $.ajax({
      type: 'GET',
      url: '{{ url('dashboard/keyin_branch') }}',
      data: {},
      success: function (dataAjex) {

      var data = google.visualization.arrayToDataTable(dataAjex);
      var view = new google.visualization.DataView(data);
      view.setColumns([
        0,
        1,{ 
          calc: "stringify",
          sourceColumn: 1,
          type: "string",
          role: "annotation" 
        },
        2,{ 
          calc: "stringify",
          sourceColumn: 2,
          type: "string",
          role: "annotation" 
        },
        3,{ 
          calc: "stringify",
          sourceColumn: 3,
          type: "string",
          role: "annotation" 
        },
        4,{ 
          calc: "stringify",
          sourceColumn: 4,
          type: "string",
          role: "annotation" 
        }
      ]);
      var options = {
        // title: 'Approximating Normal Distribution',
        width: "80%",
        colors: ['#96a4ff','#ff9696','#0022ff','#ff0000'],

        chartArea: {
          width: "80%",
          height: "80%",
        },
        hAxis: {
          ticks: [-1, -0.75, -0.5, -0.25, 0, 0.25, 0.5, 0.75, 1],
          // textPosition: 'none',
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

      var chart = new google.visualization.ColumnChart(document.getElementById('Bar-chart'));
      chart.draw(view, options);
      }

    }); 
  
  };

    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff1);


</script>

{{-- งานรับเข้า screenแล้ว (เช้า-บ่าย) แลป --}}
<script>
  // Bar Charts Starts
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawStuff2);

 
    function drawStuff2() {
      $.ajax({
        type: 'GET',
        url: '{{ url('dashboard/screen_lab') }}',
        data: {},
        success: function (response) {
          // console.log();
          var data = google.visualization.arrayToDataTable(response.arr_data);

          var view = new google.visualization.DataView(data);
          view.setColumns([
            0,
            1,{ 
              calc: "stringify",
              sourceColumn: 1,
              type: "string",
              role: "annotation" }, 
            2,{ 
              calc: "stringify",
              sourceColumn: 2,
              type: "string",
              role: "annotation" }, 
            3,{ 
              calc: "stringify",
              sourceColumn: 3,
              type: "string",
              role: "annotation" }, 
            4,{ 
              calc: "stringify",
              sourceColumn: 4,
              type: "string",
              role: "annotation" }]);

          var options = {
            // title: 'Approximating Normal Distribution',
            width: "100%",
            colors: ['#94ff9b','#ff9eff','#009c0a','#b500b5'],

            chartArea: {
              width: "80%",
              height: "80%"
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

          var chart = new google.visualization.ColumnChart(document.getElementById('Bar-chart5'));
          chart.draw(view, options);
        }
      }); 
    };
    // test งาน screen รับเข้าแยกตามแลปผลิต (กล่อง) ช้อย
    
  // Bar Charts Ends
</script>

{{-- งานในระบบ(กทม.) --}}
<script>
  // Bar Charts Starts


    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawStuff3);

 
    function drawStuff3() {

      $.ajax({
        type: 'GET',
        url: '{{ url('dashboard/order_processing') }}',
        data: {lab:'กทม.'},
        success: function (dataAjex) {

          var data = google.visualization.arrayToDataTable(dataAjex);
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
            { calc: "stringify",
              sourceColumn: 1,
              type: "string",
              role: "annotation" }]);
          var options = {
            // title: 'Approximating Normal Distribution',
            width: "100%",
            colors: ['#ffd500'],

            chartArea: {
              width: "85%",
              height: "80%"
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

          var chart = new google.visualization.ColumnChart(document.getElementById('Bar-chart2'));
          chart.draw(view, options);
        }
      });
    };


  // Bar Charts Ends
</script>

{{-- งานในระบบ(พัทยา) --}}
<script>
  // Bar Charts Starts

    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawStuff4);

 
  function drawStuff4() {

    $.ajax({
      type: 'GET',
      url: '{{ url('dashboard/order_processing') }}',
      data: {lab:'พัทยา'},
      success: function (dataAjex) {
      var data = google.visualization.arrayToDataTable(dataAjex);
      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
        { calc: "stringify",
          sourceColumn: 1,
          type: "string",
          role: "annotation" }]);
      var options = {
        // title: 'Approximating Normal Distribution',
        width: "100%",
        colors: ['#57c7d4'],

        chartArea: {
          width: "85%",  
          height: "80%"
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

      var chart = new google.visualization.ColumnChart(document.getElementById('Bar-chart3'));
      chart.draw(view, options);
    }
    }); 
  };


  // Bar Charts Ends
</script>

{{-- งานในระบบ(หาดใหญ่) --}}
<script>
  // Bar Charts Starts

    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawStuff5);

    function drawStuff5(dataAjex) {
      
        $.ajax({
          type: 'GET',
          url: '{{ url('dashboard/order_processing') }}',
          data: {lab:'หาดใหญ่'},
          success: function (dataAjex) {
            var data = new google.visualization.arrayToDataTable(dataAjex);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
            { calc: "stringify",
              sourceColumn: 1,
              type: "string",
              role: "annotation" }]);
            var options = {
              
              // title: 'Approximating Normal Distribution',
              width: "100%",
              colors: ['#FB9677'],

              chartArea: {
                width: "85%",
                height: "80%"
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

            var chart = new google.visualization.ColumnChart(document.getElementById('Bar-chart4'));
            chart.draw(view, options);
          }
        }); 
    };


  // Bar Charts Ends
</script>

{{-- bkk30days --}}
<script type="text/javascript">
  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart1);

  function drawChart1() {


    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Day');
    data.addColumn('number', 'PFM');
    data.addColumn('number', 'FMC');
    data.addColumn('number', 'PINTOOTH');
    data.addColumn('number', 'ZIRCONIA');
    data.addColumn('number', 'E.MAX');
    data.addColumn('number', 'CERAMAGE');
    data.addColumn('number', 'TEMP');
    data.addColumn('number', 'IMP');
    data.addColumn('number', 'Other');
    
    var bkk = '{{ $bkk30days }}';
    var bkkjson = JSON.parse(bkk.replace(/&quot;/g,'"'));

    data.addRows(bkkjson);
    var options = {
          legend: 'none',
          lineWidth:50,
        };

    var chart = new google.charts.Line(document.getElementById('curve_chart1'));

    chart.draw(data, google.charts.Line.convertOptions(options));
  }
</script>

{{-- pattaya30days --}}
<script type="text/javascript">
  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart1);

  function drawChart1() {


    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Day');
    data.addColumn('number', 'PFM');
    data.addColumn('number', 'FMC');
    data.addColumn('number', 'PINTOOTH');
    data.addColumn('number', 'ZIRCONIA');
    data.addColumn('number', 'E.MAX');
    data.addColumn('number', 'CERAMAGE');
    data.addColumn('number', 'TEMP');
    data.addColumn('number', 'IMP');
    data.addColumn('number', 'Other');
    
    var bkk = '{{ $pattaya30days }}';
    var bkkjson = JSON.parse(bkk.replace(/&quot;/g,'"'));

    data.addRows(bkkjson);
    var options = {
          legend: 'none',
          lineWidth:50,
        };

    var chart = new google.charts.Line(document.getElementById('curve_chart2'));

    chart.draw(data, google.charts.Line.convertOptions(options));
  }
</script>

{{-- hatyai30days --}}
<script type="text/javascript">
  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart1);

  function drawChart1() {


    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Day');
    data.addColumn('number', 'PFM');
    data.addColumn('number', 'FMC');
    data.addColumn('number', 'PINTOOTH');
    data.addColumn('number', 'ZIRCONIA');
    data.addColumn('number', 'E.MAX');
    data.addColumn('number', 'CERAMAGE');
    data.addColumn('number', 'TEMP');
    data.addColumn('number', 'IMP');
    data.addColumn('number', 'Other');
    
    var bkk = '{{ $hatyai30days }}';
    var bkkjson = JSON.parse(bkk.replace(/&quot;/g,'"'));

    data.addRows(bkkjson);
    var options = {
          legend: 'none',
          lineWidth:50,
        };

    var chart = new google.charts.Line(document.getElementById('curve_chart3'));

    chart.draw(data, google.charts.Line.convertOptions(options));
  }
</script>

{{-- งานระหว่างผลิต --}}
<script>
  
    $.ajax({
      type: 'GET',
      url: '{{ url('dashboard/order_processing') }}',
      data: {lab:'กทม.'},
      success: function (obj1) {
      // var obj1 = JSON.parse(data);
      
    // console.log(obj1);
          $('#in_processing1').html('<td style="padding: 5px;">กทม.</td>\
          <td style="padding: 5px;">'+obj1[1][1]+'</td>\
          <td style="padding: 5px;">'+obj1[2][1]+'</td>\
          <td style="padding: 5px;">'+obj1[3][1]+'</td>\
          <td style="padding: 5px;">'+obj1[4][1]+'</td>\
          <td style="padding: 5px;">'+obj1[5][1]+'</td>\
          <td style="padding: 5px;">'+obj1[6][1]+'</td>\
          <td style="padding: 5px;">'+obj1[7][1]+'</td>\
          <td style="padding: 5px;">'+obj1[8][1]+'</td>\
          <td style="padding: 5px;">'+obj1[9][1]+'</td>');
      }
    });

    $.ajax({
      type: 'GET',
      url: '{{ url('dashboard/order_processing') }}',
      data: {lab:'พัทยา'},
      success: function (obj1) {
      // var obj1 = JSON.parse(data);
      
    // console.log(obj1);
          $('#in_processing2').html('<td style="padding: 5px;">พัทยา</td>\
          <td style="padding: 5px;">'+obj1[1][1]+'</td>\
          <td style="padding: 5px;">'+obj1[2][1]+'</td>\
          <td style="padding: 5px;">'+obj1[3][1]+'</td>\
          <td style="padding: 5px;">'+obj1[4][1]+'</td>\
          <td style="padding: 5px;">'+obj1[5][1]+'</td>\
          <td style="padding: 5px;">'+obj1[6][1]+'</td>\
          <td style="padding: 5px;">'+obj1[7][1]+'</td>\
          <td style="padding: 5px;">'+obj1[8][1]+'</td>\
          <td style="padding: 5px;">'+obj1[9][1]+'</td>');
      }
    });


    $.ajax({
      type: 'GET',
      url: '{{ url('dashboard/order_processing') }}',
      data: {lab:'หาดใหญ่'},
      success: function (obj1) {
      // var obj1 = JSON.parse(data);
      
    // console.log(obj1);
          $('#in_processing3').html('<td style="padding: 5px;">หาดใหญ่</td>\
          <td style="padding: 5px;">'+obj1[1][1]+'</td>\
          <td style="padding: 5px;">'+obj1[2][1]+'</td>\
          <td style="padding: 5px;">'+obj1[3][1]+'</td>\
          <td style="padding: 5px;">'+obj1[4][1]+'</td>\
          <td style="padding: 5px;">'+obj1[5][1]+'</td>\
          <td style="padding: 5px;">'+obj1[6][1]+'</td>\
          <td style="padding: 5px;">'+obj1[7][1]+'</td>\
          <td style="padding: 5px;">'+obj1[8][1]+'</td>\
          <td style="padding: 5px;">'+obj1[9][1]+'</td>');
      }
    });


</script>

{{-- รายงานจำนวน KEY-IN ของแลปที่ผลิตแยกตามสาขา (วันนี้) (กล่อง) --}}
<script>
  
    $.ajax({
      type: 'GET',
      url: '{{ url('dashboard/order_refbarcode') }}',
      data: {},
      success: function (data) {

        var th_row = '<th style="padding: 5px;">แลป/KEY-IN</th>';
        jQuery.each(data['กทม.'], function(key, obj) {
          th_row = th_row +  '<th style="padding: 5px;">'+key+'</th>';
        });
        $('#data_branch').html(th_row);

        var td_row = '';
        jQuery.each(data, function(key, obj) {
          td_row = td_row + '<tr><td style="padding: 5px;">'+key+'</td>';

            jQuery.each(data[key], function(index2, obj) {
                td_row = td_row +  '<td style="padding: 5px;">'+obj+'</td>';
            });

          td_row = td_row + '</tr>';
        });

        $('#data_lab').html(td_row);

      }
    });

</script>


@stop


