<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Collection;

class Result
{
    public bool $isFailure;
    public bool $isSuccess;
    public object $value;

    public string $code;
    public array $errors;

    public static function fail(string $code, array $errors = []): Result
    {
        $result = new Result();
        $result->code = $code;
        $result->errors = $errors;
        $result->isSuccess = false;
        $result->isFailure = true;
        //$result->value = null;

        return $result;
    }

    public static function success(object $value): Result
    {
        $result = new Result();
        $result->code = "";
        $result->errors = [];
        $result->isSuccess = true;
        $result->isFailure = false;
        $result->value = $value;

        return $result;
    }
}
