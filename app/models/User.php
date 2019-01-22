<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-20
 * Time: 16:53
 */

namespace App\Models;


use App\Classes\DBWrapper;

class User extends DBWrapper
{
    protected $table = "users";
    protected $fillable = ['name', 'phone', 'money', 'password'];

    public function profile($id)
    {
        return $this->hashOne("profiles", "user_id", $id);
    }

    public function message($id)
    {
        return $this->hasMany("messages", "user_id", $id);
    }
}