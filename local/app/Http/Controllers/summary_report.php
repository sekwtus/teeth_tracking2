<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Gate;
use App\order_screen;
use App\job;
use App\job_detail;
use App\screen_file;

class summary_report extends Controller
{
    public function index()
    {
        return 0;
    }


    public function select_summary(Request $request, $id)
    {
        $data_id = job::where('ID_order_screen', $id)->limit(1)->first();

        $data_job_flow = [];
        if ($data_id != null || $data_id != '') {

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
        }

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

        $data_detail_screen =  DB::select("SELECT
                                    order_screen.ID,
                                    order_screen.Barcode,
                                    order_screen.RefBarcode,
                                    order_screen.FactoryID,
                                    order_screen.BranchID,
                                    order_screen.CustomerID,
                                    customer.`Name` AS customer_name,
                                    order_screen.DoctorID,
                                    doctor.`Name` AS doctor_name,
                                    order_screen.SaleID,
                                    Employee.`Name` AS employee_name,
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
                                    processround.CompanyID,
                                    company.`Name` AS company_name,
                                    Employee.ID_area,
                                    order_screen.Datefinal,
                                    processround.production_cycle
                                    FROM
                                    order_screen
                                    INNER JOIN Employee ON order_screen.SaleID = Employee.ID_user
                                    INNER JOIN customer ON order_screen.CustomerID = customer.ID
                                    INNER JOIN doctor ON order_screen.DoctorID = doctor.ID
                                    LEFT JOIN processround ON order_screen.processroundID = processround.ID
                                    LEFT JOIN company ON processround.CompanyID = company.ID
                                    WHERE
                                    order_screen.ID = $id ");

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

        $data_req = DB::select("SELECT
                                select_req.ID,
                                select_req.ID_order_screen,
                                select_req.TeethID,
                                select_req.topic,
                                select_req.count,
                                select_req.detail,
                                select_req.created_at
                                FROM
                                select_req
                                WHERE
                                select_req.ID_order_screen = $id");

        $data_extra = DB::select("SELECT
                                select_extra.ID,
                                select_extra.ID_order_screen,
                                GROUP_CONCAT( DISTINCT teeth.`Name` ) AS Teeth_name,
                                select_extra.topic,
                                select_extra.detail,
                                select_extra.detail_2,
                                select_extra.created_at
                                FROM
                                select_extra
                                LEFT JOIN teeth ON select_extra.TeethID = teeth.ID
                                WHERE
                                select_extra.ID_order_screen = $id
                                GROUP BY
                                select_extra.topic
                                ");

        if (!empty($data_id->ID)) {
            $data_qc = DB::select("SELECT
                                Job_QC.ID,
                                Job_QC.Job_ID,
                                Job_QC.Job_detail_ID,
                                Job_QC.QC_ID,
                                Job_QC.Type_QC,
                                Job_QC.ID_screen,
                                Job_QC.note,
                                qcchecklist.productID,
                                qcchecklist.departmentID,
                                qcchecklist.sub_department,
                                GROUP_CONCAT( DISTINCT qcchecklist.ccp ) AS ccp
                                FROM
                                Job_QC
                                LEFT JOIN qcchecklist ON Job_QC.QC_ID = qcchecklist.ID
                                WHERE
                                Job_QC.Job_ID = '$data_id->ID'
                                GROUP BY
                                Job_QC.Job_ID");
        } else {
            $data_qc = DB::select("SELECT
                                Job_QC.ID,
                                Job_QC.Job_ID,
                                Job_QC.Job_detail_ID,
                                Job_QC.QC_ID,
                                Job_QC.Type_QC,
                                Job_QC.ID_screen,
                                Job_QC.note,
                                qcchecklist.productID,
                                qcchecklist.departmentID,
                                qcchecklist.sub_department,
                                GROUP_CONCAT( DISTINCT qcchecklist.ccp ) AS ccp
                                FROM
                                Job_QC
                                LEFT JOIN qcchecklist ON Job_QC.QC_ID = qcchecklist.ID");
        }

        return view('summary_report', compact(
            'data_job_flow',
            'data_order_screen',
            'data_detail_screen',
            'teeth',
            'data_req',
            'data_extra',
            'data_qc'
        ));
    }

    public function summary($id)
    {
        $order = DB::select("SELECT
                            order_screen.ID,
                            order_screen.Barcode,
                            order_screen.RefBarcode,
                            order_screen.FactoryID,
                            order_screen.BranchID,
                            order_screen.Model,
                            order_screen.OralScan,
                            type_Branch.`Name` as branch_name,
                            type_Branch.companyID,
                            company.Name AS company_name,
                            order_screen.CustomerID,
                            order_screen.DoctorID,
                            order_screen.SaleID,
                            order_screen.SaleID_Close,
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
                            customer.`Name` AS customer,
                            doctor.`Name` AS doctor,
                            customer_type.`name` AS customer_type,
                            type_Deliver.`Name` AS DeliverType,
                            Employee_1.Nick_name AS Employee,
                            Employee_2.Nick_name AS Employee_2,
                            Employee_1.ID_area AS 'ID_area',
                            department_1.`Name` AS department,
                            area.`Name` AS area,
                            zone.Name AS sub_department_name,
                            customer.CustomerCode,
                            order_screen.technician_recommend,
                            Employee_1.`Name` AS employee_name,
                            Employee_2.`Name` AS employee_name_2,
                            order_screen.note,
                            processround.production_cycle,
                            order_screen.Datefinal,
                            order_screen.ContiBarcode,
                            -- sub_department.Name AS sub_department_name,
                            department_2.Name AS department_name,
                            work_defect_1.name_type AS name_type_1,
                            work_defect_1.detail_type AS detail_type_1,
                            work_defect_2.name_type AS name_type_2,
                            work_defect_2.detail_type AS detail_type_2,
                            type_of_con.`Name` AS type_of_con_name
                            FROM
                            order_screen
                            LEFT JOIN Employee AS Employee_1 ON Employee_1.ID_user = order_screen.SaleID
                            LEFT JOIN Employee AS Employee_2 ON Employee_2.ID_user = order_screen.SaleID_Close
                            LEFT JOIN users ON users.ID = order_screen.SaleID
                            LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                            LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                            LEFT JOIN area ON order_screen.AreaID = area.ID
                            LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                            LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                            LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                            LEFT JOIN department AS department_1 ON job.job_current_department = department_1.ID
                            LEFT JOIN type_Branch ON type_Branch.ID = order_screen.BranchID
                            LEFT JOIN company ON company.ID = type_Branch.companyID
                            LEFT JOIN processround ON order_screen.processroundID = processround.ID
                            LEFT JOIN user_subDepartments ON user_subDepartments.user_id = order_screen.SaleID
                            LEFT JOIN sub_department ON sub_department.ID = user_subDepartments.Sub_DepartmentID
                            LEFT JOIN department AS department_2 ON department_2.ID = sub_department.DepartmentID
                            LEFT JOIN zone ON area.ZoneID = zone.ID
                            LEFT JOIN work_defect AS work_defect_1 ON order_screen.ddlWorkLate = work_defect_1.id
                            LEFT JOIN work_defect AS work_defect_2 ON order_screen.ddlTypeEdit = work_defect_2.id
                            LEFT JOIN type_of_con ON order_screen.type_of_con = type_of_con.ID
                            WHERE
                            order_screen.ID = ?
                            ORDER BY
                            order_screen.ID DESC
                            LIMIT 1", [$id]);
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
                                screen.Pintooth,
                                screen.PintoothHook,
                                screen.PintoothHookRest,
                                screen.PintoothAlloys,
                                screen.PintoothAlloysNote,
                                screen.PintoothAlloysComment,

                                screen.txtCommentAlloys,
                                screen.txtCommentShade,
                                screen.txtCommentStump,
                                screen.txtCommentModel,
                                screen.txtCommentFixCement,
                                screen.MARGIN_Buccal,
                                screen.MARGIN_Lingual,
                                screen.Metal_type,
                                screen.Metal_type2,
                                screen.Metal_type3,
                                screen.Metal_type4,
                                screen.Metal_type5,
                                screen.Metal_type6,
                                screen.comment_Metal_type,
                                screen.one_color_extra1

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

        $teeth = DB::select('SELECT
                                    order_teeth_screen.ID,
                                    order_teeth_screen.ScreenID,
                                    order_teeth_screen.TeethID,
                                    order_teeth_screen.TypeOfWorkID,
                                    order_teeth_screen.TypeOfProductID,
                                    order_teeth_screen.TypeOfGroupID,
                                    order_teeth_screen.GroupNo,
                                    type_of_work.`Name` AS work_name,
                                    type_of_product.`Name` AS work_type,
                                    teeth.`Name` AS teeth_name,
                                    type_of_product.WorkGroupID,
                                    work_group.`Name` AS work_group,
                                    type_of_group.NAME AS name_group,
                                    order_teeth_screen.status
                                    FROM
                                    order_teeth_screen
                                    LEFT JOIN type_of_work ON order_teeth_screen.TypeOfWorkID = type_of_work.ID
                                    LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
                                    LEFT JOIN teeth ON order_teeth_screen.TeethID = teeth.ID
                                    LEFT JOIN work_group ON type_of_product.WorkGroupID = work_group.ID
                                    LEFT JOIN type_of_group ON order_teeth_screen.TypeOfGroupID = type_of_group.ID
                                    WHERE
                                    order_teeth_screen.ScreenID = ? AND
                                    order_teeth_screen.ID IN (( SELECT MAX( order_teeth_screen.ID ) FROM order_teeth_screen GROUP BY order_teeth_screen.TeethID ))', [$id]);

        $job = DB::select('SELECT
                            job_detail.ID,
                            job_detail.JobID,
                            job_detail.ID_order_screen,
                            job_detail.DepartmentID,
                            job_detail.Sub_DepartmentID,
                            job_detail.EmployeeID,
                            job_detail.created_at,
                            job_detail.updated_at,
                            job_detail.status_job_detail,
                            job_detail.detail_job,
                            department.NAME AS department_name,
                            sub_department.NAME AS sub_department_name,
                            Employee.NAME AS Employee_Name,
                            Employee.Nick_name AS Nick_name,
                            type_Branch.NAME AS Branch_name,
                            company.NAME AS company_name,
                            sub_department.ID AS ID_Sub_Depart,
                            job_detail.Note_QC,
                            job_detail.Note_Service,
                            department2.`Name` as qc_backward_dep_name
                        FROM
                            job_detail
                            LEFT JOIN department ON department.ID = job_detail.DepartmentID
                            LEFT JOIN sub_department ON sub_department.ID = job_detail.Sub_DepartmentID
                            LEFT JOIN Employee ON Employee.ID_user = job_detail.EmployeeID
                            LEFT JOIN type_Branch ON type_Branch.ID = Employee.ID_type_Branch
                            LEFT JOIN company ON company.ID = type_Branch.companyID 
                            LEFT JOIN department as department2 ON department2.ID = job_detail.detail_job
                        WHERE
                            job_detail.ID_order_screen = ?
                        ORDER BY
                            job_detail.ID', [$id]);

        $job_sale = DB::select('SELECT
                            job.ID,
                            job.ID_order_screen,
                            job.job_current_department,
                            job.updated_at
                            FROM
                            job
                            WHERE
                            job.ID_order_screen = ? AND job.job_current_department = 997', [$id]);

        $qcchecklist = DB::select('SELECT
                                        qcchecklist.ID,
                                        qcchecklist.productID,
                                        qcchecklist.departmentID,
                                        qcchecklist.sub_department,
                                        qcchecklist.ccp,
                                        qcchecklist.created_at,
                                        qcchecklist.updated_at,
                                        department.Name AS departmentName,
                                        sub_department.Name AS sub_departmentName
                                        FROM
                                        qcchecklist
                                        INNER JOIN department ON qcchecklist.departmentID = department.ID
                                        INNER JOIN sub_department ON department.ID = sub_department.DepartmentID
                            ', [$id]);

        $screen = DB::select('SELECT
                            screen.ID,
                            screen.EmployeeID,
                            screen.created_at,
                            screen.ID_order_screen,
                            Employee.Name AS Employee_Name,
                            Employee.Nick_name AS Nick_name,
                            type_Branch.Name AS Branch_name,
                            company.Name AS company_name
                            FROM
                            screen
                            LEFT JOIN Employee ON Employee.ID_user = screen.EmployeeID
                            LEFT JOIN type_Branch ON type_Branch.ID = Employee.ID_type_Branch
                            LEFT JOIN company ON company.ID = type_Branch.companyID
                            WHERE screen.ID_order_screen = ?
                            GROUP BY screen.ID_order_screen
                            ', [$id]);

        $Job_QC = DB::select("SELECT
                            Job_QC.ID,
                            Job_QC.Job_ID,
                            Job_QC.Job_detail_ID,
                            Job_QC.QC_ID,
                            Job_QC.Employee_ID,
                            Job_QC.ToDepartmentID,
                            qcchecklist.ccp,
                            GROUP_CONCAT(qcchecklist.ccp  SEPARATOR ',      ') AS detail_ccp
                            FROM
                            Job_QC
                            LEFT JOIN qcchecklist ON Job_QC.QC_ID = qcchecklist.ID
                            -- WHERE Job_QC.Job_ID = 51921
                            GROUP BY Job_QC.Job_detail_ID
                            ", []);

        $teeth_group = DB::select('SELECT
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
                order_screen.ID = ?', [$id]);
        $teeth2 = DB::select('SELECT
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
                order_teeth_screen.TeethID', [$id]);

        $data_ref = DB::select('SELECT
                    order_screen.ID,
                    order_screen.Barcode,
                    order_screen.RefBarcode,
                    order_screen.ddlTypeEdit,
                    order_screen.comment_Workdefect2,
                    order_screen.comment_Workdefect1,
                    work_defect_2.name_type AS name_type_2,
                    work_defect_2.detail_type AS detail_type_2
                FROM
                    order_screen
                    LEFT JOIN work_defect AS work_defect_2 ON order_screen.ddlTypeEdit = work_defect_2.id
                ORDER BY
                    order_screen.ID ASC ', []);

        // $production_process = DB::select('SELECT
        //         production_process.type_product_id,
        //         production_process.department_id,
        //         department.`Name`,
        //         type_of_product.`Name` as product_name
        //         FROM
        //         production_process
        //         LEFT JOIN department ON production_process.department_id = department.ID
        //         LEFT JOIN type_of_product ON production_process.type_product_id = type_of_product.ID
        //         ', []);

        // query interlock
        $data_interlock = DB::select("SELECT
                     *
                     FROM
                     INTERLOCK
                     WHERE
                     INTERLOCK.screen_ID = ?
                     ", [$id]);

        $Female_Mesial = "";
        $Female_Distal = "";
        $Male_Mesial  = "";
        $Male_Distal  = "";

        foreach ($data_interlock as $interlock) {
            if ($interlock->Sex == 'Female' && $interlock->Side == 'Mesial') {
                $Female_Mesial = $interlock->Teeth_ID;
            } else if ($interlock->Sex == 'Female' && $interlock->Side == 'Distal') {
                $Female_Distal = $interlock->Teeth_ID;
            } else if ($interlock->Sex == 'Male' && $interlock->Side == 'Mesial') {
                $Male_Mesial = $interlock->Teeth_ID;
            } else if ($interlock->Sex == 'Male' && $interlock->Side == 'Distal') {
                $Male_Distal = $interlock->Teeth_ID;
            }
        } //
        $type_of_product = DB::select('SELECT
            order_teeth_screen.TypeOfProductID
        FROM
            order_screen
            INNER JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID
        WHERE
            order_screen.ID = ?
            LIMIT 1', [$id]);
        if (!empty($type_of_product)) {
            $production_process = DB::select('SELECT
            production_process.type_product_id,
            production_process.department_id,
            production_process.point,
            department.`Name` AS department
        FROM
            production_process
            INNER JOIN department ON production_process.department_id = department.ID
        WHERE
            production_process.type_product_id = ?', [$type_of_product[0]->TypeOfProductID]);
        } else {
            $production_process = null;
        }

        $job_flow = DB::select('SELECT
                            job_detail.ID,
                            job_detail.JobID,
                            job_detail.ID_order_screen,
                            job_detail.DepartmentID,
                            job_detail.Sub_DepartmentID,
                            job_detail.EmployeeID,
                            job_detail.created_at,
                            job_detail.updated_at,
                            job_detail.status_job_detail,
                            department.Name AS department_name,
                            sub_department.Name AS sub_department_name,
                            Employee.Name AS Employee_Name,
                            Employee.Nick_name AS Nick_name,
                            type_Branch.Name AS Branch_name,
                            company.Name AS company_name,
                            sub_department.ID AS ID_Sub_Depart,
                            job_detail.Note_QC,
                            job_detail.Note_Service
                            FROM
                            job_detail
                            LEFT JOIN department ON department.ID = job_detail.DepartmentID
                            LEFT JOIN sub_department ON sub_department.ID = job_detail.Sub_DepartmentID
                            LEFT JOIN Employee ON Employee.ID_user = job_detail.EmployeeID
                            LEFT JOIN type_Branch ON type_Branch.ID = Employee.ID_type_Branch
                            LEFT JOIN company ON company.ID = type_Branch.companyID
                            WHERE
                            job_detail.ID_order_screen = ?
                            GROUP BY
                            job_detail.DepartmentID
                            ORDER BY job_detail.ID', [$id]);

            $file = screen_file::where(['screen_id'=>$id])
            ->get(['name_file','created_at','type']);
            // $result = screen_file::where(['ind_id'=>$ind_id, 'office_id'=>Auth::User()->office_id, 'round'=>$round])->first();

            if(!$file){
                $file = json_decode('{"name_file":""}');
            }

        // return $id;
        // dd($job,$Job_QC);
        return view('summary', compact(
            'order',
            'select_extra',
            'select_Attachment',
            'select_IMPLANT_Attachment',
            'select_extra_additional',
            'data_select_attachment_additional',
            'data_select_IMPLANT_Attachment_additional',
            'teeth',
            'job',
            'qcchecklist',
            'screen',
            'job_sale',
            'Job_QC',
            'detail_screen_group',
            'teeth_group',
            'flow',
            'id',
            'teeth2',
            'Female_Mesial',
            'Female_Distal',
            'Male_Mesial',
            'Male_Distal',
            'production_process',
            'data_ref',
            'job_flow',
            'file'
        ));

        // return $order;
    }


    public function Del_Transection($job_detail_id, $order_screen_id)
    {
        DB::delete("DELETE FROM job_detail WHERE job_detail.ID = ?", [$job_detail_id]);
        DB::delete("DELETE FROM Job_QC WHERE Job_QC.Job_detail_ID = ?", [$job_detail_id]);
        $Last_Job_detail = DB::select('SELECT
                                            job_detail.ID,
                                            job_detail.JobID,
                                            job_detail.ID_screen,
                                            job_detail.ID_order_screen,
                                            job_detail.DepartmentID,
                                            job_detail.Sub_DepartmentID,
                                            job_detail.job_status
                                        FROM
                                            job_detail
                                        WHERE
                                            job_detail.ID_order_screen = ?
                                        ORDER BY
                                            job_detail.ID DESC
                                            LIMIT 1 ', [$order_screen_id]);
        $Job_detail = DB::select('SELECT
                job_detail.ID
                FROM
                job_detail
                WHERE
                job_detail.ID_order_screen = ? ', [$order_screen_id]);

        if (empty($Job_detail)) {
            DB::update("UPDATE job set job_current_department = null, job_current_sub_department = null, status = null
            WHERE job.ID_order_screen = ? ", [$order_screen_id]);
        } else {
            foreach ($Last_Job_detail as $key => $last) {
                DB::update("UPDATE job set job_current_department = ?, job_current_sub_department = ?, status = ?
                WHERE job.ID_order_screen = ? ", [$last->DepartmentID, $last->Sub_DepartmentID, $last->job_status, $order_screen_id]);
            }
        }
        return redirect('/summary_report/' . $order_screen_id);
    }
}
