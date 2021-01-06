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
                            </div>
                            @endif
                          @endforeach
                        </div>
                      </div>

                      <a class="dropdown-item" href="{{ route('login') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" style="padding-left: 0px;padding-right: 0px;">
                        <button class="btn btn-danger btn-block" style="width: 100%;"><i class="fa fa-power-off"></i>
                            &nbsp;ออกจากระบบ
                        </button>
                      </a>
                      <form id="logout-form" action="{{ route('login') }}" method="POST" style="display: none;">
                          @csrf
                      </form>

                    </div>
                  </li>

        @if(Auth::user()->ID_type_users == 1 || Auth::user()->ID_type_users == 9)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                <i class="menu-icon mdi mdi-tag-multiple"></i>
                <span class="menu-title">ติดตามงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="work_follower" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">ฝ่ายขาย</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="order" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/order') }}">สร้างใบสั่งงาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainorder') }}">รายการที่สั่งผลิต</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainorder_com') }}">รายการที่ผลิตแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ url('/mainscreen') }}">
                <i class="menu-icon mdi mdi-certificate"></i>
                <span class="menu-title">สกรีนงาน</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#screenJob" aria-expanded="false" aria-controls="screenJob">
                <i class="menu-icon mdi mdi-certificate"></i>
                <span class="menu-title">สกรีนงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="screenJob" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainscreen') }}">งานรอ Screen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainscreen_90day') }}">งานที่สกรีนแล้วไม่เกิน90วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/screenComplete') }}">งาน Screen แล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"data-toggle="collapse" href="#productAdmin" aria-expanded="false" aria-controls="auth" >
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="menu-title">ผลิตงานติดแน่น</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="productAdmin" >
                    <ul class="nav flex-column sub-menu">
                        
                        <li class="nav-item">
                            <ul  class="nav flex-column sub-menu" id="myUL">
                                @foreach ($product_department as $prod_deprt)
                                @if ($prod_deprt->ID != 8 && $prod_deprt->ID != 3)    {{-- cantfqc --}}
                                    <li class="nav-item">
                                        <span class="nav-link menu-title caret">{{ $prod_deprt->Name }}</span>
                                        <ul class="nested">
                                            <a class="nav-link" href="{{ url('job').'/'.$prod_deprt->ID }}">รับงาน</a>
                                            <a class="nav-link" href="{{ url('distribute_job').'/'.$prod_deprt->ID }}">จ่ายงาน</a>
                                            <a class="nav-link" href="{{ url('qc_job').'/'.$prod_deprt->ID }}">QC</a>
                                        </ul>
                                    </li>
                                @endif
                            @endforeach

                            </ul>
                        </li>
                            
                    </ul>
                </div>
            </li>

             <li class="nav-item">
                <a class="nav-link" href="{{ url('/service/5') }}">
                <i class="menu-icon mdi mdi-dna"></i>
                <span class="menu-title">บริการเทคนิค</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ url('/Export/997') }}">
                <i class="menu-icon mdi mdi-truck"></i>
                <span class="menu-title">จัดส่ง</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#transport" aria-expanded="false" aria-controls="transport">
                <i class="menu-icon mdi mdi-certificate"></i>
                <span class="menu-title">จัดส่ง</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transport" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport/997') }}">รอจัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport_90day') }}">จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport_complete') }}">จัดส่งแล้วทั้งหมด</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ url('/today') }}">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">รายงานทูเดย์ (today)</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">รายงานทูเดย์ (today)</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="today" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                {{-- <a class="nav-link" href="{{ url('report/recieve_send') }}"> --}}
                    <a class="nav-link"  data-toggle="collapse" href="#today2" aria-expanded="false" aria-controls="today2">
                <i class="menu-icon mdi mdi-folder"></i>
                <span class="menu-title">บันทึกการรับ-ส่งงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="today2" >
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('report/recieve_send_today') }}">บันทึกการรับ-ส่งงาน ย้อนหลัง 7 วัน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('report/recieve_send') }}">บันทึกการรับ-ส่งงานทั้งหมด</a>
                    </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-settings"></i>
                <span class="menu-title">ตั้งค่า</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth" >
                    <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/doctor') }}">หมอ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/customer') }}">ลูกค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/employee') }}">พนักงาน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/service_area') }}">เขตพื้นที่</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/branch') }}">สาขา</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/company') }}">บริษัท</a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link" href="{{ url('/lab_master') }}">แลป</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/zone') }}">โซน</a>
                    </li>
                    --

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/factory') }}">โรงงาน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/all_master') }}">Master</a>
                    </li>
                     
                   {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ url('/add_menu') }}">menu setting</a>
                    </li> --}}
                   
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ url('/files') }}">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#work_edit" aria-expanded="false" aria-controls="work_edit">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">report(ทดสอบ)</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="work_edit" >
                    <ul class="nav flex-column sub-menu">
                      
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/report/rejected') }}">ตีกลับช่างภายใน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/report/modify') }}">งานแก้ภายนอก by สินค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('report/delay') }}">งานเลื่อนหลังผลิต</a>
                        </li>

                        <li class="nav-item">
                            <hr>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/report/work_edit/mount') }}">งานแก้ทั้งหมด</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('table/report/work_edit/PFM/week') }}">งานแก้ ทำใหม่ รายสัปดาห์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('table/report_employee/unit') }}">สถิติงานแก้รวม</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="{{ url('/table/report_employee/work_defect') }}">สถิติงานแก้รายคน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/screenComplete') }}">งาน Screen แล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
    

        @endif

        @if(Auth::user()->ID_type_users == 2)
        <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                <i class="menu-icon mdi mdi-tag-multiple"></i>
                <span class="menu-title">ติดตามงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="work_follower" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- @if(Auth::user()->ID_area != NULL) --}}
            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">ฝ่ายขาย</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="order" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/order') }}">สร้างใบสั่งงาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainorder') }}">รายการที่สั่งผลิต</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainorder_com') }}">รายการที่ผลิตแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#transport" aria-expanded="false" aria-controls="transport">
                <i class="menu-icon mdi mdi-certificate"></i>
                <span class="menu-title">จัดส่ง</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transport" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport/997') }}">รอจัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport_90day') }}">จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport_complete') }}">จัดส่งแล้วทั้งหมด</a>
                        </li>
                    </ul>
                </div>
            </li>
                <li class="nav-item">
                    <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                    <i class="menu-icon mdi mdi-chart-line"></i>
                    <span class="menu-title">รายงานทูเดย์ (today)</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="today" >
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ url('report/recieve_send') }}">
                        <i class="menu-icon mdi mdi-folder"></i>
                        <span class="menu-title">บันทึกการรับ-ส่งงาน</span>
                        </a>
                </li> --}}
                <li class="nav-item">
                    {{-- <a class="nav-link" href="{{ url('report/recieve_send') }}"> --}}
                        <a class="nav-link"  data-toggle="collapse" href="#today2" aria-expanded="false" aria-controls="today2">
                    <i class="menu-icon mdi mdi-folder"></i>
                    <span class="menu-title">บันทึกการรับ-ส่งงาน</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="today2" >
                        <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('report/recieve_send_today') }}">บันทึกการรับ-ส่งงาน ย้อนหลัง 7 วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('report/recieve_send') }}">บันทึกการรับ-ส่งงานทั้งหมด</a>
                        </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ url('/files') }}">
                    <i class="menu-icon mdi mdi-file"></i>
                    <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                    </a>
                </li>

        @endif

        @if(Auth::user()->ID_type_users == 8)
            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                <i class="menu-icon mdi mdi-tag-multiple"></i>
                <span class="menu-title">ติดตามงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="work_follower" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- @if(Auth::user()->ID_area != NULL) --}}

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="order">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">ฝ่ายขาย</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="order" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/order') }}">สร้างใบสั่งงาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainorder') }}">รายการที่สั่งผลิต</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainorder_com') }}">รายการที่ผลิตแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#transport" aria-expanded="false" aria-controls="transport">
                <i class="menu-icon mdi mdi-certificate"></i>
                <span class="menu-title">จัดส่ง</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transport" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport/997') }}">รอจัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport_90day') }}">จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transport_complete') }}">จัดส่งแล้วทั้งหมด</a>
                        </li>
                    </ul>
                </div>
            </li>
                <li class="nav-item">
                    <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                    <i class="menu-icon mdi mdi-chart-line"></i>
                    <span class="menu-title">รายงานทูเดย์ (today)</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="today" >
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ url('report/recieve_send') }}">
                        <i class="menu-icon mdi mdi-folder"></i>
                        <span class="menu-title">บันทึกการรับ-ส่งงาน</span>
                        </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon mdi mdi-settings"></i>
                    <span class="menu-title">ตั้งค่า</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth" >
                        <ul class="nav flex-column sub-menu">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/employee') }}">พนักงาน</a>
                        </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ url('/files') }}">
                    <i class="menu-icon mdi mdi-file"></i>
                    <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                    </a>
                </li>
        @endif

        @if(Auth::user()->ID_type_users == 3)
        <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                <i class="menu-icon mdi mdi-tag-multiple"></i>
                <span class="menu-title">ติดตามงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="work_follower" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#screenJob" aria-expanded="false" aria-controls="screenJob">
                <i class="menu-icon mdi mdi-certificate"></i>
                <span class="menu-title">สกรีนงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="screenJob" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainscreen') }}">งานรอ Screen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mainscreen_90day') }}">งานที่สกรีนแล้วไม่เกิน90วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/screenComplete') }}">งาน Screen แล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">รายงานทูเดย์ (today)</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="today" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ url('/files') }}">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                </a>
            </li>
        @endif

        @foreach ($employee_department as $data)
            @if(Auth::user()->id == $data->ID_user)
                @if(Auth::user()->ID_type_users == 4 )
                <li class="nav-item">
                        <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                        <i class="menu-icon mdi mdi-tag-multiple"></i>
                        <span class="menu-title">ติดตามงาน</span>
                        <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="work_follower" >
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"data-toggle="collapse" href="#productAdmin" aria-expanded="false" aria-controls="auth" >
                        <i class="menu-icon mdi mdi-archive"></i>
                        <span class="menu-title">ผลิตงานติดแน่น</span>
                        <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="productAdmin" >
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('job').'/'.$data->department }}">รับงาน</a>
                                    <a class="nav-link" href="{{ url('distribute_job').'/'.$data->department }}">จ่ายงาน</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                        <i class="menu-icon mdi mdi-chart-line"></i>
                        <span class="menu-title">รายงานทูเดย์ (today)</span>
                        <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="today" >
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ url('/files') }}">
                        <i class="menu-icon mdi mdi-file"></i>
                        <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                        </a>
                    </li>
                @endif
            @endif
        @endforeach


            @if(Auth::user()->ID_type_users == 7)
            <li class="nav-item">
                    <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                    <i class="menu-icon mdi mdi-tag-multiple"></i>
                    <span class="menu-title">ติดตามงาน</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="work_follower" >
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link"data-toggle="collapse" href="#productAdmin" aria-expanded="false" aria-controls="auth" >
                    <i class="menu-icon mdi mdi-archive"></i>
                    <span class="menu-title">ผลิตงานติดแน่น</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="productAdmin" >
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <ul  class="nav flex-column sub-menu" id="myUL">
                                    @foreach ($product_department as $prod_deprt)
                                    @if ($prod_deprt->ID != 8 && $prod_deprt->ID != 3)    {{-- cantfqc --}}
                                        <li class="nav-item">
                                            <span class="nav-link menu-title caret">{{ $prod_deprt->Name }}</span>
                                            <ul class="nested">
                                                <a class="nav-link" href="{{ url('job').'/'.$prod_deprt->ID }}">รับงาน</a>
                                                <a class="nav-link" href="{{ url('distribute_job').'/'.$prod_deprt->ID }}">จ่ายงาน</a>
                                                <a class="nav-link" href="{{ url('qc_job').'/'.$prod_deprt->ID }}">QC</a>
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">รายงานทูเดย์ (today)</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="today" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"  href="{{ url('/files') }}">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                </a>
            </li>
            @endif

        @can('IsFQC')
        <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                <i class="menu-icon mdi mdi-tag-multiple"></i>
                <span class="menu-title">ติดตามงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="work_follower" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link"data-toggle="collapse" href="#productAdmin" aria-expanded="false" aria-controls="auth" >
                <i class="menu-icon mdi mdi-archive"></i>
                <span class="menu-title">ผลิตงานติดแน่น</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="productAdmin" >
                    <ul class="nav flex-column sub-menu">
                        
                        <li class="nav-item">
                            <ul  class="nav flex-column sub-menu" id="myUL">
                                @foreach ($product_department as $prod_deprt)
                                @if ($prod_deprt->ID != 8 && $prod_deprt->ID != 3)    {{-- cantfqc --}}
                                    <li class="nav-item">
                                        <span class="nav-link menu-title caret">{{ $prod_deprt->Name }}</span>
                                        <ul class="nested">
                                            <a class="nav-link" href="{{ url('job').'/'.$prod_deprt->ID }}">รับงาน</a>
                                            <a class="nav-link" href="{{ url('distribute_job').'/'.$prod_deprt->ID }}">จ่ายงาน</a>
                                            <a class="nav-link" href="{{ url('qc_job').'/'.$prod_deprt->ID }}">QC</a>
                                        </ul>
                                    </li>
                                @endif
                            @endforeach

                            </ul>
                        </li>
                            
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/FQC/8') }}">
                <i class="menu-icon mdi mdi-truck"></i>
                <span class="menu-title">FQC</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">รายงานทูเดย์ (today)</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="today" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ url('/files') }}">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                </a>
            </li>
        @endcan

        @if(Auth::user()->ID_type_users == 6)
        <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#work_follower" aria-expanded="false" aria-controls="work_follower">
                <i class="menu-icon mdi mdi-tag-multiple"></i>
                <span class="menu-title">ติดตามงาน</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="work_follower" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_inLab') }}">งานที่อยู่ในแลป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_30day') }}">งานที่จัดส่งแล้วไม่เกิน30วัน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/work_follower_exported') }}">งานที่จัดส่งแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/service/10') }}">
                <i class="menu-icon mdi mdi-truck"></i>
                <span class="menu-title">บริการเทคนิค</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"  data-toggle="collapse" href="#today" aria-expanded="false" aria-controls="today">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">รายงานทูเดย์ (today)</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="today" >
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/waitExport') }}">งานที่ไม่ได้จัดส่ง</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/today/Exported') }}">งานที่จัดส่งเสร็จแล้ว</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="{{ url('/files') }}">
                <i class="menu-icon mdi mdi-file"></i>
                <span class="menu-title">เอกสาร(เฉพาะผู้ที่เกี่ยวข้อง)</span>
                </a>
            </li>
        @endif


    </ul>
  </nav>
<script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
            });
        }
</script>
