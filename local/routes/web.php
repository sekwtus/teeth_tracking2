<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : 'auth.login');
    return Redirect('auth.login');
});

Route::get('/table', function () {
    return view('table');
});

Route::get('/table2', function () {
    return view('table2');
});

Route::get('/table3', function () {
    return view('table3');
});

Route::get('/new_screen', function () {
    return view('screen.screen');
})->middleware('auth');

Route::get('/test', function () {
    return view('test');
});

Route::get('/test555', function () {
    return view('/order/test');
});

Route::get('/test1', function () {
    return view('/order/test1');
});

Route::get('/testproduct', function () {
    return view('testproduct');
});

Route::get('/main_job', function () {
    return view('/Job/main_job');
});

Route::get('/edit_job', function () {
    return view('/Job/edit_job');
});

Route::get('/history_job', function () {
    return view('/Job/history_job');
});

Route::get('/select_job', function () {
    return view('/Job/select_job');
});
Route::get('/testmaster', function () {
    return view('/master/test');
});

// Route::get('/dashboard', function () {
//     if (!Gate::allows('IsAdmin')) {
//         abort(404, 'Page NotFound');
//     }

//     return view('dashboard');
// })->middleware('auth');

Route::get('/dashboard', 'dashboard@main_dashboard')->middleware('auth');
Route::get('/dashboard/processDetail', 'dashboard@index')->middleware('auth');
Route::get('/dashboard/work_transportDay_today', 'dashboard@work_transportDay_today')->middleware('auth');
Route::get('/dashboard/work_transportDay_yesterday', 'dashboard@work_transportDay_yesterday')->middleware('auth');
Route::get('/dashboard/keyin_branch', 'dashboard@keyin_branch')->middleware('auth');
Route::get('/dashboard/screen_lab', 'dashboard@screen_lab')->middleware('auth');
Route::get('/dashboard/pie_work_late', 'dashboard@pie_work_late')->middleware('auth');
Route::get('/dashboard/pie_call_doctor', 'dashboard@pie_call_doctor')->middleware('auth');
Route::get('/dashboard/type_of_work', 'dashboard@type_of_work')->middleware('auth');
Route::get('/dashboard/order_processing', 'dashboard@order_processing')->middleware('auth');
Route::get('/dashboard/order_refbarcode', 'dashboard@order_refbarcode')->middleware('auth');



// test
// Route::get('/dashboard/tody', 'dashboard@tody')->middleware('auth');

// Route::get('/doctor', function () {
//     return view('Doctor.doctor');
// });
Route::resource('doctor', 'doctor_controller')->middleware('auth');
Route::get('table/doctor', 'datatable_controller@doctor')->middleware('auth');
Route::get('doctor/update_status/{id}', 'doctor_controller@updateStatus')->middleware('auth');
Route::post('doctor/update', 'doctor_controller@update')->middleware('auth');
Route::get('delete_docter', 'doctor_controller@destroy')->middleware('auth');

// Route::get('/customer', function () {
//     return view('Customer.customer');
// });
Route::resource('customer', 'customer_controller')->middleware('auth');
Route::get('table/customer', 'datatable_controller@customer')->middleware('auth');
Route::get('customer/update_status/{id}', 'customer_controller@updateStatus')->middleware('auth');
Route::get('delete_customer', 'customer_controller@delete_customer')->middleware('auth');
Route::post('update_customer/save', 'customer_controller@update_customer')->middleware('auth');

// Route::resource('employee', 'employee_controller')->middleware('auth');
Route::get('/production', 'production_scan_profile_controller@getIndex')->middleware('auth');
Route::get('/production/scan_profile', 'production_scan_profile_controller@scan')->middleware('auth');
Route::get('/production_product', 'production_scan_product_controller@getIndex')->middleware('auth');
Route::get('/production/scan_product', 'production_scan_product_controller@scan')->middleware('auth');
Route::get('/edit_master', 'edit_master_controller@getIndex')->middleware('auth');
Route::get('/qc', 'qc_controller@getIndex')->middleware('auth');
Route::get('/qc/select', 'qc_controller@getselect')->middleware('auth');
Route::get('/product_master1', 'product_master1_controller@Index')->middleware('auth');
Route::get('/product_master2', 'product_master2_controller@Index')->middleware('auth');
Route::get('/product_master3', 'product_master3_controller@Index')->middleware('auth');
Route::get('/product_master4', 'product_master4_controller@Index')->middleware('auth');
Route::get('/employee', 'employee_controller@index')->middleware('auth');
Route::get('/table/employee', 'datatable_controller@employee')->middleware('auth');
Route::get('/employee/create', 'employee_controller@create')->middleware('auth');
Route::get('/employee/edit/{id}', 'employee_controller@edit')->middleware('auth');
Route::post('/employee/add', 'employee_controller@add')->middleware('auth');
Route::post('/employee/saveedit/{id_user}', 'employee_controller@saveedit')->middleware('auth');
Route::post('/employee/delete/{id}/{id_user}', 'employee_controller@delete')->middleware('auth');
Route::get('employee/update_status/{id}', 'employee_controller@updateStatus')->middleware('auth');

