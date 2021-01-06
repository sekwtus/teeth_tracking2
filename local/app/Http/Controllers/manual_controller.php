<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Gate;
use DataTables;
use App\manual;

class manual_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $file_category = DB::SELECT("SELECT id,name from file_category ");
        return view('files.files', compact('file_category'));
    }

    public function show()
    {
        $manual = DB::SELECT("SELECT
                                manual.id,
                                manual.`name`,
                                manual.path_file,
                                manual.`status`,
                                manual.created_at,
                                manual.updated_at,
                                manual.file_category_id,
                                file_category.`name` AS file_category_name,
                                DATE_FORMAT( manual.updated_at, '%Y/%m/%d %H:%i' ) AS date_up,
                                Employee.Nick_name
                            FROM
                                manual
                            INNER JOIN file_category ON manual.file_category_id = file_category.id
                            INNER JOIN Employee ON manual.user_id = Employee.ID_user 
                            ORDER BY
                            manual.updated_at DESC 
                            ");
        return Datatables::of($manual)->make(true);
    }

    public function file_category(){
        $msg = DB::SELECT("SELECT
                            file_category.id,
                            file_category.name
                            FROM
                            file_category
        ");
        return  response()->json(array('msg'=> $msg));
    }

    public function add(Request $request){
        // return $request;
    //    return $filename = Auth::user()->id . '_' . Carbon::now()->toDateString() . '_' . str_random(8) . '.' . $request->file('image')->getClientOriginalExtension();
        $photo = "";
        if ($request->hasFile('image')){
            $filename = Auth::user()->id . '_' . str_random(8) . '_' . $request->file('image')->getClientOriginalName();           
            $request->file('image')->move(public_path('file'), $filename);
            $photo = $filename;
        }
        // manual::insert($request,$photo);
        DB::insert("INSERT INTO manual (name,path_file,created_at,updated_at,status,file_category_id,user_id)
                            VALUES
                            (?,?,NOW(),NOW(),'active',?,?)"
                            ,[$request->name_manual,$photo,$request->file_category_id,Auth::user()->id]);
        return redirect('files');
    }

    public function edit(Request $request){
        //  return $request ;
        $photo = "";
        if ($request->hasFile('image')){ 
            $filename = Auth::user()->id . '_' . str_random(8) . '_' . $request->file('image')->getClientOriginalName();            
            $request->file('image')->move(public_path('file'), $filename);
            $photo = $filename;
            
                DB::UPDATE("UPDATE manual 
                                SET name = ?, path_file = ?, updated_at = NOW(), status = 'active' ,file_category_id = ?, user_id = ?
                                WHERE id = ?
                                ",[$request->Name,$filename,$request->file_category_id,$request->ID,$request->ID]);

        }else {
            DB::UPDATE("UPDATE manual 
            SET name= ? , updated_at = NOW(), status = 'active',file_category_id = ?
            WHERE id = ?
            ",[$request->Name,$request->file_category_id,$request->ID]);
        }
            // manual::insert($request,$photo);
       
        return redirect('files');
    }

    public function delete(Request $request){
      
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

        // DB::delete("DELETE FROM manual WHERE id = ?", [$request->ID]);

        if( DB::delete("DELETE FROM manual WHERE id = ?", [$request->ID]) ) {
            unlink(public_path('file/'. $request->path_file)); //ถ้ามีการแนบไฟล์ใหม่ จะลบไฟล์เดิมทิ้ง
        }

         return 'ลบสำเร็จ';
       
    }

    public function updateStatus(Request $request, $id)
    { 
        $check = DB::SELECT("
                    SELECT 
                        status
                    FROM
                        manual
                    WHERE
                        id = '$id'
        ");
        if(!Gate::allows('IsAdmin')){
            abort(404,"Page NotFound");
        }

       if ($check[0]->status == 'active') {
            DB::update("UPDATE manual SET status = 'inactive' WHERE id = ? ", [$id]);
       } else {
        DB::update("UPDATE manual SET status = 'active' WHERE id = ? ", [$id]);
       }
       
        return redirect('files');
    }

    public function auto_delete_file(){
        $file = manual::where('created_at', '<', Carbon::now()->subDays(7))->get();
        // return  $file;
        if($file != null){
            foreach ($file as $key => $value) {
                manual::where('id', '=',$value->id)->delete();
                unlink(public_path('file/'. $value->path_file));
            }
            return response()->json(array('msg'=> 'ลบสำเร็จ')); 
        }// return  $file;
        else{
            return response()->json(array('msg'=> 'ไม่มีข้อมูล'));
        }
        // if(manual::where('created_at', '<', Carbon::now()->subDays(2))->delete()){
        //     return  response()->json(array('msg'=> 'ลบสำเร็จ'));
        // }else{
        //     return  response()->json(array('msg'=> 'ลบไม่สำเร็จ')); 
        // }
    }
  
  
}
