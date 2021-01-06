<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Gate;
use DB;
use App\Employee;

class production_scan_profile_controller extends Controller
{
    public function getIndex(Request $request)
    {
        $data_employee = DB::table('Employee')
        ->select('Employee.ID_user','Employee.ID_Employee','Employee.ID_area','Employee.Name','Employee.Nick_name','Employee.cotton','users.picture_user','company.fullname')
        ->join('users', 'Employee.ID', '=', 'users.id')
        ->join('company', 'Employee.ID_company', '=', 'company.ID')
        ->where('ID_user', $request->scanbarcode_pf)
        ->get();

        $data_product = DB::table('screen')
        ->select('screen.ID',
        'screen.ID_order_screen',
        'screen.TeethID',
        'screen.Metal_type',
        'screen.Hook',
        'screen.MESIAL_REST',
        'screen.DISTAL_REST',
        'screen.CINGULUM_REST',
        'screen.EMBRESSURE_REST',
        'screen.LINGUAL_LEDGE',
        'screen.other_hook',
        'screen.undercut_hook',
        'screen.unit_hook',
        'screen.UNDERCUT',
        'screen.CONTOUR',
        'screen.unit_CONTOUR',
        'screen.one_color',
        'screen.one_color_Combobox',
        'screen.one_color_branch',
        'screen.one_color_branch_color',
        'screen.many_color_crowns',
        'screen.many_branch_crowns',
        'screen.many_color_Middle',
        'screen.many_branch_Middle',
        'screen.many_color_tip',
        'screen.many_branch_tip',
        'screen.OCCLUSAL_STAINING',
        'screen.PONTIC_DESIGN',
        'screen.MARGIN',
        'screen.Metal_Margin_detail',
        'screen.status')
        ->where('screen.ID_order_screen', $request->scanbarcode_pd)
        ->groupBy('screen.ID_order_screen')
        ->get();

        $product = null;
        $profile = null;

        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
    return view('Production.production_scan_profile',compact('data_employee','data_product','profile','product'));
    }
    public function scan(Request $request)
    {
        $product = $request->scanbarcode1;
        $profile = $request->scanbarcode2;
        $data_employee = DB::table('Employee')
            ->select('Employee.ID_user','Employee.ID_Employee','Employee.ID_area','Employee.Name','Employee.Nick_name','Employee.cotton','users.picture_user','company.fullname')
            ->join('users', 'Employee.ID', '=', 'users.id')
            ->join('company', 'Employee.ID_company', '=', 'company.ID')
            ->where('ID_user',$request->scanbarcode2)
            ->get();
        $data_product = DB::table('screen')
            ->select('screen.ID',
            'screen.ID_order_screen',
            'screen.TeethID',
            'screen.Metal_type',
            'screen.Hook',
            'screen.MESIAL_REST',
            'screen.DISTAL_REST',
            'screen.CINGULUM_REST',
            'screen.EMBRESSURE_REST',
            'screen.LINGUAL_LEDGE',
            'screen.other_hook',
            'screen.undercut_hook',
            'screen.unit_hook',
            'screen.UNDERCUT',
            'screen.CONTOUR',
            'screen.unit_CONTOUR',
            'screen.one_color',
            'screen.one_color_Combobox',
            'screen.one_color_branch',
            'screen.one_color_branch_color',
            'screen.many_color_crowns',
            'screen.many_branch_crowns',
            'screen.many_color_Middle',
            'screen.many_branch_Middle',
            'screen.many_color_tip',
            'screen.many_branch_tip',
            'screen.OCCLUSAL_STAINING',
            'screen.PONTIC_DESIGN',
            'screen.MARGIN',
            'screen.Metal_Margin_detail',
            'screen.status')
            ->where('screen.ID_order_screen', $request->scanbarcode1)
            ->groupBy('screen.ID_order_screen')
            ->get();
        
        if($request->scanbarcode1 != null || $request->scanbarcode2 != null){
            $data_employee = DB::table('Employee')
            ->select('Employee.ID_user','Employee.ID_Employee','Employee.ID_area','Employee.Name','Employee.Nick_name','Employee.cotton','users.picture_user','company.fullname')
            ->join('users', 'Employee.ID', '=', 'users.id')
            ->join('company', 'Employee.ID_company', '=', 'company.ID')
            ->where('ID_user',$request->scanbarcode2)
            ->get();

            $data_product = DB::table('screen')
            ->select('screen.ID',
            'screen.ID_order_screen',
            'screen.TeethID',
            'screen.Metal_type',
            'screen.Hook',
            'screen.MESIAL_REST',
            'screen.DISTAL_REST',
            'screen.CINGULUM_REST',
            'screen.EMBRESSURE_REST',
            'screen.LINGUAL_LEDGE',
            'screen.other_hook',
            'screen.undercut_hook',
            'screen.unit_hook',
            'screen.UNDERCUT',
            'screen.CONTOUR',
            'screen.unit_CONTOUR',
            'screen.one_color',
            'screen.one_color_Combobox',
            'screen.one_color_branch',
            'screen.one_color_branch_color',
            'screen.many_color_crowns',
            'screen.many_branch_crowns',
            'screen.many_color_Middle',
            'screen.many_branch_Middle',
            'screen.many_color_tip',
            'screen.many_branch_tip',
            'screen.OCCLUSAL_STAINING',
            'screen.PONTIC_DESIGN',
            'screen.MARGIN',
            'screen.Metal_Margin_detail',
            'screen.status')
            ->where('screen.ID_order_screen', $request->scanbarcode1)
            ->groupBy('screen.ID_order_screen')
            ->get();
        
        
        $product = $request->scanbarcode1;
        $profile = $request->scanbarcode2;
        }
        if($request->scanbarcode3 != null || $request->scanbarcode4 != null){
            $data_employee = DB::table('Employee')
            ->select('Employee.ID_user','Employee.ID_Employee','Employee.ID_area','Employee.Name','Employee.Nick_name','Employee.cotton','users.picture_user','company.fullname')
            ->join('users', 'Employee.ID', '=', 'users.id')
            ->join('company', 'Employee.ID_company', '=', 'company.ID')
            ->where('ID_user',$request->scanbarcode3)
            ->get();

            $data_product = DB::table('screen')
            ->select('screen.ID',
            'screen.ID_order_screen',
            'screen.TeethID',
            'screen.Metal_type',
            'screen.Hook',
            'screen.MESIAL_REST',
            'screen.DISTAL_REST',
            'screen.CINGULUM_REST',
            'screen.EMBRESSURE_REST',
            'screen.LINGUAL_LEDGE',
            'screen.other_hook',
            'screen.undercut_hook',
            'screen.unit_hook',
            'screen.UNDERCUT',
            'screen.CONTOUR',
            'screen.unit_CONTOUR',
            'screen.one_color',
            'screen.one_color_Combobox',
            'screen.one_color_branch',
            'screen.one_color_branch_color',
            'screen.many_color_crowns',
            'screen.many_branch_crowns',
            'screen.many_color_Middle',
            'screen.many_branch_Middle',
            'screen.many_color_tip',
            'screen.many_branch_tip',
            'screen.OCCLUSAL_STAINING',
            'screen.PONTIC_DESIGN',
            'screen.MARGIN',
            'screen.Metal_Margin_detail',
            'screen.status')
            ->where('screen.ID_order_screen', $request->scanbarcode4)
            ->groupBy('screen.ID_order_screen')
            ->get();
        
        
        $product = $request->scanbarcode4;
        $profile = $request->scanbarcode3;
        }
        if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }
        return view('Production.production_scan_profile',compact('data_employee','data_product','profile','product'));
    }
}
