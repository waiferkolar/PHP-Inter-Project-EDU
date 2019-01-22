<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-20
 * Time: 16:58
 */

namespace App\Models;


use App\Classes\DBWrapper;

class Message extends DBWrapper
{
    protected $table = "messages";
    protected $fillable = ["user_id", "content", "image"];
}