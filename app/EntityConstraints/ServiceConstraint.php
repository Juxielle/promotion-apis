<?php

namespace App\EntityConstraints;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EntityClasses\EntityTable;
use App\EnumList\ProductStatusList;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class ServiceConstraint extends EntityConstraint
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
                type: EntityType::FLOAT,
                name: EntityField::PRICE,
                label: FieldLabel::PRICE,
                value: "0"
            ),
            new EntityModel(
                type: EntityType::FLOAT,
                name: EntityField::PROMOTIONAL_PRICE,
                label: FieldLabel::PROMOTIONAL_PRICE,
                value: "0"
            ),
            new EntityModel(
                type: EntityType::ENUM,
                name: EntityField::STATUS,
                label: FieldLabel::STATUS,
                listEnum: (new ProductStatusList())->keys(),
                value: Constant::ACTIVE
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::CATEGORY_ID,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::CATEGORIES
            ),
            new EntityModel(
                type: EntityType::INTEGER,
                name: EntityField::SELLER_ID,
                isForeignKey: true,
                referenceKey: EntityField::ID,
                referenceTable: EntityTable::SELLERS
            ),
        ];

        $this->items = $this->list;
    }
}