// Route::get('/employee', function () {
//     return view('Employee.employee');
// })->middleware('auth');

// Route::get('/company', function () {
//     return view('Company.company');
// });
Route::resource('company', 'company_controller')->middleware('auth');
Route::get('table/company', 'datatable_controller@company')->middleware('auth');

// Route::get('/service_area', function () {
//     return view('Service Area.service_area');
// });
Route::resource('service_area', 'area_controller')->middleware('auth');
Route::get('table/service_area', 'datatable_controller@service_area')->middleware('auth');

Route::resource('factory', 'factory_controller')->middleware('auth');
Route::get('table/factory', 'datatable_controller@factory')->middleware('auth');

Route::resource('lab_master', 'lab_master_controller')->middleware('auth');
Route::get('table/lab', 'lab_master_controller@ajaxLab')->middleware('auth');
Route::post('add_lab', 'lab_master_controller@add_lab')->middleware('auth');
Route::get('delete_lab', 'lab_master_controller@delete_lab')->middleware('auth');
Route::post('update_lab', 'lab_master_controller@update_lab')->middleware('auth');

Route::resource('/branch', 'branch_controller')->middleware('auth');
Route::get('table/branch', 'branch_controller@ajaxbranch')->middleware('auth');
Route::post('add_branch', 'branch_controller@add_branch')->middleware('auth');
Route::get('delete_branch', 'branch_controller@delete_branch')->middleware('auth');
Route::get('getLab_company', 'branch_controller@getLab_company')->middleware('auth');
Route::post('update_branch', 'branch_controller@update_branch')->middleware('auth');


Route::get('table/packing', 'datatable_controller@packing')->middleware('auth');
Route::get('table/packing_complete', 'datatable_controller@packing_complete')->middleware('auth');
Route::post('/packing/scan', 'packing_controller@change_status')->middleware('auth');
Route::get('/detail_packing/{id}', 'packing_controller@getIndex_detail_packing')->middleware('auth');
Route::get('/packing_finish/{id}', 'packing_controller@packing_finish')->middleware('auth');
Route::get('/master_QC', 'master_QC_checklist_controller@getIndex')->middleware('auth');
Route::get('/master_QC/search', 'master_QC_checklist_controller@search')->middleware('auth');
Route::get('/master_QC/Edit/{id}', 'master_QC_checklist_controller@edit')->middleware('auth');
Route::get('/master_QC/Delete/{id}', 'master_QC_checklist_controller@delete')->middleware('auth');
Route::get('/transportation', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('Transport.transporttation');
})->middleware('auth');

Route::get('/today/waitExport', 'today@index')->middleware('auth');
Route::get('/table/today/waitExport', 'today@getAjexWaitExport')->middleware('auth');
Route::get('/today/Exported','today@index2')->middleware('auth');
Route::get('/table/today/Exported', 'today@getAjexExported')->middleware('auth');

Route::get('/today/{id}', 'today@todayFinish')->middleware('auth');
Route::post('/today/scan', 'today@scanBarCode')->middleware('auth');
Route::post('/today/by_id', 'today@index_by_id')->middleware('auth');
Route::get('/history_jobFlow/{id}', 'today@jobFlow')->middleware('auth');

//Start Order*************************************************
Route::get('/mainorder', 'main_order_controller@getIndex')->middleware('auth');
Route::get('/mainorder_com', 'main_order_controller@getIndex_com')->middleware('auth');
Route::get('/work_follower_inLab', 'work_follower@index')->middleware('auth');
Route::get('/work_follower_30day', 'work_follower@index_30day')->middleware('auth');
Route::get('/work_follower_exported', 'work_follower@index_exported')->middleware('auth');
Route::post('/job_work_follower/{ID}/update', 'work_follower@jobcomplete')->middleware('auth');
Route::get('/work_follower/delete_barcode', 'work_follower@delete_barcode')->middleware('auth');
Route::get('/table/work_follower/order', 'work_follower@getAjexOrder')->middleware('auth');
Route::get('/table/work_follower/order_30day', 'work_follower@getAjexOrder_30day')->middleware('auth');



