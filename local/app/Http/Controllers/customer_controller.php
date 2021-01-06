<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\customer;
use App\customer_type;
use App\area;
use Gate;
use DB;

class customer_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $data_customer = DB::select("SELECT
                                        customer.ID,
                                        customer.`Name`,
                                        customer_type.name AS 'CustomerType',
                                        area.Name AS 'Area',
                                        customer.CustomerTypeID,
                                        customer.AreaID
                                        FROM
                                        customer
                                        LEFT JOIN customer_type
                                        ON customer_type.id=customer.CustomerTypeID
                                        LEFT JOIN area
                                        ON area.ID=customer.AreaID LIMIT 300", []);
                                        // return $data_customer;
        $data_customer_all = DB::select("SELECT
                                        customer.ID,
                                        customer.`Name`,
                                        customer.CustomerTypeID,
                                        customer.AreaID,
                                        customer.CustomerCode2,
                                        customer.CustomerCode,
                                        customer.short_Name,
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
                                        customer");
        $data_type_customer = customer_type::all();

        $data_area = area::all();

        return view('Customer.customer',compact('data_customer','data_type_customer','data_area','data_customer_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $validate = \Validator::make($request->all(), [
            'Name'  =>  'required',
            'short_Name' =>  'required',
        ], [
            'Name.required'  =>  'ชื่อลูกค้าต้องไม่ว่าง',
            'short_Name.required'  =>  'ชื่อย่อลูกค้าต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->short_Name;
        $CustomerTypeID = $request->CustomerTypeID;
        $AreaID = $request->AreaID;
        $CustomerCode= $request->CustomerCode;
        $CustomerCode2= $request->CustomerCode2;
        $short_Name =$request->Name;
        $send_object = $request->send_object;
        $Tel = $request->Tel;
        $send_bill = $request->send_bill;
        $TaxID = $request->TaxID;

        customer::insert($Name,$CustomerTypeID,$AreaID,$CustomerCode,$CustomerCode2,$short_Name,$send_object, $Tel,$send_bill ,$TaxID);

        return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_customer(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $validate = \Validator::make($request->all(), [
            'Name'  =>  'required',
        ], [
            'Name.required'  =>  'ชื่อลูกค้าต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }
        $id = $request->ID_;
        $Name = $request->Name;
        $CustomerTypeID = $request->CustomerTypeID;
        $AreaID = $request->AreaID;
        $short_Name = $request->short_Name;
        $CustomerCode = $request->CustomerCode;
        $CustomerCode2 = $request->CustomerCode2;
        $send_object = $request->send_object;
        $send_bill = $request->send_bill;
        $Tel = $request->Tel;
        $TaxID = $request->TaxID;
        customer::update_by_id($id,$Name,$CustomerTypeID,$AreaID,$short_Name,$CustomerCode,$CustomerCode2,$send_object,$send_bill,$Tel,$TaxID);

        return redirect('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateStatus(Request $request, $id)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $id_customer = $id;
        customer::update_status($id_customer);

        return redirect('customer');
    }

    public function delete_customer(Request $request){
        // return 'delete_customer';

        DB::delete("DELETE FROM customer WHERE ID = '$request->ID_'");
        return 'ลบข้อมูลสำเร็จ';
    }

}
