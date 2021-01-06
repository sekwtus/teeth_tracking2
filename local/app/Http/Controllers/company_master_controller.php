<?php

namespace App\Http\Controllers;

use App\company;
use App\Branch;
use App\division;
use App\department;
use App\sub_department;
use DB;

class company_master_controller extends Controller
{
    public function index()
    {
        $data_company = company::all();

        return view('master.company_master1', compact('data_company'));
    }

    public function branch($id)
    {
        $data_branch = DB::select("SELECT
                                        type_Branch.ID,
                                        type_Branch.`Name`,
                                        type_Branch.companyID
                                        FROM
                                        type_Branch
                                        WHERE
                                        type_Branch.companyID = '$id' ");

        return view('master.company_master2', compact('data_branch'));
    }

    public function division($id)
    {
        $data_division = DB::select("SELECT
                                            division.`Name`,
                                            division.ID
                                            FROM
                                            division
                                            WHERE
                                            division.BranchID = '$id' ");

        return view('master.company_master3', compact('data_division'));
    }

    public function department($id)
    {
        $data_department = DB::select("SELECT
                                            department.ID,
                                            department.DivisionID,
                                            department.`Name`
                                            FROM
                                            department
                                            WHERE
                                            department.DivisionID = '$id' ");
        //return $data_department;
        return view('master.company_master4', compact('data_department'));
    }

    public function sub_department($id)
    {
        $sub_department = DB::select("SELECT
                                                sub_department.ID,
                                                sub_department.DepartmentID,
                                                sub_department.`Name`
                                                FROM
                                                sub_department
                                                WHERE
                                                sub_department.DepartmentID = '$id' ");
        //return $sub_department;
        return view('master.company_master5', compact('sub_department'));
    }
}
