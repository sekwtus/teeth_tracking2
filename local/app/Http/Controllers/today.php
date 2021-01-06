<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use DB;
use Auth;
use Gate;
use App\order_screen;
use App\job;
class today extends Controller
{
    public function index()
    {
            return view('Transport.today');
    }
    public function getAjexWaitExport()
    {
        $sql = order_screen::select_data_for_packing_finish();
        return Datatables::of($sql )->make(true);
    }

    public function index2()
    {
        return view('Transport.exported');
    }

    public function getAjexExported()
    {
        $sql = order_screen::select_data_today_finish_forSaler();
        return Datatables::of($sql )->make(true);
    }

    public function todaySearch(Request $request){

        $start_date = substr($request->daterange, 0, 10);
        $end_date = substr($request->daterange, 13, 23);

        $date1 = strtr($start_date, '-', '/');
        $start_date_save = date('d/m/Y', strtotime($date1));

        $date2 = strtr($end_date, '-', '/');
        $end_date_save = date('d/m/Y', strtotime($date2));
        return $start_date_save.'   '.$end_date_save;
        $data_packing_finish = order_screen::select_data_for_packing_finish_bydate($start_date_save,$end_date_save);

        if (Gate::allows('IsSale')) {
            $data_packing_finish = order_screen::select_data_for_packing_finish();
            $data_today = order_screen::select_data_today_forSaler();
            $data_today_finish = order_screen::select_data_today_finish_forSaler();

            return view('Transport.today', compact('data_today', 'data_today_finish', 'data_packing_finish'));
        } else {
            $data_packing_finish = order_screen::select_data_for_packing_finish();
            $data_area_today = order_screen::select_area_today();
            $data_today = order_screen::select_data_today();
            $data_today_finish = order_screen::select_data_today_finish();

            return view('Transport.today', compact('data_today', 'data_area_today', 'data_today_finish', 'data_packing_finish'));
        }
    }


    public function index_by_id(Request $request)
    {
        // if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
        //     abort(404, 'Page NotFound');
        // }
        $id = $request->area;
        $data_packing_finish = order_screen::select_data_for_packing_finish();
        $data_today_finish = order_screen::select_data_today_finish_by_area($id);
        $data_today = order_screen::select_data_today_by_area($request->area);
        $data_area_today = order_screen::select_area_today();

        return view('Transport.today', compact('data_today', 'data_area_today', 'data_today_finish','data_area_today','data_packing_finish'));
    }

    public function todayFinish($id)
    {
        $ID_user = Auth::user()->id;
        DB::update('UPDATE job SET job.job_current_department = 998 WHERE job.ID = ?', [$id]);
        DB::insert('INSERT INTO job_detail (
            JobID,
            productID,
            ID_screen,
            DepartmentID,
            step_job_department,
            status_job_detail,
            EmployeeID,
            created_at,
            updated_at
            )
            SELECT
                job_detail.JobID,
                1 as productID,
                job_detail.ID_screen,
                998 as DepartmentID,
                998 as step_job_department,
                3 as status_job_detail,
                ?,
                now(),
                now()
            FROM
                job_detail
            WHERE
                job_detail.JobID = ?
            ', [$ID_user, $id]);

        return redirect('today');
    }


    public function scan(Request $request)
    {
        $id_barcode = $request->BarCode;
        $id = DB::select("SELECT job.ID FROM order_screen INNER JOIN job ON job.ID_order_screen = order_screen.ID WHERE order_screen.Barcode = ?",[$id_barcode]);
        $ID_user = Auth::user()->id;
        if($id != null){
            DB::update('UPDATE job SET job.job_current_department = 997 WHERE job.ID = ?', [$id]);
            DB::insert('INSERT INTO job_detail (
                JobID,
                productID,
                ID_screen,
                DepartmentID,
                step_job_department,
                status_job_detail,
                EmployeeID,
                created_at,
                updated_at
                )
                SELECT
                    job_detail.JobID,
                    1 as productID,
                    job_detail.ID_screen,
                    997 as DepartmentID,
                    997 as step_job_department,
                    3 as status_job_detail,
                    ?,
                    now(),
                    now()
                FROM
                    job_detail
                WHERE
                    job_detail.JobID = ?
                ', [$ID_user, $id]);

            return redirect('today');
        } else {
            return redirect('today')->with('massage','ไม่มี Barcode นี้ในระบบ');
        }
    }

    public function jobFlow(Request $request , $id){
        // if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
        //     abort(404,"Page NotFound");
        // }

        $data_id = job::where('ID_order_screen',$id)->limit(1)->first();
        $data_job_flow = DB::select("SELECT
                            job_detail.ID,
                            job_detail.JobID,
                            job_detail.ID_screen,
                            job_detail.productID,
                            job_detail.DepartmentID,
                            job_detail.step_job_department,
                            Employee.Nick_name AS `Nick name`,
                            Employee.`Name`,
                            job_detail.EmployeeID,
                            job_detail.status_job_detail,
                            job_detail.created_at,
                            job_detail.updated_at,
                            department.`Name` As nameDepartment,
                            users.picture_user
                            FROM
                            job_detail
                            LEFT JOIN Employee ON Employee.ID_user = job_detail.EmployeeID
                            LEFT JOIN department ON job_detail.DepartmentID = department.ID
                            LEFT JOIN users ON Employee.ID = users.id
                            WHERE
                            job_detail.ID IN ((
                                SELECT MAX(ID)
                                FROM job_detail
                            WHERE job_detail.JobID = '$data_id->ID'
                                GROUP BY DepartmentID
                            )) ORDER BY ID");

        $data_order_screen = DB::select("SELECT
                                    order_screen.ID,
                                    order_screen.Barcode,
                                    order_screen.RefBarcode,
                                    order_screen.FactoryID,
                                    order_screen.BranchID,
                                    order_screen.CustomerID,
                                    order_screen.DoctorID,
                                    order_screen.SaleID,
                                    order_screen.StartDate,
                                    order_screen.DeliverDate,
                                    order_screen.DeliverType,
                                    order_screen.PatientHN,
                                    order_screen.PatientName,
                                    order_screen.PatientSex,
                                    order_screen.PatientAge,
                                    order_screen.created_at,
                                    order_screen.updated_at,
                                    order_screen.ReceptionTime,
                                    order_screen.`comment`,
                                    order_screen.AreaID,
                                    order_screen.DeliverDate_comment,
                                    Employee.`Name`
                                    FROM
                                    order_screen
                                    INNER JOIN Employee ON order_screen.SaleID = Employee.ID_user
                                    WHERE
                                    order_screen.ID = $id");

        return view('Transport.history_jobFlow', compact('data_job_flow','data_order_screen'));
    }


}