Route::get('/table/work_follower/orderComplete', 'work_follower@getAjexOrderComplete')->middleware('auth');

Route::get("work_follower_exported_before",function (){
    return view('order.work_follower_exported');
})->middleware('auth');
Route::get("work_follower_30day_before",function (){
    return view('order.work_follower_30day');
})->middleware('auth');




Route::get('table/order', 'datatable_controller@order')->middleware('auth');
Route::get('table/order_complete', 'datatable_controller@order_complete')->middleware('auth');
Route::get('table/order_doctor', 'datatable_controller@order_doctor')->middleware('auth');
Route::get('table/screen_doctor', 'datatable_controller@screen_doctor')->middleware('auth');

Route::get('/mainorder2', 'main_order2_controller@getIndex')->middleware('auth');

Route::get('/order', 'order_controller@getIndex')->middleware('auth');

Route::get('/order2', 'order2_controller@index')->middleware('auth');

Route::get('/order2/{id}', 'order2_controller@index2')->middleware('auth');

Route::get('/order2_area/{id}/{id2}', 'order2_controller@index_area')->middleware('auth');

Route::get('/order2_3', 'order2_controller@index3')->middleware('auth');

Route::get('/order2_4', 'order2_controller@index4')->middleware('auth');

// Route::get('/order3', 'order3_controller@index')->middleware('auth');

Route::get('/order3/company', 'order3_controller@index2')->middleware('auth');

Route::get('/order4', 'order4_controller@index')->middleware('auth');

Route::get('/order5', 'order5_controller@index')->middleware('auth');

Route::get('/order6', 'order6_controller@index1')->middleware('auth');

Route::get('/order7', 'order7_controller@index')->middleware('auth');

Route::get('/order7/save', 'order7_controller@index_save')->middleware('auth');

Route::post('/order/add', 'order_controller@addorder')->middleware('auth');

Route::post('/order2/add', 'order2_controller@addorder')->middleware('auth');

Route::post('/order2/addPatient', 'order2_controller@addPatient')->middleware('auth');

Route::post('/order2/addCustomerID', 'order2_controller@addCustomerID')->middleware('auth');

Route::post('/order2/addDoctorID', 'order2_controller@addDoctorID')->middleware('auth');
Route::post('/order2_3/addDoctor', 'order2_controller@addDoctor')->middleware('auth');

Route::post('/order3_1/companyID', 'order3_controller@addcompanyID')->middleware('auth');

Route::post('/order3_2/addBranchID', 'order3_controller@addBranchID')->middleware('auth');

Route::post('/order3_3/addArea', 'order3_controller@addArea')->middleware('auth');

Route::post('/order3/FactoryID', 'order3_controller@addFactoryID')->middleware('auth');

Route::post('/order4/addteeth', 'order4_controller@addteeth')->middleware('auth');

Route::post('/order5/addgroupteeth', 'order5_controller@addgroupteeth')->middleware('auth');

// Route::post('/order6/addattachment', 'order6_controller@addattachment')->middleware('auth');

Route::post('/order6/addattachment/{id}', 'order6_controller@addattachment')->middleware('auth');

Route::post('/order4/{id}/delete', 'order4_controller@delete_order4')->middleware('auth');

Route::post('/order5/{id}/delete', 'order5_controller@delete_order5')->middleware('auth');

Route::get('/order_detail/{id}', 'main_order_controller@getOrderDetail')->middleware('auth');

Route::post('/order/continuouswork/{id}', 'screen_controller@continuouswork')->middleware('auth');

//End Order*************************************************

// Route::get('/mainscreen', function () {
//     if(!Gate::allows('IsAdmin')){
//         abort(404,"Page NotFound");
//     }
//     return view('screen.mainscreen');
// })->middleware('auth');

Route::get('/mainscreen', 'mainscreen_controller@getIndex')->middleware('auth');
Route::get('/mainscreen_90day', 'mainscreen_controller@getIndex_90day')->middleware('auth');
Route::get('/screenComplete', 'mainscreen_controller@getIndexComplete')->middleware('auth');
Route::get('table/screen_teeth', 'datatable_controller@screen_teeth')->middleware('auth');
Route::get('table/screen_teeth_90day', 'datatable_controller@screen_teeth_90day')->middleware('auth');

