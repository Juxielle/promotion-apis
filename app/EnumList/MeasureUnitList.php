<?php

namespace App\EnumList;

use App\Classes\Constant;

class MeasureUnitList extends ItemList
{
    private array $list;

    public function __construct()
    {
        $this->list = [
            new ItemEnum(
                key: Constant::CREDIT_CARD,
                value: "Carte de visa"
            ),
            new ItemEnum(
                key: Constant::AIRTEL_MONEY,
                value: "Airtel Money"
            ),
            new ItemEnum(
                key: Constant::MOOV_MONEY,
                value: "Moov Money"
            ),
        ];

        $this->setItems();
    }

    protected function setItems(): void
    {
        $this->items = $this->list;
    }
}
