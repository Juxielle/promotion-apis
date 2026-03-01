<?php

namespace App\EntityConstraints;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\EnumList\OrderStatusList;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class OrderConstraint extends EntityConstraint
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::CUSTOMER_ID,
                isNullable: true,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::CUSTOMERS
            ),
            new EntityModel(
                type: EntityType::ENUM,
                name: EntityField::STATUS,
                label: FieldLabel::STATUS,
                listEnum: (new OrderStatusList())->keys(),
                value: Constant::WAITING
            ),
        ];

        $this->items = $this->list;
    }
}
