<?php

namespace App\EntityConstraints;

use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class PaymentConstraint extends EntityConstraint
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new EntityModel(
                type: EntityType::FLOAT,
                name: EntityField::TOTAL_PRICE,
                label: FieldLabel::TOTAL_PRICE,
                value: "0"
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::ORDER_ID,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::ORDERS,
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::PAYMENT_MEAN_ID,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::PAYMENT_MEANS,
            ),
        ];

        $this->items = $this->list;
    }
}