Route::get('table/screen', 'datatable_controller@screen')->middleware('auth');
Route::get('table/screen_complete', 'datatable_controller@screen_complete')->middleware('auth');
Route::get('/mainscreen/screen/{id}', 'mainscreen_controller@screen')->middleware('auth');
Route::get('/mainscreen/Enclosed/{id}', 'select_teeth_controller@Enclosed')->middleware('auth');

Route::post('/mainscreen/screen/save', 'mainscreen_controller@save')->middleware('auth');
Route::get("screenComplete_before",function (){
    return view('screen.screenComplete');
})->middleware('auth');
Route::get("mainscreen_90day_before",function (){
    return view('screen.mainscreen_90day');
})->middleware('auth');


// select color by id brand
Route::get('color-by-brand', 'new_screen_controller@selectcolor')->middleware('auth');

// NEW-SCREEN
Route::get('/mainscreen/new_screen/{id}', 'new_screen_controller@screen')->middleware('auth');
Route::get('/mainscreen/edit_conclusion/{id}/{group}', 'new_screen_controller@edit_conclusion')->middleware('auth');//แก้ไขหลังสกีน
Route::post('/mainscreen/edit_conclusion/{id}/{group}/save', 'new_screen_controller@save_edit_conclusion')->middleware('auth');

Route::get('/mainscreen/edit_on_screening/{id}/{group}', 'new_screen_controller@edit_on_screening')->middleware('auth');//แก้ไขขณะสกรีน
Route::post('/mainscreen/edit_on_screening/{id}/{group}/save', 'new_screen_controller@save_edit_on_screening')->middleware('auth');
Route::post('/edit_on_screening/edit_teeth/{id}', 'new_screen_controller@on_screening_edit_teeth')->middleware('auth');


Route::post('/mainscreen/edit_conclusion/{id}/{group}/delete', 'new_screen_controller@delete_teeth_conclusion')->middleware('auth');
Route::get('/mainscreen/edit_teeth/{id}', 'new_screen_controller@edit_teeth')->middleware('auth');
Route::post('/mainscreen/edit_teeth/{id}/delete/{id_screen}/{TeethID}', 'new_screen_controller@delete_teeth')->middleware('auth');
Route::post('/mainscreen/edit_teeth/addteeth', 'new_screen_controller@addteeth')->middleware('auth');
Route::get('/mainscreen/edit_teeth2/{id}', 'new_screen_controller@groupteeth')->middleware('auth');
Route::post('/mainscreen/edit_teeth2/addgroup', 'new_screen_controller@addgroup')->middleware('auth');
Route::post('/mainscreen/edit_teeth2/group/{id}/delete/{id_screen}', 'new_screen_controller@delete_group')->middleware('auth');
Route::get('/mainscreen/edit_select_teeth/{id}', 'new_screen_controller@edit_select_teeth')->middleware('auth');
Route::get('/mainscreen/edit_screen_teeth/{id}', 'new_screen_controller@editscreen_teeth')->middleware('auth');

Route::post('screen/savefile', 'new_screen_controller@saveFile')->middleware('auth');
Route::post('distribute/savefile', 'job_controller@saveFile')->middleware('auth');

//แก้ไขซี่ฟัน
Route::post('/edit_conclusion/edit_teeth/{id}', 'new_screen_controller@conclusion_edit_teeth')->middleware('auth');
Route::post('/mainscreen/edit_screen_teeth/save', 'new_screen_controller@eidt_save')->middleware('auth');
Route::post('/mainscreen/new_screen/save', 'new_screen_controller@save')->middleware('auth');
Route::get('/mainscreen/detail/teeth/edit/{id}/{id_teeth}', 'new_screen_controller@editscreen')->middleware('auth');
Route::post('/mainscreen/detail/teeth/edit/save/{id}/{id_teeth}', 'new_screen_controller@savescreen')->middleware('auth');
Route::get('/mainscreen/edit_conclusion_general/{id}', 'new_screen_controller@editgeneralscreen')->middleware('auth');
Route::post('/mainscreen/new_screen_general/save/{id}', 'new_screen_controller@savegeneral')->middleware('auth');
Route::post('/mainscreen/edit_conclusion/{id}/{group}/add', 'new_screen_controller@edit_conclusion_add')->middleware('auth');


