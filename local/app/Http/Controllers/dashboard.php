<?php

namespace App\Http\Controllers;

use App\department;
use App\job;
use App\dashboardModail;
use App\type_Branch;
use DB;
use DataTables;
use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function main_dashboard()
    {      
        //นับตามชนิดงาน => 1กล่อง 5ฟัน 2ชนิด นับ 2
        $order_refbarcode = DB::select("SELECT
                                            ref2.*,
                                            Employee.ID_type_Branch,
                                            type_Branch.lab 
                                        FROM
                                            (
                                        SELECT    
                                            Count( ref_order_teeth_screen.OrderID ) AS count,
                                            ref_order_teeth_screen.OrderID,
                                            ref_order_teeth_screen.`group`,
                                            DATE_FORMAT( ref_order_teeth_screen.created_at, '%d/%m/%Y' ) AS date_format_,
                                            ref_order_teeth_screen.created_at 
                                        FROM
                                            (
                                        SELECT      
                                            order_teeth_screen.OrderID,
                                            type_of_product.`group`,
                                            order_teeth_screen.created_at 
                                        FROM
                                            order_teeth_screen
                                            LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID 
                                        GROUP BY
                                            order_teeth_screen.OrderID,
                                            type_of_product.`group` 
                                            ) AS ref_order_teeth_screen
                                            RIGHT JOIN ( SELECT order_screen.ID FROM order_screen WHERE 
                                            order_screen.RefBarcode IS NOT NULL) AS order_screen ON order_screen.ID = ref_order_teeth_screen.OrderID 
                                        GROUP BY
                                            ref_order_teeth_screen.OrderID 
                                            ) AS ref2
                                            RIGHT JOIN screen ON screen.ID_order_screen = ref2.OrderID
                                            LEFT JOIN Employee ON screen.EmployeeID = Employee.ID_user
                                            LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
                                        WHERE
                                            ref2.OrderID IS NOT NULL 
                                            AND ref2.date_format_ IS NOT NULL 
                                            AND DATE_FORMAT( ref2.created_at, '%Y%m%d' ) > DATE_FORMAT( DATE_ADD( NOW( ), INTERVAL - 37 DAY ), '%Y%m%d' ) 
                                        GROUP BY
                                            screen.ID_order_screen 
                                        ORDER BY
                                            ref2.created_at ASC");

        for ($cc = 37; $cc >= 1 ; $cc--) {
            $date30s_[] = date("d/m", strtotime("-".$cc." days"));
        }
        for ($cc = 37; $cc >= 1 ; $cc--) {
            $date30Y_[] = date("d/m/Y", strtotime("-".$cc." days"));
        }

        for ($cc = 30; $cc >= 1 ; $cc--) {
            $date30s_average[] = date("d/m", strtotime("-".$cc." days"));
        }
        for ($cc = 30; $cc >= 1 ; $cc--) {
            $date30Y_average[] = date("d/m/Y", strtotime("-".$cc." days"));
        }
    

        // งานแก้ตามประเภทสินค้า (30วันย้อนหลัง) bkk30days
        for ($i=0; $i <9 ; $i++) {
           for ($j=0; $j <37 ; $j++) {
                $product[$i][$j] = (float)(0.0);
           }
        } // ประกาศตัวแปร default ค่า = 0.0
    
            foreach ($order_refbarcode as $key => $order) {
                if ($order->lab == 'กทม.') {

                    for ($product_count = 1; $product_count <= 9 ; $product_count++) { 

                        if ($order->group == $product_count) {

                            for ($cc = 0; $cc < 37 ; $cc++) {

                                if($date30Y_[$cc] == $order->date_format_ ){
                                    $product[$product_count-1][$cc] = $product[$product_count-1][$cc] + (float)($order->count);
                                }  
                            }
                        }
                    }
                }
            }
         

            for ($i=0; $i <9 ; $i++) { 
                for ($j=0; $j <30 ; $j++) { 
                     $product7s[$i][$j] = (float)(0.0);
                }
             }
             
            
                for ($product_count = 1; $product_count <= 9 ; $product_count++) { 
                    for ($cc = 0; $cc < 30 ; $cc++) {
                        $sum7days = 0.0;
                        for ($days7=0; $days7 <7; $days7++) { 
                            $sum7days = $sum7days + (float)($product[$product_count-1][$cc+$days7]);
                        }
                        $product7s[$product_count-1][$cc] =  (float)($sum7days/7.0);
                    }
                }
                

            for ($i=0; $i < 30; $i++) {
                
                    $json_data[$i]=array(
                        $date30s_average[$i],
                        doubleval( number_format($product7s[0][$i], 2) ),
                        doubleval( number_format($product7s[1][$i], 2) ),
                        doubleval( number_format($product7s[2][$i], 2) ),
                        doubleval( number_format($product7s[3][$i], 2) ),
                        doubleval( number_format($product7s[4][$i], 2) ),
                        doubleval( number_format($product7s[5][$i], 2) ),
                        doubleval( number_format($product7s[6][$i], 2) ),
                        doubleval( number_format($product7s[7][$i], 2) ),
                        doubleval( number_format($product7s[8][$i], 2) ),
                    );
                
            }
            
     $bkk30days= json_encode($json_data);


        // งานแก้ตามประเภทสินค้า (30วันย้อนหลัง) pattaya30days
        for ($i=0; $i <9 ; $i++) { 
            for ($j=0; $j <37 ; $j++) { 
                 $product[$i][$j] = (float)(0.0);
            }
         } // ประกาศตัวแปร default ค่า = 0.0
     
             foreach ($order_refbarcode as $key => $order) {
                 if ($order->lab == 'พัทยา') {
 
                     for ($product_count = 1; $product_count <= 9 ; $product_count++) { 
 
                         if ($order->group == $product_count) {
 
                             for ($cc = 0; $cc < 37 ; $cc++) {
 
                                 if($date30Y_[$cc] == $order->date_format_ ){
                                     $product[$product_count-1][$cc] = $product[$product_count-1][$cc] + (float)($order->count);
                                 }  
                             }
                         }
                     }
                 }
             }
          
 
             for ($i=0; $i <9 ; $i++) { 
                 for ($j=0; $j <30 ; $j++) { 
                      $product7s[$i][$j] = (float)(0.0);
                 }
              }
              
             
                 for ($product_count = 1; $product_count <= 9 ; $product_count++) { 
                     for ($cc = 0; $cc < 30 ; $cc++) {
                         $sum7days = 0.0;
                         for ($days7=0; $days7 <7; $days7++) { 
                             $sum7days = $sum7days + (float)($product[$product_count-1][$cc+$days7]);
                         }
                         $product7s[$product_count-1][$cc] =  (float)($sum7days/7.0);
                     }
                 }
                 
 
             for ($i=0; $i < 30; $i++) {
                 
                     $json_data[$i]=array(
                         $date30s_average[$i],
                         doubleval( number_format($product7s[0][$i], 2) ),
                         doubleval( number_format($product7s[1][$i], 2) ),
                         doubleval( number_format($product7s[2][$i], 2) ),
                         doubleval( number_format($product7s[3][$i], 2) ),
                         doubleval( number_format($product7s[4][$i], 2) ),
                         doubleval( number_format($product7s[5][$i], 2) ),
                         doubleval( number_format($product7s[6][$i], 2) ),
                         doubleval( number_format($product7s[7][$i], 2) ),
                         doubleval( number_format($product7s[8][$i], 2) ),
                     );
                 
             }

        $pattaya30days= json_encode($json_data);


        // งานแก้ตามประเภทสินค้า (30วันย้อนหลัง) hatyai30days
        for ($i=0; $i <9 ; $i++) { 
            for ($j=0; $j <37 ; $j++) { 
                 $product[$i][$j] = (float)(0.0);
            }
         } // ประกาศตัวแปร default ค่า = 0.0
     
             foreach ($order_refbarcode as $key => $order) {
                 if ($order->lab == 'หาดใหญ่') {
 
                     for ($product_count = 1; $product_count <= 9 ; $product_count++) { 
 
                         if ($order->group == $product_count) {
 
                             for ($cc = 0; $cc < 37 ; $cc++) {
 
                                 if($date30Y_[$cc] == $order->date_format_ ){
                                     $product[$product_count-1][$cc] = $product[$product_count-1][$cc] + (float)($order->count);
                                 }  
                             }
                         }
                     }
                 }
             }
          
 
             for ($i=0; $i <9 ; $i++) { 
                 for ($j=0; $j <30 ; $j++) { 
                      $product7s[$i][$j] = (float)(0.0);
                 }
              }
              
             
                 for ($product_count = 1; $product_count <= 9 ; $product_count++) { 
                     for ($cc = 0; $cc < 30 ; $cc++) {
                         $sum7days = 0.0;
                         for ($days7=0; $days7 <7; $days7++) { 
                             $sum7days = $sum7days + (float)($product[$product_count-1][$cc+$days7]);
                         }
                         $product7s[$product_count-1][$cc] =  (float)($sum7days/7.0);
                     }
                 }
                 
 
             for ($i=0; $i < 30; $i++) {
                 
                     $json_data[$i]=array(
                         $date30s_average[$i],
                         doubleval( number_format($product7s[0][$i], 2) ),
                         doubleval( number_format($product7s[1][$i], 2) ),
                         doubleval( number_format($product7s[2][$i], 2) ),
                         doubleval( number_format($product7s[3][$i], 2) ),
                         doubleval( number_format($product7s[4][$i], 2) ),
                         doubleval( number_format($product7s[5][$i], 2) ),
                         doubleval( number_format($product7s[6][$i], 2) ),
                         doubleval( number_format($product7s[7][$i], 2) ),
                         doubleval( number_format($product7s[8][$i], 2) ),
                     );
                 
             }
    
        $hatyai30days= json_encode($json_data);
     
     
        return view('dashboard',compact('bkk30days','pattaya30days','hatyai30days'));
    }

    public function index()
    {
        $data_department = department::select_all();
        $data_job = job::select_for_dashboard();
        // test
        return view('dashboard_processDetail', ['data_department' => $data_department,

                'data_job' => $data_job, ]);
    }

    //งานที่ออกวันนี้
    public function work_transportDay_today(){
        $origDate = now();
        $newDate = date("d/m/Y", strtotime($origDate));

        $type_Branch = type_Branch::groupBy('type_Branch.lab')
            ->orderBy('type_Branch.lab')
        ->get();

        $department = DB::select("SELECT 
            department.ID AS department_id,
            department.Name AS department_name,
            department.order_dashboard 

            FROM department 

            WHERE 1
                AND department.order_dashboard IS NOT NULL 
                
            ORDER BY 
                department.order_dashboard
        ");

        $count_job = DB::select("SELECT
                Count( order_screen.DeliverDate ) AS count_order,
                type_Branch.lab,
                order_screen.job_current_department,
                order_screen.BranchID 
            FROM
                order_screen
                LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID 
            WHERE
                order_screen.DeliverDate = '$newDate' 
                AND   (
                ( ( `order_screen`.`job_current_department` <> 997 ) OR
                isnull( `order_screen`.`job_current_department` ) ) 
                AND ( `order_screen`.`updated_at` IS NOT NULL ) 
                AND isnull( `order_screen`.`deleted_at` ) 
                ) 
            GROUP BY
                order_screen.DeliverDate,
                type_Branch.lab,
                order_screen.job_current_department
            ORDER BY
                type_Branch.lab ASC;
        ");

        
        return response()->json([
            'count_job'=>$count_job,
            'type_Branch'=>$type_Branch,
            'department'=>$department
        ]);
    }

    //งานที่ค้างอยู่ในแผนกเกิน 1 วัน 
    public function work_transportDay_yesterday(){
        // $newDate = date("d/m/Y", strtotime("-1 days"));
          $count_job = DB::select("SELECT
                                        Count( job.ID_order_screen ) as count_order,
                                        job.date_time_start,
                                        job.job_current_department,
                                        screen.EmployeeID,
                                        type_Branch.lab,
                                        department.`Name` 
                                    FROM
                                        job
                                        LEFT JOIN ( SELECT screen.ID_order_screen, screen.EmployeeID FROM screen GROUP BY screen.ID_order_screen ) 
                                            AS screen ON screen.ID_order_screen = job.ID_order_screen
                                        LEFT JOIN Employee ON Employee.ID_user = screen.EmployeeID
                                        LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID
                                        LEFT JOIN department ON job.job_current_department = department.ID 
                                    WHERE
                                        job.job_current_department <> 997 
                                        AND job.date_time_start < now( ) - INTERVAL 24 HOUR 
                                    GROUP BY
                                        job.job_current_department,
                                        type_Branch.lab");

            $count_job_wait_screen = DB::select("SELECT
                                        order_screen.Barcode,
                                        Count( order_screen.Barcode ) AS count_order,
                                        order_screen.created_at,
                                        order_screen.job_current_department,
                                        order_screen.BranchID,
                                        type_Branch.lab 
                                    FROM
                                        order_screen
                                        LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID 
                                    WHERE
                                    order_screen.job_current_department IS NULL
                                    GROUP BY
                                        order_screen.job_current_department,
                                        type_Branch.lab
                                        ");
        return  array($count_job ,$count_job_wait_screen ); 
    }

    // งานรับเข้า KEY-IN (เช้า-บ่าย) สาขา
    public function keyin_branch(){


        $active_branch = DB::select("SELECT
                type_Branch.ID,
                type_Branch.`Name`,
                company.fullname,
                type_Branch.lab,
                type_Branch.active_branch 
            FROM
                type_Branch
                LEFT JOIN company ON type_Branch.companyID = company.ID 
            WHERE
                type_Branch.active_branch = 'active' 
            GROUP BY
                type_Branch.`Name` 
            ORDER BY
                type_Branch.ID"
        );

        $date_today = date("d/m/Y", strtotime(now()));
        $keyin_today = DB::select("SELECT
                order_screen.Barcode,
                order_screen.StartDate,
                order_screen.created_at,
                DATE_FORMAT( order_screen.created_at, '%d/%m/%Y' ),
                order_screen.BranchID,
                type_Branch.`Name` 
            FROM
                order_screen
                LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID 
            WHERE
                DATE_FORMAT( order_screen.created_at, '%d/%m/%Y' ) = '$date_today' 
            ORDER BY
                type_Branch.`Name` ASC"
        );


        $today_active_branchAM = array(0);  //เซ็ตค่าเริ่มต้นเป็น 0 
        $today_active_branchPM = array(0);  //เซ็ตค่าเริ่มต้นเป็น 0 
        for ($i=0; $i < count($active_branch) ; $i++) { 
            $today_active_branchAM[$i] = 0;
            $today_active_branchPM[$i] = 0;
        }
        foreach ($active_branch as $key2 => $act_branch) {
            foreach ($keyin_today as $key => $today) {

                if ($today->Name == $act_branch->Name) {     //id สาขา
                    if(date('A', strtotime($today->created_at)) == 'AM') {
                        $today_active_branchAM[$key2]  = $today_active_branchAM[$key2] +1;
                    }
                    else if(date('A', strtotime($today->created_at)) == 'PM'){
                        $today_active_branchPM[$key2]  = $today_active_branchPM[$key2] +1;
                    }
                }

            }
        }
        ////////////////////////////////////////////////////////////////////////////// 
        //endtoday

        $yesterday = date("d/m/Y", strtotime("-1 days"));

        $keyin_yesterday = DB::select("SELECT
                order_screen.Barcode,
                order_screen.StartDate,
                order_screen.created_at,
                DATE_FORMAT( order_screen.created_at, '%d/%m/%Y' ),
                order_screen.BranchID,
                type_Branch.`Name` 
            FROM
                order_screen
                LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID 
            WHERE
                DATE_FORMAT( order_screen.created_at, '%d/%m/%Y' ) = '$yesterday' 
            ORDER BY
                type_Branch.`Name` ASC"
        );


        $yesterday_active_branchAM = array(0);  //เซ็ตค่าเริ่มต้นเป็น 0 
        $yesterday_active_branchPM = array(0);  //เซ็ตค่าเริ่มต้นเป็น 0 

        for ($i=0; $i < count($active_branch) ; $i++) { 
            $yesterday_active_branchAM[$i] = 0;
            $yesterday_active_branchPM[$i] = 0;
        }
        
        foreach ($active_branch as $key2 => $act_branch) {
            
            foreach ($keyin_yesterday as $key => $yesterday) {

                if ($yesterday->Name == $act_branch->Name) {     //id สาขา
                    if(date('A', strtotime($yesterday->created_at)) == 'AM') {
                        $yesterday_active_branchAM[$key2]  = $yesterday_active_branchAM[$key2] +1;
                    }
                    else if(date('A', strtotime($yesterday->created_at)) == 'PM'){
                        $yesterday_active_branchPM[$key2]  = $yesterday_active_branchPM[$key2] +1;
                    }
                }

            }
        }

        ///////////////////////////////////////////
        // end yesterday

        $name_branch=array(); //ชื่อสาขา
        foreach ($active_branch as $key => $value) { 
            $name_branch[$key] = $value->Name;
        }

        for ($i=0; $i < count($active_branch) ; $i++) { 
            $json_data[$i]=array(
                $name_branch[$i],
                $yesterday_active_branchAM[$i],
                $yesterday_active_branchPM[$i], 
                $today_active_branchAM[$i],
                $today_active_branchPM[$i],
            );
        }

        array_unshift($json_data,array('','เมื่อวาน-เช้า','เมื่อวาน-บ่าย','วันนี้-เช้า','วันนี้-บ่าย'));

        return $json_data;
    }

    // งานรับเข้า screenแล้ว (เช้า-บ่าย) แลป
    public function screen_lab(){
        $today = date("d/m/Y", strtotime(now()));
        $yesterday = date("d/m/Y", strtotime("-1 days"));

        //-------------------------------------- test choice ------------------------------//
            $type_Branch = type_Branch::groupBy('type_Branch.lab')
                ->orderBy('type_Branch.lab')
            ->get();

            $screen_lab_today_test = DB::select("SELECT
                COUNT( DISTINCT screen_choice_test.ID_order_screen ) AS count,
                screen_choice_test.EmployeeID,
                screen_choice_test.ID_order_screen,
                Employee.ID_type_Branch,
                screen_choice_test.created_at,
                
                TIME_FORMAT( screen_choice_test.created_at, '%p' ) AS period_en,
                
                CASE
                    WHEN TIME_FORMAT( screen_choice_test.created_at, '%p' ) = 'AM' THEN 'เช้า' 
                    WHEN TIME_FORMAT( screen_choice_test.created_at, '%p' ) = 'PM' THEN 'บ่าย' 
                END AS period_th,
                
                type_Branch.lab
                
                FROM
                    screen_choice_test
                    LEFT JOIN Employee ON screen_choice_test.EmployeeID = Employee.ID_user
                    LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
                WHERE
                    DATE_FORMAT( screen_choice_test.created_at, '%d/%m/%Y' ) = '$today'
                    -- AND DATE_FORMAT( screen_choice_test.created_at, '%p' ) = 'AM'
                    
                GROUP BY
                    type_Branch.lab,
                    period_en
                    
                ORDER BY
                    type_Branch.lab ASC,
                    screen_choice_test.created_at ASC
                    
            ", []);

            $screen_lab_yesterday_test = DB::select("SELECT
                COUNT( DISTINCT screen_choice_test.ID_order_screen ) AS count,
                screen_choice_test.EmployeeID,
                screen_choice_test.ID_order_screen,
                Employee.ID_type_Branch,
                screen_choice_test.created_at,

                TIME_FORMAT( screen_choice_test.created_at, '%p' ) AS period_,

                CASE
                    WHEN TIME_FORMAT( screen_choice_test.created_at, '%p' ) = 'AM' THEN 'เช้า' 
                    WHEN TIME_FORMAT( screen_choice_test.created_at, '%p' ) = 'PM' THEN 'บ่าย' 
                END AS period_,

                type_Branch.lab

                FROM
                    screen_choice_test
                    LEFT JOIN Employee ON screen_choice_test.EmployeeID = Employee.ID_user
                    LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
                WHERE
                    DATE_FORMAT( screen_choice_test.created_at, '%d/%m/%Y' ) = '$yesterday'
                    
                GROUP BY
                    type_Branch.lab,
                    period_
                    
                ORDER BY
                    type_Branch.lab ASC,
                    screen_choice_test.created_at ASC
                    
            ", []);
        //-------------------------------------- test choice ------------------------------//
        
        // start today //
        $screen_lab_today = DB::select("SELECT
                screen.ID_order_screen,
                screen.created_at,
                screen.EmployeeID,
                Employee.ID_type_Branch,
                Employee.ID_company,
                type_Branch.`Name`,
                type_Branch.lab 
            FROM
                screen
                LEFT JOIN Employee ON screen.EmployeeID = Employee.ID_user
                LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
            WHERE
                DATE_FORMAT( screen.created_at, '%d/%m/%Y' ) = '$today' 
            GROUP BY
                screen.ID_order_screen
        ");

        $arr_today_AM = [];
        $arr_today_PM = [];
        foreach ($type_Branch as $i=>$branch) {
            $arr_today_AM[$i] = 0;
            $arr_today_PM[$i] = 0;
        }

        foreach ($type_Branch as $num_branch=>$branch) {
            foreach ($screen_lab_today as $today_) {
                if($today_->lab == $branch->lab) {
                    if(date('A', strtotime($today_->created_at)) == 'AM') {
                        $arr_today_AM[$num_branch]  = $arr_today_AM[$num_branch] +1;
                    }
                    else if(date('A', strtotime($today_->created_at)) == 'PM'){
                        $arr_today_PM[$num_branch]  = $arr_today_PM[$num_branch] +1;
                    }
                } 
            }
        }
        // end today //

        // start yesterday //
        $screen_lab_yesterday = DB::select("SELECT
                screen.ID_order_screen,
                screen.created_at,
                screen.EmployeeID,
                Employee.ID_type_Branch,
                Employee.ID_company,
                type_Branch.`Name`,
                type_Branch.lab 
            FROM
                screen
                LEFT JOIN Employee ON screen.EmployeeID = Employee.ID_user
                LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
            WHERE
                DATE_FORMAT( screen.created_at, '%d/%m/%Y' ) = '$yesterday' 
            GROUP BY
            screen.ID_order_screen
        ");

        $arr_yesterday_AM = [];
        $arr_yesterday_PM = [];
        foreach ($type_Branch as $i=>$branch) {
            $arr_yesterday_AM[$i] = 0;
            $arr_yesterday_PM[$i] = 0;
        }

        foreach ($type_Branch as $num_branch=>$branch) {
            foreach ($screen_lab_yesterday as $yesterday_) {
                if($yesterday_->lab == $branch->lab) {
                    if(date('A', strtotime($yesterday_->created_at)) == 'AM') {
                        $arr_yesterday_AM[$num_branch]  = $arr_yesterday_AM[$num_branch] +1;
                    }
                    else if(date('A', strtotime($yesterday_->created_at)) == 'PM'){
                        $arr_yesterday_PM[$num_branch]  = $arr_yesterday_PM[$num_branch] +1;
                    }
                } 
            }
        }
        // start yesterday //

        $arr_branch = [];
        foreach ($type_Branch as $i=>$branch) {
            $arr_branch[$i] = $branch->lab;
        }
        // return $arr_yesterday_AM;

        
        for ($i=0 ; $i < count($type_Branch); $i++) {
            $arr_data[$i]=array(
                $arr_branch[$i],
                $arr_yesterday_AM[$i],
                $arr_yesterday_PM[$i],
                $arr_today_AM[$i],
                $arr_today_PM[$i]
            );
        } 
        // return $arr_data;
        array_unshift($arr_data,array("","เมื่อวาน-เช้า","เมื่อวาน-บ่าย","วันนี้-เช้า","วันนี้-บ่าย"));

        return response()->json([
            'arr_data'=>$arr_data,
        ]);
        // return $json_data;
    }
    //backup
    public function screen_lab_sek(){

        $today = date("d/m/Y", strtotime(now()));

        $screen_lab_today = DB::select("SELECT
                                            screen.ID_order_screen,
                                            screen.created_at,
                                            screen.EmployeeID,
                                            Employee.ID_type_Branch,
                                            Employee.ID_company,
                                            type_Branch.`Name`,
                                            type_Branch.lab 
                                        FROM
                                            screen
                                            LEFT JOIN Employee ON screen.EmployeeID = Employee.ID_user
                                            LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
                                        WHERE
                                            DATE_FORMAT( screen.created_at, '%d/%m/%Y' ) = '$today' 
                                        GROUP BY
                                            screen.ID_order_screen");

        $Filter_today = [
            0,    //อนุเสาวรีย์.-เช้า-วันนี้
            0,    //อนุเสาวรีย์.-บ่าย-วันนี้
            0,    //งามวงศ์วาน.-บ่าย-วันนี้
            0,    //งามวงศ์วาน.-เช้า-วันนี้
            0,    //กทม.-เช้า-วันนี้
            0,    //กทม.-บ่าย-วันนี้
            0,    //พัทยา-เช้า-วันนี้
            0,    //พัทยา-บ่าย-วันนี้
            0,    //หาดใหญ่-เช้า-วันนี้
            0     //หาดใหญ่-บ่าย-วันนี้
        ];
        
        foreach ($screen_lab_today as $key => $today) {

           
            if ($today->Name == 'อนุเสาวรีย์') {   //อนุเสาวรีย์
                if(date('A', strtotime($today->created_at)) == 'AM') {
                    $Filter_today[2] = $Filter_today[2] +1;
                    $Filter_today[4] = $Filter_today[4] +1;
                }
                else if(date('A', strtotime($today->created_at)) == 'PM'){
                    $Filter_today[3] = $Filter_today[3] +1;
                    $Filter_today[5] = $Filter_today[5] +1;
                }
            }else
             if ($today->Name == 'งามวงศ์วาน') {   //งามวงศ์วาน
                if(date('A', strtotime($today->created_at)) == 'AM') {
                    $Filter_today[0] = $Filter_today[0] +1;
                    $Filter_today[4] = $Filter_today[4] +1;
                }
                else if(date('A', strtotime($today->created_at)) == 'PM'){
                    $Filter_today[1] = $Filter_today[1] +1;
                    $Filter_today[5] = $Filter_today[5] +1;
                }
            }else
            // if ($today->lab == 'กทม.') {   //กทม
            //     if(date('A', strtotime($today->created_at)) == 'AM') {
            //         $Filter_today[4] = $Filter_today[4] +1;
            //     }
            //     else if(date('A', strtotime($today->created_at)) == 'PM'){
            //         $Filter_today[5] = $Filter_today[5] +1;
            //     }
            // }else
            if ($today->lab == 'พัทยา') {     //พัทยา
                if(date('A', strtotime($today->created_at)) == 'AM') {
                    $Filter_today[6] = $Filter_today[6] +1;
                }
                else if(date('A', strtotime($today->created_at)) == 'PM'){
                    $Filter_today[7] = $Filter_today[7] +1;
                }
            }else
            if ($today->lab == 'หาดใหญ่') {     //หาดใหญ่
                if(date('A', strtotime($today->created_at)) == 'AM') {
                    $Filter_today[8] = $Filter_today[8] +1;
                }
                else if(date('A', strtotime($today->created_at)) == 'PM'){
                    $Filter_today[9] = $Filter_today[9] +1;
                }
            }
        }
        
        ////////////////////////////////////////////////////////////////////////////// 
        //endtoday

        $yesterday = date("d/m/Y", strtotime("-1 days"));

        $screen_lab_yesterday = DB::select("SELECT
                screen.ID_order_screen,
                screen.created_at,
                screen.EmployeeID,
                Employee.ID_type_Branch,
                Employee.ID_company,
                type_Branch.`Name`,
                type_Branch.lab 
            FROM
                screen
                LEFT JOIN Employee ON screen.EmployeeID = Employee.ID_user
                LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
            WHERE
                DATE_FORMAT( screen.created_at, '%d/%m/%Y' ) = '$yesterday' 
            GROUP BY
                screen.ID_order_screen");
        
        
        
        

        $Filter_yesterday = [
            0,    //อนุเสาวรีย์.-เช้า-เมื่อวาน
            0,    //อนุเสาวรีย์.-บ่าย-เมื่อวาน
            0,    //งามวงศ์วาน.-เช้า-เมื่อวาน
            0,    //งามวงศ์วาน.-บ่าย-เมื่อวาน
            0,    //กทม.-เช้า-เมื่อวาน
            0,    //กทม.-บ่าย-เมื่อวาน
            0,    //พัทยา-เช้า-เมื่อวาน
            0,    //พัทยา-บ่าย-เมื่อวาน
            0,    //หาดใหญ่-เช้า-เมื่อวาน
            0     //หาดใหญ่-บ่าย-เมื่อวาน
        ];
        
        foreach ($screen_lab_yesterday as $key => $yesterday) {

            
            if ($yesterday->Name == 'อนุเสาวรีย์') {   //อนุเสาวรีย์
                if(date('A', strtotime($yesterday->created_at)) == 'AM') {
                    $Filter_yesterday[2] = $Filter_yesterday[2] +1;
                    $Filter_yesterday[4] = $Filter_yesterday[4] +1;
                }
                else if(date('A', strtotime($yesterday->created_at)) == 'PM'){
                    $Filter_yesterday[3] = $Filter_yesterday[3] +1;
                    $Filter_yesterday[5] = $Filter_yesterday[5] +1;
                }
            }else
            if ($yesterday->Name == 'งามวงศ์วาน') {   //งามวงศ์วาน
                if(date('A', strtotime($yesterday->created_at)) == 'AM') {
                    $Filter_yesterday[0] = $Filter_yesterday[0] +1;
                    $Filter_yesterday[4] = $Filter_yesterday[4] +1;
                }
                else if(date('A', strtotime($yesterday->created_at)) == 'PM'){
                    $Filter_yesterday[1] = $Filter_yesterday[1] +1;
                    $Filter_yesterday[5] = $Filter_yesterday[5] +1;
                }
            }else
            // if ($yesterday->lab == 'กทม.') {   //กทม
            //     if(date('A', strtotime($yesterday->created_at)) == 'AM') {
            //         $Filter_yesterday[4] = $Filter_yesterday[4] +1;
            //     }
            //     else if(date('A', strtotime($yesterday->created_at)) == 'PM'){
            //         $Filter_yesterday[5] = $Filter_yesterday[5] +1;
            //     }
            // }else
            if ($yesterday->lab == 'พัทยา') {     //พัทยา
                if(date('A', strtotime($yesterday->created_at)) == 'AM') {
                    $Filter_yesterday[6] = $Filter_yesterday[6] +1;
                }
                else if(date('A', strtotime($yesterday->created_at)) == 'PM'){
                    $Filter_yesterday[7] = $Filter_yesterday[7] +1;
                }
            }else
            if ($yesterday->lab == 'หาดใหญ่') {     //หาดใหญ่
                if(date('A', strtotime($yesterday->created_at)) == 'AM') {
                    $Filter_yesterday[8] = $Filter_yesterday[8] +1;
                }
                else if(date('A', strtotime($yesterday->created_at)) == 'PM'){
                    $Filter_yesterday[9] = $Filter_yesterday[9] +1;
                }
            }
        }
        

        // return $Filter_yesterday;
        $name_branch=array(
            "อนุเสาวรีย์",
            "งามวงศ์วาน",
            "กทม.",
            "พัทยา",
            "หาดใหญ่"
        );

        $j=0;
        for ($i=0 ; $i < 5; $i++) {
            $json_data[$i]=array(
                $name_branch[$i],
                intval($Filter_yesterday[$j]),
                intval($Filter_yesterday[$j+1]),
                intval($Filter_today[$j]),
                intval($Filter_today[$j+1])
            );
            $j=$j+2;
        }

        array_unshift($json_data,array("","เมื่อวาน-เช้า","เมื่อวาน-บ่าย","วันนี้-เช้า","วันนี้-บ่าย"));
        // $json= json_encode($json_data);

        return response()->json([
            'json_data'=> $json_data
        ]);
        // return $json_data;
    }

    // งานเลื่อน กทม.พัทยา หาดใหญ่
    public function pie_work_late(Request $request){
       $work_late =   DB::select("SELECT
                                    order_screen.Barcode,
                                    Count( order_screen.ddlWorkLate ) as count,
                                    order_screen.ddlWorkLate,
                                    order_screen.job_current_department,
                                    work_defect.detail_type,
                                    order_screen.BranchID,
                                    type_Branch.`Name`,
                                    type_Branch.lab 
                                FROM
                                    order_screen
                                    LEFT JOIN work_defect ON order_screen.ddlWorkLate = work_defect.id
                                    LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID 
                                WHERE
                                (
                                    ( ( `order_screen`.`job_current_department` <> 997 ) OR
                                    isnull( `order_screen`.`job_current_department` ) ) 
                                    AND ( `order_screen`.`updated_at` IS NOT NULL ) 
                                    AND isnull( `order_screen`.`deleted_at` ) 
                                )
                                    AND order_screen.ddlWorkLate <> '' 
                                    AND order_screen.ddlWorkLate > 26 
                                GROUP BY
                                    order_screen.ddlWorkLate,
                                    type_Branch.lab 
                                ORDER BY
                                    Count( order_screen.ddlWorkLate ) DESC;");

        $i = 0;
        $label = ['ไม่มี','ไม่มี','ไม่มี'];
        $count = [0,0,0];
        
        foreach ($work_late as $key => $value) {
            if ($value->lab == $request->lab && $i < 3) {
                $label[$i]=$value->detail_type;
                $count[$i]=$value->count;
                $i++;
            }
            
        }
        
        return array($label,$count);


    }

    //งานติดต่อหมอ
    public function pie_call_doctor(Request $request){
        $call_doctor = DB::select("SELECT
                                        count( temp.status_job_detail ) as count,
                                        temp.lab,
                                        temp.status_job_detail 
                                    FROM
                                        (
                                    SELECT
                                        order_screen.ID,
                                        order_screen.Barcode,
                                        order_screen.job_current_sub_department,
                                        job_detail.status_job_detail,
                                        order_screen.BranchID,
                                        type_Branch.`Name`,
                                        type_Branch.lab 
                                    FROM
                                        order_screen
                                        LEFT JOIN ( SELECT job_detail.ID_order_screen, job_detail.status_job_detail 
                                            FROM job_detail WHERE job_detail.Sub_DepartmentID = 10 ) 
                                            AS job_detail ON order_screen.ID = job_detail.ID_order_screen
                                        LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID 
                                    WHERE
                                        order_screen.job_current_sub_department = 10 
                                    GROUP BY
                                        order_screen.ID 
                                        ) AS temp 
                                    GROUP BY
                                        temp.lab,
                                        temp.status_job_detail;");

            
            $count = [0,0];
            $i = 0;
            foreach ($call_doctor as $key => $value) {
                if ($value->lab == $request->lab && $value->status_job_detail == 6 ) {
                    $label[$i]= "บริการรอติดต่อหมอ";
                    $count[$i]=$value->count;
                    $i++;
                }
                if ($value->lab == $request->lab && $value->status_job_detail == 7 ) {
                    $label[$i]= "บริการติดต่อหมอแล้ว";
                    $count[$i]=$value->count;
                    $i++;
                }
            }
            return array($label,$count);                                  
    }

    //ประเภทงาน(ปกติ ด่วน)
    public function type_of_work(Request $request){
              $type_of_work = DB::select("SELECT
                                            order_screen.Barcode,
                                            order_screen.DeliverType,
                                            order_screen.BranchID,
                                            type_Branch.`Name`,
                                            type_Branch.lab,
                                            count( order_screen.DeliverType ) as count,
                                            type_Deliver.`Name` AS type_deliver 
                                        FROM
                                            order_screen
                                            LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                                            LEFT JOIN type_Deliver ON order_screen.DeliverType = type_Deliver.ID 
                                        WHERE
                                            (
                                            ( ( `order_screen`.`job_current_department` <> 997 ) OR
                                            isnull( `order_screen`.`job_current_department` ) ) 
                                            AND ( `order_screen`.`updated_at` IS NOT NULL ) 
                                            AND isnull( `order_screen`.`deleted_at` ) 
                                            ) 
                                        GROUP BY
                                            type_Deliver.`Name`,
                                            type_Branch.lab 
                                        ORDER BY
                                            count( order_screen.DeliverType ) DESC ");

        $label = ['ไม่มี','ไม่มี','ไม่มี'];
        $count = [0,0,0];

                    $i = 0;
                    foreach ($type_of_work as $key => $value) {
                        if ($value->lab == $request->lab && $i < 3) {
                            $label[$i]=$value->type_deliver;
                            $count[$i]=$value->count;
                            $i++;
                        }
                        
                    }
                    return array($label,$count);                                  
    }

    // งานในระบบ
    public function order_processing(Request $request){

        $order_processing = DB::select("SELECT sum( count ) as count, lab, `group`
                                        FROM (
                                        SELECT
                                            order_teeth_screen.OrderID,
                                            Count( order_teeth_screen.TeethID ) AS count,
                                            order_teeth_screen.TeethID,
                                            order_teeth_screen.TypeOfProductID,
                                            order_screen.job_current_department,
                                            screen.EmployeeID,
                                            Employee.ID_type_Branch,
                                            type_Branch.lab,
                                            type_of_product.`group` 
                                        FROM
                                            order_teeth_screen
                                            LEFT JOIN order_screen ON order_screen.ID = order_teeth_screen.OrderID
                                            LEFT JOIN ( SELECT screen.EmployeeID, screen.ID_order_screen FROM screen GROUP BY screen.ID_order_screen ) AS screen ON screen.ID_order_screen = order_teeth_screen.OrderID
                                            LEFT JOIN Employee ON Employee.ID_user = screen.EmployeeID
                                            LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID
                                            LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID 
                                        WHERE
                                            (
                                            ( ( order_screen.job_current_department <> 997 ) OR isnull( `order_screen`.`job_current_department` ) ) 
                                            AND ( order_screen.updated_at IS NOT NULL ) 
                                            AND isnull( `order_screen`.`deleted_at` ) 
                                            ) 
                                        GROUP BY
                                            order_teeth_screen.TypeOfProductID,
                                            order_teeth_screen.OrderID 
                                            ) AS temp 
                                        GROUP BY
                                            lab,
                                            `group`");
        $name_group = array(
            "PFM",
            "FMC",
            "PINTOOTH",
            "ZIRCONIA",
            "E.MAX",
            "CERAMAGE",
            "TEMP",
            "IMP",
            "Other"
        );

        $product = [0,0,0,0,0,0,0,0,0];
         
        foreach ($order_processing as $key => $order) {
            if ($order->lab == $request->lab) {
                if ($order->group == 1) {
                    $product[0] = $order->count;
                }
                elseif ($order->group == 2) {
                    $product[1] = $order->count;
                } 
                elseif ($order->group == 3) {
                    $product[2] = $order->count;
                } 
                elseif ($order->group == 4) {
                    $product[3] = $order->count;
                } 
                elseif ($order->group == 5) {
                    $product[4] = $order->count;
                } 
                elseif ($order->group == 6) {
                    $product[5] = $order->count;
                } 
                elseif ($order->group == 7) {
                    $product[6] = $order->count;
                } 
                elseif ($order->group == 8) {
                    $product[7] = $order->count;
                }
                elseif ($order->group == 9) {
                    $product[8] = $order->count;
                } 
            }
        }

        for ($i=0; $i < 9; $i++) {
            $json_data[$i]=array(
                $name_group[$i],
                intval($product[$i]),
            );
        }
        
        array_unshift($json_data,array("","งานในระบบ"));
        // $json= json_encode($json_data);

        return $json_data;
    }

    // KEY-in lab
    public function order_refbarcode(){
        $origDate = now();
        $newDate = date("d/m/Y", strtotime($origDate));
        $order_refbarcode = DB::select("SELECT count( temp.ID_order_screen ) as count 
                                                ,temp.lab,type_Branch.`Name` as groupx FROM(
                                        SELECT
                                            screen.ID_order_screen,
                                            Employee.ID_type_Branch,
                                            type_Branch.lab
                                        FROM
                                            screen
                                            LEFT JOIN Employee ON screen.EmployeeID = Employee.ID_user
                                            LEFT JOIN type_Branch ON Employee.ID_type_Branch = type_Branch.ID 
                                        WHERE
                                            DATE_FORMAT( screen.created_at, '%d/%m/%Y' ) = '$newDate' 
                                        GROUP BY
                                            screen.ID_order_screen)
                                            as temp 
                                            LEFT JOIN order_screen on temp.ID_order_screen = order_screen.ID
                                            LEFT JOIN type_Branch on order_screen.BranchID = type_Branch.ID
                                        GROUP BY temp.lab,type_Branch.`Name`");

        $all_lab = DB::select("SELECT
                type_Branch.ID,
                type_Branch.`Name`,
                company.fullname,
                type_Branch.lab,
                type_Branch.active_branch 
            FROM
                type_Branch
                LEFT JOIN company ON type_Branch.companyID = company.ID 
            WHERE
                type_Branch.active_branch = 'active' 
            GROUP BY
                type_Branch.lab
            ORDER BY
                type_Branch.ID
        ");

        $active_branch = DB::select("SELECT
                type_Branch.ID,
                type_Branch.`Name`,
                company.fullname,
                type_Branch.lab,
                type_Branch.active_branch 
            FROM
                type_Branch
                LEFT JOIN company ON type_Branch.companyID = company.ID 
            WHERE
                type_Branch.active_branch = 'active' 
            GROUP BY
                type_Branch.`Name` 
            ORDER BY
                type_Branch.ID"
        );

        $data_lab = array();
        for ($i=0; $i < count($all_lab); $i++) { 
            for ($y=0; $y < count($active_branch) ; $y++) { 
                $data_lab[$all_lab[$i]->lab][$active_branch[$y]->Name] = 0;
            }
        }

        foreach ($order_refbarcode as $key => $order) {
            $data_lab[$order->lab][$order->groupx] = $order->count;
        }
        
        return $data_lab;

        $labbkk = [0,0,0,0,0];
        $labpty = [0,0,0,0,0];
        $labhdy = [0,0,0,0,0];

        foreach ($order_refbarcode as $key => $order) {

            if ($order->lab == 'กทม.') {
                if ($order->groupx == 'อนุเสาวรีย์') {
                    $labbkk[0] = $order->count;
                }
                elseif ($order->groupx == 'งามวงศ์วาน') {
                    $labbkk[1] = $order->count;
                } 
                elseif ($order->groupx == 'พัทยา') {
                    $labbkk[2] = $order->count;
                } 
                elseif ($order->groupx == 'หาดใหญ่') {
                    $labbkk[3] = $order->count;
                } 
                elseif ($order->groupx == 'DC คลองหลวง') {
                    $labbkk[4] = $order->count;
                }
            }
        }

        foreach ($order_refbarcode as $key => $order) {
            if ($order->lab == 'พัทยา') {
                if ($order->groupx == 'อนุเสาวรีย์') {
                    $labpty[0] = $order->count;
                }
                elseif ($order->groupx == 'งามวงศ์วาน') {
                    $labpty[1] = $order->count;
                } 
                elseif ($order->groupx == 'พัทยา') {
                    $labpty[2] = $order->count;
                } 
                elseif ($order->groupx == 'หาดใหญ่') {
                    $labpty[3] = $order->count;
                } 
                elseif ($order->groupx == 'DC คลองหลวง') {
                    $labpty[4] = $order->count;
                }
            }
        }

        foreach ($order_refbarcode as $key => $order) {
            if ($order->lab == 'หาดใหญ่') {
                if ($order->groupx == 'อนุเสาวรีย์') {
                    $labhdy[0] = $order->count;
                }
                elseif ($order->groupx == 'งามวงศ์วาน') {
                    $labhdy[1] = $order->count;
                } 
                elseif ($order->groupx == 'พัทยา') {
                    $labhdy[2] = $order->count;
                } 
                elseif ($order->groupx == 'หาดใหญ่') {
                    $labhdy[3] = $order->count;
                } 
                elseif ($order->groupx == 'DC คลองหลวง') {
                    $labhdy[4] = $order->count;
                }
            }
        }

        return array($labbkk,$labpty,$labhdy);
    }

    

}
