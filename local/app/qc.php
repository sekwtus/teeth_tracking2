<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order_sale extends Model
{
    protected $table = 'order_sale';

    public static function select_order_sale()
    {
        $sql = "SELECT
                    *
                    FROM
                    order_sale
                    ORDER BY id DESC LIMIT 1)";
        return DB::select($sql , [Auth::user()->id]);
    }

}
