<?php

namespace App\EntityClasses;

class DocumentName
{
    public string $name;
    public string $code;
    public bool $isRequired;

    public function __construct(string $name, string $code, bool $isRequired = true)
    {
        $this->name = $name;
        $this->code = $code;
        $this->isRequired = $isRequired;
    }
}
