@extends('layouts.template')

@section('stylesheet')
{{-- .triangle {
    width: 100px;
    height: 100px;
    border: 1px solid black; /* ใส่เส้นขอบแบบทึบสีดำขนาด 1px */
} --}}

@stop

@section('content')
<div class="content-wrapper">
  <div class="row" id="stepApp">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-12 p-0 text-left">
              <h4>New Order</h4>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-4 m-0 ">
               <div style="width: 320px; padding: 10px; margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 1. ALLOYS</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 2. IMPLANT STANDARD ABUTMENT </div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 3. CONTOUR AND OCCLUSION DESIGN</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 4. FINAL CERAMIC SHADE</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 5. OCCLUSAL STAINING</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 6. PONTIC DESIGN</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 7. MARGIN AND MENTAL DESIGN</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 8. STUMP สี</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 9. ZIRCONIA</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 10. IMPLANT ZIRCONIA</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color: #3366CC;"  aling="center"> 11. คำสั่งพิเศษ (Special Requirement)</div>
               <br>
               <div style="width: 320px; padding: 10px;  margin: 3; border-radius: 7px; background-color:  #D3D3D3;"  aling="center"> 12. หมายเหตุ</div>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-sm-12 text-right">
                <a href="{{ url('screen10') }}">
                   <button class="btn btn-lg btn-success">
                     Back Step

                   </button>
                </a>
                <a href="{{ url('screen12') }}">
                    <button class="btn btn-lg btn-success">
                        Next Step
                        <i class="mdi mdi-arrow-right-bold"></i>
                    </button>
                </a>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@stop