Route::get('/mainscreen/teeth/{id}', 'select_teeth_controller@teeth')->middleware('auth');
Route::get('/mainscreen/teeth/group/{id}', 'select_teeth_controller@groupteeth')->middleware('auth');
Route::get('/mainscreen/teeth/detail/{id}', 'select_teeth_controller@detailteeth')->middleware('auth');
Route::post('/mainscreen/teeth/addteeth', 'select_teeth_controller@addteeth')->middleware('auth');
Route::post('/mainscreen/teeth/addgroup', 'select_teeth_controller@addgroup')->middleware('auth');
Route::post('/mainscreen/teeth/{id}/delete/{id_screen}/{TeethID}', 'select_teeth_controller@delete_teeth')->middleware('auth');
Route::post('/mainscreen/teeth/group/{id}/delete/{id_screen}', 'select_teeth_controller@delete_group')->middleware('auth');
Route::post('/mainscreen/teeth/{id}/save', 'select_teeth_controller@save')->middleware('auth');


Route::get('/mainscreen/detail/{id}', 'mainscreen_controller@detailscreen')->middleware('auth');
Route::get('/mainscreen/detail/teeth/{id}', 'mainscreen_controller@detailteeth')->middleware('auth');
Route::post('/mainscreen/continuouswork/{id}', 'mainscreen_controller@continuouswork')->middleware('auth');
Route::post('mainscreen/detail/teeth/{id}/{id2}/update', 'mainscreen_controller@updateDetailReqType')->middleware('auth');
Route::get('/checking_screen', 'mainscreen_controller@checking_screen')->middleware('auth');



Route::get('/group', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('screen.group');
})->middleware('auth');

// Route::get('/screen1', function () {
//     return view('screen.screen1');
// })->middleware('auth');

Route::get('/screen1', 'screen_controller@getIndex')->middleware('auth');
Route::get('/screen1_1', 'screen_controller@getIndex1')->middleware('auth');
Route::post('/screen/add', 'screen_controller@savedata')->middleware('auth');

Route::get('/screen2', 'screen2_controller@getIndex')->middleware('auth');
Route::post('/screen2/add', 'screen2_controller@savedata')->middleware('auth');

Route::get('/screen3', 'screen3_controller@getIndex')->middleware('auth');
Route::post('/screen3/add', 'screen3_controller@savedata')->middleware('auth');

Route::get('/screen4', 'screen4_controller@getIndex')->middleware('auth');
Route::post('/screen4/add', 'screen4_controller@savedata')->middleware('auth');

Route::get('/screen5', 'screen5_controller@getIndex')->middleware('auth');
Route::post('/screen5/add', 'screen5_controller@savedata')->middleware('auth');

Route::get('/screen6', 'screen6_controller@getIndex')->middleware('auth');
Route::post('/screen6/add', 'screen6_controller@savedata')->middleware('auth');

Route::get('/screen7', 'screen7_controller@getIndex')->middleware('auth');
Route::post('/screen7/add', 'screen7_controller@savedata')->middleware('auth');

Route::get('/screen8', 'screen8_controller@getIndex')->middleware('auth');
Route::post('/screen8/add', 'screen8_controller@savedata')->middleware('auth');

Route::get('/screen9', 'screen9_controller@getIndex')->middleware('auth');

Route::get('/groupscreen', function () {
    return view('screen.group_screen');
})->middleware('auth');

// Route::get('/screen2', function () {
//     return view('screen.screen2');
// })->middleware('auth');

// Route::get('/screen3', function () {
//     return view('screen.screen3');
// })->middleware('auth');

// Route::get('/screen4', function () {
//     return view('screen.screen4');
// })->middleware('auth');

// Route::get('/screen5', function () {
//     return view('screen.screen5');
// })->middleware('auth');

// Route::get('/screen6', function () {
//     return view('screen.screen6');
// })->middleware('auth');

// Route::get('/screen7', function () {
//     return view('screen.screen7');
// })->middleware('auth');

// Route::get('/screen8', function () {
//     return view('screen.screen8');
// })->middleware('auth');

Route::get('/screen9', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('screen.screen9');
})->middleware('auth');

Route::get('/screen10', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('screen.screen10');
})->middleware('auth');

Route::get('/screen11', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('screen.screen11');
})->middleware('auth');

Route::get('/screen12', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('screen.screen12');
})->middleware('auth');

