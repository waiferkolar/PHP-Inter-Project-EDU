<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-20
 * Time: 17:16
 */

namespace App\Models;


use App\Classes\DBWrapper;

class MoneyTranferRecord extends DBWrapper
{
    protected $table = "money_transfer_records";
}