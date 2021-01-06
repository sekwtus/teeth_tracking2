<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use DB;
use Gate;
use App\area;
use App\zone;
use App\order_screen;
use Carbon;

class reportController extends Controller
{

    public function index()
    {

       
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $index_work_defect = DB::select("SELECT
                    work_defect.detail_type
                    FROM
                    work_defect
                    WHERE
                    work_defect.id_type = 2", []);

        $monthYears = DB::select('SELECT monthYears FROM `log_report_workedit_pfm` ', []);
            // $arr_data=array();


        return view('report/work_defect', compact('index_work_defect','monthYears'));
    }

    //todo report งานตีกลับ
    public function rt01_rejected() {
        // $data_monify = DB::select(" SELECT
        //                             YEAR(order_sale.created_at) as YY,
        //                             MONTH(order_sale.created_at) as MM,
        //                             type_of_product.Name as NN,
        //                             count(order_teeth.TeethID) as count_TT,      
        //                             sum(RefBarcode is not null) as count_ref,
        //                             sum(ContiBarcode is not null) as count_con
        //                             FROM
        //                             order_teeth
        //                             LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
        //                             LEFT JOIN order_sale ON order_teeth.OrderID = order_sale.ID
        //                             WHERE
        //                             order_sale.Barcode IS NOT null AND
        //                             YEAR(order_sale.created_at) IN ( 2020 )
        //                             GROUP BY
        //                             order_teeth.TypeOfProductID,
        //                             MM
        //                             order by
        //                             YY,order_teeth.TypeOfProductID,MM", []);



        return view('report.report_t01_rejected');
    }

    //todo report งานแก้
    public function rt01_modify()
    {
        $data_monify = DB::select(" SELECT
                                    YEAR(order_sale.created_at) as YY,
                                    MONTH(order_sale.created_at) as MM,
                                    type_of_product.Name as NN,
                                    count(order_teeth.TeethID) as count_TT,      
                                    sum(RefBarcode is not null) as count_ref,
                                    sum(ContiBarcode is not null) as count_con
                                    FROM
                                    order_teeth
                                    inner JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                                    inner JOIN order_sale ON order_teeth.OrderID = order_sale.ID
                                    WHERE
                                    order_sale.Barcode IS NOT null AND
                                    YEAR(order_sale.created_at) IN ( 2019,2020 )
                                    GROUP BY
                                    order_teeth.TypeOfProductID,
                                    MM
                                    order by
                                    YY,order_teeth.TypeOfProductID,MM
        ", []);

        
        // dd($data_monify);
        return view('report.report_t01_modify' ,compact('data_monify'));
    }

    //todo report งานเลื่อนหลังผลิต
    public function rt01_delay() {
        $data_delay = DB::select("SELECT
            YEAR(order_screen.created_at) as YY,
            MONTH(order_screen.created_at) as MM,
            type_of_product.Name as NN,
            SUM(case when order_screen.Barcode is not null then 1 end) as cc_barcode ,
            SUM(case when order_screen.ContiBarcode is not null then 1 end) as cc_con ,
            SUM(case when order_screen.RefBarcode is not null then 1 end) as cc_ref ,
            work_defect.detail_type as delay_name,
            SUM(case when order_screen.ddlWorkLate in (27,28,29,30,31,32,33,34,35,36,37,38) then 1 end)  as cc_all
            FROM
            order_screen
            left join work_defect on ddlWorkLate = work_defect.id
            inner join order_teeth on order_screen.ID = order_teeth.ScreenID
            left join type_of_product on order_teeth.TypeOfProductID = type_of_product.ID
            WHERE ddlWorkLate in (27,28,29,30,31,32,33,34,35,36,37,38)
            GROUP BY
            order_teeth.TypeOfProductID,ddlWorkLate,MM
            ORDER BY YY,MM
        ", []);
        // dd($data_delay);
        return view('report.report_t01_delay',compact('data_delay'));
    }

    public function work_edit_pfm(){
        $sql = DB::select('SELECT * FROM `log_report_workedit_pfm` ', []);
        return Datatables::of($sql )->make(true);
    }

    public function PDF1(Request $req) {
        // $data_packing_finish = order_screen::select_data_for_packing_finish();
        // $start = $req->datestart;
        // $end = $req->dateend;
        $pdf = PDF::loadView('report.pdf.rpt-1-pdf');
        $pdf->setPaper('a4','landscape');
        $fileName = 'รายงาน 1';
        return $pdf->stream($fileName.'.pdf');
    }

    public function test(){
        // ในที่นี้เราจะใช้เป็นเดือน จึงมีการสร้าง array เก็บค่าเดือน
        $thai_month=array(
        "ม.ค.",
        "ก.พ.",
        "มี.ค.",
        "เม.ย.",
        "พ.ค.",
        "มิ.ย.",
        "ก.ค.",
        "ส.ค.",
        "ก.ย.",
        "ต.ค.",
        "พ.ย.",
        "ธ.ค."//*ชนิดงานแก้
        );
        // สร้างฟังก์ชั่น หายอดจำนวนที่ขายได้รวม ในแต่ละเดือน ของสินค้าใดๆ
        // โดยจะสิ่งชื่อสินค้า และปี เข้าไปเพื่อตรวจสอบ และสร้างค่าตัวแปร array
        // ชุดข้อมูล

        function getData($val,$year){
            $arr_data=array();
            // คำสั่ง sql เปลี่ยนไปตามความเหมาะสม ขึ้นกับว่าเป็นข้อมูลประเภทไหน
            // และต้องการใช้ข้อมูลในลักษณะใด ในที่นี้ เป็นการหายอดรวม ของสินค้า
            // แต่ละรายการ ในแต่ละเดือน ของปี ที่ส่งค่าตัวแปรมา
            $q="
            SELECT
            SUM(quantity) as total_quantity
            FROM tbl_sale WHERE name='".$val."' AND date LIKE '".$year."%'
            GROUP BY DATE_FORMAT( DATE,  '%Y-%m-01' )
            ";
            $qr=mysql_query($q);
            while($rs=mysql_fetch_array($qr)){
                $arr_data[]=$rs['total_quantity'];
            }
            return $arr_data;  // ส่งค่ากลับชุด array ข้อมูล
        }
        // สร้างชุด array ข้อมูลของสินค้า A ปี เป็นตัวแปร $_GET['year'] ที่เราส่งมาในที่นี้คือปี 2014
        $col_A=getData('A',$_GET['year']); // สร้างชุด array ข้อมูลของสินค้า A
        $col_B=getData('B',$_GET['year']); // สร้างชุด array ข้อมูลของสินค้า B
        $col_C=getData('C',$_GET['year']); // สร้างชุด array ข้อมูลของสินค้า C
        // กำหนดตัวแปร $i ไว้อ้างอิง key ของชุดข้อมูล array
        $i=0;
        $q="
        SELECT
        sale_id
        FROM tbl_sale
        GROUP BY DATE_FORMAT( DATE,  '%Y-%m-01' )
        ";
        // การ query จะใช้ group by เดียวกัน เพื่อให้ key ของข้อมูล array ตรงและสัมพันธ์กัน
        $qr=mysql_query($q);
        while($rs=mysql_fetch_array($qr)){
            $json_data[]=array(
                $thai_month[$i],  // สร้างข้อมูลแถวที่สองขึั้นไป คอลัมน์แรก อันนี้คือ เดือนย่อ
                intval($col_A[$i]),  // สร้างข้อมูลแถวที่สองขึั้นไป คอลัมน์ที่สอง ข้อมูลยอดรวมของ สินค้า A
                intval($col_B[$i]),  // สร้างข้อมูลแถวที่สองขึั้นไป คอลัมน์ที่สาม ข้อมูลยอดรวมของ สินค้า B
                intval($col_C[$i])  // สร้างข้อมูลแถวที่สองขึั้นไป คอลัมน์ที่สี่ ข้อมูลยอดรวมของ สินค้า C
            );
            $i++; // เพื่ม key ของตัวแปร arrray
        }
        // ใส่ชุดข้อมูลแถวแรกเข้าไปในตัวแปร array
        array_unshift($json_data,array("เดือน","สินค้า A","สินค้า B","สินค้า C"));
        $json= json_encode($json_data); // แปลงข้อมูล array เป็น ข้อความ json object นำไปใช้งาน
        echo $json;
    }

    public function get_data_report_work_defect(Request $request){
             /////////////////////////////////////
             $work_defect=array(
                "ขอบขาด",
                "กระดก",
                "ใส่ไม่ลง",
                "ไม่ Seat/ไม่แนบ",
                "เปลี่ยน Design",
                "หลวม",
                "ทะลุ",
                "สูง",
                "ไม่สบ",
                "แตกร้าว",
                "คอนแทค",
                "รูปร่าง",
                "Prep เพิ่ม",
                "เปลี่ยน Abutment",
                "งานสลับ",
                "สี"
                );

            $sql = DB::select("SELECT *
            FROM
            log_report_workedit_pfm
            WHERE
            log_report_workedit_pfm.monthYears
            IN ('$request->_1st','$request->_2nd','$request->_3th') ", []);

            foreach ($sql as $key => $value) {
                $arr_data[$key][0]=$value->id8;
                $arr_data[$key][1]=$value->id9;
                $arr_data[$key][2]=$value->id10;
                $arr_data[$key][3]=$value->id11;
                $arr_data[$key][4]=$value->id12;
                $arr_data[$key][5]=$value->id13;
                $arr_data[$key][6]=$value->id14;
                $arr_data[$key][7]=$value->id15;
                $arr_data[$key][8]=$value->id16;
                $arr_data[$key][9]=$value->id17;
                $arr_data[$key][10]=$value->id18;
                $arr_data[$key][11]=$value->id19;
                $arr_data[$key][12]=$value->id20;
                $arr_data[$key][13]=$value->id21;
                $arr_data[$key][14]=$value->id22;
                $arr_data[$key][15]=$value->id23;
            }

            for ($i=0; $i < 16; $i++) {
                $json_data[$i]=array(
                    $work_defect[$i],
                    intval($arr_data[0][$i]),
                    intval($arr_data[1][$i]),
                    intval($arr_data[2][$i])
                );
            }


            array_unshift($json_data,array("","มกราคม",'กุมภาพันธ์','มีนาคม'));
            $json= json_encode($json_data);

        return $json;
    }

    public function indexRecieveSend() {
            return view('report.report_recieve_send');
    }

    public function indexRecieveSendToday() {   
            return view('report.report_recieve_send_today');
    }
            // $qr = DB::select($sql);
    public function getAjexRecSend() {   
        
                $sql = "SELECT
                order_screen.ID,
                order_screen.Barcode,
                view_type_product.TypeOfProductID,
                customer.`Name` AS customer_name,
                doctor.`Name` AS doctorname,
                order_screen.PatientName,
                order_screen.DeliverDate,
                order_screen.created_at AS StartDate,
                view_type_product.type_of_product AS product_name,
                zone.`Name` AS zone_name,
                area.`Name` AS area_name,
                order_screen.job_current_department,
                order_screen.PatientHN AS PatientHN,
                order_screen.ReceptionTime AS ReceptionTime,
                order_screen.first_product
            FROM
                order_screen
                LEFT JOIN customer ON order_screen.CustomerID = customer.ID
                LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                LEFT JOIN view_type_product ON order_screen.ID = view_type_product.OrderID
                LEFT JOIN area ON customer.AreaID = area.ID
                LEFT JOIN zone ON area.ZoneID = zone.ID
            WHERE
                ( order_screen.job_current_department <> 9977
                OR order_screen.job_current_department IS NULL )
                GROUP BY
                    order_screen.created_at";
        $qr = DB::select($sql); 
        return Datatables::of($qr)->addIndexColumn()->make(true);
    
    }

    public function getAjexRecSendToday() {
        $sql = "SELECT
                order_screen.ID,
                order_screen.Barcode,
                view_type_product.TypeOfProductID,
                customer.`Name` AS customer_name,
                doctor.`Name` AS doctorname,
                order_screen.PatientName,
                order_screen.DeliverDate,
                order_screen.created_at AS StartDate,
                view_type_product.type_of_product AS product_name,
                zone.`Name` AS zone_name,
                area.`Name` AS area_name,
                order_screen.job_current_department,
                order_screen.PatientHN AS PatientHN,
                order_screen.ReceptionTime AS ReceptionTime,
                order_screen.first_product
            FROM
                order_screen
                LEFT JOIN customer ON order_screen.CustomerID = customer.ID
                LEFT JOIN doctor ON order_screen.DoctorID = doctor.ID
                LEFT JOIN view_type_product ON order_screen.ID = view_type_product.OrderID
                LEFT JOIN area ON customer.AreaID = area.ID
                LEFT JOIN zone ON area.ZoneID = zone.ID
            WHERE
               ( order_screen.job_current_department <> 9977
                OR order_screen.job_current_department IS NULL )
                AND	(order_screen.created_at BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW())
            GROUP BY
                order_screen.created_at ";
            $qr = DB::select($sql);
            return Datatables::of($qr)->addIndexColumn()->make(true);
        }


        
        public function index_work_edit_pfm_week(){
            if(!Gate::allows('IsAdmin')){
                abort(404,"Page NotFound");
            }

            $sql = DB::select("SELECT
                        order_screen.ID,
                        order_screen.Barcode,
                        order_screen.ddlTypeEdit,
                        order_screen.StartDate,
                        order_screen.created_at,
                        WEEK(order_screen.created_at),
                        floor((day(order_screen.created_at)-1)/7)+1 as weeks,
                        DATE_FORMAT( order_screen.created_at, '%m' ) AS mount,
                        DATE_FORMAT( order_screen.created_at, '%M' ) AS MOUNTs
                        FROM
                        order_screen
                        WHERE
                        order_screen.ddlTypeEdit IS NOT NULL AND
                        order_screen.ddlTypeEdit <> ''AND
                        order_screen.ddlTypeEdit > 7
                        ORDER BY
                        order_screen.created_at ASC
                        ", []);


            foreach ($sql as $key => $value) {  // ประกาศตัวแปร int
                $analys[$value->mount][$value->weeks][$value->ddlTypeEdit] = 0;
            }
            foreach ($sql as $key => $value) { // เพิ่มค่า
                $analys[$value->mount][$value->weeks][$value->ddlTypeEdit]++;
            }
            $par =  json_encode($analys);

            $work_defect = DB::select("SELECT * from work_defect where name_type = 'ทำใหม่'");

            return view('report.report_work_defect_week', compact('analys','par','work_defect','sql'));
        }
        
        //ajax
        public function get_data_report_work_defect_week(Request $request){

                    $work_defect=array(
                        "",
                        "ขอบขาด",
                        "กระดก",
                        "ใส่ไม่ลง",
                        "ไม่ Seat/ไม่แนบ",
                        "เปลี่ยน Design",
                        "หลวม",
                        "ทะลุ",
                        "สูง",
                        "ไม่สบ",
                        "แตกร้าว",
                        "คอนแทค",
                        "รูปร่าง",
                        "Prep เพิ่ม",
                        "เปลี่ยน Abutment",
                        "งานสลับ",
                        "สี"
                        );
                        
            $sql = DB::select("SELECT
                        order_screen.Barcode,
                        order_screen.ID,
                        order_screen.ddlTypeEdit,
                        order_screen.StartDate,
                        order_screen.created_at,
                        WEEK ( order_screen.created_at ),
                        floor( ( DAY ( order_screen.created_at ) - 1 ) / 7 ) + 1 AS weeks,
                        DATE_FORMAT( order_screen.created_at, '%m' ) AS mount,
                        DATE_FORMAT( order_screen.created_at, '%M' ) AS MOUNTs
                        FROM
                        order_screen
                        WHERE
                        order_screen.ddlTypeEdit IS NOT NULL AND
                        order_screen.ddlTypeEdit <> '' AND
                        DATE_FORMAT( order_screen.created_at, '%m' ) IN ('$request->_1st','$request->_2nd') AND
                        order_screen.ddlTypeEdit > 7
                        ORDER BY
                        order_screen.created_at ASC            
                        ", []);


            
            for($workDefect = 8; $workDefect <= 23 ; $workDefect++) {
                for ($weeks =1; $weeks <= 5 ; $weeks++) { 
                    $analys[$request->_1st][$weeks][$workDefect] = 0;
                    $analys[$request->_2nd][$weeks][$workDefect] = 0;
                }
            }

            foreach ($sql as $key => $value) {  // ประกาศตัวแปร int
                $analys[$value->mount][$value->weeks][$value->ddlTypeEdit] = 0;
            }
            foreach ($sql as $key => $value) { // เพิ่มค่า
                $analys[$value->mount][$value->weeks][$value->ddlTypeEdit]++;
            }
          
            for($workDefect = 8,$k=1; $workDefect <= 23 ; $workDefect++ ,$k++) {

                    $arr_data[$k][1]=$analys[$request->_1st][1][$workDefect];  
                    $arr_data[$k][2]=$analys[$request->_2nd][1][$workDefect];  
                    $arr_data[$k][3]=$analys[$request->_1st][2][$workDefect];  
                    $arr_data[$k][4]=$analys[$request->_2nd][2][$workDefect];  
                    $arr_data[$k][5]=$analys[$request->_1st][3][$workDefect];  
                    $arr_data[$k][6]=$analys[$request->_2nd][3][$workDefect];  
                    $arr_data[$k][7]=$analys[$request->_1st][4][$workDefect];  
                    $arr_data[$k][8]=$analys[$request->_2nd][4][$workDefect];  
                    $arr_data[$k][9]=$analys[$request->_1st][5][$workDefect];  
                   $arr_data[$k][10]=$analys[$request->_2nd][5][$workDefect];  
            }

            for ($i=1; $i <= 15; $i++) {
                $json_data[$i]=array(
                    $work_defect[$i],
                    intval($arr_data[$i][1]),
                    intval($arr_data[$i][2]),
                    intval($arr_data[$i][3]),
                    intval($arr_data[$i][4]),
                    intval($arr_data[$i][5]),
                    intval($arr_data[$i][6]),
                    intval($arr_data[$i][7]),
                    intval($arr_data[$i][8]),
                    intval($arr_data[$i][9]),
                    intval($arr_data[$i][10]),
                );
            }

            array_unshift($json_data,array("","W1",'W1',
                                              "W2",'W2',
                                              "W3",'W3',            
                                              "W4",'W4',
                                              "W5",'W5',));

            $json= json_encode($json_data);

            return $json;
            // return $analys['06'][4][8];
            // return $analys['07'][4][8];
            //  $par =  var_dump(json_decode($analys));
            //  return  $par;
       }

       public function indexUnitEmployee(){
            $department = DB::select("SELECT
                                department.ID,
                                department.`Name`
                                FROM
                                department
                                WHERE
                                department.ID NOT IN (0,1,2,4,5,994,995,996,997,998,999)");
            return view('report.report_unit_employee',compact('department'));
       }

    
       public function getajax_unit(Request $request){

        $user = DB::select("SELECT
                        users.username,
                        Employee.Nick_name,
                        users.ID_type_users,
                        Employee.department
                        FROM
                        users
                        LEFT JOIN Employee ON users.id = Employee.ID_user
                        WHERE
                        Employee.department = $request->department
                        ");

        $totalUnit = DB::select("SELECT
                            unit_employee.id,
                            users.username,
                            Employee.Nick_name,
                            Count( unit_employee.id ) AS count,
                            unit_employee.sub_depart,
                            unit_employee.barcode,
                            unit_employee.created_at
                        FROM
                            unit_employee
                            LEFT JOIN Employee ON unit_employee.EmployeeID = Employee.ID_user
                            LEFT JOIN users ON unit_employee.EmployeeID = users.id 
                        WHERE
                        DATE_FORMAT( unit_employee.created_at, '%m' ) = $request->_1st
                        GROUP BY
                            Employee.ID_user");

        $defectUnit = DB::select("SELECT
                        order_screen.RefBarcode,
                        unit_employee.barcode,
                        unit_employee.unit,
                        Count(order_screen.ID) AS count,
                        unit_employee.EmployeeID,
                        users.username
                        FROM
                        unit_employee
                        LEFT JOIN ( SELECT order_screen.ID , order_screen.RefBarcode 
                        FROM order_screen WHERE order_screen.RefBarcode IS NOT NULL ) AS order_screen ON order_screen.RefBarcode= unit_employee.barcode
                        LEFT JOIN users ON unit_employee.EmployeeID = users.id
                        WHERE
                        order_screen.RefBarcode IS NOT NULL
                        AND DATE_FORMAT( unit_employee.created_at, '%m' ) = $request->_1st
                        GROUP BY
                        unit_employee.EmployeeID");

        $totalUnit2 = DB::select("SELECT
                            unit_employee.id,
                            users.username,
                            Employee.Nick_name,
                            Count( unit_employee.id ) AS count,
                            unit_employee.sub_depart,
                            unit_employee.barcode,
                            unit_employee.created_at
                        FROM
                            unit_employee
                            LEFT JOIN Employee ON unit_employee.EmployeeID = Employee.ID_user
                            LEFT JOIN users ON unit_employee.EmployeeID = users.id 
                        WHERE
                        DATE_FORMAT( unit_employee.created_at, '%m' ) = $request->_2nd
                        GROUP BY
                            Employee.ID_user");

        $defectUnit2 = DB::select("SELECT
                        order_screen.RefBarcode,
                        unit_employee.barcode,
                        unit_employee.unit,
                        Count(order_screen.ID) AS count,
                        unit_employee.EmployeeID,
                        users.username
                        FROM
                        unit_employee
                        LEFT JOIN ( SELECT order_screen.ID , order_screen.RefBarcode 
                        FROM order_screen WHERE order_screen.RefBarcode IS NOT NULL ) AS order_screen ON order_screen.RefBarcode= unit_employee.barcode
                        LEFT JOIN users ON unit_employee.EmployeeID = users.id
                        WHERE
                        order_screen.RefBarcode IS NOT NULL
                        AND DATE_FORMAT( unit_employee.created_at, '%m' ) = $request->_2nd
                        GROUP BY
                        unit_employee.EmployeeID");
     
        foreach ($user as $key => $users) {
            $checkTotal = 0;
            foreach ($totalUnit as $key => $total) {
                if ($total->username  == $users->username) {
                    $arrUser[] = array($users->username,$users->Nick_name,$total->count);
                    $checkTotal = 1;
                }
            }
            if ($checkTotal == 0) {
                $arrUser[] = array($users->username,$users->Nick_name,0);
            }
        }

        foreach ($user as $key => $users) {
            $checkTotal = 0;
            foreach ($totalUnit2 as $key => $total2) {
                if ($total2->username  == $users->username) {
                    $arrUser2[] = array($users->username,$users->Nick_name,$total2->count);
                    $checkTotal = 1;
                }
            }
            if ($checkTotal == 0) {
                $arrUser2[] = array($users->username,$users->Nick_name,0);
            }
        }
        // return $arrUser2;

        for ($countUser=0; $countUser < count($arrUser); $countUser++) { 
            $checkDefect = 0;
            $checkDefect2 = 0;
            foreach ($defectUnit as $key => $defect) {
                if ($defect->username == $arrUser[$countUser][0] && $defect->count != 0) {
                    $arrUser[$countUser][3] = $defect->count;
                    $arrUser[$countUser][4] = number_format( doubleval(($defect->count*1000)/$arrUser[$countUser][2]) , 1);
                    $checkDefect = 1;
                }
            }

            foreach ($defectUnit2 as $key => $defect2) {
                if ($defect2->username == $arrUser[$countUser][0] && $defect2->count != 0) {
                    $arrUser[$countUser][5] = number_format( doubleval(($defect2->count*1000)/$arrUser2[$countUser][2]) , 1);
                    $checkDefect2 = 1;
                }
            }
            
            if ($checkDefect == 0) {
                $arrUser[$countUser][3] = 0;
                $arrUser[$countUser][4] = 0;
            }
            if ($checkDefect2 == 0) {
                $arrUser[$countUser][5] = 0;
            }
        }

        for ($j=0; $j < count($arrUser); $j++) {
            
                $json_data[$j]=array(
                    $arrUser[$j][1],
                    intval($arrUser[$j][4]),
                    intval($arrUser[$j][5]),
                );
        }

        array_unshift($json_data,array("",'FEB','MAR'));

        return array($arrUser,$json_data);
        // return array($user,$totalUnit,$defectUnit);
    }

    public function indexUnitEmployeeWorkdefect(){
        $department = DB::select("SELECT
                                department.ID,
                                department.`Name`
                                FROM
                                department
                                WHERE
                                department.ID NOT IN (0,1,2,4,5,994,995,996,997,998,999)");
        $work_defect_type = DB::select("SELECT * FROM `work_defect` WHERE work_defect.id_type IN (1,2)");
        return view('report.report_unit_employee_work_defect',compact('department','work_defect_type'));
    }

    public function getEmployee_report_workDefect(Request $request){
        $employee = DB::select("SELECT
        users.username,
        Employee.Nick_name,
        users.ID_type_users,
        Employee.department
        FROM
        users
        LEFT JOIN Employee ON users.id = Employee.ID_user
        WHERE
        Employee.department = $request->department
        ");
        return $employee;
    }

    public function getajax_unit_workDefect(Request $request){
        $strWorkDefectId ='';

        for ($i=0; $i < count($request->arrWorkdefect); $i++) { 
            $strWorkDefectId = $strWorkDefectId . $request->arrWorkdefect[$i] . ',';
        }
        	
        $strWorkDefectId = substr_replace($strWorkDefectId ,"", -1);
        
        $select = DB::select("SELECT
                                order_screen.RefBarcode,
                                unit_employee.barcode,
                                unit_employee.EmployeeID,
                                users.username,
                                order_screen.ddlTypeEdit,
                                DATE_FORMAT( unit_employee.created_at, '%m' ) as month_,
                                DATE_FORMAT( unit_employee.created_at, '%Y' ) as years_
                            FROM
                                unit_employee
                                LEFT JOIN ( SELECT order_screen.ID, order_screen.RefBarcode,order_screen.ddlTypeEdit  FROM order_screen 
                                WHERE order_screen.RefBarcode IS NOT NULL ) AS order_screen ON order_screen.RefBarcode = unit_employee.barcode
                                LEFT JOIN users ON unit_employee.EmployeeID = users.id 
                            WHERE
                                order_screen.RefBarcode IS NOT NULL 
                                AND order_screen.ddlTypeEdit IN ($strWorkDefectId)
                                AND users.username = '$request->employee'");
        
        $totalUnit = DB::select("SELECT
                                    Count( unit_employee.id ) AS count_
                                FROM
                                    unit_employee
                                    LEFT JOIN Employee ON unit_employee.EmployeeID = Employee.ID_user
                                    LEFT JOIN users ON unit_employee.EmployeeID = users.id 
                                WHERE
                                    users.username = '$request->employee'");                    
        $month=array(
            "JAN",
            "FEB",
            "MAR",
            "APR",
            "MAY",
            "JUN",
            "JUL",
            "AUG",
            "SEB",
            "OCT",
            "NOV",
            "DEC",
            "AVG"
        );

        // งานแก้ รายคน
        for ($i=0; $i <13 ; $i++) { 
            for ($j=0; $j <8 ; $j++) { 
                 $arr_workDefect[$i][$j] = (float)(0.0);
                 $arr_avg[$i] = (float)(0.0);
            }
         } // ประกาศตัวแปร default ค่า = 0.0

         foreach ($select as $key => $value) {
            for ($countMonth=0; $countMonth < 13; $countMonth++) {
                if ($countMonth == $value->month_) {
                    if ($value->ddlTypeEdit == $request->arrWorkdefect[0]) {
                        $arr_workDefect[$countMonth][1]= $arr_workDefect[$countMonth][1] + $value->ddlTypeEdit;
                        $arr_workDefect[$countMonth][7]= $arr_workDefect[$countMonth][7] + $value->ddlTypeEdit;
                    }
                    if ($value->ddlTypeEdit == $request->arrWorkdefect[1]) {
                        $arr_workDefect[$countMonth][2]= $arr_workDefect[$countMonth][2] + $value->ddlTypeEdit;
                        $arr_workDefect[$countMonth][7]= $arr_workDefect[$countMonth][7] + $value->ddlTypeEdit;
                    }
                    if ($value->ddlTypeEdit == $request->arrWorkdefect[2]) {
                        $arr_workDefect[$countMonth][3]= $arr_workDefect[$countMonth][3] + $value->ddlTypeEdit;
                        $arr_workDefect[$countMonth][7]= $arr_workDefect[$countMonth][7] + $value->ddlTypeEdit;
                    }
                    if ($value->ddlTypeEdit == $request->arrWorkdefect[3]) {
                        $arr_workDefect[$countMonth][4]= $arr_workDefect[$countMonth][4] + $value->ddlTypeEdit;
                        $arr_workDefect[$countMonth][7]= $arr_workDefect[$countMonth][7] + $value->ddlTypeEdit;
                    }
                    if ($value->ddlTypeEdit == $request->arrWorkdefect[4]) {
                        $arr_workDefect[$countMonth][5]= $arr_workDefect[$countMonth][5] + $value->ddlTypeEdit;
                        $arr_workDefect[$countMonth][7]= $arr_workDefect[$countMonth][7] + $value->ddlTypeEdit;
                    }
                    if ($value->ddlTypeEdit == $request->arrWorkdefect[5]) {
                        $arr_workDefect[$countMonth][6]= $arr_workDefect[$countMonth][6] + $value->ddlTypeEdit;
                        $arr_workDefect[$countMonth][7]= $arr_workDefect[$countMonth][7] + $value->ddlTypeEdit;
                    }
                }
            }
        }

        for ($i=0; $i <13 ; $i++) { 
            for ($j=0; $j <8 ; $j++) { 
                if ($arr_workDefect[$i][$j] != 0) {
                    $arr_workDefect[$i][$j] =  number_format((float)(($arr_workDefect[$i][$j]*1000)/$totalUnit[0]->count_),1);
                    $arr_avg[$j] = $arr_avg[$j] + $arr_workDefect[$i][$j];
                }
            }
             
         }
         
         
         for ($i=0; $i < 13; $i++) {
            if ($i != 12) {
                $json_data[$i]=array(
                    $month[$i],
                    floatval($arr_workDefect[$i][1]),
                    floatval($arr_workDefect[$i][2]),
                    floatval($arr_workDefect[$i][3]),
                    floatval($arr_workDefect[$i][4]),
                    floatval($arr_workDefect[$i][5]),
                    floatval($arr_workDefect[$i][6]),
                    floatval($arr_workDefect[$i][7])
                );
            }else {
                $json_data[$i]=array(
                    $month[$i],
                    floatval(number_format( $arr_avg[1]*(1/12) ,1)),
                    floatval(number_format( $arr_avg[2]*(1/12) ,1)),
                    floatval(number_format( $arr_avg[3]*(1/12) ,1)),
                    floatval(number_format( $arr_avg[4]*(1/12) ,1)),
                    floatval(number_format( $arr_avg[5]*(1/12) ,1)),
                    floatval(number_format( $arr_avg[6]*(1/12) ,1)),
                    floatval(number_format( $arr_avg[7]*(1/12) ,1))
                );
            }
        }

        return $json_data;
        
    }
}
