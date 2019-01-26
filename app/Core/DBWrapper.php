<?php

namespace App\Core;


class DBWrapper
{
    private $db;
    protected $table;
    protected $fillable;

    protected static $stmt;

    public function __construct()
    {
        $this->db = Database::getConn();
    }

    public function all()
    {
        self::$stmt = $this->db->prepare("SELECT * FROM " . $this->table);
        self::$stmt->execute();
        return self::$stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find($key, $value)
    {
        self::$stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE " . $key . "=:" . $key);
        self::$stmt->bindParam(":" . $key, $value);
        self::$stmt->execute();
        return new static;
    }

    public function insert($vlus)
    {
        $keys = "";
        foreach ($this->fillable as $fill) {
            $keys .= $fill . ",";
        }
        $keys = rtrim($keys, ",");

        $ary = explode(",", $keys);
        $values = "";
        foreach ($ary as $val) {
            $values .= ":" . $val . ",";
        }

        $values = rtrim($values, ",");


        self::$stmt = $this->db->prepare("INSERT INTO $this->table ($keys) VALUES ($values)");

        for ($i = 0; $i < count($vlus); $i++) {
            self::$stmt->bindParam(":" . $this->fillable[$i], $vlus[$i]);
        }

        return self::$stmt->execute();


    }

    public function where($key, $value)
    {
        self::$stmt = $this->db->prepare("SELECT * FROM " . $this->table . " WHERE " . $key . "=:" . $key);
        self::$stmt->bindParam(":" . $key, $value);
        self::$stmt->execute();
        return new static;
    }

    public function get()
    {
        return self::$stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function first()
    {
        return self::$stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function hashOne($joinTable, $foreign, $primary)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $joinTable . " WHERE " . $foreign . "=:" . $foreign);
        $stmt->bindParam(":" . $foreign, $primary);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function hasMany($joinTable, $foreign, $primary)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $joinTable . " WHERE " . $foreign . "=:" . $foreign);
        $stmt->bindParam(":" . $foreign, $primary);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function delete($key, $value)
    {
        $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE " . $key . "=:" . $key);
        $stmt->bindParam(":" . $key, $value);
        return $stmt->execute();
    }

    public function update($vals, $realKey, $realVal)
    {

        $pholder = "";

        foreach ($vals as $key => $vlue) {
            $pholder .= $key . "=:" . $key . ",";
        }
        $pholder = rtrim($pholder, ",");


        $stmt = $this->db->prepare("UPDATE " . $this->table . " SET " . $pholder . " WHERE " . $realKey . "=:" . $realKey);

        foreach ($vals as $k => $value) {
            $stmt->bindParam(":" . $k, $value);
        }
        $stmt->bindParam(":" . $realKey, $realVal);

        return $stmt->execute();
    }


}