<?php

namespace App\EntityConstraints;

class EntityModel
{
    public string $type;
    public string $name;
    public string $label;
    public array $listEnum;
    public string|int|float|bool $value;
    public bool $isForeignKey;
    public string $referenceKey;
    public string $referenceTable;
    public bool $isNullable;
    public bool $isSought;
    public bool $isFile;

    public function __construct(
        string $type,
        string $name,
        string $label = "",
        array $listEnum = [],
        string|int|float|bool $value = "",
        bool $isNullable = false,
        bool $isForeignKey = false,
        bool $isSought = false,
        bool $isFile = false,
        string $referenceKey = "",
        string $referenceTable = "")
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->listEnum = $listEnum;
        $this->value = $value;
        $this->isForeignKey = $isForeignKey;
        $this->isSought = $isSought;
        $this->isFile = $isFile;
        $this->referenceKey = $referenceKey;
        $this->referenceTable = $referenceTable;
        $this->isNullable = $isNullable;
    }
}
