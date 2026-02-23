<?php

namespace App\EntityConstraints;

use App\EntityClasses\EntityField;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class CodeConfirmConstraint extends EntityConstraint
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::EMAIL,
                label: FieldLabel::EMAIL
            ),
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::CODE,
                label: FieldLabel::CODE
            ),
        ];

        $this->items = $this->list;
    }
}
