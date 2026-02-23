<?php

namespace App\EntityConstraints;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\EnumList\UserStatusList;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class UserConstraint extends EntityConstraint
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
                type: EntityType::STRING,
                name: EntityField::EMAIL,
                label: FieldLabel::EMAIL
            ),
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::TELEPHONE,
                label: FieldLabel::TELEPHONE
            ),
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::PASSWORD,
                label: FieldLabel::PASSWORD
            ),
            new EntityModel(
                type: EntityType::ENUM,
                name: EntityField::STATUS,
                label: FieldLabel::STATUS,
                listEnum: (new UserStatusList())->keys(),
                value: Constant::ACTIVE
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::ROLE_ID,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::ROLES
            ),
        ];

        $this->items = $this->list;
    }
}
