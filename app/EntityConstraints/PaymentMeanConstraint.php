<?php

namespace App\EntityConstraints;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EnumList\PaymentModeList;
use App\Enums\EntityType;
use App\Enums\FieldLabel;

class PaymentMeanConstraint extends EntityConstraint
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
                type: EntityType::ENUM,
                name: EntityField::PAYMENT_MODE,
                label: FieldLabel::PAYMENT_MODE,
                listEnum: (new PaymentModeList())->keys(),
                value: Constant::CREDIT_CARD
            ),
            new EntityModel(
                type: EntityType::STRING,
                name: EntityField::IMAGE,
                label: FieldLabel::IMAGE,
                isFile: true
            ),
        ];

        $this->items = $this->list;
    }
}
