<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
      <a class="navbar-brand brand-logo" href="#">
        <img src="{{ asset('images/PCdental.png') }}" style="width:auto;height:55px;"  alt="logo"/>
      </a>
      <a class="navbar-brand brand-logo-mini" href="#">
        <img src="{{ asset('images/Pc_Dental_Lab-mini.jpg') }}" style="width:50px;height:50px;" alt="logo" />
      </a>
    </div>


    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>

  		<ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex pl-0">
  			<li class="nav-item">
  				<a class="nav-link" style="font-size: 1em;">
  					<i class="mdi mdi-calendar-clock"></i>
  					<span id="diffTime"></span>
  				</a>
  			</li>
  		</ul>

      <ul class="navbar-nav navbar-nav-right">

        <li class="nav-item dropdown d-none d-xl-inline-block">
          <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <span class="profile-text">สวัสดี,&nbsp;{{ Auth::user()->username }} &nbsp;</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <a class="dropdown-item p-0">
              <div class="d-flex border-bottom">
                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                  <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                </div>
                <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                  <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                </div>
                <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                  <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                </div>
              </div>
            </a>

            <a class="dropdown-item mt-2" href="{{ url('/profile') }}">
                    Profile
            </a>

            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>

    </div>
  </nav>
  <script src="{{ asset('js/shared/misc.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHOeEfiuP7-dWQATq4ldQo_JNaPyakqKI" ></script>
  <script>
          var timeNow = new Date("2018-04-05 23:59:59");


          var strDate =  timeNow.getDate();
          var strMouth =  timeNow.getMonth()+1;
          var strYear = timeNow.getFullYear();
          var strHours = timeNow.getHours();
          var strMinutes= timeNow.getMinutes();
          var strSec  = timeNow.getSeconds();


        // document.getElementById("TimeNow").innerHTML = strDate + "/" + strMouth + "/" + strYear + " " + strHours + ":" + strMinutes + ":" + strSec;


          window.onload = function()
          {
            var hou = 2;
            var sec = 60;

            setInterval(function(){

            var _timeNow = new Date();

              var _strMouth =   _timeNow.getMonth()+1;
              var _strYear = _timeNow.getFullYear();
              var _strDate = _timeNow.getDate();
              var _strHours = _timeNow.getHours();
              var _strMinutes= _timeNow.getMinutes();
              var _strSec  = _timeNow.getSeconds();



             document.getElementById("diffTime").innerHTML = _strDate + "/" + _strMouth + "/" + _strYear + " " + _strHours + ":" + _strMinutes + ":" + _strSec;

             },1000);
           }
  </script>