Route::get('/registers', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('register');
})->middleware('auth');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// Auth::routes(['verify' => true]);
// Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/camera', function () {
    if (!Gate::allows('IsAdmin')) {
        abort(404, 'Page NotFound');
    }

    return view('camera.takephoto');
})->middleware('auth');

Route::get('/profile', 'profile_controller@profile')->middleware('auth');

Route::get('/editprofile', 'profile_controller@editprofile')->middleware('auth');

Route::post('/editprofile/add', 'profile_controller@addprofile')->middleware('auth');

// Route::get('/changepassword', function () {
//     if(!Gate::allows('IsAdmin')){
//         abort(404,"Page NotFound");
//     }
//     return view('profile/changepassword');
// })->middleware('auth');

Route::get('/changepassword', function () {
    return view('profile/changepassword');
})->middleware('auth');

Route::get('/all_master', function () {
    return view('master/all_master');
})->middleware('auth');

Route::post('/changepassword/edit', 'profile_controller@changepassword')->middleware('auth');

Route::get('/masterCompany', 'company_master_controller@index')->middleware('auth');
Route::get('/company_master1/{ID}', 'company_master_controller@branch')->middleware('auth');
Route::get('/company_master2/{ID}', 'company_master_controller@division')->middleware('auth');
Route::get('/company_master3/{ID}', 'company_master_controller@department')->middleware('auth');
Route::get('/company_master4/{ID}', 'company_master_controller@sub_department')->middleware('auth');

Route::get('/zone_master', 'zone_master_controller@index')->middleware('auth');
Route::get('/zone_master1/{ID}', 'zone_master_controller@selectArea')->middleware('auth');
// Route::get('/zone_master2/branch', 'zone_master_controller@selectZone')->middleware('auth');
// Route::post('/zone_master3/zone', 'zone_master_controller@selectArea')->middleware('auth');

Route::get('/zone', 'zone_master_controller@getZone')->middleware('auth');
Route::get('/ajaxGetZone', 'zone_master_controller@ajaxGetZone')->middleware('auth');
Route::post('/add_zone', 'zone_master_controller@add_zone')->middleware('auth');
Route::get('/delete_zone', 'zone_master_controller@delete_zone')->middleware('auth');
Route::post('/update_zone', 'zone_master_controller@update_zone')->middleware('auth');


Route::get('qc', 'qc_controller@getIndex')->middleware('auth');
Route::get('/qc/{id}', 'qc_controller@getselect')->middleware('auth');
Route::post('/qc/scan', 'qc_controller@addJob')->middleware('auth');
Route::post('/qc/scanOpen/{id}/{jobid}', 'qc_controller@Openjob')->middleware('auth');
Route::post('/qc/scanClose/{id}/{jobid}', 'qc_controller@Closejob')->middleware('auth');

Route::get('product/{id}', 'product_controller@getIndex')->middleware('auth');
Route::get('main_product', 'main_product_controller@getIndex')->middleware('auth');
Route::get('/product/{id_job}/{id}', 'product_controller@getselect')->middleware('auth');
Route::post('/product/{id_job}/scan', 'product_controller@addJob')->middleware('auth');
Route::post('/product/{id_job}/scanOpen/{id}/{jobid}/{detailid}', 'product_controller@Openjob')->middleware('auth');
Route::post('/product/{id_job}/scanClose/{id}/{jobid}/{detailid}', 'product_controller@Closejob')->middleware('auth');
Route::post('/product/{id_job}/qcchecklist/{id}/{jobid}/{detailid}', 'product_controller@qcchecklist')->middleware('auth');
Route::post('/product/{id_job}/qcchecklist/{id}/{jobid}/{detailid}/2', 'product_controller@qc_uncomplete')->middleware('auth');
Route::post('/product/{id_job}/qcchecklist/{id}/{jobid}/{detailid}/sendtodoctor', 'product_controller@send_to_doctor')->middleware('auth');
Route::post('/product/{id_job}/qcchecklist/{id}/{jobid}/{detailid}/fqc_com', 'product_controller@fqcchecklist')->middleware('auth');
Route::post('/product/{id_job}/qcchecklist/{id}/{jobid}/{detailid}/fqc_uncom', 'product_controller@fqc_uncomplete')->middleware('auth');


