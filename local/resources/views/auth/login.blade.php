
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ Config::get('app.name') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./vendor/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./vendor/iconfonts/puse-icons-feather/feather.css">
    <link rel="stylesheet" href="./vendor/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="./vendor/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="./css/shared/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="./images/carousel/login_3.jpg" /> </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper auth p-0 theme-two">
          <div class="row d-flex align-items-stretch">
            <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
              <div class="slide-content bg-1"> </div>
            </div>
            <div class="col-12 col-md-8 h-100 bg-white">
              <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <center>
                        <div class="center">
                            <img alt="logo Pic" src="images/PCdental.png" style="width:130;height:130px;">
                        </div>
                    </center>
                      <br>
                      <br>

                      <div class="form-group">
                         <label class="label">รหัสผู้ใช้งาน (Username หรือ Email)</label>
                         <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="mdi mdi-account-outline"></i>
                                    </span>
                                 </div>
                              <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('email') }}</strong>
                                       </span>
                                   @endif
                         </div>
                       </div>

                        <div class="form-group">
                          <label class="label">รหัสผ่าน (Password)</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="mdi mdi-lock-outline"></i>
                                </span>
                            </div>
                            <input id="password" placeholder="*******" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                             @if ($errors->has('password'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                             @endif
                          </div>
                        </div>

                        @if(session('success'))
                            <strong style="color:red;">{{session('success')}}</strong>
                        @endif

                        <div class="form-group">
                           <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('เข้าสู่ระบบ') }}
                                </button>
                            </div>
                        </div>
                </form>

                <div class="wrapper mt-5 text-gray">
                        <p class="footer-text text-center">Copyright © 2018 PC Dental Lab.Power by DCore System Integrator.</p>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./vendor/js/vendor.bundle.base.js"></script>
    <script src="./vendor/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="./js/shared/off-canvas.js"></script>
    <script src="./js/shared/hoverable-collapse.js"></script>
    <script src="./js/shared/misc.js"></script>
    <script src="./js/shared/settings.js"></script>
    <script src="./js/shared/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
  </body>
</html>
