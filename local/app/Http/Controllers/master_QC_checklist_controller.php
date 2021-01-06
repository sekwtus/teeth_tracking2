<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Gate;
use DB;

class master_QC_checklist_controller extends Controller{
    public function getIndex(){
        $Product = DB::select("SELECT
        product.ID,
        product.`Name`
        FROM
        product        
        ", []);

        $Department = DB::select("SELECT
        department.ID,
        department.`Name`
        FROM
        department
        WHERE
        department.ID < 800
        ", []);

        $QC_Checklist = null;

        return  view('master.master_QC',compact('Product','Department','QC_Checklist'));
    }

    public function search(Request $request){
        $Product = DB::select("SELECT
        product.ID,
        product.`Name`
        FROM
        product        
        ", []);

        $Department = DB::select("SELECT
        department.ID,
        department.`Name`
        FROM
        department
        WHERE
        department.ID < 800
        ", []);

        if($request->Product != null && $request->Department != null){
            $QC_Checklist = DB::select("SELECT
            qcchecklist.ID,
            product.`Name` AS product,
            product.`ID` AS product_ID,
            department.`Name` AS department,
            department.`ID` AS department_ID,
            qcchecklist.ccp
            FROM
            qcchecklist
            INNER JOIN product ON product.ID = qcchecklist.productID
            INNER JOIN department ON department.ID = qcchecklist.departmentID
            WHERE
            qcchecklist.productID = ? AND
            qcchecklist.departmentID  = ?      
            ", [$request->Product,$request->Department]);    
        }else if($request->Product == null && $request->Department != null){
            $QC_Checklist = DB::select("SELECT
            qcchecklist.ID,
            product.`Name` AS product,
            product.`ID` AS product_ID,
            department.`Name` AS department,
            department.`ID` AS department_ID,
            qcchecklist.ccp
            FROM
            qcchecklist
            INNER JOIN product ON product.ID = qcchecklist.productID
            INNER JOIN department ON department.ID = qcchecklist.departmentID
            WHERE
            qcchecklist.departmentID  = ?      
            ", [$request->Department]);
        }else if($request->Product != null && $request->Department == null){
            $QC_Checklist = DB::select("SELECT
            qcchecklist.ID,
            product.`Name` AS product,
            product.`ID` AS product_ID,
            department.`Name` AS department,
            department.`ID` AS department_ID,
            qcchecklist.ccp
            FROM
            qcchecklist
            INNER JOIN product ON product.ID = qcchecklist.productID
            INNER JOIN department ON department.ID = qcchecklist.departmentID
            WHERE
            qcchecklist.productID = ?      
            ", [$request->Product]);
        }else{
            $QC_Checklist = DB::select("SELECT
            qcchecklist.ID,
            product.`Name` AS product,
            product.`ID` AS product_ID,
            department.`Name` AS department,
            department.`ID` AS department_ID,
            qcchecklist.ccp
            FROM
            qcchecklist
            INNER JOIN product ON product.ID = qcchecklist.productID
            INNER JOIN department ON department.ID = qcchecklist.departmentID    
            ", [$request->Product,$request->Department]);
        }
        return view('master.master_QC',compact('Product','Department','QC_Checklist'));
    }
    public function edit(Request $request,$id){
        $Product = DB::select("SELECT
        product.ID,
        product.`Name`
        FROM
        product        
        ", []);

        $Department = DB::select("SELECT
        department.ID,
        department.`Name`
        FROM
        department
        WHERE
        department.ID < 800
        ", []);

        $QC_Checklist = null;

        DB::update("UPDATE qcchecklist SET productID = ?, departmentID = ?, ccp = ? WHERE ID = ?  ", [$request->ProductEdit,$request->DepartmentEdit,$request->QCEdit,$id]);
        // return ($id);
        // return view('master.master_QC',compact('Product','Department','QC_Checklist'));
        return redirect('master_QC');
    }

    public function delete($id){
        $Product = DB::select("SELECT
        product.ID,
        product.`Name`
        FROM
        product        
        ", []);

        $Department = DB::select("SELECT
        department.ID,
        department.`Name`
        FROM
        department
        WHERE
        department.ID < 800
        ", []);

        $QC_Checklist = null;

        DB::delete("DELETE FROM qcchecklist WHERE ID = '$id'", []);
        return view('master.master_QC',compact('Product','Department','QC_Checklist'));
    }
}