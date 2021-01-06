@extends('layouts.template')

@section('stylesheet')

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}

    .radio-toolbar {
    margin: 10px;
    }

    .radio-toolbar input[type="radio"] {
        display:none;
    }

    .radio-toolbar label {
             display:inline-block;
             background-color:#ddd;
             width: 20%;
             height: 20%;
             padding: 20px;
             font-size:14px;
             /* border: 2px solid #444; */
             /* border-radius: 4px;     */
         }
    .radio-toolbar label:hover {
        color: #212529;
        background-color: #cddde5;
        border-color: #c4d7e1;
    }

    .radio-toolbar input[type="radio"]:checked + label {
        color: #fff;
        background-color: #19d895;
        border-color: #19d895;
    }
    ::-webkit-datetime-edit-year-field:not([aria-valuenow]),
::-webkit-datetime-edit-month-field:not([aria-valuenow]),
::-webkit-datetime-edit-day-field:not([aria-valuenow]) {
    color: transparent;
}

.clock {

    color: #17D4FE;
    font-size: 60px;
    font-family: Orbitron;
    letter-spacing: 7px;


}
/* flip card */
.flip-card {
  background-color: transparent;
  width: 300px;
  height: 300px;
  perspective: 1000px;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color: #2980b9;
  color: black;
  z-index: 2;
}

.flip-card-back {
  background-color: #2980b9;
  color: white;
  transform: rotateY(180deg);
  z-index: 1;
}
/* end flip card */


</style>
@stop

@section('content')

<div class="content-wrapper">
        <div class="row" id="stepApp">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <div class="row border-bottom">
                  <div class="col-12 p-0 text-left">
                    <h4>สร้างงาน</h4>
                    <div style="text-align:center;margin-top:0px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-3 m-0 step-timeline">
                    <ul class="m-0 step-list">
                      <li class="yellow">ปูน</li>
                      <li class="white">WAX</li>
                      <li class="white">CAD</li>
                      <li class="white">CAM</li>
                      <li class="white">แต่งโลหะ</li>
                      <li class="white">แต่งลง Zirconia</li>
                      <li class="white">แต่งลงเซรามิค</li>
                      <li class="white">โอเปค</li>
                      <li class="white">พอสเลน</li>
                      <li class="white">ขัด</li>
                    </ul>
                  </div>
                  <div class="col-md-9 step-content">

                          {{-- @if($errors->all())
                          <div class="alert alert-danger">
                              {{ $errors->first() }}
                          </div>
                          @endif --}}
                               <!-- Circles which indicates the steps of the form: -->
                               <table  id="example" class="table table-striped table-bordered" width="100%">

                                        <tr style="background-color:#ddd">
                                            <td style="width: 10%;">รหัสสั่งผลิต</td>
                                            <td style="width: 10%;">วันรับงาน</td>
                                            <td style="width: 10%;">เวลา Check-in</td>
                                            <td style="width: 10%;">ผู้ดำเนินงาน</td>
                                            <td style="width: 10%;">QA</td>
                                            <td style="width: 10%;">เวลา Cdeck-out</td>
                                        </tr>
                                    <tbody>
                                        <tr>
                                            <td>A050</td>
                                            <td>22/10/2561</td>
                                            <td>09:45 AM <br> 22/10/2561</td>
                                            <td>นายสมชาย รักดี</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br><br>


                          <div class="col-md-12">
                                <!-- One "tab" for each step in the form: -->
                                <div class="tab">
                                  <div class="form-group row">
                                    <label class="col-form-label col-sm-3" for="pickup"><h3><br>Check-in</h3> </label>
                                       <div class="col-sm-9">
                                            <div class="row">
                                              <div id="MyClockDisplay" class="clock"></div>
                                            </div>
                                            <div class="row">
                                                <div class="input-group">
                                                    <input class="form-control" type="date" name="StartDate" id="StartDate" value="{{date("Y-m-d", strtotime('+7 hours'))}}" onkeypress="return false" readonly>
                                                </div>
                                            </div>
                                       </div>
                                   </div>
                                </div>

                                <div class="tab"><h3 align="center" >เลือกคนทำงาน<br><h3><br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <div class="flip-card">
                                                <div class="flip-card-inner">
                                                  <div class="flip-card-front">
                                                        <h1>John Doe</h1>
                                                    <img src="https://img.icons8.com/android/1600/user.png" alt="Avatar" style="width:300px;height:250px;">
                                                  </div>
                                                  <div class="flip-card-back">
                                                    <h1>John Doe</h1>
                                                    <p>Architect & Engineer</p>
                                                    <p>We love that guy</p>
                                                  </div>
                                                </div>
                                        </div>
                                        </div>


                                        <div class="col-sm-6">
                                        <div class="flip-card">
                                              <div class="flip-card-inner">
                                                <div class="flip-card-front">
                                                      <h1>John Doe</h1>
                                                  <img src="https://img.icons8.com/android/1600/user.png" alt="Avatar" style="width:300px;height:250px;">
                                                </div>
                                                <div class="flip-card-back">
                                                  <h1>John Doe</h1>
                                                  <p>Architect & Engineer</p>
                                                  <p>We love that guy</p>
                                                </div>
                                              </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab"><h3>QA</h3>
                                         <div class="accordion basic-accordion" role="tablist">
                                             <div class="card">
                                                 <div class="card-header" role="tab" id="orderRequestTypeID2">
                                                     <div class="radio-toolbar">
                                                         <div class="row">
                                                             <div class="col-12">
                                                                 <input type="radio" name="chkAcceopt" id="accept" value="accept" >
                                                                 <label align="center" for="accept">ผ่าน</label>
                                                             </div>
                                                             <div class="col-12">
                                                                 <input type="radio" name="chkAcceopt" id="denied" value="denied"  >
                                                                 <label align="center" for="denied">ไม่ผ่าน</label>
                                                             </div>
                                                        </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                </div>



                                <div class="tab">
                                      <div class="form-group row">
                                       <label class="col-form-label col-sm-3" for="pickup"><h3><br>Check-out</h3> </label>
                                          <div class="col-sm-9">
                                               <div class="row">
                                                 <div id="MyClockDisplay2" class="clock"></div>
                                               </div>
                                               <div class="row">
                                                   <div class="input-group">
                                                       <input class="form-control" type="date" name="StartDate" id="StartDate" value="{{date("Y-m-d", strtotime('+7 hours'))}}" onkeypress="return false" readonly>
                                                   </div>
                                               </div>
                                          </div>
                                      </div>
                                </div>
                                <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                                </div>

                          </div>
                  </div>
              </div>

              <div class="row mt-2">
                  <div class="col-sm-12 text-right">
                      <button type="submit" class="btn btn-lg btn-success">
                          ต่อไป
                          <i class="mdi mdi-arrow-right-bold"></i>
                      </button>
                  </div>
              </div>
          </div>
          </div>
          </div>
          </div>

@stop

@section('scripts')

<script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the crurrent tab

        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("tab");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }

        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("tab");
          // Exit the function if any field in the current tab is invalid:
          if (n == 1 && !validateForm()) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }

        function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("tab");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
          }
          return valid; // return the valid status
        }

        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("step");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }
</script>
<script>
    function showTime(){
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if(h == 0){
            h = 12;
        }

        if(h > 12){
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        document.getElementById("MyClockDisplay2").innerText = time;
        document.getElementById("MyClockDisplay2").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
</script>

@stop
