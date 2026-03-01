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
                key: Constant::G,
                value: "Gramme"
            ),
            new ItemEnum(
                key: Constant::KG,
                value: "Kilogramme"
            ),
            new ItemEnum(
                key: Constant::L,
                value: "Litre"
            ),
            new ItemEnum(
                key: Constant::ML,
                value: "Millilitre"
            ),
        ];

        $this->setItems();
    }

    protected function setItems(): void
    {
        $this->items = $this->list;
    }
}
