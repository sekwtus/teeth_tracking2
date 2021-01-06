<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer_type;
use App\customer;
use App\customer_doctor;
use App\order_sale;
use App\order_screen;
use App\doctor;
use DB;
use Auth;
use Gate;

class order2_controller extends Controller
{
    public function index()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $customer_type_all = customer_type::all();

        return view('order.order2_1', compact('customer_type_all'));
    }

    public function index2($id)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        if(Auth::user()->ID_area == NULL){
            $area = DB::select("SELECT * FROM `area`", []);
            $data_customer = DB::select("SELECT customer_type.id,customer_type.`name` FROM customer_type WHERE customer_type.id = '$id'", []);
            return view('order.order2_1_1', compact('area','data_customer'));
        }

        $order_sale = order_sale::orderBy('id', 'desc')->where('SaleID', Auth::user()->id)->limit(1)->first();
        $id_area = $order_sale->AreaID;

        if(Auth::user()->ID_type_users == 59)
        {
            $customer_all = DB::select("SELECT * from customer where CustomerTypeID = '$id' and AreaID = '$id_area'", []);
            $data_customer = DB::select("SELECT customer_type.id,customer_type.`name` FROM customer_type WHERE customer_type.id = '$id'", []);

            return view('order.order2_2', compact('customer_all', 'data_customer'));
        }
        else
        {
            $customer_all = DB::select("SELECT * FROM customer WHERE CustomerTypeID = '$id' AND AreaID IN ( SELECT users.ID_area FROM users WHERE users.id = ? )", [Auth::user()->id]);
            $data_customer = DB::select("SELECT customer_type.id,customer_type.`name` FROM customer_type WHERE customer_type.id = '$id'", []);

            return view('order.order2_2', compact('customer_all', 'data_customer'));
        }
    }

    public function index_area($id_area,$id_customer)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        DB::update("UPDATE order_sale SET AreaID = ? WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [$id_area,Auth::user()->id]);
        DB::update("UPDATE order_screen SET AreaID = ? WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [$id_area,Auth::user()->id]);
        $customer_all = DB::select("SELECT * from customer where CustomerTypeID = '$id_customer' and AreaID = '$id_area'", []);
        $data_customer = DB::select("SELECT customer_type.id,customer_type.`name` FROM customer_type WHERE customer_type.id = '$id_customer'", []);

        return view('order.order2_2', compact('customer_all', 'data_customer'));
    }

    public function addCustomerID(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $radio = $request->radio;
        // ADD DATA
        // order_sale::update_CustomerID($radio);
        DB::update("UPDATE order_sale SET CustomerID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // order_screen::update_CustomerID($radio);
        DB::update("UPDATE order_screen SET CustomerID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return redirect('/order2_3');
    }

    public function index3()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        // $doctor_all = customer_doctor::select_doctor();
        $doctor_all = DB::select("SELECT
                                        customer_doctor.Name_doctor AS 'ID',
                                        doctor.Name AS 'Name'
                                        FROM
                                        customer_doctor
                                        INNER JOIN doctor
                                        ON doctor.ID=customer_doctor.Name_doctor
                                        WHERE customer_doctor.Name_customer
                                        IN (SELECT order_sale.CustomerID
                                        from (select * from order_sale WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1)
                                        as order_sale)", [Auth::user()->id]);
        $data_customer = DB::select("SELECT
                                        order_sale.ID,
                                        customer.Name AS 'customer',
                                        customer_type.Name AS 'customer_type'
                                        FROM
                                        order_sale
                                        INNER JOIN customer
                                        ON customer.ID=order_sale.CustomerID
                                        INNER JOIN customer_type
                                        ON customer.CustomerTypeID=customer_type.id
                                        WHERE order_sale.SaleID = ?
                                        ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return view('order.order2_3', compact('doctor_all', 'data_customer'));
    }

    public function addDoctorID(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $radio = $request->radio;
        // order_sale::update_DoctorID($radio);
        DB::update("UPDATE order_sale SET DoctorID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // order_screen::update_DoctorID($radio);
        DB::update("UPDATE order_screen SET DoctorID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return redirect('/order2_4');
    }

    public function index4()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        // $data_customer = order_sale::select_customer();
        $data_customer = DB::select("SELECT
                    order_sale.ID,
                    order_sale.Barcode,
                    order_sale.RefBarcode,
                    customer.Name AS 'customer',
                    doctor.Name AS 'doctor',
                    customer_type.Name AS 'customer_type',
                    order_sale.SaleID,
                    order_sale.StartDate,
                    order_sale.DeliverDate,
                    type_Deliver.Name AS 'DeliverType',
                    order_sale.PatientHN,
                    order_sale.PatientName,
                    order_sale.PatientSex,
                    order_sale.PatientAge,
                    order_sale.comment,
                    order_sale.created_at,
                    order_sale.updated_at
                    FROM
                    order_sale
                    INNER JOIN type_Deliver
                    ON type_Deliver.ID=order_sale.DeliverType
                    INNER JOIN customer
                    ON customer.ID=order_sale.CustomerID
                    INNER JOIN doctor
                    ON doctor.ID=order_sale.DoctorID
                    INNER JOIN customer_type
                    ON customer.CustomerTypeID=customer_type.id
                    WHERE order_sale.SaleID = ?
                    ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return view('order.order2_4', compact('data_customer'));
    }

    public function addPatient(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $validate = \Validator::make($request->all(), [
            'PatientName' => 'required',
        ], [
            'PatientName.required' => 'กรุณาระบุ ชื่อ-นามสกุล',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $PatientName = $request->PatientName;
        $PatientHN = $request->PatientHN;
        $PatientAge = $request->PatientAge;
        $PatientSex = $request->radio;

        // order_sale::update_Patient($PatientName, $PatientHN, $PatientAge, $PatientSex);
        DB::update("UPDATE order_sale SET PatientName = '$PatientName', PatientHN = '$PatientHN', PatientAge = '$PatientAge', PatientSex = '$PatientSex' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // order_screen::update_Patient($PatientName, $PatientHN, $PatientAge, $PatientSex);
        DB::update("UPDATE order_screen SET PatientName = '$PatientName', PatientHN = '$PatientHN', PatientAge = '$PatientAge', PatientSex = '$PatientSex' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return redirect('/order3/company');
    }

    public function addDoctor(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $Doctor = new doctor;
        $Doctor->Name = $request->Name_Doctor;
        $Doctor->Phone = $request->phone;
        $Doctor->email = $request->email;
        $Doctor->Line_doctor = $request->line;
        $Doctor->save();

        $ID_customer = DB::select("SELECT
        order_sale.CustomerID
        FROM
        order_sale
        WHERE
        order_sale.SaleID = ? ORDER BY id DESC LIMIT 1
        ",[Auth::user()->id]);

        $ID_doctor = DB::select("SELECT
        doctor.ID
        FROM
        doctor
        WHERE
        doctor.`name` = ?
        ",[$request->Name_Doctor]);

        $customer_doctor = new customer_doctor;
        $customer_doctor->Name_doctor = $ID_doctor[0]->ID;
        $customer_doctor->Name_customer = $ID_customer[0]->CustomerID;
        $customer_doctor->save();
        // order_screen::update_DoctorID($radio);
        // DB::update("UPDATE order_screen SET DoctorID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return redirect('/order2_3');
    }
}
