<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- <title>Star Admin Free Bootstrap Admin Dashboard Template</title> --}}
  <title>@yield('title') - {{ Config::get('app.name') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendor/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/icheck/skins/all.css') }}">
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  {{-- <link rel="icon" href="https://pcdental.s3.amazonaws.com/static/images/favicons/favicon.ico"> --}}
      <!-- plugins:css -->
      <link rel="stylesheet" href="{{ asset('vendor/iconfonts/puse-icons-feather/feather.css') }}">
      <!-- endinject -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{ asset('css/shared/style.css') }}">
      <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{ asset('css/project.css') }}">
        <!-- End Layout styles -->
      <!-- plugin css for this page -->
      <!-- End plugin css for this page -->

      {{-- icon font awesome --}}
        <!-- plugin css for this page -->

    <link rel="stylesheet" href="{{ asset('vendor/iconfonts/font-awesome/css/font-awesome.min.css') }}">
    {{-- Hamberger --}}
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" /> </head>
    <link rel="stylesheet" href="{{ asset('css/demo_1/style.css') }}">


  <style>
    .form-control{
      border-color: #ddd;
    }
    .loader {
    position: fixed;
    z-index: 9;
    top: 0;
    left: 10%;
    width: 100%;
    height: 100%;
    background: #FFF;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .loader.hidden {
        animation: fadeOut 1s;
        animation-fill-mode: forwards;
    }
    @keyframes fadeOut {
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }

    .overFlow {
      overflow: auto;
    }
    </style>

<style>
    ul, #myUL {
      list-style-type: none;
    }
    
    #myUL {
      margin: 0;
      padding: 0;
    }
    
    .caret {
      cursor: pointer;
      -webkit-user-select: none; /* Safari 3.1+ */
      -moz-user-select: none; /* Firefox 2+ */
      -ms-user-select: none; /* IE 10+ */
      user-select: none;
    }
    
    .caret::before {
      content: "\25B6";
      color: black;
      display: inline-block;
      margin-right: 6px;
    }
    
    .caret-down::before {
      -ms-transform: rotate(90deg); /* IE 9 */
      -webkit-transform: rotate(90deg); /* Safari */'
      transform: rotate(90deg);  
    }
    
    .nested {
      display: none;
    }
    
    .active {
      display: block;
    }
    </style>
    


  @yield('stylesheet')
</head>

<body>

 {{-- <div class="loader-demo-box loader">
   <div class="circle-loader"></div>
 </div> --}}

{{-- <div id="load_screen" class="load_screen"><div id="loading" class="loading"> load doc </div></div> --}}

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('layouts.sidebar')
      <!-- partial -->
      <div class="main-panel">

        @yield('content')

        <!-- partial:partials/_footer.html -->
        @include('layouts.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->

  <script src="{{ asset('vendor/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendor/js/vendor.bundle.addons.js') }}"></script>

  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/misc.js') }}"></script>

  <script src="{{ asset('js/dashboard.js') }}"></script>


  <script src="{{ asset('js/shared/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/shared/settings.js') }}"></script>
  <script src="{{ asset('js/shared/todolist.js') }}"></script>
  <script src="{{ asset('js/project.js') }}"></script>


  <script src="{{ asset('js/shared/data-table.js') }}"></script>
  <script src="{{ asset('js/shared/wizard.js') }}"></script>
  <script src="{{ asset('js/shared/file-upload.js') }}"></script>
  <script src="{{ asset('js/shared/typeahead.js') }}"></script>
  <script src="{{ asset('js/shared/select2.js') }}"></script>
{{-- Hamberger --}}
  <script src="{{ asset('js/shared/misc.js') }}"></script>




{{-- <script src="{{ asset('js/test.js') }}"></script> --}}

<script src="{{ asset('https://unpkg.com/axios/dist/axios.min.js') }}"></script>

<script>

{{-- window.addEventListener("load", function () {
    const loader = document.querySelector(".loader");
    loader.className += " hidden";
}); --}}

$('[data-toggle="tooltip"]').tooltip();
</script>
  @yield('scripts')
</body>
<script>
    $('textarea').on('input propertychange', function() {
      $(this).val($(this).val().replace(/[^a-zA-Zก-๙1-9=+-/. #,0​@*()​!@$%&*_-{};<>?|^~]/g,''));
    });

    $(function () {
      // alert($('span.notification').text())
      realTime();
    });
      // $(window).load(realTime);
      function realTime() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'get',
            url:'{{ url("auto_delete_file") }}',
            data:{
                '_token': "{{ csrf_token() }}"
            },
            success: function (data) {
              
                console.log(data);

              //   if(data.num_notify > 0){
                  
              //     $('span.notification').text(data.num_notify).show();
              //     $('a.notification').attr('style','display:flex !important');
              //   } else{
                  
              //     $('span.notification').text(data.num_notify).hide();
              //     $('a.notification').attr('style','display:none !important');
              //   }
              // let timeout = setTimeout(realTime, 3000);

              // if(data.status_notify == 1 && data.status_accept == 1){
              //   clearTimeout(timeout);
              // }
              
            },
        });
      }
</script>


</html>
