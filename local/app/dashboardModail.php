<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class dashboardModail extends Model
{
    // Tody
    public static function count_select_data_for_packing_finish()
    {
        $sql = 'SELECT
                    COUNT(*) as number
                    FROM
                    order_screen
                    INNER JOIN customer ON order_screen.CustomerID = customer.ID
                    INNER JOIN doctor ON order_screen.DoctorID = doctor.ID
                    INNER JOIN job ON job.ID_order_screen = order_screen.ID
                    WHERE
                    job.job_current_department = 998 AND
                    order_screen.created_at >= CURRENT_DATE()';

        return DB::select($sql);
    }

    public static function count_select_data_today()
    {
        $sql = 'SELECT   
                        COUNT(*) as number
                        FROM
                        order_screen
                        INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
                        INNER JOIN users ON order_screen.SaleID = users.id
                        INNER JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                        INNER JOIN company ON type_Branch.companyID = company.ID
                        INNER JOIN customer ON order_screen.CustomerID = customer.ID
                        INNER JOIN job ON job.ID_order_screen = order_screen.ID
                        WHERE
                        job.job_current_department = 7 AND
                        order_screen.created_at >= CURRENT_DATE()
                        ';

        return DB::select($sql, [Auth::user()->id]);
    }

    public static function count_select_data_today_finish()
    {
        $sql = 'SELECT  
                    COUNT(*) as number
                    FROM
                    order_screen
                    INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
                    INNER JOIN users ON order_screen.SaleID = users.id
                    INNER JOIN type_Branch ON order_screen.BranchID = type_Branch.ID
                    INNER JOIN company ON type_Branch.companyID = company.ID
                    INNER JOIN customer ON order_screen.CustomerID = customer.ID
                    INNER JOIN job ON job.ID_order_screen = order_screen.ID
                    WHERE
                    job.job_current_department = 998 AND
                    order_screen.created_at >= CURRENT_DATE()
        ';

        return DB::select($sql, [Auth::user()->id]);
    }

//    End Tody

    // Screen
    public static function count_data_teeth()
    {
        $sql = "SELECT
                    str_to_date( order_screen.StartDate, '%d/%m/%Y' ) AS d,
                    COUNT( order_teeth_screen.ScreenID ) AS 'count' 
                FROM
                    order_screen
                    INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
                    INNER JOIN customer ON customer.ID = order_screen.CustomerID
                    INNER JOIN users ON users.id = order_screen.SaleID
                    INNER JOIN Employee ON Employee.ID_user = order_screen.SaleID
                    LEFT JOIN order_teeth_screen ON order_teeth_screen.ScreenID = order_screen.ID 
                GROUP BY
                    order_screen.ID 
                ORDER BY
                    d DESC";

        return DB::select($sql);
    }

    public static function count_data_order()
    {
        $sql = "SELECT
                    COUNT( * ) AS number,
                    SUM( order_teeth_screen.STATUS ) AS 'sumstatus',
                    COUNT( order_teeth_screen.ScreenID ) AS 'count' 
                FROM
                    order_screen
                    INNER JOIN doctor ON doctor.ID = order_screen.DoctorID
                    INNER JOIN customer ON customer.ID = order_screen.CustomerID
                    INNER JOIN users ON users.id = order_screen.SaleID
                    INNER JOIN Employee ON Employee.ID = order_screen.SaleID
                    INNER JOIN order_teeth_screen ON order_screen.ID = order_teeth_screen.ScreenID 
                GROUP BY
                    order_teeth_screen.ScreenID 
                HAVING
                    sumstatus != count 
                    OR sumstatus = 0 
                ORDER BY
                    order_screen.ID DESC";

        return DB::select($sql);
    }

    public static function count_data_screen()
    {
        $sql = "SELECT	 
                    SUM(order_teeth_screen.status) AS 'sumstatus',
                    COUNT(order_teeth_screen.ScreenID) AS 'count'
                    FROM
                    order_screen
                    INNER JOIN doctor
                    ON doctor.ID=order_screen.DoctorID
                    INNER JOIN customer
                    ON customer.ID=order_screen.CustomerID
                    INNER JOIN users
                    ON users.id=order_screen.SaleID
                    INNER JOIN Employee
                    ON Employee.ID=order_screen.SaleID
                    INNER JOIN order_teeth_screen
                    ON order_screen.ID=order_teeth_screen.ScreenID
                    GROUP BY order_teeth_screen.ScreenID
                    HAVING sumstatus = count
                    ORDER BY order_screen.ID desc";

        return DB::select($sql);
    }
}
