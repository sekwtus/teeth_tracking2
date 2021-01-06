<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\doctor;
use DataTables;

class testdatatable_controller extends Controller
{
    public function view()
    {
        $doctor = doctor::all();

        return view('testdatatable', compact('doctor'));
    }

    public function index_yajra()
    {
        $doctor = doctor::select(['ID', 'Name']);

        return Datatables::of($doctor)->make(true);
    }
}
