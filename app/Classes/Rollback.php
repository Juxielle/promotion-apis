<?php

namespace App\Classes;

class Rollback
{
    public string $action;
    public string $objectCode;
    public mixed $value;

    public function __contruct(string $action, string $objectCode, mixed $value)
    {
        $this->action = $action;
        $this->objectCode = $objectCode;
        $this->value = $value;
    }
}