<!DOCTYPE html>
<html>
<head>
    <title>Capture webcam image with php and jquery - ItSolutionStuff.com</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style>
</head>
<body>

<div class="container">
    {{-- <h1 class="text-center">Capture webcam image with php and jquery - ItSolutionStuff.com</h1> --}}

    {{ Form::open(['method' => 'post' , 'url' => '/savephoto' , 'files' => true]) }}
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <div class="col-md-6">
                <div id="results"></div>
            </div>
            {{-- {{ Form::file('image') }} --}}
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
        {{ Form::close() }}
</div>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>

</body>
</html>



{{-- @extends('layouts.template')

@section('stylesheet')
        <link rel="stylesheet" href="css/main.css">
@stop
@section('content')

{{ Form::open(['method' => 'post' , 'url' => '/savephoto' , 'files' => true]) }}
<div class="row justify-content-center">
        <div class="col-md-6">
            <video id="video" name="photo1" width="640" height="480" autoplay></video>
        </div>
        <div class="col-md-6">
            <canvas id="canvas" name="photo2" width="640" height="480 "></canvas>
        </div>

        <input type="hidden" name="image" class="image-tag">

        <div class="col-md-2" align="center">
            <button id="snap" name="photo3">Capture</button>
        </div>
</div>


    <button type="submit" class="btn btn-lg btn-success">
        <i class="mdi mdi-content-save"></i>
        บันทึกการแก้ไข
    </button>

{{ Form::close() }}
@stop

@section('scripts')
        <script src="js/photo.js"></script>
@stop --}}





{{-- @extends('layouts.template')

@section('stylesheet')
        <link rel="stylesheet" href="css/main.css">
@stop
@section('content')

<div class="row justify-content-center">
        <div class="col-md-6">
            <video id="video" width="640" height="480" autoplay></video>
        </div>
        <div class="col-md-6">
            <canvas id="canvas" width="640" height="480 "></canvas>
        </div>
</div>
    <div class="col-md-2" align="center">
        <button id="snap">Capture</button>
    </div>
@stop

@section('scripts')
        <script src="js/photo.js"></script>
@stop --}}



