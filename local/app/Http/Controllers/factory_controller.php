<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\zone;
use App\company;
use App\factory;
use Gate;

class factory_controller extends Controller
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

        $data_factory = DB::select("SELECT
                                        factory.ID,
                                        factory.`Name`,
                                        company.Name AS 'company',
                                        zone.Name AS 'zone',
                                        factory.CompanyID,
                                        factory.ZoneID
                                        FROM
                                        factory
                                        INNER JOIN company
                                        ON company.ID=factory.CompanyID
                                        INNER JOIN zone
                                        ON zone.ID=factory.ZoneID", []);
        $data_company = company::all();

        $data_zone = zone::all();

        return view('Factory.factory',compact('data_factory','data_company','data_zone'));
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
        ], [
            'Name.required'  =>  'ชื่อโรงงานต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->Name;
        $CompanyID = $request->CompanyID;
        $ZoneID = $request->ZoneID;
        factory::insert($Name,$CompanyID,$ZoneID);

        return redirect('factory');
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
    public function update(Request $request, $id)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $validate = \Validator::make($request->all(), [
            'Name'  =>  'required',
        ], [
            'Name.required'  =>  'ชื่อโรงงานต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->Name;
        $CompanyID = $request->CompanyID;
        $ZoneID = $request->ZoneID;
        factory::update_by_id($id,$Name,$CompanyID,$ZoneID);

        return redirect('factory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        factory::delete_by_id($id);

        return redirect('factory');
    }
}
