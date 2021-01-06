<?php

namespace App\Http\Controllers;

use App\area;
use App\zone;
use DB;
use Illuminate\Http\Request;
use Gate;

class area_controller extends Controller
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

        $data_area = DB::select("SELECT
                                        area.ID,
                                        area.`Name`,
                                        zone.Name AS 'Area',
                                        area.ZoneID
                                        FROM
                                        area
                                        INNER JOIN zone
                                        ON zone.ID=area.ZoneID", []);

        $data_zone = zone::all();

        return view('Service Area.service_area', compact('data_area', 'data_zone'));
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
            'Name' => 'required',
        ], [
            'Name.required' => 'ชื่อพื้นที่ให้บริการต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->Name;
        $ZoneID = $request->ZoneID;
        area::insert($Name, $ZoneID);

        return redirect('service_area');
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
            'Name' => 'required',
        ], [
            'Name.required' => 'ชื่อพื้นที่ให้บริการต้องไม่ว่าง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->Name;
        $ZoneID = $request->ZoneID;
        area::update_by_id($id, $Name, $ZoneID);

        return redirect('service_area');
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

        area::delete_by_id($id);

        return redirect('service_area');
    }
}
