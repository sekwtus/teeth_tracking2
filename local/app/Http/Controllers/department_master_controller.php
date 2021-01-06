<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;
use App\Branch;
use App\Employee;
use App\users;
use App\type_users;
use DB;
use Auth;
use Carbon\Carbon;
use Gate;

class department_master_controller extends Controller
{
    public function Index()
    {
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('master.department_master',compact(''));
    }
}
