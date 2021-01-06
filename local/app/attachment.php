<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class attachment extends Model
{
    protected $table = 'attachment';

    public static function select_attachment()
    {
        $sql = "SELECT
                    attachment.ID,
                    attachment.`Name`,
                    attachment.AttachmentTypeID
                    FROM
                    attachment ,
                    attachment_type
                    WHERE
                    attachment.AttachmentTypeID = '1' AND attachment.AttachmentTypeID = attachment_type.ID";
        return DB::select($sql , []);
    }
}
