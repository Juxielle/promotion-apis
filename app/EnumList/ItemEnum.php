<?php

namespace App\EnumList;

class ItemEnum
{
    public string $key;
    public string $value;
    public string $data;

    public function __construct(string $key, string $value, string $data = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->data = $data ?? "";
    }
}
