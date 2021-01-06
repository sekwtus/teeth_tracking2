<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Employee;
use DB;
use Auth;
use App\company;
use App\Branch;
use Hash;
use Carbon\Carbon;
use Image;

use App\users;
class profile_controller extends Controller
{
    public function profile()
    {
        $data_Employee = DB::select("SELECT
                                        Employee.ID,
                                        Employee.ID_user,
                                        users.username AS 'username',
                                        users.email AS 'email',
                                        Employee.ID_Employee,
                                        Employee.`Name`,
                                        Employee.Nick_name,
                                        Employee.name_position,
                                        Employee.gender,
                                        Employee.Phone_Number,
                                        Employee.Line_ID,
                                        Employee.department,
                                        Employee.cotton,
                                        type_Branch.Name AS 'type_Branch',
                                        company.Name AS 'company'
                                        FROM
                                        Employee
                                        INNER JOIN type_Branch
                                        ON type_Branch.ID=Employee.ID_type_Branch
                                        INNER JOIN company
                                        ON company.ID=Employee.ID_company
                                        INNER JOIN users
                                        ON users.id=Employee.ID_user
                                        WHERE Employee.ID_user = ?", [Auth::user()->id]);

        $data_users = DB::select("SELECT * FROM users WHERE users.id = ?", [Auth::user()->id]);


        return view('profile.profile',compact('data_Employee','data_users'));
    }

    public function editprofile()
    {
        $data_Employee = DB::select("SELECT
                                        Employee.ID,
                                        Employee.ID_user,
                                        users.username AS 'username',
                                        users.email AS 'email',
                                        users.password AS 'password',
                                        Employee.ID_Employee,
                                        Employee.`Name`,
                                        Employee.Nick_name,
                                        Employee.name_position,
                                        Employee.gender,
                                        Employee.Phone_Number,
                                        Employee.Line_ID,
                                        Employee.department,
                                        Employee.cotton,
                                        type_Branch.Name AS 'type_Branch',
                                        company.Name AS 'company',
                                        Employee.ID_type_Branch,
                                        Employee.ID_company
                                        FROM
                                        Employee
                                        INNER JOIN type_Branch
                                        ON type_Branch.ID=Employee.ID_type_Branch
                                        INNER JOIN company
                                        ON company.ID=Employee.ID_company
                                        INNER JOIN users
                                        ON users.id=Employee.ID_user
                                        WHERE Employee.ID_user = ?", [Auth::user()->id]);

        $data_type_company = company::all();

        $data_type_Branch = Branch::all();

        $data_users = DB::select("SELECT * FROM users WHERE users.id = ?", [Auth::user()->id]);


        return view('profile.editprofile',compact('data_Employee','data_type_company','data_type_Branch','data_users'));
    }

    public function addprofile(Request $request)
    {

        $validate = \Validator::make($request->all(), [
            'email' => 'nullable|email|unique:users,email,'.Auth::user()->id.',id',
            'username' => 'unique:users,username,' .Auth::user()->id.',id',
        ], [
            'username.unique'  =>  'username ต้องไม่ซ้ำ',
            'email.email' => 'รูปแบบการเขียน E-mail ไม่ถูกต้อง',
            'email.unique' => 'E-mail ต้องไม่ซ้ำ',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }



        $data_users = users::find(Auth::user()->id);

        if ($request->hasFile('image')){

            $filename = Auth::user()->username .'_'. $request->id .'_'. Carbon::now()->toDateString() .'_' . str_random(8) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/file'), $filename);
            $data_users->picture_user = $filename;
         }


        DB::update("UPDATE Employee SET Name = '$request->Name',
                                        ID_Employee = '$request->ID_Employee',
                                        Nick_name = '$request->Nick_name',
                                        gender = '$request->gender',
                                        Phone_Number = '$request->Phone_Number',
                                        Line_ID = '$request->Line_ID'
                                        WHERE Employee.ID_user = ?", [Auth::user()->id]);

        DB::update("UPDATE users SET username = '$request->username' , email = '$request->email' , picture_user = '$data_users->picture_user' , id_user_update = ?
                                        WHERE users.id = ?", [Auth::user()->id,Auth::user()->id]);

        return redirect('/profile');
    }

    public function changepassword(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'old_password'          => 'required',
            'password'              => 'required|min:4',
            'password_confirmation' => 'required|same:password'
        ], [
            'old_password.required'                 =>  'รหัสผ่านเก่าต้องไม่ว่าง',
            'password.required'                     =>  'รหัสผ่านใหม่ต้องไม่ว่าง',
            'password_confirmation.required'        =>  'ยืนยันรหัสผ่านใหม่ต้องไม่ว่าง',
            'password.min'                          =>  'รหัสผ่านใหม่ต้องไม่น้อยกว่า 4 ตัว',
            'password_confirmation.same'            =>  'รหัสผ่านใหม่ต้องตรงกับยืนยันรหัสผ่าน',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $data_users = new users();
        $data_users = users::find(Auth::user()->id);

        if (Hash::check($request->old_password, $data_users->password)) {
            $data_users->password = bcrypt($request->password);
            $data_users->save();
            return redirect('/profile');
           }

        return redirect()->back()->withErrors("รหัสผ่านไม่ถูกต้อง");
    }
}
