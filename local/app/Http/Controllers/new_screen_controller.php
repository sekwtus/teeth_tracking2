<?php

namespace App\Http\Controllers;

use App\job;
use App\order_screen;
use App\screen;
use App\select_Attachment;
use App\select_extra;
use App\select_IMPLANT_Attachment;
use App\select_extra_additional;
use App\select_Attachment_additional;
use App\select_IMPLANT_Attachment_additional;
use App\order_sale;
use App\order_teeth;
use App\type_of_group;
use App\order_teeth_screen;
use App\screen_file;
use Auth;
use DB;
use Gate;
use Illuminate\Http\Request;
use Artisan;

class new_screen_controller extends Controller
{
    public function screen($id)
    {
        Artisan::call('cache:clear');
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $job_check = job::where('ID_order_screen', $id)->first();
        if(!empty($job_check) && $job_check->job_current_department != "0")
        {
            return redirect('/mainscreen/detail/teeth/' . $id);
        }


        $screen_SHADE_Brand = DB::select('SELECT
            screen_SHADE_Brand.id,
            screen_SHADE_Brand.name,
            screen_SHADE_Brand.create_at
            FROM
            screen_SHADE_Brand
        ');

        $screen_SHADE_Colors = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
        ');

        $work_defect1 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 1
        ', []);
        $work_defect2 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 2
        ', []);
        $work_defect3 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 3
        ', []);
        $work_defect4 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 4
        ', []);

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
            order_teeth_screen.ScreenID = ?
            -- AND order_teeth_screen.ID IN (( SELECT MAX( order_teeth_screen.ID ) FROM order_teeth_screen GROUP BY order_teeth_screen.TeethID ))
            ', [$id]);
        // return $teeth;

        $processround = DB::select('SELECT
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
            ', [Auth::user()->id]);

        $type_Deliver = DB::select('SELECT
            type_Deliver.ID,
            type_Deliver.`Name`,
            type_Deliver.create_at
            FROM
            type_Deliver
        ');

        $order = DB::select("SELECT
                order_screen.ID,
                order_screen.Barcode,
                order_screen.RefBarcode,
                order_screen.ContiBarcode,
                order_screen.FactoryID,
                order_screen.BranchID,
                order_screen.CustomerID,
                order_screen.DoctorID,
                order_screen.SaleID,
                order_screen.StartDate,
                order_screen.DeliverDate,
                order_screen.Delaydate,
                order_screen.Delaytime,
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
                order_screen.phone,
                order_screen.Address,
                order_screen.processroundID,
                order_screen.Datefinal,
                order_screen.technician_recommend,
                order_screen.line_doctor,
                order_screen.phone_doctor,
                order_screen.phone_customer,
                order_screen.FinalTime,
                order_screen.DeliverDate_comment,
                order_screen.note,
                order_screen.type_of_con,
                order_screen.Employee_DeliverDate_comment,
                order_screen.comment_WorkLate,
                order_screen.comment_WorkLate_before,
                order_screen.comment_Workdefect1,
                order_screen.comment_Workdefect2,
                customer.`Name` AS customer,
                customer.ID AS customerID,
                customer.CustomerCode AS CustomerCode,
                doctor.ID AS doctorID,
                doctor.`Name` AS doctor,
                doctor.Line_doctor,
                customer_type.`name` AS customer_type,
                type_Deliver.`Name` AS DeliverType_name,
                Employee.Nick_name AS Employee,
                Employee.`Name` AS name_Employee,
                department.`Name` AS department,
                area.`Name` AS ID_area,
                processround.production_cycle AS production_cycle_order,
                company.fullname AS company_name,
                type_Branch.`Name` AS branch_name,
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
                LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                LEFT JOIN area ON order_screen.AreaID = area.ID
                LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                LEFT JOIN department ON job.job_current_department = department.ID
                LEFT JOIN processround ON order_screen.processroundID = processround.ID
                LEFT JOIN company ON order_screen.FactoryID = company.ID
                LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                LEFT JOIN work_defect AS work_defect_1 ON order_screen.ddlWorkLate = work_defect_1.id
                LEFT JOIN work_defect AS work_defect_2 ON order_screen.ddlTypeEdit = work_defect_2.id
                LEFT JOIN type_of_con ON order_screen.type_of_con = type_of_con.ID
            WHERE
                order_screen.ID = ?
            ORDER BY
                order_screen.ID DESC", [$id]);

        $order_teeth_screen = DB::select('SELECT
                                            order_teeth_screen.ID,
                                            order_teeth_screen.status,
                                            type_of_work.`Name` AS work_name,
                                            type_of_product.`Name` AS work_type,
                                            teeth.`Name` AS teeth_name,
                                            type_of_product.WorkGroupID,
                                            work_group.`Name` AS work_group,
                                            TypeOfGroupID,
                                            type_of_group.Name AS name_group
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
                                            teeth.`Name` ', [$id]);

        $data_select_extra_additional = DB::select('SELECT
                                            select_extra_additional.ID,
                                            select_extra_additional.detail
                                            FROM
                                            select_extra_additional
                                            WHERE
                                            select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_extra = DB::select('SELECT
                                            select_extra.topic,
                                            select_extra.detail,
                                            select_extra.date,
                                            select_extra.note
                                            FROM
                                            select_extra
                                            WHERE
                                            select_extra.ID_order_screen = ?', [$id]);

        $data_select_attachment = DB::select('SELECT
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

        $data_select_IMPLANT_Attachment = DB::select('SELECT
                                            select_IMPLANT_Attachment.ID,
                                            select_IMPLANT_Attachment.ID_order_screen,
                                            select_IMPLANT_Attachment.topic,
                                            select_IMPLANT_Attachment.number,
                                            select_IMPLANT_Attachment.assign,
                                            select_IMPLANT_Attachment.created_at,
                                            select_IMPLANT_Attachment.updated_at
                                            FROM
                                            select_IMPLANT_Attachment
                                            WHERE
                                            select_IMPLANT_Attachment.ID_order_screen = ?', [$id]);

        $data_select_extra_additional = DB::select('SELECT
        select_extra_additional.ID,
        select_extra_additional.detail
        FROM
        select_extra_additional
        WHERE
        select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_IMPLANT_Attachment_additional = DB::select('SELECT
        select_IMPLANT_Attachment_additional.ID,
        select_IMPLANT_Attachment_additional.detail
        FROM
        select_IMPLANT_Attachment_additional
        WHERE
        select_IMPLANT_Attachment_additional.ID_order_screen = ?', [$id]);

        $data_select_attachment_additional = DB::select('SELECT
        select_Attachment_additional.ID,
        select_Attachment_additional.detail
        FROM
        select_Attachment_additional
        WHERE
        select_Attachment_additional.ID_order_screen = ?', [$id]);

            $extra = "";
            $extra_attachment = "";
            $extra_implant_attachment = "";

            foreach($data_select_extra_additional as $out_data_select_extra_additional)
            {
                $extra = $out_data_select_extra_additional->detail;
            }

            foreach($data_select_IMPLANT_Attachment_additional as $out_data_select_IMPLANT_Attachment_additional)
            {
                $extra_implant_attachment = $out_data_select_IMPLANT_Attachment_additional->detail;
            }

            foreach($data_select_attachment_additional as $out_data_select_attachment_additional)
            {
                $extra_attachment = $out_data_select_attachment_additional->detail;
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

            $ID_customer = $order[0]->customerID;
            $list_doctor = DB::select('SELECT
            customer_doctor.ID,
            customer_doctor.Name_doctor,
            customer_doctor.Name_customer,
            doctor.`Name`
            FROM
            customer_doctor
            INNER JOIN doctor ON customer_doctor.Name_doctor = doctor.ID
            WHERE
            customer_doctor.Name_customer = ?',[$ID_customer]);
        $type_of_con = DB::select('Select * from type_of_con');
        // return view('screen/screen', compact('teeth', 'processround', 'order', 'processround', 'id', 'order_teeth_screen'));
        // return $order;

         $company = DB::select('SELECT
                    company.ID,
                    company.`Name`,
                    company.fullname,
                    company.name_eng,
                    company.address,
                    company.create_at
                    FROM
                    company
        ');

         $type_Branch = DB::select('SELECT
                    type_Branch.ID,
                    type_Branch.`Name`,
                    type_Branch.companyID,
                    type_Branch.lab,
                    type_Branch.AreaID,
                    type_Branch.ZoneID,
                    type_Branch.send_object,
                    type_Branch.send_bill,
                    type_Branch.Tel,
                    type_Branch.Fax,
                    type_Branch.HN,
                    type_Branch.TaxID,
                    type_Branch.create_at
                    FROM
                    type_Branch
        ');

        $customer = DB::select('SELECT
                    customer.ID,
                    customer.CustomerCode2,
                    customer.CustomerCode,
                    customer.`Name`,
                    customer.short_Name,
                    customer.CustomerTypeID,
                    customer.AreaID,
                    customer.NameCustomer1,
                    customer.NameCustomer2,
                    customer.send_object,
                    customer.send_bill,
                    customer.Tel,
                    customer.HN,
                    customer.TaxID,
                    customer.`status`,
                    customer.CustomerName,
                    customer.CustomerAddress,
                    customer.CustomerVisitor,
                    customer.CustomerCredit,
                    customer.CustomerLimitMoney,
                    customer.CustomerTel1,
                    customer.CustomerTel2,
                    customer.CustomerTaxID,
                    customer.CustomerAccNo,
                    customer.CustomerTransport,
                    customer.lat,
                    customer.lon,
                    customer.province,
                    customer.Country
                    FROM
                    customer
        ');

            $file = screen_file::where(['screen_id'=>$id])
            ->get(['name_file','created_at']);
            // $result = screen_file::where(['ind_id'=>$ind_id, 'office_id'=>Auth::User()->office_id, 'round'=>$round])->first();

            if(!$file){
                $file = json_decode('{"name_file":""}');
            }

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

        return view('screen/new_screen', compact('work_defect1','work_defect2','work_defect3','work_defect4','teeth',
         'processround', 'order', 'processround', 'id', 'order_teeth_screen', 'data_select_extra', 'type_Deliver',
          'data_select_attachment', 'data_select_IMPLANT_Attachment', 'screen_SHADE_Brand', 'screen_SHADE_Colors',
          'data_select_extra_additional','extra','extra_implant_attachment','extra_attachment','list_doctor',
        'Female_Mesial','Female_Distal','Male_Mesial','Male_Distal','type_of_con','company','type_Branch','customer','file','count_job','endflow'));
    }

    public function editgeneralscreen($id)
    {
        Artisan::call('cache:clear');
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $screen_SHADE_Brand = DB::select('SELECT
            screen_SHADE_Brand.id,
            screen_SHADE_Brand.name,
            screen_SHADE_Brand.create_at
            FROM
            screen_SHADE_Brand
        ');

        $screen_SHADE_Colors = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
        ');

        $work_defect1 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 1
        ', []);
        $work_defect2 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 2
        ', []);
        $work_defect3 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 3
        ', []);
        $work_defect4 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 4
        ', []);

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
            order_teeth_screen.ScreenID = ?
            -- AND order_teeth_screen.ID IN (( SELECT MAX( order_teeth_screen.ID ) FROM order_teeth_screen GROUP BY order_teeth_screen.TeethID ))
            ', [$id]);

        $processround = DB::select('SELECT
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
            ', [Auth::user()->id]);

        $type_Deliver = DB::select('SELECT
            type_Deliver.ID,
            type_Deliver.`Name`,
            type_Deliver.create_at
            FROM
            type_Deliver
        ');

        $order = DB::select("SELECT
            order_screen.ID,
            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.ContiBarcode,
            order_screen.FactoryID,
            order_screen.BranchID,
            order_screen.CustomerID,
            order_screen.DoctorID,
            order_screen.SaleID,
            order_screen.StartDate,
            order_screen.DeliverDate,
            order_screen.Delaydate,
            order_screen.Delaytime,
            order_screen.DeliverType,
            order_screen.DeliverDate_comment,
            order_screen.PatientHN,
            order_screen.PatientName,
            order_screen.PatientSex,
            order_screen.PatientAge,
            order_screen.created_at,
            order_screen.updated_at,
            order_screen.ReceptionTime,
            order_screen.`comment`,
            order_screen.AreaID,
            order_screen.phone,
            order_screen.Address,
            order_screen.processroundID,
            order_screen.Datefinal,
            order_screen.technician_recommend,
            order_screen.line_doctor,
            order_screen.phone_doctor,
            order_screen.phone_customer,
            order_screen.FinalTime,
            order_screen.note,
            order_screen.type_of_con,
            order_screen.Employee_DeliverDate_comment,
            order_screen.comment_WorkLate,
            order_screen.comment_WorkLate_before,
            order_screen.comment_Workdefect1,
            order_screen.comment_Workdefect2,
            customer.`Name` AS customer,
            customer.`ID` AS customerID,
            customer.CustomerCode AS 'CustomerCode',
            doctor.`ID` AS doctorID,
            doctor.`Name` AS doctor,
            doctor.Line_doctor ,
            customer_type.`name` AS customer_type,
            type_Deliver.`Name` AS DeliverType_name,
            Employee.Nick_name AS 'Employee',
            Employee.name AS 'name_Employee',
            Employee.ID_area AS 'ID_area',
            department.`Name` as department,
            area.Name AS 'area',
            processround.production_cycle AS 'production_cycle_order',
            company.fullname AS 'company_name',
            type_Branch.Name AS 'branch_name',
            work_defect_1.name_type AS name_type_1,
            work_defect_1.detail_type AS detail_type_1,
            work_defect_2.name_type AS name_type_2,
            work_defect_2.detail_type AS detail_type_2,
            order_screen.ddlWorkLate,
            order_screen.ddlTypeEdit,
            type_of_con.`Name` AS type_of_con_name
            FROM
            order_screen
            LEFT JOIN area ON order_screen.AreaID = area.ID
            LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
            LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
            LEFT JOIN customer ON customer.ID = order_screen.CustomerID
            LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
            LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
            LEFT JOIN job ON job.ID_order_screen = order_screen.ID
            LEFT JOIN department ON job.job_current_department = department.ID
            LEFT JOIN processround ON order_screen.processroundID = processround.ID
            LEFT JOIN company ON order_screen.FactoryID = company.ID
            LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
            LEFT JOIN work_defect AS work_defect_1 ON order_screen.ddlWorkLate = work_defect_1.id
            LEFT JOIN work_defect AS work_defect_2 ON order_screen.ddlTypeEdit = work_defect_2.id
            LEFT JOIN type_of_con ON order_screen.type_of_con = type_of_con.ID
            WHERE
            order_screen.ID = ?
            ORDER BY
            order_screen.ID DESC
            LIMIT 1", [$id]);

        $ID_customer = $order[0]->customerID;

        $list_doctor = DB::select('SELECT
            customer_doctor.ID,
            customer_doctor.Name_doctor,
            customer_doctor.Name_customer,
            doctor.`Name`
            FROM
            customer_doctor
            INNER JOIN doctor ON customer_doctor.Name_doctor = doctor.ID
            WHERE
            customer_doctor.Name_customer = ?',[$ID_customer]);

        $order_teeth_screen = DB::select('SELECT
                                            order_teeth_screen.ID,
                                            order_teeth_screen.status,
                                            type_of_work.`Name` AS work_name,
                                            type_of_product.`Name` AS work_type,
                                            teeth.`Name` AS teeth_name,
                                            type_of_product.WorkGroupID,
                                            work_group.`Name` AS work_group,
                                            TypeOfGroupID,
                                            type_of_group.Name AS name_group
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
                                            teeth.`Name` ', [$id]);

        $data_select_extra_additional = DB::select('SELECT
                                            select_extra_additional.ID,
                                            select_extra_additional.detail
                                            FROM
                                            select_extra_additional
                                            WHERE
                                            select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_extra = DB::select('SELECT
                                            select_extra.topic,
                                            select_extra.detail,
                                            select_extra.date,
                                            select_extra.note
                                            FROM
                                            select_extra
                                            WHERE
                                            select_extra.ID_order_screen = ?', [$id]);

        $data_select_attachment = DB::select('SELECT
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

        $data_select_IMPLANT_Attachment = DB::select('SELECT
                                            select_IMPLANT_Attachment.ID,
                                            select_IMPLANT_Attachment.ID_order_screen,
                                            select_IMPLANT_Attachment.topic,
                                            select_IMPLANT_Attachment.number,
                                            select_IMPLANT_Attachment.assign,
                                            select_IMPLANT_Attachment.created_at,
                                            select_IMPLANT_Attachment.updated_at
                                            FROM
                                            select_IMPLANT_Attachment
                                            WHERE
                                            select_IMPLANT_Attachment.ID_order_screen = ?', [$id]);

        $data_select_extra_additional = DB::select('SELECT
        select_extra_additional.ID,
        select_extra_additional.detail
        FROM
        select_extra_additional
        WHERE
        select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_IMPLANT_Attachment_additional = DB::select('SELECT
        select_IMPLANT_Attachment_additional.ID,
        select_IMPLANT_Attachment_additional.detail
        FROM
        select_IMPLANT_Attachment_additional
        WHERE
        select_IMPLANT_Attachment_additional.ID_order_screen = ?', [$id]);

        $data_select_attachment_additional = DB::select('SELECT
        select_Attachment_additional.ID,
        select_Attachment_additional.detail
        FROM
        select_Attachment_additional
        WHERE
        select_Attachment_additional.ID_order_screen = ?', [$id]);

            $extra = "";
            $extra_attachment = "";
            $extra_implant_attachment = "";

            foreach($data_select_extra_additional as $out_data_select_extra_additional)
            {
                $extra = $out_data_select_extra_additional->detail;
            }

            foreach($data_select_IMPLANT_Attachment_additional as $out_data_select_IMPLANT_Attachment_additional)
            {
                $extra_implant_attachment = $out_data_select_IMPLANT_Attachment_additional->detail;
            }

            foreach($data_select_attachment_additional as $out_data_select_attachment_additional)
            {
                $extra_attachment = $out_data_select_attachment_additional->detail;
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
            $type_of_con = DB::select('Select * from type_of_con');
        // return view('screen/screen', compact('teeth', 'processround', 'order', 'processround', 'id', 'order_teeth_screen'));
        // return $order;

        $company = DB::select('SELECT
                    company.ID,
                    company.`Name`,
                    company.fullname,
                    company.name_eng,
                    company.address,
                    company.create_at
                    FROM
                    company
        ');

         $type_Branch = DB::select('SELECT
                    type_Branch.ID,
                    type_Branch.`Name`,
                    type_Branch.companyID,
                    type_Branch.lab,
                    type_Branch.AreaID,
                    type_Branch.ZoneID,
                    type_Branch.send_object,
                    type_Branch.send_bill,
                    type_Branch.Tel,
                    type_Branch.Fax,
                    type_Branch.HN,
                    type_Branch.TaxID,
                    type_Branch.create_at
                    FROM
                    type_Branch
        ');

        $customer = DB::select('SELECT
                    customer.ID,
                    customer.CustomerCode2,
                    customer.CustomerCode,
                    customer.`Name`,
                    customer.short_Name,
                    customer.CustomerTypeID,
                    customer.AreaID,
                    customer.NameCustomer1,
                    customer.NameCustomer2,
                    customer.send_object,
                    customer.send_bill,
                    customer.Tel,
                    customer.HN,
                    customer.TaxID,
                    customer.`status`,
                    customer.CustomerName,
                    customer.CustomerAddress,
                    customer.CustomerVisitor,
                    customer.CustomerCredit,
                    customer.CustomerLimitMoney,
                    customer.CustomerTel1,
                    customer.CustomerTel2,
                    customer.CustomerTaxID,
                    customer.CustomerAccNo,
                    customer.CustomerTransport,
                    customer.lat,
                    customer.lon,
                    customer.province,
                    customer.Country
                    FROM
                    customer
        ');

            $file = screen_file::where(['screen_id'=>$id])
            ->get(['name_file','created_at']);
            // $result = screen_file::where(['ind_id'=>$ind_id, 'office_id'=>Auth::User()->office_id, 'round'=>$round])->first();

            if(!$file){
                $file = json_decode('{"name_file":""}');
            }

        return view('screen/edit_general_screen', compact('work_defect1','work_defect2','work_defect3','work_defect4',
        'teeth', 'processround', 'order', 'processround', 'id', 'order_teeth_screen', 'data_select_extra', 'type_Deliver',
         'data_select_attachment', 'data_select_IMPLANT_Attachment', 'screen_SHADE_Brand', 'screen_SHADE_Colors',
         'data_select_extra_additional','extra','extra_implant_attachment','extra_attachment','list_doctor',
         'Female_Mesial','Female_Distal','Male_Mesial','Male_Distal','type_of_con','company','type_Branch','customer','file'));
    }

    public function edit_conclusion($id,$group)
    {
        Artisan::call('cache:clear');
        // $id = 490;
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }
        $teeth = DB::select("SELECT
            screen.screen_group,
            screen.ID_order_screen,
            screen.TeethID,
            order_teeth_screen.ScreenID,
            order_teeth_screen.ID,
            order_teeth_screen.OrderID,
            order_teeth_screen.TeethID,
            order_teeth_screen.TypeOfWorkID,
            order_teeth_screen.TypeOfProductID,
            order_teeth_screen.TypeOfGroupID,
            order_teeth_screen.GroupNo,
            order_teeth_screen.`status`
            FROM
            screen
            LEFT JOIN order_teeth_screen ON screen.ID_order_screen = order_teeth_screen.ScreenID AND screen.TeethID = order_teeth_screen.TeethID
            WHERE
            screen.screen_group = '$group' AND
            screen.ID_order_screen = ?
            GROUP BY
            screen.TeethID
            ", [$id]);

        $processround = DB::select('SELECT
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
            ', [Auth::user()->id]);

        $type_Deliver = DB::select('SELECT
            type_Deliver.ID,
            type_Deliver.`Name`,
            type_Deliver.create_at
            FROM
            type_Deliver
        ');

        $order = DB::select("SELECT
            order_screen.ID,
            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.ContiBarcode,
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
            order_screen.phone,
            order_screen.Address,
            order_screen.processroundID,
            order_screen.Datefinal,
            order_screen.technician_recommend,
            order_screen.line_doctor,
            order_screen.phone_doctor,
            order_screen.phone_customer,
            order_screen.FinalTime,
            order_screen.note,
            customer.`Name` AS customer,
            customer.CustomerCode AS 'CustomerCode',
            doctor.`Name` AS doctor,
            doctor.Line_doctor ,
            customer_type.`name` AS customer_type,
            type_Deliver.`Name` AS DeliverType_name,
            Employee.Nick_name AS 'Employee',
            Employee.name AS 'name_Employee',
            Employee.ID_area AS 'ID_area',
            department.`Name` as department,
            area.Name AS 'area',
            processround.production_cycle AS 'production_cycle_order',
            company.fullname AS 'company_name',
            type_Branch.Name AS 'branch_name'
            FROM
            order_screen
            LEFT JOIN area ON order_screen.AreaID = area.ID
            LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
            LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
            LEFT JOIN customer ON customer.ID = order_screen.CustomerID
            LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
            LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
            LEFT JOIN job ON job.ID_order_screen = order_screen.ID
            LEFT JOIN department ON job.job_current_department = department.ID
            LEFT JOIN processround ON order_screen.processroundID = processround.ID
            LEFT JOIN company ON order_screen.FactoryID = company.ID
            LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
            WHERE
            order_screen.ID = ?", [$id]);

        $order_teeth_screen = DB::select("SELECT
                                            Max(order_teeth_screen.ID) as ID,
                                            type_of_work.`Name` AS work_name,
                                            type_of_work.ID AS work_name_ID,
                                            type_of_product.`Name` AS work_type,
                                            type_of_product.ID AS work_type_id,
                                            teeth.`Name` AS teeth_name,
                                            teeth.ID AS teeth_name_ID,
                                            type_of_product.WorkGroupID,
                                            work_group.`Name` AS work_group,
                                            TypeOfGroupID,
                                            type_of_group.NAME AS name_group,
                                            type_of_group.ID AS name_group_ID,
                                            order_teeth_screen.`status`
                                        FROM
                                            order_teeth_screen
                                            LEFT JOIN type_of_work ON order_teeth_screen.TypeOfWorkID = type_of_work.ID
                                            LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
                                            LEFT JOIN teeth ON order_teeth_screen.TeethID = teeth.ID
                                            LEFT JOIN work_group ON type_of_product.WorkGroupID = work_group.ID
                                            LEFT JOIN type_of_group ON order_teeth_screen.TypeOfGroupID = type_of_group.ID
                                        WHERE
                                            order_teeth_screen.ScreenID = $id
                                            AND order_teeth_screen.TeethID IN (
                                            (
                                        SELECT
                                            screen.TeethID
                                        FROM
                                            screen
                                            LEFT JOIN order_teeth_screen ON screen.ID_order_screen = order_teeth_screen.ScreenID
                                            AND screen.TeethID = order_teeth_screen.TeethID
                                        WHERE
                                            screen.screen_group = '$group'
                                            AND screen.ID_order_screen = $id
                                        GROUP BY
                                            screen.TeethID
                                            ))
                                        GROUP BY
                                        order_teeth_screen.TeethID", []);

        $data_select_extra_additional = DB::select('SELECT
                                            select_extra_additional.ID,
                                            select_extra_additional.detail
                                            FROM
                                            select_extra_additional
                                            WHERE
                                            select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_extra = DB::select('SELECT
                                            select_extra.topic,
                                            select_extra.detail,
                                            select_extra.date,
                                            select_extra.note
                                            FROM
                                            select_extra
                                            WHERE
                                            select_extra.ID_order_screen = ?', [$id]);

        $data_select_attachment = DB::select('SELECT
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

        $data_select_IMPLANT_Attachment = DB::select('SELECT
                                            select_IMPLANT_Attachment.ID,
                                            select_IMPLANT_Attachment.ID_order_screen,
                                            select_IMPLANT_Attachment.topic,
                                            select_IMPLANT_Attachment.number,
                                            select_IMPLANT_Attachment.assign,
                                            select_IMPLANT_Attachment.created_at,
                                            select_IMPLANT_Attachment.updated_at
                                            FROM
                                            select_IMPLANT_Attachment
                                            WHERE
                                            select_IMPLANT_Attachment.ID_order_screen = ?', [$id]);

            $extra = "";

            foreach($data_select_extra_additional as $out_data_select_extra_additional)
            {
                $extra = $out_data_select_extra_additional->detail;
            }
            $data_screen = DB::select('SELECT
            screen.ID,
            screen.ID_order_screen,
            screen.TeethID,
            screen.Metal_type,
            screen.Metal_type2,
            screen.Metal_type3,
            screen.Metal_type4,
            screen.Metal_type5,
            screen.Metal_type6,
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
            screen.implant_brand_comment,
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
            screen.one_branch_stump,
            screen.one_color_stump,
            screen.screen_group,
            screen.comment_stump,
            screen.comment_fix_cement,
            screen.implant_brand,
            screen.txtCommentAlloys,
            screen.txtCommentShade,
            screen.txtCommentStump,
            screen.txtCommentModel,
            screen.txtCommentFixCement,
            screen.Pintooth,
            screen.PintoothHook,
            screen.PintoothHookRest,
            screen.PintoothAlloys,
            screen.PintoothAlloysNote,
            screen.PintoothAlloysComment,
            screen.MARGIN_Buccal,
            screen.MARGIN_Lingual
            FROM
            screen
            WHERE
            screen.screen_group = ? AND screen.ID_order_screen = ?
            GROUP BY
            screen.screen_group
            ',[$group,$id]);
        // return view('screen/screen', compact('teeth', 'processround', 'order', 'processround', 'id', 'order_teeth_screen'));
        // return $order;

        $screen_SHADE_Brand = DB::select('SELECT
            screen_SHADE_Brand.id,
            screen_SHADE_Brand.name,
            screen_SHADE_Brand.create_at
            FROM
            screen_SHADE_Brand
        ');
        $screen_SHADE_Colors = null;
        $screen_SHADE_Colors1 = null;
        $screen_SHADE_Colors2 = null;
        $screen_SHADE_Colors3 = null;
        $screen_STUMP_Colors = null;
        if($data_screen != null){
        //SHADE สีเดียว
        $screen_SHADE_Colors = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->one_color_branch]
        );

        //SHADE หลายสี(คอฟัน)
        $screen_SHADE_Colors1 = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->many_branch_crowns]
        );
        //SHADE หลายสี(กลางฟัน)
        $screen_SHADE_Colors2 = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->many_branch_Middle]
        );
        //SHADE หลายสี(ปลายฟัน)
        $screen_SHADE_Colors3 = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->many_branch_tip]
        );

        //STUMP สีเดียว
        $screen_STUMP_Colors = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->one_branch_stump]
        );
        }
        $teeth_not_in = DB::select('SELECT
                teeth.ID,
                teeth.`Name`
            FROM
                teeth
            WHERE
                teeth.ID
                NOT IN (
            SELECT
                screen.TeethID
            FROM
                screen
                LEFT JOIN order_teeth_screen ON screen.ID_order_screen = order_teeth_screen.ScreenID
                AND screen.TeethID = order_teeth_screen.TeethID
            WHERE
                screen.ID_order_screen = ?
            GROUP BY
                screen.TeethID)',[$id]);

        $product_not_in = DB::select('SELECT
                type_of_product.ID,
                type_of_product.`Name`
            FROM
                type_of_product');

        $group_not_in = DB::select('SELECT
                type_of_group.ID,
                type_of_group.`Name`
            FROM
                type_of_group');
        $work_not_in = DB::select('SELECT
                type_of_work.ID,
                type_of_work.`Name`
            FROM
                type_of_work');

        return view('screen/edit_conclusion', compact('teeth', 'processround', 'order', 'processround',
        'id','group' ,'order_teeth_screen', 'data_select_extra', 'type_Deliver', 'data_select_attachment',
        'data_select_IMPLANT_Attachment', 'screen_SHADE_Brand', 'screen_SHADE_Colors', 'screen_SHADE_Colors1',
        'screen_SHADE_Colors2', 'screen_SHADE_Colors3', 'screen_STUMP_Colors', 'data_select_extra_additional',
        'extra','data_screen','teeth_not_in','work_not_in','group_not_in','product_not_in'));
    }

    public function save_edit_conclusion($id,$screen_group,Request $request)
    {
        $job_check = job::where('ID_order_screen', $request->ID_order_screen)->first();

        DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,DepartmentID,Sub_DepartmentID,EmployeeID,created_at) VALUES(?, ?, '2', '73', ? , ?)
            ",[$job_check->ID,$id,Auth::user()->id,now()]);
        $TeethID = array();
        $new_screen_group = "";
            for ($i = 11; $i <= 48; $i++) {
                $chkTooth = "chkTooth_" . $i;
                if ($request->input($chkTooth) != null) {
                    $TeethID[] = $request->input($chkTooth);
                    $new_screen_group = $new_screen_group . $i .",";
                }
            }
        $new_screen_group = substr($new_screen_group, 0, -1);

        $ShadeOne = null;
        $ColorOne = null;
        $ShadeBrandMulti1 = null;
        $ShadeColorMulti1 = null;
        $ShadeBrandMulti2 = null;
        $ShadeColorMulti2 = null;
        $ShadeBrandMulti3 = null;
        $ShadeColorMulti3 = null;
        $StumpBrand = null;
        $StumpColor = null;
        foreach ($TeethID as $out_TeethID) {
            if($request->ddlShadeBrand == 'อื่นๆ'){
                $ShadeOne = $request->txtShadeOne;
                $ColorOne = $request->txtColorOne;
            }else{
                $ShadeOne = $request->ddlShadeBrand;
                $ColorOne = $request->ddlShadeColor;
            }
            if($request->ddlShadeBrandMulti1 == 'อื่นๆ'){
                $ShadeBrandMulti1 = $request->txtShadeBrandMulti1;
                $ShadeColorMulti1 = $request->txtShadeColorMulti1;
            }else{
                $ShadeBrandMulti1 = $request->ddlShadeBrandMulti1;
                $ShadeColorMulti1 = $request->ddlShadeColordMulti1;
            }
            if($request->ddlShadeBrandMulti2 == 'อื่นๆ'){
                $ShadeBrandMulti2 = $request->txtShadeBrandMulti2;
                $ShadeColorMulti2 = $request->txtShadeColorMulti2;
            }else{
                $ShadeBrandMulti2 = $request->ddlShadeBrandMulti2;
                $ShadeColorMulti2 = $request->ddlShadeColordMulti2;
            }
            if($request->ddlShadeBrandMulti3 == 'อื่นๆ'){
                $ShadeBrandMulti3 = $request->txtShadeBrandMulti3;
                $ShadeColorMulti3 = $request->txtShadeColorMulti3;
            }else{
                $ShadeBrandMulti3 = $request->ddlShadeBrandMulti3;
                $ShadeColorMulti3 = $request->ddlShadeColordMulti3;
            }
            if($request->ddlStumpBrand == 'อื่นๆ'){
                $StumpBrand = $request->txtStumpBrand;
                $StumpColor = $request->txtStumpColor;
            }else{
                $StumpBrand = $request->ddlStumpBrand;
                $StumpColor = $request->ddlStumpColor;
            }
        DB::update("UPDATE screen SET
                model = '$request->rdoGroupModel',
                model_resin = '$request->rdoModelResin',
                implant = '$request->rdoGroupRetained',
                implant_ceramage = '$request->rdoGroupSystem',
                -- implant_screw = '$request->rdoGroupBrand',
                Metal_type = '$request->rdoAlloys1',
                Metal_type2 = '$request->rdoAlloys2',
                Metal_type3 = '$request->rdoAlloys3',
                Metal_type4 = '$request->rdoAlloys4',
                Metal_type5 = '$request->rdoAlloys5',
                Metal_type6 = '$request->rdoAlloys6',
                Hook = '$request->rdoRest',
                MESIAL_REST = '$request->chkHaveRest1',
                DISTAL_REST = '$request->chkHaveRest2',
                CINGULUM_REST = '$request->chkHaveRest3',
                EMBRESSURE_REST = '$request->chkHaveRest5',
                LINGUAL_LEDGE = '$request->chkHaveRest4',
                other_hook = '$request->rdoUndercut',
                undercut_hook = '$request->rdoGroupHaveUndercut',
                unit_CONTOUR = '$request->rdoUnder',
                OCCLUSAL_STAINING = '$request->rdoStaining',
                PONTIC_DESIGN = '$request->PONTIC_DESIGN',
                MARGIN1 = '$request->MARGIN1',
                MARGIN2 = '$request->MARGIN2',
                MARGIN3 = '$request->MARGIN3',
                FixCement = '$request->rdoFixCement',
                GINGIVAL_EMBRASURES = '$request->chkGingival',
                OCCLUSION = '$request->chkOcclusion',
                CONTACT = '$request->chkContact',
                shade = '$request->rdoShade',
                one_color = '$request->rdoGroupShade',
                one_color_Combobox = '$request->txtDoctorShade',
                one_color_branch = '$ShadeOne',
                one_color_branch_color = '$ColorOne',
                many_color_crowns = '$ShadeColorMulti1',
                many_branch_crowns = '$ShadeBrandMulti1',
                many_branch_Middle = '$ShadeBrandMulti2',
                many_color_Middle = '$ShadeColorMulti2',
                many_branch_tip = '$ShadeBrandMulti3',
                many_color_tip = '$ShadeColorMulti3',
                stump = '$request->rdoGroupStump',
                one_branch_stump = '$StumpBrand',
                one_color_stump = '$StumpColor',

                comment_shade = '$request->txtDoctorShade',
                comment_stump = '$request->txtDoctorStump',
                comment_Metal_type = '$request->txtDoctorAlloys',
                comment_model = '$request->txtDoctorModel',
                comment_fix_cement = '$request->txtDoctorFix',
                screen_group = '$new_screen_group',
                status = '1',
                implant_brand = '$request->rdoGroupImpBrand',
                implant_brand_comment = '$request->txtImpBrandOther',
                txtCommentAlloys = '$request->txtCommentAlloys',
                txtCommentShade = '$request->txtCommentShade',
                txtCommentStump = '$request->txtCommentStump',
                txtCommentModel = '$request->txtCommentModel',
                txtCommentFixCement = '$request->txtCommentFixCement',
                MARGIN_Buccal = '$request->MARGIN_Buccal',
                MARGIN_Lingual = '$request->MARGIN_Lingual',
                Pintooth = '$request->rdopintooth',
                PintoothHook = '$request->rdopintoothhook',
                PintoothHookRest = '$request->chkHaveRestpintooth',
                PintoothAlloys = '$request->chkpintoothalloys',
                PintoothAlloysNote = '$request->Notepintoothalloys',
                PintoothAlloysComment = '$request->Commentpintoothalloys'

                where ID_order_screen = '$request->ID_order_screen'
                AND TeethID = $out_TeethID", []);
        }
        return redirect('/mainscreen/detail/teeth/' . $request->ID_order_screen);
    }

    public function edit_on_screening($id,$group)
    {
        Artisan::call('cache:clear');
        // $id = 490;
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }
        $teeth = DB::select("SELECT
            screen.screen_group,
            screen.ID_order_screen,
            screen.TeethID,
            order_teeth_screen.ScreenID,
            order_teeth_screen.ID,
            order_teeth_screen.OrderID,
            order_teeth_screen.TeethID,
            order_teeth_screen.TypeOfWorkID,
            order_teeth_screen.TypeOfProductID,
            order_teeth_screen.TypeOfGroupID,
            order_teeth_screen.GroupNo,
            order_teeth_screen.`status`
            FROM
            screen
            LEFT JOIN order_teeth_screen ON screen.ID_order_screen = order_teeth_screen.ScreenID AND screen.TeethID = order_teeth_screen.TeethID
            WHERE
            screen.screen_group = '$group' AND
            screen.ID_order_screen = ?
            GROUP BY
            screen.TeethID
            ", [$id]);

        $processround = DB::select('SELECT
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
            ', [Auth::user()->id]);

        $type_Deliver = DB::select('SELECT
            type_Deliver.ID,
            type_Deliver.`Name`,
            type_Deliver.create_at
            FROM
            type_Deliver
        ');

        $order = DB::select("SELECT
            order_screen.ID,
            order_screen.Barcode,
            order_screen.RefBarcode,
            order_screen.ContiBarcode,
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
            order_screen.phone,
            order_screen.Address,
            order_screen.processroundID,
            order_screen.Datefinal,
            order_screen.technician_recommend,
            order_screen.line_doctor,
            order_screen.phone_doctor,
            order_screen.phone_customer,
            order_screen.FinalTime,
            order_screen.note,
            customer.`Name` AS customer,
            customer.CustomerCode AS 'CustomerCode',
            doctor.`Name` AS doctor,
            doctor.Line_doctor ,
            customer_type.`name` AS customer_type,
            type_Deliver.`Name` AS DeliverType_name,
            Employee.Nick_name AS 'Employee',
            Employee.name AS 'name_Employee',
            Employee.ID_area AS 'ID_area',
            department.`Name` as department,
            area.Name AS 'area',
            processround.production_cycle AS 'production_cycle_order',
            company.fullname AS 'company_name',
            type_Branch.Name AS 'branch_name'
            FROM
            order_screen
            LEFT JOIN area ON order_screen.AreaID = area.ID
            LEFT JOIN Employee ON Employee.ID_user=order_screen.SaleID
            LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
            LEFT JOIN customer ON customer.ID = order_screen.CustomerID
            LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
            LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
            LEFT JOIN job ON job.ID_order_screen = order_screen.ID
            LEFT JOIN department ON job.job_current_department = department.ID
            LEFT JOIN processround ON order_screen.processroundID = processround.ID
            LEFT JOIN company ON order_screen.FactoryID = company.ID
            LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
            WHERE
            order_screen.ID = ?", [$id]);

        $order_teeth_screen = DB::select("SELECT
                                            Max(order_teeth_screen.ID) as ID,
                                            type_of_work.`Name` AS work_name,
                                            type_of_work.ID AS work_name_ID,
                                            type_of_product.`Name` AS work_type,
                                            type_of_product.ID AS work_type_id,
                                            teeth.`Name` AS teeth_name,
                                            teeth.ID AS teeth_name_ID,
                                            type_of_product.WorkGroupID,
                                            work_group.`Name` AS work_group,
                                            TypeOfGroupID,
                                            type_of_group.NAME AS name_group,
                                            type_of_group.ID AS name_group_ID,
                                            order_teeth_screen.`status`
                                        FROM
                                            order_teeth_screen
                                            LEFT JOIN type_of_work ON order_teeth_screen.TypeOfWorkID = type_of_work.ID
                                            LEFT JOIN type_of_product ON order_teeth_screen.TypeOfProductID = type_of_product.ID
                                            LEFT JOIN teeth ON order_teeth_screen.TeethID = teeth.ID
                                            LEFT JOIN work_group ON type_of_product.WorkGroupID = work_group.ID
                                            LEFT JOIN type_of_group ON order_teeth_screen.TypeOfGroupID = type_of_group.ID
                                        WHERE
                                            order_teeth_screen.ScreenID = $id
                                            AND order_teeth_screen.TeethID IN (
                                            (
                                        SELECT
                                            screen.TeethID
                                        FROM
                                            screen
                                            LEFT JOIN order_teeth_screen ON screen.ID_order_screen = order_teeth_screen.ScreenID
                                            AND screen.TeethID = order_teeth_screen.TeethID
                                        WHERE
                                            screen.screen_group = '$group'
                                            AND screen.ID_order_screen = $id
                                        GROUP BY
                                            screen.TeethID
                                            ))
                                        GROUP BY
                                        order_teeth_screen.TeethID", []);

        $data_select_extra_additional = DB::select('SELECT
                                            select_extra_additional.ID,
                                            select_extra_additional.detail
                                            FROM
                                            select_extra_additional
                                            WHERE
                                            select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_extra = DB::select('SELECT
                                            select_extra.topic,
                                            select_extra.detail,
                                            select_extra.date,
                                            select_extra.note
                                            FROM
                                            select_extra
                                            WHERE
                                            select_extra.ID_order_screen = ?', [$id]);

        $data_select_attachment = DB::select('SELECT
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

        $data_select_IMPLANT_Attachment = DB::select('SELECT
                                            select_IMPLANT_Attachment.ID,
                                            select_IMPLANT_Attachment.ID_order_screen,
                                            select_IMPLANT_Attachment.topic,
                                            select_IMPLANT_Attachment.number,
                                            select_IMPLANT_Attachment.assign,
                                            select_IMPLANT_Attachment.created_at,
                                            select_IMPLANT_Attachment.updated_at
                                            FROM
                                            select_IMPLANT_Attachment
                                            WHERE
                                            select_IMPLANT_Attachment.ID_order_screen = ?', [$id]);

            $extra = "";

            foreach($data_select_extra_additional as $out_data_select_extra_additional)
            {
                $extra = $out_data_select_extra_additional->detail;
            }
            $data_screen = DB::select('SELECT
            screen.ID,
            screen.ID_order_screen,
            screen.TeethID,
            screen.Metal_type,
            screen.Metal_type2,
            screen.Metal_type3,
            screen.Metal_type4,
            screen.Metal_type5,
            screen.Metal_type6,
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
            screen.implant_brand_comment,
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
            screen.one_branch_stump,
            screen.one_color_stump,
            screen.screen_group,
            screen.comment_stump,
            screen.comment_fix_cement,
            screen.implant_brand,
            screen.txtCommentAlloys,
            screen.txtCommentShade,
            screen.txtCommentStump,
            screen.txtCommentModel,
            screen.txtCommentFixCement,
            screen.Pintooth,
            screen.PintoothHook,
            screen.PintoothHookRest,
            screen.PintoothAlloys,
            screen.PintoothAlloysNote,
            screen.PintoothAlloysComment,
            screen.MARGIN_Buccal,
            screen.MARGIN_Lingual
            FROM
            screen
            WHERE
            screen.screen_group = ? AND screen.ID_order_screen = ?
            GROUP BY
            screen.screen_group
            ',[$group,$id]);
        // return view('screen/screen', compact('teeth', 'processround', 'order', 'processround', 'id', 'order_teeth_screen'));
        // return $order;

        $screen_SHADE_Brand = DB::select('SELECT
            screen_SHADE_Brand.id,
            screen_SHADE_Brand.name,
            screen_SHADE_Brand.create_at
            FROM
            screen_SHADE_Brand
        ');
        $screen_SHADE_Colors = null;
        $screen_SHADE_Colors1 = null;
        $screen_SHADE_Colors2 = null;
        $screen_SHADE_Colors3 = null;
        $screen_STUMP_Colors = null;
        if($data_screen != null){
        //SHADE สีเดียว
        $screen_SHADE_Colors = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->one_color_branch]
        );

        //SHADE หลายสี(คอฟัน)
        $screen_SHADE_Colors1 = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->many_branch_crowns]
        );
        //SHADE หลายสี(กลางฟัน)
        $screen_SHADE_Colors2 = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->many_branch_Middle]
        );
        //SHADE หลายสี(ปลายฟัน)
        $screen_SHADE_Colors3 = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->many_branch_tip]
        );

        //STUMP สีเดียว
        $screen_STUMP_Colors = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
            WHERE
            screen_SHADE_Colors.id_Shade_Brand = ?', [$data_screen[0]->one_branch_stump]
        );
        }
        $teeth_not_in = DB::select('SELECT
                teeth.ID,
                teeth.`Name`
            FROM
                teeth
            WHERE
                teeth.ID
                NOT IN (
            SELECT
                screen.TeethID
            FROM
                screen
                LEFT JOIN order_teeth_screen ON screen.ID_order_screen = order_teeth_screen.ScreenID
                AND screen.TeethID = order_teeth_screen.TeethID
            WHERE
                screen.ID_order_screen = ?
            GROUP BY
                screen.TeethID)',[$id]);

        $product_not_in = DB::select('SELECT
                type_of_product.ID,
                type_of_product.`Name`
            FROM
                type_of_product');

        $group_not_in = DB::select('SELECT
                type_of_group.ID,
                type_of_group.`Name`
            FROM
                type_of_group');
        $work_not_in = DB::select('SELECT
                type_of_work.ID,
                type_of_work.`Name`
            FROM
                type_of_work');

        return view('screen/edit_on_screening', compact('teeth', 'processround', 'order', 'processround',
        'id','group' ,'order_teeth_screen', 'data_select_extra', 'type_Deliver', 'data_select_attachment',
        'data_select_IMPLANT_Attachment', 'screen_SHADE_Brand', 'screen_SHADE_Colors', 'screen_SHADE_Colors1',
        'screen_SHADE_Colors2', 'screen_SHADE_Colors3', 'screen_STUMP_Colors', 'data_select_extra_additional',
        'extra','data_screen','teeth_not_in','work_not_in','group_not_in','product_not_in'));
    }

    public function save_edit_on_screening($id,$screen_group,Request $request)
    {
        $TeethID = array();
        $new_screen_group = "";
            for ($i = 11; $i <= 48; $i++) {
                $chkTooth = "chkTooth_" . $i;
                if ($request->input($chkTooth) != null) {
                    $TeethID[] = $request->input($chkTooth);
                    $new_screen_group = $new_screen_group . $i .",";
                }
            }
        $new_screen_group = substr($new_screen_group, 0, -1);

        $ShadeOne = null;
        $ColorOne = null;
        $ShadeBrandMulti1 = null;
        $ShadeColorMulti1 = null;
        $ShadeBrandMulti2 = null;
        $ShadeColorMulti2 = null;
        $ShadeBrandMulti3 = null;
        $ShadeColorMulti3 = null;
        $StumpBrand = null;
        $StumpColor = null;
        foreach ($TeethID as $out_TeethID) {
            if($request->ddlShadeBrand == 'อื่นๆ'){
                $ShadeOne = $request->txtShadeOne;
                $ColorOne = $request->txtColorOne;
            }else{
                $ShadeOne = $request->ddlShadeBrand;
                $ColorOne = $request->ddlShadeColor;
            }
            if($request->ddlShadeBrandMulti1 == 'อื่นๆ'){
                $ShadeBrandMulti1 = $request->txtShadeBrandMulti1;
                $ShadeColorMulti1 = $request->txtShadeColorMulti1;
            }else{
                $ShadeBrandMulti1 = $request->ddlShadeBrandMulti1;
                $ShadeColorMulti1 = $request->ddlShadeColordMulti1;
            }
            if($request->ddlShadeBrandMulti2 == 'อื่นๆ'){
                $ShadeBrandMulti2 = $request->txtShadeBrandMulti2;
                $ShadeColorMulti2 = $request->txtShadeColorMulti2;
            }else{
                $ShadeBrandMulti2 = $request->ddlShadeBrandMulti2;
                $ShadeColorMulti2 = $request->ddlShadeColordMulti2;
            }
            if($request->ddlShadeBrandMulti3 == 'อื่นๆ'){
                $ShadeBrandMulti3 = $request->txtShadeBrandMulti3;
                $ShadeColorMulti3 = $request->txtShadeColorMulti3;
            }else{
                $ShadeBrandMulti3 = $request->ddlShadeBrandMulti3;
                $ShadeColorMulti3 = $request->ddlShadeColordMulti3;
            }
            if($request->ddlStumpBrand == 'อื่นๆ'){
                $StumpBrand = $request->txtStumpBrand;
                $StumpColor = $request->txtStumpColor;
            }else{
                $StumpBrand = $request->ddlStumpBrand;
                $StumpColor = $request->ddlStumpColor;
            }
        DB::update("UPDATE screen SET
                model = '$request->rdoGroupModel',
                model_resin = '$request->rdoModelResin',
                implant = '$request->rdoGroupRetained',
                implant_ceramage = '$request->rdoGroupSystem',
                -- implant_screw = '$request->rdoGroupBrand',
                Metal_type = '$request->rdoAlloys1',
                Metal_type2 = '$request->rdoAlloys2',
                Metal_type3 = '$request->rdoAlloys3',
                Metal_type4 = '$request->rdoAlloys4',
                Metal_type5 = '$request->rdoAlloys5',
                Metal_type6 = '$request->rdoAlloys6',
                Hook = '$request->rdoRest',
                MESIAL_REST = '$request->chkHaveRest1',
                DISTAL_REST = '$request->chkHaveRest2',
                CINGULUM_REST = '$request->chkHaveRest3',
                EMBRESSURE_REST = '$request->chkHaveRest5',
                LINGUAL_LEDGE = '$request->chkHaveRest4',
                other_hook = '$request->rdoUndercut',
                undercut_hook = '$request->rdoGroupHaveUndercut',
                unit_CONTOUR = '$request->rdoUnder',
                OCCLUSAL_STAINING = '$request->rdoStaining',
                PONTIC_DESIGN = '$request->PONTIC_DESIGN',
                MARGIN1 = '$request->MARGIN1',
                MARGIN2 = '$request->MARGIN2',
                MARGIN3 = '$request->MARGIN3',
                FixCement = '$request->rdoFixCement',
                GINGIVAL_EMBRASURES = '$request->chkGingival',
                OCCLUSION = '$request->chkOcclusion',
                CONTACT = '$request->chkContact',
                shade = '$request->rdoShade',
                one_color = '$request->rdoGroupShade',
                one_color_Combobox = '$request->txtDoctorShade',
                one_color_branch = '$ShadeOne',
                one_color_branch_color = '$ColorOne',
                many_color_crowns = '$ShadeColorMulti1',
                many_branch_crowns = '$ShadeBrandMulti1',
                many_branch_Middle = '$ShadeBrandMulti2',
                many_color_Middle = '$ShadeColorMulti2',
                many_branch_tip = '$ShadeBrandMulti3',
                many_color_tip = '$ShadeColorMulti3',
                stump = '$request->rdoGroupStump',
                one_branch_stump = '$StumpBrand',
                one_color_stump = '$StumpColor',

                comment_shade = '$request->txtDoctorShade',
                comment_stump = '$request->txtDoctorStump',
                comment_Metal_type = '$request->txtDoctorAlloys',
                comment_model = '$request->txtDoctorModel',
                comment_fix_cement = '$request->txtDoctorFix',
                screen_group = '$new_screen_group',
                status = '1',
                implant_brand = '$request->rdoGroupImpBrand',
                implant_brand_comment = '$request->txtImpBrandOther',
                txtCommentAlloys = '$request->txtCommentAlloys',
                txtCommentShade = '$request->txtCommentShade',
                txtCommentStump = '$request->txtCommentStump',
                txtCommentModel = '$request->txtCommentModel',
                txtCommentFixCement = '$request->txtCommentFixCement',
                MARGIN_Buccal = '$request->MARGIN_Buccal',
                MARGIN_Lingual = '$request->MARGIN_Lingual',
                Pintooth = '$request->rdopintooth',
                PintoothHook = '$request->rdopintoothhook',
                PintoothHookRest = '$request->chkHaveRestpintooth',
                PintoothAlloys = '$request->chkpintoothalloys',
                PintoothAlloysNote = '$request->Notepintoothalloys',
                PintoothAlloysComment = '$request->Commentpintoothalloys'

                where ID_order_screen = '$request->ID_order_screen'
                AND TeethID = $out_TeethID", []);
        }
        return redirect('/mainscreen/new_screen/' . $id);
    }

    public function on_screening_edit_teeth(Request $request, $id){

        $screen_group = "";
        for ($i = 0; $i < sizeOf($request->new_teeth); $i++) {
            $screen_group = $screen_group . $request->new_teeth[$i] .",";
        }
        $screen_group = substr($screen_group, 0, -1);

        for ($i = 0; $i < sizeOf($request->new_teeth); $i++) {

            order_teeth::where('TeethID', $request->current_teeth[$i])
            ->where('ScreenID', $id)
            ->update( ['TypeOfProductID' => $request->new_product[$i],
                       'TypeOfWorkID' => $request->new_type_of_work[$i],
                       'TypeOfGroupID' => $request->new_group[$i],
                       'TeethID' => $request->new_teeth[$i]
                       ]);

            order_teeth_screen::where('TeethID', $request->current_teeth[$i])
            ->where('ScreenID', $id)
            ->update( ['TypeOfProductID' => $request->new_product[$i],
                       'TypeOfWorkID' => $request->new_type_of_work[$i],
                       'TypeOfGroupID' => $request->new_group[$i],
                       'TeethID' => $request->new_teeth[$i]
                       ]);

            screen::where('TeethID', $request->current_teeth[$i] )
            ->where('ID_order_screen', $id )
            ->update(['screen_group' => $screen_group,
                      'TeethID' => $request->new_teeth[$i]]);

        }

        return back();
    }

    public function selectcolor(Request $req)
    {
        $color_by_brand = DB::select('SELECT
          screen_SHADE_Colors.id,
          screen_SHADE_Colors.id_Shade_brand,
          screen_SHADE_Colors.color,
          screen_SHADE_Colors.create_at
          FROM
          screen_SHADE_Colors
          WHERE
          screen_SHADE_Colors.id_Shade_Brand = ?', [$req->brand_id]
        );

        // echo '<option value="0">สี</option>';
        if ($req->brand_id != 0) {
            foreach ($color_by_brand as $i => $color) {
                echo '<option value="' . $color->id . '">' . $color->color . '</option>';
            }
        } else {
            echo '<option value="0">ไม่มีข้อมูล</option>';
        }

    }

    public function editscreen($id, $id_teeth)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $data_all = DB::select('SELECT
            *
            FROM
            screen
            WHERE
            screen.ID_order_screen = ? AND screen.TeethID = ?', [$id, $id_teeth]);

        $data_implant = DB::select('SELECT
            ID,GROUP_CONCAT(topic) AS "topic"
            FROM
            select_implant
            WHERE
            select_implant.ID_order_screen = ? AND select_implant.TeethID = ?', [$id, $id_teeth]);

        // return $data_implant;
        return view('screen/edit_screen', compact('data_all', 'id', 'data_implant'));
    }

    public function savescreen($id, $id_teeth, Request $request)
    {
        $screen = screen::where('ID_order_screen', $id)->where('TeethID', $id_teeth)->limit(1)->first();

        // $data_screen = screen::find(488);
        // $data_screen->Metal_type = '0000';
        // $data_screen->save();


        DB::update("UPDATE screen SET
            e_max = '$request->e_max',
            color = '$request->color',
            ceramage = '$request->ceramage',
            zirconia_copping = '$request->zirconia_copping',
            zirconia_crown = '$request->zirconia_crown',
            zirconia_restoration = '$request->zirconia_restoration',
            model = '$request->model',
            model_resin = '$request->model_resin',
            implant = '$request->implant',
            implant_ceramage = '$request->implant_ceramage',
            implant_screw = '$request->implant_screw',
            Metal_type = '$request->Metal_type',
            Hook = '$request->Hook',
            MESIAL_REST = '$request->MESIAL_REST',
            DISTAL_REST = '$request->DISTAL_REST',
            CINGULUM_REST = '$request->CINGULUM_REST',
            EMBRESSURE_REST = '$request->EMBRESSURE_REST',
            LINGUAL_LEDGE = '$request->LINGUAL_LEDGE',
            other_hook = '$request->other_hook',
            undercut_hook = '$request->undercut_hook',
            unit_hook = '$request->unit_hook',
            UNDERCUT = '$request->UNDERCUT',
            CONTOUR = '$request->CONTOUR',
            unit_CONTOUR = '$request->unit_CONTOUR',
            one_color = '$request->one_color',
            one_color_Combobox = '$request->one_color_Combobox',
            one_color_branch = '$request->one_color_branch',
            one_color_branch_color = '$request->one_color_branch_color',
            many_color_crowns = '$request->many_color_crowns',
            many_branch_crowns = '$request->many_branch_crowns',
            many_color_Middle = '$request->many_color_Middle',
            many_branch_Middle = '$request->many_branch_Middle',
            many_color_tip = '$request->many_color_tip',
            many_branch_tip = '$request->many_branch_tip',
            OCCLUSAL_STAINING = '$request->OCCLUSAL_STAINING',
            PONTIC_DESIGN = '$request->PONTIC_DESIGN',
            MARGIN1 = '$request->MARGIN1',
            MARGIN2 = '$request->MARGIN2',
            MARGIN3 = '$request->MARGIN3',
            Metal_Margin_detail = '$request->Metal_Margin_detail',
            comment_emax_color = '$request->comment_emax_color',
            comment_ceramage = '$request->comment_ceramage',
            comment_zirconia = '$request->comment_zirconia',
                comment_model = '$request->comment_model',
            comment_implant = '$request->comment_implant',
            comment_hook = '$request->comment_hook',
            comment_contour = '$request->comment_contour',
                comment_shade = '$request->comment_shade',
                comment_Metal_type = '$request->comment_Metal_type',
                comment_stump = '$request->comment_stump',
                comment_fix_cement = '$request->comment_fix_cement'
            where ID = '$screen->ID' ", []);


        // return $request->all();
        // return $screen->ID;
        return redirect('/mainscreen/detail/teeth/' . $id);
    }

    public function save(Request $request)
    {
        // return $request;
        DB::delete("DELETE FROM select_extra WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_Attachment WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_IMPLANT_Attachment WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_extra_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_Attachment_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_IMPLANT_Attachment_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM INTERLOCK WHERE screen_ID = '$request->ID_order_screen'");

        if($request->Female_Mesial != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Female', 'Mesial', ?)
            ",[$request->ID_order_screen,$request->Female_Mesial,now(),]);
        }
        if($request->Female_Distal != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Female', 'Distal', ?)
            ",[$request->ID_order_screen,$request->Female_Distal,now(),]);
        }
        if($request->Male_Mesial != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Male', 'Mesial', ?)
            ",[$request->ID_order_screen,$request->Male_Mesial,now(),]);
        }
        if($request->Male_Distal != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Male', 'Distal', ?)
            ",[$request->ID_order_screen,$request->Male_Distal,now(),]);
        }

        if ($request->chkAttachment1 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment1;
            $select_Attachment->number = $request->txtAttachment1;
            $select_Attachment->assign = $request->txtAttachment2;
            $select_Attachment->save();
        }

        if ($request->chkAttachment2 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment2;
            $select_Attachment->number = $request->txtAttachment2;
            $select_Attachment->save();
        }

        if ($request->chkAttachment3 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment3;
            $select_Attachment->number = $request->txtAttachment3;
            $select_Attachment->save();
        }

        if ($request->chkAttachment4 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment4;
            $select_Attachment->number = $request->txtAttachment4;
            $select_Attachment->save();
        }

        if ($request->chkAttachment5 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment5;
            $select_Attachment->number = $request->txtAttachment5;
            $select_Attachment->save();
        }

        if ($request->chkAttachment6 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment6;
            $select_Attachment->number = $request->txtAttachment6;
            $select_Attachment->save();
        }

        if ($request->chkAttachment7 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment7;
            $select_Attachment->number = $request->txtAttachment7;
            $select_Attachment->save();
        }

        if ($request->chkAttachment8 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment8;
            $select_Attachment->number = $request->txtAttachment8;
            $select_Attachment->save();
        }

        if ($request->chkAttachment9 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment9;
            $select_Attachment->number = $request->txtAttachment9;
            $select_Attachment->save();
        }

        if ($request->chkAttachment10 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment10;
            $select_Attachment->number = $request->txtAttachment10;
            $select_Attachment->save();
        }

        if ($request->chkAttachment11 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment11;
            $select_Attachment->number = $request->txtAttachment11;
            $select_Attachment->save();
        }
        // -------------------------------------------------------------------------------

        if ($request->chkAttachmentImp1 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp1;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt1;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp1;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp2 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp2;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt2;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp2;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp3 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp3;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt3;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp3;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp4 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp4;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt4;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp4;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp5 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp5;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt5;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp5;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp6 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp6;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt6;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp6;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp7 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp7;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt7;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp7;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp8 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp8;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt8;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp8;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp9 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp9;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt9;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp9;
            $select_IMPLANT_Attachment->save();
        }
        if ($request->chkAttachmentImp10 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp10;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt10;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp10;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkCmd1 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd1;
            $select_extra->detail = $request->rdoGroupCmd1;
            $select_extra->save();
        }

        if ($request->chkCmd2 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd2;
            $select_extra->detail = $request->rdoGroupCmd2;
            $select_extra->save();
        }

        if ($request->chkCmd3 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd3;
            $select_extra->detail = $request->rdoGroupCmd3;
            $select_extra->save();
        }

        if ($request->chkCmd4 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd4;
            $select_extra->detail = $request->rdoGroupCmd4;
            $select_extra->save();
        }

        if ($request->chkCmd5 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd5;
            $select_extra->detail = $request->rdoGroupCmd5;
            $select_extra->save();
        }

        if ($request->chkCmd6 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd6;
            $select_extra->detail = $request->rdoGroupCmd6;
            $select_extra->save();
        }

        if ($request->chkCmd7 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd7;
            $select_extra->save();
        }

        if ($request->chkCmd8 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd8;
            $select_extra->save();
        }

        if ($request->chkCmd9 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd9;
            $select_extra->save();
        }

        if ($request->chkCmd10 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd10;
            $select_extra->save();
        }

        if ($request->chkCmd11 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd11;
            $select_extra->note = $request->txtCmd11;
            $select_extra->save();
        }

        if ($request->chkCmd12 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd12;
            $select_extra->note = $request->txtCmd12;
            $select_extra->save();
        }

        if ($request->chkCmd13 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd13;
            $select_extra->save();
        }

        if ($request->chkCmd14 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd14;
            $select_extra->detail = $request->rdoGroupCmd14;
            $select_extra->save();
        }

        $select_extra_additional = new select_extra_additional();
        $select_extra_additional->ID_order_screen = $request->ID_order_screen;
        $select_extra_additional->detail = $request->comment_extra;
        $select_extra_additional->save();

        $select_Attachment_additional = new select_Attachment_additional();
        $select_Attachment_additional->ID_order_screen = $request->ID_order_screen;
        $select_Attachment_additional->detail = $request->comment_attachment;
        $select_Attachment_additional->save();

        $select_IMPLANT_Attachment_additional = new select_IMPLANT_Attachment_additional();
        $select_IMPLANT_Attachment_additional->ID_order_screen = $request->ID_order_screen;
        $select_IMPLANT_Attachment_additional->detail = $request->comment_implant_attachment;
        $select_IMPLANT_Attachment_additional->save();

        if($request->rdoWork == 'new'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            DoctorID = '$request->doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = null,
            ContiBarcode = null,
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            Datefinal = '$request->Datefinal',
            DeliverDate_comment = '$request->DeliverDate_comment',
            ddlWorkLate = '$request->ddlWorkLate',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlTypeEdit = null,
            type_of_con = null,
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        } else if($request->rdoWork == 'con'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = null,
            ContiBarcode = '$request->RefBarcode',
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            Datefinal = '$request->Datefinal',
            DeliverDate_comment = '$request->DeliverDate_comment',
            ddlWorkLate = '$request->ddlWorkLate',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlTypeEdit = null,
            type_of_con = '$request->type_of_con',
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        } else if($request->rdoWork == 'edit'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = '$request->RefBarcode',
            ContiBarcode = null,
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            Datefinal = '$request->Datefinal',
            DeliverDate_comment = '$request->DeliverDate_comment',
            ddlWorkLate = '$request->ddlWorkLate',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlTypeEdit = '$request->ddlTypeEdit',
            type_of_con = null,
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        }

        if ($request->checkjob == '1') {
            $order_screen = order_screen::where('ID', $request->ID_order_screen)->first();

            DB::update("UPDATE order_screen SET order_screen.status_screen = 1 WHERE order_screen.ID = ? ", [$request->ID_order_screen]);

            $job_check = job::where('ID_order_screen', $request->ID_order_screen)->first();

            if($order_screen->DeliverType != '5' && empty($job_check) )
            {
                $data_job = new job();
                $data_job->ID_order_screen = $request->ID_order_screen;
                // $data_job->BranchID = $order_screen->BranchID;
                $data_job->job_current_department = '0';
                $data_job->date_time_start = \Carbon\Carbon::now();
                $data_job->save();
                $order_teeth_screen = DB::update("UPDATE order_teeth_screen SET editable = null WHERE ScreenID = ? ",[$request->ID_order_screen]);
                return redirect('/mainscreen');
            }
            else
            {
                $order_teeth_screen = DB::update("UPDATE order_teeth_screen SET editable = null WHERE ScreenID = ? ",[$request->ID_order_screen]);
                return redirect('/mainscreen');
            }

        } else {
            $TeethID = array();
            $screen_group = "";
            for ($i = 11; $i <= 48; $i++) {
                $chkTooth = "chkTooth_" . $i;
                if ($request->input($chkTooth) != null) {
                    $TeethID[] = $request->input($chkTooth);
                    DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '$i'  ", []);
                    $screen_group = $screen_group . $i .",";
                }
            }
            $screen_group = substr($screen_group, 0, -1);

            foreach ($TeethID as $out_TeethID) {
                $data_screen = new screen();
                $data_screen->TeethID = $out_TeethID;
                $data_screen->ID_order_screen = $request->ID_order_screen;
                $data_screen->model = $request->rdoGroupModel;
                $data_screen->model_resin = $request->rdoModelResin;
                $data_screen->implant = $request->rdoGroupRetained;
                $data_screen->implant_ceramage = $request->rdoGroupSystem;
                // $data_screen->implant_screw = $request->rdoGroupBrand;
                $data_screen->Metal_type = $request->rdoAlloys1;
                $data_screen->Metal_type2 = $request->rdoAlloys2;
                $data_screen->Metal_type3 = $request->rdoAlloys3;
                $data_screen->Metal_type4 = $request->rdoAlloys4;
                $data_screen->Metal_type5 = $request->rdoAlloys5;
                $data_screen->Metal_type6 = $request->rdoAlloys6;
                $data_screen->Hook = $request->rdoRest;
                $data_screen->MESIAL_REST = $request->chkHaveRest1;
                $data_screen->DISTAL_REST = $request->chkHaveRest2;
                $data_screen->CINGULUM_REST = $request->chkHaveRest3;
                $data_screen->EMBRESSURE_REST = $request->chkHaveRest5;
                $data_screen->LINGUAL_LEDGE = $request->chkHaveRest4;
                $data_screen->other_hook = $request->rdoUndercut;
                $data_screen->undercut_hook = $request->rdoGroupHaveUndercut;
                $data_screen->unit_CONTOUR = $request->rdoUnder;
                $data_screen->OCCLUSAL_STAINING = $request->rdoStaining;
                $data_screen->PONTIC_DESIGN = $request->PONTIC_DESIGN;
                $data_screen->MARGIN1 = $request->MARGIN1;
                $data_screen->MARGIN2 = $request->MARGIN2;
                $data_screen->MARGIN3 = $request->MARGIN3;
                $data_screen->MARGIN_Buccal = $request->MARGIN_Buccal;
                $data_screen->MARGIN_Lingual = $request->MARGIN_Lingual;
                $data_screen->FixCement = $request->rdoFixCement;
                $data_screen->GINGIVAL_EMBRASURES = $request->chkGingival;
                $data_screen->OCCLUSION = $request->chkOcclusion;
                $data_screen->CONTACT = $request->chkContact;
                $data_screen->shade = $request->rdoShade;
                $data_screen->one_color = $request->rdoGroupShade;
                $data_screen->one_color_extra1 = $request->rdoGroupShade2;
                $data_screen->one_color_Combobox = $request->txtDoctorShade;

                if($request->ddlShadeBrand == 'อื่นๆ'){
                    $data_screen->one_color_branch = $request->txtShadeOne;
                    $data_screen->one_color_branch_color = $request->txtColorOne;
                }else{
                    $data_screen->one_color_branch = $request->ddlShadeBrand;
                    $data_screen->one_color_branch_color = $request->ddlShadeColor;
                }
                if($request->ddlShadeBrandMulti1 == 'อื่นๆ'){
                    $data_screen->many_branch_crowns = $request->txtShadeBrandMulti1;
                    $data_screen->many_color_crowns = $request->txtShadeColorMulti1;
                }else{
                    $data_screen->many_branch_crowns = $request->ddlShadeBrandMulti1;
                    $data_screen->many_color_crowns = $request->ddlShadeColordMulti1;
                }
                if($request->ddlShadeBrandMulti2 == 'อื่นๆ'){
                    $data_screen->many_branch_Middle = $request->txtShadeBrandMulti2;
                    $data_screen->many_color_Middle = $request->txtShadeColorMulti2;
                }else{
                    $data_screen->many_branch_Middle = $request->ddlShadeBrandMulti2;
                    $data_screen->many_color_Middle = $request->ddlShadeColordMulti2;
                }
                if($request->ddlShadeBrandMulti3 == 'อื่นๆ'){
                    $data_screen->many_branch_tip = $request->txtShadeBrandMulti3;
                    $data_screen->many_color_tip = $request->txtShadeColorMulti3;
                }else{
                    $data_screen->many_branch_tip = $request->ddlShadeBrandMulti3;
                    $data_screen->many_color_tip = $request->ddlShadeColordMulti3;
                }
                $data_screen->stump = $request->rdoGroupStump;
                if($request->ddlStumpBrand == 'อื่นๆ'){
                    $data_screen->one_branch_stump = $request->txtStumpBrand;
                    $data_screen->one_color_stump = $request->txtStumpColor;
                }else{
                    $data_screen->one_branch_stump = $request->ddlStumpBrand;
                    $data_screen->one_color_stump = $request->ddlStumpColor;
                }
                $data_screen->comment_shade = $request->txtDoctorShade;
                $data_screen->comment_stump = $request->txtDoctorStump;
                $data_screen->comment_Metal_type = $request->txtDoctorAlloys;
                $data_screen->comment_model = $request->txtDoctorModel;
                $data_screen->comment_fix_cement = $request->txtDoctorFix;
                $data_screen->screen_group = $screen_group;
                $data_screen->status = '1';
                $data_screen->implant_brand = $request->rdoGroupImpBrand;
                $data_screen->implant_brand_comment = $request->txtImpBrandOther;
                $data_screen->txtCommentAlloys = $request->txtCommentAlloys;
                $data_screen->txtCommentShade = $request->txtCommentShade;
                $data_screen->txtCommentStump = $request->txtCommentStump;
                $data_screen->txtCommentModel = $request->txtCommentModel;
                $data_screen->txtCommentFixCement = $request->txtCommentFixCement;
                $data_screen->created_at = NOW();
                $data_screen->updated_at = NOW();
                $data_screen->EmployeeID = Auth::user()->id;
                $data_screen->Pintooth = $request->rdopintooth;
                $data_screen->PinToothHook = $request->rdopintoothhook;//ดึงข้อมูลมาแสดง
                $data_screen->PinToothHookRest = $request->chkHaveRestpintooth;
                $data_screen->PintoothAlloys = $request->chkpintoothalloys;
                $data_screen->PintoothAlloysNote = $request->Notepintoothalloys;
                $data_screen->PintoothAlloysComment = $request->Commentpintoothalloys;
                // $data_screen->MARGIN_Buccal = $request->MARGIN_Buccal;
                // $data_screen->MARGIN_Lingual = $request->MARGIN_Lingual;
                $data_screen->save();

            }
            return redirect('/mainscreen/new_screen/' . $request->ID_order_screen);
        }
    }

    public function savegeneral(Request $request,$id)
    {
        // return $id.'///'.$request->ID_order_screen;
        // return $request->type_Deliver;
        $check_order_screen = DB::SELECT("
                    SELECT
                    order_screen.DeliverType
                    FROM
                    order_screen
                    WHERE
                    order_screen.ID = '$id' 
        ");
       
        if ( $check_order_screen[0]->DeliverType != 5 ) {
            $job_check = job::where('ID_order_screen', $request->ID_order_screen)->first();
            DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,DepartmentID,Sub_DepartmentID,EmployeeID,created_at) VALUES(?, ?, '2', '72', ? , ?)
                ",[$job_check->ID,$id,Auth::user()->id,now()]);
        }
        
        
        if(empty($job_check))
        {
           if($request->type_Deliver != '5')
            {
                $data_job = new job();
                $data_job->ID_order_screen = $request->ID_order_screen;
                $data_job->job_current_department = '0';
                $data_job->date_time_start = \Carbon\Carbon::now();
                $data_job->save();
            }
        }


        DB::delete("DELETE FROM select_extra WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_Attachment WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_IMPLANT_Attachment WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_extra_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_Attachment_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_IMPLANT_Attachment_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM INTERLOCK WHERE screen_ID = '$request->ID_order_screen'");


        if($request->Female_Mesial != null){
           DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Female', 'Mesial', ?)
            ",[$request->ID_order_screen,$request->Female_Mesial,now(),]);
        }
        if($request->Female_Distal != null){
           DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Female', 'Distal', ?)
            ",[$request->ID_order_screen,$request->Female_Distal,now(),]);
        }
        if($request->Male_Mesial != null){
           DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Male', 'Mesial', ?)
            ",[$request->ID_order_screen,$request->Male_Mesial,now(),]);
        }
        if($request->Male_Distal != null){
           DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Male', 'Distal', ?)
            ",[$request->ID_order_screen,$request->Male_Distal,now(),]);
        }


        if ($request->chkAttachment1 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment1;
            $select_Attachment->number = $request->txtAttachment1;
            $select_Attachment->assign = $request->txtAttachment2;
            $select_Attachment->save();
        }

        if ($request->chkAttachment2 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment2;
            $select_Attachment->number = $request->txtAttachment2;
            $select_Attachment->save();
        }

        if ($request->chkAttachment3 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment3;
            $select_Attachment->number = $request->txtAttachment3;
            $select_Attachment->save();
        }

        if ($request->chkAttachment4 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment4;
            $select_Attachment->number = $request->txtAttachment4;
            $select_Attachment->save();
        }

        if ($request->chkAttachment5 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment5;
            $select_Attachment->number = $request->txtAttachment5;
            $select_Attachment->save();
        }

        if ($request->chkAttachment6 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment6;
            $select_Attachment->number = $request->txtAttachment6;
            $select_Attachment->save();
        }

        if ($request->chkAttachment7 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment7;
            $select_Attachment->number = $request->txtAttachment7;
            $select_Attachment->save();
        }

        if ($request->chkAttachment8 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment8;
            $select_Attachment->number = $request->txtAttachment8;
            $select_Attachment->save();
        }

        if ($request->chkAttachment9 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment9;
            $select_Attachment->number = $request->txtAttachment9;
            $select_Attachment->save();
        }
        if ($request->chkAttachment10 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment10;
            $select_Attachment->number = $request->txtAttachment10;
            $select_Attachment->save();
        }

        if ($request->chkAttachment11 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment11;
            $select_Attachment->number = $request->txtAttachment11;
            $select_Attachment->save();
        }
        // ----------------------------------------------------------------------


        if ($request->chkAttachmentImp1 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp1;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt1;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp1;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp2 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp2;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt2;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp2;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp3 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp3;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt3;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp3;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp4 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp4;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt4;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp4;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp5 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp5;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt5;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp5;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp6 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp6;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt6;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp6;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp7 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp7;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt7;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp7;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp8 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp8;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt8;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp8;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp9 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp9;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt9;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp9;
            $select_IMPLANT_Attachment->save();
        }
        if ($request->chkAttachmentImp10 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp10;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt10;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp10;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkCmd1 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd1;
            $select_extra->detail = $request->rdoGroupCmd1;
            $select_extra->save();
        }

        if ($request->chkCmd2 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd2;
            $select_extra->detail = $request->rdoGroupCmd2;
            $select_extra->save();
        }

        if ($request->chkCmd3 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd3;
            $select_extra->detail = $request->rdoGroupCmd3;
            $select_extra->save();
        }

        if ($request->chkCmd4 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd4;
            $select_extra->detail = $request->rdoGroupCmd4;
            $select_extra->save();
        }

        if ($request->chkCmd5 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd5;
            $select_extra->detail = $request->rdoGroupCmd5;
            $select_extra->save();
        }

        if ($request->chkCmd6 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd6;
            $select_extra->detail = $request->rdoGroupCmd6;
            $select_extra->save();
        }

        if ($request->chkCmd7 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd7;
            $select_extra->save();
        }

        if ($request->chkCmd8 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd8;
            $select_extra->save();
        }

        if ($request->chkCmd9 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd9;
            $select_extra->save();
        }

        if ($request->chkCmd10 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd10;
            $select_extra->save();
        }

        if ($request->chkCmd11 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd11;
            $select_extra->note = $request->txtCmd11;
            $select_extra->save();
        }

        if ($request->chkCmd12 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd12;
            $select_extra->note = $request->txtCmd12;
            $select_extra->save();
        }
        if ($request->chkCmd13 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd13;
            $select_extra->save();
        }

        if ($request->chkCmd14 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd14;
            $select_extra->detail = $request->rdoGroupCmd14;
            $select_extra->save();
        }

        $select_extra_additional = new select_extra_additional();
        $select_extra_additional->ID_order_screen = $request->ID_order_screen;
        $select_extra_additional->detail = $request->comment_extra;
        $select_extra_additional->save();

        $select_Attachment_additional = new select_Attachment_additional();
        $select_Attachment_additional->ID_order_screen = $request->ID_order_screen;
        $select_Attachment_additional->detail = $request->comment_attachment;
        $select_Attachment_additional->save();

        $select_IMPLANT_Attachment_additional = new select_IMPLANT_Attachment_additional();
        $select_IMPLANT_Attachment_additional->ID_order_screen = $request->ID_order_screen;
        $select_IMPLANT_Attachment_additional->detail = $request->comment_implant_attachment;
        $select_IMPLANT_Attachment_additional->save();

        if($request->rdoWork == 'new'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            line_doctor = '$request->line_doctor',
            DoctorID = '$request->doctor',
            phone_doctor = '$request->phone_doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = null,
            contiBarcode = null,
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            Datefinal = '$request->Datefinal',
            DeliverDate_comment = '$request->DeliverDate_comment',
            ddlWorkLate = '$request->ddlWorkLate',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlTypeEdit = null,
            type_of_con = null,
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        } else if ($request->rdoWork == 'con'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            DoctorID = '$request->doctor',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            Barcode = '$request->Barcode',
            RefBarcode = null,
            contiBarcode = '$request->RefBarcode',
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            Datefinal = '$request->Datefinal',
            DeliverDate_comment = '$request->DeliverDate_comment',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlWorkLate = '$request->ddlWorkLate',
            ddlTypeEdit = null,
            type_of_con = '$request->type_of_con',
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        } else if ($request->rdoWork == 'edit'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            DoctorID = '$request->doctor',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = '$request->RefBarcode',
            contiBarcode = null,
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            Datefinal = '$request->Datefinal',
            DeliverDate_comment = '$request->DeliverDate_comment',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlWorkLate = '$request->ddlWorkLate',
            ddlTypeEdit = '$request->ddlTypeEdit',
            type_of_con = null,
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        }

        return redirect('/mainscreen/detail/teeth/' . $id);
    }


    public function edit_teeth(Request $request,$id){
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $type_of_product = order_teeth::select_product();
        $type_of_work = order_teeth::select_work();
        $teeth = order_teeth::screen_teeth($id);

        return view('screen/edit_teeth',compact('type_of_product', 'type_of_work', 'teeth', 'id'));
    }

    public function groupteeth($id)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        // $id_sale = order_sale::select_id_sale();
        // $id_screen = order_screen::select_id_screen();
        $type_of_group = type_of_group::select_type_group();
        $teeth = order_teeth::screen_teeth_group($id);
        $group_no = order_teeth::select_group();
        $editables = order_teeth_screen::where('ScreenID',$id)->get();
        $editable = null;
        foreach($editables as $out_editable){
            if($out_editable->editable == 0){
                $editable = 0;
            }
        }

        return view('screen/edit_teeth2', compact('type_of_group', 'teeth', 'group_no', 'id','editable'));
        // return $teeth;
    }

    public function addteeth(Request $request)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $validate = \Validator::make($request->all(), [
               'TypeOfWorkID' => 'required',
               'TypeOfProductID' => 'required',
           ], [
               'TypeOfWorkID.required' => 'เลือก Type of work',
               'TypeOfProductID.required' => 'เลือก Type of product',
           ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        // if (($request->TypeOfWorkID != null) && ($request->TypeOfProductID != null)) {
        if ($request->chkTooth_11 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_11', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_11', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_12 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_12', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_12', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_13 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_13', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_13', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_14 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_14', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_14', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_15 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_15', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_15', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_16 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_16', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_16', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_17 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_17', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_17', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_18 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_18', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_18', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_19 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_19', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_19', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_20 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_20', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_20', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_21 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_21', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_21', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_22 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_22', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_22', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_23 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_23', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_23', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_24 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_24', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_24', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_25 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_25', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_25', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_26 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_26', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_26', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_27 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_27', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_27', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_28 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_28', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_28', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_29 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_29', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_29', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_30 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_30', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_30', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_31 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_31', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_31', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_32 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_32', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_32', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_33 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_33', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_33', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_34 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_34', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_34', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_35 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_35', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_35', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_36 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_36', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_36', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_37 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_37', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_37', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_38 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_38', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_38', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_39 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_39', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_39', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_40 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_40', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_40', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_41 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_41', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_41', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_42 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_42', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_42', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_43 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_43', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_43', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_44 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_44', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_44', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_45 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_45', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_45', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_46 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_46', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_46', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_47 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_47', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_47', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        if ($request->chkTooth_48 != null) {
            DB::insert("INSERT INTO order_teeth (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_48', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
            DB::insert("INSERT INTO order_teeth_screen (OrderID, ScreenID ,TeethID ,TypeOfWorkID,TypeOfProductID,status) values ('$request->id_sale', '$request->id_screen', '$request->chkTooth_48', '$request->TypeOfWorkID', '$request->TypeOfProductID', '0')", []);
        }
        // } else {
        //     return redirect('/order4')->with('alert', 'Deleted!');
        // }

        //show order step 4
        return redirect('/mainscreen/edit_teeth/'.$request->id_screen);
    }

    public function delete_teeth($id, $id_screen, $TeethID)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }
        order_teeth::delete_teeth($id, $id_screen, $TeethID);

        return redirect('/mainscreen/edit_teeth/'.$id_screen);
    }

    public function addgroup(Request $request)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        if ($request->chkTooth_11 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '11'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '11'  ", []);
        }
        if ($request->chkTooth_12 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '12'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '12'  ", []);
        }
        if ($request->chkTooth_13 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '13'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '13'  ", []);
        }
        if ($request->chkTooth_14 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '14'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '14'  ", []);
        }
        if ($request->chkTooth_15 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '15'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '15'  ", []);
        }
        if ($request->chkTooth_16 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '16'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '16'  ", []);
        }
        if ($request->chkTooth_17 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '17'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '17'  ", []);
        }
        if ($request->chkTooth_18 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '18'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '18'  ", []);
        }
        if ($request->chkTooth_19 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '19'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '19'  ", []);
        }
        if ($request->chkTooth_20 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '20'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '20'  ", []);
        }
        if ($request->chkTooth_21 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '21'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '21'  ", []);
        }
        if ($request->chkTooth_22 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '22'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '22'  ", []);
        }
        if ($request->chkTooth_23 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '23'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '23'  ", []);
        }
        if ($request->chkTooth_24 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '24'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '24'  ", []);
        }
        if ($request->chkTooth_25 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '25'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '25'  ", []);
        }
        if ($request->chkTooth_26 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '26'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '26'  ", []);
        }
        if ($request->chkTooth_27 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '27'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '27'  ", []);
        }
        if ($request->chkTooth_28 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '28'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '28'  ", []);
        }
        if ($request->chkTooth_29 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '29'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '29'  ", []);
        }
        if ($request->chkTooth_30 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '30'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '30'  ", []);
        }
        if ($request->chkTooth_31 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '31'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '31'  ", []);
        }
        if ($request->chkTooth_32 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '32'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '32'  ", []);
        }
        if ($request->chkTooth_33 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '33'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '33'  ", []);
        }
        if ($request->chkTooth_34 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '34'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '34'  ", []);
        }
        if ($request->chkTooth_35 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '35'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '35'  ", []);
        }
        if ($request->chkTooth_36 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '36'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '36'  ", []);
        }
        if ($request->chkTooth_37 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '37'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '37'  ", []);
        }
        if ($request->chkTooth_38 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '38'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '38'  ", []);
        }
        if ($request->chkTooth_39 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '39'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '39'  ", []);
        }
        if ($request->chkTooth_40 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '40'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '40'  ", []);
        }
        if ($request->chkTooth_41 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '41'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '41'  ", []);
        }
        if ($request->chkTooth_42 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '42'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '42'  ", []);
        }
        if ($request->chkTooth_43 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '43'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '43'  ", []);
        }
        if ($request->chkTooth_44 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '44'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '44'  ", []);
        }
        if ($request->chkTooth_45 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '45'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '45'  ", []);
        }
        if ($request->chkTooth_46 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '46'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '46'  ", []);
        }
        if ($request->chkTooth_47 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '47'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '47'  ", []);
        }
        if ($request->chkTooth_48 != null) {
            DB::update("UPDATE order_teeth SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '48'  ", []);
            DB::update("UPDATE order_teeth_screen SET TypeOfGroupID = '$request->TypeOfGroupID', GroupNo = '$request->group_no' where  OrderID = '$request->id_sale' AND TeethID = '48'  ", []);
        }

        return redirect('/mainscreen/edit_teeth2/'.$request->id_screen);
    }

    public function delete_group($id, $id_screen)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        order_teeth::update_teeth_group($id, $id_screen);

        return redirect('/mainscreen/edit_teeth2/'.$id_screen);
    }

    public function edit_select_teeth($id)
    {
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $order_teeth_screen = order_teeth_screen::where('ScreenID',$id)->get();

        // $screen_group = "";
        // foreach ($order_teeth_screen as $out_order_teeth_screen) {
        //     $screen_group = $screen_group . $out_order_teeth_screen->TeethID .",";
        // }
        // $screen_group = substr($screen_group, 0, -1);
        foreach ($order_teeth_screen as $out_order_teeth_screen) {
            DB::update("UPDATE order_teeth_screen SET editable = 1 where  ScreenID = $id ", []);
            // DB::delete("DELETE screen WHERE  ")
        }
        // DB::update("UPDATE screen SET screen_group = '$screen_group'  where  ID = $id ",[]);


        return redirect('/mainscreen');
    }
    public function delete_teeth_conclusion(Request $request, $id, $group){
        $order_teeth_screen = order_teeth_screen::where('ID',$id)->get();
        $TeethID = $order_teeth_screen[0]->TeethID;
        $ScreenID = $order_teeth_screen[0]->ScreenID;
        // $order_teeth_screen_delete = DB::delete("DELETE FROM order_teeth_screen WHERE ID = $id");
        // $order_teeth_delete = DB::delete("DELETE FROM order_teeth WHERE TeethID = $TeethID AND ScreenID = $ScreenID");
        // $screen_delete = DB::delete("DELETE FROM screen WHERE ID_order_screen = $ScreenID AND TeethID = $TeethID");
        $screen = screen::where('ID_order_screen',$ScreenID)
        ->where('TeethID',$TeethID)
        ->get();
        $order_teeth_screen_select = order_teeth_screen::where('ScreenID',$ScreenID)->get();
        $screen_group = "";
        foreach ($order_teeth_screen_select as $out_order_teeth_screen) {
            $screen_group = $screen_group . $out_order_teeth_screen->TeethID .",";
        }
        $screen_group = substr($screen_group, 0, -1);
        // $screen_update = DB::update("UPDATE screen SET screen_group = WHERE ID_order_screen = $ScreenID AND TeethID = $TeethID")
        return $screen_group;

        return redirect('/mainscreen/edit_conclusion/'.$ScreenID.'/'.$group);
    }

    public function conclusion_edit_teeth(Request $request, $id){

        $screen_group = "";
        for ($i = 0; $i < sizeOf($request->new_teeth); $i++) {
            $screen_group = $screen_group . $request->new_teeth[$i] .",";
        }
        $screen_group = substr($screen_group, 0, -1);

        for ($i = 0; $i < sizeOf($request->new_teeth); $i++) {

            order_teeth::where('TeethID', $request->current_teeth[$i])
            ->where('ScreenID', $id)
            ->update( ['TypeOfProductID' => $request->new_product[$i],
                       'TypeOfWorkID' => $request->new_type_of_work[$i],
                       'TypeOfGroupID' => $request->new_group[$i],
                       'TeethID' => $request->new_teeth[$i]
                       ]);

            order_teeth_screen::where('TeethID', $request->current_teeth[$i])
            ->where('ScreenID', $id)
            ->update( ['TypeOfProductID' => $request->new_product[$i],
                       'TypeOfWorkID' => $request->new_type_of_work[$i],
                       'TypeOfGroupID' => $request->new_group[$i],
                       'TeethID' => $request->new_teeth[$i]
                       ]);

            screen::where('TeethID', $request->current_teeth[$i] )
            ->where('ID_order_screen', $id )
            ->update(['screen_group' => $screen_group,
                      'TeethID' => $request->new_teeth[$i]]);

        }

        return Redirect('mainscreen/detail/teeth/'.$id);
    }

    public function editscreen_teeth($id)
    {
        Artisan::call('cache:clear');
        if (!Gate::allows('IsScrene')) {
            if (!Gate::allows('IsAdmin')) {
                abort(404, 'Page NotFound');
            }
        }

        $job_check = job::where('ID_order_screen', $id)->first();

        DB::insert("INSERT INTO job_detail (JobID,ID_order_screen,DepartmentID,Sub_DepartmentID,EmployeeID,created_at) VALUES(?, ?, '2', '74', ? , ?)
            ",[$job_check->ID,$id,Auth::user()->id,now()]);

        $screen_SHADE_Brand = DB::select('SELECT
            screen_SHADE_Brand.id,
            screen_SHADE_Brand.name,
            screen_SHADE_Brand.create_at
            FROM
            screen_SHADE_Brand
        ');

        $screen_SHADE_Colors = DB::select('SELECT
            screen_SHADE_Colors.id,
            screen_SHADE_Colors.id_Shade_brand,
            screen_SHADE_Colors.color,
            screen_SHADE_Colors.create_at
            FROM
            screen_SHADE_Colors
        ');

        $work_defect1 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 1
        ', []);
        $work_defect2 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 2
        ', []);
        $work_defect3 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 3
        ', []);
        $work_defect4 = DB::select('SELECT
            work_defect.id,
            work_defect.id_type,
            work_defect.name_type,
            work_defect.detail_type
            FROM
            work_defect
            WHERE
            work_defect.id_type = 4
        ', []);

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
            order_teeth_screen.ScreenID = ?
            -- AND order_teeth_screen.ID IN (( SELECT MAX( order_teeth_screen.ID ) FROM order_teeth_screen GROUP BY order_teeth_screen.TeethID ))
            ', [$id]);
        // return $teeth;

        $processround = DB::select('SELECT
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
            ', [Auth::user()->id]);

        $type_Deliver = DB::select('SELECT
            type_Deliver.ID,
            type_Deliver.`Name`,
            type_Deliver.create_at
            FROM
            type_Deliver
        ');

        $order = DB::select("SELECT
                order_screen.ID,
                order_screen.Barcode,
                order_screen.RefBarcode,
                order_screen.ContiBarcode,
                order_screen.FactoryID,
                order_screen.BranchID,
                order_screen.CustomerID,
                order_screen.DoctorID,
                order_screen.SaleID,
                order_screen.StartDate,
                order_screen.DeliverDate,
                order_screen.Delaydate,
                order_screen.Delaytime,
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
                order_screen.phone,
                order_screen.Address,
                order_screen.processroundID,
                order_screen.Datefinal,
                order_screen.technician_recommend,
                order_screen.line_doctor,
                order_screen.phone_doctor,
                order_screen.phone_customer,
                order_screen.FinalTime,
                order_screen.DeliverDate_comment,
                order_screen.note,
                order_screen.type_of_con,
                order_screen.Employee_DeliverDate_comment,
                order_screen.comment_WorkLate,
                order_screen.comment_WorkLate_before,
                order_screen.comment_Workdefect1,
                order_screen.comment_Workdefect2,
                customer.`Name` AS customer,
                customer.ID AS customerID,
                customer.CustomerCode AS CustomerCode,
                doctor.ID AS doctorID,
                doctor.`Name` AS doctor,
                doctor.Line_doctor,
                customer_type.`name` AS customer_type,
                type_Deliver.`Name` AS DeliverType_name,
                Employee.Nick_name AS Employee,
                Employee.`Name` AS name_Employee,
                department.`Name` AS department,
                area.`Name` AS ID_area,
                processround.production_cycle AS production_cycle_order,
                company.fullname AS company_name,
                type_Branch.`Name` AS branch_name,
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
                LEFT JOIN type_Deliver ON type_Deliver.ID = order_screen.DeliverType
                LEFT JOIN customer ON customer.ID = order_screen.CustomerID
                LEFT JOIN area ON order_screen.AreaID = area.ID
                LEFT JOIN doctor ON doctor.ID = order_screen.DoctorID
                LEFT JOIN customer_type ON customer.CustomerTypeID = customer_type.id
                LEFT JOIN job ON job.ID_order_screen = order_screen.ID
                LEFT JOIN department ON job.job_current_department = department.ID
                LEFT JOIN processround ON order_screen.processroundID = processround.ID
                LEFT JOIN company ON order_screen.FactoryID = company.ID
                LEFT JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                LEFT JOIN work_defect AS work_defect_1 ON order_screen.ddlWorkLate = work_defect_1.id
                LEFT JOIN work_defect AS work_defect_2 ON order_screen.ddlTypeEdit = work_defect_2.id
                LEFT JOIN type_of_con ON order_screen.type_of_con = type_of_con.ID
            WHERE
                order_screen.ID = ?
            ORDER BY
                order_screen.ID DESC", [$id]);

        $order_teeth_screen = DB::select('SELECT
                                            order_teeth_screen.ID,
                                            order_teeth_screen.status,
                                            type_of_work.`Name` AS work_name,
                                            type_of_product.`Name` AS work_type,
                                            teeth.`Name` AS teeth_name,
                                            type_of_product.WorkGroupID,
                                            work_group.`Name` AS work_group,
                                            TypeOfGroupID,
                                            type_of_group.Name AS name_group
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
                                            teeth.`Name` ', [$id]);

        $data_select_extra_additional = DB::select('SELECT
                                            select_extra_additional.ID,
                                            select_extra_additional.detail
                                            FROM
                                            select_extra_additional
                                            WHERE
                                            select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_extra = DB::select('SELECT
                                            select_extra.topic,
                                            select_extra.detail,
                                            select_extra.date,
                                            select_extra.note
                                            FROM
                                            select_extra
                                            WHERE
                                            select_extra.ID_order_screen = ?', [$id]);

        $data_select_attachment = DB::select('SELECT
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

        $data_select_IMPLANT_Attachment = DB::select('SELECT
                                            select_IMPLANT_Attachment.ID,
                                            select_IMPLANT_Attachment.ID_order_screen,
                                            select_IMPLANT_Attachment.topic,
                                            select_IMPLANT_Attachment.number,
                                            select_IMPLANT_Attachment.assign,
                                            select_IMPLANT_Attachment.created_at,
                                            select_IMPLANT_Attachment.updated_at
                                            FROM
                                            select_IMPLANT_Attachment
                                            WHERE
                                            select_IMPLANT_Attachment.ID_order_screen = ?', [$id]);

        $data_select_extra_additional = DB::select('SELECT
        select_extra_additional.ID,
        select_extra_additional.detail
        FROM
        select_extra_additional
        WHERE
        select_extra_additional.ID_order_screen = ?', [$id]);

        $data_select_IMPLANT_Attachment_additional = DB::select('SELECT
        select_IMPLANT_Attachment_additional.ID,
        select_IMPLANT_Attachment_additional.detail
        FROM
        select_IMPLANT_Attachment_additional
        WHERE
        select_IMPLANT_Attachment_additional.ID_order_screen = ?', [$id]);

        $data_select_attachment_additional = DB::select('SELECT
        select_Attachment_additional.ID,
        select_Attachment_additional.detail
        FROM
        select_Attachment_additional
        WHERE
        select_Attachment_additional.ID_order_screen = ?', [$id]);

            $extra = "";
            $extra_attachment = "";
            $extra_implant_attachment = "";

            foreach($data_select_extra_additional as $out_data_select_extra_additional)
            {
                $extra = $out_data_select_extra_additional->detail;
            }

            foreach($data_select_IMPLANT_Attachment_additional as $out_data_select_IMPLANT_Attachment_additional)
            {
                $extra_implant_attachment = $out_data_select_IMPLANT_Attachment_additional->detail;
            }

            foreach($data_select_attachment_additional as $out_data_select_attachment_additional)
            {
                $extra_attachment = $out_data_select_attachment_additional->detail;
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

            $ID_customer = $order[0]->customerID;
            $list_doctor = DB::select('SELECT
            customer_doctor.ID,
            customer_doctor.Name_doctor,
            customer_doctor.Name_customer,
            doctor.`Name`
            FROM
            customer_doctor
            INNER JOIN doctor ON customer_doctor.Name_doctor = doctor.ID
            WHERE
            customer_doctor.Name_customer = ?',[$ID_customer]);
        $type_of_con = DB::select('Select * from type_of_con');
        // return view('screen/screen', compact('teeth', 'processround', 'order', 'processround', 'id', 'order_teeth_screen'));
        // return $order;

         $company = DB::select('SELECT
                    company.ID,
                    company.`Name`,
                    company.fullname,
                    company.name_eng,
                    company.address,
                    company.create_at
                    FROM
                    company
        ');

         $type_Branch = DB::select('SELECT
                    type_Branch.ID,
                    type_Branch.`Name`,
                    type_Branch.companyID,
                    type_Branch.lab,
                    type_Branch.AreaID,
                    type_Branch.ZoneID,
                    type_Branch.send_object,
                    type_Branch.send_bill,
                    type_Branch.Tel,
                    type_Branch.Fax,
                    type_Branch.HN,
                    type_Branch.TaxID,
                    type_Branch.create_at
                    FROM
                    type_Branch
        ');

        $customer = DB::select('SELECT
                    customer.ID,
                    customer.CustomerCode2,
                    customer.CustomerCode,
                    customer.`Name`,
                    customer.short_Name,
                    customer.CustomerTypeID,
                    customer.AreaID,
                    customer.NameCustomer1,
                    customer.NameCustomer2,
                    customer.send_object,
                    customer.send_bill,
                    customer.Tel,
                    customer.HN,
                    customer.TaxID,
                    customer.`status`,
                    customer.CustomerName,
                    customer.CustomerAddress,
                    customer.CustomerVisitor,
                    customer.CustomerCredit,
                    customer.CustomerLimitMoney,
                    customer.CustomerTel1,
                    customer.CustomerTel2,
                    customer.CustomerTaxID,
                    customer.CustomerAccNo,
                    customer.CustomerTransport,
                    customer.lat,
                    customer.lon,
                    customer.province,
                    customer.Country
                    FROM
                    customer
        ');


        return view('screen/new_screen_edit', compact('work_defect1','work_defect2','work_defect3','work_defect4','teeth',
         'processround', 'order', 'processround', 'id', 'order_teeth_screen', 'data_select_extra', 'type_Deliver',
          'data_select_attachment', 'data_select_IMPLANT_Attachment', 'screen_SHADE_Brand', 'screen_SHADE_Colors',
          'data_select_extra_additional','extra','extra_implant_attachment','extra_attachment','list_doctor',
        'Female_Mesial','Female_Distal','Male_Mesial','Male_Distal','type_of_con','company','type_Branch','customer'));
    }

    public function eidt_save(Request $request)
    {
        DB::delete("DELETE FROM select_extra WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_Attachment WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_IMPLANT_Attachment WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_extra_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_Attachment_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM select_IMPLANT_Attachment_additional WHERE ID_order_screen = '$request->ID_order_screen'");
        DB::delete("DELETE FROM INTERLOCK WHERE screen_ID = '$request->ID_order_screen'");

        if($request->Female_Mesial != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Female', 'Mesial', ?)
            ",[$request->ID_order_screen,$request->Female_Mesial,now(),]);
        }
        if($request->Female_Distal != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Female', 'Distal', ?)
            ",[$request->ID_order_screen,$request->Female_Distal,now(),]);
        }
        if($request->Male_Mesial != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Male', 'Mesial', ?)
            ",[$request->ID_order_screen,$request->Male_Mesial,now(),]);
        }
        if($request->Male_Distal != null){
            $test = DB::insert("INSERT INTO INTERLOCK (screen_ID,Teeth_ID,Sex,Side,created_at) VALUES(?, ?, 'Male', 'Distal', ?)
            ",[$request->ID_order_screen,$request->Male_Distal,now(),]);
        }

        if ($request->chkAttachment1 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment1;
            $select_Attachment->number = $request->txtAttachment1;
            $select_Attachment->assign = $request->txtAttachment2;
            $select_Attachment->save();
        }

        if ($request->chkAttachment2 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment2;
            $select_Attachment->number = $request->txtAttachment2;
            $select_Attachment->save();
        }

        if ($request->chkAttachment3 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment3;
            $select_Attachment->number = $request->txtAttachment3;
            $select_Attachment->save();
        }

        if ($request->chkAttachment4 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment4;
            $select_Attachment->number = $request->txtAttachment4;
            $select_Attachment->save();
        }

        if ($request->chkAttachment5 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment5;
            $select_Attachment->number = $request->txtAttachment5;
            $select_Attachment->save();
        }

        if ($request->chkAttachment6 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment6;
            $select_Attachment->number = $request->txtAttachment6;
            $select_Attachment->save();
        }

        if ($request->chkAttachment7 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment7;
            $select_Attachment->number = $request->txtAttachment7;
            $select_Attachment->save();
        }

        if ($request->chkAttachment8 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment8;
            $select_Attachment->number = $request->txtAttachment8;
            $select_Attachment->save();
        }

        if ($request->chkAttachment9 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment9;
            $select_Attachment->number = $request->txtAttachment9;
            $select_Attachment->save();
        }

        if ($request->chkAttachment10 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment10;
            $select_Attachment->number = $request->txtAttachment10;
            $select_Attachment->save();
        }

        if ($request->chkAttachment11 != null) {
            $select_Attachment = new select_Attachment();
            $select_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_Attachment->topic = $request->chkAttachment11;
            $select_Attachment->number = $request->txtAttachment11;
            $select_Attachment->save();
        }
        // -------------------------------------------------------------------------------

        if ($request->chkAttachmentImp1 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp1;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt1;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp1;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp2 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp2;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt2;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp2;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp3 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp3;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt3;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp3;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp4 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp4;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt4;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp4;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp5 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp5;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt5;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp5;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp6 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp6;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt6;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp6;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp7 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp7;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt7;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp7;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp8 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp8;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt8;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp8;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkAttachmentImp9 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp9;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt9;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp9;
            $select_IMPLANT_Attachment->save();
        }
        if ($request->chkAttachmentImp10 != null) {
            $select_IMPLANT_Attachment = new select_IMPLANT_Attachment();
            $select_IMPLANT_Attachment->ID_order_screen = $request->ID_order_screen;
            $select_IMPLANT_Attachment->topic = $request->chkAttachmentImp10;
            $select_IMPLANT_Attachment->number = $request->txtAttachmentImpAmt10;
            $select_IMPLANT_Attachment->assign = $request->txtAttachmentImp10;
            $select_IMPLANT_Attachment->save();
        }

        if ($request->chkCmd1 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd1;
            $select_extra->detail = $request->rdoGroupCmd1;
            $select_extra->save();
        }

        if ($request->chkCmd2 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd2;
            $select_extra->detail = $request->rdoGroupCmd2;
            $select_extra->save();
        }

        if ($request->chkCmd3 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd3;
            $select_extra->detail = $request->rdoGroupCmd3;
            $select_extra->save();
        }

        if ($request->chkCmd4 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd4;
            $select_extra->detail = $request->rdoGroupCmd4;
            $select_extra->save();
        }

        if ($request->chkCmd5 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd5;
            $select_extra->detail = $request->rdoGroupCmd5;
            $select_extra->save();
        }

        if ($request->chkCmd6 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd6;
            $select_extra->detail = $request->rdoGroupCmd6;
            $select_extra->save();
        }

        if ($request->chkCmd7 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd7;
            $select_extra->save();
        }

        if ($request->chkCmd8 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd8;
            $select_extra->save();
        }

        if ($request->chkCmd9 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd9;
            $select_extra->save();
        }

        if ($request->chkCmd10 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd10;
            $select_extra->save();
        }

        if ($request->chkCmd11 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd11;
            $select_extra->note = $request->txtCmd11;
            $select_extra->save();
        }

        if ($request->chkCmd12 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd12;
            $select_extra->note = $request->txtCmd12;
            $select_extra->save();
        }

        if ($request->chkCmd13 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd13;
            $select_extra->save();
        }

        if ($request->chkCmd14 != null) {
            $select_extra = new select_extra();
            $select_extra->ID_order_screen = $request->ID_order_screen;
            $select_extra->topic = $request->chkCmd14;
            $select_extra->detail = $request->rdoGroupCmd14;
            $select_extra->save();
        }

        $select_extra_additional = new select_extra_additional();
        $select_extra_additional->ID_order_screen = $request->ID_order_screen;
        $select_extra_additional->detail = $request->comment_extra;
        $select_extra_additional->save();

        $select_Attachment_additional = new select_Attachment_additional();
        $select_Attachment_additional->ID_order_screen = $request->ID_order_screen;
        $select_Attachment_additional->detail = $request->comment_attachment;
        $select_Attachment_additional->save();

        $select_IMPLANT_Attachment_additional = new select_IMPLANT_Attachment_additional();
        $select_IMPLANT_Attachment_additional->ID_order_screen = $request->ID_order_screen;
        $select_IMPLANT_Attachment_additional->detail = $request->comment_implant_attachment;
        $select_IMPLANT_Attachment_additional->save();

        if($request->rdoWork == 'new'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            DoctorID = '$request->doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = null,
            ContiBarcode = null,
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            Datefinal = '$request->Datefinal',
            DeliverDate_comment = '$request->DeliverDate_comment',
            ddlWorkLate = '$request->ddlWorkLate',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlTypeEdit = null,
            type_of_con = null,
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        } else if($request->rdoWork == 'con'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = null,
            ContiBarcode = '$request->RefBarcode',
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            DeliverDate_comment = '$request->DeliverDate_comment',
            ddlWorkLate = '$request->ddlWorkLate',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlTypeEdit = null,
            type_of_con = '$request->type_of_con',
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        } else if($request->rdoWork == 'edit'){
            DB::update("UPDATE order_screen SET PatientHN = '$request->PatientHN',
            PatientName = '$request->PatientName',
            PatientAge = '$request->PatientAge',
            StartDate = '$request->StartDate',
            DeliverDate = '$request->DeliverDate',
            Delaydate = '$request->Delaydate',
            Delaytime = '$request->Delaytime',
            ReceptionTime = '$request->ReceptionTime',
            processroundID = '$request->processround',
            Address = '$request->Address',
            phone = '$request->phone',
            technician_recommend = '$request->technician_recommend',
            phone_customer = '$request->phone_customer',
            line_doctor = '$request->line_doctor',
            phone_doctor = '$request->phone_doctor',
            note = '$request->note',
            Barcode = '$request->Barcode',
            RefBarcode = '$request->RefBarcode',
            ContiBarcode = null,
            DeliverType = '$request->type_Deliver',
            ReceptionTime = '$request->ReceptionTime',
            FinalTime = '$request->FinalTime',
            DeliverDate_comment = '$request->DeliverDate_comment',
            ddlWorkLate = '$request->ddlWorkLate',
            Employee_DeliverDate_comment = '$request->Employee_DeliverDate_comment',
            comment_WorkLate = '$request->comment_WorkLate',
            comment_WorkLate_before = '$request->comment_WorkLate_before',
            comment_Workdefect1 = '$request->comment_Workdefect1',
            comment_Workdefect2 = '$request->comment_Workdefect2',
            ddlTypeEdit = '$request->ddlTypeEdit',
            type_of_con = null,
            FactoryID = '$request->FactoryID',
            CustomerID = '$request->CustomerID'
            where ID = '$request->ID_order_screen' ", []);
        }

        if ($request->checkjob == '1') {
            $order_screen = order_screen::where('ID', $request->ID_order_screen)->first();

            DB::update("UPDATE order_screen SET order_screen.status_screen = 1 WHERE order_screen.ID = ? ", [$request->ID_order_screen]);

            $job_check = job::where('ID_order_screen', $request->ID_order_screen)->first();

            if($order_screen->DeliverType != '5' && empty($job_check) )
            {
                $data_job = new job();
                $data_job->ID_order_screen = $request->ID_order_screen;
                // $data_job->BranchID = $order_screen->BranchID;
                $data_job->job_current_department = '0';
                $data_job->date_time_start = \Carbon\Carbon::now();
                $data_job->save();
                $order_teeth_screen = DB::update("UPDATE order_teeth_screen SET editable = null WHERE ScreenID = ? ",[$request->ID_order_screen]);
                return redirect('/mainscreen');
            }
            else
            {
                $order_teeth_screen = DB::update("UPDATE order_teeth_screen SET editable = null WHERE ScreenID = ? ",[$request->ID_order_screen]);
                return redirect('/mainscreen');
            }

        } else {
            $TeethID = array();
            $screen_group = "";
            for ($i = 11; $i <= 48; $i++) {
                $chkTooth = "chkTooth_" . $i;
                if ($request->input($chkTooth) != null) {
                    $TeethID[] = $request->input($chkTooth);
                    DB::update("UPDATE order_teeth_screen SET status = '1' where  ScreenID = '$request->ID_order_screen' AND TeethID = '$i'  ", []);
                    $screen_group = $screen_group . $i .",";
                }
            }
            $screen_group = substr($screen_group, 0, -1);

            foreach ($TeethID as $out_TeethID) {
                $data_screen = new screen();
                $data_screen->TeethID = $out_TeethID;
                $data_screen->ID_order_screen = $request->ID_order_screen;
                $data_screen->model = $request->rdoGroupModel;
                $data_screen->model_resin = $request->rdoModelResin;
                $data_screen->implant = $request->rdoGroupRetained;
                $data_screen->implant_ceramage = $request->rdoGroupSystem;
                // $data_screen->implant_screw = $request->rdoGroupBrand;
                $data_screen->Metal_type = $request->rdoAlloys1;
                $data_screen->Metal_type2 = $request->rdoAlloys2;
                $data_screen->Metal_type3 = $request->rdoAlloys3;
                $data_screen->Metal_type4 = $request->rdoAlloys4;
                $data_screen->Metal_type5 = $request->rdoAlloys5;
                $data_screen->Metal_type6 = $request->rdoAlloys6;
                $data_screen->Hook = $request->rdoRest;
                $data_screen->MESIAL_REST = $request->chkHaveRest1;
                $data_screen->DISTAL_REST = $request->chkHaveRest2;
                $data_screen->CINGULUM_REST = $request->chkHaveRest3;
                $data_screen->EMBRESSURE_REST = $request->chkHaveRest5;
                $data_screen->LINGUAL_LEDGE = $request->chkHaveRest4;
                $data_screen->other_hook = $request->rdoUndercut;
                $data_screen->undercut_hook = $request->rdoGroupHaveUndercut;
                $data_screen->unit_CONTOUR = $request->rdoUnder;
                $data_screen->OCCLUSAL_STAINING = $request->rdoStaining;
                $data_screen->PONTIC_DESIGN = $request->PONTIC_DESIGN;
                $data_screen->MARGIN1 = $request->MARGIN1;
                $data_screen->MARGIN2 = $request->MARGIN2;
                $data_screen->MARGIN3 = $request->MARGIN3;
                $data_screen->MARGIN_Buccal = $request->MARGIN_Buccal;
                $data_screen->MARGIN_Lingual = $request->MARGIN_Lingual;
                $data_screen->FixCement = $request->rdoFixCement;
                $data_screen->GINGIVAL_EMBRASURES = $request->chkGingival;
                $data_screen->OCCLUSION = $request->chkOcclusion;
                $data_screen->CONTACT = $request->chkContact;
                $data_screen->shade = $request->rdoShade;
                $data_screen->one_color = $request->rdoGroupShade;
                $data_screen->one_color_extra1 = $request->rdoGroupShade2;
                $data_screen->one_color_Combobox = $request->txtDoctorShade;

                if($request->ddlShadeBrand == 'อื่นๆ'){
                    $data_screen->one_color_branch = $request->txtShadeOne;
                    $data_screen->one_color_branch_color = $request->txtColorOne;
                }else{
                    $data_screen->one_color_branch = $request->ddlShadeBrand;
                    $data_screen->one_color_branch_color = $request->ddlShadeColor;
                }
                if($request->ddlShadeBrandMulti1 == 'อื่นๆ'){
                    $data_screen->many_branch_crowns = $request->txtShadeBrandMulti1;
                    $data_screen->many_color_crowns = $request->txtShadeColorMulti1;
                }else{
                    $data_screen->many_branch_crowns = $request->ddlShadeBrandMulti1;
                    $data_screen->many_color_crowns = $request->ddlShadeColordMulti1;
                }
                if($request->ddlShadeBrandMulti2 == 'อื่นๆ'){
                    $data_screen->many_branch_Middle = $request->txtShadeBrandMulti2;
                    $data_screen->many_color_Middle = $request->txtShadeColorMulti2;
                }else{
                    $data_screen->many_branch_Middle = $request->ddlShadeBrandMulti2;
                    $data_screen->many_color_Middle = $request->ddlShadeColordMulti2;
                }
                if($request->ddlShadeBrandMulti3 == 'อื่นๆ'){
                    $data_screen->many_branch_tip = $request->txtShadeBrandMulti3;
                    $data_screen->many_color_tip = $request->txtShadeColorMulti3;
                }else{
                    $data_screen->many_branch_tip = $request->ddlShadeBrandMulti3;
                    $data_screen->many_color_tip = $request->ddlShadeColordMulti3;
                }
                $data_screen->stump = $request->rdoGroupStump;
                if($request->ddlStumpBrand == 'อื่นๆ'){
                    $data_screen->one_branch_stump = $request->txtStumpBrand;
                    $data_screen->one_color_stump = $request->txtStumpColor;
                }else{
                    $data_screen->one_branch_stump = $request->ddlStumpBrand;
                    $data_screen->one_color_stump = $request->ddlStumpColor;
                }
                $data_screen->comment_shade = $request->txtDoctorShade;
                $data_screen->comment_stump = $request->txtDoctorStump;
                $data_screen->comment_Metal_type = $request->txtDoctorAlloys;
                $data_screen->comment_model = $request->txtDoctorModel;
                $data_screen->comment_fix_cement = $request->txtDoctorFix;
                $data_screen->screen_group = $screen_group;
                $data_screen->status = '1';
                $data_screen->implant_brand = $request->rdoGroupImpBrand;
                $data_screen->implant_brand_comment = $request->txtImpBrandOther;
                $data_screen->txtCommentAlloys = $request->txtCommentAlloys;
                $data_screen->txtCommentShade = $request->txtCommentShade;
                $data_screen->txtCommentStump = $request->txtCommentStump;
                $data_screen->txtCommentModel = $request->txtCommentModel;
                $data_screen->txtCommentFixCement = $request->txtCommentFixCement;
                $data_screen->created_at = NOW();
                $data_screen->updated_at = NOW();
                $data_screen->EmployeeID = Auth::user()->id;
                $data_screen->Pintooth = $request->rdopintooth;
                $data_screen->PinToothHook = $request->rdopintoothhook;//ดึงข้อมูลมาแสดง
                $data_screen->PinToothHookRest = $request->chkHaveRestpintooth;
                $data_screen->PintoothAlloys = $request->chkpintoothalloys;
                $data_screen->PintoothAlloysNote = $request->Notepintoothalloys;
                $data_screen->PintoothAlloysComment = $request->Commentpintoothalloys;
                // $data_screen->MARGIN_Buccal = $request->MARGIN_Buccal;
                // $data_screen->MARGIN_Lingual = $request->MARGIN_Lingual;
                $data_screen->save();

            }
            return redirect('/mainscreen/edit_screen_teeth/' . $request->ID_order_screen);
        }
    }

    public function saveFile(Request $req) {
        // return $req;
        $tf = new screen_file();
        if($req->hasFile('txtFile')) {
        //   $filename = 'file_'.date('dmY').'_'.str_random(5) .'.'. $req->file('txtFile')->getClientOriginalExtension();
          $datenow = date("dmhms", strtotime( now() ));
          $filename = $req->barcode.'_'.$datenow.'_'.$req->file('txtFile')->getClientOriginalName();
          $req->file('txtFile')->move(public_path('file'), $filename);
          $tf->name_file = $filename;
        }

        // $tf->user_id = Auth::user()->id;
        // $tf->office_id = Auth::User()->office_id;
        $tf->barcode = $req->barcode;
        $tf->screen_id = $req->screen_id;
        $tf->type = "1";
        $tf->save();

        return response()->json([
          'msg'=>'แนบเอกสารสำเร็จ',
          'file_name'=>$tf->name_file,
          'id_file'=>str_replace( '.', '', $req->barcode.'_'.$req->file('txtFile')->getClientOriginalName() ),
          'download'=>'<p class="mt-1"><a href="'.url('local/public/file').'/'.$tf->name_file.'" target="_blank" class="btn btn-success btn-rounded btn-block"><i class="fa fa-file-pdf"></i> <span></span>'.$tf->name_file.'</a></p>'
        ]);
    }

    public function deleteFile(Request $req) {
        
        // $tf = new screen_file();
        // if($req->hasFile('txtFile')) {
        // //   $filename = 'file_'.date('dmY').'_'.str_random(5) .'.'. $req->file('txtFile')->getClientOriginalExtension();
        //   $filename = $req->barcode.'_'.$req->file('txtFile')->getClientOriginalName();
        //   $req->file('txtFile')->move(public_path('file'), $filename);
        //   $tf->name_file = $filename;
        // }
        // // $tf->user_id = Auth::user()->id;
        // // $tf->office_id = Auth::User()->office_id;
        // $tf->barcode = $req->barcode;
        // $tf->screen_id = $req->screen_id;
        // $tf->type = "1";
        // $tf->save();

        DB::table('screen_file')->where('name_file', '=', $req->file_name)
                                ->where('barcode', '=', $req->barcode)   
                                ->delete();

        unlink(public_path('file/'.$req->file_name));
                                
        return response()->json([
            'msg'=>'ลบสำเร็จ',
            'id'=>  '.file_'.$req->id
            ]);
    }
}
