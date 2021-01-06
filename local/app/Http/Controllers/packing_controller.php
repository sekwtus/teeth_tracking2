<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Gate;
use DB;
use App\job;
use App\order_screen;
use App\job_detail;

class packing_controller extends Controller
{
    public function getIndex(Request $request)
    {
        // if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin')) {
        //     abort(404, 'Page NotFound');
        // }
        $data_order_screen = order_screen::select_data_for_packing();
        $data_packing_finish = order_screen::select_data_packing_finish();

        return  view('Packing.packing', compact('data_order_screen', 'data_packing_finish'));
    }

    public function getIndex_detail_packing(Request $request, $id)
    {
        if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin')) {
            abort(404, 'Page NotFound');
        }

        $data_order_screen = order_screen::select_data_for_packing_detail($id);

        return  view('Packing.detail_packing', compact('data_order_screen'));
    }

    public function change_status(Request $request)
    {
        // if (!Gate::allows('IsSale') && !Gate::allows('IsAdmin')) {
        //     abort(404, 'Page NotFound');
        // }
        $ID_user = Auth::user()->id;
        $data_id = order_screen::where('Barcode', $request->scanbarcode_pd)->limit(1)->first();
        $count = order_screen::where('Barcode', $request->scanbarcode_pd)->count();
        $id = job::where('job.ID_order_screen', $data_id)->limit(1)->first();
        // dd($count);
        if ($count > 0) {
            DB::update('UPDATE job SET job.job_current_department = 7 WHERE job.ID_order_screen = ?', [$data_id->ID]);
            job_detail::packing($id, $ID_user);

            return redirect('packing')->with('massage', 'การสแกนบาร์โค้ดสำหรับบรรจุสำเร็จ');
        } else {
            return redirect('packing')->with('massage', 'บาร์โค้ดไม่ถูกต้อง กรุณาลองใหม่');
        }
    }
}
