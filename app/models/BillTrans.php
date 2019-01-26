<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-26
 * Time: 17:01
 */

namespace App\models;


use App\Classes\DBWrapper;

class BillTrans extends DBWrapper
{
    protected $table = "bill_transfers";
}