//job
// Route::get('main_job/{id}', 'job_controller@getIndex')->middleware('auth');
Route::get('job/{id}', 'job_controller@getIndex')->middleware('auth');
Route::get('distribute_job/{id}', 'job_controller@getdistributeIndex')->middleware('auth');
Route::get('qc_job/{id}', 'job_controller@getQCIndex')->middleware('auth');
Route::post('job/scan/{id}', 'job_controller@add_job')->middleware('auth');
Route::post('job/{id}/sub_depart', 'job_controller@sub_department')->middleware('auth');
Route::post('job/scan/sub_depart/{id}', 'job_controller@add_sub_department')->middleware('auth');
Route::post('job/scan/sub_depart2/{id}', 'job_controller@add_sub_department2')->middleware('auth');
Route::post('job/{id}/qcchecklist/{id_job}', 'job_controller@qc_uncomplete')->middleware('auth');
Route::post('job/{id}/fqcchecklist/{id_job}', 'job_controller@fqc_uncomplete')->middleware('auth');
Route::post('job/{id}/send_to_doctor', 'job_controller@send_to_doctor')->middleware('auth');
Route::post('job/scan/add_QC/{id}', 'job_controller@add_QC')->middleware('auth');
Route::post('job/scan/add_FQC/{id}', 'job_controller@add_FQC')->middleware('auth');
Route::post('job/{id}/QC_Compelte/{id_job}', 'job_controller@qc_complete')->middleware('auth');
Route::post('job/{id}/send_to_service/{id_job}', 'job_controller@send_to_service')->middleware('auth');
Route::post('job/{id}/QC_Uncom_backward/{id_job}', 'job_controller@QC_Uncom_backward')->middleware('auth');
Route::post('job/{id}/call_to_doctor/{id_job}', 'job_controller@call_to_doctor')->middleware('auth');
Route::get('ajax_get_data_job', 'job_controller@ajax_get_data_job')->middleware('auth');
Route::get('ajax_get_type_product', 'job_controller@ajax_get_type_product')->middleware('auth');
Route::get('ajax_get_note', 'job_controller@ajax_get_note')->middleware('auth');

//job ajex
Route::get('req_employee_dept', 'job_controller@req_employee_dept')->middleware('auth');

Route::get('transport/{id}', 'Export_controller@getExport')->middleware('auth');
Route::get('transport_90day', 'Export_controller@getExport_90day')->middleware('auth');
Route::get('transport_complete', 'Export_controller@getExport_complete')->middleware('auth');

Route::get('transport_90day_before', function () {
    return view('Job.Export_90day');
})->middleware('auth');

Route::get('transport_complete_before', function () {
    return view('Job.Export_complete');
})->middleware('auth');

Route::post('job/export/{id}', 'Export_controller@add_job')->middleware('auth');
Route::get('/table/order_packing', 'Export_controller@getAjexOrder_packing')->middleware('auth');
Route::get('/table/order_packed', 'Export_controller@getAjexOrder_packed')->middleware('auth');
Route::get('/table/order_packed_90day', 'Export_controller@getAjexOrder_packed_90day')->middleware('auth');

Route::post('job/FQC/{id}', 'Export_controller@getIndex')->middleware('auth');

Route::get('FQC/{id}', 'FQC_controller@getIndex')->middleware('auth');
Route::post('FQC/add_FQC/{id}', 'FQC_controller@add_FQC')->middleware('auth');
Route::post('FQC/{id}/send_to_doctor/{id_job}/{id_order_screen}', 'FQC_controller@send_to_doctor')->middleware('auth');
Route::post('FQC/{id}/fqc_uncomplete/{id_job}', 'FQC_controller@fqc_uncomplete')->middleware('auth');
Route::post('FQC/{id}/fqc_complete/{id_job}', 'FQC_controller@fqc_complete')->middleware('auth');
Route::post('FQC/{id}/send_to_service/{id_job}', 'FQC_controller@send_to_service')->middleware('auth');
Route::post('FQC/{id}/call_to_doctor/{id_job}', 'FQC_controller@call_to_doctor')->middleware('auth');

Route::get('service/{id}', 'service_controller@getIndex')->middleware('auth');
Route::post('service/add_service/{id}', 'service_controller@add_service')->middleware('auth');
Route::post('service/{id}/send_to_service_/{id_job}', 'service_controller@send_to_service')->middleware('auth');
Route::post('service/{id}/send_to_service_teeth/{id_job}', 'service_controller@send_to_teeth')->middleware('auth');
Route::post('service/edit/{id}/{id_doc}', 'service_controller@edit_doctor')->middleware('auth');



