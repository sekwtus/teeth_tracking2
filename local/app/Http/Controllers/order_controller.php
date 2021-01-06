<?php

namespace App\Http\Controllers;

use App\job;
use Auth;
use DB;
use Gate;
use Illuminate\Http\Request;

class order_controller extends Controller
{
    public function getIndex()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        DB::delete("DELETE FROM order_sale WHERE order_sale.SaleID = ? AND updated_at is NULL", [Auth::user()->id]);
        DB::delete('DELETE FROM order_screen WHERE order_screen.SaleID = ? AND updated_at is NULL', [Auth::user()->id]);

        // $type_Deliver = order_sale::select_Deliver();
        $type_Deliver = DB::select('SELECT type_Deliver.ID,type_Deliver.`Name` FROM type_Deliver', []);
        $job_continue = job::select_job_continue();
        $job_sendBack = job::select_job_sendBack();

        return view('order/order', compact('type_Deliver', 'job_continue', 'job_sendBack'));
    }

    public function addorder(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }
        // order_sale::delete_main();
        // order_screen::delete_main();
        DB::delete('DELETE FROM order_sale WHERE order_sale.Barcode = ? AND updated_at is NULL', [$request->Barcode]);
        DB::delete('DELETE FROM order_screen WHERE order_screen.Barcode = ? AND updated_at is NULL', [$request->Barcode]);
        // return $request;
        $validate = \Validator::make($request->all(), [
            'Barcode' => 'required',
            'Barcode' => 'unique:order_screen,Barcode',
            'StartDate' => 'required',
            // 'Enddate' => 'required',
            // 'ReceptionTime' => 'required',
            // 'Datefinal' => 'required',
        ], [

            'Barcode.required' => 'Barcode ต้องไม่ว่าง',
            'Barcode.unique' => 'Barcode ต้องไม่ซ้ำ',
            'StartDate.required' => 'วันรับงาน ต้องไม่ว่าง',
            // 'Enddate.required' => 'วันส่งงาน ต้องไม่ว่าง',
            // 'ReceptionTime.required' => 'เวลารับงาน ต้องไม่ว่าง',
            // 'Datefinal.required' => 'วันรับจริง ต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        } else {
            // return $request;
            // ADD DATA
            // $data_order = new order_sale();
            // $data_order->Barcode = $request->Barcode;
            // $data_order->RefBarcode = $request->RefBarcode;
            // $data_order->StartDate = $request->StartDate;
            // $data_order->DeliverDate = $request->Enddate;
            // $data_order->ReceptionTime = $request->ReceptionTime;
            // $data_order->DeliverType = $request->radio;
            // $data_order->SaleID = Auth::user()->id;
            // $data_order->save();
            if($request->toggleOral == 'on'){
                $toggleOral = "Oral Scan";
            } else {
                $toggleOral = "พิมพ์ปาก";
            }
            DB::insert('INSERT INTO order_sale (Barcode,RefBarcode,ContiBarcode,StartDate,DeliverDate,ReceptionTime,DeliverType,SaleID,Datefinal,created_at,OralScan)
                    VALUES
                    (?,?,?,?,?,?,?,?,?,NOW(),?)', [$request->Barcode, $request->RefBarcode, $request->ContiBarcode, $request->StartDate, $request->Enddate, $request->ReceptionTime, $request->radio, Auth::user()->id, $request->Datefinal,$toggleOral]);

            // $data_screen = new order_screen();
            // $data_screen->Barcode = $request->Barcode;
            // $data_screen->RefBarcode = $request->RefBarcode;
            // $data_screen->StartDate = $request->StartDate;
            // $data_screen->DeliverDate = $request->Enddate;
            // $data_screen->ReceptionTime = $request->ReceptionTime;
            // $data_screen->DeliverType = $request->radio;
            // $data_screen->SaleID = Auth::user()->id;
            // $data_screen->save();

            DB::insert('INSERT INTO order_screen (ContiBarcode,Barcode,RefBarcode,StartDate,DeliverDate,ReceptionTime,DeliverType,SaleID,Datefinal,created_at,OralScan,DesRadio6)
                    VALUES
                    (?,?,?,?,?,?,?,?,?,NOW(),?,?)', [$request->ContiBarcode, $request->Barcode, $request->RefBarcode, $request->StartDate, $request->Enddate, $request->ReceptionTime, $request->radio, Auth::user()->id, $request->Datefinal,$toggleOral,$request->DesRadio6]);
        }
        if (Auth::user()->ID_type_users == 59) {
            // $area = area::select_all();
            $area = DB::select('SELECT area.ID,area.`Name` FROM area', []);

            return view('order.order3_3', compact('area'));
        } else {
            return redirect('/order2');
        }
    }
}
