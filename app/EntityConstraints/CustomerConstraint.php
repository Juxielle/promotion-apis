<?php

namespace App\EntityConstraints;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\EnumList\SexList;
use App\EnumList\UserStatusList;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class CustomerConstraint extends EntityConstraint
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::NAME,
                label: FieldLabel::NAME
            ),
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::FIRSTNAME,
                label: FieldLabel::FIRSTNAME,
                isNullable: true
            ),
            new EntityModel(
                type: EntityType::ENUM,
                name: EntityField::SEX,
                label: FieldLabel::SEX,
                listEnum: (new SexList())->keys(),
                value: Constant::SEX_M
            ),
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::EMAIL,
                label: FieldLabel::EMAIL,
                isNullable: true
            ),
        ];

        $this->items = $this->list;
    }
}
