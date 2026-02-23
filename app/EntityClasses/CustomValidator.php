<?php

namespace App\EntityClasses;

class CustomValidator
{
    public array $rules = [];
    public array $messages = [];

    function __construct(array $rules, array $messages){
        $this->rules = $rules;
        $this->messages = $messages;
    }
}