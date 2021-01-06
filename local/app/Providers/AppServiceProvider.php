<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Employee;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $employee_user = Employee::all();

        $employee_user = DB::select("SELECT
                                        Employee.ID,
                                        Employee.ID_user,
                                        Employee.name_position,
                                        Employee.Nick_name,
                                        Employee.cotton,
                                        Employee.department
                                        FROM
                                        Employee
                                        ", []);

            View::share([
                'employee_user'    => $employee_user
            ]);

            $employee_department = DB::select("SELECT
                                                    Employee.ID_user,
                                                    Employee.department
                                                    FROM
                                                    Employee
                                                    INNER JOIN department ON Employee.department = department.ID
                                                    ", []);
            View::share([
            'employee_department'    => $employee_department
            ]);

            $product_department = DB::select("SELECT
                                            department.ID,
                                            department.DivisionID,
                                            department.`Name`
                                            FROM
                                            department
                                            WHERE
                                            department.DivisionID = ?
                                            ORDER BY department.order_menu ASC
                                            ",[4]);
            View::share([
                'product_department'    => $product_department
                ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
