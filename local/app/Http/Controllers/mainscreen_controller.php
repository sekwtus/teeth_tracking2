<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use DB;
use App\screen;
use App\job;
use App\order_screen;
use Auth;
use Artisan;

class mainscreen_controller extends Controller
{
    public function getIndex()
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }
        return view('screen.mainscreen');
    }

    public function getIndexComplete()
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }
        return view('screen.screenComplete_before');
    }

    public function detailscreen($id)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $teeth = DB::select('SELECT
            order_teeth_screen.ID,
            order_teeth_screen.ScreenID,
            order_teeth_screen.TeethID,
            order_teeth_screen.TypeOfWorkID,
            order_teeth_screen.TypeOfProductID,
            order_teeth_screen.TypeOfGroupID,
            order_teeth_screen.GroupNo,
            order_teeth_screen.status
            FROM
            order_teeth_screen
            WHERE
            order_teeth_screen.ScreenID = ? AND
            order_teeth_screen.ID IN (( SELECT MAX( order_teeth_screen.ID ) FROM order_teeth_screen GROUP BY order_teeth_screen.TeethID ))', [$id]);

        return view('screen.detail_screen', compact('teeth'));
    }

    public function detailteeth($id)
    {
        Artisan::call('cache:clear');

        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $data_ref =DB::select('SELECT
                    order_screen.ID,
                    order_screen.Barcode,
                    order_screen.RefBarcode,
                    order_screen.comment_Workdefect2,
                    work_defect_2.name_type AS name_type_2,
                    work_defect_2.detail_type AS detail_type_2
                FROM
                    order_screen
                    LEFT JOIN work_defect AS work_defect_2 ON order_screen.ddlTypeEdit = work_defect_2.id
                ORDER BY
                    order_screen.ID DESC ', []);

        $order = DB::select("SELECT
                            order_screen.ID,
                            order_screen.Barcode,
                            order_screen.RefBarcode,
                            order_screen.FactoryID,
                            order_screen.BranchID,
                            type_Branch.`Name` as branch_name,
                            type_Branch.companyID,
                            company.fullname as company_name,
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
                            order_screen.phone_doctor,
                            order_screen.phone_customer,
                            order_screen.line_doctor,
                            order_screen.FinalTime,
                            order_screen.DeliverDate_comment,
                            order_screen.type_of_con,
                            order_screen.Employee_DeliverDate_comment,
                            order_screen.comment_WorkLate,
                            order_screen.comment_WorkLate_before,
                            order_screen.comment_Workdefect1,
                            order_screen.comment_Workdefect2,
                            order_screen.OralScan,
                            order_screen.Model,
                            customer.`Name` AS customer,
                            doctor.`Name` AS doctor,
                            customer_type.`name` AS customer_type,
                            type_Deliver.`Name` AS DeliverType,
                            Employee.Nick_name AS Employee,
                            department.`Name` AS department,
                            area.`Name` AS ID_area,
                            customer.CustomerCode,
                            order_screen.technician_recommend,
                            Employee.`Name` as employee_name,
                            order_screen.note,
                            processround.production_cycle,
                            order_screen.Datefinal,
                            order_screen.ContiBarcode,
                            order_screen.ddlWorkLate,
                            order_screen.ddlTypeEdit,
                            work_defect_1.name_type AS name_type_1,
                            work_defect_1.detail_type AS detail_type_1,
                            work_defect_2.name_type AS name_type_2,
                            work_defect_2.detail_type AS detail_type_2,
                            type_of_con.`Name` AS type_of_con_name
                            FROM
                            order_screen
                            LEFT JOIN Employee ON Employee.ID_user = order_screen.SaleID
                            LEFT JOIN users ON users.ID = order_screen.SaleID
                            LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                            LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                            LEFT JOIN area ON order_screen.AreaID = area.ID
                            LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                            LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                            LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                            LEFT JOIN department ON job.job_current_department = department.ID
                            LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                            LEFT JOIN company ON type_Branch.companyID = company.ID
                            LEFT JOIN processround ON order_screen.processroundID = processround.ID
                            LEFT JOIN work_defect AS work_defect_1 ON order_screen.ddlWorkLate = work_defect_1.id
                            LEFT JOIN work_defect AS work_defect_2 ON order_screen.ddlTypeEdit = work_defect_2.id
                            LEFT JOIN type_of_con ON order_screen.type_of_con = type_of_con.ID
                            WHERE
                            order_screen.ID = ? ORDER BY order_screen.ID DESC LIMIT 1", [$id]);

        $data_all = DB::select('SELECT
                                    *
                                    FROM
                                    screen
                                    WHERE
                                    screen.ID_order_screen = ?', [$id]);

        $data_implant = DB::select("SELECT
                                        select_implant.ID,
                                        select_implant.ID_order_screen,
                                        select_implant.TeethID,
                                        select_implant.topic,
                                        select_implant.detail,
                                        select_implant.created_at
                                        FROM
                                        select_implant
                                        WHERE
                                        select_implant.ID_order_screen = ?", [$id]);

        $data_Requirement = DB::select("SELECT
                                                select_req.ID,
                                                select_req.ID_order_screen,
                                                select_req.TeethID,
                                                select_req.topic,
                                                select_req.count,
                                                select_req.detail
                                                FROM
                                                select_req
                                                WHERE select_req.ID_order_screen = ?", [$id]);

        $select_extra = DB::select('SELECT
                                    select_extra.ID,
                                    select_extra.ID_order_screen,
                                    select_extra.TeethID,
                                    select_extra.topic,
                                    select_extra.note,
                                    select_extra.date,
                                    select_extra.detail,
                                    select_extra.detail_2
                                    FROM
                                    select_extra
                                    WHERE
                                    select_extra.ID_order_screen = ?', [$id]);


        $select_Attachment = DB::select('SELECT
                            select_Attachment.ID,
                            select_Attachment.ID_order_screen,
                            select_Attachment.TeethID,
                            select_Attachment.topic,
                            select_Attachment.number,
                            select_Attachment.assign,
                            select_Attachment.created_at,
                            select_Attachment.updated_at
                            FROM
                            select_Attachment
                            WHERE
                            select_Attachment.ID_order_screen = ?', [$id]);



        $select_IMPLANT_Attachment = DB::select('SELECT
                            select_IMPLANT_Attachment.ID,
                            select_IMPLANT_Attachment.ID_order_screen,
                            select_IMPLANT_Attachment.TeethID,
                            select_IMPLANT_Attachment.topic,
                            select_IMPLANT_Attachment.number,
                            select_IMPLANT_Attachment.assign,
                            select_IMPLANT_Attachment.created_at,
                            select_IMPLANT_Attachment.updated_at
                            FROM
                            select_IMPLANT_Attachment
                            WHERE
                            select_IMPLANT_Attachment.ID_order_screen = ?', [$id]);


        $select_extra_additional = DB::select('SELECT
                            select_extra_additional.ID,
                            select_extra_additional.ID_order_screen,
                            select_extra_additional.detail,
                            select_extra_additional.created_at,
                            select_extra_additional.updated_at
                            FROM
                            select_extra_additional
                            WHERE
                            select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_attachment_additional = DB::select('SELECT
                            select_Attachment_additional.ID,
                            select_Attachment_additional.detail
                            FROM
                            select_Attachment_additional
                            WHERE
                            select_Attachment_additional.ID_order_screen = ?', [$id]);

        $data_select_IMPLANT_Attachment_additional = DB::select('SELECT
                            select_IMPLANT_Attachment_additional.ID,
                            select_IMPLANT_Attachment_additional.detail
                            FROM
                            select_IMPLANT_Attachment_additional
                            WHERE
                            select_IMPLANT_Attachment_additional.ID_order_screen = ?', [$id]);

        //check 1st group of screen teeth group
        $first_screen_group = DB::select('SELECT
                            screen.ID,
                            screen.ID_order_screen,
                            screen.TeethID
                            FROM
                            screen
                            WHERE
                            screen.ID_order_screen = ?
                            LIMIT 1', [$id]);
        foreach($first_screen_group as $stGroup){
            $first_group = $stGroup->TeethID;
        }

        $detail_screen_group =  DB::select('SELECT
                                screen.ID,
                                screen.ID_order_screen,
                                screen.TeethID,
                                screen.Metal_type,
                                screen.Hook,
                                screen.MESIAL_REST,
                                screen.DISTAL_REST,
                                screen.CINGULUM_REST,
                                screen.EMBRESSURE_REST,
                                screen.LINGUAL_LEDGE,
                                screen.other_hook,
                                screen.undercut_hook,
                                screen.unit_hook,
                                screen.UNDERCUT,
                                screen.CONTOUR,
                                screen.unit_CONTOUR,
                                screen.one_color,
                                screen.one_color_Combobox,
                                screen.one_color_branch,
                                screen.one_color_branch_color,
                                screen.many_color_crowns,
                                screen.many_branch_crowns,
                                screen.many_color_Middle,
                                screen.many_branch_Middle,
                                screen.many_color_tip,
                                screen.many_branch_tip,
                                screen.OCCLUSAL_STAINING,
                                screen.PONTIC_DESIGN,
                                screen.MARGIN1,
                                screen.Metal_Margin_detail,
                                screen.detail,
                                screen.`status`,
                                screen.created_at,
                                screen.updated_at,
                                screen.e_max,
                                screen.color,
                                screen.ceramage,
                                screen.zirconia_copping,
                                screen.zirconia_crown,
                                screen.zirconia_restoration,
                                screen.model,
                                screen.model_resin,
                                screen.implant,
                                screen.implant_ceramage,
                                screen.implant_screw,
                                screen.comment_emax_color,
                                screen.comment_ceramage,
                                screen.comment_zirconia,
                                screen.comment_model,
                                screen.comment_implant,
                                screen.comment_hook,
                                screen.comment_contour,
                                screen.comment_shade,
                                screen.comment_Metal_type,
                                screen.comment_occlusal_staining,
                                screen.comment_extra,
                                screen.comment_stump,
                                screen.comment_fix_cement,
                                screen.MARGIN2,
                                screen.MARGIN3,
                                screen.FixCement,
                                screen.GINGIVAL_EMBRASURES,
                                screen.OCCLUSION,
                                screen.CONTACT,
                                screen.shade,
                                screen.shade_brand,
                                screen.shade_color,
                                screen.stump,
                                -- screen.stump_Textarea,
                                screen.one_branch_stump,
                                screen.one_color_stump,
                                screen.screen_group,
                                screen.implant_brand,
                                screen.implant_brand_comment,
                                screen_SHADE_Brand_1.`name` AS one_color_branch_name,
                                screen_SHADE_Colors_1.color AS one_color_name,
                                screen_SHADE_Brand_2.`name` AS one_color_branch_name_2,
                                screen_SHADE_Colors_2.color AS one_color_name_2,
                                screen_SHADE_Brand_3.`name` AS one_color_branch_name_3,
                                screen_SHADE_Colors_3.color AS one_color_name_3,
                                screen_SHADE_Brand_4.`name` AS one_color_branch_name_4,
                                screen_SHADE_Colors_4.color AS one_color_name_4,
                                screen_SHADE_Brand_5.`name` AS one_color_branch_name_5,
                                screen_SHADE_Colors_5.color AS one_color_name_5,
                                screen.txtCommentAlloys,
                                screen.txtCommentShade,
                                screen.txtCommentModel,
                                screen.txtCommentStump,
                                screen.txtCommentFixCement,
                                screen.Pintooth,
                                screen.PintoothHook,
                                screen.PintoothHookRest,
                                screen.PintoothAlloys,
                                screen.PintoothAlloysNote,
                                screen.PintoothAlloysComment,
                                screen.MARGIN_Buccal,
                                screen.MARGIN_Lingual,
                                screen.one_color_extra1,
                                screen.comment_Metal_type,
                                screen.Metal_type2,
                                screen.Metal_type3,
                                screen.Metal_type4,
                                screen.Metal_type5,
                                screen.Metal_type6
                                FROM
                                screen
                                LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_1 ON screen.one_color_branch = screen_SHADE_Brand_1.id
                                LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_1 ON screen.one_color_branch_color = screen_SHADE_Colors_1.id
                                LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_2 ON screen.many_branch_crowns = screen_SHADE_Brand_2.id
                                LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_2 ON screen.many_color_crowns = screen_SHADE_Colors_2.id
                                LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_3 ON screen.many_branch_Middle = screen_SHADE_Brand_3.id
                                LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_3 ON screen.many_color_Middle = screen_SHADE_Colors_3.id
                                LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_4 ON screen.many_branch_tip = screen_SHADE_Brand_4.id
                                LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_4 ON screen.many_color_tip = screen_SHADE_Colors_4.id
                                LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_5 ON screen.one_branch_stump = screen_SHADE_Brand_5.id
                                LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_5 ON screen.one_color_stump = screen_SHADE_Colors_5.id
                                WHERE
                                screen.ID_order_screen = ?
                                GROUP BY
                                screen.screen_group ', [$id]);

        //

        $teeth_group =DB::select('SELECT
                            screen.TeethID,
                            screen.screen_group,
                            order_teeth.TypeOfWorkID,
                            order_teeth.TypeOfProductID,
                            type_of_work.`Name` as work_name,
                            type_of_product.`Name` as product_name
                            FROM
                            screen
                            LEFT JOIN order_teeth ON screen.TeethID = order_teeth.TeethID
                            LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                            LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                            WHERE
                            screen.ID_order_screen = ?
                            GROUP BY
                            screen.TeethID', [$id]);

        $flow = DB::select('SELECT
                            GROUP_CONCAT(DISTINCT department.Name SEPARATOR " > ") AS flow
                            FROM
                            order_screen
                            INNER JOIN job ON job.ID_order_screen = order_screen.ID
                            INNER JOIN job_detail ON job_detail.JobID = job.ID
                            INNER JOIN department ON job_detail.step_job_department = department.ID
                            WHERE
                            order_screen.ID = ?',[$id]);


        $teeth =DB::select('SELECT
                            Max(order_teeth_screen.ID),
                            type_of_work.`Name` AS work_name,
                            type_of_product.`Name` AS work_type,
                            teeth.ID AS teeth,
                            teeth.`Name` AS teeth_name,
                            type_of_product.WorkGroupID,
                            work_group.`Name` AS work_group,
                            order_teeth_screen.TypeOfGroupID,
                            type_of_group.`Name` AS name_group,
                            order_teeth_screen.`status`,
                            order_teeth_screen.ScreenID
                            FROM
                            order_teeth_screen
                            LEFT JOIN type_of_work ON order_teeth_screen.TypeOfWorkID = type_of_work.ID
                            LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
                            LEFT JOIN teeth ON order_teeth_screen.TeethID = teeth.ID
                            LEFT JOIN work_group ON type_of_product.WorkGroupID = work_group.ID
                            LEFT JOIN type_of_group ON order_teeth_screen.TypeOfGroupID = type_of_group.ID
                            WHERE
                            order_teeth_screen.ScreenID = ?
                            GROUP BY
                            order_teeth_screen.TeethID
                            ', [$id]);

        $IsEndFlow =DB::select('SELECT
                                job_detail.ID_order_screen,
                                job_detail.DepartmentID,
                                job_detail.Sub_DepartmentID
                                FROM
                                job_detail
                                WHERE
                                job_detail.ID_order_screen = ? AND
                                job_detail.Sub_DepartmentID = 7
                            ', [$id]);
        $endflow = false;
        if(empty($IsEndFlow)){
            $endflow = true;
        }


        // query interlock
        $data_interlock = DB::select("SELECT
        *
        FROM
        INTERLOCK
        WHERE
        INTERLOCK.screen_ID = ?
        ", [$id]);

        $Female_Mesial ="";
        $Female_Distal ="";
        $Male_Mesial  ="";
        $Male_Distal  ="";

        foreach($data_interlock as $interlock){
            if($interlock->Sex == 'Female' && $interlock->Side == 'Mesial'){
                $Female_Mesial = $interlock->Teeth_ID;
            }else if($interlock->Sex == 'Female' && $interlock->Side == 'Distal'){
                $Female_Distal = $interlock->Teeth_ID;
            }else if($interlock->Sex == 'Male' && $interlock->Side == 'Mesial'){
                $Male_Mesial = $interlock->Teeth_ID;
            }else if($interlock->Sex == 'Male' && $interlock->Side == 'Distal'){
                $Male_Distal = $interlock->Teeth_ID;
            }
        }//

        $job_complete =DB::select('SELECT
                                job.ID_order_screen
                            FROM
                                job
                            WHERE
                                job.job_current_department = 997
                            ', []);
        $count_job = 0;
        foreach($job_complete as $out_job_complete){
            if($out_job_complete->ID_order_screen == $id)
            {
                $count_job = 1;
            }
        }

        return view('screen.conclusion', compact('teeth_group','detail_screen_group','data_all','select_extra_additional',
        'select_IMPLANT_Attachment', 'data_Requirement','order','select_extra','data_implant','select_Attachment','id','flow',
        'data_select_attachment_additional','data_select_IMPLANT_Attachment_additional','teeth','endflow',
        'Female_Mesial','Female_Distal','Male_Mesial','Male_Distal','data_ref','count_job'));
    }

    public function screen($id)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $teeth = DB::select('SELECT
            order_teeth_screen.ID,
            order_teeth_screen.ScreenID,
            order_teeth_screen.TeethID,
            order_teeth_screen.TypeOfWorkID,
            order_teeth_screen.TypeOfProductID,
            order_teeth_screen.TypeOfGroupID,
            order_teeth_screen.GroupNo,
            order_teeth_screen.status
            FROM
            order_teeth_screen
            WHERE
            order_teeth_screen.ScreenID = ? AND
            order_teeth_screen.ID IN (( SELECT MAX( order_teeth_screen.ID ) FROM order_teeth_screen GROUP BY order_teeth_screen.TeethID ))', [$id]);

        $id_screen = DB::select('SELECT
                                screen.ID
                                FROM
                                screen
                                ORDER BY id DESC LIMIT 1', []);

        $data_Requirement = DB::select('SELECT
                                    type_Requirement.ID,
                                    type_Requirement.`Name`
                                    FROM
                                    type_Requirement', []);

        $processround = DB::select("SELECT
                                        processround.ID,
                                        processround.CompanyID,
                                        processround.production_cycle,
                                        processround.create_at
                                        FROM
                                        processround
                                        INNER JOIN Employee
                                        ON Employee.ID_user = ?
                                        INNER JOIN company
                                        ON company.ID = Employee.ID_company
                                        WHERE processround.CompanyID = company.ID
                                        ", [Auth::user()->id]);


        // return view('screen/screen1_1', compact('data_Requirement', 'id_screen', 'teeth', 'processround'));
        return view('screen/screen', compact('data_Requirement', 'id_screen', 'teeth', 'processround'));

        //return $teeth;
    }

    public function save(Request $request)
    {
        $order_screen = order_screen::where('ID', $request->ID_order_screen)->first();

        if ($request->checkjob == '1') {
            $data_job = new job();
            $data_job->ID_order_screen = $request->ID_order_screen;
            $data_job->BranchID = $order_screen->BranchID;
            $data_job->job_current_department = '0';
            $data_job->date_time_start = \Carbon\Carbon::now();
            $data_job->save();

            return redirect('/mainscreen');
        // return $order_screen;
        } else {
            $TeethID = array();

            //teeth
            if ($request->chkTooth_11 != null) {
                $TeethID[] = $request->chkTooth_11;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '11'  ", []);
            }
            if ($request->chkTooth_12 != null) {
                $TeethID[] = $request->chkTooth_12;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '12'  ", []);
            }
            if ($request->chkTooth_13 != null) {
                $TeethID[] = $request->chkTooth_13;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '13'  ", []);
            }
            if ($request->chkTooth_14 != null) {
                $TeethID[] = $request->chkTooth_14;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '14'  ", []);
            }
            if ($request->chkTooth_15 != null) {
                $TeethID[] = $request->chkTooth_15;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '15'  ", []);
            }
            if ($request->chkTooth_16 != null) {
                $TeethID[] = $request->chkTooth_16;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '16'  ", []);
            }
            if ($request->chkTooth_17 != null) {
                $TeethID[] = $request->chkTooth_17;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '17'  ", []);
            }
            if ($request->chkTooth_18 != null) {
                $TeethID[] = $request->chkTooth_18;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '18'  ", []);
            }
            if ($request->chkTooth_19 != null) {
                $TeethID[] = $request->chkTooth_19;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '19'  ", []);
            }
            if ($request->chkTooth_20 != null) {
                $TeethID[] = $request->chkTooth_20;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '20'  ", []);
            }
            if ($request->chkTooth_21 != null) {
                $TeethID[] = $request->chkTooth_21;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '21'  ", []);
            }
            if ($request->chkTooth_22 != null) {
                $TeethID[] = $request->chkTooth_22;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '22'  ", []);
            }
            if ($request->chkTooth_23 != null) {
                $TeethID[] = $request->chkTooth_23;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '23'  ", []);
            }
            if ($request->chkTooth_24 != null) {
                $TeethID[] = $request->chkTooth_24;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '24'  ", []);
            }
            if ($request->chkTooth_25 != null) {
                $TeethID[] = $request->chkTooth_25;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '25'  ", []);
            }
            if ($request->chkTooth_26 != null) {
                $TeethID[] = $request->chkTooth_26;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '26'  ", []);
            }
            if ($request->chkTooth_27 != null) {
                $TeethID[] = $request->chkTooth_27;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '27'  ", []);
            }
            if ($request->chkTooth_28 != null) {
                $TeethID[] = $request->chkTooth_28;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '28'  ", []);
            }
            if ($request->chkTooth_29 != null) {
                $TeethID[] = $request->chkTooth_29;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '29'  ", []);
            }
            if ($request->chkTooth_30 != null) {
                $TeethID[] = $request->chkTooth_30;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '30'  ", []);
            }
            if ($request->chkTooth_31 != null) {
                $TeethID[] = $request->chkTooth_31;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '31'  ", []);
            }
            if ($request->chkTooth_32 != null) {
                $TeethID[] = $request->chkTooth_32;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '32'  ", []);
            }
            if ($request->chkTooth_33 != null) {
                $TeethID[] = $request->chkTooth_33;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '33'  ", []);
            }
            if ($request->chkTooth_34 != null) {
                $TeethID[] = $request->chkTooth_34;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '34'  ", []);
            }
            if ($request->chkTooth_35 != null) {
                $TeethID[] = $request->chkTooth_35;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '35'  ", []);
            }
            if ($request->chkTooth_36 != null) {
                $TeethID[] = $request->chkTooth_36;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '36'  ", []);
            }
            if ($request->chkTooth_37 != null) {
                $TeethID[] = $request->chkTooth_37;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '37'  ", []);
            }
            if ($request->chkTooth_38 != null) {
                $TeethID[] = $request->chkTooth_38;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '38'  ", []);
            }
            if ($request->chkTooth_39 != null) {
                $TeethID[] = $request->chkTooth_39;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '39'  ", []);
            }
            if ($request->chkTooth_40 != null) {
                $TeethID[] = $request->chkTooth_40;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '40'  ", []);
            }
            if ($request->chkTooth_41 != null) {
                $TeethID[] = $request->chkTooth_41;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '41'  ", []);
            }
            if ($request->chkTooth_42 != null) {
                $TeethID[] = $request->chkTooth_42;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '42'  ", []);
            }
            if ($request->chkTooth_43 != null) {
                $TeethID[] = $request->chkTooth_43;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '43'  ", []);
            }
            if ($request->chkTooth_44 != null) {
                $TeethID[] = $request->chkTooth_44;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '44'  ", []);
            }
            if ($request->chkTooth_45 != null) {
                $TeethID[] = $request->chkTooth_45;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '45'  ", []);
            }
            if ($request->chkTooth_46 != null) {
                $TeethID[] = $request->chkTooth_46;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '46'  ", []);
            }
            if ($request->chkTooth_47 != null) {
                $TeethID[] = $request->chkTooth_47;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '47'  ", []);
            }
            if ($request->chkTooth_48 != null) {
                $TeethID[] = $request->chkTooth_48;
                DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '48'  ", []);
            }

            foreach ($TeethID as $out_TeethID) {
                $data_screen = new screen();
                $data_screen->TeethID = $out_TeethID;
                $data_screen->ID_order_screen = $request->ID_order_screen;
                $data_screen->Metal_type = $request->Metal_type;
                $data_screen->Hook = $request->Hook;
                $data_screen->MESIAL_REST = $request->MESIAL_REST;
                $data_screen->DISTAL_REST = $request->DISTAL_REST;
                $data_screen->CINGULUM_REST = $request->CINGULUM_REST;
                $data_screen->EMBRESSURE_REST = $request->EMBRESSURE_REST;
                $data_screen->LINGUAL_LEDGE = $request->LINGUAL_LEDGE;
                $data_screen->other_hook = $request->other_hook;
                $data_screen->undercut_hook = $request->undercut_hook;
                $data_screen->unit_hook = $request->unit_hook;
                $data_screen->UNDERCUT = $request->UNDERCUT;
                $data_screen->CONTOUR = $request->CONTOUR;
                $data_screen->unit_CONTOUR = $request->unit_CONTOUR;
                $data_screen->one_color = $request->one_color;
                $data_screen->one_color_Combobox = $request->one_color_Combobox;
                $data_screen->one_color_branch = $request->one_color_branch;
                $data_screen->one_color_branch_color = $request->one_color_branch_color;
                $data_screen->many_color_crowns = $request->many_color_crowns;
                $data_screen->many_branch_crowns = $request->many_branch_crowns;
                $data_screen->many_color_Middle = $request->many_color_Middle;
                $data_screen->many_branch_Middle = $request->many_branch_Middle;
                $data_screen->many_color_tip = $request->many_color_tip;
                $data_screen->many_branch_tip = $request->many_branch_tip;
                $data_screen->OCCLUSAL_STAINING = $request->OCCLUSAL_STAINING;
                $data_screen->PONTIC_DESIGN = $request->PONTIC_DESIGN;
                $data_screen->MARGIN = $request->MARGIN;
                $data_screen->Metal_Margin_detail = $request->Metal_Margin_detail;
                $data_screen->status = '1';

                $data_screen->save();
            }

            foreach ($TeethID as $TeethID) {
                //requirement
                if ($request->ดู_Wax_full_contour != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '1'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ดู_Wax_full_contour')", []);
                }
                if ($request->ดู_Wax_full_contour == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '1' ", []);
                }

                //ดู Contour porcelain

                if ($request->ดู_Contour_porcelain != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '2'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ดู_Contour_porcelain')", []);
                }
                if ($request->ดู_Contour_porcelain == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '2' ", []);
                }

                // //ดู Design ทางไลน์

                if ($request->ดู_Design_ทางไลน์ != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '3'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ดู_Design_ทางไลน์')", []);
                }
                if ($request->ดู_Design_ทางไลน์ == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '3' ", []);
                }

                // //ลองโครงก่อน

                if ($request->ลองโครงก่อน != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '4'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ลองโครงก่อน')", []);
                }
                if ($request->ลองโครงก่อน == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '4' ", []);
                }

                // //ลอง contour พอสเลนก่อนเกรซ

                if ($request->ลอง_contour_พอสเลนก่อนเกรซ != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '5'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ลอง_contour_พอสเลนก่อนเกรซ')", []);
                }
                if ($request->ลอง_contour_พอสเลนก่อนเกรซ == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '5' ", []);
                }

                // //ขอ SPURE ด้วย
                if ($request->ขอ_SPURE_ด้วย != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '6'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ขอ_SPURE_ด้วย')", []);
                }
                if ($request->ขอ_SPURE_ด้วย == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '6' ", []);
                }

                // //ทำ PINDEX
                if ($request->ทำ_PINDEX != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '7'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ทำ_PINDEX')", []);
                }
                if ($request->ทำ_PINDEX == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '7' ", []);
                }

                //จะส่งคนไข้มาเทียบสีที่ Lab
                if ($request->จะส่งคนไข้มาเทียบสีที่_Lab != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '8'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->จะส่งคนไข้มาเทียบสีที่_Lab')", []);
                }
                if ($request->จะส่งคนไข้มาเทียบสีที่_Lab == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '8' ", []);
                }

                //หมอส่งสีฟันมาทางไลน์
                if ($request->หมอส่งสีฟันมาทางไลน์ != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '9'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->หมอส่งสีฟันมาทางไลน์')", []);
                }
                if ($request->หมอส่งสีฟันมาทางไลน์ == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '9' ", []);
                }

                //ทางไลน์
                if ($request->ทางไลน์ != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '10'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ทางไลน์')", []);
                }
                if ($request->ทางไลน์ == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '10' ", []);
                }

                // //ส่งกลับ
                if ($request->ส่งกลับ != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '11'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ส่งกลับ')", []);
                }
                if ($request->ส่งกลับ == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '11' ", []);
                }

                // //ให้ช่างโทรกลับในขั้นตอน____________
                if ($request->ให้ช่างโทรกลับในขั้นตอน____________ != null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '12'", []);
                    DB::insert("INSERT INTO select_requirement (ID_order_screen, TeethID, ID_type_requirement) values ('$request->ID_order_screen', '$TeethID' ,'$request->ให้ช่างโทรกลับในขั้นตอน____________')", []);
                }
                if ($request->ให้ช่างโทรกลับในขั้นตอน____________ == null) {
                    DB::delete("DELETE FROM select_requirement WHERE TeethID = '$TeethID' AND ID_order_screen = '$request->ID_order_screen' AND ID_type_requirement = '12' ", []);
                }
            }

            return redirect('/mainscreen/screen/'.$request->ID_order_screen);
        }
    }

    public function continuouswork(Request $request, $id)
    {
        DB::update("UPDATE job SET job_current_department ='998' where  ID_order_screen = ?  ", [$id]);
        DB::update("UPDATE order_screen SET StartDate = '$request->StartDate',DeliverDate = '$request->DeliverDate'  where  ID = ?  ", [$id]);

        return redirect('/mainscreen');
    }

    public function updateDetailReqType(Request $request, $idScreen,$idTeeth)
    {
        DB::update("UPDATE screen SET detail ='$request->detail' where  ID_order_screen = '$idScreen' and TeethID = '$idTeeth' ", []);
        return redirect('mainscreen/detail/teeth/'.$idScreen);
    }

    public function checking_screen(Request $request)
    {
            $detail_screen_group =  DB::select("SELECT
                    screen.ID,
                    screen.ID_order_screen,
                    screen.TeethID,
                    screen.Metal_type,
                    screen.Hook,
                    screen.MESIAL_REST,
                    screen.DISTAL_REST,
                    screen.CINGULUM_REST,
                    screen.EMBRESSURE_REST,
                    screen.LINGUAL_LEDGE,
                    screen.other_hook,
                    screen.undercut_hook,
                    screen.unit_hook,
                    screen.UNDERCUT,
                    screen.CONTOUR,
                    screen.unit_CONTOUR,
                    screen.one_color,
                    screen.one_color_Combobox,
                    screen.one_color_branch,
                    screen.one_color_branch_color,
                    screen.many_color_crowns,
                    screen.many_branch_crowns,
                    screen.many_color_Middle,
                    screen.many_branch_Middle,
                    screen.many_color_tip,
                    screen.many_branch_tip,
                    screen.OCCLUSAL_STAINING,
                    screen.PONTIC_DESIGN,
                    screen.MARGIN1,
                    screen.Metal_Margin_detail,
                    screen.detail,
                    screen.`status`,
                    screen.created_at,
                    screen.updated_at,
                    screen.e_max,
                    screen.color,
                    screen.ceramage,
                    screen.zirconia_copping,
                    screen.zirconia_crown,
                    screen.zirconia_restoration,
                    screen.model,
                    screen.model_resin,
                    screen.implant,
                    screen.implant_ceramage,
                    screen.implant_screw,
                    screen.comment_emax_color,
                    screen.comment_ceramage,
                    screen.comment_zirconia,
                    screen.comment_model,
                    screen.comment_implant,
                    screen.comment_hook,
                    screen.comment_contour,
                    screen.comment_shade,
                    screen.comment_Metal_type,
                    screen.comment_occlusal_staining,
                    screen.comment_extra,
                    screen.comment_stump,
                    screen.comment_fix_cement,
                    screen.MARGIN2,
                    screen.MARGIN3,
                    screen.FixCement,
                    screen.GINGIVAL_EMBRASURES,
                    screen.OCCLUSION,
                    screen.CONTACT,
                    screen.shade,
                    screen.shade_brand,
                    screen.shade_color,
                    screen.stump,
                    -- screen.stump_Textarea,
                    screen.one_branch_stump,
                    screen.one_color_stump,
                    screen.screen_group,
                    screen.implant_brand,
                    screen_SHADE_Brand_1.`name` AS one_color_branch_name,
                    screen_SHADE_Colors_1.color AS one_color_name,
                    screen_SHADE_Brand_2.`name` AS one_color_branch_name_2,
                    screen_SHADE_Colors_2.color AS one_color_name_2,
                    screen_SHADE_Brand_3.`name` AS one_color_branch_name_3,
                    screen_SHADE_Colors_3.color AS one_color_name_3,
                    screen_SHADE_Brand_4.`name` AS one_color_branch_name_4,
                    screen_SHADE_Colors_4.color AS one_color_name_4,
                    screen_SHADE_Brand_5.`name` AS one_color_branch_name_5,
                    screen_SHADE_Colors_5.color AS one_color_name_5,
                    screen.txtCommentAlloys,
                    screen.txtCommentShade,
                    screen.txtCommentModel,
                    screen.txtCommentStump,
                    screen.txtCommentFixCement,
                    screen.Pintooth,
                    screen.PintoothHook,
                    screen.PintoothHookRest,
                    screen.PintoothAlloys,
                    screen.PintoothAlloysNote,
                    screen.PintoothAlloysComment,
                    screen.MARGIN_Buccal,
                    screen.MARGIN_Lingual,
                    screen.one_color_extra1,
                    screen.comment_Metal_type,
                    screen.Metal_type2,
                    screen.Metal_type3,
                    screen.Metal_type4,
                    screen.Metal_type5,
                    screen.Metal_type6
                    FROM
                    screen
                    LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_1 ON screen.one_color_branch = screen_SHADE_Brand_1.id
                    LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_1 ON screen.one_color_branch_color = screen_SHADE_Colors_1.id
                    LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_2 ON screen.many_branch_crowns = screen_SHADE_Brand_2.id
                    LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_2 ON screen.many_color_crowns = screen_SHADE_Colors_2.id
                    LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_3 ON screen.many_branch_Middle = screen_SHADE_Brand_3.id
                    LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_3 ON screen.many_color_Middle = screen_SHADE_Colors_3.id
                    LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_4 ON screen.many_branch_tip = screen_SHADE_Brand_4.id
                    LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_4 ON screen.many_color_tip = screen_SHADE_Colors_4.id
                    LEFT JOIN screen_SHADE_Brand AS screen_SHADE_Brand_5 ON screen.one_branch_stump = screen_SHADE_Brand_5.id
                    LEFT JOIN screen_SHADE_Colors AS screen_SHADE_Colors_5 ON screen.one_color_stump = screen_SHADE_Colors_5.id
                    WHERE
                    screen.ID_order_screen = ?
                    GROUP BY
                    screen.screen_group ", [$request->id_order_screen]
            );

            $teeth_group = DB::select("SELECT
                                    screen.TeethID,
                                    screen.screen_group,
                                    order_teeth.TypeOfWorkID,
                                    order_teeth.TypeOfProductID,
                                    type_of_work.`Name` as work_name,
                                    type_of_product.`Name` as product_name
                                    FROM
                                    screen
                                    LEFT JOIN order_teeth ON screen.TeethID = order_teeth.TeethID
                                    LEFT JOIN type_of_work ON order_teeth.TypeOfWorkID = type_of_work.ID
                                    LEFT JOIN type_of_product ON order_teeth.TypeOfProductID = type_of_product.ID
                                    WHERE
                                    screen.ID_order_screen = ?
                                    GROUP BY
                                    screen.TeethID ", [$request->id_order_screen]
            );

            $teeth =DB::select("SELECT
                Max(order_teeth_screen.ID),
                type_of_work.`Name` AS work_name,
                type_of_product.`Name` AS work_type,
                teeth.ID AS teeth,
                teeth.`Name` AS teeth_name,
                type_of_product.WorkGroupID,
                work_group.`Name` AS work_group,
                order_teeth_screen.TypeOfGroupID,
                type_of_group.`Name` AS name_group,
                order_teeth_screen.`status`,
                order_teeth_screen.ScreenID
                FROM
                order_teeth_screen
                LEFT JOIN type_of_work ON order_teeth_screen.TypeOfWorkID = type_of_work.ID
                LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
                LEFT JOIN teeth ON order_teeth_screen.TeethID = teeth.ID
                LEFT JOIN work_group ON type_of_product.WorkGroupID = work_group.ID
                LEFT JOIN type_of_group ON order_teeth_screen.TypeOfGroupID = type_of_group.ID
                WHERE
                order_teeth_screen.ScreenID = ?
                GROUP BY
                order_teeth_screen.TeethID", [$request->id_order_screen]
            );

            return array($detail_screen_group,$teeth_group,$teeth);
    }

    public function getIndex_90day(Request $request) {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }
        return view('screen.mainscreen_90day_before');
    }
}
