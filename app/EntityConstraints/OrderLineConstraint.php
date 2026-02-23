<?php

namespace App\EntityConstraints;

use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class OrderLineConstraint extends EntityConstraint
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::ARTICLE_COUNT,
                label: FieldLabel::ARTICLE_COUNT,
                value: 1
            ),
            new EntityModel(
                type: EntityType::FLOAT,
                name: EntityField::PRICE,
                label: FieldLabel::PRICE,
                value: "0"
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::ORDER_ID,
                isNullable: true,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::ORDERS,
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::PRODUCT_ID,
                isNullable: true,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::PRODUCTS,
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::SERVICE_ID,
                isNullable: true,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::SERVICES
            ),
        ];

        $this->items = $this->list;
    }
}