// Route::post('/product1/scan', 'product_controller@addJob1')->middleware('auth');

// setting menu , type user
Route::get('/add_menu', 'manage_menu@index')->middleware('auth');
Route::post('/add_menu/add', 'manage_menu@addMenu')->middleware('auth');

Route::get('/group_setting', 'group_setting@index')->middleware('auth'); //is type user in database
Route::post('/group_setting/add_group', 'group_setting@addTypeUsers')->middleware('auth');
Route::post('/group_setting/permission_group', 'group_setting@permission_group')->middleware('auth');

Route::post('/savephoto', 'testcontroller@savephoto')->middleware('auth');

Route::get('/testdatatable', 'testdatatable_controller@view');
Route::get('/testdatatable_table', 'testdatatable_controller@index_yajra');

// Route::get('/summary_report/{id}', 'summary_report@select_summary')->middleware('auth');
Route::get('/summary_report/{id}', 'summary_report@summary')->middleware('auth');
Route::get('pdf/rpt-1', 'reportController@PDF1')->middleware('auth');

Route::resource('report/work_edit/mount', 'reportController')->middleware('auth');
Route::get('table/report/work_edit/PFM', 'reportController@work_edit_pfm')->middleware('auth');
Route::get('get_data_report_work_defect', 'reportController@get_data_report_work_defect')->middleware('auth');
//week
// Route::get('report/work_edit/week', 'reportController@index_work_edit_pfm_week')->middleware('auth');
// Route::get('report/work_edit/PFM/week', 'reportController@index_work_edit_pfm_week')->middleware('auth');
Route::get('table/report/work_edit/PFM/week', 'reportController@index_work_edit_pfm_week')->middleware('auth');
Route::get('get_data_report_work_defect_week', 'reportController@get_data_report_work_defect_week')->middleware('auth');

Route::post('/summary_report/Del_Transection/{job_detail_id}/{order_screen_id}', 'summary_report@Del_Transection');
//report รับ- ส่งงาน
Route::get('report/recieve_send', 'reportController@indexRecieveSend')->middleware('auth');
Route::get('report/recieve_send_today', 'reportController@indexRecieveSendToday')->middleware('auth');
Route::get('/table/report/re_send', 'reportController@getAjexRecSend')->middleware('auth');
Route::get('/table/report/re_send_today', 'reportController@getAjexRecSendToday')->middleware('auth');
Route::get('report/transport_complete_before', function () {
    return view('report.report_recieve_send');
})->middleware('auth');

//report งานแก้รวม ปรียบเทียบ2เดือน
Route::get('/table/report_employee/unit', 'reportController@indexUnitEmployee')->middleware('auth');
Route::get('/table/report_employee/unit/getajax_unit', 'reportController@getajax_unit')->middleware('auth');

//งานแก้รายคน ตามประเภทงานแก้
Route::get('/table/report_employee/work_defect', 'reportController@indexUnitEmployeeWorkdefect')->middleware('auth');
Route::get('/getEmployee_report_workDefect', 'reportController@getEmployee_report_workDefect')->middleware('auth');
Route::get('/table/report_employee/unit/getajax_unit_workDefect', 'reportController@getajax_unit_workDefect')->middleware('auth');


// รายงาน report_t01 =====================================================
Route::get('report/rejected', 'reportController@rt01_rejected')->middleware('auth');

Route::get('report/modify', 'reportController@rt01_modify')->middleware('auth');
Route::get('table/report_work_modify', 'datatable_controller@report_work_modify')->middleware('auth');

Route::get('report/delay', 'reportController@rt01_delay')->middleware('auth');
Route::get('table/report_work_delay', 'datatable_controller@report_work_delay')->middleware('auth');

//-----------------------------------------------------------------------
//files
Route::get('files', 'manual_controller@index')->middleware('auth'); 
Route::get('/table/manual', 'manual_controller@show')->middleware('auth'); 
Route::post('/manual/add', 'manual_controller@add')->middleware('auth'); 
Route::post('/manual/edit', 'manual_controller@edit')->middleware('auth'); 
Route::get('/delete_manual', 'manual_controller@delete')->middleware('auth');
Route::get('/delete_status/{id}', 'manual_controller@updateStatus')->middleware('auth');
Route::post('/edit_conclusion_general/deletefile', 'new_screen_controller@deleteFile')->middleware('auth');
Route::get('/auto_delete_file', 'manual_controller@auto_delete_file')->middleware('auth');



