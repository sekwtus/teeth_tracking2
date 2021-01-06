<?php

namespace App\Http\Controllers;
use DataTables;
use App\doctor;
use Illuminate\Http\Request;
use Gate;

class doctor_controller extends Controller
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

        $data_doctor = doctor::all();

        return view('Doctor.doctor', compact('data_doctor'));
    }


    public function index_yajra()
    {
        // return Datatables::of(doctor::query())->make(true);

        $doctor = doctor::select(['ID', 'Name']);

        return Datatables::of($doctor)->make(true);
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
            // 'email' => 'email',
        ], [
            'Name.required' => 'ชื่อแพทย์ต้องไม่ว่าง',
            // 'email.email' => 'ใส่รูปแบบอีเมล์ให้ถูกต้อง',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $Name = $request->Name;
        $Phone = $request->Phone;
        $email = $request->email;
        // $Address = $request->Address;
        doctor::insert($Name, $Phone, $email);

        return redirect('doctor');
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
    public function update(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        // $validate = \Validator::make($request->all(), [
        //     'Name' => 'required',
        //     'email' => 'email',
        // ], [
        //     'Name.required' => 'ชื่อแพทย์ต้องไม่ว่าง',
        //     'email.email' => 'ใส่รูปแบบอีเมล์ให้ถูกต้อง',
        // ]);

        // if ($validate->fails()) {
        //     return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        // }
        $id = $request->ID;
        $Name = $request->Name;
        $Phone = $request->Phone;
        $email = $request->email;
        $Line = $request->Line_doctor;
        doctor::update_by_id($id, $Name, $Phone, $email, $Line);

        return redirect('doctor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        doctor::delete_by_id($request->ID);

        return 'ลบสำเร็จ';
    }


    public function updateStatus(Request $request, $id)
    {
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        $id_doctor = $id;
        doctor::update_status($id_doctor);

        return redirect('doctor');
    }

}
