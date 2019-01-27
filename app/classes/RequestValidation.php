<?php

namespace App\classes;


use App\Core\DBHelper;

class RequestValidation
{
    private static $errors = [];
    private static $error_messages = [
        'string' => 'The :attribute field cannot contain numbers',
        'required' => 'The :attribute field is required',
        'minLength' => 'The :attribute field must be a minimum of :policy characters',
        'maxLength' => 'The :attribute field must be a maximum of :policy characters',
        'mixed' => 'The :attribute field can contain only letters, numbers, dash and space only',
        'number' => 'The :attribute field cannot contain letters e.g 20.2, 30',
        'email' => 'Email address is not valid!',
        'unique' => 'The :attribute is already taken, please try another one!',
    ];

    public static function startValidate(array $dataAndValues, array $policies)
    {
        foreach ($dataAndValues as $column => $value) {
            if (in_array($column, array_keys($policies))) {
                self::doValidate([
                    'column' => $column,
                    'value' => $value,
                    'policies' => $policies[$column]
                ]);
            }
        }
    }

    public static function doValidate(array $data)
    {
        foreach ($data['policies'] as $method => $policy) {
            $valid = call_user_func_array([self::class, $method], [$data['column'], $data['value'], $policy]);
            if (!$valid) {
                self::setError(
                    str_replace(
                        [':attribute', ":policy", "_"],
                        [$data['column'], $policy, " "],
                        self::$error_messages[$method],
                        $data['column']
                    ));
            }
        }
    }

    public static function setError($error, $key = "")
    {
        if ($key == "") {
            self::$errors = $error;
        } else {
            self::$errors[$key][] = $error;
        }
    }

    public static function hashError()
    {
        return count(self::$errors) > 0;
    }

    public static function getErrors()
    {
        return self::$errors;
    }

    public static function unique($key, $value, $policy)
    {
        return DBHelper::unique($key, $value, $policy);
    }

    public static function required($key, $value, $policy)
    {
        return empty($value) || $value == null ? false : true;
    }

    public static function minLength($key, $value, $policy)
    {
        return strlen($value) > $policy;
    }

    public static function maxLength($key, $value, $policy)
    {
        return strlen($value) < $policy;
    }

    public static function isEmail($key, $value, $policy)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function mixed($key, $value, $policy)
    {
        return preg_match('/^[A-Za-z0-9 .,_~\-!@#\&%\^\'\*\(\)]+$/', $value);
    }

    public static function string($key, $value, $policy)
    {
        return preg_match('/^[A-Za-z]+$/', $value);
    }

    public static function number($key, $value, $policy)
    {
        return preg_match('/^[0-9]+$/', $value);
    }
}