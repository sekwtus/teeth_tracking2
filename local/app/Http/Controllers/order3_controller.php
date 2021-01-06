<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order_sale;
use App\factory;
use App\company;
use App\order_screen;
use App\type_Branch;
use App\area;
use DB;
use Auth;
use Gate;

class order3_controller extends Controller
{
    // public function index( )
    // {
    //     if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
    //         abort(404,"Page NotFound");
    //     }

    //     $factory_all = factory::select_factory();

    //     return view('order.order3',compact('factory_all'));
    // }

    public function index2()
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        // $company = company::select_all();
        $company = DB::select("SELECT company.ID,company.`Name`,company.fullname FROM company", []);

        return view('order.order3_1', compact('company'));
    }

    // public function addFactoryID(Request $request)
    // {
    //     if(!Gate::allows('IsSale') && !Gate::allows('IsAdmin')){
    //         abort(404,"Page NotFound");
    //     }

    //     $radio = $request->radio;
    //     order_sale::update_FactoryID($radio);
    //     order_screen::update_FactoryID($radio);

    //     return redirect('/order4');
    // }

    public function addcompanyID(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $radio = $request->radio;
        // order_sale::update_FactoryID($radio);
        DB::update("UPDATE order_sale SET FactoryID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // order_screen::update_FactoryID($radio);
        DB::update("UPDATE order_screen SET FactoryID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // $type_Branch = type_Branch::select_by_id($radio);
        $type_Branch = DB::select("SELECT type_Branch.ID,type_Branch.`Name` FROM type_Branch WHERE type_Branch.companyID = '$radio'", []);

        $data_company = DB::select("SELECT
                                        order_sale.ID,
                                        company.fullname AS 'fullname'
                                        FROM
                                        order_sale
                                        INNER JOIN company
                                        ON company.ID= ?
                                        WHERE order_sale.SaleID = ?
                                        ORDER BY id DESC LIMIT 1", [$radio, Auth::user()->id]);

        return view('order.order3_2', compact('type_Branch', 'data_company'));
    }

    public function addBranchID(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $radio = $request->radio;
        // order_sale::update_BranchID($radio);
        DB::update("UPDATE order_sale SET BranchID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // order_screen::update_BranchID($radio);
        DB::update("UPDATE order_screen SET BranchID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return redirect('/order7');
        // $typesale = DB::select('SELECT
        //                                 users.ID_type_users
        //                                 FROM
        //                                 users
        //                                 WHERE
        //                                 users.id = ?', [Auth::user()->id]);

        // foreach ($typesale as $data) {
        //     $datatype = $data->ID_type_users;
        // }

        // if ($datatype === 59) {
        //     $data_company = DB::select("SELECT
        //                                 order_sale.ID,
        //                                 company.fullname AS 'company_name',
        //                                 type_Branch.Name AS 'branch_name'
        //                                 FROM
        //                                 order_sale
        //                                 INNER JOIN company
        //                                 ON company.ID= order_sale.FactoryID
        //                                 INNER JOIN type_Branch
        //                                 ON type_Branch.ID= order_sale.BranchID
        //                                 WHERE order_sale.SaleID = ?
        //                                 ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        //     $area = area::select_by_id($radio);

        //     return view('order.order3_3', compact('data_company', 'area'));
        // // return 123456;
        // } else {
        //     return redirect('/order6');
        // }
        // return redirect('/order6');

        // IF LEADER SALE

        // $data_company = DB::select("SELECT
        //                                 order_sale.ID,
        //                                 company.fullname AS 'company_name',
        //                                 type_Branch.Name AS 'branch_name'
        //                                 FROM
        //                                 order_sale
        //                                 INNER JOIN company
        //                                 ON company.ID= order_sale.FactoryID
        //                                 INNER JOIN type_Branch
        //                                 ON type_Branch.ID= order_sale.BranchID
        //                                 WHERE order_sale.SaleID = ?
        //                                 ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        // $area = area::select_by_id($radio);

        // return view('order.order3_3', compact('data_company', 'area'));
        // END IF LEADER SALE
    }

    public function addArea(Request $request)
    {
        if (!(Gate::allows('IsSale') || Gate::allows('adminSale')) && !Gate::allows('IsAdmin') && !Gate::allows('Chiefsales')) {
            abort(404, 'Page NotFound');
        }

        $radio = $request->radio;
        // order_sale::update_Area($radio);
        DB::update("UPDATE order_sale SET AreaID = '$radio' WHERE order_sale.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);
        // order_screen::update_Area($radio);
        DB::update("UPDATE order_screen SET AreaID = '$radio' WHERE order_screen.SaleID = ? ORDER BY id DESC LIMIT 1", [Auth::user()->id]);

        return redirect('/order2');
    }
}
