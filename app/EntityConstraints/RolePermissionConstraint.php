<?php

namespace App\EntityConstraints;

use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class RolePermissionConstraint extends EntityConstraint
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::PROPORTION,
                label: FieldLabel::PROPORTION,
                value: "1"
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::ROLE_ID,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::ROLES
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::PERMISSION_ID,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::PERMISSIONS
            ),
        ];

        $this->items = $this->list;
    }
}
