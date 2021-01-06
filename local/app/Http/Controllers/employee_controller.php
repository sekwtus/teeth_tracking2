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
use App\sub_department;

class employee_controller extends Controller
{
    public function index()
    {
        if(!Gate::allows('IsAdmin') && !Gate::allows('adminSale')){
            abort(404,"Page NotFound");
        }

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
            ON users.id=Employee.ID_user", []);

            return view('Employee.employee',compact('data_Employee'));
      
    }

    public function create()
    {
        if(!Gate::allows('IsAdmin') && !Gate::allows('adminSale')){
            abort(404,"Page NotFound");
        }

        $data_type_company = company::all();
        $data_type_Branch = DB::select("SELECT
        type_Branch.ID,
        type_Branch.`Name`,
        type_Branch.companyID,
        company.`Name` as name_company
        FROM
        type_Branch
        LEFT JOIN company ON type_Branch.companyID = company.ID
        ");
        $data_type_users = type_users::all();
        $data_sub_department = sub_department::withoutSale();
        $area = DB::select("SELECT * from area");

        return view('Employee.create_employee',compact('data_type_company','data_type_Branch',
        'data_type_users','data_sub_department','area'));
    }

    public function edit($id)
    {
        if(!Gate::allows('IsAdmin') && !Gate::allows('adminSale')){
            abort(404,"Page NotFound");
        }

        $data_type_company = company::all();
        $data_type_Branch = DB::select("SELECT
        type_Branch.ID,
        type_Branch.`Name`,
        type_Branch.companyID,
        company.`Name` as name_company
        FROM
        type_Branch
        LEFT JOIN company ON type_Branch.companyID = company.ID
        ");
        $data_type_users = type_users::all();

        $data_sub_department = sub_department::withoutSale();

        $data_Employee = DB::select("SELECT
                                Employee.ID,
                                Employee.ID_user,
                                users.username AS username,
                                users.email AS email,
                                Employee.ID_Employee,
                                Employee.`Name`,
                                Employee.Nick_name,
                                Employee.name_position,
                                Employee.gender,
                                Employee.Phone_Number,
                                Employee.Line_ID,
                                Employee.department,
                                Employee.cotton,
                                type_Branch.`Name` AS type_Branch,
                                company.`Name` AS company,
                                Employee.ID_type_Branch,
                                Employee.ID_company,
                                users.ID_type_users,
                                users.ID_area,
                                type_users.`Name` AS name_type_user,
                                user_subDepartments.Sub_DepartmentID
                                FROM
                                Employee
                                LEFT JOIN type_Branch ON type_Branch.ID = Employee.ID_type_Branch
                                LEFT JOIN company ON company.ID = Employee.ID_company
                                LEFT JOIN users ON users.id = Employee.ID_user
                                LEFT JOIN type_users ON users.ID_type_users = type_users.ID
                                LEFT JOIN user_subDepartments ON users.id = user_subDepartments.user_id
                                WHERE
                                Employee.ID_user = ?", [$id]);

            $data_users = DB::select("SELECT * FROM users WHERE users.id = ?", [$id]);
            $area = DB::select("SELECT * from area");

        return view('Employee.edit_employee',compact('data_sub_department','data_type_company','data_type_Branch',
        'data_type_users','data_Employee','data_users','area'));
        //return $data_users;
    }


    public function add(Request $request)
    {

        if(!Gate::allows('IsAdmin') && !Gate::allows('adminSale')){
            abort(404,"Page NotFound");
        }

        $validate = \Validator::make($request->all(), [
            'email'                                 => 'nullable|email|unique:users,email',
            'username'                              => 'required|unique:users,username',
            'password'                              => 'required|min:4',
            'password_confirmation'                 => 'required|same:password'
        ], [
            'username.required'                     =>  'username ต้องห้ามว่าง',
            'username.unique'                       =>  'username ต้องไม่ซ้ำ',
            'email.email'                           =>  'รูปแบบการเขียน E-mail ไม่ถูกต้อง',
            'email.unique'                          =>  'E-mail ต้องไม่ซ้ำ',
            'password.required'                     =>  'รหัสผ่านใหม่ต้องไม่ว่าง',
            'password_confirmation.required'        =>  'ยืนยันรหัสผ่านใหม่ต้องไม่ว่าง',
            'password.min'                          =>  'รหัสผ่านใหม่ต้องไม่น้อยกว่า 4 ตัว',
            'password_confirmation.same'            =>  'รหัสผ่านใหม่ต้องตรงกับยืนยันรหัสผ่าน',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }


        $data_users = users::all();

        if ($request->hasFile('image')){

            $filename = Auth::user()->username .'_'. $request->id .'_'. Carbon::now()->toDateString() .'_' . str_random(8) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/file'), $filename);
            $data_users->picture_user = $filename;
         }
         else
         {
            $data_users->picture_user = null;
         }

         $data_users->password = bcrypt($request->password);

         if ($request->area == 0 || $request->area == null) {
            DB::insert("INSERT INTO users (username, password ,email, picture_user, ID_type_users , created_at )
            values ('$request->username','$data_users->password','$request->email','$data_users->picture_user','$request->ID_type_users',NOW())", []);
         } else {
            DB::insert("INSERT INTO users (username, password,ID_area ,email, picture_user, ID_type_users , created_at )
            values ('$request->username','$data_users->password','$request->area','$request->email','$data_users->picture_user','$request->ID_type_users',NOW())", []);
         }

        $data_users2 = DB::table('users')->where('username','=', $request->username)->first();

        DB::insert("INSERT INTO user_subDepartments (user_id,username, Sub_DepartmentID,created_at )
                    values ('$data_users2->id','$request->username','$request->sub_department',NOW())", []);

        // return Var_dump($data_users2);
        $depart = null;
        if ($request->sub_department != 0) {
            $main_department = DB::table('sub_department')->where('ID','=', $request->sub_department)->first();
        $depart = $main_department->DepartmentID;
        }

        $company = DB::table('type_Branch')->where('ID','=', $request->Branch)->first();

        DB::insert("INSERT INTO Employee (Name,ID_user,ID_Employee, Nick_name, name_position, gender, Phone_Number,
                                          Line_ID, department,ID_type_Branch, ID_company, created_at , updated_at,status)
                                  values ('$request->Name','$data_users2->id','$request->ID_Employee','$request->Nick_name','$request->name_position',
                                          '$request->gender','$request->Phone_Number','$request->Line_ID','$depart',
                                          '$request->Branch','$company->companyID',NOW(),NOW(),1)", []);

        return redirect('/employee');
    }


    public function saveedit(Request $request,$id_user)
    {
        if(!Gate::allows('IsAdmin') && !Gate::allows('adminSale')){
            abort(404,"Page NotFound");
        }

        $validate = \Validator::make($request->all(), [
            'email'                                 => 'nullable|email|unique:users,email,'.$id_user.',id',
            'username'                              => 'unique:users,username,' .$id_user.',id'
        ], [
            'username.required'                     =>  'username ต้องห้ามว่าง',
            'username.unique'                       =>  'username ต้องไม่ซ้ำ',
            'email.email'                           =>  'รูปแบบการเขียน E-mail ไม่ถูกต้อง',
            'email.unique'                          =>  'E-mail ต้องไม่ซ้ำ'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput($request->all());
        }

        $data_users = users::find($id_user);

        if ($request->hasFile('image')){
            $filename = Auth::user()->username .'_'. $request->id .'_'. Carbon::now()->toDateString() .'_' . str_random(8) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/file'), $filename);
            $data_users->picture_user = $filename;
         }

        $department = sub_department::where('ID',$request->sub_department)->limit(1)->first();
        $company = DB::table('type_Branch')->where('ID','=', $request->Branch)->first();

        DB::update("UPDATE Employee SET Name = '$request->Name',
                                        Nick_name = '$request->Nick_name',
                                        gender = '$request->gender',
                                        Phone_Number = '$request->Phone_Number',
                                        Line_ID = '$request->Line_ID',
                                        department = '$department->DepartmentID',
                                        cotton = '$request->cotton',
                                        ID_type_Branch = '$request->Branch',
                                        ID_company = '$company->companyID'
                                        WHERE Employee.ID_user = ?", [$id_user]);

        DB::update("UPDATE users SET    username = '$request->username' ,
                                        email = '$request->email' ,
                                        ID_area = '$request->area',
                                        ID_type_users = '$request->ID_type_users',
                                        picture_user = '$data_users->picture_user',
                                        id_user_update = ?
                                        WHERE users.id = ?", [Auth::user()->id,$id_user]);

        DB::update("UPDATE user_subDepartments SET username = '$request->username' ,
                                        Sub_DepartmentID = '$request->sub_department'
                                        WHERE user_subDepartments.user_id = ?", [$id_user]);


        return redirect('/employee');
    }

    public function delete($id,$id_user)
    {
        if(!Gate::allows('IsAdmin') && !Gate::allows('adminSale')){
            abort(404,"Page NotFound");
        }

        //DB::delete("DELETE Employee WHERE ID = '$id'", []);

        Employee::where('ID',$id)->delete();

        $data_users = users::find($id_user);
        $data_users->delete();

        return redirect('/employee');
    }


    public function updateStatus(Request $request, $id)
    {
        if(!Gate::allows('IsAdmin') && !Gate::allows('adminSale')){
            abort(404,"Page NotFound");
        }

        $id_employee = $id;
        employee::update_status($id_employee);

        return redirect('employee');
    }
}
