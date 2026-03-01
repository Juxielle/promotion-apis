<?php

namespace App\EntityConstraints;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\EnumList\UserStatusList;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class CategoryConstraint extends EntityConstraint
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::CODE,
                label: FieldLabel::CODE
            ),
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::LABEL,
                label: FieldLabel::LABEL
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::CATEGORY_ID,
                isNullable: true
            ),
        ];

        $this->items = $this->list;
    }
}
