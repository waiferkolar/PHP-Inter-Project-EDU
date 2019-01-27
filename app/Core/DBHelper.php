<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-27
 * Time: 18:13
 */

namespace App\Core;


class DBHelper
{
    public static function unique($name, $value, $policy)
    {
        $con = Database::getConn();
        $stmt = $con->prepare("SELECT * FROM $policy WHERE $name=:name");
        $stmt->bindParam(":name", $value);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        return $result == false ? true : false;

    }
}