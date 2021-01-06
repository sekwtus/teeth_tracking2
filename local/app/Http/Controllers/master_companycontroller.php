<?php

namespace App\Http\Controllers;

use App\company;
use App\Branch;
use App\division;
use App\department;
use App\sub_department;

class master_companycontroller extends Controller
{
    public function index()
    {
        $data_company = company::all();

        $data_branch = Branch::all();

        $data_division = division::all();

        $data_department = department::all();

        $data_sub_department = sub_department::all();

        return view('master.company_master', compact('data_company', 'data_branch', 'data_division', 'data_department', 'data_sub_department'));
    }
}
