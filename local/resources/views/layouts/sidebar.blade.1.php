<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
            <li class="nav-item nav-profile">
                    <div class="nav-link">
                      <div class="user-wrapper">

                            @if(Auth::user()->picture_user != null)
                            <div class="profile-image">
                                <img class="img-xs rounded-circle" src="{{ url('/local/public/file/').'/'.Auth::user()->picture_user }}" alt="Profile image">
                            </div>
                            @endif

                            @if(Auth::user()->picture_user == null)
                            <div class="profile-image">
                                <img class="img-xs rounded-circle" src="{{ url('/local/public/file/user1__2018-12-09_KsURh8W2.png') }}" alt="Profile image">
                            </div>
                            @endif
                        <div class="text-wrapper">
                          {{-- <p class="profile-name">Richard V.Welsh</p> --}}
                          @foreach ($employee_user as $out_employee_user)
                            @if($out_employee_user->ID_user == Auth::user()->id)
                            <p class="profile-name">{{ $out_employee_user->Nick_name }}</p>
                            <div>
                                @if($out_employee_user->name_position == NULL)
                                <small class="designation text-muted">{{ $out_employee_user->cotton }} : ไม่ระบุตำแหน่ง</small>
                                @endif

                                @if($out_employee_user->name_position != NULL)
                                <small class="designation text-muted">{{ $out_employee_user->cotton }} : {{ $out_employee_user->name_position }}</small>
                                @endif
                                {{-- <span class="status-indicator online"></span> --}}
                            </div>
                            @endif
                          @endforeach
                        </div>
                      </div>

                      <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" style="padding-left: 0px;padding-right: 0px;">
                      {{-- {{ __('Logout') }} --}}
                            <button class="btn btn-danger btn-block" style="width: 100%;"><i class="fa fa-power-off"></i>
                                &nbsp;ออกจากระบบ
                            </button>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>

                    </div>
                  </li>

      @can('IsAdmin')
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
          <i class="menu-icon mdi mdi-television"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ url('/work_follower') }}">
            <i class="menu-icon mdi mdi-tag-multiple"></i>
            <span class="display1">ติดตามงาน</span>
          </a>
      </li>
      @endcan
     @can('IsSale')
     <li class="nav-item">
        <a class="nav-link" href="{{ url('/work_follower') }}">
          <i class="menu-icon mdi mdi-tag-multiple"></i>
          <span class="display1">ติดตามงาน</span>
        </a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="{{ url('/mainorder') }}">
          <i class="menu-icon mdi mdi-file"></i>
          <span class="display1"> สร้างใบสั่งงาน </span>
        </a>
    </li>
     {{-- เพิ่ม --}}
    <li class="nav-item">
         <a class="nav-link" href="{{ url('/Export/997') }}">
           <i class="menu-icon mdi mdi-certificate"></i>
           <span class="display1"> จัดส่ง</span>
         </a>
     </li>
     {{-- <li class="nav-item">
         <a class="nav-link" href="{{ url('/packing') }}">
           <i class="menu-icon mdi mdi-trackpad"></i>
           <span class="display1"> Packing</span>
         </a>
     </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/today') }}">
          <i class="menu-icon mdi mdi-truck"></i>
          <span class="display1">รายงานทูเดย์ (today)</span>
        </a>
    </li>
    {{-- end เพิ่ม --}}
    @endcan

    @can('Chiefsales')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/work_follower') }}">
          <i class="menu-icon mdi mdi-tag-multiple"></i>
          <span class="display1">ติดตามงาน</span>
        </a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="{{ url('/mainorder') }}">
          <i class="menu-icon mdi mdi-file"></i>
          <span class="display1"> สร้างใบสั่งงาน </span>
        </a>
    </li>
    {{-- เพิ่ม --}}
    <li class="nav-item">
         <a class="nav-link" href="{{ url('/mainscreen') }}">
           <i class="menu-icon mdi mdi-certificate"></i>
           <span class="display1"> สกรีนงาน</span>
         </a>
     </li>
     {{-- <li class="nav-item">
         <a class="nav-link" href="{{ url('/packing') }}">
           <i class="menu-icon mdi mdi-trackpad"></i>
           <span class="display1"> Packing</span>
         </a>
     </li> --}}
     {{-- end เพิ่ม --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/today') }}">
          <i class="menu-icon mdi mdi-truck"></i>
          <span class="display1">รายงานทูเดย์ (today)</span>
        </a>
    </li>
    @endcan

    @can('IsScrene')
     {{-- เพิ่ม --}}
     <li class="nav-item">
        <a class="nav-link" href="{{ url('/work_follower') }}">
          <i class="menu-icon mdi mdi-tag-multiple"></i>
          <span class="display1">ติดตามงาน</span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/mainorder') }}">
          <i class="menu-icon mdi mdi-file"></i>
          <span class="display1"> สร้างใบสั่งงาน </span>
        </a>
    </li> --}}
    {{-- end เพิ่ม --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/mainscreen') }}">
          <i class="menu-icon mdi mdi-certificate"></i>
          <span class="display1"> สกรีนงาน</span>
        </a>
      </li>
      {{-- เพิ่ม --}}
      {{-- <li class="nav-item">
         <a class="nav-link" href="{{ url('/packing') }}">
           <i class="menu-icon mdi mdi-trackpad"></i>
           <span class="display1"> Packing</span>
         </a>
     </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/today') }}">
          <i class="menu-icon mdi mdi-truck"></i>
          <span class="display1">รายงานทูเดย์ (today)</span>
        </a>
    </li>
    {{-- end เพิ่ม --}}
   @endcan



   {{-- เพิ่ม --}}
   @can('IsUser')
     <li class="nav-item">
        <a class="nav-link" href="{{ url('/work_follower') }}">
          <i class="menu-icon mdi mdi-tag-multiple"></i>
          <span class="display1">ติดตามงาน</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/mainorder') }}">
          <i class="menu-icon mdi mdi-file"></i>
          <span class="display1"> สร้างใบสั่งงาน </span>
        </a>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/mainscreen') }}">
          <i class="menu-icon mdi mdi-certificate"></i>
          <span class="display1"> สกรีนงาน</span>
        </a>
      </li>
      {{-- <li class="nav-item">
         <a class="nav-link" href="{{ url('/packing') }}">
           <i class="menu-icon mdi mdi-trackpad"></i>
           <span class="display1"> Packing</span>
         </a>
     </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/today') }}">
          <i class="menu-icon mdi mdi-truck"></i>
          <span class="display1">รายงานทูเดย์ (today)</span>
        </a>
    </li>
   @endcan
   {{-- end เพิ่ม --}}




     @can('IsAdmin')
       <li class="nav-item">
          <a class="nav-link" href="{{ url('/mainorder') }}">
            <i class="menu-icon mdi mdi-file"></i>
            <span class="display1"> สร้างใบสั่งงาน </span>
          </a>
      </li>

     <li class="nav-item">
         <a class="nav-link" href="{{ url('/mainscreen') }}">
           <i class="menu-icon mdi mdi-certificate"></i>
           <span class="display1"> สกรีนงาน</span>
         </a>
     </li>
     {{-- <li class="nav-item">
         <a class="nav-link" href="{{ url('/packing') }}">
           <i class="menu-icon mdi mdi-trackpad"></i>
           <span class="display1"> Packing</span>
         </a>
     </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/today') }}">
          <i class="menu-icon mdi mdi-truck"></i>
          <span class="display1">รายงานทูเดย์ (today)</span>
        </a>
    </li>
     <li class="nav-item">
        <a class="nav-link"  data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="menu-icon mdi mdi-settings"></i>

            <span class="display1">ตั้งค่า</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth" >
            <ul class="nav flex-column sub-menu">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/doctor') }}">Doctor</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/customer') }}">Customer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/employee') }}">Employee</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/service_area') }}">Service Area</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/company') }}">Company</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/factory') }}">Factory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/all_master') }}">Master</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link" href="{{ url('/group_setting') }}">group setting</a>
              </li>
              <li class="nav-item">
                    <a class="nav-link" href="{{ url('/add_menu') }}">menu setting</a>
              </li>
            </ul>
        </div>
      </li>
      @endcan

      @foreach ($employee_department as $data)
        @if(Auth::user()->id == $data->ID_user)
            @if ($data->department == '9' || $data->department == '23')
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/work_follower') }}">
                      <i class="menu-icon mdi mdi-tag-multiple"></i>
                      <span class="display1">ติดตามงาน</span>
                    </a>
                </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ url('/job/9') }}">
                  <i class="menu-icon mdi mdi-archive"></i>
                  <span class="display1"> ผลิตงานติดแน่น</span>
                  </a>
              </li>
            @endif
        @endif
      @endforeach

      @foreach ($employee_department as $data)
      @if(Auth::user()->id == $data->ID_user)
          @if ($data->department == '15')
          <li class="nav-item">
                <a class="nav-link" href="{{ url('/work_follower') }}">
                  <i class="menu-icon mdi mdi-tag-multiple"></i>
                  <span class="display1">ติดตามงาน</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/job/15') }}">
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="display1"> ผลิตงานติดแน่น</span>
                </a>
            </li>
          @endif
      @endif
    @endforeach

    @foreach ($employee_department as $data)
        @if(Auth::user()->id == $data->ID_user)
            @if ($data->department == '13')
            <li class="nav-item">
                    <a class="nav-link" href="{{ url('/work_follower') }}">
                      <i class="menu-icon mdi mdi-tag-multiple"></i>
                      <span class="display1">ติดตามงาน</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/job/13') }}">
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="display1"> ผลิตงานติดแน่น</span>
                </a>
            </li>
            @endif
        @endif
    @endforeach

    @foreach ($employee_department as $data)
    @if(Auth::user()->id == $data->ID_user)
        @if ($data->department == '11')
        <li class="nav-item">
                <a class="nav-link" href="{{ url('/work_follower') }}">
                  <i class="menu-icon mdi mdi-tag-multiple"></i>
                  <span class="display1">ติดตามงาน</span>
                </a>
            </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/job/11') }}">
            <i class="menu-icon mdi mdi-archive"></i>
            <span class="display1"> ผลิตงานติดแน่น</span>
            </a>
        </li>
        @endif
    @endif
@endforeach

    @foreach ($employee_department as $data)
        @if(Auth::user()->id == $data->ID_user)
            @if ($data->department == '12')
            <li class="nav-item">
                    <a class="nav-link" href="{{ url('/work_follower') }}">
                      <i class="menu-icon mdi mdi-tag-multiple"></i>
                      <span class="display1">ติดตามงาน</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/job/12') }}">
                    <i class="menu-icon mdi mdi-archive"></i>
                    <span class="display1"> ผลิตงานติดแน่น</span>
                    </a>
                </li>
            @endif
        @endif
    @endforeach


    {{-- @foreach ($employee_department as $data)
        @if(Auth::user()->id == $data->ID_user)
            @if ($data->department == '6')
            <li class="nav-item">
                    <a class="nav-link" href="{{ url('/work_follower') }}">
                      <i class="menu-icon mdi mdi-tag-multiple"></i>
                      <span class="display1">ติดตามงาน</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/job/6') }}">
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="display1"> ผลิตงานติดแน่น</span>
                </a>
            </li>
            @endif
        @endif
    @endforeach --}}

    @foreach ($employee_department as $data)
        @if(Auth::user()->id == $data->ID_user)
            @if ($data->department == '8')
            <li class="nav-item">
                    <a class="nav-link" href="{{ url('/work_follower') }}">
                      <i class="menu-icon mdi mdi-tag-multiple"></i>
                      <span class="display1">ติดตามงาน</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/job/8') }}">
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="display1"> ผลิตงานติดแน่น</span>
                </a>
            </li>
            @endif
        @endif
    @endforeach

    @foreach ($employee_department as $data)
      @if(Auth::user()->id == $data->ID_user)
          @if ($data->department == '17')
          <li class="nav-item">
                <a class="nav-link" href="{{ url('/work_follower') }}">
                  <i class="menu-icon mdi mdi-tag-multiple"></i>
                  <span class="display1">ติดตามงาน</span>
                </a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/job/17') }}">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="display1"> ผลิตงานติดแน่น</span>
              </a>
          </li>
          @endif
      @endif
    @endforeach

    @foreach ($employee_department as $data)
        @if(Auth::user()->id == $data->ID_user)
            @if ($data->department == '10')
            <li class="nav-item">
                    <a class="nav-link" href="{{ url('/work_follower') }}">
                      <i class="menu-icon mdi mdi-tag-multiple"></i>
                      <span class="display1">ติดตามงาน</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/job/10') }}">
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="display1"> ผลิตงานติดแน่น</span>
                </a>
            </li>
            @endif
        @endif
    @endforeach

    @foreach ($employee_department as $data)
        @if(Auth::user()->id == $data->ID_user)
            @if ($data->department == '20')
            <li class="nav-item">
                    <a class="nav-link" href="{{ url('/work_follower') }}">
                      <i class="menu-icon mdi mdi-tag-multiple"></i>
                      <span class="display1">ติดตามงาน</span>
                    </a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/job/20') }}">
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="display1"> ผลิตงานติดแน่น</span>
                </a>
            </li>
            @endif
        @endif
    @endforeach

    @foreach ($employee_department as $data)
      @if(Auth::user()->id == $data->ID_user)
          @if ($data->department == '19')
          <li class="nav-item">
                <a class="nav-link" href="{{ url('/work_follower') }}">
                  <i class="menu-icon mdi mdi-tag-multiple"></i>
                  <span class="display1">ติดตามงาน</span>
                </a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/job/19') }}">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="display1"> ผลิตงานติดแน่น</span>
              </a>
          </li>
          @endif
      @endif
    @endforeach

    @foreach ($employee_department as $data)
      @if(Auth::user()->id == $data->ID_user)
        @if ($data->department == '14')
        <li class="nav-item">
                <a class="nav-link" href="{{ url('/work_follower') }}">
                  <i class="menu-icon mdi mdi-tag-multiple"></i>
                  <span class="display1">ติดตามงาน</span>
                </a>
            </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/job/14') }}">
            <i class="menu-icon mdi mdi-archive"></i>
            <span class="display1"> ผลิตงานติดแน่น</span>
            </a>
        </li>
        @endif
      @endif
    @endforeach

    @foreach ($employee_department as $data)
      @if(Auth::user()->id == $data->ID_user)
        @if ($data->department == '18')
        <li class="nav-item">
                <a class="nav-link" href="{{ url('/work_follower') }}">
                  <i class="menu-icon mdi mdi-tag-multiple"></i>
                  <span class="display1">ติดตามงาน</span>
                </a>
            </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ url('/job/18') }}">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="display1"> ผลิตงานติดแน่น</span>
              </a>
          </li>
        @endif
      @endif
    @endforeach


    @foreach ($employee_department as $data)
    @if(Auth::user()->id == $data->ID_user)
      @if ($data->department == '24')
      <li class="nav-item">
            <a class="nav-link" href="{{ url('/work_follower') }}">
              <i class="menu-icon mdi mdi-tag-multiple"></i>
              <span class="display1">ติดตามงาน</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/job/24') }}">
            <i class="menu-icon mdi mdi-archive"></i>
            <span class="display1"> ผลิตงานติดแน่น</span>
            </a>
        </li>
      @endif
    @endif
  @endforeach

  @foreach ($employee_department as $data)
  @if(Auth::user()->id == $data->ID_user)
    @if ($data->department == '7')
    <li class="nav-item">
          <a class="nav-link" href="{{ url('/work_follower') }}">
            <i class="menu-icon mdi mdi-tag-multiple"></i>
            <span class="display1">ติดตามงาน</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ url('/job/7') }}">
          <i class="menu-icon mdi mdi-archive"></i>
          <span class="display1"> ผลิตงานติดแน่น</span>
          </a>
      </li>
    @endif
  @endif
@endforeach

@can('IsFQC')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/work_follower') }}">
          <i class="menu-icon mdi mdi-tag-multiple"></i>
          <span class="display1">ติดตามงาน</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/FQC/6') }}">
        <i class="menu-icon mdi mdi-archive"></i>
        <span class="display1"> FQC</span>
        </a>
    </li>
@endcan

@can('IsService')
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/work_follower') }}">
          <i class="menu-icon mdi mdi-tag-multiple"></i>
          <span class="display1">ติดตามงาน</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/service/5') }}">
        <i class="menu-icon mdi mdi-archive"></i>
        <span class="display1"> บริการเทคนิค</span>
        </a>
    </li>
@endcan


    </ul>
  </nav>
