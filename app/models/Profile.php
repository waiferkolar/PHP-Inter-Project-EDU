<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-20
 * Time: 17:15
 */

namespace App\Models;


use App\Classes\DBWrapper;

class Profile extends DBWrapper
{
    protected $table = "profiles";
    protected $fillable = ['user_id', 'dob', 'nrc', 'father', 'image'];
}